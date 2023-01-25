<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use OSS\OssClient;
use OSS\Core\OssException;

class Listing extends CI_Controller
{
    private $json_url = "https://www.volgoplus.com/home-json";

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
		$this->load->model('Listing_Model');
		$this->load->library('image_lib');
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	public function index()
	{
		$data = [
			//'all_cats' => $this->Category_Model->get_all_categories(),
			'all_cuntry' => $this->Listing_Model->get_all_countries(),
			'all_user' => $this->Listing_Model->get_all_user(),
		];


		$this->load->view('admin/listing/listing', $data);
	}

	public function get_category_of_specific_listing()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!$this->input->is_ajax_request() || !isset($posted_data['listing_type'])) {
			exit('No direct script access allowed');
		}

		if (strtolower($posted_data['listing_type']) === 'featured' || strtolower($posted_data['listing_type']) === 'recommended')
			$categories_arr = $this->Category_Model->get_all_categories();
		else
			$categories_arr = $this->Category_Model->get_categories_by_listing_type($posted_data['listing_type']);

		if (empty($categories_arr)) {
			echo json_encode($categories_arr);
			exit;
		}

		$new_arr = [];
		foreach ($categories_arr as $category) {
			$new_arr[] = [
				'id' => $category->id,
				'description' => $category->description,
				'name' => $category->name,
				'parent_name' => $category->parent_name,
				'image_icon' => $category->image_icon,
				'parent_ids' => $category->parent_ids,
			];
		}

		echo(json_encode($categories_arr));
		exit;

	}

	public function get_state_ajax()
	{


		if (!empty($_POST["country_id"])) {

			$selected_state_id = $this->input->post('country_id');
			$states = $this->Listing_Model->get_state_by_id($selected_state_id);

			echo json_encode($states);
		}
	}

	public function get_city_ajax()
	{


		if (!empty($_POST["state_id"])) {

			$selected_state_id = $this->input->post('state_id');


			$states = $this->Listing_Model->get_city_by_id($selected_state_id);

			echo json_encode($states);
		}
	}

    public function get_currency_ajax()
    {


        if (!empty($_POST["country_id"])) {

            $selected_currency_id = $this->input->post('country_id');
            $currencies = $this->Listing_Model->get_currency_by_id($selected_currency_id);

            echo json_encode($currencies);
        }
    }

	public function get_formdb_ajax()
	{


		if (!empty($_POST["subcat_id"])) {

			$selected_subcat_id = $this->input->post('subcat_id');


			$states = $this->Listing_Model->get_formdb_by_id($selected_subcat_id);

			echo json_encode($states);
		}
	}

	public function overlayWatermark($source_image)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		$config['wm_type'] = 'overlay';
		//$config['wm_padding'] = '5';
		$config['wm_overlay_path'] = './assets/img/watermark-logo.png';
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

	public function save_listing()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);
		$input_data = filter_input_array(INPUT_POST);

		$this->load->library('upload');
		$dataInfo = array();
		$files = $_FILES;

		$is_error_occurr = false;
		if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
			$cpt = count($_FILES['userfile']['name']);
			for ($i = 0; $i < $cpt; $i++) {


				$ext = pathinfo($files['userfile']['name'][$i], PATHINFO_EXTENSION);

				$_FILES['userfile']['name'] = $files['userfile']['name'][$i];
				$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
				$_FILES['userfile']['size'] = $files['userfile']['size'][$i];


                $config = array();
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $this->upload->initialize($config);
                $this->upload->do_upload('userfile');
                $dataInfo[] = $this->upload->data();
                foreach ($dataInfo as $info){
                    $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
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
//					'validation_errors' => '<strong>Sorry: </strong>Unable to get height and width of image. Try Again',
					'success_msg' => '',
				];
				$this->session->set_flashdata('validation_errors', '<strong>Sorry: </strong>Unable to get height and width of image. Try Again');
				$this->load->view('admin/listing/listing', $data);
				redirect('listing', $data);
				return;
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

				$this->load->view('admin/listing/listing', $data);
				redirect('listing', $data);
				return;
			}
		}

		$imagesname = [];
		foreach ($dataInfo as $key => $value) {

			$imagesname[] = $value['file_name'];
		}

		$input_data['images_from'] = serialize($imagesname);
        foreach ($dataInfo as $key => $value) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
        }

		$this->form_validation->set_rules('user_select', 'Select User', 'required|min_length[1]');
		$this->form_validation->set_rules('title_listing', 'Listing Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('desc_listing', 'Listing Description', 'required|min_length[1]');
		$this->form_validation->set_rules('Selected_country', 'Select Country', 'required|min_length[1]');
		$this->form_validation->set_rules('state_selected', 'Select State', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_city', 'Select City', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_category', 'Select Category', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_sub_category', 'Select Sub Category', 'required|min_length[1]');
		$this->form_validation->set_rules('listing_type', 'Listing Type', 'required');

		if ($this->form_validation->run() !== false) {

			// Defaults
			$cv_data_info = [];
			$dataInfo['cv_upload'] = '';
			$dataInfo['cv_upload_full_info'] = serialize([]);


			if (isset($_FILES['cv_upload']) && !empty($_FILES['cv_upload'])) {

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
					$this->session->set_flashdata('validation_errors', '<strong>Sorry: </strong> Unable to upload CV. Kindly Try Again.');
					$this->load->view('admin/listing/listing', $data);
                    redirect('listing', $data);

					return;
				} else {

					$cv_data_info = $this->upload->data();
                    $this->upload_to_bucket($cv_data_info['full_path'] , 'cvs/'. $cv_data_info['file_name']);
					$cvName = $cv_data_info['file_name'];
					$input_data['cv_upload'] = serialize($cvName);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
				}
			}

			$listing_meta_save = $this->Listing_Model->save_lisiting_meta($input_data);


			$data = [
				'all_cats' => $this->Category_Model->get_all_categories(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => '',
//				'success_msg' => '<strong>Congratulation!</strong><br /> Listing has been Added.',
				'status_for_check' => '',
				'id_of_listing' => '',
				'get_user' => '',
				'title_listing' => '',
				'desc_listing' => '',
				'retrived_country_id' => '',
				'retrived_state_id' => '',
				'retrived_city_id' => '',
				'retrived_cat_id' => '',
				'retrived__sub_cat_id' => '',
				'seo_slug' => '',
				'seo_meta_description' => '',
				'seo_keywords' => '',
				'make_id' => '',
				'model_id' => '',
				'seo_title' => '',
				'form_dynamic' => '',
			];

			// Removing Cache
			$slug = $this->Category_Model->get_category_slug_by_id($this->input->post('selected_sub_category'));
			
			if ($slug !== false) {
				//$this->delete_and_create_cache($slug, $this->input->post('listing_type'), $this->input->post('selected_category'), $this->input->post('Selected_country'));
			}
			$this->session->set_flashdata('success_msg', '<strong>Congratulation!</strong><br /> Listing has been Added.');
			$this->load->view('admin/listing/listing', $data);
			redirect('listing', $data);
		} else {
			$data = [
				'all_cats' => $this->Category_Model->get_all_categories(),
				'all_states' => $this->Listing_Model->get_all_states(),
				'all_cites' => $this->Listing_Model->get_all_city(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => validation_errors(),
				'success_msg' => '',
			];
			$this->session->set_flashdata('validation_errors', validation_errors());
			$this->load->view('admin/listing/listing', $data);
			redirect('listing', $data);
		}
	}

	private function delete_cache($slug, $listing_type, $category, $country_id){
		$this->load->helper('file');
		// Removing Cache
		$this->db->select('id');
		$this->db->from('listings');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$listing_id = $query->row();
		if ($listing_id) {
			$listing_id = $listing_id->id;
		}
		if(isset($listing_id) && !empty($listing_id)){
		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_META_DATA_OF_'.$listing_id.'__'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_META_DATA_OF_'.$listing_id.'__'));	
		}
		}
		
		if(isset($listing_id) && !empty($listing_id)){
		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__'));	
		}
		}
        
		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}

		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LISTING_META_DATA_OF_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LISTING_META_DATA_OF_10_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}

		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'));	
		}

		delete_files((VOLGO_FRONTEND_CACHE_PATH . '/category+' . $slug));
		// parent category object cache
		if (strtolower($listing_type) === 'featured') {
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type. '_limit_10_records_cat_id_' . $category  . '_country_id_' . $country_id ));
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_10_records_cat_id_' .  $category . '_country_id_' . $country_id));_RECORD_COUNTRY_ID_
			// home page listing
			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

		} else if (strtolower($listing_type) === 'recommended') {
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
			// home page listing
			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}
			
			
		} else if (strtolower($listing_type) === 'buying_lead') {
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type. '_limit_10_records_cat_id_' . $category  . '_country_id_' . $country_id ));
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_10_records_cat_id_' .  $category . '_country_id_' . $country_id));
			// home page listing

			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}
			

		} else if (strtolower($listing_type) === 'seller_lead') {
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
			// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' .  $category . '_country_id_' . $country_id));
			// home page listing
			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

			if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'))){
			unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_META_LISTING_IDS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__'));	
			}

		}

		if (strtolower($listing_type) === 'featured') {
			// listing page
			if (file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}

		} else if (strtolower($listing_type) === 'recommended') {
			// listing page
			if (file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}
		} else if (strtolower($listing_type) === 'buying_lead') {
			// listing page
			if (file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}
			

		} else if (strtolower($listing_type) === 'seller_lead') {
			// listing page
			if (file_exists((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'))) {
			unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'_RECORD_COUNTRY_ID_'.$country_id.'__'));
			}
		}

		// child category object cache
		// if (strtolower($listing_type) === 'featured') {
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_10_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_10_records_cat_id_' . $category . '_country_id_' . $country_id));

		// 	// listing page
		// 	unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'RECORD_COUNTRY_ID'.$country_id.'__'));
		// } else if (strtolower($listing_type) === 'recommended') {
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// listing page
		// 	unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'RECORD_COUNTRY_ID'.$country_id.'__'));
		// } else if (strtolower($listing_type) === 'buying_lead') {
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// listing page
		// 	unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'RECORD_COUNTRY_ID'.$country_id.'__'));
		// } else if (strtolower($listing_type) === 'seller_lead') {
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_data_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// delete_files((VOLGO_FRONTEND_CACHE_PATH . '/listing_ids_of_type_' . $listing_type . '_limit_3_records_cat_id_' . $category . '_country_id_' . $country_id));
		// 	// listing page
		// 	unlink((VOLGO_FRONTEND_CACHE_PATH . '/__GET_LISTING_IDS_OF_TYPE_'.$listing_type.'_LIMIT_10_DIRECTION_DESC_PAGE_1_RECORD_CAT_ID_'.$category.'RECORD_COUNTRY_ID'.$country_id.'__'));
		// }
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
		
		if(isset($listing_id) && !empty($listing_id)){
		$cache_key = '__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__';

		// Query
		$query = $this->db->query(
			"SELECT id , listings_id , meta_key , meta_value" .
			" From listings_meta" .
			" WHERE listings_id = '{$listing_id}' " .
			" ORDER BY id DESC"
		);
		$listing_meta_data = $query->result();
		
		// Save Data
		$this->cache->save($cache_key, $listing_meta_data, MAX_CACHE_TTL_VALUE); // 
		}
		unset($listing_meta_data);
		unset($cache_key);
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

		// Create Cache
		//$cache_key = 'listing_ids_of_type_' . $listing_type . '_limit_'.$limit.'_records_cat_id_' . $category . '_country_id_' . $country_id;
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

		// $cache_key = 'listing_data_of_type_' . $listing_type . '_limit_'.$limit.'_records_cat_id_' . $category . '_country_id_' . intval($country_id);
		// home page
		//$cache_key = '__GET_LATEST_LISTINGS_OF_'.$listing_type.'_LIMIT_9_RECORD_COUNTRY_ID_'.$country_id.'__';

		// Query
		// $query_q = "select l.id, l.title , l.created_at , l.category_id, l.sub_category_id ,
		// 				l.country_id , l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
		// 				l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
		// 				cntry.name as country_name, cntry.id as country_id ,
		// 				cites.name as city_name, cites.id as city_id ,
		// 				stats.name as state_name, stats.id as state_id
		// 				from listings l
			
		// 					inner join b2b_countries cntry on cntry.id = l.country_id
		// 					LEFT JOIN b2b_cities cites on cites.id = l.city_id
			
		// 					LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
		// 					LEFT join categories cat on cat.id = l.category_id
		// 					LEFT join b2b_states stats on stats.id = l.state_id
			
		// 				where l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$category} or l.sub_category_id = {$category})
		// 				AND l.id in ({$listing_ids})
		// 				order by l.id desc
		// 				limit {$limit}";

		// $result = $this->db->query($query_q);
		// $listing_data = $result->result();

		// Save Data
		//$this->cache->save($cache_key, $listing_data, MAX_CACHE_TTL_VALUE);



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
	}

	private function delete_and_create_cache($slug, $listing_type, $category, $country_id)
	{
		// @todo - We need to implement Queues for future in V2
		//$this->delete_cache($slug, $listing_type, $category, $country_id);
		//$this->create_cache($slug,$listing_type, $category, $country_id);
	}

	public function edit($edit_id)

	{

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
		if (empty($edit_id))
			redirect('sorry');

		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);

		$input_data = filter_input_array(INPUT_POST);
		
		$is_error_occurr = false;
		$input_data['id'] = $edit_id;
		$getlistingdata = $this->Listing_Model->get_user_returned($edit_id);
		$retrived_cat_id =  $getlistingdata[0]->category_id;
		$cat_id = $getlistingdata[0]->sub_category_id;
		$get_meta_listing = $this->Listing_Model->get_meta_returned($edit_id);
		$jsonManipulation = (new \application\classes\JsonManipulation());
		//$get_category_listing = $this->Listing_Model->get_dynamic_form_from_meta($cat_id);
		$dynamic_forms = $jsonManipulation->get_dynamic_form();
		$dynamicform = '';
		foreach ($dynamic_forms->data as $form):
		 if($form->child_cat_id === $cat_id):
		 $dynamicform = $form->forms->form_category;
		 endif;	
		endforeach;
        $images_already_available_arr = $this->Listing_Model->get_meta_returned_image($edit_id);

        /*echo '<pre>';
        print_r($images_already_available_arr);
        echo '</pre>';
        exit;*/

		// for images
		if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'][0])) {
			$listing_type = $this->Listing_Model->get_listing_type_by_listing_id($edit_id);
			$listing_type = isset($listing_type[0]) ? $listing_type[0]->meta_value : '';

			$this->load->library('upload');
			$dataInfo = array();
			$files = $_FILES;

			$cpt = count($_FILES['userfile']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['userfile']['name'] = $files['userfile']['name'][$i];
				$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
				$_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                $config = array();
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/listing_images/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $this->upload->initialize($config);
                $this->upload->do_upload('userfile');
                $dataInfo[] = $this->upload->data();
                foreach ($dataInfo as $info){
                    $this->upload_to_bucket($info['full_path'] , 'listing_images/'. $info['file_name']);
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
				$data = [
					'all_states' => $this->Listing_Model->get_all_states(),
					'all_cites' => $this->Listing_Model->get_all_city(),
					'all_cuntry' => $this->Listing_Model->get_all_countries(),
					'all_user' => $this->Listing_Model->get_all_user(),
					'validation_errors' => '<strong>Sorry: </strong>Unable to get height and width of image.',
					'success_msg' => '',
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
					'make_id'	=> $getlistingdata[0]->make_id,
					'model_id'	=> $getlistingdata[0]->model_id,
					'is_email'  => $getlistingdata[0]->is_email
				];

				$this->load->view('admin/listing/editlisting', $data);
				return;
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
					'all_states' => $this->Listing_Model->get_all_states(),
					'all_cites' => $this->Listing_Model->get_all_city(),
					'all_cuntry' => $this->Listing_Model->get_all_countries(),
					'all_user' => $this->Listing_Model->get_all_user(),
					'validation_errors' => $return_val['errors'],
					'success_msg' => '',
					'status_for_check' => $getlistingdata[0]->status,
					'id_of_listing' => $getlistingdata[0]->id,
					'get_user' => $getlistingdata[0]->uid,
					'title_listing' => $getlistingdata[0]->title,
					'desc_listing' => $getlistingdata[0]->description,
					'retrived_country_id' => $getlistingdata[0]->country_id,
					'retrived_state_id' => $getlistingdata[0]->state_id,
					'retrived_city_id' => $getlistingdata[0]->city_id,
					'page_slug' => $getlistingdata[0]->slug,
					'retrived_cat_id' => $retrived_cat_id,
					'retrived__sub_cat_id' => $getlistingdata[0]->sub_category_id,
					'seo_slug' => $getlistingdata[0]->seo_slug,
					'seo_meta_description' => $getlistingdata[0]->seo_description,
					'seo_keywords' => $getlistingdata[0]->seo_keywords,
					'seo_title' => $getlistingdata[0]->seo_title,
					'form_dynamic' => $dynamicform,
					'listing_type' => $listing_type,
					'make_id'	=> $getlistingdata[0]->make_id,
					'model_id'	=> $getlistingdata[0]->model_id,
					'is_email'  => $getlistingdata[0]->is_email
				];

				$this->load->view('admin/listing/editlisting', $data);
				return;
			}
		}

		if (isset($dataInfo) && is_array($dataInfo)) {
			$imagesname = [];
			foreach ($dataInfo as $key => $value) {

				$imagesname[] = $value['file_name'];
			}

			// concatenate already available images
			//$images_already_available = $this->db->select('*')->from('listings_meta')->where('meta_key', 'images_from')->where('listings_id', intval($getlistingdata[0]->id))->limit(1)->get()->row();


			/*if (! empty($images_already_available))
				$images_already_available_arr = unserialize($images_already_available->meta_value);*/

			$images = array_merge($imagesname, $images_already_available_arr);

			$input_data['images_from'] = $images;
		}else{
            $input_data['images_from'] = $images_already_available_arr;
        }

        if (isset($dataInfo) && is_array($dataInfo)) {
            foreach ($dataInfo as $key => $value) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/listing_images/' . $value['file_name']);
            }
        }



		// for cv

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
                    $input_data['cv_upload'] = $cv_upload_info;
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/cvs/' . $cv_data_info['file_name']);
                }
            }
        }

		$this->form_validation->set_rules('user_select', 'Select User', 'required|min_length[1]');
		$this->form_validation->set_rules('title_listing', 'Listing Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('desc_listing', 'Listing Description', 'required|min_length[1]');
		$this->form_validation->set_rules('Selected_country', 'Select Country', 'required|min_length[1]');
		$this->form_validation->set_rules('state_selected_retrival', 'Select State', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_city', 'Select City', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_category', 'Select Category', 'required|min_length[1]');
		$this->form_validation->set_rules('selected_sub_category', 'Select Sub Category', 'required|min_length[1]');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

		if ($this->form_validation->run() !== false) {


			$siteurl = FRONT_END_SITE_URL;
			$user_data = $this->Listing_Model->get_user_data_by_id($getlistingdata[0]->uid);
			$firstname = $user_data[0]->firstname;
			$lastname = $user_data[0]->lastname;
			$fullname = $firstname." ".$lastname;
			$username = $user_data[0]->username;
			$user_email_to = $user_data[0]->email;
			
			if($input_data['is_email'] === 'enabled'){
			    $listing_url = FRONT_END_SITE_URL . $input_data['page_slug'];
				$email_of_followers = $this->Listing_Model->get_follower_emails($input_data['user_select']);
				$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
				
				foreach ($email_of_followers as $email) {
				
				if($email && !empty($email)){
					
				// SMTP configuration
				try {
					$mail->SMTPDebug = true;
				 //    $mail->SMTPDebug = 2; //Alternative to above constant
					$mail->isSMTP();
					$mail->Host = PHPMAILER_SENDER_HOST;
					$mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
					$mail->Username = PHPMAILER_SENDER_USERNAME;
					$mail->Password = PHPMAILER_SENDER_PASSWORD;
					$mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
					$mail->Port = PHPMAILER_SENDER_PORT;

					$msg = str_replace('%%fullname%%', $fullname, EMAIL_FOR_NEW_POST_TO_FOLLOWER);
                    $msg = str_replace('%%username%%', $username, $msg);
                    $msg = str_replace('%%firstname%%', $firstname, $msg);
                    $msg = str_replace('%%lastname%%', $lastname, $msg);
                    $msg = str_replace('%%email%%', $user_email_to, $msg);
                    $msg = str_replace('%%siteurl%%', $listing_url, $msg);
                    $mail->setFrom(NEWSLETTER_FROM_EMAIL);
                    // Email subject
                    $mail->Subject = 'NEW POST BY FOLLOWING DEALER |' . SITE_NAME;
                    // Set email format to HTML
                    $mail->isHTML(true);
                    $mail->addAddress($email);
                    
                    $mail->Body = $msg;
					$mail->Send();
					$mail->ClearAllRecipients();
				} catch (Exception $e) {
					log_message('error', $mail->ErrorInfo);
					return true;
				}
				}
				}
			}
			
			if($input_data['is_email'] && $input_data['is_email'] === 'enabled'){
				unset($input_data['is_email']);
			}

			$listing_meta_save = $this->Listing_Model->save_lisiting_meta_edit($input_data);
			
			if($listing_meta_save ){
			if($getlistingdata[0]->status === 'disabled' && isset($input_data['package_status'])){
			$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
			// SMTP configuration
			try {
				$mail->isSMTP();
				$mail->Host = PHPMAILER_SENDER_HOST;
				$mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
				$mail->Username = PHPMAILER_SENDER_USERNAME;
				$mail->Password = PHPMAILER_SENDER_PASSWORD;
				$mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
				$mail->Port = PHPMAILER_SENDER_PORT;

	            $msg = str_replace('%%fullname%%', $username, LISTING_APPROVED_EMAIL_USER);
	            $msg = str_replace('%%firstname%%', $firstname, $msg);
	            $msg = str_replace('%%lastname%%', $lastname, $msg);
	            $msg = str_replace('%%email%%', $user_email_to, $msg);
	            $msg = str_replace('%%siteurl%%', $siteurl, $msg);

                $mail->setFrom(NEWSLETTER_FROM_EMAIL);
                // Email subject
                $mail->Subject = 'YOUR AD APPROVED |' . SITE_NAME;
                // Set email format to HTML
                $mail->isHTML(true);
                $mail->addAddress($user_email_to);
                    
                $mail->Body = $msg;
				$mail->Send();
				} catch (Exception $e) {
					log_message('error', $mail->ErrorInfo);
					//redirect(404);
					return true;
				}
			}
			}	
			$listing_type = $this->Listing_Model->get_listing_type_by_listing_id_2($edit_id);
			$listing_type = isset($listing_type[0]) ? $listing_type[0]->listing_type : '';

			$data = [
				'all_states' => $this->Listing_Model->get_all_states(),
				'all_cites' => $this->Listing_Model->get_all_city(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => '',
				'success_msg' => '<strong>Congratulation!</strong><br /> Listing has been Updated.',
				'status_for_check' => ( intval($this->input->post('package_status')) === 1 ? 'enabled' : 'disabled'),
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
				'make_id'	=> $getlistingdata[0]->make_id,
				'model_id'	=> $getlistingdata[0]->model_id,
				'is_email'  => $getlistingdata[0]->is_email
			];

			$slug = $this->Category_Model->get_category_slug_by_id($this->input->post('selected_sub_category'));
			
			if ($slug !== false) {

                /*$this->delete_cache(
                    //$this->input->post('page_slug'),
                    $getlistingdata[0]->slug,
                    $listing_type,
                    $this->input->post('selected_sub_category'),
                    $this->input->post('Selected_country')
                );*/
				/*$this->create_cache(
					$getlistingdata[0]->slug,
					$this->input->post('listing_type'),
					$this->input->post('selected_sub_category'),
					$this->input->post('Selected_country')
				);*/
			}
			$this->load->view('admin/listing/editlisting', $data);
		} else {
			$getlistingdata = $this->Listing_Model->get_user_returned($edit_id);

			$cat_id = $getlistingdata[0]->sub_category_id;

			$get_meta_listing = $this->Listing_Model->get_meta_returned($edit_id);

			// $get_category_listing = $this->Listing_Model->get_dynamic_form_from_meta($cat_id);
			$listing_type = $this->Listing_Model->get_listing_type_by_listing_id($edit_id);
			$listing_type = isset($listing_type[0]) ? $listing_type[0]->meta_value : '';
			$data = [
				'all_states' => $this->Listing_Model->get_all_states(),
				'all_cites' => $this->Listing_Model->get_all_city(),
				'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'all_user' => $this->Listing_Model->get_all_user(),
				'validation_errors' => validation_errors(),
				'success_msg' => '',
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
				'make_id'	=> $getlistingdata[0]->make_id,
				'model_id'	=> $getlistingdata[0]->model_id,
				'is_email'  => $getlistingdata[0]->is_email
			];
			
			$this->load->view('admin/listing/editlisting', $data);
		}
	}

	public function edit_ajax()
	{
		if (empty($id_of_listing = $this->input->post('id_of_listing')))
			redirect('sorry');


		$get_meta_listing = $this->Listing_Model->get_meta_returned($id_of_listing);
		$arr = [];

		foreach ($get_meta_listing as $key => $single_meta) {
			
			if ($single_meta->meta_key === 'cv_upload' || $single_meta->meta_key === 'images_from' || $single_meta->meta_key === 'ad_extras'){
                if(is_array($single_meta->meta_value)){
                    $single_meta->meta_value = $single_meta->meta_value;
                }else{
                    $single_meta->meta_value = unserialize($single_meta->meta_value);
                }
				
				$arr[] = $single_meta;
			}else {
				$arr[] = $single_meta;
			}

		}
		echo json_encode($get_meta_listing);


	}

	public function edit_ajax_image()
	{
		if (empty($id_of_listing = $this->input->post('id_of_listing')))
			redirect('sorry');


		$get_meta_listing2 = $this->Listing_Model->get_meta_returned_image($id_of_listing);
		//$images_form = unserialize($get_meta_listing2[0]->meta_value);

		echo json_encode($get_meta_listing2);
	}

	public
	function remove($single_listing_id = '')
	{
		if (empty($single_listing_id))
			redirect('sorry');

		// get listing data before deleting.
		$query = "select l.id, 
					   l.country_id,
					   l.category_id,
					   l.sub_category_id, 
					   l.slug as listing_slug,
					   c.id as cat_id, 
					   c.slug as cat_slug
				from listings_new l
						 left join categories c on c.id = l.category_id
				where l.id = {$single_listing_id};";

		$result = $this->db->query($query);
		$result = $result->result();

		//$meta = $this->db->select('meta_value')->from('listings_meta')->where('listings_id', $single_listing_id)->where('meta_key', 'listing_type')->get()->row();


		if ($this->Listing_Model->remove($single_listing_id)) {
			$this->session->set_flashdata('removed', 'success');

			/*if (isset($result[0])){
				$this->delete_cache(
					$result[0]->listing_slug,
					$meta->meta_value,
					$result[0]->cat_id,
					$result[0]->country_id
				);

				$this->create_cache(
					$result[0]->listing_slug,
					$meta->meta_value,
					$result[0]->cat_id,
					$result[0]->country_id
				);
			}*/


			// @todo: We may need in future to create cache for sub_category_id because it is showing on sub listing pages.
            //$json = file_get_contents($this->json_url, FALSE, NULL);
			redirect('viewlisting');
		} else {
			redirect('viewlisting');
		}
	}

	private
	function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = './uploads/listing_images';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['min_width'] = '290';
		$config['min_height'] = '200';

		return $config;
	}
	private
	function set_upload_options_for_cv()
	{
		//upload a cv options
		$config = array();
		$config['upload_path'] = './uploads/cvs';
		$config['allowed_types'] = 'pdf|doc|docx';

		return $config;
	}
	public function check_slug__ajax()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!$this->input->is_ajax_request() || !isset($posted_data['value'])) {
			exit('No direct script access allowed');
		}

		$slug = volgo_make_slug($posted_data['value']);

		$slug_counter = $this->Listing_Model->check_slug($slug);

		if ($slug_counter > 0) {
			$slug_counter++;
			$slug .= '-' . $slug_counter;
		}

		echo json_encode([
			'status' => 'success',
			'slug' => $slug
		]);

		exit;
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
