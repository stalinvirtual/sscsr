<?php
require_once("config/db.php");
require_once("functions.php");



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	$table_type = substr(cleanData($_POST['selectedTableFormat']), 3);

	$table_name = cleanData($_POST['examname']) . '_' . cleanData($_POST['exam_year']) . '_' . $table_type;

	$table_name = strtolower($table_name);

	$exam_short_code = cleanData($_POST['examname']);
	$exam_year = cleanData($_POST['exam_year']);
	$table_columns = implode(",", $_POST['selectcolumn']);
	$title = cleanData($_POST['examname']) . ' ' . cleanData($_POST['exam_year']) . ' Table';





	// foreach($_POST['selectcolumn'] as $value){

	// 	//echo $value;


	// 	if (stripos($value, "present_pincode ") !== false) {
	// 		$newstring = substr($value, -4);
	// 		$new = str_replace($newstring,"VARCHAR(50)",$value);
	// 		$strFn []=  $new;
	// 	}
	// 	else{
	// 		$strFn[] = $value;

	// 	}



	// }



	// $table_columns = implode(",",$strFn);



	try {
		$sql = "CREATE TABLE $table_name (id text PRIMARY KEY,$table_columns)";


		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$sql3 = "ALTER TABLE IF EXISTS public.$table_name OWNER to postgres";
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->execute();

		//create folder for uploading photos and signs of the candidates
		if ($_POST['selectedTableFormat'] == 'is_kyas') {

			$newdir = cleanData($_POST['examname']) . '_' . cleanData($_POST['exam_year']);
			$newdir = strtolower($newdir);
			$subdir = "photo";
			$subdir = "sign";
			//fetch the current working directory
			$curdir = getcwd();
			// append the "images" directory to your current working directory 
			$dir = $curdir . "/ftp";
			// append the "$newdir" directory to your image directory path 
			$path = $dir . "/$newdir";
			// for the two line u can write $dir= $curdir."\images"."/$newdir";
			// check if file exits
			if (is_dir($path)) //or using the single  line code if(is_dir($dir))
			{
				$mainfolder = 'ftp/' . $newdir;
			} else {
				mkdir($path, 0777, true);
				$mainfolder = 'ftp/' . $newdir;
				mkdir($mainfolder . "/photo", 0777, true);
				mkdir($mainfolder . "/sign", 0777, true);
			}
		} else {
			$mainfolder = '';
		}

		$status = '0';

		//when table created successfully inserted, insert new record on sscsr_db_table_master
		$stmt = $pdo->prepare("INSERT INTO public.sscsr_db_table_master(table_name, table_exam_short_name, table_exam_year, status,table_type,asset_path) VALUES (?,?,?,?,?,?)");
		$stmt->execute(array($table_name, $exam_short_code, $exam_year, $status, $table_type, $mainfolder));

		$message = array(
			'response' => array(
				'status' => 'success',
				'code' => '1',
				'message' => 'Table Created Successfully.',
				'title' => $title
			)
		);
	} catch (Exception $e) {


		if ($e->getCode() == '42P07') {
			$message = array(
				'response' => array(
					'status' => 'error',
					'code' => '0',
					'message' => 'Already Exists',
					'title' => $title
				)
			);
		} else {
			$message = array(
				'response' => array(
					'status' => 'error',
					'code' => '0',
					'message' => $e->getMessage(),
					'title' => 'Error'
				)
			);
		}
	}
	echo json_encode($message);
} else {
	header("Location: index.php");
	exit();
}