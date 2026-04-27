<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

$query = "SELECT * FROM booking WHERE BookingDate = '2026-04-27'";
$res = $con->query($query);
$bookings = $res->fetchAll(PDO::FETCH_ASSOC);

echo "Bookings for 2026-04-27:\n";
foreach ($bookings as $b) {
    echo "- ID: " . $b['BookingID'] . ", Provider: " . $b['ProviderID'] . ", Time: " . $b['StartTime'] . " - " . $b['EndTime'] . "\n";
}
?>
