<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Subscribers_Model extends CI_Model
{

	private $table_name = 'newsletter_subscribers';

	public function create_subscriber($email = '', $status = '')
	{
		$data = array(
			'email'	=> $email,
			'status'	=> $status,
			'created_at'	=> date("Y-m-d H:i:s")
		);
		$this->db->set($data);
		return $this->db->insert($this->table_name);
	}


	public function get_subscribers($limit = 10, $offset = 0)
	{
		$this->db->select('id,email,status');
		$this->db->from($this->table_name);
		// $this->db->where('type', 'page');
		$this->db->order_by('id', 'desc');
		if ($limit !== -1)
			//$this->db->limit($limit, $offset);
			$query = $this->db->get();
		return $query->result_array();
	}


	public function remove($subscriber_id) {
		$this->db->where("id", $subscriber_id);
		return $this->db->delete($this->table_name);
	}


}
