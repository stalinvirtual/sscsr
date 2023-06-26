<?php
require_once("config/db.php");
require_once("functions.php");




if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$table_format = cleanData($_POST['selectedTableFormat']);
	$exam_name = cleanData($_POST['examname']);
	$exam_year = cleanData($_POST['exam_year']);


	$tier = 'tier' . cleanData($_POST['selectedtier']);




	$kyas_table = $exam_name . '_' . $exam_year . '_kyas';
	$tier_table = $exam_name . '_' . $exam_year . '_tier';
	$output1 = getKyasTableCount($kyas_table);
	$output2 = getTierTableCount($tier_table);



	$applicable_people = $output1['applicable'];
	$tier1_people = $output2[$tier];





	$complition = '';

	if ($applicable_people == 0 || $tier1_people == 0) {
		$complition = 'No Data Found';
	} else if ($applicable_people == $tier1_people) {
		$complition = 'completed';
	} else {
		$complition = 'not completed';
	}


	$message = array(
		'complition' => $complition,
		'applicable_count' => $applicable_people,
		'tier1_count' => $tier1_people,

	);

	echo json_encode($message);
} else {

	header("Location: index.php");
	exit();
}


?>