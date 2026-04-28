<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>
    .shop-section {
        padding: 80px 0;
        background-color: #f8fafc;
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
    }

    .shop-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .shop-header h2 {
        font-size: 42px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
        letter-spacing: -0.03em;
    }

    .shop-header p {
        color: #64748b;
        font-size: 18px;
        max-width: 600px;
        margin: 0 auto;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 32px;
    }

    .product-card-premium {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card-premium:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        border-color: #185FA5;
    }

    .product-image-box {
        height: 200px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        font-size: 64px;
    }

    .product-body-premium {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .p-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .p-ingredients {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    .p-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .p-price {
        font-size: 22px;
        font-weight: 900;
        color: #185FA5;
    }

    .btn-add-cart {
        background: #1D9E75;
        color: white;
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
    }

    .btn-add-cart:hover {
        background: #0F6E56;
        transform: scale(1.1);
        color: white;
    }

    .cart-float-btn {
        position: fixed;
        bottom: 40px;
        right: 40px;
        background: #0f172a;
        color: white;
        padding: 16px 32px;
        border-radius: 50px;
        box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.3);
        z-index: 100;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .cart-float-btn:hover {
        transform: translateY(-5px);
        background: #1e293b;
        color: white;
        text-decoration: none;
    }

    .cart-badge-premium {
        background: #185FA5;
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
    }
</style>

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
