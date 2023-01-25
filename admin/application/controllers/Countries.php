<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/15/2019
 * Time: 4:16 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Countries extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->model('Country_Model');
	}

	public function index()
	{
        $data = [
            'validation_errors' => '',
            'success_msg' => '',
            'countries' => $this->Country_Model->get_countries()
        ];

		$this->load->view('admin/extras/countries/index', $data);
	}

	public function addnew()
	{
		if (! empty($this->input->post())){

			$input_data = filter_input_array(INPUT_POST);
			$this->form_validation->set_rules('country_name', 'Country ID', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('shortname', 'Short Name', 'required|min_length[1]|max_length[3]');
			$this->form_validation->set_rules('phonecode', 'Phone Code', 'required|min_length[1]');

			if ($this->form_validation->run() !== false) {

				$this->Country_Model->create(
					$data = [
						'name' => $this->input->post('country_name'),
						'shortname' => $this->input->post('shortname'),
						'phonecode' => intval($this->input->post('phonecode'))
					]
				);

				$this->session->set_flashdata('success_msg', "Country with title " . $this->input->post('country_name') . " has been added");
				redirect(base_url('countries'));

			}else {
				$data['validation_errors'] = validation_errors();
				$this->load->view('admin/extras/countries/add-country', $data);
			}
		}else {
			$this->load->view('admin/extras/countries/add-country');
		}
	}

	// mohsin's code here 
	public function edit_country($country_id = '')
	{
		if (empty($country_id) || ! intval($country_id))
			redirect('sorry');

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('country_name', 'Country ID', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('shortname', 'Short Name', 'required|min_length[1]|max_length[3]');
			$this->form_validation->set_rules('phonecode', 'Phone code', 'required|min_length[1]');

			if ($this->form_validation->run() !== false){

				$country_name = $this->input->post('country_name');
				$shortname = $this->input->post('shortname');
				$phonecode = $this->input->post('phonecode');

				$is_updated = $this->Country_Model->update_country(
					$country_id,
					$country_name,
					$shortname,
					$phonecode
				);

				if ($is_updated){
					$this->session->set_flashdata('success_msg', 'Country successfully updated.');
					redirect('countries');
				}else {
					$country_data = $this->City_Model->get_country_by_id($country_id);

					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to Edit City. Some error occurred.',
						'country_data'=> $country_data
					);

					$this->load->view('admin/extras/countries/edit-country', $data);
				}
			}else {
				$country_data = $this->Country_Model->get_country_by_id($country_id);

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> '',
					'country_data'=> $country_data
				);

				$this->load->view('admin/extras/countries/edit-country', $data);
			}

		}else {
			$country_data = $this->Country_Model->get_country_by_id($country_id);

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> '',
				'country_data'=> $country_data
			);
			$this->load->view('admin/extras/countries/edit-country', $data);
		}
	}


}
