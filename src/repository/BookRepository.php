<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Book.php';


class BookRepository extends Repository
{
    public function getBook(int $id): ?Book
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.books where :id = id'
        );
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch(PDO::FETCH_ASSOC);

        if ($book == false) {
            return null;
            //throw exception zamiast return null
        }

        return new Book($book['title'], $book['isbn'], $book['free_books_number'], $book['description'], $book['image']);
    }

    public function addBook(Book $book): void
    {
        $statement = $this->database->connect()->prepare(
            'Insert into books (title, isbn, category_id,free_books_number, description, image) values (?,?,?,?,?)'
        );
        $category_id = 1;
        $statement->execute([
            $book->getTitle(),
            $book->getIsbn(),
            $category_id,
            $book->getFreeBooksNumber(),
            $book->getDescription(),
            $book->getImage()
        ]);
    }

    public function getBooks(): array
    {
        $result = [];
        $statement = $this->database->connect()->prepare('
           Select * from books; 
        ');
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($books as $book) {
            $result[] = new Book(
                $book['title'],
                $book['isbn'],
                $book['free_books_number'],
                $book['description'],
                $book['image']
            );
        }

        return $result;
    }
}