<?php

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /SE1_Project/auth");
        exit;
    }
}

function checkRole($allowedRoles = [])
{
    checkLogin();

    if (!in_array($_SESSION['role'], $allowedRoles)) {
        header("Location: /SE1_Project/home");
        exit;
    }
}
