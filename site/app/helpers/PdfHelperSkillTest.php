<?php

namespace App\Helpers;
require_once(__DIR__ . "/../../dompdf/vendor/autoload.php");
require(__DIR__ . "/../../dompdf/autoload.inc.php");
require(__DIR__ . "/../../dompdf/vendor/dompdf/dompdf/src/Dompdf.php");


//echo __DIR__ . "/../../dompdf/vendor/autoload.php";





require("functions.php");

use Dompdf\Dompdf;


class PdfHelperSkillTest extends Dompdf
{
   public static $PDF_TEMPLATE_PATH = __DIR__ . "/../../pdf/templates";
    public static function genereateAndSkillTestDownloadAdminCard($data)
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
        
        
        if($value["col_name"] == "dob"){
            $dob_col_description = $value["col_description"];
            $date = $value["col_value"];
            //$dob_date = getDobFormat($date);
        }
        
        switch ($value["is_skill_order"]) {
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
             // Skill Test Medium
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
             // Candidate Name
            $key9 = $value["col_description"];
            $value9 = $value["col_value"];
            break;
             case "10":
             //New Name
            $key10 = $value["col_description"];
            $value10 = $value["col_value"];
            break;
             case "11":
            
            //photo_id
            $value11 = $value["col_description"]." : ".$value["col_value"] != "" && $value["col_value"] != 'NA'  ? $value["col_value"] : "photo_not_exists.png";
                    $photo_path = "exam_assets/".$value11;
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
             case "12":
             //Dob
             
             $key12 = $value["col_description"];
            $value12 = $value["col_value"];
            break;
             case "13":
             // Category
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
                //1st Venue Title
                $key16 = $value["col_description"];
                $value16 = $value["col_value"];
               
                break;
            case "17":
                //1st Venue Address
                $key17 = $value["col_description"];
                $value17 = $value["col_value"];
                break;
             case "18":
            //2nd Venue Title
            $key18 = $value["col_description"];
            $value18 = $value["col_value"];
            break;
            case "19":
            //2nd Venue Address
            $key19 = $value["col_description"];
            $value19 = $value["col_value"];
            break;
            case "20":
            // Date of Examination
            $key20 = $value["col_description"];
            $value20 = $value["col_value"];
            break;
            
            case "21":
            // Skill Test 1 Name
            $key21 = $value["col_description"];
            $value21 = $value["col_value"];
            break;
            
            case "22":
            //  Skill Test 1 Shift
            $key22 = $value["col_description"];
            $value22 = $value["col_value"];
            break;
            
            
            
            case "23":
            //  Skill Test 1 Reporting Time
            $key23 = $value["col_description"];
            $value23 = $value["col_value"];
            break;
            
            
            case "24":
            //  Skill Test 1 Entry Closing Time
            $key24 = $value["col_description"];
            $value24 = $value["col_value"];
            break;
            
            
            case "25":
            //  Skill Test 1 Exam Time
            $key25 = $value["col_description"];
            $value25 = $value["col_value"];
            break;
            
            case "26":
            //  Skill Test 2 Name
            $key26 = $value["col_description"];
            $value26 = $value["col_value"];
            break;
            
            
            case "27":
            //   Skill Test 2 Shift 
            $key27 = $value["col_description"];
            $value27 = $value["col_value"];
            break;
            
            case "28":
            //    Skill Test 2 Reporting Time 
            $key28 = $value["col_description"];
            $value28 = $value["col_value"];
            break;
            
            case "29":
            //   Skill Test 2 Entry Closing Time
            $key29 = $value["col_description"];
            $value29 = $value["col_value"];
            break;
            
            
            case "30":
            //    Skill Test 2 Exam Time
            $key30 = $value["col_description"];
            $value30 = $value["col_value"];
            break;
            
            case "31":
            //   Skill Test 3 Name
            $key31 = $value["col_description"];
            $value31 = $value["col_value"];
            break;
            
            
            case "32":
            //   Skill Test 3 Shift
            $key32 = $value["col_description"];
            $value32 = $value["col_value"];
            break;
            
            
            case "33":
            //  Skill Test 3 Reporting Time
            $key33 = $value["col_description"];
            $value33 = $value["col_value"];
            break;
            
            case "34":
            //  Skill Test 3 Entry Closing Time
            $key34 = $value["col_description"];
            $value34 = $value["col_value"];
            break;
            
            case "35":
            //   Skill Test 3 Exam Time
            $key35 = $value["col_description"];
            $value35 = $value["col_value"];
            break;
            
            
            case "36":
            //   Skill Test 4 Name
            $key36 = $value["col_description"];
            $value36 = $value["col_value"];
            break;
            
            case "37":
            //   Skill Test 4 Shift
            $key37 = $value["col_description"];
            $value37 = $value["col_value"];
            break;
            
            case "38":
            //Skill Test 4 Reporting Time
            $key38 = $value["col_description"];
            $value38 = $value["col_value"];
            break;
            
            case "39":
            //Skill Test 4 Entry Closing Time
            $key39 = $value["col_description"];
            $value39 = $value["col_value"];
            break;
            
            case "40":
            //Skill Test 4 Exam Time
            $key40 = $value["col_description"];
            $value40 = $value["col_value"];
            break;
             
            
            
            
            
          default:
            //echo "Your favorite color is neither red, blue, nor green!";
        }
    }

    $headerImg = $GLOBALS['pdf_header_image_server_path'] ."HEADER.png" ;

    //   $paper1 = $value23;
    //   $suject1 = $value24;
    //   $date1 = $value25;
    //   $shift1 = $value26;
    //   $time1 = $value27;
    //   $mark1 = $value28;





      // echo $paper1."<br>";
      // echo $suject1."<br>";
      // echo $date1."<br>";
      // echo $shift1."<br>";
      // echo $time1."<br>";
      // echo $mark1."<br>";

      $qrcode_value = "RollNo=" .$value4.","."Name=".$value9.","."DOB=" .$date;
      $qrcode =  '<img  style="width:70px;height:60px;padding-top:20px" src="'.(new \chillerlan\QRCode\QRCode)->render( $qrcode_value).'" alt="QR Code" />';

      $barcode_Value ='RollNo='.$value4;
      $barcode =  '<img  width="60%" style="padding-top:20px;height:50px" src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode_Value, $generator::TYPE_CODE_128,3,50)) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

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
   //font-size:10 ;       
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
</style>

