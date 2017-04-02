<?php
//session_start();
if(!defined('MyConst')) {
   include ("../404.html");
exit();
}else{
//$_SESSION['csskeyPASS'] = "hello";
require("koneksi.php");
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo $base_url;?>css/style.css">
<script src="<?php echo $base_url;?>js/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->

<link href="<?php echo $base_url;?>fonts/fontawesome-webfont.woff">
<link href="<?php echo $base_url;?>fonts/fontawesome-webfont.woff2">
<link href="<?php echo $base_url;?>fonts/glyphicons-halflings-regular.ttf">
<link href="<?php echo $base_url;?>fonts/glyphicons-halflings-regular.woff">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $base_url;?>block/fav/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $base_url;?>block/fav/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $base_url;?>block/fav/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $base_url;?>block/fav/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $base_url;?>block/fav/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $base_url;?>block/fav/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $base_url;?>block/fav/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $base_url;?>block/fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_url;?>block/fav/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $base_url;?>block/fav/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $base_url;?>img/favicon.ico">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $base_url;?>block/fav/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_url;?>block/fav/favicon-16x16.png">
<link rel="manifest" href="<?php echo $base_url;?>block/fav/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo $base_url;?>block/fav/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<meta name="google-site-verification" content="takILMzvxiKbu1_3R9K4bMlpYZNss27vI_aKbUF54MA" />
<?php

} ?>
