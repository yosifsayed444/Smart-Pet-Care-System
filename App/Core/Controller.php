<?php

class Controller
{
    public function view($name, $data = [])
    {
        $viewPath = __DIR__ . '/../views/' . $name . '.php';

        if (file_exists($viewPath)) {

            extract($data);
            require $viewPath;

        } else {

            require __DIR__ . '/../views/404.php';
        }
    }
}