<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Notice extends DB
{
    private $table_name = 'notices';
    public function __construct()
    {
        parent::__construct('notices', 'notice_id');
    }
	
	 public function getNoticeList($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->order_by("notice_id")
            ->get_list();
        return $pages;
    }
    public function getNoticeby($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyNotice($type);
        } else {
            return $this->select()->from($this->table_name)->where(['notice_id' => $id])->get_one($type);
        }
    }
    
    public function getEmptyNotice($type = null)
    {
        $empty_menu  = [
            'notice_id' => 0,
            'pdf_name ' => '',
            'attachment ' => '',
			'effect_from_date ' => '',
			'effect_to_date ' => '',
            'p_status ' => '',
			'category_id'=>'',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addNotice($data = array())
    {

        return $this->insert($data);
    }
    public function updateNotice($data = array(), $id = 0)
    {
        return $this->update($data, ['notice_id' => $id]);
    }
	
	
    public function getCategoryNominations($parent_id = 0)
    {
        $categories = $this->select()
            ->from($this->table_name)
			->where(['show_in_nomination' => 1,'show_in_selection_post' => 0,'status' => 1])
            ->get_list();
        return $categories;
    }
	 public function getCategorySelectionPosts($parent_id = 0)
    {
        $categories = $this->select()
            ->from($this->table_name)
			->where(['show_in_nomination' => 0,'show_in_selection_post' => 1,'status' => 1])
            ->get_list();
        return $categories;
    }
	public function getNotice()
    {
        $fetch_all =  $this->select('P.*,category.category_name')
        ->from("notices P ")
        ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
        ->where(['p_status' => 1])
        ->order_by('P.effect_from_date desc')
        ->get_list();
        return  $fetch_all;
    }

    /***
     * 
     * 
     * Notice For Latest News
     * 
     */
    public function getNoticeLatestNews()
    {
        $fetch_all =  $this->select('P.*,category.category_name')
        ->from("notices P ")
        ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
        ->where(['p_status' => 1])
        
        ->order_by('P.effect_from_date desc')
        ->fetchtwo('fetch first 2 rows only')
        ->get_list();
        return  $fetch_all;
    }
    public function getNoticeDashboard()
    {
        $fetch_all =  $this->select('P.*,category.category_name')
        ->from("notices P ")
        ->join("mstcategory category ","P.category_id = category.category_id ","JOIN")
        ->order_by('P.effect_from_date desc')
        ->get_list();
        return  $fetch_all;
    }
	
	// Publish and Unpublished
	
	 public function updateNoticeState($data = array(), $id = 0)
    {
        return $this->update($data, ['notice_id' => $id]);
    }


    public function deleteNoticeStatus($page_id = 0)
    {
        $delete_row = $this->delete($page_id);
       return $delete_row;
    }
}
