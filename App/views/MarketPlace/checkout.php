<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section">
<div class="container">

<h2 class="text-center mb-4">
Checkout 🧾
</h2>

<form method="POST"
action="<?= ROOT ?>/marketplace/placeOrder">

<div class="form-group">

<label>Name</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="form-group">

<label>Phone</label>

<input type="text"
name="phone"
class="form-control"
required>

</div>

<div class="form-group">

<label>Address</label>

<textarea
name="address"
class="form-control"
required></textarea>

</div>

<button class="btn btn-success">

Place Order ✅

</button>

</form>

</div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>