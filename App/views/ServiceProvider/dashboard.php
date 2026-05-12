<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="dashboard-wrapper">
    <div class="container-fluid px-md-5">
        
        <div class="row mb-5 align-items-center">
            <div class="col-md-8">
                <h1 class="font-weight-800" style="font-size: 2.8rem; letter-spacing: -0.04em;">Service Provider Dashboard</h1>
                <p class="text-muted">Welcome back, <?= htmlspecialchars($_SESSION['username'] ?? 'Provider') ?>! Manage your services and track your performance.</p>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="<?= ROOT ?>/ServiceProvider/analytics" class="btn btn-primary rounded-pill px-4 shadow-sm py-2">
                    <i class="fa fa-bar-chart mr-2"></i> Analytics
                </a>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-xl mb-4 border-0 shadow-sm">
                <i class="fa fa-check-circle mr-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-xl mb-4 border-0 shadow-sm">
                <i class="fa fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="row">
            
            <div class="col-lg-3 mb-4">
                <div class="premium-card">
                    <div class="section-header">
                        <h5 class="font-weight-bold mb-0">Dashboard Menu</h5>
                    </div>
                    <ul class="nav nav-pills nav-pills-custom flex-column" id="sitterTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#bookings-pane">
                                <i class="fa fa-list"></i> Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#services-pane">
                                <i class="fa fa-cogs"></i> Pricing Engine
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#schedule-pane">
                                <i class="fa fa-calendar"></i> Availability
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#reviews-pane">
                                <i class="fa fa-star"></i> Reviews
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#certs-pane">
                                <i class="fa fa-certificate"></i> Certifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#emergency-pane">
                                <i class="fa fa-bullhorn text-danger"></i> Community Alerts
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            
            <div class="col-lg-9">
                <div class="tab-content" id="sitterTabsContent">
                    
                    
                    <div class="tab-pane fade show active" id="bookings-pane">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="font-weight-bold mb-0">Recent Service Bookings</h4>
                            <a href="<?= ROOT ?>/ServiceProvider/bookings" class="btn btn-light btn-sm rounded-pill px-3 border">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-premium">
                                <thead>
                                    <tr class="text-muted small text-uppercase">
                                        <th>Pet & Owner</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentBookings)): ?>
                                        <?php foreach (array_slice($recentBookings, 0, 8) as $booking): ?>
                                            <tr>
                                                <td>
                                                    <span class="d-block font-weight-800 text-dark"><?= htmlspecialchars($booking['PetName']) ?></span>
                                                    <small class="text-muted">Owner: <?= htmlspecialchars($booking['owner_name']) ?></small>
                                                </td>
                                                <td>
                                                    <span class="d-block font-weight-bold"><?= date('M d, Y', strtotime($booking['BookingDate'])) ?></span>
                                                    <small class="text-muted"><?= date('h:i A', strtotime($booking['StartTime'])) ?></small>
                                                </td>
                                                <td>
                                                    <?php
                                                        $status = $booking['status'] ?? 'Under Review';
                                                        $cls = $status === 'Accepted' ? 'success' : ($status === 'Rejected' ? 'danger' : 'secondary');
                                                    ?>
                                                    <span class="stat-badge bg-light text-<?= $cls ?>"><?= $status ?></span>
                                                </td>
                                                <td class="text-right">
                                                    <?php if ($status === 'Under Review'): ?>
                                                        <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Accepted"
                                                           class="btn btn-sm btn-success rounded-pill px-3 mr-1">Accept</a>
                                                        <a href="<?= ROOT ?>/ServiceProvider/updateBookingStatus/<?= $booking['BookingID'] ?>/Rejected"
                                                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                           onclick="return confirm('Reject this booking?')">Reject</a>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-glass mr-2" data-toggle="modal" data-target="#petDetails<?= $booking['BookingID'] ?>">
                                                            <i class="fa fa-info-circle mr-1"></i> Details
                                                            <?php if (!empty($booking['HandlingInstructions'])): ?>
                                                                <span class="badge badge-danger ml-1" title="Safety Instructions Included">!</span>
                                                            <?php endif; ?>
                                                        </button>
                                                        <?php if ($status === 'Completed'): ?>
                                                            <button class="btn btn-sm btn-warning rounded-pill px-3 font-weight-bold" data-toggle="modal" data-target="#rateOwner<?= $booking['BookingID'] ?>">
                                                                <i class="fa fa-star mr-1"></i> Rate
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center py-5 text-muted">No bookings found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="services-pane">
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="font-weight-bold mb-3">Add New Service</h4>
                                <form action="<?= ROOT ?>/ServiceProvider/addService" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded-xl border">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Service Name</label>
                                        <input type="text" name="name" class="form-control rounded-lg" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Tier</label>
                                        <select name="tier" class="form-control rounded-lg" required>
                                            <option value="Basic">Basic</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Premium">Premium</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Base Price (EGP)</label>
                                        <input type="number" name="price" class="form-control rounded-lg" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Image</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold mt-3">Create Service</button>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <h4 class="font-weight-bold mb-3">Active Services</h4>
                                <div class="table-responsive">
                                    <table class="table table-premium">
                                        <thead>
                                            <tr class="text-muted small">
                                                <th>Service</th>
                                                <th>Tier</th>
                                                <th>Price</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($services) && is_array($services)): ?>
                                                <?php foreach ($services as $service): ?>
                                                    <tr>
                                                        <td class="font-weight-bold"><?= htmlspecialchars($service['name']) ?></td>
                                                        <td><span class="badge badge-light border"><?= htmlspecialchars($service['tier']) ?></span></td>
                                                        <td class="text-primary font-weight-bold"><?= number_format($service['price'], 2) ?> EGP</td>
                                                        <td class="text-right">
                                                            <a href="<?= ROOT ?>/ServiceProvider/deleteService/<?= $service['id'] ?>" class="text-danger" onclick="return confirm('Delete this service?')"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="4" class="text-center py-4 text-muted">No active services. Add your first service above.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="schedule-pane">
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="font-weight-bold mb-3">Set Availability</h4>
                                <form action="<?= ROOT ?>/ServiceProvider/setAvailability" method="POST" class="bg-light p-4 rounded-xl border">
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Select Date</label>
                                        <input type="date" name="date" class="form-control rounded-lg" required min="<?= date('Y-m-d') ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="small font-weight-bold">Start Time</label>
                                                <input type="time" name="start_time" class="form-control rounded-lg" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="small font-weight-bold">End Time</label>
                                                <input type="time" name="end_time" class="form-control rounded-lg" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block rounded-pill text-white font-weight-bold mt-2">Update Schedule</button>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <h4 class="font-weight-bold mb-3">Current Slots</h4>
                                <?php if (!empty($availability)): ?>
                                    <div class="list-group">
                                        <?php foreach ($availability as $slot): ?>
                                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 mb-2 rounded-xl bg-light">
                                                <div>
                                                    <span class="font-weight-bold"><?= date('M d, Y', strtotime($slot['available_date'])) ?></span>
                                                    <span class="text-muted ml-2"><?= $slot['start_time'] ?> - <?= $slot['end_time'] ?></span>
                                                </div>
                                                <a href="<?= ROOT ?>/ServiceProvider/deleteSchedule/<?= $slot['id'] ?>" class="text-danger"><i class="fa fa-times-circle"></i></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">No availability slots set.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="reviews-pane">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="font-weight-bold mb-0">Community Feedback</h4>
                            <div class="badge badge-warning p-2 px-3 rounded-pill">
                                <i class="fa fa-star mr-1"></i> Recursive Review System Active
                            </div>
                        </div>
                        
                        <?php if (!empty($reviews)): ?>
                            <div class="row">
                                                <?php foreach ($reviews as $review): ?>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="premium-card h-100 bg-light border-0 shadow-sm">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <div>
                                                                    <span class="d-block font-weight-bold"><?= htmlspecialchars($review['reviewer_name'] ?? 'Pet Owner') ?></span>
                                                                    <small class="text-muted"><?= date('M d, Y', strtotime($review['CreatedAt'] ?? 'now')) ?></small>
                                                                </div>
                                                                <div class="text-warning">
                                                                    <?php for($i=0; $i<5; $i++): ?>
                                                                        <i class="fa <?= $i < ($review['Rating'] ?? 0) ? 'fa-star' : 'fa-star-o' ?>"></i>
                                                                    <?php endfor; ?>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0 font-italic text-dark">"<?= htmlspecialchars($review['Comment'] ?? 'No comment provided.') ?>"</p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fa fa-commenting-o fa-3x text-muted mb-3 opacity-25"></i>
                                <p class="text-muted">You haven't received any reviews from pet owners yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="tab-pane fade" id="certs-pane">
                        <div class="text-center py-5">
                            <i class="fa fa-certificate fa-4x text-primary mb-4 opacity-25"></i>
                            <h4 class="font-weight-bold">Professional Certifications</h4>
                            <p class="text-muted mx-auto" style="max-width: 500px;">Upload your professional credentials to earn the Verified Provider badge and increase your booking rate by up to 40%.</p>
                            <a href="<?= ROOT ?>/ServiceProvider/certifications" class="btn btn-primary rounded-pill px-5 py-2 font-weight-bold mt-3 shadow">Manage Credentials</a>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="emergency-pane">
                        <div class="bg-danger-light p-4 rounded-xl border border-danger mb-4" style="background: rgba(231, 76, 60, 0.05);">
                            <h5 class="text-danger font-weight-bold mb-1"><i class="fa fa-bullhorn mr-2"></i>Lost Pet Community Network</h5>
                            <p class="text-muted small">Stay alert! These pets are missing in your area. Report any sightings immediately.</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-premium">
                                <thead>
                                    <tr class="text-muted small text-uppercase">
                                        <th>Location</th>
                                        <th>Pet & Description</th>
                                        <th>Date Reported</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($lostPets)): ?>
                                        <?php foreach ($lostPets as $lp): ?>
                                            <tr>
                                                <td><span class="font-weight-bold text-danger"><i class="fa fa-map-marker mr-2"></i><?= htmlspecialchars($lp['Location']) ?></span></td>
                                                <td>
                                                    <span class="d-block font-weight-bold"><?= htmlspecialchars($lp['PetName'] ?? 'Unknown Pet') ?></span>
                                                    <small class="text-muted"><?= htmlspecialchars($lp['Description']) ?></small>
                                                </td>
                                                <td><?= date('M d, Y', strtotime($lp['DateReported'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="text-center py-5 text-muted">No active community alerts.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php if(!empty($recentBookings)): ?>
    <?php foreach($recentBookings as $booking): ?>
        <div class="modal fade" id="petDetails<?= $booking['BookingID'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="modal-header bg-info text-white border-0 py-4" style="border-radius: 20px 20px 0 0;">
                        <h5 class="modal-title font-weight-800 ml-3"><i class="fa fa-paw mr-2"></i><?= htmlspecialchars($booking['PetName']) ?>'s Behavioral Profile</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <h6 class="text-uppercase tracking-widest text-danger font-weight-bold small mb-2">Special Handling</h6>
                            <div class="bg-light p-3 rounded-lg border"><?= !empty($booking['HandlingInstructions']) ? htmlspecialchars($booking['HandlingInstructions']) : 'No special instructions.' ?></div>
                        </div>
                        <div>
                            <h6 class="text-uppercase tracking-widest text-primary font-weight-bold small mb-2">Behavior Notes</h6>
                            <div class="bg-light p-3 rounded-lg border"><?= !empty($booking['BehaviorNotes']) ? htmlspecialchars($booking['BehaviorNotes']) : 'No specific behavior notes recorded.' ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(($booking['status'] ?? '') == 'Completed'): ?>
            <div class="modal fade" id="rateOwner<?= $booking['BookingID'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="modal-header bg-warning text-dark border-0 py-4" style="border-radius: 20px 20px 0 0;">
                            <h5 class="modal-title font-weight-800 ml-3"><i class="fa fa-star mr-2"></i>Rate Pet & Owner</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form action="<?= ROOT ?>/ServiceProvider/submitCommunityReview" method="POST">
                            <div class="modal-body p-4">
                                <input type="hidden" name="booking_id" value="<?= $booking['BookingID'] ?>">
                                <input type="hidden" name="reviewee_id" value="<?= $booking['OwnerID'] ?>">
                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-uppercase tracking-wider">Experience Rating</label>
                                    <select name="rating" class="form-control rounded-lg" required style="height: 50px;">
                                        <option value="5">⭐⭐⭐⭐⭐ - Well Behaved / Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ - Good Experience</option>
                                        <option value="3">⭐⭐⭐ - Average</option>
                                        <option value="2">⭐⭐ - Challenging Behavior</option>
                                        <option value="1">⭐ - Difficult / Not Recommended</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small font-weight-bold text-uppercase tracking-wider">Public Comments</label>
                                    <textarea name="comment" class="form-control rounded-lg" rows="4" placeholder="How was the pet's behavior? How was the communication with the owner?" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 p-4">
                                <button type="submit" class="btn btn-warning rounded-pill px-5 font-weight-bold shadow">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
