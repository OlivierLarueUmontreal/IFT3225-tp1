<?php

namespace src\Application\Services;

use src\Application\Repositories\IAccountRepository;
use src\Domain\Entities\Account;

class AccountService
{
    private IAccountRepository $accountRepository;
    function __construct(IAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function createAccount(string $name, string $email, string $password): ?Account
    {
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $account = new Account(null, $name, $email, $pwd);
        return $this->accountRepository->create($account);
    }

    public function getAccountById(int $id): Account
    {
        return $this->accountRepository->retrieveById($id);
    }

    public function getAccountByIdentifier(string $identifier): ?Account
    {
        return $this->accountRepository->retrieveByIdentifier($identifier);
    }

    public function getAllAccounts(): array
    {
        return $this->accountRepository->retrieveAll();
    }

    public function deleteAccount(int $id): bool
    {
        return $this->accountRepository->delete($id);
    }
}