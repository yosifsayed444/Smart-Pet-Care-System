<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_2.jpg'); height: 300px !important; min-height: 300px;" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" style="height: 300px !important; min-height: 300px;">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Medical Notes</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-5 bg-white shadow-sm rounded">
                    
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 text-info">Medical Notes History</h3>
                        <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                    
                    <ul class="list-group shadow-sm">
                        <?php if (!empty($data['notes'])): ?>
                            <?php foreach ($data['notes'] as $note): ?>
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <small class="badge badge-info text-light"><i class="fa fa-calendar"></i> <?= htmlspecialchars($note['RecordDate'] ?? 'Date Unknown') ?></small>
                                    </div>
                                    <h6 class="mb-1 text-dark">Diagnosis: <?= htmlspecialchars($note['Diagnosis'] ?? 'No Diagnosis') ?></h6>
                                    <?php if (!empty($note['Behavior'])): ?>
                                        <p class="mb-1 text-muted"><small>Behavior: <?= htmlspecialchars($note['Behavior']) ?></small></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted text-center py-4">No medical notes found for this pet.</li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
