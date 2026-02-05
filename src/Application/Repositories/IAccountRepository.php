<?php

interface IAccountRepository {
    public function getById($id): ?Account;
    public function getAll(): array;
    public function delete(Account $account): bool;
    public function update(Account $account): Account;
    public function create(string $username, string $password): int;
}