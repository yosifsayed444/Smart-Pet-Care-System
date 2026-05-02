<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>


<div class="auth-section">
    <div class="container">
        <div class="auth-card">
            
            <div class="auth-image">
                <div class="auth-image-overlay">
                    <h3 style="font-weight: 800;">Welcome Back!</h3>
                    <p style="font-size: 14px; opacity: 0.9;">Your pet's health records and favorite supplies are just one login away.</p>
                </div>
            </div>

            
            <div class="auth-form-container">
                <div class="auth-header">
                    <h2>Sign In</h2>
                    <p>Enter your details to access your account.</p>
                </div>

                <form method="POST" action="<?php echo ROOT ?>/auth/login" novalidate>
                    <div class="form-group-premium">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control-premium" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                        <?php if (! empty($errors['email'])): ?>
                            <span class="error-hint"><?php echo $errors['email'] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group-premium">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control-premium" placeholder="••••••••" required>
                        <?php if (! empty($errors['password'])): ?>
                            <span class="error-hint"><?php echo $errors['password'] ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-auth">Continue</button>

                    <div class="auth-footer">
                        Don't have an account? <a href="<?php echo ROOT ?>/auth/register">Create one now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      <script>
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.go(1);
        };
    </script>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
