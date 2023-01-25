<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 3/21/2019
 * Time: 4:18 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Mobile_listing_search extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Blocks_Model');
		$this->load->model('Listingquery_Model');
		$this->load->model('Listingfilterquery_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Listings_Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('user_agent');
	}


	public function sidebar()
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


		$counrty = isset($get_data['country_search']) ? $get_data['country_search'] : '';
		$state = isset($get_data['select_state']) ? $get_data['select_state'] : '';
		$city = isset($get_data['selected_city']) ? $get_data['selected_city'] : '';
		$parent_cat = isset($get_data['parent_cat_select']) ? $get_data['parent_cat_select'] : '';
		$child_cat = isset($get_data['child_cats']) ? $get_data['child_cats'] : '';
		$search_query = isset($get_data['search_query']) ? $get_data['search_query'] : '';

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
		unset ($get_data['search_query']);


		$page = $this->input->get('per_page', TRUE);
		if (! isset($page)) {
			$page = 1;
		}
		$metas = $get_data;
 		$per_page_limit = 10;

		$listings = $this->Listings_Model->header_advance_search($state, $city, $parent_cat, $child_cat, $search_query, $metas, $page, $per_page_limit, $counrty);
		
		$totalcounts = $listings['total_record'];

		unset ($listings['total_record']);


		$query_string =  $this->input->server('QUERY_STRING');

		$settings = $this->config->item('pagination');
    	$settings["base_url"] = base_url('/listingsearch/sidebar?').http_build_query(array_merge($_GET));
		$settings['page_query_string'] = TRUE;
		$settings["total_rows"] = $totalcounts;
		$settings["per_page"] = $per_page_limit;
		$records_per_page = ceil($totalcounts/$per_page_limit);
		if (intval($this->uri->segment(4))) {
			$page = intval(($this->uri->segment(4)));
		}
		if($records_per_page == $page)
    	$settings['num_links']    =   6;
		$this->pagination->initialize($settings);

		$str_links = $this->pagination->create_links();
		$total_count_row = '';
		
		$loged_in_user_id = volgo_get_logged_in_user_id();
		if (!empty($loged_in_user_id)) {
			$loged_in_user_id = $loged_in_user_id;
			if(isset($get_data)){
				$url = base_url('/listingsearch/sidebar?').http_build_query(array_merge($_GET));
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
		];

		if (isset($str_links))
			$data["links"] = explode('&nbsp;', $str_links);


		$this->load->view('frontend/listing_page/default-listing', $data);


	}


}
