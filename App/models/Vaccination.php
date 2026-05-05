<?php

class Vaccination
{
    use Model;

    protected $table = 'vaccination';
    protected $primaryKey = 'VaccinationID';

    protected $allowedColumns = [
        'PetID',
        'VaccineName',
        'VaccinationDate',
        'NextDate'
    ];

    public function getByPet($petId)
    {
        $query = "SELECT v.*, p.PetName
                  FROM vaccination v
                  JOIN pet p ON v.PetID = p.PetID
                  WHERE v.PetID = :PetID
                  ORDER BY v.VaccinationDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }

    public function getByVet($vetId)
    {
        
        $query = "SELECT v.*, p.PetName
                  FROM vaccination v
                  JOIN pet p ON v.PetID = p.PetID
                  JOIN appointment a ON a.PetID = p.PetID
                  WHERE a.VetID = :VetID
                  ORDER BY v.VaccinationDate DESC";
        return $this->query($query, ['VetID' => $vetId]);
    }

    public function getAllWithPets()
    {
        $query = "SELECT v.*, p.PetName
                  FROM vaccination v
                  JOIN pet p ON v.PetID = p.PetID
                  ORDER BY v.VaccinationDate DESC";
        return $this->query($query);
    }

    public function getById($id)
    {
        $query = "SELECT v.*, p.PetName
                  FROM vaccination v
                  JOIN pet p ON v.PetID = p.PetID
                  WHERE v.VaccinationID = :VaccinationID";
        $result = $this->query($query, ['VaccinationID' => $id]);
        return !empty($result) ? $result[0] : false;
    }

    public function addVaccination($data)
    {
        return $this->insertFiltered($data);
    }

    public function updateVaccination($id, $data)
    {
        return $this->updateFiltered($id, $data);
    }

    public function deleteVaccination($id)
    {
        $query = "DELETE FROM vaccination WHERE VaccinationID = :VaccinationID";
        return $this->query($query, ['VaccinationID' => $id]);
    }

    
    public function getUpcoming()
    {
        $query = "SELECT v.*, p.PetName
                  FROM vaccination v
                  JOIN pet p ON v.PetID = p.PetID
                  WHERE v.NextDate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                  ORDER BY v.NextDate ASC";
        return $this->query($query);
    }
}
