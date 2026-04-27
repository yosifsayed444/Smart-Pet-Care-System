<?php
require 'App/Core/config.php';
require 'App/Core/Database.php';
class DB { use Database; }
$db = new DB();
$con = $db->connect();
echo "--- serviceprovider ---\n";
print_r($con->query('SELECT * FROM serviceprovider')->fetchAll(PDO::FETCH_ASSOC));
echo "--- users (id, username, role) ---\n";
print_r($con->query('SELECT id, username, role FROM users WHERE role = "Provider"')->fetchAll(PDO::FETCH_ASSOC));
