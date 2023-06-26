<?php
require_once ("functions.php");
require_once ("config/db.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
  
$year_value =   $_POST['year'] ;
$year       = sanitize_string_value($year_value);
$results    = getKyasAllTableCountByYear($year);
echo json_encode($results);
}
else{
    header("Location: index.php"); 
	exit();
}

