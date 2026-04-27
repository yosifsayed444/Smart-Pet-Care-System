<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Pet Care Shop 🛒</h2>
                <p>High-quality food, vaccines, and accessories for your best friends.</p>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-shopping-basket fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title font-weight-bold"><?= htmlspecialchars($product['Name']) ?></h5>
                            <p class="small text-muted mb-2">Ingredients: <?= htmlspecialchars($product['Ingredients']) ?></p>
                            <h4 class="text-success font-weight-bold mb-3"><?= number_format($product['Price'], 2) ?> EGP</h4>
                            <a href="<?= ROOT ?>/shop/addToCart/<?= $product['ProductID'] ?>" class="btn btn-primary btn-block rounded-pill">
                                <i class="fa fa-cart-plus mr-1"></i> Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= ROOT ?>/shop/cart" class="btn btn-dark btn-lg px-5 rounded-pill shadow">
                <i class="fa fa-shopping-cart mr-2"></i> View My Cart 
                <span class="badge badge-light ml-1"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
            </a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
