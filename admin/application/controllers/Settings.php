<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Settings_Model');
	}


	public function index()
	{
		$data['settings'] = $this->Settings_Model->get_all_settings();

		$this->load->view('admin/settings/index', $data);
	}

	public function create_edit_data()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);
		$input_data = filter_input_array(INPUT_POST);

		if (!empty($input_data)) {

			//header logo upload start
			if (!empty($_FILES['header_logo']['name'])) {
				$config['upload_path'] = './uploads/settings';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('header_logo')) {
					$result['settings'] = $this->Settings_Model->get_all_settings();
					$this->load->view('admin/settings/index', $result);
					$unable_to_upload = true;
				} else {
					$upload_img_data = $this->upload->data();
					$header_logo = $upload_img_data["file_name"];
				}
			} else {
				$settings = $this->Settings_Model->get_all_settings();

				$header_logo = '';
				foreach ($settings as $setting) {
					if (isset($setting['header_logo'])){
						$header_logo = $setting['header_logo'];
						break;
					}
				}
			}

			if (isset($unable_to_upload))
				return;
			//header logo upload end

			//fav icon image upload start
			if (!empty($_FILES['fav_icon']['name'])) {
				$config['upload_path'] = './uploads/settings';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('fav_icon')) {
					$result['outcome'] = $this->Settings_Model->get_all_settings();
					$this->load->view('admin/settings/index', $result);
					$unable_to_upload = true;
				} else {
					$upload_img_data = $this->upload->data();
					$fav_icon = $upload_img_data["file_name"];
				}

			} else {
				$settings = $this->Settings_Model->get_all_settings();
				$fav_icon = '';
				foreach ($settings as $setting) {
					if (isset($setting['fav_icon'])){
						$fav_icon = $setting['fav_icon'];
						break;
					}
				}
			}

			if (isset($unable_to_upload))
				return;
			//fav icon image upload end

			$payment_methods = implode(',', (array) $this->input->post('available_payment_methods'));

			$data = array(
				'site_name' => $this->input->post('site_name'),
				'site_url' => $this->input->post('site_url'),
				'currency_unit' => $this->input->post('currency_unit'),
				'home_trade_img_w' => $this->input->post('home_trade_img_w'),
				'home_trade_img_h' => $this->input->post('home_trade_img_h'),
				'trade_detail_img_w' => $this->input->post('trade_detail_img_w'),
				'trade_detail_img_h' => $this->input->post('trade_detail_img_h'),
				'lis_featured_img_w' => $this->input->post('lis_featured_img_w'),
				'lis_featured_img_h' => $this->input->post('lis_featured_img_h'),
				'lis_recommended_img_w' => $this->input->post('lis_recommended_img_w'),
				'lis_recommended_img_h' => $this->input->post('lis_recommended_img_h'),
				'prop_lis_featured_img_w' => $this->input->post('prop_lis_featured_img_w'),
				'prop_lis_featured_img_h' => $this->input->post('prop_lis_featured_img_h'),
				'prop_lis_recommended_img_w' => $this->input->post('prop_lis_recommended_img_w'),
				'prop_lis_recommended_img_h' => $this->input->post('prop_lis_recommended_img_h'),
                'detail_slider_img_w' => $this->input->post('detail_slider_img_w'),
                'detail_slider_img_h' => $this->input->post('detail_slider_img_h'),
                'detail_slider_thumbnail_w' => $this->input->post('detail_slider_thumbnail_w'),
                'detail_slider_thumbnail_h' => $this->input->post('detail_slider_thumbnail_h'),
                'related_post_img_w' => $this->input->post('related_post_img_w'),
                'related_post_img_h' => $this->input->post('related_post_img_h'),
				'header_logo' => $header_logo,
				'fav_icon' => $fav_icon,
                'frontend_uploads_url' => $this->input->post('frontend_uploads_url'),
                'uploads_url' => $this->input->post('uploads_url'),

				'newsletter_from_email' => $this->input->post('newsletter_from_email'),
				'phpmailer_sender_host' => $this->input->post('phpmailer_sender_host'),
				'phpmailer_sender_smtpauth' => $this->input->post('phpmailer_sender_smtpauth'),
				'phpmailer_sender_username' => $this->input->post('phpmailer_sender_username'),
				'phpmailer_sender_pass' => $this->input->post('phpmailer_sender_pass'),
				'phpmailer_sender_smtp_secure' => $this->input->post('phpmailer_sender_smtp_secure'),
				'phpmailer_sender_port' => $this->input->post('phpmailer_sender_port'),

				'tiny_mce_api_key' => $this->input->post('tiny_mce_api_key'),
				'geo_ip_location_api_key' => $this->input->post('geo_ip_location_api_key'),
				'geo_ip_location_api_url' => $this->input->post('geo_ip_location_api_url'),
				'paypal_client_id' => $this->input->post('paypal_client_id'),
				'paypal_secret_id' => $this->input->post('paypal_secret_id'),
				'available_payment_methods' => $payment_methods,
				'exchange_rate_api_key' => $this->input->post('exchange_rate_api_key'),
				'exchange_rate_url' => $this->input->post('exchange_rate_url'),

				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'google_plus' => $this->input->post('google_plus'),
				'instagram' => $this->input->post('instagram'),
				'linkedin' => $this->input->post('linkedin'),
				'pinterest' => $this->input->post('pinterest'),
				'youtube' => $this->input->post('youtube'),
				'tumblr' => $this->input->post('tumblr'),

				'new_user_verify_email_link' => $this->input->post('new_user_verify_email_link'),
				'new_user_welcome_email' => $this->input->post('new_user_welcome_email'),
				'password_reset_email' => $this->input->post('password_reset_email'),
				'password_reset_email_success' => $this->input->post('password_reset_email_success'),

				'email_for_new_follower' => $this->input->post('email_for_new_follower'),
				'email_for_new_post_to_follower' => $this->input->post('email_for_new_post_to_follower'),

				'listing_approved_email_user' => $this->input->post('listing_approved_email_user'),
                'comment_approved_email_for_user' => $this->input->post('comment_approved_email_for_user'),

				'delete_account_request_email' => $this->input->post('delete_account_request_email'),
				'delete_account_request_success_email' => $this->input->post('delete_account_request_success_email'),
				'delete_account_request_success_email_for_admin' => $this->input->post('delete_account_request_success_email_for_admin'),
				'listing_added_email' => $this->input->post('listing_added_email'),
				'profile_updated_email' => $this->input->post('profile_updated_email'),

				'order_place_email' => $this->input->post('order_place_email'),
                'order_place_email_admin' => $this->input->post('order_place_email_admin'),
                'order_cancel_email_user' => $this->input->post('order_cancel_email_user'),
                'order_cancel_email_admin' => $this->input->post('order_cancel_email_admin'),
                'order_charged_email_user' => $this->input->post('order_charged_email_user'),
                'order_charged_email_admin' => $this->input->post('order_charged_email_admin'),

                'invoice_paid_email_user' => $this->input->post('invoice_paid_email_user'),
                'invoice_paid_email_admin' => $this->input->post('invoice_paid_email_admin'),
                'invoice_due_email_user' => $this->input->post('invoice_due_email_user'),
                'invoice_due_email_admin' => $this->input->post('invoice_due_email_admin'),

                'flag_report_email_admin' => $this->input->post('flag_report_email_admin'),
                'flag_report_email_user_listing_flagged' => $this->input->post('flag_report_email_user_listing_flagged'),
                'flag_report_email_user_report_listing' => $this->input->post('flag_report_email_user_report_listing'),

                'new_contact_form_admin' => $this->input->post('new_contact_form_admin'),
                'subscription_end_reminder_email' => $this->input->post('subscription_end_reminder_email'),
                'subscription_end_reminder_days' => $this->input->post('subscription_end_reminder_days'),

                'listing_approved_email_user' => $this->input->post('listing_approved_email_user'),
                'comment_approved_email_for_user' => $this->input->post('comment_approved_email_for_user'),

                'send_reply_email_to_user' => $this->input->post('send_reply_email_to_user'),
                'send_reply_email_to_sender' => $this->input->post('send_reply_email_to_sender'),
                'contact_email_buyer' => $this->input->post('contact_email_buyer'),
                'contact_email_seller' => $this->input->post('contact_email_seller')
                
			);

			$is_created = $this->Settings_Model->update_settings($data);
			if ($is_created) {
				$data = array(
					'validation_errors' => '',
					'success_msg' => '<strong>Congratulation!</strong><br/>' . ' settings has been created.',
					'site_name' => $this->input->post('site_name'),
					'site_url' => $this->input->post('site_url'),
					'currency_unit' => $this->input->post('currency_unit'),
					'home_trade_img_w' => $this->input->post('home_trade_img_w'),
					'home_trade_img_h' => $this->input->post('home_trade_img_h'),
					'trade_detail_img_w' => $this->input->post('trade_detail_img_w'),
					'trade_detail_img_h' => $this->input->post('trade_detail_img_h'),
					'lis_featured_img_w' => $this->input->post('lis_featured_img_w'),
					'lis_featured_img_h' => $this->input->post('lis_featured_img_h'),
					'lis_recommended_img_w' => $this->input->post('lis_recommended_img_w'),
					'lis_recommended_img_h' => $this->input->post('lis_recommended_img_h'),
                    'prop_lis_featured_img_w' => $this->input->post('prop_lis_featured_img_w'),
                    'prop_lis_featured_img_h' => $this->input->post('prop_lis_featured_img_h'),
                    'prop_lis_recommended_img_w' => $this->input->post('prop_lis_recommended_img_w'),
                    'prop_lis_recommended_img_h' => $this->input->post('prop_lis_recommended_img_h'),
                    'detail_slider_img_w' => $this->input->post('detail_slider_img_w'),
                    'detail_slider_img_h' => $this->input->post('detail_slider_img_h'),
                    'detail_slider_thumbnail_w' => $this->input->post('detail_slider_thumbnail_w'),
                    'detail_slider_thumbnail_h' => $this->input->post('detail_slider_thumbnail_h'),
                    'related_post_img_w' => $this->input->post('related_post_img_w'),
                    'related_post_img_h' => $this->input->post('related_post_img_h'),
					'header_logo' => $header_logo,
					'fav_icon' => $fav_icon,
                    'frontend_uploads_url' => $this->input->post('frontend_uploads_url'),
                    'uploads_url' => $this->input->post('uploads_url'),


					'newsletter_from_email' => $this->input->post('newsletter_from_email'),
					'phpmailer_sender_host' => $this->input->post('phpmailer_sender_host'),
					'phpmailer_sender_smtpauth' => $this->input->post('phpmailer_sender_smtpauth'),
					'phpmailer_sender_username' => $this->input->post('phpmailer_sender_username'),
					'phpmailer_sender_pass' => $this->input->post('phpmailer_sender_pass'),
					'phpmailer_sender_smtp_secure' => $this->input->post('phpmailer_sender_smtp_secure'),
					'phpmailer_sender_port' => $this->input->post('phpmailer_sender_port'),

					'tiny_mce_api_key' => $this->input->post('tiny_mce_api_key'),
					'paypal_client_id' => $this->input->post('paypal_client_id'),
					'paypal_secret_id' => $this->input->post('paypal_secret_id'),
					'available_payment_methods' => $this->input->post('available_payment_methods'),
					'exchange_rate_api_key' => $this->input->post('exchange_rate_api_key'),
					'exchange_rate_url' => $this->input->post('exchange_rate_url'),
					'exchange_rate_url_with_key' => $this->input->post('exchange_rate_url_with_key'),

					'facebook' => $this->input->post('facebook'),
					'twitter' => $this->input->post('twitter'),
					'google_plus' => $this->input->post('google_plus'),
					'instagram' => $this->input->post('instagram'),
					'linkedin' => $this->input->post('linkedin'),
					'pinterest' => $this->input->post('pinterest'),
					'youtube' => $this->input->post('youtube'),
					'tumblr' => $this->input->post('tumblr'),

                    'new_user_verify_email_link' => $this->input->post('new_user_verify_email_link'),
                    'new_user_welcome_email' => $this->input->post('new_user_welcome_email'),
                    'password_reset_email' => $this->input->post('password_reset_email'),
                    'password_reset_email_success' => $this->input->post('password_reset_email_success'),

                    'email_for_new_follower' => $this->input->post('email_for_new_follower'),
                    'email_for_new_post_to_follower' => $this->input->post('email_for_new_post_to_follower'),

                    'listing_approved_email_user' => $this->input->post('listing_approved_email_user'),
                    'comment_approved_email_for_user' => $this->input->post('comment_approved_email_for_user'),

                    'delete_account_request_email' => $this->input->post('delete_account_request_email'),
                    'delete_account_request_success_email' => $this->input->post('delete_account_request_success_email'),
                    'delete_account_request_success_email_for_admin' => $this->input->post('delete_account_request_success_email_for_admin'),
                    'listing_added_email' => $this->input->post('listing_added_email'),
                    'profile_updated_email' => $this->input->post('profile_updated_email'),

                    'order_place_email' => $this->input->post('order_place_email'),
                    'order_place_email_admin' => $this->input->post('order_place_email_admin'),
                    'order_cancel_email_user' => $this->input->post('order_cancel_email_user'),
                    'order_cancel_email_admin' => $this->input->post('order_cancel_email_admin'),
                    'order_charged_email_user' => $this->input->post('order_charged_email_user'),
                    'order_charged_email_admin' => $this->input->post('order_charged_email_admin'),

                    'invoice_paid_email_user' => $this->input->post('invoice_paid_email_user'),
                    'invoice_paid_email_admin' => $this->input->post('invoice_paid_email_admin'),
                    'invoice_due_email_user' => $this->input->post('invoice_due_email_user'),
                    'invoice_due_email_admin' => $this->input->post('invoice_due_email_admin'),

                    'flag_report_email_admin' => $this->input->post('flag_report_email_admin'),
                    'flag_report_email_user_listing_flagged' => $this->input->post('flag_report_email_user_listing_flagged'),
                    'flag_report_email_user_report_listing' => $this->input->post('flag_report_email_user_report_listing'),

                    'new_contact_form_admin' => $this->input->post('new_contact_form_admin'),
                    'subscription_end_reminder_email' => $this->input->post('subscription_end_reminder_email'),
                    'subscription_end_reminder_days' => $this->input->post('subscription_end_reminder_days'),

                    'listing_approved_email_user' => $this->input->post('listing_approved_email_user'),
                    'comment_approved_email_for_user' => $this->input->post('comment_approved_email_for_user'),
                    'contact_email_buyer' => $this->input->post('contact_email_buyer'),
                    'contact_email_seller' => $this->input->post('contact_email_seller')
				);



				$data['settings'] = $this->Settings_Model->get_all_settings();
				$this->load->view('admin/settings/index', $data);
                $this->session->set_flashdata('success_msg', '<strong>Congrates!</strong><br />' . 'settings has been updated');
				redirect(base_url('settings'));
			} else {
				$data['settings'] = $this->Settings_Model->get_all_settings();
				$this->load->view('admin/settings/index', $data);
			}

		} else {
			$data['settings'] = $this->Settings_Model->get_all_settings();
			$this->load->view('admin/settings/index', $data);
		}

	}


}
