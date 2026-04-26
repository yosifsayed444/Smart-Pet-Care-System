<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">

<h2>Add New Product</h2>

<a href="<?= ROOT ?>/admin/products"
class="btn btn-secondary mb-3">

Back to Products

</a>


<?php if (!empty($_SESSION['success'])): ?>

<div class="alert alert-success">

<?= $_SESSION['success']; unset($_SESSION['success']); ?>

</div>

<?php endif; ?>


<form method="POST"
enctype="multipart/form-data"
action="<?= ROOT ?>/admin/addProduct">


<div class="form-group">

<label>Product Name</label>

<input type="text"
name="Name"
class="form-control <?= isset($errors['Name']) ? 'is-invalid' : '' ?>"
value="<?= $old['Name'] ?? '' ?>">

<?php if (!empty($errors['Name'])): ?>

<div class="invalid-feedback">

<?= $errors['Name'] ?>

</div>

<?php endif; ?>

</div>


<!-- Ingredients -->

<div class="form-group">

<label>Ingredients</label>

<textarea
name="Ingredients"
class="form-control <?= isset($errors['Ingredients']) ? 'is-invalid' : '' ?>"><?= $old['Ingredients'] ?? '' ?></textarea>

<?php if (!empty($errors['Ingredients'])): ?>

<div class="invalid-feedback">

<?= $errors['Ingredients'] ?>

</div>

<?php endif; ?>

</div>


<!-- Price -->

<div class="form-group">

<label>Price</label>

<input type="text"
name="Price"
class="form-control <?= isset($errors['Price']) ? 'is-invalid' : '' ?>"
value="<?= $old['Price'] ?? '' ?>">

<?php if (!empty($errors['Price'])): ?>

<div class="invalid-feedback">

<?= $errors['Price'] ?>

</div>

<?php endif; ?>

</div>


<!-- Stock -->

<div class="form-group">

<label>Stock</label>

<input type="text"
name="stock"
class="form-control <?= isset($errors['stock']) ? 'is-invalid' : '' ?>"
value="<?= $old['stock'] ?? '' ?>">

<?php if (!empty($errors['stock'])): ?>

<div class="invalid-feedback">

<?= $errors['stock'] ?>

</div>

<?php endif; ?>

</div>


<!-- Image Upload -->

<div class="form-group mt-3">

<label>Product Image</label>

<input type="file"
name="image"
class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>">

<?php if (!empty($errors['image'])): ?>

<div class="invalid-feedback">

<?= $errors['image'] ?>

</div>

<?php endif; ?>

</div>



<button class="btn btn-success mt-3">

Save Product

</button>

</form>

</div>