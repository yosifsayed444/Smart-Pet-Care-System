<?php require __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">Sales Report</h1>
                <p class="text-muted small">Revenue trends and financial summary</p>
            </div>
            <div class="btn-toolbar">
                <a href="<?= ROOT ?>/admin/generateReportPDF/sales" class="btn-pill btn-green mr-2"><i class="fa fa-file-pdf-o mr-1"></i>Download PDF</a>
            </div>
        </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <canvas id="salesChart" width="900" height="380"></canvas>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Revenue (EGP)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $s): ?>
                            <tr>
                                <td><?= $s['date'] ?></td>
                                <td><?= number_format($s['total'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach($sales as $s) echo "'".$s['date']."',"; ?>],
            datasets: [{
                label: 'Revenue',
                data: [<?php foreach($sales as $s) echo $s['total'].","; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
