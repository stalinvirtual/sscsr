<?php
function getTemplate(
  $form_id,
   $year,
   $month,
   $from_date,
   $to_date,
   $edit_link,
   $delete_link,
   $edit_link_value,
   $delete_link_value,
   $archive_link,
   $archive_link_value,
   $submit_button,
   $reset_button,
   $datatable_form_id,

$datatable_action,

$is_publisher,

$create_link,

$title_name,
$tableHeadingArray,$datatableId

){

   $model = explode(" ", $title_name); 
    $output ="";
    $output .= <<<TEXT
    <div class="alert" style="display:none" id="notification"></div>
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <form class="form-horizontal" method="post" id="$form_id" enctype="multipart/form-data">

            <div class="card-body">
                <div class="form-group row">
                    <!-- Form Group Row Start-->

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Year : </label>

                    <div class="col-sm-3">

                        <select name="$year" class="form-control $year" id="$year">
TEXT;  
for ($i = 0; $i <= 5; $i++) {
    $yearvalue = date('Y', strtotime("last day of +$i year"));
    $output .=<<<HTML
   
    <option name='$yearvalue'>$yearvalue</option>
 HTML;
 }
 
 $output .= <<<TEXT
 </select>

                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Month : </label>

                    <div class="col-sm-3">

                        <select name="$month" class="form-control $month" id="$month">
                       
                            <option value="All">All</option>
TEXT; 
            for ($i = 1; $i <= 12; $i++) {
                $monthvalue = date('F', strtotime("$i/12/10"));
                if (strlen($i) == 1) {
                    $value = "0" . $i;
                    } else {
                
                    $value = $i;
                    }
                $output .=<<<HTML
            
                <option value=$value>$monthvalue</option>
HTML;
            }
 
 $output .= <<<TEXT
  </select> 
  <input class="form-control " type="hidden" name="modelid" id="modelid" value="$model[1]" >

                    </div>
                </div><!-- Form Group Row End-->

                <div class="form-group row " id="from_and_to_date_container" >
                    <!-- Form Group Row Start-->

                    <label for="inputEmail3" class="col-sm-2 col-form-label">From Date : </label>

                    <div class="col-sm-3">

                        <input class="form-control $from_date" type="text" name="$from_date" id="$from_date" value="" readonly>

                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">To Date :</label>

                    <div class="col-sm-3">

                        <input class="form-control $to_date" type="text" name="$to_date" id="$to_date" value="" readonly>
                        <input class="form-control $edit_link" type="hidden" name="$edit_link" id="$edit_link" value=" $edit_link_value">
                        <input class="form-control $delete_link" type="hidden" name="$delete_link" id="$delete_link" value=" $delete_link_value">
                        <input class="form-control $archive_link" type="hidden" name="$archive_link" id="$archive_link" value=" $archive_link_value">

                    </div>

                


                </div><!-- Form Group Row End-->

                <div class="form-group row">
                    <!-- Form Group Row Start-->

                    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-10">
                    
   

                        <button type="button" id="$submit_button" class="btn btn-success $submit_button">Submit</button>
                        <button type="button" id="$reset_button" class="btn btn-secondary $reset_button">Reset</button>





                    </div>
                </div><!-- Form Group Row End-->



            </div>

            <!-- /.card-body -->



            <!-- /.card-footer -->

        </form>
    </div>
</div>
</div>











<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" id="$datatable_form_id" >

                    <?php

                    if ($is_publisher == 1) {
                    } else { ?>

                        <div class="card-header">
                            <h3 class="card-title"><a href="$create_link" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span>$title_name </a></h3>
                           
                            <h3 class="card-title" style="margin-right: 10px;">
                                <button class="btn btn-info pull-right" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus-sign"></span> Archives </button>

                            </h3>


                        </div>

                    <?php }

                    ?>

                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="$datatableId" class="table table-bordered table-hover $datatableId" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:2%"><input name="select_all" value="1" type="checkbox"></th>
TEXT;   


// print_r($tableHeadingArray);
// exit;

foreach ($tableHeadingArray as $col) {

    if($col == "From Date" || $col == "To Date" ){
        $output .=<<<HTML

        <th style="width: 10%"> $col</th>
HTML;

    }
    else if($col == "Status"){
        $output .=<<<HTML
        <th style="width: 2%"> $col</th>
HTML;  

    }
    else if($col == "Category Name"){
        $output .=<<<HTML
        <th style="width: 2%"> $col</th>
HTML;  

    }
    else if($col == "Pdf File"){
        $output .=<<<HTML
        <th style="width: 3%"> $col</th>
HTML;  

    }
    else{
        $output .=<<<HTML
        <th> $col</th>
HTML;   
    }

   

}

                                    // <th>Tender Name </th>
                                    // <th>Pdf File</th>
                                    // <th style="width: 10%">From Date</th>
                                    // <th style="width:10%">To Date </th>
                                    // <th style="width: 2%">Status</th>
                                    // <th> Action </th>



                                $output .= <<<TEXT
                                 </tr>
                            </thead>

                        </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>










TEXT;
return $output;


}
