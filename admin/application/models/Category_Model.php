<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_Model extends CI_Model
{

	private $table_name = 'categories';

	public function create_category($cat_title = '', $cat_image = '', $cat_parent = '', $cat_description = '', $cat_type = '', $cat_type_db = '', $cat_slug = '')
	{

		$row = $this->db->select('*')->from('categories')->where('name', $cat_title)->where('parent_ids', $cat_parent)->get()->row();

		if (! empty($row))
			return false;

		$data = array(
			'name' => $cat_title,
			'image_icon' => $cat_image,
			'type' => $cat_type,
			'parent_ids' => $cat_parent,
			'category_type' => $cat_type_db,
			'description' => $cat_description,
			'slug' => volgo_make_slug($cat_title),
			'created_at' => date("Y-m-d H:i:s")
		);



		$this->db->set($data);

		return $this->db->insert(
			'categories'
		);
	}

	public function get_category_slug_by_id($cat_id)
	{

		$cat_slug = $this->db->select('slug')
			->from('categories')
			->where('id', intval($cat_id))
			->get()->row();


		if (!empty($cat_slug))
			return $cat_slug->slug;


		return false;

	}

	public function check_slug($slug)
	{
		$result = $this->db->query(
			"SELECT COUNT(*) AS NumHits FROM {$this->table_name} WHERE slug like '$slug%'"
		);

		$row = $result->row();
		return $row->NumHits;
	}

	public function update_category($id = '', $cat_title = '', $cat_image = '', $cat_parent = '', $cat_description = '', $cat_type = '', $cat_type_db = '', $cat_slug = '')
	{

		$data = array(
			'name' => $cat_title,
			'image_icon' => $cat_image,
			'type' => $cat_type,
			'parent_ids' => $cat_parent,
			'slug' => volgo_make_slug($cat_title),
			'category_type' => $cat_type_db,
			'description' => $cat_description,
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'categories'
		);
	}

	public function get_categories_by_listing_type($cat_type)
	{
		$this->db->select('a.id, a.description,a.name, b.name as parent_name , a.image_icon, a.parent_ids');
		$this->db->from('categories a');
		$this->db->join('categories b', 'a.parent_ids = b.id', 'left');
		$this->db->where('a.category_type', $cat_type);
		//$this->db->order_by('id');

		$query = $this->db->get();

		return ($query->result());
	}

	public function get_all_categories()
	{
		$this->db->select('a.id, a.description,a.name,a.slug, b.name as parent_name , a.image_icon, a.parent_ids');
		$this->db->from('categories a');
		$this->db->join('categories b', 'a.parent_ids = b.id', 'left');
//		$this->db->where('a.category_type', 'category');
		$this->db->order_by('id');


		$query = $this->db->get();

		return ($query->result());
	}

	public function get_cat_by_id($categoryid)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id', $categoryid);
		$this->db->limit(1);
		$query = $this->db->get();

		return ($query->row());
	}

	public function remove($single_cat_id)
	{
		$this->db->where("id", $single_cat_id);
		$this->db->delete("categories");
		return true;

	}

	public function remove_meta($single_cat_id)
	{
		$this->db->where("categories_id", $single_cat_id);
		$this->db->delete("categories_meta");
		return true;

	}

	public function get_child_cat_integrate($selected_parent_id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('parent_ids', $selected_parent_id);

		$this->db->order_by('id');
		// $this->db->join('categories b', 'a.parent_ids = b.id', 'left');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_child_from_integrate($selected_parent_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_parent_id);

		$this->db->order_by('id');

		$query = $this->db->get();

		return $query->result();
	}


	public function get_child_from_home_integrate($selected_parent_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key','homepage_category_form_search');

		$this->db->order_by('id');

		$query = $this->db->get();

		return $query->result();
	}

	public function get_adv_form($selected_parent_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key','advance_sidebar_search_form');

		$this->db->order_by('id');

		$query = $this->db->get();

		return $query->result();
	}

	public function get_basic_form($selected_parent_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key','basic_sidebar_search_form');

		$this->db->order_by('id');

		$query = $this->db->get();

		return $query->result();
	}

	public function get_from_db_integrate($selected_parent_id = "")
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_parent_id);


		$this->db->order_by('id');

		$query = $this->db->get();


		return $query->result();
	}

	public function get_child_from_update_integrate($selected_parent_id = "", $form_code = "")
	{

		$data = array(
			'categories_id' => $selected_parent_id,
			'meta_key' => 'form_category',
			'meta_value' => $form_code,
		);
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key', 'form_category');

		$this->db->order_by('id');
		$this->db->set($data);


		return $this->db->update(
			'categories_meta'
		);
	}

	public function update_adv_form_code($selected_parent_id = "",   $formcode_adv = "")
	{
		$data = array(
			'categories_id' => $selected_parent_id,
			'meta_key' => 'advance_sidebar_search_form',
			'meta_value' => $formcode_adv,
		);
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key', 'advance_sidebar_search_form');

		$this->db->order_by('id');
		$this->db->set($data);

		$this->db->update(
			'categories_meta'
		);
		$query = $this->db->affected_rows();
		if($query == 0) {

			$data = array(
				'categories_id' => $selected_parent_id,
				'meta_key' => 'advance_sidebar_search_form',
				'meta_value' => $formcode_adv,
				'created_at' => date("Y-m-d H:i:s")
			);

			$this->db->set($data);

			return $this->db->insert(
				'categories_meta'
			);

		}

		return true;


	}

	public function update_basic_form_code($selected_parent_id = "",   $formcode_basic = "")
	{
		$data = array(
			'categories_id' => $selected_parent_id,
			'meta_key' => 'basic_sidebar_search_form',
			'meta_value' => $formcode_basic,
		);
		$this->db->where('categories_id', $selected_parent_id);
		$this->db->where('meta_key', 'basic_sidebar_search_form');

		$this->db->order_by('id');
		$this->db->set($data);

		$this->db->update(
			'categories_meta'
		);
		$query = $this->db->affected_rows();
		if($query == 0) {

			$data = array(
				'categories_id' => $selected_parent_id,
				'meta_key' => 'basic_sidebar_search_form',
				'meta_value' => $formcode_basic,
				'created_at' => date("Y-m-d H:i:s")
			);

			$this->db->set($data);

			return $this->db->insert(
				'categories_meta'
			);

		}

		return true;


	}

	public function get_child_from_home_update_integrate($selected_parent_id = "",   $formcode_homepage = "")
	{

		$data = array(
			'categories_id' => $selected_parent_id,
			'meta_key' => 'homepage_category_form_search',
			'meta_value' => $formcode_homepage,
		);
		$this->db->where('categories_id', $selected_parent_id);
		 $this->db->where('meta_key', 'homepage_category_form_search');

		$this->db->order_by('id');
		$this->db->set($data);

		$this->db->update(
			'categories_meta'
		);
		$query = $this->db->affected_rows();
		if($query == 0) {

			$data = array(
				'categories_id' => $selected_parent_id,
				'meta_key' => 'homepage_category_form_search',
				'meta_value' => $formcode_homepage,
				'created_at' => date("Y-m-d H:i:s")
			);

			$this->db->set($data);

			return $this->db->insert(
				'categories_meta'
			);

		}

		return true;


	}

	public function create_category_meta($cat_sub_title = '', $form_code = '')
	{
		$data = array(
			'categories_id' => $cat_sub_title,
			'meta_key' => 'form_category',
			'meta_value' => $form_code,
			'created_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('categories_id', $cat_sub_title);
		$this->db->set($data);

		return $this->db->insert(
			'categories_meta'
		);
	}


	public function create_meta_homepage_search($cat_sub_title = '', $formcode_homepage = '')
	{

		$data = array(
			'categories_id' => $cat_sub_title,
			'meta_key' => 'homepage_category_form_search',
			'meta_value' => $formcode_homepage,
			'created_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('categories_id', $cat_sub_title);
		$this->db->set($data);

		return $this->db->insert(
			'categories_meta'
		);
	}

	public function create_adv_search_form_meta($cat_sub_title = '', $adv_form_code = '')
	{

		$data = array(
			'categories_id' => $cat_sub_title,
			'meta_key' => 'advance_sidebar_search_form',
			'meta_value' => $adv_form_code,
			'created_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('categories_id', $cat_sub_title);
		$this->db->set($data);

		return $this->db->insert(
			'categories_meta'
		);
	}

	public function create_basic_search_form_meta($cat_sub_title = '', $basic_form = '')
	{

		$data = array(
			'categories_id' => $cat_sub_title,
			'meta_key' => 'basic_sidebar_search_form',
			'meta_value' => $basic_form,
			'created_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('categories_id', $cat_sub_title);
		$this->db->set($data);

		return $this->db->insert(
			'categories_meta'
		);
	}

}
