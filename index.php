<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MBC Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<header id="header">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<img id="church_icon" src="images/churchicon.png" id="church_icon">
			<img id="church_logo" src="images/MBCMolyko.png" id="church_logo">
		</div>
		<div class="col-lg-6 col-md-6">
			    <span id="login_form">
			      <form class="form-inline" action="controller.php?todo1=log_in" method="POST">
						<div class="form-group">
						    <label class="sr-only" for="exampleInputEmail3">Username</label>
						    <input type="text" class="form-control" name="username" id="exampleInputEmail3" placeholder="Username" required>
						</div>
						<div class="form-group">
						    <label class="sr-only" for="exampleInputPassword3">Password</label>
						    <input type="password" class="form-control" name="password" id="exampleInputPassword3" placeholder="Password" required>
						</div>
						  <button type="submit" class="btn btn-success">Log In</button>
						<div id="login_notification">
							<?php
						  		if (isset($_GET['warning_message'])) {
						  			echo "<br>Username and Password Do Not Match";
						  		}
						  		elseif (isset($_GET['error_message'])) {
						  			echo "<br>No Such User Exists";
						  		}
						  		else{

						  		}
						?>
						</div>
					</form>
			    </span>
		</div>
	</header>
	<div class="row">
		<div class="row">
			<img id="mbc_background_picture" src="images/MacedoniaBackground1.jpg">
			<!--Just to get some space here-->
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				
			</div>
			<div id="registration_form" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div id="registration_form_body">
					<h4 class="text-center">Improve MBC Molyko's Record Keeping <br> Sign Up - Free</h4>
					<form role="form" action="controller.php?todo2=sign_up" method="POST">
					  <div class="form-group">	
					    <input type="text" class="form-control" id="exampleInputEmail1" name="full_name" placeholder="Full Name" required>
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control" id="exampleInputPassword1" name="su_username" placeholder="Userame" required>
					  </div>
					   <div class="form-group">
					    <input type="password" class="form-control" id="password" name="su_password" placeholder="Password" required>
					  </div>
					  <div class="form-group">
					    <input type="password" class="form-control" id="confirm_password" name="su_conf_password" placeholder=" Confirm Password" required><span id="pswd_msg"></span>
					    <script type="text/javascript">
					    	$('#confirm_password').on('keyup', function () {
							    if ($(this).val() == $('#password').val()) {
							        $('#pswd_msg').html('passwords match').css('color', 'blue');
							    } else $('#pswd_msg').html('passwords do not match').css('color', 'red');
							});
					    </script>
					  </div>
					   <div class="checkbox">
					    <label>
					      <input type="checkbox" name="su_agree" required> <b>I agree to MBC Molyko's Terms</b>
					    </label>
					  </div>
					  <button type="submit" class="btn btn-primary" id="exampleInputButton1">Sign Up</button>
					  <div id="signup_notification">
					  		<?php 
					  		//do something
					  			if (isset($_GET['success_message'])) {
					  				echo "<br>Congrats! You can now log in with your newly acquired credentials";
					  			}
					  			elseif (isset($_GET['fail_message'])) {
					  				echo "<br>Sorry! This username already exists. Choose another one";
					  			}
					  			elseif(isset($_GET['missmatch_message'])){
					  				echo "<br>Eish! Passwords do not match";
					  			}
					  			else{

					  			}
					  		?>
					  </div>
					</form>
				</div>
			</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
		</div>
	</div>
	<footer>
		<div class="row">
			<div class="row">
				<!-- <p>I am in the footer</p> -->
			</div>
		</div>
	</footer>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>