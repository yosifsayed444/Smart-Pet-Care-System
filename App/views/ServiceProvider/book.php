<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center ftco-animate">
                <h2>Book Service: <?php echo htmlspecialchars($service['name']); ?></h2>
                <p>Provider: <?php echo htmlspecialchars($service['provider_name']); ?></p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="mb-3 text-success">Provider Availability 🗓️</h5>
                    <?php if (!empty($availability)): ?>
                        <ul class="list-unstyled small">
                            <?php foreach ($availability as $slot): ?>
                                <li class="mb-2 border-bottom pb-1">
                                    <strong><?= date('M d, Y', strtotime($slot['available_date'])) ?></strong><br>
                                    <span class="text-muted"><?= date('h:i A', strtotime($slot['start_time'])) ?> - <?= date('h:i A', strtotime($slot['end_time'])) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted small">No available slots listed. Please contact the provider.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['id'])): ?>
                        <div class="alert alert-warning text-center">
                            <h5>You need to be logged in as a Pet Owner to book a service.</h5>
                            <a href="<?= ROOT ?>/auth/login" class="btn btn-primary mt-3">Login Now</a>
                        </div>
                    <?php elseif ($_SESSION['role'] !== 'Owner'): ?>
                        <div class="alert alert-danger text-center">
                            <h5>Only Pet Owners can book services.</h5>
                            <p>Current role: <?= $_SESSION['role'] ?></p>
                        </div>
                    <?php else: ?>
                        <form action="<?= ROOT ?>/ServiceProvider/book/<?= $service['id'] ?>" method="POST">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <?php if (!empty($service['image'])): ?>
                                        <img src="<?= ROOT ?>/uploads/services/<?= $service['image'] ?>" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width: 100%; height: 150px; font-size: 3rem;">
                                            <span class="flaticon-dog"></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8 d-flex flex-column justify-content-center">
                                    <h4><?= htmlspecialchars($service['name']) ?></h4>
                                    <p class="text-primary font-weight-bold mb-1">$<?= number_format($service['price'], 2) ?></p>
                                    <span class="badge badge-info w-25"><?= $service['tier'] ?></span>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Select Your Pet</label>
                                <?php if (!empty($pets)): ?>
                                    <select name="pet_id" class="form-control" required>
                                        <option value="">Choose a pet...</option>
                                        <?php foreach ($pets as $pet): ?>
                                            <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?> (<?= $pet['Species'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else: ?>
                                    <div class="alert alert-warning py-4 text-center">
                                        <h5>You haven't added any pets yet!</h5>
                                        <p>You need to register a pet before you can book this service.</p>
                                        <a href="<?= ROOT ?>/petowner/pets" class="btn btn-success">
                                            ➕ Add My First Pet
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label font-weight-bold">Choose Available Time Slot</label>
                                <?php if (!empty($availability)): ?>
                                    <select name="availability_id" class="form-control" required>
                                        <option value="">Select a slot...</option>
                                        <?php foreach ($availability as $slot): ?>
                                            <option value="<?= $slot['id'] ?>">
                                                <?= date('M d, Y', strtotime($slot['available_date'])) ?> | 
                                                <?= date('h:i A', strtotime($slot['start_time'])) ?> - <?= date('h:i A', strtotime($slot['end_time'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else: ?>
                                    <div class="alert alert-danger py-2 small">
                                        This provider has no available slots at the moment.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-block py-3 px-5" <?= (empty($pets) || empty($availability)) ? 'disabled' : '' ?>>
                                    Confirm Booking 🐾
                                </button>
                                <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-outline-secondary btn-block mt-2">Cancel</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
