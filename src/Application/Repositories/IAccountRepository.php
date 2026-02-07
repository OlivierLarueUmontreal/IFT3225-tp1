<?php

namespace src\Application\Repositories;

use src\Domain\Entities\Account;

interface IAccountRepository {
    public function retrieveById($id): ?Account;
    public function retrieveAll(): array;
    public function delete(Account $account): bool;
    public function save(Account $account): ?Account;
}