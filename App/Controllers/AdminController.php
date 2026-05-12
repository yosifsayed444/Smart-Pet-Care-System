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
                'username'    => trim($_POST['username']),
                'email'       => trim($_POST['email']),
                'phone'       => trim($_POST['phone']),
                'role'        => $_POST['role'],
                'status'      => 'Active',
                'is_verified' => 1,
                'password'    => password_hash($_POST['password'], PASSWORD_DEFAULT),
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
        if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
            $_SESSION['error'] = "You cannot delete your own admin account! ❌";
            redirect("admin/users");
            exit;
        }

        $userModel = new User();
        $user = $userModel->first(['id' => $id]);
        if ($user) {
            Helpers::deleteRelatedData($userModel, $id, $user);
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

            $imageName = Helpers::uploadFile('image', 'uploads/products/', ['jpg', 'jpeg', 'png', 'webp']);

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

                if (!empty($_FILES['image']['name'])) {
                    $newImage = Helpers::uploadFile('image', 'uploads/products/', ['jpg', 'jpeg', 'png', 'webp']);
                    if ($newImage) {
                        Helpers::deleteOldFile('uploads/products/', $row['image']);
                        $imageName = $newImage;
                    }
                }

                

                $data = [

                    'Name'        => $_POST['Name'],

                    'Ingredients' => $_POST['Ingredients'],

                    'Price'       => $_POST['Price'],

                    'stock'       => $_POST['stock'],

                    'image'       => $imageName,

                ];

                $product->update($id, $data);

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
            Helpers::deleteOldFile('uploads/products/', $row['image']);
            
            $product->delete($id);
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
        $userModel = new User();
        $data['sales'] = $userModel->query("SELECT DATE(OrderDate) as date, SUM(TotalPrice) as total FROM `order` GROUP BY DATE(OrderDate)");
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
        $userModel = new User();
        $data['appointments'] = $userModel->query("SELECT DATE(AppointmentDate) as date, COUNT(*) as count FROM appointment GROUP BY DATE(AppointmentDate)");
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/reports/appointments', $data);
    }

    public function generateReportPDF($type)
    {
        Middleware::requireRole('Admin');
        
        require_once dirname(__DIR__, 2) . '/lib/fpdf186/fpdf.php';

        $db = new User();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        Helpers::generatePDFReport($type, $db, $pdf);
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
    public function payouts()
    {
        Middleware::requireRole('Admin');
        $query = "SELECT p.*, u.username as ProviderName, o.OrderDate 
                  FROM payouts p 
                  JOIN users u ON p.ProviderID = u.id 
                  JOIN `order` o ON p.OrderID = o.OrderID 
                  ORDER BY p.CreatedAt DESC";
        $data['payouts'] = (new Booking())->query($query); 
        $data['username'] = $_SESSION['username'] ?? 'Admin';
        $this->view('admin/payouts', $data);
    }

    public function releasePayout($id)
    {
        Middleware::requireRole('Admin');
        $query = "UPDATE payouts SET Status = 'Paid' WHERE PayoutID = :id";
        (new Booking())->query($query, ['id' => $id]);
        $_SESSION['success'] = "Payout marked as Paid successfully.";
        redirect('admin/payouts');
    }
}
