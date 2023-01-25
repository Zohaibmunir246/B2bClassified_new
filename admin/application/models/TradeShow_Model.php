<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/25/2019
 * Time: 4:20 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class TradeShow_Model extends CI_Model
{

	private $table_name = 'posts';

	public function add($input_data)
	{

		$data = [
			'title' => $input_data['ts_title'],
			'slug' => $input_data['page_slug'],
			'content' => $input_data['ts_content'],
			'featured_image' => $input_data['featured_image'],
			'type'	=> 'tradeshow',
			'user_id' => volgo_get_logged_in_user_id(),
			'seo_title'	=> $input_data['ts_title'],
			'seo_slug'	=> $input_data['page_slug'],
			'seo_description'	=> $input_data['ts_content'],
			'date_time'	=>  date("Y-m-d H:i:s")
		];

		$this->db->set($data);

		$is_inserted = $this->db->insert(
			$this->table_name
		);

		if (! $is_inserted)
			return false;

		$insert_id = $this->db->insert_id();

		$metas = [
			'ts_venue' => $input_data['ts_venue'],
			'starting_date' => $input_data['started_date'],
			'ending_date' => $input_data['ended_date'],
		];

		foreach ($metas as $key => $meta){
			$data = [
				'meta_value' => $meta,
				'meta_key' => $key,
				'post_id' => $insert_id
			];

			$this->db->set($data);

			$is_inserted = $this->db->insert(
				'posts_meta'
			);
			if (! $is_inserted)
				break;

		}

		return $is_inserted;
	}

	public function update($tradeshow_id, $input_data)
	{
		$data = [
			'title' => $input_data['ts_title'],
			'slug' => $input_data['page_slug'],
			'content' => $input_data['ts_content'],
			'featured_image' => $input_data['featured_image'],
			'type'	=> 'tradeshow'
		];

		$this->db->set($data);
		$this->db->where('id', intval($tradeshow_id));

		$is_updated = $this->db->update(
			$this->table_name
		);

		if (! $is_updated)
			return false;

		$metas = [
			'ts_venue' => $input_data['ts_venue'],
			'starting_date' => $input_data['started_date'],
			'ending_date' => $input_data['ended_date'],
		];

		foreach ($metas as $key => $meta){
			$data = [
				'meta_value' => $meta,
			];

			$this->db->set($data);
			$this->db->where('post_id', intval($tradeshow_id));
			$this->db->where('meta_key', $key);

			$is_updated = $this->db->update(
				'posts_meta'
			);
			if (! $is_updated)
				break;

		}

		return $is_updated;
	}

	public function get($trade_show_id, $with_metas = false)
	{
		$columns = 'p.id,p.title,p.slug,p.content,p.featured_image';

		if ($with_metas){
			$columns .= 'pm.meta_key,pm.meta_value';
		}

		$this->db->select($columns);
		$this->db->from($this->table_name . ' as p');

		if ($with_metas){
			$this->db->join('posts_meta pm', 'pm.post_id = p.id');
		}
		$this->db->where('type', 'tradeshow');
		$this->db->where('id', intval($trade_show_id));

		$query = $this->db->get();

		if ($with_metas)
			return $this->combine_meta($query->result());

		return $query->result();
	}

	public function remove($tradeshow_id)
	{
		$this->db->where("post_id", $tradeshow_id);
		$this->db->delete('posts_meta');


		$this->db->where("id", $tradeshow_id);
		$this->db->delete($this->table_name);

		return true;
	}

	public function get_latest()
	{
		$this->db->select('p.id,p.title,p.slug,pm.meta_key,pm.meta_value');
		$this->db->from($this->table_name . ' as p');
		$this->db->join('posts_meta pm', 'pm.post_id = p.id');
		$this->db->where('p.type', 'tradeshow');
        $this->db->order_by('p.id' , 'desc');

		$query = $this->db->get();
		return $this->combine_meta($query->result());
	}

	private function combine_meta(array $data)
	{
		if (empty($data))
			return $data;

		$current_id = '';
		$new_arr = [];
		foreach ($data as $key => $row_arr){

			if (intval($row_arr->id) !== intval($current_id)){
				$current_id = $row_arr->id;

				$new_arr[$current_id]['post_data'] = [
					'post_id'	=> $row_arr->id,
					'post_slug'	=> $row_arr->slug,
					'post_title'	=> $row_arr->title,
				];
			}


			$new_arr[$current_id]['meta_data'][] = [
				'meta_key'	=> $row_arr->meta_key,
				'meta_value'	=> $row_arr->meta_value
			];
		}

		return array_values($new_arr);
	}

	public function get_post_meta($post_id, $meta_key = null)
	{
		$this->db->select('pm.id,pm.post_id,pm.meta_key,pm.meta_value');
		$this->db->from('posts_meta as pm');
		$this->db->where('post_id', intval($post_id));

		if ($meta_key !== null)
			$this->db->where('meta_key', $meta_key);

		$query = $this->db->get();
		return $query->result_array();
	}

}
