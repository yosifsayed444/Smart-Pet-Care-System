<?php

class Veterinarian
{
    use Model;

    protected $table = 'veterinarian';

    protected $allowedColumns = [
        'Name',
        'Specialization',
        'LicenseNumber'
    ];

    public function getById($vetId)
    {
        $query  = "SELECT * FROM veterinarian WHERE VetID = :VetID";
        $result = $this->query($query, ['VetID' => $vetId]);
        return !empty($result) ? $result[0] : false;
    }

    public function getAppointments($vetId)
    {
        $query = "SELECT a.*, p.PetName, p.Species, u.username AS OwnerName
                  FROM appointment a
                  JOIN pet p ON a.PetID = p.PetID
                  JOIN users u ON a.OwnerID = u.id
                  WHERE a.VetID = :VetID
                  ORDER BY a.AppointmentDate DESC";
        return $this->query($query, ['VetID' => $vetId]);
    }

    public function getPatientsForVet($vetId)
    {
        $query = "SELECT DISTINCT p.*
                  FROM pet p
                  JOIN appointment a ON a.PetID = p.PetID
                  WHERE a.VetID = :VetID";
        return $this->query($query, ['VetID' => $vetId]);
    }

    public function getAllPets()
    {
        $query = "SELECT p.*, u.username AS OwnerName
                  FROM pet p
                  JOIN users u ON p.OwnerID = u.id
                  ORDER BY p.PetName";
        return $this->query($query);
    }
}
