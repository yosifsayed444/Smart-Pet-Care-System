<?php

class AdminController extends Controller
{
    public function index()
    {
        Middleware::requireRole('Admin');
        redirect("admin/dashboard");
    }
    public function dashboard()
    {

        Middleware::requireRole('Admin');
        $user        = new User();
        $order       = new Order();
        $appointment = new Appointment();
        $booking     = new Booking();
        $users        = $user->fetchAll();
        $orders       = $order->fetchAll();
        $appointments = $appointment->fetchAll();
        $bookings     = $booking->fetchAll();
        $upcomingAppointments = 0;
        if (is_array($appointments)) {
            foreach ($appointments as $app) {
                if (strtotime($app['AppointmentDate']) >= strtotime(date('Y-m-d'))) {
                    $upcomingAppointments++;
                }
            }
        }

        $upcomingServices = 0;
        if (is_array($bookings)) {
            foreach ($bookings as $b) {
                if (strtotime($b['BookingDate']) >= strtotime(date('Y-m-d'))) {
                    $upcomingServices++;
                }
            }
        }

        $data['totalUsers']        = is_array($users) ? count($users) : 0;
        $data['totalOrders']       = is_array($orders) ? count($orders) : 0;
        $data['totalAppointments'] = $upcomingAppointments;
        $data['totalServices']     = $upcomingServices;
        $data['username']          = $_SESSION['username'] ?? 'Admin';

        $this->view("admin/dashboard", $data);
    }
    
    public function users()
    {

        Middleware::requireRole('Admin');

        $user = new User();
        $data['users'] = $user->fetchAll();
        $this->view("admin/users", $data);
    }
    public function addUser()
    {

        Middleware::requireRole('Admin');

        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $errors = Validator::validateUser(
                $_POST,
                $user
            );

            if (! empty($errors)) {

                $data['errors'] = $errors;
                $data['old']    = $_POST;

                $this->view("admin/addUser", $data);
                return;
            }

            $insertData = [

                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'phone'    => trim($_POST['phone']),
                'role'     => $_POST['role'],
                'password' => password_hash(
                    $_POST['password'],
                    PASSWORD_DEFAULT
                ),

            ];

            $user->insert($insertData);

            
            $lastRow = $user->query("SELECT id FROM users WHERE email = :email LIMIT 1", ['email' => $insertData['email']]);
            $lastId = !empty($lastRow) ? $lastRow[0]['id'] : null;

            
            if ($insertData['role'] === 'ServiceProvider' && $lastId) {
                $user->query("INSERT INTO serviceprovider (ProviderID, Name, ServiceType) VALUES (:id, :name, :type)", [
                    'id' => $lastId,
                    'name' => $insertData['username'],
                    'type' => 'General'
                ]);
            }

            
            if ($insertData['role'] === 'Vet' && $lastId) {
                $specialization = trim($_POST['specialization'] ?? 'General');
                $licenseNumber  = trim($_POST['license_number'] ?? 'VET-' . $lastId);
                $user->query(
                    "INSERT IGNORE INTO veterinarian (VetID, Name, Specialization, LicenseNumber) VALUES (:id, :name, :spec, :lic)",
                    [
                        'id'   => $lastId,
                        'name' => $insertData['username'],
                        'spec' => !empty($specialization) ? $specialization : 'General',
                        'lic'  => !empty($licenseNumber) ? $licenseNumber : 'VET-' . $lastId
                    ]
                );
            }

            $_SESSION['success'] =
                "User Added Successfully ✅";

            redirect("admin/users");
            exit;
        }

