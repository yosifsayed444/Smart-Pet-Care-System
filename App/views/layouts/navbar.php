<?php
    $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin'): ?>

<style>
.pcnav {
    background: #000000ff;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding: 0;
    font-family: 'Montserrat', sans-serif;
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 4px 24px rgba(0,0,0,0.35);
}
.pcnav::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, #185FA5 0%, #38bdf8 40%, #6366f1 70%, #185FA5 100%);
    background-size: 300% 100%;
    animation: pcnav-line 5s linear infinite;
    pointer-events: none;
}
@keyframes pcnav-line {
    0%   { background-position: 0% 0; }
    100% { background-position: 300% 0; }
}

.pcnav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none !important;
    flex-shrink: 0;
    padding-right: 28px;
    border-right: 1px solid rgba(255,255,255,0.07);
    margin-right: 16px;
    padding-top: 14px;
    padding-bottom: 14px;
}

.pcnav-brand:hover { opacity: 0.88; text-decoration: none !important; }

.pcnav-brand img {
    width: 44px; height: 44px;
    object-fit: contain; border-radius: 8px;
    transition: transform 0.35s cubic-bezier(.34,1.56,.64,1);
}
.pcnav-brand:hover img { transform: rotate(-10deg) scale(1.12); }

.pcnav-brand-name {
    font-size: 22px; font-weight: 800;
    letter-spacing: -0.03em; color: #fff; white-space: nowrap;
}
.pcnav-brand-name span { color: #38bdf8; }

.pcnav-link {
    color: rgba(255,255,255,0.6) !important;
    font-size: 15px !important; font-weight: 600 !important;
    letter-spacing: 0.02em;
    padding: 10px 16px !important;
    border-radius: 8px;
    transition: color 0.18s, background 0.18s;
    white-space: nowrap;
    text-decoration: none !important;
}
.pcnav-link:hover {
    color: #fff !important;
    background: rgba(255,255,255,0.06) !important;
    text-decoration: none !important;
}
.pcnav-link.is-active {
    color: #38bdf8 !important;
    background: rgba(56,189,248,0.08) !important;
}

.pcnav-bell {
    position: relative;
    width: 44px; height: 44px; border-radius: 10px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.5); font-size: 18px;
    text-decoration: none; transition: all 0.2s; flex-shrink: 0;
}
.pcnav-bell:hover {
    background: rgba(56,189,248,0.12);
    border-color: rgba(56,189,248,0.3);
    color: #38bdf8; text-decoration: none;
}
.pcnav-bell-dot {
    position: absolute; top: 9px; right: 9px;
    width: 8px; height: 8px; background: #f43f5e;
    border-radius: 50%; border: 1.5px solid #0d1424;
    animation: pcnav-pulse 2.2s infinite;
}
@keyframes pcnav-pulse {
    0%,100% { transform: scale(1); opacity:1; }
    50%      { transform: scale(1.5); opacity:0.6; }
}

.pcnav-cart {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 16px;
    background: rgba(24,95,165,0.1);
    border: 1px solid rgba(24,95,165,0.22);
    border-radius: 10px; color: #7dd3fc;
    font-size: 14.5px; font-weight: 700;
    text-decoration: none; transition: all 0.2s; white-space: nowrap;
}
.pcnav-cart:hover {
    background: rgba(24,95,165,0.22);
    border-color: rgba(56,189,248,0.4);
    color: #fff; text-decoration: none; transform: translateY(-1px);
}
.pcnav-cart-badge {
    background: #185FA5; color: #fff; font-size: 11px;
    font-weight: 800; padding: 2px 6px; border-radius: 10px;
    min-width: 20px; text-align: center;
}

/* ---- Dashboard ---- */
.pcnav-dash {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 16px; color: rgba(255,255,255,0.7);
    font-size: 14.5px; font-weight: 700; border-radius: 10px;
    text-decoration: none; transition: all 0.2s;
    border: 1px solid transparent;
}
.pcnav-dash:hover {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.08);
    color: #fff; text-decoration: none;
}

