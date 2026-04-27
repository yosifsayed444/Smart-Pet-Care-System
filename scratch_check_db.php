<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

$query = "DESCRIBE provider_services";
$res = $con->query($query);
$columns = $res->fetchAll(PDO::FETCH_ASSOC);

echo "Columns in provider_services:\n";
foreach ($columns as $col) {
    echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
}
?>
