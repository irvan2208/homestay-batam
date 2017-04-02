<!DOCTYPE html>
<html lang="id">
<head>
<!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBiMPo0smLAGAy0ZtJtLLbDXvvLAmDQv9o"></script>-->
<?php define('MyConst', TRUE);
include ("block/head.php");?>
<?php include ("block/header.php");?>
<?php
if ($getpid = $db->prepare("SELECT id FROM pages WHERE name = ?")) {

    /* bind parameters for markers */
    $getpid->bind_param("s", $_GET['page_name']);

    /* execute query */
    $getpid->execute();

    /* bind result variables */
    $getpid->bind_result($pageid);
 	$getpid->store_result();

    /* fetch value */
    $getpid->fetch();
    /* close statement */
    
}
	if ($getpid->num_rows == 1){
	$qhouse = $db->query ("SELECT * from pages where id = ".$pageid);
	$d = $qhouse->fetch_array();
}
	?>
	<meta property="og:url" content="<?php echo $base_url.$pagename;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $websitename.' '.$ptitle;?>" />
	<meta property="og:description" content="Your description" />
	<meta property="og:image" content="http://www.your-domain.com/path/image.jpg" />
<title>
<?php echo $websitename." ". $d['title']; ?>
</title>
<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '124072948020663',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<div class="container-fluid">
<?php 
	// $getbg =mysql_query("SELECT path from gmbar where houseid = ".$houseid." && asbg = '1'");
	// $getpbg = mysql_fetch_array($getbg);
?>
	<div class="row topsugest" 
	style="
	background-position: bottom;
	background-repeat: no-repeat;
	background-size: cover;    
	height: 200px;
	background-image: url('<?php echo $base_url;?>/img/bg.jpg');">
	</div>
</div>

<!--<div class="well well-lg">asd</div>-->
<div class="container" style="padding-bottom:20px;">
<div class="row">
	<div class="col-sm-12">
		<h1><?php echo $d['title']; ?></h1>
	</div>
</div>
<div id="fb-root"></div>
	<!-- Your share button code -->
<div class="row">
<div class="col-sm-12">
	<div class="fb-share-button" 
	data-href="http://homestay-batam.com/product.php?product_sku=beach-house-with-beach-view" 
	data-layout="button" data-mobile-iframe="true">
	<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
	</div>
</div>
</div>
<div class="row row-con">
        <div class="col-sm-12">
		  <?php echo $d['content'];?>
		</div>
    </div>
</div>

<?php include ("block/join.php");?>
</body>

<?php include ("block/footer.php");?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=124072948020663";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
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
