<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileFlagreports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Flagreports_Model');
        $this->load->library('form_validation');
    }

    public function index($user_id , $listing_slug)
    {
        if (volgo_front_is_logged_in()) {
            $split = explode("/", uri_string());
            $data['listing_slug'] = end($split);
            $listing_title = $this->Flagreports_Model->get_title_of_listing($data['listing_slug']);
            $data['report_name'] = $listing_title[0]->title;
            $this->load->view('frontend-mobile/flag_reports/flag_reports', $data);
        }else{
              redirect('login?redirected_to=' . base_url() . uri_string());
//            redirect('login?redirected_to=' . base_url('flagreport/') . $user_id. '/' . $listing_slug);
        }

    }

    public function insert_flagreport($user_id, $listing_slug)
    {
        $split = explode("/", uri_string());
        $slug = end($split);
        $listing_slug = volgo_make_slug(urldecode($slug));
        $user_id = prev($split);

        $data = array(
            'flag_validation_errors' => '',
            'flag_success_msg' => ''
        );

        $input_data = filter_input_array(INPUT_POST);

        if (!empty($input_data)) {

            $this->form_validation->set_rules('spam', 'Spam', 'required');
            $this->form_validation->set_rules('fraud', 'Fraud', 'required');
            $this->form_validation->set_rules('miscategorized', 'Miscategorized', 'required');
            $this->form_validation->set_rules('repetitive', 'Repetitive', 'required');

            if ($this->form_validation->run() !== false) {

                $spam = $this->input->post('spam');
                $fraud = $this->input->post('fraud');
                $miscategorized = $this->input->post('miscategorized');
                $repetitive = $this->input->post('repetitive');
                $descirption = "[Spam] ";
                $descirption .= $spam;
                $descirption .= "</br>";
                $descirption .= "[Fraud] ";
                $descirption .= $fraud;
                $descirption .= "</br>";
                $descirption .= "[Miscategorized] ";
                $descirption .= $miscategorized;
                $descirption .= "</br>";
                $descirption .= "[Repetitive] ";
                $descirption .= $repetitive;

                $listing_title = $this->Flagreports_Model->get_title_of_listing($listing_slug);
                $user_name = $this->Flagreports_Model->get_username($user_id);

                $is_created = $this->Flagreports_Model->create_flag_report(
                    $user_name,
                    $listing_title,
                    $descirption
                );

                if ($is_created) {
                    // send email to listing user
                    $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
                    $session_data = explode(',', $session_data);
                    $logedin_user_email = $session_data[0];
                    $msg = str_replace('%%title%%', strtoupper($listing_title[0]->title), EMAIL_FLAG_REPORT_FOR_USER_WHO_REPORTED);
                    $emailto = $logedin_user_email;
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'FLAG REPORT |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom);

                    // send email to user who is reporting listing
                    $user_email = $this->Flagreports_Model->get_user_email($user_id);
                    $msg = str_replace('%%username%%', $user_name[0]->username, EMAIL_FLAG_REPORT_FOR_USER_WHOM_LISTING);
                    $msg = str_replace('%%title%%', strtoupper($listing_title[0]->title), $msg);
                    $emailto = $user_email;
                    $emailfrom = NEWSLETTER_FROM_EMAIL;
                    $subject = 'FLAG REPORT |' . SITE_NAME;
                    volgo_send_email($msg,$subject,$emailto,$emailfrom);
                    $data = array(
                        'flag_validation_errors' => validation_errors(),
                        'spam' => $spam,
                        'fraud' => $fraud,
                        'miscategorized' => $miscategorized,
                        'repetitive ' => $repetitive
                    );


                    $this->session->set_flashdata('flag_success_msg', '<strong>Thank You!</strong><br />' . 'Report submitted successfully.');

                    //$this->load->view('frontend/flag_reports/flag_reports', $data);

                    redirect(base_url() . 'flaglisting/index/' . $user_id . '/' . $listing_slug);

                } else {
                    $this->session->set_flashdata('flag_validation_errors', validation_errors());
                    $this->load->view('frontend-mobile/flag_reports/flag_reports', $data);
                    redirect(base_url() . 'flaglisting/index/' . $user_id . '/' . $listing_slug);
                }
            } else {
                $this->session->set_flashdata('flag_validation_errors', validation_errors());
                $this->load->view('frontend-mobile/flag_reports/flag_reports', $data);
                redirect(base_url() . 'flaglisting/index/' . $user_id . '/' . $listing_slug);
            }

        } else {
            $this->session->set_flashdata('flag_validation_errors', validation_errors());
            $this->load->view('frontend-mobile/flag_reports/flag_reports', $data);
            redirect(base_url() . 'flaglisting/index/' . $user_id . '/' . $listing_slug);
        }
    }


}
