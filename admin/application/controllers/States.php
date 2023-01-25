<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/15/2019
 * Time: 4:16 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class States extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->model('State_Model');
	}

	public function index()
	{

        $config = array();
        $config["base_url"] = base_url() . "states";
        $config["total_rows"] = $this->State_Model->get_count();
        $config["per_page"] = 100;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		if ($this->input->get('s')){
			$data['states'] = $this->State_Model->get_state_from_db($this->input->get('s'));
		}else {
			$data["links"] = $this->pagination->create_links();
			$data['states'] = $this->State_Model->get_states($config['per_page'],  $page);
		}

		$this->load->view('admin/extras/states/index', $data);
	}

	public function addnew()
	{
		$data = [
			'countries' => $this->db->select('*')->from('b2b_countries')->get()->result_object()
		];

		if (! empty($this->input->post())){

			$input_data = filter_input_array(INPUT_POST);
			$this->form_validation->set_rules('country_id', 'Country ID', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('state_name', 'State Name', 'required|min_length[1]');

			if ($this->form_validation->run() !== false) {

				$this->State_Model->create(
					$data = [
						'name' => $this->input->post('state_name'),
						'country_id' => intval($this->input->post('country_id'))
					]
				);

				$this->session->set_flashdata('success_msg', "State with title " . $this->input->post('state__name') . " has been added");
				redirect(base_url('states'));

			}else {
				$data['validation_errors'] = validation_errors();
				$this->load->view('admin/extras/states/add-state', $data);
			}
		}else {
			$this->load->view('admin/extras/states/add-state', $data);
		}
	}

	// mohsin's code here 
	public function edit_state($state_id = '')
	{
		if (empty($state_id) || ! intval($state_id))
			redirect('sorry');

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('state_name', 'State Name', 'required|min_length[3]');
			$this->form_validation->set_rules('country_id', 'Country ID', 'required');
			if ($this->form_validation->run() !== false){

				$state_name = $this->input->post('state_name');
				$country_id = $this->input->post('country_id');

				$is_updated = $this->State_Model->update_state($state_id,$country_id,$state_name);

				if ($is_updated){
					$this->session->set_flashdata('success_msg', 'State successfully updated.');
					redirect('states');
				}else {
					$state_data = $this->State_Model->get_state_by_id($state_id);

					$data = array(
						'countries' => $this->db->select('*')->from('b2b_countries')->get()->result_object(),
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to Edit City. Some error occurred.',
						'state_data'=> $state_data
					);

					$this->load->view('admin/cities/edit-state', $data);
				}
			}else {
				$state_data = $this->State_Model->get_state_by_id($state_id);

				$data = array(
					'countries' => $this->db->select('*')->from('b2b_countries')->get()->result_object(),
					'validation_errors' => validation_errors(),
					'success_msg'	=> '',
					'state_data'=> $state_data
				);

				$this->load->view('admin/extras/cities/edit-city', $data);
			}

		}else {
			$state_data = $this->State_Model->get_state_by_id($state_id);

			$data = array(
				'countries' => $this->db->select('*')->from('b2b_countries')->get()->result_object(),
				'validation_errors' => '',
				'success_msg'	=> '',
				'state_data'=> $state_data
			);
			$this->load->view('admin/extras/states/edit-state', $data);
		}
	}



}
