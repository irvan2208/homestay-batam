<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Irvan Santoso</p>
          <!-- Status -->
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <li class="treeview active">
          <a href="#"><i class="fa fa-link"></i> <span>Pemesanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php
           $db = new mysqli("localhost","root","","homesta1_btm1108");
            $result = $db->query("SELECT COUNT(*) FROM hbtcek WHERE (hbtcek.id NOT IN (select id from hbtcek_approve) and hbtcek.id NOT IN (select id from hbtcek_decline))");
              $row = $result->fetch_row();
          ?>
            <li id="reqcount"><a href="#" onClick="return navclick('request');">Cek Ketersediaan <?php if($row[0]>0){ echo '('.$row[0].')';}?></a></li>
            <li><a href="#Approved" onClick="return navclick('apprcek');">Approved</a></li>
            <li><a href="#Declined" onClick="return navclick('declinecek');">Declined</a></li>
            <?php
              $countbk = $db->query("SELECT Count(*) FROM hbtcek_booked INNER JOIN hbtcek_approve ON hbtcek_booked.appid = hbtcek_approve.id
            INNER JOIN hbtcek ON hbtcek_approve.id = hbtcek.id where hbtcek.tglb >= CURDATE() AND bayar = 0");
              $rcont = $countbk->fetch_row();
            ?>
            <li><a href="#Booked" onClick="return navclick('bookedreq');">Booked <?php if($rcont[0]>0){ echo '('.$rcont[0].')';}?></a></li>
          </ul>
        </li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="#House" onClick="return navclick('rumah');"><i class="fa fa-home"></i> <span>House</span></a></li>
        <li><a href="#Owner" onClick="return navclick('owner');"><i class="fa fa-user"></i> <span>Owner</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>