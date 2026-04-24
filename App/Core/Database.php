<?php

trait Database
{
    private function connect()
    {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $connection = new PDO($string, DBUSER, DBPASS, $options);
        return $connection;
    }

    private function query($query, $data = [])
    {
        try {
            $stmt  = $this->connect()->prepare($query);
            $check = $stmt->execute($data);

            if ($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (is_array($result) && count($result) > 0) {
                    return $result;
                } else {
                    // للـ INSERT/UPDATE/DELETE نرجع true بدل false
                    return $stmt->rowCount() > 0 ? true : false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // في production غير السطر ده لـ log بدل عرض الخطأ
            error_log("DB Error: " . $e->getMessage());
            return false;
        }
    }
}
