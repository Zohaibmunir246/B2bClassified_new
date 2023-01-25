<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Currency_Model extends CI_Model
{

	public function create_currency($country_id ='' , $unit='')
	{
	    $currency_row = $this->db->select('id')->from('currencies')->where('country_id', $country_id)->get()->row();
	    if(!empty($currency_row)){
	        $this->db->where('id', $currency_row->id);
	        $this->db->delete('currencies');
        }
		$data = array(
			'country_id' => $country_id,
			'unit' => $unit,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		return $this->db->insert(
			'currencies'
		);
	}

	public function view_currencies() {
		$this->db->select('id, country_id, unit');
		$this->db->from('currencies');
		$query = $this->db->get();
		return $query->result();
	}

	public function view_currency() {
		$this->db->select('*');
		$this->db->from('currencies');
		$query = $this->db->get();
		return $query->result();
	}
	public function view_single_currency($id) {
		$this->db->select('*');
		$this->db->from('currencies');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function remove($id) {
		$this->db->where("id", $id);
		return $this->db->delete("currencies");
	}
	public function remove_currency($id) {
		$this->db->where("id", $id);
		return $this->db->delete("currencies");
	}

	public function update_currency($country_id ='' , $unit='', $currency_id = '') {
		$data = array(
            'country_id' => $country_id,
            'unit' => $unit,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		$this->db->where('id', $currency_id);
		return $this->db->update('currencies');
	}

}
