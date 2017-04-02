<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$as = $_POST['as'];
$imid = $_POST['imid'];
$hid = $_POST['hid'];
$db->query("UPDATE gmbar SET ".$as." = 0 WHERE houseid=".$hid);
$db->query("UPDATE gmbar SET ".$as." = 1 WHERE imgid=".$imid);
?>
