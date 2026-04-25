<?php

class MarketplaceController extends Controller
{
    public function index()
    {
        $this->view('Marketplace/index');
    }

    public function dashboard()
    {
        $this->view('Marketplace/dashboard');
    }
}