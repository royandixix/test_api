<?php

namespace MyApp\Core;

class App
{
    private $controllerFile = 'DefaultApp';
    private $controllerMethod = 'index';
    private $parameter = [];
    private const DEFAULT_GET = 'GET';
    private const DEFAULT_POST = 'POST';
    private $handlers = [];

    public function setDefaultController($controller)
    {
        $this->controllerFile = $controller;
    }

    public function setDefaultMethod($method)
    {
        $this->controllerMethod = $method;
    }

    public function get($uri, $callback)
    {
        $this->setHandler(self::DEFAULT_GET, $uri, $callback);
    }

    public function post($uri, $callback)
    {
        $this->setHandler(self::DEFAULT_POST, $uri, $callback);
    }

    private function setHandler(string $method, string $path, $handler)
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function run()
    {
        $execute = 0;
        $url = $this->getUrl();
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->handlers as $handler) {
            $path = explode('/', ltrim(rtrim($handler['path'], '/'), '/'));
            $kurl = (isset($url[0]) ? $url[0] : "") . (isset($url[1]) ? $url[1] : "");
            $kpath = (isset($path[0]) ? $path[0] : "") . (isset($path[1]) ? $path[1] : "");


            if ($kurl !== "" && $kurl == $kpath && $requestMethod == $handler['method']) {
                if (isset($handler['handler'][0]) && file_exists(__DIR__ . '/../controllers/' . $handler['handler'][0] . '.php')) {
                    require_once __DIR__ . '/../controllers/' . $handler['handler'][0] . '.php';
                    $this->controllerFile = $handler['handler'][0];
                    $this->controllerFile = new $this->controllerFile;
                    $execute = 1;

                    if (isset($handler['handler'][1]) && method_exists($this->controllerFile, $handler['handler'][1])) {
                        $this->controllerMethod = $handler['handler'][1];
                        unset($url[1]);
                    }
                }
            }
        }

        if ($execute == 0) {
            require_once __DIR__ . '/../controllers/' . $this->controllerFile . '.php';
            $this->controllerFile = new $this->controllerFile;
        }

        // Set parameter jika ada
        if (!empty($url)) {
            $this->parameter = array_values($url);
        }

        // Panggil metode controller dengan parameter
        call_user_func_array([$this->controllerFile, $this->controllerMethod], $this->parameter);
    }

    private function getUrl()
    {
        $url = rtrim($_SERVER['QUERY_STRING'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
