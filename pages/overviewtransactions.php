<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overview</title>
    <
    <link rel="stylesheet" type="text/css" href="..//css/bootstrap.min.css">
	<link rel="stylesheet" href="..//css/style.css">
	<script src="..//js/jquery.min.js"></script>
    <script type="text/javascript">
    	function edit_entry(){
    		alert('You are going to edit an entry');
    	}
    	$(document).on("click", ".open-AddBookDialog", function () {
	     var myId = $(this).data('id');
	     var myId2 = $(this).data('id2');
	     var myTable = $(this).data('db_table');
	     var myTable2 = $(this).data('db_table2');
	     var myAmount = $(this).data('amount');
	     var myAmount2 = $(this).data('amount2');
	     var myPurpose = $(this).data('purpose');
	     var myPurpose2 = $(this).data('purpose2');
	     $(".modal-body #entryId").val( myId );
	     $(".modal-body #entryId2").val( myId2 );
	     $(".modal-body #tableNameId").val(myTable);
	     $(".modal-body #tableNameId2").val(myTable2);
	     $(".modal-body #amountId").val(myAmount);
	     $(".modal-body #amountId2").val(myAmount2);
	     $(".modal-body #purposeId").val(myPurpose);
	     $(".modal-body #purposeId2").val(myPurpose2);
	     var messageText = 'You are about to modify the entry => '+myPurpose;
	     var messageText2 = 'You are now goint to delete the entry => '+myPurpose2;
	     $(".modal-body #notification").html(messageText.toUpperCase());
	     $(".modal-body #notification2").html(messageText2.toUpperCase());
		});
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
		// include '..//controller.php';
	}
	include '..//controller.php';
	// include '..//model.php';
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
						$today_statistics = current_day_transactions();
						$j = 0;
						if ($today_statistics) {
							echo "<table class='table table-bordered'>";
							echo "<tr>
									<td>SN</td>
									<td>TYPE</td>
									<td>DESCRIPTION</td>
									<td>AMOUNT</td>
								  </tr>";
								  for ($i=0; $i < sizeof($today_statistics); $i++) 
								  { 
								  	$j = $i + 1;
								  	$data_id = $today_statistics[$i]['id'];
								  	$data_table = $today_statistics[$i]['db_table'];
								  	$data_amount = $today_statistics[$i]['amount'];
								  	$data_purpose = $today_statistics[$i]['description'];
								  	echo "<tr>
											<td>".$j."</td>
											<td>".$today_statistics[$i]['type_of_operation']."</td>
											<td>".$today_statistics[$i]['description']."</td>
											<td id='targetted_amount'>".$today_statistics[$i]['amount']."</td>
											<td hidden id='targetted_table'>".$today_statistics[$i]['db_table']."</td>
											<td hidden id='targetted_id'>".$today_statistics[$i]['id']."</td>
											<td>
											<a href='#squarespaceModal' data-toggle='modal' class='open-AddBookDialog' data-id='$data_id' data-db_table='$data_table' data-amount='$data_amount' data-purpose='$data_purpose'><img src='..//images/edit_icon.png'>EDIT</a>
											<a href='#squarespaceModal2' data-toggle='modal' class='open-AddBookDialog' data-id2='$data_id' data-db_table2='$data_table' data-amount2='$data_amount' data-purpose2='$data_purpose'><img src='..//images/delete_icon.png'>DELETE</a></td>
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
					 <div id="successful_update">
						  		<?php
						  			if (isset($_GET['success_update'])) {
						  				echo "<p class='text-center'><b>YOUR UPDATE WAS SUCCESSFUL</b></p>";
						  			}
						  			elseif (isset($_GET['fail_update'])) {
						  				echo "<p class='text-center'><b>!!UPDATE UNSUCCESSFUL!!</b></p>";
						  			}
						  		?>
					</div>
					 <div id="successful_delete">
						  		<?php
						  			if (isset($_GET['success_delete'])) {
						  				echo "<p class='text-center'><b>DELETE OPERATION WAS SUCCESSFUL</b></p>";
						  			}
						  			elseif (isset($_GET['fail_delete'])) {
						  				echo "<p class='text-center'><b>!!DELETE OPERATION UNSUCCESSFUL!!</b></p>";
						  			}
						  		?>
					</div>
				</div>
				<!-- a tag that fires to get modal -->
				<!-- <a href="#squarespaceModal" data-toggle="modal" data-id="ISBN-001122" data-title="Add this item" class="open-AddBookDialog">UPDATE?</a> -->

				<!-- update modal start -->
				<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  		<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">×</span>
									<span class="sr-only">Close</span>
								</button>
								<h3 class="modal-title text-center" id="lineModalLabel">MODIFY ENTRY FORM</h3>
							</div>
							<div class="modal-body">
								<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
								<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
								<form class="form-horizontal" action="../controller.php?update_item=update_item_value" role="form" method="POST">
									<input type="hidden" name="update_item" value="update_item_value"/>
									<div class="form-group">
										<p class="text-center edit_data_notification" id="notification">
											PLEASE ENTER THE CORRECTED AMOUNT FOR MODIFICATION
										</p>
										<!-- <div class="form-group">
											<label for="book" class="col-sm-4 control-label sr-only">PURPOSE</label>
											<div class="col-sm-8">
												<input type="text" name="purpose" id="purposeId" readonly="" value=""/>	
											</div>
										</div> -->
										<div class="form-group">
											<label for="book" class="col-sm-4 control-label">CURRENT AMOUNT</label>
											<div class="col-sm-6">
												<input type="text" name="amount" id="amountId" value="" readonly>	
											</div>
										</div>
										<div class="form-group">
											<label for="book" class="col-sm-4 control-label">CORRECTED AMOUNT</label>
											<div class="col-sm-6">
												<input type="text" name="new_amount" id="newAmountId" value="" required>	
											</div>
										</div>
										<div class="form-group" hidden>
											<label for="book-title" class="col-sm-4 control-label">Table Name</label>
											<div class="col-sm-6">
												<input type="text" name="tableName" id="tableNameId" value=""/>	
											</div>
										</div>
										<div class="form-group" hidden>
											<label for="book-title" class="col-sm-4 control-label">Entry ID</label>
											<div class="col-sm-6">
												<input type="text" name="entryId" id="entryId" value=""/>	
											</div>
										</div>
									</div>
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group btn-delete hidden" role="group">
											<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group" role="group" disabled>
											<button type="submit" id="saveImage" class="btn btn-primary btn-hover-green" data-action="save" role="button">Modify</button>
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
				<!-- update modal end -->
				<!-- start of delete modal -->
				<div class="modal fade" id="squarespaceModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  		<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">×</span>
									<span class="sr-only">Close</span>
								</button>
								<h3 class="modal-title text-center" id="lineModalLabel">DELETE ENTRY FORM</h3>
							</div>
							<div class="modal-body">
								<img id="church_icon" src="..//images/churchicon.png" id="church_icon">
								<img id="church_logo" src="..//images/MBCMolyko.png" id="church_logo">
								<form class="form-horizontal" action="../controller.php?delete_item=delete_item_value" role="form" method="POST">
									<input type="hidden" name="delete_item" value="delete_item_value"/>
									<div class="form-group">
										<p class="text-center edit_data_notification" id="notification2">
											YOU ARE ABOUT TO DELETE AN ENTRY
										</p>
										<div class="form-group">
											<label for="book" class="col-sm-4 control-label">CURRENT AMOUNT</label>
											<div class="col-sm-6">
												<input type="text" name="amount2" id="amountId2" value="" readonly>	
											</div>
										</div>
										<div class="form-group" hidden>
											<label for="book" class="col-sm-4 control-label">CORRECTED AMOUNT</label>
											<div class="col-sm-6">
												<input type="text" name="new_amount2" id="newAmountId2" value="">	
											</div>
										</div>
										<div class="form-group" hidden>
											<label for="book-title" class="col-sm-4 control-label">Table Name</label>
											<div class="col-sm-6">
												<input type="text" name="tableName2" id="tableNameId2" value=""/>	
											</div>
										</div>
										<div class="form-group" hidden>
											<label for="book-title" class="col-sm-4 control-label">Entry ID</label>
											<div class="col-sm-6">
												<input type="text" name="entryId2" id="entryId2" value=""/>	
											</div>
										</div>
									</div>
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group btn-delete hidden" role="group">
											<button type="button" id="delImage2" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Close</button>
										</div>
										<div class="btn-group" role="group">
											<button type="submit" id="saveImage2" class="btn btn-primary btn-hover-green" data-action="save" role="button">Delete</button>
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
				<!-- end of delete modal -->
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
							<a href="operations.php"><button class="btn btn-default" type="button" id="cash_in_button">Cash In</button></a>
							<a href="mod_operations.php"><button class="btn btn-default" type="button" id="cash_out_button">Cash Out</button></a>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<footer>
		
	</footer>
	<script src="..//js/bootstrap.min.js"></script>
</body>
</html>