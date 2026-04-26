<?php
require_once 'App/Core/config.php';
require_once 'App/Core/Database.php';
require_once 'App/Core/Model.php';
require_once 'App/models/Booking.php';

$bookingModel = new Booking();
$booking_id = 12;
$result = $bookingModel->update($booking_id, [
    'BookingDate' => '2026-04-26',
    'StartTime' => '10:00:00',
    'EndTime' => '11:00:00'
]);

var_dump($result);
