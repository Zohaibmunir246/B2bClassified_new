<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewlisting extends CI_Controller
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
		$this->load->library('pagination');
		$this->load->model('User_Model');
	}

	public function index()
	{
		$config = array();
		
		if ($_GET){
			$total_row = $this->Listing_Model->record_count_search_listings($_GET);
			$config["base_url"] =  base_url('/viewlisting/index?').http_build_query(array_merge($_GET));
			$config['page_query_string'] = TRUE;
			$page = $this->input->get('per_page', TRUE);
			if (isset($page)) {
				$page = $page;
			} else {
				$page = 1;
			}
		}else{
			$total_row = $this->Listing_Model->record_count_listings();
			$config["base_url"] = base_url() . "viewlisting/index";
			$config['page_query_string'] = false;
			if ($this->uri->segment(3)) {
			$page = ($this->uri->segment(3));
			} else {
				$page = 1;
			}
		}
		
		$config["total_rows"] = $total_row;
		$config["per_page"] = 20;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 50;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		
		if ($_GET){
			$data = [
				'total_row' => $total_row,
				'all_list' => $this->Listing_Model->search_listing_from_db($_GET,$config["per_page"], $page)
			];

		}else {
			$data = [
				'all_list' => $this->Listing_Model->get_all_listing($config["per_page"], $page)
			];
		}
		
		$str_links = $this->pagination->create_links();

		$data["links"] = explode('&nbsp;', $str_links);


		$this->load->view('admin/listing/viewlisting', $data);
	}

	public function byuser($id)
	{

		$data = [
			'all_list' => $this->Listing_Model->get_all_listing_by_user($id),
		];


		$this->load->view('admin/listing/viewlisting', $data);
	}
	public function bycat($id)
	{

		$data = [
			'all_list' => $this->Listing_Model->get_all_listing_by_cat($id),
		];


		$this->load->view('admin/listing/viewlisting', $data);
	}
    public function pendinglisting()
	{
		if ($search_term = $this->input->get('s')){
			$data = [
				'all_list' => $this->Listing_Model->search_pending_listing_from_db($search_term)
			];
		}else {
            
			$data = [
				'all_list' => $this->Listing_Model->get_all_pending_listing_new()
			];
		}
		
		$this->load->view('admin/listing/approvelisting', $data);
	}

	public function approve_listing()
	{

		$is_updated = $this->Listing_Model->approve_multiple_listings($_POST['input']);
		
		if($is_updated){
			//$json = file_get_contents($this->json_url, FALSE, NULL);
			echo json_encode(['status' => 'success']);
			exit;
		}else{
			echo json_encode(['status' => 'error']);
			exit;
		}
	}

}
