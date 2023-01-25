<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
		$this->load->model('Filter_Model');
	}

	public function index()
	{
		$data = [
			'all_cats' => $this->Category_Model->get_all_categories(),
			'all_filters_labels' => $this->Filter_Model->get_all_labels(),
			'view_filters' => $this->Filter_Model->view_filters(),
		];


		$this->load->view('admin/filter/integrate', $data);
	}

	public function create()
	{
		$data = [
			'validation_errors' => '',
			'success_msg' => '',
		];
		$input_data = filter_input_array(INPUT_POST);

		$this->form_validation->set_rules('categoryid', 'Category ', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('title_filter', 'Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('label_type', 'Label', 'required|min_length[1]|max_length[255]');


		if (!empty($input_data)) {
			if ($this->form_validation->run() !== false) {

				$label_type_id = $input_data['label_type'];
				$title_filter = $input_data['title_filter'];
				$category_id = $input_data['categoryid'];
				$is_created = $this->Filter_Model->create_filter_labels($label_type_id, $title_filter, $category_id);

				$data = [
					'validation_errors' => '',
					'success_msg' => '<strong>Congratulation!</strong><br /> Filter has been Added.',
					'view_filters' => $this->Filter_Model->view_filters(),

				];
				$this->session->set_flashdata('success_msg', 'Filter created successfully.');
				redirect('filter', $data);

			} else {

				$data = [
					'validation_errors' => validation_errors(),
					'success_msg' => '',
					'view_filters' => $this->Filter_Model->view_filters(),
					'all_cats' => $this->Category_Model->get_all_categories(),
					'all_filters_labels' => $this->Filter_Model->get_all_labels(),

				];
				$this->load->view('admin/filter/integrate', $data);
			}
		}

	}

	/* edit module */

	public function edit($id ='')
	{

		if (empty($id))
			redirect('sorry');


		$data = [
			'validation_errors' => '',
			'success_msg' => '',
		];
		$input_data = filter_input_array(INPUT_POST);

		$this->form_validation->set_rules('categoryid', 'Category ', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('title_filter', 'Title', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('label_type', 'Label', 'required|min_length[1]|max_length[255]');


		if ($this->form_validation->run() !== false) {
			$label_type_id = $input_data['label_type'];
			$title_filter = $input_data['title_filter'];
			$category_id = $input_data['categoryid'];

			$is_created = $this->Filter_Model->update_filter_single($label_type_id, $title_filter, $category_id , $id);

			$data = [
				'validation_errors' => '',
				'success_msg' => '<strong>Congratulation!</strong><br /> Label has been Added.',

			];
			$this->session->set_flashdata('success_msg', 'Filter updated successfully.');
			redirect('filter', $data);

		}else{
			$data = [
				'validation_errors' => validation_errors(),
				'success_msg' => '',
				'view_filter_singles' => $this->Filter_Model->view_filters_single($id),
				'view_filters' => $this->Filter_Model->view_filters(),
				'all_cats' => $this->Category_Model->get_all_categories(),
				'all_filters' => $this->Filter_Model->get_all_labels(),

			];

			$this->load->view('admin/filter/edit_integrate', $data);

		}

	}



	public function remove_filter($filter_id = '')
	{
		if (empty($filter_id))
			redirect('sorry');

		if ($this->Filter_Model->remove_filter($filter_id)) {
			$this->session->set_flashdata('removed', 'success');

			redirect('filter');
		} else {
			redirect('filter');
		}
	}

}
