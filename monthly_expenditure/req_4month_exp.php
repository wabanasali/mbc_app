<?php 
	$raw_month_exp_multi_array = array();
	function process_month_array($month_exp_multi_array){
		for ($i=0; $i < sizeof($month_exp_multi_array); $i++) { 
			for ($j=$i+1; $j < sizeof($month_exp_multi_array); $j++) { 
					if (($month_exp_multi_array[$i]['purpose'] == $month_exp_multi_array[$j]['purpose']) && ($month_exp_multi_array[$i]['semaine'] == $month_exp_multi_array[$j]['semaine'])) {
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
	function exp_multi_array($given_month, $f_year_id){
		$week_mod5 = 0;
		$amount = 0;
		$purpose = '';
		$mois_exp_multi_array = array();
		$semaine_array = array('semaine' => $week_mod5, 'amount' => $amount, 'purpose' => $purpose);
		connect_to_db();
				$sql = "SELECT * FROM expenses ";
		$rslt = mysql_query($sql);
		while($row = mysql_fetch_array($rslt)){
			$desired_date = new DateTime($row['withdrawn_on']);
			$week = $desired_date->format('W');
			$week_mod5 = $week%5;
			$month = $desired_date->format('M');
			$purpose = $row['purpose'];
			$amount = $row['amount'];
			if ($month == $given_month) {
				$week_array['semaine'] = $week_mod5;
				$week_array['amount'] = $amount;
				$week_array['purpose'] = $purpose;
			}
			else{
				$semaine_array['semaine'] = $week_mod5;
				$semaine_array['amount'] = 0;
				$semaine_array['purpose'] = $purpose;
			}
			array_push($mois_exp_multi_array, $week_array);
		}
		return $mois_exp_multi_array;
	}
	// $raw_month_exp_multi_array = exp_multi_array('Jan', 2);
?> 