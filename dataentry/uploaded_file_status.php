<?php
//fetch.php
require_once("config/db.php");
require_once("functions.php");

$output = "";

$query =  "SELECT excel_file_status.excel_file_name,excel_file_status.file_status,excel_file_status.uploaded_time,excel_file_status.updated_time,exam_details.exam_name,exam_details.exam_month_year
FROM excel_file_status
INNER JOIN exam_details ON excel_file_status.exam_id = exam_details.exam_id order by excel_file_status.uploaded_time desc";
$result =  getAll($query);

$countQuery = "SELECT count(*)
FROM excel_file_status
INNER JOIN exam_details ON excel_file_status.exam_id = exam_details.exam_id ";
$resultCount =  getRowCount($countQuery);

 if($resultCount !=0)
{
 $output .= "
 <form id='frm-example' action='' method='POST'>
 <table id='file_status_id' class='display table table-striped table-bordered dt-responsive' width='100%'>
                     <thead>
						<tr class='danger'>	
						  <th>Sno</th>						  
						  <th>Excel Filename</th>                    
						  <th>Exam Details</th>                    
						  <th>Uploaded Date / Time</th>                    
						  <th>Status</th>                    
						</tr>
					</thead>
					<tfoot>
						<tr class='success'>       
                          <th>Sno</th>						  
						  <th>Excel Filename</th>                    
						  <th>Exam Details</th>                    
						  <th>Uploaded Date / Time</th>                    
						  <th>Status</th>  
						</tr>
					</tfoot>
				<tbody>
 ";
 $i=1;
 foreach($result as $row){
     $output .=
    '<tr class="warning">

    <td>'.$i.'</td>
    <td>'.$row->excel_file_name.'</td>
    <td>'.$row->exam_name.'('.$row->exam_month_year.')</td>
    <td>'.$row->uploaded_time.'</td>
    <td>'.$row->file_status.'</td>
    </tr>';
    $i++;

 }
 

 $output .= "</tbody></table>";
 echo $output;
}
else
{
 echo 'Data Not Found';
}
?>
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){  
	  // Setup - add a text input to each footer cell
    $('#file_status_id tfoot th').each(function () {
        var title = $('#file_status_id thead th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="&#xF002;"  style="font-family:FontAwesome;" />');
    });
   
    // DataTable
    var table = $('#file_status_id').DataTable({
		
	
	
		pageLength : 5,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
		
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
 </script>  	