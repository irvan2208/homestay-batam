<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$reqid = $_POST['reqid'];
$date = date("Y-m-d H:i:s");
$db->query("INSERT INTO hbtcek_decline VALUES ('".$reqid."','".$date."','".$adm."')");
?>
