<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>


  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/app.js" type="text/javascript"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="plugins/pace/pace.min.js"></script>
<script>
        function navclick(id) {
        //$(document).ajaxStart(function() { ; });
        Pace.restart();
            $('.content').unload();
            $('.content').hide()
            // $('#contentmenu').hide();
            // $('#contentmessage').hide();
            if (id == 'home') {
                $('.content').load("index.php .home");
                $('.content').show();
            }else if (id == 'request') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/request.php');
                $('.content').show();
            }else if (id == 'apprcek') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/apprcek.php');
                $('.content').show();
            }else if (id == 'declinecek') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/decek.php');
                $('.content').show();
            }else if (id == 'bookedreq') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/bookedre.php');
                $('.content').show();
            }else if (id == 'rumah') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/rumah.php');
                $('.content').show();
            }
            else if (id == 'owner') {
                $('.content').load('<?php echo $base_url."4dmhb";?>/pages/owner.php');
                $('.content').show();
            }
        }
    </script>