<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
		<div class="item col-md-4">
            <div class="thumbnail">
			<a href="<?php echo $base_url; ?>homestay/<?php 
echo $d['sku']; ?>">
                <img class="group list-group-image" src="<?php echo $d['img1']; ?>" alt="" width="320px" height="250px"/>
			</a>
                <div class="caption">
				<a href="<?php echo $base_url; 
?>homestay/<?php echo $d['sku']; ?>">
                    <h3 class="group inner list-group-item-heading" align="center"><?php echo $d['title']; ?></h3>
				</a>
					<p class="lead pricetag" align="center">Rp. <?php echo number_format($d['price']+$d['price']*0.1); ?> /Malam</p>
					<div class="opt-own">
						<div class="desksrt">
							<?php echo substr($d['desk'],0,100); ?>...
						</div>
						<!--<ul class="desksrt">
							<li>Dekat Dengan Bandara</li>
							<li>Dekat Dengan Bandara</li>
							<li>Dekat Dengan Bandara</li>
							<li>Dekat Dengan Bandara</li>
						</ul>-->
						<div class="ownerpic1">
							<img class="img" src="<?php echo $d['ownimg']; ?>" height="100%">
						</div>
						<div class="ownername1">
							<h4><?php echo $d['owname']; ?></h4>
							<h5>Bergabung Sejak <?php echo date("M - Y", strtotime($d['joindt']));?></h5>
						</div>
					</div>
					<div class="check">
						<!--<button type="button"data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-lg cekbtn">Check Availability</button>-->
						<a style="width:100%;" 
href="<?php echo $base_url; ?>homestay/<?php echo $d['sku']; ?>" class="btn btn-primary btn-lg">Cek Rumah</a>
						<?php 
						//$houseid = $d['hid'];
						//include ("block/popcheck.php");?>
					</div>
                </div>
            </div>
        </div>
        <?php }?>
