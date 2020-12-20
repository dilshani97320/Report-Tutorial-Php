<?php
require('pdf-sector.php');

$pdf=new PDF_SECTOR('p','mm','A4');
$pdf->Addpage();

//chart data
$data=Array(
'lorem'=>[
       'color'=>[255,0,0],
       'value'=>100],
'ipsum'=>[
       'color'=>[255,255,0],
       'value'=>300],
'dolor'=>[
       'color'=>[50,0,255],
       'value'=>150],
 'sit'=>[
       'color'=>[255,0,255],
       'value'=>50],
 'amet'=>[
       'color'=>[0,255,0],
       'value'=>240]



);
//pie and legend propeties
$pieX=105;
$pieY=60;
$r=40;//radius
$legendX=150;
$legendY=70;

//get total data summary
$datasum=0;
foreach($data as $item) {
$datasum+=$item['value'];
}

//get scale unit of each degree
$degUnit=360/$datasum;

//variable to store current angle
$currentAngle=0;

//draw the pie
foreach ($data as $item) {
	//slice size
	$deg=$degUnit*$item['value'];
	//remove bordr
	$pdf->setDrawColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//set color
	$pdf->setFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//draw the slice
	$pdf->sector($pieX,$pieY,$r,$currentAngle,$currentAngle+$deg);
	//add slice angle to currentAngle var
	$currentAngle+=$deg;
}


//draw the legend
$pdf->setfont('Arial','',9);
//store current legend y position

$currentLegendY=$legendY;
foreach ($data as $index => $item) {
	//remove bordr
	$pdf->setDrawColor($item['color'][0],$item['color'][1],$item['color'][2]);
	$pdf->setFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
	$pdf->Rect($legendX,$currentLegendY,5,5,'DF');
	$pdf->SetXY($legendX+6,$currentLegendY);
	$pdf->cell(50,5,$index,1,0);
	$currentLegendY+=5;
}


$pdf->output();


