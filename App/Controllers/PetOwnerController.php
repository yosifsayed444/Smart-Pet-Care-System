<?php

class PetOwnerController extends Controller
{
    public function index()
    {
        checkRole(['Owner']);
        $this->view('petowner/dashboard');
    }

    public function pets()
    {
        checkRole(['Owner']);

        $petModel = new Pet();
        $owner_id = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'OwnerID'   => $owner_id,
                'PetName'   => $_POST['name'],
                'Species'   => $_POST['species'],
                'Age'       => $_POST['age'],
                'Gender'    => $_POST['gender'],
                'Weight'    => $_POST['weight'],
                'Allergies' => $_POST['allergies']
            ];

            if ($petModel->insert($data)) {
                $_SESSION['success'] = "Pet added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add pet.";
            }
            redirect('petowner/pets');
        }

        $data['pets'] = $petModel->getPetsByOwner($owner_id);
        $this->view('petowner/pets', $data);
    }

    public function appointments()
    {
        checkRole(['Owner']);

        $bookingModel = new Booking();
        $owner_id = $_SESSION['id'];

        $data['bookings'] = $bookingModel->getByOwner($owner_id);
        $this->view('petowner/appointments', $data);
    }

    public function deleteAppointment($id)
    {
        checkRole(['Owner']);

        $bookingModel = new Booking();
        
        // Ensure the booking belongs to the logged-in owner
        $booking = $bookingModel->query("SELECT * FROM booking WHERE BookingID = :id", ['id' => $id]);

        if (!empty($booking) && $booking[0]['OwnerID'] == $_SESSION['id']) {
            $bookingModel->delete($id);
            $_SESSION['success'] = "Appointment cancelled successfully.";
        } else {
            $_SESSION['error'] = "You cannot delete this appointment.";
        }

        redirect('petowner/appointments');
    }
}