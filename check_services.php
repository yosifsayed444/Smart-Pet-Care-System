<?php
require 'App/Core/config.php';
require 'App/Core/Database.php';
class DB { use Database; }
$db = new DB();
$con = $db->connect();
echo "--- provider_services ---\n";
print_r($con->query('DESCRIBE provider_services')->fetchAll(PDO::FETCH_ASSOC));
