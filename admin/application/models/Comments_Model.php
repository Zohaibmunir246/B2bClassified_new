<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Comments_Model extends CI_Model
{

	private $table_name = 'comments';

	function get_all_comments(){
	    $this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table_name);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
	}

    public function view_single_comment($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_comment($status='', $comment_id = '') {
        $data = array(
            'is_approved' => $status
        );
        $this->db->set($data);
        $this->db->where('id', $comment_id);
        return $this->db->update($this->table_name);
    }

	public function remove($commentId) {
		$this->db->where("id", $commentId);
		return $this->db->delete($this->table_name);
	}

    public function get_listing_slug($listing_id) {
        $this->db->select('slug');
        $this->db->from('listings');
        $this->db->where("id", $listing_id);
        $query = $this->db->get();
        return $query->row('slug');
    }


}
