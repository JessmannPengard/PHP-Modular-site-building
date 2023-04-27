<?php

require("phpmailer/src/Exception.php");
require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("mail.config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    public function sendMail($fromEmail, $fromName, $toEmail, $subject, $body)
    {
        $response = false;

        $mail = new PHPMailer();

        try {
            // Set mail server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
            $mail->isHTML(true); //Set HTML Format
            $mail->CharSet = 'UTF-8'; //Set UTF8 encode
            $mail->isSMTP(); //Send using SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Host = MAIL_HOST; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = MAIL_USERNAME; //SMTP username
            $mail->Password = MAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = MAIL_PORT;

            // Set email detail
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($toEmail);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send mail and check for success
            $mail->send();
            $response = true;
        } catch (Exception $e) {
            // Fail
        }

        return $response;
    }
}


?>