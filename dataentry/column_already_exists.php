<?php
require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$col_name = cleanData($_POST['column_name']);
	$sql = "select count(*) as cntUser from column_master where col_name=:col_name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['col_name' => $col_name]);
	$resultCount = $stmt->fetchColumn();
	//$resultCount =  getRowCount($query);
	$message = "";

	if ($resultCount > 0) {
		$message = "<span style='color: red;'>Column Name Already Exists.</span>";
	} else {
		$message = "";
	}

	echo json_encode($message);

} else {
	header("Location: index.php");
	exit();
}