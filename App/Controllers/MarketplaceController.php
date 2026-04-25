<?php

class MarketplaceController extends Controller
{
    
    public function index()
    {
        $product = new Product();

        $data['products'] = $product->fetchAll();

        $this->view('marketplace/index', $data);
    }
}