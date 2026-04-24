<?php



spl_autoload_register(function($classname){

    $paths = [

        "../App/Controllers/",
        "../App/Models/",
        "../App/Core/",

    ];

    foreach($paths as $path){

        $file = $path . $classname . ".php";

        if(file_exists($file)){

            require $file;
            return;
        }
    }

});
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';