<?php

class Prescription
{
    use Model;

    protected $table = 'prescription';
    protected $primaryKey = 'PrescriptionID';

    protected $allowedColumns = [
        'PetID',
        'VetID',
        'MedicationName',
        'Dosage',
        'Date'
    ];

    public function addPrescription($data)
    {
        return $this->insertFiltered($data);
    }

    public function getByVet($vetId)
    {
        $query = "SELECT pr.*, p.PetName, u.username as OwnerName
                  FROM prescription pr
                  JOIN pet p ON pr.PetID = p.PetID
                  LEFT JOIN users u ON p.OwnerID = u.id
                  WHERE pr.VetID = :VetID
                  ORDER BY pr.Date DESC";
        return $this->query($query, ['VetID' => $vetId]);
    }

    public function getByPet($petId)
    {
        $query = "SELECT pr.*, p.PetName, u.username as VetName
                  FROM prescription pr
                  JOIN pet p ON pr.PetID = p.PetID
                  LEFT JOIN users u ON pr.VetID = u.id
                  WHERE pr.PetID = :PetID
                  ORDER BY pr.Date DESC";
        return $this->query($query, ['PetID' => $petId]);
    }

    public function getById($id)
    {
        $query = "SELECT pr.*, p.PetName
                  FROM prescription pr
                  JOIN pet p ON pr.PetID = p.PetID
                  WHERE pr.PrescriptionID = :PrescriptionID";
        $result = $this->query($query, ['PrescriptionID' => $id]);
        return !empty($result) ? $result[0] : false;
    }

    public function deletePrescription($id, $vetId)
    {
        $query = "DELETE FROM prescription WHERE PrescriptionID = :id AND VetID = :vet";
        return $this->query($query, ['id' => $id, 'vet' => $vetId]);
    }
}
