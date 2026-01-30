<?php

class Account implements BaseEntity { 
    private $username;
    private $email;
    private $passwordHash;
    private $authenticated;
    
    public function __construct($id, $username, $email, $passwordHash, $authenticated = false) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->authenticated = $authenticated;
    
    }

    function __destruct() {
    echo "username: " . $this->username . ". Email: " . $this->email .".<br>";
  }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getPasswordHash() :?string {
        return $this->passwordHash;
    }

    public function getAuthenticated() :?bool {
        return $this->authenticated;
    }

    // Setters 
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }
}