﻿<?php
//require('chinese.php');
require('Pdfunicode.php'); 
$pdf=new Pdfunicode(); 

$pdf->Open(); 
$pdf->AddPage(); 
//$pdf->Image('yixinlogo.png',20,20,0,0);
$pdf->AddUniGBhwFont('uni'); 
$pdf->SetFont('uni','',20); 


$pdf->Write(10,'a哈哈哈哈\n瞷放 18 C 楞 83 % %');
$pdf->Output('a.pdf','F');

/*$pdf=new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB','',20);
$pdf->Write(10,'������');
$pdf->Output();*/
?>
