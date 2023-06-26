<?php
require_once("config/db.php");

// For Local Purpose 
$base_url = "http://" . $_SERVER['SERVER_NAME'];
$GLOBALS['local_path'] = $base_url . "/projects/sscsr/site/IndexController/admitcardpreview";

//For Online Purpose

// $base_url =  "localhost";
// $GLOBALS['local_path'] =  "http://10.163.2.160/projects/site/IndexController/admitcardpreview";


function cleanData($val)
{
	return pg_escape_string($val);
}
function printr($data)
{
	echo '<pre>';
	print_r($data);
	exit;
}

function getAll($query)
{
	global $pdo;
	$result = $pdo->prepare($query);
	$result->execute();
	return $result->fetchAll();
}
function getRowCount($query, $id = "")
{
	global $pdo;
	$result = $pdo->prepare($query);
	if ($id == "") {
		$result->execute();
	} else {
		$result->execute([$id]);
	}

	$number_of_rows = $result->fetchColumn();
	return $number_of_rows;
}
function getSingleRow($query, $id = "")
{
	global $pdo;
	$result = $pdo->prepare($query);

	if ($id == "") {
		$result->execute();
	} else {
		$result->execute([$id]);
	}
	return $result->fetch();
}

function executeSQlAll($sql, $params)
{
	global $pdo;
	$stmt = $pdo->prepare($sql);
	$stmt->execute($params);
	$result = $stmt->fetchAll();
	return $result;
}
function executeSQlAllCount($sql, $params)
{
	global $pdo;
	$stmt = $pdo->prepare($sql);
	$stmt->execute($params);
	$result = $stmt->fetchColumn();
	return $result;
}
function executeSQl($sql, $params)
{
	global $pdo;
	$stmt = $pdo->prepare($sql);
	$stmt->execute($params);
	$result = $stmt->fetch();
	return $result;

}

function getAccecptedCandidates($year)
{

	global $pdo;
	$like_value = $year . '_kyas';
	$sql_query = "
					SELECT
					table_name,
					cnt_rows(table_schema, table_name) as total_count
					FROM
					information_schema.tables
					WHERE
					table_type = 'BASE TABLE' and table_name  LIKE '%$like_value%'
					AND
					table_schema NOT IN ('pg_catalog', 'information_schema')";

	$stmt = $pdo->query($sql_query);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach ($result as $key => $value) {

		if ($value->total_count > 0) {
			$table_name = $value->table_name;
			$sql_query = "SELECT  count(*) as accepted, exam_code, $value->total_count as total FROM $table_name where status_accept_reject ='ACCEPTED'  group by exam_code";
			$stmt = $pdo->query($sql_query);
			$stmt->execute();
			$accepted_count[] = $stmt->fetch();
		}


	}
	return $accepted_count;


}

function getRejectedCandidates($year)
{

	global $pdo;
	$like_value = $year . '_kyas';
	$sql_query = "
					SELECT
					table_name,
					cnt_rows(table_schema, table_name) as total_count
					FROM
					information_schema.tables
					WHERE
					table_type = 'BASE TABLE' and table_name  LIKE '%$like_value%'
					AND
					table_schema NOT IN ('pg_catalog', 'information_schema')";

	$stmt = $pdo->query($sql_query);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach ($result as $key => $value) {

		if ($value->total_count > 0) {
			$table_name = $value->table_name;
			$sql_query = "SELECT  count(*) as rejected, exam_code, $value->total_count as total FROM $table_name where status_accept_reject ='REJECTED'  group by exam_code";
			$stmt = $pdo->query($sql_query);
			$stmt->execute();
			$accepted_count[] = $stmt->fetch();
		}


	}
	return $accepted_count;


}

function getKyasTableCount($kyas_table)
{
	global $pdo;
	$sql = "SELECT count(*) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema =:table_schema and table_name=:table_name";
	$params = array('table_schema' => 'public', 'table_name' => $kyas_table);

	$result = executeSQl($sql, $params);
	if ($result->count == 1) {

		$sql1 = "SELECT count(*) as count  FROM $kyas_table where  status_accept_reject =:status_accept_reject";
		$params1 = array('status_accept_reject' => 'ACCEPTED');
		$applicable = executeSQl($sql1, $params1);



		$sql2 = "SELECT count(*) as count  FROM $kyas_table where  status_accept_reject =:status_accept_reject";
		$params2 = array('status_accept_reject' => 'REJECTED');
		$notapplicable = executeSQl($sql2, $params2);



		$tablecount = array(
			"applicable" => $applicable->count,
			"notapplicable" => $notapplicable->count,
		);

	} else {
		$tablecount = array(
			"applicable" => 0,
			"notapplicable" => 0,
		);

	}
	return $tablecount;

}


function getListOfcandidate($tier_table, $tier)
{
	global $pdo;
	$sql1 = "SELECT count(*) as count  FROM $tier_table where tier_id =:tier_id";
	$params1 = array('tier_id' => $tier);
	$result1 = executeSQl($sql1, $params1);
	if ($result1->count != 0) {
		$sql = "SELECT * FROM $tier_table where tier_id =:tier_id";
		$params = array('tier_id' => $tier);
		$result = executeSQlAll($sql, $params);
		return $result;
	} else {
		return false;
	}
}



