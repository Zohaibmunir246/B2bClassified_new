<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

class Categories_Model extends CI_Model
{

	private $tablename = 'categories';
	private $country_info = null;

	public function __construct()
	{
		parent::__construct();

		// Run Explicitly
		volgo_get_user_location();

		$this->country_info = volgo_get_country_info_from_session();
	}

	// public function get_form_by_sub_cat_id($sub_cat_id)
	// {
	// 	$this->db->cache_on();
	// 	$ids = $this->db->select('meta_value')->from('categories_meta')->where('meta_key', 'form_category')->where('categories_id', $sub_cat_id)->limit(1)->get()->row();
	// 	$this->db->cache_off();

	// 	return $ids;
	// }

	public function get_form_by_sub_cat_id($sub_cat_id)
	{
		//$this->db->cache_on();
		$ids = $this->db->select('data')->from('json_data')->where('key', 'dynamic_form')->limit(1)->get()->row();
		//$this->db->cache_off();
		return $ids;
	}

	public function get_main_cats_for_homepage_search()
	{
// 		$this->db->cache_on();

		// get main cats
		$this->db->select('c.id, c.name, c.slug, c.image_icon, c.type');
		$this->db->from($this->tablename . ' as c');
		$this->db->where('c.parent_ids', 'uncategorised');
		$this->db->where('c.category_type', 'category');
		$this->db->where_in('c.name', ['autos', 'property for sale', 'property for rent', 'classified', 'jobs', 'services']);
		$this->db->order_by('c.id', 'asc');

		$main_cats = $this->db->get()->result();

// 		$this->db->cache_off();

		// get child cats
		$main_child_cats = [];
		foreach ($main_cats as $cat){

// 			$this->db->cache_on();
			$this->db->select('c.id, c.name, c.slug, c.image_icon, c.type, c.parent_ids');
			$this->db->from($this->tablename . ' as c');
			$this->db->where('c.parent_ids', intval($cat->id));
			$this->db->where('c.category_type', 'category');

			$child_cats = $this->db->get()->result();
// 			$this->db->cache_off();

			$main_child_cats[] = [
				'parent'	=> $cat,
				'childs'	=> $child_cats
			];
		}

		return $main_child_cats;
	}

	public function get_main_cats_for_dashboard()
	{



		// get main cats
		$this->db->select('c.id, c.name, c.slug, c.image_icon, c.type');
		$this->db->from($this->tablename . ' as c');
		$this->db->where('c.parent_ids', 'uncategorised');
		$this->db->where('c.category_type', 'category');
		// $this->db->where_in('c.name', ['autos', 'property for sale', 'property for rent', 'classified', 'jobs', 'services']);
		$this->db->order_by('c.id', 'asc');

		$main_cats = $this->db->get()->result();


		// get child cats
		$main_child_cats = [];
		foreach ($main_cats as $cat){

			$this->db->select('c.id, c.name, c.slug, c.image_icon, c.type, c.parent_ids');
			$this->db->from($this->tablename . ' as c');
			$this->db->where('c.parent_ids', intval($cat->id));
			$this->db->where('c.category_type', 'category');

			$child_cats = $this->db->get()->result();
			$this->db->cache_off();

			$main_child_cats[] = [
				'parent'	=> $cat,
				'childs'	=> $child_cats
			];
		}

		return $main_child_cats;
	}

	public function get_child_cats_by_parent_id($id, $orderby_column = "", $direction = "")
	{
		$direction = empty($direction) ? 'asc' : $direction;

// 		$this->db->cache_on();
		$this->db->select('id, name,slug');
		$this->db->from($this->tablename);
		$this->db->where('parent_ids', intval($id));

		if (! empty($orderby_column))
			$this->db->order_by($orderby_column, $direction);

		$result = ($this->db->get()->result());
// 		$this->db->cache_off();

		return $result;
	}

	public function get_buying_lead_parent_cats($order_by_column = '', $direction = "")
	{
		$direction = empty($direction) ? 'asc' : $direction;
		if (! empty($order_by_column))
			$order_by = ' order by ' . $order_by_column . ' ' . $direction;
		else
			$order_by = '';

		$query = "select c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug
 				from categories c where c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'buying-lead' limit 1
				) {$order_by}";

// 		$this->db->cache_on();
		$result = $this->db->query($query);
// 		$this->db->cache_off();

