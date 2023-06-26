<?php

require_once("config/db.php");




if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	//require_once("functions.php");
	if(isset($_POST["table_name"]) && $_POST["table_name"] != 'null' )
	{

        $tbl =$_POST["table_name"];
        $sql = "SELECT table_name FROM information_schema.tables where table_name = :table_name";
        $sth = $pdo->prepare($sql);
        $sth->execute([":table_name"=>$tbl]);
        $result = $sth->fetch();
        $sqlScript = "";

        $table  = $result->table_name;
        $query = "SELECT generate_create_table_statement( '$table' )";
        $sth = $pdo->prepare($query);
        $sth->execute();
        $row_result = $sth->fetch();
        $sqlScript .= "\n\n" . $row_result->generate_create_table_statement . ";\n\n";

       

            $query = <<<TEXT
            select table_name, count(*) as column_count from information_schema."columns" where table_schema = 'public' 
            and table_name='cgle_2019_dv' GROUP by table_name order by column_count desc;
TEXT;
        $sth = $pdo->prepare($query);
        $sth->execute();
        $columnCountResult = $sth->fetch();
        $columnCount =  $columnCountResult->column_count;
        $host = "localhost";
        $user = "postgres";
        $password = "stalinthomas";
        $dbname = "sscsr";
        $port = "5432";
        $con = pg_connect("host=$host dbname=$dbname user=$user password=$password")
            or die ("Could not connect to server\n");
        $query = "SELECT * FROM $table";
        $result = pg_query($con, $query);

        for ($i = 0; $i < $columnCount; $i ++) {
          while ($row = pg_fetch_row($result)) {
              $sqlScript .= "INSERT INTO $table VALUES(";
              for ($j = 0; $j < $columnCount; $j ++) {
                  $row[$j] = $row[$j];
               if (isset($row[$j])) {



                      $sqlScript .= "'" . pg_escape_string($row[$j]) . "'";
                  } else {
                      $sqlScript .= '""';
                  }
                  if ($j < ($columnCount - 1)) {
                      $sqlScript .= ',';
                  }
              }
              $sqlScript .= ");\n";
          }
      }

      if(!empty($sqlScript))
      {
        $database_name = "archieves";
          // Save the SQL script to a backup file
          $backup_file_name =  $database_name.'_backup_' . time() . '.sql';
          $fileHandler = fopen($backup_file_name, 'w+');
          $number_of_lines = fwrite($fileHandler, $sqlScript);
          fclose($fileHandler); 
       // Download the SQL backup file to the browser
          // header('Content-Description: File Transfer');
          // header('Content-Type: application/octet-stream');
          // header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
          // header('Content-Transfer-Encoding: binary');
          // header('Expires: 0');
          // header('Cache-Control: must-revalidate');
          // header('Pragma: public');
          // header('Content-Length: ' . filesize($backup_file_name));
          // ob_clean();
          // flush();
         // readfile($backup_file_name);
         // exec('rm ' . $backup_file_name); 

          require_once("config/db1.php");
          

          $sql = file_get_contents($backup_file_name);
       
          if($pdo->exec($sql)){



          $message = array(
            'response' => array(
              'status' => 'success',
              'code' => '1',
              'message' => 'Table Archieved  Successfully.',
              'title'=> 'stalin'
            )
          );
          echo json_encode($message);  
        }


         
      
        
         
       
      }  


	
	}


  
 

}
else{
	
	header("Location: index.php"); 
	exit();
}



?>