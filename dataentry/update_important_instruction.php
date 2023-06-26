<?php 
require_once("config/db.php");

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{

        require_once("functions.php");

		$important_instructions_id =  cleanData($_POST['examname']).cleanData($_POST['exam_year']).'_'.cleanData($_POST['selectedtier']);
		$exam_code = cleanData($_POST['examname']).cleanData($_POST['exam_year']);
		$exam_code = strtolower($exam_code);
		
		$exam_tier =   cleanData($_POST['selectedtier']);
	
		if(!empty($_FILES["image_file_attachment"]))  
	{ 



		$tmp_name = $_FILES['image_file_attachment']['tmp_name'];
		
		$error = $_FILES['image_file_attachment']['error'];
		$size = $_FILES['image_file_attachment']['size'];
		$type = $_FILES['image_file_attachment']['type'];
		$target_dir = 'important_instructions/';
		$temp_file_name = $_FILES["image_file_attachment"]["name"];
		
		$temp = explode(".", $temp_file_name);
		$file_name = $important_instructions_id.'.' . end($temp) ;
		
		
		
		$removeExtension = substr($file_name, 0, strrpos($file_name, '.'));
		$final_file =  $target_dir . basename($file_name);
		
		
		//$modefile = "home/apache2438/htdocs/citizen_new/sscsr/office/".$final_file;
		
		$pdf_attachment  =$file_name ;
		
       if(file_exists($final_file)){
			unlink($final_file);
			if (move_uploaded_file($tmp_name, $final_file)) { 
				$message = array(
					'response' => array(
						'status' => 'success',
						'code' => '1', // whatever you want
						'message' => 'PDF file inserted successfully.',
						'title' => 'Important Instruction'
					)
				);
			} 
		 
		}
	
		
	}
	

echo json_encode($message); 
}
else{
	
	header("Location: index.php"); 
	exit();
}
?>