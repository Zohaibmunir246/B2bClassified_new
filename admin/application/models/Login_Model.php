<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/30/2019
 * Time: 2:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Login_Model extends CI_Model
{
	public function auth_check($data)
	{
		$this->db->select('email,password,id');
		$this->db->from('b2b_users');
		$this->db->where('email', $data['form_data']['user_email']);
		$this->db->where('user_type', 'administrator');
		$this->db->or_where('user_type', 'superadmin');
		$this->db->limit(1);

		$query = $this->db->get();
		$row = $query->row();

		if (! $row)
			return false;

		$form_useremail = $data['form_data']['user_email'];
		$form_userpassword = $data['form_data']['user_password'];

		if (password_verify($form_userpassword, $row->password) && ($row->email === $form_useremail)){
			return true;
		}else {
			return false;
		}
	}
}
