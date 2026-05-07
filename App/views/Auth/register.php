<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
     .error-hint {
        color: #d9534f;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
</style>

<div class="auth-section">
    <div class="container">
        <div class="auth-card">
            
            <div class="auth-image">
                <div class="auth-image-overlay">
                    <h3 style="font-weight: 800;">Join the Community</h3>
                    <p style="font-size: 14px; opacity: 0.9;">Create an account today and give your pet the care they deserve.</p>
                </div>
            </div>

            
            <div class="auth-form-container">
                <div class="auth-header">
                    <h2>Create Account</h2>
                    <p>It's quick and easy to get started.</p>
                </div>

                <form method="POST" action="<?php echo ROOT ?>/auth/register" novalidate>
                    <div class="form-grid">
                        <div class="form-group-premium">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control-premium" placeholder="johndoe" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
                            <?php if (! empty($errors['username'])): ?>
                                <span class="error-hint"><?php echo $errors['username'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group-premium">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control-premium" placeholder="+00 123 456" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" required>
                            <?php if (! empty($errors['phone'])): ?>
                                <span class="error-hint"><?php echo $errors['phone'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group-premium full-width">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control-premium" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                            <?php if (! empty($errors['email'])): ?>
                                <span class="error-hint"><?php echo $errors['email'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group-premium full-width">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control-premium" placeholder="••••••••" required>
                            <?php if (! empty($errors['password'])): ?>
                                <span class="error-hint"><?php echo $errors['password'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">Create Account</button>

                    <div class="auth-footer">
                        Already have an account? <a href="<?php echo ROOT ?>/auth/login">Sign in here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
