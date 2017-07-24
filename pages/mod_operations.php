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
								<label for="motif_out" class="col-sm-2 control-label">Motif</label>
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
									<input type="text" class="form-control" name="executer_id" id="christian_id1" required>
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
			<?php 
				//monthly report modal 
				include "sub_pages/monthly_modal.inc";
				//monthly report2 modal
				include "sub_pages/monthly_modal2.inc";
				//upload file modal
				include "sub_pages/upload_modal.inc";
				//quater report modal
				include "sub_pages/quaterly_modal.inc";
				//quater report 2 modal
				include "sub_pages/quaterly_modal2.inc";
			?>
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
							<button class="btn btn-default" type="button" id="cash_in_button" data-toggle="modal" data-target="#squarespaceModal2"><b>Q Report 1</b></button>
							<button class="btn btn-default" type="button" id="cash_out_button" data-toggle="modal" data-target="#squarespaceModal6"><b>Q Report 2</b></button>
						</div>
							<div class="text-center" id="cash_out_hidder"><a href="operations.php"><button class="btn btn-default" id="go_to_cash_in_button"><b>GO TO CASH IN</b></button>
								</a>
							</div>
							<div class="text-center" id="">
							<br/>
								<a href="#squarespaceModal7" data-toggle="modal"><b>M_RPT1 </b></a><b>|</b>
								<a href="#squarespaceModal3" data-toggle="modal"><b>UPLOAD FILE</b></a>
								<b>|</b>
								<a href="#squarespaceModal4" data-toggle="modal"><b>M_RPT2</b></a>
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
		$('input#christian_id1').keyup(function(e){
			var christian_matricule = $('#christian_id1').val();
			if (christian_matricule.length !== 0) {
				$.post('sp_controller1.php', {matricule:christian_matricule},function(data){
					$('#christian_name1').val(data);
				});
			}
		});
	</script>
</body>
</html>