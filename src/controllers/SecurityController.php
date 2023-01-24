<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
class SecurityController extends AppController
{

    public function login(){
        $user = new User('jkowal@gmail.com','admin','Jan','Kowalski');
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!$this->isPost()){
            return $this->render('login');
        }
        if ($user->getEmail() !== $email)
            return $this->render('login',['messages'=>['user with this email doesnt exist']]);

        if ($user->getPassword() !== $password)
            return $this->render('login',['messages'=>['wrong password']]);

        return $this->render('books');
    }
}