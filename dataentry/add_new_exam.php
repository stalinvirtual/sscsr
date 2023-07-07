<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	require_once("functions.php");
	$exam_name = cleanData($_POST['examname']);
	$exam_name = htmlspecialchars($exam_name);
	$exam_short_name = strtolower(cleanData($_POST['exam_short_name']));
	$exam_short_name = htmlspecialchars($exam_short_name);

	try {
		 $query = "SELECT * FROM exam_master WHERE exam_name = :exam_name OR exam_short_name = :exam_short_name";
		 $stmt = $pdo->prepare($query);
		 $stmt->execute(['exam_name'=>$exam_name, 'exam_short_name'=>$exam_short_name]);
		 $getresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	     $count = count($getresult);
		 if($count==0){
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
		echo json_encode($message);
	}
	else{
		$message = array(
			'response' => array(
				'status' => 'error',
				'code' => '0',
				// whatever you want
				'message' => 'Exam already exists.',
				'title' => 'Error'
			)
		);
		echo json_encode($message);
	}
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
		echo json_encode($message);
	}

} else {
	header("Location: index.php");
	exit();
}