<?php

require_once("config/db.php");
require_once("functions.php");

$output = "";
$sql = "select * from  column_master where status=:status order by col_id desc";
$params = array('status' => '0');
$result = executeSQlAll($sql, $params);
$resultCount = executeSQlAllCount($sql, $params);

/* 
print_r($result);
exit; */

$output .= "
 <form id='frm-example' action='' method='POST'>
 <table id='exam_data' class='display table table-striped table-bordered dt-responsive' width='100%'>
                    <thead>
						<tr class='danger'>	
						  <th>Sno</th>						  
						  <th>Excel Name</th>                    
						  <th>Description</th>                    
						  <th>Kyas</th>   
						  <th>Tier</th>   
						  <th>Skill</th>   
						  <th>DME</th>   
						  <th>PET</th>   
						  <th>DV</th>   
						  <th style='width: 76px'>Action</th>                 
						</tr>
					</thead>
					<tfoot>
						<tr class='success'>       
                        <th>Sno</th>						  
						<th>Excel Name</th>                    
						<th>Description</th> 
						<th>Kyas</th>   
						<th>Tier</th> 
						<th>Skill</th>   
						<th>DME</th>   
						<th>PET</th>   
						<th>DV</th>
						<th>Action</th>    
						</tr>
					</tfoot>
				<tbody>
 ";
$i = 1;

foreach ($result as $row) {
	// Update Button
	$updateButton = "<button class='btn btn-sm btn-info updateUser'  data-id='" . $row->col_id . "' data-toggle='modal' data-target='#updateModal' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i></button>";
	//$updateButton = "<a href='#' name='menu_update' class='iconSize updateUser ' data-id='" . $row->col_id  . "' data-toggle='modal' data-target='#updateModal'><i class='fa fa-edit'></i></a>";

	// Delete Button
	$deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='" . $row->col_id . "' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></button>";
	//$deleteButton = "<a href='#'  class='iconSize deleteUser ' data-id='" . $row->col_id  . "' ><i class='fa fa-trash'></i></a>";
	$action = $updateButton . " " . $deleteButton;


	if ($row->is_kyas == 1) {
		$kyas_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_kyas . '</label></i>';
	} else {
		$kyas_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_kyas . '</label></i>';
	}
	if ($row->is_tier == 1) {
		$tier_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_tier . '</label></i>';
	} else {
		$tier_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_tier . '</label></i>';
	}
	if ($row->is_skill == 1) {
		$skill_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_skill . '</label></i>';
	} else {
		$skill_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_skill . '</label></i>';
	}
	if ($row->is_dme == 1) {
		$dme_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_dme . '</label></i>';
	} else {
		$dme_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_dme . '</label></i>';
	}
	if ($row->is_pet == 1) {
		$pet_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_pet . '</label></i>';
	} else {
		$pet_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_pet . '</label></i>';
	}
	if ($row->is_dv == 1) {
		$dv_status = '<i class="fa fa-flag" aria-hidden="true" style="color:green"><label style="display:none">' . $row->is_dv . '</label></i>';
	} else {
		$dv_status = '<i class="fa fa-flag" aria-hidden="true" style="color:red"><label style="display:none">' . $row->is_dv . '</label></i>';
	}

	$output .=
		'<tr class="warning">

    <td>' . $i . '</td>
    <td>' . $row->col_name . '</td>
    <td>' . $row->col_description . '</td>
	<td>' . $kyas_status . '</td>
	<td>' . $tier_status . '</td>
	<td>' . $skill_status . '</td>
	<td>' . $dme_status . '</td>
	<td>' . $pet_status . '</td>
	<td>' . $dv_status . '</td>
	<td>' . $action . '</td>
	
    </tr>';
	$i++;
}


$output .= "</tbody></table>";
echo $output;

?>
<script type="text/javascript" language="javascript">
	$(document).ready(function () {
		// Setup - add a text input to each footer cell
		$('#exam_data tfoot th').each(function () {
			var title = $('#exam_data thead th').eq($(this).index()).text();
			$(this).html('<input type="text" placeholder="&#xF002;"  style="font-family:FontAwesome;" class ="' + title + '"/>');
		});

		$(".Sno").hide();
		$(".Action").hide();

		// DataTable
		var table = $('#exam_data').DataTable({

			buttons: [
				{
					extend: 'excel',
					text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
					title: 'Column Details',
					filename: 'Column Details',
					exportOptions: {
						columns: ':visible'
					}

				}

			],

			select: {
				'style': 'multi'
			},


			pageLength: 5,
			lengthMenu: [
				[5, 10, 20, -1],
				[5, 10, 20, 'All']
			],
			"dom": "RZfBrltip",
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
						if (response.data.is_skill === '1') {

							$(".skill").prop('checked', true);
						}
						if (response.data.is_dme === '1') {

							$(".dme").prop('checked', true);
						}
						if (response.data.is_pet === '1') {
							$(".pet").prop('checked', true);
						}
						if (response.data.is_dv === '1') {

							$(".dv").prop('checked', true);
						}


					} else {
						alert("Invalid ID.");
					}
				}
			});

		});





		// Save user 
		$('#btn_update_save').click(function (event) {

			//debugger;

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



	});
</script>