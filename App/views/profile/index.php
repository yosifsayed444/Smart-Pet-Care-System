<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    :root {
        --profile-primary: #185FA5;
        --profile-secondary: #0C447C;
        --profile-bg: #f8fafc;
        --profile-white: #ffffff;
        --profile-border: rgba(0, 0, 0, 0.08);
        --profile-text: #1e293b;
        --profile-muted: #64748b;
        --profile-radius: 16px;
        --profile-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .profile-section {
        background: var(--profile-bg);
        min-height: calc(100vh - 80px);
        padding: 60px 0;
        font-family: 'Montserrat', sans-serif;
    }

    .profile-card {
        background: var(--profile-white);
        border-radius: var(--profile-radius);
        border: 1px solid var(--profile-border);
        box-shadow: var(--profile-shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 992px) {
        .profile-card {
            flex-direction: row;
        }
        .profile-sidebar {
            width: 320px;
            border-right: 1px solid var(--profile-border);
        }
        .profile-main {
            flex: 1;
        }
    }

    .profile-sidebar {
        padding: 40px;
        text-align: center;
        background: linear-gradient(to bottom, #ffffff, #fdfdfd);
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: var(--profile-primary);
        color: white;
        font-size: 48px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 10px 15px -3px rgba(24, 95, 165, 0.3);
    }

    .profile-name {
        font-size: 24px;
        font-weight: 800;
        color: var(--profile-text);
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .role-badge {
        display: inline-block;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 24px;
    }

    .role-owner { background: #E6F1FB; color: #0C447C; }
    .role-admin { background: #FCEBEB; color: #791F1F; }
    .role-provider { background: #EAF3DE; color: #27500A; }
    .role-vet { background: #EEEDFE; color: #3C3489; }

    .profile-main {
        padding: 40px;
    }

    .section-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--profile-muted);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--profile-border);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 40px;
    }

    .info-item label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--profile-muted);
        margin-bottom: 6px;
    }

    .info-item span {
        font-size: 16px;
        font-weight: 600;
        color: var(--profile-text);
    }

    .profile-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-profile {
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit {
        background: var(--profile-primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--profile-secondary);
        transform: translateY(-2px);
        color: white;
    }

    .btn-outline {
        border: 2px solid var(--profile-border);
        color: var(--profile-text);
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: var(--profile-muted);
    }

    .stat-mini-row {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-mini {
        text-align: center;
    }

    .stat-mini .s-val {
        font-size: 20px;
        font-weight: 800;
        color: var(--profile-text);
        display: block;
    }

    .stat-mini .s-lab {
        font-size: 11px;
        font-weight: 600;
        color: var(--profile-muted);
        text-transform: uppercase;
    }
</style>

<div class="profile-section">
    <div class="container">
        <div class="profile-card">
            
            
            <div class="profile-sidebar">
                <div class="profile-avatar-large">
                    <?php
                        $name = $data['username'] ?? 'A';
                        echo strtoupper(substr($name, 0, 1));
                    ?>
                </div>
                <h1 class="profile-name"><?= htmlspecialchars($name) ?></h1>
                
                <?php 
                    $role = $data['role'] ?? 'User';
                    $roleClass = 'role-' . strtolower($role);
                ?>
                <span class="role-badge <?= $roleClass ?>"><?= $role ?></span>

            
            </div>

            
            <div class="profile-main">
                
                <div style="margin-bottom: 24px;">
                    <a href="javascript:history.back()" class="btn-pill btn-blue" style="font-size: 11px; padding: 6px 12px;">
                        <span class="fa fa-arrow-left"></span> Back
                    </a>
                </div>

                <div class="section-title">Personal Information</div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Username</label>
                        <span><?= htmlspecialchars($data['username'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <span><?= htmlspecialchars($data['email'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-item">
                        <label>Phone Number</label>
                        <span><?= htmlspecialchars($data['phone'] ?? 'N/A') ?></span>
                    </div>
                </div>

                <div class="section-title">Account Security</div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Account Status</label>
                        <span style="color: #27500A;"><?php echo $data['status'] ?? 'N/A'; ?></span>
                    </div>
                    <div class="info-item">
                        <label>Verification</label>
                        <span><?php echo $data['is_verified'] == 1 ? 'Verified' : 'Not Verified'; ?></span>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="javascript:history.back()" class="btn-profile btn-outline">
                        <span class="fa fa-arrow-left"></span> Back
                    </a>
                    <a href="<?= ROOT ?>/auth/logout" class="btn-profile btn-outline" style="color: #A32D2D;">
                        <span class="fa fa-sign-out"></span> Logout
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>