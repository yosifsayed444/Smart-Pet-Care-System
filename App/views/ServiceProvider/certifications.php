<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white"><i class="fa fa-certificate"></i> My Certifications</h4>
                        <a href="<?= ROOT ?>/ServiceProvider/dashboard" class="btn btn-sm btn-light">Back to Dashboard</a>
                    </div>
                    <div class="card-body">
                        
                        
                        <div class="bg-light p-4 rounded mb-4 border">
                            <h5 class="mb-3">Upload New Certification</h5>
                            <form action="<?= ROOT ?>/ServiceProvider/uploadCertification" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Certification Name</label>
                                            <input type="text" name="cert_name" class="form-control" placeholder="e.g., Pet First Aid, CPR" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Upload File (PDF/Image)</label>
                                            <input type="file" name="cert_file" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp" required>
                                            <small class="text-muted">Max size: 5MB</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <button type="submit" class="btn btn-success btn-block mt-2">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                        <h5 class="mb-3">Certification History</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date Submitted</th>
                                        <th>Certification Name</th>
                                        <th>File</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($certifications)): ?>
                                        <?php foreach ($certifications as $cert): ?>
                                            <tr>
                                                <td><?= htmlspecialchars(date('M j, Y', strtotime($cert['SubmittedAt']))) ?></td>
                                                <td><strong><?= htmlspecialchars($cert['CertName']) ?></strong></td>
                                                <td>
                                                    <a href="<?= ROOT ?>/uploads/certifications/<?= htmlspecialchars($cert['FilePath']) ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>
                                                </td>
                                                <td>
                                                    <?php if ($cert['Status'] == 'Pending'): ?>
                                                        <span class="badge badge-warning text-white"><i class="fa fa-clock-o"></i> Pending Review</span>
                                                    <?php elseif ($cert['Status'] == 'Verified'): ?>
                                                        <span class="badge badge-success"><i class="fa fa-check-circle"></i> Verified</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger"><i class="fa fa-times-circle"></i> Rejected</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">No certifications uploaded yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