.pcnav-user {
    display: flex; align-items: center; gap: 10px;
    padding: 6px 16px 6px 6px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 50px; text-decoration: none; transition: all 0.2s;
}
.pcnav-user:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.14); text-decoration: none;
}
.pcnav-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #185FA5 0%, #38bdf8 100%);
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; flex-shrink: 0;
}
.pcnav-username { color: rgba(255,255,255,0.85); font-size: 14.5px; font-weight: 700; }

/* ---- Separator ---- */
.pcnav-sep {
    width: 1px; height: 24px;
    background: rgba(255,255,255,0.08); flex-shrink: 0;
}

/* ---- Logout ---- */
.pcnav-logout {
    display: flex; align-items: center; gap: 6px;
    padding: 8px 16px; color: #f87171;
    font-size: 14.5px; font-weight: 700; border-radius: 10px;
    text-decoration: none; transition: all 0.2s;
    border: 1px solid transparent;
}
.pcnav-logout:hover {
    background: rgba(239,68,68,0.08);
    border-color: rgba(239,68,68,0.18);
    color: #fca5a5; text-decoration: none;
}

/* ---- Auth buttons ---- */
.pcnav-login {
    padding: 9px 20px;
    border: 1.5px solid rgba(56,189,248,0.35);
    border-radius: 10px; color: #7dd3fc;
    font-size: 15px; font-weight: 700;
    text-decoration: none; transition: all 0.2s; white-space: nowrap;
}
.pcnav-login:hover {
    background: rgba(56,189,248,0.1);
    border-color: rgba(56,189,248,0.6);
    color: #fff; text-decoration: none;
}
.pcnav-signup {
    padding: 9px 22px;
    background: linear-gradient(135deg, #185FA5, #38bdf8);
    border-radius: 10px; color: #fff !important;
    font-size: 15px; font-weight: 700;
    text-decoration: none; transition: all 0.25s;
    box-shadow: 0 3px 14px rgba(24,95,165,0.4); white-space: nowrap;
}
.pcnav-signup:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(24,95,165,0.55);
    color: #fff !important; text-decoration: none;
}

/* ---- Bootstrap navbar overrides ---- */
.pcnav .navbar-toggler {
    background: rgba(255,255,255,0.05) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    color: rgba(255,255,255,0.7) !important;
}
.pcnav .navbar-toggler .fa { color: rgba(255,255,255,0.7); font-size: 18px; }

/* Mobile collapse panel */
@media (max-width: 991px) {
    .pcnav .navbar-collapse {
        background: #111827;
        border-top: 1px solid rgba(255,255,255,0.06);
        padding: 16px 12px 20px;
        margin: 0 -15px;
    }
    .pcnav .navbar-nav { gap: 6px; }
    .pcnav-link { display: block; width: 100%; }
    .pcnav-sep  { display: none; }
    .pcnav-user { border-radius: 12px; }
    .pcnav-brand { border-right: none; padding-right: 0; }
}
</style>

<nav class="pcnav navbar navbar-expand-lg">
    <div class="container">

        <!-- Brand -->
        <a class="pcnav-brand" href="<?= ROOT ?>/">
            <img src="<?= ROOT ?>/assets/images/logo.png" alt="PetCare">
            <span class="pcnav-brand-name">Pet<span>Care</span></span>
        </a>

        <!-- Mobile toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pcnavMain" aria-controls="pcnavMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="pcnavMain">

            <!-- Center links -->
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

            <!-- Right rail -->
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

                    <!-- Bell -->
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/notifications" class="pcnav-bell">
                            <span class="fa fa-bell-o"></span>
                            <?php if ($unreadCount > 0): ?>
                                <span class="pcnav-bell-dot"></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <!-- Cart -->
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

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="<?= $dashboardLink ?>" class="pcnav-dash">
                            <span class="fa fa-th-large" style="font-size:11px;"></span> Dashboard
                        </a>
                    </li>

                    <!-- User pill -->
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/profile" class="pcnav-user">
                            <div class="pcnav-avatar"><?= strtoupper(substr($_SESSION['username'], 0, 1)) ?></div>
                            <span class="pcnav-username"><?= htmlspecialchars($_SESSION['username']) ?></span>
                        </a>
                    </li>

                    <!-- Logout -->
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
        </div><!-- /.navbar-collapse -->
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