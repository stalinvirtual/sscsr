<?php
/**
 * postgre sql driver 
 */
namespace App\System\DB;

use App\System\DB\Base;

class PgSql implements Base
{
    public $conn;
    public function __construct()
    {
    } //

    public function connect($host, $port, $db, $user, $password)
    {
        $connection_string = "host = $host port = $port dbname = $db user = $user password=$password";

      //  echo $connection_string;
        $this->conn = pg_connect($connection_string);
    }
    public function execute($sql)
    {
		

        @$result = pg_query($this->conn, $sql);
	if( $result ){
		return $result;
	} else {
		echo "Error Executing Query: ";
		die(pg_last_error());
	}
	
    }
    public function fetch($result, $result_type = null)
    {

        switch ($result_type) {
            case DB_OBJECT: {
                    $return  = pg_fetch_object($result);
                    break;
                }
            case DB_ARRAY: {
                    $return  = pg_fetch_array($result);
                    break;
                }
            case DB_ASSOC: {
                    $return  = pg_fetch_assoc($result);
                    break;
                }

            case DB_ROW: {
                    $return  = pg_fetch_row($result);
                    break;
                }
            default: {
                    $return  = pg_fetch_object($result);
                }
        }
        return $return;
    }
}
