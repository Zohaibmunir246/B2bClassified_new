<?php

require_once (realpath(__DIR__ . '/..') . '/config.php');
require_once (realpath(__DIR__ . '/../../..') . '/enviornments.php');

$posted_data = filter_input_array(INPUT_POST);

if (!empty($posted_data) && isset($posted_data['fn'])) {

	switch ($posted_data['fn']) {
		case 'get_user_chat':
            $listing_id = "";
            if(isset($posted_data['listing_id'])){
                $listing_id = $posted_data['listing_id'];
            }
			get_chat($posted_data['sender'], $posted_data['rec'], $posted_data['receiver_id'], $listing_id);
			break;
		case 'get_user_list':

			get_user_list($posted_data['accessor']);
			break;
		case 'get_si':
			get_seller_info($posted_data['id']);
			break;
		case 'del_chat':
			//delete_chat($posted_data['id'], $posted_data['user_db_id'], $posted_data['listings_id']);
			break;
	}
}

function delete_chat($md5_id, $db_id, $listing_id){
	$conn = get_connection();

	$listing_id = intval($listing_id);

	$sql = "DELETE FROM chat_interactions where listing_id = '{$listing_id}' AND from_id = '{$md5_id}' AND sender_uid = '{$db_id}' ";

	echo $sql;

	if ($conn->query($sql) === true) {
		echo 'deleted';
	} else {
		echo 'fail';
	}

	$conn->close();


	exit;
}

function get_seller_info($seller_id){
	$conn = get_connection();

	$query = "SELECT username FROM b2b_users WHERE id = '{$seller_id}' limit 1 ";
	$result = $conn->query($query);
	if ($result->num_rows > 0){
		$row = mysqli_fetch_assoc($result);
		$row['md5_id'] = md5($row['username']);
		echo json_encode($row);
		exit;
	}

	exit;
}

function get_user_list(array $accessor, $echo = true){
	$username = $accessor['username'];
	$md5_id = $accessor['id'];
	$sender_db_uid = $accessor['db_id'];
	/*echo '<pre>';
	print_r($accessor);*/

 	$conn = get_connection();

	$query = "SELECT distinct (receiver_uid), sender_uid, listing_id, message, message_id
					FROM chat_interactions
					where sender_uid = '{$sender_db_uid}' or receiver_uid =  '{$sender_db_uid}'  order by message_id desc;";

	$result = $conn->query($query);

	$receivers = [];
	if ($result->num_rows > 0){
		$i = 0;
		$message = '';
		while ($row = mysqli_fetch_assoc($result)) {

			if ($i === 0){
				$message = $row['message'];
			}else {
				$row['message'] = $message;
			}

			$i++;

			$uid = $row['receiver_uid'];
			if ($uid === $sender_db_uid){
				$uid = $row['sender_uid'];
			}

			$query = "SELECT id,username FROM b2b_users where id = '{$uid}' limit 1";
			$rec_row = $conn->query($query);

			$row1 = (mysqli_fetch_assoc($rec_row));
			$row['md5_id'] = md5($row1['username']);
			$row['username'] = ($row1['username']);
			$row['id'] = ($row1['id']);


			// ROW 2
			$lid = $row['listing_id'];
			$query = "SELECT l.title,
							   l.created_at,
							   l.meta_values,
							   c.name as country_name,
							   s.name as state_name,
							   cc.name as city_name
						FROM listings_new l
								 left join b2b_countries c on l.country_id = c.id
								 left join b2b_states s on l.state_id = s.id
								 left join b2b_cities cc on l.city_id = cc.id
						where l.id = '{$lid}' limit 1;";

			$rec_row = $conn->query($query);

			$row2 = (mysqli_fetch_assoc($rec_row));
			$row['listing_id'] = $lid;
			$row['listing_title'] = ($row2['title']);
			$row['listing_created_at'] = date("F jS, Y", strtotime(($row2['created_at'])));
			$row['listing_country_name'] = ($row2['country_name']);
			$row['listing_state_name'] = ($row2['state_name']);
			$row['listing_city_name'] = ($row2['city_name']);
			// ROW 2 - Ends
            $metas = json_decode($row2['meta_values'],true);
            /*echo '<pre>';
            print_r(json_decode($row2['meta_values'],true));
            echo '</pre>';
            exit;*/
			// ROW 3
			/*$query = "SELECT lm.meta_value FROM listings_meta lm WHERE lm.listings_id = '{$lid}' AND lm.meta_key = 'price'";

			$rec_row = $conn->query($query);

			$row3 = (mysqli_fetch_assoc($rec_row));*/
			if (isset($metas['price']) && !empty($metas['price']))
				$row['price'] = $metas['price'];
			else
				$row['price'] = '';
			// ROW 3 - Ends


			// Row 4

			/*$query = "SELECT lm.meta_value FROM listings_meta lm WHERE lm.listings_id = '{$lid}' AND lm.meta_key = 'currency_code'";

			$rec_row = $conn->query($query);

			$row4 = (mysqli_fetch_assoc($rec_row));*/
			if (isset($metas['currency_code']) && !empty($metas['currency_code']))
				$row['currency_code'] = $metas['currency_code'];
			else
				$row['currency_code'] = '';

			// Row 4 - Ends


			// Row 5

			/*$query = "SELECT lm.meta_value FROM listings_meta lm WHERE lm.listings_id = '{$lid}' AND lm.meta_key = 'images_from'";

			$rec_row = $conn->query($query);

			$row5 = (mysqli_fetch_assoc($rec_row));*/
			if (isset($metas['images_from']) && !empty($metas['images_from'])){
			    if(is_array($metas['images_from'])){
                    $images_data = $metas['images_from'];
                }else{
                    $images_data = unserialize($metas['images_from']);
                }

				$row['listing_image'] = isset($images_data[0]) ? (__BACKEND_URL__ . 'uploads/listing_images/' . $images_data[0])  : 'https://via.placeholder.com/80';
			}

			// Row 5 - Ends


			$receivers[] = $row;

		}
	}

	$conn->close();

	if ($echo)
	    echo json_encode($receivers);
	else
	    return json_encode($receivers);


	return false;
}


