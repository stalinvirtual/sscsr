<?php
require_once("config/db1.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    	//require_once("functions.php");
	if(isset($_POST["table_name"]) && $_POST["table_name"] != 'null' )
	{
/*****
 * 
 * 
 * Try Catch
 */

try{
    $tbl =$_POST["table_name"];
    $sql = "SELECT count(table_name) FROM information_schema.tables where table_name = :table_name";
    $sth = $pdo->prepare($sql);
    $sth->execute([":table_name"=>$tbl]);
    $result = $sth->fetch();

   $count =  $result->count;

   if( $count > 0){

    $message = array(
        'response' => array(
            'status' => 'fail',
            'code' => '1', // whatever you want
            'message' => 'Table Already  Exists.',
            'title' => 'Important Instruction' 
        )
    );

   }
   else{

    $message = array(
        'response' => array(
            'status' => 'success',
            'code' => '1', // whatever you want
            'message' => 'Table Already Exists.',
            'title' => 'Important Instruction'
        )
    );

   }

   echo json_encode($message);  


    
    
}
catch (Exception $e)
{
    $error_code = $e->getCode();
    if( $error_code == 23505){
        $message = array(
            'response' => array(
                'status' => 'already_exists',
                'code' => '0', // whatever you want
                'message' =>'Important Instruction already exists',
                'title'=>'Warning!'
            )
        );
    }else{
        $message = array(
            'response' => array(
                'status' => 'error',
                'code' => '0', // whatever you want
                'message' => "Something Went Wrong:".$e->getCode(),
                'title'=>'Error'
            )
        );
    }

    
} 




 /*****
  * 
TRy Catch



  */







    }
}
else{
	
	header("Location: index.php"); 
	exit();
}




?>