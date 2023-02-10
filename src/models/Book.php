<?php

class Book
{
    private int $id;
    private string $title;
    private string $isbn;
    private int $freeBooksNumber;
    private string $description;
    private string $image;
    private int $like;
    private int $dislike;

    public function __construct(int $id, string $title, string $isbn, int $freeBooksNumber, string $description, string $image, int $like=0, int $dislike=0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->isbn = $isbn;
        $this->freeBooksNumber = $freeBooksNumber;
        $this->description = $description;
        $this->image = $image;
        $this->like = $like;
        $this->dislike = $dislike;
    }


    public function getTitle() :string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getDescription() :string
    {
        return $this->description;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getLike(): int
    {
        return $this->like;
    }

    public function setLike(int $like): void
    {
        $this->like = $like;
    }


    public function getDislike(): int
    {
        return $this->dislike;
    }


    public function setDislike(int $dislike): void
    {
        $this->dislike = $dislike;
    }


    public function getImage() :string
    {
        return $this->image;
    }


    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }


    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }


    public function getFreeBooksNumber(): int
    {
        return $this->freeBooksNumber;
    }


    public function setFreeBooksNumber(int $freeBooksNumber): void
    {
        $this->freeBooksNumber = $freeBooksNumber;
    }





}