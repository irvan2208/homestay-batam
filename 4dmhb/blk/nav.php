<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $base_url."4dmhb";?>" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Homestay</b>Batam</span>
    </a>
<nav class="navbar navbar-static-top" role="navigation">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <?php
              $db = new mysqli("localhost","root","","homesta1_btm1108");
              $result = $db->query("SELECT COUNT(*) FROM hbtcek WHERE (hbtcek.id NOT IN (select id from hbtcek_approve) and hbtcek.id NOT IN (select id from hbtcek_decline))");
              $row = $result->fetch_row();

              $countbk = $db->query("SELECT Count(*) FROM hbtcek_booked INNER JOIN hbtcek_approve ON hbtcek_booked.appid = hbtcek_approve.id
            INNER JOIN hbtcek ON hbtcek_approve.id = hbtcek.id where hbtcek.tglb >= CURDATE() AND bayar = 0");
              $rcont = $countbk->fetch_row();
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php if($row[0]>0){ echo $row[0];}?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php if($row[0]>0){ echo $row[0];}?> New Request</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">

                <?php 
            $query = $db->query("SELECT * FROM hbtcek WHERE (hbtcek.id NOT IN (select id from hbtcek_approve) and hbtcek.id NOT IN (select id from hbtcek_decline)) ORDER BY cekdt desc");
            while($d = $query->fetch_array()){
                ?>
                  <li><!-- start notification -->
                    <a href="#" onclick="$('.content').load('<?php echo $base_url."4dmhb";?>/pages/request-single.php?reqid=<?php echo $d['id'];?>&status=0');">
                      <?php
                         $querygettitle = $db->query("SELECT title from house where id =".$d['houseid']);
                        $dgetht1 = $querygettitle->fetch_array();
                      ?>
                      <?php echo substr($dgetht1['title'],0,25);?>
                      (<?php echo countdays($d['tgla'],$d['tglb'])." Hari";?>)
                    </a>
                  </li>
                  <!-- end notification -->
                  <?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="#" onClick="return navclick('request');">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"><?php if($rcont[0]>0){ echo $rcont[0];}?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php if($rcont[0]>0){ echo $rcont[0];}?> New Book</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="pages/prc/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    </header>