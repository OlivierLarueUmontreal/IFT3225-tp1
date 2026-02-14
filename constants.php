<?php

require_once __DIR__ . "/config/config.php";

const ROOT_PATH = __DIR__;
const VIEWS_PATH = __DIR__ . '/src/UI/Views';
const CSS_PATH = __DIR__ . '/src/UI/CSS';


$config = require ROOT_PATH . "/config/config.php";
$env = $config['app']['env'];
if ($env == 'dev') {
    define('BASE_URL', '/IFT3225-tp1');
} else {
    define('BASE_URL', '/');
}

//TODO gerer cela dans le config bd pour le schema

/**
 * Helper Function to make url easily
 * providing empty string brings to home page.
 * example: makeurl('login') will bring you to basePath/login
 * @param string $subpath the path we want to reach using urls
 * @return string formated url with the base url
 */
function makeUrl(string $subpath = ''): string
{
    return BASE_URL . ($subpath ? '/' . ltrim($subpath) : '');
}