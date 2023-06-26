<?php
require_once("functions.php");
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    $year = $_POST['year'];
    $results = getRejectedCandidates($year);
    // $rejected_percentage = ($results[0]->accepted/$results[0]->total)*100;
// $exam_code = substr($results[0]->exam_code, 0, -4);

    foreach ($results as $result) {
        $rejected_percentage = round(($result->rejected / $result->total) * 100, 2);
        $exam_code = substr($result->exam_code, 0, -4);
        $output[] = array(
            "y" => $rejected_percentage,
            "label" => $exam_code,
            "indexLabel" => $rejected_percentage . "%",
            "indexLabelFontSize" => 11,
            "indexLabelFontColor" => "#000",
            "indexLabelFontFamily" => "tahoma",
            "indexLabelFontWeight" => "bold",
            "indexLabelPlacement" => "inside",
            "indexLabelWrap" => true,
            "indexLabelOrientation" => "vertical",
            "indexLabelBackgroundColor" => "#c0504e"
        );
    }






    echo json_encode($output);
} else {
    header("Location: index.php");
    exit();
}