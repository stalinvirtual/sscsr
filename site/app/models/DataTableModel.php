<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class DataTableModel extends DB
{
    private $table_name = 'notices';
    public function __construct()
    {
        parent::__construct('notices', 'notice_id');
    }
	
	
/***
 * 
 * PHP AJAX Data Table on 18-sep-2022
 * 
 * 
 */

public function delete($id = 0)
{
   $delId = explode(",",$id);
   foreach ($delId as $val) {
       $delete_row =  $this->delete($val);
   }
   return $delete_row;
}
public function totalRecordsWithOutFiltering()
   {
 
       $fetch_all =  $this->select('count(*) as allcount')
           ->from($this->table)
           ->get_one();
       $count = $fetch_all;
       return $count;
   }

  public function totalRecordsWithFiltering($searchQuery)
   {
       if ($searchQuery == " ") {
           $finalquery = "'1'";
 
       }
       else{
 
           $finalquery = " '1' and $searchQuery"; 
       }
       $fetch_all =  $this->select('count(*) as allcount')
           ->from("notices P")
           ->join("mstcategory c ","P.category_id = c.category_id ","JOIN")
           ->whereconditiondatatable($finalquery)
           ->get_one();
       $count = $fetch_all;
       return $count;
   }
   public function getRecords($year, $month, $effect_from_date, $effect_to_date, $searchQuery)
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
           $getlist =  $this->select('P.*,c.*')
               ->from("notices P")
               ->join("mstcategory c ","P.category_id = c.category_id ","JOIN")
               ->whereconditionarchieves($str)
               ->order_by('P.effect_to_date desc')
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

echo $str;
 
           }
           $getlist =  $this->select('P.*,c.*')
               ->from("notices P ")
               ->join("mstcategory c ","P.category_id = c.category_id ","JOIN")
               ->whereconditionarchieves($str)
               ->order_by('P.effect_to_date desc')
               ->get_list();
       }
       return  $getlist;
   }

   public function checkNoticeId($id)
   {
       $fetch_all =  $this->select('count(*) as checkid')
           ->from("notices")
           ->where(['notice_id' => $id])
           ->get_one();
       $count = $fetch_all;
       return $count;
   }
   public function archiveNoticeStatus($notice_id = 0)
   {
       if (is_array($notice_id)) {
           $notice_id = implode(",", $notice_id);
       }
       $sql = "INSERT INTO archives.noticesarchivestbl (notice_id,category_id, pdf_name,effect_from_date, effect_to_date, p_status, date_archived ) 
       SELECT notice_id, category_id,pdf_name,effect_from_date, effect_to_date, '0', NOW()
      FROM public.notices WHERE notice_id IN ($notice_id)";
       $delete_row = $this->execute($sql);
       
       $delId = explode(",", $notice_id);
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
