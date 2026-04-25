<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2>My Profile</h2>

        <hr>

        <p>
            <strong>Username:</strong>
            <?= $user['username'] ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= $user['email'] ?>
        </p>

        <p>
            <strong>Phone:</strong>
            <?= $user['phone'] ?>
        </p>

        <p>
            <strong>Role:</strong>
            <?= $user['role'] ?>
        </p>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>