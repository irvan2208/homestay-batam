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
						<th>Cekdate</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Pesan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
    				require("../../block/koneksi.php");
					$query = $db->query("SELECT * FROM hbtcek WHERE (hbtcek.id NOT IN (select id from hbtcek_approve) and hbtcek.id NOT IN (select id from hbtcek_decline)) ORDER BY cekdt desc");
					while($d = $query->fetch_array()){
				?>
					<tr>
						<td>
							<a href="#" onclick="$('.content').load('<?php echo $base_url."4dmhb";?>/pages/request-single.php?reqid=<?php echo $d['id'];?>&status=0');"><?php echo $d['id'];?></a>
						</td>
						<td><?php echo $d['houseid'];?></td>
						<td><?php echo $d['cekdt'];?></td>
						<td><?php echo $d['tgla'];?></td>
						<td><?php echo $d['tglb'];?></td>
						<td><?php echo $d['nama'];?></td>
						<td><?php echo $d['email'];?></td>
						<td><?php echo $d['pesan'];?></td>
						<td>
						<div class="btn-group">
						<button type="button" onclick="Pace.restart();actioncek(<?php echo $d['id'];?>,1);" class="btn btn-xs btn-success"><i class="fa fa-calendar-check-o"></i> Approve
			          	</button>
			          	<button type="button" onclick="Pace.restart();actioncek(<?php echo $d['id'];?>,0);" class="btn btn-xs btn-danger"><i class="fa fa-calendar-times-o"></i> Decline
			          </button></div></td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Reqid</th>
						<th>Hid</th>
						<th>Cekdate</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Pesan</th>
						<th>Action</th>
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
    	$("aside").load("blk/side-menu.php"),
    	$("header").load("blk/nav.php")
    }
}); // AJAX Get Jquery statment
}
    $('#pgheader').html("Request list");
	$('#pgdesc').html("All client Request");
	$('#now').html("Request");

  $(function () {
    $('#reqtbl').DataTable({
    	"lengthChange": false,
		"autoWidth": false,
		"order": [[0, 'asc']],
		"columnDefs": [
		      { width: '70px',targets: 0 },
		      { width: '10px', bSortable: false, targets: 1 },
		      { width: '150px', targets: 2 },
		      { width: '50px',bSortable: false, targets: 3 },
		      { width: '50px',bSortable: false, targets: 4 },
		      { bSortable: false, targets: 5 },
		      { width: '150px',bSortable: false, targets: 6 },
		      { bSortable: false, targets: 7 },
		      { width: '120px', bSortable: false, targets: 8 }
		   ]
    });
  });
</script>
