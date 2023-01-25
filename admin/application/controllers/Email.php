<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
    }
    
    function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'farhanvolgopoint@gmail.com';
        $mail->Password = 'Volgopoint203';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('farhanvolgopoint@gmail.com', 'vologpoint');
        $mail->addReplyTo('farhanfareed9@gmail.com', 'vologpoint');
        
        // Add a recipient
        $mail->addAddress('farhanfareed9@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('fari.ali86@yahoo.com');
        $mail->addBCC('fari.ali86@yahoo.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    
}