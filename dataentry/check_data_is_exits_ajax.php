<?php
require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {


	$table_format = cleanData($_POST['selectedTableFormat']);
	$exam_name = cleanData($_POST['examname']);
	$exam_year = cleanData($_POST['exam_year']);
	$tier = cleanData($_POST['selectedtier']);
	$tier_table = $exam_name . "_" . $exam_year . "_" . cleanData(substr($_POST['selectedTableFormat'], 3));

	$output = isCandidateDataExists($tier_table, $tier);
	echo json_encode($output);
} else {

	header("Location: index.php");
	exit();
}


?>a