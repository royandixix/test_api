<?php
    
    if(!session_id()) session_start();
    
    require_once '../src/config/default.php ';
    require_once '../src/core/App.php';
    require_once '../src/core/Routes.php';
    require_once '../src/core/Autoload.php'; // Pastikan ini benar

    $routes = new Routes();
    $routes->run();
    echo BASEURL;       

?>