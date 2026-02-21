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

     public function showMyAccount(): void
    {
        $user_id = $_SESSION['user_id'];
        $myAccount = $this->accountService->getAccountById($user_id);

        require VIEWS_PATH . '/Accounts/my-account.php';
    }

    public function register(): void
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!preg_match($emailPattern, $sanitized_email))
            throw new Exception("Email invalid.");

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
        $_SESSION['is_admin'] = $account->isAdmin();

        header('Location: ' . makeUrl('exercices'));
    }
}