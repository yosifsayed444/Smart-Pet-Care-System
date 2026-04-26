<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
<div class="container">

<div class="row justify-content-center pb-5 mb-3">
<div class="col-md-7 heading-section text-center ftco-animate">

<h2>Pet Food & Accessories Marketplace</h2>

<p>
Filter marketplace items based on your pet's medical needs.
</p>

</div>
</div>

<div class="row">

<?php if (!empty($products)): ?>

<?php foreach ($products as $product): ?>

<div class="col-md-4 col-sm-6 mb-4 ftco-animate">

<div class="block-7">

<?php

$imagePath =
"uploads/products/" .
($product['image'] ?? '');

if (
!empty($product['image']) &&
file_exists($imagePath)
) {

$image =
ROOT . "/" . $imagePath;

}
else {

$image =
ROOT . "/assets/images/pricing-1.jpg";

}

?>

<!-- Product Image -->

<div class="img"
style="background-image: url('<?= $image ?>');">
</div>

<!-- Product Content -->

<div class="text-center p-4">

<!-- Name -->

<span class="excerpt d-block">
<?= htmlspecialchars($product['Name']) ?>
</span>

<!-- Price -->

<span class="price">

<sup>$</sup>

<span class="number">
<?= htmlspecialchars($product['Price']) ?>
</span>

</span>

<!-- Ingredients -->

<ul class="pricing-text mb-3">

<li>
<?= htmlspecialchars($product['Ingredients']) ?>
</li>

</ul>

<!-- Stock & Button -->

<?php if ($product['stock'] > 0): ?>

<a href="<?= ROOT ?>/marketplace/addToCart/<?= $product['ProductID'] ?>"
class="btn btn-primary btn-sm">

Add To Cart 🛒

</a>

<p class="text-success small mt-2">

Stock: <?= $product['stock'] ?>

</p>

<?php else: ?>

<button class="btn btn-secondary btn-sm" disabled>

Out of Stock ❌

</button>

<p class="text-danger small mt-2">

Out of Stock

</p>

<?php endif; ?>

</div> <!-- text -->

</div> <!-- block-7 -->

</div> <!-- col -->

<?php endforeach; ?>

<?php else: ?>

<div class="col-12 text-center">

<p>No products found.</p>

</div>

<?php endif; ?>

</div> <!-- row -->

</div> <!-- container -->

</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>