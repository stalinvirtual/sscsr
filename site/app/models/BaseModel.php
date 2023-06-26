<?php
namespace App\Models;

use App\System\DB\DB;
class BaseModel extends DB{
    protected $table_name;
    protected $primary_key;

    public function __construct($table, $primaryKey){

        parent::__construct($table, $primaryKey);
    }

    public function delete( $id = 0 ){
        $this->delete( $id );
    }

}