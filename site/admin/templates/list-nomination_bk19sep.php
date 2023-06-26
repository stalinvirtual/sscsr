<div class="container-fluid">
    <!-- Container Start-->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal" method="post" id="nomination_arc_form" enctype="multipart/form-data">

                <div class="card-body">
                    <div class="form-group row">
                        <!-- Form Group Row Start-->

                        <label for="inputEmail3" class="col-sm-2 col-form-label">Year : </label>

                        <div class="col-sm-3">

                            <select name="nomination_year" class="form-control" id="nomination_year">
                                <?php for ($i = 0; $i <= 5; $i++) {
                                    $year = date('Y', strtotime("last day of +$i year"));
                                    echo "<option name='$year'>$year</option>";
                                } ?>
                            </select>

                        </div>

                        <label for="inputEmail3" class="col-sm-2 col-form-label">Month : </label>

                        <div class="col-sm-3">

                            <select name="nomination_month" class="form-control" id="nomination_month">
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
                            <input class="form-control " type="hidden" name="modelid" id="modelid" value="Tender">

                        </div>
                    </div><!-- Form Group Row End-->

                    <div class="form-group row " id="nomination_from_and_to_date_container" style="display: none;">
                        <!-- Form Group Row Start-->

                        <label for="inputEmail3" class="col-sm-2 col-form-label">From Date : </label>

                        <div class="col-sm-3">

                            <input class="form-control" type="text" name="effect_from_date" id="effect_from_date" value="" readonly>

                        </div>

                        <label for="inputEmail3" class="col-sm-2 col-form-label">To Date :</label>

                        <div class="col-sm-3">

                            <input class="form-control" type="text" name="effect_to_date" id="effect_to_date" value="" readonly>



                            <input class="form-control" type="text" name="elink" id="elink" value="<?php echo $edit_tender_link; ?>">
                            <input class="form-control" type="text" name="dlink" id="dlink" value="<?php echo $delete_tender_link; ?>">



                            <!-- <input class="form-control elink" type="hidden" name="elink" id="elink" value=" http://localhost/rd/sscsr_latest_copy/site/Admin/edittender/{id}">
                            <input class="form-control dlink" type="hidden" name="dlink" id="dlink" value=" http://localhost/rd/sscsr_latest_copy/site/admin/deletetender/{id}">
                            <input class="form-control alink" type="hidden" name="alink" id="alink" value=" http://localhost/rd/sscsr_latest_copy/site/admin/archiveBtnFunction/{id}"> -->

                        </div>




                    </div><!-- Form Group Row End-->

                    <div class="form-group row">
                        <!-- Form Group Row Start-->

                        <label for="inputEmail3" class="col-sm-2 col-form-label"></label>

                        <div class="col-sm-10">



                            <button type="button" id="nomination_form_submit_btn" class="btn btn-success form_submit_btn">Submit</button>
                            <button type="button" id="nomination_form_reset_btn" class="btn btn-secondary form_reset_btn">Reset</button>





                        </div>
                    </div><!-- Form Group Row End-->



                </div>

                <!-- /.card-body -->



                <!-- /.card-footer -->

            </form>
        </div>
    </div>
