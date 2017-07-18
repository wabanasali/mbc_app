<?php 
	$raw_month_inc_multi_array = array();
	// $week_mod5 = 0;
	// $amount = 0;
	// $purpose = '';
	// $week_array = array('semaine' => $week_mod5, 'amount' => $amount, 'purpose' => $purpose);
	function connect_to_db(){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
	}
	function process_month_array($month_inc_multi_array){
		for ($i=0; $i < sizeof($month_inc_multi_array); $i++) { 
			for ($j=$i+1; $j < sizeof($month_inc_multi_array); $j++) { 
					if (strcmp($month_inc_multi_array[$i]['purpose'], $month_inc_multi_array[$j]['purpose'])== 0 && ($month_inc_multi_array[$i]['month'] == $month_inc_multi_array[$j]['month'])) {
						$month_inc_multi_array[$i]['amount'] += $month_inc_multi_array[$j]['amount'];
						$month_inc_multi_array[$j]['amount'] = 0;
					}
			}
		}
		foreach ($month_inc_multi_array as $key => $value) {
			if ($month_inc_multi_array[$key]['amount'] == 0) {
				unset($month_inc_multi_array[$key]);
			}
		}
		return $month_inc_multi_array;
	}
	function strip_off_duplicates($rowLabelArray){
		for ($i=0; $i < sizeof($rowLabelArray); $i++) { 
			for ($j= $i+1; $j < sizeof($rowLabelArray); $j++) { 
					if (strcmp($rowLabelArray[$i], $rowLabelArray[$j]) == 0) {
						$rowLabelArray[$j] = 0;
					}
			}
		}
		return $rowLabelArray;
	}
	function quaterly_inc_multi_array($given_quater, $f_year_id){
		$month = 0;
		$amount = 0;
		$quater = 0;
		$purpose = '';
		$mois_inc_multi_array = array();
		$mois_inc_multi_array2 = array();
		$month_array = array('month' => $month, 'amount' => $amount, 'purpose' => $purpose, 'quater' => $quater);
		connect_to_db();
		//tithes
		$tithes_sql = "SELECT * FROM tithes WHERE f_year_id = '$f_year_id'";
		$tithes_rslt = mysql_query($tithes_sql);
		$tithes_num_rows = mysql_num_rows($tithes_rslt);
		if ($tithes_num_rows > 0) {
			while ($tithes_rows = mysql_fetch_array($tithes_rslt)) {
				$desired_date = new DateTime($tithes_rows['paid_on']);
				$week = $desired_date->format('W');
				$month = $desired_date->format('M');
				$amount = $tithes_rows['amount'];
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Apr') == 0 || strcmp($month, 'Jul') == 0 || strcmp($month, 'Oct') == 0) {
					$month_array['month'] = 0;
				}
				elseif (strcmp($month, 'Feb') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Aug') == 0 || strcmp($month, 'Nov') == 0) {
					$month_array['month'] = 1;
				}
				else{
					$month_array['month'] = 2;
				}
				$month_array['amount'] = $amount;
				$month_array['purpose'] = 'Tithes';
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Feb') == 0 || strcmp($month, 'Mar') == 0) {
					$month_array['quater'] = 1;
				}
				elseif(strcmp($month, 'Apr') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0){
					$month_array['quater'] = 2;
				}
				elseif (strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0 || strcmp($month, 'Jul') == 0) {
					$month_array['quater'] = 3;
				}
				else{
					$month_array['quater'] = 4;
				}
				array_push($mois_inc_multi_array, $month_array);
			}
		}
		//htg_offerings
		$htg_off_sql = "SELECT * FROM htg_offerings WHERE f_year_id = '$f_year_id'";
		$htg_off_rslt = mysql_query($htg_off_sql);
		$htg_off_num_rows = mysql_num_rows($htg_off_rslt);
		if ($htg_off_num_rows > 0) {
			while ($htg_off_rows = mysql_fetch_array($htg_off_rslt)) {
				$desired_date = new DateTime($htg_off_rows['collected_on']);
				$week = $desired_date->format('W');
				$week_mod5 = $week%5;
				$month = $desired_date->format('M');
				$amount = $htg_off_rows['amount'];
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Apr') == 0 || strcmp($month, 'Jul') == 0 || strcmp($month, 'Oct') == 0) {
					$month_array['month'] = 0;
				}
				elseif (strcmp($month, 'Feb') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Aug') == 0 || strcmp($month, 'Nov') == 0) {
					$month_array['month'] = 1;
				}
				else{
					$month_array['month'] = 2;
				}
				$month_array['amount'] = $amount;
				$month_array['purpose'] = 'HTG Offerings';
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Feb') == 0 || strcmp($month, 'Mar') == 0) {
					$month_array['quater'] = 1;
				}
				elseif(strcmp($month, 'Apr') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0){
					$month_array['quater'] = 2;
				}
				elseif (strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0 || strcmp($month, 'Jul') == 0) {
					$month_array['quater'] = 3;
				}
				else{
					$month_array['quater'] = 4;
				}
				array_push($mois_inc_multi_array, $month_array);
			}
		}
		//regular_offerings
		$regular_off_sql = "SELECT * FROM regular_offerings WHERE f_year_id = '$f_year_id'";
		$regular_off_rslt = mysql_query($regular_off_sql);
		$regular_off_num_rows = mysql_num_rows($regular_off_rslt);
		if ($regular_off_num_rows > 0) {
			while ($regular_off_rows = mysql_fetch_array($regular_off_rslt)) {
				$desired_date = new DateTime($regular_off_rows['collected_on']);
				$week = $desired_date->format('W');
				$week_mod5 = $week%5;
				$month = $desired_date->format('M');
				$amount = $regular_off_rows['amount'];
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Apr') == 0 || strcmp($month, 'Jul') == 0 || strcmp($month, 'Oct') == 0) {
					$month_array['month'] = 0;
				}
				elseif (strcmp($month, 'Feb') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Aug') == 0 || strcmp($month, 'Nov') == 0) {
					$month_array['month'] = 1;
				}
				else{
					$month_array['month'] = 2;
				}
				$month_array['amount'] = $amount;
				$month_array['purpose'] = 'Regular Offerings';
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Feb') == 0 || strcmp($month, 'Mar') == 0) {
					$month_array['quater'] = 1;
				}
				elseif(strcmp($month, 'Apr') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0){
					$month_array['quater'] = 2;
				}
				elseif (strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0 || strcmp($month, 'Jul') == 0) {
					$month_array['quater'] = 3;
				}
				else{
					$month_array['quater'] = 4;
				}
				array_push($mois_inc_multi_array, $month_array);
			}
		}
		//project_offerings
		$proj_off_sql = "SELECT * FROM project_offerings WHERE f_year_id = '$f_year_id'";
		$proj_off_rslt = mysql_query($proj_off_sql);
		$proj_off_num_rows = mysql_num_rows($proj_off_rslt);
		if ($proj_off_num_rows > 0) {
			while ($proj_off_rows = mysql_fetch_array($proj_off_rslt)) {
				$desired_date = new DateTime($proj_off_rows['collected_on']);
				$week = $desired_date->format('W');
				$week_mod5 = $week%5;
				$month = $desired_date->format('M');
				$amount = $proj_off_rows['amount'];
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Apr') == 0 || strcmp($month, 'Jul') == 0 || strcmp($month, 'Oct') == 0) {
					$month_array['month'] = 0;
				}
				elseif (strcmp($month, 'Feb') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Aug') == 0 || strcmp($month, 'Nov') == 0) {
					$month_array['month'] = 1;
				}
				else{
					$month_array['month'] = 2;
				}
				$month_array['amount'] = $amount;
				$month_array['purpose'] = 'Regular Offerings';
				if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Feb') == 0 || strcmp($month, 'Mar') == 0) {
					$month_array['quater'] = 1;
				}
				elseif(strcmp($month, 'Apr') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0){
					$month_array['quater'] = 2;
				}
				elseif (strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0 || strcmp($month, 'Jul') == 0) {
					$month_array['quater'] = 3;
				}
				else{
					$month_array['quater'] = 4;
				}
				array_push($mois_inc_multi_array, $month_array);
			}
		}
		//other_offerings
		$other_off_sql = "SELECT * FROM other_offerings WHERE f_year_id = '$f_year_id'";
		$other_off_rslt = mysql_query($other_off_sql);
		$other_off_num_rows = mysql_num_rows($other_off_rslt);
		if ($other_off_num_rows > 0) {
			while ($other_off_rows = mysql_fetch_array($other_off_rslt)) {
				$desired_date = new DateTime($other_off_rows['collected_on']);
					$week = $desired_date->format('W');
					$week_mod5 = $week%5;
					$month = $desired_date->format('M');
					$amount = $other_off_rows['amount'];
					$purpose = $other_off_rows['purpose'];
					if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Apr') == 0 || strcmp($month, 'Jul') == 0 || strcmp($month, 'Oct') == 0) {
						$month_array['month'] = 0;
					}
					elseif (strcmp($month, 'Feb') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Aug') == 0 || strcmp($month, 'Nov') == 0) {
						$month_array['month'] = 1;
					}
					else{
						$month_array['month'] = 2;
					}
					$month_array['amount'] = $amount;
					$month_array['purpose'] = $purpose;
					if (strcmp($month, 'Jan') == 0 || strcmp($month, 'Feb') == 0 || strcmp($month, 'Mar') == 0) {
						$month_array['quater'] = 1;
					}
					elseif(strcmp($month, 'Apr') == 0 || strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0){
						$month_array['quater'] = 2;
					}
					elseif (strcmp($month, 'May') == 0 || strcmp($month, 'Jun') == 0 || strcmp($month, 'Jul') == 0) {
						$month_array['quater'] = 3;
					}
					else{
						$month_array['quater'] = 4;
					}
					array_push($mois_inc_multi_array, $month_array);
			}
			foreach ($mois_inc_multi_array as $key => $value) {
				if ($mois_inc_multi_array[$key]['quater'] == $given_quater) {
					array_push($mois_inc_multi_array2, $mois_inc_multi_array[$key]);
				}
			}
		}
		return $mois_inc_multi_array2;
	}
	
	$raw_quaterly_inc_multi_array = quaterly_inc_multi_array(1, 2);//month should be of this form
	// var_dump($raw_quaterly_inc_multi_array);
	// var_dump(process_month_array($raw_month_inc_multi_array));
?> 