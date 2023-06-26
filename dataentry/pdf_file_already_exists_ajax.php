<?php

require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {


	$pdf_file_name = cleanData($_POST['examname']) . cleanData($_POST['exam_year']) . "_" . cleanData($_POST['selectedtier']) . ".pdf";






	$file_path = 'important_instructions/' . $pdf_file_name;




	if (file_exists($file_path)) {



		$message = array(
			'response' => array(
				'status' => 'already_exists',
				'code' => '0',
				// whatever you want
				'message' => 'Important Instruction already exists',
				'title' => 'Warning!'
			)
		);
	} else {
		echo "File not found";
		exit;
	}

	echo json_encode($message);
} else {

	header("Location: index.php");
	exit();
}