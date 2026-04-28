<?php

class App
{
    private $controller = 'HomeController';
    private $method     = 'index';

    public function splitUrl()
    {
        $url = $_GET['url'] ?? 'home';
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        return $url;
    }

    public function run()
    {
        $url = $this->splitUrl();

        $controller = ! empty($url[0])
            ? ucfirst($url[0]) . 'Controller'
            : 'HomeController';

        $controllerPath = __DIR__ . '/../Controllers/' . $controller . '.php';

        if (file_exists($controllerPath)) {

            require_once $controllerPath;
            $this->controller = $controller;

        } else {

            require_once __DIR__ . '/../Controllers/_404.php';
            $this->controller = '_404';
        }

        $controller = new $this->controller;

        if (! empty($url[1])) {

            if (method_exists($controller, $url[1])) {

                $this->method = $url[1];
            } else {
                
                require_once __DIR__ . '/../Controllers/_404.php';
                $this->controller = '_404';
                $controller = new $this->controller;
                $this->method = 'index';
            }
        }

        $params = [];

if (count($url) > 2) {
    $params = array_slice($url, 2);
}

call_user_func_array(
    [$controller, $this->method],
    $params
);
    }
}
