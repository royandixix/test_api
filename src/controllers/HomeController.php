<?php

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Home'
        ];
        // Memuat header, konten, dan footer
        $this->view('template/header', $data); // Memuat header
        $this->view('home/index'); // Memuat konten utama
        $this->view('template/footer'); // Memuat footer
    }
}
?>
