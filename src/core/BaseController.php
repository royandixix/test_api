<?php
class BaseController
{
    public function view($view, $data = [])
    {
        if (count($data)) {
            extract($data);
        }
        require_once '../src/views/' . $view . '.php';
    }

    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }

    public function model($model)
    {
        require_once '../src/model/' . $model . '.php';
        return new $model;
    }
}

class Controller
{
    // Memuat tampilan dengan data
    protected function view($view, $data = [])
    {
        // Mengubah array data menjadi variabel lokal
        extract($data);

        // Memuat file tampilan
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
