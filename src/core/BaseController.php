<?php
class BaseController
{
    // Method untuk memuat tampilan (view) dengan data yang diekstraksi
    public function view($view, $data = [])
    {
        if (count($data)) {
            extract($data); // Menjadikan array asosiatif sebagai variabel
        }
        require_once '../src/views/' . $view . '.php'; // Memuat file view
    }

    // Method untuk melakukan redirect ke URL tertentu
    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    // Method untuk memuat model dan mengembalikan instance dari model tersebut
    public function model($model)
    {
        require_once '../src/models/' . $model . '.php'; // Memuat file model
        return new $model; // Mengembalikan instance dari model
    }
}
