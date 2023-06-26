<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class SelectionpostArchives extends DB
{
    private $table_name = 'archives.mstselectionpostarchivestbl';
    public function __construct()
    {
        parent::__construct('archives.mstselectionpostarchivestbl', 'selection_post_id');
    }
    
   
    
    public function addSelectionpost($data = array())
    {

        return $this->insert($data);
    }
    public function updateSelectionpost($data = array(), $id = 0)
    {
        return $this->update($data, ['selection_post_id' => $id]);
    }
    

    public function lastInsertedId($parent_id = 0)
    {
        $fetch_row  = $this->select('max(selection_post_id)')
        ->from("archives.mstselectionpostarchivestbl")
        ->get_one(DB_ASSOC);
        $lastinsertid = (array)$fetch_row;
        return $lastinsertid;
    }

    

    public function getSelectionPostListAdmin($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name,phase.phase_name')
      ->from("archives.mstselectionpostarchivestbl P ")
      ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
      ->join("mstphase phase ","P.phase_id = phase.phase_id ","JOIN")
      ->order_by('selection_post_id desc')
      ->get_list();
      $lastinsertid = (object)$fetch_all ;
      return $lastinsertid;
    }

    public function getSelectionPostList($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name,phase.phase_name')
      ->from("mstselectionposttbl P ")
      ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
      ->join("mstphase phase ","P.phase_id = phase.phase_id ","JOIN")
      ->where(['P.p_status'=>'1'])
      ->order_by('selection_post_id desc')
      ->get_list();
      $lastinsertid = (object)$fetch_all ;
      return $lastinsertid;
    }

    
    /******
     * 
     * SP For Latest News
     */

    public function getSelectionPostListLatestNews($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name,phase.phase_name')
      ->from("mstselectionposttbl P ")
      ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
      ->join("mstphase phase ","P.phase_id = phase.phase_id ","JOIN")
      ->where(['P.p_status'=>'1'])
      ->order_by('effort_from_date desc')
      ->fetchtwo('fetch first 2 rows only')
      ->get_list();
      $lastinsertid = (object)$fetch_all ;
      return $lastinsertid;
    }


	 public function getHomeSelectionPostList($parent_id = 0)
    {
        $fetch_all =  $this->select('P.*,category.category_name,phase.phase_name')
        ->from("mstselectionposttbl P ")
        ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
        ->join("mstphase phase ","P.phase_id = phase.phase_id ","JOIN")
        ->where(['p_status'=>'1'])
        ->order_by('P.effort_from_date desc limit 10')
        ->get_list();
        $lastinsertid = (object)$fetch_all ;
        return $lastinsertid;
    }
	// Publish and Unpublished
	
	 public function updateSelectionpostState($data = array(), $id = 0)
    {
        return $this->update($data, ['selection_post_id' => $id]);
    }

    public function deleteSelectionPost($sp_id = 0)
    {
        $delete_row = $this->delete($sp_id);
       return $delete_row;
    }



    public function selectionPostArchievesByMonth($year,$month)
    { 
        if($month == 'All'){
            $str = <<<TEXT
            to_char("date_archived", 'YYYY')='$year' and p_status = '1'
TEXT;
    $getlist =  $this->select('P.*,category.category_name')
        ->from("archives.mstselectionpostarchivestbl  P")
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
        ->from("archives.mstselectionpostarchivestbl  P")
        ->join("mstcategory category ", "P.category_id = category.category_id ", "JOIN")
        //->where(['p_status' => '1'])
        ->whereconditionarchieves($str)
        ->order_by('P.date_archived desc')
        ->get_list();

       
            
        }
        
        return  $getlist;

    }

    // Publish and Unpublished
	
	 public function updateSelectionpostArchivesState($data = array(), $id = 0)
     {
         return $this->updateRawQuery("archives.mstselectionpostarchivestbl", $data, ['selection_post_id' => $id]);
     }
}
