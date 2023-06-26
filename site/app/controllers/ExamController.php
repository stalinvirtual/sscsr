<?php

/**
 * this is the way of adding internal link ok?
 */

namespace App\Controllers;

class ExamController extends FrontEndController
{
    public function __construct()
    {
    }
    public function index()
    {
        echo " I am in exam controller@index";
    }
    public function online()
    {
        echo " I am in exam controller@online";
    }
}
