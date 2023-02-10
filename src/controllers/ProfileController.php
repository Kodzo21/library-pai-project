<?php

require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/SessionRepository.php';


class ProfileController extends AppController
{

    private $userRepository;
    private $sessionRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->sessionRepository = new SessionRepository();
    }


    public function profile()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            if ($this->sessionRepository->getSession($_SESSION['id'])) {
                if (isset($_SESSION["email"])) {
                    $user = $this->userRepository->getUser($_SESSION["email"]);
                    return $this->render('profile', ['user' => $user]);
                }
            }
        }
        return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    public function manage()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            if ($this->sessionRepository->getSession($_SESSION['id'])) {
                $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                if ($contentType === "application/json") {
                    $email=$_SESSION['email'];
                    $id = $this->userRepository->getUser($email)->getId();
                    header('Content-type: application/json');
                    http_response_code(200);
                    echo json_encode($this->userRepository->getUserBooks($id));
                }
            }else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
        }else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

}