<?php

class Controller
{
    public function view($name)
    {
        $viewName = '../App/Views/' . $name. '.view.php';
        if (file_exists($viewName)) {
            require $viewName;
        } else {
            require '../App/Views/404.view.php';
        }

    }
}