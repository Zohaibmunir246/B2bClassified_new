<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/28/2019
 * Time: 1:38 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->model('Seo_Model');
		$this->load->model('Blocks_Model');

		$this->load->model('Listingquery_Model');
		$this->load->model('Listingfilterquery_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Categories_Model');
		
		$this->load->model('Listings_Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');

	}

	public function show_listing()

	{
        
		$listing = [
			'listing_detail' => $this->Listings_Model->get_listing_by_slug($slug),
			'listing_meta' => $this->Listings_Model->get_listings(),

		];

		$this->load->view('frontend/listing', $listing);
	}


	public function show_by_slug($slug = '')
	{


        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
		$get_data = $this->input->get();

		if (isset($get_data['select_state'])) {
			$state = $get_data['select_state'];
		} else {
			$state = '';
		};
        if (isset($get_data['selected_city'])) {
            $city = $get_data['selected_city'];
        } else {
            $city = '';
        };
		if (isset($get_data['parent_cat_select'])) {
			$parent_cat = $get_data['parent_cat_select'];
		} else {
			$parent_cat = '';
		};
		if (isset($get_data['child_cats'])) {
			$child_cat = $get_data['child_cats'];
		} else {
			$child_cat = '';
		};
		if (isset($get_data['search_query'])) {
			$search_query = $get_data['search_query'];
		} else {
			$search_query = '';
		};

		unset ($get_data['select_state']);
		unset ($get_data['selected_city']);
		unset ($get_data['parent_cat_select']);
		unset ($get_data['child_cats']);
		unset ($get_data['search_query']);

		$metas = $get_data;
		unset($get_data);
		$page = $this->input->get('per_page', TRUE);
		if (isset($page)) {
			$page = $page;
		} else {
			$page = '';
		}

		$jsonManipulation = (new \application\classes\JsonManipulation());
		
        $commentsData = $this->Listings_Model->show_comments();
        
		$total_count_row = [];
		$cat_name = $jsonManipulation->get_parent_cat_name_from_cat_id($parent_cat);	
		$sub_childs_cats = $jsonManipulation->get_sub_cats_by_parent_id($parent_cat);
		
		$country_id = volgo_get_country_info_from_session();
		$country_id = $country_id['country_id'];
		if (isset($country_id)) {
			$country_id = $country_id;
		} else {
			$country_id = 166;
		}

		if (!empty($_SESSION['volgo_user_login_data'])) {
			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

			if (!empty($user_detail)) {

				$loged_in_user_id = $user_detail[0]->id;

			} else {
				$loged_in_user_id = 'nologedin';
			}
		} else {
			$loged_in_user_id = 'nologedin';
		}
		$detail = $this->Listings_Model->get_listing_by_slug($slug);

        $seo_data['title'] = $detail['info']->title;
        $seo_data['keywords'] = $detail['info']->description;
        $seo_data['description'] = $detail['info']->description;
		if(!empty($cat_name)){
			$cat_name = $cat_name;
		}else{
			$cat_name = $detail['info']->category_slug;
		}
		
		$listing = [
			'listing_detail' => $detail,
			'loged_in_user_id' => $loged_in_user_id,
			'sub_childs_cats' => $total_count_row,
			'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
			'cat_name' => $cat_name,
            'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
			'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
			'comments' => $commentsData,
			'nearby' => $this->Listings_Model->nearby($country_id,$detail['info']->category_id),
            'all_currencies' => $this->Listings_Model->get_all_currencies(),
            'seo_data' => $seo_data,
		];
		$related_post_id = $listing['listing_detail']['info']->category_id;
		$next_previous = $listing['listing_detail']['info']->category_id;
		$related_post_current_id = $listing['listing_detail']['info']->listing_id;

		$listing['related_listing'] = $this->Listings_Model->get_autos_related_posts($related_post_current_id, $related_post_id);
		$listing['next_previous_listing'] = $this->Listings_Model->get_next_previous_posts($related_post_current_id, $next_previous);

		$cat_name = volgo_make_slug(strtolower(trim($listing['listing_detail']['info']->category_name)));
		
		$parent_cat_name = $jsonManipulation->get_parent_cat_name_from_cat_id($listing['listing_detail']['info']->category_id);
		$parent_cat_name = volgo_make_slug(strtolower(trim($parent_cat_name)));
		
		$json_category_type = $jsonManipulation->get_category_type_from_cat_slug($cat_name);
		
		/*  Detail Pages */
        //echo $cat_name.'>>>'.$json_category_type;exit;
        /*echo '<pre>';
        print_r($listing);
        exit;*/
        if (isset($_SERVER['HTTP_ALI_CDN_REAL_IP'])){
            $ip = $_SERVER['HTTP_ALI_CDN_REAL_IP'];
        }else {
            $ip = $this->input->ip_address();
        }

        $query = "SELECT * FROM listing_views WHERE ip = '$ip' AND listing_id = ".$detail['info']->listing_id."";
        $result = $this->db->query($query);
        if($result->num_rows() == 0){
            $data['listing_id'] = $detail['info']->listing_id;
            $data['ip'] = $ip;
            $this->db->insert('listing_views',$data);
        }
        $listing['sharing'] = 1;
		if ($cat_name === 'autos' && $json_category_type === 'category') {
			$this->load->view('frontend/listing_detail_pages/listingdetailautos', $listing);
		} else if ($cat_name === 'classified' && $json_category_type === 'category') {
			$this->load->view('frontend/listing_detail_pages/listingdetailclassified', $listing);
		} else if ($cat_name === 'services' && $json_category_type === 'category') {
			$this->load->view('frontend/listing_detail_pages/listingdetailservices', $listing);
		} else if ( ($cat_name === 'property-for-sale' || $cat_name === 'property-for-rent' )  && $json_category_type === 'category')  {
			$listing['parent_cat_id'] = $listing['listing_detail']['info']->category_id;
			$listing['popular_searches'] = $this->Listings_Model->popular_searches($country_id,$detail['info']->category_id);
			$this->load->view('frontend/listing_detail_pages/listingproperty', $listing);
		} else if ($cat_name === 'jobs' && $json_category_type === 'category') {
			$this->load->view('frontend/listing_detail_pages/listingjobs', $listing);
		}else if($cat_name === 'buying-leads' || $parent_cat_name === 'buying-leads' || $cat_name === 'seller-leads' || $parent_cat_name === 'seller-leads'){
		    
			if(!empty($loged_in_user_id)){
				$listing['parent_cat_name'] = $parent_cat_name;
				$listing['user_membership'] = $this->Listings_Model->user_membership_check($loged_in_user_id);
			}
			$this->load->view('frontend/listing_detail_pages/listingleads', $listing);
		}else {
			$this->load->view('frontend/listing_detail_pages/default-listing', $listing);
		}

		// @ todo: Pending
		//		echo '<h1>Write functionality for single page.</h1>';
		//		var_export($listing);
	}
	

	public function buying_leads()
	{
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$data = [
			'buying_leads' => $jsonManipulation->get_buying_leads()
		];

		$country_name = $this->input->get('cc');
		if (!empty($country_name) && !is_null($country_name)) {
			$data ['cc'] = $country_name;
		}

		$this->load->view('frontend/buying-lead/view', $data);
	}

	public function seller_leads()
	{
		$jsonManipulation = (new \application\classes\JsonManipulation());
		
		$data = [
			'selling_leads' => $jsonManipulation->get_seller_leads()
		];

		$country_name = $this->input->get('cc');
		if (!empty($country_name) && !is_null($country_name)) {
			$data ['cc'] = $country_name;
		}

		$this->load->view('frontend/seller-lead/view', $data);
	}

	public function send_reply($id, $slug)
    {
    
        $user_data = $this->Dashboard_Model->get_curent_user_detail_by_id($id);
        
        $value = uri_string();
        $get_slug = explode('/', $value);
        $make_slug = $get_slug[3];
        
        $input_data = filter_input_array(INPUT_POST);
        $buyer_email = $iput_data['email'];
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        
        if ($this->form_validation->run() !== false) {
        
        $data = [
        'validation_errors' => '',
        'success_msg' => '<strong>Congratulation!</strong><br /> Message successfull.',
        'email' => '',
        'name' => '',
        'message' => ''
        ];

        // send verification mail to buyer
        
        $msg = $input_data['message'];
        $emailto = $buyer_email;
        $emailfrom = NEWSLETTER_FROM_EMAIL;
        $subject = 'received your mail to seller |' . SITE_NAME;
        volgo_send_email($msg,$subject,$emailto,$emailfrom,$input_data);
        $this->session->set_flashdata('success_msg', 'Your account has been successfully verified');
        
        
        // send verification mail to seller
        
        // SMTP configuration
        $msg = $input_data['message'];
        $emailto = $user_data[0]->email;
        $emailfrom = NEWSLETTER_FROM_EMAIL;
        $subject = 'Buyer received your email |' . SITE_NAME;
        volgo_send_email($msg,$subject,$emailto,$emailfrom);
        
        $this->session->set_flashdata('success_msg', 'Message Sent Successfully!');
        
        //$this->load->view($slug, $data);

        redirect(base_url() . $make_slug);
        } else {
        $this->session->set_flashdata('error_msg', validation_errors());
        redirect(base_url() . $make_slug);
        }
    }

	public function chat_with_seller($id, $slug)
	{

		$user_data = $this->Listings_Model->seller_send_reply($id);

		foreach ($user_data as $seller_email) {
		}

		$input_data = filter_input_array(INPUT_POST);

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() !== false) {

			$data = [
				'chat_validation_errors' => '',
				'chat_success_msg' => '<strong>Congratulation!</strong><br /> Message successfull.',
				'email' => '',
				'name' => '',
				'message' => ''
			];
			// send verification mail to buyer
				//@todo: redirect email verification page
				$msg = $input_data['message'];
                $emailto = '';
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'received your mail to seller |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom,$input_data,$address_with_name = TRUE);

				$this->session->set_flashdata('chat_success_msg', 'Your account has been successfully verified');

			// send verification mail to seller

				$msg = $input_data['message'];
                $emailto = $seller_email->email;
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'Buyer received your email |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom,$input_data);

				$this->session->set_flashdata('chat_success_msg', 'Message Sent Successfully!');

			//$this->load->view($slug, $data);
			redirect($slug);
		} else {
			$data = [
				'chat_validation_errors' => validation_errors(),
				'chat_success_msg' => '',
			];
			$this->load->view('frontend/listing_page/listingdetail', $data);
		}
	}

	public function index()
	{

		$this->view();

	}

	public function get_state_ajax()
	{


		if (!empty($_POST["country_id"])) {

			$selected_state_id = $this->input->post('country_id');
			$states = $this->Listingfilterquery_Model->get_state_by_id($selected_state_id);


			echo json_encode($states);
			exit();
		}
	}

	public function get_formdb_ajax()
	{
		if (!empty($_POST["subcat_id"])) {

			$selected_subcat_id = $this->input->post('subcat_id');


			$states = $this->Listingfilterquery_Model->get_formdb_by_id($selected_subcat_id);

			echo json_encode($states);
			exit();
		}
	}

	public function get_formdb_ajax2()
	{


		if (!empty($_POST["subcat_id"])) {

			$selected_subcat_id = $this->input->post('subcat_id');


			$states = $this->Listingfilterquery_Model->get_form_db_retrival_advance($selected_subcat_id);

			echo json_encode($states);
			exit();
		}
	}

	public function get_city_ajax()
	{


		if (!empty($_POST["state_id"])) {

			$selected_state_id = $this->input->post('state_id');


			$states = $this->Listingfilterquery_Model->get_city_by_id($selected_state_id);

			echo json_encode($states);
			exit();
		}
	}

	public function get_subchild_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Listingfilterquery_Model->get_child_cat_integrate($selected_parent_id);
			echo json_encode($child_cats);
			exit();
		}
	}

	public function get_ajax_made()
	{


		if (!empty($_POST["subcat_id"])) {

			$selected_sub_cat_id = $_POST["subcat_id"];

			$models = $this->Listingfilterquery_Model->get_make_models($selected_sub_cat_id);


			echo json_encode($models);
			exit();
		}
	}

	public function search()
	{
		//select_country=166
		//&selected_city=5755
		//&make=acura
		//&model=
		//&phone=phone
		//&listedby=
		//&currency_code=PKR
		//&price=
		//&kilometers=kilometers
		//&bodycondition=0
		//&mechanicalcondition=0
		//&color=0
		//&year=
		//&cylinder=0
		//&transmission=0
		//&doors=0
		//&horspower=0
		//&warranty=0
		//&fueltype=0
		//&search_query=

		$get_data = $this->input->get();

		
		$state = isset($get_data['select_state']) ? $get_data['select_state'] : '';
		$city = isset($get_data['selected_city']) ? $get_data['selected_city'] : '';
		$parent_cat = isset($get_data['parent_cat_select']) ? $get_data['parent_cat_select'] : '';
		$child_cat = isset($get_data['child_cats']) ? $get_data['child_cats'] : '';
		$search_query = isset($get_data['search_query']) ? $get_data['search_query'] : '';

		if(isset($child_cat) && !empty($child_cat)){
			$cat_name = $this->Listingquery_Model->get_category_name($child_cat);
			$parent_name = $this->Listingquery_Model->get_category_name($parent_cat);
		}elseif(isset($parent_cat) && !empty($parent_cat)){
			$cat_name = $this->Listingquery_Model->get_category_name($parent_cat);
		}
		
		unset ($get_data['select_state']);
		unset ($get_data['selected_city']);
		unset ($get_data['child_cats']);
		unset ($get_data['search_query']);

		if (!isset($get_data['parent_cat_select'])) {


			$page = $this->input->get('per_page', TRUE);
			if (isset($page)) {
				$page = $page;
			} else {
				$page = '';
			}

			$listings = $this->Listings_Model->header_search($search_query, $page, $per_page_limit = 10);
			
			$totalcounts = $listings['total_record'];

			unset ($listings['total_record']);

		    $settings = $this->config->item('pagination');
		    $settings['page_query_string'] = TRUE;
    	    $settings["base_url"] = base_url('/listing/search?').http_build_query(array_merge($_GET));
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


			$this->load->view('frontend/listing_page/default-listing', $data);
		} else {

			unset ($get_data['parent_cat_select']);
			$page = $this->input->get('per_page', TRUE);
			if (isset($page)) {
				$page = $page;
			} else {
				$page = '';
			}
			$metas = $get_data;

			$listings = $this->Listings_Model->header_advance_search($state, $city, $parent_cat, $child_cat, $search_query, $metas, $page, $per_page_limit = 10);


			$totalcounts = $listings['total_record'];

			unset ($listings['total_record']);

		 	$settings = $this->config->item('pagination');
		    $settings['page_query_string'] = TRUE;
    	    $settings["base_url"] = base_url('/listing/search?').http_build_query(array_merge($_GET));
		    $settings["total_rows"] = $totalcounts;
		    $settings["per_page"] = $per_page_limit;
		    $settings['display_pages'] = TRUE;
		    $settings["page_query_string"] = TRUE;
		    $settings['use_page_numbers'] = TRUE;
 
		    $this->pagination->initialize($settings);

			$str_links = $this->pagination->create_links();
			$total_count_row = '';

			$data = [
				'sub_childs_cats' => $total_count_row,
				'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
				'listing_by_cat_featured' => $listings,
				'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
				'parent_cat_name' => isset($parent_name) ?$parent_name : '',
				'cat_name' => $cat_name,
				'total_add' => $totalcounts
			];

			if (isset($str_links))
				$data["links"] = explode('&nbsp;', $str_links);

			$this->load->view('frontend/listing_page/default-listing', $data);


		}


	}
	// property search
	public function propertysearch(){
		// parse_str($_POST['data'], $get_data);
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
		$get_data = $this->input->get();
		
		$state = isset($get_data['select_state']) ? $get_data['select_state'] : '';
		$parent_cat = isset($get_data['parent_cat_select']) ? $get_data['parent_cat_select'] : '';
		$child_cat = isset($get_data['child_cats']) ? $get_data['child_cats'] : '';
		$search_query = isset($get_data['search_query']) ? $get_data['search_query'] : '';
		
		$cat_id = $parent_cat;
		$cat_id_for = $cat_id;
		// var_dump($nearby_cat);die;
		// countries
		$country_id = volgo_get_country_info_from_session();
		$country_id = $country_id['country_id'];
		if (isset($country_id)) {
			$country_id = $country_id;
		} else {
			$country_id = 166;
		}

		$total_sub_count_row = [];
		$sub_childs_cats = $this->Listingquery_Model->sub_child_cats($cat_id);

		foreach ($sub_childs_cats as $single_id) {
			$elements = $this->Listingquery_Model->get_total_lstings_counts_by_category_and_country('featured',$single_id->id, $country_id);
			if (empty($elements)) {
				$total_sub_count_row[] = (object)[
					'subcat_id' => $single_id->id,
					'name' => $single_id->name,
					'slug' => $single_id->slug,
					'total' => 0,
				];
			} else {
				$total_sub_count_row[] = (object)[
					'subcat_id' => $single_id->id,
					'slug' => $single_id->slug,
					'name' => $single_id->name,
					'total' => $elements,
				];
			}
		}
		if(isset($child_cat) && !empty($child_cat)){
			$cat_name = $this->Listingquery_Model->get_category_name($child_cat);
			$parent_name = $this->Listingquery_Model->get_category_name($cat_id);
		}else{
			$cat_name = $this->Listingquery_Model->get_category_name($cat_id);
		}
		

		// var_dump($cat_name);die;
		if(!empty($get_data)) {
			$page = $this->input->get('per_page', TRUE);
			if (isset($page)) {
				$page = $page;
			} else {
				$page = '';
			}
			$metas = $get_data;



			$listings = $this->Listings_Model->propertysearch($state, $parent_cat, $child_cat, $search_query, $metas, $page, $per_page_limit = 10);
			$totalcounts = $listings['total_record'];

			unset ($listings['total_record']);


			$settings = $this->config->item('pagination');
		    $settings['page_query_string'] = TRUE;
    	    $settings["base_url"] = base_url('/listing/propertysearch?') . http_build_query(array_merge($_GET));
		    $settings["total_rows"] = $totalcounts;
		    $settings["per_page"] = $per_page_limit;
		    $settings['display_pages'] = TRUE;
		    $settings["page_query_string"] = TRUE;
		    $settings['use_page_numbers'] = TRUE;
 
		    $this->pagination->initialize($settings);

			$str_links = $this->pagination->create_links();

			$total_count_row = '';
			
			$recommended_listing_id = [];
			$featured_listing = [];
			if(!isset($listings['result'])){
				foreach ($listings as $row) {
					$cat_id = $row['listing_details']['listing_id'];
					$featured_listing[$cat_id]['listing_details'] = [
						'id' => $row['listing_details']['listing_id'],
						'title' => $row['listing_details']['title'],
						'slug' => $row['listing_details']['slug'],
						'created_at' => $row['listing_details']['created_at'],
						'category_id' => $row['listing_details']['category_id'],
						'category_name' => $row['listing_details']['parent_category'],
						'listing_meta_id' => $row['listing_details']['category_id'],
						'country_name' => $row['listing_details']['country'],
						'city_name' => $row['listing_details']['city_name'],
						'subcat_name' => $row['listing_details']['sub_category'],
						'state_name' => $row['listing_details']['state_name'],
					];
	
					foreach ($row['metas'] as $single_meta) {
						$featured_listing[$cat_id]['metas'][] = [
							'meta_key' => $single_meta['meta_key'],
							'meta_value' => $single_meta['meta_value'],
						];
						if($single_meta['meta_value'] == 'Premium'){
							$recommended_listing_id['listing_id']['id'] = $row['listing_details']['listing_id'];	
						}
					}
				}
			}
			$featured_listing = array_values($featured_listing);

			// var_dump($recommended_listing_id);die;
			$recommended_listing = [];
			if(!empty($recommended_listing_id)){
				foreach($recommended_listing_id['listing_id'] as $recommended){
					foreach ($listings as $row) {
						if($recommended['id'] == $row['listing_details']['listing_id']){
							$cat_id = $row['listing_details']['listing_id'];
							$recommended_listing[$cat_id]['listing_details'] = [
								'id' => $row['listing_details']['listing_id'],
								'title' => $row['listing_details']['title'],
								'slug' => $row['listing_details']['slug'],
								'created_at' => $row['listing_details']['created_at'],
								'category_id' => $row['listing_details']['category_id'],
								'category_name' => $row['listing_details']['parent_category'],
								'listing_meta_id' => $row['listing_details']['category_id'],
								'country_name' => $row['listing_details']['country'],
								'city_name' => $row['listing_details']['city_name'],
								'subcat_name' => $row['listing_details']['sub_category'],
								'state_name' => $row['listing_details']['state_name'],
							];
			
							foreach ($row['metas'] as $single_meta) {
								$recommended_listing[$cat_id]['metas'][] = [
									'meta_key' => $single_meta['meta_key'],
									'meta_value' => $single_meta['meta_value'],
								];
							}
						}
					}
				}
			}
			$recommended_listing = array_values($recommended_listing); 


			$loged_in_user_id = volgo_get_logged_in_user_id();
			

			if (!empty($loged_in_user_id)) {
				$loged_in_user_id = $loged_in_user_id;
				if(isset($get_data)){
					$url = base_url('/listing/propertysearch?') . http_build_query(array_merge($_GET));
					$link = str_replace(base_url(), '', $url);
					$saved_query = $this->Listings_Model->saved_query($loged_in_user_id,$link);
					if($saved_query != 'no'){
						$search_id = $saved_query;
						$saved_querys = 'yes';
					}
				}
			} else {
				$loged_in_user_id = "nologedin";
			}
			if($saved_querys == null){
				$saved_querys = 'no';
			}
			if (empty($_SERVER['QUERY_STRING'])){
			$current_search_link = uri_string();
			}else{
			$current_search_link = uri_string()."?".$_SERVER['QUERY_STRING'];		
			}	

			$data = [
				'footer_block' => $this->Blocks_Model->get_block('footer_block'),
				'sub_childs_cats' => $total_sub_count_row,
				'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
				'listing_by_cat_recommended' => $recommended_listing,
				'listing_by_cat_featured' => $featured_listing,
                'result' => $listings,
				'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
				'parent_cat_name' => isset($parent_name) ?$parent_name : '',
				'cat_name' => $cat_name,
				'parent_cat_id' => $cat_id_for,
			 	'child_cat_id' => $child_cat,
				'total_add' => $totalcounts,
				'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
				'loged_in_user_id' => $loged_in_user_id,
				'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
				'all_cities' => $this->Listings_Model->selected_city_name(isset($get_data['select_state']) ? $get_data['select_state'] : 0),
				'listing_save_search' => $this->Listings_Model->get_save_search($loged_in_user_id),
				'popular_searches' => $this->Listings_Model->popular_searches($country_id,$cat_id_for),
				'nearby' => $this->Listings_Model->nearby($country_id,$cat_id_for),
				'saved_query' => isset($saved_querys) ?$saved_querys : 'no',
				'search_id' => $search_id,
				'link' => $current_search_link,
			];

			if (isset($str_links))
				$data["links"] = explode('&nbsp;', $str_links);


			$this->load->view('frontend/listing_page/listingproperty', $data);
	
		} 
	}


	/*
	 * view function started
	 * */


	public function view_old($cat_name = '', $per_page_limit = 10, $page = 1)
	{
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
        $start_time = microtime(true);
        $jsonManipulation = (new \application\classes\JsonManipulation());
		
		$cat_name = $this->uri->segment(1);
		$cat_id = $jsonManipulation->get_category_id_from_cat_slug($cat_name);

		if (empty($cat_id))
			redirect('sorry');

		if ($this->uri->segment(2) && !is_numeric($this->uri->segment(2))) {
			$sub_cat_name = $this->uri->segment(2);
			$sub_cat_id = $jsonManipulation->get_category_id_from_cat_slug($sub_cat_name);
		}

		if (!empty($sub_cat_id)) {
			$parent_cat_name = $jsonManipulation->get_parent_cat_name_from_cat_id($sub_cat_id[0]->id);
		}else{
			$parent_cat_name = '';
		}
		
		if (isset($sub_cat_id) && !empty($sub_cat_id)) {
		$cat_id = $sub_cat_id;	
		}elseif ($cat_id) {
		$cat_id = $cat_id;
		}
		$nearby_cat = $cat_id;

		$country_id = volgo_get_country_info_from_session();
		$country_id = $country_id['country_id'];
		if (isset($country_id)) {
			$country_id = $country_id;
		} else {
			$country_id = 166;
		}

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
		$sub_childs_cats = $jsonManipulation->get_sub_cats_by_parent_id($cat_id);
		foreach ($sub_childs_cats as $single_id) {
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
		
		$cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
		$parent_name = $jsonManipulation->get_parent_cat_name_from_cat_id($cat_id);
		if (isset($sub_cat_name) && !empty($sub_cat_name)) {
			$parent_cat_id = $jsonManipulation->get_parent_cat_id_from_cat_slug($sub_cat_name);
		}else{
			$parent_cat_id = $jsonManipulation->get_parent_cat_id_from_cat_slug($cat_name);
		}

        if($this->input->is_ajax_request()){
            $listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_featured($cat_id, $per_page_limit, $page, $country_id, 'featured');
        }
		//$listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_featured($cat_id, $per_page_limit, $page, $country_id, 'featured');
		
		$listing_by_cat_recommend = $this->Listingquery_Model->listing_by_cat_id_recommended($cat_id, 3, 1, $country_id, 'recommended');
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
			if (empty($cat_id) || (intval($cat_id) !== $row['lisitng_info']->id)) {
				$cat_id = $row['lisitng_info']->id;
				$new_arr[$cat_id]['listing_details'] = [
					'id' => $row['lisitng_info']->id,
					'uid' => $row['lisitng_info']->uid,
					'title' => $row['lisitng_info']->title,
					'slug' => $row['lisitng_info']->slug,
					'created_at' => $row['lisitng_info']->created_at,
					'category_id' => $row['lisitng_info']->category_id,
					'category_name' => $row['lisitng_info']->catgory_name,
					'listing_meta_id' => $row['lisitng_info']->listingcatid,
					'country_name' => $row['lisitng_info']->country_name,
					'city_name' => $row['lisitng_info']->city_name,
					'subcat_name' => $row['lisitng_info']->subcategoryname,
					'state_name' => $row['lisitng_info']->state_name,

				];
			}
			foreach ($row['meta_info'] as $single_meta) {
				$new_arr[$cat_id]['metas'][] = [
					'meta_key' => $single_meta->meta_key,
					'meta_value' => $single_meta->meta_value,
				];
			}
		}
		$new_arr = array_values($new_arr);
		
		$new_arr2 = [];
        if($this->input->is_ajax_request()){
            foreach ($listing_by_cat_fetured as $row) {
                if (empty($cat_id) || (intval($cat_id) !== $row['lisitng_info']->id)) {
                    $cat_id = $row['lisitng_info']->id;
                    $new_arr2[$cat_id]['listing_details'] = [
                        'id' => $row['lisitng_info']->id,
                        'uid' => $row['lisitng_info']->uid,
                        'title' => $row['lisitng_info']->title,
                        'desc' => $row['lisitng_info']->description,
                        'slug' => $row['lisitng_info']->slug,
                        'make_id' => $row['lisitng_info']->make_id,
                        'model_id' => $row['lisitng_info']->model_id,
                        'created_at' => $row['lisitng_info']->created_at,
                        'category_id' => $row['lisitng_info']->category_id,
                        'category_name' => $row['lisitng_info']->catgory_name,
                        'listing_meta_id' => $row['lisitng_info']->listingcatid,
                        'country_name' => $row['lisitng_info']->country_name,
                        'city_name' => $row['lisitng_info']->city_name,
                        'subcat_name' => $row['lisitng_info']->subcategoryname,
                        'state_name' => $row['lisitng_info']->state_name,
                        'user_email' => isset($row['lisitng_info']->user_email) ? $row['lisitng_info']->user_email : '',
                    ];
                }
                foreach ($row['meta_info'] as $single_meta) {
                    $new_arr2[$cat_id]['metas'][] = [
                        'meta_key' => $single_meta->meta_key,
                        'meta_value' => $single_meta->meta_value,
                    ];
                }
            }
            $new_arr2 = array_values($new_arr2);
        }
		/*foreach ($listing_by_cat_fetured as $row) {
			if (empty($cat_id) || (intval($cat_id) !== $row['lisitng_info']->id)) {
				$cat_id = $row['lisitng_info']->id;
				$new_arr2[$cat_id]['listing_details'] = [
					'id' => $row['lisitng_info']->id,
					'uid' => $row['lisitng_info']->uid,
					'title' => $row['lisitng_info']->title,
					'desc' => $row['lisitng_info']->description,
					'slug' => $row['lisitng_info']->slug,
					'make_id' => $row['lisitng_info']->make_id,
					'model_id' => $row['lisitng_info']->model_id,
					'created_at' => $row['lisitng_info']->created_at,
					'category_id' => $row['lisitng_info']->category_id,
					'category_name' => $row['lisitng_info']->catgory_name,
					'listing_meta_id' => $row['lisitng_info']->listingcatid,
					'country_name' => $row['lisitng_info']->country_name,
					'city_name' => $row['lisitng_info']->city_name,
					'subcat_name' => $row['lisitng_info']->subcategoryname,
					'state_name' => $row['lisitng_info']->state_name,
					'user_email' => isset($row['lisitng_info']->user_email) ? $row['lisitng_info']->user_email : '',
				];
			}
			foreach ($row['meta_info'] as $single_meta) {
				$new_arr2[$cat_id]['metas'][] = [
					'meta_key' => $single_meta->meta_key,
					'meta_value' => $single_meta->meta_value,
				];
			}
		}
		$new_arr2 = array_values($new_arr2);*/
		$loged_in_user_id = volgo_get_logged_in_user_id();
		if (!empty($loged_in_user_id)) {
			$loged_in_user_id = $loged_in_user_id;
			
		} else {
			$loged_in_user_id = "nologedin";
	
		}

		$cat_id = volgo_get_current_category_id();
		$sub_cats = volgo_get_sub_categories_by_parent_cat_id($cat_id);
		$sub_cat_ids = [];
		foreach ($sub_cats as $sub_cat_id){
			$sub_cat_ids[] = $sub_cat_id->id;
		}
		
		if (empty($_SERVER['QUERY_STRING'])){
		$current_search_link = uri_string();
		}else{
		$current_search_link = uri_string()."?".$_SERVER['QUERY_STRING'];		
		}

		$saved_search_value = $this->Listings_Model->get_save_search($loged_in_user_id);

		$data = [
			'footer_block' => $this->Blocks_Model->get_block('footer_block'),
			'sub_childs_cats' => $total_count_row,
			'total_featured_ads' => $total_row,
			'total_recommended_ads' => $total_row1,
			'all_cuntry' => volgo_get_countries(),
			'listing_by_cat_recommended' => $new_arr,
			'listing_by_cat_featured' => $new_arr2,
			'makes' => $makes,
			'models' => $models,
			'all_cats' => $jsonManipulation->get_categories(),
			'parent_cat_name' => $parent_cat_name,
			'cat_name' => $cat_name,
			'cat_id' => $cat_id,
			'sub_categories' => $sub_cats,
			'sub_cat_ids' => $sub_cat_ids,
			'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
            'listing_save_search' => $saved_search_value,
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
		];
        $end_time = microtime(true);

// Calculate script execution time
        $execution_time = ($end_time - $start_time);

        //echo " Execution time of script = ".$execution_time." sec";
        //echo "<pre>";print_r(volgo_make_slug(trim($cat_name)));die;
		$data["links"] = explode('&nbsp;', $str_links);
        if($this->input->is_ajax_request()){
            $html = '';
            if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingautos', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingclassified', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingservices', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
                $data['parent_cat_id'] = $parent_cat_id;
                $data['child_cat_id'] = $nearby_cat;
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingproperty', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingjobs', $data,true);
            } else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
                $this->load->view('frontend/buying-lead/view', $data);
                $html = $this->load->view('frontend/buying-lead/ajax/listing/all', $data,true);
            }else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
                $this->load->view('frontend/seller-lead/view', $data);
                $html = $this->load->view('frontend/seller-lead/ajax/listing/all', $data,true);
            }else{
                $html = $this->load->view('frontend/listing_page/ajax/listing/default-listing', $data,true);
            }
            echo json_encode(['html'=>$html]);
            exit;
        }else{
            if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
                $this->load->view('frontend/listing_page/listingautos', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingclassified', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingservices', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
                $data['parent_cat_id'] = $parent_cat_id;
                $data['child_cat_id'] = $nearby_cat;
                $this->load->view('frontend/listing_page/listingproperty', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingjobs', $data);
            } else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
                $this->load->view('frontend/buying-lead/view', $data);
                $this->load->view('frontend/buying-lead/all', $data);
            }else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
                $this->load->view('frontend/seller-lead/view', $data);
                $this->load->view('frontend/seller-lead/all', $data);
            }else{
                $this->load->view('frontend/listing_page/default-listing', $data);
            }
        }



	}

    public function view($cat_name = '', $per_page_limit = 10, $page = 1)
    {

        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $slug = "";
        if ($this->uri->segment(2) && !is_numeric($this->uri->segment(2))) {
            $slug = $this->uri->segment(2);
        }else{
            $slug = $this->uri->segment(1);
        }
        $category = $this->Categories_Model->get_category_by_slug($slug);

        if ($this->uri->segment(2) && !is_numeric($this->uri->segment(2))) {
            $cat_name = $category->p_slug;
            $sub_cat_name = $category->slug;
            $cat_id = $category->p_id;
            $sub_cat_id = $category->id;
            $parent_cat_name = $category->p_name;
        }else{
            $cat_name = $category->slug;
            $sub_cat_name = $category->p_slug;
            $cat_id = $category->id;
            $sub_cat_id = $category->p_id;
            $parent_cat_name = "";
        }

		$seo_data = $this->Seo_Model->get_page_seo($cat_name, $sub_cat_name);

		$country_id = volgo_get_country_info_from_session();
		$country_id = $country_id['country_id'];
		if (isset($country_id)) {
			$country_id = $country_id;
		} else {
			$country_id = 166;
		}

		$loged_in_user_id = volgo_get_logged_in_user_id();
		if (!empty($loged_in_user_id)) {
			$loged_in_user_id = $loged_in_user_id;

		} else {
			$loged_in_user_id = "nologedin";

		}

            if (empty($category))
                redirect('sorry');

            if (isset($sub_cat_id) && !empty($sub_cat_id)) {
                $cat_id = $sub_cat_id;
            }elseif ($cat_id) {
                $cat_id = $cat_id;
            }
            $nearby_cat = $cat_id;


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






            $saved_search_value = $this->Listings_Model->get_save_search($loged_in_user_id);
            $data["links"] = explode('&nbsp;', $str_links);
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
                'listing_save_search' => $saved_search_value,
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
                'slug'=>$slug
            ];



		$models = array();
		if(isset($_GET['make'])){
			$models = $this->Listingquery_Model->listing_models_count($cat_id, $country_id);
		}
		$data['models'] = $models; 
		$data['seo_data'] = $seo_data;


		// var_dump($data);



        /*if($this->input->is_ajax_request()){
            $html = '';
            if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingautos', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingclassified', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingservices', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
                $data['parent_cat_id'] = $parent_cat_id;
                $data['child_cat_id'] = $nearby_cat;
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingproperty', $data,true);
            } else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $html = $this->load->view('frontend/listing_page/ajax/listing/listingjobs', $data,true);
            } else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
                $this->load->view('frontend/buying-lead/view', $data);
                $html = $this->load->view('frontend/buying-lead/ajax/listing/all', $data,true);
            }else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
                $this->load->view('frontend/seller-lead/view', $data);
                $html = $this->load->view('frontend/seller-lead/ajax/listing/all', $data,true);
            }else{
                $html = $this->load->view('frontend/listing_page/ajax/listing/default-listing', $data,true);
            }
            echo json_encode(['html'=>$html]);
            exit;
        }else{*/
            if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
                $this->load->view('frontend/listing_page/listingautos', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingclassified', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingservices', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
                $data['parent_cat_id'] = $parent_cat_id;
                $data['child_cat_id'] = $nearby_cat;
                $this->load->view('frontend/listing_page/listingproperty', $data);
            } else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
                $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
                $this->load->view('frontend/listing_page/listingjobs', $data);
            } else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
                $this->load->view('frontend/buying-lead/view', $data);
                $this->load->view('frontend/buying-lead/all', $data);
            }else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
                $this->load->view('frontend/seller-lead/view', $data);
                $this->load->view('frontend/seller-lead/all', $data);
            }else{
                $this->load->view('frontend/listing_page/default-listing', $data);
            }
        //}



    }

	public function ajax_listing_load_new(){
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $cat_id = $this->input->get('cat_id');
        $per_page_limit = $this->input->get('per_page_limit');
        $page = $this->input->get('page');
        $country_id = $this->input->get('country_id');
        $total_row = $this->input->get('total_row');
        $cat_name = $this->input->get('cat_name');
        $parent_name = $this->input->get('parent_name');
        $parent_cat_id = $this->input->get('parent_cat_id');
        $nearby_cat = $this->input->get('nearby_cat');
        $listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_featured($cat_id, $per_page_limit, $page, $country_id, 'featured');
        $new_arr2 = [];
        foreach ($listing_by_cat_fetured as $row) {
            if (empty($cat_id) || (intval($cat_id) !== $row['lisitng_info']->id)) {
                $cat_id = $row['lisitng_info']->id;
                $new_arr2[$cat_id]['listing_details'] = [
                    'id' => $row['lisitng_info']->id,
                    'uid' => $row['lisitng_info']->uid,
                    'title' => $row['lisitng_info']->title,
                    'desc' => $row['lisitng_info']->description,
                    'slug' => $row['lisitng_info']->slug,
                    'make_id' => $row['lisitng_info']->make_id,
                    'model_id' => $row['lisitng_info']->model_id,
                    'created_at' => $row['lisitng_info']->created_at,
                    'category_id' => $row['lisitng_info']->category_id,
                    'category_name' => $row['lisitng_info']->catgory_name,
                    'listing_meta_id' => $row['lisitng_info']->listingcatid,
                    'country_name' => $row['lisitng_info']->country_name,
                    'city_name' => $row['lisitng_info']->city_name,
                    'subcat_name' => $row['lisitng_info']->subcategoryname,
                    'state_name' => $row['lisitng_info']->state_name,
                    'user_email' => isset($row['lisitng_info']->user_email) ? $row['lisitng_info']->user_email : '',
                ];
            }
            foreach ($row['meta_info'] as $single_meta) {
                $new_arr2[$cat_id]['metas'][] = [
                    'meta_key' => $single_meta->meta_key,
                    'meta_value' => $single_meta->meta_value,
                ];
            }
        }
        $new_arr2 = array_values($new_arr2);
        $data = [
            'total_featured_ads' => $total_row,
            'all_cuntry' => volgo_get_countries(),
            'listing_by_cat_featured' => $new_arr2,
            'cat_name' => $cat_name,
            'cat_id' => $cat_id,
            'jsonManipulation'=>$jsonManipulation
        ];

        $html = '';
        if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
            $html = $this->load->view('frontend/listing_page/ajax/listing/listingautos', $data,true);
        } else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
            $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
            $html = $this->load->view('frontend/listing_page/ajax/listing/listingclassified', $data,true);
        } else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
            $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
            $html = $this->load->view('frontend/listing_page/ajax/listing/listingservices', $data,true);
        } else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
            $data['parent_cat_id'] = $parent_cat_id;
            $data['child_cat_id'] = $nearby_cat;
            $html = $this->load->view('frontend/listing_page/ajax/listing/listingproperty', $data,true);
        } else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
            $data['total_add'] = '<b>' . number_format(intval($total_row)) . '</b> Featured';
            $html = $this->load->view('frontend/listing_page/ajax/listing/listingjobs', $data,true);
        } else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
            $this->load->view('frontend/buying-lead/view', $data);
            $html = $this->load->view('frontend/buying-lead/ajax/listing/all', $data,true);
        }else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
            $this->load->view('frontend/seller-lead/view', $data);
            $html = $this->load->view('frontend/seller-lead/ajax/listing/all', $data,true);
        }else{
            $html = $this->load->view('frontend/listing_page/ajax/listing/default-listing', $data,true);
        }
        echo json_encode(['html'=>$html]);
        exit;
	}



	// check membership
	public function user_membership_check(){
        $user_id = $_GET['user_id'];
        $listing_id = $_GET['listing_id'];

        if(!empty($user_id)){
            $data = $this->Listings_Model->user_membership_check($user_id);
            if(!empty($data)){
                if(strtotime(date("Y-m-d h:i:sa")) < strtotime("+1 year",strtotime($data[0]->order_date))){
                    if($data[0]->available_connect != 0){
                        $this->Listings_Model->update_connects($data[0]->id,$data[0]->packages_id,$data[0]->available_connect, $listing_id);
                        $response = [
                            'success' => true,
                        ];
                    }else{
                        $response = [
                            'success' => 3,
                            'msg' => '<h5>Your membership connects per day limits has been reached</h5><a href="'.base_url('payment-plans').'" class="btn">Upgrade membership</a>'
                        ];
                    }
                }else{
                    $response = [
                        'success' => 3,
                        'msg' => '<h5>Your membership has been expired</h5><a href="'.base_url('payment-plans').'" class="btn">Re-subscibe membership</a>'
                    ];
                }
            }else{
                $response = [
                    'success' => false,
                    'redirect' => 1,
                ];
            }
        }
        echo json_encode($response);
        exit();
    }

	// reset membership
	public function reset_membership(){
		$this->Listings_Model->reset_membership();
	}

	public function send_cv($listing_user_email)
	{
		if (! volgo_front_is_logged_in())
			redirect('/login');

		if (! $listing_user_email)
			redirect('/');

		$to = volgo_decrypt_message($listing_user_email);

		if (! filter_var($to, FILTER_VALIDATE_EMAIL)) {
			redirect('/');
		}

		$cv_data = volgo_get_logged_in_user_cv_data();

		if (! empty($cv_data)){
			$cv_url = BACKEND_URL . ('uploads/cvs/' . $cv_data->meta_value);

				$msg = "<p>Hi,</p><p>Kindly review my CV for the job.</p><hr /> <p>CV URL: $cv_url</p>";
                $emailto = $to;
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'CV Received |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom);

				$this->session->set_flashdata('cv_sent_success_msg', 'CV has sent!');
                if(volgo_send_email($msg,$subject,$emailto,$emailfrom)){
				    redirect($this->input->get('redirect'));
				} else {
                    redirect($this->input->get('redirect'));
                }
		}
	}

	public function comments($user_id, $post_id, $user_email, $user_name, $user_profile_img, $slug){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $user_profile_img = str_replace('%22',':',str_replace('%21','.',str_replace('%20','/',$user_profile_img)));
        $input_data = filter_input_array(INPUT_POST);
        $email = volgo_decrypt_message($user_email);
        $post_link = $_POST['post_link'];
        if (!empty($input_data)) {

            $this->form_validation->set_rules('comment', 'Comments', 'required');

            if ($this->form_validation->run() !== false) {

                $comments = $this->input->post('comment');

                $is_created = $this->Listings_Model->create_comment(
                    $user_id,$post_id,$email,$comments,$user_name, $user_profile_img
                );

                if ($is_created) {
                    $data = array(
                        'validation_errors' => '',
                        'success_message' => '',
                        'user_id' => $user_id,
                        'post_id' => $post_id,
                        'user_email' => $user_email,
                        'comment' => $comments,
                        'user_name' => $user_name,
                        'user_profile_pic' => $user_profile_img,
                    );

                } else {
                    $this->session->set_flashdata('success_message', 'Thank for comment! will be show after admin approvel. ');
                    redirect(base_url() . $slug);
                }
            } else {
                $this->session->set_flashdata('validation_errors', 'comment field is required!');
                redirect(base_url() . $slug);
            }

        } else {
            $this->session->set_flashdata('validation_errors', 'comment field is required!');
            redirect(base_url() . $slug);
        }
    }
    
    public function contact_buyer(){

        $input_data = filter_input_array(INPUT_POST);

        $sender_email = $input_data['email'];
        $postlink = base_url().$input_data['slug']; 
        $this->form_validation->set_rules('senderemail', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        
        if ($this->form_validation->run() !== false) {
        if (isset($_FILES['myfile']) && !empty($_FILES['myfile']['name'])) {
			$_FILES['userfile']['name'] = $_FILES['myfile']['name'];
			$_FILES['userfile']['type'] = $_FILES['myfile']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['myfile']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['myfile']['error'];
			$_FILES['userfile']['size'] = $_FILES['myfile']['size'];

			$config['allowed_types'] = 'pdf|doc|docx';
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/cvs/';
			$config['max_size'] = '15000000';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload();

			if (!$this->upload->do_upload()) {
				echo json_encode(['upload_errors' => '<strong>Sorry: </strong>  Unable to upload CV. Kindly Try Again.']);
				exit;
			} else {
				$cv_data_info = $this->upload->data();
                //$this->upload_to_bucket($cv_data_info['full_path'] , 'b2bclassified/admin/uploads/listing_images/'. $cv_data_info['file_name']);
				$cv_upload_info = serialize($cv_data_info['file_name']);
				$posted_data['myfile'] = $cv_upload_info;
                //unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
			}
		}	
        $user_data = $this->Dashboard_Model->get_curent_user_detail_by_id($input_data['buyer_id']);
        
        // send verification mail to seller or buyer
        $msg = str_replace('%%name%%', $input_data['name'], CONTACT_EMAIL_BUYER);
        $msg = str_replace('%%email%%', $input_data['senderemail'], $msg);
        $msg = str_replace('%%message%%', $input_data['message'], $msg);
        $msg = str_replace('%%buyer_name%%', $user_data[0]->firstname . ' ' . $user_data[0]->lastname, $msg);
        $msg = str_replace('%%title%%', $input_data['title'], $msg);
        $msg = str_replace('%%postlink%%', $postlink, $msg);
        $emailto = $user_data[0]->email;
        $emailfrom = NEWSLETTER_FROM_EMAIL;
        $subject = 'Buyer Lead Inquiry  |' . SITE_NAME; 
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
			// SMTP configuration
			try {
				$mail->isSMTP();
				$mail->Host = PHPMAILER_SENDER_HOST;
				$mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
				$mail->Username = PHPMAILER_SENDER_USERNAME;
				$mail->Password = PHPMAILER_SENDER_PASSWORD;
				$mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
				$mail->Port = PHPMAILER_SENDER_PORT;

                $mail->setFrom($emailfrom);
            	
            	// Email subject
                $mail->Subject = $subject;
                // Set email format to HTML
                $mail->isHTML(true);
                $mail->addAddress($emailto);
                $mail->Body = $msg;
                $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
				$mail->send();

				} catch (Exception $e) {
					log_message('error', $mail->ErrorInfo);
					redirect(404);
					return false;
				}
			unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);	
        echo json_encode(['success_msg'=> 'Message Sent Successfully!']);
		exit;

		} else {
			echo json_encode(['error_msg'=>validation_errors()]);
			exit;
		}
    }

    public function contact_seller(){

        $input_data = filter_input_array(INPUT_POST);

        $sender_email = $input_data['ssenderemail'];
        $postlink = base_url().$input_data['slug']; 
        $this->form_validation->set_rules('ssenderemail', 'Email', 'required');
        $this->form_validation->set_rules('sname', 'Name', 'required');
        $this->form_validation->set_rules('smessage', 'Message', 'required');
        
        if ($this->form_validation->run() !== false) {

        $user_data = $this->Dashboard_Model->get_curent_user_detail_by_id($input_data['seller_id']);
        // send verification mail to seller or buyer
        $msg = str_replace('%%name%%', $input_data['sname'], CONTACT_EMAIL_SELLER);
        $msg = str_replace('%%email%%', $input_data['ssenderemail'], $msg);
        $msg = str_replace('%%phone%%', $input_data['senderphone'], $msg);
        $msg = str_replace('%%message%%', $input_data['smessage'], $msg);
        $msg = str_replace('%%seller_name%%', $user_data[0]->firstname . ' ' . $user_data[0]->lastname, $msg);
        $msg = str_replace('%%title%%', $input_data['title'], $msg);
        $msg = str_replace('%%postlink%%', $postlink, $msg);
        $emailto = $user_data[0]->email;
        $emailfrom = NEWSLETTER_FROM_EMAIL;
        $subject = 'Seller Lead Inquiry |' . SITE_NAME;
        volgo_send_email($msg,$subject,$emailto,$emailfrom);
        echo json_encode(['success_msg'=> 'Message Sent Successfully!']);
		exit;

		} else {
			echo json_encode(['error_msg'=>validation_errors()]);
			exit;
		}
    }

} 
