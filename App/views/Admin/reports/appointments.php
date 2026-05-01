<?php require __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">Appointment Activity</h1>
            </div>
            <div class="btn-toolbar">
                <a href="<?= ROOT ?>/admin/generateReportPDF/appointments" class="btn-pill btn-green mr-2"><i class="fa fa-file-pdf-o mr-1"></i>Download PDF</a>
            </div>
        </div>


            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Number of Appointments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $a): ?>
                            <tr>
                                <td><?= $a['date'] ?></td>
                                <td><?= $a['count'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </main>
</div>

