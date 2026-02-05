<?php

error_reporting(E_ALL);

require_once './config/config.php';
require_once './config/database.php';

$db = new DataBase();
$connection = $db->getPdo();

//Repositories
$AccountRepository = new AccountRepository($connection);


