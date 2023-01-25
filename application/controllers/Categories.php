<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Seo_Model');
        $this->load->model('Categories_Model');
        $this->load->model('Listings_Model');
        $this->load->library('pagination');
    }

    public function index()
    {
        // Some code goes here
		echo 'this is categories controller';
    }

	public function show_by_slug($slug)
	{
		$this->load->view('frontend/category/single-category.php', ['slug' => $slug]);
    }

	public function buying_lead_show_by_slug($slug, $per_page_limit = 10, $page = 1)
	{
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/

		$jsonManipulation = (new \application\classes\JsonManipulation());
		$buying_leads_parents = $jsonManipulation->is_lead_parent_cat($slug);
        $cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
        $cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
        $cat_name = volgo_make_slug($cat_name);

        $seo_data = $this->Seo_Model->get_page_seo('buying-lead', $cat_name);

		if($buying_leads_parents){
			
			$cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
			$cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
			$data = [
				'cat_name' => $cat_name,
				'buying_lead_sub_cats' => $jsonManipulation->get_cat_child_cats($cat_id)];
   
            $data['seo_data'] = $seo_data;

			return $this->load->view('frontend/buying-lead/view-single', $data);
		}
		$country_name = $this->input->get('cc');
		$id = '';
		if (! empty($country_name) && ! is_null($country_name)){

			$country_name = volgo_decrypt_message($country_name);

			$country_data = volgo_get_country_id_by_name($country_name, 'id');
			if (! empty($country_data))
				$id = $country_data->id;
		}



		$buying_leads_records = $this->Categories_Model->get_all_listings_by_cat_slug($slug, $id, 'buying_lead', $per_page_limit  , $page);
		$total_records = $buying_leads_records['total_buying_leads_cont'];

        $settings = $this->config->item('pagination');
        $settings['page_query_string'] = false;
        $settings["base_url"] = base_url('/buying-lead/') . $cat_name . '/' .  $per_page_limit;
        $settings["uri_segment"] = 4;
        $settings["total_rows"] = $total_records;
        $settings["per_page"] = $per_page_limit;
        $settings['display_pages'] = TRUE;
        $settings['use_page_numbers'] = TRUE;
        // get last page number

        $last_page_no = ceil($total_records/$per_page_limit);

        if($last_page_no == $page)
            $settings['num_links'] = 6;
        $this->pagination->initialize($settings);

        $str_links = $this->pagination->create_links();

		$data = [
			'buying_leads' => $buying_leads_records,
            'all_counts_result' => $this->Listings_Model->counts_reults(),
		];

        $data['seo_data'] = $seo_data;        

        if (isset($str_links))
            $data["links"] = explode('&nbsp;', $str_links);

		$this->load->view('frontend/buying-lead/all', $data);
    }

	public function seller_lead_show_by_slug($slug, $per_page_limit = 10, $page = 1)
	{ 
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$selling_leads_parents = $jsonManipulation->is_lead_parent_cat($slug);
        $cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
        $cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);
        $cat_name = volgo_make_slug($cat_name);

        $seo_data = $this->Seo_Model->get_page_seo('seller-lead', $cat_name);

		if($selling_leads_parents){
			$jsonManipulation = (new \application\classes\JsonManipulation());
			$cat_id = $jsonManipulation->get_buying_or_seller_cat_id_from_cat_slug($slug);
			$cat_name = $jsonManipulation->get_category_name_from_cat_id($cat_id);

			$data = [
				'cat_name' => $cat_name,
				'selling_lead_sub_cats' => $jsonManipulation->get_cat_child_cats($cat_id)
			];

            $data['seo_data'] = $seo_data;

			return $this->load->view('frontend/seller-lead/view-single', $data);
		}
		$country_name = $this->input->get('cc');
		$id = '';
		if (! empty($country_name) && ! is_null($country_name)){

			$country_name = volgo_decrypt_message($country_name);
			$country_data = volgo_get_country_id_by_name($country_name, 'id');

			if (! empty($country_data))
				$id = $country_data->id;
		}

        $selling_leads_records = $this->Categories_Model->get_all_listings_by_cat_slug($slug, $id, 'buying_lead', $per_page_limit  , $page);
        $total_records = $selling_leads_records['total_buying_leads_cont'];

        $settings = $this->config->item('pagination');
        $settings['page_query_string'] = false;
        $settings["base_url"] = base_url('/seller-lead/') . $cat_name . '/' .  $per_page_limit;
        $settings["uri_segment"] = 4;
        $settings["total_rows"] = $total_records;
        $settings["per_page"] = $per_page_limit;
        $settings['display_pages'] = TRUE;
        $settings['use_page_numbers'] = TRUE;

        // get last page number

        $last_page_no = ceil($total_records/$per_page_limit);

        if($last_page_no == $page)
            $settings['num_links'] = 6;
        $this->pagination->initialize($settings);

        $str_links = $this->pagination->create_links();

		$data = [
			'seller_leads' => $selling_leads_records,
            'all_counts_result' => $this->Listings_Model->counts_reults(),
		];

        $data['seo_data'] = $seo_data;

        if (isset($str_links))
            $data["links"] = explode('&nbsp;', $str_links);
		
		$this->load->view('frontend/seller-lead/all', $data);
	}
}
