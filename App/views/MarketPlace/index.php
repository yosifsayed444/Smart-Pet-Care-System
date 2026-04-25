<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Pet Food & Accessories Marketplace</h2>
                <p>Filter marketplace items based on your pet's medical needs.</p>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <div class="col-md-4 ftco-animate">
                        <div class="block-7">
                            <div class="img" style="background-image: url(<?= ROOT ?>/assets/images/<?= htmlspecialchars($product['image'] ?? 'pricing-1.jpg') ?>);"></div>
                            <div class="text-center p-4">
                                <span class="excerpt d-block"><?= htmlspecialchars($product['name']) ?></span>
                                <span class="price"><sup>$</sup> <span class="number"><?= htmlspecialchars($product['price']) ?></span></span>
                                
                                <ul class="pricing-text mb-5">
                                    <li><?= htmlspecialchars($product['description'] ?? 'No description') ?></li>
                                </ul>

                                <a href="#" class="btn btn-primary d-block px-2 py-3" onclick="alert('Added to cart!'); return false;">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No products found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
