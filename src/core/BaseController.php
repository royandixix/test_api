<?php
class BaseController extends Filter {
    public function view($view, $data = []) {
        if (count($data)) {
            extract($data);
        }
        // Gunakan __DIR__ dan sesuaikan path menuju views
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function redirect($url) {
        // header('Location: ' . BASEURL . '/' .$url);
        header('location: ' .BASEURL  . '/' . $url);
        exit;
    }

    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
       
        return new $model;
    }
}

?>
