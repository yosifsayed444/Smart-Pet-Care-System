<?php

class VetController extends Controller
{
    

    
    private function getVetId()
    {
        $userId   = $_SESSION['id'];
        $vetModel = new Veterinarian();
        $vet      = $vetModel->getById($userId);

        if (!$vet) {
            $username = $_SESSION['username'] ?? 'Veterinarian';
            $vetModel->query(
                "INSERT IGNORE INTO veterinarian (VetID, Name, Specialization, LicenseNumber) VALUES (:id, :name, 'General', :lic)",
                ['id' => $userId, 'name' => $username, 'lic' => 'VET-' . $userId]
            );
        }

        return $userId;
    }

    

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        Middleware::requireRole('Vet');
        $vetId    = $this->getVetId();
        $vetModel = new Veterinarian();
        $vacModel = new Vaccination();
        $presModel = new Prescription();
        $medModel  = new MedicalRecord();

        $data['vet']           = $vetModel->getById($vetId);
        $data['appointments']  = $vetModel->getAppointments($vetId);
        $data['patients']      = $vetModel->getPatientsForVet($vetId);
        $data['allPets']       = $vetModel->getAllPets();
        $data['vaccinations']  = $vacModel->getAllWithPets();
        $data['upcoming']      = $vacModel->getUpcoming();
        $data['prescriptions'] = $presModel->getByVet($vetId);
        $data['labResults']    = $medModel->getLabResults($vetId);
        $data['medicalNotes']  = $medModel->getMedicalNotesByVet($vetId);

        $lostPetModel = new LostPet();
        $data['lostPets'] = $lostPetModel->fetchAll();

