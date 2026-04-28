<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    .vet-card { border: none; border-radius: 15px; transition: transform 0.3s; }
    .vet-card:hover { transform: translateY(-5px); }
    .nav-pills .nav-link.active { background-color: #007bff; border-radius: 10px; }
    .nav-pills .nav-link { color: #333; font-weight: 600; border-radius: 10px; margin-bottom: 5px; }
    .tab-content { background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .badge-upcoming { background-color: #ffc107; color: #212529; }
</style>

<section class="ftco-section bg-light">
    <div class="container-fluid px-md-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Vet Dashboard</h1>
                    <span class="badge badge-primary p-2">Welcome, Dr. <?= htmlspecialchars($_SESSION['username']) ?></span>
                </div>
                <hr>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-appointments-tab" data-toggle="pill" href="#v-pills-appointments" role="tab"><i class="fa fa-calendar mr-2"></i> Appointments</a>
                    <a class="nav-link" id="v-pills-vaccinations-tab" data-toggle="pill" href="#v-pills-vaccinations" role="tab"><i class="fa fa-shield mr-2"></i> Vaccination Scheduler</a>
                    <a class="nav-link" id="v-pills-prescriptions-tab" data-toggle="pill" href="#v-pills-prescriptions" role="tab"><i class="fa fa-file-text-o mr-2"></i> Prescription Engine</a>
                    <a class="nav-link" id="v-pills-lost-tab" data-toggle="pill" href="#v-pills-lost" role="tab"><i class="fa fa-bullhorn mr-2"></i> Community Alerts 🚨</a>
                </div>
            </div>

            
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    
                    <div class="tab-pane fade show active" id="v-pills-appointments" role="tabpanel">
                        <h3>Upcoming Appointments</h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pet Name</th>
                                        <th>Owner</th>
                                        <th>Species</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($appointments)): ?>
                                        <?php foreach ($appointments as $app): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($app['AppointmentDate']) ?></td>
                                                <td><?= htmlspecialchars($app['PetName']) ?></td>
                                                <td><?= htmlspecialchars($app['OwnerName']) ?></td>
                                                <td><?= htmlspecialchars($app['Species']) ?></td>
                                                <td>
                                                    <?php 
                                                        $status = $app['status'] ?? 'Pending';
                                                        $badge = $status == 'Accepted' ? 'success' : ($status == 'Rejected' ? 'danger' : 'warning');
                                                    ?>
                                                    <span class="badge badge-<?= $badge ?>"><?= $status ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($status == 'Pending'): ?>
                                                        <a href="<?= ROOT ?>/vet/updateAppointmentStatus/<?= $app['AppointmentID'] ?>/Accepted" class="btn btn-sm btn-success">Accept</a>
                                                        <a href="<?= ROOT ?>/vet/updateAppointmentStatus/<?= $app['AppointmentID'] ?>/Rejected" class="btn btn-sm btn-danger" onclick="return confirm('Reject this appointment?')">Reject</a>
                                                    <?php else: ?>
                                                        <span class="text-muted small">Closed</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4">No appointments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="v-pills-vaccinations" role="tabpanel">
                        <div class="d-flex justify-content-between mb-3">
                            <h3>Vaccination Scheduler</h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addVaccinationModal">Add Record</button>
                        </div>
                        
                        <h5>Upcoming Due Dates (30 Days)</h5>
                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-striped">
                                <thead class="bg-warning text-dark">
                                    <tr>
                                        <th>Next Date</th>
                                        <th>Pet</th>
                                        <th>Vaccine</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($upcoming)): ?>
                                        <?php foreach ($upcoming as $up): ?>
                                            <tr>
                                                <td><strong><?= htmlspecialchars($up['NextDate']) ?></strong></td>
                                                <td><?= htmlspecialchars($up['PetName']) ?></td>
                                                <td><?= htmlspecialchars($up['VaccineName']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3">No upcoming vaccinations.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <h5>History</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pet</th>
                                        <th>Vaccine</th>
                                        <th>Next Due</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($vaccinations)): ?>
                                        <?php foreach ($vaccinations as $v): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($v['VaccinationDate']) ?></td>
                                                <td><?= htmlspecialchars($v['PetName']) ?></td>
                                                <td><?= htmlspecialchars($v['VaccineName']) ?></td>
                                                <td><?= htmlspecialchars($v['NextDate']) ?></td>
                                                <td>
                                                    <a href="<?= ROOT ?>/vet/deleteVaccination/<?= $v['VaccinationID'] ?>" class="text-danger" onclick="return confirm('Delete this record?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="v-pills-prescriptions" role="tabpanel">
                        <div class="d-flex justify-content-between mb-3">
                            <h3>Digital Prescription Engine</h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addPrescriptionModal">New Prescription</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pet</th>
                                        <th>Medication</th>
                                        <th>Dosage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($prescriptions)): ?>
                                        <?php foreach ($prescriptions as $p): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($p['Date']) ?></td>
                                                <td><?= htmlspecialchars($p['PetName']) ?> (<?= htmlspecialchars($p['OwnerName'] ?? 'Unknown Owner') ?>)</td>
                                                <td><?= htmlspecialchars($p['MedicationName']) ?></td>
                                                <td><?= htmlspecialchars($p['Dosage']) ?></td>
                                                <td>
                                                    <a href="<?= ROOT ?>/vet/deletePrescription/<?= $p['PrescriptionID'] ?>" class="text-danger" onclick="return confirm('Delete this prescription?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="v-pills-lost" role="tabpanel">
                        <div class="alert alert-danger mb-4">
                            <strong><i class="fa fa-bullhorn mr-2"></i>Community Emergency:</strong> 
                            Lost pets reported by administrators.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>Pet ID</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($lostPets)): ?>
                                        <?php foreach($lostPets as $lp): ?>
                                            <tr>
                                                <td><strong><?= htmlspecialchars($lp['PetID']) ?></strong></td>
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

                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="addVaccinationModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= ROOT ?>/vet/addVaccination" method="POST" class="modal-content">
            <div class="modal-header"><h5>Add Vaccination Record</h5></div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pet</label>
                    <select name="pet_id" class="form-control" required>
                        <?php foreach ($allPets as $pet): ?>
                            <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?> (<?= htmlspecialchars($pet['OwnerName']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><label>Vaccine Name</label><input type="text" name="vaccine_name" class="form-control" required></div>
                <div class="form-group"><label>Date</label><input type="date" name="vaccination_date" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
                <div class="form-group"><label>Next Date</label><input type="date" name="next_date" class="form-control" required></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
        </form>
    </div>
</div>


<div class="modal fade" id="addPrescriptionModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= ROOT ?>/vet/addPrescription" method="POST" class="modal-content">
            <div class="modal-header"><h5>New Prescription</h5></div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pet</label>
                    <select name="pet_id" class="form-control" required>
                        <?php foreach ($allPets as $pet): ?>
                            <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?> (<?= htmlspecialchars($pet['OwnerName']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><label>Medication</label><input type="text" name="medication_name" class="form-control" required></div>
                <div class="form-group"><label>Dosage</label><input type="text" name="dosage" class="form-control" required></div>
                <div class="form-group"><label>Date</label><input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
