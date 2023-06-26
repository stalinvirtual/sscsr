<?php
require_once("config/db.php");
require_once("functions.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$table_type = substr(cleanData($_POST['selectedTableFormat']), 3);
	$table_name = cleanData($_POST['examname']) . '_' . cleanData($_POST['exam_year']) . '_' . $table_type;
	$table_name = strtolower($table_name);

	$sql = "SELECT asset_path FROM public.sscsr_db_table_master WHERE table_name =:table_name limit 1";

	//echo $sql;
	//echo  "SELECT asset_path FROM public.sscsr_db_table_master WHERE table_name =$table_name limit 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['table_name' => $table_name]);
	$path = $stmt->fetch();

	$main_path = $path->asset_path;
	$output = '';

	if ($main_path != '') {
		$output .= "<h3>Exam assets file should be upload following folder's:-</h3><br>
				<table id='folder_data' class='display table table-striped table-bordered ' width='100%'>
                    <thead>
						<tr class='danger'> 
						    <th style='text-align:start'>Main Folder</th>
						    <th style='text-align:start'>Photo's Folder</th>
						    <th style='text-align:start'>Signature's Folder</th>
						</tr>
					</thead>
					<tbody>
						<tr class='warning'>
							<td style='text-align:start'>" . $main_path . "</td>
							<td style='text-align:start'>" . $main_path . "/photo </td>
							<td style='text-align:start'>" . $main_path . "/sign </td>
						</tr>
					</tbody>
				</table>";
	}

	$sql = "SELECT column_name FROM information_schema.columns WHERE table_name =:table_name ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['table_name' => $table_name]);
	$result = $stmt->fetchAll();







	@$output .= "
 <br>
 <h3>Excel sheet columns should be like this:- </h3>
 <br>
 <table id='exam_data' class='display table table-striped table-bordered ' width='100%'>
                    <thead>
						<tr class='danger'> ";

	$j = 1;
	foreach ($result as $row) {
		if ($row->column_name == 'id') {


		} else {
			@$output .=
				'
    <th style="text-align:start">' . $j . '</th>
    ';
			$j++;
		}


	}

	@$output .= "</tr>
					</thead>
					
				<tbody><tr class='warning'>";
	$i = 1;
	foreach ($result as $row) {
		if ($row->column_name == 'id') {


		} else {
			@$output .=
				'
    <td style="text-align:start">' . $row->column_name . '</td>
    ';
			$i++;
		}


	}


	@$output .= "</tr></tbody></table>";
	echo @$output;


} else {

	header("Location: index.php");
	exit();
}
?>
<script type="text/javascript" language="javascript">
	$(document).ready(function () {

		$('#folder_data').DataTable({
			"scrollX": true,
			"dom": "Bt"

		});


		$('#exam_data').DataTable({
			"scrollX": true,
			"dom": "Bt",
			buttons: [
				{
					extend: 'excel',
					text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
					title: '<?php echo $table_name . " table Excel Sheet Column Names" ?>',
					filename: '<?php echo $table_name ?>',
					exportOptions: {
						columns: ':visible'
					}

				}

			]

		}
		);



	});  
</script>