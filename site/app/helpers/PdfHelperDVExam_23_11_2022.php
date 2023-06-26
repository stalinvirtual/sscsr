<?php

namespace App\Helpers;

require(__DIR__ . "/../../fpdi2/src/autoload.php");
require(__DIR__ . "/../../fpdi2/src/fpdf/fpdf.php");
require("functions.php");

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PdfHelperDVExam extends Fpdi
{
    public static $PDF_TEMPLATE_PATH = __DIR__ . "/../../pdf/templates";

    public static function genereateAndDVDownloadAdminCard($data)
    {
		
		//$data = json_decode(json_encode($data), true); 
		$key9='Venue';
		$value9='';
		
		// echo "<pre>";
		// print_r($data);
		
		
		
		foreach($data['admitcardresults'] as $value){
			
			if($value["col_name"] == "reg_no"){
				$file_name = $value["col_value"];
			}
		
			
			switch ($value["is_dv_order"]) {
			  case "1":
			     //File No
				$key1 = $value["col_description"];
				$value1 = $value["col_value"];
				break;
			  case "2":
				//file_dated
				$key2 = $value["col_description"];
				$value2 = $value["col_value"];
				break;
			  case "3":
				// dv_subject_content
				$key3 = $value["col_description"];
				$value3 = $value["col_value"];
				break;

                case "4":
                    // Candidate Name
                    $key4 = $value["col_description"];
                    $value4 = $value["col_value"];
                    break;
                case "5":
                    // Roll Number
                    $key5 = $value["col_description"];
                    $value5 = $value["col_value"];
                    break;
                case "6":
                    // Category
                    $key6 = $value["col_description"];
                    $value6 = $value["col_value"];
                    break;
			  case "7":
				//Photo id

                $value7 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA'  ?  $value["col_value"] : "photo_not_exists.png";
                $full_photo_path = photoPath($data);
                $photo_path = $full_photo_path.$value7;
                if(file_exists($photo_path)){
                    $photo_path = $photo_path;
                }
                else{
                    $photo_path = "exam_assets/photo_not_exists.png";
                    
                    }
                
                break;
				 case "8":
				//Sign id
                $value8= $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA' ? $value["col_value"] : "sign_not_exits.png" ;
				
                $full_sign_path = signPath($data);
                $sign_path = $full_sign_path.$value8;
             
                if(file_exists($sign_path)){
                    $sign_path = $sign_path;
                }

                break;
				 case "9":
				//Post Reference
				$key9 = $value["col_description"];
				$value9 = $value["col_value"];
				break;
				 case "10":
				//Dv Date
				$key10 = $value["col_description"];
				$value10 = $value["col_value"];

                $value_dv_date = explode(" ", $key10);
               

                $value_dv_date_c = $value_dv_date[0]." ".$value_dv_date[1]."<br>".$value_dv_date[3]." ".$value_dv_date[4]."<br>";
               
				break;
				case "11":
				 //DV Batch Number
				$key11 = $value["col_description"];
				$value11 = $value["col_value"];
				break;
				case "12":
				 //DV Reporting Time
                 $key12 = $value["col_description"];
                 $value12 = $value["col_value"];
				break;
				case "13":
				 //DV Venue
				$key13 = $value["col_description"];
				$value13 = $value["col_value"];
				break;
			  default:
				//echo "Your favorite color is neither red, blue, nor green!";
			}
						
			
			
		}
		
		
		$pdf = new PDF();
		$pdf->AddPage();
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 14, '', 0, 0, 'C');
        $pdf->Ln(1);

        $pdf->SetY(10);
        $pdf->SetX(150);
        $pdf->Cell(0, 10, $key1.'.'.$value1, 0, 0, '', false);
        $pdf->SetY(15);
        $pdf->SetX(150);
        $pdf->Cell(0, 10, $key2.': '.$value2, 0, 0, '', false);

        //dv subject
        $pdf->SetY(65);
        $pdf->Cell(47, 5, $key3.":", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->setY(70);
		$pdf->MultiCell(190, 5,$value3,0, 'L');

        $pdf->SetY(90);
        $pdf->SetX(10);
        $pdf->SetY(90);
        $pdf->SetX(10);
        $pdf->Cell(142, 39, '', 1, 0, 'C');
        $pdf->Cell(48, 39, '', 1, 0, '');
		
		//Name of Candidate
        $pdf->SetY(90);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(47, 15,$key4, 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 15,$value4 , 0, 0, 'L');
        $pdf->SetY(90);
        $pdf->SetX(10);
        $pdf->Cell(47, 20, '', 1, 0, 'L');
        $pdf->Cell(95, 20, '', 1, 0, 'L');
		//Roll Number
        $pdf->SetY(110);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(47, 12, $key5, 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 12, $value5, 0, 0, 'L');
        $pdf->SetY(110);
        $pdf->SetX(10);
        $pdf->Cell(47, 19, '', 1, 0, 'L');
        $pdf->Cell(95, 19, '', 1, 0, 'L');

        //candidate photo 
        $pdf->SetY(90);
        $pdf->SetX(10);
        $pdf->Cell(142, 8,"", 0, 0, 'L');
        $pdf->SetY(93);
        $pdf->SetX(20);
        $pdf->Cell(142, 8, '', 0, 0, '');
        $pdf->Cell(0, 0, $pdf->Image($photo_path), 0, 0, '');

		//sign and category
        $pdf->SetY(129);
        $pdf->SetX(10);

	


        if(file_exists($sign_path)){
            $pdf->Cell(50, 8, $pdf->Image($sign_path, 160, 130, 30), 0, 0, 'C');
        }
        else{

            $sign_path = "exam_assets/sign_not_exits.png";
            $pdf->Cell(50, 8, $pdf->Image($sign_path, 160, 130, 30), 0, 0, 'C');

        }







        $pdf->SetY(129);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(47, 12, $key6, 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 12, $value6, 0, 0, 'L');
        $pdf->Cell(48, 15, '', 0, 0, 'L');
		
        $pdf->SetY(129);
        $pdf->SetX(10);
        $pdf->Cell(47, 15, '', 1, 0, 'L');
        $pdf->Cell(95, 15, '', 1, 0, 'L');
        $pdf->Cell(48, 15, '', 1, 0, 'L');
		
        //dv candidate content  
		$pdf->SetY(150);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(47, 5, $key9.":  ".$value9, 0, 0, 'L');

		// $pdf->SetY(155);
        // $pdf->SetX(10);
        // $pdf->SetFont('Arial', '', 10);
		// $pdf->MultiCell(190, 5,$value9,0, 'L');
		
		// DV TABLE
		$pdf->SetY(185);
        $pdf->SetX(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->MultiCell(30, 6, $key10, 0, 'C');
        $pdf->Cell(40, 30, "", 0, 0, 'C');
        $pdf->Cell(40, 30, "", 0, 0, 'C');
        $pdf->Cell(40, 30, "", 0, 0, 'C');

        $pdf->SetY(185);
        $pdf->SetX(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(35, 30, '', 0,0, 'C');
        $pdf->Cell(35, 30, $key11, 0, 0, 'C');
        $pdf->Cell(35, 30, $key12, 0, 0, 'C');
        $pdf->Cell(50, 30, $key13, 0, 0, 'C');

		$pdf->SetY(185);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 10);
		$pdf->Cell(30, 20,"", 1, 0, 'C');
        $pdf->Cell(40, 20,"", 1, 0, 'C');
        $pdf->Cell(40, 20,"", 1, 0, 'C');
        $pdf->Cell(80, 20,"", 1, 0, 'C');
		
		$pdf->SetY(205);
        $pdf->SetX(10);
		$pdf->SetFont('Arial', '', 10);
		$dv_date = date("d-m-Y", strtotime($value10));
		$pdf->Cell(30, 30, $dv_date, 0, 0, 'C');
        $pdf->Cell(40, 30, $value11, 0, 0, 'C');
        $pdf->Cell(40, 30, $value12, 0, 0, 'C');
		$pdf->MultiCell(80, 6, substr_replace($value13 ,".",-2), 0, 'L');

		$pdf->SetY(205);    
        $pdf->SetX(10);
		$pdf->Cell(30, 30, '', 1, 0, 'L');
        $pdf->Cell(40, 30, '', 1, 0, 'L');
        $pdf->Cell(40, 30, '', 1, 0, 'L');
        $pdf->Cell(80, 30, '', 1, 0, 'L');
      
		
		
		 if($data['pdf_name'] !=""){
			$pdfPath = $GLOBALS['local_instructions_path'];
			$pdf_file = $pdfPath.$data['pdf_name'];
			$sourcePdfPath = $pdf_file;
			$pageCount = $pdf->setSourceFile($sourcePdfPath);
			for ($pageNo = 1; $pageNo <=  $pageCount; $pageNo++) {
				$pageId = $pdf->importPage($pageNo, PdfReader\PageBoundaries::MEDIA_BOX);
				$pdf->addPage();
				$pdf->useImportedPage($pageId, 10, 10, 190);
			}
		} 
		
		$pdf->Output('I',  $file_name.".pdf");
	}
}

class PDF extends Fpdi
{
    function Cell($w, $h = 0, $txt = "", $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        if (!empty($txt)) {
            if (mb_detect_encoding($txt, 'UTF-8', false)) {
                $txt = iconv('UTF-8', 'ISO-8859-5', $txt);
            }
        }
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }
    function Header()
    {
        if ($this->PageNo() == 1) {
            //set font
            $this->SetFont('Arial', 'B', 10);
            //set border
            $this->Rect(5, 5, 200, 288, 'D'); //A4
            //first container
            $x_value = 100;
			
			
			$this->SetY(6);
            $this->Cell(190, 27, '', 0, 0, '');
            $this->Cell(5, 0, $this->Image('exam_assets/india75.png', 12, $this->SetY(7), 30), 0, 0, 'false');
            $this->SetY(6);
            $this->SetX($x_value);
            $this->Cell(5, 0, '', 0, 0, 'L', false);
            $this->Cell(0, 0, $this->Image('exam_assets/logo.jpg', 85, $this->SetY(12), 38), 0, 0, '', false);

			
            $this->Cell(0, 0, $this->Image('exam_assets/fpdf_ssc_header.png', 12, $this->SetY(33), 60), 0, 0, 'false');
			
			$this->SetY(36);
            $this->SetX(140);
            $this->Cell(0, 0, 'Staff Selection Commission', 0, 0, '', false);

            $this->SetY(40);
            $this->SetX(140);
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 0, 'Region:', 0, 0, '', false);
            $this->SetY(40);
            $this->SetX(151);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(0, 0, 'Southern Region', 0, 0, '', false);

            $this->SetY(45);
            $this->SetX(140);
            $this->Cell(0, 0, 'Website:www.sscsr.gov.in', 0, 0, '', false);

            $this->SetY(50);
            $this->SetX(140);
            $this->Cell(0, 0, 'HelplineNo.919445195946 / 044-28251139', 0, 0, '', false);

            $this->SetY(55);
            $this->SetX(140);
            $this->Cell(0, 0, 'Email Id:', 0, 0, '', false);
            $this->SetY(55);
            $this->SetX(154);
            $this->SetFont('Arial', 'U', 9);
            $this->Cell(0, 0, 'sscsr.tn@nic.in', 0, 0, '', false);
            $this->Line(5,60,205,60);
        }
    }

    // Page footer
    function Footer()
    {

        /* if ($this->PageNo() == 1) {
            $this->SetY(-21);
            $this->SetFont('Arial', 'U', 8);

            $this->Cell(0, 8, "Note: Please click here to download instructions", 'T', 0, 'C');
        } */
    }



    var $B = 0;
    var $I = 0;
    var $U = 0;
    var $HREF = '';
    var $ALIGN = '';

    function WriteHTML($html)
    {
        //HTML parser
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                //Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                elseif ($this->ALIGN == 'center')
                    $this->Cell(0, 5, $e, 0, 1, 'C');
                else
                    $this->Write(5, $e);
            } else {
                //Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    //Extract properties
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $prop = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $prop[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $prop);
                }
            }
        }
    }

    function OpenTag($tag, $prop)
    {
        //Opening tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $prop['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);
        if ($tag == 'P')
            $this->ALIGN = $prop['ALIGN'];
        if ($tag == 'HR') {
            if (!empty($prop['WIDTH']))
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin - $this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x, $y, $x + $Width, $y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
        if ($tag == 'P')
            $this->ALIGN = '';
    }

    function SetStyle($tag, $enable)
    {
        //Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s)
            if ($this->$s > 0)
                $style .= $s;
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }

    protected $T128;                                         // Tableau des codes 128
    protected $ABCset = "";                                  // jeu des caractères éligibles au C128
    protected $Aset = "";                                    // Set A du jeu des caractères éligibles
    protected $Bset = "";                                    // Set B du jeu des caractères éligibles
    protected $Cset = "";                                    // Set C du jeu des caractères éligibles
    protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
    protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
    protected $JStart = array("A" => 103, "B" => 104, "C" => 105); // Caractères de sélection de jeu au début du C128
    protected $JSwap = array("A" => 101, "B" => 100, "C" => 99);   // Caractères de changement de jeu

    //____________________________ Extension du constructeur _______________________
    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4')
    {

        parent::__construct($orientation, $unit, $format);

        $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
        $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
        $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
        $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
        $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
        $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
        $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
        $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
        $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
        $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
        $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
        $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
        $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
        $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
        $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
        $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
        $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
        $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
        $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
        $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
        $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
        $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
        $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
        $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
        $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
        $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
        $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
        $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
        $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
        $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
        $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
        $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
        $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
        $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
        $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
        $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
        $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
        $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
        $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
        $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
        $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
        $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
        $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
        $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
        $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
        $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
        $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
        $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
        $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
        $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
        $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
        $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
        $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
        $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
        $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
        $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
        $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
        $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
        $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
        $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
        $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
        $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
        $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
        $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
        $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
        $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
        $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
        $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
        $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
        $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
        $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
        $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
        $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
        $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
        $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
        $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
        $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
        $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
        $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
        $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
        $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
        $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
        $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
        $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
        $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
        $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
        $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
        $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
        $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
        $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
        $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
        $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
        $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
        $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
        $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
        $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
        $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
        $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
        $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
        $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
        $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
        $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
        $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
        $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
        $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
        $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
        $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
        $this->T128[] = array(2, 1);                       //107 : [END BAR]

        for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
            $this->ABCset .= chr($i);
        }
        $this->Aset = $this->ABCset;
        $this->Bset = $this->ABCset;

        for ($i = 0; $i <= 31; $i++) {
            $this->ABCset .= chr($i);
            $this->Aset .= chr($i);
        }
        for ($i = 96; $i <= 127; $i++) {
            $this->ABCset .= chr($i);
            $this->Bset .= chr($i);
        }
        for ($i = 200; $i <= 210; $i++) {                                           // controle 128
            $this->ABCset .= chr($i);
            $this->Aset .= chr($i);
            $this->Bset .= chr($i);
        }
        $this->Cset = "0123456789" . chr(206);

        for ($i = 0; $i < 96; $i++) {                                                   // convertisseurs des jeux A & B
            @$this->SetFrom["A"] .= chr($i);
            @$this->SetFrom["B"] .= chr($i + 32);
            @$this->SetTo["A"] .= chr(($i < 32) ? $i + 64 : $i - 32);
            @$this->SetTo["B"] .= chr($i);
        }
        for ($i = 96; $i < 107; $i++) {                                                 // contrôle des jeux A & B
            @$this->SetFrom["A"] .= chr($i + 104);
            @$this->SetFrom["B"] .= chr($i + 104);
            @$this->SetTo["A"] .= chr($i);
            @$this->SetTo["B"] .= chr($i);
        }
    }

    //________________ Fonction encodage et dessin du code 128 _____________________
    function Code128($x, $y, $code, $w, $h)
    {
        $Aguid = "";                                                                      // Création des guides de choix ABC
        $Bguid = "";
        $Cguid = "";
        for ($i = 0; $i < strlen($code); $i++) {
            $needle = substr($code, $i, 1);
            $Aguid .= ((strpos($this->Aset, $needle) === false) ? "N" : "O");
            $Bguid .= ((strpos($this->Bset, $needle) === false) ? "N" : "O");
            $Cguid .= ((strpos($this->Cset, $needle) === false) ? "N" : "O");
        }

        $SminiC = "OOOO";
        $IminiC = 4;

        $crypt = "";
        while ($code > "") {
            // BOUCLE PRINCIPALE DE CODAGE
            $i = strpos($Cguid, $SminiC);                                                // forçage du jeu C, si possible
            if ($i !== false) {
                $Aguid[$i] = "N";
                $Bguid[$i] = "N";
            }

            if (substr($Cguid, 0, $IminiC) == $SminiC) {                                  // jeu C
                $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
                $made = strpos($Cguid, "N");                                             // étendu du set C
                if ($made === false) {
                    $made = strlen($Cguid);
                }
                if (fmod($made, 2) == 1) {
                    $made--;                                                            // seulement un nombre pair
                }
                for ($i = 0; $i < $made; $i += 2) {
                    $crypt .= chr(strval(substr($code, $i, 2)));                          // conversion 2 par 2
                }
                $jeu = "C";
            } else {
                $madeA = strpos($Aguid, "N");                                            // étendu du set A
                if ($madeA === false) {
                    $madeA = strlen($Aguid);
                }
                $madeB = strpos($Bguid, "N");                                            // étendu du set B
                if ($madeB === false) {
                    $madeB = strlen($Bguid);
                }
                $made = (($madeA < $madeB) ? $madeB : $madeA);                         // étendu traitée
                $jeu = (($madeA < $madeB) ? "B" : "A");                                // Jeu en cours

                $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

                $crypt .= strtr(substr($code, 0, $made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

            }
            $code = substr($code, $made);                                           // raccourcir légende et guides de la zone traitée
            $Aguid = substr($Aguid, $made);
            $Bguid = substr($Bguid, $made);
            $Cguid = substr($Cguid, $made);
        }                                                                          // FIN BOUCLE PRINCIPALE

        @$check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
        for ($i = 0; $i < strlen($crypt); $i++) {
            $check += (ord($crypt[$i]) * $i);
        }
        $check %= 103;

        $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

        $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
        $modul = $w / $i;

        for ($i = 0; $i < strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
            $c = $this->T128[ord($crypt[$i])];
            for ($j = 0; $j < count($c); $j++) {
                $this->Rect($x, $y, $c[$j] * $modul, $h, "F");
                $x += ($c[$j++] + $c[$j]) * $modul;
            }
        }
    }
}
