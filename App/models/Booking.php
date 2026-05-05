<?php

class Booking
{
    use Model;

    protected $table = 'booking';
    protected $primaryKey = 'BookingID';

    protected $allowedColumns = [
        'PetID',
        'OwnerID',
        'ProviderID',
        'service_id',
        'status',
        'BookingDate',
        'StartTime',
        'EndTime',
        'EscrowStatus',
        'EscrowAmount',
        'CheckInTime',
        'CheckOutTime',
        'QRToken'
    ];

    public function getByProvider($provider_id)
    {
        $query = "SELECT b.*, p.PetName, u.username as owner_name 
                  FROM booking b
                  LEFT JOIN pet p ON b.PetID = p.PetID
                  LEFT JOIN users u ON b.OwnerID = u.id
                  WHERE b.ProviderID = :provider_id
                  ORDER BY b.BookingDate DESC, b.StartTime DESC";
        return $this->query($query, ['provider_id' => $provider_id]);
    }

    public function getByOwner($owner_id)
    {
        $query = "SELECT b.*, p.PetName, s.Name as provider_name, ps.name as service_name 
                  FROM booking b
                  JOIN pet p ON b.PetID = p.PetID
                  LEFT JOIN serviceprovider s ON b.ProviderID = s.ProviderID
                  LEFT JOIN provider_services ps ON b.service_id = ps.id
                  WHERE b.OwnerID = :owner_id
                  ORDER BY b.BookingDate DESC, b.StartTime DESC";
        return $this->query($query, ['owner_id' => $owner_id]);
    }


    public function hasConflict($provider_id, $date, $start, $end, $service_id, $exclude_id = null)
    {
        $query = "SELECT * FROM booking 
                  WHERE ProviderID = :provider_id 
                  AND service_id = :service_id
                  AND BookingDate = :date 
                  AND (
                      (StartTime < :end AND EndTime > :start)
                  )";
        
        $params = [
            'provider_id' => $provider_id,
            'service_id' => $service_id,
            'date' => $date,
            'start' => $start,
            'end' => $end
        ];

        if ($exclude_id) {
            $query .= " AND BookingID != :exclude_id";
            $params['exclude_id'] = $exclude_id;
        }

        $result = $this->query($query, $params);
        return !empty($result);
    }

    public function updateByBookingId($id, $data)
    {
        return $this->update($id, $data);
    }
    public function getAllBookings()
    {
        $query = "SELECT b.*, p.PetName, u.username as OwnerName, s.Name as ProviderName 
                  FROM booking b
                  LEFT JOIN pet p ON b.PetID = p.PetID
                  LEFT JOIN users u ON b.OwnerID = u.id
                  LEFT JOIN serviceprovider s ON b.ProviderID = s.ProviderID
                  ORDER BY b.BookingDate DESC";
        return $this->query($query);
    }

    public function getForEscrow($provider_id)
    {
        $query = "SELECT b.*, p.PetName, u.username as owner_name 
                  FROM booking b
                  LEFT JOIN pet p ON b.PetID = p.PetID
                  LEFT JOIN users u ON b.OwnerID = u.id
                  WHERE b.ProviderID = :provider_id AND b.EscrowStatus IS NOT NULL
                  ORDER BY b.BookingDate DESC";
        return $this->query($query, ['provider_id' => $provider_id]);
    }

    public function releaseFunds($id)
    {
        $query = "UPDATE $this->table SET EscrowStatus = 'Released' WHERE BookingID = :id";
        return $this->query($query, ['id' => $id]);
    }
}
