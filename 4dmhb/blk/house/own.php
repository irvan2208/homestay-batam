<div class="row">
	<div class="col-xs-2">
	<label>Select Owner</label>
</div>
	<div class="col-xs-10">
		<div id="getselown" class="form-group">
		<label class="control-label selfir" for="inputError"><i class="fa fa-times-circle-o"></i> Owner Belum dipilih</label>
		<select id="selownsel" required onchange="getow(value);" class="form-control select2" style="width: 100%;">
		  <option <?php if ($new == 0) {echo "selected";}?> value="">Pilih</option>
		<?php
			$getown = $db->query("SELECT * FROM owner");
			while($getdown = $getown->fetch_array()){
		?>
			<option <?php if (($new == 1 AND $getdown['id'] == $oid) OR ($edit == 1 AND $getdown['id'] == $getedit['ownid'])) {echo "selected";}?> value="<?php echo $getdown['id'];?>">

			<?php echo $getdown['nama'];?> <?php echo $getdown['phone'];?>
			</option>
	  	<?php }?>
		</select>
		<span class="help-block selfir">Pilih Owner Terlebih Dahulu</span>
	</div>
	</div>
</div>
<form class="form-horizontal ownerbaru" id="newown" method="post" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-xs-4">
		<div class="box box-primary">
		<div class="box-body box-profile">
		<?php
		if ($new == 1){
			if($getown1 = $db->query("SELECT * FROM owner WHERE id=".$oid)){
	   			$getdown1 = $getown1->fetch_array();
			}else{
				$new = 0;
			}
	   	} else if ($edit == 1) {
			$getowned = $db->query("SELECT * FROM owner WHERE id=".$getedit['ownid']);
	   		$getowned = $getowned->fetch_array();
		} 
		?>
		<div class="row">
			<div class="col-xs-4">
			<?php if ($new == 1):?>
				<img class="profile-user-img 
img-responsive img-circle" src="<?php echo $base_url;?><?php 
if(isset($getdown1['img'])){echo $getdown1['img'];} else{echo 
'catalog/imgo/owndef.png';}?>" alt="User profile picture">
			<?php elseif ($edit == 1):?>
				<img class="profile-user-img img-responsive img-circle" src="<?php echo $base_url;?><?php echo $getowned['img'];?>" alt="User profile picture">
			<?php else:?>
				<input type="file" id="ownimg" name="ownimg" class="form-control">
			<?php endif;?>
				<br>
			</div>
			<div class="col-xs-8">
			<?php if ($new == 1):?>
				<h3 class="profile-username text-left"><?php echo $getdown1['nama'];?></h3>
			<?php else:?>
			<input type="hidden" name="ownide" 
			value="<?php if ($edit == 1){echo $getowned['id'];}?>" 
			class="form-control" placeholder="Nama Owner ">
			<input type="text" name="namaown" value="<?php if ($edit == 1){echo $getowned['nama'];}?>" class="form-control" placeholder="Nama Owner ">
			<?php endif;?>

			<?php if ($new == 1):?>
				<p class="text-muted text-left"><?php echo $getdown1['phone'];?></p>
			<?php else:?>
				<input type="text" name="phoneown" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  class="form-control" value="<?php if ($edit == 1){echo $getowned['phone'];}?>" placeholder="Phone">
			<?php endif;?>

			<?php if ($new == 1):?>
				<p class="text-muted text-left">
				<?php $owttl = $getdown1['ttl'];echo chgtime($owttl);?></p>
			<?php elseif ($edit == 1):?>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="ttlown" value="<?php if ($edit == 1){echo chgtime($getowned['ttl']);}?>" class="form-control pull-right" id="datepicker" <?php if ($edit == 1){echo "readonly";}?>>
				</div>
				<?php else:?>
					<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="ttlown" class="form-control pull-right" id="datepicker">
				</div>
			<?php endif;?>
			</div>
		</div>
		  
		  <ul class="list-group list-group-unbordered">
			<li class="list-group-item">
			  <b>Jenis Kelamin</b> <a class="pull-right">
			  	<?php if ($new == 1):?>
					<?php 
						if ($getdown1['jk']==1) {
							$jk = "Pria";
						}else{
							$jk = "Wanita";
						}
						echo $jk;
					?>
				<?php elseif ($edit == 1):?>
					<?php 
						if ($getowned['jk']==1) {
							$jk = "Pria";
						}else{
							$jk = "Wanita";
						}
						echo $jk;
					?>
				<?php else:?>
					<select class="form-control" name="jkown">
						<option value="1">Pria</option>
						<option value="0">Wanita</option>
					</select>
				<?php endif;?>
			  </a>
			</li>
			<li class="list-group-item">
			  <b>Join Date</b> <a class="pull-right">
			  	<?php if ($new == 1):?>
					<?php 
						echo chgtime($getdown1['joindt']);
					?>
				<?php else:?>
					<?php echo chgtime(date("Y-m-d"));;?>
				<?php endif;?>
			  </a>
			</li>
			<li class="list-group-item">
			  <b>Alamat</b> <a class="pull-right">
			  	<?php if ($new == 1):?>
					<?php 
						echo $getdown1['alamat'];
					?>
				<?php else:?>
					<input type="text" name="alamatown" class="form-control " placeholder="alamat" value="<?php if ($edit == 1){echo $getowned['alamat'];}?>">
				<?php endif;?>
			  </a>
			</li>
		  </ul>
		  <?php if (($new == 0 and $edit ==0)or $edit == 1):?>
		  	<button type="submit" class="btn btn-primary btn-block smpown"><b>Simpan</b></button>
		  <?php endif;?>
		</div>
		<!-- /.box-body -->
	  </div>
	</div>
</div>
</form>
