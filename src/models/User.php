<?php

class User
{
    private $email;
    private $password;
    private $username;
    private $id;
    private $user_role;

    public function __construct(string $email, string $password, string $username, int $id = 0, string $user_role = "client")
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->id = $id;
        $this->user_role = $user_role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserRole(): string
    {
        return $this->user_role;
    }

    public function setUserRole($user_role)
    {
        $this->user_role = $user_role;
    }
}
