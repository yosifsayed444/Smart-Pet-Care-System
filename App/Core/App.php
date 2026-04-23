<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';
    public function splitUrl()
    {
        $url = $_GET['url'] ?? 'Home'; 
        $url = explode('/', $url);
        return $url;
    }

    public function loadController()
    {
        $url = $this->splitUrl();

        $controller = !empty($url[0]) ? ucfirst($url[0]) : 'Home';

        $controllerName = '../App/Controllers/' . $controller . '.php';

        if (file_exists($controllerName)) {
            require $controllerName;
            $this->controller = ucfirst($url[0]);
        } else {
            require '../App/Controllers/_404.php';
            $this->controller = '_404';
        }
        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);

    }
}