<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow border-info">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fa fa-qrcode"></i> Booking Verification</h4>
                </div>
                <div class="card-body py-5">
                    <p class="text-muted mb-4">
                        <?php if (empty($booking['CheckInTime'])): ?>
                            Enter the Pet Owner's verification code to <strong>Check-In</strong> and start the service.
                        <?php else: ?>
                            Enter the Pet Owner's verification code to <strong>Check-Out</strong> and complete the service.
                        <?php endif; ?>
                    </p>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="<?= ROOT ?>/ServiceProvider/scanQR/<?= $booking['BookingID'] ?>" method="POST" class="px-md-5">
                        <div class="form-group mb-4">
                            <input type="text" name="token" class="form-control form-control-lg text-center font-weight-bold"
                                   placeholder="ENTER 6-CHAR CODE" maxlength="6" style="letter-spacing: 5px; text-transform: uppercase;" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-check"></i> Verify Code</button>
                    </form>
                </div>
                <div class="card-footer bg-white">
                    <a href="<?= ROOT ?>/ServiceProvider/bookings" class="btn btn-secondary">Back to Bookings</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
