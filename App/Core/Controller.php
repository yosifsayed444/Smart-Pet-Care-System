<?php

class Controller
{
    public function view($name)
    {
        $viewName = '../App/views/' . $name. '.php';
        if (file_exists($viewName)) {
            require $viewName;
        } else {
            require '../App/views/404.php';
        }

    }
}