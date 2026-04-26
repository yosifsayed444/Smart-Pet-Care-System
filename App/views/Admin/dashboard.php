<?php require __DIR__ . '/../layouts/header.php'; ?>

<style>
    * { box-sizing: border-box; }

    .admin-layout {
        display: flex;
        height: 100vh;
        overflow: hidden;
        background: #f5f5f3;
    }

    /* ── Sidebar ── */
    .sidebar {
        width: 220px;
        min-width: 220px;
        background: #fff;
        border-right: 0.5px solid rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: sticky;
        top: 0;
    }

    .sidebar-logo {
        padding: 18px 16px 14px;
        border-bottom: 0.5px solid rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo-dot {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #185FA5;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .logo-dot svg { width: 15px; height: 15px; }

    .logo-name {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        padding: 8px 0;
    }

    .nav-group-label {
        font-size: 10px;
        font-weight: 600;
        color: #aaa;
        padding: 12px 16px 4px;
        letter-spacing: 0.07em;
        text-transform: uppercase;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 16px;
        font-size: 13px;
        color: #555;
        text-decoration: none;
        transition: background 0.12s, color 0.12s;
        position: relative;
    }

    .nav-item:hover {
        background: #f5f5f3;
        color: #111;
        text-decoration: none;
    }

    .nav-item.active {
        background: #E6F1FB;
        color: #0C447C;
        font-weight: 600;
        border-right: 2px solid #185FA5;
    }

    .nav-item svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .nav-badge {
        margin-left: auto;
        font-size: 10px;
        padding: 1px 7px;
        border-radius: 999px;
        background: #FCEBEB;
        color: #A32D2D;
        font-weight: 600;
    }

    .sidebar-footer {
        padding: 12px 16px;
        border-top: 0.5px solid rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #EEEDFE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #534AB7;
        flex-shrink: 0;
    }

    .avatar-info p  { font-size: 12px; font-weight: 600; color: #111; margin: 0; }
    .avatar-info span { font-size: 11px; color: #888; }

    /* ── Main content ── */
    .main-content {
        flex: 1;
        overflow-y: auto;
        padding: 28px 24px;
    }

    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 20px; font-weight: 600; color: #111; margin: 0 0 4px; }
    .page-header p  { font-size: 13px; color: #888; margin: 0; }

    /* Stats row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 0.5px solid rgba(0,0,0,0.08);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .stat-card .label { font-size: 11px; color: #888; margin-bottom: 4px; }
    .stat-card .value { font-size: 22px; font-weight: 600; color: #111; }
    .stat-card .delta { font-size: 11px; margin-top: 3px; }
    .delta-up   { color: #3B6D11; }
    .delta-down { color: #A32D2D; }

    /* Cards grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .dash-card {
        background: #fff;
        border: 0.5px solid rgba(0,0,0,0.08);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .dash-card-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .card-icon {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .card-icon svg { width: 14px; height: 14px; }

    .dash-card-title {
        font-size: 13px;
        font-weight: 600;
        color: #111;
    }

    .dash-card-actions { display: flex; flex-wrap: wrap; gap: 6px; }

    .btn-pill {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 6px;
        border: 0.5px solid;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
        transition: opacity 0.12s;
    }

    .btn-pill:hover { opacity: 0.75; text-decoration: none; }

    .btn-blue   { background: #E6F1FB; color: #0C447C; border-color: #85B7EB; }
    .btn-green  { background: #EAF3DE; color: #27500A; border-color: #97C459; }
    .btn-amber  { background: #FAEEDA; color: #633806; border-color: #EF9F27; }
    .btn-red    { background: #FCEBEB; color: #791F1F; border-color: #F09595; }
    .btn-gray   { background: #F1EFE8; color: #444441; border-color: #B4B2A9; }
    .btn-teal   { background: #E1F5EE; color: #085041; border-color: #5DCAA5; }
    .btn-purple { background: #EEEDFE; color: #3C3489; border-color: #AFA9EC; }

    .i-blue   { background: #E6F1FB; }
    .i-green  { background: #EAF3DE; }
    .i-amber  { background: #FAEEDA; }
    .i-red    { background: #FCEBEB; }
    .i-teal   { background: #E1F5EE; }
    .i-gray   { background: #F1EFE8; }
    .i-purple { background: #EEEDFE; }
    .i-pink   { background: #FBEAF0; }
</style>

<div class="admin-layout">

    <!-- ══════════ SIDEBAR ══════════ -->
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

            <a href="<?= ROOT ?>/admin/dashboard" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <a href="<?= ROOT ?>/admin/users" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                Users
            </a>

            <a href="<?= ROOT ?>/admin/products" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Products
            </a>

            <a href="<?= ROOT ?>/admin/orders" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                Orders
            </a>

            <a href="<?= ROOT ?>/admin/appointments" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Appointments
            </a>

            <a href="<?= ROOT ?>/admin/messages" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Messages
            </a>

            <div class="nav-group-label">Management</div>

            <a href="<?= ROOT ?>/admin/notificationEscalator" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                Notifications
                <span class="nav-badge">3</span>
            </a>

            <a href="<?= ROOT ?>/admin/lostPetBroadcast" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                Lost pet
            </a>

            <a href="<?= ROOT ?>/admin/manageDisputes" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Disputes
            </a>

            <a href="<?= ROOT ?>/admin/suspendUsers" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                Suspended users
            </a>

            <a href="<?= ROOT ?>/admin/verifyUsers" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                User verification
            </a>

            <div class="nav-group-label">System</div>

            <a href="<?= ROOT ?>/admin/manageRoles" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Roles &amp; permissions
            </a>

            <a href="<?= ROOT ?>/admin/auditLogs" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Audit logs
            </a>

            <a href="<?= ROOT ?>/admin/archiveData" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
                Archive
            </a>

            <a href="<?= ROOT ?>/admin/manageCurrency" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>
                Currency
            </a>

            <a href="<?= ROOT ?>/admin/reports" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                Reports
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="avatar">AD</div>
            <div class="avatar-info">
                <p>Admin</p>
                <span>Super admin</span>
            </div>
        </div>

    </aside>

    <!-- ══════════ MAIN CONTENT ══════════ -->
    <main class="main-content">

        <div class="page-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome back, Admin</p>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="label">Total users</div>
                <div class="value">—</div>
                <div class="delta delta-up">Active</div>
            </div>
            <div class="stat-card">
                <div class="label">Orders</div>
                <div class="value">—</div>
                <div class="delta delta-up">This month</div>
            </div>
            <div class="stat-card">
                <div class="label">Appointments</div>
                <div class="value">—</div>
                <div class="delta">Upcoming</div>
            </div>
            <div class="stat-card">
                <div class="label">Open disputes</div>
                <div class="value">—</div>
                <div class="delta delta-down">Needs action</div>
            </div>
        </div>

        <!-- Quick access cards -->
        <div class="cards-grid">

            <!-- Users -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#185FA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <span class="dash-card-title">Users management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/users"   class="btn-pill btn-blue">View users</a>
                    <a href="<?= ROOT ?>/admin/addUser" class="btn-pill btn-green">Add user</a>
                </div>
            </div>

            <!-- Products -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </div>
                    <span class="dash-card-title">Products</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/products"   class="btn-pill btn-blue">Manage</a>
                    <a href="<?= ROOT ?>/admin/addProduct" class="btn-pill btn-green">Add product</a>
                </div>
            </div>

            <!-- Orders -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#854F0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                    </div>
                    <span class="dash-card-title">Orders</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/orders" class="btn-pill btn-blue">View orders</a>
                </div>
            </div>

            <!-- Appointments -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <span class="dash-card-title">Appointments</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/appointments" class="btn-pill btn-blue">Manage</a>
                </div>
            </div>

            <!-- Notifications -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#854F0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    </div>
                    <span class="dash-card-title">Notifications</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/notificationEscalator" class="btn-pill btn-blue">All notifications</a>
                    <a href="<?= ROOT ?>/admin/healthAlerts"           class="btn-pill btn-amber">Health alerts</a>
                </div>
            </div>

            <!-- Lost pet -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    </div>
                    <span class="dash-card-title">Lost pet</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/lostPetBroadcast" class="btn-pill btn-red">Broadcast alert</a>
                </div>
            </div>

            <!-- Disputes -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-pink">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#993556" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <span class="dash-card-title">Disputes</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/manageDisputes" class="btn-pill btn-blue">Manage disputes</a>
                </div>
            </div>

            <!-- Audit logs -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-gray">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#5F5E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <span class="dash-card-title">Audit logs</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/auditLogs" class="btn-pill btn-gray">View logs</a>
                </div>
            </div>

            <!-- Suspended users -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                    </div>
                    <span class="dash-card-title">Suspended users</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/suspendUsers" class="btn-pill btn-red">Suspend users</a>
                </div>
            </div>

            <!-- Archive -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-gray">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#5F5E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
                    </div>
                    <span class="dash-card-title">Archive</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/archiveData" class="btn-pill btn-gray">Archive data</a>
                </div>
            </div>

            <!-- Currency -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#3B6D11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>
                    </div>
                    <span class="dash-card-title">Currency</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/manageCurrency" class="btn-pill btn-blue">Manage currency</a>
                </div>
            </div>

            <!-- User verification -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <span class="dash-card-title">User verification</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/verifyUsers" class="btn-pill btn-green">Verify users</a>
                </div>
            </div>

            <!-- Messages -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#185FA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </div>
                    <span class="dash-card-title">Messages</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/messages" class="btn-pill btn-green">View messages</a>
                </div>
            </div>

            <!-- Reports -->
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <span class="dash-card-title">Reports</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?= ROOT ?>/admin/reports"            class="btn-pill btn-blue">Dashboard</a>
                    <a href="<?= ROOT ?>/admin/salesReport"        class="btn-pill btn-green">Sales</a>
                    <a href="<?= ROOT ?>/admin/userReport"         class="btn-pill btn-teal">Users</a>
                    <a href="<?= ROOT ?>/admin/appointmentReport"  class="btn-pill btn-amber">Appointments</a>
                </div>
            </div>

        </div>

    </main>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>