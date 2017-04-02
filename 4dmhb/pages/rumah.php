<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../404.html");  
exit;
}
?>
<script type="text/javascript">
	$('#pgheader').html("Rumah list");
	$('#pgdesc').html("Semua rumah");
	$('#now').html("Rumah");	
	$(".selfir").hide();
	$(".img").hide();
	$(".fac").hide();
</script>
<?php
require("../../block/koneksi.php");
$edit = 0;
if (isset($_GET['hid'])) {
	$edit = 1;
	$hid = $_GET['hid'];
}
$new = 0;
if (isset($_GET['oid'])) {
	$new = 1;
	$oid = $_GET['oid'];
}
?>
<?php if ($edit ==1):?>
	<script type="text/javascript">
		$(".img").show();
		$(".fac").show();
	</script>
<?php endif; ?>
<div class="col-xs-12">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Add New House</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
			</div>
			  <!-- /.box-tools -->
		</div>
			<!-- /.box-header -->
		<!-- <form role="form"> -->
		<div class="box-body">
			<div class="col-xs-2">
			  <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
				<li><a class="own" href="#owner" data-toggle="tab">Owner</a></li>
				<li class="active"><a href="#info" class="info" data-toggle="tab">Information</a></li>
				<li><a href="#fac" class="fac" data-toggle="tab">Fasilitas</a></li>
				<li><a href="#images" class="img" data-toggle="tab">Image</a></li>
			  </ul>
			</div>
			<div class="col-xs-10">
				<!-- Tab panes -->
				<?php
				if ($edit == 1) {
					$queryedit = $db->query("SELECT * FROM house WHERE id = ".$hid);
					$getedit = $queryedit->fetch_array();
				}
				?>
				<div class="tab-content">
				  <div class="tab-pane active" id="info">
					<?php include("../blk/house/info.php");?>
				  </div>
				  <div class="tab-pane" id="fac">
				  	<?php include("../blk/house/fac.php");?>
				  </div>
				  <div class="tab-pane" id="images">
				  	<?php include ("../blk/house/img.php");?>
				  </div>
				  <div class="tab-pane" id="owner">
				  	<?php include ("../blk/house/own.php");?>
				  </div>
				</div>
				
			</div>
		</div>
		<div class="box-footer">
			<?php if ($edit == 1):?>
				<button type="submit" onclick="return navclick('rumah');" class="btn btn-danger btl">Batal</button>
			<?php endif;?>
		</div>
		<!-- </form> -->
			<!-- /.box-body -->
	</div>
	<div class="box">
		<div class="box-body">
			<table class="table table-bordered table-striped table-hover table-responsive" id="housetbl">
				<thead>
					<tr>
						<th>ID</th>
						<th>Gmbar</th>
						<th>Info</th>
						<th>Reg DAte</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$query = $db->query("SELECT
					house.regdate,
					`owner`.nama,
					owner.phone,
					house.title,
					house.alamat,
					house.price,
					house.id,
					gmbar.path
					FROM
					house
					INNER JOIN `owner` ON house.ownid = `owner`.id
					INNER JOIN gmbar ON gmbar.houseid = house.id
					WHERE
					gmbar.active = 1");
				while($d = $query->fetch_array()){
				?>
					<tr>
				
						<th><?php echo $d['id'];?></th>
						<th><a href="#" onClick="return edithos(<?php echo $d['id'];?>);"><img height="50px" src="<?php echo $base_url.$d['path'];?>"/></a></th>
						<th><?php echo $d['title'];?><br><?php echo "Rp. ".number_format($d['price']);?><br><?php echo $d['nama'];?> | <?php echo $d['phone'];?></th>
						<th><?php echo $d['regdate'];?></th>
				
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {
	$(".select2").select2();
	$('#fastbl').DataTable();
	$('#datepicker').datepicker();
	$('#housetbl').DataTable({
		"lengthChange": false,
		"autoWidth": false,
		"order": [[3, 'asc']],
		"columnDefs": [
			  { width: '10px', bSortable: false, targets: 0 },
			  { bSortable: false, targets: 1 },
			  { bSortable: false, targets: 2 },
			  { targets: 3 },
			]
	});
});


</script>
<?php //unset($_SESSION['ownsel']);?>
<script type="text/javascript">
function edithos(id) {
	Pace.restart();
	$('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?hid=' + id + '');
}

function getow(id) {
	Pace.restart();
	//alert(id);
	$('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?oid='+id);
}
$("document").ready(function () {
$('.smpown').click(function(){
	$('#newown').submit(function(e) {
		Pace.restart();
	    var form = $(this);
	    var formdata = false;
	    if(window.FormData){
	        formdata = new FormData(form[0]);
	    }

	    var formAction = form.attr('action');

	    $.ajax({
	        type        : 'POST',
	        url         : "<?php echo $base_url."4dmhb"; ?>/pages/prc/new.php?new=own",
	        cache       : false,
	        data        : formdata ? formdata : form.serialize(),
	        contentType : false,
	        processData : false,
			success: function (data) {
				//alert(data);
				$('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?oid='+data);
			}
	    });
	    e.preventDefault();
	});
	});
});


$("document").ready(function () {
$('#smp').click(function(){
	Pace.restart();
	if($('#selownsel').val()==""){
		$('.own').click();
		$(".selfir").show().delay(2500).fadeOut();
		$("#getselown").addClass(" has-error");
		setTimeout(function() {
	       $("#getselown").removeClass(" has-error");
	   }, 2500);
		event.preventDefault();
	}else{
		var data = $("#hom").serialize();
		$('#hom').submit(function() {
			$.ajax({
				url: "<?php echo $base_url."4dmhb"; ?>/pages/prc/new.php?new=hom",
				type: "POST",
				data : data,
				success: function (data) {
					$('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?hid='+data);
				}
			}); // AJAX Get Jquery statment
			return false;
		});
	}
});
return false;
});

$("document").ready(function () {
$('#smpf').click(function(){
		if ($('input[name="idhom"]').val()=="") {
			alert("Silahkan membuat rumah baru terlebih dahulu");
			$('.info').click();
			event.preventDefault();
		}
		if($('#selownsel').val()==""){
			$('.own').click();
			$(".selfir").show().delay(2500).fadeOut();
			$("#getselown").addClass(" has-error");
			setTimeout(function() {
		       $("#getselown").removeClass(" has-error");
		   }, 2500);
			event.preventDefault();
		}else{
			Pace.restart();
			var data = $("#facadd").serialize();
			$('#facadd').submit(function() {
					//alert(data);
				$.ajax({
					url: "<?php echo $base_url."4dmhb"; ?>/pages/prc/new.php?new=fac",
					type: "POST",
					data : data,
					success: function (data) {
						//alert(data);
						$('#fac').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?hid='+data+' #fac');
					}
				}); // AJAX Get Jquery statment
				return false;
			});
		}
});
return false;
});

function setimg(as,imid,hid){
	$.ajax({
		url: "<?php echo $base_url; ?>4dmhb/pages/prc/updhimg.php",
	type: "POST",
	data : {
		'as': as,
		'imid': imid,
		'hid': hid
	}
	});
}

function factog(facid,hidf){
	$.ajax({
		url: "<?php echo $base_url; ?>4dmhb/pages/prc/updfac.php",
	type: "POST",
	data : {
		'facid': facid,
		'hidf': hidf
	},
	success: function(data){
		//alert(data);
		$('#fac').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?hid='+hidf+' #fac');
		//navclick('bookedreq');
	}
	}); // AJAX Get Jquery statment
}

$('#formimg').submit(function(e) {
	Pace.restart();
    var form = $(this);
    var formdata = false;
    if(window.FormData){
        formdata = new FormData(form[0]);
    }

    var formAction = form.attr('action');

    $.ajax({
        type        : 'POST',
        url         : "<?php echo $base_url."4dmhb"; ?>/pages/prc/new.php?new=imgh",
        cache       : false,
        data        : formdata ? formdata : form.serialize(),
        contentType : false,
        processData : false,

        success: function(response) {
        	//alert(response);
            if(response != 'error') {
                //$('#messages').addClass('alert alert-success').text(response);
                // OP requested to close the modal
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function () {
                	$('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php?hid=' + response);
				    // $('#fastbl').load('<?php //echo $base_url."4dmhb";?>/pages/rumah.php?hid='+response+' #fastbl');
				})
            } else {
                $('#messages').addClass('alert alert-danger').text(response);
            }
        }
    });
    e.preventDefault();
});

$('.btl').click(function(){
	$('.box-profile').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php');
});
</script>

<?php if($edit == 0):?>
	<script>$('.own').click();</script>
<?php endif;?>
