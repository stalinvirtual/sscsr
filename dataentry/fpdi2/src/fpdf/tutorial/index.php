<?php
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',8);
$pdf->Cell(63,14,'I N L A N D L E T T E R C A R D',0,0,'C');

$pdf->setxy(70,140);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,'STAFF SELECTION COMMISSION');

$pdf->setxy(88,150);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,5,'Southern Region');

$pdf->setxy(45,155);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,5,'II Floor, EVK Sampath Building, College Road, Chennai  600 006.');

$pdf->setxy(50,160);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,5,'Telephone: 044-28251139, 28235021, 28270561, 28275568.');

$pdf->setxy(80,165);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,5,'Website : www.sscsr.gov.in');

$pdf->setxy(28,175);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,'COMMON SCREENING TEST FOR RECRUITMENT OF ASSISTANT CENTRAL');

$pdf->setxy(45,180);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,'INTELLIGENCE OFFICER (ACIO) IN INTELLIGENCE BUREAU');

$pdf->setxy(70,185);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,'(CAT.NO SR - B - 01 of SSC/SR/1/2011)');


$pdf->setxy(20,205);
$pdf->SetFont('Arial','',10);
$width_cell=array(30,100,10,30);
$pdf->Cell($width_cell[0],10,'Name',1,0);
$pdf->Cell($width_cell[1],10,'  JAYAMURUGAN J',1,0);
$pdf->Cell($width_cell[2],10,'Sex',1,0);
$pdf->Cell($width_cell[3],10,'  Male',1,1);

$pdf->setxy(20,215);
$width_cell=array(30,70,30,40);
$pdf->Cell($width_cell[0],10,'Roll No',1,0);
$pdf->Cell($width_cell[1],10,'  16411011',1,0);
$pdf->Cell($width_cell[2],10,'Ticket / Seat No.',1,0);  
$pdf->Cell($width_cell[3],10,'  45',1,1);

$pdf->setxy(20,225);
$width_cell=array(30,70,30,40);
$pdf->Cell($width_cell[0],10,'Category',1,0);  
$pdf->Cell($width_cell[1],10,'  Computer Operator/Typiest',1,0);
$pdf->Cell($width_cell[2],10,'Date of Birth',1,0);  
$pdf->Cell($width_cell[3],10,'  03/03/1996',1,1);


$pdf->setxy(20,235);
$pdf->MultiCell(30,5.3,'   Date 16/10/2011 (SUNDAY)',1,'C');
$pdf->setxy(50,235);
$pdf->MultiCell(140,4,'
  Paper (Objective Type)
  Part I - General Intelligence & Reasoning     Part III - English Comprehension
  Part II - General Awareness
',1,'L');

$pdf->setxy(20,251);
$width_cell=array(30);
$pdf->Cell($width_cell[0],6,'Time',1,0);

$pdf->setxy(50,251);
$pdf->MultiCell(140,8.3,'  Venue Name & Address


',1,'L');

$pdf->setxy(20,257);
$width_cell=array(30);
$pdf->MultiCell(30,4.7,"       2 Hrs.                  02.00 p.m             to              04.00 p.m",1,'C');

$pdf->addPDF('doc1.pdf');
$pdf->addPDF('doc2.pdf');
$pdf->Output('I',"JAYAMURUGAN_16411011.pdf");
?>

?>
