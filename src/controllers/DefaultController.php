<?php
require_once 'AppController.php';
require_once __DIR__ . '/../repository/BookRepository.php';
require_once __DIR__ . '/../repository/SessionRepository.php';

class DefaultController extends AppController {


    public function index(){
        session_start();
        if (isset($_SESSION['id'])) {
            if (($sessionRepository=new SessionRepository())->getSession($_SESSION['id'])) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/books");
            }
        }
        $bookRepository = new BookRepository();
        $books = $bookRepository->getBooks();

        $books = $this->sortByPopularity($books);
        $books = array_slice($books,0,4);
        $this->render('startscreen',['books'=>$books]);

    }

    private function sortByPopularity($objects)
    {
        usort($objects, function ($a, $b) {
            return ($b->getLike() - $b->getDislike()) - ($a->getLike() - $a->getDislike());
        });
        return $objects;
    }

}
