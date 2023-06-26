<?php
require_once("config/db.php");
require_once("functions.php");
require_once("PdfHelper.php");
/* 


echo '<pre>';
print_r($_POST);
exit; */

$table_name = strtolower($_POST['examname']) . "_" . $_POST['exam_year'] . '_' . "tier";
$kyas_table_name = strtolower($_POST['examname']) . "_" . $_POST['exam_year'] . '_' . "kyas";
$ftp_photo_sign_folder = $_POST['examname'] . "_" . $_POST['exam_year'];
$tier_id = $_POST['selectedtier'];
$isTableAlreadyExists = isTableAlreadyExists($table_name);
$exam_name = $_POST['examname'];
$exam_year = $_POST['exam_year'];
$getExamName = getExamName($exam_name, $exam_year);



if ($isTableAlreadyExists == '1') {
    $data = getSingleRowBasedTier($table_name, $kyas_table_name, $tier_id);

    print_r($data);
    exit;
    PdfHelper::genereateAndDownloadAdminCard($data, $ftp_photo_sign_folder, $getExamName);
    $date = date("Y-m-d h:i:sa");
    $file_name_with_date = $data->reg_no . "-" . $date;


    try {

        $message = array(
            'status' => 'success',
            'code' => '1',
            // whatever you want
            'pdf_name' => $file_name_with_date,
            'message' => 'Image file inserted successfully.',
            'title' => 'Important Instruction'

        );
    } catch (Exception $e) {

        $message = array(
            'status' => 'error',
            'code' => '0',
            // whatever you want
            'message' => "Something Went Wrong:" . $e->getCode(),
            'title' => 'Error'
        );
    }
} else {
    $message = array(
        'status' => 'error',
        'code' => '0',
        // whatever you want
        'message' => "Table Not Exists:",
        'title' => 'Error'
    );
}
echo json_encode($message);

?>