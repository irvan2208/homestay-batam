<?php
if(!defined('MyConst')) {
   include ("../404.html");
}else{
?>
<script>
    $(document).ready(function(){
      $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 50) { // check if user scrolled more than 50 from top of the browser window
          $(".navbar-fixed-top").css("background-color", "#355C7D "); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
        } else {
          $(".navbar-fixed-top").css("background-color", "transparent"); // if not, change it back to transparent
        }
      });
    });
</script>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" style="background-color: transparent;border-color: transparent;">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo $base_url;?>" class="navbar-brand"><img alt="Logo" src="<?php echo $base_url.'img/logohbt.png';?>"/></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li><a data-gtm-action="Header" href="<?php echo $base_url;?>page/tentang-kami"><i class="icon hs-icon-heart-solid"></i>Tentang Kami</a></li>
        <li><a data-gtm-action="Header" href="<?php echo $base_url;?>page/hubungi-kami">Hubungi Kami</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kota<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-left">
            <li><a data-guest-signup="true" href="#">Batam</a></li>
          </ul>
        </li>
        <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Log In<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-left" role="login">
            <li><a data-login="true" href="#">Guest Login</a></li>
            <li><a data-host="true" data-login="true" href="#">Host Login</a></li>
          </ul>
        </li> -->
        <li class="dropdown"><a class="dropdown-toggle" href="<?php echo $base_url;?>page/cara-kerja">Cara Kerja</a></li>
        <li class="become-a-host"><a class="white" data-gtm-action="Header" data-gtm-label="Click Become a host" href="<?php echo $base_url;?>page/bergabung" id="become-a-host">Bergabung</a></li>
      </ul>
    </nav>
</header>
<?php } ?>
