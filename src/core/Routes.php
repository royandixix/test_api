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
        // $router->setNamespace('MyApp\Controllers');

        // Definisikan rute GET untuk 'barang'
        // $router->get('barang', ['BarangController', 'index']);
        // $router->get('barang/index', ['BarangController', 'index']);
        // $router->get('barang/insert', ['BarangController', 'insert']);
        // // $router->get('barang/edit', ['BarangController', 'edit']);
        // $router->get('barang/edit/{:id}', ['BarangController', 'edit']);

        // $router->post('barang/insert_barang', ['BarangController', 'insert_barang']);
        // $router->post('barang/edit_barang', ['BarangController', 'edit_barang']);
        // $router->get('/kategori', ['KategoriController', 'index']);



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
