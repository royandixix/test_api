<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="row-home">
        <div class="left">
            <h2>System Gudang</h2>
            <div>
                <input type="text" id="mySearch" placeholder="Search...">
            </div>
            <ul id="myMenu">
                <li>
                    <a href="<?php echo BASEURL; ?>"><i class="fas fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="<?php echo BASEURL . '/barang'; ?>"><i class="fas fa-box"></i> Barang</a>
                </li>
                <li>
                    <a href="<?php echo BASEURL . '/kategori'; ?>"><i class="fas fa-list"></i> Kategori</a>
                </li>
            </ul>
        </div>
        <div class="right"> -->



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