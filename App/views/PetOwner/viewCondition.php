<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_2.jpg'); height: 300px !important; min-height: 300px;" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" style="height: 300px !important; min-height: 300px;">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Chronic Conditions</h1>
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
                        <h3 class="mb-0 text-primary">Conditions Tracking</h3>
                        <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                    
                    <form action="<?= ROOT ?>/petowner/addCondition" method="POST" class="mb-5 p-4 bg-light rounded border">
                        <input type="hidden" name="pet_id" value="<?= htmlspecialchars($data['pet_id'] ?? '') ?>">
                        <div class="form-group">
                            <label class="font-weight-bold">Log a new chronic condition:</label>
                            <div class="input-group">
                                <input type="text" name="condition" class="form-control" placeholder="E.g., Diabetes, Arthritis..." required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary px-4" type="submit"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <h5 class="text-secondary mb-3">Current Tracking List</h5>
                    
                    <ul class="list-group shadow-sm">
                        <?php if (!empty($data['conditions'])): ?>
                            <?php foreach ($data['conditions'] as $condition): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fa fa-medkit text-danger mr-2"></i> <?= htmlspecialchars($condition['ConditionName']) ?></span>
                                    <a href="<?= ROOT ?>/petowner/deleteCondition/<?= $condition['ConditionID'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this condition?');"><i class="fa fa-trash"></i></a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted text-center py-4">No chronic conditions recorded for this pet.</li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>