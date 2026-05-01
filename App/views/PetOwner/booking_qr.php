<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fa fa-qrcode"></i> Booking Verification Code</h4>
                </div>
                <div class="card-body py-5">
                    <p class="text-muted mb-4">Show this code to the sitter when they arrive to check-in, and again when they leave to check-out.</p>
                    
                    <div class="p-4 bg-light rounded d-inline-block border border-primary mb-4" style="border-width: 2px !important; border-style: dashed !important;">
                        <h1 class="display-3 font-weight-bold text-primary mb-0" style="letter-spacing: 5px;">
                            <?= htmlspecialchars($booking['QRToken']) ?>
                        </h1>
                    </div>
                    
                    <p class="mb-0"><strong>Booking ID:</strong> #<?= htmlspecialchars($booking['BookingID']) ?></p>
                </div>
                <div class="card-footer bg-white">
                    <a href="<?= ROOT ?>/petowner/index" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
