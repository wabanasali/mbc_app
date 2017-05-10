<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	$connection = mysql_connect("localhost", "root", "");
	if(!$connection){
		die('Could not connect: ' . mysql_error());
	}
	else{
		// select given database
		$db = mysql_select_db('mbc')
		or die('could not select database');
	}
	function connect_to_db(){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
	}
	function login($username, $password){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
		$hash_pswd = hash('md5', $password);
		$query = "SELECT * FROM  users WHERE username = '$username'";
		$result = mysql_query($query) or die('could not execute query');
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			// username exists
			$query1 = "SELECT * FROM  users WHERE username = '$username' AND password = '$hash_pswd'";
			$result1 = mysql_query($query1);
			$users = mysql_fetch_array($result1);
			$rows1 = mysql_num_rows($result1);
			if ($rows1 == 1) {
				//login is successful
				$query2 = "SELECT id FROM users WHERE username = '$username' AND password = '$hash_pswd'";
				$result2 = mysql_query($query2);
				$login_ids = mysql_fetch_array($result2);
				$_SESSION['login'] = "yes";
				$_SESSION['login_id']=$users['id'];
				return 0;
			}
			else{
				// username and password do not match
				return 1;
			}
		}
		else{
			// username does not exist
			return -1;
		}
	}
	function signup($fullname, $username, $password){
		//check if username already exists on table before adding
		$created_on = date('d/m/Y');
		//date('Y-m-d H:i:s')
		$hash_pswd = hash('md5', $password);
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
		$query = "SELECT * FROM  users WHERE username = '$username'";
		$result = mysql_query($query) or die('could not execute select query');
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			// username already exist in the database
			return -1;
		}
		else{
			// username does not exist in the database and is thus available for use
			$query1 = "INSERT INTO users (username, password, created_on, full_name) VALUES ('$username', '$hash_pswd', '$created_on', '$fullname')";
			mysql_query($query1) or die('could not execute insert query');
			return 0;
		}
	}

	function christian($christian_id){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
		$query = "SELECT * FROM christians WHERE matricule = '$christian_id'";
		$result = mysql_query($query) or die('could not execute select query');
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			$christian = mysql_fetch_array($result);
			return $christian['name'];
		}
		else
			return 'no such matricule';
	}
	function cash_in_tithes($christian_id, $amount){
		//fetch christian id using christian_id/matricule
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
		$paid_on = date('Y-m-d H:i:s');
		//select id for current year
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$query = "SELECT id FROM christians WHERE matricule = '$christian_id'";
		$result = mysql_query($query) or die('could not execute select query');
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			$c_id_ary = mysql_fetch_array($result);
			$c_id = $c_id_ary['id'];
			$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
			$f_year_id = $f_y_id_array['f_year_id'];
			//year must be current
			$query1 = "INSERT INTO tithes (amount, paid_on, c_id, f_year_id) VALUES ('$amount', '$paid_on', '$c_id', '$f_year_id')";
			mysql_query($query1) or die('could not execute insert tithe for current year query');
			return 0;
		}
		else{
			return -1;
		}
	}
	function cash_in_project($christian_id, $amount){
		connect_to_db();
		$collected_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$query = "SELECT id FROM christians WHERE matricule = '$christian_id'";
		$result = mysql_query($query) or die('could not execute select query');
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			$c_id_ary = mysql_fetch_array($result);
			$c_id = $c_id_ary['id'];
			$u_id = $_SESSION['login_id'];
			$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
			$f_year_id = $f_y_id_array['f_year_id'];
			//year must be current
			$query1 = "INSERT INTO project_offerings (amount, collected_on, c_id, u_id, f_year_id) VALUES ('$amount', '$collected_on', '$c_id', '$u_id', '$f_year_id')";
			mysql_query($query1) or die('could not execute insert query no login_id or no current year');
			return 0;
		}
	}
	function cash_in_htg($amount){
		connect_to_db();
		$collected_on = date('Y-m-d H:i:s');
		$u_id = $_SESSION['login_id'];
		//year must be current
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$query = "INSERT INTO htg_offerings (amount, collected_on, u_id, f_year_id) VALUES ('$amount', '$collected_on', '$u_id', '$f_year_id')";
		mysql_query($query) or die('could not insert into the htg_offerings table');
	}
	function cash_in_offerings($amount){
		connect_to_db();
		$collected_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$u_id = $_SESSION['login_id'];
		//year must be current
		$query = "INSERT INTO regular_offerings (amount, collected_on, u_id, f_year_id) VALUES ('$amount', '$collected_on', '$u_id', '$f_year_id')";
		mysql_query($query) or die('could not insert into the regular_offerings table');
	}
	function cash_in_sp_offerings($amount, $comment){
		connect_to_db();
		$collected_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$u_id = $_SESSION['login_id'];
		//year must be current
		$query = "INSERT INTO other_offerings (amount, collected_on, purpose, u_id, f_year_id) VALUES ('$amount', '$collected_on', '$comment','$u_id', '$f_year_id')";
		mysql_query($query) or die('could not insert into the regular_offerings table');
	}
	//cash out operations
	function cash_out_salary($amount){
		connect_to_db();
		$purpose = 'pastors salary for the month';
		$withdrawn_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$u_id = $_SESSION['login_id'];
		//year must be current
		$query = "INSERT INTO expenses (amount, purpose, withdrawn_on, u_id, f_year_id) VALUES ('$amount', '$purpose', '$withdrawn_on', '$u_id', '$f_year_id')";
		mysql_query($query) or die('could not commit pastors salary in the expenses table');
	}
	function cash_out_project($amount){
		connect_to_db();
		$purpose = 'expenses on project';
		$withdrawn_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$u_id = $_SESSION['login_id'];
		//year must be current
		$query = "INSERT INTO expenses (amount, purpose, withdrawn_on, u_id, f_year_id) VALUES ('$amount', '$purpose', '$withdrawn_on', '$u_id', '$f_year_id')";
		mysql_query($query) or die('could not commit project expenses in the expenses table');
	}
	function cash_out_others($amount, $purpose){
		connect_to_db();
		$withdrawn_on = date('Y-m-d H:i:s');
		$current_year = intval(date('Y'));
		$f_y_id_qry = "SELECT f_year_id FROM financial_year WHERE f_year = '$current_year'";
		$f_year_id_rslt = mysql_query($f_y_id_qry)or die('nothing was returned');
		$f_y_id_array = mysql_fetch_array($f_year_id_rslt);
		$f_year_id = $f_y_id_array['f_year_id'];
		$u_id = $_SESSION['login_id'];
		//year must be current
		$query = "INSERT INTO expenses (amount, purpose, withdrawn_on, u_id, f_year_id) VALUES ('$amount', '$purpose', '$withdrawn_on', '$u_id', '$f_year_id')";
		mysql_query($query) or die('could not commit other expenses in the expenses table');
	}
	//totals
	function total_project_offerings(){
		connect_to_db();
		$query = "SELECT amount FROM project_offerings";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_project_off = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_project_off += $row['amount'];
			}
			return $total_project_off;
		}
		else{
			return $total_amount;
		}
	}
	function total_regular_offerings(){
		connect_to_db();
		$query = "SELECT amount FROM regular_offerings";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_amount = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_amount += $row['amount'];
			}
			return $total_amount;
		}
		else{
			return $total_amount;
		}
	}
	function total_htg_offerings(){
		connect_to_db();
		$query = "SELECT amount FROM htg_offerings";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_amount = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_amount += $row['amount'];
			}
			return $total_amount;
		}
		else{
			return $total_amount;
		}
	}
	function total_other_offerings(){
		connect_to_db();
		$query = "SELECT amount FROM other_offerings";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_amount = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_amount += $row['amount'];
			}
			return $total_amount;
		}
		else{
			return $total_amount;
		}
	}
	function total_tithes(){
		connect_to_db();
		$query = "SELECT amount FROM tithes";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_tithes = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_tithes += $row['amount'];
			}
			return $total_tithes;
		}
		else{
			return $total_tithes;
		}
	}
	function cash_in_till_date(){
		//number of rows empty means no cash in yet
		return total_other_offerings() + total_htg_offerings() + total_regular_offerings() + total_project_offerings() + total_tithes();
	}
	function cash_out_till_date(){
		//number of rows empty means no cash out yet
		connect_to_db();
		$query = "SELECT amount FROM expenses";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		$total_amount = 0;
		if ($nbr_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$total_amount += $row['amount'];
			}
			return $total_amount;
		}
		else{
			return $total_amount;
		}
	}
	//always check standing balance before cashing out
	function standing_balance(){
		return cash_in_till_date() - cash_out_till_date();
	}
	//Report queries from here on
	//checking for recent transactions to show; according to date, show SN, Type, motive(grouped), amount involved
	function recent_transactions(){
		connect_to_db();
		$today_date = date('Y-m-d H:i:s');
		$total_count = 0;
		$expenses = 0;
		$htg = 0;
		$otherOfferings = 0;
		$projects = 0;
		$regularOfferings = 0;
		$tithes = 0;
		$dayStatistics = array("expenses" => $expenses, "htg" => $htg, "otherOfferings" => $otherOfferings, "projects" => $projects, "regularOfferings" => $regularOfferings, "tithes" => $tithes);
		//for current year
		$query = "SELECT * FROM daystatistics1";
		$result = mysql_query($query);
		$nbr_rows = mysql_num_rows($result);
		if ($nbr_rows == 1)
		 {
			$row = mysql_fetch_array($result);
			if (isset($row[0])) {
				$dayStatistics['expenses'] = $row[0];
			}
			if (isset($row[1])) {
				$dayStatistics['htg'] = $row[1];
			}
			if (isset($row[2])) {
				$dayStatistics['otherOfferings'] = $row[2];
			}
			if (isset($row[3])) {
				$dayStatistics['projects'] = $row[3];
			}
			if (isset($row[4])) {
				$dayStatistics['regularOfferings'] = $row[4];
			}
			if (isset($row[5])) {
				$dayStatistics['tithes'] = $row[5];
			}
			return $dayStatistics;
		}
	}
	//pending problem is that of getting the totals as per the dates
	function statistics_for_period($start_date, $end_date)
	{
		connect_to_db();
		$amount = 0;
		$description = '';
		$day_of_operation = '';
		$type_of_operation = '';
		$statistics_mult_array = array();
		$statistics_ass_array = array('amount' => $amount, 'description' => $description, 'day_of_operation' => $day_of_operation, 'type_of_operation' => $type_of_operation);
		// $exp_query = "SELECT amount, withdrawn_on, purpose FROM expenses WHERE withdrawn_on BETWEEN '$start_date' AND '$end_date'";
		$exp_query = "SELECT amount, withdrawn_on, purpose FROM expenses WHERE date_format(withdrawn_on,'%Y-%m-%d') > '$start_date' AND date_format(withdrawn_on,'%Y-%m-%d') <'$end_date'";
		$exp_result = mysql_query($exp_query);
		$exp_rows = mysql_num_rows($exp_result);
		if ($exp_rows > 0) {
			while ($exp_row_data = mysql_fetch_array($exp_result)) {
				$statistics_ass_array['amount'] = number_format($exp_row_data['amount']);
				$statistics_ass_array['description'] = $exp_row_data['purpose'];
				$statistics_ass_array['day_of_operation'] = date_format(date_create($exp_row_data['withdrawn_on']),'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH OUT';
				//compare date to previous if so add else 
				array_push($statistics_mult_array, $statistics_ass_array);
			}	
		}
		// $tithes_query = "SELECT sum(amount) AS amount, paid_on FROM tithes WHERE paid_on BETWEEN '$start_date' AND '$end_date' GROUP BY paid_on";
		$tithes_query = "SELECT sum(amount) AS amount, paid_on FROM tithes WHERE date_format(paid_on, '%Y-%m-%d') > '$start_date' AND date_format(paid_on, '%Y-%m-%d') <'$end_date' GROUP BY paid_on";
		$tithes_result = mysql_query($tithes_query);
		$tithes_rows = mysql_num_rows($tithes_result);
		if ($tithes_rows > 0) {
			while ($tithes_row_data = mysql_fetch_array($tithes_result)) {
				$statistics_ass_array['amount'] = number_format($tithes_row_data['amount']);
				$statistics_ass_array['description'] = 'Total tithes for Sunday '.date_format(date_create($tithes_row_data['paid_on']),'Y-m-d');
				$statistics_ass_array['day_of_operation'] = date_format(date_create($tithes_row_data['paid_on']), 'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH IN';
				array_push($statistics_mult_array, $statistics_ass_array);
			}
		}
		// $htg_query = "SELECT sum(amount) AS amount, collected_on FROM htg_offerings WHERE collected_on BETWEEN '$start_date' AND '$end_date' GROUP BY collected_on";
		$htg_query = "SELECT sum(amount) AS amount, collected_on FROM htg_offerings WHERE date_format(collected_on, '%Y-%m-%d') >  '$start_date' AND date_format(collected_on, '%Y-%m-%d') <'$end_date' GROUP BY collected_on";
		$htg_result = mysql_query($htg_query);
		$htg_rows = mysql_num_rows($htg_result);
		if ($htg_rows > 0) {
			while ($htg_row_data = mysql_fetch_array($htg_result)) {
				$statistics_ass_array['amount'] = number_format($htg_row_data['amount']);
				$statistics_ass_array['description'] = 'Total HTG for Sunday '.date_format(date_create($htg_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['day_of_operation'] = date_format(date_create($htg_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH IN';
				array_push($statistics_mult_array, $statistics_ass_array);
			}
		}
		$other_off_query = "SELECT amount, collected_on FROM other_offerings WHERE date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') <'$end_date'";
		$other_off_result = mysql_query($other_off_query);
		$other_off_rows = mysql_num_rows($other_off_result);
		if ($other_off_rows > 0) {
			while ($other_off_row_data = mysql_fetch_array($other_off_result)) {
				$statistics_ass_array['amount'] = number_format($other_off_row_data['amount']);
				$statistics_ass_array['description'] = 'Total Other Offerings for Sunday'.date_format(date_create($other_off_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['day_of_operation'] = date_format(date_create($other_off_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH IN';
				array_push($statistics_mult_array, $statistics_ass_array);
			}
		}

		$project_query = "SELECT sum(amount) AS amount, collected_on FROM project_offerings WHERE date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') < '$end_date' GROUP BY collected_on";
		$project_result = mysql_query($project_query);
		$project_rows = mysql_num_rows($project_result);
		if ($project_rows > 0) {
			while ($project_row_data = mysql_fetch_array($project_result)) {
				$statistics_ass_array['amount'] = number_format($project_row_data['amount']);
				$statistics_ass_array['description'] = 'Total Project Offerings for Sunday '.date_format(date_create($project_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['day_of_operation'] = date_format(date_create($project_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH IN';
				array_push($statistics_mult_array, $statistics_ass_array);
			}
		}
		
		$reg_off_query = "SELECT sum(amount) AS amount, collected_on FROM regular_offerings WHERE date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') < '$end_date' GROUP BY collected_on";
		$reg_off_result = mysql_query($reg_off_query);
		$reg_off_rows = mysql_num_rows($reg_off_result);
		if ($reg_off_rows > 0) {
			while ($reg_off_row_data = mysql_fetch_array($reg_off_result)) {
				$statistics_ass_array['amount'] = number_format($reg_off_row_data['amount']);
				$statistics_ass_array['description'] = 'Total Worship Service Offerings for Sunday '.date_format(date_create($reg_off_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['day_of_operation'] = date_format(date_create($reg_off_row_data['collected_on']),'Y-m-d');
				$statistics_ass_array['type_of_operation'] = 'CASH IN';
				array_push($statistics_mult_array, $statistics_ass_array);
			}
		}
		return $statistics_mult_array;
	}
	//The function here after generates the quaterly totals for incomes
	function quater_income_per_rubric_totals($start_date, $end_date){
		connect_to_db();
		$amount = 0;
		$rubric = '';
		$qtr_stats_mult_array = array();
		$qtr_stats_ass_array = array('amount' => $amount, 'rubric' => $rubric);
		//for current year or specified year
		$tithe_income_qry = "SELECT sum(amount) AS amount FROM tithes WHERE date_format(paid_on,'%Y-%m-%d') > '$start_date' AND date_format(paid_on,'%Y-%m-%d') < '$end_date'";
		$tithe_income_result = mysql_query($tithe_income_qry);
		$tithe_income_rows = mysql_num_rows($tithe_income_result);
		if ($tithe_income_rows > 0) {
			while ($tithe_income_row_data = mysql_fetch_array($tithe_income_result)) {
				$qtr_stats_ass_array['amount'] = $tithe_income_row_data['amount'];
				$qtr_stats_ass_array['rubric'] = 'TOTAL TITHES';
				array_push($qtr_stats_mult_array, $qtr_stats_ass_array);
			}
		}
		//for current year or specified year
		$regOff_income_qry = "SELECT sum(amount) AS amount FROM regular_offerings WHERE date_format(collected_on,'%Y-%m-%d') > '$start_date' AND date_format(collected_on,'%Y-%m-%d') < '$end_date'";
		$regOff_income_result = mysql_query($regOff_income_qry);
		$regOff_income_rows = mysql_num_rows($regOff_income_result);
		if ($regOff_income_rows > 0) {
			while ($regOff_income_row_data = mysql_fetch_array($regOff_income_result)) {
				$qtr_stats_ass_array['amount'] = $regOff_income_row_data['amount'];
				$qtr_stats_ass_array['rubric'] = 'TOTAL SUNDAY OFFERINGS';
				array_push($qtr_stats_mult_array, $qtr_stats_ass_array);
			}
		}
		//for current year or specified year
		$prjkOff_income_qry = "SELECT sum(amount) AS amount FROM project_offerings WHERE date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') < '$end_date'";
		$prjkOff_income_result = mysql_query($prjkOff_income_qry);
		$prjkOff_income_rows = mysql_num_rows($prjkOff_income_result);
		if ($prjkOff_income_rows > 0) {
			while ($prjkOff_income_row_data = mysql_fetch_array($prjkOff_income_result)) {
				$qtr_stats_ass_array['amount'] = $prjkOff_income_row_data['amount'];
				$qtr_stats_ass_array['rubric'] = 'TOTAL PROJECT OFFERINGS';
				array_push($qtr_stats_mult_array, $qtr_stats_ass_array);
			}
		}
		//for current year or specified year
		$htgOff_income_qry = "SELECT sum(amount) AS amount FROM htg_offerings WHERE date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') < '$end_date'";
		$htgOff_income_result = mysql_query($htgOff_income_qry);
		$htgOff_income_rows = mysql_num_rows($htgOff_income_result);
		if ($htgOff_income_rows > 0) {
			while ($htgOff_income_row_data = mysql_fetch_array($htgOff_income_result)) {
				$qtr_stats_ass_array['amount'] = $htgOff_income_row_data['amount'];
				$qtr_stats_ass_array['rubric'] = 'TOTAL HARVEST THANKS GIVING OFFERINGS';
				array_push($qtr_stats_mult_array, $qtr_stats_ass_array);
			}
		}
		//for current year or specified year
		$otherOff_income_qry = "SELECT sum(amount) AS amount FROM other_offerings WHERE  date_format(collected_on, '%Y-%m-%d') > '$start_date' AND date_format(collected_on, '%Y-%m-%d') < '$end_date'";
		$otherOff_income_result = mysql_query($otherOff_income_qry);
		$otherOff_income_rows = mysql_num_rows($otherOff_income_result);
		if ($otherOff_income_rows > 0) {
			while ($otherOff_income_row_data = mysql_fetch_array($otherOff_income_result)) {
				$qtr_stats_ass_array['amount'] = $otherOff_income_row_data['amount'];
				$qtr_stats_ass_array['rubric'] = 'TOTAL OTHER OFFERINGS COLLECTED';
				array_push($qtr_stats_mult_array, $qtr_stats_ass_array);	
			}
		}

		return $qtr_stats_mult_array;
	}
	//The function here after generates the quaterly totals for expenditures
	function quater_expenditure_per_rubric_totals($start_date, $end_date){
		connect_to_db();
		$amount = 0;
		$rubric = '';
		$qtr_stats_mult_array1 = array();
		$qtr_stats_ass_array1 = array('amount' => $amount, 'rubric' => $rubric);
		//for current year or specified year
		$pastorSalary_exp_qry = "SELECT sum(amount) AS amount FROM pastors_salary WHERE  date_format(withdrawn_on,'%Y-%m-%d') > '$start_date' AND date_format(withdrawn_on,'%Y-%m-%d') < '$end_date'";
		$pastorSalary_exp_result = mysql_query($pastorSalary_exp_qry);
		$pastorSalary_exp_rows = mysql_num_rows($pastorSalary_exp_result);
		if ($pastorSalary_exp_rows > 0) {
			while ($pastorSalary_exp_row_data = mysql_fetch_array($pastorSalary_exp_result)) {
				$qtr_stats_ass_array1['amount'] = $pastorSalary_exp_row_data['amount'];
				$qtr_stats_ass_array1['rubric'] = 'TOTAL PASTORS SALARY FOR THE QUATER';
				array_push($qtr_stats_mult_array1, $qtr_stats_ass_array1);
			}
		}
		//for current year or specified year
		$project_exp_qry = "SELECT sum(amount) AS amount FROM project_expenditure WHERE date_format(withdrawn_on,'%Y-%m-%d') > '$start_date' AND date_format(withdrawn_on,'%Y-%m-%d') < '$end_date'";
		$project_exp_result = mysql_query($project_exp_qry);
		$project_exp_rows = mysql_num_rows($project_exp_result);
		if ($project_exp_rows > 0) {
			while ($project_exp_row_data = mysql_fetch_array($project_exp_result)) {
				$qtr_stats_ass_array1['amount'] = $project_exp_row_data['amount'];
				$qtr_stats_ass_array1['rubric'] = 'TOTAL EXPENDITURE ON PROJECTS FOR THE QUATER';
				array_push($qtr_stats_mult_array1, $qtr_stats_ass_array1);
			}
		}
		//for current year or specified year
		$other_exp_qry = "SELECT sum(amount) AS amount FROM other_expenses WHERE date_format(withdrawn_on, '%Y-%m-%d') > '$start_date' AND date_format(withdrawn_on, '%Y-%m-%d') < '$end_date'";
		$other_exp_result = mysql_query($other_exp_qry);
		$other_exp_rows = mysql_num_rows($other_exp_result);
		if ($other_exp_rows > 0) {
			while ($other_exp_row_data = mysql_fetch_array($other_exp_result)) {
				$qtr_stats_ass_array1['amount'] = $other_exp_row_data['amount'];
				$qtr_stats_ass_array1['rubric'] = 'TOTAL MISCELANEOUS EXPENDITURE';
				array_push($qtr_stats_mult_array1, $qtr_stats_ass_array1);	
			}
		}
		return $qtr_stats_mult_array1;
	}
	function get_financial_year(){
		connect_to_db();
		$f_year_id = 0;
		$f_year = 2016;
		$fin_year_multi_array = array();
		$fin_year_ass_array = array('f_year_id' => $f_year_id, 'f_year' => $f_year);
		$get_yr_query = "SELECT * FROM financial_year";
		$fin_yr_result = mysql_query($get_yr_query);
		while ($fin_yr_data = mysql_fetch_array($fin_yr_result)) {
			$fin_year_ass_array['f_year_id'] = $fin_yr_data['f_year_id'];
			$fin_year_ass_array['f_year'] = $fin_yr_data['f_year'];
			array_push($fin_year_multi_array, $fin_year_ass_array);
		}
		return $fin_year_multi_array;
	}
?>