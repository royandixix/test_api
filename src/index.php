<?php
    
    if(!session_id()) session_start();

    require_once '../src/core/Routers.php';
    $routes = new Routers();
    $routes->run();


?>