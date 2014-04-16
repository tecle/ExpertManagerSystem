<?php
//require('chinese.php');
require('Pdfunicode.php'); 
$pdf=new Pdfunicode(); 

$pdf->Open(); 
$pdf->AddPage(); 
//$pdf->Image('yixinlogo.png',20,20,0,0);
$pdf->AddUniGBhwFont('uni'); 
$pdf->SetFont('uni','',20); 


$pdf->Write(10,'aå“ˆå“ˆå“ˆå“ˆ\nçž·î† î‡‡æ”¾ 18 C æ¥žî‚” 83 % %');
$pdf->Output('a.pdf','F');

/*$pdf=new PDF_Chinese();
$pdf->AddGBFont();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('GB','',20);
$pdf->Write(10,'¹þ¹þ¹þ');
$pdf->Output();*/
?>
