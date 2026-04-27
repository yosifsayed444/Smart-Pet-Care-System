<?php

class ServiceProviderController extends Controller
{
    public function index()
    {
        $providerModel = new ServiceProvider();
        $data['services'] = $providerModel->getAllServices();
        $this->view('ServiceProvider/services', $data);
    }

    public function services()
    {
        $this->index();
    }

    public function bookings()
    {
        Middleware::requireRole('Provider');

        $bookingModel = new Booking();
        $provider_id = $_SESSION['id'];

        $data['bookings'] = $bookingModel->getByProvider($provider_id);
        $this->view('ServiceProvider/bookings', $data);
    }

    public function updateBookingStatus($id, $status)
    {
        Middleware::requireRole('Provider');

        $bookingModel = new Booking();
        $booking = $bookingModel->first(['BookingID' => $id]);

        if ($booking && $booking['ProviderID'] == $_SESSION['id']) {
            $bookingModel->updateByBookingId($id, ['status' => $status]);
            $_SESSION['success'] = "Booking marked as $status.";
        }

        redirect('ServiceProvider/bookings');
    }

    public function dashboard()
    {
        Middleware::requireRole('Provider');

        $provider_id = $_SESSION['id'];
        $providerModel = new ServiceProvider();
        $reviewModel = new Review();
        $bookingModel = new Booking();

        $data['services'] = $providerModel->getServices($provider_id);
        $data['availability'] = $providerModel->getAvailability($provider_id);
        $data['conflictBooking'] = $providerModel->findFirstConflict($provider_id);
        $data['reviews'] = $reviewModel->viewReviews($provider_id);
        $data['recentBookings'] = $bookingModel->getByProvider($provider_id);

        $this->view('ServiceProvider/dashboard', $data);
    }

    public function addService()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = [];

            $name  = trim($_POST['name'] ?? '');
            $tier  = trim($_POST['tier'] ?? '');
            $price = trim($_POST['price'] ?? '');

            if (empty($name)) {
                $errors[] = "Service name is required.";
            } elseif (strlen($name) < 3 || strlen($name) > 100) {
                $errors[] = "Service name must be between 3 and 100 characters.";
            }

            $allowedTiers = ['Basic', 'Standard', 'Premium'];
            if (!in_array($tier, $allowedTiers)) {
                $errors[] = "Please select a valid service tier.";
            }

            if (!is_numeric($price) || $price < 0 || $price > 99999) {
                $errors[] = "Price must be a positive number (max \$99,999).";
            }

