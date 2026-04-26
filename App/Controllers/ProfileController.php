<?php
class ProfileController extends Controller
{

    public function index()
    {
     Middleware::requireLogin();
    
        $user = new User();

        $data = $user->first([
            'id' => $_SESSION['id']
        ]);

        $this->view('profile/index', [
            'data' => $data
        ]);
    }

}