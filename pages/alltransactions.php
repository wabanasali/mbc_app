<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transactions</title>
	<link rel="stylesheet" type="text/css" href="..//css/bootstrap.min.css">
	<link href="..//bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="..//css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="..//css/style.css">
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
						<li><b><a href="overviewtransactions.php">Overview</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li class="selector_line"><b><a href="#">All Transactions</a></b></li>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<li><b><a href="operations.php">Operations</a></b></li>
					</div>
				</span>
			</ul>
		</div>
		<div class="row" id="from_to_form_bkground">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="container" id="container_of_form">
					    <!-- <form class="form-inline"  role="form"> -->
								<div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12 form-group">
					                <label for="dtp_input2" class="sr-only control-label margin_from_menu" id="from_label">FROM</label>
					                <div class="input-group date form_date margin_from_menu2" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
					                    <input class="form-control" size="60" type="text" name="from_date" id="from_date" placeholder="FROM DATE">
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					                </div>
					            </div>
					            <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12form-group">
					                <label for="dtp_input2" class=" sr-only control-label margin_from_menu" id="to_label">TO</label>
					                <div class="input-group date form_date  margin_from_menu2" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" id="custom_to_date">
					                    <input class="form-control" size="60" type="text" id="to_date" name="to_date" value="" placeholder="TO DATE">
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					                </div>
					            </div>
					            <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-12 form-group">
					            	<button type="submit" class="btn btn-primary" id="go_button">GO</button>
					            </div>
					            <div id="notification"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<input type="text" id="test" value="" name="test" hidden>
				<div class="container-fluid" id="overview_statistics_area">
					<h4 class="text-center">SUMMARY OF TRANSACTIONS</h4>
					<p id="default_text" class="text-center">Set a period to view summary statistics</p>
					<div id="show_table" hidden>
						<table class="table table-bordered">
							<tr id="period_statistics">
								<th>SN</td>
								<th>TYPE</td>
								<th>DESCRIPTION</td>
								<th>AMOUNT</td>
								<th>DATE</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="container-fluid" id="cash_in_cash_out_form">
					<form class="form-vertical">
						<h5 class="text-center">Estimated Church Balance</h5>
						<h5 class="text-center"><b>
						<?php
						 	echo number_format($available_balance, 0);
						 ?> 	FCFA
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
	<!-- <script type="text/javascript" src="..//jquery/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
	<script type="text/javascript" src="..//js/jquery.min.js"></script>
	<script type="text/javascript" src="..//bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="..//js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="..//js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
	<script type="text/javascript">
		
		$(function(){
			$('button#go_button').click(function(e){
				var frm = $('#from_date').val();
				var to = $('#to_date').val();
				if (frm.length !=0 && to.length != 0) {
					// alert('Now getting ready to send query');
					$.post('sp_controller2.php',{fromDate : frm, toDate: to}, function(data){
						document.getElementById('show_table').removeAttribute('hidden');
						document.getElementById('default_text').setAttribute('hidden', 'true');
						$('#period_statistics').after(data);
					});
				}
				else{
					$('#notification').html('2 dates are required!');	
					$('#notification').css('color','red');
				}
			});
		});
		//some call back to write to file
	    $('.form_datetime').datetimepicker({
	        //language:  'fr',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	        showMeridian: 1
	    });
		$('.form_date').datetimepicker({
	        language:  'en',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
	    });
		$('.form_time').datetimepicker({
	        language:  'en',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			forceParse: 0
	    });
	</script>
	<script type="text/javascript">
	</script>
</body>
</html>