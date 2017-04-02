<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../404.html");  
exit;
}
?>
<?php
  $reqid = $_GET['reqid'];
  $status = $_GET['status'];

  require("../../block/koneksi.php");
?>
<?php

$getappid = $db->prepare("SELECT hbtcek.nama, hbtcek.email, hbtcek.phone, hbtcek.pesan, hbtcek.harga, hbtcek.tgla, hbtcek.tglb, hbtcek.cekdt, house.title, hbtcek.id as appid, house.id, gmbar.path FROM hbtcek INNER JOIN house ON house.id = hbtcek.houseid INNER JOIN gmbar ON gmbar.houseid = house.id WHERE gmbar.active = '1' && gmbar.ena = '1' && hbtcek.id = ?");
  $getappid->bind_param("s",$reqid);

  /* execute query */
$getappid->execute();

  /* bind result variables */
  $getappid->bind_result($custname,$email,$phone,$pesan,$harga,$tgla,$tglb,$cekdt,$title,$appid,$houseid,$path);

  /* fetch value */
  $getappid->fetch();
  $getappid->close();

  $booked = 0;
  $durasi = countdays($tgla, $tglb);
  $hxd = $harga*$durasi;
  $fee = $hxd*0.1;

        if ($status == 1){
          $getbooked = $db->prepare("SELECT
              hbtcek_booked.bookdt,
              hbtcek_booked.tranid
              FROM
              hbtcek_booked
              WHERE
              hbtcek_booked.appid =?");
                $getbooked->bind_param("s", $appid);

                /* execute query */
              $getbooked->execute();

                /* bind result variables */
                $getbooked->bind_result($bookdt,$tranid);

                /* fetch value */
                $getbooked->fetch();
                /* close statement */
                $getbooked->close();
          $fee = $hxd*0.1+$tranid;
        }
?>
<script type="text/javascript">
<?php
  if ($status == 1) {
?>
    $('#pgheader').html("Approved Request");
<?php
  }else{
?>
    $('#pgheader').html("Request");
<?php } ?>
  $('#pgdesc').html("<?php echo $reqid;?>");
</script>
<div class="row">

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $websitename;?>
            <?php if ($status == 1) { ?>
            <small class="pull-right">Book DATE: <?php echo chgtime($bookdt);?></small>
            <?php }else{
              ?>
              <small class="pull-right">Cek DATE: <?php echo chgtime($cekdt);?></small>
              <?php } ?>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <div class="col-sm-4">
        <table class="table table-bordered table-responsive">
        <?php if ($status == 1) { ?>
            <thead>
              <tr>
                <th colspan="2">
                  Book Info
                </th>
              </tr>
            </thead>
            <?php }else{
              ?>
              <thead>
               <tr>
                <th colspan="2">
                  Request Info
                </th>
              </tr>
            </thead>
              <?php
              } ?>
            <tbody>
              <tr>
                <th>
                  Nama
                </th>
                <td>
                  <?php echo $custname;?>
                </td>
              </tr>
              <tr>
                <th>
                  Email
                </th>
                <td>
                  <?php echo $email;?>
                </td>
              </tr>
              <tr>
                <th>
                  No Telp
                </th>
                <td>
                  <?php echo $phone;?>
                </td>
              </tr>
              <tr>
                <th>
                  Durasi
                </th>
                <td>
                  <?php echo $durasi." Malam ";?>
                </td>
              </tr>
              <tr>
                <th>
                  Tgla
                </th>
                <td>
                  <?php echo chgtime($tgla);?>
                </td>
              </tr>
              <tr>
                <th>
                  Tglb
                </th>
                <td>
                  <?php echo chgtime($tglb);?>
                </td>
              </tr>
              <tr>
                <th>
                  Pesan
                </th>
                <td>
                  <?php echo $pesan;?>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
          <div class="col-sm-4">
            <table class="table table-bordered table-responsive">
            <tr>
                <th colspan="2">
                  Book Invoice
                </th>
              </tr>
              <tr>
                <th>
                  Fee
                </th>
                <td>
                  <?php echo "Rp. ".number_format($fee);?>
                </td>
              </tr>
              <tr>
                <th>
                  Sisa
                </th>
                <td>
                  <?php echo "Rp. ".number_format($hxd);?>
                </td>
              </tr>
              <tr>
                <th>
                  Total
                </th>
                <td>
                  <?php echo "Rp. ".number_format($hxd+$fee)?>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
      </div>
      <!-- /.row -->

      <?php
        if ($status == 1) {

        }else{
      ?>
      <div class="row">
        <div class="col-xs-12">
          <button type="button" onclick="Pace.restart();actioncek(<?php echo $reqid;?>,1);" class="btn btn-xs btn-success"><i class="fa fa-calendar-check-o"></i> Approve
                  </button>
        </div>
      </div>
      <?php } ?>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <script type="text/javascript">
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
  </script>
