<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>





<section class="ftco-section bg-light">
  <div class="container">

    
    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle mr-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="row">

      
      <div class="col-md-4 mb-4">
        <div class="form-card">
          <h4 class="mb-4"><i class="fa fa-plus-circle text-primary mr-2"></i>Add New Pet</h4>
          <form id="addPetForm" action="<?= ROOT ?>/petowner/pets" method="POST" novalidate>

            
            <div class="form-group mb-3">
              <label class="font-weight-bold">Pet Name <span class="text-danger">*</span></label>
              <input type="text" id="petName" name="name" class="form-control"
                     placeholder="e.g. Max" minlength="2" maxlength="50" required>
              <div class="field-error" id="nameError">Pet name is required (2–50 characters).</div>
            </div>

            
            <div class="form-group mb-3">
              <label class="font-weight-bold">Species <span class="text-danger">*</span></label>
              <select id="petSpecies" name="species" class="form-control" required>
                <option value="">-- Select Species --</option>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Bird">Bird</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Other">Other</option>
              </select>
              <div class="field-error" id="speciesError">Please select a species.</div>
            </div>

            
            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label class="font-weight-bold">Age (Years) <span class="text-danger">*</span></label>
                <input type="number" id="petAge" name="age" class="form-control"
                       placeholder="0" min="0" max="50" required>
                <div class="field-error" id="ageError">Age must be between 0 and 50.</div>
              </div>
              <div class="col-md-6 form-group mb-3">
                <label class="font-weight-bold">Gender <span class="text-danger">*</span></label>
                <select id="petGender" name="gender" class="form-control" required>
                  <option value="">-- Select --</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <div class="field-error" id="genderError">Please select a gender.</div>
              </div>
            </div>

            
            <div class="form-group mb-3">
              <label class="font-weight-bold">Weight (kg)</label>
              <input type="number" id="petWeight" name="weight" class="form-control"
                     placeholder="e.g. 5.2" step="0.01" min="0" max="500">
              <div class="field-error" id="weightError">Weight must be between 0 and 500 kg.</div>
            </div>

            
            <div class="form-group mb-3">
              <label class="font-weight-bold">Allergies</label>
              <textarea id="petAllergies" name="allergies" class="form-control"
                        rows="3" maxlength="255"
                        placeholder="Any known allergies..."></textarea>
              <div class="char-count"><span id="allergyCount">0</span>/255</div>
              <div class="field-error" id="allergiesError">Max 255 characters.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100 font-weight-bold">
              <i class="fa fa-plus mr-1"></i> Add Pet
            </button>
          </form>
        </div>
      </div>

      
      <div class="col-md-8">
        <h4 class="mb-4"><i class="fa fa-paw text-secondary mr-2"></i>Your Pets</h4>
        <div class="row">
          <?php if (!empty($pets)): ?>
            <?php foreach ($pets as $pet): ?>
              <div class="col-md-6">
                <div class="pet-card">
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="mb-0"><?= htmlspecialchars($pet['PetName']) ?></h5>
                    <span class="badge badge-info badge-pill px-3 py-1"><?= htmlspecialchars($pet['Species']) ?></span>
                  </div>

                  <p class="mb-1 small text-muted">
                    <i class="fa fa-venus-mars mr-1"></i><strong>Gender:</strong> <?= htmlspecialchars($pet['Gender']) ?> &nbsp;|&nbsp;
                    <i class="fa fa-birthday-cake mr-1"></i><strong>Age:</strong> <?= htmlspecialchars($pet['Age']) ?> yr
                  </p>
                  <?php if (!empty($pet['Weight'])): ?>
                  <p class="mb-1 small text-muted">
                    <i class="fa fa-balance-scale mr-1"></i><strong>Weight:</strong> <?= htmlspecialchars($pet['Weight']) ?> kg
                  </p>
                  <?php endif; ?>
                  <p class="mb-3 small text-muted">
                    <i class="fa fa-medkit mr-1"></i><strong>Allergies:</strong>
                    <?= !empty($pet['Allergies']) ? htmlspecialchars($pet['Allergies']) : '<em>None</em>' ?>
                  </p>

                  <hr class="my-2">

                  
                  <div class="mb-3">
                    <label class="small font-weight-bold text-uppercase text-primary mb-1">Medical Center</label>
                    <div class="row no-gutters text-center">
                      <div class="col-3">
                        <a href="<?= ROOT ?>/petowner/vaccinations/<?= $pet['PetID'] ?>" title="Vaccinations">
                          <i class="fa fa-shield fa-lg d-block mb-1 text-info"></i><small>Vax</small>
                        </a>
                      </div>
                      <div class="col-3">
                        <a href="<?= ROOT ?>/petowner/prescriptions/<?= $pet['PetID'] ?>" title="Prescriptions">
                          <i class="fa fa-file-text-o fa-lg d-block mb-0 text-success"></i><small>Rx</small>
                        </a>
                      </div>
                      <div class="col-3">
                        <a href="<?= ROOT ?>/petowner/labResults/<?= $pet['PetID'] ?>" title="Lab Results">
                          <i class="fa fa-flask fa-lg d-block mb-0 text-success"></i><small>Lab Results</small>
                        </a>
                      </div>
                      <div class="col-3">
                        <a href="<?= ROOT ?>/petowner/medicalNotes/<?= $pet['PetID'] ?>" title="Medical Notes">
                          <i class="fa fa-stethoscope fa-lg d-block mb-1 text-success"></i><small>M.Notes</small>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between align-items-center mt-2">
                
                    <a href="<?= ROOT ?>/petowner/deletePet/<?= $pet['PetID'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to permanently remove <?= htmlspecialchars(addslashes($pet['PetName'])) ?>? This cannot be undone.')">
                      <i class="fa fa-trash"></i>
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12">
              <div class="alert alert-warning text-center py-5">
                <h5><i class="fa fa-exclamation-triangle mr-2"></i>No pets found.</h5>
                <p class="mb-0">Use the form on the left to register your first pet.</p>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <div class="mt-3 text-center">
          <a href="<?= ROOT ?>/petowner/index" class="btn btn-outline-primary mr-2">
            <i class="fa fa-tachometer mr-1"></i> Dashboard
          </a>
          <a href="<?= ROOT ?>/ServiceProvider/services" class="btn btn-success">
            <i class="fa fa-calendar mr-1"></i> Book a Service
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<script>
(function () {
    const form       = document.getElementById('addPetForm');
    const petName    = document.getElementById('petName');
    const petSpecies = document.getElementById('petSpecies');
    const petAge     = document.getElementById('petAge');
    const petGender  = document.getElementById('petGender');
    const petWeight  = document.getElementById('petWeight');
    const petAllergies = document.getElementById('petAllergies');
    const allergyCount = document.getElementById('allergyCount');

    // Live char counter for allergies
    petAllergies.addEventListener('input', function () {
        allergyCount.textContent = this.value.length;
    });

    function showError(input, errorId, msg) {
        input.classList.add('is-invalid');
        const el = document.getElementById(errorId);
        el.textContent = msg;
        el.style.display = 'block';
    }

    function clearError(input, errorId) {
        input.classList.remove('is-invalid');
        const el = document.getElementById(errorId);
        el.style.display = 'none';
    }

    // Real-time field validation
    petName.addEventListener('blur', function () {
        const v = this.value.trim();
        if (!v) showError(this, 'nameError', 'Pet name is required.');
        else if (v.length < 2 || v.length > 50) showError(this, 'nameError', 'Name must be 2–50 characters.');
        else clearError(this, 'nameError');
    });

    petSpecies.addEventListener('change', function () {
        if (!this.value) showError(this, 'speciesError', 'Please select a species.');
        else clearError(this, 'speciesError');
    });

    petAge.addEventListener('blur', function () {
        const v = this.value.trim();
        if (v === '' || isNaN(v) || Number(v) < 0 || Number(v) > 50)
            showError(this, 'ageError', 'Age must be a number between 0 and 50.');
        else clearError(this, 'ageError');
    });

    petGender.addEventListener('change', function () {
        if (!this.value) showError(this, 'genderError', 'Please select a gender.');
        else clearError(this, 'genderError');
    });

    petWeight.addEventListener('blur', function () {
        const v = this.value.trim();
        if (v !== '' && (isNaN(v) || Number(v) < 0 || Number(v) > 500))
            showError(this, 'weightError', 'Weight must be between 0 and 500 kg.');
        else clearError(this, 'weightError');
    });

    petAllergies.addEventListener('blur', function () {
        if (this.value.length > 255) showError(this, 'allergiesError', 'Max 255 characters.');
        else clearError(this, 'allergiesError');
    });

    // Submit validation
    form.addEventListener('submit', function (e) {
        let valid = true;

        const name = petName.value.trim();
        if (!name) { showError(petName, 'nameError', 'Pet name is required.'); valid = false; }
        else if (name.length < 2 || name.length > 50) { showError(petName, 'nameError', 'Name must be 2–50 characters.'); valid = false; }
        else clearError(petName, 'nameError');

        if (!petSpecies.value) { showError(petSpecies, 'speciesError', 'Please select a species.'); valid = false; }
        else clearError(petSpecies, 'speciesError');

        const age = petAge.value.trim();
        if (age === '' || isNaN(age) || Number(age) < 0 || Number(age) > 50) {
            showError(petAge, 'ageError', 'Age must be a number between 0 and 50.'); valid = false;
        } else clearError(petAge, 'ageError');

        if (!petGender.value) { showError(petGender, 'genderError', 'Please select a gender.'); valid = false; }
        else clearError(petGender, 'genderError');

        const wt = petWeight.value.trim();
        if (wt !== '' && (isNaN(wt) || Number(wt) < 0 || Number(wt) > 500)) {
            showError(petWeight, 'weightError', 'Weight must be between 0 and 500 kg.'); valid = false;
        } else clearError(petWeight, 'weightError');

        if (petAllergies.value.length > 255) {
            showError(petAllergies, 'allergiesError', 'Max 255 characters.'); valid = false;
        } else clearError(petAllergies, 'allergiesError');

        if (!valid) e.preventDefault();
    });
})();
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

