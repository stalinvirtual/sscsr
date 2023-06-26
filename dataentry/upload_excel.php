<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	require_once("functions.php");
	if(!empty($_FILES["excel_file"]))  
	{ 
		$excel_file_name = $_FILES["excel_file"]['name'];
		$exam_id = cleanData($_POST["examname"]);
	  
		// echo '<pre>';
		// print_r($_FILES);
	  
	   $last_line = system('/data/python3/bin/python3.8 /home/apache2438/htdocs/citizen_new/sscsr/office/excel_upload.py '.$excel_file_name.' '.$exam_id , $retval);
		 

		$data =[
			"file_name"=> $excel_file_name,
			"exam_id"=>cleanData($_POST["examname"]),
			
		];
	}

	echo json_encode($data);
}
else{
	
	header("Location: index.php"); 
	exit();
}
?>
