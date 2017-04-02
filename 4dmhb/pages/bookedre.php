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
						<th>Book Id</th>
						<th>Hid</th>
						<th>Tgl Book</th>
						<th>Appr id</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Fee</th>
						<th>Tran id</th>
						<th>Harga</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
    				require("../../block/koneksi.php");
					$query = $db->query("SELECT
						hbtcek_booked.id,
						hbtcek_booked.bookdt,
						hbtcek_booked.fee,
						hbtcek.houseid,
						hbtcek_booked.rent,
						hbtcek_booked.tranid,
						hbtcek_booked.appid,
						hbtcek_booked.bayar,
						hbtcek.tgla,
						hbtcek.tglb,
						hbtcek_approve.appdate
						FROM
						hbtcek_booked
						INNER JOIN hbtcek_approve ON hbtcek_booked.appid = hbtcek_approve.id
						INNER JOIN hbtcek ON hbtcek_approve.id = hbtcek.id where hbtcek.tglb >= CURDATE()");
					while($d = $query->fetch_array()){
				?>
					<tr>
						<td><a href="#" onclick="$('.content').load('<?php echo $base_url."4dmhb";?>/pages/bookedreq-single.php?reqid=<?php echo $d['id'];?>');"><?php echo $d['id'];?></a></td>
						<td><?php echo $d['houseid'];?></td>
						<td><?php echo $d['bookdt'];?></td>
						<td><?php echo $d['appid'];?></td>
						<td><?php echo $d['tgla'];?></td>
						<td><?php echo $d['tglb'];?></td>
						<td><?php echo "Rp. ".number_format($d['fee']);?></td>
						<td><?php echo "Rp. ".number_format($d['tranid']);?></td>
						<td><?php echo "Rp. ".number_format($d['rent']);?></td>
						<td><?php echo "Rp. ".number_format($d['rent']+$d['fee']);?></td>
						<td><?php if($d['bayar'] == 0):?><button type="button" onclick="Pace.restart();cfmbook(<?php echo $d['id'];?>);" class="btn btn-xs btn-success"><i class="fa fa-calendar-check-o"></i> Confirm
			          	</button><?php else:?>Confirmed<?php endif;?></td>

			          	<script>
			          		function cfmbook(bookid){
								$.ajax({
									url: "<?php echo $base_url; ?>4dmhb/pages/prc/updbokbyr.php",
							    type: "POST",
							    data : {
							    	'bookid': bookid
							    },
							    success: function(){
							    	navclick('bookedreq'),
							    	$("aside").load("blk/side-menu.php")
							    	$("header").load("blk/nav.php")
							    }
							}); // AJAX Get Jquery statment
							}
			          	</script>

					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Book Id</th>
						<th>Hid</th>
						<th>Tgl Book</th>
						<th>Tran id</th>
						<th>TGLA</th>
						<th>TGLB</th>
						<th>Fee</th>
						<th>Tran id</th>
						<th>Harga</th>
						<th>Total</th>
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
    	$("aside").load("blk/side-menu.php")
    }
}); // AJAX Get Jquery statment
}
    $('#pgheader').html("Booked list");
	$('#pgdesc').html("All client Booked Request");
	$('#now').html("Booked");

  $(function () {
    $('#reqtbl').DataTable({
    	"lengthChange": false,
		"autoWidth": false,
		"order": [[2, 'desc']],
		"columnDefs": [
		      { width: '50px', targets: 0 },
		      { width: '10px', bSortable: false, targets: 1 },
		      { width: '120px', targets: 2 },
		      { width: '50px',bSortable: false, targets: 3 },
		      { width: '50px',bSortable: false, targets: 4 },
		      { bSortable: false, targets: 5 },
		      { width: '150px',bSortable: false, targets: 6 },
		      { bSortable: false, targets: 7 },
		      { width: '100px', bSortable: false, targets: 8 }
		   ]
    });
  });
</script>