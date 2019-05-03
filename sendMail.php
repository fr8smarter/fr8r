<?php
include ('includes/functions.inc.php');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
require_once "Mail.php";

$phone = phoneNumberFormat($_POST['phone']);
$host = "ssl://smtp.gmail.com";
$username = "bruce@falsepeakventures.com";
$password = "flybhenry";
$port = "465";
$to = $_POST['sendToEmail'];
$email_from = "bruce@falsepeakventures.com";
$email_subject = $_POST['emailSource'];
$email_body = $body = "First Name: {$_POST['first_name']}\n\nLast Name: {$_POST['last_name']}\n\n Phone: {$phone}\n\n Email: {$_POST['email']}\n\n\n Message: {$_POST['message']}";
$email_address = $_POST['email'];   

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {header('location: index.php');
echo("<p>Message successfully sent!</p>");
}

?>