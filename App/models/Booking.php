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
        'QRToken',
        'TotalPrice'
    ];

    public function calculateTotalCost($service_id, $duration_hours = 1, $pet_count = 1, $is_holiday = false)
    {
        $query = "SELECT * FROM provider_services WHERE id = :id";
        $service = $this->query($query, ['id' => $service_id]);

        if (empty($service)) return 0;
        $service = $service[0];

        $base = (float)$service['price'];
        $durMult = (float)($service['duration_multiplier'] ?? 1.0);
        $specMult = (float)($service['species_multiplier'] ?? 1.0);
        $holidaySurcharge = (float)($service['holiday_surcharge'] ?? 0.0);
        $multiPetDiscount = (float)($service['multi_pet_discount'] ?? 0.0);

        
        $total = ($base * $durMult * $duration_hours) * $specMult;

        
        if ($is_holiday) {
            $total += $holidaySurcharge;
        }

        
        if ($pet_count > 1) {
            $total -= ($multi_pet_discount * ($pet_count - 1));
        }

        return max($total, $base); 
    }

    public function getByProvider($provider_id)
    {
        $query = "SELECT b.*, p.PetName, p.HandlingInstructions, p.BehaviorNotes, u.username as owner_name 
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
