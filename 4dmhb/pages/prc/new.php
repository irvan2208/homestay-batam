<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$new = $_GET['new'];
if ($new == 'own') {
	require_once 'class.upload.php';
    $handle = new Upload($_FILES['ownimg']);
    $handle->allowed = 'image/*';

    if($handle->uploaded) {
        $handle->Process('../../../catalog/imgo');
        $img = 'catalog/imgo/'.$_FILES['ownimg']['name'];
    }

	$namaown = $_POST['namaown'];
	$ownid = $_POST['ownide'];
	$usrnm = str_replace(' ', '_', $namaown);
	$jk = $_POST['jkown'];
	$phone = $_POST['phoneown'];
	$alamat = $_POST['alamatown'];
	//$usrbg = $_POST['jkown']
	$ttl = date("Y-m-d",strtotime($_POST['ttlown']));
	$joindt = date("Y-m-d");
	if(!isset($img)){
		$img = 'catalog/imgo/owndef.png';
	}
	$newown = "INSERT INTO owner VALUES (?,?,?,?,?,?,?,?,?,1) ON DUPLICATE KEY UPDATE nama=?, phone=?, alamat=?";
	//"INSERT INTO owner VALUES (?,?,?,?,?,?,?,?,?,1) ON DUPLICATE KEY UPDATE sku=?, title=?, alamat=?, desk=?, price=?, kamar=?, toilet=?, tv=?, ac=?"
	if($newown = $db->prepare($newown)){
		$newown->bind_param("isssssssssss", $ownid, $usrnm, $namaown, $jk, $phone, $img, $alamat, $ttl, $joindt,$namaown,$phone,$alamat);
		$newown->execute();
		$newown->close();
	}
	$ownsele = $db->query("SELECT id FROM owner order by id desc");
	$ownselec = $ownsele->fetch_array();
	$oid = $ownselec['id'];
	print_r($oid);
} else if ($new == 'hom'){
	$idhom = $_POST['idhom'];
	$jdlhom = $_POST['jdlhom'];
	$idown = $_POST['idown'];
	$alamathom = $_POST['alamathom'];
	$desk = $_POST['desk'];
	$pricehom = $_POST['pricehom'];
	$skuhom = $_POST['skuhom'];
	$jmlkmrhom = $_POST['jmlkmrhom'];
	$toilethom = $_POST['toilethom'];
	$tvhom = $_POST['tvhom']; 
	$achom = $_POST['achom'];
	$lathom = $_POST['lathom'];
	$longhom = $_POST['longhom'];
		
	$regdate = date("Y-m-d");
	$newhom = "INSERT INTO house VALUES (?,?,?,?,?,?,?,?,?,?,?,?,1,?,?) ON DUPLICATE KEY UPDATE sku=?, title=?, alamat=?, desk=?, price=?, kamar=?, toilet=?, tv=?, ac=?, `lat`=?, `long`=?";
	if($newhom = $db->prepare($newhom)){
		$newhom->bind_param("isssssisssssssssssissssss",$idhom, $idown, $skuhom, $jdlhom, $alamathom, $desk, $pricehom, $jmlkmrhom, $toilethom, $tvhom, $achom, $regdate, $lathom, $longhom, $skuhom, $jdlhom, $alamathom, $desk, $pricehom, $jmlkmrhom, $toilethom, $tvhom, $achom, $lathom, $longhom);
		$newhom->execute();
		$newhom->close();
	 }
	 if (empty($idhom)) {
	 	$homsele = $db->query("SELECT id FROM house order by id desc");
		$homsele = $homsele->fetch_array();
		$idhom = $homsele['id'];
	 	$homsele = $db->query("INSERT INTO gmbar (houseid,path,active,asbg,ena) VALUES('".$idhom."','catalog/imgh/homdef.ico',1,1,1)");
		print_r($idhom);
	 }else{
	 	print_r($idhom);
	 }
}else if ($new == 'fac'){
	$idhom = $_POST['idhom'];
	$namfac = $_POST['namfac'];
	$facstats = $_POST['facstats'];
		
	$newfac = "INSERT INTO fasilitas (houseid,entity,value) VALUES (?,?,?)";
	if($newfac = $db->prepare($newfac)){
		$newfac->bind_param("sss",$idhom, $namfac, $facstats);
		$newfac->execute();
		$newfac->close();
	 }
	 print_r($idhom);
}else if ($new == 'imgh') {
	require_once 'class.upload.php';
	$idhom = $_POST['hid'];
    $handle = new Upload($_FILES['file']);
    $handle->allowed = 'image/*';

    if($handle->uploaded) {
        $handle->Process('../../../catalog/imgh');
        $newimg = "INSERT INTO gmbar (houseid,path,active,asbg,size,ena) VALUES (?,?,0,0,null,1)";
        $imgspa = str_replace(' ', '_', $_FILES['file']['name']);
        $path = 'catalog/imgh/'.$imgspa;
		if($newimg = $db->prepare($newimg)){
			$newimg->bind_param("ss",$idhom, $path);
			$newimg->execute();
			$newimg->close();
		 }
    }
    print_r($idhom);
}
?>
