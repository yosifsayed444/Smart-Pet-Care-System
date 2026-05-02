<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">

<h2>Edit User</h2>

<form method="POST" action="<?= ROOT ?>/admin/editUser/<?= $user['id'] ?>"
class="mt-4"
novalidate>

<div class="form-group">

<label>Username</label>

<input type="text"
name="username"
class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
value="<?= $old['username'] ?? $user['username'] ?>">

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
value="<?= $old['email'] ?? $user['email'] ?>">

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
value="<?= $old['phone'] ?? $user['phone'] ?>">

<?php if (!empty($errors['phone'])): ?>

<div class="invalid-feedback">
<?= $errors['phone'] ?>
</div>

<?php endif; ?>

</div>






<div class="form-group">
    <label>Role</label>
    <select name="role" id="roleSelect" class="form-control">
        <option value="Owner" <?= (($old['role'] ?? $user['role']) == 'Owner') ? 'selected' : '' ?>>Owner</option>
        <option value="Admin" <?= (($old['role'] ?? $user['role']) == 'Admin') ? 'selected' : '' ?>>Admin</option>
        <option value="Vet" <?= (($old['role'] ?? $user['role']) == 'Vet') ? 'selected' : '' ?>>Vet</option>
        <option value="ServiceProvider" <?= (($old['role'] ?? $user['role']) == 'ServiceProvider') ? 'selected' : '' ?>>ServiceProvider</option>
    </select>
</div>

<div id="vetFields" style="display: <?= (($old['role'] ?? $user['role']) == 'Vet') ? 'block' : 'none' ?>;">
    <div class="form-group mt-3">
        <label>Specialization</label>
        <input type="text" name="specialization" class="form-control" value="<?= $old['specialization'] ?? $vet['Specialization'] ?? '' ?>">
    </div>
    <div class="form-group mt-3">
        <label>License Number</label>
        <input type="text" name="license_number" class="form-control" value="<?= $old['license_number'] ?? $vet['LicenseNumber'] ?? '' ?>">
    </div>
</div>

<script>
    document.getElementById('roleSelect').addEventListener('change', function() {
        var vetFields = document.getElementById('vetFields');
        if (this.value === 'Vet') {
            vetFields.style.display = 'block';
        } else {
            vetFields.style.display = 'none';
        }
    });
</script>



<button class="btn btn-primary mt-3">

Update User

</button>

</form>

</div>

<!-- <?php require __DIR__ . '/../layouts/footer.php'; ?> -->
