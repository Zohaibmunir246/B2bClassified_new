<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/28/2019
 * Time: 1:38 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'classes/JsonManipulation.php';

class MobileListing extends CI_Controller
{
	public static $jsonManipulation = null;

	public function __construct()
	{
		parent::__construct();


		$this->load->model('Blocks_Model');

		$this->load->model('Listingquery_Model');
		$this->load->model('Listingfilterquery_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Categories_Model');

		$this->load->model('Listings_Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
        $this->load->library('user_agent');

		self::$jsonManipulation = (new \application\classes\JsonManipulation());

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
            'all_currencies' => $this->Listings_Model->get_all_currencies()
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

        /*  Detail Pages */
        if ($cat_name === 'autos') {
            $this->load->view('frontend-mobile/listing_detail_pages/listingdetailautos', $listing);
        } else if ($cat_name === 'classified') {
            $this->load->view('frontend-mobile/listing_detail_pages/listingdetailclassified', $listing);
        } else if ($cat_name === 'services') {
            $this->load->view('frontend-mobile/listing_detail_pages/listingdetailservices', $listing);
        } else if ($cat_name === 'property-for-sale' || $cat_name === 'property-for-rent')  {
            $listing['parent_cat_id'] = $listing['listing_detail']['info']->category_id;
            $listing['popular_searches'] = $this->Listings_Model->popular_searches($country_id,$detail['info']->category_id);
            $this->load->view('frontend-mobile/listing_detail_pages/listingproperty', $listing);
        } else if ($cat_name === 'jobs' || $cat_name === 'jobs-wanted') {
            $this->load->view('frontend-mobile/listing_detail_pages/listingjobs', $listing);
        }else if($cat_name === 'buying-leads' || $parent_cat_name === 'buying-leads' || $cat_name === 'seller-leads' || $parent_cat_name === 'seller-leads'){
            if(!empty($loged_in_user_id)){
                $listing['parent_cat_name'] = $parent_cat_name;
                $listing['user_membership'] = $this->Listings_Model->user_membership_check($loged_in_user_id);
            }
            $this->load->view('frontend-mobile/listing_detail_pages/listingleads', $listing);
        }else {
            $this->load->view('frontend-mobile/listing_detail_pages/default-listing', $listing);
        }

		// @ todo: Pending
		//		echo '<h1>Write functionality for single page.</h1>';
		//		var_export($listing);
	}

	public function buying_leads()
	{
		$data = [
			'buying_leads' => $this->Categories_Model->get_child_cats_by_parent_id($cat_id = 130)
		];

		$country_name = $this->input->get('cc');
		if (!empty($country_name) && !is_null($country_name)) {
			$data ['cc'] = $country_name;
		}

		$this->load->view('frontend-mobile/buying-lead/view', $data);
	}

	public function seller_leads()
	{
		$data = [
			'selling_leads' => $this->Categories_Model->get_child_cats_by_parent_id($cat_id = 131)
		];

		$country_name = $this->input->get('cc');
		if (!empty($country_name) && !is_null($country_name)) {
			$data ['cc'] = $country_name;
		}

		$this->load->view('frontend-mobile/seller-lead/view', $data);
	}

	public function send_cv($listing_user_email = '')
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
			$cv_url = base_url('uploads/cv/' . $cv_data->meta_value);

			// SMTP configuration
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
   public function send_reply()
	{
		$input_data = filter_input_array(INPUT_POST);

		$id = $iput_data['listing_id'];
		$user_data = $this->Dashboard_Model->get_curent_user_detail_by_id($id);

		$sender_email = $iput_data['email'];
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
		$emailto = $sender_email;
		$emailfrom = NEWSLETTER_FROM_EMAIL;
		$subject = 'received your mail to seller |' . SITE_NAME;
		volgo_send_email($msg,$subject,$emailto,$emailfrom,$input_data);
		$this->session->set_flashdata('success_msg', 'Your account has been successfully verified');

		// SMTP configuration
		$msg = $input_data['message'];
		$emailto = $user_data[0]->email;
		$emailfrom = NEWSLETTER_FROM_EMAIL;
		$subject = 'Buyer received your email |' . SITE_NAME;
		volgo_send_email($msg,$subject,$emailto,$emailfrom);

		echo json_encode(['success_msg'=> 'Message Sent Successfully!']);
        exit;
		} else {
		echo json_encode(['error_msg'=>validation_errors()]);
        exit;
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

				$msg = $input_data['message'];
                $emailto = '';
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'received your mail to seller |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom,$input_data);

				$this->session->set_flashdata('chat_success_msg', 'Your account has been successfully verified');

			// send verification mail to seller

				$msg = $input_data['message'];
                $emailto = $seller_email->email;
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'Buyer received your email |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom);

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

		$get_data = $this->input->get();

        $counrty = isset($get_data['country_search']) ? $get_data['country_search'] : '';
		$state = isset($get_data['select_state']) ? $get_data['select_state'] : '';
        $city = isset($get_data['selected_city']) ? $get_data['selected_city'] : '';
		$parent_cat = isset($get_data['parent_cat_select']) ? $get_data['parent_cat_select'] : '';
		$child_cat = isset($get_data['child_cats']) ? $get_data['child_cats'] : '';
		$child_sub_cats = isset($get_data['child_sub_cats']) ? $get_data['child_sub_cats'] : '';
		$search_query = isset($get_data['search_query']) ? $get_data['search_query'] : '';

        // try more
        if (empty($child_cat)){
            $child_cat = isset($get_data['sub_category']) ? $get_data['sub_category'] : '';
        }

		if(isset($child_cat) && !empty($child_cat)){
			$cat_name = $this->Listingquery_Model->get_category_name($child_cat);
			$parent_name = $this->Listingquery_Model->get_category_name($parent_cat);
		}else{
			$cat_name = $this->Listingquery_Model->get_category_name($parent_cat);
		}

        unset ($get_data['country_search']);
        unset ($get_data['select_state']);
        unset ($get_data['selected_city']);
        unset ($get_data['parent_cat_select']);
        unset ($get_data['child_cats']);
        unset ($get_data['child_sub_cats']);
        unset ($get_data['search_query']);

		$page = $this->input->get('per_page', TRUE);
        if (! isset($page)) {
            $page = 1;
        }
		$metas = $get_data;
        $per_page_limit = 10;

 		if (isset($child_sub_cats) && !empty($child_sub_cats)){
		$parent_cat = $child_cat;
		$child_cat  = $child_sub_cats;
		}

		$listings = $this->Listings_Model->header_advance_search($state, $city, $parent_cat, $child_cat, $search_query, $metas, $page, $per_page_limit, $counrty);
		$totalcounts = $listings['total_record'];
		unset ($listings['total_record']);

		$query_string =  $this->input->server('QUERY_STRING');

		$settings = $this->config->item('pagination');
    	$settings["base_url"] = base_url('/listing/search?').http_build_query(array_merge($_GET));
		$settings['page_query_string'] = TRUE;
		$settings['search_page_query_string'] = TRUE;
		$settings["total_rows"] = $totalcounts;
		$settings["per_page"] = $per_page_limit;
		$records_per_page = ceil($totalcounts/$per_page_limit);
		if (intval($this->uri->segment(4))) {
			$page = intval(($this->uri->segment(4)));
		}
		if($records_per_page == $page)
    	$settings['num_links']    =   3;
		$this->pagination->initialize($settings);

		$str_links = $this->pagination->create_links();
		$total_count_row = '';

	    $loged_in_user_id = volgo_get_logged_in_user_id();
	    if (!empty($loged_in_user_id)) {
	                $loged_in_user_id = $loged_in_user_id;
	                if(isset($get_data)){
	                    $url = base_url('/listing/search?').http_build_query(array_merge($_GET));
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

				$data = [
					'sub_childs_cats' => $total_count_row,
					'all_cuntry' => $this->Listingfilterquery_Model->get_all_countries(),
					'listing_by_cat_featured' => $listings,
					'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
					'parent_cat_name' => isset($parent_name) ?$parent_name : '',
					'cat_name' => $cat_name,
					'total_add' => $totalcounts,
	                'saved_query' => isset($saved_querys) ?$saved_querys : 'no',
	                'search_id' => $search_id,
	                'all_currencies' => $this->Listings_Model->get_all_currencies()
				];

				if (isset($str_links))
					$data["links"] = explode('&nbsp;', $str_links);

				$this->load->view('frontend-mobile/listing-pages/default-listing', $data);

	}

	public function mobile_search(){
		$data = [
			'page' => 'search',
			'all_country' => $this->Listingfilterquery_Model->get_all_countries(),
			'all_cats' => $this->Listingfilterquery_Model->get_all_categories()
		];
		$this->load->view('frontend-mobile/search/index',$data);
	}


	/*
	 * view function started
	 * */


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


        if (empty($category))
            redirect('sorry');

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

        $loged_in_user_id = volgo_get_logged_in_user_id();
        if (!empty($loged_in_user_id)) {
            $loged_in_user_id = $loged_in_user_id;

        } else {
            $loged_in_user_id = "nologedin";

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
            'all_cuntry' => volgo_get_countries(),
            'listing_by_cat_recommended' => $new_arr,
            'listing_by_cat_featured' => $new_arr2,
            'slug' => $slug,
            'makes' => $makes,
            'models' => $models,
            'all_cats' => $jsonManipulation->get_categories(),
            'parent_cat_name' => $parent_cat_name,
            'cat_name' => $cat_name,
            'sub_cat_id' => $sub_cat_id,
            'sub_cat_slug' => $sub_cat_name,
            'total_add_count' => $total_row,
            'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
            'listing_save_search' => $this->Listings_Model->get_save_search($loged_in_user_id),
            'loged_in_user_id' => $loged_in_user_id,
            'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_user_id),
            'popular_searches' => $this->Listings_Model->popular_searches($country_id,$nearby_cat),
            'nearby' => $this->Listings_Model->nearby($country_id,$nearby_cat),
            'all_currencies' => $this->Listings_Model->get_all_currencies()
        ];
		$data["links"] = explode('&nbsp;', $str_links);
		if (volgo_make_slug(trim($cat_name)) === 'autos' || volgo_make_slug(trim($parent_name)) === 'autos') {
			$this->load->view('frontend-mobile/listing-pages/autos-listing', $data);
		} else if (volgo_make_slug(trim($cat_name)) === 'classified' || volgo_make_slug(trim($parent_name)) === 'classified') {
			$this->load->view('frontend-mobile/listing-pages/classified-listing', $data);
		} else if (volgo_make_slug(trim($cat_name)) === 'services' || volgo_make_slug(trim($parent_name)) === 'services') {
			$this->load->view('frontend-mobile/listing-pages/services-listing', $data);
		} else if (volgo_make_slug(trim($cat_name)) === 'property-for-sale' || volgo_make_slug(trim($cat_name)) === 'property-for-rent' || volgo_make_slug(trim($parent_name)) === 'property-for-sale' || volgo_make_slug(trim($parent_name)) === 'property-for-rent') {
			$data['parent_cat_id'] = $parent_cat_id;
			$data['child_cat_id'] = $nearby_cat;
			$this->load->view('frontend-mobile/listing-pages/property-listing', $data);
		} else if (volgo_make_slug(trim($cat_name)) === 'jobs' || volgo_make_slug(trim($cat_name)) === 'jobs-wanted' || volgo_make_slug(trim($parent_name)) === 'jobs' || volgo_make_slug(trim($parent_name)) === 'jobs-wanted') {
			$data['total_add'] = number_format(intval($total_row));
			$this->load->view('frontend-mobile/listing-pages/jobs-listing', $data);
		} else if(volgo_make_slug(trim($cat_name)) === 'buying-lead' || volgo_make_slug(trim($parent_name)) === 'buying-lead'){
            $this->load->view('frontend-mobile/buying-lead/view', $data);
            $this->load->view('frontend-mobile/buying-lead/all', $data);
		}else if(volgo_make_slug(trim($cat_name)) === 'seller-lead' || volgo_make_slug(trim($parent_name)) === 'seller-lead'){
            $this->load->view('frontend-mobile/seller-lead/view', $data);
            $this->load->view('frontend-mobile/seller-lead/all', $data);
        }else{
            $this->load->view('frontend-mobile/listing-pages/default-listing', $data);
        }


	}

	public function load_models()
    {
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
        $cat_id = $this->input->post('cat_id');
        $slug = $this->input->post('slug');
        $cat_slug = volgo_get_category_slug_by_id($cat_id);
        $country_id = volgo_get_country_info_from_session();
        $country_id = $country_id['country_id'];
        $make = $this->input->post('make');
        $models = $this->Listingquery_Model->listing_models_count($cat_id, $country_id);

        $html = '';
        $html .= '<div class="back-wrapper"><a href="#" class="back-btn-models">Back</a></div>';
        $html .= '<div class="'.$cat_id.' hidden" style="display:block"><a href="'.base_url("$slug/$cat_slug?make=".$make).'" class="">View All Ads</a></div>';
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $all_models = $jsonManipulation->get_models();
        $modles_added = [];

        foreach ($all_models as $index => $all_model):
            if(intval($all_model->sub_category_id) === 6 || $all_model->sub_category_id === 347 || $all_model->sub_category_id === 350){
                if (volgo_make_slug($all_model->parent_name) === volgo_make_slug($make)) {
                    $modelcount = 0;
                    $link = "";
                    foreach ($models as $model) {
                        if (intval($all_model->id) === intval($model->model_id)) {
                            $modelcount = $model->modelcount;
                            $link = '<div class="' . $all_model->slug . ' hidden" data-make_id="' . $all_model->make_id . '" style="display:block">';
                            $link .= '<a data-model_id="' . $all_model->id . '" data-model="' . strtolower($all_model->name) . '" class="model-item ' . $all_model->slug . '" id="model-item" href="' . base_url("$slug/$cat_slug") . '" >' . $all_model->name . ' - ' . $modelcount . '</a></div>';
                        }
                    }
                    $html .= $link;
                }
            }
        endforeach;
        echo json_encode($html);
        exit;
    }

    public function load_sub_cats(){
		$cat_id = $this->input->post('cat_id');
		$html = '';
		$country_id = volgo_get_country_info_from_session();
		$country_id = $country_id['country_id'];
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$all_count_key = 'country_id_' . volgo_get_user_country_id() . '_count';
		$all_counts = $this->cache->get($all_count_key);
		if (! $all_counts || empty($all_counts)){
		    $all_counts = $jsonManipulation->get_counts($all_count_key);
		    $this->cache->save($all_count_key, $all_counts);
		}

		$sub_childs_cats = [];
        $sub_childs_categories = $jsonManipulation->get_sub_cats_by_parent_id($cat_id);
        foreach ($sub_childs_categories as $single_id) {
            $count =  $all_counts['cat_id_' . $single_id->id];
            if (empty($count)) {
                $sub_childs_cats[] = (object)[
                    'subcat_id' => $single_id->id,
                    'name' => $single_id->name,
                    'slug' => $single_id->slug,
                    'total' => 0,
                ];
            } else {
                $sub_childs_cats[] = (object)[
                    'subcat_id' => $single_id->id,
                    'slug' => $single_id->slug,
                    'name' => $single_id->name,
                    'total' => $count,
                ];
            }
        }

		$html .= '<button class="sub-cat-close position-absolute">';
		$html .= '<span class="fa fa-times position-absolute">';
		$html .= '</span>';
		$html .= '</button>';
		$html .= '<div class="child_categories">';
		$html .= '<h2 class="all_cat_ttl">';
		$html .= '<a href="javascript:void(0)" class="full-back btn btn-warning position-absolute sub-back">';
		$html .= '<span class="icon-arrow-left"></span>Back</a>';
		$html .= 'Select Subcategory';
		$html .= '</h2>';
		$html .= '<ul>';
		$parent_cat_name = '';
        foreach ($sub_childs_cats as $item) {
        	$parent_cat_name = $jsonManipulation->get_parent_cat_name_from_cat_id($item->subcat_id);
	        if (isset($item->slug)) {
	            $parent_cat_name  = volgo_make_slug($parent_cat_name);

	            $linkof_cat = rtrim($parent_cat_name, "-") . '/' . $item->slug;
	        } else {
	            $linkof_cat = '#';
	        }
	        $html .= '<li><a href="'.base_url($linkof_cat) .'">' . $item->name . ' - ' . $all_counts['cat_id_' . $item->subcat_id] .'</a></li>';
		}

		$html .= '</ul>';
		$html .= '</div>';
		echo json_encode($html);
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

    public function load_more_listing()
    {
        $posted_data = filter_input_array(INPUT_POST);
        if (! isset($posted_data['category_name'], $posted_data['subcategory_name'])){
            exit('attributes not defined.');
        }

        $category_id = volgo_get_category_id_by_slug($posted_data['category_name']);

        $sub_category_id = '';
        if (! empty($posted_data['subcategory_name'])){
            $sub_category_id = volgo_get_category_id_by_slug($posted_data['subcategory_name']);
        }

        if(!empty($sub_category_id)){
            $category_id = $sub_category_id;
        }
        $country_id = volgo_get_country_info_from_session();
        $country_id = $country_id['country_id'];
        if (isset($country_id)) {
            $country_id = $country_id;
        } else {
            $country_id = 166;
        }
        $per_page_limit = 10;
        $page = $posted_data['current_page'];
        $cat_id = $category_id;
        $parent_name = $this->Listingquery_Model->get_parent_category_name($cat_id);
        $cat_name = $posted_data['category_name'];

        //$listing_by_cat_fetured = $this->Listingquery_Model->listing_by_cat_id_featured($category_id, $per_page_limit, $page, $country_id, 'featured');
        $listing_by_cat_fetured =$this->Listingquery_Model->listing_by_cat_id_and_listing_type($cat_id, $per_page_limit, $page, $country_id, 'featured');


        $new_arr2 = [];
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

            ];
            foreach (json_decode($row->meta_values,true) as $key => $single_meta) {
                $new_arr2[$row->id]['metas'][] = [
                    'meta_key' =>$key,
                    'meta_value' => $single_meta,
                ];
            }
        }
        $new_arr2 = array_values($new_arr2);


        $data = [
            'listing_by_cat_featured' => $new_arr2,
            'cat_name' => $posted_data['category_name'],
            'all_currencies' => $this->Listings_Model->get_all_currencies()
        ];

        ob_start();

        if ($cat_name  === 'autos' || $parent_name === 'autos') {
            $this->load->view('frontend-mobile/listing-pages/ajax_includes/autos-listing-ajax', $data);
        } else if ($cat_name === 'classified' || $parent_name === 'classified') {
            $this->load->view('frontend-mobile/listing-pages/ajax_includes/classified-listing-ajax', $data);
        } else if ($cat_name === 'services' || $parent_name === 'services') {
            $this->load->view('frontend-mobile/listing-pages/ajax_includes/services-listing-ajax', $data);
        } else if ($cat_name === 'property-for-sale' || $cat_name === 'property-for-rent' || $parent_name === 'property-for-sale' || $parent_name === 'property-for-rent') {
            $this->load->view('frontend-mobile/listing-pages/ajax_includes/property-listing-ajax', $data);
        } else if ($cat_name === 'jobs' || $cat_name === 'jobs-wanted' || $parent_name === 'jobs' || $parent_name === 'jobs-wanted') {
            $this->load->view('frontend-mobile/listing-pages/ajax_includes/jobs-listing-ajax', $data);
        }



        $html = ob_get_clean();
        echo json_encode($html);

        exit;
	}

    public function comments($user_id, $post_id, $user_email, $user_name, $slug){

        $input_data = filter_input_array(INPUT_POST);
        $email = volgo_decrypt_message($user_email);

        if (!empty($input_data)) {

            $this->form_validation->set_rules('comment', 'Comments', 'required');

            if ($this->form_validation->run() !== false) {

                $comments = $this->input->post('comment');

                $is_created = $this->Listings_Model->create_comment(
                    $user_id,$post_id,$email,$comments,$user_name
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
                    );




                } else {
                    $this->session->set_flashdata('success_message', 'Thank for comment! will be show after admin approvel. ');
                    redirect(base_url() . $slug);
                }
            } else {
                $this->session->set_flashdata('validation_errors', 'comment error');
                redirect(base_url() . $slug);
            }

        } else {
            $this->session->set_flashdata('validation_errors', '');
            redirect(base_url() . $slug);
        }
    }

}
