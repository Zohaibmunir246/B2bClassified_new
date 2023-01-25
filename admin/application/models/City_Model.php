<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class City_Model extends CI_Model
{

	private $table_name = 'b2b_cities';

	public function __construct() {
		parent::__construct();
	}

	public function get_count() {
		return $this->db->count_all($this->table_name);
	}


	public function get_cities($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_city_from_db($city)
	{
		$items = $this->db->select('*')->from('b2b_cities')->like('name', $city)->order_by('id', 'asc')->get()->result_object();
		return $items;
	}

	public function create(array $data)
	{
		$this->db->set($data);

		return $this->db->insert(
			'b2b_cities'
		);
	}

    public function get_city_by_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        return ($query->row() );
    }

    public function update_city($city_id,$city_name)
    {
        $data = array(
            'name'	=> $city_name
        );

        $this->db->set($data);
        $this->db->where('id', $city_id);
        $is_updated = $this->db->update($this->table_name);

        return $is_updated;
    }
}