<div class="header-class">
   <img src='. $headerImg.' style="width:100%;height:130px">
</div><br>
<div class="headingClass"><b>e-ADMISSION CERTIFICATE</b></div>
<div class="headingClass"><b>'.$value1.'</b></div>
<div class="headingClass"><b>'. $value2 .'</b></div>
<br>
<table class= "tableClass" style="width:100%">
   <tr style="height:200px">
      <td rowspan="2" width="50%" class="fontSizeClass">'. $barcode.  ''. $qrcode.  ' </td>
      <td  style="text-align: left" class="fontSizeClass"><b>'.$key3.': </b> '. $value3 .'</td>
   </tr>
   <tr style="height:200px">
      <td style="text-align: left" class="fontSizeClass"><b>'.$key5.' : </b> '. $value5 .' </td>
   </tr>
</table>
<!-- Roll Number  and Scribe -->
<table  class= "tableClass" style="width:100%">
   <tr style="height:200px">
      <td  style="text-align: left" width="50%" class="fontSizeClass"><b>'.$key4.' : </b>'. $value4 .' </td>
      <td  style="text-align: left" class="fontSizeClass"><b>'.$key6.' : </b> '. $value6 .' </td>
   </tr>
</table>
<!-- Roll Number  and Scribe -->

<!-- Password,Date of skill Test  and Gender -->
<table  class= "tableClass" style="width:100%">
   <tr style="padding:10px">
      <td  style="text-align: left" width="50%" class="fontSizeClass"><b>'.$key7.': </b> '.$value7.'</td>
      <td  style="text-align: left" width="29%" class="fontSizeClass"><b>'.$key20.' : </b>'.$value20.'</td>
      <td  style="text-align: left" width="21%" class="fontSizeClass"><b>'.$key8.' : </b> '.$value8.' </td>
   </tr>
</table>
<!-- Password,Date of skill Test  and Gender -->


<table style="width:100.5%;height:100px;margin-left:-2px !important"; class= "tableClass2 fontSizeClass">
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
<!-- DOB --->
<table  style="width:100%" class= "tableClass fontSizeClass">
   <tr style="height:200px !important">
      <td  style="text-align: left" width="40%"><b>'.$key12.': </b> '.$value12.' </td>
      <td  style="text-align: left" width="40%"><b>Category : </b> SC </td>
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

    if($value18 == "NA"){

        $value18 ="";

    }
    else{
        $value18 = $value18;
    }

    if($value19 == "NA"){

        $value19 ="";

    }
    else{
        $value19 = $value19;
    }

   

      $output .= '
      
      
     </td>
   </tr>
