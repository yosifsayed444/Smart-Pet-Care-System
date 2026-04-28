<?php require __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">Appointment Activity</h1>
                <p class="text-muted small">Trends and booking volumes</p>
            </div>
            <div class="btn-toolbar">
                <a href="<?= ROOT ?>/admin/generateReportPDF/appointments" class="btn-pill btn-green mr-2"><i class="fa fa-file-pdf-o mr-1"></i>Download PDF</a>
            </div>
        </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <canvas id="appChart" width="900" height="380"></canvas>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('appChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach($appointments as $a) echo "'".$a['date']."',"; ?>],
            datasets: [{
                label: 'Appointments',
                data: [<?php foreach($appointments as $a) echo $a['count'].","; ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
