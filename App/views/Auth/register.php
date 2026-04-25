<<<<<<< HEAD
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="mb-4 text-center">Register</h2>
                    <form method="POST" action="<?= ROOT ?>/auth/register">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="Pet Owner">Pet Owner</option>
                                <option value="Veterinarian">Veterinarian</option>
                                <option value="Sitter">Sitter</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Register</button>
                        <p class="text-center mt-3">Already have an account? <a href="<?= ROOT ?>/auth/login">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
=======
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

</head>

<body>


    <form method="POST">

        <!-- Username -->

        <label>Username</label>

        <input
            type="text"
            name="username" "
                                    value=" <?php echo $_POST['username'] ?? '' ?>">

        <?php if (! empty($errors['username'])): ?>

            <small>
                <?php echo $errors['username'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Email -->

        <label>Email</label>

        <input
            type="text"
            name="email" "
                                    value=" <?php echo $_POST['email'] ?? '' ?>">

        <?php if (! empty($errors['email'])): ?>

            <small>
                <?php echo $errors['email'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Phone -->

        <label>Phone</label>

        <input
            type="text"
            name="phone" "
                                    value=" <?php echo $_POST['phone'] ?? '' ?>">

        <?php if (! empty($errors['phone'])): ?>

            <small>
                <?php echo $errors['phone'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Password -->

        <label>Password</label>

        <input
            type="password"
            name="password" ">

                                <?php if (! empty($errors['password'])): ?>

                                    <small>
                                        <?php echo $errors['password'] ?>
                                    </small>

                                <?php endif; ?>

                            </div>


                            <button
                                type=" submit"
            ess w-100">
        Register
        </button>

        <divmt-3">

            <a href="/SE1_Project/auth">
                Already have account?
            </a>

            </div>

    </form>

</body>
>>>>>>> cdac4227ca14190cde6c08d98dab3cf85bb9c343
