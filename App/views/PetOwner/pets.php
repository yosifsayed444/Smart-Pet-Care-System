<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Pets 🐾</h1>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <!-- Add Pet Form -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-4">
                <h4>Add New Pet</h4>
                <form action="<?= ROOT ?>/petowner/pets" method="POST">
                    <div class="form-group mb-3">
                        <label>Pet Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Max" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Species</label>
                        <select name="species" class="form-control" required>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Bird">Bird</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Age (Years)</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Weight (kg)</label>
                        <input type="number" step="0.1" name="weight" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label>Allergies</label>
                        <textarea name="allergies" class="form-control" placeholder="Any known allergies..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Pet</button>
                </form>
            </div>
        </div>

        <!-- Pets List -->
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h4>Your Pets</h4>
                <div class="row">
                    <?php if(!empty($pets)): ?>
                        <?php foreach($pets as $pet): ?>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1 text-primary"><?= htmlspecialchars($pet['PetName']) ?></h5>
                                        <span class="badge badge-info"><?= $pet['Species'] ?></span>
                                    </div>
                                    <p class="mb-1 small">
                                        <strong>Gender:</strong> <?= $pet['Gender'] ?> | 
                                        <strong>Age:</strong> <?= $pet['Age'] ?> years
                                    </p>
                                    <p class="mb-0 small text-muted">
                                        <strong>Allergies:</strong> <?= !empty($pet['Allergies']) ? htmlspecialchars($pet['Allergies']) : 'None' ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">You haven't added any pets yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-success px-5">Back to Booking 📅</a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
