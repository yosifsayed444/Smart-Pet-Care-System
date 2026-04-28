<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_1.jpg'); height: 300px !important; min-height: 300px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" style="height: 300px !important; min-height: 300px;">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">My Notifications</h1>
        <p class="breadcrumbs"><span>Stay updated with PetCare</span></p>
      </div>
    </div>
  </div>
</div>

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
                                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border-left-<?= $n['Type'] == 'LostPet' ? 'danger' : ($n['IsRead'] ? 'secondary' : 'primary') ?>" style="border-left-width: 5px; <?= $n['IsRead'] ? 'opacity: 0.8;' : '' ?>">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 <?= $n['Type'] == 'LostPet' ? 'text-danger font-weight-bold' : '' ?>">
                                            <?= $n['Type'] == 'LostPet' ? '🚨 LOST PET ALERT' : 'System Notification' ?>
                                            <?php if (!$n['IsRead']): ?>
                                                <span class="badge badge-primary ml-2">New</span>
                                            <?php endif; ?>
                                        </h5>
                                        <small class="text-muted"><?= date('M d, H:i', strtotime($n['CreatedAt'])) ?></small>
                                    </div>
                                    <p class="mb-1"><?= htmlspecialchars($n['Message']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small class="text-muted">Type: <?= $n['Type'] ?></small>
                                        <div>
                                            <?php if (!$n['IsRead']): ?>
                                                <a href="<?= ROOT ?>/notifications/markAsRead/<?= $n['id'] ?>" class="btn btn-sm btn-link p-0 mr-3 text-primary">Mark as read</a>
                                            <?php endif; ?>
                                            <a href="<?= ROOT ?>/notifications/delete/<?= $n['id'] ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Delete this notification?')">Delete</a>
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
