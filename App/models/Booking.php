<?php

class Booking
{
    use Model;

    protected $table = 'booking';

    protected $allowedColumns = [
        'PetID',
        'OwnerID',
        'ProviderID',
        'BookingDate',
        'StartTime',
        'EndTime'
    ];

    public function getByProvider($provider_id)
    {
        $query = "SELECT * FROM booking WHERE ProviderID = :provider_id";
        return $this->query($query, ['provider_id' => $provider_id]);
    }

    public function hasConflict($provider_id, $date, $start, $end, $exclude_id = null)
    {
        $query = "SELECT * FROM booking 
                  WHERE ProviderID = :provider_id 
                  AND BookingDate = :date 
                  AND (
                      (StartTime < :end AND EndTime > :start)
                  )";
        
        $params = [
            'provider_id' => $provider_id,
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
        $keys = array_keys($data);
        $set  = "";

        foreach ($keys as $key) {
            $set .= "$key = :$key, ";
        }

        $set        = rtrim($set, ', ');
        $data['id'] = $id;

        $query = "UPDATE $this->table SET $set WHERE BookingID = :id";

        return $this->query($query, $data);
    }
}
