<?php 
/// startup file for apps
// auto load classes



require_once "bootstrap/autoload.php";


// auto load startup
$app = require "bootstrap/app.php";

$app->execute();

?>
