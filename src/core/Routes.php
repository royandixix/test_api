<?php

class Routes
{
    public function run()
    {
        // Membuat instance router dan mengatur controller serta method default
        $router = new App();
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        // Mendefinisikan rute
        $router->get('/barang', ['BarangController', 'index']);
        $router->get('/barang/insert', ['BarangController', 'insert']);
        $router->get('/barang/edit', ['BarangController', 'edit']);
        $router->post('/barang/insert_barang', ['BarangController', 'insert_barang']);
        $router->post('/barang/edit_barang', ['BarangController', 'edit_barang2']);

        // Menjalankan router
        $router->run();
    }
}
