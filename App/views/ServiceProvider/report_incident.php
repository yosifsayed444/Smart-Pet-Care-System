<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><i class="fa fa-exclamation-triangle"></i> Report Incident</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Use this form to report an injury, behavioral issue, or emergency regarding <strong><?= htmlspecialchars($pet['Name'] ?? 'the pet') ?></strong> during Booking 

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="<?= ROOT ?>/ServiceProvider/reportIncident/<?= $booking['BookingID'] ?>" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bold">Severity Level <span class="text-danger">*</span></label>
                            <select name="severity" class="form-control" required>
                                <option value="Low">Low - Minor issue, no immediate action needed.</option>
                                <option value="Medium">Medium - Needs attention but not life-threatening.</option>
                                <option value="High">High - Serious injury or behavioral issue.</option>
                                <option value="Critical">Critical - Immediate medical or owner intervention required.</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Incident Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Please describe what happened in detail..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= ROOT ?>/ServiceProvider/bookings" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
