<?php

namespace App\Helpers;
require_once(__DIR__ . "/../../dompdf/vendor/autoload.php");
require(__DIR__ . "/../../dompdf/autoload.inc.php");
require(__DIR__ . "/../../dompdf/vendor/dompdf/dompdf/src/Dompdf.php");


//echo __DIR__ . "/../../dompdf/vendor/autoload.php";





require("functions.php");

use Dompdf\Dompdf;


class PdfHelperDVExam extends Dompdf
{
  public static $PDF_TEMPLATE_PATH = __DIR__ . "/../../pdf/templates";
    public static function genereateAndDVDownloadAdminCard($data)
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
            // $full_photo_path = photoPath($data);
            // $photo_path = $full_photo_path.$value7;
            // if(file_exists($photo_path)){
            //     $photo_path = $photo_path;
            // }
            // else{
            //     $photo_path = "exam_assets/photo_not_exists.png";
                
            //     }


                    $full_photo_path = photoPath($data);
                    $photo_path = $full_photo_path.$value7;
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
                                $local_path =  $base_url ."/sscsr/site/";
                                $photo_path =  $local_path."exam_assets/photo_not_exists.png";
                                
                        }
            
            break;
             case "8":
            //Sign id
            $value8= $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA' ? $value["col_value"] : "sign_not_exits.png" ;
            
            // $full_sign_path = signPath($data);
            // $sign_path = $full_sign_path.$value8;
         
            // if(file_exists($sign_path)){
            //     $sign_path = $sign_path;
            // }


            $full_sign_path = signPath($data);
            $sign_path = $full_sign_path.$value8;
            $ch = curl_init($sign_path);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

           
            if( $retcode ==200) {
                $sign_path = $sign_path;
            }
            else{
              $base_url = "http://10.163.2.160";
              $local_path =  $base_url ."/projects/sscsr/site/";
              $local_path =  $base_url ."/sscsr/site/";
              $sign_path =  $local_path."exam_assets/sign_not_exits.png";
              
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
      $india_75_img =  $GLOBALS['pdf_header_image_server_path'] ."india75.png";
      $headerImg = $GLOBALS['pdf_header_image_server_path'] ."HEADER.png" ;
      $barcode =  '<img  src="data:image/png;base64,' . base64_encode($generator->getBarcode(  $value4, $generator::TYPE_CODE_128)) . '">';

      $qrcode =  '<div style="position:relative;right:140px;top:35px"><img  style="width:70px;height:60px;" src="'.(new \chillerlan\QRCode\QRCode)->render($value4).'" alt="QR Code" /></div>';

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
      //font-size:12px;
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
    /** Define the footer rules **/
    footer {
        position: fixed; 
        bottom: 0cm; 
        left: 0cm; 
        right: 0cm;
        height: 2cm;

        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 1.5cm;
    }
    .myDiv {
        border: 5px outset red;
        background-color: lightblue;
        text-align: center;
        position:fixed:
        top: 100px; 
      }
      .page-break{
        page-break-before : always;
      }
</style>

<div class="header-class">

<div style="text-align: left;position:relative:top:5px">
  <img src='.$india_75_img.' style="width:100PX;height:40px">
</div>

<div style="text-align: right;padding-right:5px;height:25px"><b>'.$key1.'.'.$value1.'</b></div>
<div style="text-align: right;padding-right:5px;height:25px"><b>'.$key2.': '.$value2.'</b></div>
   <img src='.$headerImg.' style="width:100%;height:130px">
</div><br>
  

<div style=" text-align:center;line-height: 2;" class=" headingClass"><b>'.$value3.'</b></div>
<br>


<table  style="width:100%" class= "tableClass">
  
   <tr>
      <td style = "width:33%;padding:15px"><b>'.$key4.' </b></td>
      <td style = "width:33%;padding:15px">'.$value4.'</td>
      <td style = "width:33%;padding:15px" rowspan = "2"><img src='.$photo_path.' width="150" height="150"></td>
   </tr>
    <tr>
      <td style = "width:33%;padding:15px"><b>'.$key5.' </b></td>
      <td style = "width:33%;padding:15px">'.$value5.' </td>
   </tr>
   <tr>
      <td style = "width:33%;padding:15px"><b>'.$key6.' </b></td>
      <td style = "width:33%;padding:15px">'.$value6.' </td>
      <td style = "width:33%;padding:15px" ><img src='.$sign_path.' width="130" height="50"></td>
   </tr>
  
   
</table>

<!-- Post Preference  --->
<table  style="width:100%" class= "tableClass">
   <tr style="height:200px !important">
      <td  style="text-align: left" width="36%"><b>'.$key9.': </b> '.$value9.' </td>
   </tr>
</table>
<!-- Post Preference --->


<br><br><br><br><br><br>

<table  style="width:100%" class= "tableClass">
   <tr>
      <th width="20%" style="line-height:2;">Date of Document Verification</th>
      <th width="20%" style="line-height:2;" >Batch Number </th>
      <th width="20%" style="line-height:2;">Reporting Time</th>
      <th width="40%" style="line-height:2;">Venue</th>
   </tr>
   <tr>
      <td>'.$value10 .'</td>
      <td>'.$value11.'</td>
      <td>'.$value12.'</td>
      <td style="line-height: 2;"> '.$value13.'

      </td>
   </tr>
   
   
</table>
<br>



<div class="page-break"></div>

<div class="myDiv">
  <h2>This is a heading in a div element</h2>
  <p>This is some text in a div element.</p>
</div>
';

   








  





echo $output;

$data = ob_get_clean();


        
        
//   echo $output;
// return;      




//echo $output;

$document->loadHtml($output);
$document->set_option('isRemoteEnabled',true);

//set page size and orientation

$document->setPaper('A4', 'portait');

//Render the HTML as PDF

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
$pdf->merge('browser', $value5.'.pdf', 'P');
 //First Pdf insert

    }
}