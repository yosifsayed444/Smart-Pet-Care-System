<?php
require 'App/Core/init.php';
$appointment = new Appointment();
$appointments = $appointment->fetchAll();
var_dump($appointments);
$totalAppointments = is_array($appointments) ? count($appointments) : 0;
var_dump($totalAppointments);
