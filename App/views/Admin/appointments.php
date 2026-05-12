<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h1 class="h4">Appointments & Bookings</h1>
            <p class="text-muted small">Manage veterinary checkups bookings</p>
        </div>

        <div class="tab-content" id="appointmentTabsContent">

            <div class="tab-pane fade show active" id="vet-pane" role="tabpanel">
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Pet</th>
                                <th>Owner</th>
                                <th>Vet</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($vetAppointments)): ?>
                                <?php foreach($vetAppointments as $app): ?>
                                    <tr>
                                        <td><?= date('M d, Y', strtotime($app['AppointmentDate'])) ?></td>
                                        <td><?= htmlspecialchars($app['PetName']) ?></td>
                                        <td><?= htmlspecialchars($app['OwnerName']) ?></td>
                                        <td><?= htmlspecialchars($app['VetName']) ?></td>
                                        <td>
                                            <?php
                                                $st = $app['status'] ?? 'Pending';
                                                $cls = strtolower($st);
                                            ?>
                                            <span class="status-badge status-<?= $cls ?>"><?= $st ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">No vet appointments found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
    </main>
</div>
