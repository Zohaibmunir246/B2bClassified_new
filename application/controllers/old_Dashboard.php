<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/28/2019
 * Time: 1:38 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('Blocks_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Categories_Model');
		$this->load->model('Listings_Model');
		$this->load->model('Listingfilterquery_Model');
		$this->load->model('Basic_Model');
		$this->load->model('Categories_Model');
		$this->load->library('user_agent');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->helper('functions_helper');

	}


	public function index()
	{
		$get_data = $this->input->get();
		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);
		$logedin_user_email = $session_data[0];
		$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);


		if (!empty($user_detail)) {

			$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);

			foreach ($user_meta as $single_meta) {
				if ($single_meta->meta_key == 'nationality') {
					$countryid = $single_meta->meta_value;
				}
				if ($single_meta->meta_key == 'states') {
					$state_id = $single_meta->meta_value;
				}
			}
		}


		if (volgo_front_is_logged_in()) {
			$country = volgo_get_countries();
			if (isset($countryid)) {
				$states = volgo_get_states_by_country_id($countryid);
			} else {
				$states = '';
			}
			if (isset($state_id)) {
				$city = volgo_get_cities_by_state_id($state_id);
			} else {
				$city = '';
			}

			if (!empty($user_detail[0]->id)) {
				$logedin_user_id = $user_detail[0]->id;
			} else {
				$logedin_user_id = '';
			}
			$followers = $this->Dashboard_Model->get_followers($logedin_user_id);
			
			if (!empty($followers)) {
				$user_detail_of_followers_arr = [];
				foreach ($followers as $single_user_id) {
					$user_detail_of_follower = $this->Dashboard_Model->get_users_detail($single_user_id);
					if($user_detail_of_follower['id']){
						$user_detail_of_followers_arr[] = $user_detail_of_follower;
					}
					
				}

			} else {
				$user_detail_of_followers_arr = '';
			}
			//echo "<pre>";print_r($user_detail_of_followers_arr);die;
			$following = $this->Dashboard_Model->get_followings($logedin_user_id);
			
			if (!empty($following)) {
				$user_detail_of_followings_arr = [];
				foreach ($following as $single_user_id) {
					$user_detail_of_following = $this->Dashboard_Model->get_users_detail($single_user_id);

					if($user_detail_of_following['id']){
						$user_detail_of_followings_arr[] = $user_detail_of_following;
					}
				}
			} else {
				$user_detail_of_followings_arr = '';
			}

			$loged_in_userid = volgo_get_logged_in_user_id();

			$get_all_fav_listings_ids = $this->Dashboard_Model->get_save_listing_ids($loged_in_userid,isset($get_data['fav_parent_cat']) ? $get_data['fav_parent_cat'] : '');

			if (!empty($get_all_fav_listings_ids)) {

				$get_all_fav_listings = $this->Dashboard_Model->get_saved_listings($get_all_fav_listings_ids);

			} else {
				$get_all_fav_listings = 'nolisitng';
			}
			
			$ads = $this->Dashboard_Model->get_user_listing($loged_in_userid, $page = 1, $per_page_limit = 10,isset($get_data['my_ads_parent_cat']) ? $get_data['my_ads_parent_cat'] : '',isset($get_data['ads_status']) ? $get_data['ads_status'] : '');
			$get_user_listing = $ads['lisitng_detial'];
			//$get_user_listing = $this->Dashboard_Model->get_user_listing($loged_in_userid,isset($get_data['my_ads_parent_cat']) ? $get_data['my_ads_parent_cat'] : '',isset($get_data['ads_status']) ? $get_data['ads_status'] : '');

			if (!empty($get_user_listing)) {

				$get_user_listing = $get_user_listing;

			} else {
				$get_user_listing = 'nolisitng';
			}
			
			//show saved search
			$responseArray=[];
			$search_data = $this->Basic_Model->basicSelect('b2b_user_meta','meta_key','save_search','id');
			if (!empty($search_data)) {
				$saved_search = $search_data->result();

				foreach($saved_search as $row){
					$singleResp=[];
					$rowMetaValue=json_decode($row->meta_value);
					if($rowMetaValue && $rowMetaValue->link){
						$get_array= [];
						if (strchr($rowMetaValue->link, "?")) {
							$split_url = explode('?', $rowMetaValue->link);
							parse_str($split_url[1], $get_array);
							$get_array=(array)$get_array;
							//get cat name
							$cat_id = $get_array['parent_cat_select'];
							$cat_name =$this->Categories_Model->get_category_by_id($cat_id);
							$get_array['parent_cat_select']=$cat_name[0]->name;
							//get subcat name
							
							if(isset($get_array['child_cats']) && !empty($get_array['child_cats'])){
								$subcat_id = $get_array['child_cats'];
								$subcat_name =$this->Categories_Model->get_category_by_id($subcat_id);
								$get_array['child_cats']=$subcat_name[0]->name;
							}
							
							
							if(isset($get_array['select_state']) && !empty($get_array['select_state'])){
								$state_cat_id = $get_array['select_state'];
								$state_cat_name =$this->Categories_Model->get_state_by_id($state_cat_id);
								$get_array['select_state']=$state_cat_name[0]->name;
							}
							
							//						print_r($get_array);exit;
							
							if(isset($get_array['country_search']) && !empty($get_array['country_search'])){
								$country_cat_id = $get_array['country_search'];
								$country_cat_name =$this->Categories_Model->get_country_by_id($country_cat_id);
								$get_array['country_search']=$country_cat_name[0]->name;
							}
							

							
							if(isset($get_array['selected_city']) && !empty($get_array['selected_city'])){
								$city_cat_id = $get_array['selected_city'];
								$city_cat_name =$this->Categories_Model->get_city_by_id($city_cat_id);
								$get_array['selected_city']=$city_cat_name[0]->name;
							}
							
						}
						else
						{
							$split_url = explode('/', $rowMetaValue->link);
							$get_array['cat_name']=$split_url[1];
//							$get_array['select_state']="";
//							$get_array['selected_city']="";
//							$get_array['parent_cat_select']="";
//							$get_array['child_cats']="";
//							$get_array['search_query']="";
						}

						$singleResp['id']=$row->id;
						$singleResp['full_url']=$rowMetaValue->link;
						$singleResp['user_id']=$row->user_id;
						$singleResp['link']=$get_array;
						$singleResp['time']=$this->time_elapsed_string($rowMetaValue->time);
						if(isset($get_data['saved_parent_cat']) && $get_data['saved_parent_cat'] == $cat_id){
							$responseArray[]=$singleResp;
						}elseif(isset($get_data['saved_parent_cat']) && empty($get_data['saved_parent_cat']) || !isset($get_data['saved_parent_cat'])){
							$responseArray[]=$singleResp;
						}
					}

				}

			}

			$package_details = $order_meta = [];
			$package_name = 'Free Membership';
			$order_details_key = 'order_details_user_id_' . volgo_get_logged_in_user_id();
			$order_details = $this->cache->get($order_details_key);
			if (! $order_details){
				$order_details = $this->Dashboard_Model->get_user_order_details(volgo_get_logged_in_user_id());
				$this->cache->save($order_details_key, $order_details);
			}
			if(! empty($order_details)){
				$package_details = $order_details->package_details;
				$package_details_arr = unserialize($package_details);
				$package_name = $package_details_arr['package_title'];

				$order_meta = $this->Dashboard_Model->get_user_order_meta($order_details->id);
			}


			$userLink = base_url('member/').volgo_encrypt_message($loged_in_userid);
			$data = [
				'footer_block' => $this->Blocks_Model->get_block('footer_block'),
				'main_categories' => $this->Categories_Model->get_main_cats_for_dashboard(),
				'ads_userid' => $loged_in_userid,
				'user_detail' => $user_detail,
				'user_meta_detail' => $user_meta,
				'all_country' => $country,
				'states' => $states,
				'city' => $city,
				'followers' => $user_detail_of_followers_arr,
				'following' => $user_detail_of_followings_arr,
				'fav_adds' => $get_all_fav_listings,
				'all_cats' => $this->Listingfilterquery_Model->get_all_categories(),
				'user_adds' => $get_user_listing,
				'total_ads_count' => $ads['total_ads_count'],
				'saved_search' => $responseArray,
				'userLink' => $userLink,
				'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_userid),
				'package_details' => $package_details,
				'user_package_title' => $package_name,
				'order_details' => $order_details,
				'order_meta' => $order_meta
			];
			
			$this->load->view('frontend/dashboard/dashboard.php', $data);


		} else {

			redirect('login?redirected_to=' . base_url('dashboard'));
		}
	}
	public function get_user_ads(){
	$page = $_POST['page'];
	$userid = $_POST['ads_userid'];
	$loged_in_userid = (int)volgo_get_logged_in_user_id();
	$ads = $this->Dashboard_Model->get_user_listing($userid, $page, $per_page_limit = 10,isset($get_data['my_ads_parent_cat']) ? $get_data['my_ads_parent_cat'] : '',isset($get_data['ads_status']) ? $get_data['ads_status'] : '');
	$user_adds = $ads['lisitng_detial'];
	if (!empty($user_adds)) {

				$user_adds = $user_adds;

			} else {
				$user_adds = 'nolisitng';
			}
	$html = '';		
	if ($user_adds != "nolisitng"):
		foreach ($user_adds as $single_listing):
        if (is_array($single_listing['metas']) && (!empty($single_listing['metas']))) {
			foreach ($single_listing['metas'] as $metas_fetch) {
			if ($metas_fetch->meta_key == 'images_from') {
			$singleimage = $metas_fetch->meta_value;
			$unserialized_image = unserialize($singleimage);
			$total_iamges = count($unserialized_image);
			if(!empty($unserialized_image)){
			$listing_image = $unserialized_image[0];}
			}

            if ($metas_fetch->meta_key == 'listing_type') {
                $listing_type = $metas_fetch->meta_value;
            }
															
			if ($metas_fetch->meta_key == 'price') {
				$price = $metas_fetch->meta_value;
			}
			if ($metas_fetch->meta_key == 'currency_code') {
				$currnecy_code = $metas_fetch->meta_value;
			}
			if ($metas_fetch->meta_key == 'phone') {
				$phone = $metas_fetch->meta_value;
			}

			}
			}
			if (isset($single_listing['title'])) {
				$slug = base_url() . volgo_make_slug($single_listing['slug']);
			}
			if(!empty($listing_image)){
			$image = UPLOADS_URL . '/listing_images/' . $listing_image;}
			else{$image = volgo_get_no_image_url();}
			if (!isset($total_iamges) || empty($total_iamges)) {
			$total_iamges = 0;
			}
			if (isset($single_listing['title'])) {
				$title = $single_listing['title'];
			}
			if (isset($single_listing['city_name']) && !empty($single_listing['city_name']) && $single_listing['city_name'] != NULL) {
				$city_name = $single_listing['city_name'].' , ';
			}
			if (isset($single_listing['state_name']) && !empty($single_listing['state_name']) && $single_listing['state_name'] != NULL) {
				$state_name = $single_listing['state_name'].' , ';
			}
			if (isset($single_listing['country_name']) && !empty($single_listing['country_name']) && $single_listing['country_name'] != NULL) {
				$country_name = $single_listing['country_name'].' , ';
			}
			if (isset($single_listing['cat_name'])) {
				$cat_name = $single_listing['cat_name'];
				$cat_link = base_url('category/' . volgo_make_slug($single_listing['cat_name']));
			}
			if (isset($single_listing['sub_cat_name'])) {
				$sub_cat_name = $single_listing['sub_cat_name'];
				$sub_cat_link = base_url('category/' . volgo_make_slug($single_listing['sub_cat_name']));
			}
			$default_currnecy_code = volgo_get_currency_unit_by_country_id();
            if(isset($currency_code) && !empty($currency_code)){
                $currency = strtoupper($currency_code);
            }else{
            	$currency = $default_currnecy_code;
            }
            if(!isset($price) || empty($price)){
			$price = 'N/A';
			}
			if (isset($single_listing['created_at'])) {
			$date = new DateTime($single_listing['created_at']);
			$date = date_format($date, "d M Y");
			}
			$html .= '<div class="maindiv"><div class="col-md-12"><div class="holder sec-holder"><div class="lisViewtCatHolder fvt-add clearfix col-sm-12"><div class="lisViewtCatCol col-md-4 col-sm-6 col-xs-12">';												
            $html .= '<a href="'. $slug .'" class="lisViewtCatLink">';
            $html .= '<img src="'. $image .'" alt="lisViewtCatLink">';
            $html .= '</a><a href="javascript:void(0)" class="totalCat">' . $total_iamges . '<i class="fa fa-camera" aria-hidden="true"></i></a></div>';
            $html .= '<div class="lisViewtCatDetail col-md-8 col-sm-12 col-xs-12 myads"><div class="row"><h4>';
            $html .= '<a href="'. $slug .'" class="lisViewtCatLink">' . $title . '</a></h4></div>';
            $html .= '<p class="text-muted">' .$city_name . $state_name . $country_name .'</p>';
            $html .= '<ul class="list-unstyled listBread clearfix"><li><a href="'. $cat_link .'">' . $cat_name . '</a></li>';
            $html .= '<li><a href="'. $sub_cat_link .'">' . $sub_cat_name . '</a></li></ul>';
            if(trim($single_listing['cat_name']) !== "Services" && trim($single_listing['cat_name']) !== "Jobs" && trim($single_listing['cat_name']) !== "Jobs Wanted" && trim($listing_type) !== 'buying_lead' && trim($listing_type) !== 'seller_lead') {
            $html .= '<h5 class="col-md-4 col-sm-6 col-xs-12 text-right">' . $currency . '<span class="detail-price">' . $price . '</span></h5>';
        	}
        	$html .= '</div></div></div>';
        	$html .= '<div class="status-bar"><ul class="status"><li>Status : <span style="color: #e2574c">';
        	if (isset($single_listing['status']) && $single_listing['status'] == 'enabled') {
			$html .= '<span class="active">active</span>';
			}elseif (isset($single_listing['status']) && $single_listing['status'] == 'disabled') {
			$html .= '<span class="pending">pending</span>';
			}else{
			$html .= '<span class="expired">'.$single_listing['status'].'</span>'; 
			}
			if (isset($single_listing['id'])) { 
				$delete_link = base_url('Dashboard/del_listing/') . $single_listing['id'] ."/dashboard#myads";
			}	
			$html .= '</li><li style="font-weight: normal"><i class="fa fa-calendar"></i>' . $date . '</li></ul>';
			$html .= '<div class="edit1"><ul class="pull-right"><li><a href="'.base_url('edit-ad-post/') . $single_listing['id'].'"><span>Edit</span> <i class="fa fa-edit"></i></a></li>';
			$html .= '<li><a href="" data-toggle="modal" data-target="#modal'.$single_listing['id'].'"><span>Share</span> <i class="fa fa-share-alt"></i></a></li>';
			$html .= '<li class="delete"><a class="fav_del_confirm" href="'. $delete_link .'"><span>Delete</span><i class="fa fa-trash"></i></a></li></ul></div></div></div></div>';
			$link = base_url() . $single_listing['slug'];
			$title = $single_listing['title'];
			$images = (empty($listing_image)) ? volgo_get_no_image_url() : UPLOADS_URL . '/listing_images/' . $listing_image;
			$id = $single_listing['id'];
			$html .= include realpath(__DIR__ . '/..') . '/includes/social_share.php';
			endforeach;
		else:
			$html .= '<div class="not_found_das alert alert-info">Post not found</div>';
		endif;
		echo json_encode(['user_ads' => $html]);
        exit;
	}
	public function get_member_ads(){
	$page = $_POST['page'];
	$userid = $_POST['ads_userid'];
	$loged_in_userid = (int)volgo_get_logged_in_user_id();
	$ads = $this->Dashboard_Model->get_user_listing($userid, $page, $per_page_limit = 10,isset($get_data['my_ads_parent_cat']) ? $get_data['my_ads_parent_cat'] : '',isset($get_data['ads_status']) ? $get_data['ads_status'] : '');
	$user_adds = $ads['lisitng_detial'];
	if (!empty($user_adds)) {

				$user_adds = $user_adds;

			} else {
				$user_adds = 'nolisitng';
			}
	$html = '';		
	if ($user_adds != "nolisitng"):
		foreach ($user_adds as $single_listing):
        if (is_array($single_listing['metas']) && (!empty($single_listing['metas']))) {
			foreach ($single_listing['metas'] as $metas_fetch) {
			if ($metas_fetch->meta_key == 'images_from') {
			$singleimage = $metas_fetch->meta_value;
			$unserialized_image = unserialize($singleimage);
			$total_iamges = count($unserialized_image);
			if(!empty($unserialized_image)){
			$listing_image = $unserialized_image[0];}
			}

            if ($metas_fetch->meta_key == 'listing_type') {
                $listing_type = $metas_fetch->meta_value;
            }
															
			if ($metas_fetch->meta_key == 'price') {
				$price = $metas_fetch->meta_value;
			}
			if ($metas_fetch->meta_key == 'currency_code') {
				$currnecy_code = $metas_fetch->meta_value;
			}
			if ($metas_fetch->meta_key == 'phone') {
				$phone = $metas_fetch->meta_value;
			}

			}
			}
			if (isset($single_listing['title'])) {
				$slug = base_url() . volgo_make_slug($single_listing['slug']);
			}
			if(!empty($listing_image)){
			$image = UPLOADS_URL . '/listing_images/' . $listing_image;}
			else{$image = volgo_get_no_image_url();}
			if (!isset($total_iamges) || empty($total_iamges)) {
			$total_iamges = 0;
			}
			if (isset($single_listing['title'])) {
				$title = $single_listing['title'];
			}
			if (isset($single_listing['city_name']) && !empty($single_listing['city_name']) && $single_listing['city_name'] != NULL) {
				$city_name = $single_listing['city_name'].' , ';
			}
			if (isset($single_listing['state_name']) && !empty($single_listing['state_name']) && $single_listing['state_name'] != NULL) {
				$state_name = $single_listing['state_name'].' , ';
			}
			if (isset($single_listing['country_name']) && !empty($single_listing['country_name']) && $single_listing['country_name'] != NULL) {
				$country_name = $single_listing['country_name'].' , ';
			}
			if (isset($single_listing['cat_name'])) {
				$cat_name = $single_listing['cat_name'];
				$cat_link = base_url('category/' . volgo_make_slug($single_listing['cat_name']));
			}
			if (isset($single_listing['sub_cat_name'])) {
				$sub_cat_name = $single_listing['sub_cat_name'];
				$sub_cat_link = base_url('category/' . volgo_make_slug($single_listing['sub_cat_name']));
			}
			$default_currnecy_code = volgo_get_currency_unit_by_country_id();
            if(isset($currency_code) && !empty($currency_code)){
                $currency = strtoupper($currency_code);
            }else{
            	$currency = $default_currnecy_code;
            }
            if(!isset($price) || empty($price)){
			$price = 'N/A';
			}
			if (isset($single_listing['created_at'])) {
			$date = new DateTime($single_listing['created_at']);
			$date = date_format($date, "d M Y");
			}
			$html .= '<div class="lisViewtCatHolder fvt-add clearfix user_dashboard_ads_block">';
			$html .= '<div class="lisViewtCatCol col-md-4 col-sm-6 col-xs-12">';
            $html .= '<a href="'. $slug .'" class="lisViewtCatLink">';
            $html .= '<img src="'. $image .'" alt="lisViewtCatLink">';
            $html .= '</a>';
            $html .= '<a href="javascript:void(0)" class="totalCat">' . $total_iamges . '<i class="fa fa-camera" aria-hidden="true"></i>';
             $html .= '</a></div>';
            $html .= '<div class="lisViewtCatDetail col-md-8 col-sm-12 col-xs-12 myads">';
            $html .= '<div class="row">';
            $html .= '<h4 class="col-md-8 col-sm-6 col-xs-12">';
            $html .= '<a href="'. $slug .'" class="lisViewtCatLink">' . $title . '</a></h4>';
            if(trim($single_listing['cat_name']) !== "Services" && trim($single_listing['cat_name']) !== "Jobs" && trim($single_listing['cat_name']) !== "Jobs Wanted" && trim($listing_type) !== 'buying_lead' && trim($listing_type) !== 'seller_lead') {
            $html .= '<h5 class="col-md-4 col-sm-6 col-xs-12 text-right">' . $currency . '<span class="detail-price">' . $price . '</span></h5></div>';
        	}
        	$html .= '</div>';
        	$html .= '<p class="text-muted">' .$city_name . ' ' . $state_name . ' ' . $country_name .'</p>';
        	$html .= '<ul class="list-unstyled listBread clearfix"><li><a href="javascript:void(0)">' . $cat_name;

        	$html .= '</a></li><li><a href="javascript:void(0)">' . $sub_cat_name . '</a></li></ul>';
            if (!isset($phone) && $phone === '') {
            	$phone = "### ";
            }
			$html .= '<ul class="edit1 call-now">';
			$html .= '<li><span class="number" data-last="' . $phone . '">';
			$html .= '<span><a  target="_blank" class="see"><i class="fa fa-phone" aria-hidden="true"></i> <span class="calls">Call Now </span> </a></span></span></li><li>';
			$idoflisting = [];
		    $listing_fav = $this->Listings_Model->get_favlisting($userId);
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
            if ($user_id_retrived == $loged_in_userid):
               	if (in_array($item['id'], $idoflisting)):
              		$html .= '<a class="saveNow remove_fav_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'" href="#" style=" color: #fff;" ><i class="fa fa-spinner" style="display: none"></i><i class="fa fa-heart" aria-hidden="true"></i> <span> Favourite </span> </a>';
                	$html .= '<a class="saveNow fav_add_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'"
                            href="#" style="display: none;"><i class="fa fa-spinner" style="display: none"></i><i class="fa fa fa-heart" aria-hidden="true"></i><span> Favourite </span></a>';
                else:
                    $html .= '<a class="saveNow fav_add_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'" href="#"><i class="fa fa-spinner" style="display: none"></i><i
                            class="fa fa-heart" aria-hidden="true"></i> <span> Favourite </span></a>';
                    $html .= '<a class="saveNow remove_fav_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'"
                            href="#" style="display: none; "><i class="fa fa-spinner" style="display: none"></i><i class="fa fa-heart" aria-hidden="true"></i> <span> Favourite </span> </a>';
                endif;
            else:
                $html .= '<a class="saveNow fav_add_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'" href="#" style="" > <i class="fa fa-spinner" style="display: none"></i><i class="fa fa-heart" aria-hidden="true"></i> <span> Favourite </span>
                            </a>';
                $html .= '<a class="saveNow remove_fav_listing btn  save-now-btn text-capitalize" data-lisitngid="' . $item['id'] .'" data-user_id="' . $loged_in_userid .'" href="#" style="display: none;"> <i class="fa fa-spinner"
                            style="display: none"></i><i class="fa fa-heart" aria-hidden="true"></i>
                            <span> Favourite </span> </a>';
        endif;
        $html .= '</li>';
        $data_listing_slug = volgo_make_slug($single_listing['title']);
        $html .= '<li class="rep"><a href="' . base_url('flagreports/index/'). $loged_in_userid . '/' . $data_listing_slug . '">'; 
        $html .= '<i class="fa fa-flag"></i><span class="savit">Report Now</span>'; 
        $html .= '</a></li></ul></div></div>';               
			
			endforeach;
		else:
			$html .= '<div class="not_found_das alert alert-info">Post not found</div>';
		endif;
		echo json_encode(['user_ads' => $html]);
        exit;
	}
	public function user_listing($rawId){

		$userId = volgo_decrypt_message($rawId);
		$get_data = $this->input->get();
		$loged_in_userid = volgo_get_logged_in_user_id();
		$user_detail = $this->Dashboard_Model->get_curent_user_detail_by_id($userId);


		if (!empty($user_detail)) {

			$user_meta = $this->Dashboard_Model->get_user_meta($userId);

			foreach ($user_meta as $single_meta) {
				if ($single_meta->meta_key == 'nationality') {
					$countryid = $single_meta->meta_value;
				}
				if ($single_meta->meta_key == 'states') {
					$state_id = $single_meta->meta_value;
				}
			}
		}

		$ads = $this->Dashboard_Model->get_user_listing($userId,$page = 1, $per_page_limit = 10,isset($get_data['parent-cat']) ? $get_data['parent-cat'] : '');
		$get_user_listing = $ads['lisitng_detial'];
		if (!empty($get_user_listing)) {

			$get_user_listing = $get_user_listing;

		} else {
			$get_user_listing = 'nolisitng';
		}
		$userLink = base_url('member/').volgo_encrypt_message($userId);

		$followers = $this->Dashboard_Model->get_followers($userId);
		if (!empty($followers)) {
			$user_detail_of_followers = [];
			foreach ($followers as $single_user_id) {
				$user_detail_of_followers[] = $this->Dashboard_Model->get_users_detail($single_user_id);
			}

		} else {
			$user_detail_of_followers = '';
		}

		$following = $this->Dashboard_Model->get_followings($userId);
		
		if (!empty($following)) {
			$user_detail_of_followings = [];
			foreach ($following as $single_user_id) {
				$user_detail_of_following[] = $this->Dashboard_Model->get_users_detail($single_user_id);
			}
		} else {
			$user_detail_of_following = '';
		}

		$data = [
			'ads_userid' => $userId,
			'user_detail' => $user_detail,
			'user_meta_detail' => $user_meta,
			'user_adds' => $get_user_listing,
			'total_ads_count' => $ads['total_ads_count'],
			'userLink' => $userLink,
			'listing_fav' => $this->Listings_Model->get_favlisting($userId),
			'followers' => $user_detail_of_followers,
			'following' => $user_detail_of_following,
			'listing_follow' => $this->Listings_Model->get_follow_listing($loged_in_userid),
			'main_categories' => $this->Categories_Model->get_main_cats_for_dashboard(),
		];

		$this->load->view('frontend/dashboard/user_dashboard.php', $data);
	}

	public function insert()
	{

		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);
		$logedin_user_email = $session_data[0];
		$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

		if (!empty($user_detail)) {

			$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);

		}

		$input_data = filter_input_array(INPUT_POST);


		$firstname = $input_data['firstname'];
		unset($input_data['firstname']);
		$lastname = $input_data['lastname'];
		unset($input_data['lastname']);
		

		if (isset($_FILES['cv']) && !empty($_FILES['cv']['name'][0])) {

            $path = BACKEND_PATH . 'uploads/cvs/';

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'pdf|doc|docx|txt|xps';
			$config['max_size'] = '4096';

			$this->load->library('upload', $config);
			$this->upload->display_errors('', '');

			if (!$this->upload->do_upload("cv")) {
				$this->session->set_flashdata('validation_errors', $this->upload->display_errors());
				redirect('dashboard');
				
			} else {
				$upload_result = $this->upload->data();
				$cv = $upload_result['file_name'];
			}


		} else {
			foreach ($user_meta as $single_meta) {
				if ($single_meta->meta_key == 'user_cv') {
					$cv = $single_meta->meta_value;
				}


			}

		}


		if (!empty($firstname)) {
			$update_firstname = $this->Dashboard_Model->update_firstname($firstname, $user_detail[0]->id);
		}
		if (!empty($lastname)) {
			$update_lastname = $this->Dashboard_Model->update_lastname($lastname, $user_detail[0]->id);
		}
		$input_data['user_cv'] = $cv;
		$dbinsertdata = $this->Dashboard_Model->insert_metas_for_user($input_data, $user_detail[0]->id);


		if ($dbinsertdata) {
			if (volgo_front_is_logged_in()) {
				$this->session->set_flashdata('success_msg', 'Profile Updated successfully.');
				redirect('dashboard');
			} else {
				redirect('login');
			}
		} else {

			if (volgo_front_is_logged_in()) {
				$this->session->set_flashdata('validation_errors', 'Some Error Occur Try Agian.');
				redirect('dashboard');
			} else {
				redirect('login');
			}

		}


	}

	public function passwordUpdate(){
		$input_data = filter_input_array(INPUT_POST);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() !== false) {
			$password = $input_data['password'];
			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);
			if (!empty($password)) {
				$update_password = $this->Dashboard_Model->update_password($password, $user_detail[0]->id);
				if ($update_password) {
					if (volgo_front_is_logged_in()) {
						$this->session->set_flashdata('success_msg', 'Password Updated successfully please login again.');
						$this->session->unset_userdata('volgo_user_login_data');
						redirect('login');
					} else {
						redirect('login');
					}
				} else {
		
					if (volgo_front_is_logged_in()) {
						$this->session->set_flashdata('validation_errors', 'Some Error Occur Try Agian.');
						redirect('dashboard');
					} else {
						redirect('login');
					}
		
				}
			}
		}else {
			$this->session->set_flashdata('validation_errors', validation_errors());
			redirect('dashboard');
		}
	}
	public function follow($user_id_of_user, $slug)
	{
		if (!empty($_SESSION['volgo_user_login_data'])) {

			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

			if (!empty($user_detail)) {

				$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);
				$loged_in_user_id = $user_detail[0]->id;

			}
		} else {
			redirect('login?redirected_to=' . base_url($slug));
		}


		$followers = $this->Dashboard_Model->store_followers($user_id_of_user, $user_detail[0]->id);


		if ($followers) {


			redirect('' . base_url($slug));

		} else {
			redirect('' . base_url($slug));
		}


	}

	public function unfollow($user_id_of_user, $slug)
	{


		if (!empty($_SESSION['volgo_user_login_data'])) {

			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

			if (!empty($user_detail)) {

				$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);
				$loged_in_user_id = $user_detail[0]->id;

			}
		} else {
			redirect('login?redirected_to=' . base_url($slug));
		}

		$unfollowers = $this->Dashboard_Model->unstore_followers($user_id_of_user, $user_detail[0]->id);

		if ($unfollowers) {

			redirect('' . base_url($slug));

		}


	}

	public function unfollow_dashboard($user_id_of_user,$slug='')
	{
		if (!empty($_SESSION['volgo_user_login_data'])) {

			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

			if (!empty($user_detail)) {

				$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);
				$loged_in_user_id = $user_detail[0]->id;

			}
		} else {
			redirect('login?redirected_to=' . base_url($slug));
		}

		$unfollowers = $this->Dashboard_Model->unstore_followers($user_detail[0]->id, $user_id_of_user);

		if ($unfollowers) {

			redirect('' . base_url($slug));

		} else {

			"contact administrator";
		}

	}


	public function unfollowing_dashboard($user_id_of_user,$slug='')
	{
		
		if (!empty($_SESSION['volgo_user_login_data'])) {

			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
			$logedin_user_email = $session_data[0];
			$user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

			if (!empty($user_detail)) {

				$user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);
				$loged_in_user_id = $user_detail[0]->id;

			}
		} else {
			redirect('login?redirected_to=' . base_url($slug));
		}
		
		$unfollowers = $this->Dashboard_Model->unstore_followings($user_detail[0]->id, $user_id_of_user);
		//$unfollowers = $this->Dashboard_Model->remove_follow_add($user_id_of_user, $user_detail[0]->id);
		
		if ($unfollowers) { 
			$url = base_url(). 'dashboard#following'; 
			redirect($url);
		} else {
			"contact administrator";
		}

	}


	public function deactivateacuton($id)
	{

		$soft_delete = $this->Dashboard_Model->soft_delete($id);

		if ($soft_delete) {
			$this->session->sess_destroy();
			redirect("home");
		}


	}


	public function fav_add()
	{

		if ($_POST["userid"] == 0) {

			echo json_encode("nolog");
			exit();
		}
		if (!empty($_POST["listing_id"]) && !empty($_POST["userid"])) {


			$listing_id = $this->input->post('listing_id');
			$loged_in_userid = $this->input->post('userid');

			$fav_adss = $this->Dashboard_Model->fav_add($listing_id, $loged_in_userid);
			if (isset($fav_adss)){
			if (isset($listing_id)){
				$this->delete_cache(
					$listing_id
				);

				$this->create_cache(
					$listing_id
				);
			}
			}
			echo json_encode($fav_adss);
			exit();
		}

	}
	public function follow_add()
	{

		if ($_POST["loged_in_userid"] == 0) {

			echo json_encode("nolog");
			exit();
		}
		if (!empty($_POST["listing_id"]) && !empty($_POST["loged_in_userid"])) {	
			$listing_id = $this->input->post('listing_id');
			$loged_in_userid = $this->input->post('loged_in_userid');
			$selleremail = $this->input->post('selleremail');
			
			$follow_adss = $this->Dashboard_Model->follow_add($listing_id, $loged_in_userid);
			
			if($follow_adss && $follow_adss === 'follow_added'){
				// Follower Update  Email 
				if($selleremail && !empty($selleremail)){

				// $username = volgo_get_username_by_uid ($loged_in_userid);
				// $fullname = volgo_get_user_name_by_uid ($loged_in_userid);
				// $fullname = volgo_get_logged_in_user_data ($loged_in_userid);
				// $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
				// $session_data = explode(',', $session_data);
				// $email = $session_data[0];
				// $user_data = $this->Dashboard_Model->get_curent_user_detail($email);

				$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
				$session_data = explode(',', $session_data);
				$email = $session_data[0];
				$user_data = $this->Dashboard_Model->get_curent_user_detail($email);

				$siteurl = base_url();
				$firstname = $user_data[0]->firstname;
				$lastname = $user_data[0]->lastname;
				$username = $user_data[0]->username;
				$fullname = $firstname.' '.$lastname;
				
				$msg = str_replace('%%fullname%%', $fullname, EMAIL_FOR_NEW_FOLLOWER);
                $msg = str_replace('%%username%%', $username, $msg);
                $msg = str_replace('%%firstname%%', $firstname, $msg);
                $msg = str_replace('%%lastname%%', $lastname, $msg);
                $msg = str_replace('%%email%%', $email, $msg);
                $msg = str_replace('%%siteurl%%', $siteurl, $msg);
                //$msg = str_replace('%%mobile%%', $input_data['mobile-number'], $msg);
                $emailto = $selleremail;
                $emailfrom = NEWSLETTER_FROM_EMAIL;
                $subject = 'NEW FOLLOWER |' . SITE_NAME;
                volgo_send_email($msg,$subject,$emailto,$emailfrom);
			}
			}
			echo json_encode($follow_adss);
			exit();
		}

	}
	public function remove_fav()
	{

		if ($_POST["userid"] == 0) {

			return "nolog";
		}
		if (!empty($_POST["listing_id"]) && !empty($_POST["userid"])) {


			$listing_id = $this->input->post('listing_id');
			$loged_in_userid = $this->input->post('userid');

			$remove = $this->Dashboard_Model->remove_fav_add($listing_id, $loged_in_userid);
			if (isset($remove)){
			if (isset($listing_id)){
				$this->delete_cache(
					$listing_id
				);

				$this->create_cache(
					$listing_id
				);
			}
			}
			echo json_encode($remove);
			exit();
		}

	}

	public function remove_follow()
	{

		if ($_POST["userid"] == 0) {

			return "nolog";
		}
		if (!empty($_POST["listing_id"]) && !empty($_POST["userid"])) {


			$listing_id = $this->input->post('listing_id');
			$loged_in_userid = $this->input->post('userid');

			$remove = $this->Dashboard_Model->remove_follow_add($listing_id, $loged_in_userid);

			echo json_encode($remove);
			exit();
		}

	}


	public function search_fav_add($listing_id, $slug, $slug2)
	{

		$loged_in_userid = volgo_get_logged_in_user_id();
		if (empty($loged_in_userid)) {
			redirect('login?redirected_to=' . base_url($slug));
		}

		$fav_adss = $this->Dashboard_Model->save_search_add($listing_id, $loged_in_userid);

		if ($fav_adss) {

			redirect('' . base_url($slug . '/' . $slug2));
		}


	}

	public function remove_search_fav_add($listing_id, $slug, $slug2)
	{

		$loged_in_userid = volgo_get_logged_in_user_id();
		if (empty($loged_in_userid)) {
			redirect('login?redirected_to=' . base_url($slug));
		}

		$removfav_adss = $this->Dashboard_Model->remove_save_search_add($listing_id, $loged_in_userid);

		if ($removfav_adss) {

			redirect('' . base_url($slug . '/' . $slug2));
		}


	}


	public function remove_fav_add($listing_id, $slug)
	{

		$loged_in_userid = volgo_get_logged_in_user_id();
		if (empty($loged_in_userid)) {
			redirect('login?redirected_to=' . base_url($slug));
		}

		$removfav_adss = $this->Dashboard_Model->remove_fav_add($listing_id, $loged_in_userid);

		if ($removfav_adss) {

			redirect('' . base_url($slug));
		}


	}

	public function del_listing($id,$slug='')
	{

		$soft_delete = $this->Dashboard_Model->listing_delete($id);

		if ($soft_delete) {

			redirect($slug);
		} else {
			echo "Contact Administrator";
		}


	}

	public function save_search_history(){

		$loged_in_user_id = volgo_get_logged_in_user_id();
		$url = $this->agent->referrer();
		$link = str_replace(base_url(), '', $url);
		$meta_array = [
			'link' => $link,
			'time' => date("Y-m-d H:i:s"),
		];
		$meta_value = json_encode($meta_array);
		//save search
		$insert_id = $this->Dashboard_Model->save_search($loged_in_user_id, $meta_value);

		$this->session->set_userdata('search_history_id',$insert_id);
		$data = [
			'loged_in_user_id' => $loged_in_user_id,
			'insert_id' => $insert_id,
		];
		echo json_encode($data);
		exit();

	}

	public function remove_search_history(){
		if($this->session->userdata('search_history_id') !== ''){
			$link = $_POST['link'];
			$time = $_POST['time'];
			$meta_array = [
			'link' => $link,
			'time' => $time
			];
			$delete_id = $_POST['search_id'];
			$loged_in_user_id = volgo_get_logged_in_user_id();
			if(!$loged_in_user_id){
				$loged_in_user_id = $_POST['user_id'];
			}
			$meta_value = json_encode($meta_array);
			
			//$delete_id = $this->session->userdata('search_history_id');
			$this->Basic_Model->remove_search_history($meta_value,$loged_in_user_id,$delete_id);
			$this->session->unset_userdata('search_history_id');
			echo ("removed");
			exit;
		}
	}

	public function test(){

		$search_data = $this->Basic_Model->basicSelect('b2b_user_meta','meta_key','save_search');
//		print_r($search_data->result());exit;
		if (!empty($search_data)) {
			$saved_search = $search_data->result();

			$responseArray=[];

			foreach($saved_search as $row){
				$singleResp=[];
				$rowMetaValue=json_decode($row->meta_value);
//				print_r($rowMetaValue); exit;
				if($rowMetaValue && $rowMetaValue->link){
					$get_array= [];
					if (strchr($rowMetaValue->link, "?")) {
						$split_url = explode('?', $rowMetaValue->link);
						parse_str($split_url[1], $get_array);
						$get_array=(array)$get_array;
						//get cat name
						$cat_id = $get_array['parent_cat_select'];
						$cat_name =$this->Categories_Model->get_category_by_id($cat_id);
						$get_array['parent_cat_select']=$cat_name[0]->name;
						//get subcat name
						$subcat_id = $get_array['child_cats'];
						$subcat_name =$this->Categories_Model->get_category_by_id($subcat_id);
						$get_array['child_cats']=$subcat_name[0]->name;

						$state_cat_id = $get_array['select_state'];
						$state_cat_name =$this->Categories_Model->get_state_by_id($state_cat_id);
						$get_array['select_state']=$state_cat_name[0]->name;
//						print_r($get_array);exit;
						$country_cat_id = $get_array['country_search'];
						$country_cat_name =$this->Categories_Model->get_country_by_id($country_cat_id);
						$get_array['country_search']=$country_cat_name[0]->name;

						$city_cat_id = $get_array['selected_city'];
						$city_cat_name =$this->Categories_Model->get_city_by_id($city_cat_id);
						$get_array['selected_city']=$city_cat_name[0]->name;



					}
					else
					{
						$split_url = explode('/', $rowMetaValue->link);
						$get_array['cat_name']=$split_url[1];
						$get_array['select_state']="";
						$get_array['selected_city']="";
						$get_array['parent_cat_select']="";
						$get_array['child_cats']="";
						$get_array['search_query']="";
					}

					$singleResp['id']=$row->id;
					$singleResp['full_url']=$rowMetaValue->link;
					$singleResp['user_id']=$row->user_id;
					$singleResp['link']=$get_array;
					$singleResp['time']=$this->time_elapsed_string($rowMetaValue->time);
					$responseArray[]=$singleResp;
				}

			}
			print_r($responseArray);
			exit;

		}
	}
	public	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';

	}

	function delete_dashboard_search(){
		$id = $this->input->post('del_id');
		$this->Basic_Model->basicDelete('b2b_user_meta','id',$id);
		echo ("removed");
		exit;

	}

	public function update_profile_pic(){
		if (!empty($_FILES['file']['name'])) {
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);
		 
		if ($this->upload->do_upload('file')) {
		$this->Dashboard_Model->Uploadimage();
		}
		}
	}
	private function delete_cache($listing_id){
	if($listing_id){
	unlink((VOLGO_FRONTEND_CACHE_PATH . '__GET_LISTING_META_DATA_OF_'.$listing_id.'__'));
	}
	}
	private function create_cache($listing_id){
		if($listing_id){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$cache_key = '/__GET_LISTING_META_DATA_OF_'.$listing_id.'__';
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
	}

}
