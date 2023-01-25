<?php
	/**
	 * Created by PhpStorm.
	 * User: Ali Shan
	 * Date: 2/28/2019
	 * Time: 4:29 PM
	 */
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class B2bChating extends CI_Controller
	{
		
		public function __construct ()
		{
			parent::__construct();
			
			$this->load->model('B2B_Chat_Model');
			
		}
		
		public function index ()
		{
			if (! volgo_front_is_logged_in())
				redirect('login');
			
			
			$username = $this->B2B_Chat_Model->get_username_by_uid(volgo_get_logged_in_user_id());
			
			$this->load->view('frontend/b2bchat/index', ['username' => $username,'load'=>true]);
		}
		
		public function chat_box ()
		{
			if (! volgo_front_is_logged_in())
				redirect('login');
			
			$this->load->view('frontend/b2bchat/chat-box');
		}
		
		public function show_image ()
		{
			if (! volgo_front_is_logged_in())
				redirect('login');
			
			$this->load->view('frontend/b2bchat/show_image');
		}
	}
