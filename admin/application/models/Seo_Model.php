<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Seo_Model extends CI_Model
{
	private $table_name = 'seo_settings';

	public function check_slug($title)
	{
		$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

		$result = $this->db->query(
			"SELECT COUNT(*) AS NumHits FROM {$this->table_name} WHERE slug like '$slug%'"
		);

		$row = $result->row();
		return $row->NumHits;
	}

	public function check_seo_slug($title)
	{
		$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

		$result = $this->db->query(
			"SELECT COUNT(*) AS NumHits FROM {$this->table_name} WHERE seo_slug like '$slug%'"
		);

		$row = $result->row();
		return $row->NumHits;
	}

	public function create_seo_detail($page_type = '', $seo_title = '', $seo_meta_keywords = '', $seo_meta_description = '', $seo_slug = '')
	{
		$category_id = $this->input->post('selected_category') ? $this->input->post('selected_category') : 0;
		$sub_category_id = $this->input->post('selected_sub_category') ? $this->input->post('selected_sub_category') : 0;
		$sub_subcategory_id = $this->input->post('selected_sub_subcategory') ? $this->input->post('selected_sub_subcategory') : 0;
		/* Check if lead category or not*/
		if(intval($sub_subcategory_id) == 0){
			/*if condition for lead category is not true*/
			if(intval($category_id) != 0){
				$selected_category = get_category_slug_from_cat_id($category_id);	
			}
			if(intval($sub_category_id) != 0){
				$selected_sub_category = get_category_slug_from_cat_id($sub_category_id);
			}
		}else{
			/*if condition for lead category is true*/
			if(intval($category_id) != 0){
				$category_slug = get_category_slug_from_cat_id($category_id);	
			}
			if(intval($sub_category_id) != 0){
				$selected_category = get_category_slug_from_cat_id($sub_category_id);	
			}
			if(intval($sub_subcategory_id) != 0){
				$selected_sub_category = get_category_slug_from_cat_id($sub_subcategory_id);
			}

		}
	
		$selected_category = isset($selected_category) ? $selected_category : 0;
		$selected_sub_category = isset($selected_sub_category) ? $selected_sub_category : 0;
		if($page_type == 'listings'){
			if(intval($sub_subcategory_id) == 0){
			/*if not lead category*/	
				if (!empty($selected_category) && !empty($selected_sub_category)) {
					$seo_slug = $selected_category . '/' . $selected_sub_category;
				}elseif (!empty($selected_category) && empty($selected_sub_category)) {
					$seo_slug = $selected_category . '/';
				}
			}else{
				/*if lead category*/
				if (!empty($selected_category) && !empty($selected_sub_category)) {
					$seo_slug = $category_slug . '/' . $selected_sub_category;
				}elseif (!empty($selected_category) && empty($selected_sub_category)) {
					$seo_slug = $category_slug . '/';
				}
			}			
		}
        
		$data = array(
			'page_type'	=> $page_type,
			'category'	=> empty($selected_category) ? null : $selected_category,
			'sub_category'	=> empty($selected_sub_category) ? null : $selected_sub_category,
			'seo_title'	=> $seo_title,
			'seo_slug'	=> $seo_slug,
			'seo_meta_keywords'	=> $seo_meta_keywords,
			'seo_meta_description' => $seo_meta_description,
			'created_on'	=> date("Y-m-d H:i:s")

		);
		$this->db->select('*');
		$this->db->from('seo_settings');
		$this->db->where('page_type', $page_type);
		if(!empty($selected_category)){
		$this->db->where('category', $selected_category);    
		}else{
		$this->db->where('category =', null); 	
		}
		if(!empty($selected_sub_category)){
		$this->db->where('sub_category', $selected_sub_category);    
		}else{
		$this->db->where('sub_category =', null); 	
		}
		$sql = $this->db->get();

		if($sql->num_rows() > 0){
		//save data in database
		$this->db->where('page_type', $page_type);
		if(!empty($selected_category)){
		$this->db->where('category', $selected_category);    
		}else{
		$this->db->where('category =', null); 	
		}
		if(!empty($selected_sub_category)){
		$this->db->where('sub_category', $selected_sub_category);    
		}else{
		$this->db->where('sub_category =', null); 	
		}
		$this->db->set($data);

		$is_updated = $this->db->update(
			'seo_settings'
		);
		
		}else{
		$this->db->set($data);

		$is_updated = $this->db->insert('seo_settings');
		
		}
		return $is_updated;
	}

	public function update_seo($id, $page_type = '', $seo_title = '', $seo_meta_keywords = '', $seo_meta_description = '', $seo_slug = '')
	{

		$category_id = $this->input->post('selected_category') ? $this->input->post('selected_category') : 0;
		$sub_category_id = $this->input->post('selected_sub_category') ? $this->input->post('selected_sub_category') : 0;
		$sub_subcategory_id = $this->input->post('selected_sub_subcategory') ? $this->input->post('selected_sub_subcategory') : 0;
		if(intval($sub_subcategory_id) == 0){
		if(intval($category_id) != 0){
			$selected_category = get_category_slug_from_cat_id($category_id);	
		}
		if(intval($sub_category_id) != 0){
			$selected_sub_category = get_category_slug_from_cat_id($sub_category_id);
		}
		}else{
		if(intval($category_id) != 0){
			$category_slug = get_category_slug_from_cat_id($category_id);	
		}
		if(intval($sub_category_id) != 0){
			$selected_category = get_category_slug_from_cat_id($sub_category_id);	
		}
		if(intval($sub_subcategory_id) != 0){
			$selected_sub_category = get_category_slug_from_cat_id($sub_subcategory_id);
		}

		}
		
		$selected_category = isset($selected_category) ? $selected_category : '';
		$selected_sub_category = isset($selected_sub_category) ? $selected_sub_category : '';
		if($page_type == 'listings'){
			if(intval($sub_subcategory_id) == 0){
			if (!empty($selected_category) && !empty($selected_sub_category)) {
				$seo_slug = $selected_category . '/' . $selected_sub_category;
			}elseif (!empty($selected_category) && empty($selected_sub_category)) {
				$seo_slug = $selected_category . '/';
			}
			}else{
			if (!empty($selected_category) && !empty($selected_sub_category)) {
				$seo_slug = $category_slug . '/' . $selected_sub_category;
			}elseif (!empty($selected_category) && empty($selected_sub_category)) {
				$seo_slug = $category_slug . '/';
			}	
			}			
		}
        
		$data = array(
			'page_type'	=> $page_type,
			'category'	=> empty($category_slug) ? $selected_category : $category_slug,
			'sub_category'	=> empty($selected_sub_category) ? $selected_category : $selected_sub_category,
			'seo_title'	=> $seo_title,
			'seo_slug'	=> $seo_slug,
			'seo_meta_keywords'	=> $seo_meta_keywords,
			'seo_meta_description' => $seo_meta_description,
			'created_on'	=> date("Y-m-d H:i:s")

		);
		
		$this->db->set($data);
		$this->db->where('id', $id);

		return $this->db->update(
			'seo_settings'
		);
	}

	public function get_seos($limit = 10, $offset = 0)
	{
		$this->db->select('*');
		$this->db->from('seo_settings');
		$this->db->order_by('id');

		if ($limit !== -1)
			$this->db->limit($limit, $offset);

		$query = $this->db->get();

		return ( $query->result() );
	}

	public function get_seo_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('seo_settings');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return ( $query->row() );
	}

	public function remove($id)
	{
		$this->db->where("id", $id);

		return $this->db->delete("seo_settings");
	}

}
