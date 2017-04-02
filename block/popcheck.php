<?php

if(!defined('MyConst')) {
   include ("../404.html");
}else{

?>
<script>
	$(document).ready(function(){
		$('.chgrd').hide();
		$('#response').hide();
	});
</script>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2 class="modal-title">Cek Ketersediaan: <?php echo $d['title']; ?></h2>
					</div>
				</div>
			</div>
			
			<form class="form-horizontal" method="post" id="checkav">
				<div class="modal-body">
					<div class="row">
						<input type="hidden" name="houseid" value="<?php echo $houseid; ?>" />
						<div class="col-sm-12 body-modal">
							<div class="col-sm-6">
								<div class="row">
									<div id='carousel-pop' class='carousel slide' data-ride='carousel'>
										<div class='carousel-outer'>
											<!-- Wrapper for slides -->
											<div class='carousel-inner'>
												<?php
													$getslideimg = $db->query("SELECT * FROM gmbar WHERE houseid = ".$houseid." && ena = '1' limit 4");
													while($getimsl = $getslideimg->fetch_array()){
														$active = "";
														if($getimsl['active']==1)
															$active = "active";
												?>
												<div class='item <?php echo $active;?>'>
													<img src='<?php echo $base_url.$getimsl['path'];?>' alt='' />
												</div>	
												<?php } ?>						
											</div>
													
											<!-- Controls -->
											<a class='left carousel-control' href='#carousel-pop' data-slide='prev'>
												<span class='glyphicon glyphicon-chevron-left'></span>
											</a>
											<a class='right carousel-control' href='#carousel-pop' data-slide='next'>
												<span class='glyphicon glyphicon-chevron-right'></span>
											</a>
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table table-responsive tglr" style="margin-bottom:0;">
										<thead>
											<tr>
												<th>Mulai Dari</th>
												<th>Sampai Dengan</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input name="tgla" class="form-control" type="text" readonly id="tgla"/></td>
												<td><input name="tglb" class="form-control" type="text" readonly id="tglb"/></td>
											</tr>
											<tr>
												<td colspan="2" align="center"><a href="#" class="ctgl">Ganti Tanggal</a>
												<p>Pastikan tanggal anda sudah benar, </p></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="row chgrd" style="padding: 20px;">
									<div class="col-sm-8">
										<input type="text" class="form-control" readonly id="dtrg" name="daterange" value="01/01/2015 - 01/31/2015" />
									</div>
									<div class="col-sm-4">
										<button style="width:100%" class="rgdt btn btn-md btn-success" type="button">Simpan</button>
									</div>
								</div>
								<script>
									$('.cekbtn').click(function(){
										Date.prototype.addDays = function(days) {
											this.setDate(this.getDate() + parseInt(days));
											return this;
										};
										var getdate = $('#datetimepicker1').val();
										var tgla = new Date(getdate);
										var d = $('#sel1').val();
										var value = tgla.addDays(d);

										if (getdate == null) {
											getdate = new Date().addDays(1);
										}
										
										$('#tgla').val(moment(getdate).format('dddd, D MMMM YYYY'));
										if (d == null) {
											value = getdate.addDays(2);
										}
										$('#tglb').val(moment(value).format('dddd, D MMMM YYYY'));
									});
								</script>
										
								<script>
								$('.rgdt').click(function() {
									$('.tglr').show();
									$('.chgrd').hide();
									$('#tgla').val(moment($('input[name="daterange"]').data('daterangepicker').startDate).format('dddd, D MMMM YYYY'));
									$('#tglb').val(moment($('input[name="daterange"]').data('daterangepicker').endDate).format('dddd, D MMMM YYYY'));
								})
									
								$('.ctgl').click(function() {
									$('.tglr').hide();
									$('.chgrd').show();
									var getdate = $('#datetimepicker1').val();
									var tgla = new Date(getdate);
									var d = $('#sel1').val();
											
									var value = tgla.addDays(d);
									$('input[name="daterange"]').daterangepicker({
										"dateLimit": {
											"days": 14
										},
										"startDate": moment(getdate).format('MM/DD/YYY'),
										"endDate": moment(value).format('MM/DD/YYY'),
										"drops": "up",
										"minDate": moment().add(1, 'd').toDate(),
										"maxDate": moment().add(1, 'years')
											
									});
									$('#dtrg').click();
								})
								</script>
							</div>
							<div class="col-sm-6">
								<div class="row">
									<div class="col-sm-12">
										<fieldset>
										<legend><h3>Isi Data Diri Anda</h3></legend>

											<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-3 control-label" for="textinput">Nama Lengkap</label>  
										  <div class="col-md-9">
										  <input name="nama" type="text" placeholder="Nama Lengkap" class="form-control input-md" required="">
											
										  </div>
										</div>

											<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-3 control-label" for="textinput">E-Mail</label>  
										  <div class="col-md-9">
										  <input name="email" type="email" placeholder="E-Mail" class="form-control input-md" required="">
											
										  </div>
										</div>

											<!-- Text input-->
										<div class="form-group">
										  <label class="col-md-3 control-label" for="textinput">No Hp</label>  
										  <div class="col-md-9">
										  <input name="telp" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="No Hp" class="form-control input-md" required="">
											
										  </div>
										</div>

										<!-- Textarea -->
										<div class="form-group">
										  <label class="col-md-3 control-label" for="textarea">Pesan</label>
										  <div class="col-md-9">                     
											<textarea style="resize:none;" class="form-control" id="textarea" placeholder="Pesan Anda" name="pesan"></textarea>
										  </div>
										</div>
										
										<div class="form-group">
											<div class="col-md-3"></div>
											<div class="col-md-9">
												<div class="g-recaptcha" data-sitekey="6LePtCQTAAAAABnVv09UMAOHQlkaPSf_UdJhrvRp"></div>
										  	</div>
										</div>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-body" id="response"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-sm-12">
							<button type="submit" id="cekk" value="Submit" class="btn btn-primary">Cek Ketersediaan</button>
						</div>
					</div>
				</div>
				<script> 
			        $("document").ready(function () {
					    $("#cekk").click(function () {
					        $('#checkav').submit(function (e) {
					            e.preventDefault();
					             $('#response').show();
					             <?php
									$token = md5(uniqid(rand(), TRUE));
									$_SESSION['mtctoken'] = $token;
									$_SESSION['token_time'] = time();
								?>
					            $.ajax({
					                url: "<?php echo $base_url; ?>schb/checkbook.php",
					                type: "POST",
					                data : {
					                	'token': "<?php echo $token; ?>",
					                	'houseid' : $('input[name="houseid"]').val(),
					                	'nama' : $('input[name="nama"]').val(),
					                	'email' : $('input[name="email"]').val(),
					                	'telp' : $('input[name="telp"]').val(),
					                	'tgla' : $('input[name="tgla"]').val(),
					                	'tglb' : $('input[name="tglb"]').val(),
					                	'pesan' : $('textarea[name="pesan"]').val()
					                },
					                success: function (data) {
					                	//$('#response').hide();
					                	location.reload();
					                	//$('#submitsc').click();
								$(window).scrollTop($('.topsugest').offset().top);
					                },
					                error: function (jXHR, textStatus, errorThrown) {
					                	//alert("asd");
					         			//alert('Error Message: '+ x);
     									// alert('HTTP Error: '+errorThrown);
					                }
					            }); // AJAX Get Jquery statment
					            return false;
					        });
					    }); // Click effect     
					}); //Begin of Jquery Statement
			    </script>
			</form>
		</div>
	</div>
</div>
<?php } ?>
