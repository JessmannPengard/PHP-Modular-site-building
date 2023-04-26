<?php
require("Exception.php");
require("PHPMailer.php");
require("SMTP.php");
require("mail.config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$response = new stdClass();

// Obtener los datos enviados mediante POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer();

try {
    // Configurar los ajustes del servidor de correo
    $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host = MAIL_HOST; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = MAIL_USERNAME; //SMTP username
    $mail->Password = MAIL_PASSWORD; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = MAIL_PORT;

    // Configurar los detalles del correo electrónico
    $mail->setFrom($email, $name);
    $mail->addAddress(MAIL_MYEMAIL);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Enviar el correo electrónico y comprobar si se ha enviado correctamente
    $mail->send();
    $response->succeed = true;
    $response->msg = "Message has been sent";
} catch (Exception $e) {
    $response->succeed = false;
    $response->msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Convertir el objeto PHP a JSON
$json = json_encode($response);

// Establecer la cabecera de respuesta para indicar que se está devolviendo JSON
header('Content-Type: application/json');

// Devolver el JSON
echo $json;

?>