		return ($result->result());
	}

	public function get_all_listings_by_cat_slug($slug, $country_id, $type = '', $per_page_limit = 10  , $page = 1)
	{
		// @todo: needs object cache.
		// if we implement object cache then it should be removed at edit time from admin dashboard.

		$this->db->select('id, name');
		$this->db->from($this->tablename);
		$this->db->where('slug', $slug);

		if (!empty($type))
			$this->db->where('category_type', $type);

		$cat_data = $this->db->limit(1)->get()->row();

		if (empty($cat_data))
			return [];


        if (intval($page) < 1)
            $page = 1;

        $limit = $per_page_limit;
        $offset = ($page - 1) * $per_page_limit;

        if ($per_page_limit > 0) {
            $per_page_limit = " limit " . $per_page_limit . " offset " . $offset;
        } else {
            $per_page_limit = "";
        }

        if (intval($limit) < 1)
            $limit = 1;

		// @todo: needs object cache.
		// if we implement object cache then it should be removed at edit time from admin dashboard.

        if(!empty($country_id)){
            $query = "select l.id as listing_id, title, description, slug, created_at, c.name as country_name
					from listings_new l
					  left join b2b_countries c on l.country_id = c.id
					  where l.status = 'enabled' and (l.sub_category_id = {$cat_data->id} OR l.category_id = {$cat_data->id} ) and l.country_id = {$country_id}
					  order by listing_id desc
					{$per_page_limit};";
            $result = $this->db->query($query);
            $listings = $result->result();

            $total_records = "select l.id as listing_id, title, description, slug, created_at, c.name as country_name
					from listings_new l
					  left join b2b_countries c on l.country_id = c.id
					  where l.status = 'enabled' and (l.sub_category_id = {$cat_data->id} OR l.category_id = {$cat_data->id}) and l.country_id = {$country_id}
					  order by listing_id desc
                    ";
            $total_records = $this->db->query($total_records);
            $buying_total_count = $total_records->num_rows();
        }else{
            $query = "select l.id as listing_id, title, description, slug, created_at, c.name as country_name
					from listings_new l
					  left join b2b_countries c on l.country_id = c.id
					  where l.status = 'enabled' and (l.sub_category_id = {$cat_data->id} OR l.category_id = {$cat_data->id} ) 
					  order by listing_id desc
					{$per_page_limit};";
            $result = $this->db->query($query);
            $listings = $result->result();

            $total_records = "select l.id as listing_id, title, description, slug, created_at, c.name as country_name
					from listings_new l
					  left join b2b_countries c on l.country_id = c.id
					  where l.status = 'enabled' and (l.sub_category_id = {$cat_data->id} OR l.category_id = {$cat_data->id}) 
					  order by listing_id desc
                    ";
            $total_records = $this->db->query($total_records);
            $buying_total_count = $total_records->num_rows();
        }


		$arr = [
			'cat_parent' => $cat_data,
			'listings'	=> $listings,
			'total_buying_leads_cont' => $buying_total_count
		];
		return $arr;
	}

	public function get_buying_leads()
	{
		$buying_leads_parents = $this->get_buying_lead_parent_cats('name');
		
		$buying_leads = [];
		foreach ($buying_leads_parents as $buying_leads_parent){
// 			$this->db->cache_on();
			$this->db->select('c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug');
			$this->db->from($this->tablename . ' as c');
			$this->db->where('parent_ids', $buying_leads_parent->cat_id);
			$this->db->order_by('name', 'asc');
			$child_buying_lead = $this->db->get()->result();
// 			$this->db->cache_off();

			$buying_leads[] = [
				'parent_data'	=> $buying_leads_parent,
				'child_data'	=> $child_buying_lead
			];
		}

		return $buying_leads;
	}

	public function get_selling_leads()
	{
		$selling_leads_parents = $this->get_seller_lead_parent_cats('name');

		$selling_leads = [];
		foreach ($selling_leads_parents as $selling_leads_parent){
// 			$this->db->cache_on();
			$this->db->select('c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug');
			$this->db->from($this->tablename . ' as c');
			$this->db->where('parent_ids', $selling_leads_parent->cat_id);
			$this->db->order_by('name', 'asc');
			$child_selling_lead = $this->db->get()->result();
// 			$this->db->cache_off();

			$selling_leads[] = [
				'parent_data'	=> $selling_leads_parent,
				'child_data'	=> $child_selling_lead
			];
		}

		return $selling_leads;
	}

	public function get_seller_lead_parent_cats($order_by_column = '', $direction = "")
	{
		$direction = empty($direction) ? 'asc' : $direction;
		if (! empty($order_by_column))
			$order_by = ' order by ' . $order_by_column . ' ' . $direction;
		else
			$order_by = '';

		$query = "select c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug
 				from categories c where c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'seller-lead' limit 1
				) {$order_by}";

// 		$this->db->cache_on();
		$result = $this->db->query($query);