            // Image validation
            if (!empty($_FILES['image']['name'])) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $maxSize = 2 * 1024 * 1024; // 2MB
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $errors[] = "Image must be JPG, PNG, GIF, or WebP.";
                } elseif ($_FILES['image']['size'] > $maxSize) {
                    $errors[] = "Image size must not exceed 2MB.";
                }
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                redirect('ServiceProvider/dashboard');
            }

            $providerModel = new ServiceProvider();
            $data = [
                'provider_id' => $_SESSION['id'],
                'name'        => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'tier'        => $tier,
                'price'       => (float)$price
            ];

            // Image Upload Handling
            if (!empty($_FILES['image']['name'])) {
                $folder = "uploads/services/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = time() . "_" . uniqid() . "." . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $folder . $filename)) {
                    $data['image'] = $filename;
                }
            }

            $providerModel->addService($data);
            $_SESSION['success'] = "Service added successfully!";
        }
        redirect('ServiceProvider/dashboard');
    }

    public function deleteService($id)
    {
        Middleware::requireRole('Provider');
        $providerModel = new ServiceProvider();
        $providerModel->deleteService($id, $_SESSION['id']);
        $_SESSION['success'] = "Service deleted successfully.";
        redirect('ServiceProvider/dashboard');
    }

    public function updateServicePrice()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $providerModel = new ServiceProvider();
            $service_id = $_POST['service_id'];
            $price = $_POST['price'];

            $providerModel->updateServicePrice($service_id, $price);
            $_SESSION['success'] = "Price updated successfully!";
        }
        redirect('ServiceProvider/dashboard');
    }

    public function setAvailability()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = [];

            $date       = trim($_POST['date'] ?? '');
            $start_time = trim($_POST['start_time'] ?? '');
            $end_time   = trim($_POST['end_time'] ?? '');

            if (empty($date) || !strtotime($date)) {
                $errors[] = "A valid date is required.";
            } elseif (strtotime($date) < strtotime(date('Y-m-d'))) {
                $errors[] = "Availability date cannot be in the past.";
            }

            if (empty($start_time)) {
                $errors[] = "Start time is required.";
            }

            if (empty($end_time)) {
                $errors[] = "End time is required.";
            }

            if (!empty($start_time) && !empty($end_time) && strtotime($start_time) >= strtotime($end_time)) {
                $errors[] = "End time must be after start time.";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                redirect('ServiceProvider/dashboard');
            }

            $providerModel = new ServiceProvider();
            $data = [
                'provider_id'    => $_SESSION['id'],
                'available_date' => $date,
                'start_time'     => $start_time,
                'end_time'       => $end_time
            ];

            $providerModel->setAvailability($data);
            $_SESSION['success'] = "Availability set successfully!";
        }
        redirect('ServiceProvider/dashboard');
    }

    public function deleteSchedule($id)
    {
        Middleware::requireRole('Provider');
        $providerModel = new ServiceProvider();
        $providerModel->deleteAvailability($id, $_SESSION['id']);
        $_SESSION['success'] = "Schedule slot removed successfully.";
        redirect('ServiceProvider/dashboard');
    }

    public function resolveConflict()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $providerModel = new ServiceProvider();
            $booking_id = $_POST['booking_id'];
            $new_date = $_POST['new_date'];
            $new_start_time = $_POST['new_start_time'];
            $new_end_time = $_POST['new_end_time'];

            $result = $providerModel->resolveConflict($booking_id, $new_date, $new_start_time, $new_end_time, $_SESSION['id']);
            
            if ($result) {
                $_SESSION['success'] = "Conflict resolved and booking updated!";
            } else {
                $_SESSION['error'] = "Failed to resolve conflict. Check availability and overlaps.";
            }
        }
        redirect('ServiceProvider/dashboard');
    }

    public function replyToReview()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $reviewModel = new Review();
            
            // For a provider reply, we need the provider_id and user_id.
            // However, the reply might be tied to the same provider_id as the original review.
            // Let's find the original review to get the provider_id.
            $parent_id = $_POST['parent_id'];
            $original_review = $reviewModel->first(['id' => $parent_id]);

            if ($original_review) {
                $data = [
                    'provider_id' => $original_review['provider_id'],
                    'user_id' => $_SESSION['id'], // The provider's user ID
                    'comment' => $_POST['comment'],
                    'parent_id' => $parent_id,
                    'rating' => 0 // Replies don't have ratings
                ];

                $reviewModel->addReview($data);
                $_SESSION['success'] = "Reply posted successfully!";
            }
        }
        redirect('ServiceProvider/dashboard');
    }

    public function book($service_id = null)
    {
        if (!$service_id) {
            redirect('ServiceProvider/services');
        }

        $providerModel = new ServiceProvider();
        $petModel = new Pet();
        $bookingModel = new Booking();

        $service = $providerModel->getServiceById($service_id);
        if (!$service) {
            redirect('ServiceProvider/services');
        }

        $data['service'] = $service;
        $data['pets'] = [];
        $data['availability'] = $providerModel->getAvailability($service['provider_id']);

        if (isset($_SESSION['id'])) {
            $data['pets'] = $petModel->getPetsByOwner($_SESSION['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            Middleware::requireRole('Owner');

            $errors = [];

            // --- Validate pet_id ---
            $pet_id = trim($_POST['pet_id'] ?? '');
            if (empty($pet_id)) {
                $errors[] = "Please select a pet.";
            } elseif (!is_numeric($pet_id) || (int)$pet_id <= 0) {
                $errors[] = "Invalid pet selection.";
            } else {
                // Verify the pet belongs to the logged-in owner
                $petModel2 = new Pet();
                $pet = $petModel2->getPetById((int)$pet_id);
                if (!$pet || $pet['OwnerID'] != $_SESSION['id']) {
                    $errors[] = "The selected pet does not belong to your account.";
                }
            }

            // --- Validate availability slot ---
            $availability_id = trim($_POST['availability_id'] ?? '');
            if (empty($availability_id)) {
                $errors[] = "Please select an available time slot.";
            } elseif (!is_numeric($availability_id) || (int)$availability_id <= 0) {
                $errors[] = "Invalid time slot selection.";
            }

            if (!empty($errors)) {
                $data['error'] = implode('<br>', $errors);
            } else {
                // Resolve slot details
                $date = $start_time = $end_time = null;

                if (!empty($availability_id)) {
                    $slotRow = $providerModel->query(
                        "SELECT * FROM provider_availability WHERE id = :id",
                        ['id' => (int)$availability_id]
                    );
                    if (!empty($slotRow)) {
                        $date       = $slotRow[0]['available_date'];
                        $start_time = $slotRow[0]['start_time'];
                        $end_time   = $slotRow[0]['end_time'];
                    }
                } else {
                    $date       = $_POST['date']       ?? null;
                    $start_time = $_POST['start_time'] ?? null;
                    $end_time   = $_POST['end_time']   ?? null;
                }

                if (!$date || !$start_time || !$end_time) {
                    $data['error'] = "Could not resolve the selected time slot. Please try again.";
                } else {
                    // 1. Check provider availability covers this window
                    $isAvailable = $providerModel->checkAvailability(
                        $service['provider_id'], $date, $start_time, $end_time
                    );

                    // 2. Check for overlapping bookings
                    $hasConflict = $bookingModel->hasConflict(
                        $service['provider_id'], $date, $start_time, $end_time, $service_id
                    );

                    if (!$isAvailable) {
                        $data['error'] = "The provider is not available during the selected time slot. Please check their availability.";
                    } elseif ($hasConflict) {
                        $data['error'] = "This time slot is already booked by another user. Please choose a different time.";
                    } else {
                        $bookingData = [
                            'PetID'       => (int)$pet_id,
                            'OwnerID'     => $_SESSION['id'],
                            'ProviderID'  => $service['provider_id'],
                            'service_id'  => $service_id,
                            'BookingDate' => $date,
                            'StartTime'   => $start_time,
                            'EndTime'     => $end_time
                        ];

                        if ($bookingModel->insert($bookingData)) {
                            $_SESSION['success'] = "Booking successful! Your pet is scheduled.";
                            redirect('ServiceProvider/services');
                        } else {
                            $data['error'] = "Failed to create booking. Please try again.";
                        }
                    }
                }
            }
        }

        $this->view('ServiceProvider/book', $data);
    }
}