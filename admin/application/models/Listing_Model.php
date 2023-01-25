<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'classes/JsonManipulation.php';

class Listing_Model extends CI_Model
{

	public function get_all_countries()
	{
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->from('b2b_countries');

		$this->db->order_by('id');


		$query = $this->db->get();

		$this->db->cache_off();

		return ($query->result());
	}

	public function get_all_user()
	{
		$this->db->select('*');
		$this->db->from('b2b_users');

		$this->db->order_by('id');


		$query = $this->db->get();


		return ($query->result());
	}

	public function get_all_states()
	{
		$this->db->select('*');
		$this->db->from('b2b_states');

		$this->db->order_by('id');


		$query = $this->db->get();


		return ($query->result());
	}

	public function get_all_city()
	{
		$this->db->select('id , name');
		$this->db->from('b2b_cities');
		/* @todo need to rectifie it */
		//	$this->db->limit(500);
		$this->db->order_by('id');


		$query = $this->db->get();


		return ($query->result());
	}

	public function get_all_listing($limit, $page)
	{
        $offset = ($page - 1) * $limit;
        $this->db->select('*');
        $this->db->from('listings_new');

        $this->db->order_by('id', 'desc');

        $this->db->limit($limit, $offset);
        $query = $this->db->get();


        return ($query->result());
	}

	public function get_all_listing_by_user($id)
	{
		$this->db->select('*');
		$this->db->from('listings');

		$this->db->order_by('id');
		$this->db->where('uid', $id);

		$query = $this->db->get();


		return ($query->result());
	}

	public function get_all_listing_by_cat($id)
	{

		$this->db->select('*');
		$this->db->from('listings');

		$this->db->order_by('id');
		$this->db->where('category_id', $id);

		$query = $this->db->get();


		return ($query->result());
	}

	public function search_listing_from_db($search_item,$limit, $page)
	{
		$offset = ($page - 1) * $limit;
		$per_page_limit = " limit " . $limit . " offset " . $offset;
		if(isset($search_item['s'])){
			$query = "select l.* from listings_new l left join b2b_users u on u.id = l.uid where MATCH(title) AGAINST ('{$search_item['s']}' IN NATURAL LANGUAGE MODE) order by u.username {$per_page_limit}";
		}
		if(isset($search_item['fp'])){
			if($search_item['fp'] === 'filter_posts_by_users'){
                $where = 'where uid=' .$search_item["fd"];
                if((isset($search_item['fd']) && !empty($search_item["fd"])) && (isset($search_item['fc']) && !empty($search_item["fc"]))){
                    $where .= ' and category_id=' .$search_item["fc"] . ' or sub_category_id=' . $search_item["fc"];
                }
				$query = "select l.* from listings l left join b2b_users u on u.id = l.uid {$where} order by u.username {$per_page_limit}";
			}
			if($search_item['fp'] === 'filter_posts_by_country'){
				$where = 'where country_id=' .$search_item["fd"];
				if((isset($search_item['fd']) && !empty($search_item["fd"])) && (isset($search_item['fs']) && !empty($search_item["fs"])) && (isset($search_item['fc']) && !empty($search_item["fc"]))){
					$where .= ' and state_id=' . $search_item["fs"] . ' and category_id=' .$search_item["fc"] . ' or sub_category_id=' . $search_item["fc"];
				}elseif((isset($search_item['fd']) && !empty($search_item["fd"])) && (isset($search_item['fs']) && !empty($search_item["fs"]))){
					$where .= ' and state_id=' . $search_item["fs"];
				}elseif(isset($search_item["fs"]) && !empty($search_item["fs"])){
					$where .= ' and state_id=' . $search_item["fs"];
				}elseif(isset($search_item["fc"]) && !empty($search_item["fc"])){
					$where .= ' and category_id=' . $search_item["fc"];
				}elseif(isset($search_item["fc"]) && !empty($search_item["fc"])){
                    $where .= ' or sub_category_id=' . $search_item["fc"];
                }
				$query = "select l.* from listings_new l left join b2b_users u on u.id = l.uid {$where} order by u.username {$per_page_limit}";
			}
			
			if($search_item['fp'] === 'filter_posts_by_category'){
				$query = "select l.* from listings_new l left join b2b_users u on u.id = l.uid where category_id={$search_item['fd']} or sub_category_id={$search_item['fd']} order by u.username {$per_page_limit}";
			}
		}
		
		$result = $this->db->query($query);
		return $result->result_object();
	}

