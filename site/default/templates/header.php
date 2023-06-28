<?php



namespace App\Controllers;

use App\System\Route; 



/****
 *  Code Added 05_07_2022
 * 
 * 
 */

  header("X-Frame-Options:DENY");
  header("X-Content-Type-Options:nosniff");
  header("X-XSS-Protection:0; mode=block");
  header("Access-Control-Allow-Origin:*");
  header("content-secuity-policy:default-src 'self'");
  header( "Set-Cookie: HttpOnly");
  header( "Set-Cookie: name=value; HttpOnly");
  header_remove("X-Powered-By");
  ini_set('expose_php','off');

  /****
 * 
 * Code Added 05_07_2022
 * 
 */

$route = new Route();
$adminpage = $route->site_url("IndexController/admin_login");
$nominationpage = $route->site_url("IndexController/nomination");
$selectionpostpage = $route->site_url("IndexController/selectionpost");
$pageunderconstruction = $route->site_url("IndexController/pageunderconstruction");
$admit_card = $route->site_url("IndexController/admitcard");
$know_your_status = $route->site_url("IndexController/knowyourstatus");
$faq = $route->site_url("IndexController/faq");
$dlist = $route->site_url("IndexController/dlist");
$screenReaderAccess = $route->site_url("IndexController/ScreenReaderAccess");
$candidateCorner = $route->site_url("IndexController/candidateCorner");

$base_url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$base_url =  "http://10.163.2.160/projects/sscsr/site/";
//echo $base_url;
//$base_url = "https://rtionline.tn.gov.in/rd/security_audit";
//echo "$base_url";
//echo $base_url."IndexController/admin_login";




$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));

?>

<html>
<head>
	<meta charset="utf-8">
	<title>SSCSR - Staff Selection Commission</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="SSCSR - Staff Selection Commission" />
	<meta http-equiv="Content-Security-Policy: default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';">
	    <base href="<?php echo $this->base_url; ?>" />
	<!--css -->
	<link rel="shortcut icon" type="image/png" href="img/logo.png"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/cubeportfolio.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/monthly.css" rel="stylesheet" />
	<link href="css/slick/slick.css" rel="stylesheet" />
	<link href="css/slick/slick-theme.css" rel="stylesheet" />
	<link href="css/sitemap.css" rel="stylesheet" />
	<link id="t-colors" href="skins/default.css" rel="stylesheet" />
	
	<script src="js/jquery.min.js"></script> 
	
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.bootstrap4.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/datatable/css/select.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/dataTables.checkboxes.css">
	<link href="css/select2.min.css" rel="stylesheet" />

	

	
	<link href="css/custom.css" rel="stylesheet" />
	<script src="assets/datatable/js/validate.js"></script>
	<script src="assets/datatable/js/custom_validate.js"></script>
	<script src="assets/datatable/js/enc.js"></script>
	<script src="assets/datatable/js/md5.js"></script>
	<script src="assets/datatable/js/md5.min.js"></script>
	
<style>
 *{
         font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;    
		 font-size: 17;
       
      }
</style>
	
</head>
</head>
<body>
<?php  //echo phpinfo();?>
<div id="wrapper">
	<div>
		<!-- start header -->
		<header class="">
			<div class="top">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12 col-md-6 toprowclass">
							<button type="button" class="btn btn-default headergigw">&nbsp;SSCSR | GOVERMENT OF INDIA</button>
							<button class="btn btn-default headergigw dropdown"><a data-toggle="tooltip" data-placement="left" title="Admin Login" href="<?php echo $this->base_url; ?>IndexController/admin_login" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a></button>										
							<button class="btn btn-default headergigw dropdown"><a  data-toggle="tooltip" data-placement="right" title="SSCSR old website" href="http://www.sscsr.gov.in/" target="_blank"><i class="fa fa fa-link" aria-hidden="true"></i></a></button>										

						</div>
						<div class=" col-lg-6  col-sm-6 col-xs-12 col-md-6  search_btn">
							
							<div id="font-setting-buttons">
									<div class="btn-group">											
										<button type="button" class="btn btn-default headergigw" id="skip_to_main_content" data-toggle="tooltip" data-placement="left" title="Skip To Main Content"  >Skip To Main Content</button>
										<button type="button" class="btn btn-default headergigw" data-toggle="tooltip" data-placement="left" title="Site Map" id="sitemap"><i class="fa fa-sitemap" aria-hidden="true" ></i></button>
										<button type="button" class="btn btn-default change-me headergigw" data-toggle="tooltip" data-placement="left" title="Contrast" ><i class="fa fa-adjust" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-default increase-me headergigw" data-toggle="tooltip" data-placement="left" title="Font Size Increase" ><i class="fa fa-font" aria-hidden="true">+</i></button>
										<button type="button" class="btn btn-default reset-me headergigw" data-toggle="tooltip" data-placement="left" title="Normal Font Size" ><i class="fa fa-font" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-default decrease-me headergigw" data-toggle="tooltip" data-placement="left" title="Font Size Decrease"  ><i class="fa fa-font" aria-hidden="true">-</i></button>
										<button class="btn btn-default headergigw dropdown"><a href="<?php echo $screenReaderAccess; ?>" target="_blank">Screen Reader Access</a></button>										
									</div>
							</div>	
							
						</div>
					</div>
				</div>
			</div>			

			
			<div class="navbar navbar-default ">
				<div class="container headruler">
					<div class="col-md-1 col-lg-1">
						<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="#"><img src="img/logo.png" class="sitelogo"/></a>
						</div>
					</div>
					<div class="col-md-7 col-lg-7">
						<a href="#"><h3 class="ipab">कर्मचारी चयन आयोग <br>STAFF SELECTION COMMISSION</h3></a>
						<a href="#"><h4 class="goverment">Southern Region, Chennai</h4></a>
					</div>
 
					
					<div class="container" >
						<div class="row">
								<div class="row">
								
									<div class="col-xs-2" style="    margin-left: 20px;">
										<a href="<?php echo $candidateCorner;?>"><img src="images/header-icons/result.png" width="80px" style="margin-top:20px;" class="shortcut_icon"/><h6>Candidate Corner </h6></a>
									</div>
									<div class="col-xs-2">
										<a href="#"><img src="img/emblem-dark.png" class="emblem"/></a>
									</div>
							</div>
						</div>
					</div>
					
				</div>				
			</div>
		</header>
		<!-- end header -->
		<?php  //echo '<pre>';
		
		//echo "#########Stalin";

         // print_r($data); 

         ## echo $renderedMenu; ##
		 
		 ?>
		

		<div class="navbar buttons">
			<div class="container">
				<div class="navbar-collapse collapse ">
					<?php echo $renderedMenu;?>
					
				</div>
			</div>
		</div>
		
	</div>
	