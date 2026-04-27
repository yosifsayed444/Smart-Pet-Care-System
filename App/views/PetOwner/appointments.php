<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Service Bookings 📅</h1>

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
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Pet</th>
                                <th>Service</th>
                                <th>Provider</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($bookings)): ?>
                                <?php foreach($bookings as $booking): ?>
                                    <tr>
                                        <td><strong><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></strong></td>
                                        <td><?= date('h:i A', strtotime($booking['StartTime'])) ?> - <?= date('h:i A', strtotime($booking['EndTime'])) ?></td>
                                        <td><?= htmlspecialchars($booking['PetName']) ?></td>
                                        <td><span class="badge badge-info"><?= htmlspecialchars($booking['service_name'] ?? 'N/A') ?></span></td>
                                        <td><?= htmlspecialchars($booking['provider_name']) ?></td>
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
                                            <a href="<?= ROOT ?>/petowner/deleteAppointment/<?= $booking['BookingID'] ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                Delete 🗑️
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        You don't have any bookings yet. <br>
                                        <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-primary btn-sm mt-2">Browse Services</a>
                                    </td>
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
