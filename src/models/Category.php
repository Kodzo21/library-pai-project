<?php

class Category
{

    private int $id;
    private string $category;

    /**
     * @param int $id
     * @param string $category
     */
    public function __construct(int $id, string $category)
    {
        $this->id = $id;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }




}