<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBUpdate {
    use Database;
}

$db = new DBUpdate();
$con = $db->connect();

try {
    $con->exec("ALTER TABLE `appointment` ADD COLUMN `status` ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending'");
    echo "Successfully added 'status' column to 'appointment' table.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column 'status' already exists.\n";
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
?>
