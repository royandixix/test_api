<?php

class Routers
{
    private $controllerFile = "DefaultApp";
    private $controllerMethod = "index";
    private $parameter = [];

    public function run()
    {
        // Mendapatkan URL yang sudah difilter
        $url = $this->getUrl();

        // Mengecek apakah controller file ada
        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            $this->controllerFile = $url[0];
            unset($url[0]);
        }

        // Debugging URL
        echo "<pre>";
        // var_dump($url);
        echo "<pre>";

        // Memasukkan file controller
        require_once __DIR__ . "/../controllers/" . $this->controllerFile . '.php';
        $this->controllerFile = new $this->controllerFile();

        // Mengecek apakah method pada controller ada
        if (isset($url[1])) {
            if (method_exists($this->controllerFile, $url[1])) {
                $this->controllerMethod = $url[1];
                unset($url[1]);
            }
        }

        // Mengambil parameter jika ada
        if (!empty($url)) {
            $this->parameter = array_values($url);
        }

        // Memanggil method controller dengan parameter
        call_user_func_array([$this->controllerFile, $this->controllerMethod], $this->parameter);
    }

    // Fungsi untuk mengambil dan memproses URL
    private function getUrl()
    {
        $url = rtrim($_SERVER['QUERY_STRING'], '/'); // Tambahkan titik koma di sini
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
