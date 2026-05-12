<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Escrow Payments 💰</h1>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?php echo $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <p class="text-muted">Once a booking is accepted, funds are held in escrow. After you complete the service and the owner provides the check-out code, you can request to release your funds.</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Booking ID</th>
                                <th>Date</th>
                                <th>Owner</th>
                                <th>Amount</th>
                                <th>Escrow Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($bookings)): ?>
                                <?php foreach($bookings as $booking): ?>
                                    <tr>
                                        <td>#<?= htmlspecialchars($booking['BookingID']) ?></td>
                                        <td><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></td>
                                        <td><?= htmlspecialchars($booking['owner_name']) ?></td>
                                        <td><?= number_format($booking['EscrowAmount'] ?? 0, 2) ?> EGP</td>
                                        <td>
                                            <?php if ($booking['EscrowStatus'] == 'Held'): ?>
                                                <span class="badge badge-warning text-white"><i class="fa fa-lock"></i> Held</span>
                                            <?php elseif ($booking['EscrowStatus'] == 'Released'): ?>
                                                <span class="badge badge-success"><i class="fa fa-unlock"></i> Released</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary"><i class="fa fa-undo"></i> Refunded</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($booking['EscrowStatus'] == 'Held'): ?>
                                                <?php if (!empty($booking['CheckOutTime'])): ?>
                                                    <a href="<?= ROOT ?>/ServiceProvider/releaseFunds/<?= $booking['BookingID'] ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-money"></i> Request Release
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted small">Awaiting Check-Out</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted small">No action needed</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">No escrow records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
