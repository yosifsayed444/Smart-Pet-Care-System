<?php

class PetOwnerController extends Controller
{


    public function pets()
    {
        checkRole(['Owner']);

        $petModel = new Pet();
        $owner_id = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = [];

            $name      = trim($_POST['name'] ?? '');
            $species   = trim($_POST['species'] ?? '');
            $age       = trim($_POST['age'] ?? '');
            $gender    = trim($_POST['gender'] ?? '');
            $weight    = trim($_POST['weight'] ?? '');
            $allergies = trim($_POST['allergies'] ?? '');

            
            if (empty($name)) {
                $errors[] = "Pet name is required.";
            } elseif (strlen($name) < 2 || strlen($name) > 50) {
                $errors[] = "Pet name must be between 2 and 50 characters.";
            }

            $allowedSpecies = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Other'];
            if (!in_array($species, $allowedSpecies)) {
                $errors[] = "Please select a valid species.";
            }

            if (!is_numeric($age) || $age < 0 || $age > 50) {
                $errors[] = "Age must be a number between 0 and 50.";
            }

            $allowedGenders = ['Male', 'Female'];
            if (!in_array($gender, $allowedGenders)) {
                $errors[] = "Please select a valid gender.";
            }

            if ($weight !== '' && (!is_numeric($weight) || $weight < 0 || $weight > 500)) {
                $errors[] = "Weight must be a positive number (max 500 kg).";
            }

            if (strlen($allergies) > 255) {
                $errors[] = "Allergies field must not exceed 255 characters.";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                redirect('petowner/pets');
            }

            $data = [
                'OwnerID'   => $owner_id,
                'PetName'   => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'Species'   => $species,
                'Age'       => (int)$age,
                'Gender'    => $gender,
                'Weight'    => $weight !== '' ? (float)$weight : null,
                'Allergies' => htmlspecialchars($allergies, ENT_QUOTES, 'UTF-8')
            ];

            if ($petModel->insert($data)) {
                $_SESSION['success'] = "Pet added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add pet. Please try again.";
            }
            redirect('petowner/pets');
        }

