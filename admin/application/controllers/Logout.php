<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/30/2019
 * Time: 5:45 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Logout extends CI_Controller
{
	public function index()
	{
		$this->session->unset_userdata('volgo_admin_login_data');

		header('Location: ' . base_url('home'));
	}
}
