<?php
	include("..//model.php");
	if (isset($_POST['matricule'])) {
	 	$christian_mat = trim(strip_tags($_POST['matricule']));
	 	$christian_name = christian($christian_mat);
	 	if ($christian_name == "") {
	 		echo "CHRISTIAN NOT FOUND";
	 	}
	 	else{
	 		echo $christian_name;
	 	}
	 } 
	else{
		//do nothing
	}
?>