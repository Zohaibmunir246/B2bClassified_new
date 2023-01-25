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

	public function get_page_seo($cate, $sub_cate = '')
	{
		if($cate === "/") {
			$this->db->select('*')->from($this->table_name)->where('page_type', '/');
			return $this->db->get()->row();
		}
		$query = $this->db->select('*')->from($this->table_name)->where('category', $cate);
		if(!empty($sub_cate)) {
			$query->where('sub_category', $sub_cate);
		}
		return $this->db->get()->row();
	}

}
