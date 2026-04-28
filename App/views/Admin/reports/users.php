<?php require __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">User Statistics</h1>
                <p class="text-muted small">Demographics and platform role distribution</p>
            </div>
            <div class="btn-toolbar">
                <a href="<?= ROOT ?>/admin/generateReportPDF/users" class="btn-pill btn-green mr-2"><i class="fa fa-file-pdf-o mr-1"></i>Download PDF</a>
            </div>
        </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <canvas id="userChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userStats as $u): ?>
                                        <tr>
                                            <td><?= $u['role'] ?></td>
                                            <td><?= $u['count'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [<?php foreach($userStats as $u) echo "'".$u['role']."',"; ?>],
            datasets: [{
                data: [<?php foreach($userStats as $u) echo $u['count'].","; ?>],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
