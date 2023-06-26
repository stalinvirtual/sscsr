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
								  <tr class="success">
									 <td>Dob :</td>
									 <td><?php echo $admitcardresults->dob;?> </td>
								  </tr>
								
								  <tr class="info">
									 <td>Exam Date :</td>

									  <td><?php 
									 
									 switch ($exam_type) {
									  case "tier":
									       $date = ($admitcardresults->date1 =="NA")?"": $admitcardresults->date1;
											
											echo $date;
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
										 $date = ($admitcardresults->dv_date =="NA")?"": $admitcardresults->dv_date;
											
											echo $date;
										break;
										
									   default:
									         $date = ($admitcardresults->skill_test_date =="NA")?"": $admitcardresults->skill_test_date;
											
											echo $date;
										
									 }
				
				

									 
									 
											
										?> 
									</td>





									 






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
										case "skill":
										break;
										default:
											echo '<tr class="info">
													<td>Reporting Time :</td>
													<td>'. $admitcardresults->repotime.' </td>
												</tr>
												<tr class="success">
													<td>Gate/Entry Closing Time :</td>
													<td> '. $admitcardresults->gateclose.' </td>
												</tr>';
									 }
								  
								  ?>
								  
								  
								  
								   
							   </tbody>
							</table>
							
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

<?php include "footer2.php";?>
<?php echo $this->get_footer(); ?>