<?php
require_once("config/db.php");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {



    //get matched data 
    try {
        @$q = ($_GET['q']) ? $_GET['q'] : "";
        $sql = "SELECT * FROM tier_master WHERE tier_name LIKE '%" . $q . "%'  ORDER BY tier_id";
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
                'id' => $insdata->tier_id,
                'text' => $insdata->tier_name
            );
    }

    echo json_encode($searchData);
} else {

    header("Location: index.php");
    exit();
}