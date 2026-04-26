<?php

class AdminController extends Controller
{
    public function dashboard(){
        Middleware::requireRole('Admin');
        $this->view("admin/dashboard");
    }

    // Users
    public function users(){}
    public function addUser(){}
    public function editUser($id){}
    public function deleteUser($id){}

    // Products
    public function products(){}
    public function addProduct(){}
    public function editProduct($id){}
    public function deleteProduct($id){}

    // Orders
    public function orders(){}
    public function updateOrderStatus($id){}

    // Appointments
    public function appointments(){}

    // System
    public function manageRoles(){}
    public function lostPetBroadcast(){}
    public function notificationEscalator(){}
    public function manageDisputes(){}
    public function auditLogs(){}
    public function suspendUsers(){}
    public function healthAlerts(){}
    public function archiveData(){}
    public function manageCurrency(){}
    public function verifyUsers(){}

    // Reports
    public function reports(){}
    public function salesReport(){}
    public function userReport(){}
    public function appointmentReport(){}
}