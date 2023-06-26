<?php
namespace App\Controllers;

use App\System\Route; 
/***
 * 
 * code added on july 5th 2022
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
//$base_url =   "https://rtionline.tn.gov.in/security_audit/";
//echo $base_url;

/***
 * 
 * code added on july 5th 2022
 * 
 */



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
	
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.bootstrap4.css">
	<link rel="stylesheet" href="assets/datatable/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/datatable/css/select.dataTables.min.css">
	<link rel="stylesheet" href="assets/datatable/css/dataTables.checkboxes.css">
	<link href="css/select2.min.css" rel="stylesheet" />
	
<style>

</style>
	
</head>
</head>
<body>
<div id="wrapper">
	<div>
		<!-- start header -->
		<header class="">
			<div class="top">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12 col-md-6 toprowclass">
							<button type="button" class="btn btn-default headergigw">&nbsp;SSCSR | GOVERMENT OF INDIA</button>
						</div>
						<div class=" col-lg-6  col-sm-6 col-xs-12 col-md-6  search_btn">
							
							<div id="font-setting-buttons">
									<div class="btn-group">											
										<button type="button" class="btn btn-default headergigw" id="skip_to_main_content" title="Skip to Main Content" >Skip To Main Content</button>
										<button type="button" class="btn btn-default headergigw" title="Site Map" id="sitemap"><i class="fa fa-sitemap" aria-hidden="true" ></i></button>
										<button type="button" class="btn btn-default change-me headergigw" title="Contrast"><i class="fa fa-adjust" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-default increase-me headergigw" title="Font Size Increase"><i class="fa fa-font" aria-hidden="true">+</i></button>
										<button type="button" class="btn btn-default reset-me headergigw" title="Normal Font Size"><i class="fa fa-font" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-default decrease-me headergigw" title="Font Size Decrease" ><i class="fa fa-font" aria-hidden="true">-</i></button>
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
										<a href="http://10.163.2.160/projects/sscsr/site/IndexController/candidateCorner"><img src="images/header-icons/result.png" width="80px" style="margin-top:20px;" class="shortcut_icon"/><h6>Candidate Corner </h6></a>
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

         //print_r($data); 

         ## echo $renderedMenu; ##
		 
		 ?>
		

		<div class="navbar buttons">
			<div class="container">
				<div class="navbar-collapse collapse ">
					<?php echo $data['renderedMenu'];?>
					
				</div>
			</div>
		</div>
		
	</div>
	
	
	<section class="buttons">
			<div class="container">
				<div class="row breadcrumbruler">
					<div class="col-lg-12">
						<ul class="breadcrumb">
							<li><a href="index.php" class="breadcrumb_text_color">Home</a><i class="icon-angle-right"></i></li>
							<li><a href="page_not_found.php" class="bread"> Page URL is not Found </a><i class="icon-angle-right"></i></li>
						</ul>
					</div>
				</div>
			</div>
		<div class="container" id="main">
				<div class="row">
					
					<div class="col-lg-12">
						<div style="margin-bottom:50px">
							
							<div class="row">
							
								<div class="col-lg-2">
									<i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:100px"></i>
								</div>
								<div class="col-lg-10">
									<h3 style="text-align:center" ><?php echo $data['error_message '];?></h3>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-4">
								</div>
								<div class="col-lg-4">
									<p><a href="index.php"><button style="border: none;outline: 0;display: inline-block;padding: 8px;color: white;background-color: #00446d;text-align: center;cursor: pointer;width: 100%;font-size: 18px;">Back to Home</button></a></p>
								</div>
								<div class="col-lg-4">
								</div>
							</div>	
						</div>
					</div>
				
				</div>
		</div>
		
		</section>
	
	<!--  Page is not Found-->

	
		<!--  Page is not Found-->
	
