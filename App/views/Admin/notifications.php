<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
            <h2 class="mb-4">System Notifications</h2>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Broadcast System Message</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label class="mb-2">Message to All Users</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Write your announcement here. This will be sent to every user on the platform..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Broadcast to Everyone 📢</button>
                    </form>
                </div>
            </div>
        </main>
    </main>
</div>
