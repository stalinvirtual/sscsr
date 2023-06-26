<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Tender extends DB
{
    private $table_name = 'tendertbl';
    public function __construct()
    {
        parent::__construct('tendertbl', 'tender_id');
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
        ->from("tendertbl ")
        ->order_by('effect_from_date desc')
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

   

    public function copyTender($tender_id = 0)
    {
        echo $sql = "INSERT INTO public.tendertbl (pdf_name, attachment, effect_from_date, effect_to_date, p_status ) 
        SELECT pdf_name, attachment, effect_from_date, effect_to_date, '0'
       FROM public.tendertbl WHERE tender_id=$tender_id";
        return $this->execute( $sql );
       
    }

/***
 * 
 * PHP AJAX Data Table on 18-sep-2022
 * 
 * 
 */

public function deleteTender($tender_id = 0)
{
   $delId = explode(",", $tender_id);
   foreach ($delId as $val) {
       $delete_row =  $this->delete($val);
   }
   return $delete_row;
}
public function totalRecordsWithOutFiltering()
   {
 
       $fetch_all =  $this->select('count(*) as allcount')
           ->from("tendertbl")
           ->get_one();
       $count = $fetch_all;
       return $count;
   }

  public function totalRecordsWithFiltering($searchQuery)
   {
 
 
       if ($searchQuery == " ") {
           $finalquery = <<<HTML
 
     '1'
HTML;
 
       }
       else{
 
           $finalquery = <<<HTML
 
           '1' and $searchQuery
HTML;
 
       }
       $fetch_all =  $this->select('count(*) as allcount')
           ->from("tendertbl")
           ->whereconditiondatatable($finalquery)
           ->get_one();
       $count = $fetch_all;
       return $count;
   }
   public function getTenderDetails($year, $month, $effect_from_date, $effect_to_date, $searchQuery)
   {
       if ($month == 'All') {
 
           if ($searchQuery == " ") {
               $str = <<<TEXT
               to_char("effect_to_date", 'YYYY')='$year'
TEXT;
           } else {
               $str = <<<TEXT
               to_char("effect_to_date", 'YYYY')='$year' and  $searchQuery
TEXT;
           }
 
           $getlist =  $this->select('*')
               ->from("tendertbl")
               ->whereconditionarchieves($str)
               ->order_by('effect_to_date desc')
               ->get_list();
       } else {
 
           if ($searchQuery == " ") {
               $str = <<<TEXT
               to_char("effect_to_date", 'MM')='$month' and
               to_char("effect_to_date", 'YYYY')='$year' and
               effect_from_date >='$effect_from_date' and
               effect_to_date <= '$effect_to_date'
TEXT;
           }
           else{
               $str = <<<TEXT
               to_char("effect_to_date", 'MM')='$month' and
               to_char("effect_to_date", 'YYYY')='$year' and
               effect_from_date >='$effect_from_date' and
               effect_to_date <= '$effect_to_date'  $searchQuery
TEXT;
 
           }
           $getlist =  $this->select('*')
               ->from("tendertbl")
               ->whereconditionarchieves($str)
               ->order_by('effect_to_date desc')
               ->get_list();
       }
       return  $getlist;
   }

   public function checkTenderId($id)
   {
       $fetch_all =  $this->select('count(*) as checkid')
           ->from("tendertbl")
           ->where(['tender_id' => $id])
           ->get_one();
       $count = $fetch_all;
       return $count;
   }
   public function archiveTenderStatus($tender_id = 0)
   {
       if (is_array($tender_id)) {
           $tender_id = implode(",", $tender_id);
       }
       $sql = "INSERT INTO archives.tenderarchivestbl (tender_id, pdf_name,effect_from_date, effect_to_date, p_status, date_archived ) 
       SELECT tender_id, pdf_name,effect_from_date, effect_to_date, '0', NOW()
      FROM public.tendertbl WHERE tender_id IN ($tender_id)";
       $delete_row = $this->execute($sql);
       
       $delId = explode(",", $tender_id);
       foreach ($delId as $val) {
           $this->delete($val);
       }
       return $delete_row;
   }

   /***
 * 
 * PHP AJAX Data Table on 18-sep-2022
 * 
 * 
 */




}
