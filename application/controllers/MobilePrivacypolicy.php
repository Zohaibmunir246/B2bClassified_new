<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobilePrivacypolicy extends CI_Controller
{
    function __construct() {
		parent::__construct();
    }

    public function index()
    {
        $this->load->view('frontend-mobile/privacy_policy/privacypolicy');
    }



}