	public function record_count_search_listings($search_item)
	{
		if(isset($search_item['s'])){
			$query = "select * from listings_new where  MATCH(title) AGAINST ('{$search_item['s']}' IN NATURAL LANGUAGE MODE)";
		}
		if(isset($search_item['fp'])){
			if($search_item['fp'] === 'filter_posts_by_users'){
				$query = "select * from listings_new where uid = {$search_item['fd']}";
			}
			if($search_item['fp'] === 'filter_posts_by_country'){
				$query = "select * from listings_new where country_id = {$search_item['fd']}";
			}
			if($search_item['fp'] === 'filter_posts_by_category'){
				$query = "select * from listings_new where category_id = {$search_item['fd']} or sub_category_id={$search_item['fd']}";
			}
		}
		
		$result = $this->db->query($query);
		return $result->num_rows();
	}
	public function remove($single_listing_id)
	{
		/*$this->db->where("listings_id", $single_listing_id);
		$this->db->delete("listings_meta");

		$this->db->where("id", $single_listing_id);
		$this->db->delete("listings");*/

        $this->db->where("id", $single_listing_id);
        $this->db->delete("listings_new");


		return true;
	}

	public function get_state_by_id($selected_state_id)
	{
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->from('b2b_states');
		$this->db->where('country_id', $selected_state_id);

		$query = $this->db->get();
		$this->db->cache_off();

		return ($query->result());
	}

	public function get_city_by_id($selected_state_id)
	{
		$this->db->select('*');
		$this->db->from('b2b_cities');
		$this->db->where('state_id', $selected_state_id);

		$query = $this->db->get();

		return ($query->result());
	}

    public function get_currency_by_id($selected_currency_id)
    {
        $this->db->select('*');
        $this->db->from('currencies');
        $this->db->where('country_id', $selected_currency_id);

        $query = $this->db->get();

        return ($query->result());
    }

	public function get_formdb_by_id($selected_subcat_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $selected_subcat_id);

		$query = $this->db->get();

