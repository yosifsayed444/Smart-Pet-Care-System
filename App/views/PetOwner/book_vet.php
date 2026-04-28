<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2>Book a Veterinary Appointment 🩺</h2>
                <p>Select a pet and a professional veterinarian to schedule a checkup.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                    <?php endif; ?>

                    <form action="<?= ROOT ?>/petowner/bookVet" method="POST" novalidate>
                        
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Select Your Pet <span class="text-danger">*</span></label>
                            <select name="pet_id" class="form-control" required>
                                <option value="">-- Choose a pet --</option>
                                <?php foreach ($pets as $pet): ?>
                                    <option value="<?= $pet['PetID'] ?>"><?= htmlspecialchars($pet['PetName']) ?> (<?= htmlspecialchars($pet['Species']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Select Veterinarian <span class="text-danger">*</span></label>
                            <select name="vet_id" class="form-control" required>
                                <option value="">-- Choose a veterinarian --</option>
                                <?php foreach ($vets as $vet): ?>
                                    <option value="<?= $vet['VetID'] ?>">
                                        Dr. <?= htmlspecialchars($vet['VetUserName']) ?> 
                                        (<?= htmlspecialchars($vet['Specialization']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Appointment Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" 
                                   min="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-block py-3">Confirm Appointment 🐾</button>
                            <a href="<?= ROOT ?>/petowner/appointments" class="btn btn-outline-secondary btn-block mt-2">View My Appointments</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

