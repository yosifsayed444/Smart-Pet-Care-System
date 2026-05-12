<?php

class Certification
{
    use Model;

    protected $table = 'provider_certifications';
    protected $primaryKey = 'CertID';

    protected $allowedColumns = [
        'ProviderID',
        'CertName',
        'FilePath',
        'Status',
        'SubmittedAt'
    ];

    public function getByProvider($providerId)
    {
        $query = "SELECT * FROM provider_certifications WHERE ProviderID = :ProviderID ORDER BY SubmittedAt DESC";
        return $this->query($query, ['ProviderID' => $providerId]);
    }

    public function getPending()
    {
        $query = "SELECT c.*, u.username as ProviderName
                  FROM provider_certifications c
                  JOIN users u ON c.ProviderID = u.id
                  WHERE c.Status = 'Pending'
                  ORDER BY c.SubmittedAt ASC";
        return $this->query($query);
    }

    public function updateStatus($certId, $status)
    {
        $query = "UPDATE provider_certifications SET Status = :Status WHERE CertID = :CertID";
        return $this->query($query, ['Status' => $status, 'CertID' => $certId]);
    }
}