        $data['pets'] = $petModel->getPetsByOwner($owner_id);
        $this->view('PetOwner/pets', $data);
    }

    public function deletePet($id)
    {
        checkRole(['Owner']);

        $petModel = new Pet();
        $pet = $petModel->getPetById($id);

        if ($pet && $pet['OwnerID'] == $_SESSION['id']) {
            $petModel->deletePet($id);
            $_SESSION['success'] = "Pet removed successfully.";
        } else {
            $_SESSION['error'] = "You are not authorized to delete this pet.";
        }

        redirect('petowner/pets');
    }

    public function index()
    {
        checkRole(['Owner']);
        $ownerId = $_SESSION['id'] ?? 11;
        
        $petModel = new Pet();
        $bookingModel = new Booking();
        $appModel = new Appointment();
        $orderModel = new Order();

        $lostPetModel = new LostPet();

        $data['pets'] = $petModel->getPetsByOwner($ownerId);
        $data['bookings'] = $bookingModel->getByOwner($ownerId);
        $data['vetAppointments'] = $appModel->getByOwner($ownerId);
        $data['orders'] = $orderModel->getByUser($ownerId);
        $data['lostPets'] = $lostPetModel->getAllWithDetails();
        
        $incidentModel = new Incident();
        $data['openIncidentsCount'] = $incidentModel->getOpenByOwner($ownerId);
        
        $this->view('PetOwner/dashboard', $data);
    }

    public function dashboard()
    {
        $this->index();
    }

    public function appointments()
    {
        checkRole(['Owner']);
        $ownerId = $_SESSION['id'];

        $bookingModel = new Booking();
        $appModel = new Appointment();

        $data['bookings'] = $bookingModel->getByOwner($ownerId);
        $data['vetAppointments'] = $appModel->getByOwner($ownerId);
        
        $this->view('PetOwner/appointments', $data);
    }

    public function deleteAppointment($id)
    {
        checkRole(['Owner']);

        $bookingModel = new Booking();
        $booking = $bookingModel->query("SELECT * FROM booking WHERE BookingID = :id", ['id' => $id]);

        if (!empty($booking) && $booking[0]['OwnerID'] == $_SESSION['id']) {
            $bookingModel->query("DELETE FROM booking WHERE BookingID = :id", ['id' => $id]);
            $_SESSION['success'] = "Service booking cancelled successfully.";
        } else {
            $_SESSION['error'] = "You cannot delete this booking.";
        }

        redirect('petowner/index');
    }

    public function deleteVetAppointment($id)
    {
        checkRole(['Owner']);

        $appModel = new Appointment();
        $appointment = $appModel->query("SELECT * FROM appointment WHERE AppointmentID = :id", ['id' => $id]);

        if (!empty($appointment) && $appointment[0]['OwnerID'] == $_SESSION['id']) {
            $appModel->deleteAppointment($id);
            $_SESSION['success'] = "Veterinary appointment cancelled successfully.";
        } else {
            $_SESSION['error'] = "You cannot delete this appointment.";
        }

        redirect('petowner/index');
    }

    private function verifyPetOwnership($petId, $redirectTo = 'petowner/pets')
    {
        $petModel = new Pet();
        $pet = $petModel->getPetById($petId);
        if (!$pet || $pet['OwnerID'] != $_SESSION['id']) {
            $_SESSION['error'] = "Unauthorized access.";
            redirect($redirectTo);
            exit;
        }
        return $pet;
    }

    
    public function addCondition()
    {
        checkRole(['Owner']);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pet_id = $_POST['pet_id'] ?? '';
            $condition = trim($_POST['condition'] ?? '');

            if (empty($pet_id) || empty($condition)) {
                $_SESSION['error'] = "Condition name is required.";
            } else {
                $medical = new MedicalRecord();
                $medical->addCondition([
                    'PetID' => $pet_id,
                    'ConditionName' => Helpers::clean($condition)
                ]);
                $_SESSION['success'] = "Condition added successfully!";
            }
        }

        redirect('petowner/index');
    }

    public function viewConditions($petId)
    {
        checkRole(['Owner']);

        $medical = new MedicalRecord();
        $data['conditions'] = $medical->getConditions($petId);
        $data['pet_id'] = $petId;

        $this->view('PetOwner/viewCondition', $data);
    }

    public function deleteCondition($id)
    {
        checkRole(['Owner']);

        $medical = new MedicalRecord();
        $medical->deleteCondition($id);

        redirect('petowner/index');
    }

    
    public function updateWeight()
    {
        checkRole(['Owner']);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pet_id = $_POST['pet_id'] ?? '';
            $weight = $_POST['weight'] ?? '';

            if (empty($pet_id) || empty($weight)) {
                $_SESSION['error'] = "Weight value is required.";
            } elseif (!is_numeric($weight) || $weight <= 0 || $weight > 500) {
                $_SESSION['error'] = "Please enter a valid weight (0-500 kg).";
            } else {
                $pet = new Pet();
                $pet->updateWeight([
                    'Weight' => (float)$weight,
                    'PetID' => $pet_id
                ]);
                $_SESSION['success'] = "Weight updated successfully!";
            }
            redirect('petowner/viewWeight/' . $pet_id);
        } else {
            redirect('petowner/index');
        }
    }

    
    public function viewWeight($petId)
    {
        checkRole(['Owner']);

        $pet = new Pet();
        $weightInfo = $pet->viewWeight($petId);
        
        $baseWeight = $weightInfo['Weight'] ?? 0;
        
        
        $normalizationFactor = 13.37;
        $trendScore = $baseWeight * $normalizationFactor;
        
        $data['weightInfo'] = $weightInfo;
        $data['trendScore'] = $trendScore;
        $data['pet_id'] = $petId;

        $this->view('PetOwner/viewWeight', $data);
    }

    
    public function viewBehavior($petId)
    {
        checkRole(['Owner']);

        $medical = new MedicalRecord();
        $data['behaviors'] = $medical->getBehavior($petId);
        $data['pet_id'] = $petId;

        $this->view('PetOwner/pet_behavior', $data);
    }

    public function updateBehavior()
    {
        checkRole(['Owner']);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['record_id']) && !empty($_POST['behavior'])) {
                $medical = new MedicalRecord();
                $medical->updateBehavior([
                    'Behavior' => Helpers::clean($_POST['behavior']),
                    'RecordID' => $_POST['record_id']
                ]);
            }
            redirect('petowner/viewBehavior/' . (!empty($_POST['pet_id']) ? $_POST['pet_id'] : ''));
        } else {
            redirect('petowner/index');
        }
    }

    
    public function vaccinations($petId)
    {
        checkRole(['Owner']);
        
        $pet = $this->verifyPetOwnership($petId);

        $vacModel = new Vaccination();
        $data['vaccinations'] = $vacModel->getByPet($petId);
        $data['pet'] = $pet;
        
        $this->view('PetOwner/vaccinations', $data);
    }

    
    public function prescriptions($petId)
    {
        checkRole(['Owner']);
        
        $pet = $this->verifyPetOwnership($petId, 'petowner/index');

        $presModel = new Prescription();
        $data['prescriptions'] = $presModel->getByPet($petId);
        $data['pet'] = $pet;
        
        $this->view('PetOwner/prescriptions', $data);
    }

    

    public function labResults($petId)
    {
        checkRole(['Owner']);

        $pet = $this->verifyPetOwnership($petId);

        $medical = new MedicalRecord();
        $data['labResults'] = $medical->getLabResultsByPet($petId);
        $data['pet'] = $pet;

        $this->view('PetOwner/lab_results', $data);
    }

    

    public function medicalNotes($petId)
    {
        checkRole(['Owner']);

        $pet = $this->verifyPetOwnership($petId);

        $medical = new MedicalRecord();
        $data['notes'] = $medical->getMedicalNotesByPet($petId);
        $data['pet'] = $pet;

        $this->view('PetOwner/medical_notes', $data);
    }

    
    public function bookVet()
    {
        checkRole(['Owner']);
        $ownerId = $_SESSION['id'];

        $petModel = new Pet();
        $appModel = new Appointment();
        $vetModel = new Veterinarian();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = [];
            $petId = $_POST['pet_id'] ?? '';
            $vetId = $_POST['vet_id'] ?? '';
            $date  = $_POST['date']   ?? '';

            
            if (empty($petId)) $errors[] = "Please select a pet.";
            if (empty($vetId)) $errors[] = "Please select a veterinarian.";
            if (empty($date))  $errors[] = "Please select a date.";
            elseif (strtotime($date) < strtotime(date('Y-m-d'))) $errors[] = "Appointment date cannot be in the past.";

            
            $pet = $petModel->getPetById($petId);
            if (!$pet || $pet['OwnerID'] != $ownerId) {
                $errors[] = "Invalid pet selection.";
            }

            
            if (empty($errors) && $appModel->hasConflict($vetId, $date)) {
                $errors[] = "This veterinarian is already fully booked for the selected date.";
            }

            if (empty($errors)) {
                $insertData = [
                    'OwnerID' => $ownerId,
                    'PetID' => $petId,
                    'VetID' => $vetId,
                    'AppointmentDate' => $date
                ];

                if ($appModel->insert($insertData)) {
                    $_SESSION['success'] = "Veterinary appointment booked successfully!";
                    redirect('petowner/index');
                } else {
                    $_SESSION['error'] = "Failed to book appointment. Please try again.";
                }
            } else {
                $_SESSION['error'] = implode('<br>', $errors);
            }
        }

        $data['pets'] = $petModel->getPetsByOwner($ownerId);
        
        
        $data['vets'] = $vetModel->query("
            SELECT u.id as VetID, u.username as VetUserName, v.Specialization 
            FROM users u 
            LEFT JOIN veterinarian v ON u.id = v.VetID 
            WHERE u.role = 'Vet'
        ");
        
        $this->view('PetOwner/book_vet', $data);
    }



