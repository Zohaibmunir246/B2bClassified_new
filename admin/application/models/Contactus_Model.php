<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Contactus_Model extends CI_Model
{

	private $table_name = 'contact';

	function get_all_contacts(){

		$query = $this->db->order_by('id' , 'desc')->get($this->table_name);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
	}


	public function get_contact_by_id($id)
	{
		$this->db->select('id,name,email,phone,comments');
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return ( $query->row() );
	}



	public function update_contactus($id, $title = '', $content = '')
	{

		$data = array(
			'email'	=> $title,
			'comments'	=> $content
			// 'datetime'	=> date("Y-m-d H:i:s")

		);

		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update($this->table_name);
	}

	public function remove($contactUslId) {
		$this->db->where("id", $contactUslId);
		return $this->db->delete($this->table_name);
	}


}
