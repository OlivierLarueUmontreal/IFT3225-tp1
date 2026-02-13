<?php

namespace src\UI\Controllers;

use Exception;
use src\Application\Services\AccountService;

class AccountController
{
    private AccountService $accountService;

    function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function showAll(): void
    {
        $accounts = $this->accountService->getAllAccounts();

        $title = 'Liste des Comptes utilisateurs';
        require VIEWS_PATH . '/Accounts/accounts.php';
    }

    public function register(): void
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username))
            throw new Exception("Veuillez entrer le nom d'utilisateur");

        if (empty($email))
            throw new Exception("Veuillez entrer une adresse courriel");

        if (empty($password))
            throw new Exception("Veuillez entrer un mot de passe");

        $account = $this->accountService->createAccount($username, $email, $password);

        if (!isset($account))
            throw new Exception("Could not create account");

        // Regenerate session id to mitigate fixation
        session_regenerate_id(true);
        $_SESSION['user_id'] = $account->getId();
        $_SESSION['username'] = $account->getUsername();
        $_SESSION['email'] = $account->getEmail();

        header('Location: ' . makeUrl());
    }
}