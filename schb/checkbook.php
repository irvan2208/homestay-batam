<?php
session_start();
if (isset($_SESSION['mtctoken'])){
	if ($_POST['token'] == $_SESSION['mtctoken']){
		$token_age = time() - $_SESSION['token_time']; 
		//if ($token_age <= 5){
			require("../block/koneksi.php");
			$cekid = date("ymdHis");
			$cekdt = date("Y-m-d H:i:s");
			$tgla = date("Y-m-d",strtotime($_POST['tgla']));
			$tglb = date("Y-m-d",strtotime($_POST['tglb']));

			$getpr = $db->prepare("SELECT id, price, title FROM house WHERE house.id = ?");

			    /* bind parameters for markers */
			    $getpr->bind_param("i", $_POST['houseid']);
			    $getpr->execute();
			    $getpr->bind_result($houseid,$harga,$housetitle1);
			    $getpr->fetch();
			    $getpr->close();


			$mcekq = "INSERT INTO hbtcek VALUES (?,?,?,?,?,?,?,?,?,?)";
			if($mcekq = $db->prepare($mcekq)){
				$mcekq->bind_param("issssssssi", $cekid, $houseid, $cekdt, $tgla, $tglb, $_POST['nama'], $_POST['email'], $_POST['telp'], $_POST['pesan'], $harga);
				$mcekq->execute();
				$mcekq->close();
				unset($_SESSION['mtctoken']);
				$_SESSION['status'] = 1;
				$nama = $_POST['nama'];
				$email = $_POST['email'];
				$phone = $_POST['telp'];
				$pesan = $_POST['pesan'];
				// $tgla = chgtime($tgla);
				// $tglb = chgtime($tglb);

				$mail->SetFrom('request@homestay-batam.com', $websitename.' (Request)');


				$mail->Subject    = $websitename.".com Terima kasih telah melakukan cek ketersediaan #".$cekid;
                                setlocale(LC_ALL, 'id_ID');
$tgla = strftime("%A, %d %B %Y",strtotime($tgla));
$tglb = strftime("%A, %d %B %Y",strtotime($tglb));
$cekdt= strftime("%A, %d %B %Y (%I:%M:%S)",strtotime($cekdt));
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
									<p>Hai '.$nama.', Terima kasih telah melakukan permintaan cek ketersediaan di Homestay-batam, permintaan anda sedang di cek.</p>

									<p>Berikut adalah detail:</p>
									<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
										<tr>
											<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$cekid.'</h2></th>
										</tr>
										<tr>
											<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
				    							Waktu Permintaan Cek
				    						</td>
										    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px" bgcolor="#FFFFFF">'.$cekdt.'</td>
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
												'.$housetitle1.'
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
										
									</table>
								</td>
								<td width="20"></td>
							</tr>
							<tr>
							<td width="20"></td>
								<td >
									<p>Permintaan anda akan kami respon secepatnya, maksimal 1X24 jam jika anda masih belum menerima respon dari kami silahkan hubungi kami di <a href="#" style="color: #6C5B7B!important;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 0;text-decoration: none;">Link</a>.</p>
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
								<td width="20"></td>
								<td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
								<p  style="    font-size: 10px;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
								Harap untuk tidak membalas e-mail ini, karena 
e-mail ini dikirimkan secara otomatis oleh sistem.
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
$mail->AddBCC('irvan.2208@gmail.com', 'Irvan Santoso');
if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  echo "Message sent!";
				}


			}

		//}
	} else{
		include ("../404.html");
		writeLog('FormtokenCheckBooknotmatch');
		session_unset();
		session_destroy();
	}
}else{
		include ("../404.html");
		writeLog('FormtokenCheckBooknotset');
}

function writeLog($where) {

	$ip = $_SERVER["REMOTE_ADDR"]; // Get the IP from superglobal
	//$browser = $_SERVER['HTTP_USER_AGENT']; // Get the IP from superglobal
	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
	$date = date("d M Y H:i:s");
	
	// create a logging message with php heredoc syntax
	$logging = <<<LOG
		\n
		<< Start of Message >>
		There was a hacking attempt on your form. \n 
		Date Time of Attack: {$date}
		IP-Adress: {$ip} \n
		Host of Attacker: {$host}
		Point of Attack: {$where}
		<< End of Message >>
LOG;
        
        // open log file
		if($handle = fopen('hacklog.log', 'a')) {
		
			fputs($handle, $logging);  // write the Data to file
			fclose($handle);           // close the file
			
		} else {  // if first method is not working, for example because of wrong file permissions, email the data
		echo "<script>alert('asd');</script>";
        	/*$to = 'ADMIN@gmail.com';  
        	$subject = 'HACK ATTEMPT';
        	$header = 'From: ADMIN@gmail.com';
        	if (mail($to, $subject, $logging, $header)) {
        		echo "Sent notice to admin.";
        	}*/

	}
}
?>
