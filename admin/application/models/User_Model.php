<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/12/2019
 * Time: 4:54 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class User_Model extends CI_Model
{

	private $users_table = 'b2b_users';

	public function get_all_users($columns = 'id,firstname,lastname,email')
	{

		$this->db->select($columns);
		$this->db->from($this->users_table);

		$query = $this->db->get();
		return $query->result();

	}
	public function get_password($id)
	{
		$this->db->select('*');
		$this->db->from('b2b_users');
		$this->db->where("id" , $id);

		$this->db->order_by('id');
		$query = $this->db->get();
		return ($query->result());
	}



	public function get_user_by_email_like($email, $columns = 'id,firstname,lastname,email')
	{

		$this->db->select($columns);
		$this->db->from($this->users_table);
		$this->db->like('email', $email);

		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_user()
	{
		$this->db->select('*');
		$this->db->from('b2b_users');

		$this->db->order_by('id');


		$query = $this->db->get();


		return ($query->result());
	}

	public function get_all_countries()
	{
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->from('b2b_countries');

		$this->db->order_by('name');

		$query = $this->db->get();
		$this->db->cache_off();


		return ($query->result());
	}

	public function create_user($input_data)
	{

        $username = $this->input->post('username');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $usertype = $this->input->post('user_type');
        $email = $this->input->post('email');
        $password = $this->input->post('password');


        unset($input_data['username']);
        unset($input_data['firstname']);
        unset($input_data['lastname']);
        unset($input_data['user_type']);
        unset($input_data['email']);
        unset($input_data['password']);

        $data = array(
            'username' => $username,
            'firstname' => $firstname,
            'lastname ' => $lastname,
            'user_type ' => $usertype,
            'email' => strtolower($email),
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'is_deleted' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

		$this->db->set($data);

        $is_inserted = $this->db->insert('b2b_users');
        if(!$is_inserted){
            $data = [
                'validation_errors' => 'Data Not Inserted Something happened Kindly Retry',
                'success_msg' => '',
            ];

            $this->load->view('users', $data);
            return false;
        }else{
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
                return $user_insert_id;
            } else {
                return true;
            }
        }

	}

	public function udate_user($input_data, $id)
	{

		$data = array(
			'username' => $this->input->post('username'),
			'firstname' => $this->input->post('firstname'),
			'lastname ' => $this->input->post('lastname'),
			'password' => $input_data['password_updated'],
			'user_type' => $this->input->post('user_type'),
			'email' => $this->input->post('email'),
			'is_deleted' => null,
			'updated_at' => date("Y-m-d H:i:s"),
		);

		$this->db->set($data);
		$this->db->where('id', $id);

        $is_inserted = $this->db->update(
			'b2b_users'
		);


        if (!$is_inserted) {

            $data = [
                'validation_errors' => 'Data Not Inserted Something happened Kindly Retry',
                'success_msg' => '',
            ];

            $this->load->view('admin/viewusers/edit', $data);
            return false;
        } else {

            if (!empty($input_data)) {

                foreach ($input_data as $key => $value) {
                    if (is_array($value)) {
                        $value = serialize($value);

                    }
                    $data2 = array(
                        'meta_value' => $value
                    );
                    $this->db->select('*');
                    $sql = $this->db->get('b2b_user_meta');
                    if($sql->num_rows() > 0){
                        //save data in database
                        $this->db->where('user_id', $id);
                        $this->db->where('meta_key', $key);
                        $this->db->set($data2);

                        $is_updated = $this->db->update(
                            'b2b_user_meta'
                        );

                        if (!$is_updated) {
                            break;
                        }
                    }else{
                        $this->db->set('b2b_user_meta', $id);
                        $this->db->set('meta_key', $key);
                        $this->db->set($data2);

                        $is_inserted = $this->db->insert('b2b_user_meta');
                        if (!$is_inserted) {
                            break;
                        }
                    }
                }
                return $is_updated;
            } else {
                return true;
            }
        }

	}

	public function store_image_admin($name_of_imageuploaded)
	{

		$data = array(
			'user_id' => $name_of_imageuploaded['user_id'],
			'meta_key' => 'Image_of_profile_user',
			'meta_value' => $name_of_imageuploaded['user_image'],

		);

		$this->db->set($data);

		$this->db->insert(
			'b2b_user_meta'
		);
	}

	public function store_image_admin_update($name_of_imageuploaded , $id)
	{

		$data = array(
			'user_id' => $name_of_imageuploaded['user_id'],
			'meta_key' => 'profile_image',
			'meta_value' => $name_of_imageuploaded['image_name'],

		);

		$this->db->select('*');
		$this->db->where('user_id' , $id );
		$this->db->where("meta_key" , "Image_of_profile_user");
		$this->db->or_where("meta_key" , "profile_image");
		$this->db->from('b2b_user_meta');
		$sql = $this->db->get();
		if($sql->num_rows() > 0){
		$this->db->set($data);
		$this->db->where('user_id' , $id );
		$this->db->where("meta_key" , "Image_of_profile_user");
		$this->db->or_where("meta_key" , "profile_image");
		$this->db->update(
			'b2b_user_meta'
		);
	 	}else{
	 		$this->db->set($data);
	 		$this->db->insert(
			'b2b_user_meta'
		);
	 	}

		return true;

	}

	public function store_country_admin($selected_country)
	{
		// changed Country_id to Selected_country in meta key
		$data = array(
			'user_id' => $selected_country['user_id'],
			'meta_key' => 'Selected_country',
			'meta_value' => $selected_country['country_id'],
		);

		$this->db->set($data);

		$this->db->insert(
			'b2b_user_meta'
		);

	}
	public function store_country_admin_update($selected_country , $id)
	{
		$data = array(
			'user_id' => $selected_country['user_id'],
			'meta_key' => 'Selected_country',
			'meta_value' => $selected_country['country_id'],
		);
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$this->db->where("meta_key" , "Selected_country");
		$this->db->or_where("meta_key" , "Country_Id");
		$this->db->from('b2b_user_meta');
		$sql = $this->db->get();
		if($sql->num_rows() > 0){
		$this->db->set($data);
		$this->db->where('user_id', $id);
		$this->db->where("meta_key" , "Selected_country");
		$this->db->or_where("meta_key" , "Country_Id");
		$this->db->update(
			'b2b_user_meta'
		);
	 	}else{
	 		$this->db->set($data);
	 		$this->db->insert(
			'b2b_user_meta'
		);
	 	}

		return true;

	}

	// view users //

	public function record_count_users()
	{
		return $this->db->count_all("b2b_users");
	}

	public function fetch_data_all_users($limit, $page)
	{
		$offset = ($page - 1) * $limit;
		$this->db->select('*');
		$this->db->from('b2b_users');
		$this->db->order_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();


		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;

		} else {
			return false;
		}
	}

	public function record_count_search_users($search)
	{
		$this->db->select('*');
		$this->db->from('b2b_users');
		$this->db->like('username', $search);
		$this->db->like('firstname', $search);
		$this->db->like('lastname', $search);
		$this->db->like('email', $search);
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function fetch_data_search_all_users($limit, $page, $search)
	{
		$offset = ($page - 1) * $limit;
		$this->db->select('*');
		$this->db->from('b2b_users');
		$this->db->like('username', $search);
		$this->db->or_like('firstname', $search);
		$this->db->or_like('lastname', $search);
		$this->db->or_like('email', $search);
		$this->db->order_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$data = [];
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$data[$key] = $row;
			}
			return $data;
		} else {
			return "No User Found";
		}
	}

	public function remove($delte_id)
	{
		$this->db->where("id", $delte_id);

		$this->db->delete("b2b_users");
		$this->db->where("user_id", $delte_id);
		$this->db->delete("b2b_user_meta");
		return true;

	}

	public function get_current_user($edit_id)
	{

		$this->db->select("*");
		$this->db->from("b2b_users");
		$this->db->where("id", $edit_id);
		$query = $this->db->get();
		return ($query->result());

	}

	public function get_current_user_meta($edit_id)
	{

		$this->db->select("*");
		$this->db->from("b2b_user_meta");
		$this->db->where("user_id", $edit_id);
		$query = $this->db->get();
		return ($query->result());

	}

	public function get_current_user_meta_image($edit_id)
	{

		$this->db->select("*");
		$this->db->from("b2b_user_meta");
		$this->db->where("user_id", $edit_id);
		$this->db->where("meta_key" , 'Image_of_profile_user');
		$this->db->or_where("meta_key" , "profile_image");
		$query = $this->db->get();
		return ($query->result());

	}


}
