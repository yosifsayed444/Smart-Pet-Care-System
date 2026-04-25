<?php

class ServiceProviderController extends Controller
{
    public function index()
    {
        $this->view('ServiceProvider/index');
    }

    public function services()
    {
        $this->view('ServiceProvider/services');
    }

    public function bookings()
    {
        $this->view('ServiceProvider/bookings');
    }

    public function dashboard()
    {
        $this->view('ServiceProvider/dashboard');
    }
}