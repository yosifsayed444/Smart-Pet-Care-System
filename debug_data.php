<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

$query = "SELECT * FROM provider_services";
$res = $con->query($query);
$services = $res->fetchAll(PDO::FETCH_ASSOC);

echo "All Services:\n";
foreach ($services as $s) {
    print_r($s);
}

$query = "SELECT * FROM booking";
$res = $con->query($query);
$bookings = $res->fetchAll(PDO::FETCH_ASSOC);

echo "\nAll Bookings:\n";
foreach ($bookings as $b) {
    print_r($b);
}
?>
