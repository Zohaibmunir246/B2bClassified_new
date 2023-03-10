<?php
/**
 * Created by PhpStorm.
 * User: volgopoint.com
 * Date: 2/25/2019
 * Time: 1:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers_Model extends CI_Model{

    private $table_name = 'newsletter_subscribers';

    public function create_subscriber($sendToSubscriberEmails = '', $name= '')
    {
        $this->db->select('email');
        $this->db->from($this->table_name);
        $this->db->where('email', $sendToSubscriberEmails);
        $sql = $this->db->get();
        if($sql->num_rows() === 0){
        $data = array(
            'name' => $name,
            'email'	=> $sendToSubscriberEmails,
            'status' => 'email_pending_verifications',
            'created_at'	=> date("Y-m-d H:i:s")
        );
        $this->db->set($data);
        return $this->db->insert($this->table_name);
        }else{
        return false;
        }
    }

    public function verify_subscriber($email){
        $this->db->where('email', $email);
        $this->db->set('status', 'email_verified');
        $this->db->update($this->table_name);
    }

}