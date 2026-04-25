<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="mb-4 text-center">Login</h2>

                    <form method="POST" action="<?php echo ROOT ?>/auth/login" novalidate>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        </div> <?php if (! empty($errors['email'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['email'] ?></div>
                    <?php endif; ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                        </div>
                        <?php if (! empty($errors['password'])): ?>
                            <div class="alert alert-danger"><?php echo $errors['password'] ?></div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary w-100 py-3">Login</button>
                        <p class="text-center mt-3">Don't have an account? <a href="<?php echo ROOT ?>/auth/register">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
