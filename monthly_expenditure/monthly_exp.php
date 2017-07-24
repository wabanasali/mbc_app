<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/

// require_once( "fpdf/fpdf.php" );
require('..//fpdf.php');
//house keeping
require('req_4month_exp.php');
// Begin configuration
$raw_month_exp_multi_array = array();
$exp_array = array();
$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$sum_amount = 0;
$abr_month = $_GET['abr_month'];
$f_year_id = $_GET['f_year_id'];
//set month
if (strcmp($abr_month, 'Jan') ==  0) {
  $month = 'JANUARY';

}
elseif (strcmp($abr_month, 'Feb') == 0) {
  $month = 'FEBRUARY';
}
elseif (strcmp($abr_month, 'Mar') == 0) {
  $month = 'MARCH';
}
elseif (strcmp($abr_month, 'Apr') == 0) {
  $month = 'APRIL';
}
elseif (strcmp($abr_month, 'May') == 0) {
  $month = 'MAY';
}
elseif (strcmp($abr_month, 'Jun') == 0) {
  $month = 'JUNE';
}
elseif (strcmp($abr_month, 'Jul') == 0) {
  $month = 'JULY';
}
elseif (strcmp($abr_month, 'Aug') == 0) {
  $month = 'AUGUST';
}
elseif (strcmp($abr_month, 'Sep') == 0) {
  $month = 'SEPTEMBER';
}
elseif (strcmp($abr_month, 'Oct') == 0) {
  $month = 'OCTOBER';
}
elseif (strcmp($abr_month, 'Nov') == 0) {
  $month = 'NOVEMBER';
}
else{
  $month = 'DECEMBER';
}
//set year from database
connect_to_db();
$f_year_qry = "SELECT f_year FROM financial_year WHERE f_year_id = '$f_year_id'";
$f_year_rslt = mysql_query($f_year_qry)or die('NO SUCH FINANCIAL YEAR');
$f_year_array = mysql_fetch_array($f_year_rslt);
$year = $f_year_array['f_year'];

//go to the database and data now
$raw_month_exp_multi_array = exp_multi_array($abr_month, $f_year_id);
// var_dump($raw_month_exp_multi_array);
for ($i=0; $i < sizeof($raw_month_exp_multi_array); $i++) { 
  $sum_amount += $raw_month_exp_multi_array[$i]['amount'];
}
if ($sum_amount == 0) {
  $feedback = 'no_rpt'; 
  header("Location: ../pages/operations.php?feedback=$feedback");
}

