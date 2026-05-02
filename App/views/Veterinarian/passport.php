<?php require __DIR__ . '/../layouts/header.php'; ?>


<div class="container">
    <div class="text-right mt-4">
        <button onclick="window.print()" class="btn btn-dark btn-print"><i class="fa fa-print mr-2"></i> Print Passport</button>
    </div>
    
    <div class="passport-container">
        <div class="stamp">OFFICIAL<br>VET STAMP<br><?= date('Y-m-d') ?></div>
        
        <div class="passport-header">
            <img src="<?= ROOT ?>/assets/images/logo.png" width="50" class="mb-2" alt="">
            <h1>Pet Travel Passport</h1>
            <p class="text-muted">International Veterinary Certificate of Health</p>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="passport-photo">
                    <i class="flaticon-dog"></i>
                </div>
            </div>
        </div>

        
        <div class="info-section">
            <h5>I. Identification of Animal</h5>
            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <span><?= htmlspecialchars($pet['PetName']) ?></span>
                </div>
                <div class="info-item">
                    <label>Species</label>
                    <span><?= htmlspecialchars($pet['Species']) ?></span>
                </div>
                <div class="info-item">
                    <label>Age</label>
                    <span><?= htmlspecialchars($pet['Age']) ?> Years</span>
                </div>
                <div class="info-item">
                    <label>Gender</label>
                    <span><?= htmlspecialchars($pet['Gender']) ?></span>
                </div>
                <div class="info-item">
                    <label>Weight</label>
                    <span><?= htmlspecialchars($pet['Weight']) ?> KG</span>
                </div>
                <div class="info-item">
                    <label>Microchip/ID</label>
                    <span>#PET-<?= str_pad($pet['PetID'], 6, '0', STR_PAD_LEFT) ?></span>
                </div>
            </div>
        </div>

        
        <div class="info-section">
            <h5>II. Vaccination Against Rabies & Others</h5>
            <table class="table table-sm table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>Vaccine Name</th>
                        <th>Date Administered</th>
                        <th>Valid Until</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vaccinations)): ?>
                        <?php foreach ($vaccinations as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['VaccineName']) ?></td>
                                <td><?= htmlspecialchars($v['VaccinationDate']) ?></td>
                                <td><?= htmlspecialchars($v['NextDate']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center">No vaccination records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="info-section">
            <h5>III. Clinical Examination & Health Notes</h5>
            <?php if (!empty($medNotes)): ?>
                <?php foreach (array_slice($medNotes, 0, 3) as $note): ?>
                    <div class="mb-2 p-2 border-bottom">
                        <small class="text-muted d-block"><?= htmlspecialchars($note['RecordDate']) ?></small>
                        <strong>Result:</strong> <?= htmlspecialchars($note['Diagnosis']) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="small text-center italic">No clinical examination notes found.</p>
            <?php endif; ?>
        </div>

        <div class="mt-5 pt-4 border-top">
            <div class="row">
                <div class="col-6">
                    <p class="small mb-0">Authorized Veterinarian ID:</p>
                    <p><strong>VET-<?= str_pad($vetId, 4, '0', STR_PAD_LEFT) ?></strong></p>
                </div>
                <div class="col-6 text-right">
                    <p class="small mb-4 text-muted italic">Electronic Signature and Validation</p>
                    <div style="font-family: 'Dancing Script', cursive; font-size: 1.5rem;">Verified Digital Passport</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
