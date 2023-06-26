<?php
require_once("config/db.php");
require_once("functions.php");

//get matched data 
try {

    $query = "SELECT count(app_no) as total_candidate FROM ssc_candidate_details_by_exam";
    $result = getAll($query);

} catch (Exception $Ex) {
    echo "Error" . $sql . "</br>" . $ex;
}

$searchData = $result[0]->total_candidate;

echo $searchData;