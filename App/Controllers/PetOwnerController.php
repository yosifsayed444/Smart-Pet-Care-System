<?php

class PetOwnerController extends Controller
{
    public function index()
    {
        checkRole(['Owner']);
        $this->view('petowner/dashboard');
    }
}