<?php

class App
{
    private $controllerFile = "DefaultApp";
    private $controllerMethod = "index";
    private $parameter = [];
    private const DEFAULT_GET = 'GET';
    private const DEFAULT_POST = 'POST';
    private $handlers = [];

    // Mengatur default controller
    public function setDefaultController($controller)
    {
        $this->controllerFile = $controller;
    }

    // Mengatur default method
    public function setDefaultMethod($method)
    {
        $this->controllerMethod = $method;
    }

    // Menangani request GET
    public function get($uri, $callback)
    {
        $this->setHandler(self::DEFAULT_GET, $uri, $callback);
    }

    // Menangani request POST
    public function post($uri, $callback)
    {
        $this->setHandler(self::DEFAULT_POST, $uri, $callback);
    }

    // Menyimpan handler berdasarkan method dan path
    private function setHandler(string $method, string $path, $handler)
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    // Menjalankan aplikasi
    public function run()
    {
        $execute = false;
        $url = $this->getUrl();
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Mengecek apakah handler cocok dengan URL dan metode permintaan
        foreach ($this->handlers as $handler) {
            $path = explode('/', ltrim(trim($handler['path'], '/'), '/'));
            $urlKey = (isset($url[0]) ? $url[0] : '') . (isset($url[1]) ? $url[1] : '');
            $pathKey = (isset($path[0]) ? $path[0] : '') . (isset($path[1]) ? $path[1] : '');

            // Eksekusi handler jika cocok
            if ($urlKey !== "" && $urlKey == $pathKey && $requestMethod == $handler['method']) {
                if (isset($handler['handler'][0]) && file_exists(__DIR__ . '/../controllers/' . $handler['handler'][0] . '.php')) {
                    require_once __DIR__ . "/../controllers/" . $handler['handler'][0] . '.php';
                    $this->controllerFile = new $handler['handler'][0]();
                    $execute = true;

                    if (isset($handler['handler'][1]) && method_exists($this->controllerFile, $handler['handler'][1])) {
                        $this->controllerMethod = $handler['handler'][1];
                        unset($url[1]);
                    }
                }
            }
        }

        // Jika handler tidak dieksekusi, jalankan default atau berdasarkan URL
        if (!$execute) {
            if ($url && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
                require_once __DIR__ . '/../controllers/' . $url[0] . '.php';
                $this->controllerFile = new $url[0]();
                unset($url[0]);
            } else {
                require_once __DIR__ . '/../controllers/' . $this->controllerFile . '.php';
                $this->controllerFile = new $this->controllerFile();
            }

            if (isset($url[1]) && method_exists($this->controllerFile, $url[1])) {
                $this->controllerMethod = $url[1];
                unset($url[1]);
            }
        }

        // Mengatur parameter jika ada
        $this->parameter = !empty($url) ? array_values($url) : [];

        // Menjalankan controller method dengan parameter
        call_user_func_array([$this->controllerFile, $this->controllerMethod], $this->parameter);
    }

    // Mendapatkan URL dan membersihkannya
    private function getUrl()
    {
        $url = rtrim($_SERVER['QUERY_STRING'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}
