 <?php
	include("..//model.php");
 	if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
 		$frm_date = date_format(date_create(trim(strip_tags($_POST['fromDate']))), 'd/m/Y');
 		$to_date = date_format(date_create(trim(strip_tags($_POST['toDate']))), 'd/m/Y');
 		$some_array = statistics_for_period($frm_date, $to_date);
 		if (sizeof($some_array) > 0) {
 			for ($i=0; $i < sizeof($some_array); $i++) { 
	 			$j = $i + 1;
	 			echo "<tr>";
	 			echo "<td>";
	 			echo $j;
	 			echo "</td>";
	 			echo "<td>";
	 			echo $some_array[$i]['type_of_operation'];
	 			echo "</td>";
	 			echo "<td>";
	 			echo $some_array[$i]['description'];
	 			echo "</td>";
	 			echo "<td>";
	 			echo $some_array[$i]['amount'];
	 			echo "</td>";
	 			echo "<td>";
	 			echo $some_array[$i]['day_of_operation'];
	 			echo "</td>";
	 			echo "</tr>";
	 		}
 		}
 		else{
 			//do nothing
 		}
 	}
 	else{
 		echo "You still have to work on the dates!";
 	}
?> 