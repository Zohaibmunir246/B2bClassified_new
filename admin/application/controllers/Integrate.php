<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Integrate extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
	}

	public function index()
	{


		$data = [
			'all_cats' => $this->Category_Model->get_all_categories()
		];


		$this->load->view('admin/integrate/categoryform', $data);
	}

	public function get_subchild_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Category_Model->get_child_cat_integrate($selected_parent_id);
			echo json_encode($child_cats);
		}
	}

	public function get_sub_from_child_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Category_Model->get_child_from_integrate($selected_parent_id);

			if (isset($child_cats[0])) {
				$child_cats = $child_cats[0]->meta_value;
				echo $child_cats;
			} else {
				echo '';
			}
		}
	}

	public function get_sub_from_home_child_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Category_Model->get_child_from_home_integrate($selected_parent_id);

			if (isset($child_cats[0])) {
				$child_cats = $child_cats[0]->meta_value;
				echo $child_cats;
			} else {
				echo '';
			}
		}
	}

	public function get_adv_form_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Category_Model->get_adv_form($selected_parent_id);

			if (isset($child_cats[0])) {
				$child_cats = $child_cats[0]->meta_value;
				echo $child_cats;
			} else {
				echo '';
			}
		}
	}

	public function get_basic_form_ajax()
	{


		if (!empty($_POST["parent_cat_id"])) {

			$selected_parent_id = $_POST["parent_cat_id"];
			$child_cats = $this->Category_Model->get_basic_form($selected_parent_id);

			if (isset($child_cats[0])) {
				$child_cats = $child_cats[0]->meta_value;
				echo $child_cats;
			} else {
				echo '';
			}
		}
	}

	public function create()
	{

		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);


		$input_data = filter_input_array(INPUT_POST);

		if (!empty($input_data)) {

			$this->form_validation->set_rules('formcode', 'Form Code', 'required|min_length[1]');
			$this->form_validation->set_rules('formcode_homepage', 'Homepage Form Code', 'required|min_length[1]');
			$this->form_validation->set_rules('advance_formcode', 'Advance Form Code', 'required|min_length[1]');
			$this->form_validation->set_rules('basic_formcode', 'Basic Form Code', 'required|min_length[1]');
			$this->form_validation->set_rules('subchild_cat', 'Sub Category', 'required|min_length[1]|max_length[255]');


			if ($this->form_validation->run() !== false) {

				$cat_sub_title = $this->input->post('subchild_cat');

				$form_code = $this->input->post('formcode');
				$form_code = str_replace(PHP_EOL, '', $form_code);

				$adv_form_code = $this->input->post('advance_formcode');
				$adv_form_code = str_replace(PHP_EOL, '', $adv_form_code);

				$basic_form_code = $this->input->post('basic_formcode');
				$basic_form_code = str_replace(PHP_EOL, '', $basic_form_code);

				$formcode_homepage = $this->input->post('formcode_homepage');
				$formcode_homepage = str_replace(PHP_EOL, '', $formcode_homepage);

				$selected_parent_id = $_POST["subchild_cat"];

				$dbform = $this->Category_Model->get_from_db_integrate($selected_parent_id);

				if (!empty($dbform)) {
					$child_cats = $this->Category_Model->get_child_from_update_integrate($selected_parent_id, $form_code);
					if ($child_cats) {
						$home_page_meta = $this->Category_Model->get_child_from_home_update_integrate($selected_parent_id, $formcode_homepage);
						$adv_home_page_meta = $this->Category_Model->update_adv_form_code($selected_parent_id, $adv_form_code);
						$is_inserted_basic_form = $this->Category_Model->update_basic_form_code($selected_parent_id, $basic_form_code);

						if ($home_page_meta) {

							$data = array(
								'validation_errors' => '',
								'success_msg' => '<strong>Congratulation!</strong><br /> Form has been Updated.',
								'all_cats' => $this->Category_Model->get_all_categories()
							);

							$this->load->view('admin/integrate/categoryform', $data);
						}else{
							$data = array(
								'validation_errors' => 'Home Page Form Not Integrated kindly Retry',
								'success_msg' => '',
								'all_cats' => $this->Category_Model->get_all_categories()
							);

							$this->load->view('admin/integrate/categoryform', $data);
						}
					}
					else{
						$data = array(
							'validation_errors' => 'Category Form Not Integrated kindly Retry',
							'success_msg' => '',
							'all_cats' => $this->Category_Model->get_all_categories()
						);

						$this->load->view('admin/integrate/categoryform', $data);
					}


				} else {
					$is_created = $this->Category_Model->create_category_meta(
						$cat_sub_title, $form_code
					);
					if ($is_created) {

						$add_meta_homepage = $this->Category_Model->create_meta_homepage_search(
							$cat_sub_title, $formcode_homepage
						);

						$add_adv_meta_homepage = $this->Category_Model->create_adv_search_form_meta(
							$cat_sub_title, $adv_form_code
						);

						$is_inserted_basic_form = $this->Category_Model->create_basic_search_form_meta(
							$cat_sub_title, $basic_form_code
						);

						if ($add_meta_homepage) {
							$data = array(
								'validation_errors' => '',
								'success_msg' => '<strong>Congratulation!</strong><br /> Form has been created.',
								'all_cats' => $this->Category_Model->get_all_categories()
							);

							$this->load->view('admin/integrate/categoryform', $data);
						} else {
							$data = array(
								'validation_errors' => 'HomePage form not created Retry',
								'success_msg' => '',
								'all_cats' => $this->Category_Model->get_all_categories()
							);

							$this->load->view('admin/integrate/categoryform', $data);
						}

					} else {
						$data = array(
							'validation_errors' => validation_errors(),
							'success_msg' => '',
							'all_cats' => $this->Category_Model->get_all_categories()
						);

						$this->load->view('admin/integrate/categoryform', $data);
					}
				}
			} else {

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg' => '',
					'all_cats' => $this->Category_Model->get_all_categories()
				);

				$this->load->view('admin/integrate/categoryform', $data);
			}
		}
	}

}