        $this->view('Veterinarian/dashboard', $data);
    }

    

    public function addVaccination()
    {
        Middleware::requireRole('Vet');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $petId   = trim($_POST['pet_id'] ?? '');
            $vaccine = Helpers::clean($_POST['vaccine_name'] ?? '');
            $date    = trim($_POST['vaccination_date'] ?? '');
            $next    = trim($_POST['next_date'] ?? '');

            if (empty($petId) || !is_numeric($petId))         $errors[] = "Please select a valid pet.";
            if (empty($vaccine))                              $errors[] = "Vaccine name is required.";
            elseif (strlen($vaccine) > 100)                   $errors[] = "Vaccine name must not exceed 100 characters.";
            if (empty($date) || !strtotime($date))            $errors[] = "A valid vaccination date is required.";
            if (empty($next) || !strtotime($next))            $errors[] = "A valid next-due date is required.";
            if (!empty($date) && !empty($next) && strtotime($next) <= strtotime($date))
                $errors[] = "Next-due date must be after the vaccination date.";

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
            } else {
                $vacModel = new Vaccination();
                $vacModel->addVaccination([
                    'PetID'           => (int)$petId,
                    'VaccineName'     => $vaccine,
                    'VaccinationDate' => $date,
                    'NextDate'        => $next
                ]);
                $_SESSION['success'] = "Vaccination record added successfully!";
            }
        }
        redirect('vet/dashboard');
    }

    public function viewVaccinations()
    {
        Middleware::requireRole('Vet');
        $vacModel = new Vaccination();
        $data['vaccinations'] = $vacModel->getAllWithPets();
        $data['upcoming']     = $vacModel->getUpcoming();
        $this->view('Veterinarian/dashboard', $data);
    }

    public function updateVaccination($id)
    {
        Middleware::requireRole('Vet');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $vaccine = Helpers::clean($_POST['vaccine_name'] ?? '');
            $date    = trim($_POST['vaccination_date'] ?? '');
            $next    = trim($_POST['next_date'] ?? '');

            if (empty($vaccine))                           $errors[] = "Vaccine name is required.";
            if (empty($date) || !strtotime($date))         $errors[] = "A valid vaccination date is required.";
            if (empty($next) || !strtotime($next))         $errors[] = "A valid next-due date is required.";
            if (!empty($date) && !empty($next) && strtotime($next) <= strtotime($date))
                $errors[] = "Next-due date must be after the vaccination date.";

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
            } else {
                $vacModel = new Vaccination();
                $vacModel->updateVaccination($id, [
                    'VaccineName'     => $vaccine,
                    'VaccinationDate' => $date,
                    'NextDate'        => $next
                ]);
                $_SESSION['success'] = "Vaccination updated successfully!";
            }
        }
        redirect('vet/dashboard');
    }

    public function deleteVaccination($id)
    {
        Middleware::requireRole('Vet');
        $vacModel = new Vaccination();
        $vacModel->deleteVaccination($id);
        $_SESSION['success'] = "Vaccination record deleted.";
        redirect('vet/dashboard');
    }

    

    public function addPrescription()
    {
        Middleware::requireRole('Vet');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $vetId  = $this->getVetId();

            $petId    = trim($_POST['pet_id'] ?? '');
            $medName  = Helpers::clean($_POST['medication_name'] ?? '');
            $dosage   = Helpers::clean($_POST['dosage'] ?? '');
            $date     = trim($_POST['date'] ?? '');

            if (empty($petId) || !is_numeric($petId))     $errors[] = "Please select a valid pet.";
            if (empty($medName))                          $errors[] = "Medication name is required.";
            elseif (strlen($medName) > 100)               $errors[] = "Medication name must not exceed 100 characters.";
            if (empty($dosage))                           $errors[] = "Dosage is required.";
            elseif (strlen($dosage) > 50)                 $errors[] = "Dosage must not exceed 50 characters.";
            if (empty($date) || !strtotime($date))        $errors[] = "A valid prescription date is required.";

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
            } else {
                $presModel = new Prescription();
                $presModel->addPrescription([
                    'PetID'          => (int)$petId,
                    'VetID'          => $vetId,
                    'MedicationName' => $medName,
                    'Dosage'         => $dosage,
                    'Date'           => $date
                ]);

                $petModel = new Pet();
                $pet = $petModel->getPetById($petId);
                if ($pet && isset($pet['OwnerID'])) {
                    $notifModel = new Notification();
                    $notifModel->sendNotification($pet['OwnerID'], "A new prescription ($medName) for {$pet['PetName']} has been added by your Veterinarian.", "Prescription");
                }

                $_SESSION['success'] = "Prescription added successfully!";
            }
        }
        redirect('vet/dashboard');
    }

    public function viewPrescriptions()
    {
        Middleware::requireRole('Vet');
        $vetId     = $this->getVetId();
        $presModel = new Prescription();
        $data['prescriptions'] = $presModel->getByVet($vetId);
        $this->view('Veterinarian/dashboard', $data);
    }

    public function deletePrescription($id)
    {
        Middleware::requireRole('Vet');
        $vetId     = $this->getVetId();
        $presModel = new Prescription();
        $presModel->deletePrescription($id, $vetId);
        $_SESSION['success'] = "Prescription deleted.";
        redirect('vet/dashboard');
    }

    public function updateAppointmentStatus($id, $status)
    {
        Middleware::requireRole('Vet');
        
        $allowed = ['Accepted', 'Rejected'];
        if (!in_array($status, $allowed)) {
            $_SESSION['error'] = "Invalid status requested.";
            redirect('vet/dashboard');
        }

        $appModel = new Appointment();
        $vetId    = $this->getVetId();
        
        
        $appointment = $appModel->query("SELECT * FROM appointment WHERE AppointmentID = :id", ['id' => $id]);
        
        if (!empty($appointment)) {
            $appointment = $appointment[0];
            if ($appointment['VetID'] == $vetId) {
                $appModel->updateStatus($id, $status);
                $_SESSION['success'] = "Appointment #$id successfully marked as $status.";
            } else {
                $_SESSION['error'] = "Unauthorized: This appointment is assigned to another veterinarian.";
            }
        } else {
            $_SESSION['error'] = "Appointment not found.";
        }

        redirect('vet/dashboard');
    }

    public function addMedicalNote()
    {
        Middleware::requireRole('Vet');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $petId = trim($_POST['pet_id'] ?? '');
            $diagnosis = Helpers::clean($_POST['diagnosis'] ?? '');
            $behavior = Helpers::clean($_POST['behavior'] ?? '');
            
            if (empty($petId) || empty($diagnosis)) {
                $_SESSION['error'] = "Pet and Diagnosis are required.";
            } else {
                $medModel = new MedicalRecord();
                $medModel->addRecord([
                    'PetID' => $petId,
                    'VetID' => $this->getVetId(),
                    'Diagnosis' => $diagnosis,
                    'Behavior' => $behavior,
                    'RecordDate' => date('Y-m-d H:i:s')
                ]);
                $_SESSION['success'] = "Medical Note added successfully!";
            }
        }
        redirect('vet/dashboard');
    }

    public function addLabResult()
    {
        Middleware::requireRole('Vet');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $petId = trim($_POST['pet_id'] ?? '');
            $diagnosis = Helpers::clean($_POST['diagnosis'] ?? '');
            $notes = Helpers::clean($_POST['notes'] ?? '');
            
            if (empty($petId) || empty($diagnosis)) {
                $_SESSION['error'] = "Pet and Diagnosis/Summary are required.";
                redirect('vet/dashboard');
            }
            
            $data = [
                'PetID' => $petId,
                'VetID' => $this->getVetId(),
                'Diagnosis' => $diagnosis,
                'LabNotes' => $notes,
                'RecordDate' => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['lab_file']['name'])) {
                $filename = Helpers::uploadFile('lab_file', 'uploads/lab_results/', ['pdf', 'jpg', 'jpeg', 'png', 'webp'], 5 * 1024 * 1024, 'lab_');
                if ($filename) {
                    $data['LabFile'] = $filename;
                } else {
                    redirect('vet/dashboard');
                }
            }

            $medModel = new MedicalRecord();
            $medModel->addRecord($data);
            $_SESSION['success'] = "Lab Result added successfully!";
        }
        redirect('vet/dashboard');
    }

    public function passport($id = null)
    {
        Middleware::requireLogin();
        if (!in_array($_SESSION['role'], ['Vet', 'Owner', 'Admin'])) {
            redirect('home');
        }

        if (!$id) {
            redirect($_SESSION['role'] == 'Vet' ? 'vet/dashboard' : 'petowner/dashboard');
        }

        $petModel = new Pet();
        $vacModel = new Vaccination();
        $medModel = new MedicalRecord();

        $data['pet'] = $petModel->getPetById($id);
        if (!$data['pet']) {
            $_SESSION['error'] = "Pet not found.";
            redirect($_SESSION['role'] == 'Vet' ? 'vet/dashboard' : 'petowner/dashboard');
        }

        if ($_SESSION['role'] == 'Owner' && !$data['pet']['passport_ready']) {
            $_SESSION['error'] = "Your pet's passport has not been generated by a veterinarian yet.";
            redirect('petowner/dashboard');
        }

        $data['vaccinations'] = $vacModel->getByPet($id);
        $data['medNotes']     = $medModel->getMedicalNotesByPet($id);
        $userModel = new User();
        $data['user'] = $userModel->first(['id' => $data['pet']['OwnerID']]);
        $data['vetId'] = ($_SESSION['role'] == 'Vet') ? $this->getVetId() : 1;

        $this->view('Veterinarian/passport', $data);
    }

    public function togglePassportStatus($petId)
    {
        Middleware::requireRole('Vet');
        $petModel = new Pet();
        $pet = $petModel->getPetById($petId);
        if ($pet) {
            $newStatus = $pet['passport_ready'] ? 0 : 1;
            $petModel->query("UPDATE pet SET passport_ready = :status WHERE PetID = :id", ['status' => $newStatus, 'id' => $petId]);
            $_SESSION['success'] = "Passport status updated successfully.";
        }
        redirect('vet/dashboard');
    }

    public function book()        { $this->view('Veterinarian/book'); }
    public function appointments(){ Middleware::requireRole('Vet'); $this->dashboard(); }
    public function prescriptions(){ $this->viewPrescriptions(); }

}