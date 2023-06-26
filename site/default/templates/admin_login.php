<?php

namespace App\Controllers;

use App\System\Route;

echo $this->get_header();
?>
<section class="buttons">
	<div class="container">
		<div class="row breadcrumbruler">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
					<li><a href="page_not_found.php" class="bread"> Department login</a><i class="icon-angle-right"></i></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container" id="main">
		<div class="row">
			<div class="col-lg-4">
				<div style="margin-bottom:50px">
				</div>
			</div>
			<div class="col-lg-4">
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
							$loadcaptcha = $route->site_url("Api/loadcaptcha");
							$token = $_SESSION['token'];
							?>
							<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
								<h2 class="form-signin-heading">Department Login</h2>
								<label for="exampleInputEmail1">User Name</label>
								<input type="text" class="form-control" placeholder="Username " name="username" id="username" required="" oncopy="return false" onpaste="return false"  />
								<br>
								<label for="exampleInputEmail1">Password</label>
								<input type="password" class="form-control" placeholder="Password " name="password" required="" id="password" oncopy="return false" onpaste="return false"/>
								<br>


								<!-- Captcha Start-->

								<!--  <label for="exampleInputEmail1">Captcha</label>
								<input type="text" name="captcha_code" id="captcha" class="demoInputBox form-control" placeholder="Captcha" required="" autocomplete="off">
								<br>
								<img src="<?php //echo $loadcaptcha; 
											?>" style="width:100px"  id="captcha_code"/>
								<button name="submit" class="btnRefresh" onClick="refreshCaptcha();">Refresh Captcha</button> 
							  <br>
							  <!-- Captcha End -->
								<br>
								<button class="btn btn-lg btn-sscsrthemecolor btn-block" type="submit" name="login" onClick="return Validate();">Login</button>
								<p class="pt-1 text-danger text-center" id="err_msg"></p>  
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div style="margin-bottom:50px">
				</div>
			</div>
		</div>
	</div>
	<!-- Captcha loging -->
	<?php
	$route = new Route();
	$loadcaptcha = $route->site_url("Api/loadcaptcha");
	?>
</section>




<?php include "footer2.php"; ?>
<script>
	function refreshCaptcha() {
		var url = '<?php echo $loadcaptcha; ?>';
		$('#captcha_code').attr('src', url);
	}
</script>

<?php echo $this->get_footer(); ?>