function get_connection ()
{
	$servername = DATABASE_HOST;
	$username = DATABASE_USERNAME;
	$password = DATABASE_PASSWORD;
	$dbname = DATABASE_DB;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	return $conn;
}


function delete_all ()
{
	$conn = get_connection();


	$sql = "DELETE FROM users_list where 1=1";

	if ($conn->query($sql) === true) {
		echo "records deleted";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function delete_by_resource_id ($resource_id)
{
	$conn = get_connection();


	$sql = "DELETE FROM users_list where resource_id = '{$resource_id}' ";

	if ($conn->query($sql) === true) {
		echo "Resource ID $resource_id is deleted" . PHP_EOL . PHP_EOL;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}


function custom_insert ($uname, $md5_id, $ipadd, $resource_id, $uid)
{

	$conn = get_connection();


	$sql = "INSERT INTO users_list (username, user_id, ip_address, resource_id,uid) VALUES ('{$uname}', '{$md5_id}', '{$ipadd}', '{$resource_id}', '{$uid}')";
	if ($conn->query($sql) === true) {
		echo "New record created successfully" . PHP_EOL . PHP_EOL;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}


function is_user_online ($md5_hash)
{

	$conn = get_connection();


	$sql = "SELECT * FROM users_list WHERE user_id = '{$md5_hash}'";

	$result = $conn->query($sql);
	$conn->close();


	if (($result->num_rows > 0))
		return true;

	return false;


}


function get_chat ($md5_sender, $md5_reciever, $receiver_id = 0,$listing_id = NULL)
{


	$conn = get_connection();

    if(empty($listing_id)){
        $sql = "SELECT * FROM chat_interactions WHERE (from_id = '{$md5_sender}' and to_id = '{$md5_reciever}') OR (from_id = '{$md5_reciever}' and to_id = '{$md5_sender}') order by `message_id` desc";
    }else{
        $sql = "SELECT * FROM chat_interactions WHERE (from_id = '{$md5_sender}' and to_id = '{$md5_reciever}') OR (from_id = '{$md5_reciever}' and to_id = '{$md5_sender}') AND listing_id = $listing_id order by `message_id` desc";
    }


	$result = $conn->query($sql);
	$conn->close();

	$messages = [];

	if (($result->num_rows > 0)) {

		while ($row = mysqli_fetch_assoc($result)) {

			if ($md5_sender === $row['from_id']) {
				$extra_class = 'right';
			}else {
				$extra_class = 'left';
			}

			$messages[] = [
				'from_id'	=> $row['from_id'],
				'message'	=> $row['message'],
				'class'	=> $extra_class
			];
			$updateQuery = "UPDATE `chat_interactions` SET `is_read`= 1 WHERE receiver_uid = '{$receiver_id}' and `message_id` = ".$row['message_id'];
            $conn = get_connection();
            $result1 = $conn->query($updateQuery);
            $conn->close();
		}
		krsort($messages);


		foreach ($messages as $i=>$message){


			echo '<div class="'. $message['class'] . '-msg msg-container"><div class="message-inner">' . $message['message'] . '</div></div>';
		}

	}


	exit;


}


function delete_online_users(){
	$conn = get_connection();


	$sql = "DELETE FROM users_list";

	$result = $conn->query($sql);
	$conn->close();
}


