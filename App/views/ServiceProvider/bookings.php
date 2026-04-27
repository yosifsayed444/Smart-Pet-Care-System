<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Manage My Bookings 🗓️</h1>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?php echo $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Owner</th>
                                <th>Pet</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($bookings)): ?>
                                <?php foreach($bookings as $booking): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($booking['owner_name']) ?></td>
                                        <td><?= htmlspecialchars($booking['PetName']) ?></td>
                                        <td>
                                            <strong><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></strong><br>
                                            <span class="small text-muted"><?= date('h:i A', strtotime($booking['StartTime'])) ?> - <?= date('h:i A', strtotime($booking['EndTime'])) ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                                $status = $booking['status'] ?? 'Under Review';
                                                $badgeClass = 'badge-secondary';
                                                if ($status == 'Accepted') $badgeClass = 'badge-success';
                                                if ($status == 'Rejected') $badgeClass = 'badge-danger';
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                        </td>
                                        <td>
                                            <?php if ($status == 'Under Review'): ?>
                                                <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Accepted" class="btn btn-success btn-sm">Accept ✅</a>
                                                <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Rejected" class="btn btn-danger btn-sm">Reject ❌</a>
                                            <?php else: ?>
                                                <span class="text-muted small">Decided</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">No bookings found yet.</td>
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
