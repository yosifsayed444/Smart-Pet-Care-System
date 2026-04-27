<?php
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin'): ?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <p class="mb-0 phone pl-md-2">

                    <a href="#" class="mr-2">
                        <span class="fa fa-phone mr-1"></span>
                        +00 1234 567
                    </a>

                    <a href="#">
                        <span class="fa fa-paper-plane mr-1"></span>
                        info@petcare.com
                    </a>

                </p>
            </div>

            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="social-media">
                    <p class="mb-0 d-flex">

                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-facebook"></span>
                        </a>

                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-twitter"></span>
                        </a>

                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-instagram"></span>
                        </a>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">

<div class="container">

<a class="navbar-brand" href="<?php echo ROOT ?>/">
    <span class="flaticon-pawprint-1 mr-2"></span>
    PetCare
</a>

<button class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#ftco-nav">

<span class="fa fa-bars"></span>

</button>

<div class="collapse navbar-collapse" id="ftco-nav">

<ul class="navbar-nav ml-auto">

<?php if (isset($_SESSION['id'])): ?>


    <?php if ($_SESSION['role'] === 'Owner'): ?>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/" class="nav-link">
                Home
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/serviceprovider" class="nav-link">
                Services
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/marketplace" class="nav-link">
                Marketplace
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/about" class="nav-link">
                About
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/petowner/appointments" class="nav-link">
                My Appointments
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/contact" class="nav-link">
                Contact
            </a>
        </li>

        <li class="nav-item">

            <a href="<?php echo ROOT ?>/marketplace/cart"
               class="nav-link">

                Cart 🛒

                <?php if ($count > 0): ?>

                    <span class="badge badge-light">
                        <?php echo $count ?>
                    </span>

                <?php endif; ?>

            </a>

        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/profile"
               class="nav-link">

                👤 <?php echo $_SESSION['username'] ?>

            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/auth/logout"
               class="nav-link">

                Logout

            </a>
        </li>


    <?php else: ?>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/<?php echo $_SESSION['role'] === 'Provider' ? 'serviceprovider' : strtolower($_SESSION['role']) ?>/dashboard"
               class="nav-link">

                Dashboard

            </a>
        </li>

        <?php if ($_SESSION['role'] === 'Provider'): ?>
            <li class="nav-item">
                <a href="<?php echo ROOT ?>/serviceprovider/bookings" class="nav-link">
                    Manage Bookings
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/profile"
               class="nav-link">

                👤 <?php echo $_SESSION['username'] ?>

            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/auth/logout"
               class="nav-link">

                Logout

            </a>
        </li>

    <?php endif; ?>

<?php else: ?>

    <!-- Guest -->

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/" class="nav-link">
            Home
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/serviceprovider" class="nav-link">
            Services
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/marketplace" class="nav-link">
            Marketplace
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/about" class="nav-link">
            About
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/contact" class="nav-link">
            Contact
        </a>
    </li>

    <li class="nav-item">

        <a href="<?php echo ROOT ?>/auth/login"
           class="nav-link">

            Login

        </a>

    </li>

<?php endif; ?>

</ul>

</div>

</div>

</nav>

<?php endif; ?>