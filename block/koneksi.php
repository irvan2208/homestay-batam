<?php
$db = new mysqli("localhost","root","","homesta1_btm1108");
$port = ":80"; //ganti port localhost disini kalau ada
$base_url = "http://" .$_SERVER['SERVER_NAME']."/";
$websitename = "Homestay-Batam";
date_default_timezone_set('Asia/Jakarta');

function chgtime($tgl){
  $a = $tgl;
  setlocale(LC_ALL, 'id_ID');
  echo strftime("%A, %d %B %Y",strtotime($a));
}

function countdays($tgl1, $tgl2){
	$tgla = strtotime($tgl1);
	$tglb = strtotime($tgl2);
    $datediff = $tglb - $tgla;
    $diff = floor($datediff/(60*60*24));
    return $diff;
}

require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
$mail->IsSMTP();
$mail->Host       = "mail.homestay-batam.com";
//$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;
$mail->Host       = "mail.homestay-batam.com";
$mail->Port       = 25;
$mail->Username   = "request@homestay-batam.com";
$mail->Password   = "request";
?>
