<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

echo "Vets in 'veterinarian' table:\n";
$res = $con->query("SELECT * FROM veterinarian");
print_r($res->fetchAll(PDO::FETCH_ASSOC));

echo "\nVets in 'users' table:\n";
$res = $con->query("SELECT * FROM users WHERE role = 'Vet'");
print_r($res->fetchAll(PDO::FETCH_ASSOC));
?>
