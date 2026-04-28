<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">Manage Orders</h1>
                <p class="text-muted small">View and manage all customer orders</p>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success py-2 small mb-4">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger py-2 small mb-4">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($orders)): ?>
                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td>#<?= $order['OrderID'] ?></td>
                                <td><?= htmlspecialchars($order['username']) ?></td>
                                <td><?= date('M d, Y', strtotime($order['OrderDate'])) ?></td>
                                <td class="font-weight-bold"><?= number_format($order['TotalPrice'], 2) ?> EGP</td>
                                <td>
                                    <?php 
                                        $st = $order['Status'];
                                        $cls = strtolower($st);
                                    ?>
                                    <span class="status-badge status-<?= $cls ?>"><?= $st ?></span>
                                </td>
                                <td>
                                    <?php if($st === 'Pending'): ?>
                                        <a href="<?= ROOT ?>/admin/updateOrderStatus/<?= $order['OrderID'] ?>?status=Confirmed" class="action-btn btn-confirm">Confirm</a>
                                        <a href="<?= ROOT ?>/admin/updateOrderStatus/<?= $order['OrderID'] ?>?status=Cancelled" class="action-btn btn-cancel" onclick="return confirm('Cancel this order?')">Cancel</a>
                                    <?php elseif($st === 'Confirmed'): ?>
                                        <a href="<?= ROOT ?>/admin/updateOrderStatus/<?= $order['OrderID'] ?>?status=Cancelled" class="action-btn btn-cancel" onclick="return confirm('Cancel this order?')">Cancel</a>
                                    <?php else: ?>
                                        <span class="text-muted">No actions</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">No orders found in the system.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
