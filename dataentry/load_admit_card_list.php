<?php

require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

	$output = "";

	$query = "select  distinct em.exam_name, dbm.table_exam_year, dbm.table_type, dbm.table_name,dbm.table_exam_short_name,dtm.tier_id as tier_id,dtm.updated_on as updated_on,tm.tier_name as tier_name,dtm.id as tier_master_id,dtm.status as dtmstatus  from exam_master em 
	join sscsr_db_table_master dbm on em.exam_short_name = dbm.table_exam_short_name
	join sscsr_db_table_tier_master dtm on dbm.table_name = dtm.table_name
	join tier_master tm on cast(dtm.tier_id as char(255)) =  cast(tm.tier_id as char(255)) order by dbm.table_exam_year desc,dtm.tier_id asc ";

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
							  <th width=35%>Exam Name</th> 
							  <th width=20%>Exam Type</th> 
							  <th width=2%>Rows</th> 
							  <th width=2%>Action</th>							  
							</tr>
						</thead>
						<tfoot>
							<tr class='success'>       
							 					  
							  <th  width=35%>Exam Name</th>                    
							  <th width=20%>Exam Type</th> 
							  <th width=2%>Rows</th>
							  <th width=2%>Action</th>							  
							 
							</tr>
						</tfoot>
					<tbody>
	 ";
	$i = 1;

	foreach ($result as $row) {


		$array = explode('_', $row->table_name);
		$kyas_table = $array[0] . '_' . $array[1] . '_' . 'kyas';
		//$table_count =  "select count(*) from $row->table_name    where tier_id='$row->tier_id' and ac_printed = '1'";
		$table_count = "select count(*) from $kyas_table  as kd 
		join $row->table_name  as ted 
		on kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code)
		join tier_master as t 
		on ted.tier_id = cast(t.tier_id as char(255))
		where ted.ac_printed = '1' and ted.tier_id = '$row->tier_id'";


		$table_tot_row_count = getRowCount($table_count);
		$examname = $row->exam_name . ' (' . $row->tier_name . ') (' . $row->table_exam_year . ')';
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

		if ($row->dtmstatus == '1') {

			$output .=
				'<tr class="warning">
			
			<td id ="exam_name_id">' . $examname . '</td>
			<td>' . $table_for . '</td>
			<td style="text-align:right">' . $table_tot_row_count . '</td>';


			$output .= '<td>
				<form method="post">
					<button type="button" name="update" id=' . $row->tier_master_id . ' class="btn btn-primary btn-xs publish-admitcard"><i class="fa fa-eye" aria-hidden="true"></i></button>
				</form>
				<input class="form-control" type="hidden" name="id" id="tier_master_id" value=' . $row->tier_master_id . '>
				</td>
				</tr>';

		}



		$i++;


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

		$('#exam_data').on('click', '.publish-button', function (event) {



			// $('#tbl').on('click', 'tbody tr a', function() 

			var exam_tier_master_id = $(this).closest('td').find('#tier_master_id').val();
			//var baseurl = 'exam_tier_master_publish_ajax.php';
			//var redirecturl = 'dataentry/exam_tier_master.php';
			var iconid = $(this).closest('td').find('.publish-button').attr('id');



			var exam_name = $(this).closest('tr').find('#exam_name_id').text();
			if (iconid == 'green') {
				var title = "Un Publish";
			}
			else {
				var title = " Publish";
			}



			swal.fire({
				title: '<strong> Want to ' + title + '</strong>',
				html: exam_name,
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
						url: "exam_tier_master_publish_ajax.php",
						method: "POST",
						data: {
							exam_tier_master_id: exam_tier_master_id,
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
							var dt = new Date();
							var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

							$('#update_time').html(time);
						});
					});

				} else {
					console.log('button B pressed')
				}
			})




		});

	});
</script>