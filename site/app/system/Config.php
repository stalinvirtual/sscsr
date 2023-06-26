<?php

namespace App\System;

class Config
{
  private $db_driver = "pgsql";
  private $db_host = "localhost";
  private $db_port = "5432";
  private $db_name = "sscsr";
  private $db_user = "postgres";
  private $db_password = "stalinthomas";
  private $app_root = "";
  private $theme = "default";
  private $template_extension = "php";
  private $default_controller = "IndexController";
  private $sef = "1";
  public function __construct($base_url = "")
  {
    // default constructor
    $this->app_root = APP_ROUTE;
  }
  public function get($config_key)
  {
    return $this->$config_key;
  }
}

