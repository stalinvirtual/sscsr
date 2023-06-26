<?php

namespace App\Helpers;

require_once(__DIR__ . "/../../dompdf/vendor/autoload.php");
require(__DIR__ . "/../../dompdf/autoload.inc.php");
require(__DIR__ . "/../../dompdf/vendor/dompdf/dompdf/src/Dompdf.php");
require("functions.php");

use Dompdf\Dompdf;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PdfHelperDMEExam extends Dompdf
{
    public static $PDF_TEMPLATE_PATH = __DIR__ . "/../../pdf/templates";

    public static function genereateAndDMEDownloadAdminCard($data)
    {
        ob_start();
         $document = new Dompdf();
         $exam_short_name = $data['exam_name']->table_exam_short_name;
         $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
         $tier_id = $data['tier_id'];
         $pdfname = $data['pdf_name'] ;
		foreach($data['admitcardresults'] as $value){
			if($value["col_name"] == "reg_no"){
				$file_name = $value["col_value"];
			}
			if($value["col_name"] == "pet_date"){
				$pet_col_description = $value["col_description"];
				$date = $value["col_value"];
				$pet_date = getDobFormat($date);
			}
			if($value["col_name"] == "dob"){
				$dob_col_description = $value["col_description"];
				$date = $value["col_value"];
				$dob_date = getDobFormat($date);
			}
			
			switch ($value["is_dme_order"]) {
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
                    case "7":
                    //repotime
                   $key7 = $value["col_description"];
                   $value7 = valueAdded($value["col_value"]);
                   break;

                   case "8":
                    //gender
                   $key8 = $value["col_description"];
                   $value8 = $value["col_value"];
                   break;
                    case "9":
                    //cand_name
                    $key9 = $value["col_description"];
                   $value9 = $value["col_value"];
                   break;
                    case "10":
                    // new_name
                   $key10 = $value["col_description"];
                   $value10 = $value["col_value"];
                   break;
                    case "11":
                   //photo_id
                    $value11 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA'  ?  $value["col_value"] : "photo_not_exists.png";
                    $full_photo_path = photoPath($data);
                    $photo_path = $full_photo_path.$value11;
                    $ch = curl_init($photo_path);
                    curl_setopt($ch, CURLOPT_NOBODY, true);
                    curl_exec($ch);
                    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    if( $retcode ==200) {
                       $photo_path = $photo_path;
                    }
                    else{
                     $base_url = "http://10.163.2.160";
                        $local_path =  $base_url ."/projects/sscsr/site/";
                        $photo_path =  $local_path."exam_assets/photo_not_exists.png";
                             
                       }

                   break;
                    case "6":
                     //DOB
                   $key6 = $value["col_description"];
                   $value6 = $value["col_value"];
                   //echo  $value16;
                   $dme_date = $value6;
                   break;
                   case "12":
                   //Date Of DME
                   $key12 = $value["col_description"];
                   $value12 = $value["col_value"];
                   $dob_date = getDobFormat($value12);
                   break;
                   case "13":
                   //category
                   $key13 = $value["col_description"];
                   $value13 = $value["col_value"];
                   break;
                   case "14":
                   //sign_id
                
                $value14 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA' ? $value["col_value"] : "sign_not_exits.png" ;
                $full_sign_path = signPath($data);
                $sign_path = $full_sign_path.$value14;
                $ch = curl_init($sign_path);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_exec($ch);
                $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if( $retcode ==200) {
                   $sign_path = $sign_path;
                }
                else{

                 }
                   break;
                   case "16":
                   //dme venue
                   $key16 = $value["col_description"];
                   $value16 = $value["col_value"];
                   break;
                 default:
                   //echo "Your favorite color is neither red, blue, nor green!";
               }
			}
            $exam_name_based_tier_year = $data['exam_name']->exam_name . " (" . $data['exam_name']->table_exam_year . ") " . strtoupper($data['exam_type']);
            $headerImg = $GLOBALS['pdf_header_image_server_path'] ."HEADER.png" ;
            $qrcode_value = "RollNo=" .$value4.","."Name=".$value9.","."DOB=" .$value6;
            $qrcode =  '<img  style="width:70px;height:70px;" src="'.(new \chillerlan\QRCode\QRCode)->render($qrcode_value).'" alt="QR Code" />';
            $barcode_Value ='RollNo='.$value4;
            $barcode =  '<img  width="60%" style="padding-bottom:10px;height:50px" src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode_Value, $generator::TYPE_CODE_128,3,50)) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';


            $output = '
            <style>
         .tableClass td, .tableClass th  {
         border:1px solid black;
         border-collapse: collapse;
         }
         .tableClass   {
         border:1px solid black;
         border-collapse: collapse;
         }
         body{
         font-family: Arial, Helvetica, sans-serif;    
         font-size:10 ;       
         }
         td {
         text-align: center;
         padding: 6px;
         }
         .header-class{
         border:1px solid black;
         height:auto;
         padding-left:5px;
         padding-top:5px;
         padding-bottom:5px;
         }
         div p{
         padding-left:50px;
         }
         .headerClass{
         color:red;
         }
       
    
         .fontSizeClass{
            font-size:12px !important ;
           }
           .headingClass{
            text-align:center;
            line-height: 1.5;
            font-size:15px !important;
            text-decoration: underline;
        
         }
    
         *{
            font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;    
           // font-size:12px;
         }
         .outer-table{
            width:100%
         }
         
         
         
         .outer-table, .outer-table td, .outer-table th{
            border:1px solid #000;
            border-collapse:collapse; 
            
            text-align:center;  
            
         }
         .inner-table {
            width:100%;
            border:0px;
            border-collapse:collapse; 
            
         }
         .inner-table tr{
            border-spacing:-1px;  
         }
         .inner-table td{
            border-spacing:-1px;
            padding:3px;
            white-space: nowrap;
            text-align:left;  
         }
         .page-break{
            page-break-before : always;
         }
      </style>
      <div class="header-class">
         <img src='.$headerImg .' style="width:100%;height:130px">
      </div><br>
      <div class="headingClass"><b>e-ADMISSION CERTIFICATE</b></div>
      <div class="headingClass">'.$value1.'</div>
      <div class="headingClass">'. $value2 .'</div>
      <br><br> <br><br> <br>
      <!-- Barcode ,Register No, Ticket No  -->
      <table class= "tableClass" style="width:100%">
         <tr style="height:200px">
            <td rowspan="2" width="50%" class="fontSizeClass">'. $barcode.  ''. $qrcode.  '</td>
            <td  style="text-align: left" class="fontSizeClass"><b>'.$key3.': </b> '. $value3 .'</td>
         </tr>
         <tr style="height:200px">
            <td style="text-align: left" class="fontSizeClass"><b>'.$key5.' : </b> '. $value5 .' </td>
         </tr>
      </table>
      <!-- Barcode ,Register No, Ticket No  -->
      <!-- Roll Number and Date of DME -->
      <table  class= "tableClass" style="width:100%">
         <tr style="height:200px">
            <td  style="text-align: left" width="50%" class="fontSizeClass"><b>'.$key4.' : </b>'. $value4 .' </td>
            <td  style="text-align: left" class="fontSizeClass"><b>'.$key6.' : </b> '. $value6 .' </td>
         </tr>
      </table>
      <!-- Roll Number and and Date of DME -->
      <!-- Gender and Reporting Time -->
    
    
      <table  class= "tableClass" style="width:100%">
         <tr style="padding:10px">
            <td  style="text-align: left" width="50%" class="fontSizeClass"><b>'.$key8.': </b>'. $value8 .'</td>
            <td  style="text-align: left" class="fontSizeClass"><b>'.$key7.': </b> '. $value7 .' </td>
         </tr>
      </table>
      <!-- Gender and Reporting Time -->
      
    
      <!-- Candidate Name,New or Changed Name , Photo  -->
      <table style="width:100.5%;height:100px;margin-left:-2px !important"; class= "tableClass2">
         <tr>
            <td style="width:79%; vertical-align: text-top;text-align:left;border:1px solid black;border-collapse: collapse;">
               <div style="text-align:left;line-height: 2"><b>'.$key9.'</b></div>
               <div style=" text-align:left;line-height: 2">'. $value9 .'</div>
               <div style="text-align:left;line-height: 2"><b>New or Changed Name</b></div>
               <div style=" text-align:left;line-height: 2">'. $value9 .'</div>
            </td>
            <td style="width:21%;border:1px solid black;border-collapse: collapse;"><img src='.$photo_path.' width="100" height="100"></td>
         </tr>
      </table>
      <!-- Candidate Name,New or Changed Name , Photo  -->
      <!-- DOB ,Category,Sign  --->
      <table  style="width:100%" class= "tableClass">
         <tr style="height:200px !important">
            <td  style="text-align: left" width="40%"><b>'.$key12.': </b> '.$value12.'</td>
            <td  style="text-align: left" width="40%"><b>'.$key13.': </b> '.$value13.' </td>
            <td  style="text-align: left" width="21.5%">';
         $ch = curl_init($sign_path);
         curl_setopt($ch, CURLOPT_NOBODY, true);
         curl_exec($ch);
         $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
         curl_close($ch);
    
         
         if( $retcode ==200) {
            $sign_path = $sign_path;
            $output .=  '<img src='.$sign_path.' width="130" height="50">';
         }
    
         if($value21 == "NA"){
    
            $value21 ="";
    
         }
         else{
            $value21 = $value21;
         }
    
         if($value22 == "NA"){
    
            $value22 ="";
    
         }
         else{
            $value22 = $value22;
         }
            $output .= '
         </td>
         </tr>
      </table>
      <!-- DOB ,Category,Sign  --->
      <!-- Post Preference  --->
      <!-- <table  style="width:100%" class= "tableClass">
         <tr style="height:200px !important">
            <td  style="text-align: left" width="36%"><b>'.$key9.': </b> '.$value9.' </td>
         </tr>
      </table> -->
      <!-- Post Preference --->
      <!-- Candidate \'s Address-->
      <table  style="width:100%"; class= "tableClass">
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
               <b> Candidate\'s Address :  </b> 
            </td>
         </tr>
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               '.$data['candidate_address'].'
            </td>
         </tr>
      </table>
      <!-- Candidate\'s Address -->
      <!-- Examination Venue-->
      <table  style="width:100%"; class= "tableClass">
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
               <b> '. $key16.' :  </b> 
            </td>
         </tr>
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
                '.$value16 .'   
            </td>
         </tr>
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
               '.$value20.'
               
            </td>
         </tr>
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
               <b> '.$value21 .'  </b> 
            </td>
         </tr>
         <tr>
            <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
            '.$value22.'
            </td>
         </tr>
      </table>
      <!-- Examination Venue -->
      ';
      $output  .='<div class="page-break"></div>
      <div class="myDiv">
      <img src='.$last_line.' style="width:100%;height:130px">
      </div>';
      echo $output;
      $data = ob_get_clean();
      $document->loadHtml($output);
      $document->set_option('isRemoteEnabled',true);
      $document->setPaper('A4', 'portait');
      $document->render();

      //First Pdf insert 
      $output = $document->output();
      $admitcardpdf = self::$PDF_TEMPLATE_PATH."/".$file_name.".pdf";
      file_put_contents($admitcardpdf, $output);
      $pdf = new \Clegginabox\PDFMerger\PDFMerger;
      $pdf->addPDF($admitcardpdf, '1');
      if( $pdfname ==""){
      }
      else{
      $pdfPath = $GLOBALS['local_instructions_path'];
      $pdf_file = $pdfPath.$pdfname;
      $pdf->addPDF($pdf_file);
      }
      $pdf->merge('browser', $value3.'.pdf', 'P');
      //First Pdf insert

	}
}

