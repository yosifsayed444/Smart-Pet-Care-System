<<<<<<< HEAD
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="mb-4 text-center">Login</h2>
                    <?php if(!empty($errors['email'])): ?>
                        <div class="alert alert-danger"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                    <form method="POST" action="<?= ROOT ?>/auth/login">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Login</button>
                        <p class="text-center mt-3">Don't have an account? <a href="<?= ROOT ?>/auth/register">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
=======
<h3>
    Login
</h3>

<form method="POST">

    <div>

        <label>Email</label>

        <input
            type="text"
            name="email">

        <?php if (! empty($errors['email'])): ?>

            <small>
                <?php echo $errors['email'] ?>
            </small>

        <?php endif; ?>

    </div>

    <div>

        <label>Password</label>

        <input
            type="password"
            name="password">

        <?php if (! empty($errors['password'])): ?>

            <small>
                <?php echo $errors['password'] ?>
            </small>

        <?php endif; ?>

    </div>


    <button
        type="submit">
        Login
    </button>

    <div>

        <a href="/SE1_Project/auth/register">
            Create Account
        </a>

    </div>

</form>
>>>>>>> cdac4227ca14190cde6c08d98dab3cf85bb9c343
