<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/20/2019
 * Time: 11:20 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class ADBanners_Model extends CI_Model{

	private $table_name = 'ad_banners';

	public function get_all_banners()
	{
		$this->db->select('id,title,description,ad_code_image,ad_size,ad_type,display_unit,unique_key, url');
		$this->db->from($this->table_name);

		$banners = $this->db->get();

		return $banners->result();
	}

	public function insert(array $form_data, $code_image = '')
	{
		if (empty($form_data))
			return false;

		if (empty($code_image)){
			$code_image = $form_data['adbanner_code'];
		}

		$data = array(
			'title'	=> $form_data['banner_title'],
			'description'	=> $form_data['banner_description'],
			'ad_type'	=> $form_data['banner_type'],
			'ad_code_image' => $code_image,
			'url'	=> $form_data['banner_link'],
			'ad_size' => $form_data['banner_size'],
			'display_unit'	=> $form_data['banner_display_unit'],
			'unique_key'	=> $form_data['banner_display_unit']. '_' . time(),
			'created_at'	=>  date("Y-m-d H:i:s")
		);

		$this->db->set($data);

		$is_inserted = $this->db->insert(
			$this->table_name
		);

		return $is_inserted;

	}

	public function update($banner_id, array $form_data, $code_image = '')
	{
		if (empty($form_data))
			return false;

		if (empty($code_image)){
			$code_image = $form_data['adbanner_code'];
		}

		$data = array(
			'title'	=> $form_data['banner_title'],
			'description'	=> $form_data['banner_description'],
			'ad_type'	=> $form_data['banner_type'],
			'url'	=> $form_data['banner_link'],
			'ad_size' => $form_data['banner_size'],
			'display_unit'	=> $form_data['banner_display_unit'],
			'unique_key'	=> $form_data['banner_display_unit']. '_' . time(),
			'updated_at'	=>  date("Y-m-d H:i:s")
		);

		if (! empty($code_image)){
			$data['ad_code_image'] = $code_image;
		}

		$this->db->set($data);
		$this->db->where('id', $banner_id);

		$is_updated = $this->db->update(
			$this->table_name
		);

		return $is_updated;

	}

	public function get_banner_by_id($id)
	{
		$this->db->select('id,title,description,ad_code_image,ad_size,ad_type,display_unit,unique_key, url');
		$this->db->from($this->table_name);
		$this->db->where('id', $id);

		$banners = $this->db->get();

		return $banners->result();
	}

	public function remove($banner_id)
	{
		// Remove banner data
		$this->db->where("id", $banner_id);
		$this->db->delete($this->table_name);

		return true;
	}
}
