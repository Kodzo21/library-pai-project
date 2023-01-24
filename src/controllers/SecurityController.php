<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class SecurityController extends AppController
{

    public function login(){
        $userRepository = new UserRepository();




        if (!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = $userRepository->getUser($email);
        if (!$user){
            return $this->render('login',['messages'=>['user doesnt exist']]);
        }
        if ($user->getEmail() !== $email)
            return $this->render('login',['messages'=>['user with this email doesnt exist']]);

        if ($user->getPassword() !== $password)
            return $this->render('login',['messages'=>['wrong password']]);

        return $this->render('books');
    }
}