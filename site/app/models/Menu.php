<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Menu extends DB
{
    private $table_name = 'mstmenu';
    public function __construct()
    {
        parent::__construct('mstmenu', 'id');
    }

    public function getAllPublishedMenus($parent_id = 0)
    {
        $results  = $this->select("c.*,p.menu_name as parent_name")
            ->from("mstmenu c")
            ->join("mstmenu p ", "c.menu_parent_id=p.id", " LEFT JOIN")
            ->where(['c.status' => 1])
            ->order_by("c.id")
            ->get_list();
        return $results;
    }
    public function getMenusForPublish($parent_id = 0)
    {
        $menus = $this->select()
            ->from($this->table_name)
            ->where(['status' => 1, 'is_footer_menu' => 'false'])
            ->order_by("menu_order")
            ->get_list();
        $route = new Route();

        foreach ($menus as $key => $menu) {
            if ($menu->menu_type == '2') {
                $menu->menu_full_url = $menu->menu_link;
            } else if ($menu->menu_type == '3') {
                $menu->menu_full_url = 'uploads/' . $menu->attachment;
            } else {
                $menu->menu_full_url = $route->site_url($menu->menu_link);
            }
            $menus[$key] = $menu;
        }
        return $menus;
    }

    public function getFooterMenusForPublish($parent_id = 0)
    {
        $menus = $this->select()
            ->from($this->table_name)
            ->where(['status' => 1, 'is_footer_menu' => 'true'])
            ->order_by("menu_order")
            ->get_list();



        $route = new Route();

        foreach ($menus as $key => $menu) {
            if ($menu->menu_type == '2') {
                $menu->menu_full_url = $menu->menu_link;
            } else if ($menu->menu_type == '3') {
                $menu->menu_full_url = 'uploads/' . $menu->attachment;
            } else {
                $menu->menu_full_url = $route->site_url($menu->menu_link);
            }
            $menus[$key] = $menu;
        }
        return $menus;
    }

    public function getMenus($parent_id = 0)
    {
        $menus = $this->select()
            ->from($this->table_name)
            ->where(['status' => 0])
            ->order_by("menu_order")
            ->get_list();
        $route = new Route();


        foreach ($menus as $key => $menu) {
            if ($menu->menu_type == '2') {
                $menu->menu_full_url = $menu->menu_link;
            } else if ($menu->menu_type == '3') {
                $menu->menu_full_url = 'uploads/' . $menu->attachment;
            } else {
                $menu->menu_full_url = $route->site_url($menu->menu_link);
            }
            $menus[$key] = $menu;
        }
        return $menus;
    }
    public function getMenusDropdown($parent_id = 0)
    {
        $menus = $this->select()
            ->from($this->table_name)
            ->get_list();
        $route = new Route();


        foreach ($menus as $key => $menu) {
            if ($menu->menu_type == '2') {
                $menu->menu_full_url = $menu->menu_link;
            } else if ($menu->menu_type == '3') {
                $menu->menu_full_url = 'uploads/' . $menu->attachment;
            } else {
                $menu->menu_full_url = $route->site_url($menu->menu_link);
            }
            $menus[$key] = $menu;
        }
        return $menus;
    }
    public function getMenu($menu_id = 0, $type = null)
    {
        if ($menu_id == 0) {
            return $this->getEmptyMenu($type);
        } else {
            return $this->select()->from($this->table_name)->where(['id' => $menu_id])->get_one($type);
        }
    }
    public function getMenuByAlias($alias)
    {
        //echo $alias . " ===";
        $menu =  $this->select()->from($this->table_name)->where(['menu_link' => $alias])->get_one();
        // echo $this->last_query;
        return $menu;
    }
    public function getEmptyMenu($type = null)
    {
        $empty_menu  = ['id' => 0, 'menu_parent_id' => 0, 'menu_name' => '', 'menu_link' => '', 'menu_type' => 1, 'menu_page_id' => null, 'menu_route' => null, 'status' => null, 'attachment' => null, 'is_footer_menu' => null, 'is_redirect_popup' => 0];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addMenu($data = array())
    {
        return $this->insert($data);
    }
    public function updateMenu($data = array(), $menu_id = 0)
    {
        return $this->update($data, ['id' => $menu_id]);
    }
    public function deleteMenu($menu_id = 0)
    {

        if ($menu_id == 1) { // Home or Root menu cannot be deleted
            return false;
        }
        // delete the children menu too
        //return $this->where("WHERE id = $menu_id OR menu_parent_id = $menu_id")->delete();


        $db = pg_connect("host=localhost port=5432 dbname=sscsr user=postgres password=stalinthomas");

        $id = $menu_id;

        $sql2 = "DELETE FROM mstmenu WHERE id = '$id' OR menu_parent_id = '$id' ";

        $result = pg_query($sql2);


        if (!$result) {
            return false;
        } else {

            return true;
        }

        //$deletemenu =  $this->where("WHERE id = $menu_id OR menu_parent_id = $menu_id")->delete();
        //echo $this->last_query;
        //exit;
        // return $deletemenu;
    }
    //reorder main menu
    public function reorderMenus()
    {



        $menus = $this->select()
            ->from($this->table_name)
            ->where(['menu_parent_id' => '0'])
            ->order_by("menu_order")
            ->get_list();

        return $menus;
    }
    public function updatereorderMenu($data = array(), $menu_id = 0)
    {
        return $this->update($data, ['id' => $menu_id]);
    }

    //reorder sub menu

    public function reorderSubMenus()
    {


        $menus  = $this->select("c.*, p.menu_name as parent_name")
      ->from("mstmenu c")
      ->join("mstmenu p ", "c.menu_parent_id=p.id", " LEFT JOIN")
      ->where("c.status = 1 and c.is_footer_menu = 'false' and c.menu_parent_id !=0")
      ->order_by("c.menu_order")
      ->get_list();
        return $menus;
    }
    public function updatereorderSubMenu($data = array(), $menu_id = 0)
    {
        return $this->update($data, ['id' => $menu_id]);
    }

    public function lastInsertedID()
    {
        //echo $alias . " ===";
        $menu =  $this->select("MAX(id)")->from($this->table_name)->get_one();

        //echo $this->last_query;
        //exit;
        return $menu;
    }

    public function updateState($data = array(), $id = 0)
    {
        return $this->update($data, ['id' => $id]);
    }


 //reorder sub menu

 public function reorderSubMenusNew()
 {


     $menus  = $this->select("distinct c.menu_parent_id,p.menu_name as parent_name")
   ->from("mstmenu c")
   ->join("mstmenu p ", "c.menu_parent_id=p.id", " LEFT JOIN")
   ->where("c.status = 1 and c.is_footer_menu = 'false' and c.menu_parent_id !=0")
   ->order_by("c.menu_parent_id asc")
   ->get_list();
     return $menus;
 }

 public function reorderSubMenusNewById($id)
 {


     $menus  = $this->select("*")
   ->from("mstmenu ")
   ->where(["menu_parent_id"=>$id])
   ->order_by("menu_order asc")
   ->get_list();
     return $menus;
 }

 public function updatereorderSubMenuNew($data = array(), $menu_id = 0)
    {
        return $this->update($data, ['id' => $menu_id]);
    }





   
}
