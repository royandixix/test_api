<?php

use MyApp\Core\BaseController;

class DefaultApp extends BaseController
{
    // public function index() {
    //     $data = [
    //         "title"=> "Home",
    //     ];
    //     $this->view("template/header", $data);
    //     $this->view('home/index', $data);
    //     $this->view('template/footer');
    // }

    // API
    public function index()
    {
        $data = [   
            "status" => "404",
            "error" => "404",
            "message" => "Halaman tidak ditemukan",
            "data" => null
        ];
        $this->view("template/header");
        header('HTTP/1.0 404 Not Found'); 
        echo json_encode($data);
    }
}