function isCandidateDataExists($tier_table, $tier)
{

	global $pdo;
	$sql = "SELECT count(*) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema =:table_schema and table_name=:table_name";
	$params = array('table_schema' => 'public', 'table_name' => $tier_table);
	$result = executeSQl($sql, $params);
	if ($result->count == 1) {
		$sql1 = "SELECT count(*) as count  FROM $tier_table where tier_id =:tier_id";
		$params1 = array('tier_id' => $tier);
		$result1 = executeSQl($sql1, $params1);
		if ($result1->count == 1) {
			$tier_table_count = array(
				"table_name" => $tier_table,
				"tier_id" => $tier,
				"is_exits" => true,
				"msg" => "Exits",
			);
		} else {
			$tier_table_count = array(
				"table_name" => $tier_table,
				"tier_id" => $tier,
				"is_exits" => false,
				"msg" => "Not Exits",
			);
		}

	} else {
		$tier_table_count = array(
			"table_name" => $tier_table,
			"tier_id" => $tier,
			"is_exits" => false,
			"msg" => "Table Not Exits",
		);
	}

	return $tier_table_count;
}

function getTierTableCount($tier_table)
{

	global $pdo;
	$sql = "SELECT count(*) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema =:table_schema and table_name=:table_name";
	$params = array('table_schema' => 'public', 'table_name' => $tier_table);
	$result = executeSQl($sql, $params);
	if ($result->count == 1) {

		$sql1 = "SELECT count(*) as count  FROM $tier_table where  tier_id =:tier_id";
		$params1 = array('tier_id' => '1');
		$tier1_result = executeSQl($sql1, $params1);


		$sql2 = "SELECT count(*) as count  FROM $tier_table where  tier_id =:tier_id";
		$params2 = array('tier_id' => '2');
		$tier2_result = executeSQl($sql2, $params2);



		$sql3 = "SELECT count(*) as count  FROM $tier_table where  tier_id =:tier_id";
		$params3 = array('tier_id' => '3');
		$tier3_result = executeSQl($sql3, $params3);



		$sql4 = "SELECT count(*) as count  FROM $tier_table where  tier_id =:tier_id";
		$params4 = array('tier_id' => '4');
		$tier4_result = executeSQl($sql4, $params4);

		$tablecount = array(
			"tier1" => $tier1_result->count,
			"tier2" => $tier2_result->count,
			"tier3" => $tier3_result->count,
			"tier4" => $tier4_result->count,
		);

	} else {
		$tablecount = array(
			"tier1" => 0,
			"tier2" => 0,
			"tier3" => 0,
			"tier4" => 0,
		);

	}
	return $tablecount;

}
function getKyasAllTableCount($exam_name)
{

	global $pdo;


	$sql_query = "
SELECT
     table_name,
	 cnt_rows(table_schema, table_name)
FROM
    information_schema.tables
WHERE
    table_type = 'BASE TABLE' and table_name  LIKE '%_kyas%'
AND
    table_schema NOT IN ('pg_catalog', 'information_schema')";
	$stmt = $pdo->query($sql_query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	//print_r($result);

	$sum = 0;
	foreach ($result as $key => $value) {
		$sum += $value->cnt_rows;
	}

	$array = array(

		"kyas_records" => $result,
		"kyas_count" => $sum

	);

	return $array;
}

function getKyasAllTableCountByYear($year)
{

	global $pdo;
	$like_value = $year . '_kyas';
	$sql_query = "
					SELECT
					table_name,
					cnt_rows(table_schema, table_name), 0 as photo, 0 as signature
					FROM
					information_schema.tables
					WHERE
					table_type = 'BASE TABLE' and table_name  LIKE '%$like_value%'
					AND
					table_schema NOT IN ('pg_catalog', 'information_schema')";

	$stmt = $pdo->query($sql_query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $key => $value) {
		$foldername = explode('_kyas', $value->table_name);
		$asset_path = getcwd() . "/ftp/" . $foldername[0] . $foldername[1];
		$photo_path = $asset_path . "/photo/";
		$sign_path = $asset_path . "/sign/";
		$photo_count = checkFileCount($photo_path);
		$sign_count = checkFileCount($sign_path);
		$value->photo = $photo_count;
		$value->signature = $sign_count;
	}
	return $result;
}

//get table row count
function getkyasRowCount($exam_name, $exam_year, $table_subname)
{
	global $pdo;

	$table_name = $exam_name . '_' . $exam_year . '_' . $table_subname;

	$newtablename = strtolower($table_name);

	$sql = "SELECT count(*) as rowcount  FROM $newtablename";

	$stmt = $pdo->query($sql);
	$stmt->execute();
	return $result = $stmt->fetch();

}

//function for check if table exists or not
function isExists($exam_name, $exam_year, $table_subname)
{
	global $pdo;
	$table_name = $exam_name . '_' . $exam_year . '_' . $table_subname;
	$newtablename = strtolower($table_name);
	$sql = "SELECT count(*) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema =:table_schema and table_name=:table_name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['table_schema' => 'public', 'table_name' => $newtablename]);
	$result = $stmt->fetch();
	return $result;


}

// check file count inside the ftp assests
function checkFileCount($path)
{

	// Initialize filecount variavle
	$filecount = 0;
	$files2 = glob($path . "*");
	if ($files2) {
		$filecount = count($files2);
	}
	return $filecount;
}
function isTableAlreadyExists($table_name)
{
	global $pdo;
	$sql = "SELECT count((1)) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema ='public' and table_name = :table_name";
	$params = array('table_name' => $table_name);
	$result = executeSQl($sql, $params);
	return $result->count;
}
function getSingleRowBasedTier($table_name, $kyas_table_name, $tier_id)
{
	global $pdo;

	$sql = "SELECT kd.reg_no,kd.exam_code,kd.cand_name,kd.dob,kd.photo_id,kd.sign_id, kd.gender,kd.category,
	CONCAT(kd.present_address,kd.present_district,kd.present_state,kd.present_pincode) as candidate_address, 
	CONCAT(ted.venue_name,ted.venue_address) as examvenue1, 
	CONCAT(ted.venue_district,ted.venue_state) as examvenue2, 
	ted.scribe_opted_medium,ted.roll_no,ted.ticket_no,ted.repotime,ted.gateclose,
	ted.paper1 as paper1,ted.subject1 as subject1,
	ted.date1 as date1,ted.time1 as time1,
	ted.shift1 as shift1,ted.mark1 as mark1,
	ted.paper2 as paper2,ted.subject2 as subject2,
	ted.date2 as date2,ted.time2 as time2,
	ted.shift2 as shift2,ted.mark2 as mark2,
	ted.paper3 as paper3,ted.subject3 as subject3,
	ted.date3 as date3,ted.time3 as time3,
	ted.shift3 as shift3,ted.mark3 as mark3,
	ted.paper4 as paper4,ted.subject4 as subject4,
	ted.date4 as date4,ted.time4 as time4,
	ted.shift4 as shift4,ted.mark1 as mark4,
	t.tier_name, t.tier_id FROM $kyas_table_name  kd 
	JOIN $table_name ted ON kd.reg_no = ted.reg_no and kd.exam_code = ted.exam_code
	JOIN tier_master t ON ted.tier_id = cast(t.tier_id as char(255))
			where ted.tier_id = '$tier_id' LIMIT 1";


	$stmt = $pdo->query($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	return $result;
}
function valueAdded($str)
{
	$subject_value = explode('\n', $str);
	$subjectStr = '';
	if (is_array($subject_value)) {
		foreach ($subject_value as $value) {
			$subjectStr .= $value . chr(10);
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
function getExamName($exam_name, $exam_year)
{
	global $pdo;
	$sql = "SELECT distinct(tm.table_exam_short_name),
	tm.table_exam_year,
	em.exam_name
	FROM public.sscsr_db_table_master tm 
JOIN exam_master em ON tm.table_exam_short_name = em.exam_short_name where tm.table_exam_short_name = :table_exam_short_name and table_exam_year=:table_exam_year";

	//$sql = "SELECT count((1)) as count  FROM INFORMATION_SCHEMA.TABLES where table_schema ='public' and table_name = :table_name";
	$params = array('table_exam_short_name' => $exam_name, 'table_exam_year' => $exam_year);
	$result = executeSQl($sql, $params);
	return $result;


}



function selectionpost_shortcode_tablename($examname, $exam_year, $table_type)
{

	$needle = '/';
	if (strpos($examname, $needle) !== false) {
		$array = explode('/', $examname);
		$word = $array[0] . "_" . $exam_year . "_" . "sp" . "_" . $array[3];

		$myArray2 = explode("-", $word);

		$word2 = $myArray2[0] . "_" . $myArray2[1];
		$examName = strtolower($word2) . '_' . $table_type;

	} else {
		$examName = $examname . '_' . $exam_year . '_' . $table_type;

	}

	return $examName;

}

function selectionpost_shortcode_folder($examname, $exam_year)
{

	$needle = '/';
	if (strpos($examname, $needle) !== false) {
		$array = explode('/', $examname);
		$word = $array[0] . "_" . $exam_year . "_" . "sp" . "_" . $array[3];

		$myArray2 = explode("-", $word);

		$word2 = $myArray2[0] . "_" . $myArray2[1];
		$examName = strtolower($word2);

	} else {
		$examName = $examname . '_' . $exam_year;

	}

	return $examName;

}


function selectionpost_shortcode_name($examname, $exam_year)
{

	$needle = '/';
	if (strpos($examname, $needle) !== false) {
		$array = explode('/', $examname);
		$word = $array[0] . "_" . $exam_year . "_" . "sp" . "_" . $array[3];

		$myArray2 = explode("-", $word);

		$word2 = $myArray2[0] . "_" . $myArray2[1];
		$examName = strtolower($word2);

	} else {
		$examName = $examname;

	}

	return $examName;

}
function sanitize_string_value($param)
{
	$return_value = filter_var($param, FILTER_SANITIZE_STRING);
	return $return_value;
}

?>