<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileHome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Listings_Model');
		$this->load->model('Blocks_Model');
		$this->load->model('Categories_Model');
		$this->load->model('Adbanner_Model');
		$this->load->model('Dashboard_Model');
	}

	public function index()
	{
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
		$page = $this->input->post('page');
		if(isset($page)){
			$page = $page;
		}else{
			$page = 1;
		}
		
	    // echo '<h1>we need to work on it. its mobile</h1>';
		// return;
		$session_data = volgo_decrypt_message(isset($_SESSION['volgo_user_login_data']));
		$session_data = explode(',', $session_data);
		$logedin_user_email = $session_data[0];
		
		$listings = $this->Listings_Model->get_listings_mobile(10,$page);

		// var_dump($listings);die;
		$loged_in_user_id = volgo_get_logged_in_user_id();
		if (!empty($loged_in_user_id)) {
			$loged_in_user_id = $loged_in_user_id;
		} else {
			$loged_in_user_id = "nologedin";
		}
		if($loged_in_user_id != "nologedin"){
			$user_detail = $this->Dashboard_Model->get_curent_user_detail_by_id($loged_in_user_id);
			$user_meta = $this->Dashboard_Model->get_user_meta($loged_in_user_id);
		}else{
			$user_detail = '';
			$user_meta = '';
		}
		
		$data = [
			//'footer_block' => $this->Blocks_Model->get_block('footer_block'),
			'listings' => $listings,
			'ad_banners' => $this->Adbanner_Model->get_rightside_banners(2),
			'main_categories' => $this->Categories_Model->get_main_cats_for_homepage_search(),
			'home'	=> 'home',
			'listing_fav' => $this->Listings_Model->get_favlisting($loged_in_user_id),
			'user' => $user_detail,
			'user_meta' => $user_meta,
            'all_currencies' => $this->Listings_Model->get_all_currencies()
		];
		// echo '<pre>';
		// print_r($data['listings']);die;
		if(isset($page) && $page != 1){
			if(!empty($data['listings'])){
				$formated = $this->post_html($data);
				echo json_encode($formated);
				exit;
			}else{
				echo json_encode('no');
				exit;
			}
			
		}else{
			$this->load->view('frontend-mobile/index.php', $data);
		}
	}

	public function post_html($data){
		$listings = $data['listings'];
		$listing_fav = $data['listing_fav'];
		$output = '';
		
		if (!empty($listings) && isset($listings['list'])):
			foreach ($listings['list'] as $f_listing) :
				$listing_image = base_url() . 'uploads/general/no-image.jpg';
				$listing_price = 0;
				$currency_code = volgo_get_currency_unit_by_country_id();
	
				foreach ($f_listing['metas'] as $meta):
					if ($meta['meta_key'] === 'images_from' && (!empty($meta['meta_value']))) {
					    if(is_array($meta['meta_value']))
                            $lm = $meta['meta_value'];
					    else
						    $lm = unserialize($meta['meta_value']);

						if (!empty($lm))
							$listing_image = IMG_BASE_URL . 'listing_images/' . ($lm[0]) . '?x-oss-process=image/auto-orient,1/quality,q_30/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
					}
					if (($meta['meta_key'] === 'price') && (!empty($meta['meta_value']))) $listing_price = $meta['meta_value'];

					if ($meta['meta_key'] === 'currency_code' && (!empty($meta['meta_value']))) $currency_code = $meta['meta_value'];

					if ($meta['meta_key'] === 'listing_type' && (!empty($meta['meta_value']))) $listing_type = $meta['meta_value'];
				endforeach;
				$output .= '<div class="post_cards msrItem">';
				$output .= '<div class="block featured text-center position-relative imgsize">';
				$user_id = volgo_get_logged_in_user_id();
				if (isset($user_id)) {
					$user_id = $user_id;
				} else {
					$user_id = 0;
				}
				$idoflisting = [];
				if (!empty($listing_fav)) {
				foreach ($listing_fav as $single_listing) {
				$idoflisting[] = $single_listing->meta_value;
				$user_id_retrived = $single_listing->user_id;
				}
				}
				if (isset($user_id_retrived)) {
				$user_id_retrived = $user_id_retrived;
				} else {
				$user_id_retrived = "no fav";
				}

				if ($user_id_retrived == $user_id){
				if (in_array($f_listing['listing_info']['listing_id'], $idoflisting)){
				$output .= '<a class="saveNow remove_fav_listing icon fav position-absolute"
				data-lisitngid="'.$f_listing['listing_info']['listing_id'].'"
				data-user_id="'.$user_id.'" href="#"
				style="">
				<i class="fa fa-spinner" style="display: none"></i>
				<span class="icon-heart"></span></a>';
				}else{	
				$output .= '<a class="saveNow fav_add_listing icon position-absolute"
				data-lisitngid="'.$f_listing['listing_info']['listing_id'].'" data-user_id="'.$user_id.'" href="#" style="">
				<i class="fa fa-spinner" style="display: none"></i>
				<span class="icon-heart"></span></a>';
				}
				}
				$output .= '<a href="'.base_url() . $f_listing['listing_info']['listing_slug'].'" class="post_image_">
				<img src="'.$listing_image.'" alt="image description"></a>';
				$output .= '<strong class="title">' . $f_listing['listing_info']['listing_title'] . '</strong>';
				$output .= '<div class="price-bar d-flex justify-content-between align-items-center">';
				$output .= '<a href="'.base_url() . $f_listing['listing_info']['listing_slug'].'" class="btn '. $listing_type.'">'.$listing_type.'</a>';
				
				if(trim($f_listing['category_info']['category_name']) !== "Services" && trim($f_listing['category_info']['category_name']) !== "Jobs" && trim($f_listing['category_info']['category_name']) !== "Jobs Wanted") {
				$output .= '<strong class="price">';
				if(isset($listing_price) && !empty($listing_price)) {
						$output .= '<span class="currency-code">'.volgo_get_currency_unit_by_country_id().' </span>';
					
					$output .= '<span class="detail-price">'.number_format(intval($listing_price)).'</span>';
				}else{
					$output .= 'N/A';
				}
				$output .= '</strong>';
				}
				$output .= '</div></div></div>';
			endforeach;
		endif;
		
		return $output;
	}

	public function ajax__get_states_by_country_id(){
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

		// Update User Session
		volgo_update_user_location_by_force($posted_data['country_id']);

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

}