$reportName = "MACEDONIA BAPTIST CHURCH EXPENDITURE REPORT FOR ".$month." ".$year;
//heading for month with with four weeks
// $columnLabels = array( "WEEK 5", "WEEK 1", "WEEK 2", "WEEK 3", "WEEK 4", "TOTAL");
$columnLabels = array( "WEEK 1", "WEEK 2", "WEEK 3", "WEEK 4", "WEEK 5", "TOTAL");
//Description column for month
// $rowLabels = array( "Main Offerings", "Tithes", "Project Offerings", "Rent From House" );
$pr_jan_exp_multi_array = array();
// var_dump($raw_month_exp_multi_array);
foreach (process_month_array($raw_month_exp_multi_array) as $key => $value) {
  array_push($pr_jan_exp_multi_array, $value);
}
$rowLabels = array();
//initialise array
for ($i=0; $i < sizeof($pr_jan_exp_multi_array)+1; $i++) { 
  for ($j=0; $j < 6; $j++) { 
    $exp_array[$i][$j] = 0;
  }
}
// var_dump($exp_array);
foreach ($pr_jan_exp_multi_array as $key => $value) {
  array_push($rowLabels, $pr_jan_exp_multi_array[$key]['purpose']);
}
$mod_row_labels = strip_off_duplicates($rowLabels);
array_push($mod_row_labels, "TOTAL");
// var_dump($pr_jan_exp_multi_array);
// var_dump($mod_row_labels);
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );
function get_amt($arry1, $arry2, $sem){
  for ($i=0; $i < sizeof($arry2); $i++) { 
    for ($j=0; $j < sizeof($arry1); $j++) { 
      if (($arry1[$j]['semaine'] == $sem) && ($arry1[$j]['purpose'] == $arry2[$i])) {
        return $arry1[$j]['amount'];
      }
      else{
        return 0;
      }
    }
  }
}
function set_exp_table_data($arry1, $arry2, $arry3){
  $m = sizeof($arry2);
  $m1 = $m-1;
  for ($i=0; $i < sizeof($arry1); $i++) { 
    for ($j=0; $j < sizeof($arry2); $j++) { 
      for ($k=0; $k < 5; $k++) { 
        if (strcmp($arry1[$i], $arry2[$j]['purpose']) == 0 && $arry2[$j]['semaine'] == $k) {
          $arry3[$i][$k] = $arry2[$j]['amount'];
        } 
      }
    }
  }
  for ($l=0; $l < sizeof($arry2); $l++) { 
    $arry3[$l][5] = $arry3[$l][0] + $arry3[$l][1] + $arry3[$l][2] + $arry3[$l][3] + $arry3[$l][4];
  }
  //summing for totals
  for ($r=0; $r < 6; $r++) { 
    for ($s=0; $s < $m; $s++) { 
      $arry3[$m][$r] += $arry3[$s][$r];
    }
  }
  return $arry3;
}
function moveDown($input,$index) {
       $new_array = $input;
        
       if(count($new_array)>$index) {
                 array_splice($new_array, $index+2, 0, $input[$index]);
                 array_splice($new_array, $index, 1);
             }
  
       return $new_array;
}  
function move_down_array($some_array){
  for ($i=0; $i < sizeof($some_array); $i++) { 
    $some_array[$i] = moveDown(moveDown(moveDown(moveDown($some_array[$i], 0), 1), 2), 3);
  }
  return $some_array;
}
$data = set_exp_table_data($mod_row_labels, $pr_jan_exp_multi_array, $exp_array);
$data1 = move_down_array($data);
// var_dump($data1);
// var_dump($data);
//now we call to order things
// var_dump($data);
// var_dump($exp_array);
// var_dump($data);
// End configuration
/**
  Create the title page
**/

// $pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf = new FPDF( 'L', 'mm', 'A4' );
/**
  Create the page header, main heading, and intro text
**/
$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
/**
  Create the table
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 15 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 10 );

// "PRODUCT" cell
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
$pdf->Cell( 60, 8, " DESCRIPTION", 1, 0, 'L', true );

// Remaining header cells
$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 30, 8, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 8 );

// Create the table data rows

$fill = false;
$row = 0;
$associated_flag = 0;
for ($t=0; $t < sizeof($data1); $t++) {
    // var_dump($data1[$t]) ;
    $sum = array_sum($data1[$t]);
    // var_dump($sum);
    //check for zero column in an array
    $pdf->SetFont( 'Arial', 'B', 10 );
    $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
    $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
    if ($sum == 0) {
      // $t += 1;
      $row += 1;
    }
    else{
      $pdf->Cell( 60, 8, " " . $mod_row_labels[$row], 1, 0, 'L', $fill );
    
      // Create the data cells
      $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
      $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
      $pdf->SetFont( 'Arial', '', 10 );

      for ( $i=0; $i<sizeof($columnLabels); $i++ ) {
          $pdf->Cell( 30, 8, ( number_format( $data1[$t][$i] ) ), 1, 0, 'C', $fill );
      }
      //undo flag and move on
      // $associated_flag = 0;
      $row++;
      $fill = !$fill;
      $pdf->Ln( 8 );
    }
    
    
}
/***
  Serve the PDF
***/
$pdf->Output('D','TestReport.pdf');
	// header("Location:pages/operations.php");
?>