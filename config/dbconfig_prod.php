<?php

// Read database credentials from environment variables with sensible defaults.
return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'db' => getenv('DB_NAME') ?: 'nguyehun_tp1',
    'username' => getenv('DB_USER') ?: 'nguyehun',
    'pwd' => getenv('DB_PASS') ?: '',
];