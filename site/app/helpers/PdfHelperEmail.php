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
class PdfHelperEmail extends Fpdi
{
    public static $PDF_TEMPLATE_PATH = __DIR__ . "/../../pdf/templates";

    public static function genereateAndDownloadAdminCardEmail($data)
    {
		  
      

        $pdf = new PDF();
		
		$v_value18 ='';
		
        // echo '<pre>';
        // print_R($data);

        $exam_short_name = $data['exam_name']->table_exam_short_name;



       // echo count($data['admitcardresults']);



        
       

		
		foreach($data['admitcardresults'] as $valueInner){

            foreach($valueInner as $value){
			
			if($value["col_name"] == "paper1"){
				$paper1 = $value["col_value"];
                
			}
			if($value["col_name"] == "paper2"){
				$paper2 = $value["col_value"];
			}
            if($value["col_name"] == "paper3"){
                $paper3 = $value["col_value"];
            }
            if($value["col_name"] == "paper4"){
                $paper4 = $value["col_value"];
            }
			
			if($value["col_name"] == "reg_no"){
				$file_name = $value["col_value"];
                //echo $file_name."<br>";
			}
			
			if($value["col_name"] == "pet_date"){
				$pet_col_description = $value["col_description"];
				$date = $value["col_value"];
				//$pet_date = getDobFormat($date);
			}
			if($value["col_name"] == "dob"){
				$dob_col_description = $value["col_description"];
				$date = $value["col_value"];
				//$dob_date = getDobFormat($date);
			}
			
			switch ($value["is_tier_order"]) {
			  case "1":
			     //ac_main_title 
				$key1 = $value["col_description"];
				$value1 = $value["col_value"];
				break;
			  case "2":
			  //ac_sub_title
				$key2 = $value["col_description"];
				$value2 = $value["col_value"];
				break;
			  case "3":
			  //reg_no
				$key3 = $value["col_description"];
				$value3 = $value["col_value"];
				break;
			  case "4":
			   //roll_no
				$key4 = $value["col_description"];
				$value4 = $value["col_value"];
				break;
				 case "5":
				 // ticket_no
				$key5 = $value["col_description"];
				$value5 = $value["col_value"];
				break;
				 case "6":
				 //scribe_opted_medium
				$key6 = $value["col_description"];
				$value6 = $value["col_value"];
				break;
				 case "7":
				 // password_for_examination
				$key7 = $value["col_description"];
				$value7 = $value["col_value"];
				break;
				case "8":
				 //gender
				$key8 = $value["col_description"];
				$value8 = $value["col_value"];
				break;
				case "9":
				 // post_preference
				$key9 = $value["col_description"];
				$value9 = $value["col_value"];
				break;
				 case "10":
				 //repotime
				$key10 = $value["col_description"];
				$value10 = valueAdded($value["col_value"]);
				break;
				 case "11":
				 //gateclose
				$key11 = $value["col_description"];
				$value11 = valueAdded($value["col_value"]);
				break;
				 case "12":
				 //cand_name
				 
				 $key12 = $value["col_description"];
				$value12 = $value["col_value"];
				break;
				 case "13":
				 // new_name
				$key13 = $value["col_description"];
				$value13 = $value["col_value"];
				break;
				 case "14":

				$value14 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA'  ?  $value["col_value"] : "photo_not_exists.png";

               
                        $full_photo_path = photoPath($data);
						$photo_path = $full_photo_path.$value14;

                        
						if(file_exists($photo_path)){
                            $photo_path = $photo_path;
						}
						else{
							$photo_path = "exam_assets/photo_not_exists.png";
							
							}


                           // echo $photo_path ;
				break;
				 case "15":
				  //DOB
				$key15 = $value["col_description"];
				$value15 = $value["col_value"];
				$dob_date = getDobFormat($value15);
				break;
				case "16":
				//category
				$key16 = $value["col_description"];
				$value16 = $value["col_value"];
				break;
				case "17":
				//sign_id
				$value17 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA' ? $value["col_value"] : "sign_not_exits.png" ;
				
                            $full_sign_path = signPath($data);
                            $sign_path = $full_sign_path.$value17;
                         
                            if(file_exists($sign_path)){
                                $sign_path = $sign_path;
                            }
				break;
				
				
				case "18":
				//present_state
				@$v_value18 .= $value["col_value"].", ";
				$value18= $v_value18;
				
				
				break;
				
				case "19":
				//venue1_title
				$key19 = $value["col_description"];
				$value19 = $value["col_value"];
				break;
				
				case "20":
				//venue1_address
				$key20 = $value["col_description"];
				$value20 = $value["col_value"];
				break;
				
				case "21":
				//venue2_title
				$key21 = $value["col_description"];
				$value21 = $value["col_value"];
				break;
				case "22":
				//venue2_address
				$key22 = $value["col_description"];
				$value22 = $value["col_value"];
				break;
				case "23":
				//paper1
				$value23 = valueAdded($value["col_value"]);
				break;
				case "24":
				//subject1
				
				$value24 = valueAdded($value["col_value"]);
				break;
				case "25":
				//date1
				
				$value25 =  valueAdded($value["col_value"]);
				break;
				case "26":
				//shift1
				
				$value26 =  valueAdded($value["col_value"]);
				break;
				case "27":
				//time1
				
				$value27 =  valueAdded($value["col_value"]);
				break;
				case "28":
				//mark1
				
				$value28 =  valueAdded($value["col_value"]);
                break;
				case "29":
				//paper2
				$value29 = valueAdded($value["col_value"]);
				break;
				case "30":
				//subject2
				
				$value30 = valueAdded($value["col_value"]);
				break;
				case "31":
				//date2
				
				$value31 =  valueAdded($value["col_value"]);
				break;
				case "32":
				//shift2
				
				$value32 =  valueAdded($value["col_value"]);
				break;
				case "33":
				//time2
				
				$value33 =  valueAdded($value["col_value"]);
				break;
				case "34":
				//mark2
				
				$value34 =  valueAdded($value["col_value"]);
				break;
                case "35":
                //paper3
                $value35 = valueAdded($value["col_value"]);
                break;
                case "36":
                //subject3
                
                $value36 = valueAdded($value["col_value"]);
                break;
                case "37":
                //date3
                
                $value37 =  valueAdded($value["col_value"]);
                break;
                case "38":
                //shift3
                
                $value38 =  valueAdded($value["col_value"]);
                break;
                case "39":
                //time3
                
                $value39 =  valueAdded($value["col_value"]);
                break;
                case "40":
                //mark3
                
                $value40 =  valueAdded($value["col_value"]);
                break;
                case "41":
                //paper4
                $value41 = valueAdded($value["col_value"]);
                break;
                case "42":
                //subject4
                $value42 = valueAdded($value["col_value"]);
                break;
                case "43":
                //date4
                $value43 =  valueAdded($value["col_value"]);
                break;
                case "44":
                //shift4
                $value44 =  valueAdded($value["col_value"]);
                break;
                case "45":
                //time4
                $value45 =  valueAdded($value["col_value"]);
                break;
                case "46":
                //mark4
                $value46 =  valueAdded($value["col_value"]);
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
        $pdf->Cell(190, 5, 'e-ADMISSION CERTIFICATE for', 0, 1, 'C');
        $pdf->Cell(190, 5, $value1, 0, 1, 'C');

        $pdf->Cell(190, 5, $value2, 0, 1, 'C');

        $pdf->Image("http://chart.apis.google.com/chart?chs=300x300&cht=qr&chl=".$value3."&choe=UTF-8%22%20", 10, 50, 20, 20, "png");
        //RegNo & Barcode
        $pdf->SetY(50);
        $pdf->SetX(10);
        $pdf->Code128(45, 55, $value3, 50, 10);
        $pdf->Cell(95, 21, '', 1, 0, 'C', false);
        $pdf->Cell(95, 21, '', 1, 0, 'C');
        $pdf->SetY(50);
        $pdf->SetX(10);
        $pdf->Cell(95, 8, '', 0, 0, 'L');
        $pdf->Cell(95, 8, $key3.": ".$value3, 0, 0, 'L');
        $pdf->SetY(59);
        $pdf->SetX(10);
        $pdf->Cell(95, 8, '', 0, 0, 'L');
        $pdf->Cell(95, 12,  $key5.": ".$value5, 1, 0, 'L');

        $pdf->SetFont('Arial', 'B', 10);

         //Roll Number & Opted for Scribe
            
         $pdf->SetY(71);
         $pdf->SetX(10);
         $pdf->Cell(95, 8,  $key4.": ".$value4, 0, 0, 'L');
 
         $pdf->SetFont('Arial', '', 10);
         $pdf->SetY(71);
         $pdf->SetX(10);
         $pdf->Cell(95, 20, '(to be used as User ID)', 0, 0, 'L');
        
 
         
       
 
 
         $pdf->SetY(71);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', '', 9);
         $pdf->Cell(95, 14, '', 1, 0, 'L');
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->Cell(95, 14,  $key6.": ".$value6, 1, 0, 'L');
 
         //PassWord & gender
         $pdf->SetY(85);
         $pdf->SetX(10);
         $pdf->Cell(95, 8,  $key7.": ".$value7, 0, 0, 'L');
         $pdf->Cell(95, 15,'', 1, 0, '');
         $pdf->SetY(85);
         $pdf->SetX(10);
         $pdf->Cell(95, 15,  '', 1, 0, 'L');
         $pdf->Cell(95, 8, $key8.": ".$value8, 0, 0, 'L');
 
         //Exam Date & repoting time & entry closing time
 
 
        
 
 
 
 
 
         $pdf->SetY(100);
         $pdf->SetX(10);
         
         $pdf->Cell(95, 8,$key10, 0, 0, '');
         $pdf->Cell(95, 8,$key11, 0, 0, '');
 
         $pdf->SetY(100);
         $pdf->SetX(10);
       
         $pdf->Cell(95, 16,'', 1, 0, '');
         $pdf->Cell(95, 16,'', 1, 0, '');
         $pdf->SetFont('Arial','', 10);
 
         $pdf->SetY(103);
         $pdf->SetX(10);
       
         $pdf->Cell(95, 16, utf8_decode($value10), 0, 0, 'C');
         $pdf->Cell(95, 16,utf8_decode($value11), 0, 0, 'C');
 
         //candidate name & photo 
         $pdf->SetY(116);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->Cell(142, 8, $key12, 0, 0, 'L');
         $pdf->Cell(48, 8, '', 0, 0, '');
 
         $pdf->SetY(119);
         $pdf->SetX(20);
         $pdf->Cell(142, 8, '', 0, 0, 'C');
         
         $pdf->Cell(0, 0, $pdf->Image($photo_path,$pdf->GetX(), $pdf->GetY()), 0, 0, 'C');
         
         $pdf->SetY(116);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', '', 10);
         $pdf->Cell(142, 18, $value12, 0, 0, 'L');
 
         $pdf->SetY(119);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->Cell(142, 32, $key13, 0, 0, 'L');
         $pdf->Cell(48, 32, '', 0, 0, '');
 
         $pdf->SetY(122);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', '', 10);
         $pdf->Cell(142, 39, $value13, 0, 0, 'L');
         $pdf->Cell(48, 39, '', 0, 0, '');
 
         $pdf->SetY(116);
         $pdf->SetX(10);
         $pdf->Cell(142, 39, '', 1, 0, 'C');
         $pdf->Cell(48, 39, '', 1, 0, '');
 
         //dob & category & sign
         $pdf->SetY(155);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->Cell(47, 8, $key15, 0, 0, 'L');
         $pdf->Cell(95, 8, $key16, 0, 0, 'L');
         if(file_exists($sign_path)){
             $pdf->Cell(0, 0, $pdf->Image($sign_path, $pdf->GetX(), $pdf->GetY(), 40,15), 0, 0, 'C',true);
         }
         else{
             $sign_path = "exam_assets/sign_not_exits.png";
                 
             $pdf->Cell(0, 0, $pdf->Image($sign_path, $pdf->GetX(),$pdf->GetY(), 40,15), 0, 0, 'C',true);
         }
 
         
         $pdf->SetY(157);
         $pdf->SetX(10);
         $pdf->Cell(47, 12, '', 0, 0, 'C');
         $pdf->SetFont('Arial', '', 10);
         $pdf->Cell(95, 12, $value16, 0, 0, 'C');
         $pdf->Cell(48, 15, '', 0, 0, 'L');
         $pdf->SetY(157);
         $pdf->SetX(10);
         $pdf->Cell(47, 15, $date, 0, 0, 'C');
         $pdf->Cell(95, 15, '', 0, 0, 'L');
         $pdf->Cell(48, 15, '', 0, 0, 'L');
 
         $pdf->SetY(155);
         $pdf->SetX(10);
         $pdf->Cell(47, 15, "", 1, 0, 'C');
         $pdf->Cell(95, 15, '', 1, 0, 'L');
         $pdf->Cell(48, 15, '', 1, 0, 'L');
         //$short_name = 
 
         //if($exam_short_name == 'spe'){
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->SetY(170);
         $pdf->SetX(10);
         $pdf->Cell(190, 10, $key9.':   '.$value9, 1, 0, 'L');
         $pdf->SetFont('Arial', '', 10);
         //Candidate Address
         $pdf->SetY(173);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->Cell(170, 19, "Candidate's Address:", 0, 0, 'L');
         $pdf->SetY(185);
         $pdf->SetX(15);
         $pdf->SetFont('Arial', '', 10);
         $pdf->MultiCell(190,5,($data['candidate_address']), 0, 'L');
         $pdf->SetY(180);
         $pdf->SetX(10);
         $pdf->SetFont('Arial', '', 10);
         $pdf->Cell(190, 15, '', 1, 0, 'L');
 
         
     //Examination venue
 
     $pdf->SetY(188);
     $pdf->SetX(10);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->Cell(190, 20, "Examination Venue: ", 0, 0, 'L');
 
     $pdf->SetY(192);
     $pdf->SetX(15);
     $pdf->SetFont('Arial', '', 10);
     $pdf->Cell(190, 20, $value19 != 'NA' ? $value19 : "", 0, 0, 'L');
 
     $pdf->SetY(195);
     $pdf->SetX(15);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->Cell(190, 48,$value21 != 'NA' ? $value21 : "", 0, 0, 'L');
 
     $pdf->SetY(205);
     $pdf->SetX(15);
     $pdf->SetFont('Arial', '', 10);
     $pdf->MultiCell(180,5,$value20 != 'NA' ? $value20 : "", 0, 'L');
 
     $pdf->SetY(205);
     $pdf->SetX(15);
     $pdf->MultiCell(180,5,$value22 != 'NA' ? $value22 : "", 0, 'L');
     
     $pdf->SetY(195);
     $pdf->SetX(10);
     $pdf->Cell(190, 36, "", 1, 0, 'L');
     $pdf->SetFont('Arial', '', 10);
 
 
         //Subject Details
         $pdf->SetFont('Arial', 'B', 7);
         $pdf->SetY(230);
         $pdf->SetX(10);
         $pdf->Cell(30, 6, '', 0, 0, 'C');
         $pdf->Cell(75, 6, '', 0, 0, 'C');
         $pdf->Cell(20, 6, '', 0, 0, 'C');
         $pdf->Cell(10, 6, '', 0, 0, 'C');
         $pdf->Cell(40, 6, 'Time of', 0, 0, 'C');
         $pdf->Cell(15, 6, ' ', 0, 0, 'C');
 
 
         $pdf->SetY(231);
         $pdf->SetX(10);
         $pdf->Cell(30, 12, 'Paper', 1, 0, 'C');
         $pdf->Cell(75, 12, 'Subject', 1, 0, 'C');
         $pdf->Cell(20, 12, 'Date of Exam', 1, 0, 'C');
         $pdf->Cell(10, 12, 'Shift', 1, 0, 'C');
         $pdf->Cell(40, 12, ' Exam ', 1, 0, 'C');
         $pdf->Cell(15, 12, ' Marks', 1, 0, 'C');	
         $pdf->SetFont('Arial', '', 8);
 
         /**
          * @author Stalin
          * @subject  Paper1
          */
         if ($paper1 != "NA" && $paper2 == "NA") {
             $date_height = 28;
             $shift_height = 28;
             $time_height = 28;
         } else {
             $date_height = 7;
             $shift_height = 7;
             $time_height = 7;
         }
 
         if ($paper1 != "NA") {
             $pdf->SetY(243);
             $pdf->SetX(10);
             $pdf->MultiCell(30, 7, utf8_decode($value23), 1, 'C');
             $pdf->SetY(243);
             $pdf->SetX(40);
             $pdf->SetFont('Arial', '', 8);
             $pdf->MultiCell(75, 7, utf8_decode($value24), 1, 'C');
             $pdf->SetY(243);
             $pdf->SetX(115);
             $pdf->MultiCell(20, $date_height, getDateFormate($value25) , 1, 'C');
             $pdf->SetY(243);
             $pdf->SetX(135);
             $pdf->MultiCell(10, $shift_height, utf8_decode($value26), 1, 'C');
             $pdf->SetY(243);
             $pdf->SetX(145);
             $pdf->SetFont('Arial', '', 7);
             $pdf->MultiCell(40, $time_height, utf8_decode($value27), 1, 'C');
             $pdf->SetFont('Arial', '', 9);
             $pdf->SetY(243);
             $pdf->SetX(185);
 
             $pdf->MultiCell(15, 7, utf8_decode($value28), 1, 'C');
         } else {
 
         }
 
 
         if ($paper2 != "NA") {
             $pdf->SetY(250);
             $pdf->SetX(10);
             $pdf->MultiCell(30, 7, utf8_decode($value29), 1, 'C');
             $pdf->SetY(250);
             $pdf->SetX(40);
             $pdf->SetFont('Arial', '', 8);
             $pdf->MultiCell(75, 7, utf8_decode($value30), 1, 'C');
             $pdf->SetY(250);
             $pdf->SetX(115);
             $pdf->MultiCell(20, 7, getDateFormate($value31) , 1, 'C');
             $pdf->SetY(250);
             $pdf->SetX(135);
             $pdf->MultiCell(10, 7, utf8_decode($value32), 1, 'C');
             $pdf->SetY(250);
             $pdf->SetX(145);
             $pdf->SetFont('Arial', '', 7);
             $pdf->MultiCell(40, 7, utf8_decode($value33), 1, 'C');
             $pdf->SetFont('Arial', '', 9);
             $pdf->SetY(250);
             $pdf->SetX(185);
             $pdf->MultiCell(15, 7, utf8_decode($value34), 1, 'C');
         } else {
         } 
 
         if ($paper3 != "NA") {
             $pdf->SetY(257);
             $pdf->SetX(10);
             $pdf->MultiCell(30, 7, utf8_decode($value35), 1, 'C');
             $pdf->SetY(257);
             $pdf->SetX(40);
             $pdf->SetFont('Arial', '', 8);
             $pdf->MultiCell(75, 7, utf8_decode($value36), 1, 'C');
             $pdf->SetY(257);
             $pdf->SetX(115);
             $pdf->MultiCell(20, 7,  getDateFormate($value37), 1, 'C');
             $pdf->SetY(257);
             $pdf->SetX(135);
             $pdf->MultiCell(10, 7, utf8_decode($value38), 1, 'C');
             $pdf->SetY(257);
             $pdf->SetX(145);
             $pdf->SetFont('Arial', '', 7);
             $pdf->MultiCell(40, 7, utf8_decode($value39), 1, 'C');
             $pdf->SetFont('Arial', '', 9);
             $pdf->SetY(257);
             $pdf->SetX(185);
             $pdf->MultiCell(15, 7, utf8_decode($value40), 1, 'C');
         } else {
         }
 
         if ($paper4 != "NA") {
             $pdf->SetY(264);
             $pdf->SetX(10);
             $pdf->MultiCell(30, 7, utf8_decode($value41), 1, 'C');
             $pdf->SetY(264);
             $pdf->SetX(40);
             $pdf->SetFont('Arial', '', 8);
             $pdf->MultiCell(75, 7, utf8_decode($value42), 1, 'C');
             $pdf->SetY(264);
             $pdf->SetX(115);
             $pdf->MultiCell(20, 7,  getDateFormate($value43), 1, 'C');
             $pdf->SetY(264);
             $pdf->SetX(135);
             $pdf->MultiCell(10, 7, utf8_decode($value44), 1, 'C');
             $pdf->SetY(264);
             $pdf->SetX(145);
             $pdf->SetFont('Arial', '', 7);
             $pdf->MultiCell(40, 7, utf8_decode($value45), 1, 'C');
             $pdf->SetFont('Arial', '', 9);
             $pdf->SetY(264);
             $pdf->SetX(185);
             $pdf->MultiCell(15, 7, utf8_decode($value46), 1, 'C');
         } else {
         }
 
 
          if($data['pdf_name'] !=""){
 
             $pdfPath = instpath();
             $pdf_file = $pdfPath.$data['pdf_name'];
             $sourcePdfPath = $pdf_file;
             $pageCount = $pdf->setSourceFile($sourcePdfPath);
             for ($pageNo = 1; $pageNo <=  $pageCount; $pageNo++) {
                 $pageId = $pdf->importPage($pageNo, PdfReader\PageBoundaries::MEDIA_BOX);
                 $pdf->addPage();
                 $pdf->useImportedPage($pageId, 10, 10, 190);
             }
         }   
 


        /***********
         * 
         * File Path
         * 
         * 
         */
        $newdir =$_POST['examname'].'_'.$_POST['exam_year'];
        $newdir = strtolower($newdir);
    
        //fetch the current working directory
        $curdir= getcwd();
        // append the "images" directory to your current working directory 
         $dir=$curdir."/exam_assets/ftp";
        // // append the "$newdir" directory to your image directory path 
         $path=$dir."/$newdir"; 
         $pdf->Output($path."/".$file_name.".pdf", 'F');


        } // Forech End
	

     
  

       

     //}
  
      
  


     //https://stackoverflow.com/questions/35997961/file-attachment-with-phpmailer

       // exit;














        
        // exit;
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
            $this->Cell(190, 27, '', 1, 0, '');
            $this->Cell(5, 0, $this->Image('exam_assets/fpdf_ssc_header.png', 12, $this->SetY(7), 65), 0, 0, 'false');
            $this->SetY(6);
            $this->SetX($x_value);
            $this->Cell(5, 0, '', 0, 0, 'L', false);
            $this->Cell(0, 0, $this->Image('exam_assets/logo.jpg', 88, $this->SetY(7), 25), 0, 0, '', false);
            $this->SetY(10);
            $this->SetX(120);
            $this->Cell(0, 0, 'Staff Selection Commission', 0, 0, '', false);

            $this->SetY(15);
            $this->SetX(120);
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 0, 'Region:', 0, 0, '', false);
            $this->SetY(15);
            $this->SetX(131);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(0, 0, 'Southern Region', 0, 0, '', false);

            $this->SetY(20);
            $this->SetX(120);
            $this->Cell(0, 0, 'Website:www.sscsr.gov.in', 0, 0, '', false);

            $this->SetY(25);
            $this->SetX(120);
            $this->Cell(0, 0, 'HelplineNo.919445195946 / 044-28251139', 0, 0, '', false);

            $this->SetY(30);
            $this->SetX(120);
            $this->Cell(0, 0, 'Email Id:', 0, 0, '', false);
            $this->SetY(30);
            $this->SetX(134);
            $this->SetFont('Arial', 'U', 9);
            $this->Cell(0, 0, 'sscsr.tn@nic.in', 0, 0, '', false);
        }
    }

    // Page footer
    function Footer()
    {

       // if ($this->PageNo() == 1) {
          //  $this->SetY(-21);
            //$this->SetFont('Arial', 'U', 8);

            //$this->Cell(0, 8, "Note: Please click here to download instructions", 'T', 0, 'C');
       // }
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

        $check = ord(@$crypt[0]);                                                   // calcul de la somme de contrôle
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
