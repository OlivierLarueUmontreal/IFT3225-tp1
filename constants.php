<?php

require_once __DIR__ . "/config/config.php";

const ROOT_PATH = __DIR__;
const VIEWS_PATH = __DIR__ . '/src/UI/Views';


$config = require ROOT_PATH . "/config/config.php";
$env = $config['app']['env'];
if ($env == 'dev') {
    define('BASE_URL', '/IFT3225-tp1');
} else {
    define('BASE_URL', '/');
}

// Helper Function to make url easily
function makeUrl(string $subpath = ''): string{
    return BASE_URL . ($subpath ? '/' . ltrim($subpath) : '');
}