<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;
use App\Helpers\Helpers;

class ImportantLinks extends DB
{
    private $table_name = 'importantlinks';
    public function __construct()
    {
        parent::__construct('importantlinks', 'id');
    }
	
	 public function getImportantLinksList($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->order_by("id")
            ->get_list();
        return $pages;
    }
    public function getImportantLinksby($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyImportantLinks($type);
        } else {
            return $this->select()->from($this->table_name)->where(['id' => $id])->get_one($type);
        }
    }
    
    public function getEmptyImportantLinks($type = null)
    {
        $empty_menu  = [
            'id' => 0,
            'link_name ' => '',
            'menu_link ' => '',
			'creation_date ' => '',
            'status ' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addImportantLinks($data = array())
    {

        return $this->insert($data);
    }
    public function updateImportantLinks($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    }
	

	 public function getImportantLinks()
    {
        $results  = $this->select()
        ->from("importantlinks")
        ->order_by("creation_date desc")
        ->get_list();
        return $results;
    }
	 public function getHomePageImportantLinksListFirstFourRowsOnly()
    {
      /***
       * Author:@stalin
       * Subject: Testing Query 
       * Date : 07-04-2022
       * 
       */

        /***  End Test Query */
         $results  = $this->select()
         ->from("importantlinks")
         ->where(['status'=>'1'])
         ->fetchfour('FETCH FIRST 5 ROW ONLY')
         ->get_list();
        return $results;
    }
	
	 public function getHomePageImportantLinksListAfterFirstFourRowsOnly()
    {
        $results  = $this->select()
        ->from("importantlinks")
        ->where(['status'=>'1'])
        ->fetchfour('OFFSET 4 ROWS FETCH FIRST 4 ROW ONLY')
        ->get_list();
       return $results;
    }
	
	// Publish and Unpublished
	
	 public function updateImportantLinksState($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    }

    public function deleteImportantLinksStatus($il_id = 0)
    {
        $delete_row = $this->delete($il_id);
       return $delete_row;
    }
}
