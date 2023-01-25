<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Seo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Seo_Model');
	}

	public function index()
	{
		$seos = $this->Seo_Model->get_seos(-1);

		$data = [
			'seos'	=> $seos
		];

		$this->load->view('admin/seo/index', $data);
	}

	public function addnew()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg'	=> ''
		);

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('page_type', 'Page Type', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('seo_title', 'Seo Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('seo_meta_keywords', 'Page Meta Keywords', 'required');
			$this->form_validation->set_rules('seo_meta_description', 'Page Meta Description', 'required');

			if ($this->form_validation->run() !== false){

				$page_type = $this->input->post('page_type');
				$seo_title = $this->input->post('seo_title');
				$seo_meta_keywords = $this->input->post('seo_meta_keywords');
				$seo_meta_description = $this->input->post('seo_meta_description');
				$seo_slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->input->post('seo_slug'))));
                
				$is_created = $this->Seo_Model->create_seo_detail(
					$page_type,
					$seo_title,
					$seo_meta_keywords,
					$seo_meta_description,
					$seo_slug
				);

				if ($is_created){
					
					$this->session->set_flashdata('success_msg', 'Seo Details created successfully.');
					redirect('seo');
				}else {
					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to add details. Some error occurred.'
					);

					$this->load->view('admin/seo/addnew', $data);
				}
			}else {
				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> ''
				);

				$this->load->view('admin/seo/addnew', $data);
			}
		}else {

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> ''
			);

			$this->load->view('admin/seo/addnew', $data);
		}
	}

	public function edit($seo_id = '')
	{
		if (empty($seo_id) || ! intval($seo_id))
			redirect('sorry');

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('page_type', 'Page Type', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('seo_title', 'Seo Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('seo_meta_keywords', 'Page Meta Keywords', 'required');
			$this->form_validation->set_rules('seo_meta_description', 'Page Meta Description', 'required');

			if ($this->form_validation->run() !== false){

				$page_type = $this->input->post('page_type');
				$seo_title = $this->input->post('seo_title');
				$seo_meta_keywords = $this->input->post('seo_meta_keywords');
				$seo_meta_description = $this->input->post('seo_meta_description');
				$seo_slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->input->post('seo_slug'))));

				$is_updated = $this->Seo_Model->update_seo(
					$seo_id,
					$page_type,
					$seo_title,
					$seo_meta_keywords,
					$seo_meta_description,
					$seo_slug
				);

				if ($is_updated){

					$this->session->set_flashdata('success_msg', 'Page successfully updated.');
					$page_data = $this->Seo_Model->get_seo_by_id($seo_id);

					$data = array(
						'validation_errors' => '',
						'success_msg'	=> '',
						'page_data'=> $page_data
					);
			$this->load->view('admin/seo/edit', $data);
				}else {
					$page_data = $this->Seo_Model->get_seo_by_id($seo_id);

					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to add page. Some error occurred.',
						'page_data'=> $page_data
					);

					$this->load->view('admin/seo/edit', $data);
				}
			}else {
				$page_data = $this->Seo_Model->get_seo_by_id($seo_id);

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> '',
					'page_data'=> $page_data
				);

				$this->load->view('admin/seo/edit', $data);
			}

		}else {
			$page_data = $this->Seo_Model->get_seo_by_id($seo_id);

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> '',
				'page_data'=> $page_data
			);
			$this->load->view('admin/seo/edit', $data);
		}
	}

	public function remove($seo_id = '')
	{
		if (empty($seo_id) || ! intval($seo_id))
			redirect('sorry');

		if ($this->Seo_Model->remove($seo_id)){
			$this->session->set_flashdata('removed','success');
			redirect('seo');
		}else {
			redirect('seo');


		}
	}

	public function check_slug__ajax()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || ! isset($posted_data['value'])) {
			exit('No direct script access allowed');
		}

		$slug = volgo_make_slug($posted_data['value']);

		$slug_counter = $this->Page_Model->check_slug($slug);

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
