<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Newsletters_Model extends CI_Model
{

	private $table_name = 'newsletter_emails';

	function get_all_subscirbers(){
		$query = $this->db->get('newsletter_subscribers');
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
	}

	function get_all_email_records(){
		$query = $this->db->get($this->table_name);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
	}

	public function create_newsletter_emails($subject = '', $emailBody = '', $sendToSubscriberEmails = "")
	{
		$data = array(
			'subject' => $subject,
			'email_body' => $emailBody,
			'send_to_subscriber_emails'	=> serialize($sendToSubscriberEmails),
			'create_date'	=> date("Y-m-d H:i:s")
		);
		$this->db->set($data);
		return $this->db->insert($this->table_name);
	}
	

	public function remove($newsletterEmailId) {
		$this->db->where("id", $newsletterEmailId);
		return $this->db->delete($this->table_name);
	}


}
