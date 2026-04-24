<?php

class ServiceProviderController extends Controller
{
    public function index()
    {
        checkRole(['Provider']);
        $this->view('ServiceProvider/dashboard');
    }
}