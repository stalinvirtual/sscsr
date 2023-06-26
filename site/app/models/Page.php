<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Page extends DB
{
    private $table_name = 'pagemaster';
    public function __construct()
    {
        parent::__construct('pagemaster', 'page_id');
    }
    public function getPages($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
			
            ->order_by("page_id desc")
            ->get_list();
	return $pages;
    }
    public function getPage($page_id = 0, $type = null)
    {
        if ($page_id == 0) {
            return $this->getEmptyPage($type);
        } else {
            return $this->select()->from($this->table_name)->where(['page_id' => $page_id])->get_one($type);
        }
    }
    // public function getMenuByAlias($alias)
    // {
    //     echo $alias . " ===";
    //     $menu =  $this->select()->from($this->table_name)->where(['m_menu_link' => $alias])->get_one();
    //     echo $this->last_query;
    //     return $menu;
    // }
    public function getEmptyPage($type = null)
    {
        $empty_menu  = ['page_id' => 0, 'page_content' => '', 'title' => '', 'status' => 0,'last_content'=>''];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addPage($data = array())
    {

 


        return $this->insert($data);

// echo $this->last_query;
    }
    public function updatePage($data = array(), $page_id = 0)
    {
        return $this->update($data, ['page_id' => $page_id]);
    }
    public function deletePage($page_id = 0)
    {
        $delete_row = $this->delete($page_id);
       return $delete_row;
    }
    public function pageDetails($menu_page_id)
    {
        $fetch_row  = $this->select('page_id,title')
        ->from("pagemaster")
        ->where(['page_id'=>$menu_page_id])
        ->get_one(DB_ASSOC);
        return  $fetch_row ;

    }
	// Publish and Unpublished
	 public function getPagesPublished($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->where(['status' => 1])
            ->order_by("page_id desc")
            ->get_list();
        return  $pages;
    }
    public function getPagesUnpublished($parent_id = 0)
    {
         $pages = $this->select()
            ->from($this->table_name)
             ->where(['status' => 0])
            ->order_by("page_id desc")
            ->get_list();
        return  $pages;
    }
	// Publish and Unpublished
	
	 public function updatePageState($data = array(), $id = 0)
    {
        return $this->update($data, ['page_id' => $id]);
    }

	
}
