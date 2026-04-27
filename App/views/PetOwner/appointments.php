<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    .nav-tabs .nav-link.active { border-bottom: 3px solid #007bff; color: #007bff; font-weight: 700; }
    .nav-tabs .nav-link { border: none; color: #666; transition: 0.3s; }
    .card { border-radius: 15px; border: none; }
</style>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Scheduled Appointments 📅</h1>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa fa-check-circle mr-2"></i><?= $_SESSION['success'] ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fa fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tabs Header -->
    <ul class="nav nav-tabs mb-4" id="appointmentTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="vet-tab" data-toggle="tab" href="#vet-content" role="tab">
                Veterinary Checkups 🩺
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="service-tab" data-toggle="tab" href="#service-content" role="tab">
                Services & Sitting 🐾
            </a>
        </li>
    </ul>

    <div class="tab-content" id="appointmentTabsContent">
        
        <!-- VETERINARY APPOINTMENTS TAB -->
        <div class="tab-pane fade show active" id="vet-content" role="tabpanel">
            <div class="card shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Vet Appointments</h5>
                    <a href="<?= ROOT ?>/petowner/bookVet" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Book New Vet</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Date</th>
                                <th>Pet</th>
                                <th>Veterinarian</th>
                                <th>Specialization</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($vetAppointments)): ?>
                                <?php foreach($vetAppointments as $vApp): ?>
                                    <tr>
                                        <td><strong><?= date('M d, Y', strtotime($vApp['AppointmentDate'])) ?></strong></td>
                                        <td><?= htmlspecialchars($vApp['PetName']) ?></td>
                                        <td>Dr. <?= htmlspecialchars($vApp['VetName']) ?></td>
                                        <td><span class="badge badge-info"><?= htmlspecialchars($vApp['Specialization']) ?></span></td>
                                        <td>
                                            <?php 
                                                $vStatus = $vApp['status'] ?? 'Pending';
                                                $vBadge  = $vStatus == 'Accepted' ? 'success' : ($vStatus == 'Rejected' ? 'danger' : 'warning');
                                            ?>
                                            <span class="badge badge-<?= $vBadge ?>"><?= $vStatus ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= ROOT ?>/petowner/deleteVetAppointment/<?= $vApp['AppointmentID'] ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Cancel this vet appointment?')">
                                                Cancel 🗑️
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No veterinary appointments scheduled. <br>
                                        <a href="<?= ROOT ?>/petowner/bookVet" class="btn btn-outline-primary btn-sm mt-2">Find a Vet</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SERVICE BOOKINGS TAB -->
        <div class="tab-pane fade" id="service-content" role="tabpanel">
            <div class="card shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Service & Provider Bookings</h5>
                    <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-success btn-sm"><i class="fa fa-search mr-1"></i> Browse Services</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>Date / Time</th>
                                <th>Pet</th>
                                <th>Service</th>
                                <th>Provider</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($bookings)): ?>
                                <?php foreach($bookings as $booking): ?>
                                    <tr>
                                        <td>
                                            <strong><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></strong><br>
                                            <small><?= date('h:i A', strtotime($booking['StartTime'])) ?> - <?= date('h:i A', strtotime($booking['EndTime'])) ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($booking['PetName']) ?></td>
                                        <td><?= htmlspecialchars($booking['service_name'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($booking['provider_name']) ?></td>
                                        <td>
                                            <?php 
                                                $status = $booking['status'] ?? 'Under Review';
                                                $badgeClass = 'badge-secondary';
                                                if ($status == 'Accepted') $badgeClass = 'badge-success';
                                                if ($status == 'Rejected') $badgeClass = 'badge-danger';
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= ROOT ?>/petowner/deleteAppointment/<?= $booking['BookingID'] ?>" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Cancel this service booking?')">
                                                Cancel 🗑️
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        No service bookings found. <br>
                                        <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-outline-success btn-sm mt-2">Browse All Services</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
