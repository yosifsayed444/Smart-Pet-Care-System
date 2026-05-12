<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">

    
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    
    <main class="main-content">

        <div class="page-header">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Welcome back, <?php echo $data['username'] ?? 'No name' ?></p>
            </div>
            <a href="<?= ROOT ?>/auth/logout" class="btn-pill btn-red">Logout</a>
        </div>

        
        <div class="stats-row">
            <div class="stat-card">
                <div class="label">Total users</div>
                <div class="value"><?php echo $totalUsers ?? 0 ?></div>
                <div class="delta delta-up">Active</div>
            </div>
            <div class="stat-card">
                <div class="label">Orders</div>
                 <div class="value"><?php echo $totalOrders ?? 0 ?></div>                
                 <div class="delta delta-up">This month</div>
            </div>
            <div class="stat-card">
                <div class="label">Appointments</div>
                <div class="value"><?php echo $totalAppointments ?? 0 ?></div>
                <div class="delta">Upcoming</div>
            </div>
            <div class="stat-card">
                <div class="label">Services</div>
                <div class="value"><?php echo $totalServices ?? 0 ?></div>
                <div class="delta">Upcoming</div>
            </div>
        </div>

        
        <div class="cards-grid">

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#185FA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <span class="dash-card-title">Users management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/users"   class="btn-pill btn-blue">View users</a>
                    <a href="<?php echo ROOT ?>/admin/addUser" class="btn-pill btn-green">Add user</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </div>
                    <span class="dash-card-title">Products management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/products"   class="btn-pill btn-blue">Manage</a>
                    <a href="<?php echo ROOT ?>/admin/addProduct" class="btn-pill btn-green">Add product</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#854F0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                    </div>
                    <span class="dash-card-title">Orders management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/orders" class="btn-pill btn-blue">View orders</a>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22543D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>
                    </div>
                    <span class="dash-card-title">Payouts management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/payouts" class="btn-pill btn-green">View payouts</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <span class="dash-card-title">Appointments management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/appointments" class="btn-pill btn-blue">Manage</a>
                </div>
            </div>
            
            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <span class="dash-card-title">Services management</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/services" class="btn-pill btn-blue">Manage</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#854F0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    </div>
                    <span class="dash-card-title">Notifications</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/notificationEscalator" class="btn-pill btn-blue">All notifications</a>
                    <a href="<?php echo ROOT ?>/admin/healthAlerts"           class="btn-pill btn-amber">Health alerts</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    </div>
                    <span class="dash-card-title">Lost pet</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/lostPetBroadcast" class="btn-pill btn-red">Broadcast alert</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                    </div>
                    <span class="dash-card-title">Suspended users</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/suspendUsers" class="btn-pill btn-red">Suspend users</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <span class="dash-card-title">User verification</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/verifyUsers" class="btn-pill btn-green">Verify users</a>
                </div>
            </div>

            
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="card-icon i-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <span class="dash-card-title">Reports</span>
                </div>
                <div class="dash-card-actions">
                    <a href="<?php echo ROOT ?>/admin/reports"            class="btn-pill btn-blue">Dashboard</a>
                    <a href="<?php echo ROOT ?>/admin/salesReport"        class="btn-pill btn-green">Sales</a>
                    <a href="<?php echo ROOT ?>/admin/userReport"         class="btn-pill btn-teal">Users</a>
                    <a href="<?php echo ROOT ?>/admin/appointmentReport"  class="btn-pill btn-amber">Appointments</a>
                </div>
            </div>

        </div>

    </main>

</div>
