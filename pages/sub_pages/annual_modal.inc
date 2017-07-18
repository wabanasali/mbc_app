			<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title text-center" id="lineModalLabel">ANNUAL REPORT FORM</h3>
					</div>
					<div class="modal-body">
						<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
						<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
						<form class="form-horizontal" action="../controller.php?areport=annual_report" role="form" method="POST">
						<input type="hidden" name="areport" value="annual_report"/>
			              <div class="form-group">
							<label for="motif" class="col-sm-6 control-label">FINANCIAL YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_fin_yr_year" id="fin_year_id_year" onchange="update_rpt_notification()">
											<?php 
												$fin_year_info = get_financial_year();
												echo $fin_year_info;
											?>
											<option value="0">Choose</option>
											<?php
												foreach ($fin_year_info as $key => $value) {
													echo "<option value='".$value['f_year']."'>".$value['f_year']."</option>";			
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<p class="text-center anual_rpt_notification" id="anual_rpt_notification">PLEASE CHOOSE THE YEAR WHOSE FINANCIAL REPORT IS DESIRED</p>
							</div>
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group btn-delete hidden" role="group">
								<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group" role="group" disabled>
								<button type="submit" id="saveImage" class="btn btn-primary btn-hover-green" data-action="save" role="button" disabled>Print</button>
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