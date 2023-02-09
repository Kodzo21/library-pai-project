<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Session.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/SessionRepository.php';

class SecurityController extends AppController
{

    private $userRepository;
    private $sessionRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->sessionRepository = new SessionRepository();
    }


    public function login()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            if ($this->sessionRepository->getSession($_SESSION['id'])) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/books");
            }
        }
        if (!$this->isPost()) {
            return $this->render('login');
        } else {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $this->userRepository->getUser($email);
            if (!$user) {
                return $this->render('login', ['messages' => ['user doesnt exist']]);
            }
            if ($user->getEmail() !== $email)
                return $this->render('login', ['messages' => ['user with this email doesnt exist']]);

            if (!password_verify($password, $user->getPassword()))
                return $this->render('login', ['messages' => ['wrong password']]);

            $session_id = session_id();
            $session = new Session($session_id, $user->getId());
            $this->sessionRepository->addSession($session);
            $_SESSION['id'] = $session_id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user->getRole();
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/books");
        }
    }

    public function register()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            if ($this->sessionRepository->getSession($_SESSION['id'])) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/books");
            }
        } else
            if (!$this->isPost()) {
                return $this->render('register');
            }else {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmedPassword = $_POST['confirmedPassword'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $phone = $_POST['phone'];

                if ($password !== $confirmedPassword) {
                    return $this->render('register', ['messages' => ['Unmatching passwords']]);
                }
                $user = new User(1, 'user', $email, password_hash($password, PASSWORD_BCRYPT), $name, $surname);
                $user->setPhone($phone);

                $this->userRepository->addUser($user);
                return $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
            }
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            if ($this->sessionRepository->getSession($_SESSION['id'])) {
                $sessionID = session_id();
                $this->sessionRepository->removeSession($sessionID);
                session_destroy();
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/login");
            }
        }
    }
}