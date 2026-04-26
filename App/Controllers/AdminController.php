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

        $users        = $user->fetchAll();
        $orders       = $order->fetchAll();
        $appointments = $appointment->fetchAll();

        $data['totalUsers']        = is_array($users) ? count($users) : 0;
        $data['totalOrders']       = is_array($orders) ? count($orders) : 0;
        $data['totalAppointments'] = is_array($appointments) ? count($appointments) : 0;
        $data['username']          = $_SESSION['username'] ?? 'Admin';

        $this->view("admin/dashboard", $data);
    }
    // Users
    public function users()
    {

        Middleware::requireRole('Admin');

        $user = new User();

        $data['users'] = $user->query(
            "SELECT * FROM users WHERE role != 'Admin'"
        );

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

            $_SESSION['success'] =
                "User Updated Successfully ✅";

            redirect("admin/users");
            exit;
        }

        $data['user'] = $user->first([
            'id' => $id,
        ]);

        $this->view("admin/editUser", $data);
    }

    public function deleteUser($id)
    {

        Middleware::requireRole('Admin');

        $user = new User();

        $user->delete($id);

        $_SESSION['success'] =
            "User Deleted Successfully 🗑️";

        redirect("admin/users");
        exit;
    }

    // Products
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

                        /* إنشاء الفولدر لو مش موجود */

                        if (! is_dir($folder)) {

                            mkdir($folder, 0777, true);
                        }

                        /* رفع الصورة */

                        move_uploaded_file(
                            $tmp,
                            $folder . $imageName
                        );

                        /* حذف الصورة القديمة */

                        if (! empty($row['image'])) {

                            $oldImage =
                                $folder . $row['image'];

                            if (file_exists($oldImage)) {

                                unlink($oldImage);
                            }
                        }
                    }
                }

                /* البيانات */

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

        $product->deleteProduct($id);

        $_SESSION['success'] =
            "Product Deleted Successfully 🗑️";

        redirect("admin/products");
        exit;
    }

    // Orders
    public function orders()
    {}
    public function updateOrderStatus($id)
    {}

    // Appointments
    public function appointments()
    {}

    // System
    public function manageRoles()
    {}
    public function lostPetBroadcast()
    {}
    public function notificationEscalator()
    {}
    public function manageDisputes()
    {}
    public function auditLogs()
    {}
    public function suspendUsers()
    {}
    public function healthAlerts()
    {}
    public function archiveData()
    {}
    public function manageCurrency()
    {}
    public function verifyUsers()
    {}

    // Reports
    public function reports()
    {}
    public function salesReport()
    {}
    public function userReport()
    {}
    public function appointmentReport()
    {}

    public function messages()
    {
        Middleware::requireRole('Admin');

        $message = new Message();

        $data['messages'] = $message->fetchAll();

        $this->view('admin/messages', $data);
    }
}
