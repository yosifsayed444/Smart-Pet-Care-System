<?php

spl_autoload_register(function ($class) {
    require "../App/models/" . ucfirst($class) .".php";
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';