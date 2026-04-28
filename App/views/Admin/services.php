<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h1 class="h4">Service Bookings</h1>
            <p class="text-muted small">Manage general pet service bookings</p>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Pet</th>
                        <th>Owner</th>
                        <th>Provider</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($serviceAppointments)): ?>
                        <?php foreach($serviceAppointments as $booking): ?>
                            <tr>
                                <td><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></td>
                                <td><?= htmlspecialchars($booking['PetName'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($booking['OwnerName'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($booking['ProviderName'] ?? 'N/A') ?></td>
                                <td><?= $booking['StartTime'] ?> - <?= $booking['EndTime'] ?></td>
                                <td>
                                    <?php 
                                        $st = $booking['status'] ?? 'Pending';
                                        $cls = strtolower($st);
                                        if($cls == 'under review') $cls = 'pending';
                                    ?>
                                    <span class="status-badge status-<?= $cls ?>"><?= $st ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No service bookings found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>