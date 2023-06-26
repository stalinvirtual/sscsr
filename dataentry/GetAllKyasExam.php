<?php
require_once("config/db.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	require_once("functions.php");
	$exam_name = cleanData($_POST["kyas"]);


	####### Kyas Table Count ###############

	$kyas_table_count = getKyasAllTableCount($exam_name);

	$response = array(
		"kyas_count" => $kyas_table_count['kyas_count'],
		"kyas_records" => $kyas_table_count['kyas_records'],
		"status" => "success"
	);

	echo json_encode($response);
} else {

	header("Location: index.php");
	exit();
}