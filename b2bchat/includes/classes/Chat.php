<?php
	
	use Ratchet\MessageComponentInterface;
	use Ratchet\ConnectionInterface;
	
	require_once 'custom-db.php';
	
	class Chat implements MessageComponentInterface
	{
		
		/**
		 * @var SplObjectStorage
		 */
		protected $clients = null;

		private static $current_users = [];
		private static $custom_db_data = [];

		/**
		 * @var array
		 */
		protected $users = [];
		
		/**
		 * @var Database
		 */
		protected $db = null;
		
		
		public function __construct ($db)
		{
			$this->clients = new \SplObjectStorage;
			$this->db = $db;
		}
		
		/**
		 * @param ConnectionInterface $conn
		 */
		public function onOpen (ConnectionInterface $conn)
		{
			$this->clients->attach($conn);
		}
		
		/**
		 * @param ConnectionInterface $from
		 * @param string              $msg
		 */
		public function onMessage (ConnectionInterface $from, $msg)
		{
			$message_sent = false;
			/*echo '<pre>';
			print_r($this->clients);*/
			$i = 0;
			foreach ($this->clients as $client) {
			    //echo ++$i.'<br>';
				$package = json_decode($msg);

				if (is_object($package) == true) {
					/**
					 * We need to switch the message type because in the future
					 * this could be a message or maybe a request for all chatters
					 * in the chat. For now we only use the message type but we can
					 * build on that later.
					 */

					switch ($package->type) {
						case 'message':

                           if ($from != $client) {
                               //echo 'yes<br>';
 								if ($message_sent === false){
									// send private message.
									if (empty($package->to_user) == false) {
										$message_sent = true;
										$this->handle_message($package, $from, $msg, $client);
									}
								}


								// Stoping Public Message
								//return;


								/**
								 * Defined in includes/config.php
								 */
                               /*if (ENABLE_DATABASE == true) {
                                 /*if (isset($package->user) and is_object($package->user) == true) {
                                       $this->db->insert(
                                           $package->to_user,
                                           $package->user->id,
                                           $package->message,
                                           $client->remoteAddress
                                       );
                                   }
                               }*/
								$client->send($msg);
							} else {
                               //echo 'No<br>';
								if ($message_sent === false){
									// send offline & private messages.
									if (empty($package->to_user) == false) {
										$message_sent = true;
										$this->handle_message($package, $from, $msg, $client);
									}
								}

							}
							break;
						case 'registration':

							// Avoid Duplicating
							if (!is_user_online($package->user->id)) {
								$this->register_user($from, $package, $client);
							}
							break;
						case 'userlist':
							$list = [];


							foreach ($this->users as $resourceId => $value) {
								$list[ $resourceId ] = $value['user'];
							}
                            /*echo '<pre>';
                            print_r($package);*/
							if (! in_array($value['user']->username, self::$current_users)){
                                $user_arr['username'] = $value['user']->username;
                                $user_arr['id'] = $value['user']->id;
                                $user_arr['db_id'] = $value['user']->db_id;
                                $json_encoded = get_user_list($user_arr, false);
                                $arr = json_decode($json_encoded);

                                if (is_array($arr)){
                                    self::$current_users[] = $value['user']->username;
                                    self::$custom_db_data[$value['user']->username] = $json_encoded;
                                }else {
                                    $arr = [];
                                }
                            }elseif  (isset(self::$custom_db_data[$value['user']->username])) {
							    $json_encoded = self::$custom_db_data[$value['user']->username];
                                $arr = json_decode($json_encoded);
                            }else {
							    $arr = [];
                            }





							$new_package = [
								'users' => $list,
                                'details' => $arr,
								'type'  => 'userlist'
							];

							$new_package = json_encode($new_package);

							$client->send($new_package);
							break;
					}
				}
			}
		}
		
		private function handle_message($package, $from, $msg, $client){
		        $message_sent_to = [];
				
				// offline chat
				if (!is_user_online($package->to_user)) {
					$this->users[] = [
						'user'   => $package->user,
						'client' => $from
					];
				}
				
				/**
				 * Find the client to send the message to
				 */
				$i = 0;
				foreach ($this->users as $resourceId => $user) {
					echo $i++;
					if ($resourceId == $from->resourceId)
						continue;

					/**
					 * Non target users will not see this message
					 * on their screens.
					 */

					if ($user['user']->id == $package->to_user && !in_array($user['user']->id, (array) $message_sent_to)) {

						$this->save_chat_into_db($package, $client);

						$message_sent_to[] = $user['user']->id;

						$targetClient = $user['client'];
						$targetClient->send($msg);

						return;
					} else if (!is_user_online($package->to_user)) {
						$this->save_chat_into_db($package, $client);
					}
				}
			
		}
		
		private function save_chat_into_db ($package, $client)
		{
			/**
			 * Defined in includes/config.php
			 */
			if (ENABLE_DATABASE == true) {
				if (isset($package->user) and is_object($package->user) == true and (!empty($package->from_user_db_id > 0) && $package->from_user_db_id > 0) and (!empty($package->to_user_db_id) && $package->to_user_db_id > 0)) {
                    $conn = get_connection();
                    $query = "SELECT * FROM chat_interactions WHERE 
                                sender_uid = {$package->from_user_db_id} 
                                and receiver_uid = {$package->to_user_db_id}  
                                and ip_address = '{$client->remoteAddress}'  
                                and listing_id = '{$package->listing_id}'
                                and `time` = now()

                                ";
                    //echo $query;
                    $result = $conn->query($query);
                    if ($result->num_rows == 0){
                        $this->db->insert(
                            $package->to_user,
                            $package->user->id,
                            $package->message,
                            $client->remoteAddress,
                            $package->from_user_db_id, //@todo: we can also get this from online user table (user_list table)
                            $package->to_user_db_id,
                            $package->listing_id
                        );
                    }

				}
			}
		}
		
		private function register_user ($from, $package, $client)
		{
			
			$this->users[ $from->resourceId ] = [
				'user'   => $package->user,
				'client' => $from
			];
			
			if (ENABLE_DATABASE == true) {
				if(!empty($package->user->username)){
                    custom_insert(
                        $package->user->username,
                        $package->user->id,
                        $client->remoteAddress,
                        $from->resourceId,
                        $package->user->db_id
                    );
                }

				
			}
		}
		
		/**
		 * @param ConnectionInterface $conn
		 */
		public function onClose (ConnectionInterface $conn)
		{
			
			//$user = $this->users[$conn->resourceId]['user'];
			delete_by_resource_id($conn->resourceId);
			
			
			unset($this->users[ $conn->resourceId ]);
			$this->clients->detach($conn);
			
			
		}
		
		/**
		 * @param ConnectionInterface $conn
		 * @param Exception           $e
		 */
		public function onError (ConnectionInterface $conn, \Exception $e)
		{
			unset($this->users[ $conn->resourceId ]);
			$conn->close();
		}
	}
