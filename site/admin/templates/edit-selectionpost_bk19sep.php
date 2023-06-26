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
                    <h1>Selection Post Creation Form</h1>
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

                            <h3 class="card-title">Selection Post creation Form</h3>

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

                        <form class="form-horizontal" method="post" name ="selection_post_form" id="selection_post_form" enctype="multipart/form-data">

                            <div class="card-body">
								<div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phase : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <select name="phase_id" class="form-control">
                                            <?php foreach ($phases as $key => $phase) :
                                                $selected = "";
                                                if ($current_selectionpost['category_id'] == $phase->phase_id) {
                                                    $selected = "selected=\"selected\"";
                                                }
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $phase->phase_id; ?>"><?php echo $phase->phase_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name of the Examination : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control exam_name" name="exam_name" 
                                        id="exam_name" rows="5" placeholder="Enter only 256 characters"><?php echo $current_selectionpost['exam_name']; ?></textarea>
                                    </div>
                                </div>
                                
                               
                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control">
                                            <?php foreach ($categories as $key => $category) :
                                                $selected = "";
                                                if ($current_selectionpost['category_id'] == $category->category_id) {
                                                    $selected = "selected=\"selected\"";
                                                }
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                


                                <!-- <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Attachment : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <?php
                                        /*  $singleFile = $current_nomination['attachment'];
                                        $uploadPath = 'nominations' . '/' . $singleFile;
                                        $file_location = $this->route->get_base_url() . "/" . $uploadPath;
                                        ?>
                                        <input class="form-control" type="file" name="attachment">
                                        <a href="<?= $file_location ?>" target="_blank"><?= $current_nomination['attachment']*/ ?></a>

                                    </div>
                                </div> -->




                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect From Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">

                                        <?php							
                                            if(@$current_selectionpost['effort_from_date']==""){
                                                $effort_from_date = "";
                                            }
                                            else{
                                                $effort_from_date = date('d-m-Y', strtotime($current_selectionpost['effort_from_date']));
                                            }
                                        ?>
                                        <input class="form-control" type="text" name="effort_from_date" id="effort_from_date" value="<?php echo $effort_from_date; ?>" readonly> 


                                    </div>

                                </div>
                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Effect To Date : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">



                                    <?php							
                                            if(@$current_selectionpost['effect_to_date']==""){
                                                $effect_to_date = "";
                                            }
                                            else{
                                                $effect_to_date = date('d-m-Y', strtotime($current_selectionpost['effect_to_date']));
                                            }
                                        ?>
                                        <input class="form-control" type="text" name="effect_to_date" id="effect_to_date" value="<?php echo $effect_to_date; ?>" readonly>



                                    </div>

                                </div>

                                <?php



                                //echo '<pre>';

                                // echo $nomination_id;
                                //print_r($current_nomination); 
                                ?>




                                <div class="form-group row">

                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Attachment : <span style='color:red'>*</span></label>

                                    <div class="col-sm-10">
                                        <table class="table table-bordered" id="item_table">
                                            <tr>
                                                <th>Enter Pdf Name</th>
                                                <th>Enter Pdf </th>


                                                <th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                            </tr>

                                            <?php
                                            if ($selectionpost_id == 0) {
                                            } else {


                                                foreach ($selectionpostchildlist as $key => $childlist) :
                                                    $selected = "";
                                                    if ($current_selectionpost['selection_post_id'] == $childlist->selection_post_id) {
                                                        $selected = "selected=\"selected\"";
                                                        $uploadPath = 'selectionposts' . '/' . $childlist->attachment;
                                                        $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>
                                                        <tr>

                                                            <td><input type="text" name="pdf_name[]" class="form-control item_name " id="pdfname" value="<?php echo $childlist->pdf_name; ?>" />
                                                                <input type="hidden" id="pdf_id" name="nomination_child_id[]" class="form-control item_name" value="<?php echo $childlist->selection_post_child_id; ?>" />



                                                            </td>
                                                            <td><input type="file" name="pdf_file[]" class="form-control item_quantity pdfselectionpost" accept="application/pdf" value="<?php echo $childlist->attachment; ?>" />

                                                                <input type="text" name="pdf_files[]" class="form-control item_quantity" value="<?php echo $childlist->attachment; ?>" />

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

                                <input type="hidden" value="<?php echo $current_selectionpost['selection_post_id']; ?>" name="id" class="sp_id">

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

        <input type="submit" class="btn btn-info" name="selectionpost" value="submit">
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


//Year Range For 2020
	

$("#effort_from_date").datepicker({
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


//Year Range For 2020
	

$("#effect_to_date").datepicker({
    changeMonth: true, 
    changeYear: true, 
    yearRange: '2020:+0'
 });

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


			$('.pdfselectionpost').on( 'change', function() {
			   myfile= $( this ).val();
			   var ext = myfile.split('.').pop();
			   if(ext=="pdf"){
				  return true;
			   } else{
				   swal("Accept Only PDF Files","","warning");
				   $('.pdfselectionpost').val('');
				   return;
			   }
			});  


        $(document).on('click', '.add', function() {
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="pdf_name[]" class="form-control item_name" /></td>';
            html += '<td><input type="file" name="pdf_file[]" class="form-control item_quantity  pdfselectionpost" accept="application/pdf" /></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table').append(html);
			
			$('.pdfselectionpost').on( 'change', function() {
			   myfile= $( this ).val();
			   var ext = myfile.split('.').pop();
			   if(ext=="pdf"){
				  return true;
			   } else{
				   swal("Accept Only PDF Files","","warning");
				   $('.pdfselectionpost').val('');
				   return;
			   }
			});  
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

        





    });
</script>