</div><!-- Container-fluid-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <?php

                if ($is_publisher == 1) {
                } else { ?>

                    <form id="frm-example" action="<?php echo $common_nomination_archive; ?>" method="POST">

                        <div class="card-header">
                            <h3 class="card-title"><a href="<?php echo $create_nomination_link; ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add Nomination </a></h3>

                            <h3 class="card-title" style="margin-right: 10px;"><button class="btn btn-primary action-btn" data-action="delete" type="button">Delete</button>
                            </h3>

                            <h3 class="card-title" style="margin-right: 10px;"><button class="btn btn-primary action-btn" data-action="archive" type="button">Archives</button>
                            </h3>

                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="ids" id="ids" />

                        </div>

                    <?php } ?>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="nominationTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 2%"><input name="select_all" value="1" type="checkbox"></th>
                                    <th>Exam Name</th>
                                    <th style="width: 2%">Category Name</th>
                                    <th style="width: 3%"> Pdf File</th>
                                    <th style="width: 10%">From Date</th>
                                    <th style="width: 10%">To Date</th>
                                    <th style="width: 2%">Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>


                        </table>
                    </div>
                    <!-- /.card-body -->
                    </form>
            </div>


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
<script src="<?php echo $this->theme_url; ?>/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
    $(document).ready(function() {

        $("#nomination_from_and_to_date_container").hide();
        let baseurl = '<?php echo $this->route->site_url("Admin/ajaxResponseForDataTableLoad"); ?>';







        // var userDataTable = $('#nominationTable').DataTable({
        //     'processing': true,
        //     'serverSide': true,
        //     'serverMethod': 'post',
        //     'ajax': {
        //         'url': baseurl
        //     },
        //     'columns': [{
        //             data: 'nomination_id'
        //         },
        //         {
        //             data: 'exam_name'
        //         },
        //         {
        //             data: 'category_name'
        //         },
        //         {
        //             data: 'pdf_name'
        //         },

        //         {
        //             data: 'effect_from_date'
        //         },
        //         {
        //             data: 'effect_to_date'
        //         },
        //         {
        //             data: 'p_status'
        //         },
        //         {
        //             data: 'action'
        //         },

        //     ],
        //     'columnDefs': [{
        //         'targets': 0,
        //         'checkboxes': {
        //             'selectRow': true
        //         }
        //     }],
        //     'select': {
        //         'style': 'multi'
        //     },
        // });


        
        $("#nomination_arc_form").on('click', function(event) {
            //debugger;
            event.preventDefault();
            $('#nominationTable').dataTable().fnDestroy();

          //var y =   $("#nomination_year option:selected").text();

            var formData = {
                year: $("#nomination_year option:selected").text(),
                month: $("#nomination_month option:selected").val(),
                effect_from_date: $("#effect_from_date").val(),
                effect_to_date: $("#effect_to_date").val(),
            };


            var userDataTable = $('#nominationTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': baseurl,
                data: formData,
            },
            'columns': [{
                    data: 'nomination_id'
                },
                {
                    data: 'exam_name'
                },
                {
                    data: 'category_name'
                },
                {
                    data: 'pdf_name'
                },

                {
                    data: 'effect_from_date'
                },
                {
                    data: 'effect_to_date'
                },
                {
                    data: 'p_status'
                },
                {
                    data: 'action'
                },

            ],
            'columnDefs': [{
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }],
            'select': {
                'style': 'multi'
            },
        });

        });

        jQuery("#nomination_arc_form").trigger('click');

        

        // Check Box

        $('#nominationTable').on('change', 'input[type="checkbox"]', function() {
            let selectedCheckboxCount = $("#nominationTable input[type=\"checkbox\"]:checked").length;
            if (selectedCheckboxCount > 0) {
                console.log($(".deletebtn"))
                $(".deletebtn").attr('disabled', "disabled");
                $(".archivebtn").attr('disabled', "disabled");
            } else {
                $(".deletebtn").removeAttr('disabled');
                $(".archivebtn").removeAttr('disabled');
            }
        });


        // Handle form submission event
        $(".action-btn").on('click', function(e) {
            e.preventDefault;
            //debugger;
            $("#action").val($(this).data('action'));

            let action_value = $("#action").val();

            // make the form submit
            var rows_selected = $('#nominationTable').DataTable().column(0).checkboxes.selected();
            let form = "#frm-example";
            let rowIds = "";



            if (rows_selected.length == 0) {

                swal("Please select atleast one checkbox");
                return false;

            } else {

                let title = action_value[0].toUpperCase() +action_value.slice(1);

                swal("Are You Want to " +   title, {
                    buttons: {
                        yes: {
                            text: "ok",
                            value: "yes"
                        },
                        No: {
                            text: "cancel",
                            value: "No",
                            buttonColor: "#000000",
                        }
                    }
                }).then((value) => {
                    if (value === "yes") { //yes start


                        $.each(rows_selected, function(index, rowId) {
                            // Create a hidden element
                            rowIds += `${rowId},`;
                            // $(form).append(
                            //     $('<input>')
                            //         .attr('type', 'hidden1')
                            //         .attr('name', 'id[]')
                            //         .val(rowId)
                            // );

                            // $('#frm-example').trigger('submit');

                        });
                        rowIds = rowIds.substring(0, rowIds.length - 1);

                        $(form).find("#ids").val(rowIds);
                        $(form).submit();




                    } // yes End
                    return false;
                });

            }










        });

        // Delete record
        $('#nominationTable').on('click', '.deletebtn', function(e) {
            e.preventDefault()
            var id = $(this).data('id');
            swal("Are You Want to Delete ?", {
                buttons: {
                    yes: {
                        text: "Ok",
                        value: "yes"
                    },
                    No: {
                        text: "Cancel",
                        value: "No",
                        buttonColor: "#000000",
                    }
                }
            }).then((value) => {
                if (value === "yes") { //yes start

                    // AJAX request
                    $.ajax({
                        url: baseurl,
                        type: 'post',
                        data: {
                            request: 4,
                            id: id
                        },
                        success: function(response) {
                            if (response == 1) {
                                swal("Record deleted.");

                                // Reload DataTable
                                $('#nominationTable').DataTable().ajax.reload();
                                $('.alert-success').html('');
                            } else {
                                swal("Invalid ID.");
                            }

                        }
                    });





                } // yes End
                return false;
            });


        });
        // Archive record
        $('#nominationTable').on('click', '.archivebtn', function(e) {
            e.preventDefault()
            var id = $(this).data('id');
            swal("Are You Want to Archive ?", {
                buttons: {
                    yes: {
                        text: "Ok",
                        value: "yes"
                    },
                    No: {
                        text: "Cancel",
                        value: "No",
                        buttonColor: "#000000",
                    }
                }
            }).then((value) => {
                if (value === "yes") { //yes start

                    // AJAX request
                    $.ajax({
                        url: baseurl,
                        type: 'post',
                        data: {
                            request: 5,
                            id: id
                        },
                        success: function(response) {
                            if (response == 1) {
                                swal("Record Archived.");

                                // Reload DataTable
                                $('#nominationTable').DataTable().ajax.reload();
                            } else {
                                swal("Invalid ID.");
                            }

                        }
                    });





                } // yes End
                return false;
            });


        });

        // Publish record
        $('#nominationTable').on('click', '.publishbtn', function(e) {
            e.preventDefault()
            var id = $(this).data('id');
            swal("Are You Want to Publish ?", {
                buttons: {
                    yes: {
                        text: "Ok",
                        value: "yes"
                    },
                    No: {
                        text: "Cancel",
                        value: "No",
                        buttonColor: "#000000",
                    }
                }
            }).then((value) => {
                if (value === "yes") { //yes start

                    // AJAX request
                    $.ajax({
                        url: baseurl,
                        type: 'post',
                        data: {
                            request: 6,
                            id: id
                        },
                        success: function(response) {

                            if (response == 1) {
                                swal("Record Published .");
                              

                                // Reload DataTable
                                $('#nominationTable').DataTable().ajax.reload();
                                $('.alert-success').hide();
                            } else {
                                swal("Invalid ID.");
                            }

                        }
                    });





                } // yes End
                return false;
            });


        });

        //DatePicker

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
            });
        });

        //year Onchange

        $("#nomination_year").on('change', function(e) {


            let year = $(this).val();
            let monthoutput = $("#nomination_month").val();

            // let monthvalue = month == 'All' ?'01':month;
            //month == 'All' ?'01':month;

            if (monthoutput == 'All') {

                monthvalue = '01';
                $("#nomination_from_and_to_date_container").hide();

            } else {
                $("#nomination_from_and_to_date_container").show();

                monthvalue = monthoutput;

                $("#effect_from_date").datepicker("setDate", `01-${monthvalue}-${year}`);
                $("#effect_to_date").datepicker("setDate", `01-${monthvalue}-${year}`);


                console.log(`01-${monthvalue}-${year}`)

            }
        });

        //Nomination Month onchange

        $("#nomination_month").on('change', function(e) {
           // debugger;
            let month = $(this).val();
            let year = $("#nomination_year").val();
            if (month == 'All') {
                monthvalue = '01';
                $("#nomination_from_and_to_date_container").hide();

            } else {
               // debugger;
                $("#nomination_from_and_to_date_container").show();
                monthvalue = month;
                $("#effect_from_date").datepicker("setDate", `01-${monthvalue}-${year}`);
                $("#effect_to_date").datepicker("setDate", `01-${monthvalue}-${year}`);

                console.log(`01-${monthvalue}-${year}`)
            }

        });
   

    });
</script>
<style>
    .dt-checkboxes-select-all [type="checkbox"]{
        position: relative;
        left: 10px;
    }
</style>