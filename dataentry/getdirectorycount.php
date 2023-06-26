<?php
require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {


	$table_format = cleanData($_POST['selectedTableFormat']);
	$exam_name = cleanData($_POST['examname']);
	$exam_year = cleanData($_POST['exam_year']);
	$asset_path = getcwd() . "/ftp/" . $exam_name . '_' . $exam_year;

	$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
	if ($output->count == 1) {

		//Set the current working directory
		$photo_path = $asset_path . "/photo/";
		$sign_path = $asset_path . "/sign/";
		$output2 = getkyasRowCount($exam_name, $exam_year, $table_subname = "kyas");
		$row_count = $output2->rowcount;
		$photo_count = checkFileCount($photo_path);
		$sign_count = checkFileCount($sign_path);
		$complition = '';


		if ($photo_count == 0 && $sign_count == 0 && $row_count == 0) {
			$complition = 'new';
		} else if ($row_count == $photo_count && $row_count == $sign_count) {
			$complition = 'complited';
		} else {
			$complition = 'not complited';
		}


		$message = array(
			'complition' => $complition,
			'row_count' => $row_count,
			'photo_count' => $photo_count,
			'sign_count' => $sign_count
		);

		echo json_encode($message);
	}
} else {
	header("Location: index.php");
	exit();
}



?>