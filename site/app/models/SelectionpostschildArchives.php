<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class SelectionpostschildArchives extends DB
{
    private $table_name = 'archives.mstselectionpostarchiveschildtbl';
    public function __construct()
    {
        parent::__construct('archives.mstselectionpostarchiveschildtbl', 'selection_post_child_id');
    }
    public function getSelectionpostschild($parent_id = 0)
    {
        $nominationchildtbllist = $this->select()
            ->from($this->table_name)
            ->where(['status' => 0])
            ->get_list();
        return $nominationchildtbllist;
    }



    /*****
     * 
     * 
     * SP For Latest News
     * 
     */
    public function getSelectionpostschildLatestNews($parent_id = 0)
    {
        $nominationchildtbllist = $this->select()
            ->from($this->table_name)
            ->where(['status' => 1])
            ->get_list();
        return $nominationchildtbllist;
    }
    public function addSelectionpostchild($data = array())
    {

        return $this->insert($data);
    }
    public function updateSelectionpostchild($data = array(), $id = 0)
    {



        return $this->update($data, ['selection_post_child_id' => $id]);
    }
    public function updateState($data = array(), $id = 0)
    {
        return $this->update($data, ['selection_post_child_id' => $id]);
    }
}
