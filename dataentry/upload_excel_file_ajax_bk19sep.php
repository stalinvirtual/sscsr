<?php
require_once("config/db.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	require_once("functions.php");
	
	// Python Block
		
		$table_type = substr($_POST['selectedTableFormat'], 3);

		$table_name = $_POST['examname'].'_'.$_POST['exam_year'].'_'.$table_type;

		$table_name = strtolower($table_name);
		
	   $sql = "SELECT count((1)) as ct  FROM INFORMATION_SCHEMA.TABLES where  table_schema =:table_schema and table_name=:table_name";
	   $params = array('table_schema' =>"public","table_name"=>$table_name);
	   $isExists = executeSQlAll($sql ,$params);

		if($isExists[0]->ct == 0){
			
			$message = array(
				'response' => array(
					'status' => 'error',
					'code' => '0', // whatever you want
					'message' => $e->getMessage(),
					'title'=>'Error'
				)
			);
		}
		else{
			 $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = :table_name";
			 $params = array("table_name"=>$table_name);
			 $result = executeSQlAll($sql ,$params);

			 $i=1;
			foreach($result as $row){
				 if($row->column_name == 'id'){ 
				 }
				 else{
					  @$table_columns .= $row->column_name.",";
				$i++;
				 }
			 }


			$table_columns = rtrim($table_columns,',');

			 $j=1;
			foreach($result as $row){
				 if($row->column_name == 'id'){ 
				 }
				 else{
					  @$table_value .= $row->column_name.",";
				$j++;
				 }
			 }


			$table_value = rtrim($table_value,',');



			if(!empty($_FILES["excel_file_attachment"]))  
			{ 



				$tmp_name = $_FILES['excel_file_attachment']['tmp_name'];
				
				$error = $_FILES['excel_file_attachment']['error'];
				$size = $_FILES['excel_file_attachment']['size'];
				$type = $_FILES['excel_file_attachment']['type'];
				$target_dir = 'uploaded_excel_files/';
				$file_name = $_FILES["excel_file_attachment"]["name"];
				$removeExtension = substr($file_name, 0, strrpos($file_name, '.'));
				$final_file =  $target_dir . basename($_FILES["excel_file_attachment"]["name"]);
				

				############ Tier ID Checking Based Exam ###########
				$tier_id = $_POST["selectedtier"];
			 
				if (isset($tier_id) && ($tier_id != 0))
				   {
					try{
					$exam_year = $_POST['exam_year'];
					$id = $table_name.'_'.$tier_id;
					$stmt = $pdo->prepare("insert into sscsr_db_table_tier_master (id,table_name, tier_id, table_exam_year, status) values (?,?,?,?,?)");
					
					$stmt->execute([$id,$table_name,$tier_id,$exam_year,'0']);
					}
					catch(exception $e) {
					  //echo "ex: ".$e; 
					}
				}

				$tier_id = $_POST["selectedtier"];
				$excel_file_attachment_name = $_FILES["excel_file_attachment"]["name"];
				$exam_code =$_POST['examname'].$_POST['exam_year'];
				$exam_code = trim(strtolower($exam_code));

				if (move_uploaded_file($tmp_name, $final_file)) { 
					$dt = date('Y-m-d h:i:s');

					$dataEntryDirectory = dirname(__FILE__);


					$excel_file_attachment_name_path = $dataEntryDirectory."/uploaded_excel_files/".$excel_file_attachment_name;

				
					//echo 'py C:/xampp/htdocs/sscsr/sscsr/dataentry/python/upload_excel_file.py '.$excel_file_attachment_name_path.' '.$table_name.' '.$table_columns.' '.$exam_code.' '.$tier_id.' '.$table_value;

					
					
					$last_line = system('py  '. $dataEntryDirectory.'/python/upload_excel_file_01.py '.$excel_file_attachment_name_path.' '.$table_name.' '.$table_columns.' '.$exam_code.' '.$tier_id.' '.$table_value , $retval);

					// echo 'py  '. $dataEntryDirectory.'/python/upload_excel_file_01.py '.$excel_file_attachment_name_path.' '.$table_name.' '.$table_columns.' '.$exam_code.' '.$tier_id.' '.$table_value , $retval;
				
				}  
			}
		}
	
}
else{
	
	header("Location: index.php"); 
	exit();
}
