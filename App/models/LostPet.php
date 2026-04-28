<?php

class LostPet
{
    use Model;
    protected $table = 'lost_pets';
    protected $allowedColumns = ['PetID', 'OwnerID', 'Description', 'Location', 'Status', 'DateReported'];
}
