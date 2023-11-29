<?php
require("Mail.php");

$response = new stdClass();

// Get POST data
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

// Convert to JSON
$json = json_encode($response);

// Establish header
header('Content-Type: application/json');

// Return JSON
echo $json;
