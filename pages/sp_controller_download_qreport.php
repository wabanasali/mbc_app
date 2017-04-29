<?php
	include("..//model.php");
	require("..//fpdf.php");
		if (isset($_POST['tdayMonth']) && isset($_POST['tdayYear'])) {
			$currentMonth = $_POST['tdayMonth'];
			$currentYear = $_POST['tdayYear'];
			if ($currentMonth > -1 && $currentMonth < 3) {
				echo "Ready to print first quater report";
			}
			else if ($currentMonth > 2 && $currentMonth < 6) {
				// echo "Ready to print second quater report";
				$somestuff = "$income_counter = 0;
 $expenses_counter = 0;
 $information = array('quater'=>2, 'tithes'=>20000, 'reg_off'=>30000, 'proj_off'=>120000, 'other_off'=>0, 'salaries'=>25000, 'proj_exp'=>10000, 'designated_off'=>0, 'other_exp'=>0);
 $totalIncome = $information['tithes']+$information['reg_off']+$information['proj_off']+$information['other_off'];
 $totalExpenditure = $information['salaries']+$information['proj_exp']+$information['designated_off']+$information['other_exp'];
 $balance = $totalIncome - $totalExpenditure;
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'QUATER '.$information['quater'].' REPORT FOR THE YEAR 2017','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,2,'********************************************************','0','1');
$pdf->Cell(40,10,'A. INCOME','0','1');
$pdf->Cell(40,2,'=========','0','1');
if ($information['tithes'] > 0) {
	$pdf->Cell(40,10,''.++$income_counter.'. TITHES  = '.number_format($information['tithes']).' FCFA','0','1');
}
if ($information['reg_off'] > 0) {
	$pdf->Cell(40,10,''.++$income_counter.'. REGULAR OFFERINGS  = '.number_format($information['reg_off']).' FCFA','0','1');
}
if ($information['proj_off'] > 0) {
	$pdf->Cell(40,10,''.++$income_counter.'. OTHER OFFERINGS  = '.number_format($information['proj_off']).' FCFA','0','1');
}
if ($information['other_off'] > 0) {
	$pdf->Cell(40,10,''.++$income_counter.'. OFFERINGS  = '.number_format($information['other_off']).' FCFA','0','1');
}
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'TOTAL INCOME  = '.number_format($totalIncome).' FCFA','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,'B. EXPENDITURE','0','1');
$pdf->Cell(40,2,'=========','0','1');
if ($information['salaries'] > 0) {
	$pdf->Cell(40,10,''.++$expenses_counter.'. SALARIES  = '.number_format($information['salaries']).' FCFA','0','1');
}
if ($information['proj_exp'] > 0) {
	$pdf->Cell(40,10,''.++$expenses_counter.'. PROJECT EXPENSES  = '.number_format($information['proj_exp']).' FCFA','0','1');
}
if ($information['designated_off'] > 0) {
	$pdf->Cell(80,10,''.++$expenses_counter.'. TOTAL EXPENDITURE  = '.number_format($information['designated_off']).' FCFA','0','1');
}
if ($information['other_exp'] > 0) {
	$pdf->Cell(80,10,''.++$expenses_counter.'. TOTAL EXPENDITURE  = '.number_format($information['other_exp']).' FCFA','0','1');
}
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'TOTAL EXPENDITURE  = '.number_format($totalExpenditure).' FCFA','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,'C. BALANCE','0','1');
$pdf->Cell(40,2,'=========','0','1');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,' TOTAL INCOME - TOTAL EXPENDITURE = '.number_format($balance).' FCFA','0','1');
$pdf->Output('D');";
				echo $somestuff;
			}
			else if ($currentMonth > 5 && $currentMonth < 9) {
				echo "Ready to print third quater report";
			}
			else if ($currentMonth > 8 && $currentMonth < 12) {
				echo "Ready to print fourth quater report";
			}
			else{
				echo "The quater is seemingly undefined!";
			}
		}
		else{
			echo "Quater report for undefined quater!!";
		}
  // echo "You are now going to download quater report!";
?>