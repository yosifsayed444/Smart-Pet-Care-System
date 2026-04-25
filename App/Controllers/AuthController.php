<?php

class AuthController extends Controller
{

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

                            case 'Provider':
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

            } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $errors['email'] = "Invalid email format";
            }

            if (empty($phone)) {

                $errors['phone'] = "Phone is required";

            } elseif (! preg_match("/^[0-9]{11}$/", $phone)) {

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

                $newUser = $user->first([
                    'email' => $email,
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