		return ($query->result());
	}

	public function get_user_returned($edit_id)
	{
		$this->db->select('*');
		$this->db->from('listings_new');
		$this->db->where('id', $edit_id);

		$query = $this->db->get();


		return ($query->result());
	}

	public function get_dynamic_form_from_meta($cat_id)
	{
		$this->db->select('*');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', $cat_id);
		$this->db->where('meta_key', 'form_category');

		$query = $this->db->get();


		return ($query->result());
	}

    public function get_meta_returned($edit_id)
    {

        $this->db->select('*');
        $this->db->from('listings_new');
        $this->db->where('id', $edit_id);

        $query = $this->db->get();
        $metas = array();
        if($query->num_rows() > 0){
            $getlistingdata = $query->row();
            $listing_metas = json_decode($getlistingdata->meta_values,true);


            foreach ($listing_metas as $k=>$v){
                /*if($k == 'images_from'){
                    if(is_array($v)){
                        $metas_images = $v;
                    }else{
                        $metas_images = unserialize($v);
                    }
                }*/
                $metas[] = (object)array(
                    'id'=>$getlistingdata->id,
                    'listings_id'=>$getlistingdata->id,
                    'meta_key'=>$k,
                    'meta_value'=>$v,
                );
            }
        }

        return $metas;
    }
    public function get_meta_returned_image($edit_id)
    {

        $this->db->select('*');
        $this->db->from('listings_new');
        $this->db->where('id', $edit_id);

        $query = $this->db->get();
        $metas_images = array();
        if($query->num_rows() > 0){
            $getlistingdata = $query->row();
            $listing_metas = json_decode($getlistingdata->meta_values,true);


            foreach ($listing_metas as $k=>$v){
                if($k == 'images_from'){
                    if(is_array($v)){
                        $metas_images = $v;
                    }else{
                        $metas_images = unserialize($v);
                    }
                }

            }
        }

        return $metas_images;
    }

	public function save_lisiting_meta($input_data)
	{
		if (array_key_exists('package_status', $input_data)) {

			$enb = 'enabled';
			unset($input_data['package_status']);
		} else {
			$enb = 'disabled';
		}


		$user_select = $this->input->post('user_select');
		$title_listing = $this->input->post('title_listing');
		$description_listing = $this->input->post('desc_listing');
		$Selected_country = $this->input->post('Selected_country');
		$state_selected = $this->input->post('state_selected');
		$selected_city = $this->input->post('selected_city');
		$selected_category = $this->input->post('selected_category');
		$slug = $input_data['page_slug'];
		$selected_sub_category = $this->input->post('selected_sub_category');
		$seo_title = $this->input->post('seo_title');
		$seo_slug = $this->input->post('seo_slug');
		$seo_keywords = $this->input->post('seo_keywords');
		$make_id = $this->input->post('make_id');
		$model_id = $this->input->post('model_id');
		$seo_meta_description = $this->input->post('seo_meta_description');

		//$slug = volgo_make_slug($this->input->post('input_title'));
		$slug_count = intval($this->check_slug($slug));
		if ($slug_count > 0) {
			$slug = $slug . '-' . (++$slug_count);
		}

		unset($input_data['user_select']);
		unset($input_data['page_slug']);
		unset($input_data['title_listing']);
		unset($input_data['desc_listing']);
		unset($input_data['Selected_country']);
		unset($input_data['state_selected']);
		unset($input_data['selected_city']);
		unset($input_data['selected_category']);
		unset($input_data['selected_sub_category']);
		unset($input_data['seo_title']);
		unset($input_data['seo_slug']);
		unset($input_data['seo_keywords']);
		unset($input_data['make_id']);
		unset($input_data['model_id']);
		unset($input_data['seo_meta_description']);


		$data = array(
			'uid' => $user_select,
			'title' => $title_listing,
			'description' => $description_listing,
			'country_id' => $Selected_country,
			'state_id' => $state_selected,
			'city_id' => $selected_city,
			'category_id' => $selected_category,
			'sub_category_id' => $selected_sub_category,
			'seo_title' => $seo_title,
			'seo_slug' => $seo_slug,
			'seo_description' => $seo_meta_description,
			'seo_keywords' => $seo_keywords,
			'make_id' => $make_id,
			'model_id' => $model_id,
			'slug' => $slug,
			'views' => 0,
			'status' => $enb,
			'geo_location_lat_lng' => null,
			'created_at' => date("Y-m-d H:i:s"),
			'is_email' => 'enabled',
		);
		
		/*$this->db->set($data);

		$is_inserted = $this->db->insert(
			'listings'
		);*/
        $meta_values = array();
        if (!empty($input_data)) {

            foreach ($input_data as $key => $value) {
                if($key == 'images_from'){
                    $value = unserialize($value);
                }
                $meta_values[$key] = $value;
            }
            $data['listing_type'] = $meta_values['listing_type'];
            $data['meta_values'] = json_encode($meta_values);

        } else {
            return true;
        }
        $is_inserted = $this->db->insert(
            'listings_new',$data
        );

		if (!$is_inserted) {


			$data = [
				'all_cats' => $this->Category_Model->get_all_categories(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => 'Data Not Inserted Something happened Kindly Retry',
				'success_msg' => '',
			];

			$this->load->view('admin/listing/listing', $data);
			return false;
		}else{
            return $is_inserted;
        }

		/*else {
		    //$this->make_home_json($Selected_country);
			$listing_insert_id = $this->db->insert_id();
            $meta_values = array();
			if (!empty($input_data)) {

				foreach ($input_data as $key => $value) {
                    if($key == 'images_from'){
                        $value = unserialize($value);
                    }
                    $meta_values[$key] = $value;
					if (is_array($value)) {
						$value = serialize($value);
					}
					$data2 = array(
						'meta_key' => $key,
						'meta_value' => $value,
						'listings_id' => $listing_insert_id,
					);


					//save data in database

					$this->db->set($data2);

					$is_inserted = $this->db->insert(
						'listings_meta'
					);
					if (!$is_inserted) {
						break;
					}
				}
                $data['listing_type'] = $meta_values['listing_type'];
                $data['meta_values'] = json_encode($meta_values);
                $is = $this->db->insert(
                    'listings_new',$data
                );
				return $is_inserted;
			} else {
				return true;
			}
		}*/
	}

	public function get_follower_emails($id_of_user)
	{
		$this->db->select('meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->where('meta_key', 'follow_add_dashboard');
		//$this->db->where('meta_value', intval($id_of_user));
		$this->db->where('user_id', intval($id_of_user));
		// // $this->db->cache_on();
		

		$query = $this->db->get();
		$follewer_ids = $query->result();
		
		$follower_emails = [];
		foreach ($follewer_ids as $follewer_id) {
		$this->db->select('email');
		$this->db->from('b2b_users');
		$this->db->where('id', $follewer_id->meta_value);
		$query = $this->db->get();
		$follower_emails[] = $query->row('email');
		}

		// $this->db->cache_off();

		return $follower_emails;
	}

	function get_user_data_by_id($user_id){
		$this->db->select('firstname, lastname, username, email');
		$this->db->from('b2b_users');
		$this->db->where('id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	public function save_lisiting_meta_edit($input_data)
	{

		if (!$input_data)
			return;

		$jsonManipulation = (new \application\classes\JsonManipulation());
		$all_cats = $jsonManipulation->get_categories(null);

		if (array_key_exists('package_status', $input_data)) {
			$enb = 'enabled';
			unset($input_data['package_status']);
		} else {
			$enb = 'disabled';
		}

		// update Listing Count
		foreach ($all_cats as $cat) {
			if (intval($input_data['selected_sub_category']) === intval($cat->id)) {

				// Select original data from DB.
				$listing = $this->db->select('status')->from('listings_new')->where('id', $input_data['id'])->get()->row();
				if (!empty($listing)) {

					$total_count_key = 'country_id_' . $input_data['Selected_country'];

					if ($listing->status === 'disabled' && $enb === 'enabled') {
						// this is new listing and should be +1

						if (isset($cat->count, $cat->count->$total_count_key)) {
							$cat->count->$total_count_key = intval($cat->count->$total_count_key) + 1;
						} else {
							$cat->count = (object) [
								'country_id_' . $input_data['Selected_country'] => 1
							];
						}

					}else if ($listing->status === 'enabled' && $enb === 'disabled'){
						// it mean one listing should be minus. As current status is disabled

						if (isset($cat->count, $cat->count->$total_count_key)) {
							$cat->count->$total_count_key = intval($cat->count->$total_count_key) - 1;
						} else {
							$cat->count = (object) [
								'country_id_' . $input_data['Selected_country'] => 0
							];
						}

					}else {
						// Just in the end make sure that key exists or add keys with out any increment
						if (isset($cat->count, $cat->count->$total_count_key)) {
							// do nothing
						} else {
							$cat->count = (object) [
								'country_id_' . $input_data['Selected_country'] => 0
							];
						}
					}
				}

				break;
			}
		}

		// actually update the categories.
		$jsonManipulation->recreate_array($all_cats, 'categories');

		// updating the cache
		$cache_key = 'json_categories_1';
		$this->cache->delete($cache_key);
		$this->cache->save($cache_key, $all_cats, MAX_CACHE_TTL_VALUE);

		$user_select = $input_data['user_select'];
		$title_listing = $input_data['title_listing'];
		$description_listing = $input_data['desc_listing'];
		$Selected_country = $input_data['Selected_country'];
		$state_selected = $input_data['state_selected_retrival'];
		$selected_city = $input_data['selected_city'];
		$selected_category = $this->input->post('selected_category');
		$selected_sub_category = $input_data['selected_sub_category'];
		$slug = $input_data['page_slug'];
		$seo_title = $input_data['seo_title'];
		$seo_slug = $input_data['seo_slug'];
		$seo_keywords = $input_data['seo_keywords'];

		$seo_meta_description = $input_data['seo_meta_description'];
		$id = $input_data['id'];

		if(!isset($input_data['is_email'])){
			$is_email = 'enabled';
		}else{
			$is_email = 'disabled';
		}
		
// 		//$slug = volgo_make_slug($this->input->post('input_title'));
// 		$slug_count = intval($this->check_slug($slug));
// 		if ($slug_count > 0) {
// 			$slug = $slug . '-' . (++$slug_count);
// 		}
		
		unset($input_data['id']);
		unset($input_data['user_select']);
		unset($input_data['title_listing']);
		unset($input_data['desc_listing']);
		unset($input_data['Selected_country']);
		unset($input_data['state_selected_retrival']);
		unset($input_data['selected_city']);
		unset($input_data['selected_category']);
		unset($input_data['page_slug']);
		unset($input_data['selected_sub_category']);
		unset($input_data['seo_title']);
		unset($input_data['seo_slug']);
		unset($input_data['seo_keywords']);
		unset($input_data['seo_meta_description']);
		unset($input_data['select_make']);
		unset($input_data['select_model']);


		$forchecking_image = '';
		if (isset($input_data['images_from'])) {
		    if(is_array($input_data['images_from'])){
                $forchecking_image = @$input_data['images_from'][0];
            }else{
                $forchecking_image = @unserialize($input_data['images_from'])[0];
            }

		}

		if (empty($forchecking_image)) {
			unset($input_data['images_from']);
		}


		$data = array(
			'uid' => $user_select,
			'title' => $title_listing,
			'description' => $description_listing,
			'country_id' => $Selected_country,
			'state_id' => $state_selected,
			'city_id' => $selected_city,
			'category_id' => $selected_category,
			'sub_category_id' => $selected_sub_category,
			'seo_title' => $seo_title,
			'seo_slug' => $seo_slug,
			'seo_description' => $seo_meta_description,
			'seo_keywords' => $seo_keywords,
			'slug' => $slug,
			'views' => 0,
			'status' => $enb,
			'is_email' => $is_email,
			'geo_location_lat_lng' => null,
			'created_at' => date("Y-m-d H:i:s"),
		);


		/*$this->db->set($data);
		$this->db->where('id', $id);
		$is_inserted = $this->db->update(
			'listings'
		);*/
        $meta_values = array();
        if (!empty($input_data)) {

            foreach ($input_data as $key => $value) {
                if ($key == 'images_from') {
                    if (is_array($value)){
                        $value = $value;
                    }else{
                        $value = unserialize($value);
                    }
                }
                $meta_values[$key] = $value;

            }
            $data['listing_type'] = $meta_values['listing_type'];
            $data['meta_values'] = json_encode($meta_values);
            $this->db->where('id', $id);
            $is_updated = $this->db->update(
                'listings_new', $data
            );
        }
		if (!$is_updated) {


			$data = [
				'all_cats' => $this->Category_Model->get_all_categories(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => 'Data Not Inserted Something happened Kindly Retry',
				'success_msg' => '',
			];

			$this->load->view('admin/listing/edit', $data);
			return false;
		}else{
            return $is_updated;
        } /*else {
            $meta_values = array();
			if (!empty($input_data)) {

				foreach ($input_data as $key => $value) {
                    if($key == 'images_from'){
                        $value = unserialize($value);
                    }
                    $meta_values[$key] = $value;
					if (is_array($value)) {
						$value = serialize($value);

					}
					$data2 = array(
						'meta_value' => $value
					);
					$this->db->select('*');
					$this->db->where('listings_id', $id);
					$this->db->where('meta_key', $key);
					$sql = $this->db->get('listings_meta');
					if($sql->num_rows() > 0){
					//save data in database
					$this->db->where('listings_id', $id);
					$this->db->where('meta_key', $key);
					$this->db->set($data2);

					$is_updated = $this->db->update(
						'listings_meta'
					);

					if (!$is_updated) {
						break;
					}
					}else{
					$this->db->set('listings_id', $id);
					$this->db->set('meta_key', $key);
					$this->db->set($data2);

					$is_inserted = $this->db->insert('listings_meta');
					if (!$is_inserted) {
						break;
					}
					}
				}
                $data['listing_type'] = $meta_values['listing_type'];
                $data['meta_values'] = json_encode($meta_values);
                $this->db->where('id',$id);
                $is = $this->db->update(
                    'listings_new',$data
                );
				return $is_updated;
			} else {
				return true;
			}
		}*/
	}

	public function get_listing_type_by_listing_id($listing_id)
	{
		$this->db->select('*');
		$this->db->from('listings_meta');
		$this->db->where('listings_id', $listing_id);
		$this->db->where('meta_key', 'listing_type');

		$query = $this->db->get();


		return ($query->result());
	}

	public function get_listing_type_by_listing_id_2($listing_id)
	{
		$this->db->select('*');
		$this->db->from('listings_new');
		$this->db->where('id', $listing_id);

		$query = $this->db->get();


		return ($query->result());
	}

	private $table_name = 'listings_new';

	public function check_slug($title)
	{

		$slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
		$result = $this->db->query(
			"SELECT COUNT(*) AS NumHits FROM {$this->table_name} WHERE slug like '$slug%'"
		);

		$row = $result->row();
		return $row->NumHits;
	}

	public function record_count_listings()
	{
		return $this->db->count_all("listings_new");
	}

	public function get_parent_category_id($category_id)
	{
		$this->db->select('parent_ids,category_type');
		$this->db->from('categories');
		$this->db->where('id', $category_id);
		$this->db->where('category_type', 'seller_lead');
		$this->db->or_where('category_type', 'buying_lead');
		$query = $this->db->get();

		return ($query->row());
	}
	function get_latest_listing_ids($type,$country_id,$limit){

	$listing_ids_query = "select l.id
							from listings_new
			     			where lm.listing_type = '{$type}'
							and l.status = 'enabled' and l.country_id = " . intval($country_id) . " order by l.id
										desc limit {$limit};";
				$listings_ids_q = $this->db->query($listing_ids_query);
				$listings_ids = $listings_ids_q->result();
				
				//Perform operation
				$listing_ids_arr = [];
				foreach ($listings_ids as $value) {
					$listing_ids_arr[] = $value->id;
				}
				//$listings_ids = implode(',', $listing_ids_arr);
				return $listing_ids_arr;
	}
	public function search_pending_listing_from_db($search_item)
	{
		$query = "select * from listings_new where status='disabled' and MATCH(title) AGAINST ('{$search_item}' IN NATURAL LANGUAGE MODE)";
		
		$result = $this->db->query($query);
		return $result->result_object();
	}
	
	public function get_all_pending_listing()
	{
		$this->db->select('*');
		$this->db->from('listings_new');
		$this->db->where('status', 'disabled');
		$this->db->order_by('id', 'desc');

		$query = $this->db->get();
        //echo $this->db->last_query(); exit;
		return ($query->result());
	}
    public function get_all_pending_listing_new()
    {
        $query = "SELECT *
        FROM `listings_new`
        WHERE `status` = 'disabled'
        ORDER BY `id` DESC";
        $result = $this->db->query($query);

        return $result->result();

    }
	
	public function approve_multiple_listings($ids)
	{
		$data = array(
			'status' => 'enabled'
		);
		$this->db->set($data);
		if($ids === 'all'){
			$this->db->where('id !=', '');
			$this->db->where('status', 'disabled');

		}else{
			$this->db->where_in('id', $ids);
		}
		$is_updated = $this->db->update(
			'listings_new'
		);
        /*if($ids === 'all'){
            $qury = "SELECT id
			    FROM listings WHERE status = 'disabled'
			";
            $ids = array();
            $rest = $this->db->query($qury);
            foreach ($rest->result() as $r){
                $ids[] = $r->id;
            }
        }
		if(count($ids)){
            $ids = implode(',',$ids);
            $query = "
		    SELECT *
		    FROM listings
		    WHERE id in ($ids)
		";
            $result = $this->db->query($query);

            foreach ($result->result() as $row){

                $this->make_home_json($row->country_id);


            }
        }*/

		return $is_updated;
	}

    public function get_listings($limit = 9, array $listing_type = ['featured','recommended'],$country_id)
    {
        //$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        $final_listings = [];
        foreach ($listing_type as $key => $type) {
            /*
             * @can be:
             * 	listings_ids_of_buying_lead_listings_4_records_country_id_166
             * 	listings_ids_of_featured_listings_9_records_country_id_166
             * 	listings_ids_of_recommended_listings_9_records_country_id_166
             * */
            //$cache_key = get_meta_listing_ids_cache_key($type,$limit,$this->country_info['country_id']);
            //if (!$listings_ids = $this->cache->get($cache_key)) {
            // Query
            $listing_ids_query = "select lm.listings_id
										from listings_meta lm
										  left join listings l on l.id = lm.listings_id
										where lm.meta_key
											  = 'listing_type' and lm.meta_value = '{$type}'
										and l.status = 'enabled' and l.country_id = " . $country_id . " order by listings_id
										desc limit {$limit};";
            $listings_ids_q = $this->db->query($listing_ids_query);
            $listings_ids = $listings_ids_q->result();
            // Perform operation
            $listing_ids_arr = [];
            foreach ($listings_ids as $value) {
                $listing_ids_arr[] = $value->listings_id;
            }
            $listings_ids = implode(',', $listing_ids_arr);
            unset($listing_ids_query);
            unset($listings_ids_q);
            // Save Data
            //if (IS_CACHE_ON === true)
            //$this->cache->save($cache_key, $listings_ids, MAX_CACHE_TTL_VALUE); // save for 72 hours
            //}
            if (!isset($listings_ids) || empty($listings_ids))
                $listings_ids = 0;
            /*
             * @can be
             * 	latest_listings_of_buying_lead_listings_4_records_country_id_166
             *	latest_listings_of_featured_listings_9_records_country_id_166
             * 	latest_listings_of_recommended_listings_9_records_country_id_166
             * */
            //$cache_key = get_latest_listings_cache_key($type,$limit,$this->country_info['country_id']);
            //if (!$listings = $this->cache->get($cache_key)) {
            // Query
            $query = $this->db->query(
                "SELECT l.id as listing_id, l.slug, l.title, c.id as category_id, c.name as category_name" .
                " From listings as l" .
                " inner JOIN categories c ON c.id = l.category_id " .
                " WHERE l.id in ({$listings_ids})" .
                " ORDER BY listing_id DESC" .
                " limit {$limit}"
            );
            $listings = $query->result();
            unset($listings_ids);
            // Save Data
            //if(IS_CACHE_ON === true)
            //$this->cache->save($cache_key, $listings, MAX_CACHE_TTL_VALUE); // save for 72 hours
            //}
            $final_listings[$type] = $listings;
        }
        unset($key);
        unset($type);
        unset($listings);
        $new_arr = [];
        foreach ($final_listings as $type => $listings) {
            $listing_id = '';
            $listing_meta_info = [];
            $old_key = 0;
            foreach ($listings as $key => $val_arr) {
                if (empty($listing_id) || (intval($listing_id) !== intval($val_arr->listing_id))) {
                    $listing_id = $val_arr->listing_id;
                    $old_key = $key;
                    $new_arr[$type][$old_key]['listing_info'] = [
                        'listing_id' => $val_arr->listing_id,
                        'listing_title' => $val_arr->title,
                        'listing_slug' => $val_arr->slug,
                    ];
                    $new_arr[$type][$old_key]['category_info'] = [
                        'category_id' => $val_arr->category_id,
                        'category_name' => $val_arr->category_name
                    ];
                    /*
                     * @can be
                     * 	listing_meta_35821
                     *	listing_meta_xxxxxxx (where xxxxx is listing id)
                     * */
                    /* $cache_key = get_mobile_listing_meta_data_cache_key($listing_id);
                     if (!$result = $this->cache->get($cache_key)) {*/
                    // Query
                    $this->db->select('id, meta_key, meta_value');
                    $this->db->from('listings_meta');
                    $this->db->where('listings_id', intval($listing_id));
                    $this->db->order_by("listings_id", "desc");
                    $result = $this->db->get()->result();
                    // Save Data
                    /*if (IS_CACHE_ON === true)
                        $this->cache->save($cache_key, $result, MAX_CACHE_TTL_VALUE);*/ // save for 72 hours
                    //}
                    $listing_meta_info = $result;
                }
                if($new_arr[$type][$old_key]['listing_info'] == $country_id){
                    countinue;
                }
                foreach ($listing_meta_info as $listing_meta) {
                    $new_arr[$type][$old_key]['metas'][] = [
                        'listing_meta_id' => isset($listing_meta->id) ? (int)$listing_meta->id : 0,
                        'meta_key' => $listing_meta->meta_key,
                        'meta_value' => $listing_meta->meta_value,
                    ];
                }
            }
        }
        return $new_arr;
    }

    public function letest_trade_show()
    {
        $this->db->select('p_te.id ,p_te.title, p_te.content, p_te.featured_image, p_te.slug');
        $this->db->select('pm_te.meta_value ,pm_te.meta_key');
        $this->db->from('posts as p_te');
        $this->db->join('posts_meta as pm_te', 'pm_te.post_id = p_te.id', 'left');
        $this->db->where('type', 'tradeshow');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $letest_trade_show = $result->result();

        return $letest_trade_show;
    }
    public function counts_reults($country_id = null){
       /* if(empty($country_id)){
            $country_id = volgo_get_country_id_from_session();
        }*/
        /*$query = "SELECT c.name,c.id,
    (
     SELECT COUNT(l.id)
     FROM listings l
     WHERE l.sub_category_id = c.id
     AND l.status = 'enabled'
     AND l.country_id = $country_id
    ) as total_counts,

    (
       SELECT COUNT(lf.id)
       FROM listings lf
       JOIN listings_meta lm
       ON lm.listings_id = lf.id
       WHERE meta_key = 'listing_type'
       AND meta_value = 'featured'
       AND lf.sub_category_id = c.id
       AND lf.country_id = $country_id
       AND lf.status = 'enabled'
     ) as total_count_featured,

     (
       SELECT COUNT(lr.id)
       FROM listings lr
       JOIN listings_meta lm
       ON lm.listings_id = lr.id
       WHERE meta_key = 'listing_type'
       AND meta_value = 'recommended'
       AND lr.sub_category_id = c.id
       AND lr.country_id = $country_id
       AND lr.status = 'enabled'
     ) as total_count_recommended


    FROM categories c WHERE category_type = 'category' AND parent_ids != 'uncategorised'";*/
        $query = "SELECT c.name,c.id,'' as total_counts,'' as total_counts,'' as total_count_recommended
	
    FROM categories c WHERE category_type = 'category' AND parent_ids != 'uncategorised'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_latest_listings($limit = 9,$country_id)
    {

        $this->db->select('l.id, l.title, l.slug, l.created_at');
        $this->db->from('listings as l');
        $this->db->where('l.status', 'enabled');
        $this->db->where('l.country_id', intval($country_id));
        $this->db->order_by("id", "desc");
        $this->db->limit($limit);

        $result = $this->db->get();

        //$this->db->cache_off();

        $listings = $result->result();

        return $listings;
    }

    public function get_all_currencies()
    {
        $this->db->select('*');
        $this->db->from('currencies');
        $this->db->order_by('id');
        $query = $this->db->get();

        return ($query->result());
    }

    public function get_rightside_banners($limit = 1, $where_display_unit = 'right-sidebar')
    {
// 		$this->db->cache_on();
        $this->db->select('id, unique_key, title, description, ad_code_image, ad_type, url');
        $this->db->from('ad_banners');

        if (! empty($where_display_unit))
            $this->db->where('display_unit', 'right-sidebar');

        $this->db->limit($limit);

        $query = $this->db->get();
        $banners = $query->result();
// 		$this->db->cache_off();

        return $banners;

    }

    public function make_home_json($country_id = null){

        if(empty($country_id)){
            $countries_query =  "
	        SELECT * 
	        FROM b2b_countries c
	    ";
        }else{
            $countries_query =  "
	        SELECT * 
	        FROM b2b_countries c
	        WHERE id = $country_id
	    ";
        }


        $countries_results = $this->db->query($countries_query);
        $countries = $countries_results->result();


        foreach ($countries as $country){

            $listings = $this->get_listings(18,['featured','recommended'],$country->id);


            $single_tradeshow_merg = $this->letest_trade_show();

            // get trade show
            $new_arr = [];
            $final_arr = $this->get_tradeshow_arr($single_tradeshow_merg, $new_arr);

            $data = [
                //'footer_block' => $this->Blocks_Model->get_block('footer_block'),
                'listings' => $listings,
                'buying_and_seller_leads'	=> $this->get_listings(6, ['buying_lead','seller_lead'],$country->id),
                'new_listings' => $this->get_latest_listings(5,$country->id),
                'ad_banners'	=> $this->get_rightside_banners(2),
                'all_counts_result' => $this->counts_reults($country->id),
                'trade_shows' => $final_arr,
                'metas_trade_show' => $new_arr,
                'all_currencies' => $this->get_all_currencies()
            ];
            $json = json_encode($data);
            //$file = FCPATH."jsons/$country->id.json";
            $file = $_SERVER["DOCUMENT_ROOT"].'/b2bclassified/'."jsons/$country->id.json";
            if(file_exists($file)){
                $fp = fopen($file, 'w');
                fwrite($fp, $json);
                fclose($fp);
            }else{
                $fp = fopen($file, 'w');
                fwrite($fp, $json);
                fclose($fp);
                chmod($file, 0777);

            }
        }


        return true;
        exit;
    }
    private function get_tradeshow_arr(array $single_tradeshow_merg, &$new_arr){
        $mergedfinal = [];

        foreach ($single_tradeshow_merg as $value) {
            $result2[] = (array)$value;
            $mergedfinal[] = array_merge(...$result2);
        }

        $id = '';
        foreach ($mergedfinal as $row) {
            if (empty($id) || (intval($id) !== $row['id'])) {
                $id = $row['id'];
                $new_arr[$id]['tradeshow_info'] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'featured_image' => $row['featured_image'],
                    'slug'	=> $row['slug']
                ];
            }

            $new_arr[$id]['metas'][] = [
                'meta_key' => $row['meta_key'],
                'meta_value' => $row['meta_value']
            ];
        }


        $new_arr = array_values($new_arr);
        $final_arr = [];

        foreach ($new_arr as $key => $single_value) {
            $final_arr[] = $single_value['tradeshow_info'];
        }

        return $final_arr;
    }
}
