<?php

namespace App\Controllers;

use App\System\Route;
use fpdi2\src\setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
//namespace App\Controllers;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('fpdf/fpdf.php');
require('autoload.php');

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('Fantastic-Speaker.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId, 10, 10, 90);

$pdf->addPage();
$pdf->Ln(2);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(190, 14, '', 0, 0, 'C');
$pdf->Ln(1);
$pdf->Cell(190, 5, 'Important Instructions', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);


$pdf->Output('I', 'generated.pdf');
