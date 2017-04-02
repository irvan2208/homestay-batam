<?php 
session_start();
if (!isset($_SESSION['Logged'])){
include ("../../../404.html");  
exit;
}
?>
<?php
require("../../../block/koneksi.php");
$bookid = $_POST['bookid'];
$date = date("Y-m-d H:i:s");
$db->query("UPDATE hbtcek_booked set bayar = '1', cfmdt ='".$date."' where id =".$bookid);

$getbkdt = $db->prepare("SELECT
hbtcek_booked.rent,
hbtcek.tgla,
hbtcek.tglb,
hbtcek.email,
hbtcek.phone,
hbtcek.nama,
hbtcek_booked.cfmdt,
house.title,
house.alamat
FROM
hbtcek
INNER JOIN hbtcek_booked ON hbtcek_booked.appid = hbtcek.id
INNER JOIN house ON house.id = hbtcek.houseid
WHERE
hbtcek_booked.id
 = ?");

	$getbkdt->bind_param("i", $bookid);

	/* execute query */
	$getbkdt->execute();

	/* bind result variables */
	$getbkdt->bind_result($sisa,$tgla,$tglb,$email,$phone,$nama,$bookdt,$housetitle,$alamat);
	/* fetch value */
	$getbkdt->fetch();
	/* close statement */
	$getbkdt->close();

	setlocale(LC_ALL, 'id_ID');
	$tgla = strftime("%A, %d %B %Y",strtotime($tgla));
	$tglb = strftime("%A, %d %B %Y",strtotime($tglb));
	$bookdt= strftime("%A, %d %B %Y (%I:%M:%S)",strtotime($bookdt));

$mail->SetFrom('request@homestay-batam.com', $websitename.' (Request)');

$mail->Subject    = $websitename.".com Pembayaran di terima #".$bookid;

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
						<p>Hai '.$nama.', Pembayaran anda sudah kami terima. Silahkan menuju ke alamat berikut pada tanggal '.$tgla.'  persiapkan kartu identitas anda, dan sisa pembayaran sejumlah Rp. '.number_format($sisa).' saat bertemu dengan owner.</p>

						<p>Berikut adalah detail:</p>
						<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
							<tr>
								<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$bookid.'</h2></th>
							</tr>
							<tr>
								<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
	    							Waktu Konfirmasi
	    						</td>
							    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">'.$bookdt.'</td>
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
	    							<strong>Alamat</strong>
	    						</td>
							    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
									<strong>'.$alamat.'</strong>
								</td>
							</tr>
							<tr>
							<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
							</tr>
							<tr>
								<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
	    							<strong>Bayar langsung ke owner</strong>
	    						</td>
							    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
									<strong>Rp. '.number_format($sisa).'</strong>
								</td>
							</tr>	
						</table>
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
				<tr>
					<td colspan="3" height="20"></td>
				</tr>
				<tr>
					<td width="20"></td>
					<td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
					<p  style="    font-size: 10px;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
					Harap untuk tidak membalas e-mail ini, karena e-mail ini dikirimkan 
secara otomatis oleh sistem.
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

?>
