<?php

class Database extends PDO
{

    /**
     * Database constructor.
     * @param string $username
     * @param string $password
     * @param string $host
     * @param string $database
     */
    public function __construct($username = '', $password = '', $host = '', $database = '')
    {
        $dsn = 'mysql:dbname='.$database.';host='.$host;
        parent::__construct($dsn,$username,$password);
    }

    /**
     * @param int $to_id
     * @param int $from_id
     * @param string $message
     * @param string $ip_address
     */
    public function insert($to_id = 0, $from_id = 0, $message = '', $ip_address = '', $sender_uid = 0, $receiver_uid = 0, $listing_id = 0, $is_read = 0) {
        $statement = $this->prepare("INSERT INTO chat_interactions 
                          SET 
                          to_id = :to_id,
                          from_id = :from_id,
                          message = :message,
                          ip_address = :ip_address,
                          sender_uid = :sender_uid,
                          receiver_uid = :receiver_uid,
                          listing_id = :listing_id;
                          is_read = :is_read");


        $result = $statement->execute([
            'to_id' => $to_id,
            'from_id' => $from_id,
            'message' => $message,
            'ip_address' => $ip_address,
			'sender_uid'=> $sender_uid,
			'receiver_uid' => $receiver_uid,
            'listing_id'    => $listing_id,
            'is_read'    => $is_read,
        ]);

        var_export($result);
    }

    /**
     * @param string $username
     * @param string $user_id
     * @param string $ip_address
     * @param integer $uid
     */
    public function insert_users_list($username = '', $user_id = '', $ip_address = '', $uid = 11) {


    }
}
