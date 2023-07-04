<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
$base_url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<style>
	.form-control{
    height: 39px !important;
	}
</style>
<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo $this->base_url; ?>" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="<?php echo $this->base_url; ?>IndexController/candidateCorner" class="bread"> Candidate Corner</a><i class="icon-angle-right"></i></li>
					<li>Download Admit Card<i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<p style="text-align:center">
	( cgle 2022 / 10000092576 / 04-06-1990 )
		
		
	</p>
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
							<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="max-width:585px !important;" target="_blank">
								<h2 class="form-signin-heading">Download Admit Card</h2>
								<label for="exampleInputEmail1">Exam</label>
								<select name="examname" id="admitcard_examname" required="true" class="form-control col-md-3 col-sm-2">
									<option value="" selected="selected">Select Exam</option>
								</select>
								<br>
								<br>




								<!-- <label for="exampleInputEmail1">Registration Number <span class="qnsround"  data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
								<input type="text" class="form-control" placeholder="Registration Number" name="register_number" id="register_number"  autocomplete="off" /> -->


								<div class="form-group row">
									<div class="col-xs-5">
										<label for="dob" class="placeholder_font_size ">Registration Number<span class="qnsround"  data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
										<input class="form-control placeholder_font_size" placeholder="Registration Number" name="register_number" maxlength="11" id="register_number" value=""  type="text" onkeypress="return isNumber(event)"  required>
									</div>
							 </div>
								
								<br>
								<div class='roll_pp_div' style='display:none'>
									<label for="exampleInputEmail1">Roll Number <span class="qnsround" data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
									<input type="text" class="form-control" placeholder="Roll Number" name="roll_number" id="roll_number" value ="" autocomplete="off" />
									<br>
								</div>

									<!-- <div class="post_preference_div" style="display: none;">

										<label for="exampleInputEmail1">Post Preference</label>
										<input type="text" class="form-control" placeholder="Post Preference" name="post_preference" id="post_preference"   value ="" autocomplete="off" />
										<br>

									</div> -->

									<div class="post_preference_div_select" style="display: none;">

										<label for="exampleInputEmail1">Post Preference</label>
									
										<select class="form-control" name="post_preference_one" id="post_preference_one">

										</select>


										
										<br>

									</div>

								




								<!-- <label for="exampleInputEmail1">Date of Birth</label>
								<input type="date" class="form-control" placeholder="DOB " name="dob" required="" id="password" autocomplete="off" /> -->


								<div class="form-group row">
									<div class="col-xs-4">
										<label for="dob">Date of Birth</label>
										<input class="form-control placeholder_font_size" name="dob" id="dob" value="" readonly type="text" required>
									</div>
							 </div>





								<br>
								<button class="btn btn-lg btn-sscsrthemecolor btn-block" type="submit" name="admit_card">Download Admit Card</button>
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
<?php include "footer2.php"; ?>
<style>
	.placeholder_font_size{
	font-size: 13px;
}
	.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
    color: black !important;
}
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
	.qnsround{
	display: inline-block;
    width: 18px;
    height: 18px;
    text-align: center;
    line-height: 18px;
    background-color: #141313;
    color: #fff;
    margin-top: 2px;
    margin-left: 5px;
    border-radius: 50%;
    cursor: pointer;
	}
	.ui-datepicker-trigger{
	position: relative;
    margin-left: 155px;
    margin-top: -30px;
    height: 20px;
}
</style>



<?php echo $this->get_footer(); ?>