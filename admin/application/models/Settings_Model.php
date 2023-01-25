<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Settings_Model extends CI_Model
{

	private $table_name = 'settings';

	public function update_settings($input_data){

		foreach($input_data as $key => $value){

			$this->db->select('id');
			$this->db->from($this->table_name);
			$this->db->where("key", $key);
			$this->db->where("type", 'default');
			$result = $this->db->get();

			if (!empty($record = $result->result_array())){
				// Update

				$rec = [
					'value'	=> $value
				];

				$this->db->set($rec);
				$this->db->where('id', $record[0]['id']);
				$is_ok = $this->db->update($this->table_name);

				if (! $is_ok)
					break;

			}else {
				//insert

				$rec = [
					'key'	=> $key,
					'value'	=> $value,
					'type'	=> 'default'
				];

				$this->db->set($rec);
				$is_ok = $this->db->insert($this->table_name);

				if (! $is_ok)
					break;
			}
		}

		return $is_ok;
	}


	public function get_all_settings(){
		$this->db->select('key,value,type');
		$this->db->from($this->table_name);
		$this->db->where('type', 'default');

		$query = $this->db->get();

		return ( $this->convert_into_associate($query->result()) );
	}

	private function convert_into_associate(array $data)
	{
		if (empty($data))
			return $data;

		$newArr = [];
		foreach ($data as $key => $obj) {
			$newArr[][$obj->key] = $obj->value;
		}

		return $newArr;

	}

}
