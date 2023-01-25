<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/7/2019
 * Time: 2:43 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends CI_Controller{

	public function __construct()
	{
		parent::__construct();

		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Packages_Model');
	}

	public function index()
	{
		$packages = $this->Packages_Model->get_all_packages();

		$data = [
			'packages'	=> $packages
		];

		$this->load->view('admin/packages/show_all', $data);
	}

	public function addnew()
	{
		$all_enabled_functionalities = $this->Packages_Model->get_all_enabled_functionalities();
		$data = [
			'functionalities'	=> $all_enabled_functionalities
		];

		$posted_data = filter_input_array(INPUT_POST);

		if (! empty($posted_data)){

			$this->form_validation->set_rules('package_title', 'Package Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('package_amount', 'Package Amount', 'required');
			$this->form_validation->set_rules('package_expiry', 'Package Expiry', 'required');
			$this->form_validation->set_rules('package_expiry_unit', 'Package Expiry Unit', 'required');
			$this->form_validation->set_rules('is_featured', 'Is Featured', 'required');


			if ($this->form_validation->run() !== false){

				$is_inserted = $this->Packages_Model
					->insert_package_info(
						$this->input->post('package_title'),
						$this->input->post('package_content'),
						$this->input->post('package_amount'),
						$this->input->post('package_expiry'),
						$this->input->post('package_expiry_unit'),
						$this->input->post('package_status'),
						$this->input->post('package_functionalities'),
						$this->input->post('is_featured')
					);

				if ($is_inserted){

					$this->session->set_flashdata('success_msg', 'Package created successfully.');

					redirect('packages');

				}else {
					$data['validation_errors']	= '<strong>Sorry</strong> Unable to insert the data. Kindly retry.';
					$this->load->view('admin/packages/addnewpackage', $data);
				}
			} else {
				$data['validation_errors']	= validation_errors();
				$this->load->view('admin/packages/addnewpackage', $data);
			}
		}else {
			$this->load->view('admin/packages/addnewpackage', $data);
		}
	}

	public function edit($package_id = '')
	{
		if (empty($package_id) || ! intval($package_id))
			redirect('sorry');

		$package_data = $this->Packages_Model->get_package_by_id($package_id);
		$all_enabled_functionalities = $this->Packages_Model->get_all_enabled_functionalities();

		// Add selected into std Class if it is selected already.
		foreach ($all_enabled_functionalities as $i => $all_enabled_functionality) {
			foreach ($package_data[0]['functionality_data'] as $functionality_data){

				if ($all_enabled_functionality->id === $functionality_data['functionality_id']){
					$all_enabled_functionalities[$i]->selected = 'true';
				}
			}
		}

		$input_data = filter_input_array(INPUT_POST);

		if (! empty($input_data)){

			$this->form_validation->set_rules('package_title', 'Package Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('package_amount', 'Package Amount', 'required');
			$this->form_validation->set_rules('package_expiry', 'Package Expiry', 'required');
			$this->form_validation->set_rules('package_expiry_unit', 'Package Expiry Unit', 'required');

			if ($this->form_validation->run() !== false){

				$is_updated = $this->Packages_Model
					->update_package_info(
						$package_id,
						$title = $this->input->post('package_title'),
						$this->input->post('package_content'),
						$this->input->post('package_amount'),
						$this->input->post('package_expiry'),
						$this->input->post('package_expiry_unit'),
						$this->input->post('package_status'),
						$this->input->post('package_functionalities')
					);


				if ($is_updated){

					$this->session->set_flashdata('success_msg', 'Package with title ' . $title . ' has been successfully updated.');

					redirect('packages');

				}else {
					$data = array(
						'validation_errors' => '<strong>Sorry</strong> Unable to update the package information. Kindly retry.',
						'package_data'=> $package_data,
						'functionalities'	=> $all_enabled_functionalities
					);

					$this->load->view('admin/packages/editpackage', $data);
				}

			}else {
				$data = array(
					'validation_errors' => validation_errors(),
					'package_data'=> $package_data,
					'functionalities'	=> $all_enabled_functionalities
				);

				$this->load->view('admin/packages/editpackage', $data);
			}
		}else {
			$data = array(
				'validation_errors' => '',
				'package_data'=> $package_data,
				'functionalities'	=> $all_enabled_functionalities
			);

			$this->load->view('admin/packages/editpackage', $data);
		}
	}

	public function remove($package_id = '')
	{
		if (empty($package_id) || ! intval($package_id))
			redirect('sorry');

		if ($this->Packages_Model->remove($package_id)){
			$this->session->set_flashdata('removed','success');
			redirect('packages');
		}else {
			redirect('packages');
		}
	}

	public function get_package_info__ajax()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! $this->input->is_ajax_request() || !isset($posted_data['selected_package'])) {
			exit('No direct script access allowed');
		}

		if (! intval($posted_data['selected_package'])){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$package = $this->Packages_Model->get_package_by_id($posted_data['selected_package']);
		if (empty($package)){
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}
		$package['status'] = 'success';

		echo json_encode($package);
		exit;
	}

}
