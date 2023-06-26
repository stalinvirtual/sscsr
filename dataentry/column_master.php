<!-- session -->
<?php
require_once("config/db.php");
session_start();
if (!isset($_SERVER['HTTP_REFERER']) && empty($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])) {
	header("Location: login.php");
} else {
	?>
	<!-- header -->
	<?php include('header.php'); ?>
	<script src="js/validatehtml.js"></script>
	<div class="main-grid">


		<!-- ADD Modal -->
		<div class="modal fade" id="addStudent" role="dialog">
			<div class="modal-dialog modal-sm-4">
				<div class="modal-content">
					<div class="modal-body">
						<div class="panel panel-widget forms-panel">
							<div class="forms">
								<div class=" form-grids form-grids-right">
									<div class="widget-shadow " data-example-id="basic-forms">
										<div class="form-title">
											<h4>Add New Column Details :</h4>
										</div>
										<div class="form-body">
											<form class="form-horizontal">


												<div class="form-group">
													<label for="column_name" class="col-sm-4 control-label">Column Name<font
															style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<input type="text" id="column_name" name="column_name"
															class="form-control" placeholder="Column Name" value=""
															required="true">
														<div id="uname_response"></div>

													</div>
												</div>


												<div class="column_name_validate"></div>

												<div class="form-group">
													<label for="column description" class="col-sm-4 control-label">Column
														Description <font style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<input type="text" id="column_description" name="column_description"
															class="form-control" placeholder="Column Description" value=""
															required="true">

													</div>
												</div>

												<div class="column_desc_validate"></div>
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label">Column For :
														<span style='color:red'>*</span></label>
													<div class="col-sm-4">
														<label class="checkbox">
															<input type="checkbox" name="is_kyas" class="kyas"
																value="kyas_add">
															<i class="icon-checkbox"></i>
															Application Status
														</label>
													</div>
													<div class="col-sm-4"><label class="checkbox">
															<label class="checkbox">
																<input type="checkbox" name="is_tier" class="tier"
																	value="tier_add">
																<i class="icon-checkbox"></i>
																Written Exam
															</label>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-4">
														<label class="checkbox">
															<input type="checkbox" name="is_skill" class="skill"
																value="skill_add">
															<i class="icon-checkbox"></i>
															Skill Test
														</label>
													</div>
													<div class="col-sm-4"><label class="checkbox">
															<label class="checkbox">
																<input type="checkbox" name="is_pet" class="pet"
																	value="pet_add">
																<i class="icon-checkbox"></i>
																PET Exam
															</label>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-8">
														<label class="checkbox">
															<input type="checkbox" name="is_dme" class="dv" value="dme_add">
															<i class="icon-checkbox"></i>
															Detailed Medical Examination
														</label>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-8">
														<label class="checkbox">
															<input type="checkbox" name="is_dv" class="dv" value="dv_add">
															<i class="icon-checkbox"></i>
															Document Verification
														</label>
													</div>
												</div>
												<input type="hidden" id="txt_userid" value="0">

												<div class="col-sm-offset">
													<button type="button" class="btn btn-default w3ls-button"
														id="addcolumn">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="updateModal" role="dialog">
			<div class="modal-dialog modal-sm-4">
				<div class="modal-content">
					<div class="modal-body">
						<div class="panel panel-widget forms-panel">
							<div class="forms">
								<div class=" form-grids form-grids-right">
									<div class="widget-shadow " data-example-id="basic-forms">
										<div class="form-title">
											<h4>Edit Column Details :</h4>
										</div>
										<div class="form-body">
											<form class="form-horizontal">


												<div class="form-group">
													<label for="column_name" class="col-sm-4 control-label">Column Name<font
															style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<input type="text" id="column_name_update" name="column_name"
															class="form-control" placeholder="Column Name" value=""
															required="true" readonly>
														<div id="uname_response"></div>

													</div>
												</div>


												<div class="form-group">
													<label for="column description" class="col-sm-4 control-label">Column
														Description <font style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<input type="text" id="column_description_update"
															name="column_description" class="form-control"
															placeholder="Column Description" value="" required="true">

													</div>
												</div>


												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label">Column For :
														<span style='color:red'>*</span></label>
													<div class="col-sm-4">
														<label class="checkbox">
															<input type="checkbox" name="is_kyas" class="kyas" value="kyas"
																onclick="return false">
															<i class="icon-checkbox"></i>
															Application Status
														</label>
													</div>
													<div class="col-sm-4"><label class="checkbox">
															<label class="checkbox">
																<input type="checkbox" name="is_tier" class="tier"
																	value="tier" onclick="return false">
																<i class="icon-checkbox"></i>
																Written Exam
															</label>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-4">
														<label class="checkbox">
															<input type="checkbox" name="is_skill" class="skill"
																value="skill" onclick="return false">
															<i class="icon-checkbox"></i>
															Skill Test
														</label>
													</div>
													<div class="col-sm-4"><label class="checkbox">
															<label class="checkbox">
																<input type="checkbox" name="is_pet" class="pet" value="pet"
																	onclick="return false">
																<i class="icon-checkbox"></i>
																PET Exam
															</label>
													</div>
												</div>

												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-8">
														<label class="checkbox">
															<input type="checkbox" name="is_dme" class="dme" value="dme"
																onclick="return false">
															<i class="icon-checkbox"></i>
															Detailed Medical Examination
														</label>
													</div>
												</div>

												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-4 col-form-label"> </label>
													<div class="col-sm-8">
														<label class="checkbox">
															<input type="checkbox" name="is_dv" class="dv" value="dv"
																onclick="return false">
															<i class="icon-checkbox"></i>
															Document Verification
														</label>
													</div>
												</div>


												<input type="hidden" id="txt_userid" value="0">

												<div class="col-sm-offset">
													<button type="button" class="btn btn-default w3ls-button"
														id="btn_update_save">Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="panel panel-widget forms-panel">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-9 form-group">
								<h4>List of Columns </h4>
							</div>
							<div class="col-md-2 form-group">
								<button class="btn w3ls-button hvr-icon-float-away col-24" data-toggle="modal"
									data-target="#addStudent"> Add Column</button>
							</div>
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
	$(document).ready(function () {
		validateHtml("column_name");
		validateHtml("column_description");



		// load exam	
		$.ajax({
			url: "Load_column_details.php",
			method: "GET",
			success: function (data) {
				$('#examdata').html(data);
			}
		});

		//Add new Exam details
		$("#addcolumn").on('click', function () {

			var column_name = $('#column_name').val();
			var column_description = $('#column_description').val();
			var myCheckboxes = new Array();
			$("input:checked").each(function () {
				myCheckboxes.push($(this).val());
			});

			if (column_name != '' && column_description != '' && myCheckboxes != '') {
				$.ajax({
					url: "add_new_column.php",
					method: "POST",
					data: {
						column_name: column_name,
						column_description: column_description,
						myCheckboxes: myCheckboxes,
					},
					dataType: "json",
				}).done(function (data) {
					swal.fire({
						showCloseButton: true,
						title: data.response.title,
						text: data.response.message,
						icon: data.response.status,
					}).then(function () {
						location.reload();
					});


				});
			} else {

				swal.fire("Oops", "Please fill the required ( *) fields !", "error")
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