<?php

trait Model
{
    use Database;

    protected function getPrimaryKey()
    {
        return property_exists($this, 'primaryKey') ? $this->primaryKey : 'id';
    }

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

        $pk = $this->getPrimaryKey();
        $query = "UPDATE $this->table SET $set WHERE $pk = :id";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $pk = $this->getPrimaryKey();
        $query = "DELETE FROM $this->table WHERE $pk = :id";

        return $this->query($query, ['id' => $id]);
    }

    public function insertFiltered($data)
    {
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }
        return $this->insert($data);
    }

    public function updateFiltered($id, $data)
    {
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }
        return $this->update($id, $data);
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
    public function lastInsertId()
    {
        $connection = $this->connect();
        return $connection->lastInsertId();
    }
}
