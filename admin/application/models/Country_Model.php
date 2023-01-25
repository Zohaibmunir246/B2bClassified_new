<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_Model extends CI_Model
{

	private $table_name = 'b2b_countries';

	public function __construct() {
		parent::__construct();
	}

	public function get_count() {
		return $this->db->count_all($this->table_name);
	}


	public function get_countries()
	{
        $this->db->select('*');
		$query = $this->db->get($this->table_name);
		return $query->result();
	}

	public function create(array $data)
	{
		$this->db->set($data);

		return $this->db->insert($this->table_name);
	}

	public function get_country_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return ($query->row() );
	}

	public function update_country($country_id,$country_name,$shortname,$phonecode)
	{

		$data = array(
			'name'	=> $country_name,
			'shortname' => $shortname,
			'phonecode' => $phonecode

		);

		$this->db->set($data);
		$this->db->where('id', $country_id);
		$is_updated = $this->db->update($this->table_name);
		return $is_updated;
	}
}
