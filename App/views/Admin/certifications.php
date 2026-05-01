<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="d-flex" id="wrapper">
    
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    
    <div id="page-content-wrapper" class="w-100 bg-light">
        <div class="container-fluid py-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0 text-gray-800"><i class="fa fa-certificate text-primary"></i> Provider Certifications Verification</h2>
            </div>

            <div class="card shadow mb-4 border-0">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Certifications</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Submitted Date</th>
                                    <th>Provider Name</th>
                                    <th>Certification</th>
                                    <th>Document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($certifications)): ?>
                                    <?php foreach ($certifications as $cert): ?>
                                        <tr>
                                            <td><?= htmlspecialchars(date('M j, Y g:i A', strtotime($cert['SubmittedAt']))) ?></td>
                                            <td><strong><?= htmlspecialchars($cert['ProviderName']) ?></strong></td>
                                            <td><?= htmlspecialchars($cert['CertName']) ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>/uploads/certifications/<?= htmlspecialchars($cert['FilePath']) ?>" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fa fa-file-pdf-o"></i> View Document
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?= ROOT ?>/admin/verifyCertification/<?= $cert['CertID'] ?>?status=Verified" class="btn btn-sm btn-success" onclick="return confirm('Verify this certification?');">
                                                    <i class="fa fa-check"></i> Verify
                                                </a>
                                                <a href="<?= ROOT ?>/admin/verifyCertification/<?= $cert['CertID'] ?>?status=Rejected" class="btn btn-sm btn-danger" onclick="return confirm('Reject this certification?');">
                                                    <i class="fa fa-times"></i> Reject
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No pending certifications to review.</td>
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

<?php require __DIR__ . '/../layouts/footer.php'; ?>
