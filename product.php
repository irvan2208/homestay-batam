<?php
session_start();
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php
define('MyConst', TRUE);
include ("block/head.php");?>
<?php include ("block/header.php");?>
<?php
if ($gethid = $db->prepare("SELECT house.id as hid FROM house WHERE house.sku = ?")) {

    /* bind parameters for markers */
    $gethid->bind_param("s", $_GET['product_sku']);

    /* execute query */
    $gethid->execute();

    /* bind result variables */
    $gethid->bind_result($houseid);
 	$gethid->store_result();

    /* fetch value */
    $gethid->fetch();
    /* close statement */
    
}
	//$houseid = mysqli_fetch_assoc($db->query(""));
if ($gethid->num_rows == 1){
	$qhouse = $db->query ("SELECT * from house where id = ".$houseid);
	$d = $qhouse->fetch_array();
}
	?>
	<meta property="og:url" content="<?php echo $base_url.$housesku;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $websitename." ". $d['title']; ?>" />
	<meta property="og:description" content="<?php echo $d['desk']; ?>" />
<?php 
if ($gethid->num_rows==1) {
	$getag =mysqli_fetch_assoc($db->query("SELECT path as active from gmbar where houseid = ".$houseid." && active= '1'"));
$getim = $getag['active'];
?>
	<meta property="og:image" content="<?php echo $base_url.$getim;?>" />
<?php } ?>
<title>
<?php if ($gethid->num_rows == 1){echo $websitename." ". $d['title'];}else{echo $websitename." Not Found";} ?>
</title>
<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>
<?php if ($gethid->num_rows == 1):?>
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
if ($gethid->num_rows==1) {
	$getbg =mysqli_fetch_assoc($db->query("SELECT path as alg from gmbar where houseid = ".$houseid." && asbg = '1'"));
	//$getpbg = $getbg->fetch_array();
?>
	<div class="row topsugest" 
	style="
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;    
	height: 200px;
	background-image: url('<?php echo $base_url.$getbg['alg'];?>');">
	</div>
	<?php }?>
</div>

<!--<div class="well well-lg">asd</div>-->
<div class="container" style="padding-bottom:20px;">
	<div class="row">
		<div class="col-sm-12">
			<h1><?php echo $d['title']; ?></h1>
		</div>
	</div>
	<div clas="row">
	<?php
		if (isset($_SESSION['status'])) {
			$stats = $_SESSION['status'];
			if($stats == 1){
		?>
			<div class="alert alert-success">
				<h3>
					<strong>Berhasil!</strong> Permintaan cek ketersediaan diterima, kami akan mengirimkan email apabila rumah tersedia.
				</h3>
			</div>
		<?php
				unset($_SESSION['status']);
			}
		}
		?>
	</div>
	<div id="fb-root"></div>
	<!-- Your share button code -->
	<div class="row">
		<div class="col-sm-12">
			<div class="fb-share-button" 
			data-href="<?php echo $base_url;?>product/<?php 
echo $d['sku'];?>" 
			data-layout="button" data-mobile-iframe="true">
			<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
			</div>
		</div>
	</div>
	<div class="row row-con">
        <div class="col-md-8">
			<?php include ("block/homeslide.php");?>
		</div>
        <div class="col-md-4">
			<div class="row">
				<h1 class="price" style="margin-bottom: 0;" align="center">Rp. <?php echo number_format($d['price']+$d['price']*0.1); ?> /Malam</h1>
				<p align="center" >*Sudah termasuk Booking fee (10%)</p>

			</div>
			<form method="get" action="#">
			<div class="row form-cek">
				<div style="overflow:hidden;">
					<div class="form-group">
						<div class="row" style="padding: 5px 40px 0 40px;font-size:16px">
							<input type="hidden" id="datetimepicker1" name="dt">
						</div>
					</div>
					<script type="text/javascript">
						$(function () {
							$('#datetimepicker1').datetimepicker({
								format: 'MM-DD-YYYY',
								inline: true,
								minDate: moment().add(1, 'd').toDate(),
								maxDate: moment().add(1, 'years')
							});
						});
					</script>
				</div>
				<div class="nights f1c">
					<select class="form-control" id="sel1" name="days">
						<?php for($i = 1;$i<=14;$i++):?>
							<option value="<?php echo $i;?>"><?php echo $i;?> Hari</option>
						<?php endfor;?>
					  </select>
				</div>
				<div class="check f1c">
					<button type="button" class="btn btn-primary btn-lg cekbtn" 
