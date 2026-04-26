<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row">

        <!-- Users -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Users Management</h5>

                    <a href="<?= ROOT ?>/admin/users"
                       class="btn btn-primary btn-sm m-1">
                        View Users
                    </a>

                    <a href="<?= ROOT ?>/admin/addUser"
                       class="btn btn-success btn-sm m-1">
                        Add User
                    </a>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Products</h5>

                    <a href="<?= ROOT ?>/admin/products"
                       class="btn btn-primary btn-sm m-1">
                        Manage Products
                    </a>

                    <a href="<?= ROOT ?>/admin/addProduct"
                       class="btn btn-success btn-sm m-1">
                        Add Product
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Orders</h5>

                    <a href="<?= ROOT ?>/admin/orders"
                       class="btn btn-primary btn-sm m-1">
                        View Orders
                    </a>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Appointments</h5>

                    <a href="<?= ROOT ?>/admin/appointments"
                       class="btn btn-primary btn-sm m-1">
                        Manage Appointments
                    </a>
                </div>
            </div>
        </div>

        <!-- Roles -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Roles & Permissions</h5>

                    <a href="<?= ROOT ?>/admin/manageRoles"
                       class="btn btn-primary btn-sm m-1">
                        Manage Roles
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Notifications</h5>

                    <a href="<?= ROOT ?>/admin/notificationEscalator"
                       class="btn btn-primary btn-sm m-1">
                        Notifications
                    </a>

                    <a href="<?= ROOT ?>/admin/healthAlerts"
                       class="btn btn-warning btn-sm m-1">
                        Health Alerts
                    </a>
                </div>
            </div>
        </div>

        <!-- Lost Pet -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Lost Pet</h5>

                    <a href="<?= ROOT ?>/admin/lostPetBroadcast"
                       class="btn btn-danger btn-sm m-1">
                        Broadcast Alert
                    </a>
                </div>
            </div>
        </div>

        <!-- Disputes -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Disputes</h5>

                    <a href="<?= ROOT ?>/admin/manageDisputes"
                       class="btn btn-primary btn-sm m-1">
                        Manage Disputes
                    </a>
                </div>
            </div>
        </div>

        <!-- Logs -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Audit Logs</h5>

                    <a href="<?= ROOT ?>/admin/auditLogs"
                       class="btn btn-dark btn-sm m-1">
                        View Logs
                    </a>
                </div>
            </div>
        </div>

        <!-- Suspension -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Suspended Users</h5>

                    <a href="<?= ROOT ?>/admin/suspendUsers"
                       class="btn btn-danger btn-sm m-1">
                        Suspend Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Archive -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Archive</h5>

                    <a href="<?= ROOT ?>/admin/archiveData"
                       class="btn btn-secondary btn-sm m-1">
                        Archive Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Currency -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Currency</h5>

                    <a href="<?= ROOT ?>/admin/manageCurrency"
                       class="btn btn-primary btn-sm m-1">
                        Manage Currency
                    </a>
                </div>
            </div>
        </div>

        <!-- Verification -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>User Verification</h5>

                    <a href="<?= ROOT ?>/admin/verifyUsers"
                       class="btn btn-success btn-sm m-1">
                        Verify Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Reports</h5>

                    <a href="<?= ROOT ?>/admin/reports"
                       class="btn btn-primary btn-sm m-1">
                        Reports Dashboard
                    </a>

                    <a href="<?= ROOT ?>/admin/salesReport"
                       class="btn btn-success btn-sm m-1">
                        Sales Report
                    </a>

                    <a href="<?= ROOT ?>/admin/userReport"
                       class="btn btn-info btn-sm m-1">
                        User Report
                    </a>

                    <a href="<?= ROOT ?>/admin/appointmentReport"
                       class="btn btn-warning btn-sm m-1">
                        Appointment Report
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>