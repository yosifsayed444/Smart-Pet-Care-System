<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1>Payouts Management</h1>
                <p>Manage and release marketplace vendor payments</p>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" style="background: #e6fffa; color: #234e52; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid #b2f5ea;">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="dash-card" style="padding: 0; overflow: hidden;">
            <div class="table-responsive">
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #edf2f7;">
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">ID</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Provider</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Order ID</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Gross</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Fee (15%)</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Net</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Status</th>
                            <th style="padding: 1.25rem; text-align: left; color: #64748b; font-weight: 600;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['payouts'])): ?>
                            <?php foreach ($data['payouts'] as $payout): ?>
                                <tr style="border-bottom: 1px solid #edf2f7;">
                                    <td style="padding: 1.25rem;">#<?= $payout['PayoutID'] ?></td>
                                    <td style="padding: 1.25rem;">
                                        <div style="font-weight: 600; color: #1e293b;"><?= $payout['ProviderName'] ?></div>
                                        <div style="font-size: 0.75rem; color: #94a3b8;"><?= $payout['CreatedAt'] ?></div>
                                    </td>
                                    <td style="padding: 1.25rem;">#<?= $payout['OrderID'] ?></td>
                                    <td style="padding: 1.25rem;">$<?= number_format($payout['GrossAmount'], 2) ?></td>
                                    <td style="padding: 1.25rem; color: #e53e3e;">-$<?= number_format($payout['PlatformFee'], 2) ?></td>
                                    <td style="padding: 1.25rem; font-weight: 700; color: #38a169;">$<?= number_format($payout['NetAmount'], 2) ?></td>
                                    <td style="padding: 1.25rem;">
                                        <span class="badge" style="padding: 0.5rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;
                                            <?= $payout['Status'] == 'Paid' ? 'background: #f0fff4; color: #2f855a;' : 'background: #fffaf0; color: #9c4221;' ?>">
                                            <?= $payout['Status'] ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1.25rem;">
                                        <?php if ($payout['Status'] == 'Pending'): ?>
                                            <a href="<?= ROOT ?>/admin/releasePayout/<?= $payout['PayoutID'] ?>"
                                               class="btn-pill btn-green" style="font-size: 0.75rem; padding: 0.5rem 1rem;">
                                               Mark as Paid
                                            </a>
                                        <?php else: ?>
                                            <span style="color: #94a3b8; font-size: 0.75rem;">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="padding: 3rem; text-align: center; color: #94a3b8;">
                                    No payouts found in the system.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<style>
.table-responsive { overflow-x: auto; }
.btn-pill {
    display: inline-block;
    border-radius: 99px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}
.btn-green { background: #38a169; color: white; }
.btn-green:hover { background: #2f855a; }
</style>
