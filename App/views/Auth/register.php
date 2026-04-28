<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    .auth-section {
        min-height: calc(100vh - 120px);
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        padding: 60px 0;
        font-family: 'Montserrat', sans-serif;
    }

    .auth-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        max-width: 1000px;
        margin: 0 auto;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .auth-image {
        width: 40%;
        background: url('https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=800') no-repeat center center;
        background-size: cover;
        position: relative;
        display: none;
    }

    @media (min-width: 992px) {
        .auth-image {
            display: block;
        }
    }

    .auth-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.8), transparent);
        color: white;
    }

    .auth-form-container {
        flex: 1;
        padding: 50px;
    }

    .auth-header {
        margin-bottom: 32px;
    }

    .auth-header h2 {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .auth-header p {
        color: #64748b;
        font-size: 15px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group-premium {
        margin-bottom: 20px;
    }

    .form-group-premium.full-width {
        grid-column: span 2;
    }

    @media (max-width: 600px) {
        .form-group-premium.full-width {
            grid-column: span 1;
        }
    }

    .form-group-premium label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control-premium {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        font-size: 14px;
        transition: all 0.2s ease;
        color: #1e293b;
    }

    .form-control-premium:focus {
        border-color: #185FA5;
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(24, 95, 165, 0.1);
    }

    .btn-auth {
        width: 100%;
        padding: 16px;
        border-radius: 14px;
        background: #185FA5;
        color: white;
        border: none;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 12px;
    }

    .btn-auth:hover {
        background: #0C447C;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(24, 95, 165, 0.3);
    }

    .auth-footer {
        margin-top: 24px;
        text-align: center;
        font-size: 14px;
        color: #64748b;
    }

    .auth-footer a {
        color: #185FA5;
        font-weight: 700;
        text-decoration: none;
    }

    .error-hint {
        color: #ef4444;
        font-size: 11px;
        font-weight: 600;
        margin-top: 4px;
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

                <form method="POST" action="<?php echo ROOT ?>/auth/register">
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
