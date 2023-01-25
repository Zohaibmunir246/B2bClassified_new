<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Filter_Model extends CI_Model
{

	public function create_label($label_type ='' , $title_filter='' , $description_filter='')
	{
		$data = array(
			'label_type' => $label_type,
			'title' => $title_filter,
			'description' => $description_filter,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		return $this->db->insert(
			'filter_labels'
		);
	}
	public function create_filter_labels($label_type_id ='' , $title_filter='' , $category_id='')
	{
		$data = array(
			'category_id' => $category_id,
			'title' => $title_filter,
			'filter_label_id' => $label_type_id,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		return $this->db->insert(
			'filters'
		);
	}

	public function view_filters() {
		$this->db->select('f.id as filter_id , f.title as filter_title ,  fl.title, c.name');
		$this->db->from('filters f');
		$this->db->join('filter_labels fl', 'f.filter_label_id = fl.id', 'left');
		$this->db->join('categories c', 'c.id = f.category_id', 'left');
		$query = $this->db->get();
		return $query->result();
	}


	public function view_filters_single($id) {
		$this->db->select('*');
		$this->db->from('filters');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function view_label() {
		$this->db->select('*');
		$this->db->from('filter_labels');
		$query = $this->db->get();
		return $query->result();
	}
	public function view_label_single($id) {
		$this->db->select('*');
		$this->db->from('filter_labels');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function remove($label_id) {
		$this->db->where("id", $label_id);
		return $this->db->delete("filter_labels");
	}
	public function remove_filter($filter_id) {
		$this->db->where("id", $filter_id);
		return $this->db->delete("filters");
	}

	public function update_label($label_type ='' , $title_filter='' , $description_filter='' , $id= '') {

		$data = array(
			'label_type' => $label_type,
			'title' => $title_filter,
			'description' => $description_filter,
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'filter_labels'
		);
	}

	public function update_filter_single($label_type_id ='' , $title_filter='' , $category_id='' , $id= '') {

		$data = array(
			'category_id' => $category_id,
			'title' => $title_filter,
			'filter_label_id' => $label_type_id,
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'filters'
		);
	}

	public function get_all_labels(){
		$this->db->select('*');
		$this->db->from('filter_labels');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}

}
