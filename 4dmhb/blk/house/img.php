<div class="row">
					  	<div class="col-xl-12 pull-right">
					  		<button type="submit" id="smpimg" type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">Add New Image</button>

					  		<div class="modal fade" id="myModal">
				                <div class="modal-dialog">
				                    <div class="modal-content">
				                        <form id="formimg" enctype="multipart/form-data" role="form">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				                                <h4 class="modal-title">Upload Photo</h4>
				                            </div>
				                            <div class="modal-body">
				                                <div id="messages"></div>
				                                <input type="file" name="file" id="file">
				                                <input type="hidden" name="hid" value="<?php echo $hid;?>">
				                            </div>
				                            <div class="modal-footer">
				                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                                <button type="submit" class="btn btn-primary">Save</button>
				                            </div>
				                        </form>
				                    </div>
				                </div>
				            </div>
					  	</div>
				  	</div>
					<div class="row">
						<table class="table table-bordered table-striped table-hover table-responsive" id="imgtbl">
						<thead>
							<tr>
								<td>ID</td>
								<td>IMG</td>
								<td>As main</td>
								<td>AS BG</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
						  	<?php 
						  	if ($edit == 1){
								$qimg = $db->query ("SELECT * FROM gmbar WHERE houseid =". $hid);
								while($img = $qimg->fetch_array()){
							?>
							<tr>
								<td><?php echo $img['imgid'];?></td>
								<td><img width="90px" src="<?php echo $base_url.$img['path'];?>"/></td>
								<td>
								<input 
								type="radio" 
								name="imgasm" 
								value="<?php echo $img['imgid'];?>"
								<?php if ($img['active']==1) {echo "checked";}?>
								onclick="Pace.restart();setimg('active',<?php echo $img['imgid'];?>,<?php echo $hid;?>);">
								</td>
								<td>
								<input 
								type="radio" 
								name="imgasbg" 
								value="<?php echo $img['imgid'];?>" 
								<?php if ($img['asbg']==1) {echo "checked";}?>
								onclick="Pace.restart();setimg('asbg',<?php echo $img['imgid'];?>,<?php echo $hid;?>);" >
								</td>
								<td></td>
							</tr>
							<?php } } ?>
						</tbody>
						</table>
					</div>