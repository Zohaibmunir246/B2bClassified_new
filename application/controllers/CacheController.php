<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'classes/JsonManipulation.php';

class CacheController extends CI_Controller
{
	public function make_listings_meta_cache()
	{
		$ttl = '1209600'; // for 1 month

		$listing_meta_ids = $this->db->query('select listings_id from listings_meta  group by listings_id;');
		$listing_meta_ids = $listing_meta_ids->result();

		foreach ($listing_meta_ids as $meta_id) {
			$meta_data = $this->db->query("SELECT `lm`.`id` as `listing_meta_id`, `lm`.`meta_key`, `lm`.`meta_value`
				FROM `listings_meta` as `lm`
				WHERE `listings_id` = {$meta_id->listings_id}
				ORDER BY `listings_id` DESC");
			$meta_data = $meta_data->result();

			$this->cache->save('listing_meta_' . $meta_id->listings_id, $meta_data, $ttl);
			log_message('info', ($meta_id->listings_id . ' is created'));

			echo PHP_EOL . ' ---- '. PHP_EOL;
			echo 'listing_meta_' . $meta_id->listings_id . ' file is created.';
			echo PHP_EOL . ' ---- '. PHP_EOL;
		}
	}

	public function total_listings()
	{
		$ttl = '1209600'; // for 1 month

		$country_ids = $this->db->query('select distinct id from b2b_countries;');
		$country_ids = $country_ids->result();

		$category_ids = $this->db->query('select distinct id from categories;');
		$category_ids = $category_ids->result();

		foreach ($country_ids as $country_id) {

			foreach ($category_ids as $category_id) {
				$new_db_key = $cache_key = 'country_id_' . $country_id->id . '_cat_id_' . intval($category_id->id) . '__total_count';
				$db_key = 'country_id_' . $country_id->id . '__total_count';


				// Query
				/*$count_meta = $this->db->select('meta_value')
					->from('categories_meta')
					->where('categories_id', intval($category_id->id))
					->where('meta_key', $db_key)
					->limit(1)
					->get()->row();*/

				// @note:
				// - We are giving hardcoded empty array to update the database as well to avoid any conflict.
				// - because we don't write any update call yet to update the database number when a new post is added.
				// - so,
				$count_meta = [];

				// Deleting old key if its present in any case
				$this->db->where("meta_key", $db_key);
				$this->db->delete('categories_meta');

				if (empty($count_meta)) {
					// try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility

					//1) Count Records
					$result = $this->db->query("
								SELECT count(distinct (l.id)) as count
									FROM `listings` as `l`
									  inner join (select listings_id
												  from listings_meta
												  where meta_key = 'listing_type'
														and meta_value in ('recommended', 'featured')) as lm_id on lm_id.listings_id = l.id
									WHERE `l`.`sub_category_id` = {intval($category_id->id)}
										  AND `country_id` = {$country_id->id}
										  AND `status` = 'enabled'
							");

					$count_row = $result->row();
					$count = $count_row->count;

					//2) save into categories meta for next usage. // insert

					$data = [
						'categories_id' => intval($category_id->id),
						'meta_key' => $new_db_key,
						'meta_value' => $count,
						'created_at' => date("Y-m-d H:i:s"),
					];
					$this->db->set($data);

					$this->db->insert(
						'categories_meta'
					);
				} else {
					$count = $count_meta->meta_value;
				}


				// Save Data
				$this->cache->save($cache_key, $count, $ttl);
				log_message('info', ($cache_key. ' is created'));

				echo PHP_EOL . ' ---- '. PHP_EOL;
				echo $cache_key . ' file is created.';
				echo PHP_EOL . ' ---- '. PHP_EOL;
			}
		}
	}

	public function latest_listings_cache()
	{
		$ttl = '1209600'; // for 1 month

		$listing_type = ['featured', 'recommended', 'buying_lead'];

		$country_ids = $this->db->query('select distinct id from b2b_countries;');
		$country_ids = $country_ids->result();

		foreach ($listing_type as $key => $type) {
			foreach ($country_ids as $country_id){
				if ($type === 'buying_lead')
					$limit = 4;
				else if ($type == 'recommended')
					$limit = 3;
				else
					$limit = 9;

				echo PHP_EOL . '------ ' . PHP_EOL;
				echo 'Country ID: ' . $country_id->id . PHP_EOL;
				echo 'Type: ' . $type . PHP_EOL;

				$cache_key = 'listings_ids_of_' . $type . '_listings_' . $limit . '_records_country_id_' . intval($country_id->id);

				// Query
				$listing_ids_query = "select lm.listings_id
									from listings_meta lm
									  left join listings l on l.id = lm.listings_id
									where lm.meta_key
										  = 'listing_type' and lm.meta_value = '{$type}'
									and l.status = 'enabled' and l.country_id = ".intval($country_id->id) ." order by listings_id
									desc limit {$limit};";
				$listings_ids_q = $this->db->query($listing_ids_query);
				$listings_ids = $listings_ids_q->result();

				// Perform operation
				$listing_ids_arr = [];
				foreach ($listings_ids as $value){
					$listing_ids_arr[] = $value->listings_id;
				}
				$listings_ids = implode(',', $listing_ids_arr);

				if (empty($listings_ids))
					$listings_ids = '0';

				// Save Data
				$this->cache->save($cache_key, $listings_ids, $ttl);
				echo PHP_EOL . ' ---- '. PHP_EOL;
				echo $cache_key . ' file is created.' . PHP_EOL;

				$cache_key = 'latest_listings_of_' . $type . '_listings_' . $limit . '_records_country_id_' . intval($country_id->id);

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

				// Save Data
				$this->cache->save($cache_key, $listings, $ttl);


				echo $cache_key . ' file is created.';
				echo PHP_EOL . ' ---- '. PHP_EOL;
			}
		}
	}

	public function create_listings_cache()
	{
		$ttl = '1209600'; // for 1 month

		$listing_type = [ 'recommended' ];

		$country_ids = $this->db->query('select distinct id from b2b_countries;');
		$country_ids = $country_ids->result();

		$category_ids = $this->db->query('select distinct id from categories;');
		$category_ids = $category_ids->result();

		foreach ($listing_type as $type){
			foreach ($country_ids as $country_id){
				foreach ($category_ids as $category_id){
					if ($type === 'recommended')
						$meta_limit = 3;
					else
						$meta_limit = 10;

					// -------------------------------------------------------
					// Rule 1:

					$cache_key = 'listing_ids_of_type_' . $type . '_limit_' . $meta_limit . '_records_cat_id_' . $category_id->id . '_country_id_' . intval($country_id->id);

					// Query
					$query = "select
						distinct lm.listings_id
					from listings_meta lm
						join listings l on l.id = lm.listings_id
					where (
						lm.meta_key = 'listing_type' and lm.meta_value  = '".$type."'
					)
					and l.country_id = {$country_id->id} and  l.status = 'enabled' and (l.category_id =  {$category_id->id} or l.sub_category_id = {$category_id->id})
					order by lm.listings_id desc
					limit {$meta_limit}";

					$result_data = $this->db->query($query);

					$ids_arr = $result_data->result();

					$ids = [];
					foreach ($ids_arr as $id_arr){
						$ids[] = $id_arr->listings_id;
					}
					$listing_ids = implode(',', $ids);

					// Save Data
					$this->cache->save($cache_key, $listing_ids, $ttl);

					echo PHP_EOL . '------ ' . PHP_EOL;
					echo 'Country ID: ' . $country_id->id . PHP_EOL;
					echo 'Category ID: ' . $category_id->id . PHP_EOL;
					echo 'Type: ' . $type . PHP_EOL;
					echo PHP_EOL;
					echo $cache_key . ' file is created';


					if(empty($listing_ids))
						$listing_ids = 0;

					// -------------------------------------------------------
					// Rule 2:

					$cache_key = 'listing_data_of_type_' . $type . '_limit_' . $meta_limit . '_records_cat_id_' . $category_id->id . '_country_id_' . intval($country_id->id);


					// Query
					$query_q = "select l.id, l.title , l.created_at , l.category_id, l.sub_category_id ,
						l.country_id , l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
						l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
						cntry.name as country_name, cntry.id as country_id ,
						cites.name as city_name, cites.id as city_id ,
						stats.name as state_name, stats.id as state_id
						from listings l
			
							inner join b2b_countries cntry on cntry.id = l.country_id
							LEFT JOIN b2b_cities cites on cites.id = l.city_id
			
							LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
							LEFT join categories cat on cat.id = l.category_id
							LEFT join b2b_states stats on stats.id = l.state_id
			
						where l.country_id = {$country_id->id} and  l.status = 'enabled' and (l.category_id =  {$category_id->id} or l.sub_category_id = {$category_id->id})
						AND l.id in ({$listing_ids})
						order by l.id desc
						limit {$meta_limit}";

					$result = $this->db->query($query_q);
					$listing_data = $result->result();

					// Save Data
					$this->cache->save($cache_key, $listing_data, $ttl);


					echo PHP_EOL;
					echo $cache_key . ' file is created';
				}
			}
		}
	}

	public function total_count()
	{
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$all_json_cats = $jsonManipulation->get_categories(null);

		$countries = $this->db->select('id')->from('b2b_countries')->get()->result();


		// Categories IDs
		$parent_id = 0;
		$parent_count = 0;
		foreach ($countries as $country){
			$count_array = [];

			foreach ($all_json_cats as $i => $json_cat){
				// cat_id_5
				$total_count_key = 'cat_id_' . $json_cat->id;

				if ($json_cat->parent_ids === 'uncategorised'){
					$parent_id = $json_cat->id;
					$parent_count = 0;
				}

				$query = "Select COUNT(*) as total FROM listings l where l.sub_category_id = {$json_cat->id} and l.status = 'enabled' and l.country_id = {$country->id};";

				$result = $this->db->query($query);
				if (! empty($result->result())){

					$total_count = $result->result();

					$count_array[$total_count_key] = $total_count[0]->total;

					if (intval($json_cat->parent_ids) === intval($parent_id)){
						$parent_count += $total_count[0]->total;
						$count_array['cat_id_'.$parent_id] = $parent_count;
					}
				}
			}

			//country_id_1_count
			$count_key = 'country_id_' . $country->id . '_count';
			$jsonManipulation->add_count($count_array, $count_key);
		}

		echo PHP_EOL . PHP_EOL . 'All Done' . PHP_EOL;
	}

	public function total_featured_count()
	{
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$all_json_cats = $jsonManipulation->get_categories(null);

		$countries = $this->db->select('id')->from('b2b_countries')->get()->result();


		// Categories IDs
		foreach ($countries as $country){
			//country_id_1_count
			$count_key = 'country_id_' . $country->id . '_count';
			$new_arr = [];

			foreach ($all_json_cats as $i => $json_cat){
				$total_count_key = 'cat_id_'.$json_cat->id.'_total_count_featured';

				$query = "select COUNT(distinct lm.listings_id) as total from listings_meta lm
						    inner join listings l on l.id = lm.listings_id
							where lm.meta_key = 'listing_type' 
							and lm.meta_value = 'featured' 
							and l.country_id = {$country->id} 
							and l.status = 'enabled' 
							and l.sub_category_id = {$json_cat->id};";


				$result = $this->db->query($query);
				if (! empty($result->result())){

					$total_count = $result->result();
					/*$json_cat->count->$total_count_key = intval($total_count[0]->total);*/

					$new_arr[$total_count_key] = intval($total_count[0]->total);

					continue;

					if (isset($json_cat->count) && is_object($json_cat->count)) {
						$json_cat->count->$total_count_key = intval($total_count[0]->total);
					} else {
						$json_cat->count = (object) [
							$total_count_key => intval($total_count[0]->total)
						];
					}
				}
			}

			$q = "select * from json_data where `key` = '{$count_key}'";
			$r = $this->db->query($q);

			if (! empty($r->result())){
				$r = $r->result();
				$json_data = $r[0]->data;
				$data = json_decode($json_data);
				if (isset($data[0]))
					$data = (array) $data[0];
				else
					$data = (array) $data;
			}else {
				$data = [];
			}

			$data = array_merge($data, $new_arr);
			//country_id_1_count
			$count_key = 'country_id_' . $country->id . '_count';
			$jsonManipulation->add_count($data, $count_key, false);
		}

		echo PHP_EOL . PHP_EOL . 'All Done' . PHP_EOL;
	}

	public function total_recommended_count()
	{
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$all_json_cats = $jsonManipulation->get_categories(null);

		$countries = $this->db->select('id')->from('b2b_countries')->get()->result();

		// Categories IDs
		foreach ($countries as $country){

			$count_key = 'country_id_' . $country->id . '_count';
			$new_arr = [];

			foreach ($all_json_cats as $i => $json_cat){

				$total_count_key = 'cat_id_'.$json_cat->id.'_total_count_recommended';

				$query = "select COUNT(distinct lm.listings_id) as total from listings_meta lm
						    inner join listings l on l.id = lm.listings_id
							where lm.meta_key = 'listing_type' 
							and lm.meta_value = 'recommended' 
							and l.country_id = {$country->id} 
							and l.status = 'enabled' 
							and l.sub_category_id = {$json_cat->id};";

				$result = $this->db->query($query);
				if (! empty($result->result())){

					$total_count = $result->result();
					/*$json_cat->count->$total_count_key = intval($total_count[0]->total);*/

					$new_arr[$total_count_key] = intval($total_count[0]->total);

					continue;

					if (isset($json_cat->count) && is_object($json_cat->count)) {
						$json_cat->count->$total_count_key = intval($total_count[0]->total);
					} else {
						$json_cat->count = (object) [
							$total_count_key => intval($total_count[0]->total)
						];
					}

				}
			}

			$q = "select * from json_data where `key` = '{$count_key}'";
			$r = $this->db->query($q);

			if (! empty($r->result())){
				$r = $r->result();

				$json_data = $r[0]->data;
				$data = json_decode($json_data);

					$data = (array) $data;
			}else {
				$data = [];
			}

			$data = array_merge($data, $new_arr);

			//country_id_1_count
			$count_key = 'country_id_' . $country->id . '_count';
			$jsonManipulation->add_count($data, $count_key, false);
		}

		echo PHP_EOL . PHP_EOL . 'All Done' . PHP_EOL;
	}

}
