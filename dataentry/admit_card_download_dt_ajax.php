<?php
// ini_set('memory_limit', '100M');
//ini_set('memory_limit', '-1');
require_once("config/db.php");
require_once("functions.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$table_type = substr(cleanData($_POST['selectedTableFormat']), 3);
	$table_name = cleanData($_POST['examname']) . '_' . cleanData($_POST['exam_year']) . '_' . $table_type;
	$table_name = strtolower($table_name);
	$download_options = trim($_POST['download_options']);
	$selectedtier = trim($_POST['selectedtier']);
	$kyas_table = cleanData($_POST['examname']) . '_' . cleanData($_POST['exam_year']) . '_' . 'kyas';
	// $person = array(
	// 	"table_type" => $table_type,
	// 	"table_name" => $table_name,
	// 	"download_options" => $download_options,
	// 	"selectedtier" => $selectedtier,
	// );
	// 	SELECT kd.*,ted.*,t.tier_name, t.tier_id, ted.*,t.tier_name, 
// t.tier_id,
// CONCAT(kd.present_address,', ',kd.present_district,', ',kd.present_state,', ',substring(kd.present_pincode,1,6)) as candidate_address 
// FROM cgle_2019_kyas kd 
// JOIN cgle_2019_tier ted ON kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) 
	// JOIN tier_master t ON ted.tier_id = cast(t.tier_id as char(255)) 
// where ted.tier_id = '1' and ted.ac_printed = '1' 

// echo $_POST['examname'];
// echo $_POST['exam_year'];
// echo $table_type;
// die;


$output = isExists($_POST['examname'],$_POST['exam_year'],	$table_type);
if($output->count == 1){
	

	if ($download_options == '1') {
		$sql = "SELECT kd.reg_no,kd.dob,kd.cand_name,ted.roll_no,ted.updated_on,ted.ipaddress FROM $kyas_table kd 
JOIN $table_name ted ON 
kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) 
JOIN tier_master t ON ted.tier_id = cast(t.tier_id as char(255)) where ted.tier_id = :tier_id and ted.ac_printed = :ac_printed  limit 10000";
		$sql2 = "
SELECT column_name 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE table_name = :kyas_table and column_name in ('cand_name','reg_no','dob')
UNION ALL 
SELECT column_name 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE table_name = :other_table and column_name  in('roll_no','ipaddress' ,'updated_on')";
	} else {
		$sql = "SELECT kd.reg_no,kd.dob,kd.cand_name,ted.roll_no FROM $kyas_table kd 
JOIN $table_name ted ON 
kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code) 
JOIN tier_master t ON ted.tier_id = cast(t.tier_id as char(255)) where ted.tier_id = :tier_id and ted.ac_printed = :ac_printed  limit 10000";
		$sql2 = "
SELECT column_name 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE table_name = :kyas_table and column_name in ('cand_name','reg_no','dob')
UNION ALL 
SELECT column_name 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE table_name = :other_table and column_name  in('roll_no')";
	}

	$stmt = $pdo->prepare($sql);
	$stmt->execute(['tier_id' => $selectedtier, 'ac_printed' => $download_options]);
	$getresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$count = count($getresult);
	if ($count > 0) {
		$getcol = $pdo->prepare($sql2);
		$getcol->execute(['kyas_table' => $kyas_table, 'other_table' => $table_name]);
		if ($download_options == 1) {
			$filename = $table_name . '_' . $selectedtier . '_downloaded.csv';
		} else {
			$filename = $table_name . '_' . $selectedtier . '_not_downloaded.csv';
		}
		$file = fopen($filename, 'w');
		$headers = array(); // Replace with your actual column names
		$row = $getcol->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $val) {
			if ($val['column_name'] == 'updated_on') {
				$val['column_name'] = 'downloaded_on';
			}
			$headers[] = $val['column_name'];
		}
		fputcsv($file, $headers);
		foreach ($getresult as $res) {
			fputcsv($file, $res);
		}
		fclose($file);
		// Provide a download link for the CSV file
		echo '<a href="' . $filename . '" style="color:white !important"><button class="btn hvr-icon-down col-5" id="download_btn" style="margin: 10px 0px 0px 329px;">
		Download</button></a>';
		$reloadTime = 3000; // Reload time in milliseconds (5 seconds)

		echo '<script type="text/javascript">';
		echo 'setTimeout(function(){location.reload(); }, '.$reloadTime.');
		';
		
		echo '</script>';
	} else {
		echo '<p style="text-align:center; color:red;"><b>No records found in "' . $table_name . '" </b></p>';
	}
}else{
	echo '<p style="text-align:center; color:red;"><b>"' . $table_name . '" does not exist.</b></p>';
	$reloadTime = 3000; // Reload time in milliseconds (5 seconds)

		echo '<script type="text/javascript">';
		echo 'setTimeout(function(){location.reload(); }, '.$reloadTime.');
		';
		
		echo '</script>';
}
} else {
	
	header("Location: index.php");
	exit();
}


?>
<script type="text/javascript" language="javascript">
	$(document).ready(function () {
		var table = $('#admit_card_tbl').DataTable({
			//dom: 'Bfrtip',
			dom: "Bfrtip",
			buttons: [
				'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
			],
			select: {
				'style': 'multi'
			},
			pageLength: 10,
			lengthMenu: [
				[10, 10, 20, -1],
				[10, 10, 20, 'All']
			],
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
		var download_options = $('input[name="download_options"]:checked').val();
		if (download_options == '0') {
			var dt = $('#admit_card_tbl').DataTable();
			//hide the first column
			dt.columns([5, 6]).visible(false);
			// location.reload();
		}
		else {
			jQuery('.dt-checkboxes-select-all').closest('tr').find('[type=checkbox]').hide();
			var dt = $('#admit_card_tbl').DataTable();
			//hide the first column
			//dt.columns([0]).visible(false);
			dt.columns([5, 6]).visible(true);
		}
		//  $('#admit_card_tbl').DataTable({
		// 	pageLength: 10,
		// 		"scrollX":true,
		// 		"dom": "Bfrtip",
		// 		'paging': true,
		//         'pageLength': 10,
		// 		'lengthMenu': [[ 10, 20, -1], [ 10, 20, "All"]],
		//         'iDisplayLength': -1,
		// 	});
		// $('#exam_data').DataTable({
		// 		"scrollX":true,
		// 		'paging': true,
		//         'pageLength': 10,
		// 		'lengthMenu': [[10, 20, -1], [ 10, 20, "All"]],
		//         'iDisplayLength': -1,
		// 		"dom": "Bfrtip",
		// 		buttons: [
		// 			{
		// 				extend: 'excel',
		// 				text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
		// 				title: '<?php // echo $table_name . " table Excel Sheet Column Names" ?>',
		// 				filename: '<?php // echo $table_name ?>',
		// 				exportOptions: {
		// 					 columns: ':visible'
		// 				}
		// 			}
		// 		]
		// 	}
		// );
	});  
</script>