<link rel="stylesheet" href="<?= ROOT ?>/assets/CSS/admin.css">

<?php
    $current_page = basename($_SERVER['REQUEST_URI']);
    function is_active($page, $current) {
        return (strpos($current, $page) !== false) ? 'active' : '';
    }
?>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-dot">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
                <path d="M2 12l10 5 10-5"/>
            </svg>
        </div>
        <span class="logo-name">PetAdmin</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-label">Main</div>
        <a href="<?= ROOT ?>/admin/dashboard" class="nav-item <?= is_active('dashboard', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="<?= ROOT ?>/admin/users" class="nav-item <?= is_active('users', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Users
        </a>
        <a href="<?= ROOT ?>/admin/products" class="nav-item <?= is_active('products', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Products
        </a>
        <a href="<?= ROOT ?>/admin/orders" class="nav-item <?= is_active('orders', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
            Orders
        </a>
        <a href="<?= ROOT ?>/admin/appointments" class="nav-item <?= is_active('appointments', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Appointments
        </a>
        <a href="<?= ROOT ?>/admin/services" class="nav-item <?= is_active('services', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Services
        </a>

        <div class="nav-group-label">Management</div>
        <a href="<?= ROOT ?>/admin/notificationEscalator" class="nav-item <?= is_active('notificationEscalator', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
            Notifications
        </a>
        <a href="<?= ROOT ?>/admin/lostPetBroadcast" class="nav-item <?= is_active('lostPetBroadcast', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            Lost pet
        </a>
        <a href="<?= ROOT ?>/admin/suspendUsers" class="nav-item <?= is_active('suspendUsers', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
            Suspended users
        </a>
        <a href="<?= ROOT ?>/admin/verifyUsers" class="nav-item <?= is_active('verifyUsers', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Verification
        </a>
        <a href="<?= ROOT ?>/admin/certifications" class="nav-item <?= is_active('certifications', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            Certifications
        </a>
        <a href="<?= ROOT ?>/admin/escrowManagement" class="nav-item <?= is_active('escrowManagement', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            Escrow
        </a>
        <a href="<?= ROOT ?>/admin/payouts" class="nav-item <?= is_active('payouts', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>
            Payouts
        </a>

        <div class="nav-group-label">System</div>
        <a href="<?= ROOT ?>/admin/reports" class="nav-item <?= is_active('reports', $current_page) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            Reports
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="profile-avatar">
            <?php
                $name = $_SESSION['username'] ?? 'A';
                echo strtoupper(substr($name, 0, 1));
            ?>
        </div>
        <div class="avatar-info">
            <p><a href="<?= ROOT ?>/profile/index" style="text-decoration: none; color: inherit;"><?= $_SESSION['username'] ?? 'Admin' ?></a></p>
        </div>
    </div>
</aside>
