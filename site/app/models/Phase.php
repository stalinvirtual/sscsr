<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Phase extends DB
{
    private $table_name = 'mstphase';
    public function __construct()
    {
        parent::__construct('mstphase', 'phase_id');
    }
    public function getPhase($parent_id = 0)
    {
        $phases = $this->select()
            ->from($this->table_name)
            ->get_list();
        return $phases;
    }
	 public function getPhasefromPhaseDetailsTbl($q){
        $fetch_all =  $this->select('phase_id, phase_name')
        ->from("mstphase ")
        ->where("phase_name LIKE '%".$q."%'")
        ->order_by('phase_id ASC LIMIT 10')
        ->get_list();
        $lastinsertid = (object)$fetch_all ;
        return $lastinsertid;
    }
}
