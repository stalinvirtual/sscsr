<?php

namespace App\Controllers;

use App\Helpers\Helpers;

Helpers::urlSecurityAudit();


echo $this->get_header(); ?>


<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tender  Archives By Month</h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid">

    <div class="row">

        <!-- left column -->

        <div class="col-md-12">

            <!-- general form elements -->
            <!-- /.card -->

            <!-- Horizontal Form -->

            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title">Tender  Archives By Month </h3>

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


                <form class="form-horizontal" method="post" id="tender_arc_form" enctype="multipart/form-data" >

                    <div class="card-body">


                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-2 col-form-label">Year : <span style='color:red'>*</span></label>

                            <div class="col-sm-10">

                                <select name="tender_year" class="form-control" id="tender_year">
                                    <?php for ($i = 0; $i <= 5; $i++) {
                                        $year = date('Y', strtotime("last day of +$i year"));
                                        echo "<option name='$year'>$year</option>";
                                    } ?>
                                </select>

                            </div>
                        </div>


                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-2 col-form-label">Month : <span style='color:red'>*</span></label>

                            <div class="col-sm-10">

                                <select name="tender_month" class="form-control" id="tender_month">
                                    <option value="All">All</option>
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        $month = date('F', strtotime("$i/12/10"));

                                        if (strlen($i) == 1) {
                                            $value = "0" . $i;
                                        } else {

                                            $value = $i;
                                        }

                                        echo "<option value=$value>$month</option> ";
                                    } ?>
                                </select>

                            </div>
                        </div>



                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-2 col-form-label">From Date : <span style='color:red'>*</span></label>

                            <div class="col-sm-10">

                            <input class="form-control" type="text" name="effect_from_date" id="effect_from_date" value="" readonly>

                            </div>
                        </div>


                        <div class="form-group row">

<label for="inputEmail3" class="col-sm-2 col-form-label">To Date : <span style='color:red'>*</span></label>

<div class="col-sm-10">

<input class="form-control" type="text" name="effect_to_date" id="effect_to_date" value="" readonly>
<input class="form-control" type="text" name="elink" id="elink" value="<?php echo $edit_tender_link;?>" >
<input class="form-control" type="text" name="dlink" id="dlink" value="<?php echo $delete_tender_link;?>" >





</div>
</div>


                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">

                        <!-- <input type="submit" class="btn btn-info" name="save_na" value="submit" id="nomination_arc"> -->
                        <!-- <input type="button" class="btn btn-default float-right" onclick="history.back();" value="Cancel"> -->

                        <button type="submit" class="btn btn-success">Submit</button>



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




    <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>

									<th>Tender Name </th>
									<th>Pdf File</th>
									<th>From Date</th>
									<th>To Date </th>
									<th>Status</th>
									<th> Action </th>
								</tr>
							</thead>
      
    </table>







    <?php echo $this->get_footer(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



    <script>
        $(document).ready(function() {

            $("#tender_arc_form").submit(function(event) {

                event.preventDefault();


                $('#example').dataTable().fnDestroy();

               

     var baseurl = '<?php echo $this->route->site_url("Admin/ajaxresponseforTenderarchievesByMonth"); ?>';


                var formData = {
                    tender_year: $("#tender_year option:selected").text(),
                    tender_month: $("#tender_month option:selected").val(),
                    elink: $("#elink").val(),
                    dlink: $("#dlink").val(),
                };


               // dbshow(formData);

                var table = $('#example').DataTable({
                    "ajax": {
                        'type': 'POST',
                        'url': baseurl,
                        data: formData,
                    },
                    'columnDefs': [{
                        'targets': 0,
                       
                    }],
                    'order': [
                        [2, 'desc']
                    ],
                    "lengthMenu": [
                 [5, 10, 25, 50, -1],
                 [5, 10, 25, 50, "All"]
             ],
			 
			  
              
			
			//fixedColumns: true,
             'responsive': true
                });

                table.clear().draw();



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

$("#effect_from_date").datepicker({
changeMonth: true,
changeYear: true,
yearRange: '2020:+0'
}


);
$("#effect_to_date").datepicker({
changeMonth: true,
changeYear: true,
yearRange: '2020:+0'
}
);
});
    </script>