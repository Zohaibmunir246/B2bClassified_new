<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Currencies extends CI_Controller
{

	private $view_labels_from_db ;

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Currency_Model');
		$this->load->model('Listing_Model');


		$this->view_currency_from_db =  $this->Currency_Model->view_currencies();

	}

	public function index()
	{
		$data = [
			'validation_errors' => '',
			'success_msg' => '',
			'view_currency'=>$this->view_currency_from_db,
            'all_cuntry' => $this->Listing_Model->get_all_countries(),
		];

		$this->load->view('admin/currency/currency', $data);
	}

	public function create()
	{
		$data = [
			'validation_errors' => '',
			'success_msg' => '',
		];
		$input_data = filter_input_array(INPUT_POST);

		$this->form_validation->set_rules('country_id', 'Country', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('unit', 'Unit', 'required|min_length[1]|max_length[255]');

		if (!empty($input_data)) {
			if ($this->form_validation->run() !== false) {
                $country_id = $input_data['country_id'];
                $unit = $input_data['unit'];
				$is_created = $this->Currency_Model->create_currency($country_id , $unit);

				$data = [
					'validation_errors' => '',
					'success_msg' => '<strong>Congratulation!</strong><br /> Currency has been Added.',
					'view_currency'=>$this->Currency_Model->view_currencies(),

				];
				$this->session->set_flashdata('success_msg', 'Currency added successfully.');
				redirect('Currencies', $data);

			}
			else{

				$data = [
					'validation_errors' => validation_errors(),
					'success_msg' => '',
                    'view_currency'=>$this->view_currency_from_db,
                    'all_cuntry' => $this->Listing_Model->get_all_countries(),

				];
				$this->load->view('admin/currency/currency', $data);
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect('currencies', $data);
			}
		}


	}
	public function edit($id = '') {
		if (empty($id))
			redirect('sorry');


		$data = [
			'validation_errors' => '',
			'success_msg' => '',
		];
		$input_data = filter_input_array(INPUT_POST);

        $this->form_validation->set_rules('country_id', 'Country', 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('unit', 'Unit', 'required|min_length[1]|max_length[255]');


		if ($this->form_validation->run() !== false) {
            $country_id = $input_data['country_id'];
            $unit = $input_data['unit'];
            $is_created = $this->Currency_Model->update_currency($country_id , $unit, $id);

			$data = [
				'validation_errors' => '',
				'success_msg' => '<strong>Congratulation!</strong><br /> currency has been updated.',

			];
			$this->session->set_flashdata('success_msg', 'currency updated successfully.');
			redirect('currencies', $data);

		}else{
			$data = [
				'validation_errors' => validation_errors(),
				'success_msg' => '',
                'all_cuntry' => $this->Listing_Model->get_all_countries(),
				'view_currency_singles' => $this->Currency_Model->view_single_currency($id),
                'view_currency'=>$this->view_currency_from_db,

			];
			$this->load->view('admin/currency/edit_currency', $data);

		}
	}

	public function remove($id = '') {
		if (empty($id))
			redirect('sorry');

		if ($this->Currency_Model->remove($id)) {
			$this->session->set_flashdata('removed', 'success');

			redirect('currencies');
		} else {
			redirect('currencies');
		}
	}
}
