<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileAdvertisewithus extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Advertise_Model');
    }

    public function index()
    {
        $this->load->view('frontend-mobile/advertise_with_us/advertise_with_us');

    }

    public function create()
    {
        $input_data = filter_input_array(INPUT_POST);

            $this->form_validation->set_rules('fullname', 'Fullname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');

            if ($this->form_validation->run() !== false) {

                    $data = array(
                        'validation_errors' => validation_errors(),
                        'success_msg' => '<strong>Congratulation!</strong><br /> Message successfull.',
                        'fullname' => '',
                        'email' => '',
                        'phone' => '',
                        'message' => ''
                    );



                    // @todo: advertise with us message to admin

                    $mail = new \PHPMailer\PHPMailer\PHPMailer();


                    // Passing `true` enables exceptions
                    $msg = 'Email: ' . $input_data['email'] .'<br />' .'Name: ' . $input_data['fullname'] .'<br />' .'Phone No: ' . $input_data['phone'] . '<br />' . 'Message: ' . $input_data['message']; 
                         
                         $emailto = ADMIN_EMAIL;
                         $emailfrom = $input_data['email'];
                         $subject = 'New user want to advertise with us |' . SITE_NAME;
                         volgo_send_email($msg,$subject,$emailto,$emailfrom);

                    $this->session->set_flashdata('success_msg', '<strong>Thank You!</strong><br />' . 'for advertise with us.');
                    $this->load->view('frontend-mobile/advertise_with_us/advertise_with_us', $data);
                    redirect(base_url() . 'advertise-with-us');
            } else {
                $this->session->set_flashdata('validation_errors', validation_errors());
                $this->load->view('frontend-mobile/advertise_with_us/advertise_with_us');
                redirect(base_url(). 'advertise-with-us');
            }

    }

}