// 		$this->db->cache_off();
		return ($result->result());
	}

	public function get_parent_categories($order_by_column = '', $direction = "")
	{
		$direction = empty($direction) ? 'asc' : $direction;

// 		$this->db->cache_on();
		$this->db->select('c1.id as cat_id, c1.parent_ids, c1.name as cat_name, c1.image_icon, c1.slug');
		$this->db->from($this->tablename . ' as c1');
		$this->db->where('c1.parent_ids', 'uncategorised');

		if (! empty($order_by_column))
			$this->db->order_by($order_by_column, $direction);

		$query = $this->db->get();
		$result = ($query->result());
// 		$this->db->cache_off();

		return $result;
	}

	public function get_parent_categories_for_add_post($order_by_column = '', $direction = "")
	{
		$direction = empty($direction) ? 'asc' : $direction;

// 		$this->db->cache_on();
		$this->db->select('c1.id as cat_id, c1.parent_ids, c1.name as cat_name, c1.image_icon, c1.slug');
		$this->db->from($this->tablename . ' as c1');
		$this->db->where('c1.parent_ids', 'uncategorised');
		$this->db->where('c1.category_type', 'category');

		if (! empty($order_by_column))
			$this->db->order_by($order_by_column, $direction);

		$query = $this->db->get();
		$result = ($query->result());
// 		$this->db->cache_off();

		return $result;
	}

	public function get_categories_for_header()
	{
		$parent_cats = $this->get_parent_categories();

		$header_cats = [];
		foreach ($parent_cats as $cat){
// 			$this->db->cache_on();
			$this->db->select('c1.id as cat_id, c1.parent_ids, c1.name as cat_name,  c1.image_icon, c1.slug');
			$this->db->from($this->tablename . ' as c1');
			$this->db->where('c1.parent_ids', $cat->cat_id);

			$query = $this->db->get();
// 			$this->db->cache_off();
			$header_cats[] = [
				'parent'	=> $cat,
				'childs'	=> $query->result()
			];
		}
		unset($query);
		unset($cat);
		unset($parent_cats);

		foreach ($header_cats as $header_cat){
			foreach ($header_cat['childs'] as $child_arr){
				// $this->db->cache_on();
				$this->db->select('count(l.id) as count');
				$this->db->from('listings l');
				$this->db->where('l.sub_category_id', intval($child_arr->cat_id));

				$query = $this->db->get();
				// $this->db->cache_off();
				$count = $query->row();
				$child_arr->count = $count->count;
			}
		}
		unset($header_cat);
		unset($child_arr);
		unset($count);
		unset($query);

		return $header_cats;
	}

	public function get_header_form_by_id($id)
	{
// 		$this->db->cache_on();
		$this->db->select('meta_value');
		$this->db->from('categories_meta');
		$this->db->where('categories_id', intval($id));
		$this->db->where('meta_key', 'homepage_category_form_search');
		$this->db->limit(1);

		$result = ($this->db->get()->result());
// 		$this->db->cache_off();

		return $result;

	}

	public function get_category_by_id($id){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $cache_key = 'get_category_by_id_'. $id;
        if (!$result = $this->cache->get($cache_key)) {
		//$this->db->cache_on();
		$this->db->select('name');
		$this->db->from('categories');
		$this->db->where('id', intval($id));
		$this->db->limit(1);

		$result = ($this->db->get()->result());
		//$this->db->cache_off();
		if (IS_CACHE_ON === true)
        $this->cache->save($cache_key, $result, MAX_CACHE_TTL_VALUE); // save for 72 hours
        }
		return $result;
	}

	public function get_country_by_id($id){
// 		$this->db->cache_on();
		$this->db->select('name');
		$this->db->from('b2b_countries');
		$this->db->where('id', intval($id));
		$this->db->limit(1);

		$result = ($this->db->get()->result());
// 		$this->db->cache_off();

		return $result;
	}
	public function get_state_by_id($id){
// 		$this->db->cache_on();
		$this->db->select('name');
		$this->db->from('b2b_states');
		$this->db->where('id', intval($id));
		$this->db->limit(1);

		$result = ($this->db->get()->result());
// 		$this->db->cache_off();

		return $result;
	}

	public function get_city_by_id($id){
// 		$this->db->cache_on();
		$this->db->select('name');
		$this->db->from('b2b_cities');
		$this->db->where('id', intval($id));
		$this->db->limit(1);

		$result = ($this->db->get()->result());
// 		$this->db->cache_off();

		return $result;
	}

	public function is_buying_lead_parent_cat($cat_slug)
	{
		$query = "select c.id as cat_id
 				from categories c where c.slug = '{$cat_slug}' and c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'buying-lead' limit 1
				)";
						
		$result = $this->db->query($query);
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}

	public function is_seller_lead_parent_cat($cat_slug)
	{
		$query = "select c.id as cat_id
 				from categories c where c.slug = '{$cat_slug}' and c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'seller-lead' limit 1
				)";

		$result = $this->db->query($query);
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}

	public function get_category_by_slug($slug){


	    $query = "
	        SELECT c.* ,pc.id p_id,pc.name p_name,pc.slug p_slug,pc.image_icon p_image_icon,pc.type p_type,pc.description p_description
	        FROM categories c
	        LEFT JOIN categories pc
	        ON pc.id = c.parent_ids 
	        WHERE c.slug = '$slug'
	        LIMIT 1
	    ";
	    $result = $this->db->query($query);
	    if($result->num_rows() > 0){
	        return $result->row();
        }else{
	        return false;
        }
    }

    public function get_child_categories_by_parent_id($id){

        $query = "
	        SELECT c.*
	        FROM categories c
	        WHERE c.parent_ids = $id
	    ";
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return array();
        }
    }
}

