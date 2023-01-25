<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Contactus_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('frontend/contact_us/contactus');
    }

    public function create()
    {
        $data = array(
            'validation_errors' => '',
            'success_msg' => ''
        );

        $input_data = filter_input_array(INPUT_POST);

        if (!empty($input_data)) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('comments', 'Comments', 'required');

            if ($this->form_validation->run() !== false) {

                $name = $this->input->post('name');
                $subject = $this->input->post('subject');
                $email = $this->input->post('email');
                $comments = $this->input->post('comments');

                $is_created = $this->Contactus_Model->user_contact(
                    $name,
                    $subject,
                    $email,
                    $comments
                );

                if ($is_created) {
                    $data = array(
                        'validation_errors' => validation_errors(),
                        'name' => $name,
                        'subject' => $subject,
                        'email' => $email,
                        'comments ' => $comments
                    );

                    // @todo: contact us message to admin


                        $msg = str_replace('%%name%%', $data['name'], EMAIL_NEW_CONTACT_FORM);
                        $msg = str_replace('%%subject%%', $data['subject'], $msg);
                        $msg = str_replace('%%email%%', $data['email'], $msg);
                        $msg = str_replace('%%comment%%', $data['comments'], $msg);
                        
                        $emailto = NEWSLETTER_FROM_EMAIL;
                        $emailfrom = $data['email'];
                        $subject = 'New user contact us |' . SITE_NAME;
                        volgo_send_email($msg,$subject,$emailto,$emailfrom);

                    // @todo: contact us message to user

                        
                        $msg = 'Your comment has been sent successfully';
                        $emailto = '';
                        $emailfrom = NEWSLETTER_FROM_EMAIL;
                        $subject = 'Welcome |' . SITE_NAME;
                        volgo_send_email($msg,$subject,$emailto,$emailfrom,$data,$addBCC = true);

                    $this->session->set_flashdata('success_msg', '<strong>Thank You!</strong><br />' . 'message submitted successfully.');
                    $this->load->view('frontend/contact_us/contactus', $data);
                    redirect(base_url('contact-us'));
                } else {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    $this->load->view('frontend/contact_us/contactus', $data);
                    redirect(base_url('contact-us'));
                }
            } else {
                $this->session->set_flashdata('validation_errors', validation_errors());
                $this->load->view('frontend/contact_us/contactus', $data);
                redirect(base_url('contact-us'));
            }

        } else {
            $this->session->set_flashdata('validation_errors', validation_errors());
            $this->load->view('frontend/contact_us/contactus', $data);
            redirect(base_url('contact-us'));
        }

    }

}
