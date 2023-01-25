<?php
/**
 * Created by PhpStorm.
 * User: volgopoint.com
 * Date: 2/25/2019
 * Time: 2:29 PM
 */

class Subscribers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Subscribers_Model');
    }

    public function create()
    {
        $data = array(
            'validation_errors' => '',
            'success_msg' => '',
        );

        $input_data = filter_input_array(INPUT_POST);
        if (!empty($input_data)) {

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() !== false) {

                $sendToSubscriberEmails = $this->input->post('email');
                $name = $this->input->post('name');
                $is_created = $this->Subscribers_Model->create_subscriber(
                    $sendToSubscriberEmails, $name
                );

                if ($is_created) {
                    $data = array(
                        'validation_errors' => validation_errors(),
                        'success_msg' => '<strong>Congratulation!</strong><br />' . $sendToSubscriberEmails . ' subscriber has been created.',
                        'email' => $sendToSubscriberEmails,
                        'name' => $name,
                    );
                    // we don't need it (apparently)
                    // $html = 'email:' . $sendToSubscriberEmails . '|||status:' . 'email_pending_verifications';
                    // $msg = base_url('subscribers/verify_email/') . volgo_encrypt_message($html);
                    // $user_data = array('email' => $sendToSubscriberEmails, 'name' => $name);
                    // $emailto = '';
                    // $emailfrom = NEWSLETTER_FROM_EMAIL;
                    // $subject = 'Verify Your Email  |' . SITE_NAME;
                    // volgo_send_email($msg,$subject,$emailto,$emailfrom,$user_data);

                    echo json_encode(['success_msg' => '<strong>Congratulation!</strong><br />' . $sendToSubscriberEmails . ' subscriber has been created.']);
                    exit;
                } else {
                    echo json_encode(['validation_errors' => 'Email Already Exist']);
                    exit;
                }
                // if(!$mail->send()){
                //     // echo 'Message could not be sent.';
                //     // echo 'Mailer Error: ' . $mail->ErrorInfo;
                // }else{
                //     // echo 'Message has been sent';
                // }
            } else {
                echo json_encode(['validation_errors' => validation_errors()]);
                exit;
            }
        } else {
            echo json_encode(['validation_errors' => validation_errors()]);
            exit;
        }

    }

    public function verify_email($token)
    {

        $result = volgo_decrypt_message($token);
        $data = explode("|||", $result, 2);
        $user_email = explode(':', $data[0], 2);
        $user_status = explode(':', $data[1], 2);
        $user_email = $user_email[1];
        $user_status = $user_status[1];

        if (!empty($user_email)) {
            $msg = 'Thank you! You are subscribed successfully';
            $emailto = $user_email;
            $emailfrom = NEWSLETTER_FROM_EMAIL;
            $subject = 'Congratulations';
            volgo_send_email($msg, $subject, $emailto, $emailfrom);

            $this->Subscribers_Model->verify_subscriber($user_email);

            $message = "<h2>Success! </h2>";
            $message .= '<p>subscriber verified successfully.</p>';

            $this->session->set_flashdata('subscriber_success', $message);
            redirect(base_url());
        } else {
            $message = "<h2>Sorry! </h2>";
            $message .= '<p>Unable to verify subscriber.</p>';
            $this->session->set_flashdata('subscriber_error', $message);
            redirect(base_url());
        }

    }
}
