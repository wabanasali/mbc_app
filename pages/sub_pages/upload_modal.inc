<div class="modal fade" id="squarespaceModal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  		<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">×</span>
									<span class="sr-only">Close</span>
								</button>
								<h3 class="modal-title text-center" id="lineModalLabel">CHRISTIANS UPLOAD FORM</h3>
							</div>
							<div class="modal-body">
								<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
								<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
								<form class="form-horizontal" action="../controller.php?upload_item=upload_item_value" role="form" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="upload_item" value="upload_item_value"/>
									<div class="form-group">
										<p class="text-center edit_data_notification" id="notification3">
											YOU ARE ABOUT TO UPLOAD LIST OF CHRISTIANS
										</p>
									</div>
									<div class="form-group">
										<div class="col-sm-6">
											<input type="file" name="file" id="file" class="input-large">
										</div>
									</div>
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group btn-delete hidden" role="group">
											<button type="button" id="delImage3" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group" role="group">
											<button type="submit" id="saveImage3" class="btn btn-primary btn-hover-green" data-action="save" role="button" data-loading-text="Loading ...">Upload</button>
										</div>
									</div>
				            	</form>
							</div>
							<div class="modal-footer">
								<p class="text-center">Powered By @Theophilus</p>
							</div>
						</div>
			  		</div>
				</div>