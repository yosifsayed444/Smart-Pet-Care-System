<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
.field-error { font-size: 0.78rem; color: #dc3545; margin-top: 3px; display: none; }
.is-invalid  { border-color: #dc3545 !important; }
</style>

<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Service Provider Dashboard</h1>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle mr-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="card p-4 shadow-sm mb-4">
                <h4>Welcome <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Provider' ?></h4>
                <p class="mb-0">Manage your services, availability, and reviews below.</p>
            </div>
        </div>
    </div>

    <div class="row">

        
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa fa-cogs mr-2"></i>Tiered Service Pricing Engine</h5>
                </div>
                <div class="card-body">

                    
                    <form id="addServiceForm" action="<?= ROOT ?>/ServiceProvider/addService" method="POST"
                          enctype="multipart/form-data" class="mb-4" novalidate>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Service Name <span class="text-danger">*</span></label>
                            <input type="text" id="svcName" name="name" class="form-control"
                                   placeholder="e.g. Dog Grooming" minlength="3" maxlength="100" required>
                            <div class="field-error" id="svcNameError">Service name is required (3–100 characters).</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Service Image <small class="text-muted">(JPG/PNG/GIF/WebP, max 2MB)</small></label>
                            <input type="file" id="svcImage" name="image" class="form-control" accept="image/*">
                            <div class="field-error" id="svcImageError">Invalid file type or size exceeds 2MB.</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label font-weight-bold">Tier <span class="text-danger">*</span></label>
                                <select id="svcTier" name="tier" class="form-select form-control" required>
                                    <option value="">-- Select Tier --</option>
                                    <option value="Basic">Basic</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Premium">Premium</option>
                                </select>
                                <div class="field-error" id="svcTierError">Please select a tier.</div>
                            </div>
                            <div class="col">
                                <label class="form-label font-weight-bold">Price ($) <span class="text-danger">*</span></label>
                                <input type="number" id="svcPrice" name="price" class="form-control"
                                       placeholder="0.00" step="0.01" min="0" max="99999" required>
                                <div class="field-error" id="svcPriceError">Price must be between $0 and $99,999.</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa fa-plus mr-1"></i> Add Service
                        </button>
                    </form>

                    <hr>
                    <h6 class="mb-3">Your Services</h6>

                    <table class="table table-sm mt-2">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Tier</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= htmlspecialchars($service['name']) ?></td>
                                    <td><span class="badge badge-secondary"><?= htmlspecialchars($service['tier']) ?></span></td>
                                    <td>$<?= number_format($service['price'], 2) ?></td>
                                    <td class="d-flex gap-1" style="gap:4px;">
                                        
                                        <button class="btn btn-sm btn-outline-primary"
                                                data-toggle="modal"
                                                data-target="#updatePriceModal<?= $service['id'] ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        
                                        <a href="<?= ROOT ?>/ServiceProvider/deleteService/<?= $service['id'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete service \'<?= htmlspecialchars(addslashes($service['name'])) ?>\'? This cannot be undone.')">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        
                                        <div class="modal fade" id="updatePriceModal<?= $service['id'] ?>"
                                             tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title">Update Price – <?= htmlspecialchars($service['name']) ?></h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                  <span>&times;</span>
                                                </button>
                                              </div>
                                              <form action="<?= ROOT ?>/ServiceProvider/updateServicePrice"
                                                    method="POST"
                                                    class="updatePriceForm"
                                                    novalidate>
                                                  <div class="modal-body">
                                                    <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">New Price ($) <span class="text-danger">*</span></label>
                                                        <input type="number" step="0.01" name="price"
                                                               class="form-control updatePriceInput"
                                                               value="<?= htmlspecialchars($service['price']) ?>"
                                                               min="0" max="99999" required>
                                                        <div class="field-error updatePriceError">Price must be between $0 and $99,999.</div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                  </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted py-3">No services added yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fa fa-calendar mr-2"></i>Availability &amp; Conflicts</h5>
                </div>
                <div class="card-body">

                    
                    <form id="availabilityForm" action="<?= ROOT ?>/ServiceProvider/setAvailability"
                          method="POST" class="mb-4" novalidate>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Date <span class="text-danger">*</span></label>
                            <input type="date" id="avDate" name="date" class="form-control" required>
                            <div class="field-error" id="avDateError">A valid future date is required.</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label font-weight-bold">Start Time <span class="text-danger">*</span></label>
                                <input type="time" id="avStart" name="start_time" class="form-control" required>
                                <div class="field-error" id="avStartError">Start time is required.</div>
                            </div>
                            <div class="col">
                                <label class="form-label font-weight-bold">End Time <span class="text-danger">*</span></label>
                                <input type="time" id="avEnd" name="end_time" class="form-control" required>
                                <div class="field-error" id="avEndError">End time must be after start time.</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info text-white w-100">
                            <i class="fa fa-clock-o mr-1"></i> Set Availability
                        </button>
                    </form>

                    <hr>
                    <h6 class="mb-3">Your Schedule</h6>

                    <ul class="list-group mb-3">
                        <?php if (!empty($availability)): ?>
                            <?php foreach ($availability as $slot): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fa fa-calendar-o text-info mr-1"></i>
                                        <strong><?= htmlspecialchars($slot['available_date']) ?></strong>
                                        <small class="ml-2 text-muted">
                                            <?= htmlspecialchars($slot['start_time']) ?> – <?= htmlspecialchars($slot['end_time']) ?>
                                        </small>
                                    </div>
                                    <a href="<?= ROOT ?>/ServiceProvider/deleteSchedule/<?= $slot['id'] ?>"
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Remove this availability slot?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-center text-muted py-3">No availability set yet.</li>
                        <?php endif; ?>
                    </ul>

                    <h6>Scheduling Conflicts</h6>
                    <?php if (!empty($conflictBooking)): ?>
                        <div class="alert alert-warning py-2 mb-2">
                            <strong>Conflict detected!</strong>
                            Booking #<?= htmlspecialchars($conflictBooking['BookingID']) ?> has a scheduling issue.
                            <button class="btn btn-sm btn-danger float-right"
                                    data-toggle="modal" data-target="#resolveConflictModal">Resolve</button>
                        </div>

                        
                        <div class="modal fade" id="resolveConflictModal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Resolve Conflict – Booking #<?= htmlspecialchars($conflictBooking['BookingID']) ?></h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                              </div>
                              <form action="<?= ROOT ?>/ServiceProvider/resolveConflict" method="POST" novalidate>
                                  <div class="modal-body">
                                    <p class="text-muted">Propose a new time for this booking to resolve the overlap.</p>
                                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($conflictBooking['BookingID']) ?>">
                                    <div class="form-group">
                                        <label>New Date</label>
                                        <input type="date" name="new_date" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label>New Start Time</label>
                                            <input type="time" name="new_start_time" class="form-control" required>
                                        </div>
                                        <div class="col form-group">
                                            <label>New End Time</label>
                                            <input type="time" name="new_end_time" class="form-control" required>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Resolve</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>

                    <?php else: ?>
                        <div class="alert alert-success py-2 mb-0">
                            <i class="fa fa-check-circle mr-1"></i> No conflicts detected in your bookings.
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fa fa-list mr-2"></i>Recent Service Bookings</h5>
                    <a href="<?= ROOT ?>/ServiceProvider/bookings" class="btn btn-sm btn-light">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Owner</th>
                                    <th>Pet</th>
                                    <th>Date &amp; Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentBookings)): ?>
                                    <?php foreach (array_slice($recentBookings, 0, 5) as $booking): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($booking['owner_name']) ?></td>
                                            <td><?= htmlspecialchars($booking['PetName']) ?></td>
                                            <td><?= date('M d, h:i A', strtotime($booking['BookingDate'] . ' ' . $booking['StartTime'])) ?></td>
                                            <td>
                                                <?php
                                                    $status = $booking['status'] ?? 'Under Review';
                                                    $cls = $status === 'Accepted' ? 'success' : ($status === 'Rejected' ? 'danger' : 'secondary');
                                                ?>
                                                <span class="badge badge-<?= $cls ?>"><?= $status ?></span>
                                            </td>
                                            <td>
                                                <?php if ($status === 'Under Review'): ?>
                                                    <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Accepted"
                                                       class="btn btn-sm btn-success">Accept</a>
                                                    <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Rejected"
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Reject this booking?')">Reject</a>
                                                <?php else: ?>
                                                    <span class="text-muted small">Handled</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center text-muted py-3">No new bookings to show.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fa fa-bullhorn mr-2"></i>Community Emergency Alerts (Lost Pets)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Pet ID</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Date Reported</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($lostPets)): ?>
                                    <?php foreach ($lostPets as $lp): ?>
                                        <tr class="table-danger">
                                            <td><strong><?= htmlspecialchars($lp['PetID']) ?></strong></td>
                                            <td><i class="fa fa-map-marker mr-1"></i><?= htmlspecialchars($lp['Location']) ?></td>
                                            <td><?= htmlspecialchars($lp['Description']) ?></td>
                                            <td><?= date('M d, Y', strtotime($lp['DateReported'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center text-muted py-3">No lost pet alerts at this time.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<script>
(function () {
    
    function showErr(el, errId, msg) {
        el.classList.add('is-invalid');
        const e = document.getElementById(errId);
        if (e) { e.textContent = msg; e.style.display = 'block'; }
    }
    function clearErr(el, errId) {
        el.classList.remove('is-invalid');
        const e = document.getElementById(errId);
        if (e) e.style.display = 'none';
    }
    function todayStr() {
        return new Date().toISOString().split('T')[0];
    }

    
    const svcForm  = document.getElementById('addServiceForm');
    const svcName  = document.getElementById('svcName');
    const svcTier  = document.getElementById('svcTier');
    const svcPrice = document.getElementById('svcPrice');
    const svcImage = document.getElementById('svcImage');

    svcName.addEventListener('blur', () => {
        const v = svcName.value.trim();
        if (!v) showErr(svcName, 'svcNameError', 'Service name is required.');
        else if (v.length < 3 || v.length > 100) showErr(svcName, 'svcNameError', 'Name must be 3–100 characters.');
        else clearErr(svcName, 'svcNameError');
    });

    svcTier.addEventListener('change', () => {
        if (!svcTier.value) showErr(svcTier, 'svcTierError', 'Please select a tier.');
        else clearErr(svcTier, 'svcTierError');
    });

    svcPrice.addEventListener('blur', () => {
        const v = svcPrice.value.trim();
        if (v === '' || isNaN(v) || Number(v) < 0 || Number(v) > 99999)
            showErr(svcPrice, 'svcPriceError', 'Price must be between $0 and $99,999.');
        else clearErr(svcPrice, 'svcPriceError');
    });

    svcImage.addEventListener('change', () => {
        const file = svcImage.files[0];
        if (!file) { clearErr(svcImage, 'svcImageError'); return; }
        const allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowed.includes(file.type)) {
            showErr(svcImage, 'svcImageError', 'Image must be JPG, PNG, GIF, or WebP.');
        } else if (file.size > 2 * 1024 * 1024) {
            showErr(svcImage, 'svcImageError', 'Image size must not exceed 2MB.');
        } else {
            clearErr(svcImage, 'svcImageError');
        }
    });

    svcForm.addEventListener('submit', function (e) {
        let valid = true;

        const name = svcName.value.trim();
        if (!name) { showErr(svcName, 'svcNameError', 'Service name is required.'); valid = false; }
        else if (name.length < 3 || name.length > 100) { showErr(svcName, 'svcNameError', 'Name must be 3–100 characters.'); valid = false; }
        else clearErr(svcName, 'svcNameError');

        if (!svcTier.value) { showErr(svcTier, 'svcTierError', 'Please select a tier.'); valid = false; }
        else clearErr(svcTier, 'svcTierError');

        const price = svcPrice.value.trim();
        if (price === '' || isNaN(price) || Number(price) < 0 || Number(price) > 99999) {
            showErr(svcPrice, 'svcPriceError', 'Price must be between $0 and $99,999.'); valid = false;
        } else clearErr(svcPrice, 'svcPriceError');

        if (svcImage.files[0]) {
            const f = svcImage.files[0];
            const ok = ['image/jpeg','image/png','image/gif','image/webp'].includes(f.type);
            if (!ok || f.size > 2097152) {
                showErr(svcImage, 'svcImageError', 'Invalid file type or size exceeds 2MB.'); valid = false;
            } else clearErr(svcImage, 'svcImageError');
        }

        if (!valid) e.preventDefault();
    });

    
    document.querySelectorAll('.updatePriceForm').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const input = form.querySelector('.updatePriceInput');
            const errEl = form.querySelector('.updatePriceError');
            const v = input.value.trim();
            if (v === '' || isNaN(v) || Number(v) < 0 || Number(v) > 99999) {
                input.classList.add('is-invalid');
                if (errEl) errEl.style.display = 'block';
                e.preventDefault();
            } else {
                input.classList.remove('is-invalid');
                if (errEl) errEl.style.display = 'none';
            }
        });
    });

    
    const avForm  = document.getElementById('availabilityForm');
    const avDate  = document.getElementById('avDate');
    const avStart = document.getElementById('avStart');
    const avEnd   = document.getElementById('avEnd');

    // Set min date to today
    avDate.setAttribute('min', todayStr());

    avDate.addEventListener('blur', () => {
        if (!avDate.value || avDate.value < todayStr())
            showErr(avDate, 'avDateError', 'Please select today or a future date.');
        else clearErr(avDate, 'avDateError');
    });

    avStart.addEventListener('blur', () => {
        if (!avStart.value) showErr(avStart, 'avStartError', 'Start time is required.');
        else clearErr(avStart, 'avStartError');
        // Re-check end time if both filled
        if (avEnd.value && avStart.value >= avEnd.value)
            showErr(avEnd, 'avEndError', 'End time must be after start time.');
        else if (avEnd.value) clearErr(avEnd, 'avEndError');
    });

    avEnd.addEventListener('blur', () => {
        if (!avEnd.value) { showErr(avEnd, 'avEndError', 'End time is required.'); return; }
        if (avStart.value && avEnd.value <= avStart.value)
            showErr(avEnd, 'avEndError', 'End time must be after start time.');
        else clearErr(avEnd, 'avEndError');
    });

    avForm.addEventListener('submit', function (e) {
        let valid = true;

        if (!avDate.value || avDate.value < todayStr()) {
            showErr(avDate, 'avDateError', 'Please select today or a future date.'); valid = false;
        } else clearErr(avDate, 'avDateError');

        if (!avStart.value) {
            showErr(avStart, 'avStartError', 'Start time is required.'); valid = false;
        } else clearErr(avStart, 'avStartError');

        if (!avEnd.value) {
            showErr(avEnd, 'avEndError', 'End time is required.'); valid = false;
        } else if (avStart.value && avEnd.value <= avStart.value) {
            showErr(avEnd, 'avEndError', 'End time must be after start time.'); valid = false;
        } else clearErr(avEnd, 'avEndError');

        if (!valid) e.preventDefault();
    });
})();
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
