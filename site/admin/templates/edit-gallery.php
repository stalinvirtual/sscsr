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
                    <h1> Photo Creation Form</h1>
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

                            <h3 class="card-title"> Photo Creation Form </h3>

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

                        <form class="form-horizontal" method="post" name="editgallery_form" id="editgallery_form" enctype="multipart/form-data">

                            <div class="card-body">








                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Event Year : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <select name="year" class="form-control">

                                            <?php

                                            for ($i = 2023; $i <= 2025; $i++) {
                                                $selected = "";

                                                if ($current_gallery['year'] == $i) {
                                                    $selected = "selected=\"selected\"";
                                                }
                                            ?>


                                                <option <?php echo $selected; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php }
                                            ?>

                                        </select>

                                    </div>
                                </div>


                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Event Name : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <select name="event_id" class="form-control">
                                            <?php foreach ($eventcategoriesdropdown as $key => $eventcategoriy) :
                                                $selected = "";
                                                if ($current_gallery['event_id'] == $eventcategoriy->event_id) {
                                                    $selected = "selected=\"selected\"";
                                                }
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $eventcategoriy->event_id; ?>"><?php echo $eventcategoriy->event_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>


                                <!-- <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect From Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">

                                        <?php

                                        // if (@$current_gallery['effect_from_date'] == "") {
                                        //     $effect_from_date = "";
                                        // } else {
                                        //     $effect_from_date = date('d-m-Y', strtotime($current_gallery['effect_from_date']));
                                        // }
                                        ?>
                                        <input class="form-control" type="text" name="effect_from_date" id="effect_from_date" value="<?php //echo $effect_from_date; ?>" readonly>

                                    </div>

                                </div> -->
                                <!-- <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect To Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">


                                        <?php

                                        // if (@$current_gallery['effect_to_date'] == "") {
                                        //     $effect_to_date = "";
                                        // } else {
                                        //     $effect_to_date = date('d-m-Y', strtotime($current_gallery['effect_to_date']));
                                        // }
                                        ?>
                                        <input class="form-control" type="text" name="effect_to_date" id="effect_to_date" value="<?php //echo $effect_to_date; ?>" readonly>


                                    </div>

                                </div> -->






                                <!-- <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect From Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
									<?php

                                    //if (@$current_eventcategory['creation_date'] == "") {
                                    // $creation_date = "";
                                    // } else {
                                    // $creation_date = date('d-m-Y', strtotime($current_eventcategory['creation_date']));
                                    // }


                                    ?>

                                        <input class="form-control" type="text" name="creation_date" id="creation_date" value="<?php //echo $creation_date; 
                                                                                                                                ?>" readonly>
									

                                    </div>

                                </div> -->


                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Image : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <table class="table table-bordered" id="item_table">
                                            <tr>

                                                <th>Upload Images </th>


                                                <th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                            </tr>

                                            <?php
                                            if ($gallery_id == 0) {
                                            } else {


                                                foreach ($gallery_child_list as $key => $childlist) :
                                                    $selected = "";
                                                    if ($current_gallery['gallery_id'] == $childlist->gallery_id) {
                                                        $selected = "selected=\"selected\"";
                                                        $uploadPath = 'gallery' . '/' . $childlist->image_path;
                                                        $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>
                                                        <tr>

                                                            <td>
                                                                <input type="hidden" id="image_id" name="image_id[]" class="form-control item_name" value="<?php echo $childlist->image_id; ?>" />



                                                            </td>
                                                            <td><input type="file" name="image_file[]" class="form-control item_quantity pdfnomination image_file" accept="image/gif, image/jpeg, image/png" value="<?php echo $childlist->image_path; ?>" />

                                                                <input type="text" name="image_files[]" class="form-control item_quantity" value="<?php echo $childlist->image_path; ?>" />

                                                                <!-- <p><?php //echo $childlist->attachment; 
                                                                        ?></p> -->
                                                            </td>
                                                            <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-minus" aria-hidden="true"></i></button></td>



                                                            <br>
                                                        </tr>
                                                    <?php }


                                                    ?>

                                                <?php endforeach; ?>

                                            <?php
                                                // echo '<tr>';
                                            }

                                            ?>

                                        </table>


                                    </div>

                                </div>






                                <input type="hidden" value="<?php echo $current_gallery['gallery_id']; ?>" name="gallery_id" class="gallery_id">

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <input type="submit" class="btn btn-info" name="save_gallery" value="submit" id="save_gallery">
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
            });

        });





        $.datepicker.setDefaults({
            showOn: "button",
            buttonImage: "<?php echo $this->theme_url; ?>/dist/img/datepicker.png",
            buttonText: "Date Picker",
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy'
        });
        $(function() {


            $("#effect_to_date").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '2020:+0'
            });

        });


    });
    $(document).ready(function() {

     

        // $('#imageclassupload').on('change', function() {
           
        // });


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
            // html += '<td><input type="text" name="pdf_name[]" class="form-control item_name" /></td>';
            html += '<td><input type="file" name="image_file[]" class="form-control item_quantity imageclassupload" accept="image/gif, image/jpeg, image/png" /></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table').append(html);


            $('input[type="file"]').change(function(e) {

            
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "jpg" ||ext == "jpeg" || ext == "png" || ext == "ico"  ||ext == "bmp" ) {

                return true;
            } else {
                swal("Accept Only Img Files", "", "warning");
                $('input[type="file"]').val('');
                return;
            }
           
        });





        });
        $(document).on('click', '.remove', function() {
            //debugger;
            var image_id = $(this).closest('tr').find('#image_id').val();
            if (image_id != "") {

                var gallery_id = $('.gallery_id').val();
                var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforselectionpostsforremovingfileupload"); ?>';


                jQuery.ajax({
                    url: baseurl,
                    data: {
                        gallery_id: gallery_id,
                        image_id: image_id

                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response.message == 1) {
                            //alert("Welcome")
                            window.location.href = redirecturl;

                        }
                    }
                });
            }
            // alert(pdfname);
            $(this).closest('tr').remove();
        });

        $('.imageclassupload').on('change', function() {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "png" || ext == "jpg" || ext == "jpeg") {
                alert(ext);
            } else {
                alert(ext);
            }
        });





    });
</script>