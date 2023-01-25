<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
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


		$this->load->view('admin/category', $data);
	}

	public function create()
	{
		$input_data = filter_input_array(INPUT_POST);


		if (!empty($input_data)) {

			$this->form_validation->set_rules('cat_title', 'Category Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_desc', 'Category Description', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_slug', 'Category Slug', 'required|min_length[1]');


			if (!empty($_FILES['cat_image']['name'])) {
				$config['upload_path'] = './uploads/categories';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('cat_image')) {
					$data = array(
						'all_cats' => $this->Category_Model->get_all_categories()
					);
					$unable_to_upload = true;

					$this->load->view('admin/category', $data);
                    $this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors());
                    redirect('category', $data);
				} else {
					$upload_img_data = $this->upload->data();
				}
			}


			if (isset($unable_to_upload))
				return;


			if ($this->form_validation->run() !== false) {

				$cat_title = $this->input->post('cat_title');
				$cat_description = $this->input->post('cat_desc');
				if (isset($upload_img_data)) {
					$cat_image = $upload_img_data["file_name"];
				} else {
					$cat_image = $this->input->post('cat_icon');
				}
				$cat_type = $this->input->post('cat_type');
				$cat_parent = $this->input->post('parent_cat');
				$cat_type_db = $this->input->post('category_type');
				$cat_slug = $this->input->post('cat_slug');

				$is_created = $this->Category_Model->create_category(
                $cat_title, $cat_image, $cat_parent, $cat_description, $cat_type, $cat_type_db, $cat_slug
				);
				if ($is_created) {
					$data = array(
						'validation_errors' => '',
						'all_cats' => $this->Category_Model->get_all_categories(),
					);

					$this->load->view('admin/category', $data);
                    $this->session->set_flashdata('success_msg', '<strong>Congratulation!</strong><br />' . $cat_title . ' category has been created.');
                    redirect('category', $data);
				}else {
					$data = array(
						'all_cats' => $this->Category_Model->get_all_categories()
					);

					$this->load->view('admin/category', $data);
					$this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Category already exists.' );
					redirect('category', $data);
				}
			} else {

				$data = array(
					'all_cats' => $this->Category_Model->get_all_categories(),
					'validation_errors' => validation_errors(),
					'success_msg' => ''
				);

				$this->load->view('admin/category', $data);
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect('category', $data);
			}
		}
	}

	/* edit module */

	public function edit($categoryid = '')
	{
		if (empty($categoryid))
			redirect('sorry');


		$input_data = filter_input_array(INPUT_POST);


		if (!empty($input_data)) {

			$this->form_validation->set_rules('cat_title', 'Category Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_desc', 'Category Description', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_slug', 'Category Slug', 'required|min_length[1]');


			if (!empty($_FILES['cat_image']['name'])) {
				$config['upload_path'] = './uploads/categories';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('cat_image')) {
					$data = array(
						'validation_errors' => '<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors(),
						'all_cats' => $this->Category_Model->get_all_categories()
					);
					$unable_to_upload = true;
					$this->load->view('admin/category', $data);
				} else {
					$upload_img_data = $this->upload->data();
				}
			}


			if (isset($unable_to_upload))
				return;


			if ($this->form_validation->run() !== false) {

				$cat_title = $this->input->post('cat_title');
				$cat_description = $this->input->post('cat_desc');
				if (isset($upload_img_data)) {

					$cat_image = $upload_img_data["file_name"];
				} else {
					$cat_image = $this->input->post('cat_icon');
				}
				$cat_type = $this->input->post('cat_type');

				$cat_parent = $this->input->post('parent_cat');
				$cat_type_db = $this->input->post('category_type');
				$cat_slug = $this->input->post('cat_slug');


				$is_updated = $this->Category_Model->update_category(
					$categoryid, $cat_title, $cat_image, $cat_parent, $cat_description, $cat_type, $cat_type_db, $cat_slug
				);

				if ($is_updated) {

					$category_data = $this->Category_Model->get_cat_by_id($categoryid);
					$all_cats = $this->Category_Model->get_all_categories();

					$data = array(
						'validation_errors' => '',
						'success_msg' => '<strong>Congratulation!</strong><br /> category has been update.',
						'cat_data' => $category_data,
						'all_cats' => $all_cats
					);

					$this->load->view('admin/editcategory', $data);
				} else {
					$category_data = $this->Category_Model->get_cat_by_id($categoryid);
					$all_cats = $this->Category_Model->get_all_categories();

					$data = array(
						'validation_errors' => '<strong>Sorry!</strong><br />' . 'Unable to add page. Some error occurred.',
						'cat_data' => $category_data,
						'all_cats' => $all_cats
					);

					$this->load->view('admin/editcategory', $data);
				}
			} else {
				$all_cats = $this->Category_Model->get_all_categories();
				$category_data = $this->Category_Model->get_cat_by_id($categoryid);

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg' => '',
					'cat_data' => $category_data,
					'all_cats' => $all_cats
				);

				$this->load->view('admin/editcategory', $data);
			}
		} else {
			$category_data = $this->Category_Model->get_cat_by_id($categoryid);
			$all_cats = $this->Category_Model->get_all_categories();

			$data = array(
				'validation_errors' => '',
				'success_msg' => '',
				'cat_data' => $category_data,
				'all_cats' => $all_cats
			);


			$this->load->view('admin/editcategory', $data);
		}
	}

	public function remove($single_cat_id = '')
	{
		if (empty($single_cat_id))
			redirect('sorry');

		if ($this->Category_Model->remove_meta($single_cat_id)) {
			$this->Category_Model->remove($single_cat_id);
			$this->session->set_flashdata('removed', 'success');

			redirect('category');
		} else {
			redirect('category');
		}
	}

	public function check_slug__ajax()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || ! isset($posted_data['value'])) {
			exit('No direct script access allowed');
		}

		$slug = volgo_make_slug($posted_data['value']);

		$slug_counter = $this->Category_Model->check_slug($slug);

		if ($slug_counter > 0){
			$slug_counter++;
			$slug .= '-' . $slug_counter;
		}

		echo json_encode([
			'status'	=> 'success',
			'slug'	=> $slug
		]);

		exit;
	}

}
