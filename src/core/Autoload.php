<?php 

function load_core($class_name)
{
    $path_to_file = '../src/core/' . $class_name . '.php';
    
    // Mengecek apakah file class ada
    if (file_exists($path_to_file)) {
        require_once($path_to_file);
    }
}

// Mendaftarkan fungsi autoload
spl_autoload_register('load_core');

?>
