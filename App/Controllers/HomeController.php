<?php

class HomeController extends Controller
{
    public function index()
    {
        $productModel = new Product();

        $products = $productModel->getFeatured();

        $this->view("Home", [
            "products" => $products
        ]);
    }
}