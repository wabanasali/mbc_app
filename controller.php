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
		function coordinate_qreport_download(){
			header("Location: quater_report.php");
		}
		function cash_in($selection, $christian_id, $christian_name, $amount, $comment){
			if ($selection == 'Tithes') {
				if (cash_in_tithes($christian_id, $amount) == 0) {
					//successful insertion
					header("Location:pages/operations.php?success_notification=sucess");
				}
				else{
					//unsuccessful insertion
					header("Location:pages/operations.phpsuccess_notification=fail");
				}		
			}
			elseif ($selection == 'Project') {
				if (cash_in_project($christian_id, $amount) == 0) {
					header("Location:pages/operations.php?success_notification=sucess");	
				}
				else{
					header("Location:pages/operations.php?success_notification=fail");
				}
			}
			elseif ($selection == 'Harvest') {
				// echo "You selected harvest";
				if (cash_in_htg($amount) == 0) {
					header("Location:pages/operations.php?success_notification=sucess");
				}
				else{
					header("Location:pages/operations.php?success_notification=fail");
				}
			}
			elseif ($selection == 'Offerings') {
				// echo "You selected offerings";
				if (cash_in_offerings($amount) == 0) {
					header("Location:pages/operations.php?success_notification=sucess");
				}
				else
					header("Location:pages/operations.php?fail_notification=fail");
			}
			elseif ($selection == 'Others') {
				if (cash_in_sp_offerings($amount, $comment) == 0) {
					header("Location:pages/operations.php?success_notification=sucess");
				}
				else
					var_dump("I am here now");
					header("Location:pages/operations.php?fail_notification=fail");
			}
			else{

			}
		}
		function cash_out($supplied_motif1, $supplied_executer_id, $supplied_executer_name, $supplied_executed_amount, $supplied_execution_comment){
			if ($supplied_motif1 == 'Pastor Salary') {
				if (cash_out_salary($supplied_executed_amount) == 0) {
					header("Location:pages/mod_operations.php?success_notification=sucess");
				}
				else
					//i need an error message with it
					header("Location:pages/mod_operations.php?fail_notification=fail1");
			}
			elseif ($supplied_motif1 == 'Project') {
				if (cash_out_project($supplied_executed_amount) == 0) {
					header("Location:pages/mod_operations.php?success_notification=sucess");
				}
				else
					header("Location:pages/mod_operations.php?fail_notification=fail2");
			}
			else{
				if (cash_out_others($supplied_executed_amount, $supplied_execution_comment) == 0) {
					header("Location:pages/mod_operations.php?success_notification=sucess");
				}
				else
					header("Location:pages/mod_operations.php?fail_notification=fail3");
			}
		}
		
		function available_balance()
		{
			return standing_balance();
		}
		
		function current_day_transactions(){
			return day_transactions();
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
					$supplied_amount = trim(strip_tags($_POST['amount']));
					if (isset($_POST['christian_id'])) {
						$supplied_chrisian_id = trim(strip_tags($_POST['christian_id']));
					}
					else
						$supplied_chrisian_id = '';
					if (isset($_POST['christian_name'])) {
						$supplied_name = trim(strip_tags($_POST['christian_name']));
					}
					else
						$supplied_name = '';
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
		elseif (isset($_POST['qreport'])) {
			# check if it is current year or an already past year, cause printing and redirect to operations page
			if ($_POST['qreport'] == 'quater_report') {
				$supplied_year = trim(strip_tags($_POST['selected_fin_yr_id2']));
				$supplied_quater = trim(strip_tags($_POST['selected_quater']));
				if ($supplied_quater == 0) {
					header("Location: quater_report.php");
				}
				else{
					header("Location: quater_report.php");
				}
				// echo "Wonder ful palava";
			}
		}
		elseif (isset($_POST['areport'])) {
			# check if it is current year or an already past year, cause printing and redirect to operations page
			$supplied_year = trim(strip_tags($_POST['selected_fin_yr_id']));
			header("Location: mc_quater_report.php");
		}
		elseif (isset($_POST['update_item'])) {
			#get values to use for update
			$supplied_tablename = trim(strip_tags($_POST['tableName']));
			$supplied_id = trim(strip_tags($_POST['entryId']));
			$supplied_new_amount = trim(strip_tags($_POST['new_amount']));
			if (modify_record($supplied_tablename, $supplied_new_amount, $supplied_id) == 0) {
				header("Location: pages/overviewtransactions.php?success_update");
			}
			else{
				header("Location: pages/overviewtransactions.php?fail_update");
			}
		}
		elseif (isset($_POST['delete_item'])) {
			$supplied_tablename = trim(strip_tags($_POST['tableName2']));
			$supplied_id = trim(strip_tags($_POST['entryId2']));
			if (delete_record($supplied_tablename, $supplied_id) == 0) {
				header("Location: pages/overviewtransactions.php?success_delete");
			}
			else{
				header("Location: pages/overviewtransactions.php?fail_delete");
			}
		}
		else{
			$available_balance = available_balance();	
		}
	}
	else{
		coordinate_logout();
	}
?>