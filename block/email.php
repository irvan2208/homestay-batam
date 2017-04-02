<?php
require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
$mail->IsSMTP();
$mail->Host       = "mail.homestay-batam.com";
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;
$mail->Host       = "mail.homestay-batam.com";
$mail->Port       = 25;
$mail->Username   = "request@homestay-batam.com";
$mail->Password   = "request";
?>