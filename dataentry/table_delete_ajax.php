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
		

        $sql2="DROP TABLE $table_name";
		$statement2 = $pdo->prepare($sql2);
		$result = $statement2->execute(); 
		

		
		
		
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