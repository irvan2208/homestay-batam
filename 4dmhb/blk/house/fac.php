<div class="row">
  <form method="post" id="facadd">
  	<div class="col-sm-4">
  	<input type="hidden" name="idhom" class="form-control" value="<?php if ($edit == 1){echo $hid;}?>">
  	<input type="text" placeholder="nama fasilitas" class="form-control" name="namfac"></div>
  	<div class="col-sm-4" >
  		<select name="facstats" class="form-control" >
  			<option value="1" selected>Enable</option>
  			<option value="0">Disable</option>
  		</select>
  	</div>
  	<div class="col-sm-4"><button type="submit" id="smpf" type="button" class="btn btn-block btn-primary">Simpan</button></div>
  </form>
	</div>
	<div class="row">
<table class="table table-bordered table-striped table-hover table-responsive" id="fastbl">
<thead>
	<tr>
		<td>ID</td>
		<td>Nama</td>
		<td>val</td>
		<td>action</td>
	</tr>
</thead>
<tbody>
  	<?php 
  	if ($edit == 1){
		$qfas = $db->query ("SELECT * FROM
		fasilitas
		WHERE
		houseid =". $hid);
		while($fas = $qfas->fetch_array()){
		if($fas['value'] == 1){
			$val = "Tersedia";
		}else{
			$val = "Tidak Tersedia";
		}
	?>
	<tr>
		<td><?php echo $fas['id'];?></td>
		<td><?php echo $fas['entity'];?></td>
		<td><?php echo $val;?></td>
		<td>
		<?php if($fas['value'] == 1):?>
			<button type="button" onclick="Pace.restart();factog(<?php echo $fas['id'];?>,<?php echo $hid;?>);" class="btn btn-xs btn-danger"><i class="fa fa-check-circle-o"></i> Disable </button>
		<?php else:?>
			<button type="button" onclick="Pace.restart();factog(<?php echo $fas['id'];?>,<?php echo $hid;?>);" class="btn btn-xs btn-success"><i class="fa fa-times-circle-o"></i> Enable </button>
		<?php endif;?>
		</td>
	</tr>
	<?php }
	} ?>
</tbody>
</table>
</div>