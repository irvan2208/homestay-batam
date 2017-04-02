<form method="post" id="hom">
<div class="form-group">
	<div class="col-xs-7">
	  <label>Title</label>
	  <input type="text" name="jdlhom" class="form-control jdl" placeholder="Masukkan judul" value="<?php if ($edit == 1){echo $getedit['title'];}?>"> 
	  <input type="hidden" name="idhom" class="form-control" value="<?php if ($edit == 1){echo $hid;}?>">
	  <input type="hidden" name="idown" class="form-control" value="<?php if ($new == 1){echo $oid;}?>">
	</div>
	<div class="col-xs-5">
	  <label>Sku</label>
	  <input type="text" readonly class="form-control jdl1" placeholder="Sku" name="skuhom" value=""> 
	</div>
	<script>
	$( ".jdl" ).keyup(function() {
		var value = $( this ).val();

		$(".jdl1").attr('value',(value.replace(/\s+/g, '-').toLowerCase()));
	  })
	  .keyup();
	</script>
</div>
	<div class="col-xs-7">
	<div class="form-group">
	  <label>Alamat</label>
	  <textarea style="resize:none;" class="form-control" id="textarea" placeholder="Alamat" name="alamathom"><?php if ($edit == 1){echo $getedit['alamat'];}?></textarea>
	</div>
	<div class="form-group">
	  <label>Deskripsi</label>
	  <textarea style="resize:none;" class="form-control textareadeski" id="textarea" placeholder="Deskripsi" name="desk"><?php if ($edit == 1){echo $getedit['desk'];}?></textarea>
	</div>
	<div class="form-group">
	  <label>Price</label>
	  <div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
	  <input type="text" name="pricehom" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" placeholder="Price" value="<?php if ($edit == 1){echo $getedit['price'];}?>"><span class="input-group-addon">.00</span>
	  </div>
	</div>
  <!-- /.box-body -->
  </div>
  
  <div class="col-xs-5">
	<div class="form-group">
	  <label>Kamar</label>
	  <input type="number" name="jmlkmrhom" value="<?php if ($edit == 1){echo $getedit['kamar'];}?>" class="form-control" min="1" value="0">
	</div>
	<div class="form-group">
	  <label>Toilet</label>
	  <input type="number" name="toilethom" value="<?php if ($edit == 1){echo $getedit['toilet'];}?>" class="form-control" min="1" value="0">
	</div>
	<div class="form-group">
	  <label>TV</label>
	  <input name="tvhom" type="number" value="<?php if ($edit == 1){echo $getedit['tv'];}?>" class="form-control" min="1" value="0">
	</div>
	<div class="form-group">
	  <label>AC</label>
	  <input name="achom" type="number" value="<?php if ($edit == 1){echo $getedit['ac'];}?>" class="form-control" min="1" value="0">
	</div>
	<div class="form-group col-xs-6">
	  <label>Latitude</label>
	  <div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
	  <input name="lathom" id="lathome" type="text" value="<?php if ($edit == 1){echo $getedit['lat'];}?>" class="form-control">
	  </div>
	</div>
	<div class="form-group col-xs-6">
	  <label>Longitude</label>
	  <div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
	  <input name="longhom" id="longhome" type="text" value="<?php if ($edit == 1){echo $getedit['long'];}?>" class="form-control">
	  </div>
	</div>
</div>
<div class="col-xs-12">
	<div id="map_canvas" style="height: 500px;"></div>
    <div id="current">Nothing yet...</div>
    <script type="text/javascript">
    	var map = new google.maps.Map(document.getElementById('map_canvas'), {
		    zoom: 10,
		    center: new google.maps.LatLng(1.385, 103.156),
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var myMarker = new google.maps.Marker({
			<?php if ($edit == 1):?>
				<?php if ($getedit['long'] == "" or $getedit['lat']==""):?>
				position: new google.maps.LatLng(1.098, 104.071),
				<?php else:?>
				position: new google.maps.LatLng(<?php echo $getedit['lat'];?>, <?php echo $getedit['long'];?>),
				<?php endif;?>
			<?php else:?>
		    position: new google.maps.LatLng(1.098, 104.071),
		    <?php endif;?>
		    draggable: true
		});

		google.maps.event.addListener(myMarker, 'dragend', function (evt) {
		    document.getElementById('lathome').value = evt.latLng.lat().toFixed(3);
		    document.getElementById('longhome').value = evt.latLng.lng().toFixed(3);
		});

		google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
		    document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
		});

		map.setCenter(myMarker.position);
		myMarker.setMap(map);
    </script>


</div>
<button type="submit" id="smp" class="btn btn-primary">Simpan</button>


</form>

<script type="text/javascript">
	$(".textareadeski").wysihtml5();
</script>