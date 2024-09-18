<?php

namespace MyApp\Core;

class Routes
{
    public function run()
    {
        $router = new App();

        // Set default controller dan method
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        // API Routes
        $router->get('barang/index', ['BarangController', 'index']); // Rute untuk menampilkan data barang pada URL /barang/index.
        $router->get('/barang/(:id)', ['BarangController', 'index']); // Rute untuk menampilkan data barang tertentu berdasarkan ID.
        $router->patch('/barang/(:id)', ['BarangController', 'edit']); // Rute untuk mengedit data barang tertentu berdasarkan ID menggunakan metode PATCH.
        $router->post('/barang', ['BarangController', 'insert']); // Rute untuk menambahkan data barang baru menggunakan metode POST.
        $router->delete('/barang/(:id)', ['BarangController', 'delete']); // Rute untuk menghapus data barang tertentu berdasarkan ID menggunakan metode DELETE.

        // Definisikan rute GET untuk 'kategori'
        $router->get('/kategori', ['KategoriController', 'index']); // Rute untuk menampilkan data kategori pada URL /kategori.

        // Jalankan router
        $router->run();
    }
}
