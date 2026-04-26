<?php
class Validator
{

    public static function validateUser($data, $userModel, $ignoreId = null)
    {

        $errors = [];

        $username = trim($data['username'] ?? '');
        $email    = trim($data['email'] ?? '');
        $phone    = trim($data['phone'] ?? '');
        $password = trim($data['password'] ?? '');

        if (empty($username)) {

            $errors['username'] = "Username is required";

        } elseif (strlen($username) < 3) {

            $errors['username'] = "Username must be at least 3 characters";
        }

        // Email
        if (empty($email)) {

            $errors['email'] = "Email is required";

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errors['email'] = "Invalid email format";
        }

        // Duplicate Email
        $exists = $userModel->first([
            'email' => $email
        ]);

        if ($exists && $exists['id'] != $ignoreId) {

            $errors['email'] = "Email already exists";
        }

        // Phone
        if (empty($phone)) {

            $errors['phone'] = "Phone is required";

        } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {

            $errors['phone'] = "Phone must be 11 digits";
        }

        if ($ignoreId === null) {

            if (empty($password)) {

                $errors['password'] = "Password is required";

            } elseif (strlen($password) < 6) {

                $errors['password'] = "Password must be at least 6 characters";
            }
        }

        return $errors;
    }
public static function validateProduct($data, $isEdit = false)
{
    $errors = [];

    /* Product Name */

    if (empty($data['Name'])) {

        $errors['Name'] =
            "Product Name is required";

    } elseif (strlen($data['Name']) < 3) {

        $errors['Name'] =
            "Product Name must be at least 3 characters";
    }


    /* Ingredients */

    if (empty($data['Ingredients'])) {

        $errors['Ingredients'] =
            "Ingredients are required";
    }


    /* Price */

    if (empty($data['Price'])) {

        $errors['Price'] =
            "Price is required";

    } elseif (!is_numeric($data['Price'])) {

        $errors['Price'] =
            "Price must be numeric";

    } elseif ($data['Price'] <= 0) {

        $errors['Price'] =
            "Price must be greater than 0";
    }


    /* Stock */

    if ($data['stock'] === '') {

        $errors['stock'] =
            "Stock is required";

    } elseif (!is_numeric($data['stock'])) {

        $errors['stock'] =
            "Stock must be numeric";

    } elseif ($data['stock'] < 0) {

        $errors['stock'] =
            "Stock cannot be negative";
    }


    /* Image Validation */

    // الصورة Required في add فقط
    if (!$isEdit && empty($_FILES['image']['name'])) {

        $errors['image'] =
            "Product image is required";
    }

    // لو فيه صورة مرفوعة
    if (!empty($_FILES['image']['name'])) {

        $allowed = ['jpg','jpeg','png','webp'];

        $imageName =
            $_FILES['image']['name'];

        $imageSize =
            $_FILES['image']['size'];

        $ext = strtolower(
            pathinfo($imageName, PATHINFO_EXTENSION)
        );

        /* Check Extension */

        if (!in_array($ext, $allowed)) {

            $errors['image'] =
                "Image must be jpg, jpeg, png or webp";
        }

        /* Check Size */

        if ($imageSize > 2 * 1024 * 1024) {

            $errors['image'] =
                "Image size must be less than 2MB";
        }
    }

    return $errors;
}
    
}