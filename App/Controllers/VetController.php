<?php

class VetController extends Controller
{
    

    
    private function getVetId()
    {
        $userId   = $_SESSION['id'];
        $vetModel = new Veterinarian();
        $vet      = $vetModel->getById($userId);

        if (!$vet) {
            // Auto-create a veterinarian profile for this user if missing
            $username = $_SESSION['username'] ?? 'Veterinarian';
            $vetModel->query(
                "INSERT IGNORE INTO veterinarian (VetID, Name, Specialization, LicenseNumber) VALUES (:id, :name, 'General', :lic)",
                ['id' => $userId, 'name' => $username, 'lic' => 'VET-' . $userId]
            );
        }

        return $userId;
    }

    private function clean($v)
    {
        return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
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
            $vaccine = $this->clean($_POST['vaccine_name'] ?? '');
            $date    = trim($_POST['vaccination_date'] ?? '');
            $next    = trim($_POST['next_date'] ?? '');

            if (empty($petId) || !is_numeric($petId))        $errors[] = "Please select a valid pet.";
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

            $vaccine = $this->clean($_POST['vaccine_name'] ?? '');
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
            $medName  = $this->clean($_POST['medication_name'] ?? '');
            $dosage   = $this->clean($_POST['dosage'] ?? '');
            $date     = trim($_POST['date'] ?? '');

            if (empty($petId) || !is_numeric($petId))    $errors[] = "Please select a valid pet.";
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

    

    public function book()        { $this->view('Veterinarian/book'); }
    public function appointments(){ Middleware::requireRole('Vet'); $this->dashboard(); }
    public function prescriptions(){ $this->viewPrescriptions(); }

}