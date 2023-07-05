<?php
include __DIR__ . '/db.php';
date_default_timezone_set("Asia/Calcutta"); 
$query =  "select 
dtm.no_of_days,
dbm.table_name,
dbm.table_type,
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


//    echo '<pre>';
//    print_r($records );
//    exit;

  
    foreach( $records as $record ){
		if ($record->table_type == 'tier') {
			
			$tier_id =  $record->tier_id;
			if($tier_id == '1'){
				
				$sqlExamDate = "SELECT date1::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name 
			where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
<<<<<<< HEAD
			//echo $sqlExamDate;
			//exit;
=======
>>>>>>> d32e4936a63e4205af7cc0fc81ae7b7b49e06a0b
				
			}
			else if($tier_id == '2'){
				
				$sqlExamDate = "SELECT distinct LEAST((SELECT MIN(date) FROM (VALUES (date1::date-INTEGER '$record->no_of_days'), 
				(date2::date-INTEGER '$record->no_of_days'),
						(date3::date-INTEGER '$record->no_of_days'),
						(date4::date-INTEGER '$record->no_of_days')) AS statusupdateddate(date))) as  statusupdateddate
						FROM $record->table_name 
					  where tier_id = '$record->tier_id' and (date1::date-INTEGER '$record->no_of_days') > now()  and date1 !='NA'  
and date2 !='NA'  and date3 !='NA' and date4 !='NA' limit 1";
				
				
			
			}
			
		}
		 else if ($record->table_type == 'skill') {
			 $sqlExamDate = "SELECT skill_test_date::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name 
			where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
			
			
		}
		else if ($record->table_type == 'dme') {
			 $sqlExamDate = "SELECT date1::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name 
			where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
			
			
		}
		else if ($record->table_type == 'pet') {
			 $sqlExamDate = "SELECT date1::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name 
			where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
			
			
		}
		else if ($record->table_type == 'dv') {
			 $sqlExamDate = "SELECT dv_date::date - INTEGER '$record->no_of_days' as statusupdateddate FROM $record->table_name 
			where tier_id = '$record->tier_id' and date1::date > now() order by id asc limit 1";
			
			
		}
		
		
        
<<<<<<< HEAD
     // echo $sqlExamDate;
=======
      //echo $sqlExamDate;
>>>>>>> d32e4936a63e4205af7cc0fc81ae7b7b49e06a0b
	  //exit;
        $resultExamDate =  $pdo->prepare($sqlExamDate);
        $resultExamDate->execute();
        $recordDate = $resultExamDate->fetch();
        // print_r( $recordDate);
        echo "\n";

        //$date = "2023-02-13";

        $date  = date("Y-m-d");
        echo "Current Date : " . $date."<br>";

<<<<<<< HEAD
        echo  "Status Updated Date: ".@$recordDate->statusupdateddate."<br>";
=======
        echo  "Status Updated Date: ".$recordDate->statusupdateddate."<br>";
>>>>>>> d32e4936a63e4205af7cc0fc81ae7b7b49e06a0b



        if( $date  == @$recordDate->statusupdateddate ){
            // write your logic to update the status
            echo "Updating the status of sscsr_db_table_tier_master#$record->tier_master_id\n";
            $updateQuery = "UPDATE public.sscsr_db_table_tier_master SET  status='1', updated_on = NOW() WHERE id='$record->tier_master_id'";
            $stmt = $pdo->prepare($updateQuery);
			$stmt->execute();
        }
        
    }

?>