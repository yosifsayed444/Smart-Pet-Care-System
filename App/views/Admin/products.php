<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- SweetAlert Success -->

<?php if (!empty($_SESSION['success'])): ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

Swal.fire({

icon: 'success',

title: 'Success',

text: '<?= $_SESSION['success'] ?>',

confirmButtonColor: '#3085d6'

});

</script>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>


<div class="container mt-4">

<h2>Products</h2>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Ingredients</th>
<th>Price</th>
<th>Stock</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php if(!empty($products)): ?>

<?php foreach ($products as $row): ?>

<tr>

<td><?= $row['ProductID'] ?></td>

<td><?= $row['Name'] ?></td>

<td><?= $row['Ingredients'] ?></td>

<td><?= $row['Price'] ?></td>

<td><?= $row['stock'] ?></td>
<td>

<img src="<?= ROOT ?>/uploads/products/<?= $row['image'] ?>" width="100" alt="Product Image">

</td>

<td>

<a href="<?= ROOT ?>/admin/editProduct/<?= $row['ProductID'] ?>"
class="btn btn-warning btn-sm">

Edit

</a>    

<a href="<?= ROOT ?>/admin/deleteProduct/<?= $row['ProductID'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this product?')">

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6" class="text-center">

No Products Found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

<a href="<?= ROOT ?>/admin/addProduct"
class="btn btn-primary">

Add Product

</a>
<a href="<?= ROOT ?>/admin/dashboard"
class="btn btn-secondary">

Back to Dashboard

</a>

</div>