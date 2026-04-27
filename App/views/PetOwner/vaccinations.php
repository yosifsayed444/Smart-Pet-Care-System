<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2>Vaccination History: <?= htmlspecialchars($pet['PetName']) ?></h2>
                <p>Keep track of your pet's immunization schedule.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Date Given</th>
                                    <th>Next Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($vaccinations)): ?>
                                    <?php foreach ($vaccinations as $v): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($v['VaccineName']) ?></strong></td>
                                            <td><?= htmlspecialchars($v['VaccinationDate']) ?></td>
                                            <td><?= htmlspecialchars($v['NextDate']) ?></td>
                                            <td>
                                                <?php 
                                                    $today = date('Y-m-d');
                                                    if ($v['NextDate'] < $today) {
                                                        echo '<span class="badge badge-danger">Overdue</span>';
                                                    } elseif ($v['NextDate'] <= date('Y-m-d', strtotime('+30 days'))) {
                                                        echo '<span class="badge badge-warning">Due Soon</span>';
                                                    } else {
                                                        echo '<span class="badge badge-success">Up to Date</span>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center">No vaccination records found for this pet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="<?= ROOT ?>/petowner/pets" class="btn btn-outline-primary"><i class="fa fa-arrow-left mr-1"></i> Back to My Pets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
