<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
	<div class='carousel-outer'>
		<!-- Wrapper for slides -->
		<div class='carousel-inner'>
			<?php
				$getslideimg = $db->query("SELECT * FROM gmbar WHERE houseid = ".$houseid." && ena = '1' limit 4");
				while($getimsl = $getslideimg->fetch_array()){
					$active = "";
					if($getimsl['active']==1)
						$active = "active";
			?>
				<div class='item <?php echo $active;?>'>
					<img src='<?php echo $base_url.$getimsl['path'];?>' alt='' />
				</div>	
			<?php } ?>		
		</div>
			
		<!-- Controls -->
		<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
			<span class='glyphicon glyphicon-chevron-left'></span>
		</a>
		<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
			<span class='glyphicon glyphicon-chevron-right'></span>
		</a>
	</div>
	
	<!-- Indicators -->
	<ol class='carousel-indicators mCustomScrollbar'>
			<?php
				$getslideimg = $db->query("SELECT * FROM gmbar WHERE houseid = ".$houseid." && ena = '1' limit 4");
				$cntslideimg = $db->query("SELECT COUNT(*) as tot FROM gmbar WHERE ena = '1' && houseid = ".$houseid);
				$cntsl = $cntslideimg->fetch_assoc();
				$cntot = $cntsl['tot'];
				$i = 0;
				while(($i<=$cntot)&&($getimsl = $getslideimg->fetch_array())){
					$active = "";
					if($getimsl['active']==1)
						$active = "active";
			?>
				<li data-target='#carousel-custom' data-slide-to='<?php echo $i;?>' class='<?php echo $active;?>'><img src='<?php echo $base_url.$getimsl['path'];?>' alt='' /></li>
			<?php $i++;} ?>
	</ol>
</div>
<?php } ?>