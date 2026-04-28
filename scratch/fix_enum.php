<?php
require 'App/Core/config.php';
$string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";
$pdo = new PDO($string, DBUSER, DBPASS);

$query = "ALTER TABLE `order` MODIFY COLUMN Status ENUM('Pending', 'Cancelled', 'Completed', 'Confirmed') NOT NULL DEFAULT 'Pending'";
$pdo->exec($query);
echo "Enum updated successfully!";
