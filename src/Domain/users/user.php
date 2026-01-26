<?php

class user {
    private $id;
    private $username;
    private $email;
    private $passwordHash;
    public function __construct($id, $username, $email, $passwordHash) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    function __destruct() {
    echo "Name: " . $this->name . ". Color: " . $this->color .".<br>";
  }

    // Getters 
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
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