<?php
require 'App/Core/config.php';
require 'App/Core/Database.php';
class DB { use Database; }
$db = new DB();
$con = $db->connect();
$res = $con->query('SHOW TABLES');
print_r($res->fetchAll(PDO::FETCH_COLUMN));
