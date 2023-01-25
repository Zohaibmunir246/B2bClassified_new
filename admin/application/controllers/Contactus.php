<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 12:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Contactus_Model');
	}


	public function index()
	{
		$data['outcome'] = $this->Contactus_Model->get_all_contacts();
		$this->load->view('admin/contactus', $data);
	}

	public function send($id = '')
	{
		if (empty($id) || ! intval($id))
			redirect('sorry');

		$input_data = filter_input_array(INPUT_POST);
		if (! empty($input_data)){

			$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('comments', 'Reply Comments Content', 'required');

			if ($this->form_validation->run() !== false){

				$title = $this->input->post('email');
				$content = $this->input->post('comments');

				$is_updated = $this->Contactus_Model->update_contactus(
					$id,
					$title,
					$content
				);

				if ($is_updated){
					$page_data = $this->Contactus_Model->get_contact_by_id($id);

					$data = array(
						'validation_errors' => '',
						'success_msg'	=> '<strong>Congratulation!</strong><br /> Message has been sent.',
						'page_data'=> $page_data
					);

					$this->load->view('admin/replycontact', $data);
				}else {
					$page_data = $this->Contactus_Model->get_contact_by_id($id);

					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to send message. Some error occurred.',
						'page_data'=> $page_data
					);

					$this->load->view('admin/replycontact', $data);
				}
			}else {
				$page_data = $this->Contactus_Model->get_contact_by_id($id);

				$data = array(
					'validation_errors' => validation_errors(),
					'success_msg'	=> '',
					'page_data'=> $page_data
				);

				$this->load->view('admin/replycontact', $data);
			}

			$mail = new PHPMailer\PHPMailer\PHPMailer();

			// SMTP configuration

            try {
//                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = PHPMAILER_SENDER_HOST;
                $mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
                $mail->Username = PHPMAILER_SENDER_USERNAME;
                $mail->Password = PHPMAILER_SENDER_PASSWORD;
                $mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
                $mail->Port = PHPMAILER_SENDER_PORT;

                $mail->setFrom(NEWSLETTER_FROM_EMAIL);
                // Email subject
                $mail->Subject = 'no-reply';
                // Set email format to HTML
                $mail->isHTML(true);

                if(isset($title)){
                    $mail->addAddress($title);
                }
                if(isset($content)){
                    $mail->Body = $content;
                }
                $mail->send();
            } catch (Exception $e) {
                log_message('error', $mail->ErrorInfo);
            }

		}else {
			$page_data = $this->Contactus_Model->get_contact_by_id($id);

			$data = array(
				'validation_errors' => '',
				'success_msg'	=> '',
				'page_data'=> $page_data
			);

			$this->load->view('admin/replycontact', $data);
		}

	}


	public function remove($contactUslId = '') {
		if (empty($contactUslId))
				redirect('sorry');

		if ($this->Contactus_Model->remove($contactUslId)) {
				$this->session->set_flashdata('removed', 'success');

				redirect('contactus');
		} else {
				redirect('contactus');
		}
	}



}
