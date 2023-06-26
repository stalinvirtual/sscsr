<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();?>

<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="#" class="bread"> Know Your Roll Number </a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<h3 style="text-align:center"> <?php echo $examname->exam_name;?> (<?php echo $examname->exam_short_name;?>)<?php echo '-'.$year;?>(<?php echo '-'.$admitcardresults->tier_name;?>)</h3>
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
							/* echo '<pre>';
							print_r($admitcardresults); */
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
									 <td><?php 
										$date = $admitcardresults->dob;
										$var_day = substr($date,0,2);
										// Get the month
										$var_month = substr($date,2,2);
										// Get the year
										$var_year = substr($date,4,4);
										// Change the date from ddmmyyyy to yyyymmdd
										$new_date_format = $var_day."-".$var_month."-".$var_year ;
										echo $new_date_format;?> </td>
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