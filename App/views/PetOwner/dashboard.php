<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>

.glass-panel {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    padding: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}
.pet-card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    border: 1px solid #eee;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: all 0.3s ease;
}
.pet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.action-btn {
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 8px 15px;
}
.nav-tabs .nav-link.active { border-bottom: 4px solid #007bff; color: #007bff; font-weight: 700; background: none; }
.nav-tabs .nav-link { border: none; color: #777; transition: 0.3s; padding: 15px 25px; }




form h3 {
color: #1b652d;
margin-bottom: 10px;
}

label {
display: block;
margin: 10px 0;
font-size: 16px;
cursor: pointer;
}

button {
margin-top: 10px;
padding: 12px 20px;
background: #28a745;
color: white;
border: none;
cursor: pointer;
font-size: 16px;
}


</style>

<section class="ftco-section bg-light">
    <div class="container">
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="fa fa-check-circle mr-2"></i><?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <i class="fa fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="row">
            
            <div class="col-lg-5 mb-5">
                <div class="glass-panel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0" style="font-weight: 800;">My Pets</h3>
                        <a href="<?= ROOT ?>/petowner/pets" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fa fa-plus mr-1"></i> Register
                        </a>
                    </div>
                    
                    <?php if(!empty($pets)): ?>
                        <?php foreach($pets as $pet): ?>
                            <div class="pet-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0 font-weight-bold"><?= htmlspecialchars($pet['PetName']) ?></h5>
                                    <span class="badge badge-primary badge-pill"><?= htmlspecialchars($pet['Species']) ?></span>
                                </div>
                                <p class="small text-muted mb-3">
                                    <?= htmlspecialchars($pet['Age']) ?> yrs | <?= htmlspecialchars($pet['Gender']) ?>
                                </p>

                                
                                <div class="bg-light p-3 rounded mb-3">
                                    <label class="small font-weight-bold text-uppercase text-primary d-block mb-2">Medical Center</label>
                                    <div class="row no-gutters text-center">
                                        <div class="col-6 mb-2">
                                            <a href="<?= ROOT ?>/petowner/vaccinations/<?= $pet['PetID'] ?>" title="Vaccinations">
                                                <i class="fa fa-shield text-info d-block fa-lg mb-1"></i><small>Vaccinations</small>
                                            </a>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <a href="<?= ROOT ?>/petowner/prescriptions/<?= $pet['PetID'] ?>" title="Prescriptions">
                                                <i class="fa fa-file-text-o text-success d-block fa-lg mb-1"></i><small>Prescriptions</small>
                                            </a>
                                        </div>
                                
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap">
                                    <a href="<?= ROOT ?>/petowner/viewConditions/<?= $pet['PetID'] ?>" class="btn btn-outline-danger btn-sm action-btn mr-1 mb-1">
                                        Conditions
                                    </a>
                                    <a href="<?= ROOT ?>/petowner/viewWeight/<?= $pet['PetID'] ?>" class="btn btn-outline-info btn-sm action-btn mb-1">
                                        Weight
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fa fa-paw fa-3x text-muted mb-2"></i>
                            <p>No pets found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-lg-7">
                <div class="glass-panel">
                    <h3 class="mb-4" style="font-weight: 800;">My Activity</h3>
                    
                    <ul class="nav nav-tabs mb-4" id="dashboardTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="vet-tab" data-toggle="tab" href="#vet-pane">Vet Checkups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="service-tab" data-toggle="tab" href="#service-pane">Service Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order-pane">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="lost-tab" data-toggle="tab" href="#lost-pane">Lost Pet Alerts 🚨</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" id="triage-tab" data-toggle="tab" href="#triage-pane">
                                Triage 🤖
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="dashboardTabsContent">
                        
                        <div class="tab-pane fade" id="lost-pane">
                            <div class="alert alert-danger mb-4">
                                <strong><i class="fa fa-bullhorn mr-2"></i>Community Emergency:</strong> 
                                Below are pets reported lost in the community. Please keep an eye out!
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-danger text-white">
                                        <tr>
                                            <th>Pet</th>
                                            <th>Location</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($lostPets)): ?>
                                            <?php foreach($lostPets as $lp): ?>
                                                <tr>
                                                    <td><strong><?= htmlspecialchars($lp['PetName'] ?? 'Unknown Pet') ?></strong></td>
                                                    <td><i class="fa fa-map-marker text-danger mr-1"></i><?= htmlspecialchars($lp['Location']) ?></td>
                                                    <td><?= htmlspecialchars($lp['Description']) ?></td>
                                                    <td><?= date('M d', strtotime($lp['DateReported'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-4">No lost pet alerts at this time.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show active" id="vet-pane">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Date</th>
                                            <th>Pet</th>
                                            <th>Doctor</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($vetAppointments)): ?>
                                            <?php foreach($vetAppointments as $vApp): ?>
                                                <tr>
                                                    <td><strong><?= date('M d', strtotime($vApp['AppointmentDate'])) ?></strong></td>
                                                    <td><?= htmlspecialchars($vApp['PetName']) ?></td>
                                                    <td><?= htmlspecialchars($vApp['VetName']) ?></td>
                                                    <td>
                                                        <?php 
                                                            $st = $vApp['status'] ?? 'Pending';
                                                            $cls = $st == 'Accepted' ? 'success' : ($st == 'Rejected' ? 'danger' : 'warning');
                                                        ?>
                                                        <span class="badge badge-<?= $cls ?>"><?= $st ?></span>
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        <a href="<?= ROOT ?>/petowner/deleteVetAppointment/<?= $vApp['AppointmentID'] ?>" 
                                                           class="text-danger" onclick="return confirm('Cancel checkup?')">
                                                            <i class="fa fa-times-circle fa-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-4">No upcoming vet appointments.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3">
                                <a href="<?= ROOT ?>/petowner/bookVet" class="btn btn-outline-primary btn-sm">Book a Vet Checkup</a>
                            </div>
                        </div>

                        
                        <div class="tab-pane fade" id="service-pane">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th>Date</th>
                                            <th>Service</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($bookings)): ?>
                                            <?php foreach($bookings as $booking): ?>
                                                <tr>
                                                    <td><strong><?= date('M d', strtotime($booking['BookingDate'])) ?></strong></td>
                                                    <td><?= htmlspecialchars($booking['service_name'] ?? 'Booking') ?></td>
                                                    <td>
                                                        <?php 
                                                            $st = $booking['status'] ?? 'Under Review';
                                                            $cls = $st == 'Accepted' ? 'success' : ($st == 'Rejected' ? 'danger' : 'secondary');
                                                        ?>
                                                        <span class="badge badge-<?= $cls ?>"><?= $st ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= ROOT ?>/petowner/deleteAppointment/<?= $booking['BookingID'] ?>" 
                                                           class="text-danger" onclick="return confirm('Cancel booking?')">
                                                            <i class="fa fa-times-circle fa-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-4">No active service bookings.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3">
                                <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-outline-success btn-sm">Browse All Services</a>
                            </div>
                        </div>

                        
                        <div class="tab-pane fade" id="order-pane">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($orders)): ?>
                                            <?php foreach($orders as $order): ?>
                                                <tr>
                                                    <td>#<?= $order['OrderID'] ?></td>
                                                    <td><?= date('Y-m-d', strtotime($order['OrderDate'])) ?></td>
                                                    <td class="font-weight-bold"><?= number_format($order['TotalPrice'], 2) ?> EGP</td>
                                                    <td>
                                                        <?php 
                                                            $st = $order['Status'];
                                                            $cls = $st == 'Confirmed' ? 'success' : ($st == 'Cancelled' ? 'danger' : 'warning');
                                                        ?>
                                                        <span class="badge badge-<?= $cls ?>"><?= $st ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="4" class="text-center py-4">You haven't placed any orders yet.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3">
                                <a href="<?= ROOT ?>/shop" class="btn btn-outline-dark btn-sm">Visit Shop</a>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="triage-pane">
                            <div class="container">
                                <h3>Vet Bot Triage System</h3>
                                <form action="<?= ROOT ?>/petowner/triageResult" method="post" onsubmit="return validateForm()">

                                    <h3>Select Symptoms</h3>

                                    <select class="form-control" name="petId" required>
                                        <option value="" disabled selected>Select Pet</option>
                                        <?php foreach ($pets as $pet): ?>
                                            <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    

                                    <label>
                                        <input type="checkbox" name="symptoms[]" value="tumor">
                                        Tumor
                                    </label>

                                    <label>
                                        <input type="checkbox" name="symptoms[]" value="aggressive">
                                        Aggressive Behavior
                                    </label>

                                    <label>
                                        <input type="checkbox" name="symptoms[]" value="vomiting">
                                        Vomiting
                                    </label>

                                    <button type="submit">
                                        Check
                                    </button>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>