public function triage()
{
    $this->view('PetOwner/triage');
}

public function triageResult()
{
    $symptoms = $_POST['symptoms'] ?? [];
    $petId = $_POST['petId'] ?? null;

    // Emergency Red Flags (No DB needed, pure logic)
    $emergencySymptoms = ['breathing', 'bleeding', 'unconscious', 'seizure'];
    $redFlags = array_intersect($emergencySymptoms, $symptoms);

    if (!empty($redFlags)) {
        $_SESSION['red_flag'] = $redFlags;
        $_SESSION['red_flag_pet'] = $petId;
        redirect('petowner/emergencyAlert');
    }

    $type = "General Vet";
    if (in_array('tumor', $symptoms)) {
        $type = "Oncologist";
    }
    if (in_array('aggressive', $symptoms)) {
        $type = "Behavioral Specialist";
    }

    $this->view('PetOwner/triage_result', [
        'type' => $type
    ]);
}

    
    public function incidents()
    {
        checkRole(['Owner']);
        $incidentModel = new Incident();
        $data['incidents'] = $incidentModel->getByOwner($_SESSION['id']);
        
        
        $this->view('PetOwner/incidents', $data);
    }
    public function confirmCompletion($bookingId)
    {
        checkRole(['Owner']);
        $bookingModel = new Booking();
        $booking = $bookingModel->first(['BookingID' => $bookingId]);

        if ($booking && $booking['OwnerID'] == $_SESSION['id']) {
            if ($booking['EscrowStatus'] == 'Held') {
                $bookingModel->updateByBookingId($bookingId, ['EscrowStatus' => 'Released']);
                $_SESSION['success'] = "Service confirmed! Payment has been released from escrow.";
            } else {
                $_SESSION['error'] = "Escrow is already " . $booking['EscrowStatus'] . ".";
            }
        } else {
            $_SESSION['error'] = "Unauthorized or booking not found.";
        }

        redirect('petowner/index');
    }

    
    public function submitCommunityReview()
    {
        checkRole(['Owner']);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $bookingId = $_POST['booking_id'];
            $revieweeId = $_POST['reviewee_id'];
            $rating = $_POST['rating'];
            $comment = trim($_POST['comment'] ?? '');

            $reviewModel = new Review();
            if ($reviewModel->hasReviewed($bookingId, $_SESSION['id'])) {
                $_SESSION['error'] = "You have already reviewed this booking.";
            } else {
                $reviewModel->insertCommunityReview([
                    'BookingID' => $bookingId,
                    'ReviewerID' => $_SESSION['id'],
                    'RevieweeID' => $revieweeId,
                    'ReviewerRole' => 'Owner',
                    'Rating' => $rating,
                    'Comment' => Helpers::clean($comment)
                ]);
                $_SESSION['success'] = "Thank you for your feedback!";
            }
        }
        redirect('petowner/index');
    }

    public function addLog()
    {
        checkRole(['Owner']);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $petId = $_POST['pet_id'] ?? '';
            $description = trim($_POST['description'] ?? '');
            
            if (empty($petId) || empty($description)) {
                $_SESSION['error'] = "Description is required.";
                redirect('petowner/index');
            }

            $medModel = new MedicalRecord();
            $redFlags = $medModel->checkRedFlags($description);

            $data = [
                'PetID' => $petId,
                'Diagnosis' => Helpers::clean($description),
                'RecordDate' => date('Y-m-d'),
                'VetID' => null 
            ];

            $medModel->addRecord($data);

            if (!empty($redFlags)) {
                
                $_SESSION['red_flag'] = $redFlags;
                $_SESSION['red_flag_pet'] = $petId;
                redirect('petowner/emergencyAlert');
            } else {
                $_SESSION['success'] = "Daily log saved successfully.";
                redirect('petowner/index');
            }
        }
    }

    public function emergencyAlert()
    {
        checkRole(['Owner']);
        if (empty($_SESSION['red_flag'])) {
            redirect('petowner/index');
        }

        $data['flags'] = $_SESSION['red_flag'];
        $data['pet_id'] = $_SESSION['red_flag_pet'];
        
        
        $this->view('PetOwner/emergency_alert', $data);
        
        
        unset($_SESSION['red_flag']);
        unset($_SESSION['red_flag_pet']);
    }

    public function generateQR($bookingId)
    {
        checkRole(['Owner']);
        $bookingModel = new Booking();
        $booking = $bookingModel->first(['BookingID' => $bookingId]);

        if ($booking && $booking['OwnerID'] == $_SESSION['id'] && $booking['status'] == 'Accepted') {
            if (empty($booking['QRToken'])) {
                
                $token = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
                $bookingModel->updateByBookingId($bookingId, ['QRToken' => $token]);
                $booking['QRToken'] = $token;
            }
            $data['booking'] = $booking;
            $this->view('PetOwner/booking_qr', $data);
        } else {
            $_SESSION['error'] = "Booking not found or not accepted yet.";
            redirect('petowner/index');
        }
    }
}
