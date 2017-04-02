<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../404.html");  
exit;
}
?>
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body"><table class="table table-bordered table-striped table-hover table-responsive" id="reqtbl">
				<thead>
					<tr>
						<th>Reqid</th>
						<th>Hid</th>
						<th>Tgl Decline</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Harga</th>
					</tr>
				</thead>
				<tbody>
				<?php
    				require("../../block/koneksi.php");
					$query = $db->query("SELECT
					hbtcek_decline.decdate,
					hbtcek_decline.decadm,
					hbtcek_decline.id,
					hbtcek.houseid,
					hbtcek.tgla,
					hbtcek.tglb,
					hbtcek.nama,
					hbtcek.phone,
					hbtcek.email,
					hbtcek.harga
					FROM
					hbtcek_decline
					INNER JOIN hbtcek ON hbtcek.id = hbtcek_decline.id");
					while($d = $query->fetch_array()){
				?>
					<tr>
						<td><a href="#" onclick="$('.content').load('<?php echo $base_url."4dmhb";?>/pages/request-single.php?reqid=<?php echo $d['id'];?>');"><?php echo $d['id'];?></a></td>
						<td><?php echo $d['houseid'];?></td>
						<td><?php echo $d['decdate'];?></td>
						<td><?php echo $d['tgla'];?></td>
						<td><?php echo $d['tglb'];?></td>
						<td><?php echo $d['nama'];?></td>
						<td><?php echo $d['email'];?></td>
						<td><?php echo $d['harga'];?></td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Reqid</th>
						<th>Hid</th>
						<th>Tgl Decline</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Harga</th>
					</tr>
				</tfoot>
			</table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

<script>
function actioncek(reqid,act){
	$.ajax({
		url: (act == 1) ? "<?php echo $base_url; ?>4dmhb/pages/prc/approvereq.php" : "<?php echo $base_url; ?>4dmhb/pages/prc/declinereq.php",
    type: "POST",
    data : {
    	'reqid': reqid
    },
    success: function(){
    	navclick('request'),
    	$("aside").load("blk/side-menu.php")
    }
}); // AJAX Get Jquery statment
}
    $('#pgheader').html("Request list");
	$('#pgdesc').html("All client Request");
	$('#now').html("Declined");

  $(function () {
    $('#reqtbl').DataTable({
    	"lengthChange": false,
		"autoWidth": false,
		"order": [[2, 'desc']],
		"columnDefs": [
		      { width: '70px', targets: 0 },
		      { width: '10px', bSortable: false, targets: 1 },
		      { width: '150px', targets: 2 },
		      { width: '50px',bSortable: false, targets: 3 },
		      { width: '50px',bSortable: false, targets: 4 },
		      { bSortable: false, targets: 5 },
		      { width: '150px',bSortable: false, targets: 6 },
		      { bSortable: false, targets: 7 }
		   ]
    });
  });
</script>
