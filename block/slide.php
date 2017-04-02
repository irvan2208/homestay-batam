<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
<div class="container-fluid slide1">
	<div class="row topsugest">
		<div id="carousel" class="home carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			  <?php
				$cntslh = $db->query("SELECT COUNT(*) as t1 from house");
				$cntslho = $cntslh->fetch_assoc();
				//echo $cntslho['t1'];
				for($i=0;$i<$cntslho['t1'];$i++):
			  ?>
				<li data-target="#carousel" data-slide-to="<?php echo $i;?>" class="<?php if ($getsl['id']==1) {echo "active";}?>"></li>
				<?php endfor;?>
			  </ol>

			  <div class="carousel-inner">
			  <?php
				$qshome = $db->query("SELECT
				house.id,
				house.ownid,
				house.sku,
				house.title,
				house.price,
				owner.nama,
				owner.img,
				house.desk
				FROM
				house
				INNER JOIN `owner` ON house.ownid = `owner`.id
				WHERE
				house.active = 1
				ORDER BY
				house.id DESC
				");
				while ($getsl = $qshome->fetch_array()):
				$houseidslid = $getsl['id'];
				$gsimg = $db->query("SELECT path from gmbar where houseid = ".$houseidslid." && asbg = '1' && ena = '1' limit 1");
				$gsbg = $gsimg->fetch_array();
				?>
				<div class="home item <?php if ($getsl['id']==1) {echo "active";}?>" align="center" style="background-position: center;background-repeat: no-repeat;background-size: cover;background-image: url('<?php echo $gsbg["path"];?>');">
					<div class="container">
							<div class="row">
								<div class="col-sm-4 hidden-md">
									<div class="owner-bl" align="center">
										<div class="ownerpic">
											<img class="img" src="<?php echo $getsl['img']; ?>" height="100%">
										</div>
										<div class="ownernm">
											<h2><?php echo $getsl['nama']; ?></h2>
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="house-desk">
									<div class="row">
										<div class="housetitle">
											<h2><?php echo $getsl['title']; ?></h2>
										</div>
										<div class="price-book">
											<div class="houseprice">
												<h3>Rp. <?php echo number_format($getsl['price']);?> /Malam</h1>
											</div>
											<div class="book-btn">
												
<a href="<?php echo $base_url; ?>homestay/<?php echo $getsl['sku']; ?>" class="btn btn-primary btn-lg">Cek Rumah</a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="shortdesk" align="left">
										<?php echo substr($getsl['desk'],0,200); ?>
											<!--<ul class="desksrt">
												<li>Dekat Dengan Bandara width:  20%;</li>
												<li>Dekat Dengan Bandara</li>
												<li>Dekat Dengan Bandara</li>
												<li>Dekat Dengan Bandara</li>
											</ul>-->
										</div>										
									</div>
									</div>
								</div>
							</div>			
					</div>
				</div>
				<?php endwhile;?>
			  </div>
			  
			  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
		</div>
	</div>
</div>
<?php } ?>
