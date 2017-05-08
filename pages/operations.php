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
	<link href="..//bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
		function hideCashIn(){
			// alert('You are now going to hide Cash in Form');
			//add hidden attribute to cashin form & add hidden attribute to cashout link
			document.getElementById('cash_in_rectangle').setAttribute('hidden', 'true');
			document.getElementById('cash_in_hidder').setAttribute('hidden', 'true');
			//remove hidden attribute from cash out form & remove hidden attribute from cash in linkd
			document.getElementById('cash_out_rectangle').removeAttribute('hidden');
			document.getElementById('cash_out_hidder').removeAttribute('hidden');

		}
		function hideCashOut(){
			// alert('You are now going to hide Cash out Form');
			//add hidden attribute to cash out form & add hidden attribute to cash in link
			document.getElementById('cash_out_rectangle').setAttribute('hidden', 'true');
			document.getElementById('cash_out_hidder').setAttribute('hidden', 'true');
			//remove hidden attribute from cash in form & remove hidden attribute from cash out link
			document.getElementById('cash_in_rectangle').removeAttribute('hidden');
			document.getElementById('cash_in_hidder').removeAttribute('hidden');
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
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="cash_out_rectangle" hidden="">
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
						</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="container-fluid" id="cash_in_cash_out_form">
					<form class="form-vertical">
						<h5 class="text-center">Estimated Church Balance</h5>
						<h5 class="text-center"><b>
						<?php
						// format available balance with commas.
						 	echo number_format($available_balance, 0);
						 ?> FCFA
						</b> (Available)</h5>
						<div class="form-group" id="cash_in_cash_out_buttons">
							<button type="button" id="cash_in_button" onclick="download_qreport();">Q Report</button>
							<button type="button" id="cash_out_button" onclick="alert('Generating annual report');">A Report</button>
						</div>
						<div class="text-center" id="cash_in_hidder"><a href="#" onclick="hideCashIn()">GO TO CASH OUT</a></div>
						<div class="text-center" id="cash_out_hidder" hidden><a href="#" onclick="hideCashOut()">GO TO CASH IN</a></div>
					</form>
				</div>
			</div>
		</div>
<!-- 		<div class="row main_body_bground">

			<div class="main_body_bground">
				<a href=""><span class="glyphicon glyphicon-arrow-up"></span></a>
			</div>
		</div> -->
	</div>
	
	<footer>
		
	</footer>
	<script src="..//js/bootstrap.min.js"></script>
	<!-- <script src="..//js/some_trial.js"></script> -->
</body>
</html>