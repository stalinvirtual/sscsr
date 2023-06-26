<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class NominationArchieves extends DB
{
    private $table_name = 'archives.mstnominationarchievestbl';
    public function __construct()
    {
        parent::__construct('archives.mstnominationarchievestbl', 'nomination_archieve_id');
    }

    public function addNomination($data = array())
    {

        return $this->insert($data);
    }

    public function lastInsertedId($parent_id = 0)
    {
        $fetch_row  = $this->select('max(nomination_id)')
            ->from("archives.mstnominationarchievestbl")
            ->get_one(DB_ASSOC);
        $lastinsertid = (array)$fetch_row;
        return $lastinsertid;
    }





    public function getNominationsArchievesList()
    {
        // $fetch_all =  $this->select('*')
        //     ->from("mstnominationarchievestbl ")
        //     ->get_list();
        // $lastinsertid = (object)$fetch_all;
        // return $lastinsertid;






        $fetch_all =  $this->select('P.*,category.category_name')
        ->from("archives.mstnominationarchievestbl P ")
        ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
       // ->where(['p_status' => '1'])
       // ->wherecondition("P.effort_from_date > current_date - interval '2 days'")
        ->order_by('P.date_archived desc')
        ->get_list();
         $lastinsertid = (object)$fetch_all;
         return $lastinsertid;
    }


    
    /*****
     * 
     * Nomination Archieves
     * 
     */

    public function nominationArchieves($year,$month)
    { 
        if($month == 'All'){
            $str = <<<TEXT
            to_char("date_archived", 'YYYY')='$year' and p_status = '1'
TEXT;
    $getlist =  $this->select('P.*,category.category_name')
        ->from("archives.mstnominationarchivestbl  P")
        ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
        //->where(['p_status' => '1'])
        ->whereconditionarchieves($str)
        ->order_by('P.date_archived desc')
        ->get_list();

        }
        else{
            $str = <<<TEXT
            to_char("date_archived", 'MM')='$month' and 
            to_char("date_archived", 'YYYY')='$year' and p_status = '1'
TEXT;

   

    $getlist =  $this->select('P.*,category.category_name')
        ->from("archives.mstnominationarchivestbl  P")
        ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
        //->where(['p_status' => '1'])
        ->whereconditionarchieves($str)
        ->order_by('P.date_archived desc')
        ->get_list();

       
            
        }
        
        return  $getlist;

    }
    public function getHomeNominationsList($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name')
            ->from("archives.mstnominationarchivestbl P ")
            ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
            ->where(['p_status' => '1'])
            ->order_by('P.date_archived desc')
            ->get_list();
          
        $lastinsertid = (object)$fetch_all;
        return $lastinsertid;
    }



    
	    // Publish and Unpublished

        public function updateNominationArchivesState($data = array(), $id = 0)
        {
            return $this->update($data, ['nomination_id' => $id]);
        }
        public function deleteNominationArchives($nomination_id = 0)
        {
            $delete_row = $this->delete($nomination_id);
           return $delete_row;
        }
}
