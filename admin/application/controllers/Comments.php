<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Comments_Model');
	}


	public function index()
	{
		$data['outcome'] = $this->Comments_Model->get_all_comments();
		$this->load->view('admin/comments/comments', $data);
	}

    public function edit($id = '') {
        if (empty($id))
            redirect('sorry');


        $data = [
            'validation_errors' => '',
            'success_msg' => '',
        ];
        $input_data = filter_input_array(INPUT_POST);

        $this->form_validation->set_rules('is_approved', 'Status', 'required');

        $comment = $this->Comments_Model->view_single_comment($id);
        $listing_id = $comment[0]->post_id;
        $user_id = $comment[0]->user_id;
        $user_name = $comment[0]->user_name;
        $email = $comment[0]->user_email;
        $message = $input_data['comment'];
        $slug = $this->Comments_Model->get_listing_slug($listing_id);
        $post_link = FRONT_END_SITE_URL . $slug;

        if ($this->form_validation->run() !== false) {
            $status = $input_data['is_approved'];
            $is_created = $this->Comments_Model->update_comment($status, $id);
            if($input_data['is_approved'] && $is_created){
                $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                // SMTP configuration
                try {
                    // $mail->SMTPDebug = true;
                    // $mail->SMTPDebug = 2; //Alternative to above constant
                    $mail->isSMTP();
                    $mail->Host = PHPMAILER_SENDER_HOST;
                    $mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
                    $mail->Username = PHPMAILER_SENDER_USERNAME;
                    $mail->Password = PHPMAILER_SENDER_PASSWORD;
                    $mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
                    $mail->Port = PHPMAILER_SENDER_PORT;

                     $msg = str_replace('%%message%%', $message, COMMENT_APPROVED_EMAIL_FOR_USER);
                     $msg = str_replace('%%postlink%%', $post_link, $msg);
                     $msg = str_replace('%%username%%', $user_name, $msg);

                    $mail->setFrom(NEWSLETTER_FROM_EMAIL);
                    // Email subject
                    $mail->Subject = 'NEW Comment |' . SITE_NAME;
                    // Set email format to HTML
                    $mail->isHTML(true);
                    $mail->addAddress($email);

                    $mail->Body = $msg;
                    $mail->send();
                } catch (Exception $e) {
                    log_message('error', $mail->ErrorInfo);
                    //redirect(404);
                    return true;
                }
            }
            $data = [
                'validation_errors' => '',
                'success_msg' => '<strong>Congratulation!</strong><br /> Comment has been updated.',

            ];
            $this->session->set_flashdata('success_msg', 'Comment updated successfully.');
            redirect('comments', $data);

        }else{
            $data = [
                'validation_errors' => validation_errors(),
                'success_msg' => '',
                'all_comments' => $this->Comments_Model->view_single_comment($id)

            ];
            $this->load->view('admin/comments/edit_comment', $data);

        }
    }

	public function remove($commentId = '') {
		if (empty($commentId))
				redirect('sorry');

		if ($this->Comments_Model->remove($commentId)) {
				$this->session->set_flashdata('removed', 'success');

				redirect('comments');
		} else {
				redirect('comments');
		}
	}



}
