<?php
require_once("config/db.php");
require_once("functions.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$table_format = cleanData($_POST['selectedTableFormat']);
	$exam_name = cleanData($_POST['examname']);
	$exam_year = cleanData($_POST['exam_year']);

	$response = 0;

	if ($table_format == "is_kyas") {
		$table_subname = "kyas";
		//is kyas exists
		$output = isExists($exam_name, $exam_year, $table_subname);
		if ($output->count == 1) {
			$response = 1; //kyas table is exists
		} else {
			$response = 2; //kyas table not exists
		}
	} else if ($table_format == "is_tier") {
		$table_subname = "tier";
		//is kyas exists
		$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
		if ($output->count == 0) {
			$response = 2; //kyas table not exists
		} //is tier exists
		else if ($output->count == 1) {
			$output = isExists($exam_name, $exam_year, $table_subname = 'tier');
			if ($output->count == 1) {
				$response = 3; //tier table already exists
			} else {
				$response = 4; //tier table not exits
			}
		}
	} else if ($table_format == "is_skill") {
		$table_subname = "skill";
		$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
		if ($output->count == 0) {
			$response = 2; //kyas table not exists
		}
		//is tier exists
		else if ($output->count == 1) {
			$output = isExists($exam_name, $exam_year, $table_subname = 'tier');
			if ($output->count == 0) {
				$response = 4; // tier table not exits
			} else if ($output->count == 1) {
				$output = isExists($exam_name, $exam_year, $table_subname = 'skill');
				if ($output->count == 1) {
					$response = 5; //skill table already exists
				} else {
					$response = 6; //skill table not exists
				}

			}
		}
	} else if ($table_format == "is_pet") {
		$table_subname = "pet";
		$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
		if ($output->count == 0) {
			$response = 2; //kyas table not exists
		}
		//is tier exists
		else if ($output->count == 1) {
			$output = isExists($exam_name, $exam_year, $table_subname = 'tier');
			if ($output->count == 0) {
				$response = 4; // tier table not exits
			} else if ($output->count == 1) {
				$output = isExists($exam_name, $exam_year, $table_subname = 'pet');
				if ($output->count == 1) {
					$response = 7; //pet table already exists
				} else {
					$response = 8; //pet table not exists
				}

			}
		}
	} else if ($table_format == "is_dv") {
		$table_subname = "dv";
		$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
		if ($output->count == 0) {
			$response = 2; //kyas table not exists
		}
		//is tier exists
		else if ($output->count == 1) {
			$output = isExists($exam_name, $exam_year, $table_subname = 'tier');
			if ($output->count == 0) {
				$response = 4; // tier table not exits
			} else if ($output->count == 1) {
				$output = isExists($exam_name, $exam_year, $table_subname = 'dv');
				if ($output->count == 1) {
					$response = 9; //dv table already exists
				} else {
					$response = 10; //dv table already exists
				}

			}
		}
	} else if ($table_format == "is_dme") {
		$table_subname = "dme";
		$output = isExists($exam_name, $exam_year, $table_subname = "kyas");
		if ($output->count == 0) {
			$response = 2; //kyas table not exists
		}
		//is tier exists
		else if ($output->count == 1) {
			$output = isExists($exam_name, $exam_year, $table_subname = 'tier');
			if ($output->count == 0) {
				$response = 4; // tier table not exits
			} else if ($output->count == 1) {
				$output = isExists($exam_name, $exam_year, $table_subname = 'dme');
				if ($output->count == 1) {
					$response = 11; //dme table already exists
				} else {
					$response = 12; //dme table already exists
				}

			}
		}
	}





	echo json_encode($response);

} else {

	header("Location: index.php");
	exit();
}