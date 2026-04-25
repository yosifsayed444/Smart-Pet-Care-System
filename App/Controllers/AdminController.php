<?php

class AdminController extends Controller
{
    public function dashboard()
    {
        checkRole(['Admin']);
        $this->view("admin/dashboard");
    }
}