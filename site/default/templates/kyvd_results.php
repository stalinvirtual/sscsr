<?php

namespace App\Controllers;

use App\System\Route;
$route = new Route();
$kyasvd = $route->site_url("IndexController/knowyourvenuedetails");

echo $this->get_header();?>

<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="<?php echo $kyasvd;?>" class="bread"> Know your Date and City of Exam </a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<?php 
									switch ($exam_type) {
									  case "tier":
										$exam =  "Tier Exam" ;
										break;
										
										case "dme":
											$exam =  "DME" ;
										break;
										
										case "pet":
											$exam =  "PET" ;
										break;
										case "dv":
										$exam =  "DV Exam" ;
										break;
										
										default:
										$exam =   "Skill Test" ;
										break;
										
									 }
									 ?>
	<h3 style="text-align:center"> <?php echo $examname->exam_name;?> (<?php echo $examname->exam_short_name;?><?php echo '-'.$year;?>)(<?php echo $exam;?>)(<?php echo $admitcardresults->tier_name;?>)</h3>
	<div class="container" id="main">
		<div class="row">
			<div class="col-lg-3">
				<div style="margin-bottom:50px">
				</div>
			</div>
			<div class="col-lg-6">
				<div style="margin-bottom:50px">
					<div class="row">
						  <div class="wrapper">
						    <?php
							 //echo '<pre>';
							//print_r($admitcardresults);
							?>
							<table class="table table-responsive table-striped table-bordered table-hover">
							   <tbody>
								  <tr>
									 <td>Roll Number :</td>
									 <td><?php echo $admitcardresults->roll_no;?> </td>
								  </tr>
								  <tr class="info">
									 <td>Register No :</td>
									 <td><?php echo $admitcardresults->reg_no;?> </td>
								  </tr>
								  <tr class="success">
									 <td>Name of the candidate :</td>
									 <td><?php echo $admitcardresults->cand_name;?> </td>
								  </tr>
								  <tr class="info">
									 <td>Date of Birth :</td>
									 <td><?php echo $admitcardresults->dob;?> </td>
								  </tr>
								
								 
								   <tr class="success">
									 <td>
									 <?php 
									switch ($exam_type) {
									  case "tier":
											echo "Exam City" ;
										break;
										
										case "dme":
										echo "DME Venue Details" ;
										break;
										
										case "pet":
										echo "PET Venue Details" ;
										break;
										case "dv":
										echo "DV Venue Details" ;
										break;
										
										default:
										echo "Skill Venue Details" ;
										break;
										
									 }
									 ?>
									 
									 
									 
									 </td>
									 
									 
									 <?php
									//echo "<pre>";
									// print_r($exam_type);
									 ?>
									 
									 
									
									 <td><?php 
									 
									 switch ($exam_type) {
									  case "tier":
									       $venue1_title = ($admitcardresults->venue1_title =="NA")?"": $admitcardresults->venue1_title;
											$venue1_address = ($admitcardresults->venue1_address =="NA")?"": $admitcardresults->venue1_address;
											$venue2_title = ($admitcardresults->venue2_title =="NA")?"": $admitcardresults->venue2_title;
											$venue2_address = ($admitcardresults->venue2_address =="NA")?"": $admitcardresults->venue2_address;
											$exam_city = ($admitcardresults->exam_city =="NA")?"": $admitcardresults->exam_city;
											echo $exam_city."<br>" ;
										break;
										
										case "dme":
										$dme_venue = ($admitcardresults->dme_venue =="NA")?"": $admitcardresults->dme_venue;
										echo $dme_venue."<br>" ;
										break;
										
										case "pet":
										$pet_venue = ($admitcardresults->pet_venue =="NA")?"": $admitcardresults->pet_venue;
										echo $pet_venue."<br>" ;
										break;
										case "dv":
										$dv_venue = ($admitcardresults->dv_venue =="NA")?"": $admitcardresults->dv_venue;
										echo $dv_venue."<br>" ;
										break;
										
									   default:
									        $venue1_title = ($admitcardresults->venue1_title =="NA")?"": $admitcardresults->venue1_title;
											$venue1_address = ($admitcardresults->venue1_address =="NA")?"": $admitcardresults->venue1_address;
											$venue2_title = ($admitcardresults->venue2_title =="NA")?"": $admitcardresults->venue2_title;
											$venue2_address = ($admitcardresults->venue2_address =="NA")?"": $admitcardresults->venue2_address;
											$exam_city = ($admitcardresults->exam_city =="NA")?"": $admitcardresults->exam_city;
											// echo '<b>'.$venue1_title."</b><br>" ;
											// echo $venue1_address."<br>" ;
											// echo '<b>'.$venue2_title."</b><br>" ;
											// echo $venue2_address."<br>" ;
											echo $exam_city."<br>" ;
										
									 }
				
				

									 
									 
											
										?> 
									</td>
								  </tr>
								  <?php
								  
								   switch ($exam_type) {
										
										case "dme":
										case "pet":
											echo '<tr class="info">
													<td>Reporting Time :</td>
													<td>'. $admitcardresults->repotime.' </td>
												</tr>';
										break;
										case "dv":
											echo '<tr class="info">
													<td> Reporting Time :</td>
													<td>'. $admitcardresults->dv_reporting_time.' </td>
												</tr>';
												break;
										case "skill":
											echo '<tr class="info">
													<td>Reporting Time :</td>
													<td>'. $admitcardresults->skill1_reporting_time.' </td>
												</tr>
												<tr class="info">
													<td> Gate/Entry Closing Time :</td>
													<td>'. $admitcardresults->skill1_entry_closing_time.' </td>
												</tr>';
										break;
										default:
											// echo '<tr class="info">
											// 		<td>Reporting Times :</td>
											// 		<td>'. $admitcardresults->repotime.' </td>
											// 	</tr>
											// 	<tr class="success">
											// 		<td>Gate/Entry Closing Time :</td>
											// 		<td> '. $admitcardresults->gateclose.' </td>
											// 	</tr>';
									 }
								  
								  ?>
								  
								  
								  
								   
							   </tbody>
							</table>

							<?php
							 $exam_type_value =  trim($exam_type);
							//echo '<pre>';
							//print_r( $admitcardresults);
							$tier_id = $admitcardresults->tier_id;


							switch ($exam_type_value) { //Switch Start
										
								case "dme":
								case "pet":
								case "dv":
								case "skill":
								break;
								default:
								if($tier_id == 1 || $tier_id == 3){ // Tier 1 Starts
									$date1 	 		= $admitcardresults->date1;
									$paper1	 		= $admitcardresults->paper1;
									$report_p1	 	= $admitcardresults->report_p1;
									$gateclose_p1	= $admitcardresults->gateclose_p1;
									
									
	
									$tableArray = array(
										"Exam Date"                 => $date1,
										"Paper"                     => $paper1,
										"Reporting Time "           => $report_p1,
										"Gate / Entry Closing Time" => $gateclose_p1
								   );
								  
								 
									$theader = $tcell = "<tr>";
									foreach($tableArray as $title => $value ){
										$theader .=  "<th>$title</th>";
										$items = explode(",", $value);
										if( count($items) > 1){
										$value = "<table class='inner-table'>";
										// $value .= array_map(function($subValue){// if this is not difficult, you can still use foreach here
										//     return "<td>$subValue</td>";
										// }, $items);
										$stalin = array();
										foreach( $items as $item ){
												$value .= " <tr><td>$item</td></tr>";
												$stalin[] = $item;
										}
										$value .= "</table>";
									
										}
										$tcell .= " <td  >$value</td>";
									
									}
	
									$th1 = '<tr>
												<th width="10%">Exam Date</th>
												<th width="20%">Paper</th>
											
												<th width="10%">Reporting Time</th>
												<th width="20%">Gate / <br> Entry Closing Time</th>
												';
	
												$output ="<table class='outer-table' style='width:100%'>{$th1}{$tcell}{$tfoot}</table>";
											echo $output;
								}// Tier 1 Starts
								else if($tier_id == 2){ // Tier 2 Starts
									$output = "";
									//Paper 1 
									$paper1  = trim($admitcardresults->paper1);
									$suject1 = $admitcardresults->subject1;
									$date1   = date("d-m-Y", strtotime($admitcardresults->date1));
									$shift1  = $admitcardresults->shift1;
									$time1   = $admitcardresults->time1;
									$mark1   = $admitcardresults->mark1;
								$report_p1   = $admitcardresults->report_p1;
							$gateclose_p1    = $admitcardresults->gateclose_p1;
									//Paper 2 
									$paper2  = trim($admitcardresults->paper2);
									$suject2 = $admitcardresults->subject2;
									$date2   = date("d-m-Y", strtotime($admitcardresults->date2));
									$shift2  = $admitcardresults->shift2;
									$time2   = $admitcardresults->time2;
									$mark2   = $admitcardresults->mark2;
								$report_p2   = $admitcardresults->report_p2;
							$gateclose_p2    = $admitcardresults->gateclose_p2;
									//Paper3
									$paper3  = trim($admitcardresults->paper3);
									$suject3 = $admitcardresults->subject3;
									$date3   = date("d-m-Y", strtotime($admitcardresults->date3));
									$shift3  = $admitcardresults->shift3;
									$time3   = $admitcardresults->time3;
									$mark3   = $admitcardresults->mark3;
								$report_p3   = $admitcardresults->report_p3;
							$gateclose_p3    = $admitcardresults->gateclose_p3;
									//Paper 4
									$paper4  = trim($admitcardresults->paper4);
									$suject4 = $admitcardresults->subject4;
									$date4   = date("d-m-Y", strtotime($admitcardresults->date4));
									$shift4  = $admitcardresults->shift4;
									$time4   = $admitcardresults->time4;
									$mark4   = $admitcardresults->mark4;
								$report_p4   = $admitcardresults->report_p4;
							$gateclose_p4    = $admitcardresults->gateclose_p4;
						
						
						
									 //Paper 5
									 $paper5  = trim($admitcardresults->paper5);
									 $suject5 = $admitcardresults->subject5;
									 $date5   = date("d-m-Y", strtotime($admitcardresults->date5));
									 $shift5  = $admitcardresults->shift5;
									 $time5   = $admitcardresults->time5;
									 $mark5   = $admitcardresults->mark5;
								$report_p5    = $admitcardresults->report_p5;
							$gateclose_p5     = $admitcardresults->gateclose_p5;
									//Paper 6
									$paper6  = trim($admitcardresults->paper6);
									$suject6 = $admitcardresults->subject6;
									$date6   = date("d-m-Y", strtotime($admitcardresults->date6));
									$shift6  = $admitcardresults->shift6;
									$time6   = $admitcardresults->time6;
									$mark6   = $admitcardresults->mark6;
								$report_p6   = $admitcardresults->report_p6;
							$gateclose_p6    = $admitcardresults->gateclose_p6;
						
						
						
									if($paper2 == "NA"){
									   $tableArray2 = array(
										array($date1,$paper1,$report_p1,$gateclose_p1),
										  
										 
									   );
						
									}
						
									else if($paper5 == "NA" && $paper6 == "NA"){
									   $tableArray2 = array(
										  array($date1,$paper1,$report_p1,$gateclose_p1),
										  array($date2, $paper2,$report_p2,$gateclose_p2),
										  array($date3,$paper3,$report_p3,$gateclose_p3),
										  array($date4, $paper4,$report_p4,$gateclose_p4),
										 
									   );
						
									}
									else{
									  
									   $tableArray2 = array(
										array($date1,$paper1,$report_p1,$gateclose_p1),
										array($date2, $paper2,$report_p2,$gateclose_p2),
										array($date3,$paper3,$report_p3,$gateclose_p3),
										array($date4, $paper4,$report_p4,$gateclose_p4),
										array($date5,$paper5, $report_p5,$gateclose_p5),
										array($date6,$paper6, $report_p6,$gateclose_p6)
									   );
						
									}
						
									$output .='<table  style="width:100%" class= "tableClass">
								 <tr>
									<th width="10%" class="tblheader">Exam Date</th>
									<th width="5%" class="tblheader">Paper</th>
									<th width="10%" class="tblheader">Reporting Time</th>
									<th width="10%" class="tblheader">Gate / <br> Entry Closing Time</th>
								 </tr>';
								 $keys = array_keys($tableArray2);
								foreach ($tableArray2 as $row) {
									 $output  .= "<tr>
									<td>".$row[0]."</td>
									<td>".$row[1]."</td>
									<td>".$row[2]."</td>
									<td>".$row[3]."</td>
									
									
									</tr>";
							 }
								
						
								 $output  .= '</table>
								 <br>';
								 $output .="<table class='outer-table' style='width:100%'>{$th1}{$tcell}{$tfoot}</table>";
							   echo $output;
	
								} // Tier 2 Starts
							 } //Switch End

						
							?>
							
						  </div>
					</div>	
				</div>
			</div>
			<div class="col-lg-3">
				<div style="margin-bottom:50px">
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
/*$category = $kyasresults;
echo '<pre>';print_r($category );*/

