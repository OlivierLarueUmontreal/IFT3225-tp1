-- Initialize database and accounts table for TP1
-- Run with: mysql -u root -p < scripts/init_mysql_tp1.sql

CREATE DATABASE IF NOT EXISTS `tp1` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tp1`;

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` TEXT,
  `email` TEXT,
  `password` TEXT,
  `enabled` TINYINT(1) NOT NULL DEFAULT 1,
  `register_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
