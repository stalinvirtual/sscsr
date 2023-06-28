<?php
require_once("config/db.php");
require_once("functions.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	if(isset($_POST['table_name']) && $_POST['table_name'] != 'null' )
	{
		
		$sql = "SELECT * FROM sscsr_db_table_master WHERE table_name = :table_name";
		$statement = $pdo->prepare($sql);
		$result = $statement->execute([':table_name' =>	$_POST["table_name"]]);
		$result = $statement->fetchAll();
		
		
			if($result->asset_path !=""){

			$dir = 	$result->asset_path;
			$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
			$files = new RecursiveIteratorIterator($it,
						 RecursiveIteratorIterator::CHILD_FIRST);
			foreach($files as $file) {
				if ($file->isDir()){
					rmdir($file->getRealPath());
				} else {
					unlink($file->getRealPath());
				}
			}
			rmdir($dir); 
			}
			$table_name = $_POST['table_name'];
			$sql1="DELETE FROM sscsr_db_table_master WHERE table_name = :table_name";
		 $statement1 = $pdo->prepare($sql1);
	     $result = $statement1->execute([':table_name' =>	$table_name]);

		// $sql1 = "DELETE  FROM sscsr_db_table_master where table_name in (SELECT tblmaster.table_name FROM sscsr_db_table_master as tblmaster 
		// 	LEFT JOIN sscsr_db_table_tier_master as tblTierMaster ON (tblMaster.table_name = tblTierMaster.table_name) 
		// 	LEFT JOIN sscsr_db_table_city_tier_master as tblCityTierMaster ON (tblMaster.table_name = tblCityTierMaster.table_name)
		// 	WHERE tblmaster.table_name = :table_name)";
		//  $statement1 = $pdo->prepare($sql1);
	    //  $result = $statement1->execute([':table_name' =>	$table_name]);
		if(!$result){
			echo "Error in Deleting the table";
		}else{
			$sql="DELETE FROM sscsr_db_table_tier_master WHERE table_name = :table_name";
		 $statement1 = $pdo->prepare($sql);
	     $result1 = $statement1->execute([':table_name' =>	$table_name]);

		 $sql2="DELETE FROM sscsr_db_table_city_tier_master WHERE table_name = :table_name";
		 $statement2 = $pdo->prepare($sql2);
	     $result2 = $statement2->execute([':table_name' =>	$table_name]);

		 $sql3="DROP TABLE $table_name";
		 $statement3 = $pdo->prepare($sql3);
		 $result3 = $statement3->execute(); 
		 
		}

      

		
		
		
		if(!empty($result))
		{
		  $message = array(
				'response' => array(
					'status' => 'success',
					'code' => '1',
					'message' => 'Table Deleted Successfully.',
					'title'=> $title
				)
			);
			
			echo json_encode($message);
			
		}
	}

}
else{
	
	header("Location: index.php"); 
	exit();
}

?>