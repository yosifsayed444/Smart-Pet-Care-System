<?php require __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="h4">System Reports & Analytics</h1>
                <p class="text-muted small">Overview of business and user metrics</p>
            </div>
        </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <i class="fa fa-money fa-3x text-primary mb-3"></i>
                            <h4>Sales Report</h4>
                            <p>Daily revenue trends and total sales summary.</p>
                            <a href="<?= ROOT ?>/admin/salesReport" class="btn btn-outline-primary btn-block">View Sales</a>
                            <a href="<?= ROOT ?>/admin/generateReportPDF/sales" class="btn btn-primary btn-block"><i class="fa fa-file-pdf-o mr-2"></i>Download PDF</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <i class="fa fa-users fa-3x text-success mb-3"></i>
                            <h4>User Statistics</h4>
                            <p>Demographics and user role distributions.</p>
                            <a href="<?= ROOT ?>/admin/userReport" class="btn btn-outline-success btn-block">View Users</a>
                            <a href="<?= ROOT ?>/admin/generateReportPDF/users" class="btn btn-success btn-block"><i class="fa fa-file-pdf-o mr-2"></i>Download PDF</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <i class="fa fa-calendar-check-o fa-3x text-info mb-3"></i>
                            <h4>Appointment Activity</h4>
                            <p>Booking volumes for vets and service providers.</p>
                            <a href="<?= ROOT ?>/admin/appointmentReport" class="btn btn-outline-info btn-block">View Activity</a>
                            <a href="<?= ROOT ?>/admin/generateReportPDF/appointments" class="btn btn-info btn-block"><i class="fa fa-file-pdf-o mr-2"></i>Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>
