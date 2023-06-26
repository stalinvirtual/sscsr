<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
$base_url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo $this->base_url; ?>" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="<?php echo $this->base_url; ?>IndexController/candidateCorner" class="bread"> Candidate Corner</a><i class="icon-angle-right"></i></li>
					<li> Know Your Roll Number<i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<p style="text-align:center"></p>
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
										if (isset($errorMsg) && !empty($errorMsg)) {
										  echo '<div class="alert alert-danger errormsg">';
										  echo $errorMsg;
										  echo '</div>';
										  //unset($errorMsg);
										}

										$route = new Route();
										//$loadcaptcha = $route->site_url("Api/loadcaptcha");
										?>
							<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="max-width:585px !important;" target="_blank">       
							  <h2 class="form-signin-heading">Know Your Roll Number</h2>
							   <label for="exampleInputEmail1">Exam</label>
							  <select name="examname" id="admitcard_examname" required="true" class="form-control col-md-3 col-sm-2">
									<option value="" selected="selected">Select Exam</option>		
								</select>
							  <br>
							  <br>
							  
							
							  
							  
							    <label for="exampleInputEmail1">Register Number</label>
							  <input type="text" class="form-control" placeholder="Application Number" name="register_number" id = "username" required="" autocomplete="off" />
							  <br>
							  <label for="exampleInputEmail1">Date of Birth</label>
							  <input type="date" class="form-control" placeholder="DOB " name="dob" required="" id = "password" autocomplete="off"/>  
							 
							  <br>
							  <button class="btn btn-lg btn-sscsrthemecolor btn-block" type="submit" name="admit_card">Know Your Roll No</button>   
							</form>
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
<?php include "footer2.php";?>
<style>
.select2-selection__rendered {
    line-height: 31px !important;
	white-space: inherit !important;
}
.select2-container .select2-selection--single {
    height: 56px !important;
	white-space: inherit !important;
}
.select2-selection__arrow {
    height: 56px !important;
}
 </style>



<?php echo $this->get_footer(); ?>