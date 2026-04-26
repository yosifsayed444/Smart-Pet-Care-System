<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">

            <h1 class="mb-4">Admin Dashboard</h1>

            <div class="card p-4 shadow-sm">
                <h4>Welcome <?php echo $_SESSION['username']; ?> </h4>
                
            </div>

        </div>
    </div>

</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>