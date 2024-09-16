<?php
class BaseController extends Filter
{
    public function view($view, $data = [])
    {
        if (count($data)) {
            extract($data);
        }
        // Gunakan __DIR__ dan sesuaikan path menuju views
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function redirect($url)
    {
        header('Location: ' . BASEURL . '/' . $url);
        exit;
    }

    public function model($model)
    {
        // Periksa path di sini
        $file = __DIR__ . '/../models/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model;
        } else {
            throw new Exception("Model file does not exist: " . $file);
        }
    }
    
}