?>
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
      font-size:10 ;
      }



	  /* *{
         font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;    
		 font-size: 17;
       
      } */
      .outer-table{
         width:100%;
		  font-size: 15px; 
      }
      
      .outer-table  tbody  tr:first-child {
    background-color: #009879;
    color: #ffffff;
   
	height: 30px;
}
.tableClass tbody  tr:first-child {
    background-color: #009879;
    color: #ffffff;
   
	height: 30px;
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
      .headingClass{
         text-align:center;
         line-height: 1.25;
         font-size:15px !important;
         text-decoration: underline;
      }
	  .tblheader{
		text-align: center;
	  }
</style>

<?php include "footer2.php";?>
<?php echo $this->get_footer(); ?>


<?php
							
						// 	$tier_id = $admitcardresults->tier_id;
						// 	if($tier_id == 1 || $tier_id == 3){ // Tier 1 Starts
						// 		$date1 	 = $admitcardresults->date1;
						// 		$shift1  = $admitcardresults->shift1;
						// 		$time1	 = $admitcardresults->time1;
						// 		$paper1	 = $admitcardresults->paper1;
						// 		$suject1 = $admitcardresults->subject1;
						// 		$mark1   = $admitcardresults->mark1;

						// 		$tableArray = array(
						// 			"Date" => $date1,
						// 			"Shift" => $shift1,
						// 			"Time" => $time1,
						// 			"Paper/Session" => $paper1,
						// 			"Subject" => $suject1,
						// 			"Marks" => $mark1
						// 	   );
							 
						// 		$theader = $tcell = "<tr>";
						// 		foreach($tableArray as $title => $value ){
						// 			$theader .=  "<th>$title</th>";
						// 			$items = explode(",", $value);
						// 			if( count($items) > 1){
						// 			$value = "<table class='inner-table'>";
						// 			// $value .= array_map(function($subValue){// if this is not difficult, you can still use foreach here
						// 			//     return "<td>$subValue</td>";
						// 			// }, $items);
						// 			$stalin = array();
						// 			foreach( $items as $item ){
						// 					$value .= " <tr><td>$item</td></tr>";
						// 					$stalin[] = $item;
						// 			}
						// 			$value .= "</table>";
								
						// 			}
						// 			$tcell .= " <td  >$value</td>";
								
						// 		}

						// 		$th1 = '<tr>
						// 					<th>Exam Date</th>
						// 					<th width="8%">Shift</th>
						// 					<th>Exam Time</th>
						// 					<th width="10%">Paper/Session</th>
						// 					<th width="20%">Subject</th>
						// 					<th width="4%">Marks</th>';

						// 					$output ="<table class='outer-table' style='width:100%'>{$th1}{$tcell}{$tfoot}</table>";
						// 				echo $output;

						// 	} // Tier 1 Starts
						// 	else if($tier_id == 2){ // Tier 2 Starts
						// 		echo "@@@@@@@@@@@@@@";
						// 		$output = "";

						// 		 //Paper 1 
						// 		 $paper1  = trim($admitcardresults->paper1);
						// 		 $suject1 = $admitcardresults->subject1;
						// 		 $date1   = date("d-m-Y", strtotime($admitcardresults->date1));
						// 		 $shift1  = $admitcardresults->shift1;
						// 		 $time1   = $admitcardresults->time1;
						// 		 $mark1   = $admitcardresults->mark1;
						// 		 //Paper 2 
						// 		 $paper2  = trim($admitcardresults->paper2);
						// 		 $suject2 = $admitcardresults->subject2;
						// 		 $date2   = date("d-m-Y", strtotime($admitcardresults->date2));
						// 		 $shift2  = $admitcardresults->shift2;
						// 		 $time2   = $admitcardresults->time2;
						// 		 $mark2   = $admitcardresults->mark2;
						// 		 //Paper3
						// 		 $paper3  = trim($admitcardresults->paper3);
						// 		 $suject3 = $admitcardresults->subject3;
						// 		 $date3   = date("d-m-Y", strtotime($admitcardresults->date3));
						// 		 $shift3  = $admitcardresults->shift3;
						// 		 $time3   = $admitcardresults->time3;
						// 		 $mark3   = $admitcardresults->mark3;
						// 		 //Paper 4
						// 		 $paper4  = trim($admitcardresults->paper4);
						// 		 $suject4 = $admitcardresults->subject4;
						// 		 $date4   = date("d-m-Y", strtotime($admitcardresults->date4));
						// 		 $shift4  = $admitcardresults->shift4;
						// 		 $time4   = $admitcardresults->time4;
						// 		 $mark4   = $admitcardresults->mark4;
					 
					 
					 
						// 		  //Paper 5
						// 		  $paper5  = trim($admitcardresults->paper5);
						// 		  $suject5 = $admitcardresults->subject5;
						// 		  $date5   = date("d-m-Y", strtotime($admitcardresults->date5));
						// 		  $shift5  = $admitcardresults->shift5;
						// 		  $time5   = $admitcardresults->time5;
						// 		  $mark5   = $admitcardresults->mark5;
						// 		 //Paper 6
						// 		 $paper6  = trim($admitcardresults->paper6);
						// 		 $suject6 = $admitcardresults->subject6;
						// 		 $date6   = date("d-m-Y", strtotime($admitcardresults->date6));
						// 		 $shift6  = $admitcardresults->shift6;
						// 		 $time6   = $admitcardresults->time6;
						// 		 $mark6   = $admitcardresults->mark6;
					 
					 
					 
						// 		 if($paper2 == "NA"){
						// 			$tableArray2 = array(
						// 			   array($date1,$shift1,$time1, $paper1,$suject1,$mark1),
									   
									  
						// 			);
					 
						// 		 }
					 
						// 		 else if($paper5 == "NA" && $paper6 == "NA"){
						// 			$tableArray2 = array(
						// 			   array($date1,$shift1,$time1, $paper1,$suject1,$mark1),
						// 			   array($date2,$shift2,$time2, $paper2,$suject2,$mark2),
						// 			   array($date3,$shift3,$time3,$paper3,$suject3,$mark3),
						// 			   array($date4,$shift4,$time4, $paper4,$suject4,$mark4),
									  
						// 			);
					 
						// 		 }
						// 		 else{
								   
						// 			$tableArray2 = array(
						// 			   array($date1,$shift1,$time1, $paper1,$suject1,$mark1),
						// 			   array($date2,$shift2,$time2, $paper2,$suject2,$mark2),
						// 			   array($date3,$shift3,$time3,$paper3,$suject3,$mark3),
						// 			   array($date4,$shift4,$time4, $paper4,$suject4,$mark4),
						// 			   array($date5,$shift5,$time5,$paper5,$suject5, $mark5),
						// 			   array($date6,$shift6,$time6,$paper6,$suject6, $mark6)
						// 			);
					 
						// 		 }
					 
						// 		 $output .='<table  style="width:100%" class= "tableClass">
						// 	  <tr>
						// 		 <th width="10%">Exam Date</th>
						// 		 <th width="3%">Shift</th>
						// 		 <th width="8%">Exam Time</th>
						// 		 <th width="5%">Paper/<br>Session</th>
						// 		 <th width="25%">Subject</th>
						// 		 <th width="4%">Marks</th>
						// 	  </tr>';
						// 	  $keys = array_keys($tableArray2);
						// 	 foreach ($tableArray2 as $row) {
						// 		  $output  .= "<tr>
						// 		 <td>".$row[0]."</td>
						// 		 <td>".$row[1]."</td>
						// 		 <td>".$row[2]."</td>
						// 		 <td>".$row[3]."</td>
						// 		 <td>".$row[4]."</td>
						// 		 <td>".$row[5]."</td>
								 
						// 		 </tr>";
						//   }
							 
					 
						// 	  $output  .= '</table>
						// 	  <br>';
						// 	  $output .="<table class='outer-table' style='width:100%'>{$th1}{$tcell}{$tfoot}</table>";
						// 	echo $output;

						// 	}// Tier 2 Ends
							
							?>