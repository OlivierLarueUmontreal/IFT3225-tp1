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

use src\Infrastructure\DB\Database;
use src\Infrastructure\Repositories\AccountRepository;

$database = new DataBase();
$connection = $database->getPdo();
$AccountRepository = new AccountRepository($connection);

//Router
include_once './routes.php';

// If we reach here, no route matched
http_response_code(404);
include_once './views/404.php';