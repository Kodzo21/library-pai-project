<?php

require_once __DIR__ . '/../repository/UserRepository.php';


class ProfileController extends AppController
{

    private $userRepository;


    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    public function profile()
    {
        session_start();
        if(isset($_SESSION["email"])) {
            $user = $this->userRepository->getUser($_SESSION["email"]);
            return $this->render('profile', ['user' => $user]);
        }


    }

}