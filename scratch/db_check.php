<?php
require 'App/Core/config.php';
$string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";
$pdo = new PDO($string, DBUSER, DBPASS);

echo "Order table:\n";
$stmt = $pdo->query("DESCRIBE `order` ");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

echo "\nOrderDetails table:\n";
$stmt = $pdo->query("DESCRIBE orderdetails");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
