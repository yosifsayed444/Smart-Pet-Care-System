<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h1 class="font-weight-800 text-dark">My Analytics</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stats-card text-center">
                <div class="text-muted small text-uppercase font-weight-bold mb-2">Total Gross</div>
                <div class="display-4 font-weight-800 text-primary">$<?= number_format($data['stats']['gross_earnings'], 2) ?></div>
                <div class="badge badge-light mt-3 p-2 px-3">+12% vs last month</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card text-center">
                <div class="text-muted small text-uppercase font-weight-bold mb-2">Net Profit</div>
                <div class="display-4 font-weight-800 text-success">$<?= number_format($data['stats']['net_earnings'], 2) ?></div>
                <div class="mt-3 small text-muted">After 10% platform fee</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card text-center">
                <div class="text-muted small text-uppercase font-weight-bold mb-2">In Transit</div>
                <div class="display-4 font-weight-800 text-warning">$<?= number_format($data['stats']['pending_payouts'], 2) ?></div>
                <div class="mt-3 small text-muted">Pending bank verification</div>
            </div>
        </div>
    </div>
</div>

<style>
.stats-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.02);
    height: 100%;
    transition: transform 0.3s ease;
}
.stats-card:hover {
    transform: translateY(-5px);
}
.premium-card {
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    height: 100%;
}
.font-weight-800 { font-weight: 800; }
</style>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
