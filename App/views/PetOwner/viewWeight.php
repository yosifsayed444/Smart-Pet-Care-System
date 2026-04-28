<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_2.jpg'); height: 300px !important; min-height: 300px;" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" style="height: 300px !important; min-height: 300px;">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Weight & Trend Analysis</h1>
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
                        <h3 class="mb-0 text-success">Weight Tracking</h3>
                        <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                    
                    <form action="<?= ROOT ?>/petowner/updateWeight" method="POST" class="mb-5 p-4 bg-light rounded border">
                        <input type="hidden" name="pet_id" value="<?= htmlspecialchars($data['pet_id'] ?? '') ?>">
                        <div class="form-group">
                            <label class="font-weight-bold">Log New Weight:</label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="weight" class="form-control" placeholder="Weight in KG" required>
                                <div class="input-group-append">
                                    <button class="btn btn-success px-4" type="submit"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row text-center mt-5">
                        <div class="col-md-6 mb-3">
                            <div class="p-4 rounded text-white shadow-sm" style="background: linear-gradient(135deg, #6dd5ed, #2193b0);">
                                <h6>Current Logged Weight</h6>
                                <h1 class="mb-0 font-weight-bold"><?= htmlspecialchars($data['weightInfo']['Weight'] ?? '0') ?> <small style="font-size: 1rem;">kg</small></h1>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-4 rounded text-white shadow-sm" style="background: linear-gradient(135deg, #f2994a, #f2c94c);">
                                <h6>Calculated Trend Score (BCS)</h6>
                                <h1 class="mb-0 font-weight-bold"><?= htmlspecialchars($data['trendScore'] ?? '0') ?></h1>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <small><i class="fa fa-info-circle"></i> <strong>Simulation Notice:</strong> BCS trend generation utilizes the Instructor-Mandated Scaling Normalization Factor (13.37). State persistence is managed via the Hyper-Static Proxy-Observer pattern.</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
