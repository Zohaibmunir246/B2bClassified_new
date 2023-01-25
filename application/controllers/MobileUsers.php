<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use OSS\OssClient;
use OSS\Core\OssException;

class MobileUsers extends CI_Controller
{
    function __construct() {
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('Users_Model');
		$this->load->model('Categories_Model');
		$this->load->model('Listings_Model');
		$this->load->model('Listingquery_Model');
        $this->load->model('Dashboard_Model');

    }

    private function check_login($location = ''){
		if (volgo_front_is_logged_in() && empty($location)) {
			$this->session->set_flashdata('volgo_redirecting', true);

			header('Location: ' . base_url());
		}else if (! empty($location) && volgo_front_is_logged_in()){
			$this->session->set_flashdata('volgo_redirecting', true);

			header('Location: ' . $location);
		}else if (! empty($location)){
			redirect('login?redirected_to=' . $location);
		}else {
			redirect('login');
		}
	}


    public function index()
    {
        $this->check_login();
    }

	public function ajax__get_states_by_country_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['country_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['country_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$states_std_arr = volgo_get_states_by_country_id($posted_data['country_id']);
		$states = [];
		foreach ($states_std_arr as $state){
			$states[] = (array) $state;
		}

		echo json_encode($states);
		exit;
    }
	public function ajax__get_cityes_by_country_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['country_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['country_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$states_std_arr = volgo_get_states_by_country_id($posted_data['country_id']);
		$states = [];
		foreach ($states_std_arr as $state){
			$states[] = (array) $state;
		}

		echo json_encode($states);
		exit;
	}
	public function ajax__get_cities_by_state_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['state_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['state_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$cities_std_arr = volgo_get_cities_by_state_id($posted_data['state_id']);
		$cities = [];
		foreach ($cities_std_arr as $city){
			$cities[] = (array) $city;
		}

		echo json_encode($cities);
		exit;
    }

	public function ajax__get_form_by_sub_cat()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['sub_cat_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['sub_cat_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}


		$categories_std_arr = $this->Categories_Model->get_form_by_sub_cat_id($posted_data['sub_cat_id']);
		if (empty($categories_std_arr))
			$categories = [];
		else
			$categories = $categories_std_arr->meta_value;

