<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

echo "Tables in database:\n";
$res = $con->query("SHOW TABLES");
$tables = $res->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $t) {
    echo "- $t\n";
}

foreach ($tables as $t) {
    echo "\nColumns in $t:\n";
    $res = $con->query("DESCRIBE `$t` ");
    $cols = $res->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $c) {
        echo "  - " . $c['Field'] . " (" . $c['Type'] . ")\n";
    }
}
?>
