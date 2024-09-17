<?php 
use MyApp\Config\Config;
use MyApp\Core\Routes;

if (!session_id())
 session_start();

// require_once "../src/core/Autoload.php";
// require_once "../src/config/default.php";

require_once '../vendor/autoload.php';

Config::load();
$routers = new Routes();
$routers->run();

?>