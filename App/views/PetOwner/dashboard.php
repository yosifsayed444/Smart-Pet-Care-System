<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
:root {
    --glass-bg: rgba(255, 255, 255, 0.75);
    --glass-border: rgba(255, 255, 255, 0.3);
    --premium-blue: #185FA5;
    --premium-green: #2ecc71;
    --premium-red: #e74c3c;
    --soft-shadow: 0 8px 32px rgba(31, 38, 135, 0.08);
}

.dashboard-wrapper {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: 40px;
    padding-bottom: 60px;
}

.premium-card {
    background: var(--glass-bg);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 24px;
    border: 1px solid var(--glass-border);
    box-shadow: var(--soft-shadow);
    padding: 30px;
    height: 100%;
}

.section-header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* Pet Quick Actions Grid */
.medical-icon-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 12px;
    border-radius: 16px;
    background: #fff;
    transition: all 0.2s;
    border: 1px solid #f1f5f9;
}
.medical-icon-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-color: var(--premium-blue);
}
.medical-icon-btn i { font-size: 1.25rem; }
.medical-icon-btn span { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em; color: #64748b; }

/* Custom Tabs */
.nav-pills-custom .nav-link {
    color: #64748b;
    font-weight: 700;
    padding: 12px 20px;
    border-radius: 12px;
    transition: all 0.2s;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.nav-pills-custom .nav-link.active {
    background: var(--premium-blue) !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(24,95,165,0.3);
}

/* Status Badges */
.stat-badge {
    padding: 6px 12px;
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
}

/* Table Style */
.table-premium {
    border-collapse: separate;
    border-spacing: 0 8px;
}
.table-premium tr { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
.table-premium td { padding: 15px !important; vertical-align: middle !important; border: none !important; }
.table-premium td:first-child { border-radius: 12px 0 0 12px; }
.table-premium td:last-child { border-radius: 0 12px 12px 0; }

.btn-glass {
    background: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.8);
    backdrop-filter: blur(5px);
    border-radius: 10px;
    padding: 8px 16px;
    font-weight: 600;
    transition: 0.3s;
}
.btn-glass:hover { background: #fff; transform: translateY(-2px); }

/* Pet Selection in Triage */
.triage-card {
    background: #f8fafc;
    border: 2px dashed #e2e8f0;
    border-radius: 20px;
    padding: 25px;
}
</style>

<div class="dashboard-wrapper">
    <div class="container-fluid px-md-5">
        
        <!-- Top Statistics/Welcome -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-8">
                <h6 class="text-uppercase tracking-widest text-primary font-weight-bold mb-2">Pet Owner Dashboard</h6>
                <h1 class="font-weight-800" style="font-size: 2.8rem; letter-spacing: -0.04em;">My Pet Family 🐾</h1>
                <p class="text-muted">Welcome back! Here's what's happening with your pets today.</p>
            </div>
            <div class="col-md-4 text-md-right">
                <?php if (!empty($openIncidentsCount)): ?>
                    <div class="d-inline-flex align-items-center bg-danger text-white px-4 py-2 rounded-pill shadow">
                        <i class="fa fa-exclamation-triangle mr-3"></i>
                        <div class="text-left">
                            <small class="d-block font-weight-bold" style="line-height: 1;">Incident Alert</small>
                            <span class="font-weight-800" style="font-size: 1.1rem;"><?= $openIncidentsCount ?> Open</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-xl mb-4 border-0 shadow-sm">
                <i class="fa fa-check-circle mr-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Left Column: Pets Management -->
            <div class="col-lg-4 mb-4">
                <div class="premium-card">
                    <div class="d-flex justify-content-between align-items-center section-header">
                        <h4 class="font-weight-bold mb-0">My Pets</h4>
                        <a href="<?= ROOT ?>/petowner/pets" class="btn-glass text-primary small">
                            <i class="fa fa-plus-circle mr-1"></i> Register
                        </a>
                    </div>
                    
                    <div class="pet-list mt-3">
                        <?php if(!empty($pets)): ?>
                            <?php foreach($pets as $pet): ?>
                                <div class="bg-white p-4 rounded-xl border mb-4 shadow-sm" style="border-radius: 20px;">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="font-weight-800 mb-0"><?= htmlspecialchars($pet['PetName']) ?></h5>
                                            <span class="badge badge-light border text-muted small px-2"><?= htmlspecialchars($pet['Species']) ?></span>
                                        </div>
                                        <div class="text-right">
                                            <span class="d-block font-weight-bold text-primary" style="font-size: 1.1rem;"><?= htmlspecialchars($pet['Age']) ?>Y</span>
                                            <small class="text-muted text-uppercase"><?= htmlspecialchars($pet['Gender']) ?></small>
                                        </div>
                                    </div>

                                    <!-- Quick Medical Links -->
                                    <div class="row no-gutters mb-3" style="gap: 8px;">
                                        <div class="col">
                                            <a href="<?= ROOT ?>/petowner/vaccinations/<?= $pet['PetID'] ?>" class="medical-icon-btn">
                                                <i class="fa fa-shield text-info"></i>
                                                <span>Vaccines</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="<?= ROOT ?>/petowner/prescriptions/<?= $pet['PetID'] ?>" class="medical-icon-btn">
                                                <i class="fa fa-file-text-o text-success"></i>
                                                <span>Rx List</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="<?= ROOT ?>/petowner/labResults/<?= $pet['PetID'] ?>" class="medical-icon-btn">
                                                <i class="fa fa-flask text-warning"></i>
                                                <span>Labs</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="<?= ROOT ?>/petowner/medicalNotes/<?= $pet['PetID'] ?>" class="medical-icon-btn">
                                                <i class="fa fa-stethoscope text-danger"></i>
                                                <span>Notes</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="<?= ROOT ?>/petowner/viewConditions/<?= $pet['PetID'] ?>" class="btn btn-sm btn-light border flex-grow-1 mr-2 font-weight-bold text-danger">
                                            Conditions
                                        </a>
                                        <a href="<?= ROOT ?>/petowner/viewWeight/<?= $pet['PetID'] ?>" class="btn btn-sm btn-light border flex-grow-1 font-weight-bold text-info">
                                            Weight
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fa fa-paw fa-3x text-muted mb-3 opacity-25"></i>
                                <p class="text-muted">No pets registered yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Activity Hub -->
            <div class="col-lg-8">
                <div class="premium-card">
                    <div class="section-header mb-4">
                        <ul class="nav nav-pills nav-pills-custom" id="dashboardTabs" role="tablist">
                            <li class="nav-item mr-2">
                                <a class="nav-link active" data-toggle="pill" href="#vet-pane">
                                    <i class="fa fa-stethoscope"></i> Vet Checkups
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" data-toggle="pill" href="#service-pane">
                                    <i class="fa fa-calendar-check-o"></i> Services
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" data-toggle="pill" href="#order-pane">
                                    <i class="fa fa-shopping-bag"></i> Orders
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" data-toggle="pill" href="#lost-pane">
                                    <i class="fa fa-bullhorn text-danger"></i> Lost Alerts
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" data-toggle="pill" href="#triage-pane">
                                    <i class="fa fa-android"></i> AI Triage
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger font-weight-bold" href="<?= ROOT ?>/petowner/incidents">
                                    <i class="fa fa-bell"></i> Incidents
                                    <?php if (!empty($openIncidentsCount)): ?>
                                        <span class="badge badge-danger badge-pill ml-1"><?= $openIncidentsCount ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="dashboardTabsContent">
                        
                        <!-- Vet Checkups Pane -->
                        <div class="tab-pane fade show active" id="vet-pane">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="font-weight-bold mb-0">Upcoming Checkups</h4>
                                <a href="<?= ROOT ?>/petowner/bookVet" class="btn btn-primary btn-sm rounded-pill px-4">Book Vet Appointment</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-premium">
                                    <thead>
                                        <tr class="text-muted small text-uppercase">
                                            <th>Date</th>
                                            <th>Pet & Doctor</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($vetAppointments)): ?>
                                            <?php foreach($vetAppointments as $vApp): ?>
                                                <tr>
                                                    <td>
                                                        <span class="d-block font-weight-800 text-dark"><?= date('M d', strtotime($vApp['AppointmentDate'])) ?></span>
                                                        <small class="text-muted"><?= date('D', strtotime($vApp['AppointmentDate'])) ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="d-block font-weight-bold"><?= htmlspecialchars($vApp['PetName']) ?></span>
                                                        <small class="text-muted">Dr. <?= htmlspecialchars($vApp['VetName']) ?></small>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $st = $vApp['status'] ?? 'Pending';
                                                            $cls = $st == 'Accepted' ? 'success' : ($st == 'Rejected' ? 'danger' : 'warning');
                                                        ?>
                                                        <span class="stat-badge bg-light text-<?= $cls ?>"><?= $st ?></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="<?= ROOT ?>/petowner/deleteVetAppointment/<?= $vApp['AppointmentID'] ?>" 
                                                           class="btn btn-sm btn-light border text-danger rounded-circle" style="width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;"
                                                           onclick="return confirm('Cancel checkup?')">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-5 text-muted">No upcoming appointments.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Service Bookings Pane -->
                        <div class="tab-pane fade" id="service-pane">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="font-weight-bold mb-0">Service Bookings</h4>
                                <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-success btn-sm rounded-pill px-4">Browse Services</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-premium">
                                    <thead>
                                        <tr class="text-muted small text-uppercase">
                                            <th>Date</th>
                                            <th>Service Details</th>
                                            <th>Security Status</th>
                                            <th class="text-right">Management</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($bookings)): ?>
                                            <?php foreach($bookings as $booking): ?>
                                                <tr>
                                                    <td>
                                                        <span class="d-block font-weight-800"><?= date('M d', strtotime($booking['BookingDate'])) ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="d-block font-weight-bold text-dark"><?= htmlspecialchars($booking['service_name'] ?? 'Pet Service') ?></span>
                                                        <?php 
                                                            $status = $booking['status'] ?? 'Under Review';
                                                            if (!empty($booking['CheckOutTime'])) $status = 'Completed';
                                                            $cls = ($status == 'Accepted') ? 'success' : (($status == 'Completed') ? 'primary' : (($status == 'Rejected') ? 'danger' : 'secondary'));
                                                        ?>
                                                        <span class="stat-badge bg-light text-<?= $cls ?> d-inline-block mt-1"><?= $status ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if (($status == 'Accepted' || $status == 'Completed') && $booking['EscrowStatus'] == 'Held'): ?>
                                                            <span class="badge badge-warning text-white small px-2 py-1"><i class="fa fa-lock mr-1"></i> Funds Held</span>
                                                        <?php elseif (($status == 'Accepted' || $status == 'Completed') && $booking['EscrowStatus'] == 'Released'): ?>
                                                            <span class="badge badge-success small px-2 py-1"><i class="fa fa-unlock mr-1"></i> Funds Released</span>
                                                        <?php else: ?>
                                                            <span class="text-muted small">Pending Escrow</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php if ($status == 'Accepted'): ?>
                                                            <a href="<?= ROOT ?>/petowner/generateQR/<?= $booking['BookingID'] ?>" 
                                                               class="btn btn-sm btn-primary rounded-pill px-3 font-weight-bold">
                                                                <i class="fa fa-qrcode mr-1"></i> QR Access
                                                            </a>
                                                        <?php elseif ($status == 'Under Review'): ?>
                                                            <a href="<?= ROOT ?>/petowner/deleteAppointment/<?= $booking['BookingID'] ?>" 
                                                               class="text-danger small font-weight-bold" onclick="return confirm('Cancel request?')">
                                                                Cancel Request
                                                            </a>
                                                        <?php elseif ($status == 'Completed'): ?>
                                                            <span class="text-muted small"><i class="fa fa-check-circle text-success mr-1"></i> Completed</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-5 text-muted">No active bookings.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Orders Pane -->
                        <div class="tab-pane fade" id="order-pane">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="font-weight-bold mb-0">Shop Orders</h4>
                                <a href="<?= ROOT ?>/shop" class="btn btn-dark btn-sm rounded-pill px-4">Go to Shop</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-premium">
                                    <thead>
                                        <tr class="text-muted small text-uppercase">
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Total Price</th>
                                            <th>Fulfillment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($orders)): ?>
                                            <?php foreach($orders as $order): ?>
                                                <tr>
                                                    <td class="font-weight-bold">#ORD-<?= $order['OrderID'] ?></td>
                                                    <td class="text-muted"><?= date('Y-m-d', strtotime($order['OrderDate'])) ?></td>
                                                    <td class="font-weight-800 text-dark"><?= number_format($order['TotalPrice'], 2) ?> EGP</td>
                                                    <td>
                                                        <?php 
                                                            $st = $order['Status'];
                                                            $cls = $st == 'Confirmed' ? 'success' : ($st == 'Cancelled' ? 'danger' : 'warning');
                                                        ?>
                                                        <span class="stat-badge bg-light text-<?= $cls ?>"><?= $st ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-5 text-muted">No order history found.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Community Alerts -->
                        <div class="tab-pane fade" id="lost-pane">
                            <div class="bg-danger-light p-4 rounded-xl border border-danger mb-4" style="background: rgba(231, 76, 60, 0.05);">
                                <h5 class="text-danger font-weight-bold mb-1"><i class="fa fa-bullhorn mr-2"></i>Community Emergency</h5>
                                <p class="text-muted small">The following pets have been reported missing in your vicinity. Please stay alert!</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-premium">
                                    <tbody>
                                        <?php if(!empty($lostPets)): ?>
                                            <?php foreach($lostPets as $lp): ?>
                                                <tr>
                                                    <td>
                                                        <span class="d-block font-weight-800 text-danger"><?= htmlspecialchars($lp['PetName'] ?? 'Unknown Pet') ?></span>
                                                        <small class="text-muted"><?= date('M d, Y', strtotime($lp['DateReported'])) ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="d-block text-dark font-weight-bold"><i class="fa fa-map-marker text-danger mr-2"></i><?= htmlspecialchars($lp['Location']) ?></span>
                                                        <small class="text-muted"><?= htmlspecialchars($lp['Description']) ?></small>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td class="text-center py-5 text-muted">No active community alerts.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- AI Triage Pane -->
                        <div class="tab-pane fade" id="triage-pane">
                            <div class="triage-card">
                                <div class="text-center mb-4">
                                    <h3 class="font-weight-800 text-primary">Vet Bot Triage AI</h3>
                                    <p class="text-muted">Select your pet and check symptoms for immediate guidance.</p>
                                </div>
                                <form action="<?= ROOT ?>/petowner/triageResult" method="post" class="bg-white p-4 rounded-xl shadow-sm">
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold text-uppercase tracking-wider">Target Patient</label>
                                        <select class="form-control rounded-lg" name="petId" required style="height: 50px; font-weight: 600;">
                                            <option value="" disabled selected>Choose a Pet...</option>
                                            <?php foreach ($pets as $pet): ?>
                                                <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <label class="small font-weight-bold text-uppercase tracking-wider mb-3 d-block">Presenting Symptoms</label>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="tumor" id="symp1" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp1">Abnormal Growth/Tumor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="aggressive" id="symp2" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp2">Unusual Aggression</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="vomiting" id="symp3" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp3">Frequent Vomiting</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 font-weight-800 shadow">
                                        <i class="fa fa-magic mr-2"></i> ANALYZE SYMPTOMS
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>