<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2>Digital Prescriptions: <?= htmlspecialchars($pet['PetName']) ?></h2>
                <p>View all medications prescribed by your veterinarians.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Date</th>
                                    <th>Medication</th>
                                    <th>Dosage</th>
                                    <th>Prescribed By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($prescriptions)): ?>
                                    <?php foreach ($prescriptions as $p): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($p['Date']) ?></td>
                                            <td><strong><?= htmlspecialchars($p['MedicationName']) ?></strong></td>
                                            <td><?= htmlspecialchars($p['Dosage']) ?></td>
                                            <td>Dr. <?= htmlspecialchars($p['VetName'] ?? 'Veterinarian') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center">No prescriptions found for this pet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-success"><i class="fa fa-arrow-left mr-1"></i> Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
