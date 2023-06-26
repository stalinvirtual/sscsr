<!-- session -->
<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])){
 header("Location: login.php");
}
else
{
?>
<!-- header -->
<?php include('header.php'); ?>
<div class="main-grid">
	
	<div class="panel panel-widget forms-panel">
		<div class="forms">
			<div class="inline-form widget-shadow">
				<div class="form-title">
					<div class="row">
						<div class="col-lg-9 form-group"><h4>Candidate Application Status Details By Exam</h4></div>
					
						<div class="col-lg-2 form-group">
							<a class="btn w3ls-button hvr-icon-float-away col-24" href="upload_application_details.php"> Upload</a>
						</div>
					</div>
				</div>
				<div class="form-body">
					<div data-example-id="simple-form-inline"> 
						<form class="form-horizontal">				
							<div class="form-group">	
								<label for="examname" class="col-sm-4 control-label">Exam Name<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
									<select name="examname" id="examname" required="true" class="form-control">
										<option value="" selected="selected">Select Exam</option>		
									</select>	
								</div> 
							</div>
							<div class="form-group">	
								<label for="examyear" class="col-sm-4 control-label">Exam Month / Year<font style="color:red";>*</font> </label> 
								<div class="col-sm-6">
								<input type="month" id="exam_year"  name="exam_year" class="form-control"  placeholder="Enter Exam Year" value="">	
								</div> 
							</div>										
							<button type="button" class="btn w3ls-button hvr-icon-spin col-5" id="searchdata"> Load </button> 
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<table id='Student_data' class='display table table-striped table-bordered dt-responsive' width='100%'>
		<thead>
			<tr class='danger'>	
			<th>Application No</th>						  
			<th>Candidate Name</th>                       
			<th>Roll No</th>                     
			</tr>
		</thead>
		<tfoot>
			<tr class='success'> 
			<th>Application No</th>						  
			<th>Candidate Name</th>                       
			<th>Roll No</th>       
			</tr>
		</tfoot>
		<tbody>
		
		</tbody>
	</table>
	<br>
</div>
<?php
}
?>
<?php include('footer.php'); ?>
<script type="text/javascript"> 
$(document).ready(function(){


	$('#examname').select2();
	$('#examname').select2({
        placeholder: 'Select Exam',
        ajax: {
          url: 'search_exam.php',
          dataType: 'json',
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });

	     // DataTable
	var table = $('#Student_data').DataTable({
        processing: true,
        language: {
            loadingRecords: '&nbsp;',
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
		select: {
		  'style': 'multi'
		},
		order: [
		  [1, 'asc']
		],
		pageLength : 5,
		lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
		columns: [
			{ data: 'app_no' },
			{ data: 'app_name' },
			{ data: 'roll_no' },
						
			],

	});

    // Apply the search
    table.columns().eq(0).each(function (colIdx) {
        $('input', table.column(colIdx).footer()).on('keyup change', function () {
            table.column(colIdx)
                .search(this.value)
                .draw();
        });
    });
	//$('.dataTables_processing').show();
	// load candidate by exam	
	$('#searchdata').on('click', function() {
		  var examname = $('#examname option:selected').val();
		  var examyear  =  $('#exam_year').val();
		  if(examname != '' && examyear != '')
		  {
			$('.dataTables_processing').show();
			   $.ajax({
			   url:"Load_candidate_by_exam.php",
			   method:"POST",
			   data:{examname:examname,examyear:examyear},
			  }).done(function (data) {
				setTimeout(() => {
					$('.dataTables_processing').hide();
				}, 1000);
				data = JSON.parse(data);
				table.clear();
				
				table.rows.add(data.data).draw();
				//table.columns.adjust().draw(); 
			
				
			});
		  }
		  else
		  {
		    alert("Select the Exam details properly");
		  }
		 });

		 $('#Student_data tfoot th').each(function () {
        var title = $('#Student_data thead th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="&#xF002;"  style="font-family:FontAwesome;" />');
    });
   


	$('#examname').on('select2:selecting', function() {
		  table.clear().draw();
	  });
	  $('#exam_year').on('change', function() {
		  table.clear().draw();
	  });
	


});
 </script> 		