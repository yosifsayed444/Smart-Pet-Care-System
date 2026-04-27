<?php

class MedicalRecord
{
    use Model;

    protected $table = 'MedicalRecord';
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
        // Filter out non-allowed columns
        $data = array_intersect_key($data, array_flip($this->allowedColumns));
        
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);

        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        return $this->query($query, $data);
    }

    public function updateRecord($recordId, $data)
    {
        // Filter out non-allowed columns
        $data = array_intersect_key($data, array_flip($this->allowedColumns));

        $keys = array_keys($data);
        $set  = "";

        foreach ($keys as $key) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $data['RecordID'] = $recordId;
        $query = "UPDATE $this->table SET $set WHERE RecordID = :RecordID";
        
        return $this->query($query, $data);
    }

    public function deleteRecord($recordId)
    {
        $query = "DELETE FROM MedicalRecord WHERE RecordID = :RecordID";
        return $this->query($query, ['RecordID' => $recordId]);
    }

    // ==========================================
    // Chronic Condition Methods (ChronicCondition table)
    // ==========================================

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

    // ==========================================
    // Behavior and Notes Methods (Used by Controllers)
    // ==========================================

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

    // ── Lab Results ─────────────────────────────────────────────────────────

    public function addLabResult($data)
    {
        $data = array_intersect_key($data, array_flip($this->allowedColumns));
        $keys    = array_keys($data);
        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);
        $query   = "INSERT INTO MedicalRecord ($columns) VALUES ($values)";
        return $this->query($query, $data);
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

    // ── Medical Notes ────────────────────────────────────────────────────────

    public function getMedicalNotesByVet($vetId)
    {
        $query = "SELECT mr.*, p.PetName
                  FROM MedicalRecord mr
                  JOIN pet p ON mr.PetID = p.PetID
                  WHERE mr.VetID = :VetID
                  ORDER BY mr.RecordDate DESC";
        return $this->query($query, ['VetID' => $vetId]);
    }

    public function getMedicalNotesByPet($petId)
    {
        $query = "SELECT * FROM MedicalRecord WHERE PetID = :PetID ORDER BY RecordDate DESC";
        return $this->query($query, ['PetID' => $petId]);
    }
}