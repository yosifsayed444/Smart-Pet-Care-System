<?php

class Middleware
{
    public static function logged_in()
    {
        return isset($_SESSION['id']);
    }

    public static function role($role)
    {
        if (isset($_SESSION['role'])) {

            return $_SESSION['role'] === $role;
        }

        return false;
    }

    public static function requireLogin()
    {
        if (!self::logged_in()) {

            header("Location: " . ROOT . "/auth/login");
            exit;
        }
    }

    public static function requireRole($role)
    {
        if (!self::logged_in() || !self::role($role)) {

            header("Location: " . ROOT . "/auth/login");
            exit;
        }
    }
}