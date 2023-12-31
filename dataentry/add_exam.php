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
											<h4>Add New Exam Details :</h4>
										</div>
										<div class="form-body">
											<form class="form-horizontal">
											<input type="hidden" id="exam_id" name="exam_id"
																 value="exam_id">
												<div class="form-group">
													<label for="examname" class="col-sm-4 control-label">Exam Name<font
															style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<textarea name="exam_name" class="form-control" id="exam_name"
															placeholder="Enter Exam Name" rows="4" cols="50"></textarea>
													</div>
												</div>
												<div class="exam_name_validation"></div>
												<div class="form-group">
													<label for="exam_short_name" class="col-sm-4 control-label">Exam Short
														Name <font style="color:red" ;>*</font> </label>
													<div class="col-sm-6">
														<div class='input-group'>
															<input type="text" id="exam_short_name" name="exam_short_name"
																class="form-control" placeholder="Like (chsl,cgl)" value="">
														</div>
													</div>
												</div>
												<div class="exam_short_name_validation"></div>
												<!-- <div class="form-group">	
												<label for="examyear" class="col-sm-4 control-label">Exam Year <font style="color:red";>*</font> </label> 
												<div class="col-sm-6">
												 <div class='input-group date' >  
													<input type="month" id="exam_year"  name="exam_year" class="form-control"  placeholder="Enter Exam Year" value="">
												</div> 
												</div> 
											</div>
											<div class="form-group">	
												<label for="examcode" class="col-sm-4 control-label">Exam Code <font style="color:red";>*</font> </label> 
												<div class="col-sm-6">
												 <div class='input-group' >  
													<input type="text" id="exam_code"  name="exam_code" class="form-control"  placeholder="Enter Exam Code" value="">
													<p>(CHSLAPR2021,CGLAUG2021)</p>
												</div> 
												</div> 
											</div>-->
												<div class="col-sm-offset">
													<button type="button" class="btn btn-default w3ls-button"
														id="addNewStudent">Save</button>
												</div>
												<div class="col-sm-offset">
													<button type="button" class="btn btn-default w3ls-button"
														id="updateStudent">Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>
				</div> -->
				</div>
			</div>
		</div>
		<div class="panel panel-widget forms-panel">
			<div class="forms">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<div class="row">
							<div class="col-md-9 form-group">
								<h4>List of Exam </h4>
							</div>
							<div class="col-md-2 form-group">
								<button class="btn w3ls-button hvr-icon-float-away col-24" data-toggle="modal"
									data-target="#addStudent" id="addexam"> Add Exam</button>
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
<script type="text/javascript">
	validateHtml("exam_name");
	validateHtml("exam_short_name");
	$("#updateStudent").hide();
	$(document).ready(function () {
		// load exam	
		$.ajax({
			url: "Load_exam.php",
			method: "GET",
			success: function (data) {
				$('#examdata').html(data);

				$(document).on("click", ".edit", function () {
				
					var id = $(this).attr("id");
					$.ajax({
						url: "exam_edit.php",
						type: "GET",
						cache: false,
						data: {
							exam_name: id
						},
						success: function (res) {

                        var data1 =JSON.parse(res);
						$('#exam_id').val(data1[0].exam_name);
			               $('#exam_name').val(data1[0].exam_name);
							$('#exam_short_name').val(data1[0].exam_short_name);
							$("#updateStudent").show();
							$("#addNewStudent").hide();
						}
					});
				});
			}
		});

		$("#addexam").on('click', function () {
			$('#exam_name').val("");
			$('#exam_short_name').val("");
			$("#updateStudent").hide();
			$("#addNewStudent").show();
		});


		$(document).on("click", "#updateStudent", function() { 
		var exam_id =$('#exam_id').val();
        var exam_name = $('#exam_name').val();
        var exam_short_name = $('#exam_short_name').val();
		$.ajax({
			url: "exam_update_ajax.php",
			type: "POST",
			cache: false,
            data: {
				exam_id:exam_id,
                exam_name: exam_name,
                exam_short_name: exam_short_name
            },
			success: function(dataResult){
				swal.fire({
                title: '<span style="color:green">Success</span>',
                text: 'Exam Updated Successfully',
                type: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK',
                allowOutsideClick: false,

            }).then(function (result) {
                if (result.value) {
                    window.location.reload();
                }
            })
			},
			error: function(msg){
				swal.fire({
                title: '<span style="color:green">Success</span>',
                text: 'Exam Already exist',
                type: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK',
                allowOutsideClick: false,

            }).then(function (result) {
                if (result.value) {
                    window.location.reload();
                }
            })
			}

		});
	}); 

		//Add new Exam details
		$("#addNewStudent").on('click', function () {
			
			var examname = $('#exam_name').val();
			var exam_short_name = $('#exam_short_name').val();
			if (stringLengthCheck(examname, 15, 500, 'Exam Name') == true) {
				var examname = examname;
			}
			else {
				var examname = '';
			}
			if (stringLengthCheck(exam_short_name, 2, 25, 'Exam Code') == true) {
				var exam_short_name = exam_short_name;
			}
			else {
				var exam_short_name = '';
			}
			if (examname != '' && exam_short_name != '') {
				$.ajax({
					url: "add_new_exam.php",
					method: "POST",
					data: { examname: examname, exam_short_name: exam_short_name },
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
			}
			else {
				alert("Please fill the reqired ( *) fields !")
			}
		});
	});
</script>