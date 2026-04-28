<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
            <h2 class="mb-4">System Notifications</h2>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Send Mass Notification</div>
                <div class="card-body">
                    <form method="POST" novalidate>
                        <div class="form-group mb-3">
                            <label>Target Audience</label>
                            <select name="role" class="form-control">
                                <option value="All">All Users</option>
                                <option value="Owner">Pet Owners</option>
                                <option value="Vet">Veterinarians</option>
                                <option value="Provider">Service Providers</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Message Content</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Enter your system-wide message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Escalated Notification</button>
                    </form>
                </div>
            </div>
        </main>
    </main>
</div>
