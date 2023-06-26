<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Debarredlists extends DB
{
    private $table_name = 'debarredliststbl';
    public function __construct()
    {
        parent::__construct('debarredliststbl', 'debarred_lists_id');
    }
    public function getDlists($parent_id = 0)
    {
        $pages = $this->select()
            ->from($this->table_name)
            ->order_by("debarred_lists_id desc")
            ->get_list();
        return $pages;
    }
    public function getDlist($id = 0, $type = null)
    {
        if ($id == 0) {
            return $this->getEmptyDlist($type);
        } else {
            return $this->select()->from($this->table_name)->where(['debarred_lists_id' => $id])->get_one($type);
        }
    }
    // public function getMenuByAlias($alias)
    // {
    //     echo $alias . " ===";
    //     $menu =  $this->select()->from($this->table_name)->where(['m_menu_link' => $alias])->get_one();
    //     echo $this->last_query;
    //     return $menu;
    // }
    public function getEmptyDlist($type = null)
    {
        $empty_menu  = [
            'debarred_lists_id' => 0,
            'pdf_name' => '',
            'attachment' => '',
			'effect_from_date' => '',
			'effect_to_date' => '',
            'status' => '',
        ];
        if ($type == DB_OBJECT) {
            $empty_menu = (object) $empty_menu;
        }
        return $empty_menu;
    }
    public function addDlist($data = array())
    {

        return $this->insert($data);
    }
    public function updateDlist($data = array(), $id = 0)
    {
        return $this->update($data, ['debarred_lists_id' => $id]);
    }

    public function getCountAdmitcard($app_no, $dob,$examname)
    {

        $app_no = $this->cleanData($app_no );
        $getcandidaterecord  = $this->select("count(*)")
        ->from("ssc_candidate_details_by_exam")
        ->where(['app_no' => $app_no])
        ->get_one();

        return $getcandidaterecord;
    }
	public function getDebarredLists(){
		
		$dlist  = $this->select()
				   ->from("debarredliststbl")
				   ->where(['p_status' => '1'])
				    ->order_by("debarred_lists_id desc")
				   ->get_list();
        return $dlist;
		
	}
	

	// Publish and Unpublished
	
	 public function updateDebarredlistState($data = array(), $id = 0)
    {
        return $this->update($data, ['debarred_lists_id' => $id]);
    }


    function cleanData($val)
    {
        return pg_escape_string($val);
    }


    public function deleteDebarredList($dl_id = 0)
    {
        $delete_row = $this->delete($dl_id);
       return $delete_row;
    }
	
}

