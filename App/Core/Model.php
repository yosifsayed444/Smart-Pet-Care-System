<?php

trait Model
{
    use Database;

    public function insert($data)
    {
        $keys = array_keys($data);

        $columns = implode(',', $keys);
        $values  = ':' . implode(', :', $keys);

        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";

        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        $keys = array_keys($data);
        $set  = "";

        foreach ($keys as $key) {
            $set .= "$key = :$key, ";
        }

        $set        = rtrim($set, ', ');
        $data['id'] = $id;

        $query = "UPDATE $this->table SET $set WHERE id = :id";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";

        return $this->query($query, ['id' => $id]);
    }

    public function where($data)
    {
        $keys       = array_keys($data);
        $conditions = [];

        foreach ($keys as $key) {
            $conditions[] = "$key = :$key";
        }

        $conditions = implode(" AND ", $conditions);
        $query      = "SELECT * FROM $this->table WHERE $conditions";

        return $this->query($query, $data);
    }

    public function first($data)
    {
        $result = $this->where($data);

        if ($result && is_array($result) && count($result) > 0) {
            return $result[0];
        }

        return false;
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM $this->table";

        return $this->query($query);
    }
}
