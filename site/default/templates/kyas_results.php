<?php

namespace App\Controllers;

use App\System\Route;
$route = new Route();
$kyaspage = $route->site_url("IndexController/knowyourstatus");

echo $this->get_header();?>

<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="<?php echo $kyaspage ;?>" class="bread"> Know Your Application Status</a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<h3 style="text-align:center"> <?php echo $examname->exam_name;?> (<?php echo $examname->exam_short_name;?>)<?php echo '-'.$year;?></h3>
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
						               <table class="table table-responsive table-striped table-bordered table-hover">
											<tbody>
											  <tr>
												<td>Registration ID :</td>
												<td><?php echo $kyasresults->reg_no;?> </td>
												
											  </tr>      
											  <tr class="success">
												<td>Name of the candidate :</td>
												<td><?php echo $kyasresults->cand_name;?> </td>
											  </tr>
											  <tr class="danger">
												<td>New Name ( if any )   :</td>
												<td><?php echo $kyasresults->new_name;?> </td>
											  </tr>
											  <tr class="info">
												<td>Date of Birth :</td>
												<td><?php 
												$date = $kyasresults->dob;
												//$var_day = substr($date,0,2);
												// Get the month
												//$var_month = substr($date,2,2);
												// Get the year
												//$var_year = substr($date,4,4);
												// Change the date from ddmmyyyy to yyyymmdd
												//$new_date_format = $var_day."-".$var_month."-".$var_year ;
												echo $kyasresults->dob;?> </td>
											  </tr>
											  <tr class="warning">
												<td>Father's Name :</td>
											<td><?php echo $kyasresults->father_name;?> </td>
											  </tr>
											  <tr class="success">
												<td>Status of Application :</td>
												<td><?php echo $kyasresults->status_accept_reject;?> </td>
											  </tr>
											  <tr class="active">
												<td>Reason for Rejection (if rejected):</td>
												<td><?php echo ($kyasresults->reject_reason =="NaN")?"":$kyasresults->reject_reason;?> </td>
											  </tr>
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