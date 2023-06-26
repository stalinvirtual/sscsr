<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class EventCategory extends DB
{
    private $table_name = 'msteventcategory';
    public function __construct()
    {
        parent::__construct('msteventcategory', 'event_id');
    }
	

	
	 public function getEventCategoriesList($parent_id = 0)
    {
        $importantLinks_list  = $this->select()
        ->from("msteventcategory")
        ->order_by("event_id desc")
        ->get_list();
       
       return $importantLinks_list;
    }

    public function getEventCategoriesListDropdown($parent_id = 0)
    {
        $importantLinks_list  = $this->select()
        ->from("msteventcategory")
        ->where(['status'=>1])
        ->order_by("event_id desc")
        ->get_list();
       
       return $importantLinks_list;
    }
	
	
	
	
	
	public function getEventCategoryby($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyEventCategory($type);
        } else {
            return $this->select()->from($this->table_name)->where(['event_id' => $id])->get_one($type);
        }
    }
	
	  public function getEmptyEventCategory($type = null)
    {
        $empty_event_category  = [
            'id' => 0,
            'event_name ' => '',
			'creation_date ' => '',
            'status ' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_event_category = (object) $empty_event_category;
        }
        return $empty_event_category;
    }
	
	 public function addEventCategory($data = array())
    {

        return $this->insert($data);
    }
    public function updateEventCategory($data = array(), $id = 0)
    {
        return $this->update($data, ['event_id' => $id]);
    }
	
	/*  public function getImportantLinksList($parent_id = 0)
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
		$sql = "select * from importantlinks  order by creation_date desc";
        $ImportantLinkss_list = $this->set_query($sql)->get_list();
        return $ImportantLinkss_list;
    }
	 public function getHomePageImportantLinksListFirstFourRowsOnly()
    {
		$sql = "select * from importantlinks where status ='1' FETCH FIRST 4 ROW ONLY";
        $ImportantLinkss_list = $this->set_query($sql)->get_list();
        return $ImportantLinkss_list;
    }
	
	 public function getHomePageImportantLinksListAfterFirstFourRowsOnly()
    {
		$sql = "select * from importantlinks where status ='1' OFFSET 4 ROWS FETCH FIRST 4 ROW ONLY";
        $ImportantLinkss_list = $this->set_query($sql)->get_list();
        return $ImportantLinkss_list;
    }
	
	// Publish and Unpublished
	
	 public function updateImportantLinksState($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    } */


    public function deleteEventCategory($eventcategory_id = 0)
    {
        $delete_row = $this->delete($eventcategory_id);
       return $delete_row;
    }

    // Publish and Unpublished
	
	 public function updateEventCategoryState($data = array(), $id = 0)
     {
         return $this->update($data, ['event_id' => $id]);
     }
}
