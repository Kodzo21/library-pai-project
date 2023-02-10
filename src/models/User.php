<?php

class User
{
    private int $id;
    private string $role;
    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private string $phone;

    public function __construct(int $id,string $role,string $email, string $password, string $name, string $surname)
    {
        $this->id=$id;
        $this->role=$role;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getSurname(): string
    {
        return $this->surname;
    }


    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }


    public function getPhone() : ?string
    {
        return $this->phone ?? null;
    }


    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }


    public function getId():int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getRole(): string
    {
        return $this->role;
    }


    public function setRole(string $role): void
    {
        $this->role = $role;
    }






}