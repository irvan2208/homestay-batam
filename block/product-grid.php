<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
	<?php
		$query = $db->query("SELECT
		gmbar.path AS img1,
		house.sku,
		house.title,
		house.desk,
		house.price,
		`owner`.joindt,
		`owner`.img AS ownimg,
		`owner`.nama AS owname,
		house.id as hid,
		house.ownid,
		`owner`.id,
		gmbar.houseid,
		gmbar.imgid,
		gmbar.active
		FROM
		gmbar
		INNER JOIN house ON gmbar.houseid = house.id
		INNER JOIN `owner` ON house.ownid = `owner`.id
		where house.active = '1' && gmbar.houseid = house.id && gmbar.active = '1' && gmbar.ena = '1'
		order by house.id desc limit 6");
		while($d = $query->fetch_array()){ //echo $d['hid'];?>

		<div class="item">
			<?php include ("product-block.php");?>
		</div>
	<?php } ?>
<?php }?>