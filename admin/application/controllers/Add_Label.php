<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_label extends CI_Controller
{

	private $view_labels_from_db ;

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Filter_Model');


		$this->view_labels_from_db =  $this->Filter_Model->view_label();

	}

	public function index()
	{
		$data = [
			'validation_errors' => '',
			'success_msg' => '',
			'view_label'=>$this->view_labels_from_db,
			'view_label_singles' =>'',
		];

		$this->load->view('admin/filter/filters', $data);
	}

	public function create()
	{
		$data = [
			'validation_errors' => '',
			'success_msg' => '',
		];
		$input_data = filter_input_array(INPUT_POST);

		$this->form_validation->set_rules('label_type', 'Label Type', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('title_filter', 'Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('desc_filter', 'Description', 'required|min_length[1]|max_length[255]');



		if (!empty($input_data)) {
			if ($this->form_validation->run() !== false) {
				$label_type = $input_data['label_type'];
				$title_filter = $input_data['title_filter'];
				$description_filter = $input_data['desc_filter'];
				$is_created = $this->Filter_Model->create_label($label_type , $title_filter , $description_filter);

				$data = [
					'validation_errors' => '',
					'success_msg' => '<strong>Congratulation!</strong><br /> Label has been Added.',
					'view_label'=>$this->Filter_Model->view_label(),

				];
				$this->session->set_flashdata('success_msg', 'Label created successfully.');
				redirect('add_label', $data);

			}
			else{

				$data = [
					'validation_errors' => validation_errors(),
					'success_msg' => '',
					'view_label'=>$this->view_labels_from_db,

				];
				$this->load->view('admin/filter/filters', $data);
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect('add_label', $data);
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

		$this->form_validation->set_rules('label_type', 'Label Type', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('title_filter', 'Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('desc_filter', 'Description', 'required|min_length[1]|max_length[255]');


		if ($this->form_validation->run() !== false) {
			$label_type = $input_data['label_type'];
			$title_filter = $input_data['title_filter'];
			$description_filter = $input_data['desc_filter'];
			$is_created = $this->Filter_Model->update_label($label_type , $title_filter , $description_filter , $id );

			$data = [
				'validation_errors' => '',
				'success_msg' => '<strong>Congratulation!</strong><br /> Label has been Added.',

			];
			$this->session->set_flashdata('success_msg', 'label updated successfully.');
			redirect('add_label', $data);

		}else{
			$data = [
				'validation_errors' => validation_errors(),
				'success_msg' => '',
				'view_label' => $this->view_labels_from_db,
				'view_label_singles' => $this->Filter_Model->view_label_single($id),

			];
			$this->load->view('admin/filter/edit_labels', $data);

		}
	}

	public function remove($id = '') {
		if (empty($id))
			redirect('sorry');

		if ($this->Filter_Model->remove($id)) {
			$this->session->set_flashdata('removed', 'success');

			redirect('add_label');
		} else {
			redirect('add_label');
		}
	}
}
