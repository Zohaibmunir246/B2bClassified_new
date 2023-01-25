<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/12/2019
 * Time: 5:36 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->model('User_Model');
		$this->load->library('form_validation');
        $this->load->library('image_lib');
	}

	public function index()
	{
		$data = [
			'all_users' => $this->User_Model->get_all_user(),
			'all_cuntry' => $this->User_Model->get_all_countries(),

		];

		$this->load->view('admin/users/users_details', $data);
	}


	public function get_user__ajax($user_email = '')
	{
		if (!$this->input->is_ajax_request() || empty($user_email)) {
			exit('No direct script access allowed');
		}

		$users = $this->User_Model->get_user_by_email_like($user_email);
		if (empty($users)) {
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$return_arr = [];
		foreach ($users as $user) {
			$return_arr['results'][] = [
				'id' => $user->id,
				'text' => ucfirst($user->firstname) . ' ' . ucfirst($user->lastname) . ' (' . $user->email . ')'
			];
		}
		$return_arr['status'] = 'success';

		echo json_encode($return_arr);
		exit;
	}

	/**
	 *
	 */
	public function create()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);
		$input_data = filter_input_array(INPUT_POST);


		$this->form_validation->set_rules('username', 'User Name', 'required|min_length[1]|is_unique[b2b_users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]|is_unique[b2b_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('Selected_country', 'Select Country', 'required|min_length[1]');


		if ($this->form_validation->run() !== false) {

            $input_data['status'];
            //$input_data['user_image'];

			if (!empty($input_data)) {

				$is_created = $this->User_Model->create_user($input_data);
				
				if ($is_created) {

					if (!empty($_FILES['user_image']['name'])) {
					$config['upload_path'] = './uploads/user_profile';
					$config['allowed_types'] = 'gif|jpg|png';

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('user_image')) {
					$data = array(
						'validation_errors' => '<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors(),

					);
					$unable_to_upload = true;


					} else {
					$upload_img_data = $this->upload->data();
					$name_of_imageuploaded['user_image'] = $upload_img_data['file_name'];
					$name_of_imageuploaded['user_id'] = $is_created;
					
					$this->User_Model->store_image_admin($name_of_imageuploaded);

					}
					}
					$selected_country['user_id'] = $is_created;
					$selected_country['country_id'] = $input_data['Selected_country'];
					$this->User_Model->store_country_admin($selected_country);

					$data = [
						'validation_errors' => '',
						'success_msg' => 'Congratulations User Inserted into Database',
                        'username' => '',
                        'firstname' => '',
                        'lastname' => '',
                        'user_type' => '',
                        'email' => '',
                        'password' => '',
						'all_users' => $this->User_Model->get_all_user(),
						'all_cuntry' => $this->User_Model->get_all_countries(),

					];

					$this->session->set_flashdata('success_msg', 'User Created successfully.');
					redirect('users', $data);

				}

			} else {

				$data = [
					'success_msg' => '',
					'all_users' => $this->User_Model->get_all_user(),
					'all_cuntry' => $this->User_Model->get_all_countries(),

				];

				$this->load->view('admin/users/users_details', $data);
                $this->session->set_flashdata('validation_errors', 'data not uploaded Try Again');
                redirect('users', $data);
			}

		} else {
			$data = [
				'success_msg' => '',
				'all_users' => $this->User_Model->get_all_user(),
				'all_cuntry' => $this->User_Model->get_all_countries(),

			];
			$this->load->view('admin/users/users_details', $data);
            $this->session->set_flashdata('validation_errors', validation_errors());
            redirect('users', $data);
		}
		/// for the admin section /////////
	}


	public function update($id)
	{

		$data = array(
			'validation_errors' => '',
			'success_msg' => '',
		);
		$input_data = filter_input_array(INPUT_POST);
		
		$original_username = $this->db->select('username')->from('b2b_users')->where('id', intval($id))->get()->row();
		$original_email = $this->db->select('email')->from('b2b_users')->where('id', intval($id))->get()->row();

		if (empty($original_username) || $original_username->username !== $input_data['username']){
			$this->form_validation->set_rules('username', 'User Name', 'required|min_length[1]|is_unique[b2b_users.username]');
		}

		if (empty($original_email) || $original_email->email !== $input_data['email']){
			$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]|is_unique[b2b_users.email]');
		}

		$this->form_validation->set_rules('Selected_country', 'Select Country', 'required|min_length[1]');


		if ($this->form_validation->run() !== false) {

			if (!empty($input_data)) {
				$password =  $this->User_Model->get_password($id);
				$main_password = $password[0]-> password;

				$newpassswaordhash = $this->input->post("password_updated");

				if ($input_data['password_updated'] == null) {
					unset($input_data['password_updated']);
					$input_data['password_updated'] = $main_password;

				}else{

					unset($input_data['password_updated']);
					 $updatedhashpasword = password_hash($newpassswaordhash, PASSWORD_BCRYPT);
					$input_data['password_updated'] = $updatedhashpasword;
				}

				$is_created = $this->User_Model->udate_user($input_data, $id);
				
				if ($is_created) {
					$selected_country['user_id'] = $id;
					$selected_country['country_id'] = $input_data['Selected_country'];


					$country_updaeted = $this->User_Model->store_country_admin_update($selected_country, $id);
					}
					$data = [
						'validation_errors' => '',
						'success_msg' => 'Congratulations User Updated into Database',
						'all_users' => $this->User_Model->get_all_user(),
						'all_cuntry' => $this->User_Model->get_all_countries(),

					];
					
					if (!empty($_FILES['user_image']['name'])) {
					$config['upload_path'] = './uploads/user_profile';
					$config['allowed_types'] = 'gif|jpg|png';

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('user_image')) {
					$data = array(
					'validation_errors' => '<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors(),

					);
					$unable_to_upload = true;


					} else {
					$upload_img_data = $this->upload->data();
					$name_of_imageuploaded['image_name'] = $upload_img_data['file_name'];
					$name_of_imageuploaded['user_id'] = $id;
					$this->User_Model->store_image_admin_update($name_of_imageuploaded, $id);

					}


					}

					$this->session->set_flashdata('success_msg', 'User successfully updated');

					redirect('/viewusers/edit/' . $id);
					exit;
				}

			} else {
			$this->session->set_flashdata('error_msg', validation_errors());

			redirect('/viewusers/edit/' . $id);
		}
		
		/// for the admin section /////////
	}


}  /// end of class controller

