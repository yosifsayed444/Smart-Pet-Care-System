<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 30px;">
                <div class="bg-danger p-5 text-center text-white">
                    <i class="fa fa-exclamation-triangle fa-5x mb-4 animate-pulse"></i>
                    <h1 class="font-weight-800 text-white" style="font-size: 3rem;">CRITICAL ALERT!</h1>
                    <p class="lead font-weight-bold">We detected potential life-threatening symptoms in your pet's log.</p>
                </div>

                <div class="card-body p-5 bg-white">
                    <div class="mb-5">
                        <h4 class="text-uppercase tracking-widest text-danger font-weight-bold mb-3">Symptoms Identified:</h4>
                        <div class="d-flex flex-wrap" style="gap: 10px;">
                            <?php foreach ($data['flags'] as $flag): ?>
                                <span class="badge badge-danger px-4 py-2 rounded-pill shadow-sm" style="font-size: 1.1rem;">
                                    <i class="fa fa-warning mr-2"></i><?= strtoupper($flag) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="alert alert-warning border-0 rounded-xl p-4 mb-5" style="background: rgba(255, 193, 7, 0.1);">
                        <div class="d-flex align-items-start">
                            <i class="fa fa-info-circle fa-2x text-warning mr-3 mt-1"></i>
                            <div>
                                <h5 class="font-weight-bold text-dark mb-1">Immediate Action Required</h5>
                                <p class="text-muted mb-0">These symptoms may indicate a medical emergency. Please do not wait. Contact a veterinarian immediately or head to the nearest clinic.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="https://www.google.com/maps/search/emergency+veterinary+clinic+near+me" target="_blank" class="btn btn-danger btn-block btn-lg rounded-pill py-3 font-weight-bold shadow">
                                <i class="fa fa-map-marker mr-2"></i> NEAREST CLINIC
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-secondary btn-block btn-lg rounded-pill py-3 font-weight-bold">
                                I'VE TAKEN ACTION
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small"><i class="fa fa-shield mr-2"></i>Smart Pet Care System Emergency Protocol v2.1</p>
            </div>
        </div>
    </div>
</div>

<style>
.animate-pulse {
    animation: pulse 1.5s infinite;
}
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
    100% { transform: scale(1); opacity: 1; }
}
.rounded-xl { border-radius: 20px !important; }
</style>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
