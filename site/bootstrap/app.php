<?php

class Application
{
    public $config;
    public $template;
    public $route;

    public function __construct()
    {
        $this->config = new App\System\Config();
        $this->route = new App\System\Route();
        $this->template = new App\System\Template();
    }
    public function execute()
    {
        $routes = $this->route->get_menu_routes(true);

               if ($routes == false) {
            $routes = $this->route->get_routes(true);
        }

        $controller = array_shift($routes);
        $controller = $this->clean($controller);
        $method = array_shift($routes);
        $method = $this->clean($method);
        $params = $routes;
        if ($method == "") {
            $method = "index";
        }
        if ($controller == "" || $controller == "index.php" || $this->route->get_base_url() == $this->route->get_routes()) {
            $controller = $this->config->get('default_controller');
            $method = "index";
        }
        $controller_class = "App\\Controllers\\$controller";
        if ($controller == "") {
            $message  =  " Missing Controller Class ";
            $this->template->renderError($message);
            exit();
        }
        if (!class_exists($controller_class)) {
            $message  =  " $controller_class not defined ";
            $this->template->renderError($message);
            exit();
        }
        $controller_object = new $controller_class(['params' => $params]);
        if (method_exists($controller_object, $method)) {
            $controller_object->$method();
        } else {
            $message  =  " $controller_class::  $method not defined ";
			
            $this->template->renderError($message);
        }
    }
    public function clean($name)
    {
        $find = array("-", "_", " ");
        $replace = array("", "", "");
        $name  = trim($name);
        return str_replace($find, $replace, $name);
    }
}
$app = new Application();
return $app;
