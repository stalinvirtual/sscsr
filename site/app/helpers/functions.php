<?php

//  $base_url =  "http://" . $_SERVER['SERVER_NAME'];

$base_url = "http://14.139.183.34";


$GLOBALS['local_path'] =  $base_url ."/sscsr/dataentry/ftp/";
$GLOBALS['local_path'] =  $base_url ."/sscsr/dataentry/ftp/";

$GLOBALS['pdf_header_image_server_path'] = $base_url ."/sscsr/site/exam_assets/";
$GLOBALS['pdf_header_image_server_path'] = $base_url ."/sscsr/site/exam_assets/";



// $headerImg = $GLOBALS['pdf_header_image_server_path'] ."header.png" ;


//$GLOBALS['local_path'] =  "C:\\xampp\htdocs\\rd\\\security_audit\\dataentry\\ftp//";

$GLOBALS['local_instructions_path'] = "C:\\xampp\htdocs\\sscsr\\dataentry\\important_instructions\\";
//$GLOBALS['local_instructions_path'] = "C:\\xampp\htdocs\\rd\\\security_audit\\dataentry\\important_instructions\\";

$local_bulk_mail = "http://localhost/dataentry/bulkemail";
$local_bulk_mail = "http://localhost/dataentry/bulkemail";
/**
 * @author Stalin
 * @value :  Subject
 */
function valueAdded($str)
{
	$subject_value = explode('\n', $str);
	$subjectStr = '';
	if (is_array($subject_value)) {
		foreach ($subject_value as $value) {
			$subjectStr .=  $value . chr(10);
		}
	} else {
		$subjectStr = $str;
	}


	return $subjectStr;
}
function countSubject($str)
{

	$subject_value = explode('\n', $str);
	return count($subject_value);
}

function getDobFormat($date){
	$var_day = substr($date, 0, 2);
	$var_month = substr($date, 2, 2);
	$var_year = substr($date, 4, 4);
	$final_new_date_format = $var_day . "-" . $var_month . "-" . $var_year;
	return $final_new_date_format;
}


function getDateFormate($date){
	$date = date("d-m-Y", strtotime($date));

	if($date == '01-01-1970'){
		$newdate = 'NA';
	}
	else {
		$newdate = $date;
	}
	return $newdate;

}
function getPresentAddressDetails($str){
	$add_array = explode(',',$str);
	if($add_array[3]=="NA"){
		$add_array[3] = "";
	}
	else{
		$add_array[3] = $add_array[3];

	}
	if($add_array[4]=="NA"){
		$add_array[4] = "";
	}
	else{
		$add_array[4] = $add_array[4];

	}
	if($add_array[5]=="NA"){
		$add_array[5] = "";
	}
	else{
		$add_array[5] = $add_array[5];

	}
	if($add_array[1]=="NA"){
		$add_array[1] = "";
	}
	else{
		$add_array[1] = $add_array[1];

	}
	if($add_array[2]=="NA"){
		$add_array[2] = "";
	}
	else{
		$add_array[2] = $add_array[2];

	}
	if($add_array[0]=="NA"){
		$add_array[0] = "";
	}
	else{
		$add_array[0] = $add_array[0];

	}
	$finalOutput = $add_array[3].",".$add_array[4].",".$add_array[5].",".$add_array[1].",".$add_array[2].",".$add_array[0].".";
	return $finalOutput;
}

