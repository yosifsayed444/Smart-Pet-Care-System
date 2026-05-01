<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
.field-error  { font-size: 0.78rem; color: #dc3545; margin-top: 4px; display: none; }
.is-invalid   { border-color: #dc3545 !important; box-shadow: 0 0 0 .15rem rgba(220,53,69,.15) !important; }
.slot-card    { border: 2px solid transparent; border-radius: 10px; padding: 10px 14px;
                cursor: pointer; transition: border-color .2s, background .2s; background: #fff; }
.slot-card:hover { border-color: #007bff; background: #f0f7ff; }
</style>

<section class="ftco-section bg-light">
    <div class="container">

        
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center ftco-animate">
                <h2 class="mb-1">Book Service: <?= htmlspecialchars($service['name']) ?></h2>
                <p class="text-muted mb-0">
                    Provider: <strong><?= htmlspecialchars($service['provider_name']) ?></strong>
                    &nbsp;|&nbsp; Tier: <span class="badge badge-info"><?= htmlspecialchars($service['tier']) ?></span>
                    &nbsp;|&nbsp; <span class="text-primary font-weight-bold">$<?= number_format($service['price'], 2) ?></span>
                </p>
            </div>
        </div>

        <div class="row justify-content-center">

            
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3 text-success"><i class="fa fa-calendar-check-o mr-2"></i>Available Slots</h5>
                    <?php if (!empty($availability)): ?>
                        <ul class="list-unstyled small">
                            <?php foreach ($availability as $slot): ?>
                                <li class="mb-2 border-bottom pb-2">
                                    <i class="fa fa-clock-o text-success mr-1"></i>
                                    <strong><?= date('M d, Y', strtotime($slot['available_date'])) ?></strong><br>
                                    <span class="text-muted ml-3">
                                        <?= date('h:i A', strtotime($slot['start_time'])) ?> –
                                        <?= date('h:i A', strtotime($slot['end_time'])) ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted small">No available slots listed. Please contact the provider.</p>
                    <?php endif; ?>
                </div>

                <!-- Certifications Section -->
                <div class="card shadow-sm p-4 mt-4">
                    <h5 class="mb-3 text-primary"><i class="fa fa-certificate mr-2"></i>Certifications</h5>
                    <?php 
                        $verifiedCerts = array_filter($certifications ?? [], function($c) { return $c['Status'] == 'Verified'; });
                    ?>
                    <?php if (!empty($verifiedCerts)): ?>
                        <ul class="list-unstyled small">
                            <?php foreach ($verifiedCerts as $cert): ?>
                                <li class="mb-2">
                                    <i class="fa fa-check-circle text-primary mr-1"></i>
                                    <strong><?= htmlspecialchars($cert['CertName']) ?></strong>
                                    <a href="<?= ROOT ?>/uploads/certifications/<?= htmlspecialchars($cert['FilePath']) ?>" target="_blank" class="text-primary ml-2"><i class="fa fa-external-link"></i></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted small">No verified certifications found for this provider.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-md-8">
                <div class="card shadow-sm p-4">

                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-circle mr-2"></i><?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['id'])): ?>
                        <div class="alert alert-warning text-center">
                            <h5>You need to be logged in as a Pet Owner to book a service.</h5>
                            <a href="<?= ROOT ?>/auth/login" class="btn btn-primary mt-3">Login Now</a>
                        </div>

                    <?php elseif ($_SESSION['role'] !== 'Owner'): ?>
                        <div class="alert alert-danger text-center">
                            <h5>Only Pet Owners can book services.</h5>
                            <p class="mb-0">Current role: <?= htmlspecialchars($_SESSION['role']) ?></p>
                        </div>

                    <?php else: ?>

                        
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <?php if (!empty($service['image'])): ?>
                                    <img src="<?= ROOT ?>/uploads/services/<?= $service['image'] ?>"
                                         class="img-fluid rounded"
                                         style="width:100%;height:120px;object-fit:cover;">
                                <?php else: ?>
                                    <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded"
                                         style="width:100%;height:120px;font-size:2.5rem;">
                                        <span class="flaticon-dog"></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9 d-flex flex-column justify-content-center">
                                <h4 class="mb-1"><?= htmlspecialchars($service['name']) ?></h4>
                                <p class="text-primary font-weight-bold mb-1">$<?= number_format($service['price'], 2) ?></p>
                                <span class="badge badge-info"><?= htmlspecialchars($service['tier']) ?></span>
                            </div>
                        </div>

                        <hr>

                        <form id="bookingForm" action="<?= ROOT ?>/ServiceProvider/book/<?= $service['id'] ?>"
                              method="POST"
                              novalidate>

                            
                            <div class="form-group mb-4">
                                <label class="form-label font-weight-bold">
                                    Select Your Pet <span class="text-danger">*</span>
                                </label>

                                <?php if (!empty($pets)): ?>
                                    <select id="bookPetId" name="pet_id" class="form-control" required>
                                        <option value="">-- Choose a pet --</option>
                                        <?php foreach ($pets as $pet): ?>
                                            <option value="<?= $pet['PetID'] ?>">
                                                <?= htmlspecialchars($pet['PetName']) ?>
                                                (<?= htmlspecialchars($pet['Species']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="field-error" id="petError">Please select a pet.</div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-4 text-center">
                                        <h5>You haven't added any pets yet!</h5>
                                        <p>You need to register a pet before booking this service.</p>
                                        <a href="<?= ROOT ?>/petowner/pets" class="btn btn-success">
                                            ➕ Add My First Pet
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="form-group mb-4">
                                <label class="form-label font-weight-bold">
                                    Choose Available Time Slot <span class="text-danger">*</span>
                                </label>

                                <?php if (!empty($availability)): ?>
                                    <select id="bookSlotId" name="availability_id" class="form-control" required>
                                        <option value="">-- Select a slot --</option>
                                        <?php foreach ($availability as $slot): ?>
                                            <option value="<?= $slot['id'] ?>">
                                                <?= date('M d, Y', strtotime($slot['available_date'])) ?>
                                                &nbsp;|&nbsp;
                                                <?= date('h:i A', strtotime($slot['start_time'])) ?> –
                                                <?= date('h:i A', strtotime($slot['end_time'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="field-error" id="slotError">Please select a time slot.</div>
                                <?php else: ?>
                                    <div class="alert alert-danger py-2 small">
                                        <i class="fa fa-exclamation-triangle mr-1"></i>
                                        This provider has no available slots at the moment.
                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="alert alert-info py-2 small mb-4">
                                <i class="fa fa-info-circle mr-1"></i>
                                Bookings start as <strong>Under Review</strong>. The provider will accept or reject your request.
                            </div>

                            <div class="mt-2">
                                <button type="submit"
                                        id="bookSubmitBtn"
                                        class="btn btn-primary btn-block py-3"
                                        <?= (empty($pets) || empty($availability)) ? 'disabled' : '' ?>>
                                    <i class="fa fa-check-circle mr-2"></i>Confirm Booking 🐾
                                </button>
                                <a href="<?= ROOT ?>/ServiceProvider/services"
                                   class="btn btn-outline-secondary btn-block mt-2">
                                    Cancel
                                </a>
                            </div>

                        </form>

                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
(function () {
    const form      = document.getElementById('bookingForm');
    if (!form) return; // not logged in as owner — form not rendered

    const petSelect  = document.getElementById('bookPetId');
    const slotSelect = document.getElementById('bookSlotId');

    function showErr(el, errId, msg) {
        if (!el) return;
        el.classList.add('is-invalid');
        const e = document.getElementById(errId);
        if (e) { e.textContent = msg; e.style.display = 'block'; }
    }

    function clearErr(el, errId) {
        if (!el) return;
        el.classList.remove('is-invalid');
        const e = document.getElementById(errId);
        if (e) e.style.display = 'none';
    }

    
    if (petSelect) {
        petSelect.addEventListener('change', function () {
            if (!this.value) showErr(this, 'petError', 'Please select a pet.');
            else clearErr(this, 'petError');
        });
    }

    if (slotSelect) {
        slotSelect.addEventListener('change', function () {
            if (!this.value) showErr(this, 'slotError', 'Please select a time slot.');
            else clearErr(this, 'slotError');
        });
    }

    
    form.addEventListener('submit', function (e) {
        let valid = true;

        if (petSelect) {
            if (!petSelect.value) {
                showErr(petSelect, 'petError', 'Please select a pet before confirming.');
                valid = false;
            } else {
                clearErr(petSelect, 'petError');
            }
        }

        if (slotSelect) {
            if (!slotSelect.value) {
                showErr(slotSelect, 'slotError', 'Please select an available time slot.');
                valid = false;
            } else {
                clearErr(slotSelect, 'slotError');
            }
        }

        if (!valid) {
            e.preventDefault();
            // Scroll to first error
            const firstErr = form.querySelector('.is-invalid');
            if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
})();
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

