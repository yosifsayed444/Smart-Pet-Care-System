<?php
require_once "App/Core/config.php";
require_once "App/Core/Database.php";

class DBCheck {
    use Database;
}

$db = new DBCheck();
$con = $db->connect();

echo "Columns in appointment:\n";
$res = $con->query("DESCRIBE appointment");
$cols = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($cols as $c) {
    echo "  - " . $c['Field'] . " (" . $c['Type'] . ")\n";
}
?>
