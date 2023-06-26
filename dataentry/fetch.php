<?php

require_once("functions.php");
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    $year = sanitize_string_value($_GET['year']);
    $exam_code = sanitize_string_value($_GET['exam_code']);

    $table_name = $exam_code . "_" . $year . "_kyas";
    $exam_type = sanitize_string_value($_GET['exam_type']);
    $status = strtoupper($exam_type);

    $sql_query = "SELECT reg_no,cand_name,gender FROM $table_name WHERE status_accept_reject ='$status' ";

    $stmt = $pdo->query($sql_query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $key => $value) {

        $rt[] = [$value->reg_no, $value->cand_name, $value->gender];
    }

    $array = array(
        array(
            "COLUMNS" => array(
                array("title" => "Register No"),
                array("title" => "Candidate Name"),
                array("title" => "Gender")
            ),
            "DATA" => $rt
        ),

    );

    echo json_encode($array);
} else {
    header("Location: index.php");
    exit();
}