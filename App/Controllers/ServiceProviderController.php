<?php

class ServiceProviderController extends Controller
{
    public function index()
    {
        $this->view('ServiceProvider/index');
    }

    public function services()
    {
        $this->view('ServiceProvider/services');
    }

    public function bookings()
    {
        $this->view('ServiceProvider/bookings');
    }

    public function dashboard()
    {
        Middleware::requireRole('Provider');

        $provider_id = $_SESSION['id'];
        $providerModel = new ServiceProvider();
        $reviewModel = new Review();

        $data['services'] = $providerModel->getServices($provider_id);
        $data['availability'] = $providerModel->getAvailability($provider_id);
        $data['conflictBooking'] = $providerModel->findFirstConflict($provider_id);
        $data['reviews'] = $reviewModel->viewReviews($provider_id);

        $this->view('ServiceProvider/dashboard', $data);
    }

    public function addService()
    {
        Middleware::requireRole('Provider');

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $providerModel = new ServiceProvider();
            $data = [
                'provider_id' => $_SESSION['id'],
                'name' => $_POST['name'],
                'tier' => $_POST['tier'],
                'price' => $_POST['price']
            ];

            $providerModel->addService($data);
            $_SESSION['success'] = "Service added successfully!";
        }
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
            $providerModel = new ServiceProvider();
            $data = [
                'provider_id' => $_SESSION['id'],
                'available_date' => $_POST['date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time']
            ];

            $providerModel->setAvailability($data);
            $_SESSION['success'] = "Availability set successfully!";
        }
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
}