<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-3">

<h2>Add New User</h2>

<a href="<?= ROOT ?>/admin/dashboard"
class="btn btn-secondary">

Back

</a>

</div>

<form method="POST" action="<?= ROOT ?>/admin/addUser"
class="mt-4"
novalidate>

<div class="form-group">

<label>Username</label>

<input type="text"
name="username"
class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
value="<?= $old['username'] ?? '' ?>">

<?php if (!empty($errors['username'])): ?>

<div class="invalid-feedback">
<?= $errors['username'] ?>
</div>

<?php endif; ?>

</div>



<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
value="<?= $old['email'] ?? '' ?>">

<?php if (!empty($errors['email'])): ?>

<div class="invalid-feedback">
<?= $errors['email'] ?>
</div>

<?php endif; ?>

</div>



<div class="form-group">

<label>Phone</label>

<input type="text"
name="phone"
class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
value="<?= $old['phone'] ?? '' ?>">

<?php if (!empty($errors['phone'])): ?>

<div class="invalid-feedback">
<?= $errors['phone'] ?>
</div>

<?php endif; ?>

</div>



<div class="form-group">

<label>Password</label>

<input type="password"
name="password"
class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">

<?php if (!empty($errors['password'])): ?>

<div class="invalid-feedback">
<?= $errors['password'] ?>
</div>

<?php endif; ?>

</div>



<div class="form-group">

<label>Role</label>

<select name="role"
class="form-control">

<option value="Owner"
<?= (($old['role'] ?? '') == 'Owner') ? 'selected' : '' ?>>
Owner
</option>

<option value="Admin"
<?= (($old['role'] ?? '') == 'Admin') ? 'selected' : '' ?>>
Admin
</option>

<option value="Vet"
<?= (($old['role'] ?? '') == 'Vet') ? 'selected' : '' ?>>
Vet
</option>

<option value="ServiceProvider"
<?= (($old['role'] ?? '') == 'ServiceProvider') ? 'selected' : '' ?>>
ServiceProvider
</option>

</select>

</div>



<button class="btn btn-success mt-3">

Save User

</button>

</form>

</div>

