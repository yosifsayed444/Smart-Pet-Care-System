<?php

class Incident
{
    use Model;

    protected $table = 'incidents';
    protected $primaryKey = 'IncidentID';

    protected $allowedColumns = [
        'BookingID',
        'SitterID',
        'OwnerID',
        'PetID',
        'Description',
        'Severity',
        'Status',
        'ReportedAt'
    ];

    public function getByOwner($ownerId)
    {
        $query = "SELECT i.*, p.PetName, s.Name as SitterName 
                  FROM incidents i
                  LEFT JOIN pet p ON i.PetID = p.PetID
                  LEFT JOIN serviceprovider s ON i.SitterID = s.ProviderID
                  WHERE i.OwnerID = :OwnerID
                  ORDER BY i.ReportedAt DESC";
        return $this->query($query, ['OwnerID' => $ownerId]);
    }

    public function getBySitter($sitterId)
    {
        $query = "SELECT i.*, p.PetName 
                  FROM incidents i
                  LEFT JOIN pet p ON i.PetID = p.PetID
                  WHERE i.SitterID = :SitterID
                  ORDER BY i.ReportedAt DESC";
        return $this->query($query, ['SitterID' => $sitterId]);
    }

    public function getOpenByOwner($ownerId)
    {
        $query = "SELECT count(*) as count FROM incidents WHERE OwnerID = :OwnerID AND Status = 'Open'";
        $res = $this->query($query, ['OwnerID' => $ownerId]);
        return $res ? $res[0]['count'] : 0;
    }
}
