<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>


<div class="dashboard-wrapper">
    <div class="container-fluid px-md-5">
        
        <div class="row mb-5 align-items-center">
            <div class="col-md-8">
                <h6 class="text-uppercase tracking-widest text-primary font-weight-bold mb-2">Pet Owner Dashboard</h6>
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
                                                <span>Perscriptions</span>
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

                                    <div class="d-flex justify-content-between mb-2">
                                        <a href="<?= ROOT ?>/petowner/viewConditions/<?= $pet['PetID'] ?>" class="btn btn-sm btn-light border flex-grow-1 mr-2 font-weight-bold text-danger">
                                            Conditions
                                        </a>
                                        <a href="<?= ROOT ?>/petowner/viewWeight/<?= $pet['PetID'] ?>" class="btn btn-sm btn-light border flex-grow-1 font-weight-bold text-info">
                                            Weight
                                        </a>
                                    </div>
                                    <?php if (!empty($pet['passport_ready'])): ?>
                                        <a href="<?= ROOT ?>/vet/passport/<?= $pet['PetID'] ?>" target="_blank" class="btn btn-sm btn-block btn-outline-dark rounded-pill font-weight-bold">
                                            <i class="fa fa-plane mr-1"></i> Generate Travel Passport
                                        </a>
                                    <?php else: ?>
                                        <div class="alert alert-danger py-2 mb-0 text-center rounded-pill small font-weight-bold" style="border: 1px dashed #dc3545; background: rgba(220, 53, 69, 0.05);">
                                            <i class="fa fa-lock mr-1"></i>Passport Not Assigned by Vet Yet
                                        </div>
                                    <?php endif; ?>
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
                                    <i class="fa fa-user-md"></i> Specialist Triage
                                </a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link text-danger font-weight-bold" data-toggle="pill" href="#incident-pane">
                                    <i class="fa fa-bell"></i> Incidents
                                    <?php if (!empty($openIncidentsCount)): ?>
                                        <span class="badge badge-danger badge-pill ml-1"><?= $openIncidentsCount ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-danger-soft text-danger font-weight-bold" data-toggle="pill" href="#emergency-pane">
                                    <i class="fa fa-heartbeat"></i> Emergency Red Flags
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="dashboardTabsContent">
                        
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
                                                         <?php endif; ?>
                                                         <div class="mt-1 font-weight-bold text-dark small">
                                                             <i class="fa fa-money mr-1"></i> Cost: <?= number_format($booking['TotalPrice'] ?? 0, 2) ?> EGP
                                                         </div>
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
                                                             <button class="btn btn-sm btn-outline-warning rounded-pill px-3 ml-2" data-toggle="modal" data-target="#rateSitter<?= $booking['BookingID'] ?>">
                                                                 <i class="fa fa-star mr-1"></i> Rate Sitter
                                                             </button>
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

                        <div class="tab-pane fade" id="incident-pane">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="font-weight-bold mb-0 text-danger">Incident Alerts</h4>
                                <a href="<?= ROOT ?>/petowner/incidents" class="text-muted small font-weight-bold">View History <i class="fa fa-arrow-right"></i></a>
                            </div>

                            <?php if (empty($incidents)): ?>
                                <div class="alert alert-success p-4 text-center rounded-xl border-0 shadow-sm">
                                    <i class="fa fa-check-circle fa-2x mb-3 text-success"></i>
                                    <h5>All Clear!</h5>
                                    <p class="mb-0 text-muted">There are no reported incidents or emergencies for any of your pets.</p>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ($incidents as $incident): ?>
                                        <div class="col-md-6 mb-4">
                                            <?php 
                                                $borderColor = 'border-warning';
                                                $headerColor = 'bg-warning text-dark';
                                                if ($incident['Severity'] == 'High' || $incident['Severity'] == 'Critical') {
                                                    $borderColor = 'border-danger';
                                                    $headerColor = 'bg-danger text-white';
                                                }
                                            ?>
                                            <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; overflow: hidden; border-left: 5px solid <?= ($incident['Severity'] == 'High' || $incident['Severity'] == 'Critical') ? '#dc3545' : '#ffc107' ?> !important;">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <span class="badge <?= ($incident['Severity'] == 'High' || $incident['Severity'] == 'Critical') ? 'badge-danger' : 'badge-warning' ?> px-3 py-2 rounded-pill">
                                                            <?= htmlspecialchars($incident['Severity']) ?> Priority
                                                        </span>
                                                        <small class="text-muted font-weight-bold"><?= date('M d, g:i A', strtotime($incident['ReportedAt'])) ?></small>
                                                    </div>
                                                    <h6 class="font-weight-800 mb-2">Pet: <?= htmlspecialchars($incident['PetName']) ?></h6>
                                                    <p class="small text-muted mb-3">
                                                        <i class="fa fa-user-circle mr-1"></i> Sitter: <?= htmlspecialchars($incident['SitterName'] ?? 'Unknown Sitter') ?>
                                                        <br>
                                                        <i class="fa fa-hashtag mr-1"></i> Booking ID: #<?= htmlspecialchars($incident['BookingID']) ?>
                                                    </p>
                                                    <div class="p-3 bg-light rounded-lg border-0 small text-dark" style="background: #f8f9fa;">
                                                        <strong>Report Details:</strong><br>
                                                        <?= nl2br(htmlspecialchars($incident['Description'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane fade" id="triage-pane">
                            <div class="triage-card">
                                <div class="text-center mb-4">
                                    <h3 class="font-weight-800 text-primary">Specialist Triage</h3>
                                    <p class="text-muted">Select symptoms to find the right veterinary specialist.</p>
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
                                    
                                    <label class="small font-weight-bold text-uppercase tracking-wider mb-3 d-block">Non-Emergency Symptoms</label>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="tumor" id="symp1" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp1">Abnormal Growth</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="aggressive" id="symp2" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp2">Aggression</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="vomiting" id="symp3" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold" for="symp3">Vomiting</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 font-weight-800 shadow">
                                        <i class="fa fa-user-md mr-2"></i> ANALYZE SYMPTOMS
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="emergency-pane">
                            <div class="triage-card border-danger" style="border-width: 2px;">
                                <div class="text-center mb-4">
                                    <h3 class="font-weight-800 text-danger">Emergency Red Flags</h3>
                                    <p class="text-muted">Select life-threatening symptoms for immediate medical protocol.</p>
                                </div>
                                <form action="<?= ROOT ?>/petowner/triageResult" method="post" class="bg-white p-4 rounded-xl shadow-sm border border-danger">
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold text-uppercase tracking-wider">Target Patient</label>
                                        <select class="form-control rounded-lg border-danger" name="petId" required style="height: 50px; font-weight: 600;">
                                            <option value="" disabled selected>Choose a Pet...</option>
                                            <?php foreach ($pets as $pet): ?>
                                                <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <label class="small font-weight-bold text-uppercase tracking-wider mb-3 d-block text-danger font-weight-bold">CRITICAL INDICATORS (SELECT ANY):</label>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="breathing" id="esymp1" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold text-danger h5" for="esymp1"><i class="fa fa-heartbeat mr-1"></i> Breathing Difficulty</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="bleeding" id="esymp2" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold text-danger h5" for="esymp2"><i class="fa fa-tint mr-1"></i> Severe Bleeding</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                                <input type="checkbox" name="symptoms[]" value="seizure" id="esymp3" class="custom-control-input">
                                                <label class="custom-control-label font-weight-bold text-danger h5" for="esymp3"><i class="fa fa-bolt mr-1"></i> Seizures</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block rounded-pill py-3 font-weight-800 shadow animate-pulse">
                                        <i class="fa fa-ambulance mr-2"></i> ACTIVATE EMERGENCY PROTOCOL
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


<?php if(!empty($bookings)): ?>
    <?php foreach($bookings as $booking): ?>
        <?php if(($booking['status'] ?? '') == 'Completed' || !empty($booking['CheckOutTime'])): ?>
            <div class="modal fade" id="rateSitter<?= $booking['BookingID'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="modal-header bg-warning text-dark border-0 py-4" style="border-radius: 20px 20px 0 0;">
                            <h5 class="modal-title font-weight-800 ml-3"><i class="fa fa-star mr-2"></i>Rate Service Provider</h5>
                            <button type="button" class="close mr-2" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form action="<?= ROOT ?>/petowner/submitCommunityReview" method="POST">
                            <div class="modal-body p-4">
                                <input type="hidden" name="booking_id" value="<?= $booking['BookingID'] ?>">
                                <input type="hidden" name="reviewee_id" value="<?= $booking['ProviderID'] ?>">
                                
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-uppercase tracking-wider">Service Quality</label>
                                    <select name="rating" class="form-control rounded-lg" required style="height: 50px;">
                                        <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ - Good</option>
                                        <option value="3">⭐⭐⭐ - Average</option>
                                        <option value="2">⭐⭐ - Poor</option>
                                        <option value="1">⭐ - Terrible</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="small font-weight-bold text-uppercase tracking-wider">Your Feedback</label>
                                    <textarea name="comment" class="form-control rounded-lg" rows="4" placeholder="How was the experience? Your feedback helps the community." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 p-4">
                                <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning rounded-pill px-5 font-weight-bold shadow">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>