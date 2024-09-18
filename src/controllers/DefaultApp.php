<?php

use MyApp\Core\BaseController;

class DefaultApp extends BaseController
{
    // API
    public function index()
    {
        $data = [   
            "status" => "404",
            "error" => "404",
            "message" => "Halaman tidak ditemukan",
            "data" => null
        ];
        header('HTTP/1.0 404 Not Found');
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
