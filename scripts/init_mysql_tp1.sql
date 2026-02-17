-- Initialize database and accounts table for TP1
-- Run with: mysql -u root -p < scripts/init_mysql_tp1.sql

CREATE DATABASE IF NOT EXISTS `tp1` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tp1`;

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` TEXT,
  `email` TEXT,
  `password` TEXT,
  `enabled` TINYINT(1) NOT NULL DEFAULT 1,
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  `register_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `exercices` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` TEXT,
  `description` TEXT,
  `bodyparts` TEXT,
  `creatorId` INT UNSIGNED,
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_exercices_creator` FOREIGN KEY (`creatorId`) REFERENCES `accounts`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create default admin user
INSERT INTO `accounts` (username, email, password, is_admin, register_time)
SELECT 'admin', 'admin@example.com', 'admin', 1, NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `accounts` WHERE username = 'admin')
LIMIT 1;
