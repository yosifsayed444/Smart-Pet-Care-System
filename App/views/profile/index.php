<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">
    <h2>My Profile</h2>

    <div class="card mt-4 p-4">

        <p>
            <strong>Name:</strong>
            <?= $data['username'] ?? 'No name' ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= $data['email'] ?? 'No email' ?>
        </p>

        <p>
            <strong>Phone:</strong>
            <?= $data['phone'] ?? 'No phone' ?>
        </p>

        <p>
            <strong>Role:</strong>
            <?= $data['role'] ?? 'No role' ?>
        </p>

    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>