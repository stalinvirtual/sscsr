<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    //get matched data 
    try {
        @$q = ($_GET['q']) ? $_GET['q'] : "";
        $sql = "SELECT exam_name,exam_short_name from exam_master WHERE exam_name LIKE '%" . $q . "%'  ORDER BY exam_id DESC";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        /*var_dump($sql);*/

    } catch (Exception $Ex) {
        echo "Error" . $sql . "</br>" . $ex;
    }



    $searchData;
    foreach ($result as $insdata) {
        $searchData[] =
            array(
                'id' => $insdata->exam_short_name,
                'text' => $insdata->exam_name . ' (' . $insdata->exam_short_name . ')'
            );
    }

    echo json_encode($searchData);
} else {
    header("Location: index.php");
    exit();
}