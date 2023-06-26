<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;
use App\Helpers\Helpers;

class GalleryChild extends DB
{
    private $table_name = 'mstgallerychildtbl';
    public function __construct()
    {
        parent::__construct('mstgallerychildtbl', 'image_id');
    }
	
	public function getGalleryChildList($parent_id = 0){
		
		$galleries = $this->select()
            ->from($this->table_name)
            ->order_by("image_id")
            ->get_list();
        return $galleries;
		
	}
	
	
    public function getNominationchild($parent_id = 0)
    {
        $nominationchildtbllist = $this->select()
            ->from($this->table_name)
            ->where(['status' => 1])
            ->get_list();
        return $nominationchildtbllist;
    }
    public function addGalleryChild($data = array())
    {

        return $this->insert($data);
    }
    public function updateGalleryChild($data = array(), $id = 0)
    {
        return $this->update($data, ['image_id' => $id]);
    }
    public function updateState($data = array(), $id = 0)
    {
        return $this->update($data, ['nomination_child_id' => $id]);
    }
}
