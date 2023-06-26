<?php

/**
 * page controller
 */

namespace App\Controllers;

use App\System\Template;

class FrontEndController extends Template
{
    // this data holds the actual data to be passed to view
    protected $data = [];
    public function __construct($data = array())
    {
        parent::__construct();
        $this->data = $data;
    }
    public function merge_data($data = array())
    {
        $this->data = array_merge($this->data, $data);
    }
    public function render($template = null, $data = array())
    {
        $this->merge_data($data);
        parent::render($template, $this->data);
    }
}
