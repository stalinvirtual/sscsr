<?php 
namespace App\Controllers; 
use App\Helpers\Helpers;

Helpers::urlSecurityAudit();
 echo $this->get_header(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam Creation Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Advanced Form</li>
                    </ol>
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

                <div class="col-md-8">

                    <!-- general form elements -->



                    <!-- /.card -->

                    <!-- Horizontal Form -->

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title"> Exam creation Form</h3>

                        </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                        <!-- <form class="form-horizontal" method="post" enctype="multipart/form-data">

                  <div class="card-body">

                    <div class="form-group row">

                      <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Name:<span style='color:red'>*</span></label>

                      <div class="col-sm-10">

                        <input class="form-control" type="text" name="menu_name" required>

                      </div>

                    </div>

                    <div class="form-group row">

                      <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Link : <span style='color:red'>*</span></label>

                      <div class="col-sm-10">

                        <input class="form-control" type="text" name="menu_link" required>

                      </div>

                    </div>

                    <input type="hidden" value="<?= $user->id ?>" name="id">

                  </div>

                  <!-- /.card-body 

                <div class="card-footer">

                  <input type="submit" class="btn btn-info" name="add_main_menu" value="submit">
                </div>

                <!-- /.card-footer 

                </form> -->



                        <form class="form-horizontal" method="post" enctype="multipart/form-data">

                            <div class="card-body">
                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Exam Name : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="exam_name" required value="<?php echo $current_exam['exam_name']; ?>">



                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Exam Code:<span style='color:red'>*</span></label>

                                    <div class="col-sm-10">

                                        <input class="form-control" type="text" name="exam_code" required value="<?php echo $current_exam['exam_code']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Exam Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">

                                        <input class="form-control" type="date" name="exam_date" required value="<?php echo $current_exam['exam_date']; ?>">

                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Exam Time : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">



                                        <input class="form-control" id='timepicker' type="text" name="exam_time" id='time' required value="<?php echo $current_exam['exam_time']; ?>">

                                    </div>


                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            $('#timepicker').mdtimepicker(); //Initializes the time picker
                                        });
                                    </script>

                                </div>




                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                                <script>
                                    jQuery(document).ready(function() {
                                        jQuery("input[name='menu_type']").on('change', function() {
                                            if (jQuery(this).val() == 1) {
                                                jQuery(".article-container").show();
                                            } else {
                                                jQuery(".article-container").hide();
                                            }
                                        });
                                        jQuery("input[name='menu_type']").trigger('change');

                                    });
                                </script>
                                <input type="hidden" value="<?php echo $current_exam['id']; ?>" name="id">

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <input type="submit" class="btn btn-info" name="save-exam" value="submit">
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