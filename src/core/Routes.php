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

        // Definisikan rute GET untuk 'barang'
        $router->get('barang', ['BarangController', 'index']);
        $router->get('barang/index', ['BarangController', 'index']);
        $router->get('barang/insert', ['BarangController', 'insert']);
        // $router->get('barang/edit', ['BarangController', 'edit']);
        $router->get('barang/edit/{:xid}', ['BarangController', 'edit']);

        $router->post('barang/insert_barang', ['BarangController', 'insert_barang']);
        $router->post('barang/edit_barang', ['BarangController', 'edit_barang']);

        // Definisikan rute GET untuk 'kategori'
        $router->get('/kategori', ['KategoriController', 'index']);

        // Jalankan router
        $router->run();
    }
}
