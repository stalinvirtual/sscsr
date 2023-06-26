<?php
require_once("config/db.php");
require_once("functions.php");
$column_name = $_POST['column_name'];
$column_description = $_POST['column_description'];
$myCheckboxes = $_POST['myCheckboxes'];
$is_kyas = '0';
$is_tier = '0';
$is_skill = '0';
$is_dme = '0';
$is_pet = '0';
$is_dv = '0';
$parameter_value = "col_id,col_name, col_datatype, col_description, is_kyas, is_tier,is_skill,is_dme,is_pet,is_dv";
$column_value = "";
foreach ($myCheckboxes as $val) {
	if ($val == "kyas_add") {
		$query = "select max(is_kyas_order) from column_master";
		$output = getSingleRow($query);
		$is_kyas = 1;
		$is_kyas_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_kyas_order";
		$column_value .= ",'$is_kyas_order_no'";
	}
	if ($val == "tier_add") {
		$is_tier = '1';
		$query = "select max(is_tier_order) from column_master";
		$output = getSingleRow($query);
		$is_tier_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_tier_order";
		$column_value .= ",'$is_tier_order_no'";
	}
	if ($val == "skill_add") {
		$is_skill = '1';
		$query = "select max(is_skill_order) from column_master";
		$output = getSingleRow($query);
		$is_skill_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_skill_order";
		$column_value .= ",'$is_skill_order_no'";
	}
	if ($val == "dme_add") {
		$is_dme = '1';
		$query = "select max(is_dme_order) from column_master";
		$output = getSingleRow($query);
		$is_dme_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_dme_order";
		$column_value .= ",'$is_dme_order_no'";
	}
	if ($val == "pet_add") {
		$is_pet = '1';
		$query = "select max(is_pet_order) from column_master";
		$output = getSingleRow($query);
		$is_pet_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_pet_order";
		$column_value .= ",'$is_pet_order_no'";
	}
	if ($val == "dv_add") {
		$is_dv = '1';
		$query = "select max(is_dv_order) from column_master";
		$output = getSingleRow($query);
		$is_dv_order_no = ($output->max == null) ? 1 : $output->max + 1;
		$parameter_value .= ",is_dv_order";
		$column_value .= ",'$is_dv_order_no'";
	}
}
try {
	// $sql = "insert into column_master (col_name, col_datatype, col_description, is_kyas, is_tier,is_skill,is_pet,is_dv,is_tier_order, status) values ('$column_name','text','$column_description','$is_kyas','$is_tier','$is_skill','$is_pet','$is_dv','$is_tier_order_no','0')";
	$query = "select max(col_id) from column_master";
	$output = getSingleRow($query);
	$col_id = ($output->max == null) ? 1 : $output->max + 1;
	$sql = "insert into column_master ($parameter_value,status) values ('$col_id','$column_name','text','$column_description','$is_kyas','$is_tier','$is_skill','$is_dme','$is_pet','$is_dv' $column_value,'0')";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$message = array(
		'response' => array(
			'status' => 'success',
			'code' => '1',
			// whatever you want
			'message' => 'Column Created Successfully.',
			'title' => "success"
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