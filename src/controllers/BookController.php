<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../repository/BookRepository.php';

class BookController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $bookRepository;
    private $sessionRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->sessionRepository = new SessionRepository();
    }


    public function addBook()
    {
        session_start();
        if ($this->checkIfLogged()){
                if ($_SESSION['role'] === 'admin') {
                    if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                        move_uploaded_file($_FILES['file']['tmp_name'],
                            dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']);

                        $book = new Book($_POST['title'], $_POST['isbn'], $_POST['free_books_number'], $_POST['description'], $_FILES['file']['name']);
                        $this->bookRepository->addBook($book);
                        return $this->render('books', ['messages' => $this->messages, 'books' => $this->bookRepository->getBooks()]);
                    }
                    return $this->render('add_book', ['messages' => $this->messages]);
                }
                return $this->books('');
            }
        $this->render('login', ['messages' => ['musisz byc zalogowany']]);

    }

    public function books($category)
    {
        session_start();
        if ($this->checkIfLogged()){

                if (!$category) {

                    $books = $this->bookRepository->getBooks();
                    array_push($books, "");
                    $this->render('books', ['books' => $books]);

                } else if ($category === "popular") {
                    $books = $this->bookRepository->getBooks();
                    $books = $this->sortByPopularity($books);
                    array_push($books, "Najpopularniejsze: ");
                    $this->render('books', ['books' => $books]);
                } else {
                    $category = strtolower($category);
                    $books = $this->bookRepository->getBooksByCategory($category);
                    $category = ucfirst($category);
                    if (!empty($books))
                        array_push($books, "Kategoria: " . $category);
                    else $books = ["Nie ma takiej kategorii"];
                    $this->render('books', ['books' => $books]);
                }

        } else $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }


    public function search()
    {
        if ($this->checkIfLogged()) {
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if ($contentType === "application/json") {
                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);
                header('Content-type: application/json');
                http_response_code(200);
                echo json_encode($this->bookRepository->getBooksByTitle($decoded['search']));
            }
        }else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    public function like(int $id)
    {
        if ($this->checkIfLogged()) {
            $this->bookRepository->like($id);
            http_response_code(200);
        }else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    public function dislike(int $id)
    {
        if ($this->checkIfLogged()) {
            $this->bookRepository->dislike($id);
            http_response_code(200);
        }else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    public function reserve()
    {
        if ($this->checkIfLogged()) {
            session_start();
            $session = $this->sessionRepository->getSession($_SESSION['id']);
            $id = $session->getUserId();
            $book_id = $_POST['book_id'];
            $this->bookRepository->reserveBook($id, $book_id);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/books");
        } else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    public function returnBook(int $bookID)
    {
        if ($this->checkIfLogged()) {
            session_start();
            $session = $this->sessionRepository->getSession($_SESSION['id']);
            $userID = $session->getUserId();
            $this->bookRepository->returnBook($userID, $bookID);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        } else return $this->render('login', ['messages' => ['musisz byc zalogowany']]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'file is too large for destination file system.';
            return false;
        }
        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }
        return true;
    }


    private function sortByPopularity($objects)
    {
        usort($objects, function ($a, $b) {
            return ($b->getLike() - $b->getDislike()) - ($a->getLike() - $a->getDislike());
        });
        return $objects;
    }

    private function checkIfLogged(): bool
    {
        session_start();
        if (isset($_SESSION['id']))
            if ($this->sessionRepository->getSession($_SESSION['id']))
                return true;

        return false;
    }

}