<?php session_start();?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php
//print_r($_SESSION);
define('MyConst', TRUE);
include ("block/head.php");
?>
<title>
<?php echo $websitename;?>
</title>
<meta name="Description" content="Homestay batam menyediakan penginapan dalam bentuk homestay/guesthouse dalam harga 
yang terjangkau.">
<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>

<?php include ("block/header.php");?>
<?php include ("block/slide.php");?>

<div class="container-fluid con">
<div class="container">
<div class="row search-row">
	<form action="" autocomplete="off" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="input-group">
            <input name="searchtext" value="" class="form-control" type="text" placeholder="Search anything, location, description, and address...">
            <span class="input-group-btn">
               <button class="btn btn-default button" type="submit" id="addressSearch">
                   <span class="glyphicon glyphicon-search"></span> Search
               </button>
            </span>
        </div>
    </form>
</div>
</div>
</div>

<!--<div class="well well-lg">asd</div>-->
<div class="container">
<div class="row row-con">
  <?php
    if (isset($_SESSION['status'])) {
      $stats = $_SESSION['status'];
      if($stats == 1){
    ?>
      <div class="alert alert-success">
        <h3>
          <strong>Berhasil!</strong> Permintaan cek ketersediaan diterima, kami akan mengirimkan email apabila rumah tersedia.
        </h3>
      </div>
    <?php
        unset($_SESSION['status']);
      }
    }
    ?>
    <?php include ("block/product-grid.php");?>
</div>
</div>

<?php include ("block/join.php");?>
</body>

<?php include ("block/footer.php");?>
</html>
