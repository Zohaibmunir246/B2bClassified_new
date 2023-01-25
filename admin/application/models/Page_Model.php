<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Page_Model extends CI_Model
{
	private $table_name = 'posts';

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

	public function create_page($title = '', $content = '', $slug = '', $f_img = '', $seo_title = '', $seo_desc = '', $seo_slug = '')
	{

		$data = array(
			'title'	=> $title,
			'content'	=> $content,
			'slug'	=> $slug,
			'type' => 'page',
            'user_id' => volgo_get_logged_in_user_id(),
			'featured_image' => $f_img,
			'seo_title'	=> $seo_title,
			'seo_slug'	=> $seo_slug,
			'seo_description'	=> $seo_desc,
			'date_time'	=> date("Y-m-d H:i:s")

		);

		$this->db->set($data);

		return $this->db->insert(
			'posts'
		);
	}

	public function update_page($id, $title = '', $content = '', $slug = '', $f_img = '', $seo_title = '', $seo_desc = '', $seo_slug = '')
	{

		$data = array(
			'title'	=> $title,
			'content'	=> $content,
			'slug'	=> $slug,
			'type' => 'page',
            'user_id' => volgo_get_logged_in_user_id(),
			'featured_image' => $f_img,
			'seo_title'	=> $seo_title,
			'seo_slug'	=> $seo_slug,
			'seo_description'	=> $seo_desc,
			'date_time'	=> date("Y-m-d H:i:s")

		);

		$this->db->set($data);
		$this->db->where('id', $id);

		return $this->db->update(
			'posts'
		);
	}

	public function get_pages($limit = 10, $offset = 0)
	{
		$this->db->select('id,title,slug,seo_title');
		$this->db->from('posts');
		$this->db->where('type', 'page');
		$this->db->order_by('id');

		if ($limit !== -1)
			$this->db->limit($limit, $offset);

		$query = $this->db->get();

		return ( $query->result() );
	}

	public function get_page_by_id($id)
	{
		$this->db->select('id,title,slug,content,featured_image,seo_title,seo_slug,seo_description');
		$this->db->from('posts');
		$this->db->where('type', 'page');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return ( $query->row() );
	}

	public function remove($page_id)
	{
		$this->db->where("id", $page_id);
		$this->db->where("type", 'page');

		return $this->db->delete("posts");
	}

}
