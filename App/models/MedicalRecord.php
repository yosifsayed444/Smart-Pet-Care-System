<?php

class MedicalRecord
{
    use Model;

    protected $table = 'MedicalRecord';
    protected $primaryKey = 'RecordID';
    protected $allowedColumns = [
        'PetID',
        'VetID',
        'Behavior',
        'RecordDate',
        'Diagnosis',
        'LabNotes',
        'LabFile'
    ];

    public function getRecordById($recordId)
    {
        $query = "SELECT * FROM MedicalRecord WHERE RecordID = :RecordID";
        $result = $this->query($query, ['RecordID' => $recordId]);

        if ($result && is_array($result) && count($result) > 0) {
            return $result[0];
        }
        return false;
    }

    public function addRecord($data)
    {
        return $this->insertFiltered($data);
    }

    public function updateRecord($recordId, $data)
    {
        return $this->updateFiltered($recordId, $data);
    }

    public function deleteRecord($recordId)
    {
        $query = "DELETE FROM MedicalRecord WHERE RecordID = :RecordID";
        return $this->query($query, ['RecordID' => $recordId]);
    }

    
    
    

    public function addCondition($data)
    {
        $query = "INSERT INTO ChronicCondition (PetID, ConditionName) VALUES (:PetID, :ConditionName)";
        return $this->query($query, $data);
    }

    public function getConditions($petId)
    {
        $query = "SELECT * FROM ChronicCondition WHERE PetID = :PetID";
        return $this->query($query, ['PetID' => $petId]);
    }

    public function deleteCondition($id)
    {
        $query = "DELETE FROM ChronicCondition WHERE ConditionID = :id";
        return $this->query($query, ['id' => $id]);
    }

    
    
    

    public function getBehavior($petId)
    {
        $query = "SELECT RecordID, PetID, Behavior, RecordDate FROM MedicalRecord WHERE PetID = :PetID ORDER BY RecordDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }

    public function updateBehavior($data)
    {
        $query = "UPDATE MedicalRecord SET Behavior = :Behavior WHERE RecordID = :RecordID";
        return $this->query($query, $data);
    }

    public function viewMedicalNotes($petId)
    {
        $query = "SELECT * FROM MedicalRecord WHERE PetID = :PetID ORDER BY RecordDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }

    

    public function addLabResult($data)
    {
        return $this->addRecord($data);
    }

    public function getLabResults($vetId)
    {
        $query = "SELECT mr.*, p.PetName
                  FROM MedicalRecord mr
                  JOIN pet p ON mr.PetID = p.PetID
                  WHERE mr.VetID = :VetID
                  ORDER BY mr.RecordDate DESC";
        return $this->query($query, ['VetID' => $vetId]);
    }

    

    public function getMedicalNotesByVet($vetId)
    {
        return $this->getLabResults($vetId);
    }

    public function getMedicalNotesByPet($petId)
    {
        $query = "SELECT mr.*, v.Name as VetName 
                  FROM MedicalRecord mr 
                  LEFT JOIN veterinarian v ON mr.VetID = v.VetID
                  WHERE mr.PetID = :PetID 
                  ORDER BY mr.RecordDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }

    public function getLabResultsByPet($petId)
    {
        $query = "SELECT mr.*, v.Name as VetName 
                  FROM MedicalRecord mr 
                  LEFT JOIN veterinarian v ON mr.VetID = v.VetID
                  WHERE mr.PetID = :PetID 
                  AND (mr.LabFile IS NOT NULL OR mr.LabNotes IS NOT NULL) 
                  ORDER BY mr.RecordDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }
}
