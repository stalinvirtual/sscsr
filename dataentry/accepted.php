<?php
require_once("functions.php");
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    $year = $_POST['year'];
    $results = getAccecptedCandidates($year);
    // $accepted_percentage = ($results[0]->accepted/$results[0]->total)*100;
// $exam_code = substr($results[0]->exam_code, 0, -4);
    foreach ($results as $result) {
        $accepted_percentage = round(($result->accepted / $result->total) * 100, 2);
        $exam_code = substr($result->exam_code, 0, -4);
        $output[] = array(
            "y" => $accepted_percentage,
            "label" => $exam_code,
            "indexLabel" => $accepted_percentage . "%",
            "indexLabelFontSize" => 11,
            "indexLabelFontColor" => "#000",
            "indexLabelFontFamily" => "tahoma",
            "indexLabelFontWeight" => "bold",
            "indexLabelPlacement" => "inside",
            "indexLabelWrap" => true,
            "indexLabelOrientation" => "vertical",
            "indexLabelBackgroundColor" => "#4f81bc"
        );
    }
    echo json_encode($output);
    echo hi;
    
} else {
    header("Location: index.php");
    exit();
}