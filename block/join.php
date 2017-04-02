<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
<div class="container-fluid join" style="background-repeat: no-repeat;background-size: cover;background-position: center;">
<div class="container">
	<div class="row join-row">
		<div class="space"></div>
			<div class="col-sm-10 join">
				<h2>Homestay Batam, menyediakan 
penginapan murah dengan harga yang terjangkau</h2>
				<p>Kemudahan dalam mencari tempat penginapan yang sesuai dengan pilihan kita, Kami menghubungkan wisatawan dengan lokal di batam</p>
				<p>Ingin mendaftarkan rumah anda di homestay batam?, ikuti langkah-langkahnya disini</p>
				<a href="<?php echo $base_url;?>page.php?page_name=bergabung" class="border-button white" data-gtm-action="Homepage" data-gtm-label="Clicked on guide book link" >Bergabung</a>
		<div class="space"></div>
	</div>	
	</div>
</div>
</div>
<?php }?>
