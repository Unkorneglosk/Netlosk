-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `netlosk_clients`;
CREATE TABLE `netlosk_clients` (
  `id` int(11) NOT NULL,
  `secret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `useAvatar` tinyint(1) NOT NULL DEFAULT 1,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `netlosk_connect`;
CREATE TABLE `netlosk_connect` (
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tries` tinyint(4) NOT NULL,
  `timeinsert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`uniqueid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `netlosk_mailverif`;
CREATE TABLE `netlosk_mailverif` (
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `activationkey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timesend` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uniqueid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `netlosk_passreset`;
CREATE TABLE `netlosk_passreset` (
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `resetkey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timesend` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uniqueid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `netlosk_users`;
CREATE TABLE `netlosk_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `passversion` int(11) NOT NULL DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `register_ip` text NOT NULL,
  `last_ip` text NOT NULL,
  `last_visit` text NOT NULL,
  `total_visits` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL,
  `mail_deactivated` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2020-05-14 04:12:24
