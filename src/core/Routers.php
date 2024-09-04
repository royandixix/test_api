<?php

class Routers
{
    private $controllerFile = "DefaultApp";
    private $controllerMethod = "index";
    private $parameter = [];

    public function run()
    {
      

        $url = $this->getUrl();

        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            $this->controllerFile = $url[0];
            unset($url[0]);
        }



        echo "<pre>";
        // var_dump($url);
        echo "<pre>";
        require_once __DIR__ . "/../controllers/" . $this->controllerFile . '.php';
        $this->controllerFile = new $this->controllerFile();
        // $controller->$this->controllerMethod();

        if (isset($url[1])) {
            if (method_exists($this->controllerFile, $url[1])) {
                $this->controllerMethod = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->parameter = array_values($url);
        }

        call_user_func_array([$this->controllerFile, $this->controllerMethod], $this->parameter);
    }

    private function getUrl()
    {
        $url = rtrim($_SERVER['QUERY_STRING'], '/'); // Tambahkan titik koma di sini
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
