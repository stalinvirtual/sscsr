<?php

/**
 * Router file
 */

namespace App\System;

class Route
{

    public function get_app_url()
    {
        $app_url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
        $url_parts = explode("/", $_SERVER['SCRIPT_NAME']);
        array_pop($url_parts);
        $url_parts_string = implode("/", $url_parts);
        $app_url = $app_url . $url_parts_string;
        $config = new Config();
        if ($config->get('sef') != "1") {
            $app_url .= "/index.php";
        }
        return $app_url;
    }
    public function get_base_url()
    {
        $app_url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
        $url_parts = explode("/", $_SERVER['SCRIPT_NAME']);
        array_pop($url_parts);
        $url_parts_string = implode("/", $url_parts);
        $app_url = $app_url . $url_parts_string;

        return $app_url;
    }
    public function get_full_url()
    {
        $full_url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];

        return $full_url;
    }
    public function get_routes($return_as_array = false)
    {
        $full_url = $this->get_full_url();

        $route_url =  str_replace($this->get_base_url(), "", $full_url);
        $route_url = ltrim($route_url, "/");
        $indexphp_position = strpos($route_url, "/");
        if (substr($route_url, 0, $indexphp_position) == "index.php") {
            $route_url = substr($route_url, $indexphp_position);
        }
        $route_url = ltrim($route_url, "/");
        if ($return_as_array == true) {
            $route_url  = explode("/", $route_url);
        }
        return $route_url;
    }
    public function site_url($url, $querystring = NULL)
    {
        if (is_array($querystring)) {
            $querystring = http_build_query($querystring);
        }
        $url_parts = parse_url($url);
        if (isset($url_parts['query'])) {
            $querystring .= $url_parts['query'];
        }
        if ($querystring != NULL) {
            $querystring = "?" . $querystring;
        }
        return $this->get_app_url() . "/" . @$url_parts['path'] .  $querystring;
    }
    /**
     * redirection 
     */
    public function redirect($site_url, $mode  = "php")
    {
        if ($mode == "php") {
            header("location:" . $site_url);
            exit;
        }
        if ($mode == "js") {
            echo "<script>window.location.href='$site_url';</script>";
        }
    }

    /** get menu routes */
    public function get_menu_routes($return_as_array = false)
    {
        $alias = $this->get_routes();
        $menu = new \App\Models\Menu();
        $alias = rawurldecode($alias);

        $activeMenu = $menu->getMenuByAlias($alias);

        if (!$activeMenu) {
            return false;
        }
        //echo '<pre>';
        // print_r($activeMenu);
        //exit;
        if ($activeMenu->menu_type == 1) { // article/ page
            $new_menu_alias = 'PageController/show/' . $activeMenu->menu_page_id;
        } else if ($activeMenu->menu_type == 2) { //External
            $new_menu_alias  = $activeMenu->menu_link;
        } else if ($activeMenu->menu_type == 0) { // internal menu
             $new_menu_alias = $activeMenu->menu_route;
        } else { //PDF
            // $new_menu_alias  = $activeMenu->attachment;
        }
        

        if ($return_as_array == true) {
            return  explode("/", @$new_menu_alias);
        }

        return $new_menu_alias;
    }
}
