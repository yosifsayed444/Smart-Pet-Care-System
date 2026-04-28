<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    .auth-section {
        min-height: calc(100vh - 120px);
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        padding: 40px 0;
        font-family: 'Montserrat', sans-serif;
    }

    .auth-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .auth-image {
        width: 45%;
        background: url('https://images.unsplash.com/photo-1544568100-847a948585b9?auto=format&fit=crop&q=80&w=800') no-repeat center center;
        background-size: cover;
        position: relative;
        display: none;
    }

    @media (min-width: 768px) {
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
        padding: 60px;
    }

    .auth-header {
        margin-bottom: 40px;
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

    .form-group-premium {
        margin-bottom: 24px;
    }

    .form-group-premium label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control-premium {
        width: 100%;
        padding: 14px 20px;
        border-radius: 14px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        font-size: 15px;
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
        margin-top: 32px;
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
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
        display: block;
    }
</style>

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