</table>
<!-- DOB --->

<!-- Candidate \'s Address-->
<table  style="width:100%"; class= "tableClass fontSizeClass">
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
<table  style="width:100%"; class= "tableClass fontSizeClass">
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b> Examination Venue :  </b> 
      </td>
   </tr>
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b>  '.$value16 .' :  </b> 
      </td>
   </tr>
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         '.$value17.'
         
      </td>
   </tr>
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b> '.$value18 .'  </b> 
      </td>
   </tr>
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
      '.$value19.'
      </td>
   </tr>
</table>
<!-- Examination Venue -->
';

// $tableArray = array(

//    "Paper" => $paper1,
//    "Subject" => $suject1,
//    "Date" => $date1,
//    "Shift" => $shift1,
//    "Time" => $time1,
//    "Marks" => $mark1


// );

// echo '<pre>';
// print_r($tableArray);

$paper1 = trim($value21);
$suject1 = trim($value22);
$date1 = trim($value23);
$shift1 = trim($value24);
$time1 = trim($value25);



$paper2 = trim($value26);
$suject2 = trim($value27);
$date2 = trim($value28);
$shift2 = trim($value29);
$time2 = trim($value30);


$paper3 = trim($value31);
$suject3 = trim($value32);
$date3 = trim($value33);
$shift3 = trim($value34);
$time3 = trim($value35);


$paper4 = trim($value36);
$suject4 = trim($value37);
$date4 = trim($value38);
$shift4 = trim($value39);
$time4 = trim($value40);






// if ($paper1 != "" && $paper2 == "" || $paper1 != "" && $paper2 == "") {

//     $tableArray2 = array(

//         array($paper1,$suject1,$date1,$shift1,$time1),
//         // array($paper2,$suject2,$date2,$shift2,$time2, $mark2),
//         // array($paper3,$suject3,$date3,$shift3,$time3, $mark3),
//         // array($paper4,$suject4,$date4,$shift4,$time4, $mark4),
     
     
//      );


   



// }

// echo $paper1 . $paper2 .$paper3 .$paper4;
// exit;

if ($paper1 != "" && $paper1 != trim("NA") ) {
    $tableArray2 = array(

        array($paper1,$suject1,$date1,$shift1,$time1),
        // array($paper2,$suject2,$date2,$shift2,$time2, $mark2),
        // array($paper3,$suject3,$date3,$shift3,$time3, $mark3),
        // array($paper4,$suject4,$date4,$shift4,$time4, $mark4),
     );

}
if ($paper2 != "" && $paper2 != trim("NA") ) {

    $tableArray2 = array(

      array($paper1,$suject1,$date1,$shift1,$time1),
        array($paper2,$suject2,$date2,$shift2,$time2),
        // array($paper3,$suject3,$date3,$shift3,$time3, $mark3),
        // array($paper4,$suject4,$date4,$shift4,$time4, $mark4),
     
     
     );
    }

    if ($paper3 != ""  &&  $paper3 != trim("NA")) {
        $tableArray2 = array(
    
         array($paper1,$suject1,$date1,$shift1,$time1),
            array($paper2,$suject2,$date2,$shift2,$time2),
            array($paper3,$suject3,$date3,$shift3,$time3),
            // array($paper4,$suject4,$date4,$shift4,$time4, $mark4),
         
         
         );
        }
        if ($paper4 != ""  && $paper4 != trim("NA")) {
            $tableArray2 = array(
        
               array($paper1,$suject1,$date1,$shift1,$time1),
                array($paper2,$suject2,$date2,$shift2,$time2),
                array($paper3,$suject3,$date3,$shift3,$time3),
                array($paper4,$suject4,$date4,$shift4,$time4),
             
             
             );
            }




$output .='<table  style="width:100%" class= "tableClass fontSizeClass">
<tr>
  <th width="10%">Skill Test</th>
  <th width="20%">Shift</th>
  <th width="10%">Reporting Time</th>
  <th width="8%">Entry Closing Time</th>
  <th width="8%">Skill Test Time</th>
</tr>';
foreach ($tableArray2 as $mks){
$output  .= "<tr>
<td>".$mks[0]."</td>
<td>".$mks[1]."</td>
<td>".$mks[2]."</td>
<td>".$mks[3]."</td>
<td>".$mks[4]."</td>
</tr>";
}
$output  .= '</table>
<br>';
  





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
$pdf->merge('browser', $value3.'.pdf', 'P');
 //First Pdf insert

    }
}