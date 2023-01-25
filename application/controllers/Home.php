<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Listings_Model');
		$this->load->model('Blocks_Model');
		$this->load->model('Categories_Model');
		$this->load->model('Adbanner_Model');
		$this->load->model('Listingfilterquery_Model');
		$this->load->model('Seo_Model');
        $this->load->library('pagination');
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	public function index_old()
	{
        /*$end_time = microtime(true);
        $execution_time = ($end_time - $GLOBALS['start']);

        echo " Execution time of script = ".$execution_time." sec";*/
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
		if (isset($_GET['s'])) {
			$split = explode("-", $_GET['s']);
            $city = end($split);
            $string = explode("in", $_GET['s']);
            $cat_slug = rtrim($string[0], "-");

            $cat_id = volgo_get_category_id_by_slug($cat_slug);
            
            $city_id = volgo_db_city_id_by_city_name($city);
            $page = $this->input->get('per_page', TRUE);
			if (! isset($page)) {
				$page = 1;
			}

	 		$per_page_limit = 10;
            $listings = $this->Listings_Model->search_by_city($cat_id, $city_id, $page, $per_page_limit);
            $totalcounts = $listings['total_record'];

			unset ($listings['total_record']);

		    $settings = $this->config->item('pagination');
		    $settings['page_query_string'] = TRUE;
    	    $settings["base_url"] = base_url('?').http_build_query(array_merge($_GET));
		    $settings["total_rows"] = $totalcounts;
		    $settings["per_page"] = $per_page_limit;
		    $settings['display_pages'] = TRUE;
		    $settings["page_query_string"] = TRUE;
		    $settings['use_page_numbers'] = TRUE;
 
		    $this->pagination->initialize($settings);

			$str_links = $this->pagination->create_links();
			$total_count_row = '';
			$loged_in_user_id = volgo_get_logged_in_user_id();
			if (!empty($loged_in_user_id)) {
				$loged_in_user_id = $loged_in_user_id;
			} else {
				$loged_in_user_id = "nologedin";
			}
			$data = [
				'sub_childs_cats' => $total_count_row,
				'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
				'listing_by_cat_featured' => $listings,
				'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
				'cat_namelisting_by_cat_id_recommended' => '',
				'total_add' => $totalcounts,
				'parent_cat_name' => isset($parent_name) ?$parent_name : '',
				'cat_name' => $cat_name,
				'cat_id' => volgo_get_category_id_by_slug($cat_name),
				'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
				'listing_save_search' => $this->Listings_Model->get_save_search($loged_in_user_id),
                'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
				'newest_to_old' => $this->Listings_Model->get_latest_listings(),
				'search_query' => $search_query
				
			];


			if (isset($str_links))
				$data["links"] = explode('&nbsp;', $str_links);

			return $this->load->view('frontend/listing_page/default-listing', $data);
        }
        //$start_time = microtime(true);
		$listings = $this->Listings_Model->get_listings(18);
        //echo $this->db->last_query();exit;

		$single_tradeshow_merg = $this->Listings_Model->letest_trade_show();


        // Calculate script execution time

		// get trade show
		$new_arr = [];
		$final_arr = $this->get_tradeshow_arr($single_tradeshow_merg, $new_arr);


		$data = [
			//'footer_block' => $this->Blocks_Model->get_block('footer_block'),
			'listings' => $listings,
			'buying_and_seller_leads'	=> $this->Listings_Model->get_listings(6, ['buying_lead','seller_lead']),
			'new_listings' => $this->Listings_Model->get_latest_listings(5),
			'ad_banners'	=> $this->Adbanner_Model->get_rightside_banners(2),
			'all_counts_result' => $this->Listings_Model->counts_reults(),
			'trade_shows' => $final_arr,
			'metas_trade_show' => $new_arr,
            'all_currencies' => $this->Listings_Model->get_all_currencies()
		];

        //$data['exe_time'] = $execution_time;
		$this->load->view('frontend/index', $data);
	}

    public function index()
    {
        //ini_set('display_errors', 1);
       // ini_set('display_startup_errors', 1);
       // error_reporting(E_ALL);
        $country_id = volgo_get_country_id_from_session();
        if (isset($_GET['s'])) {
            $split = explode("-", $_GET['s']);
            $city = end($split);
            $string = explode("in", $_GET['s']);
            $cat_slug = rtrim($string[0], "-");

            $cat_id = volgo_get_category_id_by_slug($cat_slug);

            $city_id = volgo_db_city_id_by_city_name($city);
            $page = $this->input->get('per_page', TRUE);
            if (! isset($page)) {
                $page = 1;
            }

            $per_page_limit = 10;
            $listings = $this->Listings_Model->search_by_city($cat_id, $city_id, $page, $per_page_limit);
            $totalcounts = $listings['total_record'];

            unset ($listings['total_record']);

            $settings = $this->config->item('pagination');
            $settings['page_query_string'] = TRUE;
            $settings["base_url"] = base_url('?').http_build_query(array_merge($_GET));
            $settings["total_rows"] = $totalcounts;
            $settings["per_page"] = $per_page_limit;
            $settings['display_pages'] = TRUE;
            $settings["page_query_string"] = TRUE;
            $settings['use_page_numbers'] = TRUE;

            $this->pagination->initialize($settings);

            $str_links = $this->pagination->create_links();
            $total_count_row = '';
            $loged_in_user_id = volgo_get_logged_in_user_id();
            if (!empty($loged_in_user_id)) {
                $loged_in_user_id = $loged_in_user_id;
            } else {
                $loged_in_user_id = "nologedin";
            }
            $data = [
                'sub_childs_cats' => $total_count_row,
                'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
                'listing_by_cat_featured' => $listings,
                'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
                'cat_namelisting_by_cat_id_recommended' => '',
                'total_add' => $totalcounts,
                'parent_cat_name' => isset($parent_name) ?$parent_name : '',
                'cat_name' => $cat_name,
                'cat_id' => volgo_get_category_id_by_slug($cat_name),
                'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
                'listing_save_search' => $this->Listings_Model->get_save_search($loged_in_user_id),
                'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
                'newest_to_old' => $this->Listings_Model->get_latest_listings(),
                'search_query' => $search_query

            ];


            if (isset($str_links))
                $data["links"] = explode('&nbsp;', $str_links);

            return $this->load->view('frontend/listing_page/default-listing', $data);
        }

        //$start_time = microtime(true);
        $listings = $this->Listings_Model->get_listings(18,['featured','recommended'],$row->id);
        //echo $this->db->last_query();exit;

        $single_tradeshow_merg = $this->Listings_Model->letest_trade_show();


        // Calculate script execution time

        // get trade show
        $new_arr = [];
        $final_arr = $this->get_tradeshow_arr($single_tradeshow_merg, $new_arr);


        $data = [
            //'footer_block' => $this->Blocks_Model->get_block('footer_block'),
            'listings' => $listings,
            'buying_and_seller_leads'	=> $this->Listings_Model->get_listings(6, ['buying_lead','seller_lead'],$row->id),
            'new_listings' => $this->Listings_Model->get_latest_listings(5,$row->id),
            'ad_banners'	=> $this->Adbanner_Model->get_rightside_banners(2),
            'all_counts_result' => $this->Listings_Model->counts_reults($row->id),
            'trade_shows' => $final_arr,
            'metas_trade_show' => $new_arr,
            'all_currencies' => $this->Listings_Model->get_all_currencies()
        ];

        $data['seo_data'] = $this->Seo_Model->get_page_seo('/');

        $this->load->view('frontend/home', $data);
    }
	private function delete_and_create_cache($slug, $listing_type, $category, $country_id)
	{
		// @todo - We need to implement Queues for future in V2
		$this->delete_cache($slug, $listing_type, $category, $country_id);
		$this->create_cache($listing_type, $category, $country_id);
	}
	private function delete_cache($slug, $listing_type, $category, $country_id){

		// Removing Cache
		delete_files((VOLGO_FRONTEND_CACHE_PATH . '/category+' . $slug));

		// parent category object cache
		if (strtolower($listing_type) === 'featured') {
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type. '_limit_10_records_cat_id_' . $category  . '_country_id_' . $country_id ));
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_10_records_cat_id_' .  $category . '_country_id_' . $country_id));
		} else if (strtolower($listing_type) === 'recommended') {
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
		}

		// child category object cache
		if (strtolower($listing_type) === 'featured') {
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_10_records_cat_id_' . $category . '_country_id_' . $country_id));
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_10_records_cat_id_' . $category . '_country_id_' . $country_id));
		} else if (strtolower($listing_type) === 'recommended') {
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
			delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		}
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

	public function ajax__get_states_by_country_id(){
		$posted_data = filter_input_array(INPUT_POST);
        
		if (! $this->input->is_ajax_request() || !isset($posted_data['country_code'])) {
			exit('No direct script access allowed');
		}

		if (! $posted_data['country_code']){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}
		$country_id = volgo_db_country_id_by_country_code($posted_data['country_code']);

		$states_std_arr = volgo_get_states_by_country_id($country_id);
		$states = [];
		foreach ($states_std_arr as $state){
			$states[] = (array) $state;
		}

		// Update User Session
		volgo_update_user_location_by_force($country_id);

		echo json_encode($states);
		exit;
	}

    public function ajax_get_states_by_country_id(){
        $posted_data = filter_input_array(INPUT_POST);

        if (! $this->input->is_ajax_request() || !isset($posted_data['country_code'])) {
            exit('No direct script access allowed');
        }

        if (! $posted_data['country_code']){
            echo json_encode(
                [
                    'status' => 'error'
                ]
            );
            exit;
        }
        $country_id = volgo_db_country_id_by_country_code($posted_data['country_code']);

        $states_std_arr = volgo_get_states_by_country_id($country_id);
        $states = [];
        foreach ($states_std_arr as $state){
            $states[] = (array) $state;
        }

        // Update User Session
        volgo_update_user_location_by_force($country_id);

        echo json_encode($states);
        exit;
    }

	public function ajax__get_child_cats_by_parent_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['parent_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['parent_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$child_cats = $this->Categories_Model->get_child_cats_by_parent_id($posted_data['parent_id']);
		echo json_encode($child_cats);
		exit;

	}

	public function ajax__header_search_form_by_child_cat_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['child_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['child_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$states_std_arr = $this->Categories_Model->get_header_form_by_id($posted_data['child_id']);
		$states = [];
		foreach ($states_std_arr as $state){
			$states[] = (array) $state;
		}
		//$states['status'] = 'success';

		echo json_encode($states);
		exit;
	}

	public function search_by_city()
	{
		$data = [
			'states' => $this->Listings_Model->get_all_states(),
            'cities' => $this->Listings_Model->get_all_cities()
		];
		
		$this->load->view('frontend/search_by_city', $data);
	}

	public function category_by_city()
	{
		$city = $_GET['s'];
		$data = ['city' => $city];
		
		$this->load->view('frontend/categories_by_city', $data);
	}

	public function make_home_json(){

        $country_id = $this->input->get('country_id');
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

            $listings = $this->Listings_Model->get_listings(18,['featured','recommended'],$country->id);


            $single_tradeshow_merg = $this->Listings_Model->letest_trade_show();

            // get trade show
            $new_arr = [];
            $final_arr = $this->get_tradeshow_arr($single_tradeshow_merg, $new_arr);

            $data = [
                //'footer_block' => $this->Blocks_Model->get_block('footer_block'),
                'listings' => $listings,
                'buying_and_seller_leads'	=> $this->Listings_Model->get_listings(6, ['buying_lead','seller_lead'],$country->id),
                'new_listings' => $this->Listings_Model->get_latest_listings(5,$country->id),
                'ad_banners'	=> $this->Adbanner_Model->get_rightside_banners(2),
                'all_counts_result' => $this->Listings_Model->counts_reults($country->id),
                'trade_shows' => $final_arr,
                'metas_trade_show' => $new_arr,
                'all_currencies' => $this->Listings_Model->get_all_currencies()
            ];
            $json = json_encode($data);
            $file = FCPATH."jsons/$country->id.json";
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


        echo 'Data updated successfully.';
        exit;
    }

    public function data_transfer(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
	    $query = "SELECT * FROM listings WHERE transferred = 0";
	    $result = $this->db->query($query);
	    $i = 1;

        foreach ($result->result() as $item) {
            $query2 = "SELECT * FROM listings_meta WHERE listings_id = ".$item->id;
            $result2 = $this->db->query($query2);
            $json = array();
            $data = (array) $item;
            foreach ($result2->result() as $item2) {

                if($item2->meta_key == "listing_type"){
                    $data['listing_type'] = $item2->meta_value;
                }
                $json[$item2->meta_key] = $item2->meta_value;
            }

            $data['meta_values'] = json_encode($json);
            unset($data['transferred']);
            $id = $this->db->insert('listings_new',$data);
            echo '<pre>';
            print_r($this->db->error());
            echo '</pre>';
            $queryUpdate = "UPDATE listings SET transferred = 1 WHERE id = ".$item->id;
            $result3 = $this->db->query($queryUpdate);
            $i++;
	    }

        echo $i;exit;
    }

    public function make_all_countries_home_page_json(){
        set_time_limit ( 0);
	    $countries = $this->db->query('
	        SELECT * 
	        FROM b2b_countries
	    ');

	    foreach($countries->result() as $row){
            //$start_time = microtime(true);
            $listings = $this->Listings_Model->get_listings(18,['featured','recommended'],$row->id);
            //echo $this->db->last_query();exit;

            $single_tradeshow_merg = $this->Listings_Model->letest_trade_show();


            // Calculate script execution time

            // get trade show
            $new_arr = [];
            $final_arr = $this->get_tradeshow_arr($single_tradeshow_merg, $new_arr);


            $data = [
                //'footer_block' => $this->Blocks_Model->get_block('footer_block'),
                'listings' => $listings,
                'buying_and_seller_leads'	=> $this->Listings_Model->get_listings(6, ['buying_lead','seller_lead'],$row->id),
                'new_listings' => $this->Listings_Model->get_latest_listings(5,$row->id),
                'ad_banners'	=> $this->Adbanner_Model->get_rightside_banners(2),
                'all_counts_result' => $this->Listings_Model->counts_reults($row->id),
                'trade_shows' => $final_arr,
                'metas_trade_show' => $new_arr,
                'all_currencies' => $this->Listings_Model->get_all_currencies()
            ];

            $json = json_encode($data);
            $file = FCPATH."jsons/home/$row->id.json";
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

        echo 'Files are updated';
	    exit;

    }

    public function make_all_countries_category_page_json(){
        set_time_limit ( 0);
        $countries = $this->db->query('
	        SELECT * 
	        FROM b2b_countries
	    ');
        $per_page_limit = 10;
        $page = 1;
        $jsonManipulation = (new \application\classes\JsonManipulation());
        foreach($countries->result() as $co){
            $categories = $this->db->query('
                SELECT * 
                FROM categories
                WHERE category_type = "category"
            ');
            foreach($categories->result() as $c){
                $slug = $c->slug;

                $category = $this->Categories_Model->get_category_by_slug($slug);
                $seo_data['title'] = $category->name;
                $seo_data['keywords'] = $category->description;
                $seo_data['description'] = $category->description;
                if($c->parent_ids == 'uncategorised'){
                    $cat_name = $category->slug;
                    $sub_cat_name = $category->p_slug;
                    $cat_id = $category->id;
                    $sub_cat_id = $category->p_id;
                    $parent_cat_name = "";
                }else{
                    $cat_name = $category->p_slug;
                    $sub_cat_name = $category->slug;
                    $cat_id = $category->p_id;
                    $sub_cat_id = $category->id;
                    $parent_cat_name = $category->p_name;
                }
                if (empty($category))
                    redirect('sorry');

                if (isset($sub_cat_id) && !empty($sub_cat_id)) {
                    $cat_id = $sub_cat_id;
                }elseif ($cat_id) {
                    $cat_id = $cat_id;
                }
                $nearby_cat = $cat_id;
                $country_id = $co->id;

                $total_row = $this->Listingquery_Model->record_count_listing($cat_id, $country_id);

                if (is_null($total_row))
                    $total_row = 0;
                $settings = $this->config->item('pagination');
                if (isset($sub_cat_name) && !empty($sub_cat_name)) {
                    $settings["base_url"] = base_url() . $cat_name . '/' . $sub_cat_name . '/' .  $per_page_limit;
                    $settings["uri_segment"] = 4;
                    if (intval($this->uri->segment(4))) {
                        $page = intval(($this->uri->segment(4)));
                    }
                }else{
                    $settings["base_url"] = base_url() . $cat_name . '/' . $per_page_limit;
                    $settings["uri_segment"] = 3;
                    if (intval($this->uri->segment(3))) {
                        $page = intval(($this->uri->segment(3)));
                    }
                }
                $settings["total_rows"] = $total_row;
                $settings["per_page"] = $per_page_limit;

                $settings["reuse_query_string"] = TRUE;

                // get last page number
                $last_page_no = ceil($total_row/$per_page_limit);

                if($last_page_no == $page)
                    $settings['num_links'] = 6;
                $this->pagination->initialize($settings);

                $str_links = $this->pagination->create_links();

                $total_count_row = [];
                $sub_cat_ids = [];
                $sub_childs_cats = $this->Categories_Model->get_child_categories_by_parent_id($cat_id);

                foreach ($sub_childs_cats as $single_id) {
                    $sub_cat_ids[] = $single_id->id;
                    $count = $this->Listingquery_Model->get_total_lstings_counts_by_category_and_country('featured',$single_id->id, $country_id);
                    if (empty($count)) {
                        $total_count_row[] = (object)[
                            'subcat_id' => $single_id->id,
                            'name' => $single_id->name,
                            'slug' => $single_id->slug,
                            'total' => 0,
                        ];
                    } else {
                        $total_count_row[] = (object)[
                            'subcat_id' => $single_id->id,
                            'slug' => $single_id->slug,
                            'name' => $single_id->name,
                            'total' => $count,
                        ];
                    }
                }

                $cat_name = $category->name;
                $parent_name = $category->p_name;


                if (isset($sub_cat_name) && !empty($sub_cat_name)) {
                    $parent_cat_id = $category->p_id;
                }else{
                    $parent_cat_id = $category->id;
                }

                //if($this->input->is_ajax_request()){
                $listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_and_listing_type($cat_id, $per_page_limit, $page, $country_id, 'featured');
                //}
                //$listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_featured($cat_id, $per_page_limit, $page, $country_id, 'featured');

                $listing_by_cat_recommend = $this->Listingquery_Model->listing_by_cat_id_and_listing_type($cat_id, 3, 1, $country_id, 'recommended');

                $makes = array();
                if((intval($cat_id) === 5 || intval($cat_id) === 6) && !isset($_GET['make'])){
                    $makes = $this->Listingquery_Model->listing_makes_count($cat_id, $country_id);
                }
                $models = array();
                if(isset($_GET['make'])){
                    $models = $this->Listingquery_Model->listing_models_count($cat_id, $country_id);
                }
                $new_arr = [];
                foreach ($listing_by_cat_recommend as $row) {

                    $new_arr[$row->id]['listing_details'] = [
                        'id' => $row->id,
                        'uid' => $row->uid,
                        'title' => $row->title,
                        'slug' => $row->slug,
                        'created_at' => $row->created_at,
                        'category_id' => $row->category_id,
                        'category_name' => $row->catgory_name,
                        'listing_meta_id' => $row->listingcatid,
                        'country_name' => $row->country_name,
                        'city_name' => $row->city_name,
                        'subcat_name' => $row->subcategoryname,
                        'state_name' => $row->state_name,
                        'make_id' => $row->make_id,

                    ];
                    foreach (json_decode($row->meta_values,true) as $key => $single_meta) {
                        $new_arr[$row->id]['metas'][] = [
                            'meta_key' =>$key,
                            'meta_value' => $single_meta,
                        ];
                    }
                }
                $new_arr = array_values($new_arr);

                $new_arr2 = [];
                //if($this->input->is_ajax_request()){
                foreach ($listing_by_cat_fetured as $row) {
                    $new_arr2[$row->id]['listing_details'] = [
                        'id' => $row->id,
                        'uid' => $row->uid,
                        'title' => $row->title,
                        'slug' => $row->slug,
                        'created_at' => $row->created_at,
                        'category_id' => $row->category_id,
                        'category_name' => $row->catgory_name,
                        'listing_meta_id' => $row->listingcatid,
                        'country_name' => $row->country_name,
                        'city_name' => $row->city_name,
                        'subcat_name' => $row->subcategoryname,
                        'state_name' => $row->state_name,
                        'make_id' => $row->make_id,

                    ];
                    foreach (json_decode($row->meta_values,true) as $key => $single_meta) {
                        $new_arr2[$row->id]['metas'][] = [
                            'meta_key' =>$key,
                            'meta_value' => $single_meta,
                        ];
                    }
                }
                $new_arr2 = array_values($new_arr2);
                //}
                if (empty($_SERVER['QUERY_STRING'])){
                    $current_search_link = uri_string();
                }else{
                    $current_search_link = uri_string()."?".$_SERVER['QUERY_STRING'];
                }
                $data = [
                    'footer_block' => $this->Blocks_Model->get_block('footer_block'),
                    'sub_childs_cats' => $total_count_row,
                    'total_featured_ads' => $total_row,
                    'total_recommended_ads' => 0,
                    'all_cuntry' => volgo_get_countries(),
                    'listing_by_cat_recommended' => $new_arr,
                    'listing_by_cat_featured' => $new_arr2,
                    'makes' => $makes,
                    'models' => $models,
                    'all_cats' => $jsonManipulation->get_categories(),
                    'parent_cat_name' => $parent_cat_name,
                    'cat_name' => $cat_name,
                    'cat_id' => $cat_id,
                    'sub_categories' => $sub_childs_cats,
                    'sub_cat_ids' => $sub_cat_ids,
                    'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
                    'all_counts_result' => $this->Listings_Model->counts_reults(),
                    'link' => $current_search_link,
                    'loged_in_user_id' => $loged_in_user_id,
                    'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
                    'popular_searches' => $this->Listings_Model->popular_searches($country_id,$nearby_cat),
                    'nearby' => $this->Listings_Model->nearby($country_id,$nearby_cat),
                    'all_currencies' => $this->Listings_Model->get_all_currencies(),
                    'jsonManipulation'=>$jsonManipulation,
                    'per_page_limit'=>$per_page_limit,
                    'page'=>$page,
                    'country_id_1'=>$country_id,
                    'nearby_cat'=>$nearby_cat,
                    'parent_cat_id'=>$parent_cat_id,
                    'parent_name'=>$parent_name,
                    'slug'=>$slug,
                    'seo_data'=>$seo_data,
                ];
                $json = json_encode($data);
                $file = FCPATH."jsons/categories/$c->slug".'_'."$co->id.json";
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



        }

        echo 'Files are updated';
        exit;

    }
}
