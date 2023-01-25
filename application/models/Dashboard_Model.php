<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use OSS\OssClient;
use OSS\Core\OssException;

class Dashboard_Model extends CI_Model
{
	public function get_curent_user_detail($logedin_user_email)
	{
// 		$this->db->cache_on();
		$this->db->select('id , username , firstname , lastname , email , password, created_at , updated_at , user_type');
		$this->db->from('b2b_users');
		$this->db->order_by('id');
		$this->db->where('email', $logedin_user_email);
		$query = $this->db->get();
// 		$this->db->cache_off();

		return ($query->result());
	}

	public function get_user_order_details($userid)
	{
		$current_year = date('Y');
		$query = "select o.id, o.package_details,o.transaction_details,o.order_date,p.expiry,p.expiry_unit from orders o JOIN packages p on p.id = o.packages_id  where o.status = 'paid' and YEAR(o.order_date) = {$current_year} and o.user_id = {$userid} order by o.id desc limit 1";

		$res = $this->db->query($query);

		$res = $res->result();

		if (empty($res) || ! isset($res[0])){
			return [];
		}

		return $res[0];
	}

	public function get_user_order_meta($order_id)
	{
		$order_meta = $this->db->select('id, meta_value as connects')->from('orders_meta')->where('order_id', $order_id)->get()->row();
		return $order_meta;
	}

	public function get_curent_user_detail_by_id($id)
	{
		//$this->db->cache_on();
		$this->db->select('id , username , firstname , lastname , email , created_at , updated_at , user_type');
		$this->db->from('b2b_users');
		$this->db->order_by('id');
		$this->db->where('id', $id);
		$query = $this->db->get();
		//$this->db->cache_off();

		return ($query->result());
	}

	public function get_user_meta($user_id)
	{
		// $this->db->cache_on();
		$cache_key = 'user__meta_data_of_' . $user_id;
			
		//if (!$user__meta_data = $this->cache->get($cache_key)) {
		$this->db->select('id , user_id , meta_key , meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();

		$user__meta_data = $query->result();
		// Save Data
		//if (IS_CACHE_ON === true)
		//$this->cache->save($cache_key, $user__meta_data, MAX_CACHE_TTL_VALUE); // save for 72 hours
		//}
		return ($user__meta_data);
	}

	public function update_firstname($name, $id)
	{

		$data = array(
			'firstname' => $name,
		);

		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'b2b_users'
		);

	}

