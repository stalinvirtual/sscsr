<?php


require_once("config/db.php");
require_once("functions.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {


    $output = "";


    $query = "select * from public.tierbasedexamcity();";


    $result = getAll($query);
    $resultCount = getRowCount($query);






    /*
    print_r($result);
    exit; */




    $output .= "
    <form id='frm-example' action='' method='POST'>
    <table id='exam_data' class='display table table-striped table-bordered dt-responsive' width='100%'>
                       <thead>
                           <tr class='danger'>
                             <th width='20px'>Sno</th>                      
                             <th>Exam Name</th>
                             <th>Exam Type</th>
                             <th>Exam code</th> 
                             <th>Action</th>                            
                           </tr>
                       </thead>
                       <tfoot>
                           <tr class='success'>      
                            <th width='20px'>Sno</th>                       
                             <th>Exam Name</th>                   
                             <th>Exam Type  </th>
                             <th>Exam code</th>   
                             <th>Action</th>                            
                           
                           </tr>
                       </tfoot>
                   <tbody>
    ";
    $i = 1;





    foreach ($result as $row) {

        //$table_count =  "select count(*) from $row->table_name    where tier_id='$row->tier_id'";
        //$table_tot_row_count =  getRowCount($table_count);
        //$examname =  $row->exam_name.' ('.$row->tier_name.') ('.$row->table_exam_year.')';
        if ($row->table_type == 'kyas') {
            $table_for = "Application Status";
        } else if ($row->table_type == 'tier') {
            $table_for = "Written Exam";
        } else if ($row->table_type == 'skill') {
            $table_for = "Skill Test";
        } else if ($row->table_type == 'dme') {
            $table_for = "Detailed Medical Examination";
        } else if ($row->table_type == 'pet') {
            $table_for = "Physical Standard Test and Physical Endurance Test";
        } else if ($row->table_type == 'dv') {
            $table_for = "Document Verification";
        }
        $examcode = strtolower($row->table_exam_short_name . $row->table_exam_year);
        //if($row->dtmstatus == '0'){

        $output .=
            '<tr class="warning">
           <td width="20px">' . $i . '</td>
          
           <td id="exam_name_id">' . $row->exam_name . '(' . $row->table_exam_year . ')</td>
           <td>' . $table_for . '(' . $row->tier_name . ')</td>
         
           <td>' . $examcode . '</td>';

        if ($row->status == '0') {
            $text = $row->updated_on == null ? '' : 'Un Published pTime:';
            $time = $row->updated_on == null ? '' : date("d-m-Y H:i:s", strtotime($row->updated_on));
            $output .= '<td>
               <form method="post">
                   <i class="fa fa-flag kyc_status_publish_button"  id ="red" style="color:red"></i>
                   <span>' . $text . $time . '</span>                                    
               </form>
               <input class="form-control" type="hidden" name="id" id="sscsr_db_table_master_id" value=' . $row->id . '>
              
               </td></tr>';

        } else {
            $text = $row->updated_on == null ? '' : 'Published Time:';
            $time = $row->updated_on == null ? '' : date("d-m-Y H:i:s", strtotime($row->updated_on));
            $output .= '<td>
               <form method="post">
                   <i class="fa fa-flag kyc_status_publish_button" id ="green" style="color:green"></i> 
                   <span>' . $text . $time . '</span>                                   
               </form>
               <input class="form-control" type="hidden" name="id" id="sscsr_db_table_master_id" value=' . $row->id . '>
          
               </td></tr>';

        }

        $i++;



        //}


    }
    $output .= "</tbody></table>";
    echo $output;


} else {
    header("Location: index.php");
    exit();

}


?>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#exam_data tfoot th').each(function () {
            var title = $('#exam_data thead th').eq($(this).index()).text();
            $(this).html('<input type="text" placeholder="&#xF002;"  style="font-family:FontAwesome;" />');
        });


        // DataTable
        var table = $('#exam_data').DataTable({


            select: {
                'style': 'multi'
            },




            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "dom": "RZfrltip",
            select: true,


        });


        // Apply the search
        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                table.column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });




        // Fetch  Single record
        //  $('.updateUser').on('click', function(event) {
        $('#exam_data').on('click', '.updateUser', function (event) {
            event.preventDefault();
            var id = $(this).data('id');


            $('#txt_userid').val(id);


            // AJAX request
            $.ajax({
                url: 'ajaxfile.php',
                type: 'post',
                data: {
                    request: 2,
                    id: id
                },
                dataType: 'json',
                success: function (response) {

                    if (response.status == 1) {


                        $('#column_name_update').val(response.data.col_name);
                        $('#column_description_update').val(response.data.col_description);
                        if (response.data.is_kyas === '1') {


                            $(".kyas").prop('checked', true);
                        }
                        if (response.data.is_tier === '1') {
                            $(".tier").prop('checked', true);
                        }


                    } else {
                        alert("Invalid ID.");
                    }
                }
            });


        });










        // Save user
        $('#btn_update_save').click(function (event) {

            event.preventDefault();
            var id = $('#txt_userid').val();


            var column_name_update = $('#column_name_update').val().trim();
            var column_description_update = $('#column_description_update').val().trim();
            var myCheckboxes = new Array();
            $("input:checked").each(function () {
                myCheckboxes.push($(this).val());
            });




            if (column_name != '' && column_description != '' && myCheckboxes != '') {
                $.ajax({
                    url: "ajaxfile.php",
                    method: "POST",
                    data: {
                        request: 3,
                        id: id,
                        column_name_update: column_name_update,
                        column_description_update: column_description_update,
                        myCheckboxes: myCheckboxes,
                    },
                    dataType: "json",
                }).done(function (data) {
                    $('#updateModal').modal('toggle');
                    $('#column_name_update', '#column_name_update').val('');


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


        //Delete column master
        $('#exam_data').on('click', '.deleteUser', function (event) {
            //$('#btn_update_save').click(function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                // AJAX request
                $.ajax({
                    url: "ajaxfile.php",
                    method: "POST",
                    data: {
                        request: 4,
                        id: id
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
            }




        });

        $('#exam_data').on('click', '.kyc_status_publish_button', function (event) {
           
            var iconid = $(this).closest('td').find('.kyc_status_publish_button').attr('id');
            var exam_name = $(this).closest('tr').find('#exam_name_id').text();
            var sscsr_db_table_master_id = $(this).closest('td').find('#sscsr_db_table_master_id').val();


            if (iconid == 'green') {
                var title = "Un Publish";
            }
            else {
                var title = " Publish";
            }








            swal.fire({
                title: '<strong> Want to ' + title + '</strong>',
                html: exam_name + '<br><b>Know Your City Status</b>',
                showCloseButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: 'some-class',
                cancelButtonClass: 'some-other-class',
                showCancelButton: true
            }).then(function (result) {
                if (result.value) {


                    // AJAX request
                    $.ajax({
                        url: "kyc_status_master_publish_ajax.php",
                        method: "POST",
                        data: {
                            sscsr_db_table_master_id: sscsr_db_table_master_id,
                            iconid: iconid
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
                    console.log('button B pressed')
                }
            })




        });






    });
</script>