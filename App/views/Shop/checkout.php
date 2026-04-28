<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm p-4 h-100">
                    <h3 class="mb-4">Billing Details</h3>
                    <form id="checkoutForm" action="<?= ROOT ?>/shop/placeOrder" method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Shipping Address</label>
                                <textarea name="address" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" rows="3" placeholder="Enter your full address..." required><?= $old['address'] ?? '' ?></textarea>
                                <?php if(isset($errors['address'])): ?>
                                    <div class="invalid-feedback"><?= $errors['address'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" placeholder="e.g. 012xxxxxxx" value="<?= $old['phone'] ?? '' ?>" required>
                                <?php if(isset($errors['phone'])): ?>
                                    <div class="invalid-feedback"><?= $errors['phone'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Payment Method</label>
                                <select name="payment" id="paymentMethod" class="form-control" required>
                                    <option value="cod" <?= ($old['payment'] ?? '') === 'cod' ? 'selected' : '' ?>>Cash on Delivery</option>
                                    <option value="card" <?= ($old['payment'] ?? '') === 'card' ? 'selected' : '' ?>>Credit / Debit Card</option>
                                </select>
                            </div>
                            
                            <div id="cardDetails" class="col-md-12 mt-3" style="display: <?= ($old['payment'] ?? '') === 'card' ? 'block' : 'none' ?>;">
                                <div class="bg-light p-3 rounded border">
                                    <h6 class="mb-3"><i class="fa fa-credit-card mr-2"></i>Secure Payment</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <input type="text" name="card_number" class="form-control <?= isset($errors['card_number']) ? 'is-invalid' : '' ?>" placeholder="Card Number (16 digits)" value="<?= $old['card_number'] ?? '' ?>">
                                            <?php if(isset($errors['card_number'])): ?>
                                                <div class="invalid-feedback"><?= $errors['card_number'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="card_expiry" class="form-control <?= isset($errors['card_expiry']) ? 'is-invalid' : '' ?>" placeholder="MM/YY" value="<?= $old['card_expiry'] ?? '' ?>">
                                            <?php if(isset($errors['card_expiry'])): ?>
                                                <div class="invalid-feedback"><?= $errors['card_expiry'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="card_cvv" class="form-control <?= isset($errors['card_cvv']) ? 'is-invalid' : '' ?>" placeholder="CVV" value="<?= $old['card_cvv'] ?? '' ?>">
                                            <?php if(isset($errors['card_cvv'])): ?>
                                                <div class="invalid-feedback"><?= $errors['card_cvv'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill">Place Order Now</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('paymentMethod').addEventListener('change', function() {
                    const cardDetails = document.getElementById('cardDetails');
                    if (this.value === 'card') {
                        cardDetails.style.display = 'block';
                        cardDetails.querySelectorAll('input').forEach(i => i.required = true);
                    } else {
                        cardDetails.style.display = 'none';
                        cardDetails.querySelectorAll('input').forEach(i => i.required = false);
                    }
                });
            </script>

            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card shadow-sm p-4 bg-white border-primary" style="border-top: 5px solid #007bff;">
                    <h4 class="mb-4">Order Summary</h4>
                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach($cart as $item): ?>
                            <?php 
                                $name = $item['name'] ?? $item['Name'] ?? 'Product';
                                $price = $item['price'] ?? $item['Price'] ?? 0;
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($name) ?></h6>
                                    <small class="text-muted">Qty: <?= $item['qty'] ?></small>
                                </div>
                                <span><?= number_format($price * $item['qty'], 2) ?> EGP</span>
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

