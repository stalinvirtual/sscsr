<?php
 
namespace App\Models;
 
use App\System\DB\DB;
use App\System\Route;
 
class Faq extends DB
{
   private $table_name = 'faq';
   public function __construct()
   {
       parent::__construct('faq', 'faq_id');
   }
  
    public function getFaqList($parent_id = 0)
   {
       $pages = $this->select()
           ->from($this->table_name)
           ->order_by("faq_id")
           ->get_list();
       return $pages;
   }
   public function getFaqby($id = 0, $type = null)
   {
       if ($id == 0) {
           return $this->getEmptyFaq($type);
       } else {
           return $this->select()->from($this->table_name)->where(['faq_id' => $id])->get_one($type);
       }
   }
  
   public function getEmptyFaq($type = null)
   {
       $empty_menu  = [
           'faq_id' => 0,
           'faq_title ' => '',
           'faq_content' => '',
           'effect_from_date ' => '',
           'p_status ' => '',
          
       ];
       if ($type == DB_OBJECT) {
           $empty_menu = (object) $empty_menu;
       }
       return $empty_menu;
   }
   public function addFaq($data = array())
   {
 
       return $this->insert($data);
   }
   public function updateFaq($data = array(), $id = 0)
   {
       return $this->update($data, ['faq_id' => $id]);
   }
  
   // Publish and Unpublished
  
    public function updateFaqState($data = array(), $id = 0)
   {
       return $this->update($data, ['faq_id' => $id]);
   }

   public function deleteFaqStatus($page_id = 0)
    {
        $delete_row = $this->delete($page_id);
       return $delete_row;
    }




    public function getFaqDatails($parent_id = 0)
    {
        $faqs = $this->select()
            ->from($this->table_name)
            ->where(['p_status'=>1])
            ->order_by("effect_from_date desc")
            ->get_list();
        return $faqs;
    }
}
