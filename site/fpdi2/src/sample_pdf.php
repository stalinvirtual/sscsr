<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('fpdf/fpdf.php');
require_once('autoload.php');

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('Fantastic-Speaker.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId, 10, 10, 90);

$pdf->addPage();
$pdf->Ln(2);
$pdf->SetFont('Arial','U',10);
$pdf->Cell(190,14,'',0,0,'C');
$pdf->Ln(1);
$pdf->Cell(190,5,'Important Instructions',0,1,'C');
$pdf->SetFont('Arial','B',10);


$pdf->Output('I', 'generated.pdf');