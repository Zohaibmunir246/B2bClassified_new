<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_Model extends CI_Model{

	private $table = 'json_data';
	private $key = 'categories';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_json_data($key, $cols = '*')
	{
		$categories = $this->db->select($cols)->from($this->table)->where('key', $key)->limit(1)->get()->row_object();

		if (empty($categories))
			return [];

		$cat = (object) [];

		$cat->id = isset($categories->id) ? $categories->id : '';
		$cat->key = isset($categories->key) ? $categories->key : '';

		$cat->data = isset($categories->data)  ? json_decode($categories->data) : [];

		return $cat;
	}

	private function update_incremental_number($db_key, $number, $operation = 'create')
	{
		$arr = [
			'key' => $db_key,
			'data' => $number
		];

		$this->db->set($arr);

		if (strtolower($operation) === 'create'){
			$this->db->insert($this->table);
		}else if (strtolower($operation) === 'update'){
			unset($arr['key']);

			$this->db->where('key', $db_key);
			$this->db->update(
				$this->table
			);
		}
	}

	public function get_incremental_number($db_key, $starting = 1)
	{
		$data = $this->db->select('*')->from($this->table)->where('key', $db_key)->get()->row();
		if (empty($data)){
			$this->update_incremental_number($db_key, $starting);
			return 1;
		}else {
			$number = intval($data->data) + 1;
			$this->update_incremental_number($db_key, $number, 'update');
			return $number;
		}
	}

	public function add_json_data($db_column_key, $data_arr)
	{
		$data = $this->get_json_data($db_column_key);
		if (!empty($data)){
			// update

			$data->data = json_encode($data_arr);
			$this->db->set($data);
			$this->db->where('key', $db_column_key);
			return $this->db->update(
				$this->table
			);
		}else {
			// insert

			$arr = [
				'key' => $db_column_key,
				'data' => json_encode($data_arr)
			];

			$this->db->set($arr);
			return $this->db->insert($this->table);
		}
	}

	public function add_update_json_data($db_column_key, $data_arr)
	{
		$data = $this->get_json_data($db_column_key);

		if (!empty($data)){
			// update


			$data->data = $data_arr;
			$data->data = json_encode($data->data);

			$this->db->set($data);
			$this->db->where('key', $db_column_key);
			return $this->db->update(
				$this->table
			);
		}else {
			// insert
			$arr = [
				'key' => $db_column_key,
				'data' => json_encode([$data_arr])
			];

			$this->db->set($arr);
			return $this->db->insert($this->table);
		}
	}

	public function recreate_json_arr($db_column_key, $data_arr)
	{
		$data = $this->get_json_data($db_column_key);

		$data->data = $data_arr;
		$data->data = json_encode($data->data);

		$this->db->set($data);
		$this->db->where('key', $db_column_key);
		return $this->db->update(
			$this->table
		);
	}
}
