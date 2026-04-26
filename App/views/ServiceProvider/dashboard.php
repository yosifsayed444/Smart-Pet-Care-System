<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Service Provider Dashboard</h1>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="card p-4 shadow-sm mb-4">
                <h4>Welcome <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Provider'; ?> </h4>
                <p>Manage your services, availability, and reviews below.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tiered Service Pricing Engine -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tiered Service Pricing Engine</h5>
                </div>
                <div class="card-body">
                    <form action="/SE1_Project/public/ServiceProvider/addService" method="POST" class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Service Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tier</label>
                                <select name="tier" class="form-select">
                                    <option value="Basic">Basic</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Price ($)</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Add Service</button>
                    </form>
                    <hr>
                    <h6>Your Services</h6>
                    <table class="table table-sm mt-3">
                        <thead>
                            <tr><th>Name</th><th>Tier</th><th>Price</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($services)): ?>
                                <?php foreach($services as $service): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($service['name']); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($service['tier']); ?></span></td>
                                    <td>$<?php echo number_format($service['price'], 2); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updatePriceModal<?php echo $service['id']; ?>">Update</button>
                                        
                                        <!-- Update Price Modal -->
                                        <div class="modal fade" id="updatePriceModal<?php echo $service['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title">Update Price for <?php echo htmlspecialchars($service['name']); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="/SE1_Project/public/ServiceProvider/updateServicePrice" method="POST">
                                                  <div class="modal-body">
                                                    <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                                    <div class="form-group">
                                                        <label>New Price ($)</label>
                                                        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $service['price']; ?>" required>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                  </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted">No services added yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Availability Conflict Resolver -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Availability & Conflicts</h5>
                </div>
                <div class="card-body">
                    <form action="/SE1_Project/public/ServiceProvider/setAvailability" method="POST" class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info text-white w-100">Set Availability</button>
                    </form>
                    <hr>
                    <h6>Your Schedule</h6>
                    <ul class="list-group mb-3">
                        <?php if(!empty($availability)): ?>
                            <?php foreach($availability as $slot): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($slot['available_date']); ?>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo htmlspecialchars($slot['start_time']); ?> - <?php echo htmlspecialchars($slot['end_time']); ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-center text-muted">No availability set.</li>
                        <?php endif; ?>
                    </ul>

                    <h6>Simulated Conflicts</h6>
                    <?php if(!empty($conflictBooking)): ?>
                        <div class="alert alert-warning py-2 mb-2">
                            <strong>Conflict detected!</strong>
                            Booking #<?php echo htmlspecialchars($conflictBooking['BookingID']); ?> has a scheduling issue.
                            <button class="btn btn-sm btn-danger float-end" data-toggle="modal" data-target="#resolveConflictModal">Resolve</button>
                        </div>
                        
                        <!-- Resolve Conflict Modal (only when conflict exists) -->
                        <div class="modal fade" id="resolveConflictModal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">
                                    Resolve Conflict for Booking #<?php echo htmlspecialchars($conflictBooking['BookingID']); ?>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="/SE1_Project/public/ServiceProvider/resolveConflict" method="POST">
                                  <div class="modal-body">
                                    <p>Propose a new time for this booking to resolve the overlap.</p>
                                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($conflictBooking['BookingID']); ?>">
                                    <div class="form-group">
                                        <label>New Date</label>
                                        <input type="date" name="new_date" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label>New Start Time</label>
                                            <input type="time" name="new_start_time" class="form-control" required>
                                        </div>
                                        <div class="col form-group">
                                            <label>New End Time</label>
                                            <input type="time" name="new_end_time" class="form-control" required>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Resolve</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>

                    <?php else: ?>
                        <div class="alert alert-success py-2 mb-2">
                            No conflicts detected in your bookings.
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Recursive Review System -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Recursive Review System</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($reviews)): ?>
                        <?php foreach($reviews as $review): ?>
                            <?php if(empty($review['parent_id'])): // Only show parent reviews at the top level ?>
                            <div class="review-item mb-3 p-3 border rounded bg-light">
                                <div class="d-flex justify-content-between">
                                    <strong><?php echo htmlspecialchars($review['user_name'] ?? 'User'); ?></strong>
                                    <span class="text-warning">
                                        <?php for($i=0; $i<$review['rating']; $i++) echo '&#9733;'; ?>
                                        <?php for($i=$review['rating']; $i<5; $i++) echo '&#9734;'; ?>
                                    </span>
                                </div>
                                <p class="mb-1 text-muted">"<?php echo htmlspecialchars($review['comment']); ?>"</p>
                                <button class="btn btn-sm btn-link p-0" data-toggle="collapse" data-target="#replyForm<?php echo $review['id']; ?>">Reply</button>
                                
                                <div class="collapse mt-2" id="replyForm<?php echo $review['id']; ?>">
                                    <form action="/SE1_Project/public/ServiceProvider/replyToReview" method="POST" class="d-flex">
                                        <input type="hidden" name="parent_id" value="<?php echo $review['id']; ?>">
                                        <input type="text" name="comment" class="form-control form-control-sm mr-2" placeholder="Write a reply..." required>
                                        <button type="submit" class="btn btn-sm btn-primary">Post</button>
                                    </form>
                                </div>

                                <!-- Child Replies -->
                                <?php if(!empty($review['replies'])): ?>
                                    <?php foreach($review['replies'] as $reply): ?>
                                    <div class="ms-4 mt-2 p-2 border-start border-3 border-secondary bg-white rounded" style="margin-left: 2rem;">
                                        <strong>You (Provider)</strong>
                                        <p class="mb-0 text-muted">"<?php echo htmlspecialchars($reply['comment']); ?>"</p>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Fallback Example if no reviews exist in DB -->
                        <div class="review-item mb-3 p-3 border rounded bg-light">
                            <div class="d-flex justify-content-between">
                                <strong>John Doe</strong>
                                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                            </div>
                            <p class="mb-1 text-muted">"Great service, my dog loved the walk!"</p>
                            <button class="btn btn-sm btn-link p-0" data-toggle="collapse" data-target="#demoReply">Reply</button>
                            
                            <div class="collapse mt-2" id="demoReply">
                                <form action="/SE1_Project/public/ServiceProvider/replyToReview" method="POST" class="d-flex">
                                    <input type="hidden" name="parent_id" value="1">
                                    <input type="text" name="comment" class="form-control form-control-sm mr-2" placeholder="Write a reply..." required>
                                    <button type="submit" class="btn btn-sm btn-primary">Post</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>