<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="d-flex" id="wrapper">
    
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    
    <div id="page-content-wrapper" class="w-100 bg-light">
        <div class="container-fluid py-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0 text-gray-800"><i class="fa fa-lock text-primary"></i> Service Escrow Management</h2>
            </div>

            <div class="card shadow mb-4 border-0">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Escrow Ledger</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Service Date</th>
                                    <th>Pet Owner</th>
                                    <th>Provider</th>
                                    <th>Amount</th>
                                    <th>Escrow Status</th>
                                    <th>Admin Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings)): ?>
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td>#<?= htmlspecialchars($booking['BookingID']) ?></td>
                                            <td><?= htmlspecialchars($booking['BookingDate']) ?></td>
                                            <td><?= htmlspecialchars($booking['OwnerName'] ?? 'Unknown') ?></td>
                                            <td><?= htmlspecialchars($booking['ProviderName'] ?? 'Unknown') ?></td>
                                            <td><?= htmlspecialchars(number_format($booking['EscrowAmount'], 2)) ?> EGP</td>
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
                                                    <a href="<?= ROOT ?>/admin/forceEscrowAction/<?= $booking['BookingID'] ?>?action=Released" class="btn btn-sm btn-success" onclick="return confirm('Force release funds to provider?');">
                                                        Release
                                                    </a>
                                                    <a href="<?= ROOT ?>/admin/forceEscrowAction/<?= $booking['BookingID'] ?>?action=Refunded" class="btn btn-sm btn-secondary" onclick="return confirm('Refund funds to owner?');">
                                                        Refund
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted small">No action needed</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4">No bookings found in ledger.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
