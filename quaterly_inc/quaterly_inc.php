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
require('req_4quaterly_inc.php');
// Begin configuration
$raw_quaterly_inc_multi_array = array();
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
$sum_amount = 0;
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$quater = $_GET['quater'];
$f_year_id = $_GET['f_year_id'];
//set year from database
connect_to_db();
$f_year_qry = "SELECT f_year FROM financial_year WHERE f_year_id = '$f_year_id'";
$f_year_rslt = mysql_query($f_year_qry)or die('NO SUCH FINANCIAL YEAR');
$f_year_array = mysql_fetch_array($f_year_rslt);
$year = $f_year_array['f_year'];
$raw_quaterly_inc_multi_array = quaterly_inc_multi_array($quater, $f_year_id);
for ($i=0; $i < sizeof($raw_quaterly_inc_multi_array); $i++) { 
  $sum_amount += $raw_quaterly_inc_multi_array[$i]['amount'];
}
if ($sum_amount == 0) {
  $feedback = 'no_rpt'; 
  header("Location: ../pages/operations.php?feedback=$feedback");
}
// var_dump($raw_quaterly_inc_multi_array);
$columnLabels = array();
if ($quater == 1) {
  $reportName = "MACEDONIA BAPTIST CHURCH FIRST QUATER INCOME REPORT FOR THE YEAR ".$year;
  $columnLabels[0] = 'JANUARY';
  $columnLabels[1] = 'FEBRUARY';
  $columnLabels[2] = 'MARCH';
  $columnLabels[3] = 'TOTAL';
}
elseif ($quater == 2) {
  $reportName = "MACEDONIA BAPTIST CHURCH SECOND QUATER INCOME REPORT FOR THE YEAR ".$year;
  $columnLabels[0] = 'APRIL';
  $columnLabels[1] = 'MAY';
  $columnLabels[2] = 'JUNE';
  $columnLabels[3] = 'TOTAL';
}
elseif ($quater == 3) {
  $reportName = "MACEDONIA BAPTIST CHURCH THIRD QUATER INCOME REPORT FOR THE YEAR ".$year;
  $columnLabels[0] = 'JULY';
  $columnLabels[1] = 'AUGUST';
  $columnLabels[2] = 'SEPTEMBER';
  $columnLabels[3] = 'TOTAL';
}
else{
  $reportName = "MACEDONIA BAPTIST CHURCH FOURTH QUATER INCOME REPORT FOR THE YEAR ".$year;
  $columnLabels[0] = 'OCTOBER';
  $columnLabels[1] = 'NOVEMBER';
  $columnLabels[2] = 'DECEMBER';
  $columnLabels[3] = 'TOTAL';
}
$pr_jan_exp_multi_array = array();
foreach (process_month_array($raw_quaterly_inc_multi_array) as $key => $value) {
  array_push($pr_jan_exp_multi_array, $value);
}
$rowLabels = array();
//initialise array
for ($i=0; $i < sizeof($pr_jan_exp_multi_array)+1; $i++) { 
  for ($j=0; $j < 4; $j++) { 
    $exp_array[$i][$j] = 0;
  }
}
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
function set_exp_table_data($arry1, $arry2, $arry3){
  $m = sizeof($arry2);
  $m1 = $m-1;
  for ($i=0; $i < sizeof($arry1); $i++) { 
    for ($j=0; $j < sizeof($arry2); $j++) { 
      for ($k=0; $k < 5; $k++) { 
        if (strcmp($arry1[$i], $arry2[$j]['purpose']) == 0 && $arry2[$j]['month'] == $k) {
          $arry3[$i][$k] = $arry2[$j]['amount'];
        } 
      }
    }
  }
  for ($l=0; $l < sizeof($arry2); $l++) { 
    $arry3[$l][3] = $arry3[$l][0] + $arry3[$l][1] + $arry3[$l][2];
  }
  //summing for totals
  for ($r=0; $r < 4; $r++) { 
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
for ($t=0; $t < sizeof($data); $t++) {
    $sum = array_sum($data[$t]);
    $pdf->SetFont( 'Arial', 'B', 10 );
    $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
    $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
    if ($sum == 0) {
      $t += 1;
      $row += 1;
    }
    
    $pdf->Cell( 60, 8, " " . $mod_row_labels[$row], 1, 0, 'L', $fill );
    
    // Create the data cells
    $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
    $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
    $pdf->SetFont( 'Arial', '', 10 );

    for ( $i=0; $i<sizeof($columnLabels); $i++ ) {
        $pdf->Cell( 30, 8, ( number_format( $data[$t][$i] ) ), 1, 0, 'C', $fill );
    }
    //undo flag and move on
    // $associated_flag = 0;
    $row++;
    $fill = !$fill;
    $pdf->Ln( 8 );
}
/***
  Serve the PDF
***/
$pdf->Output('D','TestReport.pdf');
  // header("Location:pages/operations.php");
?>