<?php

class ProfileController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['id'])) {

            header("Location: " . ROOT . "/auth/login");
            exit;
        }

        $user = new User();

        $data = $user->first([
            'id' => $_SESSION['id']
        ]);

        $this->view('profile/index', [
            'user' => $data
        ]);
    }
}