<!-- session -->
<?php
require_once("config/db.php");
session_start();
if (!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])) {
	header("Location: login.php");
} else {
	?>
	<!-- header -->
	<?php include('header.php'); ?>
	<div class="main-grid">



		<div class="panel panel-widget forms-panel">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-9 form-group">
								<h4>List of Exam Tier Master </h4>
							</div>
							<div class="col-md-2 form-group">
								<!-- <button class="btn w3ls-button hvr-icon-float-away col-24" onclick="preview()">Admit Card Preview </button>-->
							</div>

							<!--<iframe id="forPostyouradd" data-src="https://rtionline.tn.gov.in/sscsr/site/IndexController/admitcardpreview" src="about:blank" width="500" height="200" style="background:#ffffff"></iframe>-->
						</div>
					</div>

					<div class="form-body">
						<div id="examdata">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<?php include('footer.php'); ?>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.js"></script> -->
<!-- <link href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<script src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->






<script type="text/javascript">
	/* function preview () {
		var iframe = $("#forPostyouradd");
		iframe.attr("src", iframe.data("src")); 
	} */
	$(document).ready(function () {




		// load exam	
		$.ajax({
			url: "Load_exam_tier_details.php",
			method: "GET",
			success: function (data) {
				$('#examdata').html(data);
			}
		});


		/*  Check Username Availability with jQuery and AJAX  Start*/

		$("#column_name").keyup(function () {

			var column_name = $(this).val().trim();


			if (column_name != '') {

				$.ajax({
					url: 'column_already_exists.php',
					type: 'post',
					data: {
						column_name: column_name
					},
					dataType: "json",
					success: function (response) {

						if (response == "") {
							$('#uname_response').html(response);
						} else {
							$('#uname_response').html(response);
							$("#column_name").val('');
						}

						//$("#column_name").val('');

					}
				});
			} else {
				$("#uname_response").html("");
			}

		});


		/*  Check Username Availability with jQuery and AJAX End*/








	});
</script>