
<?php
header('access-control-allow-origin: * ');
// Mengizinkan semua domain (wildcard `*`) untuk mengakses resource dari server ini.
header('content-type: application/json');
// Menetapkan tipe konten dari response menjadi JSON.
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH');
// Mengizinkan metode HTTP yang dapat digunakan untuk berinteraksi dengan server (GET, POST, PUT, DELETE, PATCH).
header('Access-Control-Allow-Headers: content-type, Authorization, access-control-allow-headers');
// Mengizinkan header yang digunakan oleh klien untuk mengirimkan permintaan, seperti `content-type` dan `Authorization`.
?>