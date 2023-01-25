<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletters extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Newsletters_Model');
	}


	public function index()
	{
		$data['outcome'] = $this->Newsletters_Model->get_all_email_records();
		$this->load->view('admin/newsletters', $data);
	}


	public function addemail()
	{
		$data['result'] = $this->Newsletters_Model->get_all_subscirbers();
		$this->load->view('admin/addemail', $data);

	}

	public function send()
	{
		$data = array(
			'validation_errors' => '',
			'success_msg' => ''
		);

		$input_data = filter_input_array(INPUT_POST);
		if (!empty($input_data)) {

			$this->form_validation->set_rules('subject', 'Subject Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('email_body', 'Body Content', 'required');
			$this->form_validation->set_rules('send_to_subscriber_emails[]', 'Subscribers Email', 'required');

			if ($this->form_validation->run() !== false) {

				$subject = $this->input->post('subject');
				$emailBody = $this->input->post('email_body');
				$sendToSubscriberEmails = $this->input->post('send_to_subscriber_emails[]');

				$is_created = $this->Newsletters_Model->create_newsletter_emails(
					$subject,
					$emailBody,
					serialize($sendToSubscriberEmails)
				);

				if ($is_created) {
					$data = array(
						'validation_errors' => '',
						'success_msg' => '<strong>Congratulation!</strong><br />' . ' Newsletter emails has been sent.',
						'subject' => $subject,
						'email_body' => $emailBody,
						'send_to_subscriber_emails[]' => serialize($sendToSubscriberEmails)
					);
					$data['result'] = $this->Newsletters_Model->get_all_subscirbers();
					$this->load->view('admin/addemail', $data);
				} else {
					$data = array(
						'validation_errors' => '<strong>Sorry!</strong><br />' . 'Unable to sent newsletter. Some error occurred.'
					);
					$data['result'] = $this->Newsletters_Model->get_all_subscirbers();
					$this->load->view('admin/addemail', $data);
				}
			} else {
				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg' => ''
				);
				$data['result'] = $this->Newsletters_Model->get_all_subscirbers();
				$this->load->view('admin/addemail', $data);
			}



			// @todo: ISSUE: email is sending two times. lets see this in next update.



			$mail = new \PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
			try {
				//Server settings
				//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = PHPMAILER_SENDER_HOST;  // Specify main and backup SMTP servers
				$mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;                               // Enable SMTP authentication
				$mail->Username = PHPMAILER_SENDER_USERNAME;                 // SMTP username
				$mail->Password = PHPMAILER_SENDER_PASSWORD;                           // SMTP password
				$mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = PHPMAILER_SENDER_PORT;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom(NEWSLETTER_FROM_EMAIL, SITE_NAME);
				$mail->addAddress(NEWSLETTER_FROM_EMAIL, SITE_NAME);
				
				foreach ($sendToSubscriberEmails as $sendToSubscriberEmail){
					$mail->addBCC($sendToSubscriberEmail);
				}
				$mail->addReplyTo(NEWSLETTER_FROM_EMAIL, SITE_NAME);

				// Set email format to HTML
				$mail->isHTML(true);

				if (isset($emailBody)) {
					$mail->Body = $emailBody;
				}

				// Email subject
				if (isset($subject)) {
					$mail->Subject = $subject;
				}
				$mail->send();
				//echo 'Message has been sent';
			} catch (Exception $e) {
				log_message('error', $mail->ErrorInfo);
			}
		} else {

			$data = array(
				'validation_errors' => '',
				'success_msg' => ''
			);
			$data['result'] = $this->Newsletters_Model->get_all_subscirbers();
			$this->load->view('admin/addemail', $data);
		}

		if (!$mail->send()) {
			// echo 'Message could not be sent.';
			// echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			// echo 'Message has been sent';
		}
	}

	public function remove($newsletterEmailId = '')
	{
		if (empty($newsletterEmailId))
			redirect('sorry');

		if ($this->Newsletters_Model->remove($newsletterEmailId)) {
			$this->session->set_flashdata('removed', 'success');

			redirect('newsletters');
		} else {
			redirect('newsletters');
		}
	}


}
