<?php

namespace App\Controllers;

use App\System\Route; 

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
//echo $base_url."IndexController/admin_login";

?>
<!DOCTYPE html>
<html lang="en">
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
<?php  //echo phpinfo();?>
<div id="wrapper">
<section class="buttons">
	
	
	<div class="container" id="main">
		<div class="row">
			<div class="col-lg-3">
				<div style="margin-top:50px">
				</div>
			</div>
			<div class="col-lg-6" style='margin-top:10%'>
				<div>
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
										<div style="text-align:center;margin-bottom:20px ">( cgle 2019 / 91000299330 / 29-07-1995 ) </div>
							<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="max-width:585px !important;" target="_blank">       
							  
							   <label for="exampleInputEmail1">Exam</label>
							  <select name="examname" id="examname" required="true" class="form-control col-md-3 col-sm-2">
									<option value="" selected="selected">Select Exam</option>		
								</select>
							  <br>
							  <br>
							  
							  
							  
							  
							    <!-- <label for="exampleInputEmail1">Register Number</label>
							  <input type="text" class="form-control" placeholder="Application Number" name="register_number" id = "username" required="" autocomplete="off" />
							  <br>
							  <br>admitcard_preview_examname
								<div class='roll_pp_div' style='display:none'>
									<label for="exampleInputEmail1">Roll Number <span class="qnsround" data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
									<input type="text" class="form-control" placeholder="Roll Number" name="roll_number" id="roll_number" value ="" autocomplete="off" />
									<br>
								</div> -->

								<label for="exampleInputEmail1">Register Number <span class="qnsround"  data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
								<input type="text" class="form-control" placeholder="Application Number" name="register_number" id="register_number"  autocomplete="off" />
								
								<br>
								<div class='roll_pp_div' style='display:none'>
									<label for="exampleInputEmail1">Roll Number <span class="qnsround" data-toggle='tooltip' title='cut,copy,paste is not allowed . Type it Manually'>?</span></label>
									<input type="text" class="form-control" placeholder="Roll Number" name="roll_number" id="roll_number" value ="" autocomplete="off" />
									<br>
								</div>







								<div class="post_preference_div_select" style="display: none;">

										<label for="exampleInputEmail1">Post Preference</label>
									
										<select class="form-control" name="post_preference_one" id="post_preference_one">

										</select>


										
										<br>

									</div>
							  <!-- <label for="exampleInputEmail1">Date of Birth</label>
							  <input type="date" class="form-control" placeholder="DOB " name="dob" 
							  required="" id = "password" autocomplete="off"  min ="1980-01-01" max="2005-01-01"/>  -->
							  <div class="form-group row">
									<div class="col-xs-4">
										<label for="exampleInputEmail1">Date of Birth</label>
										<input type="text" class="form-control placeholder_font_size" name="dob" id="dob" value="" autocomplete="off"  readonly  required>
									</div>
							 </div>
							 


							 
							  <br>
							  <button class="btn btn-lg btn-sscsrthemecolor btn-block" type="submit" name="admit_card">Preview</button>   
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
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
    color: black !important;
}
 </style>



