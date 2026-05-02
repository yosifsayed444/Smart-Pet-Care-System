<?php
    $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin'): ?>

<nav class="pcnav navbar navbar-expand-lg">
    <div class="container">

        <a class="pcnav-brand" href="<?= ROOT ?>/">
            <img src="<?= ROOT ?>/assets/images/logo.png" alt="PetCare">
            <span class="pcnav-brand-name">Pet<span>Care</span></span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pcnavMain" aria-controls="pcnavMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="pcnavMain">

            <?php if (!isset($_SESSION['role']) || $_SESSION['role'] === 'Owner'): ?>
            <ul class="navbar-nav mr-auto align-items-lg-center">
                <li class="nav-item"><a href="<?= ROOT ?>/"               class="nav-link pcnav-link">Home</a></li>
                <li class="nav-item"><a href="<?= ROOT ?>/serviceprovider" class="nav-link pcnav-link">Services</a></li>
                <li class="nav-item"><a href="<?= ROOT ?>/shop"           class="nav-link pcnav-link">Marketplace</a></li>
                <li class="nav-item"><a href="<?= ROOT ?>/about"          class="nav-link pcnav-link">About</a></li>
                <li class="nav-item"><a href="<?= ROOT ?>/contact"        class="nav-link pcnav-link">Contact</a></li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav mr-auto"></ul>
            <?php endif; ?>

            <ul class="navbar-nav align-items-lg-center" style="gap:6px;">

                <?php if (isset($_SESSION['id'])): ?>
                    <?php
                        $notifModel  = new Notification();
                        $unreadCount = $notifModel->countUnread($_SESSION['id']);
                        $dashboardLink = ROOT . "/home";
                        if (isset($_SESSION['role'])) {
                            switch ($_SESSION['role']) {
                                case 'Admin':           $dashboardLink = ROOT . "/admin/dashboard"; break;
                                case 'ServiceProvider': $dashboardLink = ROOT . "/serviceprovider/dashboard"; break;
                                case 'Vet':             $dashboardLink = ROOT . "/vet/dashboard"; break;
                                case 'Owner':           $dashboardLink = ROOT . "/petowner/dashboard"; break;
                            }
                        }
                    ?>

                    <li class="nav-item d-flex align-items-center" style="gap:6px;">
                        <a href="<?= ROOT ?>/notifications" class="pcnav-bell" title="General Notifications">
                            <span class="fa fa-bell-o"></span>
                            <?php if ($unreadCount > 0): ?>
                                <span class="pcnav-bell-dot"></span>
                            <?php endif; ?>
                        </a>

                    </li>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Owner'): ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/shop/cart" class="pcnav-cart">
                            <span class="fa fa-shopping-cart"></span> Cart
                            <?php if ($count > 0): ?>
                                <span class="pcnav-cart-badge"><?= $count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item d-none d-lg-flex align-items-center">
                        <div class="pcnav-sep"></div>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $dashboardLink ?>" class="pcnav-dash">
                            <span class="fa fa-th-large" style="font-size:11px;"></span> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= ROOT ?>/profile" class="pcnav-user">
                            <div class="pcnav-avatar"><?= strtoupper(substr($_SESSION['username'], 0, 1)) ?></div>
                            <span class="pcnav-username"><?= htmlspecialchars($_SESSION['username']) ?></span>
                        </a>
                    </li>

            
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/logout" class="pcnav-logout">
                            <span class="fa fa-sign-out"></span> Logout
                        </a>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/login" class="pcnav-login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/register" class="pcnav-signup">Sign Up</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<script>
(function () {
    // Active link highlight
    document.querySelectorAll('.pcnav-link').forEach(function (a) {
        if (window.location.pathname === new URL(a.href, location.origin).pathname) {
            a.classList.add('is-active');
        }
    });
})();
</script>

<?php endif; ?>