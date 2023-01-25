<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Subscribers extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Subscribers_Model');
	}


	public function index()
	{
		$data['outcome'] = $this->Subscribers_Model->get_subscribers();
		$this->load->view('admin/subscribers', $data);
	}


	public function create() {

		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
			'outcome' => $this->Subscribers_Model->get_subscribers()
		);
		$input_data = filter_input_array(INPUT_POST);

		if (!empty($input_data)) {

				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[newsletter_subscribers.email]');
				$this->form_validation->set_rules('status', 'Email Status', 'required|min_length[1]|max_length[255]');
	

				if ($this->form_validation->run() !== false) {

						$email = $this->input->post('email');
						$status = $this->input->post('status');
						$is_created = $this->Subscribers_Model->create_subscriber(
							$email, $status
					  );
					  if ($is_created) {
						$data = array(
							'email'	=> $email,
							'status'	=> $status,
							'outcome' => $this->Subscribers_Model->get_subscribers()
						);
						  
						  $this->load->view('admin/subscribers', $data);
                          $this->session->set_flashdata('success_msg','<strong>Congratulation!</strong><br />' . $email . ' subscriber has been created.');
                          redirect('subscribers', $data);
					  }else{
						$data = array(
							'outcome' => $this->Subscribers_Model->get_subscribers()
						);
	
						$this->load->view('admin/subscribers', $data);
                        $this->session->set_flashdata('validation_errors','<strong>Sorry!</strong><br />' . 'Unable to add subscriber. Some error occurred.');
                        redirect('subscribers', $data);
						
					  }

				} else {

						$data = array(
							'validation_errors' => validation_errors(),
							'success_msg' => '',
							'outcome' => $this->Subscribers_Model->get_subscribers()
						);

						$this->load->view('admin/subscribers', $data);
                        $this->session->set_flashdata('validation_errors', validation_errors());
                        redirect('subscribers', $data);
				}
		}

	}


	public function remove($subscriber_id = '') {
		if (empty($subscriber_id))
				redirect('sorry');

		if ($this->Subscribers_Model->remove($subscriber_id)) {
				$this->session->set_flashdata('removed', 'success');

				redirect('subscribers');
		} else {
				redirect('subscribers');
		}
	}


}
