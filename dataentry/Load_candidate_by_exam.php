<?php

//fetch.php
require_once("config/db.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	require_once("functions.php");
	$id = cleanData($_POST['examname']);
	$exam_month_year = cleanData($_POST['examyear']);
	$sql = "SELECT * FROM ssc_candidate_details_by_exam WHERE exam_id =(select exam_id from exam_details where exam_month_year = :exam_month_year and exam_id =:exam_id)";
	$params = array('exam_month_year' => $exam_month_year, 'exam_id' => $id);
	$result = executeSQlAll($sql, $params);
	$resultCount = executeSQlAllCount($sql, $params);

	//$resultCount =  getRowCount($query);
	$data = array();

	if ($resultCount > 0) {
		## Fetch records
		foreach ($result as $row) {
			$data[] = array(
				"app_no" => $row->app_no,
				"app_name" => $row->app_name,
				"roll_no" => $row->roll_no
			);

		}

		## Response
		$response = array(
			"data" => $data
		);
		echo json_encode($response);


	}
} else {

	header("Location: index.php");
	exit();
}