<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class TenderArchives extends DB
{
    private $table_name = 'archives.tenderarchivestbl';
    public function __construct()
    {
        parent::__construct('archives.tenderarchivestbl', 'tender_id');
    }
	
	 public function getTenderList($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->order_by("tender_id")
            ->get_list();
        return $pages;
    }
    public function getTenderby($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyTender($type);
        } else {
            return $this->select()->from($this->table_name)->where(['tender_id' => $id])->get_one($type);
        }
    }
    
    public function getEmptyTender($type = null)
    {
        $empty_menu  = [
            'tender_id' => 0,
            'pdf_name ' => '',
            'attachment ' => '',
			'effect_from_date ' => '',
			'effect_to_date ' => '',
            'p_status ' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addTender($data = array())
    {

        return $this->insert($data);
    }
    public function updateTender($data = array(), $id = 0)
    {
        return $this->update($data, ['tender_id' => $id]);
    }
	

	 public function getTender()
     {
    $fetch_all =  $this->select()
        ->from("archives.tenderarchivestbl ")
        ->order_by('date_archived desc')
        ->get_list();
        return $fetch_all;
    }
	 public function getHomePageTenderList()
    {
        $fetch_all =  $this->select()
        ->from("tendertbl ")
        ->where(['p_status'=>1])
        ->order_by('effect_from_date desc')
        ->get_list();
        return $fetch_all;
    }


    /*****
     * Tender For Latest News
     * 
     */
    public function getHomePageTenderListLatestNews()
    {
        $fetch_all =  $this->select()
        ->from("tendertbl ")
        ->where(['p_status'=>1])
        //->wherecondition("effect_from_date > current_date - interval '2 days'")
        ->order_by('effect_from_date desc')
        ->fetchtwo('fetch first 2 rows only')
        ->get_list();
        return $fetch_all;
    }
	
	// Publish and Unpublished
	
	 public function updateTenderState($data = array(), $id = 0)
    {
        return $this->update($data, ['tender_id' => $id]);
    }

    
    public function deleteTenderStatus($tender_id = 0)
    {
        $delete_row = $this->delete($tender_id);
       return $delete_row;
    }

    // Publish and Unpublished
   
    public function updateTenderArchivesState($data = array(), $id = 0)
    {
        return $this->updateRawQuery("archives.tenderarchivestbl", $data, ['tender_id' => $id]);
    }





    public function tenderArchievesByMonth($year,$month)
    { 
        if($month == 'All'){
            $str = <<<TEXT
            to_char("date_archived", 'YYYY')='$year' 
TEXT;
    $getlist =  $this->select('P.*')
        ->from(" archives.tenderarchivestbl P")
        ->whereconditionarchieves($str)
        ->order_by('P.date_archived desc')
        ->get_list();

        }
        else{
            $str = <<<TEXT
            to_char("date_archived", 'MM')='$month' and 
            to_char("date_archived", 'YYYY')='$year'
TEXT;

   

    $getlist =  $this->select('P.*')
        ->from("archives.tenderarchivestbl P")
        ->whereconditionarchieves($str)
        ->order_by('P.date_archived desc')
        ->get_list();
        }
        
        return  $getlist;

    }



    public function tenderByMonth($year,$month,$effect_from_date ,$effect_to_date)
    { 
        if($month == 'All'){
            $str = <<<TEXT
            to_char("effect_to_date", 'YYYY')='$year' 
TEXT;
    $getlist =  $this->select('P.*')
        ->from(" tendertbl P")
        ->whereconditionarchieves($str)
        ->order_by('P.effect_to_date desc')
        ->get_list();

        }
        else{
            $str = <<<TEXT
            to_char("effect_to_date", 'MM')='$month' and 
            to_char("effect_to_date", 'YYYY')='$year' and
            effect_from_date >='$effect_from_date' and
            effect_to_date <= '$effect_to_date'

TEXT;

   

    $getlist =  $this->select('P.*')
        ->from("tendertbl P")
        ->whereconditionarchieves($str)
        ->order_by('P.effect_to_date desc')
        ->get_list();
        }
        
        return  $getlist;

    }

}
