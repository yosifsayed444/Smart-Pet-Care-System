<?php

class AuthController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['id'])) {
            header("Location: " . ROOT . "/home");
            exit;
        }
        $this->login();
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

                        $_SESSION['id']       = $row['id'];
                        $_SESSION['role']     = $row['role'];
                        $_SESSION['username'] = $row['username'];

                        switch ($row['role']) {

                            case 'Admin':
                                header("Location: " . ROOT . "/admin/dashboard");
                                break;

                            case 'Vet':
                                header("Location: " . ROOT . "/vet/dashboard");
                                break;

                            case 'ServiceProvider':
                                header("Location: " . ROOT . "/serviceprovider/dashboard");
                                break;
                            

                            default:
                                header("Location: " . ROOT . "/home");
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

            $user = new User();

            $errors = Validator::validateUser($_POST, $user);

            if (empty($errors)) {

                $data = [

                    'username' => trim($_POST['username'] ?? ''),
                    'email'    => trim($_POST['email'] ?? ''),
                    'phone'    => trim($_POST['phone'] ?? ''),
                    'role'     => 'Owner',

                    'password' => password_hash(
                        $_POST['password'],
                        PASSWORD_DEFAULT
                    ),
                ];

                $user->insert($data);

                $newUser = $user->first([
                    'email' => trim($_POST['email'] ?? ''),
                ]);

                $_SESSION['id']       = $newUser['id'];
                $_SESSION['role']     = $newUser['role'];
                $_SESSION['username'] = $newUser['username'];

                header("Location: " . ROOT . "/home");
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

        session_unset();
        session_destroy();

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");

        header("Location: " . ROOT . "/auth/login");
        exit;
    }
}
