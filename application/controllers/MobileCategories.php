<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileCategories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Categories_Model');
        $this->load->model('Listings_Model');
    }

    public function index()
    {
        // Some code goes here
		echo 'this is categories controller';
    }

	public function show_by_slug($slug)
	{die;
		$this->load->view('frontend/category/single-category.php', ['slug' => $slug]);
    }

	public function buying_lead_show_by_slug($slug)
	{
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
		$buying_leads_parents = $this->Categories_Model->is_buying_lead_parent_cat($slug);
		
		if($buying_leads_parents){
			$jsonManipulation = (new \application\classes\JsonManipulation());
			$cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
			$cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
			$data = [
				'cat_name' => $cat_name,
				'buying_leads' => $this->Categories_Model->get_child_cats_by_parent_id($cat_id, $orderby_column = "", $direction = "")
			]; 
			return $this->load->view('frontend-mobile/buying-lead/view', $data);
		}
		$country_name = $this->input->get('cc');
		$id = '';
		if (! empty($country_name) && ! is_null($country_name)){

			$country_name = volgo_decrypt_message($country_name);
			$country_data = volgo_get_country_id_by_name($country_name, 'id');
			if (! empty($country_data))
				$id = $country_data->id;
		}

		$data = [
			'buying_leads' => $this->Categories_Model->get_all_listings_by_cat_slug($slug, $id,'buying_lead')
		];



		$this->load->view('frontend-mobile/buying-lead/all', $data);
    }

	public function seller_lead_show_by_slug($slug)
	{
		$buying_leads_parents = $this->Categories_Model->is_buying_lead_parent_cat($slug);
		
		if($buying_leads_parents){
			$jsonManipulation = (new \application\classes\JsonManipulation());
			$cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
			$cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
			$data = [
				'cat_name' => $cat_name,
				'buying_leads' => $this->Categories_Model->get_child_cats_by_parent_id($cat_id, $orderby_column = "", $direction = "")
			]; 
			return $this->load->view('frontend-mobile/buying-lead/view', $data);
		}
		$country_name = $this->input->get('cc');
		$id = '';
		if (! empty($country_name) && ! is_null($country_name)){

			$country_name = volgo_decrypt_message($country_name);
			$country_data = volgo_get_country_id_by_name($country_name, 'id');
			if (! empty($country_data))
				$id = $country_data->id;
		}

		$data = [
			'seller_leads' => $this->Categories_Model->get_all_listings_by_cat_slug($slug, $id,'seller_lead')
		];
		
		$this->load->view('frontend-mobile/seller-lead/all', $data);
	}
}
