<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-danger"><i class="fa fa-bell"></i> Incident Alerts</h2>
                <a href="<?= ROOT ?>/PetOwner/dashboard" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <?php if (empty($incidents)): ?>
                <div class="alert alert-success p-4 text-center">
                    <i class="fa fa-check-circle fa-3x mb-3"></i>
                    <h5>All Clear!</h5>
                    <p class="mb-0">There are no reported incidents or emergencies for any of your pets.</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($incidents as $incident): ?>
                        <div class="col-md-6 mb-4">
                            <?php 
                                $borderColor = 'border-warning';
                                $headerColor = 'bg-warning text-dark';
                                if ($incident['Severity'] == 'High' || $incident['Severity'] == 'Critical') {
                                    $borderColor = 'border-danger';
                                    $headerColor = 'bg-danger text-white';
                                }
                            ?>
                            <div class="card shadow-sm <?= $borderColor ?>">
                                <div class="card-header <?= $headerColor ?> d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($incident['Severity']) ?> Priority</h5>
                                    <small><?= date('M d, g:i A', strtotime($incident['ReportedAt'])) ?></small>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Pet:</strong> <?= htmlspecialchars($incident['PetName']) ?></h6>
                                    <p class="card-text text-muted mb-1"><strong>Sitter:</strong> <?= htmlspecialchars($incident['SitterName'] ?? 'Unknown Sitter') ?></p>
                                    <p class="card-text text-muted mb-3"><small>Booking ID: #<?= htmlspecialchars($incident['BookingID']) ?></small></p>
                                    <div class="p-3 bg-light rounded border">
                                        <strong>Report Details:</strong><br>
                                        <?= nl2br(htmlspecialchars($incident['Description'])) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
