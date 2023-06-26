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





		<div class="row" style='display:none'>
			<div class="col-md-9 form-group">

			</div>
			<div class="col-md-2 form-group">
				<button class="btn w3ls-button hvr-icon-float-away col-24" onclick="preview()">Admit Card Preview </button>
			</div>

			<!--<iframe id="forPostyouradd" data-src="https://rtionline.tn.gov.in/sscsr/site/IndexController/admitcardpreview" src="about:blank" width="500" height="200" style="background:#ffffff"></iframe>-->
		</div>
		<br>


		<div class="panel panel-widget forms-panel" id="list_admit_card">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-9 form-group">
								<h4>List of Admit Card Download </h4>
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
		<!-- Sample HTML --->

	<div class="panel panel-widget forms-panel" id="exam_based_candidate" style="display:none">
		<div class="forms">
			<div class="inline-form widget-shadow">
				<div class="form-title">
					<div class="row">
						<div class="col-md-9 form-group">
							<h4 id="custom_exam_name"></h4>
						</div>
						<div class="col-md-2 form-group">
							<button class="btn w3ls-button hvr-icon-float-away col-24" onclick="preview()">Back
							</button>
						</div>


					</div>
				</div>


				<div class="form-body" id="">
					<div id="download-admitcard">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sample HTML --->







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
			url: "load_admit_card_list.php",
			method: "GET",
			success: function (data) {
				$('#examdata').html(data);
			}
		});



		$(document).on('click', '.publish-admitcard', function () {
			var tablename = $(this).attr("id");

			var examName = $(this).parent().parent().find('#exam_name_id').html();

			$.ajax({
				url: "load_admit_card_list_by_exam.php",
				data: { tablename: tablename },
				method: "POST",
				success: function (data) {
					$('#exam_based_candidate').show();
					$('#list_admit_card').hide();
					$('#download-admitcard').html(data);

					$('#custom_exam_name').html(examName);


					var table = $('#exam_data1').DataTable({
						//dom: 'Bfrtip',
						dom: "Bfrtip",
						buttons: [
							'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
						],


						select: {
							'style': 'multi'
						},


						pageLength: 5,
						lengthMenu: [
							[5, 10, 20, -1],
							[5, 10, 20, 'All']
						],

						select: true,

					});

					// Apply the search
					table.columns().eq(0).each(function (colIdx) {
						$('input', table.column(colIdx).footer()).on('keyup change', function () {
							table.column(colIdx)
								.search(this.value)
								.draw();
						});
					});

















				}
			});
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
	function preview() {

		$('#list_admit_card').show();
		$('#exam_based_candidate').hide();


	}
</script>