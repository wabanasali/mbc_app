<?php
 include('model.php');
 $qtr = 1;
 require('./fpdf.php');
 $month = date('m');
 $day = date('d');
 $year = date('Y');
 $income_counter = 0;
 $expenses_counter = 0;
 $start = '';
 $end ='';
 $totalIncome = 0;
 $totalExpenditure = 0;
 if ($month > 0 && $month < 4) {
 	// first quater
 	$qtr = 1;
 	$year = date("Y",strtotime("-1 year"));
 	$start = ''.$year.'-12-31';
 	$end = ''.$year.'-04-01';
 }
 elseif ($month > 3 && $month < 7) {
 	// second quater
 	$qtr = 2;
 	$start = ''.$year.'-03-31';
 	$end = ''.$year.'-07-01';
 }
 elseif ($month > 6 && $month < 10) {
 	# third quater
 	$qtr = 3;
 	$start = ''.$year.'-06-30';
 	$end = ''.$year.'-10-01';
 }
 elseif ($month > 9 && $month < 13) {
 	# fourth quater
 	$qtr = 4;
 	$start = ''.$year.'-09-30';
 	$end = ''.$year.'-01-01';
 }
 else{
 	//do nothing
 }
 $income_info_array  =	quater_income_per_rubric_totals($start, $end);
 foreach ($income_info_array as $key => $value) {
 	$totalIncome += $value['amount'];
 }
 $expenditure_info_array = quater_expenditure_per_rubric_totals($start, $end);
 foreach ($expenditure_info_array as $key => $value) {
 	$totalExpenditure += $value['amount'];
 }
 $balance = $totalIncome - $totalExpenditure;
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
if ($qtr == 1) {
	$pdf->Cell(40,10,'FIRST QUATER REPORT FOR THE YEAR '.$year.'','0','1');
}
elseif ($qtr == 2) {
	$pdf->Cell(40,10,'SECOND QUATER REPORT FOR THE YEAR '.$year.'','0','1');
}
elseif ($qtr == 3) {
	$pdf->Cell(40,10,'THIRD QUATER REPORT FOR THE YEAR '.$year.'','0','1');
}
elseif ($qtr == 4) {
	$pdf->Cell(40,10,'FINAL QUATER REPORT FOR THE YEAR '.$year.'','0','1');
}
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,2,'********************************************************','0','1');
$pdf->Cell(40,10,'A. INCOME','0','1');
$pdf->Cell(40,2,'=========','0','1');
foreach ($income_info_array as $key => $value) {
	$pdf->Cell(40,10,''.++$income_counter.'.'.$value['rubric'].' = '.number_format($value['amount']).'FCFA','0','1');
 }
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'TOTAL INCOME  = '.number_format($totalIncome).' FCFA','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,'B. EXPENDITURE','0','1');
$pdf->Cell(40,2,'=========','0','1');
foreach ($expenditure_info_array as $key => $value) {
	$pdf->Cell(40,10,''.++$expenses_counter.'.'.$value['rubric'].' = '.number_format($value['amount']).'FCFA','0','1');
 }
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'TOTAL EXPENDITURE  = '.number_format($totalExpenditure).' FCFA','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,'C. BALANCE','0','1');
$pdf->Cell(40,2,'=========','0','1');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,' TOTAL INCOME - TOTAL EXPENDITURE = '.number_format($balance).' FCFA','0','1');
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,' DONE FOR THE CHURCH THIS: '.$day.'/'.$month.'/'.$year.' BY FINANCE COMMITTEE','0','1');
if ($qtr == 1) {
	$pdf->Output('D','FirstQuaterFinancialReport.pdf');
}
elseif ($qtr == 2) {
	$pdf->Output('D','SecondQuaterFinancialReport.pdf');
}
elseif ($qtr == 3) {
	$pdf->Output('D','ThirdQuaterFinancialReport.pdf');
}
elseif ($qtr == 4) {
	$pdf->Output('I','FinalQuaterFinancialReport.pdf');
}
// header("location: pages/operations.php");
?>		