		echo json_encode($categories);
		exit;
    }

	public function ajax__get_sub_cats_by_category_id()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['cat_id'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['cat_id'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$cats_std_arr = $this->Categories_Model->get_child_cats_by_parent_id($posted_data['cat_id'], 'name');
		$categories = [];
		foreach ($cats_std_arr as $cats){
			$categories[] = (array) $cats;
		}

		echo json_encode($categories);
		exit;
    }

    public function add_cat(){

        if (! volgo_front_is_logged_in()){
            redirect('login?redirected_to=' . base_url('ad-post-cat'));
        }

        $get_data = $this->input->get();

        if (isset($get_data['parent_cat_select'])) {
            $parent_cat = $get_data['parent_cat_select'];
        } else {
            $parent_cat = '';
        };

        $total_count_row = [];
        $sub_childs_cats = $this->Listingquery_Model->sub_child_cats($parent_cat);

        foreach ($sub_childs_cats as $single_id) {
            $elements = $this->Listingquery_Model->total_listing_get($single_id->id);
            if (empty($elements)) {
                $total_count_row[] = (object)[
                    'subcat_id' => $single_id->id,
                    'name' => $single_id->name,
                    'total' => 0,
                ];
            } else {
                $total_count_row[] = (object)[
                    'subcat_id' => $single_id->id,
                    'name' => $single_id->name,
                    'total' => count($elements),
                ];
            }
        }

        $data = [
            'countries'	=> volgo_get_countries(),
            'states'	=> volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
            'post_categories'	=> $this->Categories_Model->get_parent_categories_for_add_post('name'),
            'sub_childs_cats' => $total_count_row,
        ];

        $this->load->view('frontend-mobile/postform/add_cat', $data);

        return;
    }

	public function add_post()
	{
        $parameter = $_SERVER['QUERY_STRING'];
        
        if (!$parameter){
            redirect('login?redirected_to=' . base_url('ad-post-cat'));
        }

		if (! volgo_front_is_logged_in()){
			redirect('login?redirected_to=' . base_url('ad-post-cat'));
		}
        
		$data = [
			'countries'	=> volgo_get_countries(),
			'states'	=> volgo_get_states_by_country_id(volgo_get_country_id_from_session())
		];

		$this->load->view('frontend-mobile/postform/post_form', $data);

    }
   
   	public function submit_ad_post()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (! volgo_front_is_logged_in()){
            redirect('login?redirected_to=' . base_url('submit-ad-post'));
        }
        $data = [
            'countries' => volgo_get_countries(),
            'states'    => volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
            'buying_lead_parent_cats'   => $this->Categories_Model->get_buying_lead_parent_cats('name')
        ];
        $posted_data = filter_input_array(INPUT_POST);

        if (! empty($posted_data)){

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $is_error_occurr = false;
            if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
                $cpt = 0;
                $arr_files = $_FILES['userfile']['name'];
                foreach ($arr_files as $arr_file) {
                    if (isset($arr_file) && !empty($arr_file)) {
                        $cpt++;
                    }
                }
                for ($i = 0; $i < $cpt; $i++) {
                    if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $config = array();
                        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['overwrite']     = false;
                        $config['encrypt_name'] = TRUE;
                        $this->upload->initialize($config);
                        $this->upload->do_upload('userfile');
                        $dataInfo[] = $this->upload->data();
                        foreach ($dataInfo as $info){
                            $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
                        }
                    }
                }
                /*
                 *
                 * CHECK IF ANY IMAGE HAS ISSUE WITH HEIGHT AND WIDTH
                 *
                 * */
                /*
                 *
                 * PUT WATER MARK ON ALL IMAGES.
                 *
                 * */
            }
            $imagesname = [];
            foreach ($dataInfo as $key => $value) {
                if($value['file_name'] || !empty($value['file_name'])){
                    $imagesname[] = $value['file_name'];
                }else if(!$value['client_name'] || empty($value['client_name'])){
                    $imagesname[] = $value['client_name'];
                }else{
                    $imagesname[] = $value['orig_name'];
                }           
            }

            $posted_data['images_from'] = serialize($imagesname);
            foreach ($dataInfo as $key => $value) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
            }

            $this->form_validation->set_rules('input_title', 'Titles', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('input_description', 'Description', 'required');
            $this->form_validation->set_rules('input_state', 'Select State', 'required|min_length[1]');
            $this->form_validation->set_rules('input_city', 'Select City', 'required|min_length[1]');
            $this->form_validation->set_rules('input_category', 'Select Category', 'required|min_length[1]');
            $this->form_validation->set_rules('input_subcategory', 'Select Sub Category', 'required|min_length[1]');
            $this->form_validation->set_rules('listing_type', 'Listing Type', 'required');
            if ($this->form_validation->run() !== FALSE){

                // Defaults
                $cv_data_info = [];
                if (isset($_FILES['cv_upload']) && !empty($_FILES['cv_upload']['name'])){
                    $_FILES['userfile']['name'] = $_FILES['cv_upload']['name'];
                    $_FILES['userfile']['type'] = $_FILES['cv_upload']['type'];
                    $_FILES['userfile']['tmp_name'] = $_FILES['cv_upload']['tmp_name'];
                    $_FILES['userfile']['error'] = $_FILES['cv_upload']['error'];
                    $_FILES['userfile']['size'] = $_FILES['cv_upload']['size'];
                    $config['allowed_types'] = 'pdf|doc|docx';
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/cvs/';
                    $config['max_size']    = '15000000';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload();

                    if ( ! $this->upload->do_upload()) {
                        echo json_encode(['cv_upload_errors'=>'<strong>Sorry: </strong>  Unable to upload CV. Kindly Try Again.']);
                        exit;
                    }else {
                        $cv_data_info = $this->upload->data();
                        $this->upload_to_bucket($cv_data_info['full_path'] , 'cvs/'. $cv_data_info['file_name']);
                        $cv_upload_info = serialize($cv_data_info['file_name']);
                        $posted_data['cv_upload'] = $cv_upload_info;
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
                    }
                }

                $is_saved = $this->Listings_Model->save_lisiting_and_meta($posted_data);

                if ($is_saved){
                    echo json_encode(['success_msg'=>'<p><strong>Note! </strong><br />Congratulations! your post has submited successfully.</p>', 'warning_msg' =>'<p><strong>Note! </strong><br />Your ad is pending for approval.</p>']);
                    exit;
                }else {
                    echo json_encode(['error_msg'=>'<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
                    exit;
                }
            }else {
                echo json_encode(['validation_error'=>validation_errors()]);
                exit;
            }
        }
    }
    
    public function edit_ad_post($edit_id)
    {
        if (empty($edit_id))
            redirect('sorry');

        if (!volgo_front_is_logged_in()) {
            redirect('login?redirected_to=' . base_url('submit-ad-post'));
        }
        $getlistingdata = $this->Listings_Model->get_user_returned($edit_id);
        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);

        $session_data = explode(',', $session_data);
        $logedin_user_email = $session_data[0];

        $user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);
        $user_id = $user_detail[0]->id;
        if ($user_id !== $getlistingdata[0]->uid) {
            redirect('404');
        }
        $retrived_cat_id =  $getlistingdata[0]->category_id;
        $cat_id = $getlistingdata[0]->sub_category_id;
        $state_id = $getlistingdata[0]->state_id;
        $country_id = $getlistingdata[0]->country_id;
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $dynamic_forms = $jsonManipulation->get_dynamic_form();
        
        $dynamicform = '';
        foreach ($dynamic_forms->data as $form):
         if($form->child_cat_id === $cat_id):
         $dynamicform = $form->forms->form_category;
         endif; 
        endforeach;
        $listing_type = $this->Listings_Model->get_listing_type_by_listing_id($edit_id);
        $listing_type = isset($listing_type[0]) ? $listing_type[0]->meta_value : '';
        $cities = volgo_get_cities_by_state_id($state_id);
        $get_meta_listing2 = $this->Listings_Model->get_meta_returned_image($edit_id);
           
        $data = [
            'countries' => volgo_get_countries(),
            'states' => volgo_get_states_by_country_id($country_id),
            'cities' => $cities,
            'buying_lead_parent_cats' => $this->Categories_Model->get_buying_lead_parent_cats('name'),
            '' => $getlistingdata,
            'status_for_check' => $getlistingdata[0]->status,
            'id_of_listing' => $getlistingdata[0]->id,
            'get_user' => $getlistingdata[0]->uid,
            'title_listing' => $getlistingdata[0]->title,
            'desc_listing' => $getlistingdata[0]->description,
            'retrived_country_id' => $getlistingdata[0]->country_id,
            'retrived_state_id' => $getlistingdata[0]->state_id,
            'retrived_city_id' => $getlistingdata[0]->city_id,
            'retrived_cat_id' => $retrived_cat_id,
            'retrived__sub_cat_id' => $getlistingdata[0]->sub_category_id,
            'page_slug' => $getlistingdata[0]->slug,
            'seo_slug' => $getlistingdata[0]->seo_slug,
            'seo_meta_description' => $getlistingdata[0]->seo_description,
            'seo_keywords' => $getlistingdata[0]->seo_keywords,
            'seo_title' => $getlistingdata[0]->seo_title,
            'form_dynamic' => $dynamicform,
            'listing_type' => $listing_type,
            'make_id'   => $getlistingdata[0]->make_id,
            'model_id'  => $getlistingdata[0]->model_id,
            'is_email'  => $getlistingdata[0]->is_email
        ];

        $posted_data = filter_input_array(INPUT_POST);
                
        if (!empty($posted_data)) {

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $images_form = $posted_data['post_images'];
            $imagesname = [];

            if(isset($images_form)){
            $images_form = explode(",",$images_form);
            if(is_array ($images_form)){
            foreach ($images_form as $image) {
                if(!empty($image)){
                $imagesname[] = $image;
                }
            }   
            }else{
                $imagesname[] = $images_form;
            }
            }
            $is_error_occurr = false;
            if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
                $cpt = 0;
                $arr_files = $_FILES['userfile']['name'];
                foreach ($arr_files as $arr_file) {
                    if (isset($arr_file) && !empty($arr_file)) {
                        $cpt++;
                    }
                }
                for ($i = 0; $i < $cpt; $i++) {
                    if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $config = array();
                        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['overwrite']     = false;
                        $config['encrypt_name'] = TRUE;
                        $this->upload->initialize($config);
                        $this->upload->do_upload('userfile');
                        $dataInfo[] = $this->upload->data();
                        foreach ($dataInfo as $info){
                            $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
                        }
                    }
                }

             }

            foreach ($dataInfo as $key => $value) {
                if($value['file_name'] || !empty($value['file_name'])){
                    $imagesname[] = $value['file_name'];
                }else if(!$value['client_name'] || empty($value['client_name'])){
                    $imagesname[] = $value['client_name'];
                }else{
                    $imagesname[] = $value['orig_name'];
                }           
            }
            
            // Defaults

            if (isset($_FILES['cv_upload']) && !empty($_FILES['cv_upload']['name'])) {

                $_FILES['userfile']['name'] = $_FILES['cv_upload']['name'];
                $_FILES['userfile']['type'] = $_FILES['cv_upload']['type'];
                $_FILES['userfile']['tmp_name'] = $_FILES['cv_upload']['tmp_name'];
                $_FILES['userfile']['error'] = $_FILES['cv_upload']['error'];
                $_FILES['userfile']['size'] = $_FILES['cv_upload']['size'];

                $config['allowed_types'] = 'pdf|doc|docx';
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/cvs/';
                $config['max_size'] = '15000000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload();

                if (!$this->upload->do_upload()) {
                    echo json_encode(['cv_upload_errors' => '<strong>Sorry: </strong>  Unable to upload CV. Kindly Try Again.']);
                    exit;
                } else {
                    $cv_data_info = $this->upload->data();
                    $this->upload_to_bucket($cv_data_info['full_path'] , 'cvs/'. $cv_data_info['file_name']);
                    $cv_upload_info = serialize($cv_data_info['file_name']);
                    if (isset($cv_upload_info) && !empty($cv_upload_info)) {
                        $posted_data['cv_upload'] = $cv_upload_info;
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
                    }
                }
            }

            $posted_data['images_from'] = serialize($imagesname);
            foreach ($dataInfo as $key => $value) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
            }
            $this->form_validation->set_rules('input_title', 'Title', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('input_description', 'Description', 'required');
            $this->form_validation->set_rules('input_state', 'Select State', 'required|min_length[1]');
            $this->form_validation->set_rules('input_city', 'Select City', 'required|min_length[1]');

            if ($this->form_validation->run() !== FALSE) {
                $posted_data['input_category'] = $retrived_cat_id;
                $posted_data['input_subcategory'] = $cat_id;
                $posted_data['input_country'] = $country_id;
                $is_saved = $this->Listings_Model->save_lisiting_and_meta_edit($edit_id,$posted_data);

                if ($is_saved) {
                     $this->delete_cache($edit_id,$getlistingdata[0]->slug,$listing_type,$this->input->post('input_subcategory'),$this->input->post('input_country'));
                    echo json_encode(['success_msg' => '<p><strong>Congratulations! </strong><br />Your ad has been submitted successfully.</p>', 'warning_msg' => '<p><strong>Note! </strong><br />Your ad is pending for approval.</p>']);
                    exit;
                } else {
                    echo json_encode(['validation_error' => '<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
                    exit;
                }
            } else {
                echo json_encode(['validation_error' => validation_errors()]);
                exit;
            }
        } else {
            $this->load->view('frontend-mobile/postform/edit_post_form', $data);
        }
    }
    
    public function edit_ajax()
    {
        if (empty($id_of_listing = $this->input->post('id_of_listing')))
            redirect('sorry');


        $get_meta_listing = $this->Listings_Model->get_meta_returned($id_of_listing);
        $arr = [];

        foreach ($get_meta_listing as $key => $single_meta) {
            
            if ($single_meta->meta_key === 'cv_upload' || $single_meta->meta_key === 'images_from' || $single_meta->meta_key === 'ad_extras'){
                $single_meta->meta_value = unserialize($single_meta->meta_value);
                
                $arr[] = $single_meta;
            }else {
                $arr[] = $single_meta;
            }

        }
        echo json_encode($get_meta_listing);


    }
	private
	function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = BACKEND_PATH . 'uploads/listing_images/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['overwrite']     = false;
		return $config;
	}

	public function overlayWatermark($source_image)
	{
		$this->load->library('image_lib');

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		$config['wm_type'] = 'overlay';
		//$config['wm_padding'] = '5';
		$config['wm_overlay_path'] = BACKEND_PATH . 'assets/img/watermark-logo.png';
		//the overlay image
		$config['wm_opacity'] = 80;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'right';

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return [
				'status' => 'error',
				'errors' => $this->image_lib->display_errors()
			];
		}

		return true;
	}

	public function add_buying_lead()
	{
		if (! volgo_front_is_logged_in()){
			redirect('login?redirected_to=' . base_url('add-buying-lead'));
			exit;
		}

		$data = [
			'countries'	=> volgo_get_countries(),
			'states'	=> volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
			'buying_lead_parent_cats'	=> $this->Categories_Model->get_buying_lead_parent_cats('name')
		];
		$this->load->view('frontend-mobile/postform/add_buying', $data);

	}

	public function submit_buying_lead()
	{
        if (! volgo_front_is_logged_in()){
            redirect('login?redirected_to=' . base_url('add-buying-lead'));
            exit;
        }

        $data = [
            'countries' => volgo_get_countries(),
            'states'    => volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
            'buying_lead_parent_cats'   => $this->Categories_Model->get_buying_lead_parent_cats('name')
        ];
        $posted_data = filter_input_array(INPUT_POST);

        if (! empty($posted_data)){

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            $is_error_occurr = false;
            if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
                $cpt = 0;
                $arr_files = $_FILES['userfile']['name'];
                foreach ($arr_files as $arr_file) {
                    if (isset($arr_file) && !empty($arr_file)) {
                        $cpt++;
                    }
                }
                for ($i = 0; $i < $cpt; $i++) {
                    if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $config = array();
                        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['overwrite']     = false;
                        $config['encrypt_name'] = TRUE;
                        $this->upload->initialize($config);
                        $this->upload->do_upload('userfile');
                        $dataInfo[] = $this->upload->data();
                        foreach ($dataInfo as $info){
                            $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
                        }
                    }
                }

                /*
                 *
                 * CHECK IF ANY IMAGE HAS ISSUE WITH HEIGHT AND WIDTH
                 *
                 * */
                foreach ($dataInfo as $key => $value) {
                    if ($value['image_width'] === null || ($value['image_height'] === null)) {
                        $is_error_occurr = false;

                        break;
                    }
                }
                if ($is_error_occurr) {
                    $data = [
                        'all_cats' => $this->Category_Model->get_all_categories(),
                        'all_states' => $this->Listing_Model->get_all_states(),
                        'all_cites' => $this->Listing_Model->get_all_city(),
                        'all_cuntry' => $this->Listing_Model->get_all_countries(),
                        'all_user' => $this->Listing_Model->get_all_user(),

                        'validation_errors' => '<strong>Sorry: </strong>Unable to get height and width of image. Try Again',
                        'success_msg' => '',
                    ];

                    echo json_encode(['file_error' => '<strong>Sorry: </strong>Unable to get height and width of image. Try Again']);
                    exit;
                }


                /*
                 *
                 * PUT WATER MARK ON ALL IMAGES.
                 *
                 * */
                foreach ($dataInfo as $key => $value) {
                    $return_val = $this->overlayWatermark($value['full_path']);
                    if (is_array($return_val)) {
                        $is_error_occurr = true;
                        break;
                    }
                }
                if ($is_error_occurr) {
                    $data = [
                        'all_cats' => $this->Category_Model->get_all_categories(),
                        'all_states' => $this->Listing_Model->get_all_states(),
                        'all_cites' => $this->Listing_Model->get_all_city(),
                        'all_cuntry' => $this->Listing_Model->get_all_countries(),
                        'all_user' => $this->Listing_Model->get_all_user(),
                        'validation_errors' => $return_val['errors'],
                        'success_msg' => '',
                    ];

                    echo json_encode(['file_error' => '<strong>Sorry: </strong> ' . $return_val['errors']]);
                    exit;
                }
            }

            $imagesname = [];
            foreach ($dataInfo as $key => $value) {
                if($value['file_name'] || !empty($value['file_name'])){
                    $imagesname[] = $value['file_name'];
                }else if(!$value['client_name'] || empty($value['client_name'])){
                    $imagesname[] = $value['client_name'];
                }else{
                    $imagesname[] = $value['orig_name'];
                }           
            }

            $posted_data['images_from'] = serialize($imagesname);
            $posted_data['listing_type'] = 'buying_lead';
            foreach ($dataInfo as $key => $value) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
            }
            
            $this->form_validation->set_rules('input_title', 'Title', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('input_description', 'Description', 'required');
            //$this->form_validation->set_rules('input_country', 'Select Country', 'required|min_length[1]');
            $this->form_validation->set_rules('input_state', 'Select State', 'required|min_length[1]');
            $this->form_validation->set_rules('input_city', 'Select City', 'required|min_length[1]');
            $this->form_validation->set_rules('input_category', 'Select Category', 'required|min_length[1]');
            $this->form_validation->set_rules('input_subcategory', 'Select Sub Category', 'required|min_length[1]');

            if ($this->form_validation->run() !== FALSE){
                $is_saved = $this->Listings_Model->save_lisiting_and_meta($posted_data);

                if ($is_saved){
                    echo json_encode(['success_msg' => '<p><strong>Note! </strong><br />Congratulations! your post has submited successfully.</p>', 'warning_msg' => '<p><strong>Note! </strong><br />Your ad is pending for approval.</p>']);
                    
                    exit;
                }else {
                    echo json_encode(['validation_errors'=>'<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
                    exit;
                }
            }else {
                $data ['validation_errors'] = validation_errors();
                echo json_encode(['validation_errors' => validation_errors()]);
                exit;
            }
        }
    }

	public function submit_seller_lead()
	{
        if (! volgo_front_is_logged_in()){
            redirect('login?redirected_to=' . base_url('submit-seller-lead'));
            exit;
        }
        $data = [
            'countries' => volgo_get_countries(),
            'states'    => volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
            'buying_lead_parent_cats'   => $this->Categories_Model->get_seller_lead_parent_cats('name')
        ];
        $posted_data = filter_input_array(INPUT_POST);

        if (! empty($posted_data)){

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            $is_error_occurr = false;
            if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
                $cpt = 0;
                $arr_files = $_FILES['userfile']['name'];
                foreach ($arr_files as $arr_file) {
                    if (isset($arr_file) && !empty($arr_file)) {
                        $cpt++;
                    }
                }
                for ($i = 0; $i < $cpt; $i++) {
                    if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                        $config = array();
                        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['overwrite']     = false;
                        $config['encrypt_name'] = TRUE;
                        $this->upload->initialize($config);
                        $this->upload->do_upload('userfile');
                        $dataInfo[] = $this->upload->data();
                        foreach ($dataInfo as $info){
                            $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
                        }
                    }
                }
                /*
                 *
                 * CHECK IF ANY IMAGE HAS ISSUE WITH HEIGHT AND WIDTH
                 *
                 * */
                foreach ($dataInfo as $key => $value) {

                    if ($value['image_width'] === null || ($value['image_height'] === null)) {
                        $is_error_occurr = true;
                        break;
                    }
                }
                if ($is_error_occurr) {
                    echo json_encode(['validation_errors'=>'<strong>Sorry: </strong>Unable to get height and width of image. Try Again']);
                    exit;
                }

                /*
                 *
                 * PUT WATER MARK ON ALL IMAGES.
                 *
                 * */
                foreach ($dataInfo as $key => $value) {
                    $return_val = $this->overlayWatermark($value['full_path']);
                    if (is_array($return_val)) {
                        $is_error_occurr = true;
                        break;
                    }
                }
                if ($is_error_occurr) {
                    echo json_encode(['validation_errors'=>'<strong>Sorry: </strong> ' . $return_val['errors']]);
                    exit;
                }
            }

            $imagesname = [];
            foreach ($dataInfo as $key => $value) {
                if($value['file_name'] || !empty($value['file_name'])){
                    $imagesname[] = $value['file_name'];
                }else if(!$value['client_name'] || empty($value['client_name'])){
                    $imagesname[] = $value['client_name'];
                }else{
                    $imagesname[] = $value['orig_name'];
                }           
            }

            $posted_data['images_from'] = serialize($imagesname);
            $posted_data['listing_type'] = 'seller_lead';
            foreach ($dataInfo as $key => $value) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
            }

            $this->form_validation->set_rules('input_title', 'Title', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('input_description', 'Description', 'required');
            //$this->form_validation->set_rules('input_country', 'Select Country', 'required|min_length[1]');
            $this->form_validation->set_rules('input_state', 'Select State', 'required|min_length[1]');
            $this->form_validation->set_rules('input_city', 'Select City', 'required|min_length[1]');
            $this->form_validation->set_rules('input_category', 'Select Category', 'required|min_length[1]');
            $this->form_validation->set_rules('input_subcategory', 'Select Sub Category', 'required|min_length[1]');

            if ($this->form_validation->run() !== FALSE){
                $is_saved = $this->Listings_Model->save_lisiting_and_meta($posted_data);

                if ($is_saved){
                    echo json_encode(['success_msg'=>'<p><strong>Thank You! </strong><br />Your ad has been successfully submitted</p>','warning_msg' =>'<p><strong>Note! </strong><br />Your ad is pending for approval.</p>']);
                    exit;
                }else {
                    echo json_encode(['validation_errors'=>'<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
                    exit;
                }
            }else {
                echo json_encode(['validation_errors'=>'<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
                exit;
            }
        }
        else {
            $data ['validation_errors'] = validation_errors();
            echo json_encode(['validation_errors'=>'<strong>Error: </strong><br />Unable to save the ad. Kindly retry. If problem persists then kindly contact to administrator. Thank You']);
            exit;
        }
    }
	public function add_seller_lead()
	{
		if (! volgo_front_is_logged_in()){
			redirect('login?redirected_to=' . base_url('add-seller-lead'));
			exit;
		}

		$data = [
			'countries'	=> volgo_get_countries(),
			'states'	=> volgo_get_states_by_country_id(volgo_get_country_id_from_session()),
			'buying_lead_parent_cats'	=> $this->Categories_Model->get_seller_lead_parent_cats('name')
		];
		
		$this->load->view('frontend-mobile/postform/add_selling', $data);
		
	}



	public function handle_fb_login()
	{
		$fb = new \Facebook\Facebook([
			'app_id' => FACEBOOK_APP_API,
			'app_secret' => FACEBOOK_APP_SECRET,
			'default_graph_version' => 'v3.2'
		]);

		$helper = $fb->getRedirectLoginHelper();
		if (isset($_GET['state'])) {
			$helper->getPersistentDataHandler()->set('state', $_GET['state']);
		}

		try {
			$accessToken = $helper->getAccessToken();
			$logout = $helper->getLogoutUrl($accessToken, base_url('login'));
			$data ['fb_logout_url'] = $logout;

		} catch (Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			log_message('error', ('Graph returned an error: ' . $e->getMessage()));
			redirect('login');
			exit;

		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			log_message('error', ('Facebook SDK returned an error: ' . $e->getMessage()));
			redirect('login');
			exit;
		}

		if (!isset($accessToken)) {
			if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');


				log_message('error', ("Error: " . $helper->getError()));
				log_message('error', ("Error Code: " . $helper->getErrorCode()));
				log_message('error', ("Error Reason: " . $helper->getErrorReason()));
				log_message('error', ("Error Description: " . $helper->getErrorDescription()));

				redirect('login');
			} else {
				header('HTTP/1.0 400 Bad Request');
				log_message('error', 'FB - Bad Request');
				redirect('login');
			}
			exit;
		}

		// Logged in

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		try {
			// Get the \Facebook\GraphNodes\GraphUser object for the current user.
			// If you provided a 'default_access_token', the '{access-token}' is optional.
			$response = $fb->get('/me?fields=id,name,email', $accessToken);
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$me = $response->getGraphUser();
		$fb_user_name = $me->getName();
		$fb_user_email = $me->getEmail();
		$fb_user_id = $me->getId();
		
		if (!isset($fb_user_email)) {
		    
		    $data = [
			 $this->session->set_flashdata('fb_errors', "Ooops! something went wrong with your facebook information")
			 ];
			 
			 redirect('login', $data);
			
		}

		$user = $this->Users_Model->get_user_by_email($fb_user_email);

		// Create User, Send welcome email and send password email.
		if (empty($user)){
			$is_created = $this->Users_Model->add_user_from_facebook($fb_user_email, $fb_user_name, $fb_user_id, $accessToken->getValue(), $tokenMetadata);
			if (! $is_created){

				log_message('error', '------------------------------------------------');
				log_message('error', 'Unable to create (Insert User) into database at time of facebook registration');
				log_message('error', '------------------------------------------------');

				redirect('login');
				return false;
			}

			$user_password = $this->session->userdata('facebook_user_password');
			if (!empty($user_password)){

					$msg = "Hi, You are successfully registered with " . SITE_NAME . ' <br />';
					$msg .= "Your password is : " . $user_password. ' <br />';
					$msg .= "It is highly recommended that change the password.";
					
                    $user_data = array('email'=> $fb_user_email,'name' => $fb_user_name);
					$emailto = '';
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'Your temporary Password |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);

				// Welcome Email
				
                    $msg = EMAIL_NEW_USER_WELCOME_EMAIL;
                    $user_data = array('email'=> $fb_user_email,'name' => $fb_user_name);
                    $emailto = '';
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'Welcome |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);

			}
		}


		$user_data = array(
			'username'	=> $fb_user_email,
			'login_from'	=> 'facebook',
			'access_token'	=> $accessToken->getValue(),
			'access_token_metadata'	=> $tokenMetadata,
			'is_logged_in'	=> true,
			'login_time'	=> time()
		);
		$sess_enc_data = volgo_encrypt_message($user_data);
		$this->session->set_userdata('volgo_user_login_data', $sess_enc_data);


		header('Location: ' . base_url());

    }

	private function get_facebook_login_url()
	{
		$fb = new \Facebook\Facebook([
			'app_id' => FACEBOOK_APP_API,
			'app_secret' => FACEBOOK_APP_SECRET,
			'default_graph_version' => 'v3.2'
		]);

		$helper = $fb->getRedirectLoginHelper();
		if (isset($_GET['state'])) {
			$helper->getPersistentDataHandler()->set('state', $_GET['state']);
		}


		$permissions = ['public_profile','email']; // Optional permissions
		return ($helper->getLoginUrl(base_url('users/handle_fb_login'), $permissions));
    }

    public function login()
    {
		$redirected_to = $this->input->get('redirected_to');



		$data = [
			'fb_login_url'	=> $this->get_facebook_login_url(),
			'fb_logout_url'	=> '#'

		];


		if (volgo_front_is_logged_in() && (volgo_get_cookie(VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO) !== NULL) && !empty($redirected_to)) {
            header('Location: ' . $redirected_to);
        }else if (volgo_front_is_logged_in() && !empty($redirected_to)) {
			header('Location: ' . $redirected_to);
		}else if (volgo_front_is_logged_in()){
			header('Location: ' . base_url());
        }else
			$this->load->view('frontend-mobile/users/user_login', $data);
    }

    public function forget_password()
    {
        if (volgo_front_is_logged_in()) {
            header('Location: ' . base_url());
        }else {
            $this->load->view('frontend-mobile/users/forget_password');
        }
    }

    public function logout()
    {
		$this->check_login();

        $this->session->unset_userdata('volgo_user_login_data');

		$this->session->set_flashdata('success_msg', "You are successfully loged out");
		redirect('login');
    }


    public function create_user()
    {
        if (volgo_front_is_logged_in()) {
            header('Location: ' . base_url());
        } else {
            $data = array(
                'validation_errors' => '',
                'success_msg' => '',
                'fb_login_url' => $this->get_facebook_login_url(),
                'fb_logout_url' => '#'
            );
            $input_data = filter_input_array(INPUT_POST);

            $this->form_validation->set_rules('username', 'User Name already exist', 'required|min_length[1]|is_unique[b2b_users.username]');
            $this->form_validation->set_rules('email', 'Email already exist', 'required|min_length[1]|max_length[255]|is_unique[b2b_users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[255]');

            if ($this->form_validation->run() !== false) {


                $input_data['status'] = 'pending';
                $input_data['Selected_country'] = volgo_get_country_id_from_session();

                $user_meta_save = $this->Users_Model->user_signup($input_data);

                $data = [
                    'validation_errors' => '',
                    'success_msg' => '<strong>Congratulation! </strong>signup successfull. <br/>Kindly verify your account! verification link sent on you mail id',
                    'username' => '',
                    'firstname' => '',
                    'lastname' => '',
                    'email' => '',
                    'password' => '',
                    'mobile-number' => ''
                ];
                // account verification email after signup                    

                    $siteurl = base_url();

					$html = 'email:' . $input_data['email'] . '|||status:' . 'email_pending_verifications';
                    $html = base_url('Users/verify_user_account/') . volgo_encrypt_message($html);
                    $msg = str_replace('%%fullname%%', $input_data['firstname'] . ' ' . $input_data['lastname'], EMAIL_NEW_USER_VERIFY_EMAIL);
                    $msg = str_replace('%%username%%', $input_data['username'], $msg);
                    $msg = str_replace('%%firstname%%', $input_data['firstname'], $msg);
                    $msg = str_replace('%%lastname%%', $input_data['lastname'], $msg);
                    $msg = str_replace('%%email%%', $input_data['email'], $msg);
                    $msg = str_replace('%%mobile%%', $input_data['mobile-number'], $msg);
                    $msg = str_replace('%%password%%', $input_data['password'], $msg);
                    $msg = str_replace('%%verificationlink%%', $html, $msg);
                    $msg = str_replace('%%siteurl%%', $siteurl, $msg);
                    $user_data = array('email'=> $input_data['email'],'name' => $input_data['username']);
                    
                    $emailto = '';
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'Verify Your Account |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);

					$msg = str_replace('%%fullname%%', $input_data['firstname'] . ' ' . $input_data['lastname'], EMAIL_NEW_USER_WELCOME_EMAIL);
                    $msg = str_replace('%%username%%', $input_data['username'], $msg);
                    $msg = str_replace('%%firstname%%', $input_data['firstname'], $msg);
                    $msg = str_replace('%%lastname%%', $input_data['lastname'], $msg);
                    $msg = str_replace('%%email%%', $input_data['email'], $msg);
                    $msg = str_replace('%%mobile%%', $input_data['mobile-number'], $msg);
                    $msg = str_replace('%%password%%', $input_data['password'], $msg);
                    $msg = str_replace('%%siteurl%%', $siteurl, $msg);

                    $user_data = array('email'=> $input_data['email'],'name' => $input_data['username']);
                    $emailto = '';
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'Welcome |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);

                $this->load->view('frontend-mobile/users/user_signup', $data);
            } else {
                $data = [
                    'validation_errors' => validation_errors(),
                    'success_msg' => '',
                    'fb_login_url' => $this->get_facebook_login_url(),
                    'fb_logout_url' => '#'
                ];
                $this->load->view('frontend-mobile/users/user_signup', $data);
            }
        }
    }

    public function verify_user_account($token)
    {
    	$result = volgo_decrypt_message($token);
        $data = explode("|||", $result, 2);
        $user_email = explode(':', $data[0], 2);
        $user_status = explode(':', $data[1], 2);
        $user_email = $user_email[1];
        $user_status = $user_status[1];

		$redirected_to = '';
        if (volgo_get_cookie(VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO) !== null){
        	$pkg_cookie = volgo_decrypt_message( (volgo_get_cookie(VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO)) );
        	$pkg_arr = explode('&&', $pkg_cookie);

        	if (isset($pkg_arr[0], $pkg_arr[1])){
				$pkg_id = trim($pkg_arr[0], 'package_id=');
				$enc_token = trim($pkg_arr[1], 'enc_method=');
				$redirected_to = base_url('purchase/' . intval($pkg_id) . '/' . $enc_token);
			}
		}

		$is_updated = $this->Users_Model->verify_user_signup($user_email);

		if ($is_updated){
			// send email

                $msg = 'Congratulations! Signup successfully';
			    $emailto = $user_email;
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'Congratulations';
                volgo_send_email($msg,$subject,$emailto,$emailfrom);

				$this->session->set_flashdata('success_msg', 'Your account has been successfully verified');

				if (! empty($redirected_to))
					redirect(base_url('login?redirected_to=' . $redirected_to));
				else
					redirect(base_url('login'));

		}else {
			// display error/log error
			log_message('error', "Unable to update the user meta at time of verification email.");
			redirect(base_url());
		}
    }

    public function user_login()
    {
        $data = array(
            'validation_errors' => '',
        );

        $posted_data = filter_input_array(INPUT_POST);
        if (!empty($posted_data)){

            $this->form_validation->set_rules('user_email', 'Username', 'trim|required');
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required');

            if ($this->form_validation->run() === FALSE) {
                $data = array(
                    'validation_errors' => validation_errors(),
                );
            } else {
                $data = array(
                    'form_data'	=> array(
                        'user_email' => $this->input->post('user_email'),
                        'user_password' => $this->input->post('user_password')
                    ),
                    'validation_errors' => '',
                );
                $userData = $this->Users_Model->verfiy_user_login($data);
                
                if ($userData === 'is_logged') {

                    $user_data = array(
                        'username' => $data['form_data']['user_email'],
                        'is_logged_in' => true,
                        'login_time' => time()
                    );
                    $sess_enc_data = volgo_encrypt_message($user_data);
                    $this->session->set_userdata('volgo_user_login_data', $sess_enc_data);


                    $redirected_to = $this->input->get('redirected_to');

                    if (volgo_front_is_logged_in() && (volgo_get_cookie(VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO) !== NULL) && !empty($redirected_to)) {
                        header('Location: ' . $redirected_to);
                    } else if (volgo_front_is_logged_in() && !empty($redirected_to)) {
                        header('Location: ' . $redirected_to);
                    } else {
                        header('Location: ' . base_url());
                    }
                } else if ($userData === 'not_log_in') {

                    $data = array(
                        'validation_errors' => '<strong>Sorry</strong><br />Wrong Email or Password.',
                        'fb_login_url' => $this->get_facebook_login_url(),
                        'fb_logout_url' => '#'
                    );

                    $this->load->view('frontend-mobile/users/user_login', $data);
                } else if ($userData === 'google_verified') {

					$data = array(
						'validation_errors' => 'You already have an account with this email! Try logging in or request a new password..',
						'fb_login_url' => $this->get_facebook_login_url(),
						'fb_logout_url' => '#'
					);

					$this->load->view('frontend-mobile/users/user_login', $data);
				} else if ($userData === 'not_verified') {

					$data = array(
						'validation_errors' => '<strong>Hey you!</strong><br /> You already have an account with this email! Try logging in or request a new password.',
						'fb_login_url' => $this->get_facebook_login_url(),
						'fb_logout_url' => '#'
					);

					$this->load->view('frontend-mobile/users/user_login', $data);
				} else if ($userData === 'not_registered' || $userData === 'pending') {

					$data = array(
						'validation_errors' => '<strong>Sorry</strong><br />Your account is not verified. Please verify your account first.',
						'fb_login_url' => $this->get_facebook_login_url(),
						'fb_logout_url' => '#'
					);

					$this->load->view('frontend-mobile/users/user_login', $data);
				} else if ($userData === 'inactive') {

                    $data = array(
                        'validation_errors' => '<strong>Sorry</strong><br />Your account is Temporary Blocked. Please Contact us.',
                        'fb_login_url' => $this->get_facebook_login_url(),
                        'fb_logout_url' => '#'
                    );

                    $this->load->view('frontend-mobile/users/user_login', $data);
                }
            }
        }else{
        	$data = [
				'fb_login_url'	=> $this->get_facebook_login_url(),
				'fb_logout_url'	=> '#'
			];

            $this->load->view('frontend-mobile/users/user_login', $data);
        }
    }

    public function user_password_reset()
    {
        $data = array(
            'validation_errors' => '',
            'success_msg' => '',
        );
        $input_data = filter_input_array(INPUT_POST);
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|strtolower|trim');
        if ($this->form_validation->run() !== false) {
            $data = array(
                'form_data'	=> array(
                    'user_email' => $this->input->post('user_email')
                ),
                'validation_errors' => '',
            );
            $userData = $this->Users_Model->verfiy_user_email($data);

            if ($userData && !empty($userData)) {

                $user_data = array(
                    'user_email'	=> $data['form_data']['user_email']
                );
                $this->session->set_userdata('volgo_user_login_data');
                $this->session->set_flashdata('success_msg', '<strong>Congratulation!</strong><br /> password reset link sent to your mail id.');
                }else {
                    $data = array(
                        'validation_errors' => '<strong>Sorry</strong><br />Invalid Email Id.',
                    );
                }
                // password reset email
                $html = 'email:' . $input_data['user_email'];
                $html = base_url('MobileUsers/verify_reset_password/') . volgo_encrypt_message($html);
				$msg = str_replace('%%username%%', $userData->username, EMAIL_PASSWORD_RESET_EMAIL);
                $msg = str_replace('%%useremail%%', $input_data['user_email'], $msg);
                $msg = str_replace('%%verificationlink%%', $html, $msg);

                $emailto = $input_data['user_email'];
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'Password Reset |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom);

            $this->load->view('frontend-mobile/users/forget_password', $data);
        } else {
            $data = [
                'validation_errors' => validation_errors(),
                'email' => ''
            ];

            $this->load->view('frontend-mobile/users/forget_password', $data);
        }

    }

    public function reset_password($token){
        $result['token'] = $token;
        $this->load->view('frontend-mobile/users/reset_password', $result);
    }

    public function verify_reset_password($token)
    {
        $newtoken['token'] = $token;
        $result = volgo_decrypt_message($token);

        $data = explode("|||", $result, 2);
        $user_email = explode(':', $data[0], 2);
        $user_email = $user_email[1];

        $data = array(
            'validation_errors' => '',
            'success_msg' => ''
        );
        $input_data = filter_input_array(INPUT_POST);
        if (!empty($input_data)) {

            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password]');


            if ($this->form_validation->run() !== false) {

                $password = $this->input->post('password');
                $is_updated = $this->Users_Model->update_user_password(
                    $user_email, $password
                );
                if ($is_updated) {
                    $data = array(
                        'validation_errors' => validation_errors(),
                        'password' => $password
                    );

                        $msg = EMAIL_PASSWORD_RESET_SUCCESS_EMAIL;

                        $emailto = $user_email;
                        $emailfrom = NEWSLETTER_FROM_EMAIL;
                        $subject = 'Your password has been updated |' . SITE_NAME;
                        volgo_send_email($msg,$subject,$emailto,$emailfrom);

                        $this->session->set_flashdata('success_msg', 'Password updated successfully! login you account');
                        redirect('login');

                }else {

                    $this->session->set_flashdata('validation_errors', 'password update error 1');
                    $this->load->view('frontend-mobile/users/reset_password', $newtoken);
                }

                $this->session->set_flashdata('success_msg', 'Password Update successfully');
                $this->load->view('frontend-mobile/users/reset_password', $newtoken);
            } else {
                $this->session->set_flashdata('validation_errors', 'password field is required');
                $this->load->view('frontend-mobile/users/reset_password', $newtoken);
            }

        } else {
            $this->session->set_flashdata('validation_errors', '');
            $this->load->view('frontend-mobile/users/reset_password', $newtoken);
        }

    }

	public function additional_filters()
	{

		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['filter_name']) || !isset($posted_data['cat_slug'])) {
			exit('No direct script access allowed');
		}

		$category_id = volgo_get_cat_id_by_slug($posted_data['cat_slug']);

		if (empty($category_id)){
			echo json_encode('');
			exit;
		}


		if ( strtolower($posted_data['filter_name']) === 'price_only'){
			$data = [
				'price_only' => true,
				'listing_type'	=> 'featured'
			];
			$featured_results = $this->Listings_Model->header_advance_search('', $category_id, '', '', $data, 1, 10);


			$data = [
				'price_only' => true,
				'listing_type'	=> 'recommended'
			];
			$recommended_result = $this->Listings_Model->header_advance_search('', $category_id, '', '', $data, 1, 3);


			$data = [
				'featured_listings'	=> $featured_results,
				'recommended_listings'	=> $recommended_result
			];

			ob_start();
			$this->load->view('frontend/listing_page/ajax/listingautos', $data);
			$html = ob_get_clean();

			echo json_encode($html);
			exit;

		}

		if ( strtolower($posted_data['filter_name']) === 'photo_only'){
			$data = [
				'photo_only' => true,
				'listing_type'	=> 'featured'
			];
			$featured_results = $this->Listings_Model->header_advance_search('', $category_id, '', '', $data, 0, 10);


			$data = [
				'photo_only' => true,
				'listing_type'	=> 'recommended'
			];
			$recommended_result = $this->Listings_Model->header_advance_search('', $category_id, '', '', $data, 0, 3);

			$data = [
				'featured_listings'	=> $featured_results,
				'recommended_listings'	=> $recommended_result
			];

			ob_start();
			$this->load->view('frontend/listing_page/ajax/listingautos', $data);
			$html = ob_get_clean();

			echo json_encode($html);
			exit;

		}

	}

    private function delete_cache($edit_id,$slug, $listing_type, $category, $country_id){
        $this->load->helper('file');
		if(isset($edit_id) && !empty($edit_id)){
		if(file_exists((__CACHE_PATH__ . '/__GET_LISTING_META_DATA_OF_'.$edit_id.'__'))){
		unlink((__CACHE_PATH__ . '/__GET_LISTING_META_DATA_OF_'.$edit_id.'__'));	
		}
		}
		
		if(isset($listing_id) && !empty($listing_id)){
		if(file_exists((__CACHE_PATH__ . '__GET_MOBILE_LISTING_META_DATA_OF_'.$edit_id.'__'))){
		unlink((__CACHE_PATH__ . '__GET_MOBILE_LISTING_META_DATA_OF_'.$edit_id.'__'));	
		}
		}

		if(isset($slug) && !empty($slug)){
		if(file_exists((__CACHE_PATH__ . '/__GET_LISTING_DATA_BY_SLUG_'.$slug.'__'))){
		unlink((__CACHE_PATH__ . '/__GET_LISTING_DATA_BY_SLUG_'.$slug.'__'));	
		}
		}
		// Removing Cache
        
		if(file_exists((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}

		if(file_exists((__CACHE_PATH__ . '__GET_MOBILE_LISTING_META_DATA_OF_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((__CACHE_PATH__ . '__GET_MOBILE_LISTING_META_DATA_OF_10_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}

		if(file_exists((__CACHE_PATH__ . '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((__CACHE_PATH__ . '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}
        
        if(file_exists((__CACHE_PATH__ . '/__GET_LISTING_DATA_BY_SLUG_'.$slug.'__'))){
        unlink((__CACHE_PATH__ . '/__GET_LISTING_DATA_BY_SLUG_'.$slug.'__'));   
        }
        
		delete_files((__CACHE_PATH__ . '/category+' . $slug));
		// parent category object cache
		if (strtolower($listing_type) === 'featured') {
			// home page listing
			if(file_exists((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

		} else if (strtolower($listing_type) === 'recommended') {
			// home page listing
			if(file_exists((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}
			
			
		} else if (strtolower($listing_type) === 'buying_lead') {
			// home page listing
			if(file_exists((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}
			

		} else if (strtolower($listing_type) === 'seller_lead') {
			// home page listing
			if(file_exists((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((__CACHE_PATH__ . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

		}

		if (strtolower($listing_type) === 'featured') {
			// listing page
			if (file_exists((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}

		} else if (strtolower($listing_type) === 'recommended') {
			// listing page
			if (file_exists((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}
		} else if (strtolower($listing_type) === 'buying_lead') {
			// listing page
			if (file_exists((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}

		} else if (strtolower($listing_type) === 'seller_lead') {
			// listing page
			if (file_exists((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((__CACHE_PATH__ . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}
		}

	}
    
    private function create_cache($slug = '',$listing_type, $category, $country_id){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

		$this->db->select('id');
		$this->db->from('listings');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$listing_id = $query->row();
		if ($listing_id) {
			$listing_id = $listing_id->id;
		}
		
		$cache_key = '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__';
		$limit_offset = "limit 10 offset 0";
		// Query
		$listing_ids_query = " SELECT lm.listings_id  FROM `listings_meta` AS `lm` LEFT JOIN `listings` AS `l` ON l.id = lm.listings_id WHERE lm.meta_key = 'listing_type' AND (lm.meta_value = 'recommended' OR lm.meta_value = 'featured') AND l.status = 'enabled' AND l.country_id = ".intval($country_id) ." ORDER BY lm.listings_id  DESC {$limit_offset};
			";
		$listings_ids_q = $this->db->query($listing_ids_query);
		$listings_ids = $listings_ids_q->result();
		$listing_ids_arr = [];
		foreach ($listings_ids as $value) {
			$listing_ids_arr[] = $value->listings_id;
		}
		$listings_ids = implode(',', $listing_ids_arr);
		unset($listing_ids_query);
		unset($listings_ids_q);
		// Save Data
		$this->cache->save($cache_key, $listings_ids, MAX_CACHE_TTL_VALUE); // 
		unset($listing_ids);
		unset($limit_offset);
		unset($cache_key);
		$cache_key = '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__';
		// Query
		$query = $this->db->query(
			"SELECT l.id as listing_id, l.slug, l.title, c.id as category_id, c.name as category_name" .
				" From listings as l" .
				" inner JOIN categories c ON c.id = l.category_id " .
				" WHERE l.id in ({$listings_ids})" .
				" ORDER BY listing_id DESC"
		);
		$listings = $query->result();
		unset($query);
		// Save Data
		$this->cache->save($cache_key, $listings, MAX_CACHE_TTL_VALUE); //
		unset($listings);
		unset($cache_key);
		
		if ($listing_type === 'recommended'){
			$limit = 3;
		}elseif ($listing_type === 'featured') {
			$limit = 10;
		}elseif ($listing_type === 'buying_lead') {
			$limit = 10;
		}elseif ($listing_type === 'seller_lead') {
			$limit = 10;
		}else {
			$limit = 10;
		}

		// listing page
		unset($cache_key);
		$cache_key = '__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_'.$limit.'_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'RECORD_COUNTRY_ID_'.$country_id.'__';

		// Query
		$query = "select
						distinct lm.listings_id
					from listings_meta lm
						join listings l on l.id = lm.listings_id
					where (
						lm.meta_key = 'listing_type' and lm.meta_value  = '" . $listing_type . "'
					)
					and l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$category} or l.sub_category_id = {$category})
					order by lm.listings_id desc
					limit {$limit}";
		$result_data = $this->db->query($query);

		$ids_arr = $result_data->result();

		$ids = [];
		foreach ($ids_arr as $id_arr) {
			$ids[] = $id_arr->listings_id;
		}
		$listing_ids = implode(',', $ids);

		// Save Data
		$this->cache->save($cache_key, $listing_ids, MAX_CACHE_TTL_VALUE);
		unset($cache_key);
		if(empty($listing_ids))
			$listing_ids = 0;

		/* ------------------ Creating Cache for homepage - Featured and Recommended  ------------------------------------------------------------*/

		if ($listing_type === 'recommended'){
			$limit = 9;
		}elseif ($listing_type === 'featured') {
			$limit = 9;
		}elseif ($listing_type === 'buying_lead') {
			$limit = 3;
		}elseif ($listing_type === 'seller_lead') {
			$limit = 3;
		}
		//$limit = 9; // As on homepage we have only 9 listings.
		// home page

		$cache_key = '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_'.$limit.'_RECORD_COUNTRY_ID_'.$country_id.'__';
			
		$listing_ids_query = "select lm.listings_id
										from listings_meta lm
										  left join listings l on l.id = lm.listings_id
										where lm.meta_key
											  = 'listing_type' and lm.meta_value = '{$listing_type}'
										and l.status = 'enabled' and l.country_id = ".intval($country_id) ." order by listings_id
										desc limit {$limit};";
		$listings_ids_q = $this->db->query($listing_ids_query);
		$listings_ids = $listings_ids_q->result();
		
		// Perform operation
		$listing_ids_arr = [];
		foreach ($listings_ids as $value){
			$listing_ids_arr[] = $value->listings_id;
		}
		$listings_ids = implode(',', $listing_ids_arr);
		// Save Data
		$this->cache->save($cache_key, $listings_ids, MAX_CACHE_TTL_VALUE);
		unset($cache_key);
		/*
		 * @can be
		 * 	latest_listings_of_buying_lead_listings_4_records_country_id_166
		 *	latest_listings_of_featured_listings_9_records_country_id_166
		 * 	latest_listings_of_recommended_listings_9_records_country_id_166
		 * */
		//$cache_key = 'latest_listings_of_' . $listing_type . '_listings_' . $limit . '_records_country_id_' . intval($country_id);
		$cache_key = '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_'.$limit.'_RECORD_COUNTRY_ID_'.$country_id.'__';

		if(!empty($listings_ids)){
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
		$this->cache->save($cache_key, $listings, MAX_CACHE_TTL_VALUE); // save for 72 hours
		}
		unset($cache_key);
		
		if(isset($slug) && !empty($slug)){
        $cache_key = '__GET_LISTING_DATA_BY_SLUG_'.$slug.'__';

        $this->db->select('l.id as listing_id, l.title, l.slug, l.description, l.country_id, l.sub_category_id, l.status, l.created_at, l.make_id, l.model_id, c.parent_ids as sub_category,
        c.id as category_id, c.name as category_name,cc.name as sub_category_name, s.name as state_name, s.id as state_id, ct.id as city_id, bu.firstname as first_name, bu.lastname as last_name, c.slug as category_slug,cc.slug as sub_category_slug, cn.name as country_name, ct.name as city_name, 
        bu.id as user_id, bu.username as user_name, bu.created_at as user_since, bu.email as user_email');
        $this->db->from('listings as l');
        $this->db->join('b2b_countries as cn', 'cn.id = l.country_id', 'left');
        $this->db->join('b2b_cities as ct', 'ct.id = l.city_id', 'left');
        $this->db->join('b2b_states as s', 's.id = l.state_id', 'left');
        $this->db->join('b2b_users as bu', 'bu.id = l.uid', 'left');
        $this->db->join('listings_meta as lm', 'lm.listings_id = l.id', 'inner');
        $this->db->join('categories as c', 'c.id = l.category_id', 'left');
        $this->db->join('categories as cc', 'cc.id = l.sub_category_id', 'left');
        $this->db->limit(1);
        $this->db->where('l.slug', $slug);
        $result = $this->db->get();
        $listing_info = $result->result();
        
        // Save Data
        $this->cache->save($cache_key, $listing_info, MAX_CACHE_TTL_VALUE); // 
        }

        unset($listing_info);
        unset($cache_key);
        if(isset($listing_id) && !empty($listing_id)){
        $cache_key = '__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__';
        $cache_key1 = '__GET_LISTING_META_DATA_OF_'.$listing_id.'__';
        // Query
        $this->db->select('*');
        $this->db->from('listings_meta');
        $this->db->where('listings_id', $listing_id);
        $result = $this->db->get();
        $listing_meta = $result->result();
        
        // Save Data
        $this->cache->save($cache_key, $listing_meta, MAX_CACHE_TTL_VALUE); //
        $this->cache->save($cache_key1, $listing_meta, MAX_CACHE_TTL_VALUE); // 
        }
        unset($listing_meta);
        unset($cache_key);
        unset($cache_key1);
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
