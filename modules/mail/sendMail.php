<?php
require("Mail.php");

$response = new stdClass();

// Obtener los datos enviados mediante POST
$fromEmail = $_POST['fromEmail'] ?? '';
$fromName = $_POST['fromName'] ?? '';
$toEmail = $_POST['toEmail'] ?? '';
$subject = $_POST['subject'] ?? '';
$body = $_POST['body'] ?? '';

// Instantiate Mail class
$mail = new Mail();

// Send mail and check for success
if ($mail->sendMail($fromEmail, $fromName, $toEmail, $subject, $body)) {
    $response->succeed = true;
    $response->msg = "Message has been sent";
} else {
    $response->succeed = false;
    $response->msg = "Error: Message could not be sent.";
}

// Convertir el objeto PHP a JSON
$json = json_encode($response);

// Establecer la cabecera de respuesta para indicar que se está devolviendo JSON
header('Content-Type: application/json');

// Devolver el JSON
echo $json;

?>