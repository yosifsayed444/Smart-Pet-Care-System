<?php

class ContactController extends Controller
{

    public function index()
    {
        $this->view('contact');
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $message = new Message();
            $data = [
                'name'    => trim($_POST['name'] ?? ''),
                'email'   => trim($_POST['email'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'message' => trim($_POST['message'] ?? '')
            ];

            if (empty($data['name']) || empty($data['email']) || empty($data['subject']) || empty($data['message'])) {
                $_SESSION['error'] = "All fields are required.";
                redirect('contact');
                return;
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format.";
                redirect('contact');
                return;
            }

            if ($message->insert($data)) {
                $_SESSION['success'] = "Message Sent Successfully! We will get back to you soon. ✅";
            } else {
                $_SESSION['error'] = "Failed to send message. Please try again.";
            }

            redirect('contact');
        }
    }

}