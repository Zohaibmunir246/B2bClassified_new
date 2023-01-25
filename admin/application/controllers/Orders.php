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
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Orders_Model');
		$this->load->model('Packages_Model');
	}

	public function index()
	{
		$all_orders = $this->Orders_Model->get_all_orders();
		$data = [
			'all_orders' => $all_orders
		];

		$this->load->view('admin/orders/show_all', $data);
	}

	public function addnew()
	{
		$packages = $this->Packages_Model->get_all_packages('id,title');
		$input_data = filter_input_array(INPUT_POST);

		if (! empty($input_data)){

			$this->form_validation->set_rules('select_package', 'Select Package', 'required|min_length[1]|integer');
			$this->form_validation->set_rules('package_user', 'User', 'required|min_length[1]|integer');
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'required|min_length[1]|max[255]');

			if ($this->form_validation->run() !== false){

				$payment_method = $this->input->post('payment_method');

				$available_payment_methods = array_map('trim', explode(',', AVAILABLE_PAYMENT_METHODS));

				if (! in_array($payment_method, $available_payment_methods)){
					$data = array(
						'validation_errors' => '<strong>Sorry</strong> Unable to continue. Payment method is not available. Kindly retry.',
						'packages'=> $packages
					);

					$this->load->view('admin/orders/add', $data);
				}else {
					$insert_arr = $this->Orders_Model
						->place_order(
							$this->input->post('select_package'),
							$this->input->post('package_user'),
							$payment_method
						);

					if (is_array($insert_arr) && ! empty($insert_arr)){

						if ($insert_arr['payment_method'] === 'paypal'){

							$paypal = new PayPal();

							$paypal->charge(
								$insert_arr['amount'],
								"Order for " . $insert_arr['package_title'] . ' - (AED: ' . floatval($insert_arr['aed_amount']) . ')',
								base_url('orders/paypal_return_url_handler/' . intval($insert_arr['order_id']) . '/' . intval($insert_arr['package_id']) . '/' . intval($insert_arr['package_user'])),
								base_url('orders/paypal_cancel_url_handler/' . intval($insert_arr['order_id'])) . '/' . intval($insert_arr['package_id']) . '/' . intval($insert_arr['package_user']),
								$insert_arr['currency_unit']
							);


						}else if ($insert_arr['payment_method'] === 'network'){

							// @todo: Network call should put here.
							echo 'Payment Method NETWORK';
							exit;

						}else {
							$data = array(
								'validation_errors' => '<strong>Sorry</strong> Unable to continue. Payment method error. Kindly retry.',
								'packages'=> $packages
							);

							$this->load->view('admin/orders/add', $data);
						}
					}else {
						$data = array(
							'validation_errors' => '<strong>Sorry</strong> Unable to continue. Unable to add record. Kindly retry.',
							'packages'=> $packages
						);

						$this->load->view('admin/orders/add', $data);
					}
				}
			}else {
				$data = array(
					'validation_errors' => '<strong>Sorry</strong> Unable to continue. Kindly retry.',
					'packages'=> $packages
				);

				$this->load->view('admin/orders/add', $data);
			}
		}else {

			$data = [
				'packages'	=> $packages
			];

			$this->load->view('admin/orders/add', $data);
		}
	}

	public function edit($order_id = '')
	{
		if (empty($order_id) || ! intval($order_id))
			redirect(base_url('sorry'));

		$packages = $this->Packages_Model->get_all_packages('id,title');
		$current_order = $this->Orders_Model->get_order_by_oid($order_id);
		$input_data = filter_input_array(INPUT_POST);

		if (! isset($current_order[0]))
			redirect(base_url('sorry'));

		$current_order = $current_order[0];

		if (! empty($input_data)){

			$this->form_validation->set_rules('order_status', 'Order Status', 'required');

			if ($this->form_validation->run() !== false){

				$is_updated = $this->Orders_Model
					->update_order_status(
						$order_id,
						$this->input->post('order_status')
					);

				if ($is_updated){

					$message = "<strong>Updated!</strong>";
					$message .= ' Order has been updated';

					$this->session->set_flashdata('success_msg', $message);
					redirect('orders');

				}else {
					$data = array(
						'validation_errors' => '<strong>Sorry! </strong> Unable to update.',
						'packages'=> $packages,
						'current_order'	=> $current_order
					);

					$this->load->view('admin/orders/editorder', $data);
				}

			}else {
				$data = array(
					'validation_errors' => validation_errors(),
					'packages'=> $packages,
					'current_order'	=> $current_order
				);

				$this->load->view('admin/orders/editorder', $data);
			}
		}else {

			$data = [
				'packages'	=> $packages,
				'current_order'	=> $current_order
			];

			$this->load->view('admin/orders/editorder', $data);
		}
	}

	// paymentId=PAYID-LRSAGNY0H458119UL042784J&token=EC-7VW95664R0171212Y&PayerID=7F48HGB2ATNJG
	public function paypal_return_url_handler($order_id = '', $package_id = '', $package_user = '')
	{
		if (empty($order_id) || empty($package_id) || empty($package_user))
			redirect(base_url('sorry'));

		$get_data = filter_input_array(INPUT_GET);

		$is_updated = $this->Orders_Model->update_by_order_id(
			$order_id,
			$get_data['paymentId'],
			$get_data['token'],
			$get_data['PayerID'],
			'paid',
			'paypal'
		);

		if ($is_updated){

			$message = "<strong>Success!</strong>";
			$message .= ' Order has been successfully paid and charged.';

			$this->session->set_flashdata('success_msg', $message);
			redirect('orders');

		}else {
			$packages = $this->Packages_Model->get_all_packages('id,title');
			$data = array(
				'validation_errors' => '<strong>Sorry</strong> Unable to continue. Kindly retry.',
				'packages'=> $packages
			);

			$this->load->view('admin/orders/add', $data);

		}
	}

	//token=EC-20C48771VC8353923
	public function paypal_cancel_url_handler($order_id = '', $package_id = '', $package_user = '')
	{
		if (empty($order_id) || empty($package_id) || empty($package_user))
			redirect(base_url('sorry'));

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

			$message = "<strong>Cancelled!</strong>";
			$message .= ' Order has been cancelled';

			$this->session->set_flashdata('success_msg', $message);
			redirect('orders');

		}else {
			$packages = $this->Packages_Model->get_all_packages('id,title');
			$data = array(
				'validation_errors' => '<strong>Sorry</strong> Unable to continue. Kindly retry.',
				'packages'=> $packages
			);

			$this->load->view('admin/orders/add', $data);
		}
	}

	public function remove($order_id = '')
	{
		if (empty($order_id) || ! intval($order_id))
			redirect(base_url('sorry'));

		if ($this->Orders_Model->remove($order_id)){
			$this->session->set_flashdata('removed','success');
			redirect('orders');
		}else {
			redirect('orders');
		}
	}
}
