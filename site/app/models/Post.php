<?php

namespace App\Models;

use App\System\DB\DB;
use App\System\Route;

class Post extends DB
{
    private $table_name = 'mstpost';
    public function __construct()
    {
        parent::__construct('mstpost', 'post_id');
    }
    public function getPost($parent_id = 0)
    {
        $posts = $this->select()
            ->from($this->table_name)
            ->get_list();
        return $posts;
    }
}
