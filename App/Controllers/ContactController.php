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

            'name'    => trim($_POST['name']),
            'email'   => trim($_POST['email']),
            'subject' => trim($_POST['subject']),
            'message' => trim($_POST['message'])

        ];

        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['subject']) ||
            empty($data['message'])
        ) {

            echo "<script>

                alert('All fields are required');

                window.location.href='" . ROOT . "/contact';

            </script>";

            return;
        }

        

        $message->insert($data);

   

        echo "<script>

            alert('Message Sent Successfully!');

            window.location.href='" . ROOT . "/contact';

        </script>";
    }
}

}