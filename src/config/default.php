<?php
$file = __DIR__ . "/../config/config.properties"; // Gunakan __DIR__ untuk path yang relatif

// Periksa apakah file konfigurasi ada
if (!file_exists($file)) {
    echo "Config File Not Found";
    exit();
}

// Memuat file konfigurasi
$properties = parse_ini_file($file);

define('DB_HOST', $properties['db_host']);
define('DB_USER', $properties['db_user']);
define('DB_PASS', $properties['db_pass']);
define('DB_NAME', $properties['db_name']);
define('DB_PORT', $properties['db_port']);

define('BASEURL', $properties['base_url']);
?>
