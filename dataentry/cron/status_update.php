<?php
include __DIR__ . '/db.php';
date_default_timezone_set("Asia/Calcutta"); 
$query =  "select 
dtm.no_of_days,
dbm.table_name,
dtm.tier_id as tier_id,
dtm.id as tier_master_id
from exam_master em 
join sscsr_db_table_master dbm on em.exam_short_name = dbm.table_exam_short_name
join sscsr_db_table_tier_master dtm on dbm.table_name = dtm.table_name
join tier_master tm on cast(dtm.tier_id as char(255)) =  cast(tm.tier_id as char(255)) 
where dtm.stop_status = '0' AND dtm.status = '0' order by dbm.table_exam_year desc,dtm.tier_id asc ";

// echo "process started at " . date("Y-m-d H:i:s") . "\n";
// echo "Starting with query " . $query . "\n";
    $result = $pdo->prepare($query);
    $result->execute();
    
   $records = $result->fetchAll();

  
    foreach( $records as $record ){
        $sqlExamDate = "SELECT date1::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
      
        $resultExamDate =  $pdo->prepare($sqlExamDate);
        $resultExamDate->execute();
        $recordDate = $resultExamDate->fetch();
        // print_r( $recordDate);
        echo "\n";

        //$date = "2023-02-13";

        $date  = date("Y-m-d");
        echo "Current Date : " . $date."\n";

        echo  "Status Updated Date: ".$recordDate->statusupdateddate."\n";



        if( $date  == $recordDate->statusupdateddate ){
            // write your logic to update the status
            echo "Updating the status of sscsr_db_table_tier_master#$record->tier_master_id\n";
            $updateQuery = "UPDATE public.sscsr_db_table_tier_master SET  status='1', updated_on = NOW() WHERE id='$record->tier_master_id'";
            $stmt = $pdo->prepare($updateQuery);
			$stmt->execute();
        }
        
    }

?>