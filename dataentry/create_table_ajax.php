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

			//	echo $newdir;

			$sp_exam = substr($_POST['examname'], 0, 5);

			if ($sp_exam == "phase") {

				$sel_post_name = explode('_', $newdir);

				if (
					$sel_post_name[0] == 'phaseixspgraduate' ||
					$sel_post_name[0] == 'phaseixsphigher' ||

					$sel_post_name[0] == 'phaseixspmatric' ||


					$sel_post_name[0] == 'phaseiispgraduate' ||
					$sel_post_name[0] == 'phaseiisphigher' ||

					$sel_post_name[0] == 'phaseiispmatric' ||

					$sel_post_name[0] == 'phaseivspgraduate' ||
					$sel_post_name[0] == 'phaseivsphigher' ||

					$sel_post_name[0] == 'phaseivspmatric' ||

					$sel_post_name[0] == 'phasevispgraduate' ||
					$sel_post_name[0] == 'phasevisphigher' ||

					$sel_post_name[0] == 'phasevispmatric'
				) {

					$result = substr($newdir, 0, 7);
				} else if (

					$sel_post_name[0] == 'phaseispgraduate' ||
					$sel_post_name[0] == 'phaseisphigher' ||

					$sel_post_name[0] == 'phaseispmatric' ||


					$sel_post_name[0] == 'phasevspgraduate' ||
					$sel_post_name[0] == 'phasevsphigher' ||

					$sel_post_name[0] == 'phasevspmatric'
				) {

					$result = substr($newdir, 0, 6);
				} else if (

					$sel_post_name[0] == 'phaseiiispgraduate' ||
					$sel_post_name[0] == 'phaseiiisphigher' ||

					$sel_post_name[0] == 'phaseviispmatric' ||


					$sel_post_name[0] == 'phaseviispgraduate' ||
					$sel_post_name[0] == 'phaseviisphigher' ||

					$sel_post_name[0] == 'phaseviispmatric'

				) {

					$result = substr($newdir, 0, 8);
				} else if (

					$sel_post_name[0] == 'phaseviiispgraduate' ||
					$sel_post_name[0] == 'phaseviiisphigher' ||

					$sel_post_name[0] == 'phaseviiispmatric' ||


					$sel_post_name[0] == 'phaseviiispgraduate' ||
					$sel_post_name[0] == 'phaseviiisphigher' ||

					$sel_post_name[0] == 'phaseviiispmatric'

				) {

					$result = substr($newdir, 0, 9);
				}

				//echo $result;
				//exit;

				$newdir = cleanData($result) . '_' . cleanData($_POST['exam_year']);


				// For Normal Exam 


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

				//echo '@@@@@@@@@@'.$path;
				//exit;	

				//echo $path;

				//exit;

				if (is_dir($path)) //or using the single  line code if(is_dir($dir))
				{
					$mainfolder = 'ftp/' . $newdir;
					//echo $mainfolder;
				} else {
					mkdir($path, 0777, true);
					$mainfolder = 'ftp/' . $newdir;
					mkdir($mainfolder . "/photo", 0777, true);
					mkdir($mainfolder . "/sign", 0777, true);
				}
			} else {

				// For Normal Exam 


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
			}
		} else {
			$mainfolder = '';
		}

		$status = '0';

		//echo $mainfolder;
		//exit;

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