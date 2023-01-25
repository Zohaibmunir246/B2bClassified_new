<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/8/2019
 * Time: 6:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'classes/PayPal.php';

class Orders extends CI_Controller{

	public function __construct() {
		parent::__construct();

		if (! volgo_front_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Orders_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Listings_Model');
	}

	public function index()
	{
		$this->load->view('frontend/orders/index');
	}

	// paymentId=PAYID-LRSAGNY0H458119UL042784J&token=EC-7VW95664R0171212Y&PayerID=7F48HGB2ATNJG
	public function paypal_return_url_handler($order_id = '', $package_id = '', $package_user = '')
	{
		if (empty($order_id) || empty($package_id) || empty($package_user)){
			$this->session->set_flashdata('paypal_payment_plan_error', '<h2>Sorry! </h2><p>Unable to continue. Kindly retry or contact administrator.</p>');
			redirect('payment-plans');
		}


        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
        $session_data = explode(',', $session_data);
        $logedin_user_email = $session_data[0];
        $user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);
        $get_user_meta = $this->Listings_Model->get_current_user_meta($user_detail[0]->id);

        foreach ($get_user_meta as $metas):
            if ($metas->meta_key == 'pd_first_name') {
                $pd_first_name = $metas->meta_value;
            }
            if ($metas->meta_key == 'pd_last_name') {
                $pd_last_name = $metas->meta_value;
            }
            if ($metas->meta_key == 'pd_company_name') {
                $pd_company_name = $metas->meta_value;
            }
            if ($metas->meta_key == 'pd_address') {
                $pd_address = $metas->meta_value;
            }
            if ($metas->meta_key == 'pd_phone') {
                $pd_phone = $metas->meta_value;
            }
            if ($metas->meta_key == 'pd_email') {
                $pd_email = $metas->meta_value;
            }

        endforeach;

        if($package_id == 1){
            $package_name = 'Gold';
            $package_amount = '661';
        }else if($package_id == 2){
            $package_name = 'Silver';
            $package_amount = '440';
        }else if($package_id == 3){
            $package_name = 'Platinum';
            $package_amount = '954';
        }
        
		$get_data = filter_input_array(INPUT_GET);

		$is_updated = $this->Orders_Model->update_by_order_id(
			$order_id,
			$get_data['paymentId'],
			$get_data['token'],
			$get_data['PayerID'],
			'paid',
			'paypal'
		);


        $msg = str_replace('%%fullname%%', $pd_first_name . ' ' . $pd_last_name, INVOICE_PAID_EMAIL_USER);
        $msg = str_replace('%%companyname%%', $pd_company_name, $msg);
        $msg = str_replace('%%packagename%%', $package_name, $msg);
        $msg = str_replace('%%packageamount%%', $package_amount, $msg);
        $msg = str_replace('%%email%%', $pd_email, $msg);
        $msg = str_replace('%%phone%%', $pd_phone, $msg);
        $msg = str_replace('%%address%%', $pd_address, $msg);

        $user_data = array('email'=> $pd_email,'companyname' => $pd_company_name);
        $emailto = '';
        $emailfrom = NEWSLETTER_FROM_EMAIL;
        $subject = 'Purchase Package Invoice |' . SITE_NAME;
        volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);



		if ($is_updated){

			$message = "<h2>Success! </h2>";
			$message .= '<p>Order has been successfully paid and charged.</p>';

			$this->session->set_flashdata('paypal_payment_plan_success', $message);
			redirect('payment-plans');

		}else {
			$this->session->set_flashdata('paypal_payment_plan_error',
				'<h2>Sorry! </h2><p>Unable to continue. Kindly contact to site administrator.</p>');
			redirect('payment-plans');

		}
	}

	//token=EC-20C48771VC8353923
	public function paypal_cancel_url_handler($order_id = '', $package_id = '', $package_user = '')
	{
		if (empty($order_id) || empty($package_id) || empty($package_user)){
			$this->session->set_flashdata('paypal_payment_plan_error', '<h2>Sorry! </h2><p>Unable to continue. Kindly retry or contact administrator.</p>');
			redirect('payment-plans');
		}


		$get_data = filter_input_array(INPUT_GET);

		$is_updated = $this->Orders_Model->update_by_order_id(
			$order_id,
			'',
			$get_data['token'],
			'',
			'cancelled',
			'paypal'
		);

		if ($is_updated){

			$message = "<h2>Cancelled!</h2>";
			$message .= '<p>Order has been cancelled</p>';

			$this->session->set_flashdata('paypal_payment_plan_success', $message);
			redirect('payment-plans');

		}else {
			$this->session->set_flashdata('paypal_payment_plan_error',
				'<h2>Cancelled Successfully ! </h2><p>Unable to continue. Kindly contact to site administrator.</p>');
			redirect('payment-plans');
		}
	}

}
