<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	require_once("functions.php");
	$exam_name = cleanData($_POST['examname']);
	$exam_name = htmlspecialchars($exam_name);
	$exam_short_name = strtolower(cleanData($_POST['exam_short_name']));
	$exam_short_name = htmlspecialchars($exam_short_name);
	try {
		// $sql = "insert into exam_master (exam_name,exam_short_name,status) values ('$exam_name','$exam_short_name','0')";
		$sql = "insert into exam_master (exam_name,exam_short_name,status) values (?,?,?)";
		$stmt = $pdo->prepare($sql);
		// $stmt->execute();
		$stmt->execute([$exam_name, $exam_short_name, '0']);
		$message = array(
			'response' => array(
				'status' => 'success',
				'code' => '1',
				// whatever you want
				'message' => 'Exam Created Successfully.',
				'title' => 'Success'
			)
		);
	} catch (Exception $e) {
		$message = array(
			'response' => array(
				'status' => 'error',
				'code' => '0',
				// whatever you want
				'message' => $e->getMessage(),
				'title' => 'Error'
			)
		);
	}
	echo json_encode($message);
} else {
	header("Location: index.php");
	exit();
}