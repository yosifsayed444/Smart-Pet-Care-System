<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">User Suspensions</h1>
                <p class="text-muted small">Manage account status and platform access</p>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>#<?= $user['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="profile-avatar" style="width: 30px; height: 30px; font-size: 11px;">
                                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                        </div>
                                        <strong><?= htmlspecialchars($user['username']) ?></strong>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><span class="badge badge-light"><?= $user['role'] ?></span></td>
                                <td>
                                    <?php 
                                        $status = $user['status'] ?? 'Active';
                                        $cls = ($status == 'Active') ? 'status-active' : 'status-suspended';
                                    ?>
                                    <span class="status-badge <?= $cls ?>"><?= $status ?></span>
                                </td>
                                <td>
                                    <a href="<?= ROOT ?>/admin/suspendUsers?toggle=<?= $user['id'] ?>" 
                                       class="btn-pill <?= ($status == 'Active') ? 'btn-red' : 'btn-green' ?>">
                                        <?= ($status == 'Active') ? 'Suspend' : 'Activate' ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No users found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
