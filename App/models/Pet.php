<?php

class Pet
{
    use Model;

    protected $table = 'pet';

    protected $allowedColumns = [
        'OwnerID',
        'PetName',
        'Species',
        'Age',
        'Gender',
        'Weight',
        'Allergies'
    ];

    public function getPetsByOwner($owner_id)
    {
        $query = "SELECT * FROM pet WHERE OwnerID = :OwnerID";
        return $this->query($query, ['OwnerID' => $owner_id]);
    }
}