	public function update_lastname($name, $id)
	{

		$data = array(
			'lastname' => $name,
		);

		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'b2b_users'
		);

	}
	public function update_password($password,$id){
		$data = array(
			'password' => password_hash($password, PASSWORD_BCRYPT),
		);

		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update(
			'b2b_users'
		);
    }
	public function insert_metas_for_user($input_post, $id)
	{
		$data = [];
		
		
		foreach ($input_post as $key => $userdetail) {

			$this->db->select('id , user_id , meta_key , meta_value');
			$this->db->from('b2b_user_meta');
			$this->db->order_by('id');
			$this->db->where('user_id', $id);
			$this->db->where('meta_key', $key);
			$query = $this->db->get();
			$dbdata = $query->result();
			
			if($dbdata){
				$this->db->delete('b2b_user_meta', array('user_id' => $id,'meta_key'=> $key));
			}
			$data = [
				'meta_key' => $key,
				'meta_value' => $userdetail,
				'user_id' => $id,
			];

			$this->db->set($data);

			$this->db->insert(
				'b2b_user_meta'
			);
		}
			
		return true;

	}

	public function store_followers($user_id_of_user, $loged_in_user_id)
	{
// 		$this->db->cache_on();
		$this->db->select('id , user_id , meta_key , meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id');
		$this->db->where('user_id', $loged_in_user_id);
		$this->db->where('meta_key', 'Following');
		$this->db->where('meta_value', $user_id_of_user);
		$query = $this->db->get();
// 		$this->db->cache_off();
		$followeding = $query->result();

		if (empty($followeding)) {
			$data = [
				'meta_key' => 'Following',
				'meta_value' => $user_id_of_user,
				'user_id' => $loged_in_user_id,
			];

			$this->db->set($data);

			$this->db->insert(
				'b2b_user_meta'
			);

			return true;
		} else {
			return true;
		}

	}

	public function unstore_followings($user_id_of_user, $loged_in_user_id)
	{

		$this->db->delete('b2b_user_meta', ['user_id' => $loged_in_user_id, 'meta_key' => 'follow_add_dashboard', 'meta_value' => $user_id_of_user,]);

		return true;
	}

	public function unstore_followers($user_id_of_user, $loged_in_user_id)
	{

		$this->db->delete('b2b_user_meta', ['user_id' => $loged_in_user_id, 'meta_key' => 'follow_add_dashboard', 'meta_value' => $user_id_of_user,]);
		
		return true;
	}
	

	public function get_followers($loged_in_user_id,$search_query='')
	{
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$cache_key = get_followers_of_user_id_cache_key($loged_in_user_id);
		//$cache_key = 'get_followers_of_user_id_' . $loged_in_user_id;
		//if (!$followed_by = $this->cache->get($cache_key)) {
		// $this->db->cache_on();
		$this->db->select('id , user_id , meta_key , meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id','desc');
		$this->db->where('meta_key', 'follow_add_dashboard');
		$this->db->where('user_id', $loged_in_user_id);
		$query = $this->db->get();
		$followed_by = $query->result();
		// $this->db->cache_off();
		// Save Data
		//if (IS_CACHE_ON === true)
		//$this->cache->save($cache_key, $followed_by, MAX_CACHE_TTL_VALUE); // save for 72 hours
		//}
		$ids_of_followers = [];
		
		foreach ($followed_by as $key => $single_follower_id) {
			$cache_key = get_id_of_follower_cache_key($single_follower_id->meta_value);
			//$cache_key = 'get_id_of_follower_' . $single_follower_id->meta_value;
		
			//if (!$ids_of_followers = $this->cache->get($cache_key)) {
			if(!empty($search_query)){
				$this->db->select('id');
				$this->db->from('b2b_users');
				$this->db->where('id', $single_follower_id->meta_value);
				$where = "(username Like '%{$search_query}%' OR firstname Like '%{$search_query}%' OR lastname Like '%{$search_query}%' OR email Like '%{$search_query}%')";
				$this->db->where($where);
				$query = $this->db->get();
				$check = $query->result();
				if($check){
					if(!empty($single_follower_id->meta_value)){
					if(!in_array($single_follower_id->meta_value, $ids_of_followers)){
					$ids_of_followers[] = $single_follower_id->meta_value;
				    }
			    }
				}
			}else{
				//$ids_of_followers[] = $single_follower_id->user_id;
				if(!empty($single_follower_id->meta_value)){
				if(!in_array($single_follower_id->meta_value, $ids_of_followers)){
					$ids_of_followers[] = $single_follower_id->meta_value;
				}
			}
			}
			//if (IS_CACHE_ON === true)
			//$this->cache->save($cache_key, $ids_of_followers, MAX_CACHE_TTL_VALUE); // save for 72 hours
			//}
		}

		return $ids_of_followers;

	}


	public function get_followings($loged_in_user_id,$search_query='')
	{
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		//$cache_key = 'get_followings_of_user_id_' . $loged_in_user_id;
		$cache_key = get_followings_of_user_id_cache_key($loged_in_user_id);
		//if (!$followed_by = $this->cache->get($cache_key)) {
		// $this->db->cache_on();
		$this->db->select('id , user_id , meta_key , meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id','desc');
		$this->db->where('meta_key', 'follow_add_dashboard');
		$this->db->where('meta_value', $loged_in_user_id);
		$query = $this->db->get();
		$followed_by = $query->result();
		// $this->db->cache_off();
		//if (IS_CACHE_ON === true)
		//$this->cache->save($cache_key, $followed_by, MAX_CACHE_TTL_VALUE); // save for 72 hours
		//}
		$ids_of_followers = [];
		 
		foreach ($followed_by as $key => $single_follower_id) {
			//$cache_key = 'get_id_of_following_' . $single_follower_id->meta_value;
			$cache_key = get_id_of_following_cache_key($single_follower_id->meta_value);
			//if (!$ids_of_followers = $this->cache->get($cache_key)) {
			if(!empty($search_query)){

				$this->db->select('id');
				$this->db->from('b2b_users');
				$this->db->where('id', $single_follower_id->meta_value);

				$where = "(username Like '%{$search_query}%' OR firstname Like '%{$search_query}%' OR lastname Like '%{$search_query}%' OR email Like '%{$search_query}%')";
				$this->db->where($where);
				$query = $this->db->get();
				$check = $query->result();

				if($check){
					//$ids_of_followers[] = $single_follower_id->meta_value;
					if(!empty($single_follower_id->user_id)){
					if(!in_array($single_follower_id->user_id, $ids_of_followers)){
					$ids_of_followers[] = $single_follower_id->user_id;
				    }}
				}
			}else{
				//$ids_of_followers[] = $single_follower_id->meta_value;
				if(!empty($single_follower_id->user_id)){
				if(!in_array($single_follower_id->user_id, $ids_of_followers)){
					$ids_of_followers[] = $single_follower_id->user_id;
				}}
			}
			//if (IS_CACHE_ON === true)
			$this->cache->save($cache_key, $ids_of_followers, MAX_CACHE_TTL_VALUE); // save for 72 hours
		//}
		}

		return $ids_of_followers;

	}

	// public function get_users_detail($id_of_user)
	// {
	// 	$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	// 	//$cache_key = 'get_user_detail_of_' . $id_of_user;
	// 	$cache_key = get_user_data_cache_key($id_of_user);	
	// 	//if (!$followed_by_user_detail = $this->cache->get($cache_key)) {
	// 	// $this->db->cache_on();
	// 	$this->db->select('id , firstname , lastname');
	// 	$this->db->from('b2b_users');
	// 	$this->db->order_by('id');
	// 	$this->db->where('id', $id_of_user);

	// 	$query = $this->db->get();
	// 	// $this->db->cache_off();
	// 	$followed_by_user_detail = $query->result();
	// 	if (IS_CACHE_ON === true)
	// 	//$this->cache->save($cache_key, $followed_by_user_detail, MAX_CACHE_TTL_VALUE); // save for 72 hours
	// 	//}

	// 	if($followed_by_user_detail){
	// 		//$cache_key = 'get_user_meta_value_of_' . $id_of_user;
	// 		//$cache_key = get_user_meta_value_cache_key($id_of_user);
	// 		//if (!$b2b_user_meta_detail = $this->cache->get($cache_key)) {
	// 		$this->db->select('meta_value');
	// 		$this->db->from('b2b_user_meta');
	// 		$this->db->where('user_id', $id_of_user);
	// 		$this->db->where('meta_key', 'profile_image');
	// 		$this->db->or_where('meta_key', 'Image_of_profile_user');

	// 		$b2b_user_meta = $this->db->get();
	// 		$b2b_user_meta_detail = $b2b_user_meta->result();
	// 		//if (IS_CACHE_ON === true)
	// 		//$this->cache->save($cache_key, $b2b_user_meta_detail, MAX_CACHE_TTL_VALUE); // save for 72 hours
	// 		//}
	// 	}
	// 	//$cache_key = 'get_total_post_of_user_id_' . $id_of_user;
	// 	//$cache_key = get_total_posts_cache_key($id_of_user);	
	// 	///if (!$total_post = $this->cache->get($cache_key)) {
	// 	// $this->db->cache_on();
	// 	$this->db->select('id , uid');
	// 	$this->db->from('listings');
	// 	$this->db->order_by('id');
	// 	$this->db->where('uid', $id_of_user);
	// 	$countpost = $this->db->get();	
	// 	// $this->db->cache_off();
	// 	if($countpost->num_rows() > 0){
	// 	$total_post = $countpost->num_rows();
	// 	}else{
	// 	$total_post = 0;
	// 	}
	// 	//if (IS_CACHE_ON === true)
	// 	//$this->cache->save($cache_key, $countpost, MAX_CACHE_TTL_VALUE); // save for 72 hours
	// 	//}
	// 	if(!$b2b_user_meta_detail[0]->meta_value){
	// 		$b2b_user_meta_detail[0]->meta_value = '';
	// 	}

	// 	$displayname = [];
	// 	if($followed_by_user_detail){
	// 	$displayname['id'] = $followed_by_user_detail[0]->id;
	// 	$displayname['name'] = $followed_by_user_detail[0]->firstname . ' ' . $followed_by_user_detail[0]->lastname;
	// 	$displayname['postcount'] = $total_post;
	// 	$displayname['profile_pic'] = $b2b_user_meta_detail[0]->meta_value;
	// 	}
	// 	//echo "<pre>";print_r($b2b_user_meta_detail[0]->meta_value);die;
	// 	return $displayname;
	// }
	public function get_users_detail($id_of_user)
	{
		// $this->db->cache_on();
		$this->db->select('id , firstname , lastname');
		$this->db->from('b2b_users');
		$this->db->order_by('id');
		$this->db->where('id', $id_of_user);

		$query = $this->db->get();
		// $this->db->cache_off();
		$followed_by_user_detail = $query->result();

		if($followed_by_user_detail){
			$this->db->select('meta_value');
			$this->db->from('b2b_user_meta');
			$this->db->where('user_id', $id_of_user);
			$this->db->where('meta_key', 'profile_image');

			$b2b_user_meta = $this->db->get();
			$b2b_user_meta_detail = $b2b_user_meta->result();
		}

		// $this->db->cache_on();
		$this->db->select('id , uid');
		$this->db->from('listings_new');
		$this->db->order_by('id');
		$this->db->where('uid', $id_of_user);
		$countpost = $this->db->get();
		// $this->db->cache_off();
		$total_post = $countpost->num_rows();

		$displayname = [];
		$displayname['id'] = $followed_by_user_detail[0]->id;
		$displayname['name'] = $followed_by_user_detail[0]->firstname . ' ' . $followed_by_user_detail[0]->lastname;
		$displayname['postcount'] = $total_post;
		$displayname['profile_pic'] = $b2b_user_meta_detail[0]->meta_value;

		return $displayname;
	}
	public function soft_delete($id)
	{

		$data = array(
			'is_deleted' => '1',
		);

		$this->db->where('id', $id);
		return $this->db->update('b2b_users', $data);

	}

	public function save_search_add($loged_in_userid){
		$data = [
			'meta_key' => 'fav_save_search',
			'user_id' => $loged_in_userid,
		];
		$this->db->set($data);
		$this->db->insert('b2b_user_meta');
		return "fav_search_added";
	}

	public function fav_add($listing_id, $loged_in_userid)
	{

		$data = [
			'meta_key' => 'fav_add_dashboard',
			'meta_value' => $listing_id,
			'user_id' => $loged_in_userid,
		];

		$this->db->set($data);

		$this->db->insert(
			'b2b_user_meta'
		);

		return "fav_added";

	}

	public function follow_add($listing_id, $loged_in_userid)
	{
		$data = [
			'meta_key' => 'follow_add_dashboard',
			'meta_value' => $listing_id,
			'user_id' => $loged_in_userid,
		];
		
		$this->db->set($data);

		$this->db->insert('b2b_user_meta');
		
		return "follow_added";

	}

	public function remove_fav_add($listing_id, $loged_in_userid)
	{

		$delete = $this->db->delete('b2b_user_meta', ['user_id' => $loged_in_userid, 'meta_key' => 'fav_add_dashboard', 'meta_value' => $listing_id,]);
		if($delete){
			return "fav_removed";
		}else{
			return "fav_Not_removed";
		}
		
	}

	public function remove_follow_add($listing_id, $loged_in_userid)
	{

		$this->db->delete('b2b_user_meta', ['user_id' => $loged_in_userid, 'meta_key' => 'follow_add_dashboard', 'meta_value' => $listing_id,]);
		return "follow_removed";
	}
	public function remove_save_search_add($loged_in_userid)
	{

		$this->db->delete('b2b_user_meta', ['user_id' => $loged_in_userid, 'meta_key' => 'fav_save_search']);
		return "fav_save_search_removed";
	}

	public function listing_delete($listing_id)
	{

		/*$this->db->delete('listings_meta', ['listings_id' => $listing_id,]);
		$this->db->delete('listings', ['id' => $listing_id,]);*/
		$this->db->delete('listings_new', ['id' => $listing_id,]);
		return true;
	}

	public function get_save_listing_ids($loged_in_userid,$page, $limit = 10,$parent_cat='',$search_query='')   
	{
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if($page > 1){
		$offset = ($page - 1) * $limit;	
		}else{
		$offset = 0;	
		}
		
		$this->db->select('id , user_id , meta_key , meta_value');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id','desc');
		$this->db->where('meta_key', 'fav_add_dashboard');
		$this->db->where('user_id', $loged_in_userid);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$fav_adds = $query->result();
		
		$ids_of_listings = [];

		foreach ($fav_adds as $key => $single_fav_id) {
			$cache_key = get_save_favourite_listing_id_cache_key($single_fav_id->meta_value,$search_query);
			$this->db->select('id');
			$this->db->from('listings_new');
			$this->db->where('id', $single_fav_id->meta_value);
			if(!empty($parent_cat)){
				$this->db->where('category_id', $parent_cat);
			}
			if(!empty($search_query)){
				$where = "(title Like '%{$search_query}%' OR description Like '%{$search_query}%')";
				$this->db->where($where);
			}
			
			$query = $this->db->get();
			$check = $query->result();

			if($check){
				if(!in_array($single_fav_id->meta_value, $ids_of_listings))
				$ids_of_listings[] = $single_fav_id->meta_value;
			}
		}
		return $ids_of_listings;
	}

	public function get_saved_listings($ids)
	{
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$newarray = [];
		$metas = [];
		$count = 0;
		foreach ($ids as $id) {
			

			$this->db->select('id,title,country_id,state_id,city_id,description,category_id,sub_category_id,slug,meta_values,listing_type');
			$this->db->from('listings_new');
			$this->db->order_by('id');
			$this->db->where('id', $id);
			$query = $this->db->get();
			//$fav_add = $query->result();
			$fav_add = $query->result();

			if(!empty($fav_add)){
			$fav_adds[] = $fav_add;	
			}
			
			if (!empty($fav_adds)) {

				$meta_values = json_decode($fav_add[0]->meta_values,true);

				$ads_meta = array();
				foreach ($meta_values as $k=>$v){
                    $ads_meta[] = (object)array(
                      'id'=>$fav_add[0]->id,
                      'listings_id'=>$fav_add[0]->id,
                      'meta_key'=>$k,
                      'meta_value'=>$v,
                    );
                }


				$metas[] = $ads_meta;
				/*
                 *
                 * for city name
                 * */

				$this->db->select('name');
				$this->db->from('b2b_cities');
				$this->db->where('id', $fav_adds[$count][0]->city_id);
				$cityname = $this->db->get();
				$result = $cityname->result();

				if (isset($result[0]->name)) {
					$cityname = $result[0]->name;
				} else {
					$cityname = "";
				}

				/*
                 * for country name
                 *
                 * */

				//$this->db->cache_on();
				$this->db->select('name');
				$this->db->from('b2b_countries');
				$this->db->where('id', $fav_adds[$count][0]->country_id);
				$ccountryname = $this->db->get();
				$result = $ccountryname->result();


				if (isset($result[0]->name)) {
					$ccountryname = $result[0]->name;
				} else {
					$ccountryname = '';
				}


				/*
                 * for state name
                 *
                 * */

				$this->db->select('name');
				$this->db->from('b2b_states');
				$this->db->where('id', $fav_adds[$count][0]->state_id);
				$statename = $this->db->get();
				$result = $statename->result();

				if (isset($result[0]->name)) {
					$statename = $result[0]->name;
				} else {
					$statename = '';
				}



				/*
                 * Category Name
                 *
                 * */

				$this->db->select('name');
				$this->db->from('categories');
				$this->db->where('id', $fav_adds[$count][0]->category_id);
				$catname = $this->db->get();
				$result = $catname->result();

				if (isset($result[0]->name)) {
					$catname = $result[0]->name;
				} else {
					$catname = "";
				}


				/*
             * Sub Category Name
             *
             * */

				//$this->db->cache_on();
				$this->db->select('name');
				$this->db->from('categories');
				$this->db->where('id', $fav_adds[$count][0]->sub_category_id);
				$subcatname = $this->db->get();
				$result = $subcatname->result();

				if (isset($result[0]->name)) {
					$subcatname = $result[0]->name;
				} else {
					$subcatname = "";
				}

				
				$fav_adds['lisitng_detial'][] = [
					'id' => $fav_adds[$count][0]->id,
					'title' => $fav_adds[$count][0]->title,
					'country_id' => $fav_adds[$count][0]->country_id,
					'description' => $fav_adds[$count][0]->description,
					'state_id' => $fav_adds[$count][0]->state_id,
					'city_id' => $fav_adds[$count][0]->city_id,
					'city_name' => $cityname,
					'country_name' => $ccountryname,
					'state_name' => $statename,
					'cat_name' => $catname,
					'sub_cat_name' => $subcatname,
					'category_id' => $fav_adds[$count][0]->category_id,
					'sub_category_id' => $fav_adds[$count][0]->sub_category_id,
					'slug' => $fav_adds[$count][0]->slug,

					'metas' => $metas[$count],
				];
				$count++;
			}

		}

		return $fav_adds['lisitng_detial'];


	}

	public function get_user_listing($id,$page, $limit,$parent_cat='',$status='',$search_query='', $cityname= '', $statename= '')
	{

		if($page > 1){
		$offset = ($page - 1) * $limit;	
		}else{
		$offset = 0;	
		}
		$this->db->select('id,title,country_id,description,state_id,city_id,category_id,sub_category_id,slug,created_at,status,,meta_values,listing_type, (SELECT COUNT(id) FROM listing_views WHERE listing_views.listing_id = listings_new.id) AS views');
		$this->db->from('listings_new');
		$this->db->order_by('id', "desc");
		if(!empty($search_query)){
			$where = "(title Like '%{$search_query}%' OR description Like '%{$search_query}%')";
			$this->db->where($where);
		}
		$this->db->where('uid', $id);
		if(!empty($parent_cat)){
			$this->db->where('category_id', $parent_cat);
		}
		if(!empty($status)){
			$this->db->where('status', $status);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
        //echo $this->db->last_query();exit;
		$myadds = $query->result();


		$this->db->select('id');
		$this->db->from('listings_new');
		$this->db->order_by('id', "desc");
		if(!empty($search_query)){
			$where = "(title Like '%{$search_query}%' OR description Like '%{$search_query}%')";
			$this->db->where($where);
		}
		$this->db->where('uid', $id);
		if(!empty($parent_cat)){
			$this->db->where('category_id', $parent_cat);
		}
		if(!empty($status)){
			$this->db->where('status', $status);
		}
		
		$query1 = $this->db->get();
		$myaddsTotal = $query1->num_rows();
        $metas = array();
		if (!empty($myadds)) {
			$count = 0;
			foreach ($myadds as $single_add) {

                $meta_values = json_decode($single_add->meta_values,true);

                $ads_meta = array();
                foreach ($meta_values as $k=>$v){
                    $ads_meta[] = (object)array(
                        'id'=>$single_add->id,
                        'listings_id'=>$single_add->id,
                        'meta_key'=>$k,
                        'meta_value'=>$v,
                    );
                }


                $metas[] = $ads_meta;
				/*
                 *
                 * for city name
                 * */
				if(!empty($single_add->city_id) && $single_add->city_id != 0){

					$this->db->select('name');
					$this->db->from('b2b_cities');
					$this->db->where('id', $single_add->city_id);
					$cityname = $this->db->get();
					$result = $cityname->result();
					if(!empty($result)){
						$cityname = $result[0]->name;
					}

				}

				/*
                 * for country name
                 *
                 * */
				if(!empty($single_add->country_id) && $single_add->country_id != 0){

					$this->db->select('name');
					$this->db->from('b2b_countries');
					$this->db->where('id', $single_add->country_id);
					$ccountryname = $this->db->get();
					$result = $ccountryname->result();
					$ccountryname = $result[0]->name;
				}
				
				/*
                 * for state name
                 *
                 * */
				if(!empty($single_add->state_id) && $single_add->state_id != 0){

					$this->db->select('name');
					$this->db->from('b2b_states');
					$this->db->where('id', $single_add->state_id);
					$statename = $this->db->get();
					$result = $statename->result();
					$statename = $result[0]->name;

				}
				/*
                 * Category Name
                 *
                 * */
				//$cache_key = 'get_category_name_of_id_'. $single_add->category_id;

				$this->db->select('name');
				$this->db->from('categories');
				$this->db->where('id', $single_add->category_id);
				$catname = $this->db->get();
				$this->db->cache_off();
				$result = $catname->result();
				$catname = $result[0]->name;


				/*
                 * Sub Category Name
                 *
                 * */
				if($single_add->sub_category_id || !empty($single_add->sub_category_id) || $single_add->sub_category_id === 0){

                    $this->db->select('name');
                    $this->db->from('categories');
                    $this->db->where('id', $single_add->sub_category_id);
                    $subcategoryname = $this->db->get();
                    $result = $subcategoryname->result();

                    $subcatname = $result[0]->name;

				}
				$myadds['lisitng_detial'][] = [
					'id' => $single_add->id,
					'title' => $single_add->title,
					'country_id' => $single_add->country_id,
					'description' => $single_add->description,
					'state_id' => $single_add->state_id,
					'city_id' => $single_add->city_id,
					'views' => $single_add->views,
					'city_name' => $cityname,
					'country_name' => $ccountryname,
					'state_name' => $statename,
					'cat_name' => $catname,
					'sub_cat_name' => $subcatname,
					'category_id' => $single_add->category_id,
					'sub_category_id' => $single_add->sub_category_id,
					'slug' => $single_add->slug,
					'created_at' => $single_add->created_at,
					'status' => $single_add->status,
					'metas' => $metas[$count],
				];

				$count++;
			}
			
			$ads = [
				'lisitng_detial' => $myadds['lisitng_detial'],
				'total_ads_count' => $myaddsTotal	
			];
			return $ads;
		}

	}


	public function get_user_approve_listing($id)
	{
		$this->db->select('*');
		$this->db->from('listings');
		$this->db->order_by('id');
		$this->db->where('uid', $id);
		$this->db->where('status', 'enabled');
		$query = $this->db->get();

		$myadds = $query->result();
		return $myadds;
	}


	public function save_search($user_id, $meta_value)
	{
		if(!empty($meta_value)){
			$data = array(
				'user_id' => $user_id,
				'meta_key' => 'save_search',
				'meta_value' => $meta_value
			);

			$this->db->insert('b2b_user_meta', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;

		}
	}

	public function remove_search_history($id){
		$this->db->delete('listings', ['id' => $id,]);
	}

	public function Uploadimage()
    {
        $target_Folder = $_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/assets/images/';
        $target_Path = $target_Folder . basename($_FILES['file']['name']);
        $savepath = $target_Path . basename($_FILES['file']['name']);

        $file_name = $_FILES['file']['name'];
        if (isset($_FILES['file'])) {
            $check = getimagesize($_FILES['file']["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        $this->upload_to_bucket($target_Path , 'user_profile/'. basename($_FILES['file']['name']));
        unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/assets/images/' . basename($_FILES['file']['name']));
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
			$query = "select * from b2b_user_meta where user_id = {$_POST['userid']} and meta_key = 'profile_image'";
			$result = $this->db->query($query);
			$data = $result->result();
			// var_dump($data);die;
			if($result->num_rows() > 0){
				$this->db->delete('b2b_user_meta', array('user_id' => $_POST['userid'],'meta_key' => 'profile_image'));
			}
			
			$insert =   [
				'user_id' => $_POST['userid'],
				'meta_key' => 'profile_image',
				'meta_value' => $file_name
			];
			
			$this->db->set($insert);
			$this->db->insert('b2b_user_meta');
            // Move the file into UPLOAD folder
            move_uploaded_file($_FILES['file']['tmp_name'], $target_Path);
        }

	}
	

	public function del_my_ads($ids){
		$count = 0;
		if(!empty($ids)){
			foreach($ids as $id){
				$this->db->where("id", $id);
				$lisings = $this->db->delete('listings_new');
				/*if($lisings){
					// meta del
					$this->db->where("listings_id", $id);
					$this->db->delete('listings_meta');
					$count++;
				}*/

			}
		}
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
    public function get_saved_listings_counts($loged_in_userid){
		$this->db->select('id');
		$this->db->from('b2b_user_meta');
		$this->db->order_by('id','desc');
		$this->db->where('meta_key', 'fav_add_dashboard');
		$this->db->where('user_id', $loged_in_userid);
		$query1 = $this->db->get();
		$myaddsTotal = $query1->num_rows();
		return $myaddsTotal;
	}
    
    private function upload_to_bucket($source, $destination){
        $accessKeyId = "LTAI4Fk9Aprhpyv3CQr1VEZY";
        $accessKeySecret = "chSkxoFoS2wKVdDYfpqjY64PU4fKvJ";
        // This example uses endpoint China (Hangzhou). Specify the actual endpoint based on your requirements.
        $endpoint = "http://oss-me-east-1.aliyuncs.com";
        // Bucket name
        $bucket= "volgopoint";
        // Object name

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $response = $ossClient->putObject($bucket, $destination, file_get_contents($source));
            return $response;
        } catch (OssException $e) {
            print $e->getMessage();
        }
    }
}
