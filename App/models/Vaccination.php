<?php

class Vaccination
{
    use Model;

    protected $table = 'vaccination';

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
        // All vaccinations for pets that have appointments with this vet
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
        $data = array_intersect_key($data, array_flip($this->allowedColumns));
        $keys    = array_keys($data);
        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);
        $query   = "INSERT INTO vaccination ($columns) VALUES ($values)";
        return $this->query($query, $data);
    }

    public function updateVaccination($id, $data)
    {
        $data = array_intersect_key($data, array_flip($this->allowedColumns));
        $set = '';
        foreach (array_keys($data) as $key) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $data['VaccinationID'] = $id;
        $query = "UPDATE vaccination SET $set WHERE VaccinationID = :VaccinationID";
        return $this->query($query, $data);
    }

    public function deleteVaccination($id)
    {
        $query = "DELETE FROM vaccination WHERE VaccinationID = :VaccinationID";
        return $this->query($query, ['VaccinationID' => $id]);
    }

    // Upcoming vaccinations (NextDate within 30 days)
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
