<?php

class VetController extends Controller
{
    public function index()
    {
        $this->view('Veterinarian/index');
    }

    public function book()
    {
        $this->view('Veterinarian/book');
    }

    public function appointments()
    {
        $this->view('Veterinarian/appointments');
    }

    public function medical_records()
    {
        $this->view('Veterinarian/medical_records');
    }

    public function prescriptions()
    {
        $this->view('Veterinarian/prescriptions');
    }

    public function dashboard()
    {
            checkRole(['Veterinarian']);
        $this->view('Veterinarian/dashboard');
    }
}