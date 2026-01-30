<?php

class Database
{
    private ?PDO $pdo = null;

    public function GetPdo(): PDO
    {
        if ($this->pdo !== null) return $this->pdo;

        $config = require __DIR__ . "/config/config.php"; // TODO figure out way to tell if we are in prod or in local otherwise, change the file name before deploying to prod
        $env = $config['app']['env'];
        $dbConfig = require __DIR__ . "/config/dbConfig_$env.php";

        try {
            $dsn = "mysql:host=$dbConfig[host];dbname=$dbConfig[db];";
            $this->pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['pwd']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }
    }
}