<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operations</title>
	<link rel="stylesheet" type="text/css" href="..//css/bootstrap.min.css">
	<link rel="stylesheet" href="..//css/style.css">
	<script src="..//js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="..//css/bootstrap.min.css">
	<script>
		function fetch_name(str) {
		        if (str.length == 0) {
		        document.getElementById("christian_name").value = "";
		        return;
		    } else {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                document.getElementById("christian_name").value = this.responseText;
		            }
		        };
		        xmlhttp.open("GET", "sp_controller.php?q=" + str, true);
		        xmlhttp.send();
		    }
		}
		function fetch_name1(str) {
		        if (str.length == 0) {
		        document.getElementById("christian_name1").value = "";
		        return;
		    } else {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                document.getElementById("christian_name1").value = this.responseText;
		            }
		        };
		        xmlhttp.open("GET", "sp_controller.php?q=" + str, true);
		        xmlhttp.send();
		    }
		}
		function update_rpt_notification(){
			var mzg = document.getElementById('fin_year_id').value;
			var dateOfToday = new Date();
			var yearOfToday = dateOfToday.getFullYear();
			if (mzg != 0) {
				//check if it is the current year in order to know how to proceed with the download
				document.getElementById('saveImage').disabled = false;
				document.getElementById('anual_rpt_notification').innerHTML = 'YOU ARE NOW ABOUT TO PRINT FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification').style.color = "blue";
				// document.getElementById().disabled = true;
			}
		}
		function update_rpt_notification2(){
			var mzg = document.getElementById('fin_year_id2').value;
			//check for year if it is not current year
			var todayDate = new Date();
			var year = todayDate.getFullYear();
			var month = todayDate.getMonth();
			if (mzg != year) {
				//the year is not the current year so we go the year in question
				document.getElementById('hidden_select_div').removeAttribute('hidden');
				
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT QUATER FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
			}
			else{
				//it is the current year
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT QUATER FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
		}
		function update_rpt_notification3(){
			var desired_quater = document.getElementById('selected_quater_id').value;
			var year = document.getElementById('fin_year_id2').value;
			if (desired_quater == 1) {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 1ST QUATER FINANCIAL REPORT FOR THE YEAR '+year ;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
			}
			else if (desired_quater == 2) {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 2ND QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
			else if (desired_quater == 3) {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 3RD QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
			else if (desired_quater == 4) {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 4TH QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else{
				alert('You must Select a quater between 1 and 4');	
			}
		}
		function offerings_view(){
			var optn = document.getElementById('motif').value;
			if (optn == 'Harvest' || optn == 'Offerings') {
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').setAttribute('hidden','true');
				document.getElementById('christian_name_grp').setAttribute('hidden','true');
			}
			else if(optn == 'Others'){
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').setAttribute('hidden','true');
				document.getElementById('christian_name_grp').setAttribute('hidden','true');
				document.getElementById('comment_grp').removeAttribute('hidden');
				document.getElementById('comment').setAttribute('required', 'true');
			}
			else if (optn == 'Project') {
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').removeAttribute('hidden');
				document.getElementById('christian_name_grp').removeAttribute('hidden');
				document.getElementById('comment_grp').setAttribute('hidden', 'true');
				document.getElementById('comment').removeAttribute('required');
			}
			else{
				window.location = '..//pages/operations.php';
			}
		}
		function modified_view(){
			var optn = document.getElementById('motif_out').value;
			if (optn == 'Others') {
				document.getElementById('comment_group_out').removeAttribute('hidden');
				document.getElementById('comment_out').setAttribute('required');
			}
			else {
				document.getElementById('comment_group_out').setAttribute('hidden', 'true');
			}
		}
		function download_qreport(){
			window.location.href = 'http://localhost/MBC/quater_report.php';
		}
   </script>
</head>
<body>
<?php 
	if (!isset($_SESSION)) {
		session_start();
		if (@$_SESSION['login'] != "yes") {
			header("Location: ..//home.php");
			exit();
		}
	}
	include '..//controller.php';
 ?>
 	<?php 
 		if (isset($together)) {
 			echo "I am now calling the method together";
 		}
 	 ?>
	<header id="header">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
			<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
			<a id="logout_label" href="..//controller.php?set_session=log_out">LOGOUT</a>
		</div>
	</header>
	<div class="container-fluid" id="background">
		<div class="row" id="overview_menus">
			<ul class="listStyle">
				<span class="text-center">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li ><b><a href="overviewtransactions.php">Overview</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li><b><a href="alltransactions.php">All Transactions</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li class="selector_line"><b><a href="#">Operations</a></b></li>
					</div>
				</span>
			</ul>
		</div>
		<div class="row" class="main_body_bground">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="cash_out_rectangle">
				<div class="container-fluid" id="cash_out_area">
					<h4 class="text-center">Cash Out Area</h4>
						<form class="form-horizontal" action="../controller.php?todo4=cash_out" role="form" method="POST">
							<input type="hidden" name="todo4" value="cash_out" />
							<div class="form-group">
								<label for="motif" class="col-sm-2 control-label">Motif</label>
								<div class="col-sm-10">
									<div class="select-style">
										<select name="selection" id="motif_out" onchange="modified_view()">
											<option value="Pastor Salary">Pst_Salary</option>
											<option value="Project">Project</option>
											<option value="Others">Others</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="christian_id1" class="col-sm-2 control-label">Executer ID</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="executer_id" id="christian_id1" onkeyup="fetch_name1(this.value)">
								</div>
							</div>
							<div class="form-group">
								<label for="christian_name1" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="executer_name" id="christian_name1" required>
								</div>
							</div>
							<div class="form-group">
								<label for="amount" class="col-sm-2 control-label">Amount</label>
								<div class="col-sm-6">
									<input type="text" name="amount_executed" class="form-control" id="amount" required>
								</div>
							</div>
							<div class="form-group" id="comment_group_out" hidden>
								<label for="amount" class="col-sm-2 control-label">Comment</label>
								<div class="col-sm-6">
									<input type="text" name="executer_comment" class="form-control" id="comment_out">
								</div>
							</div>
							  <div class="form-group">
							    <div class="col-sm-offset-4 col-sm-10">
							      <button type="submit" class="btn btn-primary">Cash Out</button>
							    </div>
							  </div>
							<div id="successful_transaction">
						  		<?php
						  			if (isset($_GET['success_notification'])) {
						  				echo "<p class='text-center'><b>YOUR TRANSACTION WAS SUCCESSFUL</b></p>";
						  			}
						  			elseif (isset($_GET['fail_notification'])) {
						  				echo "<p class='text-center'><b>!!TRANSACTION UNSUCCESSFUL!!</b></p>";
						  			}
						  		?>
						  </div>
						</form>
				</div>
				<!-- annual modal -->
		    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title" id="lineModalLabel"></h3>
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
										<select name="selected_fin_yr_id" id="fin_year_id" onchange="update_rpt_notification()">
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
			<!-- quater modal -->
			<div class="modal fade" id="squarespaceModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title" id="lineModalLabel"></h3>
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
										<select name="selected_fin_yr_id2" id="fin_year_id2" onchange="update_rpt_notification2()" required>
											<?php 
												$fin_year_info = get_financial_year();
												// echo $fin_year_info;
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
							<div class="form-group" id="hidden_select_div" hidden>
								<label for="motif" class="col-sm-6 control-label">QUATER OF YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_quater" id="selected_quater_id" onchange="update_rpt_notification3()" required>
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
								<p class="text-center anual_rpt_notification" id="anual_rpt_notification2">PLEASE CHOOSE THE YEAR WHOSE QUATER FINANCIAL REPORT IS DESIRED</p>
							</div>
							<div class="btn-group btn-group-justified" role="group" aria-label="group button">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group btn-delete hidden" role="group">
								<button type="buttonl" id="delImage2" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group" role="group" disabled>
								<button type="submit" id="saveImage2" class="btn btn-primary btn-hover-green" data-action="save" role="button" disabled>Print</button>
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
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="container-fluid" id="cash_in_cash_out_form">
						<h5 class="text-center">Estimated Church Balance</h5>
						<h5 class="text-center"><b>
						<?php
						 	echo number_format($available_balance);
						 ?> FCFA
						</b> (Available)</h5>
						<div class="form-group" id="cash_in_cash_out_buttons">
							<button type="button" id="cash_in_button" data-toggle="modal" data-target="#squarespaceModal2">Q Report</button>
							<button type="button" id="cash_out_button" data-toggle="modal" data-target="#squarespaceModal">A Report</button>
						</div>
						<div class="text-center" id="cash_out_hidder"><a href="operations.php"><button id="go_to_cash_in_button">GO TO CASH IN</button></a></div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		
	</footer>
	<script src="..//js/bootstrap.min.js"></script>
</body>
</html>