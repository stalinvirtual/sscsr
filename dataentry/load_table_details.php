<?php

require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

	$output = "";

	$query = "select DISTINCT em.exam_name, dbm.table_exam_year, dbm.table_type, dbm.asset_path ,dbm.table_name,dbm.table_exam_short_name  from exam_master em 
	join sscsr_db_table_master dbm on em.exam_short_name = dbm.table_exam_short_name";

	$result = getAll($query);

	//echo '<pre>';
	//print_R($result);
	$output .= "
	 <form id='frm-example' action='' method='POST'>
	 <table id='exam_data' class='display table table-striped table-bordered dt-responsive' width='100%'>
						<thead>
							<tr class='danger'>	
							  <th width='20px'>Sno</th>						  
							  <th>Exam Name</th>                    
							  <th>Exam Type</th>                    
							  <th>Exam Code</th>                    
							  <th>Asset Path</th>                  
							  <th width='20px'>Rows</th>     
							  <th width='20px'>Action</th>  						  
							</tr>
						</thead>
						<tfoot>
							<tr class='success'>       
							<th width='20px'>Sno</th>						  
							  <th>Exam Name</th>                    
							  <th>Exam Type</th>                    
							  <th>Exam Code</th>                    
							  <th>Asset Path</th>                  
							  <th width='20px'>Rows</th>
							  <th width='20px'>Action</th>  						  
							</tr>
						</tfoot>
					<tbody>
	 ";
	$i = 1;

	foreach ($result as $row) {



		$table_count = "select count(*) from $row->table_name  ";
		//echo $table_count;
		$table_tot_row_count = getRowCount($table_count);




		$examcode = strtolower($row->table_exam_short_name . $row->table_exam_year);

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

		if ($row->asset_path == '') {
			$asset_path = "---No Folder---";
		} else {
			$asset_path = '<i class="fa fa-folder-open" aria-hidden="true"></i> ' . $row->asset_path;
		}



		$output .=
			'<tr class="warning">

		<td width="20px">' . $i . '</td>
		<td>' . $row->exam_name . '(' . $row->table_exam_year . ')</td>
		<td>' . $table_for . '</td>
		<td>' . $examcode . '</td>
		<td>' . $asset_path . '</td>
		<td width="20px">' . $table_tot_row_count . '</td>
		  <td width="20px"><button type="button" name="update" id="' . $row->table_name . '" class="btn btn-danger btn-xs delete" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
		  <button type="button" name="archieve" id="' . $row->table_name . '" class="btn btn-primary btn-xs archieve" style="cursor:pointer"  data-toggle="tooltip" title="Archieve"><i class="fa fa-archive" aria-hidden="true"></i></button></td>
		</tr>';
		$i++;

	}


	$output .= "</tbody></table>";
	echo $output;

} else {
	header("Location: index.php");
	exit();

}




?>
<!-- Spinner div start-->
<div id="overlay" style="display:none;">
	<h1>Data Uploading...</h1>
	<br>
	<div class="progress-3"></div>
	<br>
	<h3>Please wait</h3>
</div>

<!-- Spinner div End-->
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
			lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
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


		$(document).on('click', '.delete', function () {

			var id = $(this).attr("id");
			swal.fire({
				title: '<strong>Are you sure you want to delete this Table?</strong>',
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
						url: "table_delete_ajax.php",
						type: "POST",
						data: {
							table_name: id
						},

					}).done(function (data) {

						swal.fire({
							title: '<span style="color:green">Success</span>',
							text: 'Table Deleted Successfully',
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






		//Archieves Functions
		$(document).on('click', '.archieve', function () {

			var table_name = $(this).attr("id");




			$.ajax({
				url: "table_archieves_exists_ajax.php",
				type: "post",
				data: "table_name=" + table_name,
				dataType: "json",
				success: function (data) {




					if (data.response.status == 'fail') {






						swal.fire({
							title: data.response.message,
							type: 'warning',
							showCancelButton: false,
							confirmButtonText: 'OK',
							allowOutsideClick: false,

						})


					}
					else {

						/***
						 * 
						 * Success
						 * 
						 */

						swal.fire({
							title: '<strong>Are you sure you want to move this Table to an Archieve?</strong>',
							html: '<b>' + table_name + '</b>',


							showCloseButton: true,
							confirmButtonText: 'Yes',
							cancelButtonText: 'No',
							confirmButtonClass: 'some-class',
							cancelButtonClass: 'some-other-class',
							showCancelButton: true,
							icon: "https://www.boasnotas.com/img/loading2.gif",
						}).then(function (result) {

							if (result.value) {
								swal.fire({
									title: 'Table Archieving',
									text: 'Loading',
									allowOutsideClick: false,
									onBeforeOpen: () => {
										Swal.showLoading()
									},
									onAfterClose: () =>{
                                       Swal.hideLoading()
                                 },
                                   allowOutsideClick: false,
                                    allowEscapeKey: false,
                                 allowEnterKey: false


								});


								$.ajax({
									url: "table_archieve_ajax.php",
									type: "POST",
									data: "table_name=" + table_name,
									dataType: "json",

								}).then(function (data) {
								
									swal.fire({
										title: '<span style="color:green">Success</span>',
										text: 'Table Archieved Successfully',
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



						/****
						 * 
						 * 
						 * Success 
						 * 
						 */


					}


					// You will get response from your PHP page (what you echo or print)
				},

				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});








		});
		//Archieves Functions








	});  
</script>

<style>
	[class*=classic]:before {
		content: "Loading...";
	}

	.progress-3 {
		width: 100%;
		height: 20px;
		border-radius: 20px;
		background:
			repeating-linear-gradient(135deg, #f03355 0 10px, #ffa516 0 20px) 0/0% no-repeat,
			repeating-linear-gradient(135deg, #ddd 0 10px, #eee 0 20px) 0/100%;
		animation: p3 2s infinite;
	}

	@keyframes p3 {
		100% {
			background-size: 100%
		}
	}


	#overlay {
		background: #000000;
		color: #FFFFFF;
		position: fixed;
		height: 100%;
		width: 100%;
		z-index: 5000;
		top: 0;
		left: 0;
		float: left;
		text-align: center;
		padding-top: 20%;
		padding-left: 10%;
		padding-right: 10%;
		opacity: .80;
	}

	.spinner {
		margin: 0 auto;
		height: 64px;
		width: 64px;
		animation: rotate 1s infinite linear;
		border: 5px solid firebrick;
		border-right-color: transparent;
		border-radius: 50%;
	}
</style>