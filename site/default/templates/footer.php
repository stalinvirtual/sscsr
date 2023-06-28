<section class="section5">


	<div class="container-fluid bgColor">
		<div class="row">
			<div class="col-sm-5 col-lg-5">
			</div>
			<div class="col-sm-7 col-lg-7">
				<div class="footerClass">
					<?php echo $renderedFooterMenu; ?>

				</div>
			</div>


		</div>
		<div class="row footerFont">
			<div class="col-sm-2 col-lg-2 ">
			</div>
			<div class="col-sm-8 col-lg-8 footer_content_div">

				<p> This portal is designed, developed, hosted and maintained by National Informatics Centre(NIC)<br>Ministry Of Electronics & Information Technology, Government Of India, Tamil Nadu State Center, Chennai - 600 090.
					<br>Last Modified: <?php echo date('M d,Y'); ?> | This portal is bes viewed in chrome and firefox browser(Latest Version).
				</p>
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

<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
	$(document).ready(function() {

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



		$("[data-toggle='tooltip']").tooltip(); // Initialize Tooltip


		$("#sscsr_site_logo").hover(
			function() {
				var title = $(this).attr("data-title");
				$('<div/>', {
					text: title,
					class: 'box'
				}).appendTo(this);
			},
			function() {
				$(document).find("div.box").remove();
			}
		);


		



		$('.panel-body').hide();

		$(document).on('click', '.panel-heading span.clickable', function(e) {

			var $this = $(this);

			if (!$this.hasClass('panel-collapsed')) {
				$this.parents('.panel').find('.panel-body').slideDown();
				$this.addClass('panel-collapsed');
				$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

			} else {

				$this.parents('.panel').find('.panel-body').slideUp();
				$this.removeClass('panel-collapsed');


				$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');

			}
		})

      // Know your status

		var baseurl = '<?php echo $this->route->site_url("IndexController/getExamDetails/q/2"); ?>';
		$('#examname').select2();
		$('#examname').select2({
			placeholder: 'Select Exam Name',
			ajax: {
				url: baseurl,
				dataType: 'json',
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
					return {

						results: data
					};
				},
				cache: true
			}
		});

		 // Know your status

		// Selection Posts Start

		var baseurl = '<?php echo $this->route->site_url("IndexController/getPhaseDetails/q/2"); ?>';
		$('#phasename').select2();
		$('#phasename').select2({
			placeholder: 'Select Phase Name',
			ajax: {
				url: baseurl,
				dataType: 'json',
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
					return {

						results: data
					};
				},
				cache: true
			}
		});

		// var baseurl = '<?php //echo $this->route->site_url("IndexController/getGalleryYears/q/2"); 
							?>';  
		// $('#gallery_year').select2();
		// $('#gallery_year').select2({
		//     placeholder: 'Select Year Name',
		//     ajax: {
		//       url: baseurl,
		//       dataType: 'json',
		// 	  data: function (data) {
		//                 return {
		//                     q: data.term // search term
		//                 };
		//             },
		//       processResults: function (data) {
		//         return {

		//           results: data
		//         };
		//       },
		//       cache: true
		//     }
		//   });



		//Selection Posts End 


		//  Admit card Exam Name AJAX



		var baseurl = '<?php echo $this->route->site_url("IndexController/getTierBasedExamDetailsCard/q/2"); ?>';
		$('#admitcard_examname').select2();
		$('#admitcard_examname').select2({
			placeholder: 'Select Exam Name',
			ajax: {
				url: baseurl,
				dataType: 'json',
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
					return {

						results: data
					};
				},
				cache: true
			}
		});




		
		var baseurl2 = '<?php echo $this->route->site_url("IndexController/getTierBasedExamDetailsCardPreview/q/2"); ?>';
		$('#admitcard_preview_examname').select2();
		$('#admitcard_preview_examname').select2({
			placeholder: 'Select Exam Name',
			ajax: {
				url: baseurl2,
				dataType: 'json',
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
					return {

						results: data
					};
				},
				cache: true
			}
		});



		var baseurl = '<?php echo $this->route->site_url("IndexController/getTierBasedExamDetailsCity/q/2"); ?>';
		$('#city_examname').select2();
		$('#city_examname').select2({
			placeholder: 'Select Exam Name',
			ajax: {
				url: baseurl,
				dataType: 'json',
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
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
				data: function(data) {
					return {
						q: data.term // search term
					};
				},
				processResults: function(data) {
					return {

						results: data
					};
				},
				cache: true
			}
		});

		//  Admit card Exam Name AJAX

		//Photo Gallery
		let year  = new Date().getFullYear()  

		
		photogalleryFunction(year);
		//$("#gallery_year").trigger('change');
		function photogalleryFunction(year) {
			//var gallery_id = 	$('#gallery_events ').find('input[name="searchRadio"]:checked').val();



			var baseurl = '<?php echo $this->route->site_url("IndexController/GalleryidBasedImagesWithLightBox"); ?>';

			$.ajax({
				type: "POST",
				url: baseurl,
				data: {
					year: year
				},
				dataType: "json",
				success: function(response) {
					var html = '';

					$.each(response, function(index, value) {
						var imagepath = "gallery/" + value.id;
						var event_id = value.text.split(",");
						html += '<div class="col-md-6 col-lg-3 "> <div class="card border-0 "> <div class="card-body img-container"><img  style="cursor:pointer" id ="' + event_id[1] + '" src="' + imagepath + '" alt="Card Image" width="200" height="200" class="card-img-top  leImage">  <h6 class="eventClass">' +  event_id[0] + '</h6> </div> </div> </div>';
					});
					html += "</ul></li>";
					$('#imgGallery').html(html);


					// //light Box Pluggin
					$(".leImage").on("click", function() {

						//$('#imgGallery').html('');

						var id = this.id;
						var baseurl = '<?php echo $this->route->site_url("IndexController/EventBasedLightBox"); ?>';
						$.ajax({
							type: "POST",
							url: baseurl,
							data: {
								id: id
							},
							dataType: "json",
							success: function(response) {

								$('#gallery_year').hide();
								$('#yearId').hide();

								
								

								var html = "";
								html += '<button onclick="location.reload();">Go Back</button><ul id="lightgallery" class="list-unstyled row">';
								$.each(response, function(index, value) {
									var imagepath = "gallery/" + value.id;
									var event_id = value.text.split(",");
									html +='<li class="col-xs-6 col-sm-4 col-md-3" data-src="' + imagepath + '" data-sub-html="<p>'  +  event_id[0]  + '</p>"><a href=""><img class="img-responsive" style="border: 4px solid #949191;;width:200px;height:200px;margin:10px" src="' + imagepath + '"></a></li>';
								});
								html += "</ul></li>";
								$('#imgGallery').html(html);
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



							}
						});

					});

					//light Box pluggin




				} // Success Function
			}); // ajax End
		}

		$("#gallery_year").on('change', function(e) {
			let year = $(this).val();
			photogalleryFunction(year);
		});

	});

	function photogalleryFunction(gallery_id) {
		//var gallery_id = 	$('#gallery_events ').find('input[name="searchRadio"]:checked').val();



		var baseurl = '<?php echo $this->route->site_url("IndexController/GalleryidBasedImagesWithLightBox"); ?>';

		$.ajax({
			type: "POST",
			url: baseurl,
			data: {
				gallery_id: gallery_id
			},
			dataType: "json",
			success: function(response) {

				var html = '';
				html += '<ul id="lightgallery" class="list-unstyled row">';

				$.each(response, function(index, value) {
					var imagepath = "gallery/" + value.id;

					//html += '<li class="cbp-item web-design logo"><div class="cbp-caption"><div class="cbp-caption-defaultWrap"><img src="'+ imagepath +'" style="height:100%" alt="" class="img-responsive" /></div><div class="cbp-caption-activeWrap"><div class="cbp-l-caption-alignCenter"><div class="cbp-l-caption-body"><a href="'+ imagepath +'" class="cbp-lightbox cbp-l-caption-buttonRight" data-title="SSCSR Image-2">view larger</a></div></div></div></div></li>';
					html += '<li class="col-xs-6 col-sm-4 col-md-3" data-src="' + imagepath + '" data-sub-html="<p>' + value.text + '</p>"><a href=""><img class="img-responsive"  style="border: 10px solid black;height:200px;margin:10px" src="' + imagepath + '"></a></li>';

				});
				html += "</ul></li>";

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




			} // Success Function
		}); // ajax End
	}
</script>

</body>

</html>