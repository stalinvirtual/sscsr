<?php
require_once("config/db.php");
require_once("functions.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$exam_name = $_REQUEST['exam_name'];
	if(isset($exam_name) && $exam_name != 'null' )
	{
		$query = "SELECT * FROM exam_master WHERE exam_name = :exam_name";
		$stmt = $pdo->prepare($query);
		$row = $stmt->execute([':exam_name' => $exam_name ]);
		$getresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($getresult);
	}
}
?>