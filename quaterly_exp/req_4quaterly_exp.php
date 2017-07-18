<?php 
	$raw_quaterly_exp_multi_array = array();
	function process_month_array($month_exp_multi_array){
		for ($i=0; $i < sizeof($month_exp_multi_array); $i++) { 
			for ($j=$i+1; $j < sizeof($month_exp_multi_array); $j++) { 
					if (($month_exp_multi_array[$i]['purpose'] == $month_exp_multi_array[$j]['purpose']) && ($month_exp_multi_array[$i]['month'] == $month_exp_multi_array[$j]['month'])) {
						$month_exp_multi_array[$i]['amount'] += $month_exp_multi_array[$j]['amount'];
						$month_exp_multi_array[$j]['amount'] = 0;
					}
			}
		}
		foreach ($month_exp_multi_array as $key => $value) {
			if ($month_exp_multi_array[$key]['amount'] == 0) {
				unset($month_exp_multi_array[$key]);
			}
		}
		return $month_exp_multi_array;
	}
	function strip_off_duplicates($rowLabelArray){
		for ($i=0; $i < sizeof($rowLabelArray); $i++) { 
			for ($j= $i+1; $j < sizeof($rowLabelArray); $j++) { 
					if ($rowLabelArray[$i] == $rowLabelArray[$j]) {
						$rowLabelArray[$j] = 0;
					}
			}
		}
		return $rowLabelArray;
	}
	function connect_to_db(){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db('mbc', $connection) or die('could not select database');
	}
	function quaterly_exp_multi_array($given_quater, $f_year_id){
		$month = 0;
		$amount = 0;
		$quater = 0;
		$purpose = '';
		$mois_exp_multi_array = array();
		$mois_exp_multi_array2 = array();
		$month_array = array('month' => $month, 'amount' => $amount, 'purpose' => $purpose, 'quater' => $quater);
		connect_to_db();
		$sql = "SELECT * FROM expenses WHERE f_year_id = '$f_year_id'";
		$rslt = mysql_query($sql);
			while ($row = mysql_fetch_array($rslt)) {
				$desired_date = new DateTime($row['withdrawn_on']);
				// $week = $desired_date->format('W');
				// $week_mod5 = $week%5;
				// var_dump($row);
				$month = $desired_date->format('M');
				// $numeric_month = (int)$desired_date->format('m');
				// var_dump($testz);
				$purpose = $row['purpose'];
				$amount = $row['amount'];
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
				array_push($mois_exp_multi_array, $month_array);
			}
			// array_push($mois_exp_multi_array, $month_array);
			foreach ($mois_exp_multi_array as $key => $value) {
				if ($mois_exp_multi_array[$key]['quater'] == $given_quater) {
					array_push($mois_exp_multi_array2, $mois_exp_multi_array[$key]);
				}
			}
		// array_push($mois_exp_multi_array, $month_array);
		return $mois_exp_multi_array2;
	}
		
	$raw_quaterly_exp_multi_array = quaterly_exp_multi_array(1,2);
	// var_dump(process_month_array($raw_quaterly_exp_multi_array));
?> 