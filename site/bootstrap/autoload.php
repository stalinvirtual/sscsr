<?php
/* ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); */
session_start();
/**
 * auto loader files for classes and namespaces
 */
$path = dirname(__DIR__, 1);
define("APP_ROUTE", $path);


function tom_autoloader($class)
{

    $path = explode("\\", $class);
    $classFile = array_pop($path);

    /* echo   $classFile ;
	echo "<br>"; */

    $folderPath = implode(DIRECTORY_SEPARATOR, $path);
    $folderPath = strtolower($folderPath) . DIRECTORY_SEPARATOR;

    $filename =  APP_ROUTE . DIRECTORY_SEPARATOR . $folderPath . $classFile . ".php";
    //echo $filename."<br>";

    try {
        if (is_file($filename)) {
            include_once(@$filename);
        }
    } catch (Exception $e) {

        // throw $e->getMessage();
    }
}
spl_autoload_register("tom_autoloader");