function photoPath($data){
	

	$local_path = $GLOBALS["local_path"];
	$exam_shot_name = $data['exam_name']->table_exam_short_name;

	

	$sp_exam = substr($exam_shot_name, 0, 5);
	
	if ($sp_exam == "phase") {

		$sel_post_name  = explode('_', $exam_shot_name);

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

			$result = substr($exam_shot_name, 0, 7);
		} else if (

			$sel_post_name[0] == 'phaseispgraduate' ||
			$sel_post_name[0] == 'phaseisphigher' ||

			$sel_post_name[0] == 'phaseispmatric' ||


			$sel_post_name[0] == 'phasevspgraduate' ||
			$sel_post_name[0] == 'phasevsphigher' ||

			$sel_post_name[0] == 'phasevspmatric'
		) {

			$result = substr($exam_shot_name, 0, 6);
		} else if (

			$sel_post_name[0] == 'phaseiiispgraduate' ||
			$sel_post_name[0] == 'phaseiiisphigher' ||

			$sel_post_name[0] == 'phaseviispmatric' ||


			$sel_post_name[0] == 'phaseviispgraduate' ||
			$sel_post_name[0] == 'phaseviisphigher' ||

			$sel_post_name[0] == 'phaseviispmatric'

		) {

			$result = substr($exam_shot_name, 0, 8);
		} else if (

			$sel_post_name[0] == 'phaseviiispgraduate' ||
			$sel_post_name[0] == 'phaseviiisphigher' ||

			$sel_post_name[0] == 'phaseviiispmatric' ||


			$sel_post_name[0] == 'phaseviiispgraduate' ||
			$sel_post_name[0] == 'phaseviiisphigher' ||

			$sel_post_name[0] == 'phaseviiispmatric'

		) {

			$result = substr($exam_shot_name, 0, 9);
		}

		$exam_folder_path  = $result . '_' . $data['year_of_exam'];
	}
	else{
		$exam_folder_path = $data['exam_name']->table_exam_short_name."_".$data['year_of_exam'];
	}
	$full_photo_path = $local_path.$exam_folder_path.'/photo/';

	

	
	return $full_photo_path;
}

function signPath($data){
	//global $local_path ;

	$local_path = $GLOBALS["local_path"];

	$exam_shot_name = $data['exam_name']->table_exam_short_name;

	

	$sp_exam = substr($exam_shot_name, 0, 5);
	
	if ($sp_exam == "phase") {

		$sel_post_name  = explode('_', $exam_shot_name);

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

			$result = substr($exam_shot_name, 0, 7);
		} else if (

			$sel_post_name[0] == 'phaseispgraduate' ||
			$sel_post_name[0] == 'phaseisphigher' ||

			$sel_post_name[0] == 'phaseispmatric' ||


			$sel_post_name[0] == 'phasevspgraduate' ||
			$sel_post_name[0] == 'phasevsphigher' ||

			$sel_post_name[0] == 'phasevspmatric'
		) {

			$result = substr($exam_shot_name, 0, 6);
		} else if (

			$sel_post_name[0] == 'phaseiiispgraduate' ||
			$sel_post_name[0] == 'phaseiiisphigher' ||

			$sel_post_name[0] == 'phaseviispmatric' ||


			$sel_post_name[0] == 'phaseviispgraduate' ||
			$sel_post_name[0] == 'phaseviisphigher' ||

			$sel_post_name[0] == 'phaseviispmatric'

		) {

			$result = substr($exam_shot_name, 0, 8);
		} else if (

			$sel_post_name[0] == 'phaseviiispgraduate' ||
			$sel_post_name[0] == 'phaseviiisphigher' ||

			$sel_post_name[0] == 'phaseviiispmatric' ||


			$sel_post_name[0] == 'phaseviiispgraduate' ||
			$sel_post_name[0] == 'phaseviiisphigher' ||

			$sel_post_name[0] == 'phaseviiispmatric'

		) {

			$result = substr($exam_shot_name, 0, 9);
		}

		$exam_folder_path  = $result . '_' . $data['year_of_exam'];
	}
	else{
		$exam_folder_path = $data['exam_name']->table_exam_short_name."_".$data['year_of_exam'];
	}

	$full_sign_path = $local_path.$exam_folder_path.'/sign/';
	return $full_sign_path;
}

function instpath(){
	global $local_instructions_path;
	return $local_instructions_path;
}

function emailpath(){
	global $local_bulk_mail;
	return $local_bulk_mail;
}

