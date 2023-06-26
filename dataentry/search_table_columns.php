<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	require_once("functions.php");
	$value = cleanData($_POST['table_format']) == '' ? 'is_kyas' : cleanData($_POST['table_format']);
	$value2 = $value . "_order";


	$sql = "SELECT * FROM column_master WHERE  $value = '1' AND status = :status order by $value2";
	$params = array('status' => "0");
	$column_result = executeSQlAll($sql, $params);

	$response;
	foreach ($column_result as $insdata) {
		$response[] =
			array(
				'id' => $insdata->col_name . ' TEXT',
				'text' => $insdata->col_description
			);
	}

	echo json_encode($response);
} else {

	header("Location: index.php");
	exit();
}