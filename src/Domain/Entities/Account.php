<?php

namespace src\Domain\Entities;

use DateTime;
use src\Domain\Entities\Base\BaseEntity;

class Account extends BaseEntity
{
    private ?string $username;
    private ?string $email;
    private ?string $passwordHash;
    private bool $authenticated;
    private ?string $createdAt;
    private bool $isAdmin;

    public function __construct($id, $username, $email, $passwordHash, $authenticated = false, $createdAt = null, bool $isAdmin = false)
    {
        parent::__construct($id);

        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->authenticated = $authenticated;
        $this->createdAt = $createdAt;
        $this->isAdmin = $isAdmin;
    }

    function __destruct()
    {
        echo "username: " . $this->username . ". Email: " . $this->email . ".<br>";
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->passwordHash;
    }

    public function getAuthenticated(): ?bool
    {
        return $this->authenticated;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    // Setters
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPasswordHash($passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }
}