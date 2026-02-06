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

        if(empty($username))
            throw new Exception("Veuillez entrer le nom d'utilisateur");

        if (empty($email))
            throw new Exception("Veuillez entrer une adresse courriel");

        if (empty($password))
            throw new Exception("Veuillez entrer un mot de passe");

        $account = $this->accountService->createAccount($username, $email, $password);

        //TODO rediriger to an other page i guess
    }
}