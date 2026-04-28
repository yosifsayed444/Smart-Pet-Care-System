<?php

class LostPet
{
    use Model;
    protected $table = 'lost_pets';
    protected $allowedColumns = ['PetID', 'OwnerID', 'Description', 'Location', 'Status', 'DateReported'];

    public function getAllWithDetails()
    {
        $query = "SELECT lp.*, p.PetName FROM {$this->table} lp LEFT JOIN pet p ON lp.PetID = p.PetID ORDER BY lp.DateReported DESC";
        return $this->query($query);
    }
}
