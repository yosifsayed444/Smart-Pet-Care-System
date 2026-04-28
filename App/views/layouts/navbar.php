<?php
    $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<?php if (! isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin'): ?>
<style>
    
    :root {
        --nav-bg: rgba(255, 255, 255, 0.95);
        --nav-text: #1e293b;
        --nav-accent: #185FA5;
        --nav-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .premium-navbar {
        background: var(--nav-bg) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: var(--nav-shadow);
        padding: 12px 0;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-family: 'Montserrat', sans-serif;
    }

    .navbar-brand {
        font-weight: 800;
        font-size: 24px;
        color: var(--nav-accent) !important;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: -0.02em;
    }

    .navbar-brand .logo-icon {
        width: 32px;
        height: 32px;
        background: var(--nav-accent);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    .nav-link {
        color: var(--nav-text) !important;
        font-weight: 600;
        font-size: 14px;
        padding: 8px 16px !important;
        position: relative;
        transition: color 0.2s ease;
    }

    .nav-link:hover {
        color: var(--nav-accent) !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 16px;
        right: 16px;
        height: 2px;
        background: var(--nav-accent);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }

    
    .nav-btn-outline {
        border: 2px solid var(--nav-accent);
        color: var(--nav-accent) !important;
        border-radius: 10px;
        margin-left: 12px;
        transition: all 0.2s ease;
    }

    .nav-btn-outline:hover {
        background: var(--nav-accent);
        color: white !important;
    }

    .nav-user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 16px;
        background: #f1f5f9;
        border-radius: 30px;
        margin-left: 16px;
        text-decoration: none;
        color: var(--nav-text) !important;
        transition: background 0.2s;
    }

    .nav-user-info:hover {
        background: #e2e8f0;
        text-decoration: none;
    }

    .nav-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--nav-accent);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .cart-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: #E6F1FB;
        color: var(--nav-accent);
        border-radius: 30px;
        font-weight: 700;
        font-size: 13px;
        margin-left: 12px;
        text-decoration: none;
    }

    .cart-pill:hover {
        background: #dbeafe;
        text-decoration: none;
    }

    .cart-count {
        background: var(--nav-accent);
        color: white;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 10px;
    }

    
    .notif-bell {
        position: relative;
        margin-left: 12px;
        color: var(--nav-text);
        font-size: 18px;
        transition: color 0.2s;
    }

    .notif-bell:hover {
        color: var(--nav-accent);
    }

    .notif-dot {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
    }

    .top-bar-premium {
        background: #0f172a;
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        padding: 8px 0;
        font-family: 'Inter', sans-serif;
    }

    .top-bar-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        margin-right: 20px;
        transition: color 0.2s;
    }

    .top-bar-link:hover {
        color: white;
        text-decoration: none;
    }
</style>



<nav class="navbar navbar-expand-lg navbar-light premium-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= ROOT ?>/">
            <div class="logo-icon"><span class="fa fa-paw"></span></div>
            PetCare
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
            <span class="fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto align-items-center">
                
               
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] === 'Owner'): ?>
                    <li class="nav-item"><a href="<?= ROOT ?>/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="<?= ROOT ?>/serviceprovider" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="<?= ROOT ?>/shop" class="nav-link">Marketplace</a></li>  
                    <li class="nav-item"><a href="<?= ROOT ?>/about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="<?= ROOT ?>/contact" class="nav-link">Contact</a></li>  
                <?php endif; ?>
            

                <?php if (isset($_SESSION['id'])): ?>
                    <?php 
                        $notifModel = new Notification();
                        $unreadCount = $notifModel->countUnread($_SESSION['id']);
                    ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/notifications" class="notif-bell">
                            <span class="fa fa-bell-o"></span>
                            <?php if ($unreadCount > 0): ?>
                                <span class="notif-dot"></span>
                            <?php endif; ?>
                        </a>
                    </li>
                     <li class="nav-item">
                        <?php
                            $dashboardLink = ROOT . "/home";
                            if (isset($_SESSION['role'])) {
                                switch ($_SESSION['role']) {
                                    case 'Admin':    $dashboardLink = ROOT . "/admin/dashboard"; break;
                                    case 'ServiceProvider': $dashboardLink = ROOT . "/serviceprovider/dashboard"; break;
                                    case 'Vet':      $dashboardLink = ROOT . "/vet/dashboard"; break;
                                    case 'Owner':    $dashboardLink = ROOT . "/petowner/dashboard"; break;
                                }
                            }
                        ?>
                        <a href="<?= $dashboardLink ?>" class="nav-link" style="color: var(--nav-text) !important; font-weight: 700;">Dashboard</a>
                    </li>
                    <?php if ($_SESSION['role'] === 'Owner'): ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/shop/cart" class="cart-pill">
                            <span class="fa fa-shopping-cart"></span>
                            Cart
                            <?php if ($count > 0): ?>
                                <span class="cart-count"><?= $count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/profile" class="nav-user-info">
                            <div class="nav-avatar">
                                <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                            </div>
                            <span style="font-weight: 700;"><?= $_SESSION['username'] ?></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/logout" class="nav-link" style="color: #ef4444 !important; font-weight: 700;">Logout</a>
                    </li>

                <?php else: ?>
                    
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/login" class="nav-link nav-btn-outline">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>/auth/register" class="nav-link" style="font-weight: 700; color: var(--nav-accent) !important;">Sign Up</a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>