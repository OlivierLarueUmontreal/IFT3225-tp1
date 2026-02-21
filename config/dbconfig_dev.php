<?php

// Read database credentials from environment variables with sensible defaults.
return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'db' => getenv('DB_NAME') ?: 'tp1',
    'username' => getenv('DB_USER') ?: 'admin',
    'pwd' => getenv('DB_PASS') ?: 'admin',
];