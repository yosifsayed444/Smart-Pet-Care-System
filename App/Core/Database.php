<?php

trait Database
{
    private function connect()
    {
        $string     = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $connection = new PDO($string, DBUSER, DBPASS);
        return $connection;
    }
   private function query($query, $data = [])
    {
        $stmt  = $this->connect()->prepare($query);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result) > 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
  
}
