<?php
require_once("config/db.php");
require_once("functions.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	if(isset($_POST['exam_name']) && $_POST['exam_name'] != 'null' )
	{
		
					
			$exam_name = $_POST['exam_name'];
			$sql1="DELETE FROM exam_master WHERE exam_name = :exam_name";
		 $statement1 = $pdo->prepare($sql1);
	     $result = $statement1->execute([':exam_name' =>	$exam_name]);

		if(!empty($result))
		{
		  $message = array(
				'response' => array(
					'status' => 'success',
					'code' => '1',
					'message' => 'Exam Deleted Successfully.'
					
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