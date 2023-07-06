<?php
//fetch.php
require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    $output = "";
   
 
   


    $sql = "select * from  exam_master where status=:status order by exam_id desc";
    $params = array('status' => '0');
    $result = executeSQlAll($sql, $params);
    $resultCount = executeSQlAllCount($sql, $params);

    if ($resultCount != 0) {
        
        $output .= "
	 <form id='frm-example' action='' method='POST'>
	 <table id='exam_data' class='display table table-striped table-bordered dt-responsive' width='100%'>
						<thead>
							<tr class='danger'>	
							  <th style='width: 28px; cursor: pointer;'>Sno</th>						  
							  <th>Exam Name</th>                    
							  <th>Exam Short Code</th>  
                              <th width='20px'>Action</th>                    
							</tr>
						</thead>
						<tfoot>
							<tr class='success'>       
							<th>Sno</th>						  
							<th>Exam Name</th>    
							<th>Exam Short Code</th>  
                            <th width='20px'>Action</th>    
							</tr>
						</tfoot>
					<tbody>
	 ";
        $i = 1;
        foreach ($result as $row) {
            $output .=
                '<tr class="warning">

		<td>' . $i . '</td>
		<td>' . $row->exam_name . '</td>
		<td>' . $row->exam_short_name . '</td>
        <td width="20px"><button type="button" name="delete" id="' . $row->exam_name . '" class="btn btn-danger btn-xs delete" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
        <button type="button" name="edit" id="' . $row->exam_name . '"  class="btn btn-primary btn-xs edit" style="cursor:pointer"  data-toggle="modal"
        data-target="#addStudent" data-toggle="tooltip" title="Edit" ><i class="fa fa-edit" aria-hidden="true"></i></button></td>
  
		</tr>';
            $i++;

        }


        $output .= "</tbody></table>";
        echo $output;
    } else {
        echo 'Data Not Found';
    }

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
            order: [
                [0, 'asc']
            ],

            pageLength: 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
            "dom": "RZfrlBtip",
            select: true,
            buttons: [
                'colvis',
                {
                    extend: 'collection',
                    text: '<i class="fa fa-file-text-o" style="color:black;font-size: 15px;"> Export</i>',
                    buttons: [
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
                            title: 'Exam Details',
                            filename: 'Exam Details',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf-o" style="color:red;"> PDF</i>',
                            title: 'Exam Details',
                            filename: 'Exam Details',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print" style="color:blue;"> Print</i>',
                            title: 'Exam Details',
                            filename: 'Exam Details',
                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function (win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend(

                                        '<html><title>Report</title><meta name="viewport" content="width=device-width, initial-scale=1"><body><div class="w3-container"><h1>School-Report</h1><hr/><div class="w3-panel w3-win8"></div> </div> <div class="footer"><b><p>© <?php echo date("Y"); ?><a href="#">W<img style="width:14px;height:16px;border:0" src="http://localhost/SJB/school_sms/images/logo/favicon.png" />BHERE</a> . All Rights Reserved .</p><hr/></b></div ></body></html>'

                                    );

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }

                        }
                    ]
                }
            ]
        });

        // Apply the search
        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                table.column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });


    });  


    //Delete Exam
    $(document).on('click', '.delete', function () {

var id = $(this).attr("id");
swal.fire({
    title: '<strong>Are you sure you want to delete this Exam?</strong>',
    html: '<b>' + id + '</b>',
    showCloseButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    confirmButtonClass: 'some-class',
    cancelButtonClass: 'some-other-class',
    showCancelButton: true
}).then(function (result) {
    if (result.value) {
        $.ajax({
            url: "exam_delete_ajax.php",
            type: "POST",
            data: {
                exam_name: id
            },

        }).done(function (data) {

            swal.fire({
                title: '<span style="color:green">Success</span>',
                text: 'Exam Deleted Successfully',
                type: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK',
                allowOutsideClick: false,

            }).then(function (result) {
                if (result.value) {
                    window.location.reload();
                }
            })

        });


    } else {
        console.log('button B pressed')
    }
})



});



//edit




		
	

</script>