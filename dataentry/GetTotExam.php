<?php
require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    $exam_name = cleanData($_POST["examname"]);
    $exam_year = cleanData($_POST["examyear"]);
    ####### Kyas Table Count ###############
    $kyas_table = $exam_name . "_" . $exam_year . "_kyas";
    $kyas_table = strtolower($kyas_table);
    $kyas_table_count = getKyasTableCount($kyas_table);
    ####### Kyas Table Count ###############
    ####### Tier Table Count ###############
    $tier_table = $exam_name . "_" . $exam_year . "_tier";
    $tier_table = strtolower($tier_table);
    $tier_table_count = getTierTableCount($tier_table);
    ####### Tier Table Count ###############


    $response = array(
        "applicable" => $kyas_table_count['applicable'],
        "notapplicable" => $kyas_table_count['notapplicable'],
        "tier1" => $tier_table_count['tier1'],
        "tier2" => $tier_table_count['tier2'],
        "tier3" => $tier_table_count['tier3'],
        "tier4" => $tier_table_count['tier4'],
        "status" => "success"
    );

    echo json_encode($response);

} else {

    header("Location: index.php");
    exit();
}