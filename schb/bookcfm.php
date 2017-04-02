<?php
session_start();
if (isset($_SESSION['bcmtoken'])){
	if ($_POST['tkn'] == $_SESSION['bcmtoken']){
		if (isset($_SESSION['reqid'])){
			require("../block/koneksi.php");
			$bookdt = date("Y-m-d H:i:s");
			$reqid = base64_decode( urldecode($_SESSION['reqid']));
			$tranid = $_SESSION['tranid'];
			$fee = $_SESSION['fee'];
			$sisa = $_SESSION['sisa'];
			$id = date("ymd").$tranid;
			$k = 0;

			$bookcfmq = "INSERT INTO hbtcek_booked (id,appid,bookdt,fee,rent,tranid,bayar) VALUES (?,?,?,?,?,?,?)";
			$bookcfm = $db->prepare($bookcfmq);
			$bookcfm->bind_param("sssiiis", $id, $reqid, $bookdt, $fee, $sisa, $tranid, $k);
			//echo $bookcfmq;
			if($bookcfm->execute()){
				$bookcfm->close();
				unset($_SESSION['bcmtoken']);

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
					$bookdt= strftime("%A, %d %B %Y (%I:%M:%S)",strtotime($bookdt));

					$mail->SetFrom('request@homestay-batam.com', $websitename.' (Request)');

					$mail->Subject    = $websitename.".com Terima kasih telah melakukan pemesanan!! #".$reqid;

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
											<p>Hai '.$nama.', Terima kasih telah melakukan pemesanan silahkan lakukan pembayaran Booking fee ke homestay-batam.com sebelum '.$tgla.'.</p>

											<p>Berikut adalah detail:</p>
											<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
												<tr>
													<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$reqid.'</h2></th>
												</tr>
												<tr>
													<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
						    							Waktu Pemesanan
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
						    							Pesan
						    						</td>
												    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
														'.$pesan.'
													</td>
												</tr>
												<tr>
												<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
												</tr>
												<tr>
													<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
						    							Total Bayar
						    						</td>
												    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
														Rp. '.number_format($sisa+$fee).'
													</td>
												</tr>
												<tr>
													<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
						    							<strong>Bayar 
Homestay-batam</strong>
						    						</td>
												    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
														
<strong>Rp. '.number_format($fee).'</strong>
													</td>
												</tr>
												<tr>
													<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
						    							Bayar langsung ke owner
						    						</td>
												    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
														Rp. '.number_format($sisa).'
													</td>
												</tr>	
											</table>
										</td>
										<td width="20"></td>
									</tr>
									<tr>
									<td width="20"></td>
										<td >
											
<p>Silahkan lakukan pembayaran sejumlah Rp. '.number_format($fee).'  dengan cara transfer ke 
rekening 
berikut:</p>
											<h4>CIMB Niaga: <smaller>702743201200 A.N IRVAN SANTOSO</smaller></h4>
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
									    font-weight: bold;">Detail Pesanan anda</a></td><td width="20"></td></tr>
									<tr>
										<td colspan="3" height="20"></td>
									</tr>
									<tr>
										<td width="20"></td>
										<td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
										<p  style="    font-size: 10px;color:#999;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:0">
										Harap untuk tidak membalas 
e-mail ini, karena e-mail ini dikirimkan secara otomatis oleh sistem.
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

						$mail->Subject    = $websitename.".com Konfirmasi Pemesanan baru #".$reqid;
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
											<td colspan="3" align="center"><img alt="Logo" width="100%"></td>
											<td width="20"></td>
										</tr>
										<tr>
											<td colspan="3" height="20"></td>
										</tr>
										<tr>
											<td width="20"></td>
											<td>
												<p>Konfirmasi Pemesanan baru.</p>

												<p>Berikut adalah detail:</p>
												<table width="100%" border="0" style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;font-size: 12px;margin: 0 0 25px;padding: 0;">
													<tr>
														<th colspan="2" align="center" style="background: #6C5B7B;border-bottom-style: none;color: #ffffff;padding-left: 10px; padding-right: 10px;"><h2 style="color: #ffffff;font-family: Arial,sans-serif;font-size: 14px;line-height: 1.5;margin: 0;padding: 5px 0;">#'.$reqid.'</h2></th>
													</tr>
													<tr>
														<td style="background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px; border-collapse: collapse; border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
							    							Waktu Pemesanan
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
							    							Pesan
							    						</td>
													    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
															'.$pesan.'
														</td>
													</tr>
													<tr>
													<th colspan="3" style="    height: 5px;background:#6C5B7B;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"></th>
													</tr>
							<tr>
														<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
							    							Total Bayar
							    						</td>
													    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
															Rp. '.number_format($sisa+$fee).'
														</td>
													</tr>
							<tr>
														<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
							    							Bayar Homestay-batam
							    						</td>
													    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
															Rp. '.number_format($fee).'
														</td>
													</tr>
							<tr>
														<td style="    background: #ffffff;border-bottom-color: #cccccc;border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-spacing: 0;color: #555;font-family: Arial,sans-serif;line-height: 1.5;margin: 0;padding: 5px 10px;">
							    							Bayar langsung ke owner
							    						</td>
													    <td align="left" valign="top" style="background:#ffffff;border-bottom-color:#cccccc;border-bottom-style:solid;border-bottom-width:1px;border-collapse:collapse;border-spacing:0;color:#555;font-family:Arial,sans-serif;line-height:1.5;margin:0;padding:5px 10px">
															Rp. '.number_format($sisa).'
														</td>
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
											Harap untuk tidak 
membalas e-mail ini, karena e-mail ini dikirimkan secara otomatis oleh sistem.
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

				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
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
