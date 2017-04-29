<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overview</title>
	<link rel="stylesheet" type="text/css" href="..//css/bootstrap.min.css">
	<link href="..//bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="..//css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="..//css/style.css">
	<script src="..//js/jquery.min.js"></script>
</head>
<body>
<?php 
	if (!isset($_SESSION)) {
		session_start();
		if (@$_SESSION['login'] != "yes") {
			header("Location: ..//home.php");
			exit();
		}
		// include '..//controller.php';
	}
	include '..//controller.php';
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
						<li class="selector_line"><b><a href="#">Overview</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li><b><a href="alltransactions.php">All Transactions</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li><b><a href="operations.php">Operations</a></b></li>
					</div>
				</span>
			</ul>
		</div>
		<div class="row" class="main_body_bground">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<div class="container-fluid" id="overview_statistics_area">
					<h4 class="text-center">SUMMARY OF TODAY'S TRANSACTIONS</h4>
					<p class="text-center">
					<?php 
						$j = 0;
						if ($recent_stats) {
							echo "<table class='table table-bordered'>";
							echo "<tr>
									<td>SN</td>
									<td>TYPE</td>
									<td>DESCRIPTION</td>
									<td>AMOUNT</td>
								  </tr>";
								  for ($i=0; $i < sizeof($recent_stats); $i++) 
								  { 
								  	$j = $i + 1;
								  	echo "<tr>
											<td>".$j."</td>
											<td>".$recent_stats[$i]['type']."</td>
											<td>".$recent_stats[$i]['description']."</td>
											<td>".$recent_stats[$i]['amount']."</td>
											<td><span id='edit_glyphicon' class ='glyphicon glyphicon-pencil'></span><span id='remove_glyphicon' class ='align-center glyphicon glyphicon-remove'></span></td>
										  </tr>";
								  }
							echo "</table>";

						}
						else
						{
							echo "There are no recent transactions";
						}
					 ?>
					 </p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="container-fluid" id="cash_in_cash_out_form">
					<form class="form-vertical">
						<h5 class="text-center">Estimated Church Balance</h5>
						<h5 class="text-center"><b>
						<?php
						 	echo number_format($available_balance, 0);
						 ?> FCFA
						</b> (Available)</h5>
						<div class="form-group" id="cash_in_cash_out_buttons">
							<a href="operations.php"><button type="button" id="cash_in_button">Cash In</button></a>
							<a href="mod_operations.php"><button type="button" id="cash_out_button">Cash Out</button></a>
						</div>
					</form>
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