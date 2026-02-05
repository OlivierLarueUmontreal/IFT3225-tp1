<?php
namespace src\Domain\Entities;
use src\Domain\Entities\Base\BaseEntity;

class Account extends BaseEntity
{
    private ?string $username;
    private ?string $email; // TODO needed ?
    private ?string $passwordHash;
    private bool $authenticated;

    public function __construct($id, $username, $email, $passwordHash, $authenticated = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->authenticated = $authenticated;
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

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    public function getAuthenticated(): ?bool
    {
        return $this->authenticated;
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
}