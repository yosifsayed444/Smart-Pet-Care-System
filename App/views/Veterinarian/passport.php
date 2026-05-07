<?php require __DIR__ . '/../layouts/header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="container">
    <div class="text-right mt-4 no-print">
        <button id="download-pdf" class="btn btn-danger btn-print shadow-sm">
            <i class="fa fa-file-pdf-o mr-2"></i> Download Official PDF Passport
        </button>
            <a href="<?= ROOT ?>/petowner/dashboard" class="btn btn-secondary btn-print shadow-sm"> Back to dashboard</a>
        
    </div>
    
    <div id="passport-content">
        <div class="passport-container">            
            <div class="passport-header">
                <img src="<?= ROOT ?>/assets/images/logo.png" width="50" class="mb-2" alt="">
                <h1>Pet Travel Passport</h1>
            </div>

        
        <div class="info-section">
            <h5> Identification of Animal</h5>
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
                
            </div>
        </div>
        <div class="info-section">
            <h5> Owner Information</h5>
            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <span><?= htmlspecialchars($user['username']) ?></span>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <span><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="info-item">
                    <label>Phone</label>
                    <span><?= htmlspecialchars($user['phone']) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('download-pdf').addEventListener('click', function() {
        const element = document.getElementById('passport-content');
        const opt = {
            margin:       0.5,
            filename:     'Pet-Passport-<?= $pet['PetName'] ?>.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    });
</script>
