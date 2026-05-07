<?php

class Pet
{
    use Model;

    protected $table = 'pet';
    protected $primaryKey = 'PetID';

    protected $allowedColumns = [
        'OwnerID',
        'PetName',
        'Species',
        'Age',
        'Gender',
        'Weight',
        'Allergies',
        'HandlingInstructions',
        'BehaviorNotes'
    ];

    public function getPetsByOwner($owner_id)
    {
        $query = "SELECT * FROM pet WHERE OwnerID = :OwnerID";
        return $this->query($query, ['OwnerID' => $owner_id]);
    }
    public function getPetById($petId)
    {
        $query = "SELECT * FROM Pet WHERE PetID = :PetID";
        $result = $this->query($query, ['PetID' => $petId]);

        if ($result && is_array($result) && count($result) > 0) {
            return $result[0];
        }
        return false;
    }

    public function addPet($data)
    {
        return $this->insertFiltered($data);
    }

    public function updatePet($petId, $data)
    {
        return $this->updateFiltered($petId, $data);
    }

    public function deletePet($petId)
    {
        $query = "DELETE FROM Pet WHERE PetID = :PetID";
        return $this->query($query, ['PetID' => $petId]);
    }


    public function updateWeight($data)
    {
        $query = "UPDATE Pet SET Weight = :Weight WHERE PetID = :PetID";
        return $this->query($query, $data);
    }

    public function viewWeight($petId)
    {
        $query = "SELECT PetName, Weight FROM Pet WHERE PetID = :PetID";
        $result = $this->query($query, ['PetID' => $petId]);
        
        if ($result && is_array($result) && count($result) > 0) {
            return $result[0];
        }
        return false;
    }
}
