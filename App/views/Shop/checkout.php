<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm p-4 h-100">
                    <h3 class="mb-4">Billing Details</h3>
                    <form id="checkoutForm" action="<?= ROOT ?>/shop/placeOrder" method="POST">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Shipping Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Enter your full address..." required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. 012xxxxxxx" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Payment Method</label>
                                <select name="payment" class="form-control" required>
                                    <option value="cod">Cash on Delivery</option>
                                    <option value="card" disabled>Credit Card (Coming Soon)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill">Place Order Now</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card shadow-sm p-4 bg-white border-primary" style="border-top: 5px solid #007bff;">
                    <h4 class="mb-4">Order Summary</h4>
                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach($cart as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                    <small class="text-muted">Qty: <?= $item['qty'] ?></small>
                                </div>
                                <span><?= number_format($item['price'] * $item['qty'], 2) ?> EGP</span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 font-weight-bold" style="font-size: 1.1rem;">
                            Total
                            <span class="text-success"><?= number_format($total, 2) ?> EGP</span>
                        </li>
                    </ul>
                    <div class="alert alert-info py-2">
                        <small><i class="fa fa-info-circle mr-1"></i> Delivery within 2-3 business days.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
