<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Page_Model');
	}

	public function index()
	{
		$pages = $this->Page_Model->get_pages(-1);

		$data = [
			'pages'	=> $pages
		];

		$this->load->view('admin/pages/index', $data);
	}

	public function addnew()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg'	=> ''
		);

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			//volgo_debug($input_data);

			$this->form_validation->set_rules('page_title', 'Page Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('page_content', 'Page Content', 'required');


			if (! empty($_FILES['featured_image']['name'])){
				$config['upload_path']          = './uploads/pages';
				$config['allowed_types']        = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('featured_image'))
				{
					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors()
					);
					$unable_to_upload = true;

					$this->load->view('admin/pages/addnewpage', $data);
				}
				else
				{
					$upload_img_data = $this->upload->data();
				}
			}


			if (isset($unable_to_upload))
				return;


			if ($this->form_validation->run() !== false){

				$title = $this->input->post('page_title');
				$content = $this->input->post('page_content');
				$featured_image = isset($upload_img_data) ? $upload_img_data['file_name'] : '';
				$seo_title = $this->input->post('seo_title');
				$seo_meta_description = $this->input->post('seo_meta_description');

				$slug = $this->input->post('page_slug');
				$seo_slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->input->post('seo_slug'))));

				$seo_slug_count = $this->Page_Model->check_seo_slug($title);
				if ($seo_slug_count > 0){
					$seo_slug_count++;
					$seo_slug .= '-' . $seo_slug_count;
				}

				$count = $this->Page_Model->check_slug($slug);
				if ($count > 0){
					$count++;
					$slug .= '-' . $count;
				}

				$is_created = $this->Page_Model->create_page(
					$title,
					$content,
					$slug,
					$featured_image,
					$seo_title,
					$seo_meta_description,
					$seo_slug
				);

				if ($is_created){
					$data = array(
						'validation_errors' => '',
						'success_msg'	=> '<strong>Congratulation!</strong><br />' . $title . ' page has been created.',
						'featured_image'	=> $featured_image,
						'page_slug'	=> $slug,
						'seo_slug'	=> $seo_slug
					);

					$this->session->set_flashdata('success_msg', 'Page created successfully.');
					redirect('pages');
				}else {
					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to add page. Some error occurred.'
					);

					$this->load->view('admin/pages/addnewpage', $data);
				}
			}else {
				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> ''
				);

				$this->load->view('admin/pages/addnewpage', $data);
			}
		}else {

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> ''
			);

			$this->load->view('admin/pages/addnewpage', $data);
		}
	}

	public function edit($page_id = '')
	{
		if (empty($page_id) || ! intval($page_id))
			redirect('sorry');



		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('page_title', 'Page Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('page_content', 'Page Content', 'required');


			if (! empty($_FILES['featured_image']['name'])){
				$config['upload_path']          = './uploads/pages';
				$config['allowed_types']        = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('featured_image'))
				{
					$page_data = $this->Page_Model->get_page_by_id($page_id);

					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors(),
						'success_msg'	=> '',
						'page_data'=> $page_data
					);


					$unable_to_upload = true;

					$this->load->view('admin/pages/editpage', $data);
				}
				else
				{
					$upload_img_data = $this->upload->data();
				}
			}


			if (isset($unable_to_upload))
				return;


			if ($this->form_validation->run() !== false){

				$title = $this->input->post('page_title');
				$content = $this->input->post('page_content');
				$featured_image = isset($upload_img_data) ? $upload_img_data['file_name'] : '';
				$seo_title = $this->input->post('seo_title');
				$seo_slug = $this->input->post('seo_slug');
				$seo_meta_description = $this->input->post('seo_meta_description');

				$slug = $this->input->post('page_slug');
				$count = $this->Page_Model->check_slug($slug);
				if ($count > 1){
					$count++;
					$slug .= '-' . $count;
				}

				$is_updated = $this->Page_Model->update_page(
					$page_id,
					$title,
					$content,
					$slug,
					$featured_image,
					$seo_title,
					$seo_meta_description,
					$seo_slug
				);

				if ($is_updated){

					$this->session->set_flashdata('success_msg', 'Page successfully updated.');
					redirect('pages');
				}else {
					$page_data = $this->Page_Model->get_page_by_id($page_id);

					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to add page. Some error occurred.',
						'page_data'=> $page_data
					);

					$this->load->view('admin/pages/editpage', $data);
				}
			}else {
				$page_data = $this->Page_Model->get_page_by_id($page_id);

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> '',
					'page_data'=> $page_data
				);

				$this->load->view('admin/pages/editpage', $data);
			}

		}else {
			$page_data = $this->Page_Model->get_page_by_id($page_id);

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> '',
				'page_data'=> $page_data
			);
			$this->load->view('admin/pages/editpage', $data);
		}
	}

	public function remove($page_id = '')
	{
		if (empty($page_id) || ! intval($page_id))
			redirect('sorry');

		if ($this->Page_Model->remove($page_id)){
			$this->session->set_flashdata('removed','success');
			redirect('pages');
		}else {
			redirect('pages');


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
