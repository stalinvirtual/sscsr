<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Category extends DB
{
    private $table_name = 'mstcategory';
    public function __construct()
    {
        parent::__construct('mstcategory', 'category_id');
    }
	
	 public function getCategoryList($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->order_by("category_id")
            ->get_list();
        return $pages;
    }
    public function getCategoryby($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyCategory($type);
        } else {
            return $this->select()->from($this->table_name)->where(['category_id' => $id])->get_one($type);
        }
    }
    
    public function getEmptyCategory($type = null)
    {
        $empty_menu  = [
           // 'category_id' => 0,
            'category_name' => '',
            'show_in_selection_post' => '',
			'show_in_nomination' => '',
			'creation_date' => '',
            'status' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addCategory($data = array())
    {

        return $this->insert($data);
    }
    public function updateCategory($data = array(), $id = 0)
    {
        return $this->update($data, ['category_id' => $id]);
    }
    public function getCategoryNominations($parent_id = 0)
    {
        $categories = $this->select()
            ->from($this->table_name)
			->where(['show_in_nomination' => 1,'show_in_selection_post' => 0,'status' => 1])
            ->order_by('nomination_order asc')
            ->get_list();
           
        return $categories;
    }
	 public function getCategorySelectionPosts($parent_id = 0)
    {
        $categories = $this->select()
            ->from($this->table_name)
			->where(['show_in_nomination' => 0,'show_in_selection_post' => 1,'status' => 1])
            ->order_by('selection_post_order  asc')
            ->get_list();
           
        return $categories;
    }
	 public function getCategory()
    {
        $catecory_list  = $this->select()
        ->from("mstcategory")
        ->order_by("category_id desc")
        ->get_list();
        return $catecory_list;
    }

    public function deleteCategory($category_id = 0)
    {
        $delete_row = $this->delete($category_id);
       return $delete_row;
    }


     // Publish and Unpublished
	
	 public function updateCategoryState($data = array(), $id = 0)
     {
         return $this->update($data, ['category_id' => $id]);
     }


     // Reorder Nomination

    public function reorderNomination()
    {

        $nomination = $this->select()
            ->from($this->table_name)
            ->where(['show_in_nomination' => 1,'show_in_selection_post'=>0,'status'=>1])
            ->order_by("nomination_order asc")
            ->get_list();

        return $nomination;
    }
    public function updatereorderNomination($data = array(), $category_id = 0)
    {
        return $this->update($data, ['category_id' => $category_id]);
    }
	
	
	// Reorder Nomination




      // Reorder Selection Post

      public function reorderSelectionPost()
      {
  
          $nomination = $this->select()
              ->from($this->table_name)
              ->where(['show_in_nomination' => 0,'show_in_selection_post'=>1,'status'=>1])
              ->order_by("selection_post_order asc")
              ->get_list();
  
          return $nomination;
      }
      public function updatereorderSelectionPost($data = array(), $category_id = 0)
      {
          return $this->update($data, ['category_id' => $category_id]);
      }
      
      
      // Reorder Selection Post
	
}
