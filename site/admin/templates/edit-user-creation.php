<?php echo $this->get_header(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Creation Form</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content   section div start -->
    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- left column -->

                <div class="col-md-12">

                    <!-- general form elements -->
                    <!-- /.card -->

                    <!-- Horizontal Form -->

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">User Creation Form</h3>

                        </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                        <?php if (isset($errorMsg) && !empty($errorMsg)) {
                            echo '<div class="alert alert-danger errormsg">';
                            echo $errorMsg;
                            echo '</div>';
                            //unset($errorMsg);
                        }
                        ?>

                        <form class="form-horizontal" method="post" id="nomination_form" enctype="multipart/form-data">

                            <div class="card-body">
								

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                         <input class="form-control" type="text" name="username" id="txt_username" placeholder="Enter the User Name" value="<?php echo $current_userlist['username']; ?>" autocomplete="off" required>
										   <div id="uname_response" ></div>
                                    </div>
                                </div>
								<div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                         <input class="form-control" type="email" name="email" id="txt_email" placeholder="Enter the User Email" autocomplete="off" value="<?php echo $current_userlist['email']; ?>" required>
										  <div id="email_response" ></div>
                                    </div>
                                </div>
								<div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                         <input class="form-control" type="text" name="phone_number" pattern="[1-9]{1}[0-9]{9}"  maxlength="10"
       title="Phone number with 7-9 and remaing 9 digit with 0-9" id="phone_number" placeholder="Enter  Phone Number" autocomplete="off" value="<?php echo $current_userlist['phone_number']; ?>" required>
                                    <div id="phone_response" ></div>
									</div>
                                </div>
								<div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                         <input class="form-control" type="password" placeholder="Enter Password" title="Password must contain: Minimum 4 characters atleast 1 Alphabet and 1 Number" name="password" id="txtPassword" value="<?php echo $current_userlist['password']; ?>" required  pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$">
                                    </div>
                                </div>
								<div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                         <input class="form-control" type="password" name="cpassword" placeholder="Enter Confirm Password" id="txtConfirmPassword" value="" required>
                                    </div>
                                </div>
								
								 <div class="form-group row">

								  <label for="inputEmail3" class="col-sm-2 col-form-label"> Role: <span style='color:red'>*</span></label>

								  <div class="col-sm-10">
									<select name="user_role_id" class="form-control" required>
									  <option value="">Select Role </option>
									  <?php
									  foreach ($roles as $key => $role) :
										  $selected = "";
										  
											if ($current_userlist['user_role_id']  == $role->role_id) {
											  $selected = "selected=\"selected\"";
											}
									  ?>
										<option <?php echo $selected; ?> value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
									  <?php endforeach; ?>
									</select>

								  </div>

								</div>
                                

                                <input type="hidden" value="<?php echo $current_userlist['user_id']; ?>" name="id" class="sp_id">

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <input type="submit" class="btn btn-info" name="save_user" value="submit" id="save_user">
                                <input type="button" class="btn btn-default float-right" onclick="history.back();" value="Cancel">



                            </div>

                            <!-- /.card-footer -->

                        </form>
                        <!-- <button class="btn btn-default float-right" onclick="goBack()">Cancel</button> -->




                    </div>

                    <!-- /.card -->



                </div>

                <!--/.col (left) -->

                <!-- right column -->



                <!-- /.row -->

            </div><!-- /.container-fluid -->

    </section>

    <!-- Main content section div end -->
</div>
<?php echo $this->get_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
$.datepicker.setDefaults({
showOn: "button",
buttonImage: "<?php echo $this->theme_url; ?>/dist/img/datepicker.png",
buttonText: "Date Picker",
buttonImageOnly: true,
dateFormat: 'dd-mm-yy'  
});
$(function() {
$("#effect_from_date").datepicker();
$("#effect_to_date").datepicker();
});
    $(document).ready(function() {
        var myfile = "";

        // $('#save-namination').click(function(e) {
        //     e.preventDefault();
        //     //$('.pdfclassupload').trigger('click');
        //     var exam_name = $('.exam_name').val();
        //     if (exam_name == "") {
        //         swal('Please Enter Exam Name');
        //         return false;
        //     }
        //     if (exam_name.length <= 256) {} else {
        //         swal('Please Enter Below 256 Characters');
        //         return false;
        //     }
        //     // return true;

        //     $("#nomination_form").submit();



        // });





        $(document).on('click', '.add', function() {
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="pdf_name[]" class="form-control item_name" /></td>';
            html += '<td><input type="file" name="pdf_file[]" class="form-control item_quantity pdfclassupload" accept="application/pdf" /></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table').append(html);
        });
        $(document).on('click', '.remove', function() {
            //debugger;
            var pdfname = $(this).closest('tr').find('#pdfname').val();
            var pdf_id = $(this).closest('tr').find('#pdf_id').val();
            if (pdfname != "") {

                var sp_id = $('.sp_id').val();
                var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforselectionpostsforremovingfileupload"); ?>';


                jQuery.ajax({
                    url: baseurl,
                    data: {
                        sp_id: sp_id,
                        pdf_id: pdf_id

                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response.message == 1) {
                            debugger;
                            //alert("Welcome")
                            window.location.href = redirecturl;

                        }
                    }
                });
            }
            // alert(pdfname);
            $(this).closest('tr').remove();
        });

        $('.pdfclassupload').on('change', function() {
            debugger;
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "pdf") {
                alert(ext);
            } else {
                alert(ext);
            }
        });





    });
</script>
<script type="text/javascript">
    window.onload = function () {
        var txtPassword = document.getElementById("txtPassword");
        var txtConfirmPassword = document.getElementById("txtConfirmPassword");
        txtPassword.onchange = ConfirmPassword;
        txtConfirmPassword.onkeyup = ConfirmPassword;
        function ConfirmPassword() {
            txtConfirmPassword.setCustomValidity("");
            if (txtPassword.value != txtConfirmPassword.value) {
                txtConfirmPassword.setCustomValidity("Passwords do not match.");
            }
        }
    }
</script>