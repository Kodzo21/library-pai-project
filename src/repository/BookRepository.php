<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../models/Author.php';
require_once __DIR__.'/../models/Category.php';


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

        return new Book($book['id'],$book['title'], $book['isbn'], $book['free_books_number'], $book['description'], $book['image'],0,0);
    }

    public function addBook(Book $book,$catID,$authorID): void
    {
        $db = $this->database->connect();
        try {
            $db->beginTransaction();
            $statement = $db->prepare(
                'Insert into books (title, isbn, category_id,free_books_number, description, image) values (?,?,?,?,?,?)'
            );
            $statement->execute([
                $book->getTitle(),
                $book->getIsbn(),
                $catID,
                $book->getFreeBooksNumber(),
                $book->getDescription(),
                $book->getImage()
            ]);

            $bookID = $db->lastInsertId();

            $statement = $db->prepare(
                'Insert into book_author (book_id, author_id) values (?,?)'
            );
            $statement->execute([
                $bookID, $authorID
            ]);
        }catch (Exception $e){
            $db->rollBack();
            die($e->getMessage());
        }
    }

    public function getBooks(): array
    {
        $result = [];
        $statement = $this->database->connect()->prepare('
           Select * from books order by id; 
        ');
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($books as $book) {
            $result[] = new Book(
                $book['id'],
                $book['title'],
                $book['isbn'],
                $book['free_books_number'],
                $book['description'],
                $book['image'],
                $book['like'],
                $book['dislike']
            );
        }

        return $result;
    }

    public function getBooksByTitle(string $search):array{
        $search = '%'.strtolower($search).'%';
        $statement = $this->database->connect()->prepare('
            Select * from books where lower(title) like :searchS;
        ');
        $statement->bindParam(':searchS',$search,PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id){
        $statement = $this->database->connect()->prepare('
            Update books Set "like" ="like"+1 where id=:id;
        ');
        $statement->bindParam(":id",$id,PDO::PARAM_INT);
        $statement->execute();
    }

    public function dislike(int $id){
        $statement = $this->database->connect()->prepare('
            Update books Set dislike =dislike+1 where id=:id;
        ');
        $statement->bindParam(":id",$id,PDO::PARAM_INT);
        $statement->execute();
    }

    public function getBooksByCategory($category)
    {
        //category jest juz strtolower
        $statement = $this->database->connect()->prepare(
            '
            Select * from book_view where lower(category_name) = :categoryName;
            '
        );
        $statement->bindParam(':categoryName',$category,PDO::PARAM_STR);
        $statement->execute();
        $books=  $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($books as $book) {
            $result[] = new Book(
                $book['id'],
                $book['title'],
                $book['isbn'],
                $book['free_books_number'],
                $book['description'],
                $book['image'],
                $book['like'],
                $book['dislike']
            );
        }
        return $result;
    }

    public function reserveBook($userID,$bookID){
        $db = $this->database->connect();
        try{
            $db->beginTransaction();
            $statement = $db->prepare('
                Update books set free_books_number = free_books_number-1 where id=:id and free_books_number>0;
            ');
            $statement->bindParam(':id',$userID);
            $statement->execute();

            $statement = $db->prepare('
                insert into book_borrows (user_id,book_id) values (?,?);
            ');
            $statement->execute([
                $userID,$bookID
            ]);
            $db->commit();
        }catch (Exception $e ){
            $db->rollBack();
        }
    }

    public function returnBook($userID,$bookID){
        $db = $this->database->connect();
        try{
            $db->beginTransaction();
            $statement = $db->prepare('
                Update books set free_books_number = free_books_number+1 where id=:id ;
            ');
            $statement->bindParam(':id',$userID);
            $statement->execute();

            $statement = $db->prepare('
                update book_borrows set return_time = :timestamp where user_id = :userID and book_id = :bookID and return_time is null;
            ');
            $timestamp = date("Y-m-d H:i:s",time());
            $statement->bindParam(':timestamp',$timestamp);
            $statement->bindParam(':userID',$userID);
            $statement->bindParam(':bookID',$bookID);
            $statement->execute();
            $db->commit();
        }catch (Exception $e ){
            $db->rollBack();
        }
    }

    public function getAuthors()
    {
        $statement = $this->database->connect()->prepare(
            '
            Select id,author from authors;
            '
        );

        $statement->execute();
        $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($authors as $author) {
            $result[] = new Author(
                $author['id'],
                $author['author']
            );
        }
        return $result;
    }

    public function getCategories()
    {
        $statement = $this->database->connect()->prepare(
            '
            Select id,category_name from categories;
            '
        );

        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            $result[] = new Category(
                $category['id'],
                $category['category_name']
            );
        }
        return $result;
    }
}