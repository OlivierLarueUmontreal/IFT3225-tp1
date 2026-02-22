<?php

namespace src\Infrastructure\Repositories;

use DateTime;
use Exception;
use PDO;
use PDOException;
use src\Application\Repositories\IAccountRepository;
use src\Domain\Entities\Account;

class AccountRepository implements IAccountRepository
{
    private PDO $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function retrieveById($id): ?Account
    {
        $query = "SELECT * FROM accounts WHERE id = :id";
        $values = ['id' => $id];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrive account with id: {$id}, db Error: {$e->getMessage()}");
        }
        $result = $statement->fetch();
        if (!$result) return null;

        return $this->map($result);
    }

    public function retrieveByEmail($email): ?Account
    {
        $query = "SELECT * FROM accounts WHERE email = :email";
        $values = ['email' => $email];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrive account with email: {$email}, db Error: {$e->getMessage()}");
        }
        $result = $statement->fetch();
        if (!$result) return null;

        return $this->map($result);
    }

    public function retrieveByUsername($username): ?Account
    {
        $query = "SELECT * FROM accounts WHERE username = :username";
        $values = ['username' => $username];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrive account with username: {$username}, db Error: {$e->getMessage()}");
        }
        $result = $statement->fetch();
        if (!$result) return null;

        return $this->map($result);
    }

    public function retrieveByIdentifier($identifier): ?Account 
    {
        $query = "SELECT * FROM accounts WHERE username = :identifier OR email = :identifier";
        $values = ['identifier' => $identifier];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrive account with indentifier: {$identifier}, db Error: {$e->getMessage()}");
        }
        $result = $statement->fetch();
        if (!$result) return null;

        return $this->map($result);
    }

    public function retrieveAll(): array
    {
        $query = "SELECT * FROM accounts";
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
        } catch (PDOException $e) {
            throw new Exception("Could not retrieve all Accounts, db error: {$e->getMessage()}");
        }

        $result = $statement->fetchAll();
        if (!$result) return [];

        // doc: https://www.php.net/manual/en/function.array-map.php
        return array_map(function ($account) {
            return $this->map($account);
        }, $result);
    }

    public function delete(Account $account): bool
    {
        $query = "DELETE FROM accounts WHERE id = :id";
        $values = ['id' => $account->getId()];
        try {
            $statement = $this->pdo->prepare($query);
            return $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not delete account: {$e->getMessage()}");
        }
    }

    public function create(Account $account): ?Account
    {
        if(!(($this->retrieveByUsername($account->getUserName()) === null) && ($this->retrieveByEmail($account->getEmail()) === null))){
            return null;
        }

        $query = "INSERT INTO accounts (username, email, password) VALUES (:username, :email, :password);";
        $values = [
            'username' => $account->getUsername(),
            'email' => $account->getEmail(),
            'password' => $account->getPassword()
        ];

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not create user {$username}, db error: {$e->getMessage()}");
        }

        $lastId = $this->pdo->lastInsertId();
        return $this->retrieveById($lastId);
    }

    public function IsAdmin($id): bool
    {
        $account = $this->retrieveById($id);
        if ($account === null) return false;

        return $account->isAdmin();
    }

    private function map(array $data): Account
    {
        return new Account(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['enabled'],
            $data['register_time'],
            $data['is_admin']
        );
    }
}