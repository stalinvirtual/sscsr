<?php

require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

	$output = "";

	$query = "SELECT DISTINCT tm.table_name,
	tm.table_exam_short_name,
	tm.table_exam_year,
	tm.status,
	tm.updated_on,
	tm.table_id,
	em.exam_name
	FROM public.sscsr_db_table_master tm 
JOIN exam_master em ON tm.table_exam_short_name = em.exam_short_name 
WHERE  tm.table_type='kyas' order by tm.table_exam_year desc";

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
							  <th>Exam Short Name </th> 
							  <th>Exam Year</th>  
							  <th>Action</th>							  
							</tr>
						</thead>
						<tfoot>
							<tr class='success'>       
							 <th width='20px'>Sno</th>						  
							  <th>Exam Name</th>                    
							  <th>Exam Short Name  </th> 
							  <th>Exam Year</th>	
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


		//if($row->dtmstatus == '0'){

		$output .=
			'<tr class="warning">
			<td width="20px">' . $i . '</td>
			<td  id ="exam_name_id">' . $row->exam_name . '</td>
			<td>' . $row->table_exam_short_name . '</td>
			<td  id ="exam_year_id">' . $row->table_exam_year . '</td>';
		if ($row->status == '0') {
			$text = $row->updated_on == null ? '' : 'Un Published Time:';
			$time = $row->updated_on == null ? '' : date("d-m-Y H:i:s", strtotime($row->updated_on));
			$output .= '<td>
				<form method="post">
					<i class="fa fa-flag kyas_status_publish_button"  id ="red" style="color:red"></i> 
					<span>' . $text . $time . '</span>                                     
				</form>
				<input class="form-control" type="hidden" name="id" id="sscsr_db_table_master_id" value=' . $row->table_id . '>
				
				</td></tr>';

		} else {
			$text = $row->updated_on == null ? '' : 'Published Time:';
			$time = $row->updated_on == null ? '' : date("d-m-Y H:i:s", strtotime($row->updated_on));
			$output .= '<td>
				<form method="post">
					<i class="fa fa-flag kyas_status_publish_button" id ="green" style="color:green"></i>  
					<span>' . $text . $time . '</span>                                    
				</form>
				<input class="form-control" type="hidden" name="id" id="sscsr_db_table_master_id" value=' . $row->table_id . '>
			
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
		//	$('.updateUser').on('click', function(event) {
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

		$('#exam_data').on('click', '.kyas_status_publish_button', function (event) {
			var iconid = $(this).closest('td').find('.kyas_status_publish_button').attr('id');
			var exam_name = $(this).closest('tr').find('#exam_name_id').text();
			var exam_year = $(this).closest('tr').find('#exam_year_id').text();
			var sscsr_db_table_master_id = $(this).closest('td').find('#sscsr_db_table_master_id').val();


			if (iconid == 'green') {
				var title = "Un Publish";
			}
			else {
				var title = " Publish";
			}





			swal.fire({
				title: '<strong> Want to ' + title + '</strong>',
				html: exam_name + '(' + exam_year + ')<br><b>Know Your Application Status</b>',
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
						url: "kyas_status_master_publish_ajax.php",
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