<?php //echo $this->get_footer(); ?>







		
</div>





	
	<script src="js/jquery.min.js"></script> 

	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/uisearch.js"></script>
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
	
	
	<link href="css/lightgallery.css" rel="stylesheet">
	<script src="js/lightgallery-all.min.js"></script>
	<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<style>
		.qnsround {
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
		</style>
	
	<script>
	 $(document).ready(function(){
		$.datepicker.setDefaults({
			showOn: "button",
			buttonImage: "img/datepicker.png",
			buttonText: "Date Picker",
			buttonImageOnly: true,
			dateFormat: 'dd-mm-yy'
		});
		$(function() {
			$("#dob").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: '1965:2015'
			});
		});
		
		 
		
		 
		$("[data-toggle='tooltip']").tooltip();
		 
	 
	
		 
		 
		
		var baseurl = '<?php echo $this->route->site_url("IndexController/getTierBasedExamDetailsCardPreview/q/2"); ?>';  
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
	  
	var baseurl = '<?php echo $this->route->site_url("IndexController/getGalleryYears/q/2"); ?>';  
	$('#gallery_year').select2();
	$('#gallery_year').select2({
        placeholder: 'Select Year Name',
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
	  
	  
	  //  Admit card Exam Name AJAX
	  
	  
	  		
		var baseurl = '<?php echo $this->route->site_url("IndexController/getTierBasedExamDetailsPreview/q/2"); ?>';  
	$('#admitcard_examname').select2();
	$('#admitcard_examname').select2({
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
	  
		$('#roll_number').on("cut copy paste", function(e) {
			e.preventDefault();
		});

		$('#register_number').on("cut copy paste", function(e) {
			e.preventDefault();
		});


		$("#roll_number").keyup(function() {

			$('#post_preference_one').empty();







			var roll_no = $(this).val().trim();

			let examname = $('#admitcard_examname option:selected').val();



			let exam_name = examname.split('_');
			let exam_type = exam_name[2];

			//debugger;
			if (roll_no != '' && exam_type == 'dv') {

				var baseurl = '<?php echo $this->route->site_url("IndexController/getPostPreferenceValue"); ?>';

				//debugger;

				$.ajax({
					url: baseurl,
					type: 'post',
					data: {
						roll_no: roll_no,
						examname: examname
					},
					dataType: "json",
					success: function(response) {

						var html = '';
						$.each(response, function(i) {
							html += '<option value="' + response[i]["post_preference"] + '">' +
								response[i]["post_preference"] + '</option>';
						})
						$('#post_preference_one').empty().append(html);

					}
				});
			} else {
				$("#post_preference_one").html("");
			}

		});


		$('#admitcard_examname').on('change', function() {
			$('#roll_number').val('');
			$('#register_number').val('');
			$('#password').val('');

			let admitcardExamName = $('#admitcard_examname option:selected').val();
			var strshortened = admitcardExamName.slice(0, 5);
			if (strshortened == "phase") {
				let exam_name = admitcardExamName.split('_');
				let exam_type = exam_name[2];
				if (exam_type == 'tier' || exam_type == 'skill') {

					$('.roll_pp_div').show();
					$('.post_preference_div_select').hide();

					$('#post_preference_one').empty();







				} else if (exam_type == 'dv') {
					$('.roll_pp_div').show();
					$('.post_preference_div_select').show();

				}

			} else {
				$('.roll_pp_div').hide();
			}



		});
	  
	  //  Admit card Exam Name AJAX
	  
	  
	  
	  //  Admit card Exam Name AJAX
	  
	  
	  		
		var baseurl = '<?php echo $this->route->site_url("IndexController/getTierMaster/q/2"); ?>';  
	$('#tier_id').select2();
	$('#tier_id').select2({
        placeholder: 'Select Tier Name',
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
	  
	  //  Admit card Exam Name AJAX
	  


	$('#gallery_year').on('change', function() {
		var year = $('gallery_year').val();
		var baseurl = '<?php echo $this->route->site_url("IndexController/getYearBasedEvents/year/2"); ?>'; 
			$.ajax({
				type: "POST",
				url: baseurl,
				data:{year:year},
				contentType: "application/json; charset=utf-8",
				success: function(result) {
					var abc =  JSON.parse(result);
					$.each(abc, function(index,value){
						$('#gallery_events').append('<label class="btn btn-secondary event" for="'+value.id+'"><input class="customEventRadioButton " id="'+value.text+'" name="searchRadio" value="'+value.id+'" type="radio" checked>'+value.text+'</label>');
					});
					
					
				}
			});

	});
	
$('#gallery_events ').on('change', function() {
	
var gallery_id = 	$('#gallery_events ').find('input[name="searchRadio"]:checked').val();



var baseurl = '<?php echo $this->route->site_url("IndexController/getGalleryidBasedImages"); ?>'; 

$.ajax({
	type: "POST",
	url: baseurl,
	data:{gallery_id:gallery_id},
	dataType:"json",
	success: function(response){
	//debugger;
	var html = '';
		html += '<ul id="lightgallery" class="list-unstyled row">';

	$.each(response, function(index,value){
		var imagepath = "gallery/"+value.id;
		
		//html += '<li class="cbp-item web-design logo"><div class="cbp-caption"><div class="cbp-caption-defaultWrap"><img src="'+ imagepath +'" style="height:100%" alt="" class="img-responsive" /></div><div class="cbp-caption-activeWrap"><div class="cbp-l-caption-alignCenter"><div class="cbp-l-caption-body"><a href="'+ imagepath +'" class="cbp-lightbox cbp-l-caption-buttonRight" data-title="SSCSR Image-2">view larger</a></div></div></div></div></li>';
		html += '<li class="col-xs-6 col-sm-4 col-md-3" data-src="'+ imagepath +'" data-sub-html="<p>'+ value.text +'</p>"><a href=""><img class="img-responsive"  style="border: 10px solid black;height:200px;margin:10px" src="'+ imagepath +'"></a></li>';
		
	});
	html +="</ul></li>";
	
	//$('#grid-container').css('height','auto');
	$('#imgGallery').html(html);
	//light Box Pluggin

		 $('#lightgallery').lightGallery({
			  mode: "lg-slide",
			  cssEasing: "ease",
			  easing: "linear",
			  speed: 600,
			  height: "100%",
			  width: "100%",
			  addClass: "",
			  startClass: "lg-start-zoom",
			  backdropDuration: 150,
			  hideBarsDelay: 6000,
			  useLeft: false,
			  closable: true,
			  loop: true,
			  escKey: true,
			  keyPress: true,
			  controls: true,
			  slideEndAnimatoin: true,
			  hideControlOnEnd: false,
			  mousewheel: true,
			  getCaptionFromTitleOrAlt: true,
			  appendSubHtmlTo: ".lg-sub-html",
			  subHtmlSelectorRelative: false,
			  preload: 1,
			  showAfterLoad: true,
			  selector: "",
			  selectWithin: "",
			  nextHtml: "",
			  prevHtml: "",
			  index: false,
			  iframeMaxWidth: "100%",
			  download: true,
			  counter: true,
			  appendCounterTo: ".lg-toolbar",
			  swipeThreshold: 50,
			  enableSwipe: true,
			  enableDrag: true,
			  dynamic: false,
			  dynamicEl: [],
			  galleryId: 1
			});

			//light Box pluggin
	
	

	
        }  // Success Function
}); // ajax End



});

	
	
	
	
	});
	
	
	
	
	
	function photogalleryFunction(gallery_id){
		//var gallery_id = 	$('#gallery_events ').find('input[name="searchRadio"]:checked').val();



var baseurl = '<?php echo $this->route->site_url("IndexController/getGalleryidBasedImages"); ?>'; 

$.ajax({
	type: "POST",
	url: baseurl,
	data:{gallery_id:gallery_id},
	dataType:"json",
	success: function(response){
	//debugger;
	var html = '';
		html += '<ul id="lightgallery" class="list-unstyled row">';

	$.each(response, function(index,value){
		var imagepath = "gallery/"+value.id;
		
		//html += '<li class="cbp-item web-design logo"><div class="cbp-caption"><div class="cbp-caption-defaultWrap"><img src="'+ imagepath +'" style="height:100%" alt="" class="img-responsive" /></div><div class="cbp-caption-activeWrap"><div class="cbp-l-caption-alignCenter"><div class="cbp-l-caption-body"><a href="'+ imagepath +'" class="cbp-lightbox cbp-l-caption-buttonRight" data-title="SSCSR Image-2">view larger</a></div></div></div></div></li>';
		html += '<li class="col-xs-6 col-sm-4 col-md-3" data-src="'+ imagepath +'" data-sub-html="<p>'+ value.text +'</p>"><a href=""><img class="img-responsive"  style="border: 10px solid black;height:200px;margin:10px" src="'+ imagepath +'"></a></li>';
		
	});
	html +="</ul></li>";
	
	//$('#grid-container').css('height','auto');
	$('#imgGallery').html(html);
	//light Box Pluggin

		 $('#lightgallery').lightGallery({
			  mode: "lg-slide",
			  cssEasing: "ease",
			  easing: "linear",
			  speed: 600,
			  height: "100%",
			  width: "100%",
			  addClass: "",
			  startClass: "lg-start-zoom",
			  backdropDuration: 150,
			  hideBarsDelay: 6000,
			  useLeft: false,
			  closable: true,
			  loop: true,
			  escKey: true,
			  keyPress: true,
			  controls: true,
			  slideEndAnimatoin: true,
			  hideControlOnEnd: false,
			  mousewheel: true,
			  getCaptionFromTitleOrAlt: true,
			  appendSubHtmlTo: ".lg-sub-html",
			  subHtmlSelectorRelative: false,
			  preload: 1,
			  showAfterLoad: true,
			  selector: "",
			  selectWithin: "",
			  nextHtml: "",
			  prevHtml: "",
			  index: false,
			  iframeMaxWidth: "100%",
			  download: true,
			  counter: true,
			  appendCounterTo: ".lg-toolbar",
			  swipeThreshold: 50,
			  enableSwipe: true,
			  enableDrag: true,
			  dynamic: false,
			  dynamicEl: [],
			  galleryId: 1
			});

			//light Box pluggin
	
	

	
        }  // Success Function
}); // ajax End
	}
</script>
	
</body>

</html>
	