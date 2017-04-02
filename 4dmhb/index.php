<?php session_start();?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php
    include ("blk/head.php");?>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
  <?php include ("blk/nav.php");?>
  <?php include ("blk/side-menu.php");?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <text id="pgheader">Page Header</text>
        <small id="pgdesc">Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" onClick="return navclick('home');"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" id="now">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row home">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <?php
                // $exec_loads = sys_getloadavg();
                // $exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
                // $cpu = round($exec_loads[1]/($exec_cores + 1)*100, 0) . '%';
              ?>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include ("blk/footer.php");?>
</div>
</body>
</html>
