<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>


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