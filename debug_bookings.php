<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

$query = "SELECT * FROM booking";
$res = $con->query($query);
$bookings = $res->fetchAll(PDO::FETCH_ASSOC);

echo "All Bookings:\n";
foreach ($bookings as $b) {
    print_r($b);
}

$query = "SELECT * FROM user WHERE Role = 'Provider'";
$res = $con->query($query);
$providers = $res->fetchAll(PDO::FETCH_ASSOC);

echo "\nProviders:\n";
foreach ($providers as $p) {
    echo "UserID: " . $p['UserID'] . ", Name: " . $p['Name'] . "\n";
}

$query = "SELECT * FROM serviceprovider";
$res = $con->query($query);
$sp = $res->fetchAll(PDO::FETCH_ASSOC);

echo "\nServiceProviders Table:\n";
foreach ($sp as $s) {
    echo "ProviderID: " . $s['ProviderID'] . ", Name: " . $s['Name'] . "\n";
}
?>
