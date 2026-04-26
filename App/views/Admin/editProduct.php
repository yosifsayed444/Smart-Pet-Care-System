<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">

<h2>Edit Product</h2>

<a href="<?= ROOT ?>/admin/products"
class="btn btn-secondary mb-3">

Back to Products

</a>

<?php if (!empty($_SESSION['success'])): ?>

<div class="alert alert-success">

<?= $_SESSION['success']; unset($_SESSION['success']); ?>

</div>

<?php endif; ?>


<?php if(!empty($row)): ?>

<form method="POST"
enctype="multipart/form-data"
action="<?= ROOT ?>/admin/editProduct/<?= $row['ProductID'] ?>">

<!-- Product Name -->

<div class="form-group">

<label>Product Name</label>

<input type="text"
name="Name"
class="form-control <?= isset($errors['Name']) ? 'is-invalid' : '' ?>"
value="<?= $old['Name'] ?? $row['Name'] ?>">

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
class="form-control <?= isset($errors['Ingredients']) ? 'is-invalid' : '' ?>"><?= $old['Ingredients'] ?? $row['Ingredients'] ?></textarea>

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
value="<?= $old['Price'] ?? $row['Price'] ?>">

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
value="<?= $old['stock'] ?? $row['stock'] ?>">

<?php if (!empty($errors['stock'])): ?>

<div class="invalid-feedback">

<?= $errors['stock'] ?>

</div>

<?php endif; ?>

</div>


<!-- 🖼️ Current Image -->

<?php if(!empty($row['image'])): ?>

<div class="form-group mt-3">

<label>Current Image</label><br>

<img 
src="<?= ROOT ?>/uploads/products/<?= $row['image'] ?>"
width="120"
style="margin-bottom:10px; border-radius:8px;">

</div>

<?php endif; ?>


<!-- Upload New Image -->

<div class="form-group mt-3">

<label>Change Image</label>

<input type="file"
name="image"
class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>">

<?php if (!empty($errors['image'])): ?>

<div class="invalid-feedback">

<?= $errors['image'] ?>

</div>

<?php endif; ?>

</div>


<button class="btn btn-primary mt-3">

Update Product

</button>

</form>

<?php else: ?>

<div class="alert alert-danger">

Product not found ❌

</div>

<?php endif; ?>

</div>