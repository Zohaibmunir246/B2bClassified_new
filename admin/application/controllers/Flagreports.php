<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Flagreports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Flagreport_Model');
	}


	public function index()
	{
		$data['outcome'] = $this->Flagreport_Model->get_all_reports();
		$this->load->view('admin/flagreports', $data);
	}

	
	public function remove($flagReportId = '') {
		if (empty($flagReportId))
				redirect('sorry');

		if ($this->Flagreport_Model->remove($flagReportId)) {
				$this->session->set_flashdata('removed', 'success');

				redirect('flagreports');
		} else {
				redirect('flagreports');
		}
	}



}
