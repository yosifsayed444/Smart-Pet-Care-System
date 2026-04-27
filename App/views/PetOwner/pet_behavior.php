<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_2.jpg'); height: 300px !important; min-height: 300px;" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" style="height: 300px !important; min-height: 300px;">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Behavior Profile</h1>
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
                        <h3 class="mb-0 text-warning">Behavior Instructions</h3>
                        <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                    
                    <div class="alert alert-warning">
                        <strong>Share Handling Instructions</strong> with Sitters & Walkers.
                    </div>

                    <form action="<?= ROOT ?>/petowner/updateBehavior" method="POST" class="mb-5 p-4 bg-light rounded border">
                        <input type="hidden" name="pet_id" value="<?= htmlspecialchars($data['pet_id'] ?? '') ?>">
                        <!-- Using a dummy record_id for simulation as PetOwnerController requires it -->
                        <input type="hidden" name="record_id" value="1"> 
                        <div class="form-group">
                            <label class="font-weight-bold">Update Instructions:</label>
                            <textarea name="behavior" class="form-control" rows="4" placeholder="E.g., 'Leash Aggressive', 'Timid around large dogs'..." required></textarea>
                        </div>
                        <button class="btn btn-warning w-100 font-weight-bold" type="submit"><i class="fa fa-share-alt"></i> Share Profile</button>
                    </form>

                    <h5 class="text-secondary mb-3">Behavior History & Logs</h5>
                    <ul class="list-group shadow-sm">
                        <?php if (!empty($data['behaviors'])): ?>
                            <?php foreach ($data['behaviors'] as $behavior): ?>
                                <?php if (!empty($behavior['Behavior'])): ?>
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <small class="badge badge-warning text-dark"><i class="fa fa-calendar"></i> <?= htmlspecialchars($behavior['RecordDate'] ?? 'Date Unknown') ?></small>
                                    </div>
                                    <p class="mb-1 text-dark"><?= htmlspecialchars($behavior['Behavior']) ?></p>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted text-center py-4">No behavior profiles found.</li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>