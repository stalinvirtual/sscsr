<?php

/**
 * this is template parser file
 */

namespace App\System;

use \App\System\Config;
use \App\System\Route;
use App\Models\Menu as Menu;
use App\Helpers\Helpers;

class Template
{
    private $header;
    private $footer;
    private $body;
    private $plugins;
    private $config;
    public $route;
    private $data = array();
    private $theme = "";
    public $theme_url = "";
    public $base_url;
    public function __construct()
    {
        // default constructor
        $this->config  = new Config();
        $this->theme = $this->config->get('theme');
        $this->route = new Route();
        $this->theme_url = $this->route->get_base_url() . "/" . $this->theme;
        $this->base_url = $this->route->get_base_url() . "/";
    }
    /**
     * header rendering
     */
    public function get_header($header_suffix = NULL, $data = array())
    {
        // check if the header file available
        $header_file_path = "header" . (($header_suffix == NULL) ? "" : "-" .  $header_suffix) . "." . $this->config->get("template_extension");
        $header_full_file_path = $this->config->get('app_root') . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . $header_file_path;
        return $this->load($header_full_file_path, $this->data);
    }

    /**
     * footer rendering
     */
    public function get_footer($footer_suffix = NULL, $data = array())
    {
        // check if the header file available
        $footer_file_path = "footer" . (($footer_suffix == NULL) ? "" : "-" .  $footer_suffix) . "." . $this->config->get("template_extension");
        $footer_full_file_path = $this->config->get('app_root') . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . $footer_file_path;
        return $this->load($footer_full_file_path, $this->data);
    }
    /**
     * load file
     */
    public function load($file_path, $data = array())
    {
        $this->data = array_merge($this->data, $data);
        extract($this->data);
        if (!file_exists($file_path)) {
            // show an error while file is not found 
            $file_not_found_file = $this->config->get('app_root') . "/system/error/file_not_found.php";
            return $this->parse($file_not_found_file, ['type' => 'error', 'file_path' => $file_path]);
        } else {
            return $this->parse($file_path, $data);
        }
    }

    /**
     * parse template with key value pairs
     */
    public function parse($file_full_path, $data = array())
    {
        ob_start();
        extract($data);
        include_once($file_full_path);
        $html = ob_get_clean();

        return $html;
    }
    /**
     * render the page
     */
    public function render($template  = null, $data = array())
    {
        if ($template == NULL) {
            $template = "index";
        }
        $template_file_path = $this->config->get('app_root') . DIRECTORY_SEPARATOR . $this->theme . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . $template . "." . $this->config->get("template_extension");
        echo $this->load($template_file_path, $data);
    }
    public function renderError($message = "", $type = "error")
    {
		
		
		if($message !=""){
			
			$data['error_message '] = "Something is wrong with your request (like the URL was not found). Please try after some time or contact Administrator.";
		}
		
		 $menu  = new Menu();
		//for header published menus
        ob_start();
        \App\Helpers\Helpers::showMenuLinks($menu->getMenusForPublish());
        $menuStr = ob_get_clean();
		 ob_start();
        \App\Helpers\Helpers::showFooterMenuLinks($menu->getFooterMenusForPublish());
        $footermenuStr = ob_get_clean();
        // echo $menuStr;
       //// $this->data['renderedMenu'] = $menuStr;
		
		$data['renderedMenu'] = $menuStr;
		$data['renderedFooterMenu'] = $footermenuStr;
		
		//for footer published menus
		
        // echo $menuStr;
        //$this->data['renderedFooterMenu'] = $footermenuStr;
        $error_file = $this->config->get('app_root') . "/system/error/error.php";
        echo  $this->parse($error_file, ['type' => $type, 'data' => $data]);
    }
    /**
     * set curent theme
     */
    public function setTheme($theme)
    {
        if ($theme != "" && $theme != "default") {
            $this->theme = $theme;
            $route = new Route();
            $this->theme_url = $route->get_base_url() . "/" . $this->theme;
        }
    }
}
