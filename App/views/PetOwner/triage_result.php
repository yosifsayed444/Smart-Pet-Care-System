<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<style>

    body {
        color: #000000;
    }
    h2 {
        color: #1b652d;
        margin-top: 20px;
    }

    h3 {
        color: #28a745;
    }
</style>

<div class="container mt-5">

<h2>Recommended Specialist:</h2>

<h3><?= $type ?></h3>

<a href="<?php echo ROOT ?>/petowner/dashboard">
Back
</a>

</div>
