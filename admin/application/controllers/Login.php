<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/30/2019
 * Time: 2:54 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (volgo_is_logged_in()) {
			header('Location: ' . base_url('home'));
		}

		// Load form validation library
		$this->load->library('form_validation');
		$this->load->model('Login_Model');
	}

	public function index()
	{
		$data = array(
			'validation_errors' => '',
		);

		$posted_data = filter_input_array(INPUT_POST);
		if (!empty($posted_data)){

			$this->form_validation->set_rules('user_email', 'Username', 'trim|required');
			$this->form_validation->set_rules('user_password', 'Password', 'trim|required');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'validation_errors' => validation_errors(),
				);

				$this->load->view('admin/login-form', $data);
			} else {
				$data = array(
					'form_data'	=> array(
						'user_email' => $this->input->post('user_email'),
						'user_password' => $this->input->post('user_password')
					),
					'validation_errors' => '',
				);
				$is_ok = $this->Login_Model->auth_check($data);

				if ($is_ok){

					$user_data = array(
						'username'	=> $data['form_data']['user_email'],
						'is_logged_in'	=> true,
						'login_time'	=> time()
					);

					$sess_enc_data = volgo_encrypt_message($user_data);

					$this->session->set_userdata('volgo_admin_login_data', $sess_enc_data);
					header('Location: ' . base_url('home'));
				}else {
					$data = array(
						'validation_errors' => '<strong>Sorry</strong><br />Provided username/password was wrong.',
					);

					$this->load->view('admin/login-form', $data);
				}
			}
		}else{

			$this->load->view('admin/login-form');
		}
	}
}
