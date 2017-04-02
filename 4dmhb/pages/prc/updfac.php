<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$facid = $_POST['facid'];
$db->query("UPDATE fasilitas SET `value` = IF(`value`=1, 0, 1) WHERE id=".$facid);
?>
