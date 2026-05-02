<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>


<div class="shop-section">
    <div class="container">
        <div class="shop-header">
            <h2>Premium Marketplace</h2>
            <p>Everything your pet needs, delivered with care.</p>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success animate__animated animate__fadeInDown" style="border-radius: 12px;"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <div class="product-grid">
            <?php foreach($products as $product): ?>
                <div class="product-card-premium">
                    <div class="product-image-box">
                        <?php if (!empty($product['image'])): ?>
                            <?php if (strpos($product['image'], 'http') === 0): ?>
                                <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['Name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= ROOT ?>/uploads/products/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['Name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fa fa-shopping-basket"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-body-premium">
                        <h3 class="p-title"><?= htmlspecialchars($product['Name']) ?></h3>
                        <p class="p-ingredients"><?= htmlspecialchars($product['Ingredients']) ?></p>
                        <div class="p-footer">
                            <div class="p-price"><?= number_format($product['Price'], 2) ?> <span style="font-size: 12px; font-weight: 600;">EGP</span></div>
                            <a href="<?= ROOT ?>/shop/addToCart/<?= $product['ProductID'] ?>" class="btn-add-cart">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<a href="<?= ROOT ?>/shop/cart" class="cart-float-btn">
    <i class="fa fa-shopping-cart"></i>
    View Cart
    <span class="cart-badge-premium"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
</a>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
