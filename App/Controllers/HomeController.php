<?php

class HomeController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $providerModel = new ServiceProvider();

        $products = $productModel->getFeatured();
        $services = $providerModel->getRecentServices();

        $this->view("Home", [
            "products" => $products,
            "services" => $services
        ]);
    }
}