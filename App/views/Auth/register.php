<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card shadow-sm p-4">

<h2 class="mb-4 text-center">Register</h2>

<form method="POST" action="<?php echo ROOT ?>/auth/register" novalidate>

<!-- Username -->

<div class="form-group">
    <label>Username</label>

    <input type="text"
           name="username"
           class="form-control"
           required>

<?php if(!empty($errors['username'])): ?>
    <small class="text-danger">
        <?= $errors['username'] ?>
    </small>
<?php endif; ?>

</div>

<!-- Email -->

<div class="form-group">

<label>Email Address</label>

<input type="email"
       name="email"
       class="form-control"
       required>

<?php if (! empty($errors['email'])): ?>
    <small class="text-danger">
        <?php echo $errors['email'] ?>
    </small>
<?php endif; ?>

</div>

<!-- Password -->

<div class="form-group">

<label>Password</label>

<input type="password"
       name="password"
       class="form-control"
       required>

<?php if (! empty($errors['password'])): ?>
    <small class="text-danger">
        <?php echo $errors['password'] ?>
    </small>
<?php endif; ?>

</div>

<!-- Phone -->

<div class="form-group">

<label>Phone Number</label>

<input type="text"
       name="phone"
       class="form-control"
       required>

<?php if (! empty($errors['phone'])): ?>
    <small class="text-danger">
        <?php echo $errors['phone'] ?>
    </small>
<?php endif; ?>

</div>

<button type="submit"
        class="btn btn-primary w-100 py-3">

Register

</button>

<p class="text-center mt-3">

Already have an account?

<a href="<?php echo ROOT ?>/auth/login">
Login
</a>

</p>

</form>

</div>
</div>
</div>
</div>
</div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>