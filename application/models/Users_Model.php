<?php
/**
 * Created by PhpStorm.
 * User: volgopoint.com
 * Date: 2/25/2019
 * Time: 1:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model
{

	private $table_name = 'b2b_users';

	public function add_user_from_google($email, $name, $state, $code, $session, $token, $refresh_token, $expires)
	{

		$name_arr = explode(' ', $name);

		if (count($name_arr) > 1 && isset($name_arr[0], $name_arr[1])) {
			$firstname = $name_arr[0];
			$lastname = $name_arr[1];
		} else if (isset($name_arr[0])) {
			$firstname = $name_arr[0];
			$lastname = '';
		} else {
			$firstname = $name_arr[0];
			$lastname = '';
		}
		
		$username = $firstname . $lastname;
		
		$password = volgo_get_random_string(14);
		$this->session->set_userdata('google_user_password', $password);

		$data = array(
			'username' => $username,
			'firstname' => $firstname,
			'lastname ' => $lastname,
			'email' => $email,
			'password' => password_hash(($password), PASSWORD_BCRYPT),
			'is_deleted' => '0',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);


		$this->db->set($data);
		$is_inserted = $this->db->insert($this->table_name);

		if (!$is_inserted) {
			return false;
		} else {
			$user_insert_id = $this->db->insert_id();

			$meta_data = [
				'google_state' => $state,
				'google_code' => $code,
				'google_session'	=> $session,
				'google_token'	=> $token,
				'google_refresh_token'	=> $refresh_token,
				'google_token_expires'	=> $expires,
				'user_registered_from'	=> 'Google',
			];

			foreach ($meta_data as $key => $value) {

				$data2 = array(
					'meta_key' => $key,
					'meta_value' => $value,
					'user_id' => $user_insert_id
				);

				//save data in database

				$this->db->set($data2);
				$is_inserted = $this->db->insert('b2b_user_meta');
				if (!$is_inserted) {
					break;
				}
			}
			return $is_inserted;
		}
	}

	public function add_user_from_facebook($email, $name, $id, $access_token, $access_token_metadata)
	{

		$name_arr = explode(' ', $name);

		if (count($name_arr) > 1 && isset($name_arr[0], $name_arr[1])) {
			$firstname = $name_arr[0];
			$lastname = $name_arr[1];
		} else if (isset($name_arr[0])) {
			$firstname = $name_arr[0];
			$lastname = '';
		} else {
			$firstname = $name_arr[0];
			$lastname = '';
		}

		$password = volgo_get_random_string(14);
		$this->session->set_userdata('facebook_user_password', $password);

		$data = array(
			'username' => $email,
			'firstname' => $firstname,
			'lastname ' => $lastname,
			'email' => $email,
			'password' => password_hash(($password), PASSWORD_BCRYPT),
			'is_deleted' => '0',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);


		$this->db->set($data);
		$is_inserted = $this->db->insert($this->table_name);

		if (!$is_inserted) {
			return false;
		} else {
			$user_insert_id = $this->db->insert_id();

			$meta_data = [
				'facebook_id' => $id,
				'facebook_token' => $access_token,
				'facebook_token_metadata'	=> serialize($access_token_metadata)
			];

			foreach ($meta_data as $key => $value) {

				$data2 = array(
					'meta_key' => $key,
					'meta_value' => $value,
					'user_id' => $user_insert_id
				);

				//save data in database

				$this->db->set($data2);
				$is_inserted = $this->db->insert('b2b_user_meta');
				if (!$is_inserted) {
					break;
				}
			}
			return $is_inserted;
		}
	}

	public function get_user_by_email($email)
	{
// 		$this->db->cache_on();
		$this->db->select('id, email');
		$this->db->from($this->table_name);
		$this->db->where('email', $email);
		$this->db->limit(1);
		$result = $this->db->get()->result();
// 		$this->db->cache_off();


		return ($result);

	}

    public function get_premium_user_by_email()
    {
        $this->db->select('bu.id, bm.meta_key, bm.meta_value');
        $this->db->from('b2b_users as bu');
        $this->db->join('b2b_user_meta as bm', 'bu.id = bm.user_id', 'left');
//        $this->db->where('bm.meta_key', 'pd_first_name');
//        $this->db->or_where('bm.meta_key', 'pd_last_name');
        $this->db->where('bm.meta_key', 'pd_email');
//        $this->db->or_where('bm.meta_key', 'parent_child_cat_select');
//        $this->db->or_where('bm.meta_key', 'pd_email_notify');
        $result = $this->db->get()->result();
        return ($result);



    }

	public function user_signup($input_data)
	{

		$username = $this->input->post('username');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');


		unset($input_data['username']);
		unset($input_data['firstname']);
		unset($input_data['lastname']);
		unset($input_data['email']);
		unset($input_data['password']);

		$data = array(
			'username' => $username,
			'firstname' => $firstname,
			'lastname ' => $lastname,
			'email' => strtolower($email),
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'is_deleted' => '0',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);

		$this->db->set($data);
		$is_inserted = $this->db->insert($this->table_name);

		if (!$is_inserted) {

			$data = [
				'validation_errors' => 'Data Not Inserted Something happened Kindly Retry',
				'success_msg' => '',
			];

			$this->load->view('frontend/users/user_signup', $data);
			return false;
		} else {
			$user_insert_id = $this->db->insert_id();

			if (!empty($input_data)) {

				foreach ($input_data as $key => $value) {

					$data2 = array(
						'meta_key' => $key,
						'meta_value' => $value,
						'user_id' => $user_insert_id
					);

					//save data in database

					$this->db->set($data2);

					$is_inserted = $this->db->insert('b2b_user_meta');
					if (!$is_inserted) {
						break;
					}
				}
				return $is_inserted;
			} else {
				return true;
			}
		}
	}

	public function verify_user_signup($email)
	{
// 		$this->db->cache_on();
		$this->db->select('id');
		$this->db->from('b2b_users');
		$this->db->where('email', $email);
		$this->db->limit(1);

		$user = $this->db->get()->row();
// 		$this->db->cache_off();


		$id = $user->id;


		$this->db->where('meta_key', 'status');
		$this->db->or_where('meta_key', 'user_status');
		$this->db->where('user_id', intval($id));

		$this->db->set('meta_value', 'verified');
		return $this->db->update('b2b_user_meta');
	}

	public function verfiy_user_login($data)
	{
		$condition = "lower(email)=" . "'" . strtolower($data['form_data']['user_email']) . "'";
		$password = $data['form_data']['user_password'];

//		$this->db->cache_on();
		$this->db->select('email,password,id');
		$this->db->from('b2b_users');
		$this->db->where($condition);
		$this->db->limit(1);

		$query = $this->db->get();
//		$this->db->cache_off();

		$row = $query->row();

		if (empty($row))
			//return false;
			return 'not_registered';

		// @Management Decision - Discuss with Mobeen
        // Do not check verification email if its old record.
		
        if (intval($row->id) > 1700){
        // check if user is verified by email
        //$status_row = $this->db->select('meta_value')->from('b2b_user_meta')->where('meta_key', 'status')->or_where('meta_key', 'user_status')->where('user_id', $row->id)->get()->row();
        $query_q = 'SELECT meta_value FROM b2b_user_meta WHERE (meta_key = "status" OR meta_key = "user_status") AND user_id = ' . $row->id;
        $result = $this->db->query($query_q);
        $status_row = $result->row();
        
        if (empty($status_row))
        return 'not_verified';
        
        if (strtolower($status_row->meta_value) === 'pending' || $status_row->meta_value === 0)
        return 'pending';
        
        if (strtolower($status_row->meta_value) === 'google_verified')
        return 'google_verified';
        
        if (strtolower($status_row->meta_value) === 'inactive')
        return 'inactive';
        }

		if (strtolower($row->email) === strtolower($data['form_data']['user_email']) && password_verify($password, $row->password)){
			return 'is_logged';
		}else{
		return 'not_log_in';
	    }
	}

	public function verfiy_user_email($data)
	{
		$condition = "email=" . "'" . $data['form_data']['user_email'] . "'";

// 		$this->db->cache_on();
		$this->db->select('username,email,id');
		$this->db->from('b2b_users');
		$this->db->where($condition);
		$this->db->limit(1);

		$query = $this->db->get();
// 		$this->db->cache_off();


		$row = $query->row();

		if (empty($row))
			return false;

		if ($row->email === $data['form_data']['user_email'])
			return $row;

		return false;
	}

	public function update_user_password($user_email, $password)
	{
		$this->db->set('password', password_hash($password, PASSWORD_BCRYPT));
		$this->db->where('email', $user_email);
		$this->db->update('b2b_users');
		return true;
	}

    public function update_email_notifications($user_id, $posted_data)
    {
        $this->db->select('id');
        $this->db->from('b2b_users');
        $this->db->where('id', $user_id);
        $this->db->limit(1);

        $user = $this->db->get()->row();

        $id = $user->id;

        $this->db->where('meta_key', 'pd_email_notify');
        $this->db->where('user_id', intval($id));

        $this->db->set('meta_value', $posted_data['pd_email_notify']);
        return $this->db->update('b2b_user_meta');
    }

    public function get_all_states(){
        $this->db->select('*');
        $this->db->from('b2b_states');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_cities(){
        $this->db->select('*');
        $this->db->from('b2b_cities');
        $query = $this->db->get();
        return $query->result();
    }

}

