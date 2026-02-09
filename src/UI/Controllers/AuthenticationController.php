<?php

namespace src\UI\Controllers;

use Exception;
use src\Application\Services\AccountService;
use src\Domain\Entities\Account;

class AuthenticationController
{
    private AccountService $accountService;

    function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function authenticate(): void{
        $identifier = $_POST['identifier'] ?? '';
        $password = $_POST['password'] ?? '';

        $account = $this->accountService->getAccountByIdentifier($identifier);
        if ($account === null) {
            $_SESSION['flash_error'] = 'No user found for that identifier.';
            header('Location: ' . makeUrl('login'));
            exit();
        }

        if (!password_verify($password, $account->getPassword())) {
            $_SESSION['flash_error'] = 'Invalid credentials.';
            header('Location: ' . makeUrl('login'));
            exit();
        }

        // Regenerate session id to mitigate fixation
        session_regenerate_id(true);
        $_SESSION['username'] = $account->getUsername();
        $_SESSION['email'] = $account->getEmail();

        header('Location: ' . makeUrl('exercices'));
        exit();
    }
}