        $this->view("admin/addUser");
    }
    public function editUser($id)
    {

        Middleware::requireRole('Admin');

        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $errors = Validator::validateUser(
                $_POST,
                $user,
                $id
            );

            if (! empty($errors)) {

                $data['errors'] = $errors;
                $data['old']    = $_POST;

                $data['user'] = $user->first([
                    'id' => $id,
                ]);

                $this->view("admin/editUser", $data);
                return;
            }

            $updateData = [

                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'phone'    => trim($_POST['phone']),
                'role'     => $_POST['role'],

            ];

            $user->update($id, $updateData);

            
            if ($_POST['role'] === 'Vet') {
                $specialization = trim($_POST['specialization'] ?? 'General');
                $licenseNumber  = trim($_POST['license_number'] ?? 'VET-' . $id);

                $vetModel = new Veterinarian();
                $existingVet = $vetModel->getById($id);

                if ($existingVet) {
                    
                    $user->query(
                        "UPDATE veterinarian SET Name = :name, Specialization = :spec, LicenseNumber = :lic WHERE VetID = :id",
                        [
                            'id'   => $id,
                            'name' => $updateData['username'],
                            'spec' => !empty($specialization) ? $specialization : 'General',
                            'lic'  => !empty($licenseNumber) ? $licenseNumber : 'VET-' . $id
                        ]
                    );
                } else {
                    
                    $user->query(
                        "INSERT IGNORE INTO veterinarian (VetID, Name, Specialization, LicenseNumber) VALUES (:id, :name, :spec, :lic)",
                        [
                            'id'   => $id,
                            'name' => $updateData['username'],
                            'spec' => !empty($specialization) ? $specialization : 'General',
                            'lic'  => !empty($licenseNumber) ? $licenseNumber : 'VET-' . $id
                        ]
                    );
                }
            }

            $_SESSION['success'] =
                "User Updated Successfully ✅";

            redirect("admin/users");
            exit;
        }

        $data['user'] = $user->first([
            'id' => $id,
        ]);

        if ($data['user'] && $data['user']['role'] === 'Vet') {
            $vetModel = new Veterinarian();
            $data['vet'] = $vetModel->getById($id);
        }

        $this->view("admin/editUser", $data);
    }

    public function deleteUser($id)
    {
        Middleware::requireRole('Admin');

        // Prevent self-deletion
        if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
            $_SESSION['error'] = "You cannot delete your own admin account! ❌";
            redirect("admin/users");
            exit;
        }

        $userModel = new User();
        $user = $userModel->first(['id' => $id]);

        if ($user) {
            // Delete related records sequentially to avoid foreign key constraint issues
            
            // 1. Order Details and Orders
            $userModel->query("DELETE FROM orderdetails WHERE OrderID IN (SELECT OrderID FROM `order` WHERE UserID = :id)", ['id' => $id]);
            $userModel->query("DELETE FROM `order` WHERE UserID = :id", ['id' => $id]);

            // 2. Bookings
            $userModel->query("DELETE FROM booking WHERE OwnerID = :id OR ProviderID = :id", ['id' => $id]);

            // 3. Appointments
            $userModel->query("DELETE FROM appointment WHERE OwnerID = :id OR VetID = :id", ['id' => $id]);

            // 4. Notifications
            $userModel->query("DELETE FROM notifications WHERE user_id = :id", ['id' => $id]);

            // 5. Reviews
            $userModel->query("DELETE FROM provider_reviews WHERE user_id = :id OR provider_id = :id", ['id' => $id]);

            // 6. Role-specific cleanup
            if ($user['role'] === 'ServiceProvider') {
                $userModel->query("DELETE FROM provider_services WHERE provider_id = :id", ['id' => $id]);
                $userModel->query("DELETE FROM provider_availability WHERE provider_id = :id", ['id' => $id]);
                $userModel->query("DELETE FROM provider_certifications WHERE ProviderID = :id", ['id' => $id]);
                $userModel->query("DELETE FROM serviceprovider WHERE ProviderID = :id", ['id' => $id]);
            }

            if ($user['role'] === 'Vet') {
                $userModel->query("DELETE FROM prescription WHERE VetID = :id", ['id' => $id]);
                $userModel->query("DELETE FROM MedicalRecord WHERE VetID = :id", ['id' => $id]);
                $userModel->query("DELETE FROM veterinarian WHERE VetID = :id", ['id' => $id]);
            }

            // 7. Pets and their related data
            // Clear all data linked to pets owned by this user
            $userModel->query("DELETE FROM ChronicCondition WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
            $userModel->query("DELETE FROM MedicalRecord WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
            $userModel->query("DELETE FROM vaccination WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
            $userModel->query("DELETE FROM prescription WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
            $userModel->query("DELETE FROM lost_pets WHERE OwnerID = :id", ['id' => $id]);
            $userModel->query("DELETE FROM pet WHERE OwnerID = :id", ['id' => $id]);

            // 8. Finally delete the user record
            $userModel->delete($id);

            $_SESSION['success'] = "User and all related data deleted successfully 🗑️";
        } else {
            $_SESSION['error'] = "User not found or already deleted.";
        }

        redirect("admin/users");
        exit;
    }

    
    public function products()
    {
        Middleware::requireRole('Admin');

        $product = new Product();

        $data['products'] = $product->fetchAll();

        $this->view("admin/products", $data);
    }
    public function addProduct()
    {
        Middleware::requireRole('Admin');

        $product = new Product();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $errors = Validator::validateProduct($_POST);

            if (! empty($errors)) {

                $data['errors'] = $errors;
                $data['old']    = $_POST;

                $this->view("admin/addProduct", $data);
                return;
            }

            $imageName = null;

            if (! empty($_FILES['image']['name'])) {

                $imageName = time() . "_" . $_FILES['image']['name'];

                $tmp = $_FILES['image']['tmp_name'];

                $folder = "uploads/products/";

                if (! is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

                move_uploaded_file($tmp, $folder . $imageName);
            }

            $data = [

                'Name'        => trim($_POST['Name'] ?? ''),

                'Ingredients' => trim($_POST['Ingredients'] ?? ''),

                'Price'       => trim($_POST['Price'] ?? ''),

                'stock'       => trim($_POST['stock'] ?? ''),

                'image'       => $imageName,
            ];

            $product->insert($data);

            $_SESSION['success'] =
                "Product Added Successfully ✅";

            redirect("admin/products");
            exit;
        }

        $this->view("admin/addProduct");
    }
    public function editProduct($id = null)
    {
        Middleware::requireRole('Admin');

        if (! $id) {

            redirect("admin/products");
            exit;
        }

        $product = new Product();

        $row = $product->first([
            'ProductID' => $id,
        ]);

        if (! $row) {

            redirect("admin/products");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $errors = Validator::validateProduct($_POST, true);

            if (empty($errors)) {

                $imageName = $row['image'];

                if (! empty($_FILES['image']['name'])) {

                    $allowed =
                        ['jpg', 'jpeg', 'png', 'webp'];

                    $ext = strtolower(
                        pathinfo(
                            $_FILES['image']['name'],
                            PATHINFO_EXTENSION
                        )
                    );

                    if (in_array($ext, $allowed)) {

                        $imageName =
                            time() . "_" .
                            $_FILES['image']['name'];

                        $tmp =
                            $_FILES['image']['tmp_name'];

                        $folder =
                            "uploads/products/";

                        

                        if (! is_dir($folder)) {

                            mkdir($folder, 0777, true);
                        }

                        

                        move_uploaded_file(
                            $tmp,
                            $folder . $imageName
                        );

                        

                        if (! empty($row['image'])) {

                            $oldImage =
                                $folder . $row['image'];

                            if (file_exists($oldImage)) {

                                unlink($oldImage);
                            }
                        }
                    }
                }

                

                $data = [

                    'Name'        => $_POST['Name'],

                    'Ingredients' => $_POST['Ingredients'],

                    'Price'       => $_POST['Price'],

                    'stock'       => $_POST['stock'],

                    'image'       => $imageName,

                ];

                $product->updateProduct($id, $data);

                $_SESSION['success'] =
                    "Product Updated Successfully ✏️";

                redirect("admin/products");
                exit;
            }

            $data['errors'] = $errors;

            $data['old'] = $_POST;
        }

        $data['row'] = $row;

        $this->view("admin/editProduct", $data);
    }

    public function deleteProduct($id = null)
    {
        Middleware::requireRole('Admin');

        if (! $id) {
            redirect("admin/products");
            exit;
        }

        $product = new Product();
        $row = $product->first(['ProductID' => $id]);

        if ($row) {
            
            if (!empty($row['image']) && strpos($row['image'], 'http') !== 0) {
                $filePath = "uploads/products/" . $row['image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            
            $product->deleteProduct($id);
            $_SESSION['success'] = "Product Deleted Successfully 🗑️";
        } else {
            $_SESSION['error'] = "Product not found.";
        }

        redirect("admin/products");
        exit;
    }

    
    public function orders()
    {
        Middleware::requireRole('Admin');
        
        $orderModel = new Order();
        $data['orders'] = $orderModel->getAllOrders();
        $data['username'] = $_SESSION['username'] ?? 'Admin';

        $this->view("admin/orders", $data);
    }

    public function services()
    {
        Middleware::requireRole('Admin');
        
        $serviceAppModel = new Booking();
        $data['serviceAppointments'] = $serviceAppModel->getAllBookings();
        $data['username'] = $_SESSION['username'] ?? 'Admin';

        $this->view("admin/services", $data);
    }

    public function updateOrderStatus($id)
    {
        Middleware::requireRole('Admin');
        
        $status = $_GET['status'] ?? 'Pending';
        $orderModel = new Order();
        
        
        $order = $orderModel->first(['OrderID' => $id]);
        
        if ($order) {
            if ($status === 'Confirmed' && $order['Status'] !== 'Confirmed') {
                
                $items = $orderModel->getOrderItems($id);
                $productModel = new Product();
                foreach ($items as $item) {
                    $productModel->reduceStock($item['ProductID'], $item['Quantity']);
                }
            }

            if ($orderModel->updateStatus($id, $status)) {
                
                $notifModel = new Notification();
                $notifModel->sendNotification($order['UserID'], "Your order #$id status has been updated to: $status", "Order");
                
                $_SESSION['success'] = "Order #$id status updated to $status ✅";
            } else {
                $_SESSION['error'] = "Failed to update order status.";
            }
        } else {
            $_SESSION['error'] = "Order not found.";
        }
        
        redirect("admin/orders");
    }

    
    public function appointments()
    {
        Middleware::requireRole('Admin');
        
        $vetAppModel = new Appointment();
        $serviceAppModel = new Booking();

        $data['vetAppointments'] = $vetAppModel->getAllAppointments();
        $data['serviceAppointments'] = $serviceAppModel->getAllBookings();
        $data['username'] = $_SESSION['username'] ?? 'Admin';

        $this->view("admin/appointments", $data);
    }

    public function lostPetBroadcast()
    {
        Middleware::requireRole('Admin');
        $lostPetModel = new LostPet();
        $petModel = new Pet();
        $userModel = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pet_id'])) {
            $petId = $_POST['pet_id'];
            $desc = $_POST['description'];
            $loc = $_POST['location'];
            $pet = $petModel->first(['PetID' => $petId]);
            
            
            $lostPetModel->insert([
                'PetID' => $petId,
                'OwnerID' => $pet['OwnerID'] ?? 0,
                'Description' => $desc,
                'Location' => $loc,
                'Status' => 'Lost'
            ]);

            
            $notifModel = new Notification();
            $users = $userModel->fetchAll();
            foreach ($users as $user) {
                $notifModel->sendNotification(
                    $user['id'],
                    "LOST PET ALERT: A pet has been reported lost in $loc. Description: $desc",
                    "LostPet"
                );
            }

            $_SESSION['success'] = "Lost pet broadcasted to all users!";
            redirect('admin/lostPetBroadcast');
        }

        $data['lostPets'] = $lostPetModel->getAllWithDetails();
        $data['pets'] = $petModel->fetchAll();
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/lost_pets', $data);
    }

    public function notificationEscalator()
    {
        Middleware::requireRole('Admin');
        $notifModel = new Notification();
        $userModel = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
            $msg = trim($_POST['message']);
            
            if (!empty($msg)) {
                $users = $userModel->fetchAll();
                
                foreach ($users as $user) {
                    $notifModel->sendNotification(
                        $user['id'],
                        $msg,
                        "System Broadcast"
                    );
                }

                $_SESSION['success'] = "System broadcast sent to all users successfully! 📢";
            } else {
                $_SESSION['error'] = "Notification message cannot be empty.";
            }
            redirect('admin/notificationEscalator');
        }

        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/notifications', $data);
    }
    public function manageDisputes()
    {}
    public function verifyUsers()
    {
        Middleware::requireRole('Admin');
        $userModel = new User();
        
        if (isset($_GET['approve'])) {
            $userModel->update($_GET['approve'], ['is_verified' => 1]);
            
            
            $notifModel = new Notification();
            $notifModel->sendNotification($_GET['approve'], "Your account has been verified!", "Verification");
            
            $_SESSION['success'] = "User verified successfully.";
            redirect('admin/verifyUsers');
        }

        $data['users'] = $userModel->where(['is_verified' => 0]);
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/verify_users', $data);
    }

    public function suspendUsers()
    {
        Middleware::requireRole('Admin');
        $userModel = new User();

        if (isset($_GET['toggle'])) {
            $user = $userModel->first(['id' => $_GET['toggle']]);
            if ($user) {
                $newStatus = ($user['status'] == 'Active') ? 'Suspended' : 'Active';
                $userModel->update($user['id'], ['status' => $newStatus]);
                
                
                $notifModel = new Notification();
                $msg = ($newStatus == 'Suspended') ? "Your account has been suspended by an administrator." : "Your account has been reactivated.";
                $notifModel->sendNotification($user['id'], $msg, "System");
                
                $_SESSION['success'] = "User status updated to $newStatus.";
            }
            redirect('admin/suspendUsers');
        }

        $data['users'] = $userModel->fetchAll();
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/suspend_users', $data);
    }

    
    public function reports()
    {
        Middleware::requireRole('Admin');
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/reports/index', $data);
    }

    public function salesReport()
    {
        Middleware::requireRole('Admin');
        $db = new class { use Database; };
        $data['sales'] = $db->query("SELECT DATE(OrderDate) as date, SUM(TotalPrice) as total FROM `order` GROUP BY DATE(OrderDate)");
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/reports/sales', $data);
    }

    public function userReport()
    {
        Middleware::requireRole('Admin');
        $userModel = new User();
        $data['userStats'] = $userModel->query("SELECT role, COUNT(*) as count FROM users GROUP BY role");
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/reports/users', $data);
    }

    public function appointmentReport()
    {
        Middleware::requireRole('Admin');
        $db = new class { use Database; };
        $data['appointments'] = $db->query("SELECT DATE(AppointmentDate) as date, COUNT(*) as count FROM appointment GROUP BY DATE(AppointmentDate)");
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/reports/appointments', $data);
    }

    public function messages()
    {
        Middleware::requireRole('Admin');

        $message = new Message();

        $data['messages'] = $message->fetchAll();

        $this->view('admin/messages', $data);
    }

    public function generateReportPDF($type)
    {
        Middleware::requireRole('Admin');
        
        require_once dirname(__DIR__, 2) . '/lib/fpdf186/fpdf.php';

        $db = new class { use Database; };
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        $filename = "";
        $title = "";

        if ($type == 'sales') {
            $title = "Sales Report";
            $filename = "sales_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT DATE(OrderDate) as date, SUM(TotalPrice) as total FROM `order` GROUP BY DATE(OrderDate)");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Date', 1);
            $pdf->Cell(95, 10, 'Total Revenue (EGP)', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['date'], 1);
                    $pdf->Cell(95, 10, number_format($row['total'], 2), 1);
                    $pdf->Ln();
                }
            }
        } elseif ($type == 'users') {
            $title = "User Analytics Report";
            $filename = "user_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT role, COUNT(*) as count FROM users GROUP BY role");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Role', 1);
            $pdf->Cell(95, 10, 'User Count', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['role'], 1);
                    $pdf->Cell(95, 10, $row['count'], 1);
                    $pdf->Ln();
                }
            }
        } elseif ($type == 'appointments') {
            $title = "Appointment Report";
            $filename = "appointment_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT DATE(AppointmentDate) as date, COUNT(*) as count FROM appointment GROUP BY DATE(AppointmentDate)");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Date', 1);
            $pdf->Cell(95, 10, 'Appointment Count', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['date'], 1);
                    $pdf->Cell(95, 10, $row['count'], 1);
                    $pdf->Ln();
                }
            }
        }

        
        $reportsDir = "uploads/reports/";
        if (!is_dir($reportsDir)) {
            mkdir($reportsDir, 0777, true);
        }
        $savePath = $reportsDir . $filename;
        $pdf->Output('F', $savePath);

        
        $pdf->Output('D', $filename);
        exit;
    }

    
    public function certifications()
    {
        Middleware::requireRole('Admin');
        $certModel = new Certification();
        $data['certifications'] = $certModel->getPending();
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/certifications', $data);
    }

    public function verifyCertification($id)
    {
        Middleware::requireRole('Admin');
        if (isset($_GET['status']) && in_array($_GET['status'], ['Verified', 'Rejected'])) {
            $status = $_GET['status'];
            $certModel = new Certification();
            $cert = $certModel->first(['CertID' => $id]);
            
            if ($cert) {
                $certModel->updateStatus($id, $status);
                
                $notifModel = new Notification();
                $msg = "Your certification '" . $cert['CertName'] . "' has been " . $status . ".";
                $notifModel->sendNotification($cert['ProviderID'], $msg, "System");
                
                $_SESSION['success'] = "Certification marked as $status.";
            }
        }
        redirect('admin/certifications');
    }

    
    public function escrowManagement()
    {
        Middleware::requireRole('Admin');
        $bookingModel = new Booking();
        $data['bookings'] = $bookingModel->getAllBookings(); 
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/escrow', $data);
    }

    public function forceEscrowAction($bookingId)
    {
        Middleware::requireRole('Admin');
        if (isset($_GET['action']) && in_array($_GET['action'], ['Released', 'Refunded'])) {
            $action = $_GET['action'];
            $bookingModel = new Booking();
            $booking = $bookingModel->first(['BookingID' => $bookingId]);
            
            if ($booking) {
                $bookingModel->updateByBookingId($bookingId, ['EscrowStatus' => $action]);
                $_SESSION['success'] = "Escrow successfully marked as $action.";
            }
        }
        redirect('admin/escrowManagement');
    }
}
