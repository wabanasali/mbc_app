<div class="modal fade" id="squarespaceModal7" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title text-center" id="lineModalLabel">MONTHLY INCOME REPORT FORM</h3>
					</div>
					<div class="modal-body">
						<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
						<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
						<form class="form-horizontal" action="../controller.php?mreport1=monthly_report" role="form" method="POST">
						<input type="hidden" name="mreport1" value="monthly_report"/>
			              <div class="form-group">
							<label for="motif" class="col-sm-6 control-label">FINANCIAL YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="year_month_inc" id="fin_year_id2_month_inc" onchange="monthly_update_rpt_notification_inc()" required>
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
							<div class="form-group" id="hidden_select_div_inc" hidden>
								<label for="motif" class="col-sm-6 control-label">MONTH OF YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_month_inc" id="selected_month_id_inc" onchange="monthly2_update_rpt_notification_inc()" required>
											<option value="0">Choose</option>
											<option value="Jan">JANUARY</option>
											<option value="Feb">FEBRUARY</option>
											<option value="Mar">MARCH</option>
											<option value="Apr">APRIL</option>
											<option value="May">MAY</option>
											<option value="Jun">JUNE</option>
											<option value="Jul">JULY</option>
											<option value="Aug">AUGUST</option>
											<option value="Sep">SEPTEMBER</option>
											<option value="Oct">OCTOBER</option>
											<option value="Nov">NOVEMBER</option>
											<option value="Dec">DECEMBER</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<p class="text-center anual_rpt_notification" id="anual_rpt_notification2_inc">PLEASE CHOOSE THE YEAR WHOSE MONTHLY FINANCIAL REPORT IS DESIRED</p>
							</div>
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group btn-delete hidden" role="group">
								<button type="buttonl" id="delImage2_inc" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group" role="group" disabled>
								<button type="submit" id="saveImage2_inc" class="btn btn-primary btn-hover-green" data-action="save" role="button" disabled>Print</button>
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