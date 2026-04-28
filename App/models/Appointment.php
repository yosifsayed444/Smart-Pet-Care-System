<?php

class Appointment
{
    use Model;

    protected $table = 'appointment';
    protected $primaryKey = 'AppointmentID';

    protected $allowedColumns = [
        'OwnerID',
        'PetID',
        'VetID',
        'AppointmentDate',
        'status'
    ];

    public function deleteAppointment($id)
    {
        $query = "DELETE FROM $this->table WHERE AppointmentID = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function updateStatus($id, $status)
    {
        $data = [
            'status' => $status,
            'id' => $id
        ];
        $query = "UPDATE appointment SET status = :status WHERE AppointmentID = :id";
        return $this->query($query, $data);
    }

    public function getByOwner($ownerId)
    {
        $query = "SELECT a.*, p.PetName, u.username as VetName, v.Specialization
                  FROM appointment a
                  JOIN pet p ON a.PetID = p.PetID
                  JOIN users u ON a.VetID = u.id
                  LEFT JOIN veterinarian v ON a.VetID = v.VetID
                  WHERE a.OwnerID = :owner_id
                  ORDER BY a.AppointmentDate DESC";
        return $this->query($query, ['owner_id' => $ownerId]);
    }

    public function getByVet($vetId)
    {
        $query = "SELECT a.*, p.PetName, p.Species, u.username as OwnerName
                  FROM appointment a
                  JOIN pet p ON a.PetID = p.PetID
                  JOIN users u ON a.OwnerID = u.id
                  WHERE a.VetID = :vet_id
                  ORDER BY a.AppointmentDate ASC";
        return $this->query($query, ['vet_id' => $vetId]);
    }

    public function hasConflict($vetId, $date, $excludeId = null)
    {
        $query = "SELECT * FROM appointment WHERE VetID = :vet_id AND AppointmentDate = :date";
        $params = ['vet_id' => $vetId, 'date' => $date];

        if ($excludeId) {
            $query .= " AND AppointmentID != :exclude_id";
            $params['exclude_id'] = $excludeId;
        }

        $res = $this->query($query, $params);
        return !empty($res);
    }

    public function getAllAppointments()
    {
        $query = "SELECT a.*, p.PetName, uo.username as OwnerName, uv.username as VetName 
                  FROM appointment a
                  JOIN pet p ON a.PetID = p.PetID
                  JOIN users uo ON a.OwnerID = uo.id
                  JOIN users uv ON a.VetID = uv.id
                  ORDER BY a.AppointmentDate DESC";
        return $this->query($query);
    }
}