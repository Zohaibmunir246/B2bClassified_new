<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'classes/PayPal.php';

class Paymentplans extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Paymentplans_Model');
		$this->load->model('Orders_Model');
        $this->load->model('Blocks_Model');
        $this->load->model('Dashboard_Model');
        $this->load->model('Listings_Model');
        $this->load->model('Orders_Model');
        $this->load->model('Categories_Model');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->library('image_lib');
        $this->load->helper('functions_helper');
        $this->load->library('form_validation');
	}

    public function index()
    {
        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
        $session_data = explode(',', $session_data);
        $logedin_user_email = $session_data[0];
        $user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

    	$data = [
    		'packages' => $this->Paymentplans_Model->get_all_enabled_packages(),
            'orders_details' => $this->Orders_Model->get_order_by_user_id($user_detail[0]->id),
            'user_detail' => $user_detail
		];

        $this->load->view('frontend/payment_plans/paymentplans', $data);
    }
    
    public function payment_details()
    {
//        $package_id = $_GET['package_id'];

        if (!isset($_GET['package_id']) ) {
            redirect('sorry');
        }

        if (!volgo_front_is_logged_in()) {
            redirect('login?redirected_to=' . base_url('payment-details?package_id=' . $_GET['package_id']));
        }

        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
        $session_data = explode(',', $session_data);
        $logedin_user_email = $session_data[0];
        $user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);


        if (!empty($user_detail)) {

            $user_meta = $this->Dashboard_Model->get_user_meta($user_detail[0]->id);

            foreach ($user_meta as $single_meta) {
                if ($single_meta->meta_key == 'nationality') {
                    $countryid = $single_meta->meta_value;
                }
                if ($single_meta->meta_key == 'states') {
                    $state_id = $single_meta->meta_value;
                }
            }
        }



        if (volgo_front_is_logged_in()) {
            $country = volgo_get_countries();
            if (isset($countryid)) {
                $states = volgo_get_states_by_country_id($countryid);
            } else {
                $states = '';
            }
            if (isset($state_id)) {
                $city = volgo_get_cities_by_state_id($state_id);
            } else {
                $city = '';
            }

            $loged_in_userid = volgo_get_logged_in_user_id();

            $data = [
                'footer_block' => $this->Blocks_Model->get_block('footer_block'),
                'main_categories' => $this->Categories_Model->get_main_cats_for_dashboard(),
                'ads_userid' => $loged_in_userid,
                'user_detail' => $user_detail,
                'user_meta_detail' => $user_meta,
                'all_country' => $country,
                'states' => $states,
                'city' => $city
            ];

            $this->load->view('frontend/payment_plans/payment_details', $data);


        } else {

            redirect('login?redirected_to=' . base_url('payment-details?package_id=' . $_GET['package_id']));
        }
    }


    public function payment_detail_form($package_id)
    {
        if (!volgo_front_is_logged_in()) {
            redirect('login?redirected_to=' . base_url('payment-details?package_id=' .$package_id));
        }

        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
        $session_data = explode(',', $session_data);
        $logedin_user_email = $session_data[0];
        $user_detail = $this->Dashboard_Model->get_curent_user_detail($logedin_user_email);

        $posted_data = filter_input_array(INPUT_POST);

        if (!empty($posted_data)) {

            $this->form_validation->set_rules('pd_first_name', 'First Name', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_last_name', 'Last Name', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_company_name', 'Company Name', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_address', 'Address', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_selected_country', 'Select Country', 'required|min_length[1]');
            $this->form_validation->set_rules('pd_state', 'Select State', 'required|min_length[1]');
            $this->form_validation->set_rules('pd_city', 'Select City', 'required|min_length[1]');
            $this->form_validation->set_rules('pd_phone', 'Phone', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_zip', 'Zip', 'required|min_length[3]|max_length[255]');
//            $this->form_validation->set_rules('pd_fax', 'Fax', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_email', 'Email already exist', 'required|min_length[1]|max_length[255]');
//            $this->form_validation->set_rules('pd_year_established', 'Year established', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('pd_bus_activity', 'Primary business activity:', 'required|min_length[1]');
            $this->form_validation->set_rules('pd_email_notify', 'Do you want to recive email notification', 'required');
            $this->form_validation->set_rules('pd_listing_type', 'Select Listing', 'required');
            $this->form_validation->set_rules('parent_cat_select', 'Select Parent Category', 'required');
//            $this->form_validation->set_rules('pd_products_services', 'Product / Services', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $is_saved = $this->Listings_Model->save_payment_detail_meta($posted_data, $user_detail);

                if ($is_saved) {

                    redirect(base_url('purchase/' . $package_id) . '/' . volgo_encrypt_message('paypal'));
                } else {
                    $data = [
                        $this->session->set_flashdata('validation_errors', validation_errors())
                    ];
                    $this->load->view('frontend/payment_plans/payment_details', $data);
                    redirect(base_url('payment-details?package_id=' . $package_id));
                }
            } else {
                $data = [
                    $this->session->set_flashdata('validation_errors', validation_errors())
                ];
                $this->load->view('frontend/payment_plans/payment_details', $data);
                redirect(base_url('payment-details?package_id=' . $package_id));
            }
        }
    }

	public function purchase($package_id, $enc_method)
	{

		$message = 'package_id=' . $package_id . '&&enc_method=' . $enc_method;
		volgo_create_cookie(VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO, volgo_encrypt_message($message), 43200); // for 12 hours

		if (! volgo_front_is_logged_in()){
			$this->session->set_flashdata('success_msg', "Kindly signup or login to purchase package!");
			redirect('login?redirected_to=' . base_url('purchase/' . $package_id . '/' . $enc_method));
		}

		$payment_method = volgo_decrypt_message($enc_method);

		$available_payment_methods = array_map('trim', explode(',', AVAILABLE_PAYMENT_METHODS));

		if (! in_array($payment_method, $available_payment_methods)){
			$this->session->set_flashdata('paypal_payment_plan_error', '<h2>Sorry! </h2><p>Unable to continue. Payment method is not available. Kindly retry.</p>');

			redirect('payment-plans');
		}else {
			$insert_arr = $this->Orders_Model
				->place_order(
					$package_id,
					volgo_get_logged_in_user_id(),
					$payment_method
				);

			if (is_array($insert_arr) && !empty($insert_arr)) {

				if ($insert_arr['payment_method'] === 'paypal') {

					$paypal = new PayPal();
					$paypal->charge(
						$insert_arr['amount'],
						"Order for " . $insert_arr['package_title'] . ' - (AED: ' . floatval($insert_arr['aed_amount']) . ')',
						base_url('orders/paypal_return_url_handler/' . intval($insert_arr['order_id']) . '/' . intval($insert_arr['package_id']) . '/' . intval($insert_arr['package_user'])),
						base_url('orders/paypal_cancel_url_handler/' . intval($insert_arr['order_id'])) . '/' . intval($insert_arr['package_id']) . '/' . intval($insert_arr['package_user']),
						$insert_arr['currency_unit']
					);


				} else if ($insert_arr['payment_method'] === 'network') {

					// @todo: Network call should put here.
					echo 'Payment Method NETWORK';
					exit;

				} else {
					$this->session->set_flashdata('paypal_payment_plan_error', '<h2>Sorry! </h2><p>Unable to continue. Payment method error. Kindly retry.</p>');
					redirect('payment-plans');
				}
			} else {

				$this->session->set_flashdata('paypal_payment_plan_error', '<h2>Sorry! </h2><p>Unable to charge. Kindly retry.</p>');
				redirect('payment-plans');
			}
		}

    }

}
