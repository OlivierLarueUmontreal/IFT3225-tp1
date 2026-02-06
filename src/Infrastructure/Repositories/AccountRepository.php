<?php

namespace src\Infrastructure\Repositories;

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
            $statement = $this->pdo->prepare("DELETE FROM accounts WHERE id = :id");
            return $statement->execute();
        } catch (PDOException $e) {
            throw new Exception("Could not delete account: {$e->getMessage()}");
        }
    }

    public function save(Account $account): Account
    {
        if($account->getId() === null)
            return $this->create($account);

        return $this->update($account);
    }

    private function create(Account $account): Account
    {
        $query = "INSERT INTO accounts (username, password) VALUES (:username, :password);";
        $pwdHash = password_hash($account->getPassword(), PASSWORD_DEFAULT);
        $values = ['username' => $account->getUsername(), 'password' => $pwdHash];

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not create user {$username}, db error: {$e->getMessage()}");
        }

        $lastId = $this->pdo->lastInsertId();
        return $this->retrieveById($lastId);
    }

    private function update(Account $account): Account
    {
        $query = "UPDATE accounts SET username = :username, password = :password WHERE id = :id";
        $values = ['id' => $account->getId(), 'name' => $account->getUsername(), 'email' => $account->getEmail()];

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not update user: , db error: " . $e->getMessage());
        }

        return $account;
    }

    private function map(array $data): Account
    {
        // TODO do BD design to make sure the fields make sens
        return new Account(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['authenticated']
        );
    }
}