<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../repository/BookRepository.php';

class BookController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES=['image/png','image/jpeg','image/jpg'];
    const UPLOAD_DIRECTORY='/../public/uploads/';

    private $messages = [];
    private $bookRepository;


    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }


    public function addBook(){
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $book = new Book($_POST['title'],$_POST['isbn'],$_POST['free_books_number'],$_POST['description'],$_FILES['file']['name']);
            $this->bookRepository->addBook($book);
            return $this->render('books',['messages'=>$this->messages,'books'=>$this->bookRepository->getBooks()]);
        }
        return $this->render('add_book',['messages'=>$this->messages]);
    }

    public function books(){
        $books = $this->bookRepository->getBooks();
        $this->render('books',['books' => $books]);
    }


    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType ==="application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded  = json_decode($content,true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->bookRepository->getBooksByTitle($decoded['search']));
        }

    }

    public function like(int $id){
        $this->bookRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id){
        $this->bookRepository->dislike($id);
        http_response_code(200);
    }


    private function validate(array $file):bool
    {
        if ($file['size']>self::MAX_FILE_SIZE){
            $this->messages[]='file is too large for destination file system.';
            return false;
        }
        if (!isset($file['type'])&&!in_array($file['type'],self::SUPPORTED_TYPES)){
            $this->messages[]='File type is not supported';
            return false;
        }
        return true;
    }

}