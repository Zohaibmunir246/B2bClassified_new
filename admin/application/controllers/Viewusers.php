<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/12/2019
 * Time: 5:36 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewusers extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('pagination');
		$this->load->model('User_Model');
		$this->load->library('form_validation');

	}

	public function index()
	{

		$this->view();
	}

	public function view($page = '')
	{

		$config = array();
		$config["base_url"] = base_url() . "viewusers/view";
		$total_row = $this->User_Model->record_count_users();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 20;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		if ($this->uri->segment(3)) {
			$page = ($this->uri->segment(3));
		} else {
			$page = 1;
		}

		$data["results"] = $this->User_Model->fetch_data_all_users($config["per_page"], $page);

		$str_links = $this->pagination->create_links();

		$data["links"] = explode('&nbsp;', $str_links);

		$this->load->view('admin/users/view_users', $data);

	}

	public function fetch_users()
	{
		$all_users = $this->User_Model->get_all_user(-1);

		return $total_rows = count($all_users);

	}

	public function search($page = '')
	{
		$input_data = $this->input->get('search');
		$search = $input_data;

//volgo_debug($search);
		$config = array();
		$config["base_url"] = base_url() . "viewusers/search/";
		$total_row = $this->User_Model->record_count_search_users($search);

		$config['use_page_numbers'] = true;
		$config['query_string_segment'] = 'pagenumber';
		$config['page_query_string'] = true;
		$config['reuse_query_string'] = true;
		$config["total_rows"] = $total_row;
		$config["per_page"] = 20;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		if ($this->uri->segment(3)) {
			$page = ($this->uri->segment(3));
		} else {
			$page = 1;
		}


		$data["results"] = $this->User_Model->fetch_data_search_all_users($config["per_page"], $page, $search);

		$str_links = $this->pagination->create_links();

		$data["links"] = explode('&nbsp;', $str_links);

		$this->load->view('admin/users/view_users', $data);

	}

	public function delete($delte_id = '')
	{
		if (empty($delte_id))
			redirect('sorry');

		if ($this->User_Model->remove($delte_id)) {
			$this->session->set_flashdata('removed', 'success');

			redirect('Viewusers');
		} else {
			redirect('Viewusers');
		}
	}

	public function edit($edit_id)
	{
		if (empty($edit_id))
			redirect('sorry');

		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);
		$input_data = $edit_id;
		$usermetas =  $this->User_Model->get_current_user_meta($input_data);
		$usermetaimage =  $this->User_Model->get_current_user_meta_image($input_data);


		$data = [
			'edit_users' => $this->User_Model->get_current_user($input_data),
			'edit_users_meta' => $usermetas,
			'edit_users_meta_imgae' => $usermetaimage,
			'all_cuntry' => $this->User_Model->get_all_countries(),
		];


		$this->load->view('admin/users/edit_users_details', $data);
	}


}
/// end of class controller

