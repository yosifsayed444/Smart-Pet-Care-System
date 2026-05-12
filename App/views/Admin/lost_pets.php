<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
                <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            <h2 class="mb-4">Lost Pet Broadcast System</h2>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger text-white">Broadcast New Alert</div>
                <div class="card-body">
                    <form method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Select Pet</label>
                                <select name="pet_id" class="form-control" required>
                                    <option value="">-- Select a Pet --</option>
                                    <?php if (! empty($data['pets'])): ?>
                                    <?php foreach ($data['pets'] as $pet): ?>
                                        <option value="<?php echo $pet['PetID'] ?>"><?php echo htmlspecialchars($pet['PetName']) ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Last Seen Location</label>
                                <input type="text" name="location" class="form-control" placeholder="e.g. Maadi, Cairo" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="1" placeholder="Golden Retriever, red collar..." required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Broadcast Alert to All Users</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">Recent Alerts</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pet ID</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (! empty($data['lostPets'])): ?>
                                    <?php foreach ($data['lostPets'] as $lp): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($lp['PetName'] ?? 'Unknown Pet') ?> (ID: <?php echo $lp['PetID'] ?>)</td>
                                            <td><?php echo htmlspecialchars($lp['Location']) ?></td>
                                            <td><?php echo htmlspecialchars($lp['Description']) ?></td>
                                            <td><span class="badge badge-warning"><?php echo $lp['Status'] ?></span></td>
                                            <td><?php echo $lp['DateReported'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

