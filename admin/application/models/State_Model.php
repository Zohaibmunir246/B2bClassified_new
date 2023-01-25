<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class State_Model extends CI_Model
{

	private $table_name = 'b2b_states';

	public function __construct() {
		parent::__construct();
	}

	public function get_count() {
		return $this->db->count_all($this->table_name);
	}


	public function get_states($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_state_from_db($state)
	{
		$items = $this->db->select('*')->from('b2b_states')->like('name', $state)->order_by('id', 'asc')->get()->result_object();
		return $items;
	}

	public function create(array $data)
	{
		$this->db->set($data);
		return $this->db->insert($this->table_name);
	}

	public function get_state_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return ($query->row() );
	}

	public function update_state($state_id,$country_id,  $state_name)
	{
		$data = array(
			'name'	=> $state_name,
			'country_id' => $country_id
		);

		$this->db->set($data);
		$this->db->where('id', $state_id);
		$is_updated = $this->db->update($this->table_name);
		
		return $is_updated;
	}
}
