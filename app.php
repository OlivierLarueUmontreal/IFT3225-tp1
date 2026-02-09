<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './constants.php';
require_once './config/config.php';

// Autoloader - automatically finds and loads classes
// Inspiration: https://www.php.net/manual/en/language.oop5.autoload.php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
});

//start session and configure cookie setting
$cookieLifetime = 3600; // session valid for 1 hour

// $host = $_SERVER['HTTP_HOST'] ?? '';
// Strip port if present (cookies' domain must not include port)
// $cookieDomain = preg_replace('/:\d+$/', '', $host);

ini_set('session.gc_maxlifetime', (string)$cookieLifetime);

session_start([
    'cookie_lifetime' => $cookieLifetime,
    'cookie_path' => '/',
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);


// usings
use src\UI\Controllers\AccountController;
use src\UI\Controllers\AuthenticationController;
use src\Application\Services\AccountService;
use src\Infrastructure\DB\Database;
use src\Infrastructure\Repositories\AccountRepository;

$database = new DataBase();
$connection = $database->getPdo();

// repositories
$accountRepository = new AccountRepository($connection);

// Services
$accountService = new AccountService($accountRepository);

//Controllers
$accountController = new AccountController($accountService);
$authenticationController = new AuthenticationController($accountService);

//Router
include_once './routes.php';

// If we reach here, no route matched
http_response_code(404);
include_once './views/404.php';