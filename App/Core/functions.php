<?php

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function checkLogin()
{
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");

    if (!isset($_SESSION['id'])) {

        http_response_code(404);

        require "../App/Views/404.php";

        exit;
    }
}

function checkRole($allowedRoles = [])
{
    checkLogin();

    if (!in_array($_SESSION['role'], $allowedRoles)) {

        http_response_code(404);

        require "../App/Views/404.php";

        exit;
    }
}

function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}