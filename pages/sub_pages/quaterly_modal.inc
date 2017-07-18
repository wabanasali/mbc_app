			<div class="modal fade" id="squarespaceModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title text-center" id="lineModalLabel">QUATER REPORT FORM</h3>
					</div>
					<div class="modal-body">
						<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
						<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
						<form class="form-horizontal" action="../controller.php?qreport=quater_report" role="form" method="POST">
						<input type="hidden" name="qreport" value="quater_report"/>
			              <div class="form-group">
							<label for="motif" class="col-sm-6 control-label">FINANCIAL YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_fin_yr_qtr" id="fin_year_qtr" onchange="update_rpt_notification2()" required>
											<?php 
												$fin_year_info = get_financial_year();
												// echo $fin_year_info;
											?>
											<option value="0">Choose</option>
											<?php
												foreach ($fin_year_info as $key => $value) {
													echo "<option value='".$value['f_year_id']."'>".$value['f_year']."</option>";			
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group" id="hidden_select_qtr_div" hidden>
								<label for="motif" class="col-sm-6 control-label">QUATER OF YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_quater" id="quater_id" onchange="update_rpt_notification3()" required>
											<option value="0">Choose</option>
											<option value="1">1st QUATER</option>
											<option value="2">2nd QUATER</option>
											<option value="3">3rd QUATER</option>
											<option value="4">4th QUATER</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<p class="text-center anual_rpt_notification" id="anual_rpt_notification3">PLEASE CHOOSE THE YEAR WHOSE QUATER FINANCIAL REPORT IS DESIRED</p>
							</div>
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group btn-delete hidden" role="group">
								<button type="buttonl" id="del_Image" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group" role="group" disabled>
								<button type="submit" id="save_Image" class="btn btn-primary btn-hover-green" data-action="save" role="button" disabled>Print</button>
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