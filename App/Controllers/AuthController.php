<?php

class AuthController extends Controller
{

    public function index()
    {
        $this->view('auth/login');
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $errors = [];

            if (empty($email)) {

                $errors['email'] = "Email is required";

            } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $errors['email'] = "Invalid email format";
            }

            if (empty($password)) {

                $errors['password'] = "Password is required";
            }

            if (empty($errors)) {

                $user = new User();

                $row = $user->first([
                    'email' => $email,
                ]);

                if ($row) {

                    if (password_verify($password, $row['password'])) {

                        $_SESSION['user_id']  = $row['id'];
                        $_SESSION['role']     = $row['role'];
                        $_SESSION['username'] = $row['username'];

                        switch ($row['role']) {

                            case 'Admin':
                                header("Location: /SE1_Project/admin/dashboard");
                                break;

                            case 'Vet':
                                header("Location: /SE1_Project/vet/dashboard");
                                break;

                            case 'Provider':
                                header("Location: /SE1_Project/serviceprovider/dashboard");
                                break;

                            case 'Owner':
<<<<<<< HEAD
                                header("Location: /SE1_Project/marketplace/dashboard");
=======
                                header("Location: /SE1_Project/home");
>>>>>>> cdac4227ca14190cde6c08d98dab3cf85bb9c343
                                break;

                            default:
                                header("Location: /SE1_Project/home");
                                break;
                        }

                        exit;

                    } else {

                        $errors['password'] = "Wrong password";
                    }

                } else {

                    $errors['email'] = "User not found";
                }
            }

            $this->view('auth/login', [
                'errors' => $errors,
            ]);

        } else {

            $this->view('auth/login');
        }
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $errors = [];

            if (empty($username)) {

                $errors['username'] = "Username is required";

            } elseif (strlen($username) < 3) {

                $errors['username'] =
                    "Username must be at least 3 characters";
            }

            if (empty($email)) {

                $errors['email'] = "Email is required";

            } elseif (! filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )) {

                $errors['email'] = "Invalid email format";
            }

            if (empty($phone)) {

                $errors['phone'] = "Phone is required";

            } elseif (! preg_match(
                "/^[0-9]{11}$/",
                $phone
            )) {

                $errors['phone'] =
                    "Phone must be 11 digits";
            }
            if (empty($password)) {

                $errors['password'] = "Password is required";

            } elseif (strlen($password) < 6) {

                $errors['password'] =
                    "Password must be at least 6 characters";
            }

            if (empty($errors)) {

                $user = new User();

                $exists = $user->first([
                    'email' => $email,
                ]);

                if ($exists) {

                    $errors['email'] =
                        "Email already exists";
                }
            }

            if (empty($errors)) {

                $data = [

                    'username' => $username,
                    'email'    => $email,
                    'phone'    => $phone,
                    'role'     => 'Owner',
                    'password' => password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    ),
                ];

                $user = new User();

                $user->insert($data);
                header("Location: /SE1_Project/home");
                exit;
            }

            $this->view('auth/register', [
                'errors' => $errors,
            ]);

        } else {

            $this->view('auth/register');
        }
    }

    public function logout()
    {
        session_destroy();

        header("Location: /SE1_Project/home");
        exit;
    }
}
