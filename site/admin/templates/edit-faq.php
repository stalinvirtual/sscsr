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
                    <h1>FAQ Creation Form</h1>
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

                            <h3 class="card-title"> Faq Creation Form </h3>

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

                        <form class="form-horizontal" method="post" name = "faq_form" id="faq_form" enctype="multipart/form-data">

                            <div class="card-body">
								

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Faq Questions : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control exam_name" name="faq_title" id="faq_title" rows="5" placeholder="Enter only 500 characters"><?php echo @$current_faq['faq_title']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Faq Answer : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control exam_name" name="faq_content" id="faq_content" rows="5" placeholder="Enter only 500 characters"><?php echo @$current_faq['faq_content']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect From Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
									<?php
									
									if(@$current_faq['effect_from_date']==""){
										$effect_from_date = "";
									}
									else{
										$effect_from_date = date('d-m-Y', strtotime($current_faq['effect_from_date']));
									}
									
									?>

                                        <input class="form-control" type="text" name="effect_from_date" id="effect_from_date" value="<?php echo $effect_from_date; ?>" readonly>
									

                                    </div>

                                </div>

                                <input type="hidden" value="<?php echo $current_faq['faq_id']; ?>" name="id" class="sp_id">

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <input type="submit" class="btn btn-info" name="save_faq" value="submit" id="save_faq">
                                <input type="button" class="btn btn-default float-right" onclick="history.back();" value="Cancel">



                            </div>

                            <!-- /.card-footer -->

                        </form>

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
    $("#effect_from_date").datepicker({
    changeMonth: true, 
    changeYear: true, 
    yearRange: '2020:+0'
 }
);
    });
$(document).ready(function() {
		
       
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

       





    });
</script>