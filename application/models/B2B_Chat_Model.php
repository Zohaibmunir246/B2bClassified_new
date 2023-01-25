<?php
/**
 * Created by PhpStorm.
 * User: volgopoint.com
 * Date: 2/25/2019
 * Time: 1:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class B2B_Chat_Model extends CI_Model
{

	private $users_table_name = 'b2b_users';
	private $connection_table_name = 'open_connections';
	
	
	public function get_username_by_uid ($uid = '')
	{
		if (empty($uid))
			$uid = volgo_get_logged_in_user_id();
		
		
		$user_row = $this->db->select('username')->from($this->users_table_name)->where('id', intval($uid))->get()->row();
		
		if (empty($user_row))
			return '';
		
		return $user_row->username;
	}
	
	
	function delete_all_active_connections ()
	{
		$this->db->delete($this->connection_table_name);
		
		echo 'All active connections are deleted' . PHP_EOL;
	}
	
	function delete_active_connection_by_resource_id ($resource_id)
	{
		$this->db->delete($this->connection_table_name)->where('resource_id', $resource_id);
		
		echo $resource_id . ' is deleted' . PHP_EOL;
	}
	
	public function insert_user_chat ($a, $b, $c, $d)
	{
		return true; //@todo: Pending
	}
	
	
	function custom_insert ($uname, $md5_id, $resource_id)
	{
		$data = [
			'username' => $uname,
			'user_id' => volgo_get_logged_in_user_id(),
			'ip_address' => $this->input->ip_address(),
			'resource_id' => $resource_id,
			'md5_username'  => $md5_id
		];
		
		$this->db->set($data);
		$this->db->insert($this->connection_table_name);
		
		echo "New record created successfully" . PHP_EOL;
	}
	
	
	function is_user_online ($md5_hash)
	{
		
		$row = $this->db->select('id')->from($this->connection_table_name)->where('md5_username', $md5_hash)->get()->row();
		
		
		if (empty($row))
			return false;
		
		
		return true;
		
	}
	

}

