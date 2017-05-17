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
			if (mzg != 0) {
				document.getElementById('anual_rpt_notification').innerHTML = 'YOU ARE NOW ABOUT TO PRINT FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification').style.color = "blue";
			}
		}
		function update_rpt_notification2(){
			var mzg = document.getElementById('fin_year_id2').value;
			if (mzg != 0) {
				document.getElementById('hidden_select_div').removeAttribute('hidden');
				
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT QUATER FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
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
			//need to take year and quater as argument as argument
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
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="cash_in_rectangle">
				<div class="container-fluid" id="cash_in_area">
					<h4 class="text-center">Cash In Area</h4>
					<form class="form-horizontal" action="../controller.php?todd3=cash_in" role="form" method="POST">
						<input type="hidden" name="todo3" value="cash_in" />
						<div class="form-group">
							<label for="motif" class="col-sm-2 control-label">Motif</label>
							<div class="col-sm-10">
								<div class="select-style">
									<select name="selection" id="motif" onchange="offerings_view()">
										<option value="Tithes">Tithes</option>
										<option value="Project">Project</option>
										<option value="Harvest">HarvestTG</option>
										<option value="Offerings">Offerings</option>
										<option value="Others">Others</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group" id="christian_id_grp">
							<label for="christian_id" class="col-sm-2 control-label">Christian ID</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="christian_id" id="christian_id" onkeyup="fetch_name(this.value)" required>
							</div>
						</div>
						<div class="form-group" id="christian_name_grp">
							<label for="christian_name" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="christian_name" id="christian_name" >
							</div>
						</div>
						<div class="form-group">
							<label for="amount" class="col-sm-2 control-label">Amount</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="amount" id="amount" required>
							</div>
						</div>
						<div class="form-group" id="comment_grp" hidden>
								<label for="comment" class="col-sm-2 control-label">Comment</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="comment" id="comment">
								</div>
							</div>
						  <div class="form-group">
						    <div class="col-sm-offset-4 col-sm-10">
						      <button type="submit" class="btn btn-primary">Cash In</button>
						    </div>
						  </div>
					</form>
				</div>
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
						<form class="form-horizontal" action="" role="form" method="POST">
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
							<div class="btn-group" role="group">
								<button type="button" id="saveImage" class="btn btn-primary btn-hover-green" onclick="alert('Done')" data-action="save" role="button">Print</button>
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
						<form class="form-horizontal" action="" role="form" method="POST">
			              <div class="form-group">
							<label for="motif" class="col-sm-6 control-label">FINANCIAL YEAR</label>
								<div class="col-sm-6">
									<div class="select-style">
										<select name="selected_fin_yr_id2" id="fin_year_id2" onchange="update_rpt_notification2()">
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
										<select name="selected_quater" id="selected_quater_id">
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
								<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" id="saveImage" class="btn btn-primary btn-hover-green" onclick="download_qreport()" data-action="save" role="button">Print</button>
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
						 	echo number_format($available_balance, 0);
						 ?> FCFA
						</b> (Available)</h5>
						<div class="form-group" id="cash_in_cash_out_buttons">
							<!-- <button type="button" id="cash_in_button" onclick="download_qreport();">Q Report</button> -->
							<button type="button" id="cash_in_button" data-toggle="modal" data-target="#squarespaceModal2">Q Report</button>
							<button type="button" id="cash_out_button" data-toggle="modal" data-target="#squarespaceModal">A Report</button>
						</div>
						<div class="text-center" id="cash_in_hidder"><a href="mod_operations.php"><button id="go_to_cash_out_button">GO TO CASH OUT</button></a></div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		
	</footer>
	<script src="..//js/bootstrap.min.js"></script>
	<!-- <script src="..//js/some_trial.js"></script> -->
</body>
</html>