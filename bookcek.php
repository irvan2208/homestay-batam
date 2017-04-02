<?php session_start();?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php define('MyConst', TRUE);
include ("block/head.php");?>
<?php include ("block/header.php");?>
<?php
//session_start();
$getapprid = base64_decode( urldecode($_GET['apprid']) );
$appid = "Not Found";
$fail = 0;
if($ckhbt = $db->prepare("SELECT id FROM hbtcek WHERE id=?")){
    $ckhbt->bind_param("s", $getapprid);
    if($ckhbt->execute()){
        $ckhbt->store_result();
        $ckhbt->fetch();
        if ($ckhbt->num_rows == 1){
        	$cekdec = $db->prepare("SELECT id FROM hbtcek_decline WHERE id=?");
			    $cekdec->bind_param("s", $getapprid);
			    $cekdec->execute();
			        $cekdec->store_result();
			        $cekdec->fetch();
			        if ($cekdec->num_rows == 1){
			        	$fail = 1;
			        }else{$fail=5;}
			$stmt = $db->prepare("SELECT id FROM hbtcek_approve WHERE id=?");
			    $stmt->bind_param("s", $getapprid);
			    	$stmt->execute();
			        $stmt->store_result();
			        $stmt->fetch();
			        if ($stmt->num_rows == 1){
			        	if($cekbooked = $db->prepare("SELECT appid FROM hbtcek_booked WHERE appid=?")){
					   		$cekbooked->bind_param("s", $getapprid);
					    	if($cekbooked->execute()){
						        $cekbooked->store_result();
						        $cekbooked->fetch();

					    		$getappid = $db->prepare("SELECT hbtcek.nama, hbtcek.email, hbtcek.phone, hbtcek.pesan, hbtcek.harga, hbtcek.tgla, hbtcek.tglb, hbtcek.cekdt, house.title, hbtcek.id as appid, house.id, gmbar.path FROM hbtcek INNER JOIN house ON house.id = hbtcek.houseid INNER JOIN gmbar ON gmbar.houseid = house.id WHERE gmbar.active = '1' && gmbar.ena = '1' && hbtcek.id = ?");
							    $getappid->bind_param("s", $getapprid);

							    /* execute query */
								$getappid->execute();

							    /* bind result variables */
							    $getappid->bind_result($custname,$email,$phone,$pesan,$harga,$tgla,$tglb,$cekdt,$title,$appid,$houseid,$path);

							    /* fetch value */
							    $getappid->fetch();
							    /* close statement */
							    $getappid->close();
								
							    $durasi = countdays($tgla, $tglb);
							    $hxd = $harga*$durasi;
							    $rand = rand(01, 99);
								$fee = $hxd*0.1+$rand;
								$fail =0;
								if ($cekbooked->num_rows == 0){
								    if (new DateTime() < new DateTime($tgla)){
										$token = md5(uniqid(rand(), TRUE));
										$_SESSION['bcmtoken'] = $token;
										$_SESSION['reqid'] = $_GET['apprid'];
										$_SESSION['tranid'] = $rand;
										$_SESSION['fee'] = $fee;
										$_SESSION['sisa'] = $hxd;
										//$_SESSION['token_time'] = time();
									} else {
										$fail = 2;
									}

								}else if ($cekbooked->num_rows == 1){
									$getbooked = $db->prepare("SELECT
										hbtcek_booked.bookdt,
										hbtcek_booked.tranid,
										hbtcek_booked.bayar
										FROM
										hbtcek_booked
										WHERE
										hbtcek_booked.appid =?");
									    $getbooked->bind_param("s", $appid);

									    /* execute query */
										$getbooked->execute();

									    /* bind result variables */
									    $getbooked->bind_result($bookdt,$tranid,$byr);

									    /* fetch value */
									    $getbooked->fetch();
									    /* close statement */
									    $getbooked->close();
					        		$fail = 3;
					        		$rand = $tranid;
					        		$fee = $hxd*0.1+$rand;
					        		if (new DateTime() > new DateTime($tglb)){
										$fail = 4;
									} 
								}
							}
				        }else{
				        	$fail = 1;
				        }
			    	}
		}else{
			$fail = 4;
		}
	}
}

//echo $fail;
?>

	<meta property="og:url" content="<?php echo $base_url.$housesku;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php //echo $websitename." ". $d['title']; ?>" />
	<meta property="og:description" content="<?php echo $d['desk']; ?>" />
	<meta property="og:image" content="http://www.your-domain.com/path/image.jpg" />
<title>
<?php echo $websitename." #". $appid; ?>
</title>
<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container-fluid">
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
<?php 
$notappr ='
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-warning">
			  <div class="panel-heading">
			    <h2>Tidak tersedia</h2>
				<p>Maaf rumah yang anda request tidak tersedia, silahkan cek tanggal lain, atau cek rumah lain.</p>
			  </div>
			</div>
		</div>
	</div>
</div>';

$notappryet ='
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-warning">
			  <div class="panel-heading">
			    <h2>Sedang di cek</h2>
				<p>Rumah yang anda request sedang kami Cek ketersediaannya, silahkan menunggu maksimal 24 jam dari tanggal Request.</p>
			  </div>
			</div>
		</div>
	</div>
</div>';

$dtpassed ='
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h2>Tidak Ditemukan</h2>
				<p>Tanggal Pemesanan anda telah melewati batas, silahkan melakukan cek ketersediaan lagi.</p>
			  </div>
			</div>
		</div>
	</div>
</div>';

$booked ='
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-success">
			  <div class="panel-heading">
			    <h2>Sudah anda pesan</h2>
				<p>Anda Telah melakukan pemesanan, Silahkan Cek Kembali email anda.</p>
			  </div>
			</div>
		</div>
	</div>
</div>';

$notfound ='
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h2>Tidak Ditemukan</h2>
				<p>Cek Ketersediaan anda tidak ditemukan, silahkan hubungi kami jika anda telah melakukan cek.</p>
			  </div>
			</div>
		</div>
	</div>
</div>';

?>


<?php
if ($fail == 1) {
	echo $notappr;
} else if($fail == 2){
	echo $dtpassed;
}else if($fail == 5){
	echo $notappryet;
} else if($fail == 4){
	echo $notfound;
}else if($fail == 0 OR $fail == 3){ ?>
<div class="container" style="padding-bottom:20px;">
	<div class="row row-con">
		<div class="col-sm-12">
			<div class="panel panel-success">
			  <div class="panel-heading">
			    <h2>Rincian Pemesanan <?php echo "#".$appid; ?></h2>
			    <?php
				  if ($fail == 0){
				  ?>
				<p>Rumah yang anda cek tersedia!, anda 
dapat memesan homestay ini dengan mengklik Pesan dibawah. Silahkan 
Pesan, dan lakukan pembayaran sebelum <?php echo chgtime($tgla);?>. 
Data-data seperti rekening tujuan transfer akan dikirimkan melalui 
email setelah anda meng klik pesan dibawah.</p>
				<?php 
					}else if($fail == 3){
				?>
					<p>Anda Telah melakukan Pemesanan, Silahkan Cek Kembali email anda, dan lakukan pembayaran sebelum <?php echo chgtime($tgla);?> </p>
				<?php
					}
				?>
			  </div>
			  <div class="panel-body">
			  <div class="col-md-4">
			    <table class="table table-responsive borderless">
					<tbody>
					<?php
						if($fail == 3){
					?>
						<tr>
							<th>Dipesan Tangal</th>
							<td><?php echo chgtime($bookdt);?></td>
						</tr>
					<?php } ?>

						<tr>
							<th>Nama Lengkap</th>
							<td><?php echo $custname;?></td>
						</tr>
						<tr>
							<th>E-mail</th>
							<td><?php echo $email;?></td>
						</tr>
						<tr>
							<th>No Telp</th>
							<td><?php echo $phone;?></td>
						</tr>
						<tr>
							<th>Durasi</th>
							<td><?php echo $durasi;?> Malam</td>
						</tr>
						<tr>
							<th>Check-in</th>
							<td><?php echo chgtime($tgla);?></td>
						</tr>
						<tr>
							<th>Check-out</th>
							<td><?php echo chgtime($tglb);?></td>
						</tr>
						<tr>
							<th>Pesan</th>
							<td><?php echo $pesan;?></td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-5">
							<div class="imgbook" style="padding:15px;" align="center">
								<img src="<?php echo $base_url.$path;?>" width="100%" height="200px"/>
							</div>
						</div>
						<div class="col-md-7"><h3><?php echo $title;?></h3><h4>X <?php echo $durasi;?> Malam</h4>

							<table class="table table-responsive borderless">
								<tbody>
									<tr style="border-bottom: solid #000 2px;">
										<th>Total Harga</th>
										
<td width="40%"><?php echo "Rp. ".number_format($hxd+$fee);?></td>
									</tr>
									<tr>
										<th>Silahkan bayar Homestay-batam</th>
										<td><?php echo "Rp. ".number_format($fee);?></td>
									</tr>
									<tr>
										<th>Bayar langsung ke owner</th>
										<td><?php echo "Rp. ".number_format($hxd);?></td>
									</tr>
								</tbody>
							</table>
						</div>
				  </div>
			  </div>
			  </div>
			  <?php
			  if ($fail == 0){
			  ?>
			  <div class="panel-footer">
			  	<form action="<?php echo $base_url;?>schb/bookcfm.php" method="post">
				  	<input type="hidden" name="tkn" value="<?php echo $token;?>"/>
			  		<button class="btn btn-success btn-lg" style="font-size: 25px;width: 100%;" type="submit">Pesan</button>
			  	</form>
			  </div>
			  	<?php }else if ($fail == 3){?>
			  		<div class="panel-footer" align="center">
			  		<?php if ($byr == 1):?>
			  			<div class="alert alert-success">
					  		Status : Sudah dipesan (Berhasil)
						</div>
					<?php else:?>
					<div class="alert alert-warning">
					  		Status : Sudah dipesan (Menunggu Pembayaran)
						</div>
					<?php endif;?>
					</div>
					  <?php } ?>
			  </div>
			</div>
		</div>
    </div>
</div>
<?php }else{echo $notfound;} ?>
<?php include ("block/join.php");?>
</body>
<?php include ("block/footer.php");?>
</html>
