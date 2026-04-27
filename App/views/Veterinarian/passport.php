<?php require __DIR__ . '/../layouts/header.php'; ?>

<style>
    body { background: #f4f7f6; }
    .passport-container { max-width: 800px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 2px solid #2c3e50; position: relative; overflow: hidden; }
    .passport-header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
    .passport-header h1 { color: #2c3e50; text-transform: uppercase; letter-spacing: 2px; font-weight: 800; }
    .passport-photo { width: 150px; height: 150px; background: #eee; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: #ccc; margin: 0 auto 20px; border: 3px solid #f8f9fa; }
    .info-section { margin-bottom: 30px; }
    .info-section h5 { background: #f8f9fa; padding: 10px; border-left: 5px solid #2c3e50; color: #2c3e50; font-weight: 700; margin-bottom: 15px; }
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .info-item label { color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 2px; display: block; }
    .info-item span { color: #2c3e50; font-weight: 600; font-size: 1.1rem; }
    .stamp { position: absolute; top: 40px; right: 40px; width: 100px; height: 100px; border: 4px double #e74c3c; border-radius: 50%; display: flex; align-items: center; justify-content: center; transform: rotate(15deg); color: #e74c3c; font-weight: 800; opacity: 0.6; text-align: center; font-size: 0.7rem; line-height: 1; }
    @media print { .btn-print { display: none; } .passport-container { box-shadow: none; border: 1px solid #000; margin: 0; width: 100%; } }
</style>

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

        <!-- Section 1: Identification of Pet -->
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

        <!-- Section 2: Vaccination Records -->
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

        <!-- Section 3: Clinical Examination -->
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
