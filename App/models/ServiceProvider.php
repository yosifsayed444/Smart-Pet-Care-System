<?php

class ServiceProvider
{
    use Model;

    protected $table = 'serviceprovider';

    protected $allowedColumns = [
        'Name',
        'ServiceType'
    ];

    
    public function addService($data)
    {
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);

        $query = "INSERT INTO provider_services ($columns) VALUES ($values)";
        return $this->query($query, $data);
    }

    public function updateServicePrice($service_id, $price)
    {
        $query = "UPDATE provider_services SET price = :price WHERE id = :id";
        return $this->query($query, ['price' => $price, 'id' => $service_id]);
    }

    public function deleteService($service_id, $provider_id)
    {
        $query = "DELETE FROM provider_services WHERE id = :id AND provider_id = :provider_id";
        return $this->query($query, ['id' => $service_id, 'provider_id' => $provider_id]);
    }

    public function deleteAvailability($slot_id, $provider_id)
    {
        $query = "DELETE FROM provider_availability WHERE id = :id AND provider_id = :provider_id";
        return $this->query($query, ['id' => $slot_id, 'provider_id' => $provider_id]);
    }

    public function getServices($provider_id)
    {
        $query = "SELECT * FROM provider_services WHERE provider_id = :provider_id";
        return $this->query($query, ['provider_id' => $provider_id]);
    }

    
    public function setAvailability($data)
    {
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);

        $query = "INSERT INTO provider_availability ($columns) VALUES ($values)";
        return $this->query($query, $data);
    }

    public function getAvailability($provider_id)
    {
        $query = "SELECT * FROM provider_availability WHERE provider_id = :provider_id ORDER BY available_date, start_time";
        return $this->query($query, ['provider_id' => $provider_id]);
    }

    public function checkAvailability($provider_id, $date, $start_time, $end_time)
    {
        
        $query = "SELECT * FROM provider_availability 
                  WHERE provider_id = :provider_id 
                  AND available_date = :date 
                  AND start_time <= :start_time 
                  AND end_time >= :end_time";
        $result = $this->query($query, [
            'provider_id' => $provider_id,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);

        return !empty($result);
    }

    public function resolveConflict($booking_id, $new_date, $new_start_time, $new_end_time, $expected_provider_id = null)
    {
        $bookingModel = new Booking();
        $booking = $bookingModel->first(['BookingID' => $booking_id]);

        if ($booking) {
            if ($expected_provider_id !== null && (int)$booking['ProviderID'] !== (int)$expected_provider_id) {
                return false;
            }

            if (!$new_date || !$new_start_time || !$new_end_time) {
                return false;
            }

            if (strtotime($new_start_time) === false || strtotime($new_end_time) === false) {
                return false;
            }

            if (strtotime($new_start_time) >= strtotime($new_end_time)) {
                return false;
            }

            $isAvailable = $this->checkAvailability($booking['ProviderID'], $new_date, $new_start_time, $new_end_time);
            
            
            $hasConflict = $bookingModel->hasConflict($booking['ProviderID'], $new_date, $new_start_time, $new_end_time, $booking['service_id'], $booking_id);

            if ($isAvailable && !$hasConflict) {
                
                return $bookingModel->updateByBookingId($booking_id, [
                    'BookingDate' => $new_date,
                    'StartTime' => $new_start_time,
                    'EndTime' => $new_end_time
                ]);
            }
        }
        return false;
    }

    public function findFirstConflict($provider_id)
    {
        $bookingModel = new Booking();
        $bookings = $bookingModel->getByProvider($provider_id);

        if (empty($bookings)) {
            return false;
        }

        foreach ($bookings as $b) {
            $date = $b['BookingDate'] ?? null;
            $start = $b['StartTime'] ?? null;
            $end = $b['EndTime'] ?? null;
            $bookingId = $b['BookingID'] ?? null;

            if (!$date || !$start || !$end || !$bookingId) {
                continue;
            }

            $isAvailable = $this->checkAvailability($provider_id, $date, $start, $end);
            $hasConflict = $bookingModel->hasConflict($provider_id, $date, $start, $end, $b['service_id'], $bookingId);

            
            if (!$isAvailable || $hasConflict) {
                return $b;
            }
        }

        return false;
    }

    
    public function getRecentServices($limit = 4)
    {
        $query = "SELECT s.*, p.Name as provider_name, 
                  (SELECT COUNT(*) FROM provider_certifications c WHERE c.ProviderID = s.provider_id AND c.Status = 'Verified') as is_verified
                  FROM provider_services s
                  LEFT JOIN serviceprovider p ON s.provider_id = p.ProviderID
                  ORDER BY s.id DESC
                  LIMIT $limit";
        return $this->query($query);
    }

    
    public function getAllServices()
    {
        $query = "SELECT s.*, p.Name as provider_name,
                  (SELECT COUNT(*) FROM provider_certifications c WHERE c.ProviderID = s.provider_id AND c.Status = 'Verified') as is_verified
                  FROM provider_services s
                  LEFT JOIN serviceprovider p ON s.provider_id = p.ProviderID
                  ORDER BY s.id DESC";
        return $this->query($query);
    }

    public function getServiceById($id)
    {
        $query = "SELECT s.*, p.Name as provider_name,
                  (SELECT COUNT(*) FROM provider_certifications c WHERE c.ProviderID = s.provider_id AND c.Status = 'Verified') as is_verified
                  FROM provider_services s
                  LEFT JOIN serviceprovider p ON s.provider_id = p.ProviderID
                  WHERE s.id = :id";
        $result = $this->query($query, ['id' => $id]);
        return !empty($result) ? $result[0] : false;
    }
}
