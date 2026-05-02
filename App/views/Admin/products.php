<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Products Management</h2>
            <a href="<?= ROOT ?>/admin/addProduct" class="btn btn-sm btn-primary">Add Product</a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Image</th>
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
<td>
<?php if (strpos($row['image'], 'http') === 0): ?>
    <img src="<?= $row['image'] ?>" width="100" style="border-radius: 5px;" alt="Product Image">
<?php else: ?>
    <img src="<?= ROOT ?>/uploads/products/<?= $row['image'] ?>" width="100" style="border-radius: 5px;" alt="Product Image">
<?php endif; ?>
</td>
<td><?= $row['Name'] ?></td>
<td><?= $row['Ingredients'] ?></td>
<td><?= number_format($row['Price'], 2) ?> EGP</td>
<td><?= $row['stock'] ?></td>
<td>
<a href="<?= ROOT ?>/admin/editProduct/<?= $row['ProductID'] ?>" class="btn btn-warning btn-sm">Edit</a>    
<a href="<?= ROOT ?>/admin/deleteProduct/<?= $row['ProductID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
<td colspan="7" class="text-center">No Products Found</td>
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