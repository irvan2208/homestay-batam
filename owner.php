<!DOCTYPE html>
<html lang="id">
<head>
<?php include ("block/head.php");
$ownusr = $_GET['own_usernm'];?>
<?php include ("block/header.php");?>
<?php
	$usrid = mysql_result(mysql_query("SELECT
	id
	FROM
	owner
	WHERE
	usernm = '$ownusr'"),0);
	?>
	<meta property="og:url" content="<?php echo $base_url.$ownusr;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Your Website Title" />
	<meta property="og:description" content="Your description" />
	<meta property="og:image" content="http://www.your-domain.com/path/image.jpg" />
	<?php
	$qhouse = mysql_query ("SELECT * from owner where id = ".$usrid);
	$d = mysql_fetch_array ($qhouse);
	?>
<title>
<?php echo $websitename." ". $d['nama']; ?>
</title>
</head>
<body>


<div class="container-fluid">
<?php 
	$getbg =mysql_query("SELECT usrbg from owner where id = ".$usrid);
	$getpbg = mysql_fetch_array($getbg);
?>
	<div class="row topsugest" 
	style="
	background-position: bottom;
	background-repeat: no-repeat;
	background-size: cover;    
	height: 200px;
	background-image: url('<?php echo $getpbg['usrbg'];?>');">
	</div>
</div>

<!--<div class="well well-lg">asd</div>-->
<div class="container" style="padding-bottom:20px;">

</div>

<?php include ("block/join.php");?>
</body>

<?php include ("block/footer.php");?>
<script>
    $(document).ready(function(){
      $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 50) { // check if user scrolled more than 50 from top of the browser window
          $(".navbar-fixed-top").css("background-color", "#355C7D "); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
        } else {
          $(".navbar-fixed-top").css("background-color", "transparent"); // if not, change it back to transparent
        }
      });
    });
</script>
</html>