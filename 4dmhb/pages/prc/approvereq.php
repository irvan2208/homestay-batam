<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$reqid = $_POST['reqid'];
$date = date("Y-m-d H:i:s");
$db->query("INSERT INTO hbtcek_approve VALUES ('".$reqid."','".$date."','".$adm."')");

$getappid = $db->prepare("SELECT hbtcek.nama, hbtcek.email, hbtcek.phone, hbtcek.pesan, hbtcek.tgla, hbtcek.tglb, hbtcek.cekdt, house.title, hbtcek.id as appid FROM hbtcek INNER JOIN house ON house.id = hbtcek.houseid WHERE hbtcek.id = ?");
$getappid->bind_param("s", $reqid);

/* execute query */
$getappid->execute();

/* bind result variables */
$getappid->bind_result($nama,$email,$phone,$pesan,$tgla,$tglb,$cekdt,$housetitle,$appid);

/* fetch value */
$getappid->fetch();
/* close statement */
$getappid->close();
setlocale(LC_ALL, 'id_ID');
$tgla = strftime("%A, %d %B %Y",strtotime($tgla));
$tglb = strftime("%A, %d %B %Y",strtotime($tglb));
$date= strftime("%A, %d %B %Y (%I:%M:%S)",strtotime($date));
$mail->SetFrom('request@homestay-batam.com', $websitename.' (Request)');


$mail->Subject    = $websitename.".com Rumah yang anda request tersedia! #".$reqid;

$body             = '
<span>
<table align="center" style="color: #555;font-family: Arial,sans-serif;font-size: 14px;background:#f8f8f8;line-height: 1.5;">
    <tr>
		<td>
		<table width="600px" border="0" style="border-collapse: collapse; border-spacing: 0;margin: 0 auto;padding: 0;">
    		<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td colspan="3" align="center"><img alt="Logo" src="'.$base_url.'img/logohbtemail.png" width="50%"></td>
				<td width="20"></td>
			</tr>
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td>
					<p>Hai '.$nama.', Rumah yang anda request tersedia!!, silahkan melakukan pemesanan, dan lakukan pembayaran Booking fee ke homestay-batam.com sebelum '.$tgla.'.</p>

					<p>Berikut adalah detail:</p>
					<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
						<tr>
							<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$reqid.'</h2></th>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Waktu Approved
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">'.$date.'</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Nama
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
								'.$nama.'
							</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Telephone
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
								'.$phone.'
							</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							E-mail
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$email.'
							</td>
						</tr>						
						<tr>
						<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Judul Rumah
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$housetitle.'
							</td>
						</tr>	
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Tanggal Check-In
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$tgla.'
							</td>
						</tr>
						<tr>
							<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Tanggal Check-Out
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$tglb.'
							</td>
						</tr>
						<tr>
							<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Pesan
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$pesan.'
							</td>
						</tr>
						<tr>
						<th colspan="3" style="height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
						</tr>
						
					</table>
				</td>
				<td width="20"></td>
			</tr>
			<tr>
			<td width="20"></td>
				<td >
					<p>Silahkan Klik detail dibawah 
dan lakukan konfirmasi Pemesanan.</p>
				</td>
				<td width="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td height="2" style="    border-bottom: solid 2px;border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0"></td>
				<td width="20"></td>
			</tr>
			<tr>
				<td height="10" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0"></td>
			</tr>
<tr><td width="20"></td><td align="center"><a href="'.$base_url.'bookcek/'.base64_encode( urldecode($reqid)).'" style="display: block;
    width: 50%;
    background: #6C5B7B;
    padding: 10px;
    text-align: center;
    border-radius: 30px;
    color: white;
    text-decoration:none;
    font-weight: bold;">Detail Request</a></td><td width="20"></td></tr>
<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
				<p  style="    font-size: 10px;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
				Harap untuk tidak membalas e-mail ini, karena e-mail ini dikirimkan secara 
otomatis 
oleh sistem.
				</p>
				</td>
				<td width="20"></td>
			</tr>
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</span>
';
$body             = eregi_replace("[\]",'',$body);
$mail->MsgHTML($body);

$mail->AddAddress($email, $name);
$mail->Send();


$mail = new PHPMailer();
$mail->SetFrom('request@homestay-batam.com', $websitename.' (Request)');
$mail->Subject    = $websitename.".com Request Approved #".$reqid;
$body             = '
<span>
<table align="center" style="color: #555;font-family: Arial,sans-serif;font-size: 14px;background:#f8f8f8;line-height: 1.5;">
    <tr>
		<td>
		<table width="600px" border="0" style="border-collapse: collapse; border-spacing: 0;margin: 0 auto;padding: 0;">
    		<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td colspan="3" align="center"><img alt="Logo" src="'.$base_url.'img/logohbtemail.png" width="50%"></td>
				<td width="20"></td>
			</tr>
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td>
					<p>Request Approved.</p>

					<p>Berikut adalah detail:</p>
					<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
						<tr>
							<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$reqid.'</h2></th>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Waktu Approved
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">'.$date.'</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Nama
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
								'.$nama.'
							</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Telephone
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">
								'.$phone.'
							</td>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							E-mail
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$email.'
							</td>
						</tr>						
						<tr>
						<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
						</tr>
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Judul Rumah
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$housetitle.'
							</td>
						</tr>	
						<tr>
							<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Tanggal Check-In
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$tgla.'
							</td>
						</tr>
						<tr>
							<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Tanggal Check-Out
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$tglb.'
							</td>
						</tr>
						<tr>
							<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
    							Pesan
    						</td>
						    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
								'.$pesan.'
							</td>
						</tr>
						<tr>
						<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
						</tr>
						
					</table>
				</td>
				<td width="20"></td>
			</tr>
<tr>
				<td colspan="3" height="20"></td>
			</tr>
			<tr>
				<td width="20"></td>
				<td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
				<p  style="    font-size: 10px;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
				Harap untuk tidak membalas e-mail ini, karena e-mail ini dikirimkan secara 
otomatis oleh 
sistem.
				</p>
				</td>
				<td width="20"></td>
			</tr>
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</span>
';
$body             = eregi_replace("[\]",'',$body);
$mail->MsgHTML($body);
$mail->AddAddress('irvan.2208@gmail.com', 'Irvan Santoso');
$mail->Send();

?>
