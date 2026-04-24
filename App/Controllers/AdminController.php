<?php

class AdminController extends Controller
{
    public function index()
    {
        checkRole(['Admin']);
        $this->view('Admin/dashboard');
    }
}
