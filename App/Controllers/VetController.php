<?php


class VetController extends Controller
{

    public function index()
    {
        checkRole(['Vet']);
        $this->view('Veterinarian/dashboard');
    }
}