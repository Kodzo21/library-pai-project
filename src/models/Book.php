<?php

class Book
{
    private string $title;
    private string $isbn;
    private int $freeBooksNumber;
    private string $description;
    private string $image;


    public function __construct(string $title, string $isbn, int $freeBooksNumber, string $description, string $image)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->freeBooksNumber = $freeBooksNumber;
        $this->description = $description;
        $this->image = $image;
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