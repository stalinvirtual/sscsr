<?php
 
namespace App\Models;
 
use App\System\DB\DB;
use App\System\Route;
 
class NominationArchieveschild extends DB
{
   private $table_name = 'archives.mstnominationarchiveschildtbl';
   public function __construct()
   {
       parent::__construct('archives.mstnominationarchiveschildtbl', 'nomination_child_id');
   }
   public function getNominationchild($parent_id = 0)
   {
       $nominationchildtbllist = $this->select()
           ->from($this->table_name)
           ->where(['p_status' => 1])
           ->get_list();
       return $nominationchildtbllist;
   }
   public function addNominationArchieveschild($data = array())
   {
 
       return $this->insert($data);
   }
 
 
 
 
   public function getNominationArchieveschild($parent_id = 0)
   {
       $nominationchildtbllist = $this->select()
           ->from($this->table_name)
           //->where(['status' => 1])
           ->get_list();
       return $nominationchildtbllist;
   }
}
 
