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
            return $this->render('books',['messages'=>$this->messages,'book'=>$book]);
        }
        $this->render('add_book',['messages'=>$this->messages]);
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