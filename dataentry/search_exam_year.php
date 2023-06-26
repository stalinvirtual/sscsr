<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {



    //get matched data 
    try {
        @$q = ($_GET['q']) ? $_GET['q'] : "";
        $sql = "select distinct(table_exam_year) as year from sscsr_db_table_master   WHERE table_exam_year LIKE '%" . $q . "%'  ORDER BY table_exam_year DESC";
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
                'id' => $insdata->year,
                'text' => $insdata->year
            );
    }

    echo json_encode($searchData);
} else {

    header("Location: index.php");
    exit();
}