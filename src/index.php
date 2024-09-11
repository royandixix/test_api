<?php 

if (!session_id()) session_start();

require_once "../src/config/default.php";
require_once "../src/core/Autoload.php";

// Instansiasi dan jalankan routing
$routers = new Routes();
$routers->run();

?>