data-toggle="modal" data-target="#myModal">Cek Ketersediaan</button>
				</div>
			</div>
			</form>
		</div>
    </div>
	<div class="row" style="font-size: 16px;">
				<div class="col-sm-4"><h3>Fasilitas</h3>
					<table class="table table-responsive">
					<?php 
					$qfas = $db->query ("SELECT
					house.ac,
					house.tv,
					house.toilet,
					house.kamar
					FROM
					house
					WHERE
					house.id =". $houseid);
					$fas = $qfas->fetch_array();
					?>
					<?php if ($fas['kamar'] >=1):?>
						<tr>
							<td width="60%">Jumlah Kamar</td>
							<td width="40%">: <?php echo $fas['kamar']?></td>
						<tr>
					<?php endif;?>
					<?php if ($fas['tv'] >=1):?>	
						<tr>
							<td width="60%">TV</td>
							<td width="40%">: <?php echo $fas['tv']?></td>
						<tr>
					<?php endif;?>
					<?php if ($fas['toilet'] >=1):?>	
						<tr>
							<td width="60%">Toilet</td>
							<td width="40%">: <?php echo $fas['toilet']?></td>
						<tr>
					<?php endif;?>
					<?php if ($fas['ac'] >=1):?>
						<tr>
							<td width="60%">AC</td>
							<td width="40%">: <?php echo $fas['ac']?></td>
						<tr>
					<?php endif;?>
					</table>
				</div>
				<div class="col-sm-4"><h3>Fasilitas+</h3>
					<table class="table table-responsive">
					<?php 
					$qfas2 = $db->query ("SELECT
					fasilitas.id,
					fasilitas.houseid,
					fasilitas.entity,
					fasilitas.`value`
					FROM
					fasilitas
					WHERE value = 1 and
					fasilitas.houseid =". $houseid);
					while($fas2 = $qfas2->fetch_array()):
					if($fas2['value'] = 1){
						$value = "Tersedia";
					}
					?>
						<tr>
							<td width="60%"><?php echo $fas2['entity'];?></td>
							<td width="40%">: <?php echo $value;?></td>
						<tr>
					<?php endwhile; ?>
					</table>
				</div>
				<div class="col-sm-4">
		<?php
			$qown = $db->query("SELECT * from owner where id =".$d['ownid']);
			$vown = $qown->fetch_array();
			?>
			<div class="ownerpic1" style="float:left;margin-top: 20px;">
				<img class="img" src="<?php echo $base_url.$vown['img'];?>" height="100%">
			</div>
			<div class="ownernamepro" >
				<div class="ownname" style="font-size: 25px;"><?php echo $vown['nama'];?></div>
				<div class="onwphone" style="font-size: 20px;"><?php //echo $vown['phone'];?></div>
				<div class="onwphone" style="font-size: 12px;">Bergabung Sejak <?php echo date("M - Y", strtotime($vown['joindt']));?></div>
				<!--<div class="onwphone" style="font-size: 20px;"><ul class="desksrt"><li>Batam</li></ul></div>-->
			</div>
		</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				<div class="desc" style="padding-bottom:30px">
					<?php echo preg_replace('/<script.+?<\/script>/im', "", $d['desk']);?>
				</div>
				</div>
			</div>
<div class="row">
        <div class="col-sm-12">
		<div id="map"></div>
    <script>
	function initMap() {
  var myLatLng = {lat: <?php echo $d['lat'];?>, lng: <?php echo $d['long'];?>};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng,
	disableDefaultUI: true,
	draggable: false,
	scrollwheel: false,
    navigationControl: false,
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3bb3Nhyj4VMJq2RzJo-z5X-dU-OksOco&callback=initMap"
        async defer></script>
	</div>
</div>
</div>
   </div>
<?php include ("block/popcheck.php");?>
<?php 
$gethid->close();
else:?>
	<div class="row topsugest" 
	style="
	background-position: bottom;
	background-repeat: no-repeat;
	background-size: cover;    
	height: 200px;
	background-image: url('<?php echo $base_url;?>/img/bg.jpg');">
	</div>
	<div class="container" style="padding-bottom:20px;">
		<div class="row">
			<div class="col-sm-12">
				<h1>Rumah yang anda cari Tidak dapat ditemukan</h1>
			</div>
		</div>
	</div>
<?php endif;?>
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
