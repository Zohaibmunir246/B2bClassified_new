<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Flagreport_Model extends CI_Model
{

	private $table_name = 'flag_reports';

	public function get_all_reports() {
		$this->db->select('a.id, a.listing_id, a.user_id, a.description, a.status, b.title, c.firstname');
		$this->db->from('flag_reports a');
		$this->db->join('listings b', 'a.listing_id = b.id', 'left');
		$this->db->join('b2b_users c', 'a.user_id = c.id', 'left');
        $this->db->order_by('a.id' , 'desc');

		$query = $this->db->get();

		return ( $query->result() );
}

	public function remove($flagReportId) {
		$this->db->where("id", $flagReportId);
		return $this->db->delete($this->table_name);
	}

}
