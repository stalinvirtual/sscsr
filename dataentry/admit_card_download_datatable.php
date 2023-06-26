<?php
session_start();
if (!isset($_SERVER['HTTP_REFERER']) && empty($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])) {
	header("Location: login.php");
} else {
	?>
	<?php
	include('header.php'); ?>

<style>

.loader-mask {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    z-index: 99999;
	display: none;
}

.loader {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 50px;
    height: 50px;
    font-size: 0;
    color: #00c9d0;
    display: inline-block;
    margin: -25px 0 0 -25px;
    text-indent: -9999em;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
}
.lead{
  font-size:13px;
}
.loader div {
    background-color: #d9b06a;
    display: inline-block;
    float: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    height: 50px;
    opacity: .5;
    border-radius: 50%;
    -webkit-animation: ballPulseDouble 2s ease-in-out infinite;
    animation: ballPulseDouble 2s ease-in-out infinite;
}

.loader div:last-child {
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

@-webkit-keyframes ballPulseDouble {
    0%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

@keyframes ballPulseDouble {
    0%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}
		</style>
	<div class="main-grid">
		<div class="panel panel-widget forms-panel">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-8 form-group">
								<h4>Admit card downloaded data </h4>
							</div>
						</div>
					</div>
					<div class="form-body">
						<div data-example-id="simple-form-inline">
							<form class="form-horizontal" action="#" method="post" id="creating_master_tables">
								<div class="form-group">
									<label for="examname" class="col-sm-2 control-label">Exam Name<font style="color:red" ;>
											*</font> </label>
									<div class="col-sm-6">
										<select name="examname" id="examname" required="true" class="form-control">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="exam_year" class="col-sm-2 control-label">Select Year<font style="color:red"
											;>*</font> </label>
									<div class="col-sm-6">
										<input type="text" min="<?php echo date('Y') - 5; ?>"
											max="<?php echo date('Y') + 5; ?>" step="1" name="exam_year" id="exam_year"
											maxlength="4"
											oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											type="number" class="form-control" value="<?php echo date('Y'); ?>" />
									</div>
									<div id="year_exists" class=" col-sm-4">
									</div>
								</div>
								<div class="form-group showexamcode">
									<label for="exam_year" class="col-sm-2 control-label">Exam Code</label>
									<div class="col-sm-6">
										<p class="examshowcode"></p>
									</div>
								</div>
								<div class="form-group selectedTableFormat">
									<label for="selectedTableFormat" class="col-sm-2 control-label">Table For<font
											style="color:red" ;>*</font> </label>
									<div class="col-sm-6">
										<select name="selectedTableFormat" id="selectedTableFormat" required="true"
											class="form-control">
											<option value=""></option>
											<option value="is_tier">Written Exam</option>
											<option value="is_skill">Skill Test</option>
											<option value="is_dme">Detailed Medical Examination</option>
											<option value="is_pet">Physical Standard Test and Physical Endurance Test
											</option>
											<option value="is_dv">Document Verification</option>
										</select>
									</div>
									<div id="table_exits" class=" col-sm-4">
									</div>
								</div>
								<div class="form-group selectedtier">
									<label for="selectedtier" class="col-sm-2 control-label">Exam Tier<font
											style="color:red" ;>*</font> </label>
									<div class="col-sm-6">
										<select name="selectedtier" id="selectedtier" required="true" class="form-control">
											<option value="0" selected="selected">Select Tier</option>
										</select>
									</div>
								</div>
								<div class="form-group download_options">
									<label for="" class="col-sm-2 control-label">Download Options<font style="color:red" ;>*
										</font> </label>
									<div class="col-sm-6">
										<label class="radio-inline">
											<input type="radio" name="download_options" class="download_opt"
												id="download_options" value="1" />Download
										</label>
										<label class="radio-inline">
											<input type="radio" name="download_options" class="download_opt"
												id="download_options" value="0" />Not download
										</label>
										<!-- <input type="radio" name="download_options" value="Male" />Download Candidate
										<select name="download_options" id="download_options" required="true" class="form-control">
											<option value=""></option>
											<option value="1">download</option>
											<option value="0">not download</option>
										</select> -->
									</div>
									<div id="table_exits" class=" col-sm-4">
									</div>
								</div>
								<!-- <button class="btn w3ls-button hvr-icon-down col-5" id="admit_submit_button"
									style="margin: 10px 0px 0px 329px;">
									Submit</button> -->
							</form>
							<div id="messageTemplate">
							</div>


							<!-- <div id="overlay" style="display:none;">
								<h1>Data Uploading...</h1>
								<br>
								<div class="progress-3"></div>
								<br>
								<h3>Please wait</h3>
							</div> -->

								<!-- Preloader -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>


	
<!-- Preloader --> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		.col-sm-4.status_card {
    background-color: #00acc1;
    text-align: center;
    padding: 10px;
    color: white;
    font-weight: 600;
	font-size: small;
}
.col-sm-6.status_card {
    background-color: #00acc1;
    text-align: center;
    padding: 10px;
    color: white;
    font-weight: 600;
	font-size: small;
}
.col-sm-6.kyas_status_form {
    padding-right: 0px;
}

[class*=classic]:before {
  content:"Loading...";
}
.progress-3 {
  width:100%;
  height:20px;
  border-radius: 20px;
  background:
   repeating-linear-gradient(135deg,#f03355 0 10px,#ffa516 0 20px) 0/0%   no-repeat,
   repeating-linear-gradient(135deg,#ddd    0 10px,#eee    0 20px) 0/100%;
  animation:p3 2s infinite;
}
@keyframes p3 {
    100% {background-size:100%}
}
		#overlay {
			background: #ffffff;
			color: #666666;
			position: fixed;
			height: 100%;
			width: 100%;
			z-index: 5000;
			top: 0;
			left: 0;
			float: left;
			text-align: center;
			padding-top: 25%;
			opacity: .80;
		}
		.spinner {
			margin: 0 auto;
			height: 64px;
			width: 64px;
			animation: rotate 0.8s infinite linear;
			border: 5px solid firebrick;
			border-right-color: transparent;
			border-radius: 50%;
		}
		@keyframes rotate {
			0% {
				transform: rotate(0deg);
			}
			100% {
				transform: rotate(360deg);
			}
		}
		h2#swal2-title {
			text-align: start;
		}
		.errormsg {
			background: antiquewhite;
		}
		i.fa.fa-exclamation-triangle {
			width: inherit;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
			color: #999;
			cursor: pointer;
			display: none !important;
			font-weight: bold;
			margin-right: 2px;
		}
		p.examshowcode {
			padding: 6px;
			background-color: #00acc1;
			color: white;
			width: max-content;
			font-weight: 700;
		}
	</style>
	<?php
}
?>
<?php include('footer.php'); ?>
<script type="text/javascript" language="javascript">
	$(document).ready(function () {
		const d = new Date();
		d.getMonth() + 1; // Month	[mm]	(1 - 12)
		d.getDate();
		var current_yearbelow5 = d.getFullYear() - 5; // Day		[dd]	(1 - 31)
		var current_yearabove5 = d.getFullYear() + 5; // Day		[dd]	(1 - 31)
		$('.alert').hide();
		$('#examname').select2();
		$('.selectedTableFormat').hide();
		$('.showexamcode').hide();
		$('.table_columns').hide();
		$('#examname').select2({
			placeholder: 'Select Exam Name',
			ajax: {
				url: 'search_exam.php',
				dataType: 'json',
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
		$('#selectedTableFormat').select2({
			placeholder: 'Please select any one exam name',
			ajax: {
				url: 'search_exam.php',
				dataType: 'json',
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
		$('#examname').on('change', function () {
			//debugger;
			$('.table_columns').hide();
			$('#table_exits').html("");
			$('.selectedTableFormat').show();
			$('.showexamcode').show();
			var examshocode = $('#examname option:selected').val() + $("#exam_year").val();
			$('.examshowcode').html('<span>' + examshocode.toLowerCase() + '<span>');
			$("#selectedTableFormat").val('');
			$('#selectedTableFormat').select2({
				placeholder: 'Please select table format',
			});
		});
		$("#exam_year").keyup(function () {
			$('#table_exits').removeClass("errormsg");
			$('#table_exits').html("");
			$('.selectedTableFormat').hide();
			$('#parent_filter_select2').hide();
			$('.showexamcode').hide();
			year = $("#exam_year").val();
			if (year >= current_yearbelow5 && year <= current_yearabove5) {
				$("#year_exists").removeClass("errormsg");
				$('#year_exists').html("");
				$('.selectedTableFormat').show();
				$('.showexamcode').show();
				var examshocode = $('#examname option:selected').val() + $("#exam_year").val();
				$('.examshowcode').html('<span>' + examshocode.toLowerCase() + '<span>');
				$('#selectedTableFormat').select2({
					placeholder: "Select a Table Type",
					allowClear: true,
				});
				$("#selectedTableFormat").val('').trigger('change');
			} else {
				$("#year_exists").addClass("errormsg");
				$('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>" + current_yearbelow5 + "-" + current_yearabove5 + "</b></span></i>");
			}
		});
		$("#exam_year").keydown(function () {
			$('#table_exits').removeClass("errormsg");
			$('#table_exits').html("");
			$('.selectedTableFormat').hide();
			$('.showexamcode').hide();
			$('#parent_filter_select2').hide();
			year = $("#exam_year").val();
			if (year >= current_yearbelow5 && year <= current_yearabove5) {
				$('.selectedTableFormat').show();
				$('.showexamcode').show();
				var examshocode = $('#examname option:selected').val() + $("#exam_year").val();
				$('.examshowcode').html('<span>' + examshocode.toLowerCase() + '<span>');
				$('#selectedTableFormat').select2({
					placeholder: "Select a Table Type",
					allowClear: true,
				});
				$("#selectedTableFormat").val('').trigger('change');
			} else {
				$('#year_exists').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'> <span  style='color: red;font-size:15px;'>Please type year between <b>" + current_yearbelow5 + "-" + current_yearabove5 + "</b></span></i>");
			}
		});
		$('#selectedtier').select2({
			placeholder: 'Select Tier',
			ajax: {
				url: 'search_tier.php',
				dataType: 'json',
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
		//in multiselect select all/un select all
		$.fn.select2.amd.define('select2/selectAllAdapter', [
			'select2/utils',
			'select2/dropdown',
			'select2/dropdown/attachBody'
		], function (Utils, Dropdown, AttachBody) {
			function SelectAll() { }
			SelectAll.prototype.render = function (decorated) {
				var self = this,
					$rendered = decorated.call(this),
					$selectAll = $(
						'<button class="btn btn-xs btn-default" type="button" style="margin-left:6px;"><i class="fa fa-check-square-o"></i> Select All</button>'
					),
					$unselectAll = $(
						'<button class="btn btn-xs btn-default" type="button" style="margin-left:6px;"><i class="fa fa-square-o"></i> Unselect All</button>'
					),
					$btnContainer = $('<div style="margin-top:3px;">').append($selectAll).append($unselectAll);
				if (!this.$element.prop("multiple")) {
					// this isn't a multi-select -> don't add the buttons!
					return $rendered;
				}
				$rendered.find('.select2-dropdown').prepend($btnContainer);
				$selectAll.on('click', function (e) {
					var $results = $rendered.find('.select2-results__option[aria-selected=false]');
					//	debugger;
					$results.each(function () {
						//debugger;
						self.trigger('select', {
							data: $(this).data('data')
						});
					});
					self.trigger('close');
				});
				$unselectAll.on('click', function (e) {
					var $results = $rendered.find('.select2-results__option[aria-selected=true]');
					$results.each(function () {
						self.trigger('unselect', {
							data: $(this).data('data')
						});
					});
					self.trigger('close');
				});
				return $rendered;
			};
			return Utils.Decorate(
				Utils.Decorate(
					Dropdown,
					AttachBody
				),
				SelectAll
			);
		});
		$('#parent_filter_select2').select2({
			placeholder: 'Please select any one table format',
		});
		// $('#creating_master_tables').on('submit', function (event) {
		// 	event.preventDefault();
		// 	var examname = $('#examname option:selected').val();
		// 	var table_format = $('#selectedTableFormat option:selected').val();
		// 	var exam_year = $('#exam_year').val();
		// 	var download_options = $('input[name="download_options"]:checked').val();
		// 	// var download_options = 0;
		// 	var selectedtier = $('#selectedtier option:selected').val();
		// 	if (table_format == 'is_kyas') {
		// 		var tablefor = 'Application Status Details';
		// 	} else {
		// 		var tablefor = 'Tier Based Exam Details';
		// 	}
		// 	if (examname != '' && table_format != '' && exam_year != '') {
		// 		var formdata = new FormData(document.getElementById("creating_master_tables"));
		// 		//loader start
		// 		$.post('admit_card_download_dt_ajax.php', {
		// 			examname: examname,
		// 			selectedTableFormat: table_format,
		// 			exam_year: exam_year,
		// 			download_options: download_options,
		// 			selectedtier: selectedtier,
		// 		})
		// 			.done(function (data) {
		// 				//loader stop
		// 				$('#messageTemplate').html(data);
		// 				console.log(download_options);
		// 			})
		// 	}
		// });
	});
</script>
<script>
	
	$("#creating_master_tables input[type=radio]").change(function () {
	var formdata = new FormData(document.getElementById("creating_master_tables"));
		
		//$('#admit_submit_button').hide();
		var examname = $('#examname option:selected').val();
		var table_format = $('#selectedTableFormat option:selected').val();
		var exam_year = $('#exam_year').val();
		var download_options = $('input[name="download_options"]:checked').val();
		// var download_options = 0;
		var selectedtier = $('#selectedtier option:selected').val();
		if (table_format == 'is_kyas') {
			var tablefor = 'Application Status Details';
		} else {
			var tablefor = 'Tier Based Exam Details';
		}
		if (examname != '' && table_format != '' && exam_year != '') {
		
			//loader start
			// $('#overlay').fadeIn();
			$('.loader-mask').fadeIn();
			$.post('admit_card_download_dt_ajax.php', {
				examname: examname,
				selectedTableFormat: table_format,
				exam_year: exam_year,
				download_options: download_options,
				selectedtier: selectedtier,
			})
				.done(function (data) {
					//loader stop
				
				$('.loader-mask').fadeOut();
					
					$('#messageTemplate').html(data);
					console.log(download_options);
				})
		}

	});
</script>