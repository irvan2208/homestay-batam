<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
<footer>
<div class="container-fluid footer">
<div class="container">
	<div class="row footer-row">
		<div class="col-md-4">
			<div class="footer-link-title">Rumah 
Terbaru</div>
			<div class="footer-link">
				<ul class="ft-lk">
					<?php 
					$query = $db->query("SELECT 
sku,title FROM house WHERE active = 1 ORDER BY id desc LIMIT 5 ");
					while($row = $query->fetch_array()){?>
					<li><a href="<?php echo $base_url; ?>homestay/<?php echo $row['sku']; ?>"><?php echo $row['title']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div><div class="col-md-4">
			<div class="footer-link-title">Homestay-batam</div>
			<div class="footer-link">
				<ul class="ft-lk">
					<li><a href="<?php echo $base_url;?>">Home</a></li>
					<li><a href="<?php echo $base_url;?>page/tentang-kami">Tentang Kami</a></li>
					<li><a href="<?php echo $base_url;?>page/hubungi-kami">Hubungi Kami</a></li>
					<li><a href="<?php echo $base_url;?>page/cara-kerja">Cara Kerja</a></li>
					<li><a href="<?php echo $base_url;?>page/bergabung">Bergabung</a></li>
				</ul>
			</div>
		</div><div class="col-md-4">
			<div class="footer-link-title">Berita 
Terbaru</div>
			<div class="footer-link">
				<ul class="ft-lk">
					<li>Link</li>
					<li>Link</li>
					<li>Link</li>
					<li>Link</li>
					<li>Link</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div><br>
<div class="container-fluid join">
<div class="container">
	<div class="row join-row">
		<div class="join" align="center">
			Copyright &copy; Homestay-Batam
		</div>
	</div>
</div>
</div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<?php } ?>
