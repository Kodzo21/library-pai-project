<?php

class Session
{
    private string $id;
    private int $user_id;



    public function __construct(string $id,int $user_id)
    {
        $this->id = $id;
        $this->user_id=$user_id;

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }



    public function getUserId(): int
    {
        return $this->user_id;
    }


    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }


}