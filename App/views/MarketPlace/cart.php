<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section">
<div class="container">

<h2 class="text-center mb-4">
Shopping Cart 🛒
</h2>

<?php
$total = 0;
?>

<?php if (!empty($cart)): ?>

<table class="table table-bordered text-center">

<thead>

<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php foreach ($cart as $item): ?>

<tr>

<td>

<img
src="<?= ROOT ?>/assets/images/<?= !empty($item['image']) ? $item['image'] : 'pricing-1.jpg'; ?>"
width="80">

</td>

<td>
<?= htmlspecialchars($item['Name']); ?>
</td>

<td>
$<?= htmlspecialchars($item['Price']); ?>
</td>

<td>

<a href="<?= ROOT ?>/marketplace/decreaseQty/<?= $item['ProductID']; ?>"
class="btn btn-sm btn-danger">

−

</a>

<span class="mx-2">
<?= htmlspecialchars($item['qty']); ?>
</span>

<a href="<?= ROOT ?>/marketplace/increaseQty/<?= $item['ProductID']; ?>"
class="btn btn-sm btn-success">

+

</a>

</td>

<td>

<?php

$sub = (float)$item['Price'] * (int)$item['qty'];

$total += $sub;

echo "$" . number_format($sub, 2);

?>

</td>

<td>

<a href="<?= ROOT ?>/marketplace/removeFromCart/<?= $item['ProductID']; ?>"
class="btn btn-danger btn-sm">

Remove ❌

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<div class="text-right mt-3">

<h4>

Grand Total:
$<?= number_format($total, 2) ?>

</h4>

<a href="<?= ROOT ?>/marketplace/clearCart"
class="btn btn-warning">

Clear Cart 🧹

</a>

<a href="<?= ROOT ?>/marketplace/checkout"
class="btn btn-success ml-2">

Checkout 🧾

</a>

</div>

<?php else: ?>

<div class="text-center">

<h4>
Cart is Empty 🐾
</h4>

<a href="<?= ROOT ?>/marketplace"
class="btn btn-primary mt-3">

Go Shopping 🛍️

</a>

</div>

<?php endif; ?>

</div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>