<section class="section6 buttons">
						<!-- Photo Gallery divider -->
						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									<h3>Important Links</h3>
									<div class="row">
										<div class="col-lg-4">
											<ul>
												<li><a href="http://10.163.2.160/projects/sscsr/site/IndexController/nomination">Nomination</a></li>
												<li><a href="http://10.163.2.160/projects/sscsr/site/IndexController/selectionpost">Selection Post</a></li>
												<li><a href="#">Downloads</a></li>
												<li><a href="#">Archives</a></li>
											</ul>
										</div>
										<div class="col-lg-4">
											<ul>
												<li><a href="http://10.163.2.160/projects/sscsr/site/IndexController/faq">FAQ</a></li>
												<li><a target="_blank" href="https://ssc.nic.in/Portal/AnswerKey">Answer Key</a></li>
												<li><a target="_blank" href="https://ssc.nic.in/Portal/Results">Result</a></li>
												<li><a href="https://ssc.nic.in/Portal/RegionalNetwork" target="_blank">Related Websites</a></li>
											</ul>
										</div>
									</div>
									
									
								</div>
								
								<div class="col-lg-6">
								
											<h3 class="photogalleryClass">Photo Gallery</h3>
											<div class="gallery">
											  <figure>
												<img src="img/gallery/1_thumbnail.png" alt="">
												<figcaption>Image-1 <small>Description</small></figcaption>
											  </figure>
											  <figure>
												<img src="img/gallery/2_thumbnail.png" alt="">
												<figcaption>Image-2 <small>Description</small></figcaption>
											  </figure>
											  <figure>
												<img src="img/gallery/3_thumbnail.png" alt="">
												<figcaption>Image-3 <small>Description</small></figcaption>
											  </figure>
											  <figure>
												<img src="img/gallery/4_thumbnail.png" alt="">
												<figcaption>Image-4 <small>Description</small></figcaption>
											  </figure>
											</div>	
											<div class="cbp-l-loadMore-button">
												<a href="http://10.163.2.160/projects/sscsr/site/IndexController/gallerypage" target="_blank" class="loadmore indexmore">VIEW ALL</a>
											</div>								
											
															
								</div>
								<!-- <div class="col-lg-4">
									<div class="cClass">
										<div class="monthly buttons" id="mycalendar"></div>
									</div>
								</div> -->
							</div>
						</div>
						<!-- Photo Gallery divider -->
					</section>
<section class="section5">

		
			<div class="container-fluid bgColor">
				<div class="row">
					<div class="col-sm-5 col-lg-5">
					</div>
					<div class="col-sm-7 col-lg-7">
						<div class="footerClass">
							
							<?php echo $data['renderedFooterMenu'];?>
							
						</div>	
					</div>
					
					
				</div>
				
				
				
				<div class="row footerFont">
					<div class="col-sm-2 col-lg-2 ">
					</div>
					<div class="col-sm-8 col-lg-8 footer_content_div" >
						
						<p> This portal is designed, developed, hosted and maintained by National Informatics Centre(NIC)<br>Ministry Of Electronics & Information Technology, Government Of India, Tamil Nadu State Center, Chennai - 600 090.
							<br>Last Modified: <?php echo date('M d,Y');?> | This portal is bes viewed in chrome and firefox browser(Latest Version).</p>
					</div>
					<div class="col-sm-2 col-lg-2 ">
					</div>
				</div>
				
			</div>
			
			
				
			
			
</section>
		
</div>
	<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
	<script src="js/jquery.min.js"></script> 

	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/uisearch.js"></script>
	<script src="js/jquery.cubeportfolio.min.js"></script>
	<script src="js/google-code-prettify/prettify.js"></script>
	<script src="js/animate.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/jquery.font-accessibility.min.js"></script>
	<script src="js/monthly.js"></script>
	<script src="js/slick.js"></script>
	<script src="js/jQuery.print.js"></script>
	<script src="js/custom_script.js"></script>
	<script src="js/select2.js"></script>
	<script src="js/select2.min.js"></script>
	<script>
	 $(document).ready(function(){
		 
	 $('.panel-body').hide();
		 
		$(document).on('click', '.panel-heading span.clickable', function(e){
			  
			var $this = $(this);
			
			if(!$this.hasClass('panel-collapsed')) {
				$this.parents('.panel').find('.panel-body').slideDown();
				$this.addClass('panel-collapsed');
				$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
				
			} else {
				
				$this.parents('.panel').find('.panel-body').slideUp();
				$this.removeClass('panel-collapsed');
				
				
				$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
				
			}
		})
		 
		 
		
		var baseurl = '<?php echo $this->route->site_url("IndexController/getExamDetails/q/2"); ?>';  
	$('#examname').select2();
	$('#examname').select2({
        placeholder: 'Select Exam Name',
        ajax: {
          url: baseurl,
          dataType: 'json',
		  data: function (data) {
                    return {
                        q: data.term // search term
                    };
                },
          processResults: function (data) {
            return {
			
              results: data
            };
          },
          cache: true
        }
      });
	  
	  // Selection Posts Start
	  
	  var baseurl = '<?php echo $this->route->site_url("IndexController/getPhaseDetails/q/2"); ?>';  
	$('#phasename').select2();
	$('#phasename').select2({
        placeholder: 'Select Phase Name',
        ajax: {
          url: baseurl,
          dataType: 'json',
		  data: function (data) {
                    return {
                        q: data.term // search term
                    };
                },
          processResults: function (data) {
            return {
			
              results: data
            };
          },
          cache: true
        }
      });
	  
	  //Selection Posts End 
	  
	  
	  
	});
</script>
	
</body>

</html>