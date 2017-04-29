<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	include("model.php");
		function coordinate_login($sp_username, $sp_pswd){
			//this function handles the login procedure
			$result = login($sp_username, $sp_pswd);
			if ($result == 0) {
				header("Location: pages/overviewtransactions.php");
			}
			elseif ($result == 1) {
				header("Location: home.php?warning_message=w_msg");
			}
			else{
				//result can only be -1
				header("Location: home.php?error_message=e_msg");
			}
		}
		function coordinate_signup($f_name, $usr_name, $usr_pswd, $usr_conf_pswd){
			//this function handles the sign up procedure
			if (strcasecmp($usr_pswd, $usr_conf_pswd) == 0) {
				//passwords agree proceed
				$result1 = signup($f_name, $usr_name, $usr_pswd);
				if ($result1 == 0) {
					//sign up possible, notify user to proceed to login
					header("Location: home.php?success_message=s_message");
				}
				else{
					//sign up not possible, warn
					header("Location: home.php?fail_message=f1_message");
				}
			}
			else{
				//passwords do not agree, warn the user
				header("Location: home.php?missmatch_message=f2_message");
			}
		}
		function coordinate_logout(){
			//this function coordinates the logout procedure
			$_SESSION['login'] = "no";
			// $_SESSION['login_id'] = '';
			header("Location: home.php");
			exit();
		}

		function cash_in($selection, $christian_id, $christian_name, $amount, $comment){
			if ($selection == 'Tithes') {
				if (cash_in_tithes($christian_id, $amount) == 0) {
					//successful insertion
					header("Location:pages/operations.php");
				}
				else{
					//unsuccessful insertion
					header("Location:pages/operations.php");
				}		
			}
			elseif ($selection == 'Project') {
				if (cash_in_project($christian_id, $amount) == 0) {
					header("Location:pages/operations.php");	
				}
				else{
					header("Location:pages/operations.php");
				}
			}
			elseif ($selection == 'Harvest') {
				echo "You selected harvest";
				if (cash_in_htg($amount)) {
					header("Location:pages/operations.php");
				}
				else{
					header("Location:pages/operations.php");
				}
			}
			elseif ($selection == 'Offerings') {
				echo "You selected offerings";
				if (cash_in_offerings($amount)) {
					header("Location:pages/operations.php");
				}
				else
					header("Location:pages/operations.php");
			}
			else{
				if (cash_in_sp_offerings($amount, $comment)) {
					header("Location:pages/operations.php");
				}
				else
					header("Location:pages/operations.php");
			}
		}
		function cash_out($supplied_motif1, $supplied_executer_id, $supplied_executer_name, $supplied_executed_amount, $supplied_execution_comment){
			if ($supplied_motif1 == 'Pastor Salary') {
				if (cash_out_salary($supplied_executed_amount)) {
					header("Location:pages/operations.php");
				}
				else
					//i need an error message with it
					header("Location:pages/operations.php");
			}
			elseif ($supplied_motif1 == 'Project') {
				if (cash_out_project($supplied_executed_amount)) {
					header("Location:pages/operations.php");
				}
				else
					header("Location:pages/operations.php");
			}
			else{
				if (cash_out_others($supplied_executed_amount, $supplied_execution_comment)) {
					header("Location:pages/operations.php");
				}
				else
					header("Location:pages/operations.php");
			}
		}
		function available_balance()
		{
			return standing_balance();
		}
		function recent_statistics()
		{
			$stats_array = recent_transactions();
			$stats_data = array();
			 if($stats_array)
			 {
			 	foreach ($stats_array as $key => $value) 
			 	{
			 		if ($value != 0) {
			 			if (strcmp($key, "expenses") == 0) {
			 				array_push($stats_data, array('type' => 'CASH OUT', 'description' => 'EXPENDITURE', 'amount' => number_format($value)));
			 			}
			 			elseif (strcmp($key, "htg") == 0) {
			 				array_push($stats_data, array('type' => 'CASH IN', 'description' => 'HTG INCOME', 'amount' => number_format($value)));
			 			}
			 			elseif (strcmp($key, "otherOfferings") == 0) {
			 				array_push($stats_data, array('type' => 'CASH IN', 'description' => 'SPECIAL OFFERINGS', 'amount' => number_format($value)));
			 			}
			 			elseif (strcmp($key, "projects") == 0) {
			 				array_push($stats_data, array('type' => 'CASH IN', 'description' => 'PROJECT OFFERINGS', 'amount' => number_format($value)));
			 			}
			 			elseif (strcmp($key, "regularOfferings") == 0) {
			 				array_push($stats_data, array('type' => 'CASH IN', 'description' => 'REGULAR OFFERINGS', 'amount' => number_format($value)));
			 			}
			 			elseif (strcmp($key, "tithes") == 0) {
			 				array_push($stats_data, array('type' => 'CASH IN', 'description' => 'TITHE COLLECTIONS', 'amount' => number_format($value)));
			 			}
			 		}
			 		else
			 		{
			 			//do nothing
			 		}
			 	}
			 	return $stats_data;
			 }
			 else
			 {
			 	return null;
			 }
		}
		function grouped_statistics($from, $to)
		{
			return statistics_for_period($from, $to);
		}
	if (!isset($_GET['set_session'])) {
		//collect information from the login form
		if (isset($_GET['todo1'])) {
			//user is attempting login 
			$supplied_username = trim(strip_tags($_POST['username']));
			$supplied_password = trim(strip_tags($_POST['password']));
			echo "My supplied username is: ".$supplied_username." and my supplied password is: ".$supplied_password."<br>";
			coordinate_login($supplied_username, $supplied_password);
		}
		else if (isset($_GET['todo2'])) {
			//user is attempting sign up
			$supplied_fullname = trim(strip_tags($_POST['full_name']));
			$supplied_username = trim(strip_tags($_POST['su_username']));
			$supplied_password = trim(strip_tags($_POST['su_password']));
			$supplied_conf_password = trim(strip_tags($_POST['su_conf_password']));
			coordinate_signup($supplied_fullname, $supplied_username, $supplied_password, $supplied_conf_password);
		}
		//doing a cash in transaction
		else if (isset($_POST['todo3'])) {
			if ($_POST['todo3'] == 'cash_in') {
					$supplied_motif = trim(strip_tags($_POST['selection']));
					if (isset($_POST['christian_id'])) {
						$supplied_chrisian_id = trim(strip_tags($_POST['christian_id']));
					}
					else
						$supplied_chrisian_id = '';
					if (isset($_POST['christian_name'])) {
						$supplied_name = trim(strip_tags($_POST['christian_name']));
					}
					$supplied_name = '';
					$supplied_amount = trim(strip_tags($_POST['amount']));
					if (isset($_POST['comment'])) {
						$supplied_comment = trim(strip_tags($_POST['comment']));
					}
					else
						$supplied_comment = '';
				cash_in($supplied_motif, $supplied_chrisian_id, $supplied_name, $supplied_amount, $supplied_comment);
			}
		}
		else if (isset($_POST['todo4'])) {
			if ($_POST['todo4'] == 'cash_out') {
				$supplied_motif1 = trim(strip_tags($_POST['selection']));
				$supplied_executer_id = trim(strip_tags($_POST['executer_id']));
				$supplied_executer_name = trim(strip_tags($_POST['executer_name']));
				$supplied_executed_amount = trim(strip_tags($_POST['amount_executed']));
				if (isset($_POST['executer_comment'])) {
					$supplied_execution_comment = trim(strip_tags($_POST['executer_comment']));
				}
				else
					$supplied_execution_comment = '';
				cash_out($supplied_motif1, $supplied_executer_id, $supplied_executer_name, $supplied_executed_amount, $supplied_execution_comment);
			}
		}
		else{
			$available_balance = available_balance();
			$recent_stats = recent_statistics();	
		}
	}
	else{
		coordinate_logout();
	}
?>