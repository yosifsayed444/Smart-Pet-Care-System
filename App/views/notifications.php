<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="bg-white p-5 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h4 mb-0">Notifications</h2>
                        <?php if (!empty($notifications)): ?>
                            <a href="<?= ROOT ?>/notifications/markAllAsRead" class="btn btn-sm btn-outline-primary">Mark all as read</a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($notifications)): ?>
                        <div class="list-group">
                            <?php foreach ($notifications as $n): ?>
                                <?php $isUnread = ($n['status'] == 'unread'); ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border-left-<?= $n['title'] == 'LostPet' ? 'danger' : ($isUnread ? 'primary' : 'secondary') ?>" style="border-left-width: 5px; <?= !$isUnread ? 'opacity: 0.8;' : '' ?>">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 <?= $n['title'] == 'LostPet' ? 'text-danger font-weight-bold' : '' ?>">
                                            <?= $n['title'] == 'LostPet' ? '🚨 LOST PET ALERT' : 'System Notification' ?>
                                            <?php if ($isUnread): ?>
                                                <span class="badge badge-primary ml-2">New</span>
                                            <?php endif; ?>
                                        </h5>
                                        <small class="text-muted"><?= date('M d, H:i', strtotime($n['created_at'])) ?></small>
                                    </div>
                                    <p class="mb-1"><?= htmlspecialchars($n['message']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small class="text-muted">Type: <?= htmlspecialchars($n['title']) ?></small>
                                        <div>
                                            <?php if ($isUnread): ?>
                                                <a href="<?= ROOT ?>/notifications/markAsRead/<?= $n['notification_id'] ?>" class="btn btn-sm btn-link p-0 mr-3 text-primary">Mark as read</a>
                                            <?php endif; ?>
                                            <a href="<?= ROOT ?>/notifications/delete/<?= $n['notification_id'] ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Delete this notification?')">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fa fa-bell-o fa-4x text-muted mb-3"></i>
                            <p class="lead text-muted">You have no notifications yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
