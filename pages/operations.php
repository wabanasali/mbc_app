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
   <script src="../js/custom_js.js">
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
			<a id="logout_label" href="..//controller.php?set_session=log_out"><b>LOGOUT</b></a>
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
								<input type="text" class="form-control" name="christian_id" id="christian_id"  required>
								<!-- onkeyup="fetch_name(this.value)" -->
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
						  <p id="testing"></p>
					</form>
				</div>
			<?php 
				//monthly report modal 
				include "sub_pages/monthly_modal.inc";
				//upload file modal
				include "sub_pages/upload_modal.inc";
				//annual report modal
				include "sub_pages/annual_modal.inc";
				//quater report modal
				include "sub_pages/quaterly_modal.inc";
			?>
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
							<button class="btn btn-default" type="button" id="cash_in_button" data-toggle="modal" data-target="#squarespaceModal2">Q Report</button>
							<button class="btn btn-default" type="button" id="cash_out_button" data-toggle="modal" data-target="#squarespaceModal">A Report</button>
						</div>
						<div class="text-center" id="cash_in_hidder">
							<a href="mod_operations.php">
							<button class="btn btn-default" id="go_to_cash_out_button">GO TO CASH OUT</button>
							</a>
						</div>
						<div class="text-center" id="">
							<a href="#squarespaceModal3" data-toggle="modal"><b>UPLOAD FILE</b></a>
							<b>|</b>
							<a href="#squarespaceModal4" data-toggle="modal"><b>MONTHLY_REPORT</b></a>
							<?php 
								if (isset($_GET['feedback'])) {
									echo "<br><b>NO DATA AVAILABLE</b>";
								}
							?>
						</div>
						<div>
							<?php
						  		if (isset($_GET['success_upload'])) {
						  			echo "<p class='text-center'><b>SUCCESSFULLY UPLOADED</b></p>";
						  		}
						  		elseif (isset($_GET['fail_upload'])) {
						  			echo "<p class='text-center'><b>!!UPLOAD UNSUCCESSFUL!!</b></p>";
						  		}
						  	?>
						</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		
	</footer>
	<script src="..//js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('input#christian_id').keyup(function(e){
			var christian_matricule = $('#christian_id').val();
			if (christian_matricule.length !== 0) {
				$.post('sp_controller1.php', {matricule:christian_matricule},function(data){
					$('#christian_name').val(data);
				});
			}
		});
	</script>
</body>
</html>