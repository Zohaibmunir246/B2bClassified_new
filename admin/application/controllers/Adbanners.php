<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/20/2019
 * Time: 11:19 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Adbanners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('ADBanners_Model');
	}

	public function index()
	{
		$banners = $this->ADBanners_Model->get_all_banners();
		$data = [
			'banners' => $banners
		];

		$this->load->view('admin/adbanners/index', $data);
	}

	public function add()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!empty($posted_data)) {

			$this->form_validation->set_rules('banner_title', 'Banner Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('banner_description', 'Banner Description', 'required');
			$this->form_validation->set_rules('banner_type', 'Banner Type', 'required');
			$this->form_validation->set_rules('banner_size', 'Banner Size', 'required');
			$this->form_validation->set_rules('banner_display_unit', 'Banner Display Unit', 'required');
			$this->form_validation->set_rules('banner_link', 'Banner URL', 'required|valid_url');

			if ($this->form_validation->run() !== FALSE) {

				if (! empty($_FILES['adbanner_advert']['name'])){
					$config['upload_path']          = './uploads/adbanners';
					$config['allowed_types']        = 'gif|jpg|png';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('adbanner_advert'))
					{
						$data = array(
							'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload ad banner image.<br />Possible Reasons:<br />' . $this->upload->display_errors()
						);
						$unable_to_upload = true;

						$this->load->view('admin/adbanners/add', $data);
					}
					else
					{
						$upload_img_data = $this->upload->data();
					}
				}

				if (isset($unable_to_upload))
					return;

				$file_name = '';
				if (isset($upload_img_data) && is_array($upload_img_data) && isset($upload_img_data['file_name'])){
					$file_name = $upload_img_data['file_name'];
				}

				if ($this->ADBanners_Model->insert($this->input->post(), $file_name)){
					// inserted successfully

					$this->session->set_flashdata('success_msg', '<strong>Success! </strong>New ad banner has been created with title "' . $this->input->post('banner_title') . '"');
					redirect(base_url('adbanners'));

				}else {
					// On insert fails.

					$data = [
						'validation_errors'	=> '<strong>Sorry! </strong>Unable to create record. Please try again.'
					];

					$this->load->view('admin/adbanners/add', $data);
				}
			} else {
				// On submitting page and validation fails.

				$data = [
					'validation_errors'	=> validation_errors()
				];

				$this->load->view('admin/adbanners/add', $data);

			}
		} else {
			// On first time page load

			$this->load->view('admin/adbanners/add');
		}
	}

	public function edit($banner_id = '')
	{
		$posted_data = filter_input_array(INPUT_POST);
		$banner = $this->ADBanners_Model->get_banner_by_id($banner_id);
		$banner = isset($banner[0]) ? $banner[0] : $banner;

		if (!empty($posted_data)) {

			$this->form_validation->set_rules('banner_title', 'Banner Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('banner_description', 'Banner Description', 'required');
			$this->form_validation->set_rules('banner_type', 'Banner Type', 'required');
			$this->form_validation->set_rules('banner_size', 'Banner Size', 'required');
			$this->form_validation->set_rules('banner_display_unit', 'Banner Display Unit', 'required');
			$this->form_validation->set_rules('banner_link', 'Banner URL', 'required|valid_url');


			if ($this->form_validation->run() !== FALSE) {

				if (! empty($_FILES['adbanner_advert']['name'])){
					$config['upload_path']          = './uploads/adbanners';
					$config['allowed_types']        = 'gif|jpg|png';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('adbanner_advert'))
					{
						$data = array(
							'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload ad banner image.<br />Possible Reasons:<br />' . $this->upload->display_errors()
						);
						$unable_to_upload = true;

						$this->load->view('admin/adbanners/add', $data);
					}
					else
					{
						$upload_img_data = $this->upload->data();
					}
				}

				if (isset($unable_to_upload))
					return;

				$file_name = '';
				if ( isset($upload_img_data) && is_array($upload_img_data) && isset($upload_img_data['file_name'])){
					$file_name = $upload_img_data['file_name'];
				}

				if ($this->ADBanners_Model->update($banner_id, $this->input->post(), $file_name)){
					// inserted successfully

					$this->session->set_flashdata('success_msg', '<strong>Success! </strong>Ad banner has been updated.');
					redirect(base_url('adbanners'));

				}else {
					// On insert fails.

					$data = [
						'validation_errors'	=> '<strong>Sorry! </strong>Unable to create record. Please try again.'
					];

					$this->load->view('admin/adbanners/edit', $data);
				}
			} else {
				// On submitting page and validation fails.

				$data = [
					'validation_errors'	=> validation_errors(),
					'banner'	=> $banner
				];

				$this->load->view('admin/adbanners/edit', $data);

			}
		} else {
			// On first time page load

			$data = [
				'banner'	=> $banner
			];

			$this->load->view('admin/adbanners/edit', $data);
		}
	}

	public function remove($banner_id = '')
	{
		if (empty($banner_id) || ! intval($banner_id))
			redirect('sorry');

		if ($this->ADBanners_Model->remove($banner_id)){
			$this->session->set_flashdata('removed','success');
			redirect('adbanners');
		}else {
			redirect('adbanners');
		}
	}
}

