<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Department extends DB
{
    private $table_name = 'mstdepartment';
    public function __construct()
    {
        parent::__construct('mstdepartment', 'department_id');
    }
    public function getDepartment($parent_id = 0)
    {
        $departments = $this->select()
            ->from($this->table_name)
            ->get_list();
        return $departments;
    }
}
