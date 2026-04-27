<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2>Lab Result Hub: <?= htmlspecialchars($pet['PetName']) ?></h2>
                <p>Access your pet's diagnostic reports and veterinarian interpretations.</p>
            </div>
        </div>

        <div class="row">
            <?php if (!empty($labResults)): ?>
                <?php foreach ($labResults as $lab): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="border-radius: 15px;">
                            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                                <h5 class="mb-0 text-white">Lab Entry</h5>
                                <small><?= htmlspecialchars($lab['RecordDate']) ?></small>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-2">Interpreted by: <strong>Dr. <?= htmlspecialchars($lab['VetName']) ?></strong></p>
                                <div class="bg-light p-3 rounded mb-3">
                                    <h6 class="font-weight-bold">Diagnosis / Summary:</h6>
                                    <p class="mb-0 text-dark"><?= nl2br(htmlspecialchars($lab['Diagnosis'])) ?></p>
                                </div>
                                <?php if (!empty($lab['LabNotes'])): ?>
                                    <h6 class="font-weight-bold">Detailed Notes:</h6>
                                    <p class="text-muted"><?= nl2br(htmlspecialchars($lab['LabNotes'])) ?></p>
                                <?php endif; ?>
                                
                                <?php if (!empty($lab['LabFile'])): ?>
                                    <a href="<?= ROOT ?>/uploads/lab_results/<?= $lab['LabFile'] ?>" target="_blank" class="btn btn-block btn-info">
                                        <i class="fa fa-download mr-2"></i> Download Full Report
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="card shadow-sm p-5 text-center">
                        <i class="fa fa-flask fa-4x text-muted mb-3"></i>
                        <h5>No lab results found.</h5>
                        <p class="text-muted">Diagnostic reports uploaded by your veterinarian will appear here.</p>
                        <div class="mt-3">
                            <a href="<?= ROOT ?>/petowner/pets" class="btn btn-outline-info"><i class="fa fa-arrow-left mr-1"></i> Back to My Pets</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($labResults)): ?>
            <div class="mt-2 text-center">
                <a href="<?= ROOT ?>/petowner/pets" class="btn btn-outline-secondary">Back to My Pets</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
