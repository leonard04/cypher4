-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cypher4
CREATE DATABASE IF NOT EXISTS `cypher4` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cypher4`;

-- Dumping structure for table cypher4.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.activity_log: ~638 rows (approximately)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
	(1, 'logout', 'admin logout', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:24:20', '2020-11-08 22:24:20'),
	(2, 'login', 'admin login', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(3, 'view', 'http://localhost/ritz/public/home', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(4, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(5, 'query', 'select * from `rms_modules` where `name` = ? and `rms_modules`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(6, 'query', 'select * from `rms_users_privileges` where `id_users` = ? and `id_rms_modules` = ? and `rms_users_privileges`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(7, 'query', 'select * from `rms_actions` where `rms_actions`.`id` in (1, 2, 3, 4, 5, 6, 7) and `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(8, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(9, 'query', 'insert into `activity_log` (`log_name`, `properties`, `causer_id`, `causer_type`, `description`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?, ?)', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:24:25', '2020-11-08 22:24:25'),
	(10, 'view', 'http://localhost/ritz/public/treasury', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(11, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(12, 'query', 'select * from `finance_treasure` where `company_id` = ? and `finance_treasure`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(13, 'query', 'select * from `finance_treasure_history` where `finance_treasure_history`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(14, 'query', 'select * from `finance_treasure_insert` where `company_id` = ? and `approved_at` is null and `finance_treasure_insert`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(15, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(16, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/treasury"}', '2020-11-08 22:25:10', '2020-11-08 22:25:10'),
	(17, 'view', 'http://localhost/ritz/public/home', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(18, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(19, 'query', 'select * from `rms_modules` where `name` = ? and `rms_modules`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(20, 'query', 'select * from `rms_users_privileges` where `id_users` = ? and `id_rms_modules` = ? and `rms_users_privileges`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(21, 'query', 'select * from `rms_actions` where `rms_actions`.`id` in (1, 2, 3, 4, 5, 6, 7) and `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(22, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:25:41', '2020-11-08 22:25:41'),
	(23, 'view', 'http://localhost/ritz/public/home', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(24, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\\\\\\\localhost\\\\ritz\\\\public\\\\home"}', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(25, 'query', 'select * from `rms_modules` where `name` = ? and `rms_modules`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\\\\\\\localhost\\\\ritz\\\\public\\\\home"}', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(26, 'query', 'select * from `rms_users_privileges` where `id_users` = ? and `id_rms_modules` = ? and `rms_users_privileges`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\\\\\\\localhost\\\\ritz\\\\public\\\\home"}', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(27, 'query', 'select * from `rms_actions` where `rms_actions`.`id` in (1, 2, 3, 4, 5, 6, 7) and `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\\\\\\\localhost\\\\ritz\\\\public\\\\home"}', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(28, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\\\\\\\localhost\\\\ritz\\\\public\\\\home"}', '2020-11-08 22:26:22', '2020-11-08 22:26:22'),
	(29, 'view', 'http://localhost/ritz/public/home', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(30, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(31, 'query', 'select * from `rms_modules` where `name` = ? and `rms_modules`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(32, 'query', 'select * from `rms_users_privileges` where `id_users` = ? and `id_rms_modules` = ? and `rms_users_privileges`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(33, 'query', 'select * from `rms_actions` where `rms_actions`.`id` in (1, 2, 3, 4, 5, 6, 7) and `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(34, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 22:26:53', '2020-11-08 22:26:53'),
	(35, 'view', 'http://localhost/ritz/public/company', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:28:30', '2020-11-08 22:28:30'),
	(36, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 22:28:30', '2020-11-08 22:28:30'),
	(37, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 22:28:30', '2020-11-08 22:28:30'),
	(38, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 22:28:30', '2020-11-08 22:28:30'),
	(39, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(40, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(41, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(42, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(43, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(44, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(45, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(46, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(47, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(48, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(49, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(50, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(51, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(52, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(53, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(54, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(55, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(56, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(57, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(58, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(59, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(60, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(61, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(62, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(63, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:31', '2020-11-08 22:28:31'),
	(64, 'user', 'You have updated user', 'App\\Models\\User', 6, 'App\\Models\\User', 1, '[]', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(65, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(66, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(67, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(68, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(69, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(70, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(71, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(72, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(73, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(74, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(75, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(76, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(77, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(78, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(79, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(80, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(81, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(82, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(83, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(84, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(85, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(86, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(87, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(88, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(89, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:28:38', '2020-11-08 22:28:38'),
	(90, 'user', 'You have updated user', 'App\\Models\\User', 6, 'App\\Models\\User', 1, '{"attributes":{"id":6,"company_id":1,"id_rms_roles_divisions":1,"name":"Rangga Anggara","email":"ranggaanggara8@gmail.com","position":null,"user_img":null,"access":null,"username":"rnggara","email_verified_at":null,"password":"$2y$10$PHVww\\/vZ8CvfZJBfgw0FMe2u5k8aHmRo6B8I3j9wQGTecOSGTchVm","remember_token":null,"created_at":"2020-11-09 04:10:09","updated_at":"2020-11-09 05:29:35"},"old":{"id":6,"company_id":1,"id_rms_roles_divisions":1,"name":"Rangga Anggara","email":"ranggaanggara8@gmail.com","position":null,"user_img":null,"access":null,"username":"rnggara","email_verified_at":null,"password":"$2y$10$KRU8pdAxttSnEd9Uvr6gdec3x2oXk.MypdgiZwXaPX0s50Hnit8C2","remember_token":null,"created_at":"2020-11-09 04:10:09","updated_at":"2020-11-09 05:28:38"}}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(91, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(92, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(93, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(94, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(95, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(96, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(97, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(98, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(99, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(100, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(101, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(102, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(103, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(104, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(105, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(106, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(107, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(108, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(109, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(110, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(111, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(112, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(113, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(114, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(115, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:35', '2020-11-08 22:29:35'),
	(116, 'user', 'You have updated user', 'App\\Models\\User', 6, 'App\\Models\\User', 1, '{"attributes":{"id":6,"company_id":1,"id_rms_roles_divisions":1,"name":"Rangga Anggara","email":"ranggaanggara8@gmail.com","position":null,"user_img":null,"access":null,"username":"rnggara","email_verified_at":null,"password":"$2y$10$E19zh326vReZZmDGJeScR.kWgGHlx9d7.3isQzVPmEySZJgO2rDy6","remember_token":null,"created_at":"2020-11-09 04:10:09","updated_at":"2020-11-09 05:29:57"},"old":{"id":6,"company_id":1,"id_rms_roles_divisions":1,"name":"Rangga Anggara","email":"ranggaanggara8@gmail.com","position":null,"user_img":null,"access":null,"username":"rnggara","email_verified_at":null,"password":"$2y$10$PHVww\\/vZ8CvfZJBfgw0FMe2u5k8aHmRo6B8I3j9wQGTecOSGTchVm","remember_token":null,"created_at":"2020-11-09 04:10:09","updated_at":"2020-11-09 05:29:35"}}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(117, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(118, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(119, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(120, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(121, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(122, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(123, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(124, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(125, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(126, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(127, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(128, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(129, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(130, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(131, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(132, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(133, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(134, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(135, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(136, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(137, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(138, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(139, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(140, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(141, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:29:57', '2020-11-08 22:29:57'),
	(142, 'user', 'You have updated user', 'App\\Models\\User', 6, 'App\\Models\\User', 1, '{"attributes":{"name":"Rangga Anggara 1","updated_at":"2020-11-09 05:31:29"},"old":{"name":"Rangga Anggara","updated_at":"2020-11-09 05:29:57"}}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(143, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(144, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(145, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(146, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(147, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(148, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(149, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(150, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(151, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(152, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(153, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(154, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(155, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(156, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(157, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(158, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(159, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(160, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(161, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(162, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(163, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(164, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(165, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(166, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(167, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 22:31:29', '2020-11-08 22:31:29'),
	(168, 'view', 'http://localhost/ritz/public/marketing/leads', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:47:27', '2020-11-08 22:47:27'),
	(169, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads"}', '2020-11-08 22:47:27', '2020-11-08 22:47:27'),
	(170, 'query', 'select * from `marketing_leads` where `company_id` = ? and `marketing_leads`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads"}', '2020-11-08 22:47:27', '2020-11-08 22:47:27'),
	(171, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads"}', '2020-11-08 22:47:27', '2020-11-08 22:47:27'),
	(172, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads"}', '2020-11-08 22:47:27', '2020-11-08 22:47:27'),
	(173, 'view', 'http://localhost/ritz/public/marketing/leads/view/1', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(174, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(175, 'query', 'select * from `marketing_leads` where `id` = ? and `marketing_leads`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(176, 'query', 'select * from `marketing_lead_files` where `id_lead` = ? and `marketing_lead_files`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(177, 'query', 'select * from `marketing_lead_meetings` where `id_lead` = ? and `marketing_lead_meetings`.`deleted_at` is null order by `start_time` asc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(178, 'query', 'select * from `marketing_lead_notes` where `id_leads` = ? and `marketing_lead_notes`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(179, 'query', 'select * from `marketing_lead_tasks` where `id_lead` = ? and `marketing_lead_tasks`.`deleted_at` is null order by `due_date` asc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(180, 'query', 'select * from `marketing_lead_contracts` where `id_lead` = ? and `marketing_lead_contracts`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(181, 'query', 'select * from `marketing_lead_notes` where `marketing_lead_notes`.`id` = ? and `marketing_lead_notes`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(182, 'query', 'select * from `marketing_lead_meetings` where `marketing_lead_meetings`.`id` = ? and `marketing_lead_meetings`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(183, 'query', 'select * from `marketing_lead_meetings` where `marketing_lead_meetings`.`id` = ? and `marketing_lead_meetings`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(184, 'query', 'select * from `marketing_lead_tasks` where `marketing_lead_tasks`.`id` = ? and `marketing_lead_tasks`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(185, 'query', 'select * from `marketing_lead_contracts` where `marketing_lead_contracts`.`id` = ? and `marketing_lead_contracts`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(186, 'query', 'select * from `marketing_lead_contracts` where `marketing_lead_contracts`.`id` = ? and `marketing_lead_contracts`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(187, 'query', 'select * from `file_managements`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(188, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(189, 'query', 'select * from `users` where `company_id` = ?', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(190, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(191, 'marketing_leads', 'This model has been updated', 'App\\Models\\Marketing_leads', 1, 'App\\Models\\User', 1, '{"attributes":{"updated_at":"2020-11-09 05:47:30"},"old":{"updated_at":"2020-11-04 08:56:52"}}', '2020-11-08 22:47:30', '2020-11-08 22:47:30'),
	(192, 'marketing_lead_notes', 'This model has been created', 'App\\Models\\Marketing_lead_notes', 2, 'App\\Models\\User', 1, '{"attributes":{"id":2,"id_leads":1,"notes":"tes","created_at":"2020-11-09 05:48:58","updated_at":"2020-11-09 05:48:58","deleted_at":null,"created_by":"admin","updated_ by":null,"deleted_by":null,"company_id":1}}', '2020-11-08 22:48:58', '2020-11-08 22:48:58'),
	(193, 'view', 'http://localhost/ritz/public/marketing/leads/view/1', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(194, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(195, 'query', 'select * from `marketing_leads` where `id` = ? and `marketing_leads`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(196, 'query', 'select * from `marketing_lead_files` where `id_lead` = ? and `marketing_lead_files`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(197, 'query', 'select * from `marketing_lead_meetings` where `id_lead` = ? and `marketing_lead_meetings`.`deleted_at` is null order by `start_time` asc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(198, 'query', 'select * from `marketing_lead_notes` where `id_leads` = ? and `marketing_lead_notes`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(199, 'query', 'select * from `marketing_lead_tasks` where `id_lead` = ? and `marketing_lead_tasks`.`deleted_at` is null order by `due_date` asc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(200, 'query', 'select * from `marketing_lead_contracts` where `id_lead` = ? and `marketing_lead_contracts`.`deleted_at` is null order by `created_at` desc limit 20', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(201, 'query', 'select * from `marketing_lead_notes` where `marketing_lead_notes`.`id` = ? and `marketing_lead_notes`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(202, 'query', 'select * from `marketing_lead_notes` where `marketing_lead_notes`.`id` = ? and `marketing_lead_notes`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(203, 'query', 'select * from `marketing_lead_meetings` where `marketing_lead_meetings`.`id` = ? and `marketing_lead_meetings`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(204, 'query', 'select * from `marketing_lead_meetings` where `marketing_lead_meetings`.`id` = ? and `marketing_lead_meetings`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(205, 'query', 'select * from `marketing_lead_tasks` where `marketing_lead_tasks`.`id` = ? and `marketing_lead_tasks`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(206, 'query', 'select * from `marketing_lead_contracts` where `marketing_lead_contracts`.`id` = ? and `marketing_lead_contracts`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(207, 'query', 'select * from `marketing_lead_contracts` where `marketing_lead_contracts`.`id` = ? and `marketing_lead_contracts`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(208, 'query', 'select * from `file_managements`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(209, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(210, 'query', 'select * from `users` where `company_id` = ?', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(211, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/leads\\/view\\/1"}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(212, 'marketing_leads', 'This model has been updated', 'App\\Models\\Marketing_leads', 1, 'App\\Models\\User', 1, '{"attributes":{"updated_at":"2020-11-09 05:48:59"},"old":{"updated_at":"2020-11-09 05:47:30"}}', '2020-11-08 22:48:59', '2020-11-08 22:48:59'),
	(213, 'view', 'http://localhost/ritz/public/home', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(214, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(215, 'query', 'select * from `rms_modules` where `name` = ? and `rms_modules`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(216, 'query', 'select * from `rms_users_privileges` where `id_users` = ? and `id_rms_modules` = ? and `rms_users_privileges`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(217, 'query', 'select * from `rms_actions` where `rms_actions`.`id` in (1, 2, 3, 4, 5, 6, 7) and `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(218, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/home"}', '2020-11-08 23:38:40', '2020-11-08 23:38:40'),
	(219, 'view', 'http://localhost/ritz/public/company', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:38:43', '2020-11-08 23:38:43'),
	(220, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 23:38:43', '2020-11-08 23:38:43'),
	(221, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 23:38:43', '2020-11-08 23:38:43'),
	(222, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company"}', '2020-11-08 23:38:43', '2020-11-08 23:38:43'),
	(223, 'view', 'http://localhost/ritz/public/company/detail/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(224, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(225, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(226, 'query', 'select * from `config_company`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(227, 'query', 'select `users`.*, `users`.`id_rms_roles_divisions` as `userRoleDivId`, `rms_roles_divisions`.`id_rms_roles` as `userRoleId`, `rms_roles_divisions`.`id_rms_divisions` as `userDivId`, `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName` from `users` left join `rms_roles_divisions` on `rms_roles_divisions`.`id` = `users`.`id_rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `company_id` = ? order by `users`.`username` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(228, 'query', 'select `id_rms_roles_divisions` from `rms_roles_privileges` where `rms_roles_privileges`.`deleted_at` is null group by `id_rms_roles_divisions`', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(229, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles_divisions`.`id` as `id`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId` from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id` in (?) and `rms_roles_divisions`.`deleted_at` is null order by `rms_roles`.`name` asc', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(230, 'query', 'select `name`, `id` from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(231, 'query', 'select `name`, `id` from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(232, 'query', 'select * from `rms_roles_divisions` where `id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(233, 'query', 'select `rms_roles`.`name` as `roleName`, `rms_divisions`.`name` as `divName`, `rms_roles`.`id` as `roleId`, `rms_divisions`.`id` as `divId`, `rms_roles_divisions`.* from `rms_roles_divisions` left join `rms_roles` on `rms_roles`.`id` = `rms_roles_divisions`.`id_rms_roles` left join `rms_divisions` on `rms_divisions`.`id` = `rms_roles_divisions`.`id_rms_divisions` where `rms_roles_divisions`.`id_company` = ? and `rms_roles_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(234, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(235, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(236, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(237, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(238, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` is null and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(239, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(240, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(241, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(242, 'query', 'select * from `rms_roles_divisions` where `rms_roles_divisions`.`id` = ? and `rms_roles_divisions`.`deleted_at` is null limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(243, 'query', 'select * from `rms_roles` where `id_company` = ? and `rms_roles`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(244, 'query', 'select * from `rms_divisions` where `id_company` = ? and `rms_divisions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(245, 'query', 'select * from `rms_modules` where `rms_modules`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(246, 'query', 'select * from `rms_actions` where `rms_actions`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(247, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/company\\/detail\\/MQ=="}', '2020-11-08 23:38:45', '2020-11-08 23:38:45'),
	(248, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:38:46', '2020-11-08 23:38:46'),
	(249, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:38:46', '2020-11-08 23:38:46'),
	(250, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:38:46', '2020-11-08 23:38:46'),
	(251, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:38:46', '2020-11-08 23:38:46'),
	(252, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:38:46', '2020-11-08 23:38:46'),
	(253, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:39:00', '2020-11-08 23:39:00'),
	(254, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:39:00', '2020-11-08 23:39:00'),
	(255, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:39:00', '2020-11-08 23:39:00'),
	(256, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:39:00', '2020-11-08 23:39:00'),
	(257, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:39:00', '2020-11-08 23:39:00'),
	(258, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:40:31', '2020-11-08 23:40:31'),
	(259, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:31', '2020-11-08 23:40:31'),
	(260, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:31', '2020-11-08 23:40:31'),
	(261, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:31', '2020-11-08 23:40:31'),
	(262, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:31', '2020-11-08 23:40:31'),
	(263, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:40:45', '2020-11-08 23:40:45'),
	(264, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:45', '2020-11-08 23:40:45'),
	(265, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:45', '2020-11-08 23:40:45'),
	(266, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:45', '2020-11-08 23:40:45'),
	(267, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:40:45', '2020-11-08 23:40:45'),
	(268, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:54:04', '2020-11-08 23:54:04'),
	(269, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:04', '2020-11-08 23:54:04'),
	(270, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:04', '2020-11-08 23:54:04'),
	(271, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:04', '2020-11-08 23:54:04'),
	(272, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:04', '2020-11-08 23:54:04'),
	(273, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:54:30', '2020-11-08 23:54:30'),
	(274, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:30', '2020-11-08 23:54:30'),
	(275, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:30', '2020-11-08 23:54:30'),
	(276, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:30', '2020-11-08 23:54:30'),
	(277, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:30', '2020-11-08 23:54:30'),
	(278, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:54:34', '2020-11-08 23:54:34'),
	(279, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:34', '2020-11-08 23:54:34'),
	(280, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:34', '2020-11-08 23:54:34'),
	(281, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:34', '2020-11-08 23:54:34'),
	(282, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:34', '2020-11-08 23:54:34'),
	(283, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:54:41', '2020-11-08 23:54:41'),
	(284, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:41', '2020-11-08 23:54:41'),
	(285, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:41', '2020-11-08 23:54:41'),
	(286, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:41', '2020-11-08 23:54:41'),
	(287, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:41', '2020-11-08 23:54:41'),
	(288, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:54:54', '2020-11-08 23:54:54'),
	(289, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:54', '2020-11-08 23:54:54'),
	(290, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:54', '2020-11-08 23:54:54'),
	(291, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:54', '2020-11-08 23:54:54'),
	(292, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:54:54', '2020-11-08 23:54:54'),
	(293, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:55:28', '2020-11-08 23:55:28'),
	(294, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:28', '2020-11-08 23:55:28'),
	(295, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:28', '2020-11-08 23:55:28'),
	(296, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:28', '2020-11-08 23:55:28'),
	(297, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:28', '2020-11-08 23:55:28'),
	(298, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:55:30', '2020-11-08 23:55:30'),
	(299, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:30', '2020-11-08 23:55:30'),
	(300, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:30', '2020-11-08 23:55:30'),
	(301, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:30', '2020-11-08 23:55:30'),
	(302, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:55:30', '2020-11-08 23:55:30'),
	(303, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:56:21', '2020-11-08 23:56:21'),
	(304, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:56:21', '2020-11-08 23:56:21'),
	(305, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:56:21', '2020-11-08 23:56:21'),
	(306, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:56:21', '2020-11-08 23:56:21'),
	(307, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:56:21', '2020-11-08 23:56:21'),
	(308, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:58:38', '2020-11-08 23:58:38'),
	(309, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:38', '2020-11-08 23:58:38'),
	(310, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:38', '2020-11-08 23:58:38'),
	(311, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:38', '2020-11-08 23:58:38'),
	(312, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:38', '2020-11-08 23:58:38'),
	(313, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-08 23:58:49', '2020-11-08 23:58:49'),
	(314, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:49', '2020-11-08 23:58:49'),
	(315, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:49', '2020-11-08 23:58:49'),
	(316, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:49', '2020-11-08 23:58:49'),
	(317, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-08 23:58:49', '2020-11-08 23:58:49'),
	(318, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:02:59', '2020-11-09 00:02:59'),
	(319, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:02:59', '2020-11-09 00:02:59'),
	(320, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:02:59', '2020-11-09 00:02:59'),
	(321, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:02:59', '2020-11-09 00:02:59'),
	(322, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:02:59', '2020-11-09 00:02:59'),
	(323, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:03:07', '2020-11-09 00:03:07'),
	(324, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:07', '2020-11-09 00:03:07'),
	(325, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:07', '2020-11-09 00:03:07'),
	(326, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:07', '2020-11-09 00:03:07'),
	(327, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:07', '2020-11-09 00:03:07'),
	(328, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:03:23', '2020-11-09 00:03:23'),
	(329, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:23', '2020-11-09 00:03:23'),
	(330, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:23', '2020-11-09 00:03:23'),
	(331, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:23', '2020-11-09 00:03:23'),
	(332, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:03:23', '2020-11-09 00:03:23'),
	(333, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:06:41', '2020-11-09 00:06:41'),
	(334, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:06:41', '2020-11-09 00:06:41'),
	(335, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:06:41', '2020-11-09 00:06:41'),
	(336, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:06:41', '2020-11-09 00:06:41'),
	(337, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:06:41', '2020-11-09 00:06:41'),
	(338, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:07:06', '2020-11-09 00:07:06'),
	(339, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:06', '2020-11-09 00:07:06'),
	(340, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:06', '2020-11-09 00:07:06'),
	(341, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:06', '2020-11-09 00:07:06'),
	(342, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:06', '2020-11-09 00:07:06'),
	(343, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:07:29', '2020-11-09 00:07:29'),
	(344, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:29', '2020-11-09 00:07:29'),
	(345, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:29', '2020-11-09 00:07:29'),
	(346, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:29', '2020-11-09 00:07:29'),
	(347, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:07:29', '2020-11-09 00:07:29'),
	(348, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:12:18', '2020-11-09 00:12:18'),
	(349, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:12:18', '2020-11-09 00:12:18'),
	(350, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:12:18', '2020-11-09 00:12:18'),
	(351, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:12:18', '2020-11-09 00:12:18'),
	(352, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:12:18', '2020-11-09 00:12:18'),
	(353, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(354, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(355, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(356, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(357, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(358, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:16:40', '2020-11-09 00:16:40'),
	(359, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(360, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(361, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(362, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(363, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(364, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:26:27', '2020-11-09 00:26:27'),
	(365, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(366, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(367, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(368, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(369, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(370, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:27:47', '2020-11-09 00:27:47'),
	(371, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(372, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(373, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(374, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(375, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(376, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:04', '2020-11-09 00:28:04'),
	(377, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(378, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(379, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(380, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(381, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(382, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:28:26', '2020-11-09 00:28:26'),
	(383, 'view', 'http://localhost/ritz/public/marketing/projects', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(384, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(385, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(386, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(387, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(388, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(389, 'query', 'select max(`id`) as aggregate from `marketing_projects` where `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(390, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:37:10', '2020-11-09 00:37:10'),
	(391, 'view', 'http://localhost/ritz/public/marketing/projects', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(392, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(393, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(394, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(395, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(396, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(397, 'query', 'select max(`id`) as aggregate from `marketing_projects` where `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(398, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 00:45:13', '2020-11-09 00:45:13'),
	(399, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(400, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(401, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(402, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(403, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(404, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:14', '2020-11-09 00:45:14'),
	(405, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(406, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(407, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(408, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(409, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(410, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:24', '2020-11-09 00:45:24'),
	(411, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(412, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(413, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(414, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(415, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(416, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:35', '2020-11-09 00:45:35'),
	(417, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(418, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(419, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(420, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(421, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(422, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:39', '2020-11-09 00:45:39'),
	(423, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(424, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(425, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(426, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(427, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(428, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:45:52', '2020-11-09 00:45:52'),
	(429, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(430, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(431, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(432, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(433, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(434, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:46:18', '2020-11-09 00:46:18'),
	(435, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(436, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(437, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(438, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(439, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(440, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:20', '2020-11-09 00:48:20'),
	(441, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(442, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(443, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(444, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(445, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(446, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:28', '2020-11-09 00:48:28'),
	(447, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(448, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(449, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(450, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(451, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(452, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:48:56', '2020-11-09 00:48:56'),
	(453, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(454, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(455, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(456, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(457, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(458, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:49:16', '2020-11-09 00:49:16'),
	(459, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(460, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(461, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(462, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(463, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(464, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:05', '2020-11-09 00:51:05'),
	(465, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(466, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(467, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(468, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(469, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(470, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:51:46', '2020-11-09 00:51:46'),
	(471, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(472, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(473, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(474, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(475, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(476, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:48', '2020-11-09 00:52:48'),
	(477, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(478, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(479, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(480, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(481, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(482, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:52:54', '2020-11-09 00:52:54'),
	(483, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(484, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(485, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(486, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(487, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(488, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 00:54:29', '2020-11-09 00:54:29'),
	(489, 'view', 'http://localhost/ritz/public/marketing/projects', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(490, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(491, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(492, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(493, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(494, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(495, 'query', 'select max(`id`) as aggregate from `marketing_projects` where `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(496, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:16', '2020-11-09 02:47:16'),
	(497, 'view', 'http://localhost/ritz/public/marketing/projects', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(498, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(499, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(500, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(501, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(502, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(503, 'query', 'select max(`id`) as aggregate from `marketing_projects` where `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(504, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:47:56', '2020-11-09 02:47:56'),
	(505, 'view', 'http://localhost/ritz/public/marketing/projects', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(506, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(507, 'query', 'select * from `marketing_clients` where `company_id` = ? and `marketing_clients`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(508, 'query', 'select * from `marketing_projects` where `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(509, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(510, 'query', 'select * from `marketing_projects` where `category` = ? and `company_id` = ? and `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(511, 'query', 'select max(`id`) as aggregate from `marketing_projects` where `marketing_projects`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(512, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/marketing\\/projects"}', '2020-11-09 02:49:32', '2020-11-09 02:49:32'),
	(513, 'login', 'admin login', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 05:55:49', '2020-11-09 05:55:49'),
	(514, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(515, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(516, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(517, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(518, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(519, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 05:55:50', '2020-11-09 05:55:50'),
	(520, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(521, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(522, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(523, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(524, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(525, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:04', '2020-11-09 06:03:04'),
	(526, 'view', 'http://localhost/ritz/public/dirut/preference/MQ==', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(527, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(528, 'query', 'select * from `preference_config` where `id_company` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(529, 'query', 'select * from `template_files` where `company_id` = ? and `template_files`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(530, 'query', 'select * from `config_company` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(531, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/dirut\\/preference\\/MQ=="}', '2020-11-09 06:03:10', '2020-11-09 06:03:10'),
	(532, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:06:40', '2020-11-09 06:06:40'),
	(533, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:06:40', '2020-11-09 06:06:40'),
	(534, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:06:40', '2020-11-09 06:06:40'),
	(535, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:08:17', '2020-11-09 06:08:17'),
	(536, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:17', '2020-11-09 06:08:17'),
	(537, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:17', '2020-11-09 06:08:17'),
	(538, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:08:26', '2020-11-09 06:08:26'),
	(539, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:26', '2020-11-09 06:08:26'),
	(540, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:26', '2020-11-09 06:08:26'),
	(541, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:08:41', '2020-11-09 06:08:41'),
	(542, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:41', '2020-11-09 06:08:41'),
	(543, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:08:41', '2020-11-09 06:08:41'),
	(544, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:09:54', '2020-11-09 06:09:54'),
	(545, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:09:54', '2020-11-09 06:09:54'),
	(546, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:09:54', '2020-11-09 06:09:54'),
	(547, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:10:03', '2020-11-09 06:10:03'),
	(548, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:03', '2020-11-09 06:10:03'),
	(549, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:03', '2020-11-09 06:10:03'),
	(550, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:10:23', '2020-11-09 06:10:23'),
	(551, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:23', '2020-11-09 06:10:23'),
	(552, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:23', '2020-11-09 06:10:23'),
	(553, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:10:54', '2020-11-09 06:10:54'),
	(554, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:54', '2020-11-09 06:10:54'),
	(555, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:10:54', '2020-11-09 06:10:54'),
	(556, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:03', '2020-11-09 06:11:03'),
	(557, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:03', '2020-11-09 06:11:03'),
	(558, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:03', '2020-11-09 06:11:03'),
	(559, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:09', '2020-11-09 06:11:09'),
	(560, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:09', '2020-11-09 06:11:09'),
	(561, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:09', '2020-11-09 06:11:09'),
	(562, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:37', '2020-11-09 06:11:37'),
	(563, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:37', '2020-11-09 06:11:37'),
	(564, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:37', '2020-11-09 06:11:37'),
	(565, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:46', '2020-11-09 06:11:46'),
	(566, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:46', '2020-11-09 06:11:46'),
	(567, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:46', '2020-11-09 06:11:46'),
	(568, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:54', '2020-11-09 06:11:54'),
	(569, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:54', '2020-11-09 06:11:54'),
	(570, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:54', '2020-11-09 06:11:54'),
	(571, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:11:59', '2020-11-09 06:11:59'),
	(572, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:59', '2020-11-09 06:11:59'),
	(573, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:11:59', '2020-11-09 06:11:59'),
	(574, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:12:10', '2020-11-09 06:12:10'),
	(575, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:10', '2020-11-09 06:12:10'),
	(576, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:10', '2020-11-09 06:12:10'),
	(577, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:12:29', '2020-11-09 06:12:29'),
	(578, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:29', '2020-11-09 06:12:29'),
	(579, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:29', '2020-11-09 06:12:29'),
	(580, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:12:47', '2020-11-09 06:12:47'),
	(581, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:47', '2020-11-09 06:12:47'),
	(582, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:47', '2020-11-09 06:12:47'),
	(583, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:12:57', '2020-11-09 06:12:57'),
	(584, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:57', '2020-11-09 06:12:57'),
	(585, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:12:57', '2020-11-09 06:12:57'),
	(586, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:13:02', '2020-11-09 06:13:02'),
	(587, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:02', '2020-11-09 06:13:02'),
	(588, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:02', '2020-11-09 06:13:02'),
	(589, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:13:15', '2020-11-09 06:13:15'),
	(590, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:15', '2020-11-09 06:13:15'),
	(591, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:15', '2020-11-09 06:13:15'),
	(592, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:13:30', '2020-11-09 06:13:30'),
	(593, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:30', '2020-11-09 06:13:30'),
	(594, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:13:30', '2020-11-09 06:13:30'),
	(595, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:14:20', '2020-11-09 06:14:20'),
	(596, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:20', '2020-11-09 06:14:20'),
	(597, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:20', '2020-11-09 06:14:20'),
	(598, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:14:31', '2020-11-09 06:14:31'),
	(599, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:31', '2020-11-09 06:14:31'),
	(600, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:31', '2020-11-09 06:14:31'),
	(601, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:14:37', '2020-11-09 06:14:37'),
	(602, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:37', '2020-11-09 06:14:37'),
	(603, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:14:37', '2020-11-09 06:14:37'),
	(604, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:15:47', '2020-11-09 06:15:47'),
	(605, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:15:47', '2020-11-09 06:15:47'),
	(606, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:15:47', '2020-11-09 06:15:47'),
	(607, 'te_equipment_list_category', 'This model has been created', 'App\\Models\\Te_equipment_list_category', 1, 'App\\Models\\User', 1, '{"attributes":{"id":1,"category_name":"Separator","tag":"SEP","company_id":null,"created_at":"2020-11-09 13:17:51","created_by":"admin","deleted_at":null,"deleted_by":null,"updated_at":"2020-11-09 13:17:51","updated_by":null}}', '2020-11-09 06:17:51', '2020-11-09 06:17:51'),
	(608, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:17:51', '2020-11-09 06:17:51'),
	(609, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:17:51', '2020-11-09 06:17:51'),
	(610, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:17:51', '2020-11-09 06:17:51'),
	(611, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:21:32', '2020-11-09 06:21:32'),
	(612, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:21:32', '2020-11-09 06:21:32'),
	(613, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:21:32', '2020-11-09 06:21:32'),
	(614, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:21:32', '2020-11-09 06:21:32'),
	(615, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:22:01', '2020-11-09 06:22:01'),
	(616, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:01', '2020-11-09 06:22:01'),
	(617, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:01', '2020-11-09 06:22:01'),
	(618, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:01', '2020-11-09 06:22:01'),
	(619, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:22:28', '2020-11-09 06:22:28'),
	(620, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:28', '2020-11-09 06:22:28'),
	(621, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:28', '2020-11-09 06:22:28'),
	(622, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:28', '2020-11-09 06:22:28'),
	(623, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:22:36', '2020-11-09 06:22:36'),
	(624, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:36', '2020-11-09 06:22:36'),
	(625, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:36', '2020-11-09 06:22:36'),
	(626, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:36', '2020-11-09 06:22:36'),
	(627, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:22:53', '2020-11-09 06:22:53'),
	(628, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:53', '2020-11-09 06:22:53'),
	(629, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:53', '2020-11-09 06:22:53'),
	(630, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:22:53', '2020-11-09 06:22:53'),
	(631, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:23:01', '2020-11-09 06:23:01'),
	(632, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:01', '2020-11-09 06:23:01'),
	(633, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:01', '2020-11-09 06:23:01'),
	(634, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:01', '2020-11-09 06:23:01'),
	(635, 'view', 'http://localhost/ritz/public/techincal-engineering/equipment-list', NULL, NULL, 'App\\Models\\User', 1, '[]', '2020-11-09 06:23:38', '2020-11-09 06:23:38'),
	(636, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:38', '2020-11-09 06:23:38'),
	(637, 'query', 'select * from `te_equipment_list_category` where `company_id` = ? and `te_equipment_list_category`.`deleted_at` is null', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:38', '2020-11-09 06:23:38'),
	(638, 'query', 'select * from `users` where `id` = ? limit 1', NULL, NULL, 'App\\Models\\User', 1, '{"url":"http:\\/\\/localhost\\/ritz\\/public\\/techincal-engineering\\/equipment-list"}', '2020-11-09 06:23:38', '2020-11-09 06:23:38');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- Dumping structure for table cypher4.application_master
CREATE TABLE IF NOT EXISTS `application_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_logo` text DEFAULT '0',
  `dashboard_logo` text DEFAULT '0',
  `footer_tag` text DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.application_master: ~0 rows (approximately)
/*!40000 ALTER TABLE `application_master` DISABLE KEYS */;
INSERT INTO `application_master` (`id`, `login_logo`, `dashboard_logo`, `footer_tag`, `created_at`, `deleted_at`, `updated_at`) VALUES
	(1, 'login_logo.png', 'logo.png', 'Enterprise Resource Planning', '2020-10-05 10:32:57', NULL, '2020-10-05 10:32:59');
/*!40000 ALTER TABLE `application_master` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_gr
CREATE TABLE IF NOT EXISTS `asset_gr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` int(11) DEFAULT NULL,
  `po_num` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gr_date` datetime DEFAULT NULL,
  `wh_id` int(11) DEFAULT NULL COMMENT 'kode warehouse',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `gr_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_gr: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_gr` DISABLE KEYS */;
INSERT INTO `asset_gr` (`id`, `po_id`, `po_num`, `gr_date`, `wh_id`, `created_at`, `updated_at`, `deleted_at`, `gr_by`, `notes`) VALUES
	(1, NULL, '001/VGI/PO/XI/20', '2020-11-11 00:00:00', 4, '2020-11-12 13:49:37', '2020-11-12 13:49:37', NULL, 'cypher', '<p>tes ok</p>'),
	(2, NULL, '002/VGI/PO/XI/20', '2020-11-13 00:00:00', 4, '2020-11-13 06:40:42', '2020-11-13 06:40:42', NULL, 'cypher', '<p>1</p>');
/*!40000 ALTER TABLE `asset_gr` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_items
CREATE TABLE IF NOT EXISTS `asset_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'berisi kode barang utk barcode',
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nama barang',
  `item_series` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'isi kategori ada di file categories.php',
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `uom` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'unit of measurement. misal: kg, unit, pcs, galon, box dsb.',
  `price` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `minimal_stock` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_wh` int(11) DEFAULT NULL COMMENT 'lokasi warehouse terakhir',
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `bast` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_items: ~3 rows (approximately)
/*!40000 ALTER TABLE `asset_items` DISABLE KEYS */;
INSERT INTO `asset_items` (`id`, `item_code`, `name`, `item_series`, `category_id`, `type_id`, `uom`, `price`, `supplier`, `minimal_stock`, `notes`, `specification`, `picture`, `last_wh`, `serial_number`, `location`, `purchase_date`, `bast`, `holder`, `condition`, `penalty`, `company_id`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(3, 'PEN001', 'PENSIL 2B', 'PEN', 4, 2, 'ea', 1000, 0, 10, 'notes', 'spec', NULL, NULL, '001', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-12 02:20:20', NULL, NULL, NULL, '2020-11-12 02:20:20', NULL),
	(4, 'PEN002', 'BALLPOINT FASTER HITAM 2', 'PEN', 4, 1, 'ea', 1000, 1, 1, '1', '2', NULL, NULL, 'PEN002', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-12 04:05:16', NULL, NULL, NULL, '2020-11-13 06:54:38', NULL),
	(5, 'DWT 02', 'Deep Wheel Track 02', '002', 2, 1, 'kg', 1000, 1, 10, 'asdasd', 'asdasdasd', 'DWT 02-2020_11_23.png', NULL, '002', NULL, NULL, NULL, NULL, NULL, NULL, 17, '2020-11-23 04:36:01', NULL, NULL, NULL, '2020-11-23 04:36:01', NULL);
/*!40000 ALTER TABLE `asset_items` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_items_update
CREATE TABLE IF NOT EXISTS `asset_items_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `item_code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'berisi kode barang utk barcode',
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nama barang',
  `item_series` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'isi kategori ada di file categories.php',
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `uom` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'unit of measurement. misal: kg, unit, pcs, galon, box dsb.',
  `price` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `minimal_stock` int(11) NOT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_wh` int(11) DEFAULT NULL COMMENT 'lokasi warehouse terakhir',
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `bast` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cypher4.asset_items_update: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_items_update` DISABLE KEYS */;
INSERT INTO `asset_items_update` (`id`, `id_item`, `item_code`, `name`, `item_series`, `category_id`, `type_id`, `uom`, `price`, `supplier`, `minimal_stock`, `notes`, `specification`, `picture`, `last_wh`, `serial_number`, `location`, `purchase_date`, `bast`, `holder`, `condition`, `penalty`, `company_id`, `approved_at`, `approved_by`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 3, 'PEN001', 'PENSIL 2B1', 'PEN', NULL, 2, 'ea', 1000, 3, 10, 'notes', 'spec', NULL, NULL, '001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-13 05:32:32', 'cypher', NULL, NULL, '2020-11-13 05:32:32', NULL),
	(2, 4, 'PEN002', 'BALLPOINT FASTER HITAM 2', 'PEN', NULL, 1, 'ea', 1000, 1, 1, '1', '2', NULL, NULL, 'PEN002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-13 00:00:00', 'cypher', '2020-11-13 06:53:28', 'cypher', NULL, NULL, '2020-11-13 06:54:38', NULL);
/*!40000 ALTER TABLE `asset_items_update` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_organization
CREATE TABLE IF NOT EXISTS `asset_organization` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'customer | supplier',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acct` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '3 chars currency CODE',
  `pic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_product_type` int(11) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_organization: ~4 rows (approximately)
/*!40000 ALTER TABLE `asset_organization` DISABLE KEYS */;
INSERT INTO `asset_organization` (`id`, `category`, `name`, `address`, `telephone`, `fax`, `web`, `bank_acct`, `currency`, `pic`, `pic_email`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `id_product_type`, `rating`, `company_id`) VALUES
	(1, 'Supplier', 'PT ABC', 'JALAN JALAN1', '1', '1', '1', '1', NULL, '1', '1', 'cypher', '2020-11-12 02:30:00', NULL, '2020-11-12 02:30:00', NULL, NULL, 4, NULL, 1),
	(2, 'Supplier', 'PT ABC', 'JALAN JALAN1', '1', '1', '1', '1', NULL, '1', '1', 'cypher', '2020-11-12 02:30:00', NULL, '2020-11-12 02:30:07', 'cypher', '2020-11-12 02:30:07', 4, NULL, 1),
	(3, 'Supplier', 'PT DEF', 'ASD', '1', '1', '1', '1', NULL, '1', '1', 'cypher', '2020-11-12 02:30:44', NULL, '2020-11-12 02:30:44', NULL, NULL, 6, NULL, 1),
	(4, 'Supplier', 'WALIKOTA JAKARTA', 'Karangpawitan\r\nKawali', '081214235971', '890', 'www.epson.com', '309301026191534', NULL, 'udin', 'ranggaanggara8@gmail.com', 'cypher', '2020-11-23 12:24:30', NULL, '2020-11-23 12:24:30', NULL, NULL, 1, 5, 17);
/*!40000 ALTER TABLE `asset_organization` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_po
CREATE TABLE IF NOT EXISTS `asset_po` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `po_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_suppliers` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_date` date NOT NULL,
  `project` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'fk ke tabel projects',
  `division` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliver_to` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_time` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `dp` decimal(15,0) DEFAULT NULL,
  `ppn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_term` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appr_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` datetime DEFAULT NULL,
  `rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejected_time` datetime DEFAULT NULL,
  `rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_time` datetime DEFAULT NULL,
  `msg_subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keynumber` int(6) DEFAULT NULL,
  `justification` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gr_date` date DEFAULT NULL,
  `to_revise` int(1) DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_po: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_po` DISABLE KEYS */;
INSERT INTO `asset_po` (`id`, `supplier_id`, `po_type`, `alt_suppliers`, `po_num`, `po_date`, `project`, `division`, `reference`, `deliver_to`, `deliver_time`, `currency`, `discount`, `dp`, `ppn`, `payment_term`, `terms`, `notes`, `request_by`, `appr_notes`, `approved_by`, `approved_time`, `rejected_by`, `rejected_time`, `rejected_notes`, `sent_time`, `msg_subject`, `msg_body`, `keynumber`, `justification`, `fr_note`, `gr_date`, `to_revise`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 4, 'ATK', NULL, '001/VGI/PO/XII/20', '2020-12-02', '1', 'Consultant', '001/VGI/PEV/XII/20', NULL, NULL, 'IDR', 0.00, 0, '["1"]', 'Cash On Delivery', NULL, NULL, 'cypher', NULL, 'cypher', '2020-12-02 14:55:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asdsada', NULL, NULL, NULL, '2020-12-02 14:55:51', NULL, '2020-12-02 14:55:37', NULL, NULL, 1),
	(2, 1, 'MATERIAL', NULL, '002/VGI/PO/XII/20', '2020-12-02', '1', 'Finance', '002/VGI/PEV/XII/20', NULL, NULL, 'IDR', 0.00, 0, '["1"]', 'Cash On Delivery', NULL, NULL, 'cypher', NULL, 'cypher', '2020-12-02 15:04:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asdasda', NULL, NULL, NULL, '2020-12-02 15:04:05', NULL, '2020-12-02 15:03:56', NULL, NULL, 1),
	(3, 1, 'ATK', NULL, '003/VGI/PO/XII/20', '2020-12-17', '1', 'Asset', '003/VGI/PEV/XII/20', '<p>dasda</p>', '<p>adasda</p>', 'IDR', 0.00, 0, NULL, 'Cash On Delivery', '<p>asdasasdasd</p>', '<p>asda</p>', 'cypher', 'approved sudah OK', 'cypher', '2020-12-17 04:15:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tes', NULL, NULL, NULL, '2020-12-17 04:15:53', NULL, '2020-12-17 03:23:55', NULL, NULL, 1);
/*!40000 ALTER TABLE `asset_po` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_po_detail
CREATE TABLE IF NOT EXISTS `asset_po_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `po_num` int(11) NOT NULL,
  `item_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` float NOT NULL,
  `v1` int(11) DEFAULT NULL,
  `v2` int(11) DEFAULT NULL,
  `v3` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_po_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_po_detail` DISABLE KEYS */;
INSERT INTO `asset_po_detail` (`id`, `po_num`, `item_id`, `qty`, `v1`, `v2`, `v3`, `price`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'DWT 02', 10, NULL, NULL, NULL, 450000.00, NULL, '2020-12-02 14:55:37', NULL, '2020-12-02 14:55:37', NULL, NULL, NULL),
	(2, 2, 'PEN001', 100, NULL, NULL, NULL, 1000.00, NULL, '2020-12-02 15:03:56', NULL, '2020-12-02 15:03:56', NULL, NULL, NULL),
	(3, 3, 'PEN002', 2, NULL, NULL, NULL, 10000.00, NULL, '2020-12-17 03:23:55', NULL, '2020-12-17 03:23:55', NULL, NULL, NULL);
/*!40000 ALTER TABLE `asset_po_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_pre
CREATE TABLE IF NOT EXISTS `asset_pre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fr_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_date` datetime DEFAULT NULL,
  `fr_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_at` datetime DEFAULT NULL,
  `wh_ori` int(11) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `pre_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_date` datetime DEFAULT NULL,
  `pev_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_date` datetime DEFAULT NULL,
  `project` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_type` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_division_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_division_approved_at` datetime DEFAULT NULL,
  `fr_division_rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_division_rejected_at` datetime DEFAULT NULL,
  `pev_division_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_division_approved_at` datetime DEFAULT NULL,
  `fr_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_approved_at` datetime DEFAULT NULL,
  `pre_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_approved_at` datetime DEFAULT NULL,
  `pev_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_approved_at` datetime DEFAULT NULL,
  `fr_approved_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_approved_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_approved_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_rejected_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_rejected_at` datetime DEFAULT NULL,
  `fr_rejected_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_rejected_at` datetime DEFAULT NULL,
  `fr_rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_rejected_at` datetime DEFAULT NULL,
  `pre_rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_rejected_time` datetime DEFAULT NULL,
  `pev_rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_suppliers` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'alternatif supplier',
  `sent_time` datetime DEFAULT NULL COMMENT 'tgl kirim quotation request',
  `msg_subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suppliers` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array kandidat supplier',
  `selected_supplier` int(11) DEFAULT NULL,
  `ppns` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array ppn',
  `dps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array dp',
  `bd` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `discs` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array discount',
  `tops` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array terms of payment',
  `fr_notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array notes',
  `pre_notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currencies` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_delivers` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_times` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fr_deliver_times` datetime DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keynumber` int(6) DEFAULT NULL,
  `pc_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_time` datetime DEFAULT NULL,
  `div_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_time` datetime DEFAULT NULL,
  `justification` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach3` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_pre: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_pre` DISABLE KEYS */;
INSERT INTO `asset_pre` (`id`, `fr_num`, `fr_date`, `fr_type`, `request_by`, `request_at`, `wh_ori`, `due_date`, `pre_num`, `pre_date`, `pev_num`, `pev_date`, `project`, `pev_type`, `division`, `fr_division_approved_by`, `fr_division_approved_at`, `fr_division_rejected_by`, `fr_division_rejected_at`, `pev_division_approved_by`, `pev_division_approved_at`, `fr_approved_by`, `fr_approved_at`, `pre_approved_by`, `pre_approved_at`, `pev_approved_by`, `pev_approved_at`, `fr_approved_notes`, `pre_approved_notes`, `pev_approved_notes`, `div_rejected_by`, `div_rejected_at`, `fr_rejected_by`, `fr_rejected_at`, `fr_rejected_notes`, `pre_rejected_by`, `pre_rejected_at`, `pre_rejected_notes`, `pev_rejected_by`, `pev_rejected_time`, `pev_rejected_notes`, `alt_suppliers`, `sent_time`, `msg_subject`, `msg_body`, `suppliers`, `selected_supplier`, `ppns`, `dps`, `bd`, `discs`, `tops`, `fr_notes`, `pre_notes`, `pev_notes`, `currencies`, `delivers`, `fr_delivers`, `deliver_times`, `fr_deliver_times`, `terms`, `keynumber`, `pc_by`, `pc_time`, `div_by`, `div_time`, `justification`, `attach1`, `attach2`, `attach3`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, '001/VGI/FR/XII/20', '2020-12-02 00:00:00', 'ATK', 'cypher', '2020-12-02 00:00:00', NULL, '2020-12-31 00:00:00', '001/VGI/PRE/XII/20', '2020-12-02 00:00:00', '001/VGI/PEV/XII/20', '2020-12-02 14:55:37', '1', NULL, 'Consultant', 'cypher', '2020-12-02 14:50:09', NULL, NULL, 'cypher', '2020-12-02 14:51:22', 'cypher', '2020-12-02 14:50:13', 'cypher', '2020-12-02 14:50:22', 'cypher', '2020-12-02 14:55:37', 'asdsada', 'asdsada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["4","4",null]', NULL, '[["1"],["1"]]', '["0","0","0"]', '0', '["0","0","0"]', '["Cash On Delivery","Cash On Delivery",null]', 'asdsada', 'asdsada', '[null,null,null]', '["IDR","IDR","IDR"]', '[null,null,null]', NULL, '[null,null,null]', NULL, '[null,null,null]', NULL, 'cypher', '2020-12-02 14:51:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 14:55:37', NULL, '2020-12-02 14:50:04', NULL, NULL, 1),
	(2, '002/VGI/FR/XII/20', '2020-12-02 00:00:00', 'MATERIAL', 'cypher', '2020-12-02 00:00:00', NULL, '2020-12-31 00:00:00', '002/VGI/PRE/XII/20', '2020-12-02 00:00:00', '002/VGI/PEV/XII/20', '2020-12-02 15:03:56', '1', NULL, 'Finance', 'cypher', '2020-12-02 14:56:21', NULL, NULL, 'cypher', '2020-12-02 15:03:51', 'cypher', '2020-12-02 14:56:24', 'cypher', '2020-12-02 14:56:29', 'cypher', '2020-12-02 15:03:56', 'asdasda', 'asdasda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1","3",null]', NULL, '[["1"],["1"]]', '["0","0","0"]', '0', '["0","0","0"]', '["Cash On Delivery","Cash On Delivery",null]', 'asdasda', 'asdasda', '[null,null,null]', '["IDR","IDR","IDR"]', '[null,null,null]', 'delivered', '[null,null,null]', '2020-12-17 03:06:51', '[null,null,null]', NULL, 'cypher', '2020-12-02 14:57:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-17 03:06:51', NULL, '2020-12-02 14:56:18', NULL, NULL, 1),
	(3, '003/VGI/FR/XII/20', '2020-12-17 00:00:00', 'ATK', 'cypher', '2020-12-17 00:00:00', NULL, '2020-12-17 00:00:00', '003/VGI/PRE/XII/20', '2020-12-17 00:00:00', '003/VGI/PEV/XII/20', '2020-12-17 03:23:55', '1', NULL, 'Asset', 'cypher', '2020-12-17 03:16:25', NULL, NULL, 'cypher', '2020-12-17 03:23:50', 'cypher', '2020-12-17 03:16:37', 'cypher', '2020-12-17 03:16:56', 'cypher', '2020-12-17 03:23:55', 'tes', 'tes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '["1",null,null]', NULL, NULL, '["0","0","0"]', '0', '["0","0","0"]', '["Cash On Delivery",null,null]', 'tes', 'tes', '["<p>asda<\\/p>",null,null]', '["IDR","IDR","IDR"]', '["<p>dasda<\\/p>",null,null]', NULL, '["<p>adasda<\\/p>",null,null]', NULL, '["<p>asdasasdasd<\\/p>",null,null]', NULL, 'cypher', '2020-12-17 03:23:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-17 03:23:55', NULL, '2020-12-17 03:15:39', NULL, NULL, 1),
	(4, '004/VGI/FR/XII/20', '2020-12-17 00:00:00', 'MATERIAL', 'cypher', '2020-12-17 00:00:00', NULL, '2020-12-18 00:00:00', '004/VGI/PRE/XII/20', '2020-12-17 00:00:00', '004/VGI/PEV/XII/20', NULL, '1', NULL, 'Asset', 'cypher', '2020-12-17 03:20:29', NULL, NULL, NULL, NULL, 'cypher', '2020-12-17 03:20:41', 'cypher', '2020-12-17 03:21:08', NULL, NULL, 'asdas', 'asdas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'asdas', 'asdas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-17 03:21:08', NULL, '2020-12-17 03:17:58', NULL, NULL, 1);
/*!40000 ALTER TABLE `asset_pre` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_pre_detail
CREATE TABLE IF NOT EXISTS `asset_pre_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fr_id` int(11) DEFAULT NULL,
  `pre_id` int(11) DEFAULT NULL,
  `pre_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pev_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'kode barang',
  `qty` float DEFAULT NULL COMMENT 'qty barang yg diminta',
  `delivered` float DEFAULT NULL COMMENT 'qty barang yg diberikan',
  `qty_buy` float DEFAULT NULL,
  `qty_deliver` float DEFAULT NULL,
  `qty_req` float DEFAULT NULL,
  `qoh` float DEFAULT NULL,
  `qty_appr` float DEFAULT NULL,
  `qty_appr_pev` float DEFAULT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supp_idx` int(11) DEFAULT NULL,
  `wh` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `pre_id` (`pre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_pre_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_pre_detail` DISABLE KEYS */;
INSERT INTO `asset_pre_detail` (`id`, `fr_id`, `pre_id`, `pre_num`, `pev_num`, `item_id`, `qty`, `delivered`, `qty_buy`, `qty_deliver`, `qty_req`, `qoh`, `qty_appr`, `qty_appr_pev`, `price`, `supp_idx`, `wh`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, '001/VGI/PRE/XII/20', '001/VGI/PEV/XII/20', 'DWT 02', 10, NULL, NULL, NULL, 10, NULL, 10, NULL, '["500000","450000","0"]', 1, NULL, '2020-12-02 14:50:04', '2020-12-02 14:52:50', NULL),
	(2, 2, 2, '002/VGI/PRE/XII/20', '002/VGI/PEV/XII/20', 'PEN001', 100, 100, NULL, NULL, 100, NULL, 100, NULL, '["1000","11000","0"]', 0, NULL, '2020-12-02 14:56:18', '2020-12-17 03:06:51', NULL),
	(3, 3, 3, '003/VGI/PRE/XII/20', '003/VGI/PEV/XII/20', 'PEN002', 2, 2, NULL, 2, 2, NULL, 2, NULL, '["10000","0","0"]', 0, NULL, '2020-12-17 03:15:39', '2020-12-17 03:23:36', NULL),
	(4, 4, 4, '004/VGI/PRE/XII/20', '004/VGI/PEV/XII/20', 'PEN002', 22, 0, NULL, 0, 22, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-17 03:17:58', '2020-12-17 03:21:08', NULL),
	(5, 4, 4, '004/VGI/PRE/XII/20', '004/VGI/PEV/XII/20', 'PEN002', NULL, 22, NULL, 22, 22, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-17 03:17:58', '2020-12-17 03:21:08', NULL);
/*!40000 ALTER TABLE `asset_pre_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_qty_wh
CREATE TABLE IF NOT EXISTS `asset_qty_wh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `wh_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updater` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_wh` (`wh_id`,`item_id`),
  KEY `item_id` (`item_id`),
  KEY `wh_id` (`wh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_qty_wh: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_qty_wh` DISABLE KEYS */;
INSERT INTO `asset_qty_wh` (`id`, `item_id`, `wh_id`, `qty`, `created_at`, `updated_at`, `deleted_at`, `updater`) VALUES
	(3, 4, 4, 10, '2020-11-12 04:05:16', '2020-11-13 06:53:28', NULL, NULL),
	(4, 4, 5, 1, '2020-11-12 04:05:16', '2020-11-13 06:53:28', NULL, NULL);
/*!40000 ALTER TABLE `asset_qty_wh` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_sre
CREATE TABLE IF NOT EXISTS `asset_sre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `so_type` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_num` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_so_num` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_date` datetime DEFAULT NULL,
  `rfq_so_date` datetime DEFAULT NULL,
  `se_num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_date` datetime DEFAULT NULL,
  `division` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd` int(11) DEFAULT NULL,
  `so_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `alt_supplier` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suppliers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array kandidat supplier',
  `selected_supplier` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppns` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array ppn',
  `dps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array dp',
  `discs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array discount',
  `tops` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array terms of payment',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'array notes',
  `currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_times` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_input_at` datetime DEFAULT NULL,
  `se_input_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ack_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ack_time` datetime DEFAULT NULL,
  `attach1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach2` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach3` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_approved_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_approved_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_approved_at` datetime DEFAULT NULL,
  `so_rejected_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_rejected_at` datetime DEFAULT NULL,
  `so_rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_approved_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_approved_at` datetime DEFAULT NULL,
  `rfq_approved_notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_rejected_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfq_rejected_at` datetime DEFAULT NULL,
  `rfq_rejected_notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_approved_at` datetime DEFAULT NULL,
  `se_approved_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se_rejected_at` datetime DEFAULT NULL,
  `se_rejected_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_sre: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_sre` DISABLE KEYS */;
INSERT INTO `asset_sre` (`id`, `so_type`, `so_num`, `rfq_so_num`, `so_date`, `rfq_so_date`, `se_num`, `se_date`, `division`, `project`, `bd`, `so_notes`, `reference`, `deliver_to`, `deliver_time`, `sent_by`, `sent_at`, `alt_supplier`, `msg_subject`, `msg_body`, `suppliers`, `selected_supplier`, `ppns`, `dps`, `discs`, `tops`, `notes`, `currencies`, `delivers`, `deliver_times`, `terms`, `se_input_at`, `se_input_by`, `ack_by`, `ack_time`, `attach1`, `attach2`, `attach3`, `so_approved_by`, `so_approved_notes`, `so_approved_at`, `so_rejected_by`, `so_rejected_at`, `so_rejected_notes`, `rfq_approved_by`, `rfq_approved_at`, `rfq_approved_notes`, `rfq_rejected_by`, `rfq_rejected_at`, `rfq_rejected_notes`, `se_approved_by`, `se_approved_at`, `se_approved_notes`, `se_rejected_by`, `se_rejected_at`, `se_rejected_notes`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'PENGIRIMAN BARANG/ANGKUTAN', '001/VGI/SO/XI/20', '001/VGI/RFQSO/XI/20', '2020-11-23 07:19:32', '2020-12-02 15:06:00', '001/VGI/SE/XI/20', '2020-12-02 15:06:08', 'Asset', '1', 0, 'asdasdsa', 'xx', 'adasdasd', 'asdadasd', NULL, NULL, NULL, NULL, NULL, '["1","3",null]', NULL, '[["1"],["1"]]', '["0","0","0"]', '["0","0","0"]', '["Cash On Delivery","Cash On Delivery",null]', '[null,null,null]', '["IDR","IDR","IDR"]', '[null,null,null]', '[null,null,null]', '[null,null,null]', '2020-12-02 15:06:36', 'cypher', 'cypher', '2020-12-02 15:07:02', NULL, NULL, NULL, 'cypher', NULL, '2020-12-02 15:06:00', NULL, NULL, NULL, 'cypher', '2020-12-02 15:06:08', NULL, NULL, NULL, NULL, 'cypher', '2020-12-02 15:07:10', NULL, NULL, NULL, NULL, NULL, '2020-12-02 15:07:10', 'cypher', '2020-11-23 07:19:32', NULL, NULL, 1),
	(3, 'PENGIRIMAN BARANG/ANGKUTAN', '001/PSI/SO/XI/20', '001/PSI/RFQSO/XI/20', '2020-11-23 07:21:11', '2020-11-23 07:22:22', '001/PSI/SE/XI/20', '2020-11-23 07:24:20', 'Asset', '3', 0, 'dasdas', 'asda', 'adas', 'dsad', NULL, NULL, NULL, NULL, NULL, '["3","3",null]', NULL, NULL, '["0","0","0"]', '["0","0","0"]', '["Cash On Delivery","Cash On Delivery",null]', '[null,null,null]', '["IDR","IDR","IDR"]', '[null,null,null]', '[null,null,null]', '[null,null,null]', '2020-11-23 07:45:42', 'cypher', 'cypher', '2020-11-23 07:46:47', NULL, NULL, NULL, 'cypher', 'oke', '2020-11-23 07:22:22', NULL, NULL, NULL, 'cypher', '2020-11-23 07:24:20', 'asdasd', NULL, NULL, NULL, 'cypher', '2020-11-23 07:46:55', '<p>asda</p>', NULL, NULL, NULL, NULL, '2020-11-23 07:46:55', 'cypher', '2020-11-23 07:21:11', NULL, NULL, 17);
/*!40000 ALTER TABLE `asset_sre` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_sre_detail
CREATE TABLE IF NOT EXISTS `asset_sre_detail` (
  `so_id` int(11) NOT NULL,
  `job_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` decimal(11,2) DEFAULT NULL,
  `qty_appr` float DEFAULT NULL,
  `unit_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_se` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supp_idx` int(11) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_sre_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `asset_sre_detail` DISABLE KEYS */;
INSERT INTO `asset_sre_detail` (`so_id`, `job_desc`, `qty`, `qty_appr`, `unit_price`, `qty_se`, `supp_idx`, `id`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`) VALUES
	(1, 'asdasda', 10.00, 10, '["500000","450000","0"]', NULL, 0, 1, NULL, '2020-12-02 15:07:02', 'cypher', '2020-11-23 07:19:32', NULL, NULL),
	(3, 'asdas', 12.00, 12, '["100000","110000","0"]', NULL, 0, 3, NULL, '2020-11-23 07:46:47', 'cypher', '2020-11-23 07:21:11', NULL, NULL);
/*!40000 ALTER TABLE `asset_sre_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_type_po
CREATE TABLE IF NOT EXISTS `asset_type_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table cypher4.asset_type_po: ~13 rows (approximately)
/*!40000 ALTER TABLE `asset_type_po` DISABLE KEYS */;
INSERT INTO `asset_type_po` (`id`, `id_parent`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
	(3, 0, 'ATK', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 0, 'INVESTASI', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 0, 'MATERIAL', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 0, 'SPARE PART', NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 0, 'HSE & PPE', NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 0, 'FUEL SOLAR/BENSIN', NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 0, 'OLI MESIN', NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 0, 'LABORATORIUM', NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 0, 'FURNITURE', NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 0, 'MEKANIKAL N ELECTRICAL', NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 0, 'ELECTRONIC AND TOOLS', NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 0, 'KONSTRUKSI', NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 0, 'OFFICE SUPPORTING', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `asset_type_po` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_type_wo
CREATE TABLE IF NOT EXISTS `asset_type_wo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.asset_type_wo: ~45 rows (approximately)
/*!40000 ALTER TABLE `asset_type_wo` DISABLE KEYS */;
INSERT INTO `asset_type_wo` (`id`, `id_parent`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
	(2, 0, 'PENGIRIMAN BARANG/ANGKUTAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 0, 'MANDOR', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 0, 'THIRD PARTY/KONSULTAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 0, 'CSR', NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 0, 'SOSIAL', NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 0, 'TICKETING/TAXI', NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 0, 'ALAT TULIS KANTOR', NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 0, 'LISTRIK/AIR/UTILIZATION', NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 0, 'PANTRY/DAPUR', NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 0, 'INTERTAIN', NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 0, 'CASH BOND', NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 0, 'LEGAL', NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 0, 'GAJI', NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 0, 'MEAL/KONSUMSI', NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 0, 'ASURANSI KESEHATAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 0, 'PELATIHAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 0, 'FOTO COPY/LAMINATING', NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 0, 'KOMUNIKASI/TELPON', NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 0, 'INTERNET', NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 0, 'PEMELIHARAAN KOMPUTER', NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 0, 'SERVICE/PEMELIHARAAN KENDARAAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 0, 'SERVICE MEKANIKAL DAN ELEKTRIKAL', NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 0, 'PEMELIHARAAN FURNITURE', NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 0, 'ADVERTISING/IKLAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 0, 'SEWA KANTOR/GUDANG', NULL, NULL, NULL, NULL, NULL, NULL),
	(35, 0, 'SECURITY/KEAMANAN', NULL, NULL, NULL, NULL, NULL, NULL),
	(36, 0, 'UNLOADING/LOADING', NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 0, 'ASSET/MATERIAL/SPARE PART', NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 0, 'RESERVE', NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 0, 'SEWA MOBIL/MOTOR', NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 0, 'PROYEK/KONSTRUKSI', NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 0, 'ELECTRONIC/TOOLS/MESIN', NULL, NULL, NULL, NULL, NULL, NULL),
	(42, 0, 'SERTIFIKASI', NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 0, 'HSE/PPE/P3K', NULL, NULL, NULL, NULL, NULL, NULL),
	(45, 0, 'FURNITURE', NULL, NULL, NULL, NULL, NULL, NULL),
	(46, 0, 'LOUNDRY/HOTEL/KOST/MESS', NULL, NULL, NULL, NULL, NULL, NULL),
	(47, 0, 'FUEL SOLAR/BENSIN', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `asset_type_wo` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_wh
CREATE TABLE IF NOT EXISTS `asset_wh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.asset_wh: ~4 rows (approximately)
/*!40000 ALTER TABLE `asset_wh` DISABLE KEYS */;
INSERT INTO `asset_wh` (`id`, `name`, `address`, `telephone`, `pic`, `company_id`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
	(4, 'Vessel Tower', 'a street', '021 8201230', 'Joko', 1, '2020-11-12 04:02:49', '2020-11-12 04:02:49', NULL, NULL),
	(5, 'EXCAVATOR 01', 'b streeet', '-', '-', 1, '2020-11-12 04:03:10', '2020-11-12 04:03:10', NULL, NULL),
	(6, 'Warehouse Cileungsi', 'cileungsi', '0', '-', 1, '2020-11-13 04:12:30', '2020-11-13 04:12:30', NULL, NULL),
	(7, 'jl soedirman', 'jl soedirman', '08231424524', 'juned', 17, '2020-11-23 06:36:29', '2020-11-23 06:36:29', NULL, NULL);
/*!40000 ALTER TABLE `asset_wh` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_wo
CREATE TABLE IF NOT EXISTS `asset_wo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wo_type` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wo_num` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_date` datetime DEFAULT NULL,
  `project` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_payment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `dp` decimal(15,2) DEFAULT NULL,
  `ppn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` datetime DEFAULT NULL,
  `appr_notes` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejected_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejected_time` datetime DEFAULT NULL,
  `keynumber` int(6) DEFAULT NULL,
  `so_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_revise` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_wo: ~3 rows (approximately)
/*!40000 ALTER TABLE `asset_wo` DISABLE KEYS */;
INSERT INTO `asset_wo` (`id`, `wo_type`, `wo_num`, `division`, `supplier_id`, `currency`, `req_date`, `project`, `content`, `notes`, `terms`, `terms_payment`, `reference`, `deliver_to`, `deliver_time`, `discount`, `dp`, `ppn`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `approved_by`, `approved_time`, `appr_notes`, `rejected_by`, `rejected_time`, `keynumber`, `so_note`, `to_revise`, `company_id`) VALUES
	(1, 'PENGIRIMAN BARANG/ANGKUTAN', '001/PSI/WO/XI/20', 'Asset', 3, 'IDR', '2020-11-23 00:00:00', '3', NULL, NULL, NULL, 'Cash On Delivery', '001/PSI/SE/XI/20', NULL, NULL, 0.00, 0.00, '["2"]', NULL, '2020-11-23 07:48:42', 'cypher', '2020-11-23 07:46:55', NULL, NULL, 'cypher', '2020-11-23 07:48:42', NULL, NULL, NULL, NULL, 'dasdas', NULL, 17),
	(2, 'PENGIRIMAN BARANG/ANGKUTAN', '001/VGI/WO/XII/20', 'Asset', 1, 'IDR', '2020-12-02 00:00:00', '1', NULL, NULL, NULL, 'Cash On Delivery', '001/VGI/SE/XI/20', NULL, NULL, 0.00, 0.00, '["1"]', NULL, '2020-12-02 15:07:33', 'cypher', '2020-12-02 15:07:10', NULL, NULL, 'cypher', '2020-12-02 15:07:33', NULL, NULL, NULL, NULL, 'asdasdsa', NULL, 1),
	(3, 'MANDOR', '002/VGI/WO/XII/20', NULL, 1, 'IDR', '2020-12-01 00:00:00', '1', NULL, 'test', 'test', 'test', 'O7573', 'tewst', 'test', 0.00, 0.00, '["1"]', NULL, '2020-12-02 15:33:49', 'cypher|psi', '2020-12-02 15:33:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `asset_wo` ENABLE KEYS */;

-- Dumping structure for table cypher4.asset_wo_detail
CREATE TABLE IF NOT EXISTS `asset_wo_detail` (
  `wo_id` int(11) DEFAULT NULL,
  `job_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` decimal(20,2) DEFAULT NULL,
  `unit_price` decimal(15,2) DEFAULT NULL,
  `solar` int(11) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.asset_wo_detail: ~3 rows (approximately)
/*!40000 ALTER TABLE `asset_wo_detail` DISABLE KEYS */;
INSERT INTO `asset_wo_detail` (`wo_id`, `job_desc`, `qty`, `unit_price`, `solar`, `id`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'asdas', 12.00, 100000.00, NULL, 1, NULL, '2020-11-23 07:46:55', NULL, '2020-11-23 07:46:55', NULL, NULL, NULL),
	(2, 'asdasda', 10.00, 500000.00, NULL, 2, NULL, '2020-12-02 15:07:10', NULL, '2020-12-02 15:07:10', NULL, NULL, NULL),
	(3, 'test1', 11.00, 100000.00, NULL, 3, NULL, '2020-12-02 15:33:49', 'cypher', '2020-12-02 15:33:49', NULL, NULL, 1);
/*!40000 ALTER TABLE `asset_wo_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.config_company
CREATE TABLE IF NOT EXISTS `config_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgcolor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inherit` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.config_company: ~3 rows (approximately)
/*!40000 ALTER TABLE `config_company` DISABLE KEYS */;
INSERT INTO `config_company` (`id`, `id_parent`, `company_name`, `npwp`, `address`, `phone`, `email`, `tag`, `bgcolor`, `p_logo`, `app_logo`, `inherit`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, NULL, 'Vessel Group Indonesia', '0', '-', '0', NULL, 'VGI', '#3699ff', 'p_logo_VGI.png', 'app_logo_VGI.png', NULL, '2020-09-18 03:32:40', NULL, NULL, NULL, '2020-11-23 04:02:31', 'cypher'),
	(17, 1, 'PT. PUTRA SEJATI INDOMAKMUR', '123123', 'jakarta', '232323', 'a@b.com', 'PSI', '#00f1f5', 'p_logo_PSI.png', 'app_logo_PSI.png', 1, '2020-11-13 03:39:57', 'admin', NULL, NULL, '2020-11-23 03:58:24', 'cypher'),
	(18, 1, 'Cypher', '2131231', 'Karangpawitan', '081214235971', 'ranggaanggara8@gmail.com', 'CYP', '#9d4848', 'p_logo_cyp.png', 'app_logo_cyp.png', 1, '2020-11-23 04:52:37', 'admin', NULL, NULL, '2020-11-23 04:55:25', 'cypher');
/*!40000 ALTER TABLE `config_company` ENABLE KEYS */;

-- Dumping structure for table cypher4.config_main
CREATE TABLE IF NOT EXISTS `config_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.config_main: ~7 rows (approximately)
/*!40000 ALTER TABLE `config_main` DISABLE KEYS */;
INSERT INTO `config_main` (`id`, `parameter`, `value`) VALUES
	(1, 'install', 'done'),
	(2, 'company_name', 'Vessel Group'),
	(3, 'tag', 'vgi'),
	(4, 'address', '-'),
	(5, 'npwp', '0'),
	(6, 'email', ''),
	(7, 'phone', '0');
/*!40000 ALTER TABLE `config_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.config_record_field
CREATE TABLE IF NOT EXISTS `config_record_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(50) NOT NULL DEFAULT '0',
  `field_label` varchar(50) NOT NULL DEFAULT '0',
  `row` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.config_record_field: ~4 rows (approximately)
/*!40000 ALTER TABLE `config_record_field` DISABLE KEYS */;
INSERT INTO `config_record_field` (`id`, `field_name`, `field_label`, `row`) VALUES
	(1, 'tanggal', 'Tanggal', 2),
	(2, 'jam', 'Jam', 3),
	(3, 'id_emp', 'Employee ID', 1),
	(4, 'type', 'Tipe', 4);
/*!40000 ALTER TABLE `config_record_field` ENABLE KEYS */;

-- Dumping structure for table cypher4.csr_main
CREATE TABLE IF NOT EXISTS `csr_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online` int(1) NOT NULL DEFAULT 0,
  `pict1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pict2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pict3` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pict4` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pict5` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.csr_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `csr_main` DISABLE KEYS */;
INSERT INTO `csr_main` (`id`, `author`, `date`, `title`, `deskripsi`, `online`, `pict1`, `pict2`, `pict3`, `pict4`, `pict5`, `division`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 'cypher', '2020-11-18', 'LOREM', '<p>a</p>', 0, '2020_11_17_13_49_37csr_image1.jpg', NULL, NULL, NULL, NULL, 'Secretary', '2020-11-17 13:49:37', '2020-12-02 08:45:10', NULL, 1);
/*!40000 ALTER TABLE `csr_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.do
CREATE TABLE IF NOT EXISTS `do` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `deliver_date` datetime DEFAULT NULL,
  `deliver_by` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gr_no` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` date DEFAULT NULL,
  `division` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_do` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deliver_by` (`deliver_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.do: ~3 rows (approximately)
/*!40000 ALTER TABLE `do` DISABLE KEYS */;
INSERT INTO `do` (`id`, `from_id`, `to_id`, `deliver_date`, `deliver_by`, `project`, `notes`, `gr_no`, `approved_by`, `approved_time`, `division`, `no_do`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(6, 4, 5, '2020-11-13 00:00:00', 'cypher', NULL, 'notes', NULL, NULL, NULL, 'Asset', '001/VGI/DO/XI/20', '2020-11-13 04:07:54', '2020-11-13 05:05:20', NULL, 1),
	(7, 4, 6, '2020-11-13 00:00:00', 'cypher', NULL, '-', NULL, NULL, NULL, 'Asset', '002/VGI/DO/XI/20', '2020-11-13 04:13:26', '2020-11-13 04:13:26', NULL, 1),
	(8, 7, 7, '2020-11-23 00:00:00', 'cypher', NULL, 'sadad', NULL, NULL, NULL, 'Asset', '001/PSI/DO/XI/20', '2020-11-23 12:19:27', '2020-11-23 12:19:27', NULL, 17);
/*!40000 ALTER TABLE `do` ENABLE KEYS */;

-- Dumping structure for table cypher4.do_detail
CREATE TABLE IF NOT EXISTS `do_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `do_id` int(11) DEFAULT NULL,
  `item_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `do_id` (`do_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.do_detail: ~4 rows (approximately)
/*!40000 ALTER TABLE `do_detail` DISABLE KEYS */;
INSERT INTO `do_detail` (`id`, `do_id`, `item_id`, `qty`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 6, 'PEN002', 1, 'Transfer', '2020-11-13 04:07:54', '2020-11-13 05:05:20', '2020-11-13 05:05:20'),
	(5, 7, 'PEN002', 2, 'Transfer', '2020-11-13 04:13:26', '2020-11-13 04:13:26', NULL),
	(6, 7, 'PEN001', 1, 'Transfer', '2020-11-13 04:13:26', '2020-11-13 04:13:26', NULL),
	(7, 8, 'DWT 02', 10, 'Transfer', '2020-11-23 12:19:27', '2020-11-23 12:19:27', NULL);
/*!40000 ALTER TABLE `do_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table cypher4.file_managements
CREATE TABLE IF NOT EXISTS `file_managements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_code` (`hash_code`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.file_managements: ~124 rows (approximately)
/*!40000 ALTER TABLE `file_managements` DISABLE KEYS */;
INSERT INTO `file_managements` (`id`, `hash_code`, `file_name`, `created_at`, `created_by`, `updated_at`, `deleted_at`) VALUES
	(1, '$2y$10$p7eccGTOCCYBvaZcSYAba.4n2ThfPczdZjqQuM2OeyjI6tDsZ0qlG', 'media/lead/C:\\xampp\\tmp\\php6A28.tmp', '2020-10-13 11:34:10', NULL, '2020-10-13 11:34:10', NULL),
	(2, '$2y$10$SjOpFSIMIf7iFb8Qda.OT.LfzwjLCgwCAEto/Sii53xbZTYzHfS0u', 'media/lead/MASTERFILE.xlsx-2020-10-13 11:34:34(1).xlsx', '2020-10-13 11:34:34', NULL, '2020-10-13 11:34:34', NULL),
	(3, '$2y$10$/zfOGai6RdO/m/sefsmMn.T2KyZyIdAkVqX5Nx6PsEfT0FGEbp/Xq', 'media\\lead/MASTERFILE.xlsx-2020-10-13 11:34:53(1).xlsx', '2020-10-13 11:34:53', NULL, '2020-10-13 11:34:53', NULL),
	(4, '$2y$10$yTsuyBUFm9higHAH0FZY6.HMiU1KnXtemEr4mKIFrmjOMqvwIXPAK', 'media\\lead/php5F97.tmp-2020-10-13 11:35:12(1).xlsx', '2020-10-13 11:35:13', NULL, '2020-10-13 11:35:13', NULL),
	(5, '$2y$10$RfTp5nBtIUs1JM10ccxP4OT3IbhmYabinoHOWQ2bvpnXCe1UJFHXy', 'media\\lead/phpB4FC.tmp-2020-10-13 11:35:34(1).xlsx', '2020-10-13 11:35:34', NULL, '2020-10-13 11:35:34', NULL),
	(6, '$2y$10$0dj5B6Q1zKWcVYRxaayX0eyufKvknZ.nFDMw/oj1/psxMK7/drGAK', 'media\\lead/php72FD.tmp-2020-10-13 11:36:23(1).xlsx', '2020-10-13 11:36:23', NULL, '2020-10-13 11:36:23', NULL),
	(7, '$2y$10$8QJ1sgqXzmrNTB6P6u/RfObS1AszAG.jgoF3ZqL1ke8DNkAPKjfcS', 'media/lead/phpAF1D.tmp-2020-10-13 11:36:38(1).xlsx', '2020-10-13 11:36:38', NULL, '2020-10-13 11:36:38', NULL),
	(8, '$2y$10$qaABmuRp5c/vFvM4AbbV7eTuoLC4CipFpib1Xg0XwNvwkW6.xFShe', 'media/lead//php2B24.tmp-2020-10-13 11:37:10(1).xlsx', '2020-10-13 11:37:10', NULL, '2020-10-13 11:37:10', NULL),
	(9, '$2y$10$8pVMAg96GWVXLHBvJ.mGVOUGfyaYa2K.9VgCgj0EAH1Ng3YjGRZCO', 'images/p_logo_Student.jpeg', '2020-10-13 11:39:21', NULL, '2020-10-13 11:39:21', NULL),
	(10, '$2y$10$ORXENqAg3wCfcILxt.Ohkeae98XvJtpQfrlqknNCY1NWJ5aTzHQvC', 'images/p_logo_Student.jpeg', '2020-10-13 11:39:41', NULL, '2020-10-13 11:39:41', NULL),
	(11, '$2y$10$axkui/bBh.bc6C0runZofOk3/2iOt4OWa3mMAVfavmUmwj/sxFCc2', 'images/app_logo_Student.jpeg', '2020-10-13 11:39:41', NULL, '2020-10-13 11:39:41', NULL),
	(12, '$2y$10$.bcVlsSD.LZ/ObQQY2FLV.8c9H6DXV/JB9NzRvKd7WwXH4PaM2sNK', 'media/lead/phpB677.tmp-2020-10-13 11:39:57(1).xlsx', '2020-10-13 11:39:57', NULL, '2020-10-13 11:39:57', NULL),
	(13, '$2y$10$lJH0yT3rCvWKGRHPZv5irer8uk6EkwvXr6C4fk2/6/H9IpQGohyD2', 'media/lead/php7E9B.tmp-2020-10-13 11:40:48(1).xlsx', '2020-10-13 11:40:48', NULL, '2020-10-13 11:40:48', NULL),
	(14, '$2y$10$.JCA5UxQLtYYK1JW7/Wu4u996JQ/VECHZ9TjlSAcI/KAXhm1tDaLu', 'media/lead/phpA3F6.tmp-2020-10-13 11:40:58(1).xlsx', '2020-10-13 11:40:58', NULL, '2020-10-13 11:40:58', NULL),
	(15, '$2y$10$LUMgR1d.PpeFgZDjghjByej46/x66oWAHl0N649iBR.8fMwlRMhCG', 'media/lead/dviXMHMF8zCR2FzBogngr6aHNibW0DgZCT1VjQKs.xlsx-2020-10-13 11:41:12(1).xlsx', '2020-10-13 11:41:12', NULL, '2020-10-13 11:41:12', NULL),
	(16, '$2y$10$mJSCrlV8pYLpI4Tc6JdnO.yrCkTJtaJD/97d3.5cYrJzmvAsfnqCq', 'media/lead/MASTERFILE.xlsx-2020-10-13 11:41:21(1).xlsx', '2020-10-13 11:41:21', NULL, '2020-10-13 11:41:21', NULL),
	(17, '$2y$10$rEuEAF8xCqjg1hbbUyE0Te3uW8FXrPWXlA1UysTKE6.N12fj9yLFu', 'media/lead/GeocheMagic_SE_New_Version1-2020-10-13 11:46:07(1).xlsm', '2020-10-13 11:46:07', NULL, '2020-10-13 11:46:07', NULL),
	(18, '$2y$10$xVdatxmCHKYhYTMIuvzGMuJ1OG66rbhDLnaJquiAUdDqE8NNK1HDm', 'media\\lead/GeocheMagic_SE_New_Version1-2020-10-13 11:47:36(1).xlsm', '2020-10-13 11:47:36', NULL, '2020-10-13 11:47:36', NULL),
	(19, '$2y$10$Zrr5ldbNavx9eakSo57NB.tG97KhoMMPszJdUxYxvNL6Zoc19QASi', 'media\\lead/GeocheMagic_SE_New_Version1-2020-10-13 11:49:07(1).xlsm', '2020-10-13 11:49:07', NULL, '2020-10-13 11:49:07', NULL),
	(20, '$2y$10$Ezk7cwfgu52Bx9QoT6DsxOGVFQMoZT03QnVhst.OKt5pDzVKquNzq', 'media\\lead\\GeocheMagic_SE_New_Version1-2020-10-13 11:49:27(1).xlsm', '2020-10-13 11:49:27', NULL, '2020-10-13 11:49:27', NULL),
	(21, '$2y$10$RAUYnaIsRCBNG.Of48VLK.HN1qgW5MTa3diYfWFesfbMHzMqykb2m', 'media\\lead\\GeocheMagic_SE_New_Version1-2020_10_13_11_50_01(1).xlsm', '2020-10-13 11:50:01', NULL, '2020-10-13 11:50:01', NULL),
	(22, '$2y$10$LOCsBfPEsdK8R66FBh6iY.UF6gwguHEv1x7rkTVHQ8tabe6Ye5oNO', 'media\\lead\\Form_CBuddy_ICLIQE-2020_10_13_12_17_16(1).docx', '2020-10-13 12:17:16', NULL, '2020-10-13 12:17:16', NULL),
	(23, '$2y$10$KZgceIbK07OtQ7PaSWacVezuXsTATAHLyZEifPiLYKDtZWyMu8z2y', 'media\\lead\\WhatsApp_Image_2020-10-06_at_14_29_39-2020_10_13_13_30_33(1).jpeg', '2020-10-13 13:30:33', NULL, '2020-10-13 13:30:33', NULL),
	(24, '$2y$10$P1wBeKdEXwSAupwFrHYFUuvFeOUaoIdeEaSS1tG0Ub01gWrFSl5Mu', 'media\\lead\\ap_logo-2020_10_13_14_22_58(1).png', '2020-10-13 14:22:58', NULL, '2020-10-13 14:22:58', NULL),
	(25, '$2y$10$D6.0ZZg3UnyWLbwuDvghXuoWYs4tBK.QmGSBXuBjz58L/qsIxWsqi', 'media\\lead\\https___icope_cbuddy_id_2020_file_master-2020_10_13_14_35_30(1).pdf', '2020-10-13 14:35:30', NULL, '2020-10-13 14:35:30', NULL),
	(26, '$2y$10$kH.Y.Tm0TE.KY//lE6eKHueexfyP68tKECjSM3s06u.w1qZmpPUYK', 'media\\lead\\GTAHaXv2_[unknowncheats_me]_-2020_10_13_14_39_56(1).rar', '2020-10-13 14:39:56', NULL, '2020-10-13 14:39:56', NULL),
	(27, '$2y$10$mEf6kCW4ppvUAysTF7599ePJmFDZMf6YJMdpys6gIfoHSPyFii7mG', 'media\\lead\\leoupdate-2020_10_13_14_40_15(1).sql', '2020-10-13 14:40:15', NULL, '2020-10-13 14:40:15', NULL),
	(28, '$2y$10$sxgRn64MIcPwE5zK7ptwO.oIv02lT.BDP8yWCloZ6Q4bZS/69YGw6', 'media\\lead\\Absensi_AI_11Juli_10Agustus2020-2020_10_14_02_32_32(1).csv', '2020-10-14 02:32:32', NULL, '2020-10-14 02:32:32', NULL),
	(29, '$2y$10$gLSUctc79nR0rgSIXA5bvuZTX23zz5lF4m1Ujpw.iTJS5am/2MGnu', 'media\\lead/30_FP_GESTI_KHOIRUNNISA-2020_10_16_11_29_42(1).docx', '2020-10-16 11:29:42', NULL, '2020-10-16 11:29:42', NULL),
	(30, '$2y$10$p2uPDstZY6VGF3atmXOz9.gM2h/lgFavNsabjf29OwZGHSVKB3EmK', 'media\\lead/30_FP_GESTI_KHOIRUNNISA-2020_10_16_11_32_03(1).docx', '2020-10-16 11:32:03', NULL, '2020-10-16 11:32:03', NULL),
	(31, '$2y$10$lv4bChf8Q6itLmyLdtTDmuuqdkkvolVIbg6sNavzb2u889UWj.km', 'media\\lead/30_FP_GESTI_KHOIRUNNISA-2020_10_16_11_32_52(1).docx', '2020-10-16 11:32:52', NULL, '2020-10-16 11:32:52', NULL),
	(32, '$2y$10$cm3ntyokuKTefEmggxOSieR6dahYXAkyZBjlYpDsnFr5sqXF1A58e', 'media/journal/WhatsApp_Image_2020-10-06_at_14.29.39.jpeg', '2020-11-03 09:35:13', NULL, '2020-11-03 09:35:13', NULL),
	(33, '$2y$10$E9I74eim0f0JHtzGL7.zbuUmWZR50JEgz5ZISJADGS9MJWtsU6tC', 'media\\lead/WhatsApp_Image_2020-10-06_at_14_29_39-2020_11_03_10_06_19().jpeg', '2020-11-03 10:06:19', NULL, '2020-11-03 10:06:19', NULL),
	(34, '$2y$10$MceXi64Ha6wnHX.M.Dy21u35.He.Fj7nRFYTAiH2ZfTuxqEKrqRm', 'media\\lead/WhatsApp_Image_2020-10-06_at_14_29_39-2020_11_03_10_07_33().jpeg', '2020-11-03 10:07:33', NULL, '2020-11-03 10:07:33', NULL),
	(35, '$2y$10$eYbwJEuDqOawCM6.jHO.4OWiEAKQzYFJi7gsivRFl4eIS0JAB2ibm', 'media\\lead/WhatsApp_Image_2020-10-06_at_14_29_39-2020_11_03_10_08_43().jpeg', '2020-11-03 10:08:43', NULL, '2020-11-03 10:08:43', NULL),
	(36, '$2y$10$YuvxbjlBgvVb0lQt8iC5Ie7yncqKJ0l8Ljig.zfMDhLLKzKfyEPoO', 'media\\lead/WhatsApp_Image_2020-10-06_at_14_29_39-2020_11_03_10_10_07().jpeg', '2020-11-03 10:10:08', NULL, '2020-11-03 10:10:08', NULL),
	(37, '$2y$10$axgrGOju1ZTRRX12rIPJG.GkY3xE97yqYd77tNEVnMRqkLc9NmQq', 'media\\lead/WhatsApp_Image_2020-09-07_at_13_17_02-2020_11_03_10_13_12().jpeg', '2020-11-03 10:13:12', NULL, '2020-11-03 10:13:12', NULL),
	(38, '$2y$10$lbqX.LzkrwzgkoYAL4HVsuiyVXTNFMDEZpOlahDrXGgoIakvysiUK', 'media\\lead/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_04_04_41_15(1).gif', '2020-11-04 04:41:15', 'admin', '2020-11-04 04:41:15', NULL),
	(39, '$2y$10$ooDGvYaeNwDzxZ3wNavNWujibuDoSbuM4fxWqwgXZcDetYscmAIjm', 'media\\te\\el/abstract-colorful-shape-4k_1539370815-2020_11_09_17_17_26.jpg', '2020-11-09 17:17:26', 'admin', '2020-11-09 17:17:26', NULL),
	(40, '$2y$10$PjDViSgZeBW2annlhf2UaefZ49tshb1biqebw2mSVOvnK5nizraa', 'media\\te\\el/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_09_17_17_26.gif', '2020-11-09 17:17:27', 'admin', '2020-11-09 17:17:27', NULL),
	(41, '$2y$10$gJvi2tgsg9sEm1gVDcNv1ewmYvZjsh3IPefyKYfU6fA5bQUIxSMNK', 'media\\te\\el/ap_logo-2020_11_09_17_17_27.png', '2020-11-09 17:17:27', 'admin', '2020-11-09 17:17:27', NULL),
	(42, '$2y$10$jfkcPw55NACfzYb1NZF.tIryROgaNtJQoLFlTjtd.g4zgo.Bsgu', 'media\\te\\el/download_(1)-2020_11_09_17_17_27.xls', '2020-11-09 17:17:27', 'admin', '2020-11-09 17:17:27', NULL),
	(43, '$2y$10$U4IYUrC81dWm2nGcxGm.fqzKQqhbahd9MzRReAjACsdPj3CXg5u', 'media\\te\\el/abstract-colorful-shape-4k_1539370815-2020_11_09_17_38_47.jpg', '2020-11-09 17:38:47', 'admin', '2020-11-09 17:38:47', NULL),
	(44, '$2y$10$qWCLRgNWks1cqeOdKWsknOMNpaMUIAA9LlQv5SVlJrrZDLT5wiFWa', 'media\\te\\el/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_09_17_38_47.gif', '2020-11-09 17:38:47', 'admin', '2020-11-09 17:38:47', NULL),
	(45, '$2y$10$.1aZzhwYgoRXv6CEsTa5uOfH6jW2eR31NQdnsAaCBmz6mrQuTOgS6', 'media\\te\\el/b33a11afdff2ef2e1d7502b8d2df0fe9d1efd593-2020_11_09_17_38_47.jpg', '2020-11-09 17:38:47', 'admin', '2020-11-09 17:38:47', NULL),
	(46, '$2y$10$0qqBUFpeDbcNkLggvKC.gu9Mg67INeAVfBSDU1RQg42sdI4LdpG', 'media\\te\\el/download_(1)-2020_11_09_17_38_47.xls', '2020-11-09 17:38:47', 'admin', '2020-11-09 17:38:47', NULL),
	(47, '$2y$10$yH7Vt7ygyVdwqxIFh93fl.z1gILVBUXi3f8KvapdYehqilxUovuq2', 'media\\te\\el/abstract-colorful-shape-4k_1539370815-2020_11_09_17_40_08.jpg', '2020-11-09 17:40:08', 'admin', '2020-11-09 17:40:08', NULL),
	(48, '$2y$10$PHqPiJDxVeoBvvMiDCCT.ODfFBJtQVzulkv5.YGy4P302vApPx.', 'media\\te\\el/a1WBmzR_700bwp-2020_11_09_17_40_08.jpg', '2020-11-09 17:40:08', 'admin', '2020-11-09 17:40:08', NULL),
	(49, '$2y$10$eU2h95bMQjvE0jwvzjwUaevLwvgB7vSuWZE0HTXrocprIpzhGNG3u', 'media\\te\\el/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_09_17_40_08.gif', '2020-11-09 17:40:08', 'admin', '2020-11-09 17:40:08', NULL),
	(50, '$2y$10$7WCvTOoGf0FsQ2KY8sYgf.zYZNdcgYIeVhP27sjDHAVGLjLgL2muK', 'media\\te\\el/download_(1)-2020_11_09_17_40_08.xls', '2020-11-09 17:40:08', 'admin', '2020-11-09 17:40:08', NULL),
	(51, '$2y$10$OL3YYLPxYfQDxxoAiiFYced2LVFkL4NqIlNYnq6viwfXfw9vG8z2K', 'media\\te\\el/55_FP-2020_11_09_17_43_31.pdf', '2020-11-09 17:43:31', 'admin', '2020-11-09 17:43:31', NULL),
	(52, '$2y$10$TTs0MFLyitWkcCTocUZNzOSD6s77R23lS6LT1gYBEc4funpt6G', 'media\\te\\el/ap_logo-2020_11_09_17_43_31.png', '2020-11-09 17:43:31', 'admin', '2020-11-09 17:43:31', NULL),
	(53, '$2y$10$w333Wr5IMum48ou.xDRMe80ZyknPrj2gpnQ6HwYjAWb3qeYZUzb6', 'media\\te\\el/b33a11afdff2ef2e1d7502b8d2df0fe9d1efd593-2020_11_09_17_43_31.jpg', '2020-11-09 17:43:31', 'admin', '2020-11-09 17:43:31', NULL),
	(54, '$2y$10$195QdXtnC49NBHcvwAYkD.lxjvqn4ZsG8iZcbg4XHViv58XDf7Mm', 'media\\te\\el/download_(2)-2020_11_09_17_43_31.xls', '2020-11-09 17:43:31', 'admin', '2020-11-09 17:43:31', NULL),
	(55, '$2y$10$cH.AabZpiQBNCkHG3V8MxOkBc3NAZUUd1IJzOCqbtuXNZzee6dQNK', 'media\\te\\el/download_(5)-2020_11_10_06_11_53.xls', '2020-11-10 06:11:53', 'admin', '2020-11-10 06:11:53', NULL),
	(56, '$2y$10$4A4Nxv81j8XiRS9uQmUVdem9nhUK11MfCuZsDN.8RhLXmGNaSHBMe', 'media\\te\\el/conf-2020_11_10_07_19_07.txt', '2020-11-10 07:19:07', 'admin', '2020-11-10 07:19:07', NULL),
	(57, '$2y$10$wBz8QONqx.sYAlJirjtSrObLqy.sVU51SG.D8plZPsggC7w818g2', 'media\\te\\el/2407330074-2020_11_10_07_19_07.jpg', '2020-11-10 07:19:07', 'admin', '2020-11-10 07:19:07', NULL),
	(58, '$2y$10$VHT8z9RTgHLgo9GrFqtiJeFiS7QVI7IPi8OhJIoDEhKyt5SpJ.I6', 'media\\te\\el/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_10_07_32_42.gif', '2020-11-10 07:32:42', 'admin', '2020-11-10 07:32:42', NULL),
	(59, '$2y$10$NeTpd8f/RzGeWRf4iSPyIOTk4kgBp86j6CENBujss3Ss3sUoVAz7S', 'images/p_logo_PSI.png', '2020-11-13 03:39:57', 'cypher', '2020-11-13 03:39:57', NULL),
	(60, '$2y$10$Ddu0thnqxEcSx4bzF3hHouJfFXrtEn94m8YxNujC9BhTGdwc3nAmW', 'images/app_logo_PSI.png', '2020-11-13 03:39:57', 'cypher', '2020-11-13 03:39:57', NULL),
	(61, '$2y$10$Pa8LTkItg4xSKLUZ.xwfeTtqvsBbGYWxXcELgJd9vrBgDWSYKCTK', 'media/decree_archive/d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92.gif_2020_11_17_13_47_59.gif', '2020-11-17 13:47:59', 'cypher', '2020-11-17 13:47:59', NULL),
	(62, '$2y$10$aVa5l0PJCqmZKa5mA9BCuT5BOY6LAq1JX8KeB8V2eExhg1N3Khr.', 'media/csr_attachment/2020_11_17_13_49_37csr_image1.jpg', '2020-11-17 13:49:38', 'cypher', '2020-11-17 13:49:38', NULL),
	(63, '$2y$10$BJQdGAfmVMPmOy9bH8MzevHoxspboWKZ0dlgWrNBAej43QC9kMC', 'media/mcu_attachment/2020_11_17_13_50_18_attachment_mcu.png', '2020-11-17 13:50:18', 'cypher', '2020-11-17 13:50:18', NULL),
	(64, '$2y$10$UQsxb9eXNS8NLr75Nn2m.B2pjhmcfvnQ.QNu9UD7h1CbcJyqYOz6', 'media/mcu_attachment/2020_11_17_13_51_15_attachment_mcu.png', '2020-11-17 13:51:15', 'cypher', '2020-11-17 13:51:15', NULL),
	(65, '$2y$10$yDnGZNI7N8ChOg0fGtpU8e5GJJMnh2pXWoyNSFi7ObDbaZbf9Wg7W', 'media/employee_attachment/VGI-K1811202001-picture.gif', '2020-11-18 01:57:19', 'cypher', '2020-11-18 01:57:19', NULL),
	(66, '$2y$10$WdZNkbS0hytmRehktFgUuv9KviF7hebDoDzGYacLGBj3r6lYGLkK', 'media/employee_attachment/VGI-K1811202001-ktp.gif', '2020-11-18 01:57:19', 'cypher', '2020-11-18 01:57:19', NULL),
	(67, '$2y$10$d98WCLSNOtYZUcAkxCiuduxtnwrZHa96o1f7cM3XhtsAghlBVd6Ee', 'media/employee_attachment/VGI-K1811202001-serti1.gif', '2020-11-18 01:57:19', 'cypher', '2020-11-18 01:57:19', NULL),
	(68, '$2y$10$Sbs/IdXeVi9PRxcKTyBdWekYGMeyw7rjNSlPwsQgCaNmqztQ307g.', 'images/p_logo_cyp.png', '2020-11-23 04:52:37', 'cypher', '2020-11-23 04:52:37', NULL),
	(69, '$2y$10$RuLXcFppmS9KMbA0Ytxch.4Zs8eDMy924SaVAr/cmj565q.9FqjAq', 'images/app_logo_cyp.png', '2020-11-23 04:52:37', 'cypher', '2020-11-23 04:52:37', NULL),
	(70, '$2y$10$ECIjz50c7APgXyE47.1G1O0lhZgNT020cp2snLSz0DZ8nnI.77VC', 'media\\lead/(mom)154539-2020_11_23_14_13_52(1).png', '2020-11-23 14:13:52', 'cypher', '2020-11-23 14:13:52', NULL),
	(71, '$2y$10$QLH3I9j3acLUhpqZjy6BIeF9vLVBGVnDtaKDP1LuOU8wdmuclp8E2', 'media\\lead/(mom)154539-2020_11_23_14_17_50(1).png', '2020-11-23 14:17:50', 'cypher', '2020-11-23 14:17:50', NULL),
	(72, '$2y$10$VSgJaSIWpRYgZAA276XOC.oQ7DqZE2WjFW2H2qJud0zkgVfViQzma', 'media\\lead/1200px-Flag_of_Germany_(1935–1945)_svg-2020_11_23_14_30_09(1).png', '2020-11-23 14:30:09', 'cypher', '2020-11-23 14:30:09', NULL),
	(73, '$2y$10$RU.NnJA9o9PTgRx52vnqu7w0pwcFSJgnNgm0Q0e5wIHRFWFlSQO', 'media\\lead/(nda)a1WBmzR_700bwp-2020_11_23_14_30_32(1).jpg', '2020-11-23 14:30:32', 'cypher', '2020-11-23 14:30:32', NULL),
	(74, '$2y$10$LAUDPdjJJOTkGQZIWBvk0.jB.cCpFBVs9K7Np9Q2eijRVsLRTE4.O', 'media\\lead/(spd)2407330074-2020_11_23_14_30_38(1).jpg', '2020-11-23 14:30:38', 'cypher', '2020-11-23 14:30:38', NULL),
	(75, '$2y$10$9CK.GWYYXsmxe1ifACtdn.ajz5CyfLFtQfUgWVioQJ.9uPsST2dNK', 'media\\lead/(ol)download_(3)-2020_11_23_14_30_46(1).xls', '2020-11-23 14:30:46', 'cypher', '2020-11-23 14:30:46', NULL),
	(76, '$2y$10$Vxdwjk11bPj2EQXBpQ08u.9PTGc66TDUMjJydJVcqZHMPBRBtUxxG', 'media\\lead/(mou)download_(2)-2020_11_23_14_30_50(1).xls', '2020-11-23 14:30:51', 'cypher', '2020-11-23 14:30:51', NULL),
	(77, '$2y$10$NdcA0BrPMXPnSkY6QloNluIlXSZ2YPT2gFxuD1jRdE6TgQp.uDMfS', 'media\\lead/(pks)download_(1)-2020_11_23_14_30_54(1).xls', '2020-11-23 14:30:54', 'cypher', '2020-11-23 14:30:54', NULL),
	(78, '$2y$10$1.7.GtUF50vrsxEZWotOZKgCfuqssyMJFkfyjFB1LfIoYAIXfq', 'media\\lead/(mom)2407330074-2020_11_25_03_53_05(2).jpg', '2020-11-25 03:53:05', 'cypher', '2020-11-25 03:53:05', NULL),
	(79, '$2y$10$PngYARO0knDTEfa8cuMxlezfGkKZcWbz51iEOkrziS3RLEv0lXkNK', 'media\\lead/(nda)2407330074-2020_11_25_03_54_26(2).jpg', '2020-11-25 03:54:26', 'cypher', '2020-11-25 03:54:26', NULL),
	(80, '$2y$10$47KfLUNoPzXJLqD3IsbB.RfbO1JUH0rskYFEkfd4cHCRqECAYPku', 'media\\lead/(spd)1200px-Flag_of_Germany_(1935–1945)_svg-2020_11_25_04_04_25(2).png', '2020-11-25 04:04:25', 'cypher', '2020-11-25 04:04:25', NULL),
	(81, '$2y$10$ezluQtVIKC7qZLp3sFSdkeaueG6sjvJ6JZy7NlgIzwMLhlT2OWGvq', 'media\\lead/(ol)154539-2020_11_25_04_04_30(2).png', '2020-11-25 04:04:30', 'cypher', '2020-11-25 04:04:30', NULL),
	(82, '$2y$10$KYb.GyCynAolqMPSeX2tuoQGkwqa0uifPfF2KL33zUP3D6eG1B4O', 'media\\lead/(mou)20202857098351020011-2020_11_25_04_04_35(2).pdf', '2020-11-25 04:04:35', 'cypher', '2020-11-25 04:04:35', NULL),
	(83, '$2y$10$QYAJr7b3Yuo8FQxCTk8X.1HM8SRMgzBNN6Rc52N1pZm2Du1XNDM.', 'media\\lead/(pks)downloaded-2020_11_25_04_04_44(2).pdf', '2020-11-25 04:04:44', 'cypher', '2020-11-25 04:04:44', NULL),
	(84, '$2y$10$Cj9DNvSC46GCNyIekg.ZBuLEIQzaRbZT38P2P6zK4CDTB8JLBi5Wy', 'media\\lead/(nda-draft)55_FP-2020_11_30_03_29_47(4).pdf', '2020-11-30 03:29:47', 'cypher', '2020-11-30 03:29:47', NULL),
	(85, '$2y$10$XqyKIqIPWCpImtLLHd8iV.egQzdgSYJur.U5i0sxWg9emYk30qC', 'media\\lead/(nda-resi)55_FP-2020_11_30_04_08_18(4).pdf', '2020-11-30 04:08:19', 'cypher', '2020-11-30 04:08:19', NULL),
	(86, '$2y$10$THnwHbsC0eBnOijB1QeV.eLcLtuuz.jyZ4ouEbfFbm.k5wq2ypu', 'media\\lead/(nda-resi)20202857098351020011-2020_11_30_04_09_31(4).pdf', '2020-11-30 04:09:31', 'cypher', '2020-11-30 04:09:31', NULL),
	(87, '$2y$10$DV8x9cK4vZ3thIxj7BCeo.WpYQ8nSmcVJAyfKp8cOjnlgL6dWhjDy', 'media\\lead/(nda-resi)20202857098351020011-2020_11_30_04_13_46(4).pdf', '2020-11-30 04:13:46', 'cypher', '2020-11-30 04:13:46', NULL),
	(88, '$2y$10$0uYpZHkbG04pVuJVOmlj5eKvIKYz8qZ7N8wI3wN43YRQry1jVW4m', 'media\\lead/(nda-resi)55_FP-2020_11_30_04_13_51(4).pdf', '2020-11-30 04:13:51', 'cypher', '2020-11-30 04:13:51', NULL),
	(89, '$2y$10$0q2r9ODt36UiktrJvdw1.0fEbX7JaipdQ.AGFq1DmYVnntGCgv0e', 'media\\lead/(nda-draft)55_FP-2020_11_30_04_30_26(4).pdf', '2020-11-30 04:30:26', 'cypher', '2020-11-30 04:30:26', NULL),
	(90, '$2y$10$f.dQSFqDKMYX1oZQP0ZA.MMLzmuEtA8xA23GR8CjLycRj0qd5p7e', 'media\\lead/(nda-resi)2407330074-2020_11_30_04_48_59(4).jpg', '2020-11-30 04:48:59', 'cypher', '2020-11-30 04:48:59', NULL),
	(91, '$2y$10$5wFdmJWRonbZ4gH8GVt4OaVUos0KBViiWqyq39lIKsIeg55PcWw6', 'media\\lead/(nda-signed)154539-2020_11_30_04_49_04(4).png', '2020-11-30 04:49:04', 'cypher', '2020-11-30 04:49:04', NULL),
	(92, '$2y$10$OpNuNk5d5a3XSFbWNWze8BIsw0KacpVEAbIe25805yd89TNviL2', 'media\\lead/(drl-draft)154539-2020_11_30_04_49_11(4).png', '2020-11-30 04:49:11', 'cypher', '2020-11-30 04:49:11', NULL),
	(93, '$2y$10$RSY2At34gcBcwwjUFU4iejURnegXro8IcOny.eTrpxgeLLkk1nq', 'media\\lead/(drl-resi)20202857098351020011-2020_11_30_04_49_19(4).pdf', '2020-11-30 04:49:19', 'cypher', '2020-11-30 04:49:19', NULL),
	(94, '$2y$10$wSqmQN.24wlZ.b4fbEvg1.6gimWRDHwWQFTRwkPHuXR7eMDHr1gS', 'media\\lead/(drl-signed)2407330074-2020_11_30_04_49_49(4).jpg', '2020-11-30 04:49:49', 'cypher', '2020-11-30 04:49:49', NULL),
	(95, '$2y$10$2beWB1jnRUHtCTDKbQdzf.RAIUgDL2K6pn6uYBMYIyuVFmCjK2.', 'media\\lead/(meeting-internal-mom)20202857098351020011-2020_11_30_06_47_54(4).pdf', '2020-11-30 06:47:54', 'cypher', '2020-11-30 06:47:54', NULL),
	(96, '$2y$10$xiiZoEtUWOhFxdLxqvS.uoyRdQMnpGdbM9l7gZLw101AMoz0huVe', 'media\\lead/(meeting-eksternal-mom)document-2020_11_30_06_59_02(4).pdf', '2020-11-30 06:59:02', 'cypher', '2020-11-30 06:59:02', NULL),
	(97, '$2y$10$DixUWgGhPVBxOsGYGFojcuv6jNmiGGLL4eowgpY.GU0W6.Pvbu0qq', 'media\\lead/(wo-draft)abstract-colorful-shape-4k_1539370815-2020_11_30_06_59_14(4).jpg', '2020-11-30 06:59:14', 'cypher', '2020-11-30 06:59:14', NULL),
	(98, '$2y$10$NrSa6I6qpxddD67IAeyxFuAFnBfskdxpBUiJBSSyysiilWP3xDA4q', 'media\\lead/(wo-resi)ap_logo-2020_11_30_07_00_46(4).png', '2020-11-30 07:00:46', 'cypher', '2020-11-30 07:00:46', NULL),
	(99, '$2y$10$JR9mZYyMfc9BA5w1lTMcLu8C0ttKzt4mNxWO7OeiIw14AZIIjL45u', 'media\\lead/(wo-signed)abstract-colorful-shape-4k_1539370815-2020_11_30_07_00_52(4).jpg', '2020-11-30 07:00:52', 'cypher', '2020-11-30 07:00:52', NULL),
	(100, '$2y$10$RDI1HnEQtSlpgPSY4SmDAeoaIQqL4DuKc8weniH7nZML42dkemKzu', 'media\\lead/(agreement-draft)20202857098351020011-2020_11_30_07_00_57(4).pdf', '2020-11-30 07:00:57', 'cypher', '2020-11-30 07:00:57', NULL),
	(101, '$2y$10$Zt6u5.6WyHcrzzhYPyES9.RiEUjqDm9ptAOyskYm8P37u9UczcDga', 'media\\lead/(agreement-resi)20202857098351020011-2020_11_30_07_01_07(4).pdf', '2020-11-30 07:01:07', 'cypher', '2020-11-30 07:01:07', NULL),
	(102, '$2y$10$twJIruKBZBos0PGJchgVY.JOHuRPwkq3oJMiWru66IHRKC0BOmAo.', 'media\\lead/(agreement-signed)d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_11_30_07_01_20(4).gif', '2020-11-30 07:01:20', 'cypher', '2020-11-30 07:01:20', NULL),
	(103, '$2y$10$Q02NzEd0y.ScOd2My2vnZuE6B.0OO98Jl9j40PFTgLiPVQ.RuoTcS', 'media\\lead/(agreement-signed)a1WBmzR_700bwp-2020_11_30_07_03_33(4).jpg', '2020-11-30 07:03:33', 'cypher', '2020-11-30 07:03:33', NULL),
	(104, '$2y$10$nObonbFIAF7l3OYV0NelO4jcfTnvOPWANLh0mbv5lxP7JTfitdpy', 'media\\lead/(nda-draft)a1WBmzR_700bwp-2020_12_02_01_58_17(6).jpg', '2020-12-02 01:58:17', 'cypher', '2020-12-02 01:58:17', NULL),
	(105, '$2y$10$O540vRaO4aiH0T33AYbP0e.4Rq7rX3YbZYYwFXGzyHRRfMzMNdcMG', 'media\\lead/(nda-resi)conf-2020_12_02_01_58_26(6).txt', '2020-12-02 01:58:26', 'cypher', '2020-12-02 01:58:26', NULL),
	(106, '$2y$10$nemU78FiRqJOvcLdFPaJSOzDeW6fGvlYfWwW2RXM1Lx2grvzq.obq', 'media\\lead/(nda-signed)20202857098351020011-2020_12_02_01_58_32(6).pdf', '2020-12-02 01:58:32', 'cypher', '2020-12-02 01:58:32', NULL),
	(107, '$2y$10$FriOowSyO3n9gdCglcCLJuEtoBt9rSJKelpVOYFuiUqyM1UV2P3O', 'media\\lead/(drl-draft)20202857098351020011-2020_12_02_01_58_37(6).pdf', '2020-12-02 01:58:37', 'cypher', '2020-12-02 01:58:37', NULL),
	(108, '$2y$10$8KSJnIvH7mDSsc.k9Tkc.4QaDIZNzhA6buyK.F3w0CmclJRIDFi', 'media\\lead/(drl-resi)conf-2020_12_02_01_58_44(6).txt', '2020-12-02 01:58:44', 'cypher', '2020-12-02 01:58:44', NULL),
	(109, '$2y$10$fATsEc2peQayMXqHxuAq.MX1G1Yz15lEfxyGE4zKUCIcFghUIRy', 'media\\lead/(drl-signed)2407330074-2020_12_02_01_58_48(6).jpg', '2020-12-02 01:58:48', 'cypher', '2020-12-02 01:58:48', NULL),
	(110, '$2y$10$EUluh04dBhERPqlVbQQFxetW7gOHw9euHoOv1wfdSXfHvBteTHC6', 'media\\lead/(meeting-internal-mom)document-2020_12_02_02_01_56(6).pdf', '2020-12-02 02:01:56', 'cypher', '2020-12-02 02:01:56', NULL),
	(111, '$2y$10$XrFqBAB9GQfmANWJfZWkZ.oSbJ9SNwqsHnUFKhsKSQhBUTrpcEqa', 'media\\lead/(meeting-eksternal-mom)document-2020_12_02_02_02_13(6).pdf', '2020-12-02 02:02:13', 'cypher', '2020-12-02 02:02:13', NULL),
	(112, '$2y$10$e2FwOcPUa1qvDkEQ.XYq.PuVM6AwPsNgIconXgALQYnSXOQ.3J.', 'media\\lead/(wo-draft)55_FP-2020_12_02_02_10_35(6).pdf', '2020-12-02 02:10:35', 'cypher', '2020-12-02 02:10:35', NULL),
	(113, '$2y$10$DWv5ScQwU1IoxkGtwZbtF.Ws7ZFNIKquLMZ7RDQkkZw80JMZ2N..G', 'media\\lead/(wo-resi)20202857098351020011-2020_12_02_02_12_44(6).pdf', '2020-12-02 02:12:44', 'cypher', '2020-12-02 02:12:44', NULL),
	(114, '$2y$10$jjHG3hgOSIH91diRMedEpuZj.7WFoMWbGGu55b8TCL3NYymZ8ddqi', 'media\\lead/(wo-signed)20202857098351020011-2020_12_02_02_12_49(6).pdf', '2020-12-02 02:12:49', 'cypher', '2020-12-02 02:12:49', NULL),
	(115, '$2y$10$MpBakZdaBosHSWW3Rmk3U.GCqJtOC0i0qJ6A5NIuVNyRZf8wnlc5y', 'media\\lead/(agreement-draft)ap_logo-2020_12_02_02_12_55(6).png', '2020-12-02 02:12:55', 'cypher', '2020-12-02 02:12:55', NULL),
	(116, '$2y$10$iV5.4Wj665SNWLu9RzV2OeDT2OyF2oCcPWRg7DRNFLkKOGEYY0Su', 'media\\lead/(agreement-resi)20202857098351020011-2020_12_02_02_13_13(6).pdf', '2020-12-02 02:13:13', 'cypher', '2020-12-02 02:13:13', NULL),
	(117, '$2y$10$6gH8fS4YVxYvaXz3axAIcO7W0ASbegssSPrFx6Qbx3naBYnhrh3C', 'media\\lead/(agreement-signed)d98e4c67512664c91040030b015eef22632571cef008634c3e04fdcdb0badf92-2020_12_02_02_13_17(6).gif', '2020-12-02 02:13:17', 'cypher', '2020-12-02 02:13:17', NULL),
	(118, '$2y$10$D5fzQhaXiE84Nuv8UehpGeWkuwWj8I.xBYKdhYwXdSr9u74TmuFyK', 'media/forum_attachment/2020_12_02_07_40_49image1.gif', '2020-12-02 07:40:49', 'cypher', '2020-12-02 07:40:49', NULL),
	(119, '$2y$10$90PROKJ89l2SdFoD3irOQuguVIqLvrikNGS.6reS0lP0azi03NSi', 'media/forum_attachment/2020_12_02_07_40_49image2.png', '2020-12-02 07:40:49', 'cypher', '2020-12-02 07:40:49', NULL),
	(120, '$2y$10$JvYzrF2DTEKlj9AxEj9j.9rf4BBMi5VGRcnuxXR9r660h2tv3J5S', 'media/forum_attachment/2020_12_02_07_40_49video.mp4', '2020-12-02 07:40:49', 'cypher', '2020-12-02 07:40:49', NULL),
	(121, '$2y$10$yhakPzdWox4r7O4jYdAc.qYSzvKEkstvDY7JYuAjOAkeMPn3XCa', 'media/employee_attachment/Budi Sentosa_2020_12_02_08_13_40-contract_file.pdf', '2020-12-02 08:13:40', 'cypher', '2020-12-02 08:13:40', NULL),
	(122, '$2y$10$P5BRL4Zht2jMVlx7thIw0ufKo9xGU9tESOIUnrDKERkKBiVufZ.5.', 'media/policy_attachment/2020_12_02_08_16_29_attachment_policy.jpg', '2020-12-02 08:16:29', 'cypher', '2020-12-02 08:16:29', NULL),
	(123, '$2y$10$t8zuquCjhg.v4ea9h5U3a.HfpCKgYzyXEx.T1LP.9zSgN.C4.4S', 'media/policy_attachment/2020_12_02_08_40_53_attachment_policy.png', '2020-12-02 08:40:53', 'cypher', '2020-12-02 08:40:53', NULL),
	(124, '$2y$10$nznnRDWNyehOi6zJ8vezY2a8D8acZnWGqZzYK93sdhOccyv9O', 'media/policy_attachment/2020_12_02_08_46_33_attachment_policy.png', '2020-12-02 08:46:33', 'cypher', '2020-12-02 08:46:33', NULL);
/*!40000 ALTER TABLE `file_managements` ENABLE KEYS */;

-- Dumping structure for table cypher4.file_request
CREATE TABLE IF NOT EXISTS `file_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_hash` text DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `own_approved_by` varchar(50) DEFAULT NULL,
  `own_approved_at` datetime DEFAULT NULL,
  `dir_approved_by` varchar(50) DEFAULT NULL,
  `dir_approved_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.file_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `file_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_request` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_balance_sheet_setting
CREATE TABLE IF NOT EXISTS `finance_balance_sheet_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets` text DEFAULT NULL,
  `liability` text DEFAULT NULL,
  `equity` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.finance_balance_sheet_setting: ~0 rows (approximately)
/*!40000 ALTER TABLE `finance_balance_sheet_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance_balance_sheet_setting` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_bank_loan
CREATE TABLE IF NOT EXISTS `finance_bank_loan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `bank` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(20,2) NOT NULL,
  `bunga` decimal(5,2) NOT NULL,
  `start` date NOT NULL,
  `period` int(5) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cicil_start` int(3) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archive_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive_time` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_bank_loan: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_bank_loan` DISABLE KEYS */;
INSERT INTO `finance_bank_loan` (`id`, `bank`, `value`, `bunga`, `start`, `period`, `type`, `currency`, `cicil_start`, `description`, `archive_by`, `archive_time`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'Mandiri 1', 100000.00, 1.00, '2020-10-10', 12, 'KI', 'IDR', 0, 'asd', NULL, NULL, NULL, '2020-11-12 03:27:50', 'cypher', '2020-11-12 03:27:50', NULL, NULL, 1),
	(2, 'Mandiri', 100000000.00, 2.00, '2020-12-02', 20, 'KI', 'IDR', 0, 'asdasdas', NULL, NULL, NULL, '2020-12-02 15:17:25', 'cypher', '2020-12-02 15:17:25', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_bank_loan` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_bank_loan_detail
CREATE TABLE IF NOT EXISTS `finance_bank_loan_detail` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_loan` int(5) NOT NULL,
  `cicilan` decimal(20,2) DEFAULT NULL,
  `bunga_rate` decimal(5,2) DEFAULT NULL,
  `bunga` decimal(20,2) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_cicil` int(4) DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_bank_loan_detail: ~32 rows (approximately)
/*!40000 ALTER TABLE `finance_bank_loan_detail` DISABLE KEYS */;
INSERT INTO `finance_bank_loan_detail` (`id`, `id_loan`, `cicilan`, `bunga_rate`, `bunga`, `status`, `n_cicil`, `plan_date`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 8333.33, 1.00, 84.93, 'planned', 1, '2020-10-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(2, 1, 8333.33, 1.00, 82.19, 'paid', 2, '2020-11-10', NULL, '2020-11-12 03:28:37', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(3, 1, 8333.33, 1.00, 84.93, 'paid', 3, '2020-12-10', NULL, '2020-12-02 15:55:20', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(4, 1, 8333.33, 1.00, 84.93, 'planned', 4, '2021-01-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(5, 1, 8333.33, 1.00, 76.71, 'planned', 5, '2021-02-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(6, 1, 8333.33, 1.00, 84.93, 'planned', 6, '2021-03-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(7, 1, 8333.33, 1.00, 82.19, 'planned', 7, '2021-04-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(8, 1, 8333.33, 1.00, 84.93, 'planned', 8, '2021-05-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(9, 1, 8333.33, 1.00, 82.19, 'planned', 9, '2021-06-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(10, 1, 8333.33, 1.00, 84.93, 'planned', 10, '2021-07-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(11, 1, 8333.33, 1.00, 84.93, 'planned', 11, '2021-08-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(12, 1, 8333.33, 1.00, 82.19, 'planned', 12, '2021-09-10', NULL, '2020-11-12 03:28:19', 'cypher', '2020-11-12 03:28:19', NULL, NULL, 1),
	(13, 2, 5000000.00, 2.00, 169863.01, 'paid', 1, '2020-12-02', NULL, '2020-12-02 15:47:25', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(14, 2, 5000000.00, 2.00, 169863.01, 'planned', 2, '2021-01-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(15, 2, 5000000.00, 2.00, 153424.66, 'planned', 3, '2021-02-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(16, 2, 5000000.00, 2.00, 169863.01, 'planned', 4, '2021-03-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(17, 2, 5000000.00, 2.00, 164383.56, 'planned', 5, '2021-04-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(18, 2, 5000000.00, 2.00, 169863.01, 'planned', 6, '2021-05-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(19, 2, 5000000.00, 2.00, 164383.56, 'planned', 7, '2021-06-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(20, 2, 5000000.00, 2.00, 169863.01, 'planned', 8, '2021-07-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(21, 2, 5000000.00, 2.00, 169863.01, 'planned', 9, '2021-08-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(22, 2, 5000000.00, 2.00, 164383.56, 'planned', 10, '2021-09-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(23, 2, 5000000.00, 2.00, 169863.01, 'planned', 11, '2021-10-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(24, 2, 5000000.00, 2.00, 164383.56, 'planned', 12, '2021-11-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(25, 2, 5000000.00, 2.00, 169863.01, 'planned', 13, '2021-12-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(26, 2, 5000000.00, 2.00, 169863.01, 'planned', 14, '2022-01-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(27, 2, 5000000.00, 2.00, 153424.66, 'planned', 15, '2022-02-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(28, 2, 5000000.00, 2.00, 169863.01, 'planned', 16, '2022-03-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(29, 2, 5000000.00, 2.00, 164383.56, 'planned', 17, '2022-04-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(30, 2, 5000000.00, 2.00, 169863.01, 'planned', 18, '2022-05-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(31, 2, 5000000.00, 2.00, 164383.56, 'planned', 19, '2022-06-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1),
	(32, 2, 5000000.00, 2.00, 169863.01, 'planned', 20, '2022-07-02', NULL, '2020-12-02 15:23:11', 'cypher', '2020-12-02 15:23:11', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_bank_loan_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_coa
CREATE TABLE IF NOT EXISTS `finance_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_coa: ~47 rows (approximately)
/*!40000 ALTER TABLE `finance_coa` DISABLE KEYS */;
INSERT INTO `finance_coa` (`id`, `code`, `name`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '10000', 'Aset', NULL, 1, '2020-10-09 08:04:07', '2020-10-09 08:04:07', NULL),
	(2, '11000', 'Aset Lancar', '10000', 1, '2020-10-09 08:04:29', '2020-10-09 08:04:29', NULL),
	(3, '11100', 'Kas dan Setara Kas', '11000', 1, '2020-10-09 08:04:52', '2020-10-09 08:04:52', NULL),
	(4, '11110', 'Kas', '11100', 1, '2020-10-09 08:05:57', '2020-10-26 03:03:00', NULL),
	(5, '11111', 'Kas Kecil', '11110', 1, '2020-10-09 08:06:12', '2020-10-26 03:03:01', NULL),
	(6, '11120', 'Bank', '11100', 1, '2020-10-09 08:06:30', '2020-10-09 08:06:30', NULL),
	(7, '11121', 'Bank Mandiri', '11120', 1, '2020-10-09 08:06:47', '2020-10-09 08:06:47', NULL),
	(8, '11200', 'Piutang Usaha', '11000', 1, '2020-10-09 08:10:41', '2020-10-09 08:10:41', NULL),
	(9, '11300', 'Piutang Pemegang Saham', '11000', 1, '2020-10-09 08:11:32', '2020-10-09 08:11:32', NULL),
	(10, '11400', 'Biaya Dibayar Dimuka', '11000', 1, '2020-10-09 08:12:35', '2020-10-09 08:12:35', NULL),
	(11, '11500', 'Piutang Lain-lain', '11000', 1, '2020-10-09 08:12:53', '2020-10-09 08:12:53', NULL),
	(12, '11410', 'Uang Muka Lainnnya', '11400', 1, '2020-10-09 08:14:50', '2020-10-09 08:14:50', NULL),
	(13, '11310', 'H. Rifwaldi Rivai Muhammad Noer', '11300', 1, '2020-10-09 08:15:34', '2020-10-09 08:16:50', '2020-10-09 08:16:50'),
	(14, '11320', 'Zulfikar Lukman', '11300', 1, '2020-10-09 08:16:13', '2020-10-09 08:16:54', '2020-10-09 08:16:54'),
	(15, '11510', 'The Executive Centre', '11500', 1, '2020-10-09 08:16:41', '2020-10-09 08:17:13', '2020-10-09 08:17:13'),
	(16, '12000', 'Aset Tidak Lancar', '10000', 1, '2020-10-09 08:18:20', '2020-10-09 08:18:20', NULL),
	(17, '12100', 'Aset Tetap', '12000', 1, '2020-10-09 08:19:02', '2020-10-09 08:19:02', NULL),
	(18, '12110', 'Peralatan Kantor', '12100', 1, '2020-10-09 08:19:30', '2020-10-09 08:19:30', NULL),
	(19, '12120', 'Akumulasi Penyusutan Peralatan Kantor', '12100', 1, '2020-10-09 08:27:21', '2020-10-09 08:27:21', NULL),
	(20, '20000', 'Liabilitas', NULL, 1, '2020-10-09 08:28:24', '2020-10-09 08:28:24', NULL),
	(21, '21000', 'Liabilitas Lancar', '20000', 1, '2020-10-09 08:28:53', '2020-10-09 08:28:53', NULL),
	(22, '21100', 'Pendapatan Diterima Dimuka', '21000', 1, '2020-10-09 08:30:48', '2020-10-09 08:30:48', NULL),
	(23, '21200', 'Hutang Pajak', '21000', 1, '2020-10-09 08:31:07', '2020-10-09 08:31:07', NULL),
	(24, '22000', 'Liabilitas Tidak Lancar', '20000', 1, '2020-10-09 08:31:34', '2020-10-09 08:31:34', NULL),
	(25, '30000', 'Ekuitas', NULL, 1, '2020-10-09 08:32:01', '2020-10-09 08:32:01', NULL),
	(26, '31000', 'Modal Saham', '30000', 1, '2020-10-09 08:32:38', '2020-10-09 08:32:38', NULL),
	(27, '32000', 'Saldo Laba (Rugi)', '30000', 1, '2020-10-09 08:33:09', '2020-10-09 08:33:09', NULL),
	(28, '40000', 'Pendapatan', NULL, 1, '2020-10-09 08:34:06', '2020-10-09 08:34:06', NULL),
	(29, '41000', 'Pendapatan Jasa', '40000', 1, '2020-10-09 08:34:20', '2020-10-09 08:34:20', NULL),
	(30, '50000', 'Beban', NULL, 1, '2020-10-09 08:34:52', '2020-10-09 08:34:52', NULL),
	(31, '51000', 'Beban Administrasi dan Umum', '50000', 1, '2020-10-09 08:35:33', '2020-10-09 08:35:33', NULL),
	(32, '51100', 'Biaya Gaji dan Tunjangan (PT)', '51000', 1, '2020-10-09 08:41:18', '2020-10-09 08:41:18', NULL),
	(33, '51200', 'Biaya Gaji dan Tunjangan (PTT)', '51000', 1, '2020-10-09 08:41:47', '2020-10-09 08:41:47', NULL),
	(34, '51300', 'Biaya THR dan Bonus (PT)', '51000', 1, '2020-10-09 08:42:11', '2020-10-09 08:42:11', NULL),
	(35, '51400', 'Tunjangan Pajak', '51000', 1, '2020-10-09 08:43:58', '2020-10-09 08:43:58', NULL),
	(36, '51500', 'Biaya Lembur (PT)', '51000', 1, '2020-10-09 08:44:34', '2020-10-09 08:44:34', NULL),
	(37, '51600', 'Jasa Profesional', '51000', 1, '2020-10-09 08:45:14', '2020-10-09 08:45:14', NULL),
	(38, '51700', 'Transport', '51000', 1, '2020-10-09 09:57:07', '2020-10-09 09:57:07', NULL),
	(39, '51800', 'Bensin', '51000', 1, '2020-10-09 09:57:35', '2020-10-09 09:57:35', NULL),
	(40, '51900', 'Tol dan Parkir', '51000', 1, '2020-10-09 09:58:10', '2020-10-09 09:58:10', NULL),
	(41, '51010', 'Akomodasi', '51000', 1, '2020-10-09 10:03:53', '2020-10-09 10:11:10', NULL),
	(42, '42000', 'Pendapatan Lain-lain', '40000', 1, '2020-10-09 10:29:22', '2020-10-09 10:29:22', NULL),
	(43, '52000', 'Beban Lain-lain', '50000', 1, '2020-10-09 10:29:44', '2020-10-09 10:29:44', NULL),
	(44, '42100', 'Pendapatan Jasa Giro', '42000', 1, '2020-10-09 10:30:21', '2020-10-09 10:30:21', NULL),
	(45, '42200', 'Pendapatan Lain-lain', '42000', 1, '2020-10-09 10:30:51', '2020-10-09 10:30:51', NULL),
	(46, '52100', 'Biaya Bank', '52000', 1, '2020-10-09 10:31:10', '2020-10-09 10:31:10', NULL),
	(47, '52200', 'Biaya Lain-lain', '52000', 1, '2020-10-09 10:31:26', '2020-10-09 10:31:26', NULL);
/*!40000 ALTER TABLE `finance_coa` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_coa_history
CREATE TABLE IF NOT EXISTS `finance_coa_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_treasure_history` int(11) NOT NULL DEFAULT 0,
  `md5` text DEFAULT NULL,
  `no_coa` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coa_date` date DEFAULT NULL,
  `debit` decimal(15,2) DEFAULT NULL,
  `credit` decimal(15,2) DEFAULT NULL,
  `file_hash` text DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.finance_coa_history: ~40 rows (approximately)
/*!40000 ALTER TABLE `finance_coa_history` DISABLE KEYS */;
INSERT INTO `finance_coa_history` (`id`, `id_treasure_history`, `md5`, `no_coa`, `description`, `coa_date`, `debit`, `credit`, `file_hash`, `company_id`, `approved_by`, `approved_at`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
	(1, 22, NULL, '11000', NULL, '2020-10-19', 280000.00, NULL, '$2y$10$axgrGOju1ZTRRX12rIPJG.GkY3xE97yqYd77tNEVnMRqkLc9NmQq', 1, NULL, NULL, '2020-10-21 09:34:08', '2020-11-03 10:13:12', NULL, 'admin', 'admin', NULL),
	(2, 22, NULL, '12100', NULL, '2020-10-19', 100000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 09:34:08', '2020-10-21 10:40:29', '2020-10-21 10:40:29', 'admin', 'admin', NULL),
	(3, 22, NULL, '11121', NULL, '2020-10-19', NULL, 280000.00, '$2y$10$axgrGOju1ZTRRX12rIPJG.GkY3xE97yqYd77tNEVnMRqkLc9NmQq', 1, NULL, NULL, '2020-10-21 09:34:08', '2020-11-03 10:13:12', NULL, 'admin', 'admin', NULL),
	(4, 21, NULL, '12100', NULL, '2020-10-08', 100000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 09:38:05', '2020-10-21 09:38:05', NULL, 'admin', NULL, NULL),
	(5, 21, NULL, '11121', NULL, '2020-10-08', NULL, 100000.00, NULL, 1, NULL, NULL, '2020-10-21 09:38:05', '2020-10-21 09:38:05', NULL, 'admin', NULL, NULL),
	(6, 20, NULL, '11121', NULL, '2020-10-08', 12000000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 09:39:18', '2020-10-21 09:39:18', NULL, 'admin', NULL, NULL),
	(7, 20, NULL, '12100', NULL, '2020-10-08', NULL, 12000000.00, NULL, 1, NULL, NULL, '2020-10-21 09:39:18', '2020-10-21 09:39:18', NULL, 'admin', NULL, NULL),
	(8, 22, NULL, '12000', NULL, '2020-10-19', 100000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 10:10:52', '2020-10-21 10:39:04', '2020-10-21 10:39:04', 'admin', NULL, NULL),
	(9, 18, NULL, '11200', NULL, '2020-10-08', 12000000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 10:11:28', '2020-10-21 10:11:28', NULL, 'admin', NULL, NULL),
	(10, 18, NULL, '11121', NULL, '2020-10-08', NULL, 12000000.00, NULL, 1, NULL, NULL, '2020-10-21 10:11:28', '2020-10-21 10:11:28', NULL, 'admin', NULL, NULL),
	(11, 5, NULL, '11000', NULL, '2020-10-06', 5000000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 10:13:33', '2020-10-21 10:13:33', NULL, 'admin', NULL, NULL),
	(12, 5, NULL, '12100', NULL, '2020-10-06', 10000000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 10:13:33', '2020-10-21 10:13:33', NULL, 'admin', NULL, NULL),
	(13, 5, NULL, '11121', NULL, '2020-10-06', NULL, 15000000.00, NULL, 1, NULL, NULL, '2020-10-21 10:13:33', '2020-10-21 10:13:33', NULL, 'admin', NULL, NULL),
	(14, 22, NULL, '12110', NULL, '2020-10-19', 100000.00, NULL, NULL, 1, NULL, NULL, '2020-10-21 10:40:06', '2020-10-21 10:40:29', '2020-10-21 10:40:29', 'admin', 'admin', NULL),
	(15, 0, 'a7e73b59f4145b850b9dba5ffd7f4ec1', '10000', 'tes', '2020-10-23', 1000.00, NULL, NULL, 1, 'admin', '2020-10-27 02:00:20', '2020-10-23 08:27:12', '2020-10-27 02:00:20', NULL, 'admin', NULL, NULL),
	(16, 0, 'a7e73b59f4145b850b9dba5ffd7f4ec1', '11121', 'tes', '2020-10-23', NULL, 1000.00, NULL, 1, 'admin', '2020-10-27 02:00:20', '2020-10-23 08:27:12', '2020-10-27 02:00:20', NULL, 'admin', NULL, NULL),
	(17, 0, 'f7a0da54ada4cda3d8813dab244b52b1', '10000', 'hmmmm', '2020-10-24', 10000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 09:03:12', '2020-10-23 09:03:12', NULL, 'admin', NULL, NULL),
	(18, 0, 'f7a0da54ada4cda3d8813dab244b52b1', '11000', 'hmmmm', '2020-10-24', NULL, 5000.00, NULL, 1, NULL, NULL, '2020-10-23 09:03:12', '2020-10-23 09:03:12', NULL, 'admin', NULL, NULL),
	(19, 0, 'f7a0da54ada4cda3d8813dab244b52b1', '12100', 'hmmmm', '2020-10-24', NULL, 5000.00, NULL, 1, NULL, NULL, '2020-10-23 09:03:12', '2020-10-23 09:03:12', NULL, 'admin', NULL, NULL),
	(20, 0, '57ddd404ba320a496037c8e1066364d9', '10000', 'tetasd', '2020-10-22', 10000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 17:57:08', '2020-10-23 17:58:49', '2020-10-23 17:58:49', 'admin', NULL, NULL),
	(21, 0, '57ddd404ba320a496037c8e1066364d9', '10000', 'tetasd', '2020-10-22', NULL, 10000.00, NULL, 1, NULL, NULL, '2020-10-23 17:57:08', '2020-10-23 17:58:49', '2020-10-23 17:58:49', 'admin', NULL, NULL),
	(22, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', 'teadsasda', '2020-10-15', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 18:49:29', '2020-10-23 19:09:12', '2020-10-23 19:09:12', 'admin', NULL, NULL),
	(23, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '11100', 'teadsasda', '2020-10-15', 500.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 18:49:29', '2020-10-23 19:09:12', '2020-10-23 19:09:12', 'admin', NULL, NULL),
	(24, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '12100', 'teadsasda', '2020-10-15', 500.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 18:49:29', '2020-10-23 19:09:12', '2020-10-23 19:09:12', 'admin', NULL, NULL),
	(25, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', 'teadsasda', '2020-10-15', NULL, 2000.00, NULL, 1, NULL, NULL, '2020-10-23 18:49:29', '2020-10-23 19:09:12', '2020-10-23 19:09:12', 'admin', NULL, NULL),
	(26, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', 'teadsasda', '2020-10-15', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:12', '2020-10-23 19:09:21', '2020-10-23 19:09:21', 'admin', NULL, NULL),
	(27, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '11100', 'teadsasda', '2020-10-15', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:12', '2020-10-23 19:09:21', '2020-10-23 19:09:21', 'admin', NULL, NULL),
	(28, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', 'teadsasda', '2020-10-15', NULL, 2000.00, NULL, 1, NULL, NULL, '2020-10-23 19:09:12', '2020-10-23 19:09:21', '2020-10-23 19:09:21', 'admin', NULL, NULL),
	(29, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', '1231', '2020-10-15', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:21', '2020-10-23 19:09:26', '2020-10-23 19:09:26', 'admin', NULL, NULL),
	(30, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '11100', '1231', '2020-10-15', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:21', '2020-10-23 19:09:26', '2020-10-23 19:09:26', 'admin', NULL, NULL),
	(31, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', '1231', '2020-10-15', NULL, 2000.00, NULL, 1, NULL, NULL, '2020-10-23 19:09:21', '2020-10-23 19:09:26', '2020-10-23 19:09:26', 'admin', NULL, NULL),
	(32, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', '1231', '2020-10-17', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:26', '2020-10-23 19:09:26', NULL, 'admin', NULL, NULL),
	(33, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '11100', '1231', '2020-10-17', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-23 19:09:26', '2020-10-23 19:09:26', NULL, 'admin', NULL, NULL),
	(34, 0, 'c84f51eacb68ffd16baece9ebb65f7ae', '10000', '1231', '2020-10-17', NULL, 2000.00, NULL, 1, NULL, NULL, '2020-10-23 19:09:26', '2020-10-23 19:09:26', NULL, 'admin', NULL, NULL),
	(35, 0, '0f922903a8ade468c427313b25d74abb', '10000', '1asdadas', '2020-10-20', 1000.00, NULL, NULL, 1, NULL, NULL, '2020-10-24 04:50:21', '2020-10-24 04:50:21', NULL, 'admin', NULL, NULL),
	(36, 0, '0f922903a8ade468c427313b25d74abb', '11000', '1asdadas', '2020-10-20', NULL, 1000.00, NULL, 1, NULL, NULL, '2020-10-24 04:50:21', '2020-10-24 04:50:21', NULL, 'admin', NULL, NULL),
	(37, 0, '9917741077ad29d9cb6e2a0ea501fcd8', '10000', 'teasd', '2020-11-03', 1000.00, NULL, '$2y$10$cm3ntyokuKTefEmggxOSieR6dahYXAkyZBjlYpDsnFr5sqXF1A58e', 1, NULL, NULL, '2020-11-03 09:35:13', '2020-11-03 09:35:13', NULL, 'admin', NULL, NULL),
	(38, 0, '9917741077ad29d9cb6e2a0ea501fcd8', '30000', 'teasd', '2020-11-03', NULL, 1000.00, '$2y$10$cm3ntyokuKTefEmggxOSieR6dahYXAkyZBjlYpDsnFr5sqXF1A58e', 1, NULL, NULL, '2020-11-03 09:35:13', '2020-11-03 09:35:13', NULL, 'admin', NULL, NULL),
	(39, 9, NULL, '10000', NULL, '2020-10-06', 13000000.00, NULL, '$2y$10$E9I74eim0f0JHtzGL7.zbuUmWZR50JEgz5ZISJADGS9MJWtsU6tC', 1, 'admin', '2020-11-03 10:06:19', '2020-11-03 10:06:19', '2020-11-03 10:06:19', NULL, 'admin', NULL, NULL),
	(40, 9, NULL, '11121', NULL, '2020-10-06', NULL, 13000000.00, '$2y$10$E9I74eim0f0JHtzGL7.zbuUmWZR50JEgz5ZISJADGS9MJWtsU6tC', 1, 'admin', '2020-11-03 10:06:19', '2020-11-03 10:06:19', '2020-11-03 10:06:19', NULL, 'admin', NULL, NULL);
/*!40000 ALTER TABLE `finance_coa_history` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_invoice_in
CREATE TABLE IF NOT EXISTS `finance_invoice_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) NOT NULL,
  `paper_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `amount_left` decimal(20,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `app_date` date DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_invoice_in: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_invoice_in` DISABLE KEYS */;
INSERT INTO `finance_invoice_in` (`id`, `paper_id`, `paper_type`, `amount`, `amount_left`, `pay_date`, `app_date`, `status`, `project`, `plan_date`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'PO', 4950000.00, 4850000.00, '2020-12-02', '2020-12-02', 'input', '1', NULL, NULL, '2020-12-02 15:57:47', NULL, '2020-12-02 15:13:36', NULL, NULL, 1),
	(2, 3, 'WO', 1210000.00, 710000.00, '2020-12-02', '2020-12-02', 'input', '1', NULL, NULL, '2020-12-02 15:52:15', NULL, '2020-12-02 15:34:04', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_invoice_in` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_invoice_in_pay
CREATE TABLE IF NOT EXISTS `finance_invoice_in_pay` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `inv_id` int(11) NOT NULL,
  `pay_num` int(3) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` tinyint(4) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `inv_date_received` date DEFAULT NULL,
  `inv_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_invoice_in_pay: ~5 rows (approximately)
/*!40000 ALTER TABLE `finance_invoice_in_pay` DISABLE KEYS */;
INSERT INTO `finance_invoice_in_pay` (`id`, `inv_id`, `pay_num`, `amount`, `pay_date`, `description`, `paid`, `inv_date`, `inv_date_received`, `inv_number`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 1, 100000.00, '2020-12-24', 'dasd', 1, NULL, NULL, NULL, NULL, '2020-12-02 15:57:47', NULL, '2020-12-02 15:16:40', NULL, NULL, NULL),
	(2, 1, 2, 100000.00, '2020-12-31', 'asdada', NULL, NULL, NULL, NULL, NULL, '2020-12-02 15:16:49', NULL, '2020-12-02 15:16:49', NULL, NULL, NULL),
	(3, 2, 1, 500000.00, '2020-12-07', 'DP', 1, NULL, NULL, NULL, NULL, '2020-12-02 15:52:15', NULL, '2020-12-02 15:34:29', NULL, NULL, NULL),
	(4, 2, 2, 500000.00, '2020-12-23', 'Payment2', NULL, NULL, NULL, NULL, NULL, '2020-12-02 15:34:46', NULL, '2020-12-02 15:34:46', NULL, NULL, NULL),
	(5, 2, 3, 210000.00, '2021-01-04', 'Pelunasan', NULL, NULL, NULL, NULL, NULL, '2020-12-02 15:35:00', NULL, '2020-12-02 15:35:00', NULL, NULL, NULL);
/*!40000 ALTER TABLE `finance_invoice_in_pay` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_inv_out
CREATE TABLE IF NOT EXISTS `finance_inv_out` (
  `id_inv` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_periode` date DEFAULT NULL,
  `end_periode` date DEFAULT NULL,
  `company` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prj_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valueday` decimal(15,2) DEFAULT NULL,
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inv`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_inv_out: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_inv_out` DISABLE KEYS */;
INSERT INTO `finance_inv_out` (`id_inv`, `no`, `title`, `start_periode`, `end_periode`, `company`, `periode`, `value`, `currency`, `prj_code`, `valueday`, `prefix`, `deposit`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, NULL, '{"id":"2","type":"project","tag":"001"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-12 02:50:51', 'cypher', '2020-11-12 02:50:51', NULL, NULL, NULL, 1),
	(2, NULL, '{"id":"7","type":"project","tag":"HHO"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 09:01:04', 'cypher', '2020-12-02 09:01:04', NULL, NULL, NULL, 17);
/*!40000 ALTER TABLE `finance_inv_out` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_inv_out_detail
CREATE TABLE IF NOT EXISTS `finance_inv_out_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_inv` int(11) NOT NULL,
  `activity` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `no_inv` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_id_inv` int(11) DEFAULT 0,
  `year_id_inv` year(4) DEFAULT 2000,
  `value_d` decimal(15,2) DEFAULT NULL,
  `payment_account` int(10) DEFAULT NULL,
  `wapu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin_approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin_approved_date` date DEFAULT NULL,
  `fin_approved_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_revise_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_revise_date` date DEFAULT NULL,
  `req_revise_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceo_app_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceo_app_date` date DEFAULT NULL,
  `ceo_app_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revise_number` int(10) DEFAULT NULL,
  `taxes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transferred` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_date` date DEFAULT NULL,
  `paid_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `paid_all_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_all_date` date DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_inv_out_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_inv_out_detail` DISABLE KEYS */;
INSERT INTO `finance_inv_out_detail` (`id`, `id_inv`, `activity`, `date`, `no_inv`, `no_id_inv`, `year_id_inv`, `value_d`, `payment_account`, `wapu`, `fin_approved_by`, `fin_approved_date`, `fin_approved_note`, `req_revise_by`, `req_revise_date`, `req_revise_note`, `status`, `ceo_app_by`, `ceo_app_date`, `ceo_app_note`, `revise_number`, `taxes`, `transferred`, `sent_by`, `sent_date`, `paid_by`, `paid_date`, `paid_all_by`, `paid_all_date`, `discount`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'Payment 1', '2020-11-12', '001/INV-VGI/001/XI/2020', 1, '2020', 1000000.00, 1, NULL, 'cypher', '2020-11-12', NULL, NULL, NULL, NULL, 'approved', 'cypher', '2020-11-12', NULL, NULL, '["1"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2020-11-12 02:51:20', 'cypher', '2020-11-12 02:53:28', 'cypher', NULL, NULL, 1),
	(2, 1, 'Payment 2', '2020-11-12', '002/INV-VGI/001/XI/2020', 2, '2020', 1000000.00, 1, NULL, 'cypher', '2020-11-12', NULL, NULL, NULL, NULL, 'approved', 'cypher', '2020-11-12', NULL, NULL, '["1"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '2020-11-12 03:30:18', 'cypher', '2020-11-12 03:38:34', 'cypher', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_inv_out_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_inv_out_print
CREATE TABLE IF NOT EXISTS `finance_inv_out_print` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_inv_out_detail` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(15,2) DEFAULT NULL,
  `qty` decimal(15,2) DEFAULT NULL,
  `uom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_inv_out_print: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_inv_out_print` DISABLE KEYS */;
INSERT INTO `finance_inv_out_print` (`id`, `id_inv_out_detail`, `description`, `unit_price`, `qty`, `uom`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, '<p>Item 1</p>', 1000000.00, 1.00, 'unit', '2020-11-12 02:51:59', 'cypher', '2020-11-12 02:51:59', NULL, NULL, NULL, 1),
	(2, 2, '<p>sada</p>', 10000.00, 100.00, 'kg', '2020-11-12 03:30:51', 'cypher', '2020-11-12 03:30:51', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_inv_out_print` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_leasing
CREATE TABLE IF NOT EXISTS `finance_leasing` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `subject` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` decimal(20,2) DEFAULT NULL,
  `bunga` decimal(5,2) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `period` int(5) DEFAULT NULL,
  `vendor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cicil_start` int(3) DEFAULT NULL,
  `dp` decimal(20,2) DEFAULT NULL,
  `adm` decimal(20,2) DEFAULT NULL,
  `insurance` decimal(20,2) DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_leasing: ~0 rows (approximately)
/*!40000 ALTER TABLE `finance_leasing` DISABLE KEYS */;
INSERT INTO `finance_leasing` (`id`, `subject`, `value`, `bunga`, `start`, `period`, `vendor`, `currency`, `cicil_start`, `dp`, `adm`, `insurance`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'lorem', 100000000.00, 2.00, '2020-12-02', 20, 'asdsadasda', 'IDR', 0, 500000.00, 200000.00, 200000.00, NULL, '2020-12-02 15:29:36', 'cypher', '2020-12-02 15:29:36', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_leasing` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_leasing_detail
CREATE TABLE IF NOT EXISTS `finance_leasing_detail` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_leasing` int(5) NOT NULL,
  `cicilan` decimal(20,2) DEFAULT NULL,
  `bunga_rate` decimal(5,2) DEFAULT NULL,
  `bunga` decimal(20,2) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_cicil` int(4) DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_leasing_detail: ~20 rows (approximately)
/*!40000 ALTER TABLE `finance_leasing_detail` DISABLE KEYS */;
INSERT INTO `finance_leasing_detail` (`id`, `id_leasing`, `cicilan`, `bunga_rate`, `bunga`, `status`, `n_cicil`, `plan_date`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 5000000.00, 2.00, 169863.01, 'paid', 1, '2020-12-02', NULL, '2020-12-03 03:48:55', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(2, 1, 5000000.00, 2.00, 169863.01, 'planned', 2, '2021-01-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(3, 1, 5000000.00, 2.00, 153424.66, 'planned', 3, '2021-02-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(4, 1, 5000000.00, 2.00, 169863.01, 'planned', 4, '2021-03-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(5, 1, 5000000.00, 2.00, 164383.56, 'planned', 5, '2021-04-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(6, 1, 5000000.00, 2.00, 169863.01, 'planned', 6, '2021-05-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(7, 1, 5000000.00, 2.00, 164383.56, 'planned', 7, '2021-06-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(8, 1, 5000000.00, 2.00, 169863.01, 'planned', 8, '2021-07-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(9, 1, 5000000.00, 2.00, 169863.01, 'planned', 9, '2021-08-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(10, 1, 5000000.00, 2.00, 164383.56, 'planned', 10, '2021-09-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(11, 1, 5000000.00, 2.00, 169863.01, 'planned', 11, '2021-10-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(12, 1, 5000000.00, 2.00, 164383.56, 'planned', 12, '2021-11-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(13, 1, 5000000.00, 2.00, 169863.01, 'planned', 13, '2021-12-02', NULL, '2020-12-02 15:29:40', 'cypher', '2020-12-02 15:29:40', NULL, NULL, 1),
	(14, 1, 5000000.00, 2.00, 169863.01, 'planned', 14, '2022-01-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(15, 1, 5000000.00, 2.00, 153424.66, 'planned', 15, '2022-02-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(16, 1, 5000000.00, 2.00, 169863.01, 'planned', 16, '2022-03-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(17, 1, 5000000.00, 2.00, 164383.56, 'planned', 17, '2022-04-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(18, 1, 5000000.00, 2.00, 169863.01, 'planned', 18, '2022-05-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(19, 1, 5000000.00, 2.00, 164383.56, 'planned', 19, '2022-06-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1),
	(20, 1, 5000000.00, 2.00, 169863.01, 'planned', 20, '2022-07-02', NULL, '2020-12-02 15:29:41', 'cypher', '2020-12-02 15:29:41', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_leasing_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_profit_loss_setting
CREATE TABLE IF NOT EXISTS `finance_profit_loss_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operating_income` text DEFAULT NULL,
  `operating_expense` text DEFAULT NULL,
  `other_income` text DEFAULT NULL,
  `other_expense` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.finance_profit_loss_setting: ~0 rows (approximately)
/*!40000 ALTER TABLE `finance_profit_loss_setting` DISABLE KEYS */;
INSERT INTO `finance_profit_loss_setting` (`id`, `operating_income`, `operating_expense`, `other_income`, `other_expense`, `tax`, `created_at`, `updated_at`, `company_id`) VALUES
	(2, '["1","3","16","20"]', '["3","4"]', '["6"]', '["8"]', '25', '2020-10-27 06:34:03', '2020-10-27 07:36:54', 1);
/*!40000 ALTER TABLE `finance_profit_loss_setting` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_schedule_payment
CREATE TABLE IF NOT EXISTS `finance_schedule_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_time` datetime DEFAULT NULL,
  `sp_date` date DEFAULT NULL,
  `payment_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDR` decimal(15,2) DEFAULT NULL,
  `USD` decimal(15,2) DEFAULT NULL,
  `PIC` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_schedule_payment: ~23 rows (approximately)
/*!40000 ALTER TABLE `finance_schedule_payment` DISABLE KEYS */;
INSERT INTO `finance_schedule_payment` (`id`, `input_time`, `sp_date`, `payment_type`, `description`, `IDR`, `USD`, `PIC`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2020-11-12 00:00:00', '2020-11-12', '', '001/VGI/PO/XI/20', 1000.00, NULL, 'cypher', NULL, '2020-11-12 02:57:51', '2020-11-12 02:57:51', NULL),
	(2, '2020-11-12 00:00:00', '2020-11-10', '', 'LOAN Mandiri 1', -8333.33, NULL, 'cypher', NULL, '2020-11-12 03:28:37', '2020-11-12 03:28:37', NULL),
	(3, '2020-11-30 00:00:00', '2020-11-28', '', 'Salary, jamsostek, pension of staff periode November 2020', -500000.00, NULL, 'cypher', NULL, '2020-11-30 12:40:09', '2020-11-30 12:40:09', NULL),
	(4, '2020-12-02 00:00:00', '2020-12-02', '', 'LOAN Mandiri', -5000000.00, NULL, 'cypher', NULL, '2020-12-02 15:47:25', '2020-12-02 15:47:25', NULL),
	(5, '2020-12-02 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-02 15:47:25', '2020-12-02 15:47:25', NULL),
	(6, '2020-12-02 00:00:00', '2020-12-03', '', 'UTIL Listrik Mess Rantau', -120000.00, NULL, 'cypher', NULL, '2020-12-02 15:51:41', '2020-12-02 15:51:41', NULL),
	(7, '2020-12-02 00:00:00', '2020-12-07', '', '002/VGI/WO/XII/20', 500000.00, NULL, 'cypher', NULL, '2020-12-02 15:52:15', '2020-12-02 15:52:15', NULL),
	(8, '2020-12-02 00:00:00', '2020-12-10', '', 'LOAN Mandiri 1', -8333.33, NULL, 'cypher', NULL, '2020-12-02 15:55:20', '2020-12-02 15:55:20', NULL),
	(9, '2020-12-02 00:00:00', '2020-12-24', '', '001/VGI/PO/XII/20', 100000.00, NULL, 'cypher', NULL, '2020-12-02 15:57:47', '2020-12-02 15:57:47', NULL),
	(10, '2020-12-02 00:00:00', '2020-12-28', '', 'Salary, jamsostek, pension of staff periode December 2020', -8780645.16, NULL, 'cypher', NULL, '2020-12-02 16:08:46', '2020-12-02 16:08:46', NULL),
	(11, '2020-12-02 00:00:00', '2020-12-28', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-02 16:08:46', '2020-12-02 16:08:46', NULL),
	(12, '2020-12-03 00:00:00', '2020-12-02', '', 'LOAN Mandiri', -5000000.00, NULL, 'cypher', NULL, '2020-12-03 03:41:58', '2020-12-03 03:41:58', NULL),
	(13, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:41:58', '2020-12-03 03:41:58', NULL),
	(14, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:41:58', '2020-12-03 03:41:58', NULL),
	(15, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:41:58', '2020-12-03 03:41:58', NULL),
	(16, '2020-12-03 00:00:00', '2020-12-02', '', 'LOAN Mandiri', -5000000.00, NULL, 'cypher', NULL, '2020-12-03 03:43:29', '2020-12-03 03:43:29', NULL),
	(17, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:43:29', '2020-12-03 03:43:29', NULL),
	(18, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:43:29', '2020-12-03 03:43:29', NULL),
	(19, '2020-12-03 00:00:00', '2020-12-02', '', '', 0.00, NULL, 'cypher', NULL, '2020-12-03 03:43:29', '2020-12-03 03:43:29', NULL),
	(20, '2020-12-03 00:00:00', '2020-12-02', 'LOAN', 'LOAN Mandiri', -5000000.00, NULL, 'cypher', NULL, '2020-12-03 03:48:55', '2020-12-03 03:48:55', NULL),
	(21, '2020-12-03 00:00:00', '2020-12-02', 'LEASING', 'LEASING lorem', -5000000.00, NULL, 'cypher', NULL, '2020-12-03 03:48:55', '2020-12-03 03:48:55', NULL),
	(22, '2020-12-03 00:00:00', '2020-12-02', 'UTIL', 'UTIL Listrik Kantor', -100000.00, NULL, 'cypher', NULL, '2020-12-03 03:48:55', '2020-12-03 03:48:55', NULL),
	(23, '2020-12-03 00:00:00', '2020-12-02', 'UTIL', 'UTIL Listrik Mess Rantau', -100000.00, NULL, 'cypher', NULL, '2020-12-03 03:48:55', '2020-12-03 03:48:55', NULL);
/*!40000 ALTER TABLE `finance_schedule_payment` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_treasure
CREATE TABLE IF NOT EXISTS `finance_treasure` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `source` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `USD` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDR` decimal(15,2) DEFAULT NULL,
  `account_usd` decimal(15,2) DEFAULT NULL,
  `account_idr` decimal(15,2) DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `br_balance` decimal(15,2) DEFAULT NULL,
  `id_bank` int(3) DEFAULT NULL,
  `currency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'IDR',
  `account_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_idr` decimal(15,2) DEFAULT NULL,
  `actual_usd` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_treasure: ~3 rows (approximately)
/*!40000 ALTER TABLE `finance_treasure` DISABLE KEYS */;
INSERT INTO `finance_treasure` (`id`, `source`, `USD`, `IDR`, `account_usd`, `account_idr`, `type`, `br_balance`, `id_bank`, `currency`, `account_number`, `account_name`, `branch`, `address`, `bank_code`, `swift_code`, `actual_idr`, `actual_usd`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'Mandiri 1', NULL, -9333.33, NULL, NULL, 'bank', NULL, NULL, 'IDR', '1231312312', 'PT VESSEL GROUP', 'Pejaten', NULL, '', NULL, NULL, NULL, '2020-11-12 02:48:56', 'cypher', '2020-11-12 03:28:37', NULL, NULL, NULL, 1),
	(2, 'BRI', NULL, -500000.00, NULL, NULL, 'bank', NULL, NULL, 'IDR', '3093xxxxxx', 'Rangga', 'Cilandak', NULL, '11120', NULL, NULL, NULL, '2020-11-20 07:45:05', 'cypher', '2020-11-30 12:40:09', NULL, NULL, NULL, 1),
	(3, 'BANK ROYAL', NULL, -33508978.49, NULL, NULL, 'bank', NULL, NULL, 'IDR', '1282203212', 'PT ABC', 'KALIBATA', NULL, NULL, NULL, NULL, NULL, '2020-12-02 15:45:06', 'cypher', '2020-12-03 03:48:55', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_treasure` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_treasure_history
CREATE TABLE IF NOT EXISTS `finance_treasure_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_treasure` int(4) NOT NULL,
  `date_input` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDR` decimal(15,2) NOT NULL,
  `USD` int(11) NOT NULL DEFAULT 0,
  `PIC` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_app` int(1) NOT NULL DEFAULT 0,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_treasure_history: ~18 rows (approximately)
/*!40000 ALTER TABLE `finance_treasure_history` DISABLE KEYS */;
INSERT INTO `finance_treasure_history` (`id`, `id_treasure`, `date_input`, `description`, `IDR`, `USD`, `PIC`, `sp_date`, `sp_app`, `approved_by`, `approved_at`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(3, 1, '2020-11-10', '[SP] Schedule Payment for Loan Mandiri 1', -8333.33, 0, 'cypher', '1', 1, NULL, NULL, '2020-11-12 03:28:37', NULL, '2020-12-01 08:08:09', NULL, NULL, NULL, NULL),
	(4, 1, '2020-11-12', 'Invoice out Payment: Payment 2[JASA SEWA ANGKUTAN UMUM]', 1000000.00, 0, 'cypher', '2', 0, NULL, NULL, '2020-11-12 03:38:34', NULL, '2020-12-01 04:57:31', NULL, NULL, NULL, 1),
	(5, 1, '2020-11-13', 'Pembayaran Bid/Performance Bond ID : 2/VGI/BPB/11/2020 Guarantee Fund', -7000.00, 0, 'cypher', '2', 0, NULL, NULL, '2020-11-13 08:02:54', NULL, '2020-12-01 04:57:31', NULL, NULL, NULL, NULL),
	(6, 1, '2020-11-13', 'Administrasi Bid/Performance Bond ID : 2/VGI/BPB/11/2020 Administration Fund', -1000.00, 0, 'cypher', '2', 0, NULL, NULL, '2020-11-13 08:02:54', NULL, '2020-12-01 04:57:31', NULL, NULL, NULL, NULL),
	(7, 1, '2020-11-13', 'Return Bond ID : 2/VGI/BPB/11/2020 Guarantee Fund', 7000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-11-13 08:03:28', NULL, '2020-11-24 13:51:03', NULL, NULL, NULL, NULL),
	(8, 1, '2020-11-18', '[Severance] Aslam', -20000000.00, 0, 'cypher', '1', 1, NULL, NULL, '2020-11-18 02:37:42', NULL, '2020-12-01 08:08:09', NULL, NULL, NULL, NULL),
	(10, 3, '2020-12-02', '[SP] Schedule Payment for Loan Mandiri', -5000000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:47:25', NULL, '2020-12-02 15:47:25', NULL, NULL, NULL, NULL),
	(11, 3, '2020-12-02', '', 0.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:47:25', NULL, '2020-12-02 15:47:25', NULL, NULL, NULL, NULL),
	(12, 3, '2020-12-03', '[SP] Schedule Payment for Utilization Listrik Mess Rantau', -120000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:51:41', NULL, '2020-12-02 15:51:41', NULL, NULL, NULL, NULL),
	(13, 3, '2020-12-07', '[SP] Schedule Payment for 002/VGI/WO/XII/20', 500000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:52:15', NULL, '2020-12-02 15:52:15', NULL, NULL, NULL, NULL),
	(14, 3, '2020-12-10', '[SP] Schedule Payment for Loan Mandiri 1', -8333.33, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:55:20', NULL, '2020-12-02 15:55:20', NULL, NULL, NULL, NULL),
	(15, 3, '2020-12-24', '[SP] Schedule Payment for 001/VGI/PO/XII/20', 100000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 15:57:47', NULL, '2020-12-02 15:57:47', NULL, NULL, NULL, NULL),
	(16, 3, '2020-12-28', '[SP] Salary, jamsostek, pension of staff periode December 2020', -8780645.16, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 16:08:46', NULL, '2020-12-02 16:08:46', NULL, NULL, NULL, NULL),
	(17, 3, '2020-12-28', '', 0.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-02 16:08:46', NULL, '2020-12-02 16:08:46', NULL, NULL, NULL, NULL),
	(26, 3, '2020-12-02', '[SP] Schedule Payment for Loan Mandiri', -5000000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:48:55', NULL, NULL, NULL, NULL),
	(27, 3, '2020-12-02', '[SP] Schedule Payment for Leasing lorem asdsadasda', -5000000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:48:55', NULL, NULL, NULL, NULL),
	(28, 3, '2020-12-02', '[SP] Schedule Payment for Utilization Listrik Kantor', -100000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:48:55', NULL, NULL, NULL, NULL),
	(29, 3, '2020-12-02', '[SP] Schedule Payment for Utilization Listrik Mess Rantau', -100000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:48:55', NULL, NULL, NULL, NULL),
	(30, 1, '2020-12-14', 'Cashbond [out]: aaa. (ID: 1)', -250000000.00, 0, 'cypher', NULL, 0, NULL, NULL, '2020-12-14 08:12:38', 'cypher', '2020-12-14 08:12:38', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_treasure_history` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_treasure_insert
CREATE TABLE IF NOT EXISTS `finance_treasure_insert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_treasure` int(6) NOT NULL,
  `date_insert` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDR` decimal(15,2) NOT NULL,
  `USD` decimal(15,2) NOT NULL DEFAULT 0.00,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_treasure_insert: ~0 rows (approximately)
/*!40000 ALTER TABLE `finance_treasure_insert` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance_treasure_insert` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_treasure_sp
CREATE TABLE IF NOT EXISTS `finance_treasure_sp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `bank` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `saldo` decimal(17,2) DEFAULT NULL,
  `hold` decimal(17,2) DEFAULT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_treasure_sp: ~2 rows (approximately)
/*!40000 ALTER TABLE `finance_treasure_sp` DISABLE KEYS */;
INSERT INTO `finance_treasure_sp` (`id`, `num`, `year`, `bank`, `date1`, `date2`, `saldo`, `hold`, `approved_by`, `approved_date`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, '001/VGI/SP/1/2020', 2020, '1', '2020-11-10', '2020-11-18', NULL, NULL, 'cypher', '2020-12-01', '2020-12-01 04:57:02', NULL, '2020-12-01 08:08:09', NULL, NULL, NULL, 1),
	(2, '002/VGI/SP/1/2020', 2020, '1', '2020-11-12', '2020-11-13', NULL, NULL, NULL, NULL, '2020-12-01 04:57:31', NULL, '2020-12-01 04:57:31', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_treasure_sp` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_util_criteria
CREATE TABLE IF NOT EXISTS `finance_util_criteria` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_util_criteria: ~0 rows (approximately)
/*!40000 ALTER TABLE `finance_util_criteria` DISABLE KEYS */;
INSERT INTO `finance_util_criteria` (`id`, `name`, `content`, `author`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'ELECTRICITY', NULL, 'cypher', NULL, '2020-12-02 15:36:35', 'cypher', '2020-12-02 15:36:35', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_util_criteria` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_util_instances
CREATE TABLE IF NOT EXISTS `finance_util_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_master` int(11) NOT NULL,
  `subject` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_date` date NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `amount_back` decimal(15,2) NOT NULL,
  `progress` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_util_instances: ~33 rows (approximately)
/*!40000 ALTER TABLE `finance_util_instances` DISABLE KEYS */;
INSERT INTO `finance_util_instances` (`id`, `id_master`, `subject`, `description`, `pay_date`, `currency`, `amount`, `amount_back`, `progress`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'Listrik Mess Rantau', 'test', '2020-02-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 03:14:05', NULL, '2020-12-02 15:36:58', '2020-12-03 03:14:05', NULL, 1),
	(2, 1, 'Listrik Mess Rantau', 'test', '2020-03-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 03:11:06', NULL, '2020-12-02 15:36:58', '2020-12-03 03:11:06', NULL, 1),
	(3, 1, 'Listrik Mess Rantau', 'test', '2020-04-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 03:09:51', NULL, '2020-12-02 15:36:58', '2020-12-03 03:09:51', NULL, 1),
	(4, 1, 'Listrik Mess Rantau', 'test', '2020-05-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(5, 1, 'Listrik Mess Rantau', 'test', '2020-06-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(6, 1, 'Listrik Mess Rantau', 'test', '2020-07-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(7, 1, 'Listrik Mess Rantau', 'test', '2020-08-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(8, 1, 'Listrik Mess Rantau', 'test', '2020-09-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(9, 1, 'Listrik Mess Rantau', 'test', '2020-10-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(10, 1, 'Listrik Mess Rantau', 'test', '2020-11-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-02 15:36:58', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(11, 1, 'Listrik Mess Rantau', 'test', '2020-12-03', 'IDR', 120000.00, 120000.00, 'paid', NULL, '2020-12-02 15:51:41', NULL, '2020-12-02 15:36:58', NULL, NULL, 1),
	(12, 3, 'Listrik Kantor Kos', 'test4', '2020-12-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 02:56:33', NULL, '2020-12-03 02:56:33', NULL, NULL, 1),
	(13, 1, 'Listrik Mess Rantau', 'test', '2021-01-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 02:57:00', NULL, '2020-12-03 02:57:00', NULL, NULL, 1),
	(14, 1, 'Listrik Mess Rantau', 'test', '1970-02-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 02:57:00', NULL, '2020-12-03 02:57:00', NULL, NULL, 1),
	(15, 3, 'Listrik Kantor Kos', 'test4', '2021-01-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 02:57:04', NULL, '2020-12-03 02:57:04', NULL, NULL, 1),
	(16, 3, 'Listrik Kantor Kos', 'test4', '1970-02-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 02:57:04', NULL, '2020-12-03 02:57:04', NULL, NULL, 1),
	(17, 2, 'Listrik Kantor', 'test3', '2021-01-04', 'IDR', 220000.00, 220000.00, 'created', NULL, '2020-12-03 03:10:54', NULL, '2020-12-03 02:57:26', '2020-12-03 03:10:54', NULL, 1),
	(18, 2, 'Listrik Kantor', 'test3', '1970-02-04', 'IDR', 220000.00, 220000.00, 'created', NULL, '2020-12-03 03:10:56', NULL, '2020-12-03 02:57:26', '2020-12-03 03:10:56', NULL, 1),
	(19, 1, 'Listrik Mess Rantau', 'test', '2020-04-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 03:09:51', NULL, '2020-12-03 03:09:51', NULL, NULL, 1),
	(20, 1, 'Listrik Mess Rantau', 'test', '2020-03-03', 'IDR', 120000.00, 120000.00, 'created', NULL, '2020-12-03 03:11:06', NULL, '2020-12-03 03:11:06', NULL, NULL, 1),
	(21, 4, 'Listrik Kantor', 'aasdsa', '2020-12-02', 'IDR', 100000.00, 100000.00, 'paid', NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:33:42', NULL, NULL, 1),
	(22, 5, 'Listrik Mess Rantau', 'sadasd', '2020-01-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(23, 5, 'Listrik Mess Rantau', 'sadasd', '2020-02-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(24, 5, 'Listrik Mess Rantau', 'sadasd', '2020-03-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(25, 5, 'Listrik Mess Rantau', 'sadasd', '2020-04-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(26, 5, 'Listrik Mess Rantau', 'sadasd', '2020-05-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(27, 5, 'Listrik Mess Rantau', 'sadasd', '2020-06-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(28, 5, 'Listrik Mess Rantau', 'sadasd', '2020-07-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(29, 5, 'Listrik Mess Rantau', 'sadasd', '2020-08-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(30, 5, 'Listrik Mess Rantau', 'sadasd', '2020-09-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(31, 5, 'Listrik Mess Rantau', 'sadasd', '2020-10-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(32, 5, 'Listrik Mess Rantau', 'sadasd', '2020-11-02', 'IDR', 100000.00, 100000.00, 'created', NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:30', NULL, NULL, 1),
	(33, 5, 'Listrik Mess Rantau', 'sadasd', '2020-12-02', 'IDR', 100000.00, 100000.00, 'paid', NULL, '2020-12-03 03:48:55', NULL, '2020-12-03 03:34:30', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_util_instances` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_util_master
CREATE TABLE IF NOT EXISTS `finance_util_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recurrent_date` date NOT NULL,
  `recurrent_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_date` date DEFAULT NULL,
  `n_date` int(4) DEFAULT NULL,
  `classification` int(3) DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_util_master: ~5 rows (approximately)
/*!40000 ALTER TABLE `finance_util_master` DISABLE KEYS */;
INSERT INTO `finance_util_master` (`id`, `subject`, `description`, `recurrent_date`, `recurrent_type`, `type`, `amount`, `currency`, `status`, `last_date`, `n_date`, `classification`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'Listrik Mess Rantau', 'test', '2020-01-03', 'monthly', 'FIXED', 120000.00, 'IDR', 'running', '2020-01-03', NULL, 1, NULL, '2020-12-03 03:14:05', NULL, '2020-12-02 15:36:56', '2020-12-03 03:14:05', NULL, 1),
	(2, 'Listrik Kantor', 'test3', '2020-12-04', 'monthly', 'FIXED', 220000.00, 'IDR', 'ready', '2020-12-04', NULL, 1, NULL, '2020-12-03 03:11:06', NULL, '2020-12-02 15:39:41', '2020-12-03 03:11:06', NULL, 1),
	(3, 'Listrik Kantor Kos', 'test4', '2020-11-02', 'monthly', 'FIXED', 100000.00, 'IDR', 'running', '2020-11-02', NULL, 1, NULL, '2020-12-03 03:09:51', NULL, '2020-12-03 02:56:29', '2020-12-03 03:09:51', NULL, 1),
	(4, 'Listrik Kantor', 'aasdsa', '2020-12-02', 'monthly', 'FIXED', 100000.00, 'IDR', 'running', '2020-12-02', NULL, 1, NULL, '2020-12-03 03:33:42', NULL, '2020-12-03 03:12:05', NULL, NULL, 1),
	(5, 'Listrik Mess Rantau', 'sadasd', '2020-01-02', 'monthly', 'FIXED', 100000.00, 'IDR', 'running', '2020-01-02', NULL, 1, NULL, '2020-12-03 03:34:30', NULL, '2020-12-03 03:34:28', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_util_master` ENABLE KEYS */;

-- Dumping structure for table cypher4.finance_util_salary
CREATE TABLE IF NOT EXISTS `finance_util_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_date` date DEFAULT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `jamsostek` decimal(15,2) DEFAULT NULL,
  `health_insurance` decimal(15,2) DEFAULT NULL,
  `pension` decimal(15,2) DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.finance_util_salary: 8 rows
/*!40000 ALTER TABLE `finance_util_salary` DISABLE KEYS */;
INSERT INTO `finance_util_salary` (`id`, `salary_date`, `currency`, `amount`, `jamsostek`, `health_insurance`, `pension`, `plan_date`, `status`, `position`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, '2020-11-28', 'IDR', 500000.00, NULL, NULL, NULL, '2020-11-28', 'waiting', 'staff', NULL, '2020-11-30 12:03:55', NULL, '2020-11-30 11:42:10', '2020-11-30 12:03:55', NULL, 1),
	(2, '2020-11-28', 'IDR', 700112.50, NULL, NULL, NULL, '2020-11-28', 'waiting', 'manager', NULL, '2020-11-30 12:03:55', NULL, '2020-11-30 11:42:10', '2020-11-30 12:03:55', NULL, 1),
	(3, '2020-11-28', 'IDR', 500000.00, NULL, NULL, NULL, '2020-11-28', 'waiting', 'staff', NULL, '2020-11-30 12:04:27', NULL, '2020-11-30 12:03:56', '2020-11-30 12:04:27', NULL, 1),
	(4, '2020-11-28', 'IDR', 700112.50, NULL, NULL, NULL, '2020-11-28', 'waiting', 'manager', NULL, '2020-11-30 12:04:27', NULL, '2020-11-30 12:03:56', '2020-11-30 12:04:27', NULL, 1),
	(5, '2020-11-28', 'IDR', 500000.00, NULL, NULL, NULL, '2020-11-28', 'waiting', 'staff', NULL, '2020-11-30 12:40:09', NULL, '2020-11-30 12:04:28', NULL, NULL, 1),
	(6, '2020-11-28', 'IDR', 700112.50, NULL, NULL, NULL, '2020-11-28', 'waiting', 'manager', NULL, '2020-12-02 15:42:20', NULL, '2020-11-30 12:04:28', NULL, NULL, 1),
	(7, '2020-12-28', 'IDR', 8780645.16, NULL, NULL, NULL, '2020-12-28', 'paid', 'staff', NULL, '2020-12-02 16:08:46', NULL, '2020-12-02 16:05:45', NULL, NULL, 1),
	(8, '2020-12-28', 'IDR', 4741975.81, NULL, NULL, NULL, '2020-12-28', 'waiting', 'manager', NULL, '2020-12-02 16:05:45', NULL, '2020-12-02 16:05:45', NULL, NULL, 1);
/*!40000 ALTER TABLE `finance_util_salary` ENABLE KEYS */;

-- Dumping structure for table cypher4.frm_comment
CREATE TABLE IF NOT EXISTS `frm_comment` (
  `id_comment` int(100) NOT NULL AUTO_INCREMENT,
  `id_topik` int(100) NOT NULL,
  `date_comment` datetime NOT NULL,
  `isi_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(100) NOT NULL,
  `baca` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.frm_comment: ~0 rows (approximately)
/*!40000 ALTER TABLE `frm_comment` DISABLE KEYS */;
INSERT INTO `frm_comment` (`id_comment`, `id_topik`, `date_comment`, `isi_comment`, `video`, `image1`, `image2`, `emp_id`, `baca`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(3, 3, '2020-12-02 07:40:49', 'jjkhkj', '2020_12_02_07_40_49video.mp4', '2020_12_02_07_40_49image1.gif', '2020_12_02_07_40_49image2.png', 1, 't', '2020-12-02 07:40:49', 'cypher', NULL, NULL, '2020-12-02 07:40:49', NULL, 1);
/*!40000 ALTER TABLE `frm_comment` ENABLE KEYS */;

-- Dumping structure for table cypher4.frm_forum
CREATE TABLE IF NOT EXISTS `frm_forum` (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `nama_forum` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_forum` datetime DEFAULT NULL,
  `emp_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `baca` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_forum`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.frm_forum: ~0 rows (approximately)
/*!40000 ALTER TABLE `frm_forum` DISABLE KEYS */;
INSERT INTO `frm_forum` (`id_forum`, `nama_forum`, `date_forum`, `emp_id`, `baca`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(3, 'tes', '2020-12-02 03:42:34', '1', 't', '2020-12-02 03:42:34', 'cypher', NULL, NULL, '2020-12-02 03:42:34', NULL, 1);
/*!40000 ALTER TABLE `frm_forum` ENABLE KEYS */;

-- Dumping structure for table cypher4.frm_topik
CREATE TABLE IF NOT EXISTS `frm_topik` (
  `id_topik` int(100) NOT NULL AUTO_INCREMENT,
  `id_forum` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `nama_topik` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_topik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_topik` datetime DEFAULT NULL,
  `baca` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_topik`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.frm_topik: ~0 rows (approximately)
/*!40000 ALTER TABLE `frm_topik` DISABLE KEYS */;
INSERT INTO `frm_topik` (`id_topik`, `id_forum`, `emp_id`, `nama_topik`, `desc_topik`, `date_topik`, `baca`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(3, 3, 1, 'LOREM', 'ghfhgfhgf', '2020-12-02 07:40:21', 't', '2020-12-02 07:40:21', 'cypher', NULL, NULL, '2020-12-02 07:40:21', NULL, 1);
/*!40000 ALTER TABLE `frm_topik` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_cashbond
CREATE TABLE IF NOT EXISTS `general_cashbond` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_date` date NOT NULL,
  `m_approve` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_approve_time` date DEFAULT NULL,
  `approved_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` date DEFAULT NULL,
  `currency` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa` decimal(15,2) DEFAULT NULL,
  `division` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done` date DEFAULT NULL,
  `user` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `project` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `dir_appr` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir_appr_date` date DEFAULT NULL,
  `man_fin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_fin_date` date DEFAULT NULL,
  `m_appr_cashout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_appr_cashout_date` date DEFAULT NULL,
  `man_fin_cashout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_fin_cashout_date` date DEFAULT NULL,
  `is_private` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_cashbond: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_cashbond` DISABLE KEYS */;
INSERT INTO `general_cashbond` (`id`, `subject`, `input_date`, `m_approve`, `m_approve_time`, `approved_by`, `approved_time`, `currency`, `sisa`, `division`, `done`, `user`, `project`, `from`, `vehicle`, `dir_appr`, `dir_appr_date`, `man_fin`, `man_fin_date`, `m_appr_cashout`, `m_appr_cashout_date`, `man_fin_cashout`, `man_fin_cashout_date`, `is_private`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `company_id`) VALUES
	(1, 'aaa', '2020-12-15', 'cypher', '2020-12-14', 'cypher', '2020-12-14', 'IDR', 250000000.00, 'Asset', '2020-12-14', 'open', '8', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-14', 0, 'cypher', '2020-12-14 08:11:07', NULL, '2020-12-14 08:18:47', NULL, NULL, 1);
/*!40000 ALTER TABLE `general_cashbond` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_cashbond_detail
CREATE TABLE IF NOT EXISTS `general_cashbond_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cashbond` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_nota` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cashin` decimal(15,2) NOT NULL,
  `cashout` decimal(15,2) NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_string` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_int` int(4) DEFAULT NULL,
  `fuel_type` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuel_amount` decimal(15,2) DEFAULT NULL,
  `fuel_km` decimal(15,2) DEFAULT NULL,
  `fuel_id` int(11) DEFAULT NULL,
  `fuel_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_cashbond_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_cashbond_detail` DISABLE KEYS */;
INSERT INTO `general_cashbond_detail` (`id`, `id_cashbond`, `tanggal`, `no_nota`, `deskripsi`, `cashin`, `cashout`, `category`, `source_string`, `source_int`, `fuel_type`, `fuel_amount`, `fuel_km`, `fuel_id`, `fuel_by`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
	(1, 1, '2020-12-15', 'aaa', 'asda', 250000000.00, 0.00, NULL, 'BR', 0, NULL, NULL, NULL, NULL, NULL, 'cypher', '2020-12-14 08:11:28', NULL, '2020-12-14 08:11:28', NULL, NULL);
/*!40000 ALTER TABLE `general_cashbond_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_reimburse
CREATE TABLE IF NOT EXISTS `general_reimburse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_date` date NOT NULL,
  `m_approve` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_approve_time` date DEFAULT NULL,
  `approved_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` date DEFAULT NULL,
  `currency` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa` decimal(15,2) DEFAULT NULL,
  `division` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done` date DEFAULT NULL,
  `user` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `project` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_reimburse: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_reimburse` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_reimburse` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_reimburse_detail
CREATE TABLE IF NOT EXISTS `general_reimburse_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reimburse` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_nota` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cashin` decimal(15,2) NOT NULL,
  `cashout` decimal(15,2) NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_string` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_int` int(4) DEFAULT NULL,
  `created_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_reimburse_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_reimburse_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_reimburse_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_to
CREATE TABLE IF NOT EXISTS `general_to` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `doc_num` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_date` date DEFAULT NULL,
  `destination` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tolocation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_type` char(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wh, fld',
  `travel_type` char(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'odo, reg',
  `type_of_travel` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'dom, ovs',
  `departure_dt` date DEFAULT NULL,
  `return_dt` date DEFAULT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'approve, disapprove',
  `action_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `action_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `admin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_time` datetime DEFAULT NULL,
  `create_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `paid_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_time` datetime DEFAULT NULL,
  `project` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sppd_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_meal` decimal(15,2) DEFAULT NULL,
  `to_spending` decimal(15,2) DEFAULT NULL,
  `to_overnight` decimal(15,2) DEFAULT NULL,
  `to_transport` decimal(15,2) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `to_cekmeal` int(1) DEFAULT NULL,
  `to_cekspending` int(1) DEFAULT NULL,
  `to_cekovernight` int(1) DEFAULT NULL,
  `to_cektransport` int(1) DEFAULT NULL,
  `transport` decimal(15,2) NOT NULL DEFAULT 0.00,
  `taxi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `airtax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `departure_time` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_no` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_time` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_no` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_payment` decimal(15,2) DEFAULT NULL,
  `location_rate` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_to: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_to` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_to` ENABLE KEYS */;

-- Dumping structure for table cypher4.general_to_plan
CREATE TABLE IF NOT EXISTS `general_to_plan` (
  `emp_id` int(11) NOT NULL,
  `assign_date` date NOT NULL,
  `project` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.general_to_plan: ~0 rows (approximately)
/*!40000 ALTER TABLE `general_to_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_to_plan` ENABLE KEYS */;

-- Dumping structure for table cypher4.ha_paper_permit
CREATE TABLE IF NOT EXISTS `ha_paper_permit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_paper` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_revise` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `issued_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_num` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.ha_paper_permit: 1 rows
/*!40000 ALTER TABLE `ha_paper_permit` DISABLE KEYS */;
INSERT INTO `ha_paper_permit` (`id`, `author`, `purpose`, `nama_paper`, `kode`, `to_revise`, `issued_date`, `issued_by`, `paper_num`, `vendor`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, 'cypher', 'test1', 'wo', 'O7573', NULL, '2020-12-02', 'cypher', '002/VGI/WO/XII/20', NULL, '2020-12-02 15:31:57', 'cypher', NULL, NULL, '2020-12-02 15:33:49', 'cypher', 1);
/*!40000 ALTER TABLE `ha_paper_permit` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_absen2
CREATE TABLE IF NOT EXISTS `hrd_absen2` (
  `a_id` int(12) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `absen_alasan_id` int(12) DEFAULT NULL,
  `approved_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_absen2: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_absen2` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_absen2` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_absen_alasan
CREATE TABLE IF NOT EXISTS `hrd_absen_alasan` (
  `absen_alasan_id` int(11) NOT NULL AUTO_INCREMENT,
  `alasan` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`absen_alasan_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_absen_alasan: ~19 rows (approximately)
/*!40000 ALTER TABLE `hrd_absen_alasan` DISABLE KEYS */;
INSERT INTO `hrd_absen_alasan` (`absen_alasan_id`, `alasan`, `bobot`, `created_at`, `updated_at`) VALUES
	(1, 'WAITING', 0, NULL, NULL),
	(2, '<p>CUTI</p>', 0, NULL, NULL),
	(4, '<p>ABSEN - ALASAN VIA TELEPHONE</p>', 60, NULL, NULL),
	(5, '<p>ABSEN - ALASAN VIA SMS/BBM</p>', 100, NULL, NULL),
	(6, '<p>ABSEN - ALASAN VIA TITIP ORANG</p>', 200, NULL, NULL),
	(7, '<p>ALPHA - SAKIT TANPA BUKTI</p>', 300, NULL, NULL),
	(8, '<p>ABSEN - SAKIT DENGAN BUKTI</p>', 10, NULL, NULL),
	(11, '<p>ABSEN - KELUARGA MENINGGAL</p>', 10, NULL, NULL),
	(12, '<p>ABSEN - IJIN TANPA APPROVAL</p>', 400, NULL, NULL),
	(13, '<p>ALPHA - TIDAK ADA PENJELASAN</p>', 400, NULL, NULL),
	(14, '<p>ABSEN - KELUARGA UTAMA SAKIT</p>', 100, NULL, NULL),
	(15, 'ABSEN - MERAWAT ANAK', 10, NULL, NULL),
	(16, '<p>ABSEN - IJIN DENGAN APPROVAL</p>', 20, NULL, NULL),
	(17, '<p>IJIN SETENGAH HARI</p>', 200, NULL, NULL),
	(19, '<p>TIDAK ABSEN</p>', 200, NULL, NULL),
	(20, 'MAGANG - IJIN KHUSUS', 0, NULL, NULL),
	(21, '<p>ALPHA - HARI KRUSIAL</p>', 1500, NULL, NULL),
	(24, 'ABSEN - TUGAS KANTOR', 0, NULL, NULL),
	(25, 'CUTI - ALASAN PENTING', 1, NULL, NULL);
/*!40000 ALTER TABLE `hrd_absen_alasan` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_bonus
CREATE TABLE IF NOT EXISTS `hrd_bonus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bonusID` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `bonus_amount` decimal(10,0) DEFAULT NULL,
  `bonus_start` date DEFAULT NULL,
  `bonus_end` date DEFAULT NULL,
  `given_by` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_time` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_bonus: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_bonus` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_bonus` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_bonus_payment
CREATE TABLE IF NOT EXISTS `hrd_bonus_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bonus_id` int(11) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `payment_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_bonus_payment: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_bonus_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_bonus_payment` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_config
CREATE TABLE IF NOT EXISTS `hrd_config` (
  `opt_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opt_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `opt_name` (`opt_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_config: ~23 rows (approximately)
/*!40000 ALTER TABLE `hrd_config` DISABLE KEYS */;
INSERT INTO `hrd_config` (`opt_name`, `opt_value`, `id`, `updated_at`) VALUES
	('penalty_amt', '[{"id":"1","value":"0"},{"id":5,"value":"0"},{"id":6,"value":"0"},{"id":7,"value":"0"},{"id":8,"value":"0"},{"id":9,"value":"0"},{"id":10,"value":"0"},{"id":11,"value":"0"},{"id":12,"value":"0"},{"id":13,"value":"0"},{"id":14,"value":"0"},{"id":15,"value":"0"},{"id":16,"value":"0"},{"id":17,"value":"0"},{"id":18,"value":"0"}]', 1, '2020-11-23 04:52:37'),
	('penalty_period', '[{"id":"1","value":"1"},{"id":5,"value":"1"},{"id":6,"value":"1"},{"id":7,"value":"1"},{"id":8,"value":"1"},{"id":9,"value":"1"},{"id":10,"value":"1"},{"id":11,"value":"1"},{"id":12,"value":"1"},{"id":13,"value":"1"},{"id":14,"value":"1"},{"id":15,"value":"1"},{"id":16,"value":"1"},{"id":17,"value":"1"},{"id":18,"value":"1"}]', 2, '2020-11-23 04:52:37'),
	('penalty_start', '[{"id":"1","value":"07:30:59"},{"id":5,"value":"07:30:59"},{"id":6,"value":"07:30:59"},{"id":7,"value":"07:30:59"},{"id":8,"value":"07:30:59"},{"id":9,"value":"07:30:59"},{"id":10,"value":"07:30:59"},{"id":11,"value":"07:30:59"},{"id":12,"value":"07:30:59"},{"id":13,"value":"07:30:59"},{"id":14,"value":"07:30:59"},{"id":15,"value":"07:30:59"},{"id":16,"value":"07:30:59"},{"id":17,"value":"07:30:59"},{"id":18,"value":"07:30:59"}]', 3, '2020-11-23 04:52:37'),
	('period_start', '[{"id":"1","value":"16"},{"id":5,"value":"16"},{"id":6,"value":"16"},{"id":7,"value":"16"},{"id":8,"value":"16"},{"id":9,"value":"16"},{"id":10,"value":"16"},{"id":11,"value":"16"},{"id":12,"value":"16"},{"id":13,"value":"16"},{"id":14,"value":"16"},{"id":15,"value":"16"},{"id":16,"value":"16"},{"id":17,"value":"16"},{"id":18,"value":"16"}]', 4, '2020-11-23 04:52:37'),
	('period_end', '[{"id":"1","value":"15"},{"id":5,"value":"15"},{"id":6,"value":"15"},{"id":7,"value":"15"},{"id":8,"value":"15"},{"id":9,"value":"15"},{"id":10,"value":"15"},{"id":11,"value":"15"},{"id":12,"value":"15"},{"id":13,"value":"15"},{"id":14,"value":"15"},{"id":15,"value":"15"},{"id":16,"value":"15"},{"id":17,"value":"15"},{"id":18,"value":"15"}]', 5, '2020-11-23 04:52:37'),
	('absence_deduction', '[{"id":"1","value":"30"},{"id":5,"value":"30"},{"id":6,"value":"30"},{"id":7,"value":"30"},{"id":8,"value":"30"},{"id":9,"value":"30"},{"id":10,"value":"30"},{"id":11,"value":"30"},{"id":12,"value":"30"},{"id":13,"value":"30"},{"id":14,"value":"30"},{"id":15,"value":"30"},{"id":16,"value":"30"},{"id":17,"value":"30"},{"id":18,"value":"30"}]', 6, '2020-11-23 04:52:37'),
	('bonus_period', '[{"id":"1","value":"5"},{"id":5,"value":"5"},{"id":6,"value":"5"},{"id":7,"value":"5"},{"id":8,"value":"5"},{"id":9,"value":"5"},{"id":10,"value":"5"},{"id":11,"value":"5"},{"id":12,"value":"5"},{"id":13,"value":"5"},{"id":14,"value":"5"},{"id":15,"value":"5"},{"id":16,"value":"5"},{"id":17,"value":"5"},{"id":18,"value":"5"}]', 7, '2020-11-23 04:52:37'),
	('thr_period', '[{"id":"1","value":"<p>08-2020<\\/p>"},{"id":5,"value":"<p>08-2020<\\/p>"},{"id":6,"value":"<p>08-2020<\\/p>"},{"id":7,"value":"<p>08-2020<\\/p>"},{"id":8,"value":"<p>08-2020<\\/p>"},{"id":9,"value":"<p>08-2020<\\/p>"},{"id":10,"value":"<p>08-2020<\\/p>"},{"id":11,"value":"<p>08-2020<\\/p>"},{"id":12,"value":"<p>08-2020<\\/p>"},{"id":13,"value":"<p>08-2020<\\/p>"},{"id":14,"value":"<p>08-2020<\\/p>"},{"id":15,"value":"<p>08-2020<\\/p>"},{"id":16,"value":"<p>08-2020<\\/p>"},{"id":17,"value":"<p>08-2020<\\/p>"},{"id":18,"value":"<p>08-2020<\\/p>"}]', 8, '2020-11-23 04:52:37'),
	('odorate', '[{"id":"1","value":"1.5"}]', 9, '2020-11-23 04:52:37'),
	('performa_period', '[{"id":"1","value":"10"},{"id":5,"value":"10"},{"id":6,"value":"10"},{"id":7,"value":"10"},{"id":8,"value":"10"},{"id":9,"value":"10"},{"id":10,"value":"10"},{"id":11,"value":"10"},{"id":12,"value":"10"},{"id":13,"value":"10"},{"id":14,"value":"10"},{"id":15,"value":"10"},{"id":16,"value":"10"},{"id":17,"value":"10"},{"id":18,"value":"10"}]', 10, '2020-11-23 04:52:37'),
	('performa_amt1', '[{"id":"1","value":"4"},{"id":5,"value":"4"},{"id":6,"value":"4"},{"id":7,"value":"4"},{"id":8,"value":"4"},{"id":9,"value":"4"},{"id":10,"value":"4"},{"id":11,"value":"4"},{"id":12,"value":"4"},{"id":13,"value":"4"},{"id":14,"value":"4"},{"id":15,"value":"4"},{"id":16,"value":"4"},{"id":17,"value":"4"},{"id":18,"value":"4"}]', 11, '2020-11-23 04:52:37'),
	('performa_amt2', '[{"id":"1","value":"6"},{"id":5,"value":"6"},{"id":6,"value":"6"},{"id":7,"value":"6"},{"id":8,"value":"6"},{"id":9,"value":"6"},{"id":10,"value":"6"},{"id":11,"value":"6"},{"id":12,"value":"6"},{"id":13,"value":"6"},{"id":14,"value":"6"},{"id":15,"value":"6"},{"id":16,"value":"6"},{"id":17,"value":"6"},{"id":18,"value":"6"}]', 12, '2020-11-23 04:52:37'),
	('performa_amt3', '[{"id":"1","value":"8"},{"id":5,"value":"8"},{"id":6,"value":"8"},{"id":7,"value":"8"},{"id":8,"value":"8"},{"id":9,"value":"8"},{"id":10,"value":"8"},{"id":11,"value":"8"},{"id":12,"value":"8"},{"id":13,"value":"8"},{"id":14,"value":"8"},{"id":15,"value":"8"},{"id":16,"value":"8"},{"id":17,"value":"8"},{"id":18,"value":"8"}]', 13, '2020-11-23 04:52:37'),
	('performa_amt4', '[{"id":"1","value":"10"},{"id":5,"value":"10"},{"id":6,"value":"10"},{"id":7,"value":"10"},{"id":8,"value":"10"},{"id":9,"value":"10"},{"id":10,"value":"10"},{"id":11,"value":"10"},{"id":12,"value":"10"},{"id":13,"value":"10"},{"id":14,"value":"10"},{"id":15,"value":"10"},{"id":16,"value":"10"},{"id":17,"value":"10"},{"id":18,"value":"10"}]', 14, '2020-11-23 04:52:37'),
	('performa_amt5', '[{"id":"1","value":"12"},{"id":5,"value":"12"},{"id":6,"value":"12"},{"id":7,"value":"12"},{"id":8,"value":"12"},{"id":9,"value":"12"},{"id":10,"value":"12"},{"id":11,"value":"12"},{"id":12,"value":"12"},{"id":13,"value":"12"},{"id":14,"value":"12"},{"id":15,"value":"12"},{"id":16,"value":"12"},{"id":17,"value":"12"},{"id":18,"value":"12"}]', 15, '2020-11-23 04:52:37'),
	('performa_start', '[{"id":"1","value":"6"},{"id":5,"value":"6"},{"id":6,"value":"6"},{"id":7,"value":"6"},{"id":8,"value":"6"},{"id":9,"value":"6"},{"id":10,"value":"6"},{"id":11,"value":"6"},{"id":12,"value":"6"},{"id":13,"value":"6"},{"id":14,"value":"6"},{"id":15,"value":"6"},{"id":16,"value":"6"},{"id":17,"value":"6"},{"id":18,"value":"6"}]', 16, '2020-11-23 04:52:37'),
	('performa_end', '[{"id":"1","value":"8"},{"id":5,"value":"8"},{"id":6,"value":"8"},{"id":7,"value":"8"},{"id":8,"value":"8"},{"id":9,"value":"8"},{"id":10,"value":"8"},{"id":11,"value":"8"},{"id":12,"value":"8"},{"id":13,"value":"8"},{"id":14,"value":"8"},{"id":15,"value":"8"},{"id":16,"value":"8"},{"id":17,"value":"8"},{"id":18,"value":"8"}]', 17, '2020-11-23 04:52:37'),
	('penalty_stop', '[{"id":"1","value":""},{"id":5,"value":""},{"id":6,"value":""},{"id":7,"value":""},{"id":8,"value":""},{"id":9,"value":""},{"id":10,"value":""},{"id":11,"value":""},{"id":12,"value":""},{"id":13,"value":""},{"id":14,"value":""},{"id":15,"value":""},{"id":16,"value":""},{"id":17,"value":""},{"id":18,"value":""}]', 23, '2020-11-23 04:52:37'),
	('approval_start', '[{"id":"1","value":""},{"id":5,"value":""},{"id":6,"value":""},{"id":7,"value":""},{"id":8,"value":""},{"id":9,"value":""},{"id":10,"value":""},{"id":11,"value":""},{"id":12,"value":""},{"id":13,"value":""},{"id":14,"value":""},{"id":15,"value":""},{"id":16,"value":""},{"id":17,"value":""},{"id":18,"value":""}]', 24, '2020-11-23 04:52:37'),
	('btl_col', '[{"id":"1","value":["nomor","bank_acct ","thp ","emp_name "]},{"id":5,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":6,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":7,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":8,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":9,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":10,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":11,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":12,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":13,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":14,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":15,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":16,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":17,"value":["nomor","bank_acct ","thp ","emp_name "]},{"id":18,"value":["nomor","bank_acct ","thp ","emp_name "]}]', 25, '2020-11-23 04:52:37'),
	('wo_signature', '[{"id":"1","value":"71-Rangga Anggara"},{"id":5,"value":"71-Rangga Anggara"},{"id":6,"value":"71-Rangga Anggara"},{"id":7,"value":"71-Rangga Anggara"},{"id":8,"value":"71-Rangga Anggara"},{"id":9,"value":"71-Rangga Anggara"},{"id":10,"value":"71-Rangga Anggara"},{"id":11,"value":"71-Rangga Anggara"},{"id":12,"value":"71-Rangga Anggara"},{"id":13,"value":"71-Rangga Anggara"},{"id":14,"value":"71-Rangga Anggara"},{"id":15,"value":"71-Rangga Anggara"},{"id":16,"value":"71-Rangga Anggara"},{"id":17,"value":"71-Rangga Anggara"},{"id":18,"value":"71-Rangga Anggara"}]', 26, '2020-11-23 04:52:37'),
	('po_signature', '[{"id":"1","value":"1-Jokowi"},{"id":5,"value":"1-Jokowi"},{"id":6,"value":"1-Jokowi"},{"id":7,"value":"1-Jokowi"},{"id":8,"value":"1-Jokowi"},{"id":9,"value":"1-Jokowi"},{"id":10,"value":"1-Jokowi"},{"id":11,"value":"1-Jokowi"},{"id":12,"value":"1-Jokowi"},{"id":13,"value":"1-Jokowi"},{"id":14,"value":"1-Jokowi"},{"id":15,"value":"1-Jokowi"},{"id":16,"value":"1-Jokowi"},{"id":17,"value":"1-Jokowi"},{"id":18,"value":"1-Jokowi"}]', 27, '2020-11-23 04:52:37'),
	('to_signature', '[{"id":"1","value":"71-Rangga Anggara"},{"id":5,"value":"71-Rangga Anggara"},{"id":6,"value":"71-Rangga Anggara"},{"id":7,"value":"71-Rangga Anggara"},{"id":8,"value":"71-Rangga Anggara"},{"id":9,"value":"71-Rangga Anggara"},{"id":10,"value":"71-Rangga Anggara"},{"id":11,"value":"71-Rangga Anggara"},{"id":12,"value":"71-Rangga Anggara"},{"id":13,"value":"71-Rangga Anggara"},{"id":14,"value":"71-Rangga Anggara"},{"id":15,"value":"71-Rangga Anggara"},{"id":16,"value":"71-Rangga Anggara"},{"id":17,"value":"71-Rangga Anggara"},{"id":18,"value":"71-Rangga Anggara"}]', 28, '2020-11-23 04:52:37');
/*!40000 ALTER TABLE `hrd_config` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_cuti
CREATE TABLE IF NOT EXISTS `hrd_cuti` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_emp` int(2) DEFAULT NULL,
  `request_at` date DEFAULT NULL,
  `division` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `o_level` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_date` date DEFAULT NULL,
  `hrd_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hrd_date` date DEFAULT NULL,
  `reject1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_cuti: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_cuti` DISABLE KEYS */;
INSERT INTO `hrd_cuti` (`c_id`, `id_emp`, `request_at`, `division`, `awal`, `akhir`, `keterangan`, `status`, `o_level`, `div_by`, `div_date`, `hrd_by`, `hrd_date`, `reject1`, `reject2`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '2020-11-17', NULL, '2020-11-18', '2020-11-20', 'a', 0, NULL, 'cypher', '2020-11-17', 'cypher', '2020-11-17', NULL, NULL, '2020-11-17 13:40:16', '2020-11-17 13:40:56', NULL);
/*!40000 ALTER TABLE `hrd_cuti` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_cv
CREATE TABLE IF NOT EXISTS `hrd_cv` (
  `cv_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `cv_type` varchar(10) NOT NULL,
  `awal_waktu` date NOT NULL,
  `akhir_waktu` date NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`cv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.hrd_cv: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_cv` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_cv` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_cv_u
CREATE TABLE IF NOT EXISTS `hrd_cv_u` (
  `cv_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `cv_address` varchar(250) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `whom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.hrd_cv_u: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_cv_u` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_cv_u` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee
CREATE TABLE IF NOT EXISTS `hrd_employee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_position` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` int(11) DEFAULT NULL,
  `tax_status` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `emp_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'office, engineer',
  `emp_level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'staff, manager, director',
  `transport` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meal` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pension` decimal(10,0) DEFAULT NULL,
  `health` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_insurance` decimal(10,0) DEFAULT NULL,
  `jamsostek` decimal(10,0) DEFAULT NULL,
  `fld_bonus` decimal(10,0) DEFAULT 0,
  `odo_bonus` decimal(10,0) DEFAULT 0,
  `wh_bonus` decimal(10,0) DEFAULT 0,
  `overtime` decimal(10,0) DEFAULT 0,
  `others` decimal(10,0) DEFAULT 0,
  `voucher` decimal(10,0) DEFAULT NULL,
  `allowance_office` decimal(10,0) DEFAULT NULL,
  `max_loan` decimal(10,0) DEFAULT NULL,
  `loan_balance` decimal(10,0) DEFAULT NULL,
  `bank_acct` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '002',
  `picture` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearly_bonus` float DEFAULT NULL,
  `fx_yearly_bonus` decimal(15,2) DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `ktp` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serti1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuti` int(2) DEFAULT 12,
  `cuti_flag` int(1) DEFAULT NULL,
  `phone2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneh` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thr` decimal(5,2) DEFAULT 0.00,
  `emp_birth` date DEFAULT NULL,
  `dom_meal` decimal(15,2) DEFAULT NULL,
  `dom_spending` decimal(15,2) DEFAULT NULL,
  `dom_overnight` decimal(15,2) DEFAULT NULL,
  `ovs_meal` decimal(15,2) DEFAULT NULL,
  `ovs_spending` decimal(15,2) DEFAULT NULL,
  `ovs_overnight` decimal(15,2) DEFAULT NULL,
  `dom_transport_airport` decimal(15,2) DEFAULT 0.00,
  `dom_transport_train` decimal(15,2) DEFAULT NULL,
  `dom_transport_bus` decimal(15,2) DEFAULT NULL,
  `dom_transport_cil` decimal(15,2) DEFAULT NULL,
  `ovs_transport_airport` decimal(15,2) DEFAULT NULL,
  `ovs_transport_train` decimal(15,2) DEFAULT NULL,
  `ovs_transport_bus` decimal(15,2) DEFAULT NULL,
  `ovs_transport_cil` decimal(15,2) DEFAULT NULL,
  `allow_bpjs_tk` decimal(15,2) DEFAULT NULL,
  `allow_bpjs_kes` decimal(15,2) DEFAULT NULL,
  `allow_jshk` decimal(15,2) DEFAULT NULL,
  `deduc_bpjs_tk` decimal(15,2) DEFAULT NULL,
  `deduc_bpjs_kes` decimal(15,2) DEFAULT NULL,
  `deduc_jshk` decimal(15,2) DEFAULT NULL,
  `deduc_pph21` decimal(15,2) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_lahir` date DEFAULT NULL,
  `expel` date DEFAULT NULL,
  `gender` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mcu_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point` int(11) DEFAULT 0,
  `point_mandatory` int(11) DEFAULT 0,
  `bank_save` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_file` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_hire` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_employee: ~5 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee` DISABLE KEYS */;
INSERT INTO `hrd_employee` (`id`, `emp_name`, `emp_id`, `emp_position`, `division`, `tax_status`, `salary`, `emp_type`, `emp_level`, `transport`, `meal`, `house`, `pension`, `health`, `health_insurance`, `jamsostek`, `fld_bonus`, `odo_bonus`, `wh_bonus`, `overtime`, `others`, `voucher`, `allowance_office`, `max_loan`, `loan_balance`, `bank_acct`, `bank_code`, `picture`, `religion`, `npwp`, `yearly_bonus`, `fx_yearly_bonus`, `address`, `phone`, `expire`, `ktp`, `serti1`, `cuti`, `cuti_flag`, `phone2`, `phoneh`, `thr`, `emp_birth`, `dom_meal`, `dom_spending`, `dom_overnight`, `ovs_meal`, `ovs_spending`, `ovs_overnight`, `dom_transport_airport`, `dom_transport_train`, `dom_transport_bus`, `dom_transport_cil`, `ovs_transport_airport`, `ovs_transport_train`, `ovs_transport_bus`, `ovs_transport_cil`, `allow_bpjs_tk`, `allow_bpjs_kes`, `allow_jshk`, `deduc_bpjs_tk`, `deduc_bpjs_kes`, `deduc_jshk`, `deduc_pph21`, `email`, `emp_lahir`, `expel`, `gender`, `mcu_id`, `point`, `point_mandatory`, `bank_save`, `contract_file`, `pro_hire`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, 'Budi Sentosa', 'VGI-K1211202001', 'Staff', 2, '0', 'MjAwMDAwMA==', '1', NULL, 'NzUwMDAw', 'MTAwMDAwMA==', 'NTAwMDAw', 0, 'NzUwMDAw', 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, '1213123', '002', 'VGI-K1211202001-picture.png', 'islam', NULL, 0, NULL, 'jl jl', '1', '2021-11-18', 'VGI-K1211202001-ktp.png', 'VGI-K1211202001-sertif.png', 12, 0, '2', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a@b.com', '2020-11-11', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$yhakPzdWox4r7O4jYdAc.qYSzvKEkstvDY7JYuAjOAkeMPn3XCa', NULL, '2020-11-12 02:43:39', NULL, NULL, NULL, '2020-12-02 08:13:40', NULL, 1),
	(2, 'Cynthia Utomo', 'VGI-K1211202002', 'Manager', 3, '0', 'MjgwMDAwMA==', '5', NULL, 'MTA1MDAwMA==', 'MTQwMDAwMA==', 'NzAwMDAw', 0, 'MTA1MDAwMA==', 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, '1231215632', '008', 'VGI-K1211202002-picture.png', 'islam', NULL, 0, NULL, 'jalan', '1', NULL, 'VGI-K1211202002-ktp.png', 'VGI-K1211202002-sertif.png', 12, 0, '2', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a@a.com', '2020-11-04', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '2020-11-12 03:54:56', NULL, NULL, NULL, '2020-11-12 03:54:56', NULL, 1),
	(3, 'Aslam', 'VGI-1311202001', 'Manager', NULL, '0', 'NDAwMDAwMA==', '5', NULL, 'MTUwMDAwMA==', 'MjAwMDAwMA==', 'MTAwMDAwMA==', 0, 'MTUwMDAwMA==', 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, '1213124', '008', 'VGI-1311202001-picture.png', 'islam', NULL, 0, NULL, 'street', '1234', NULL, 'VGI-1311202001-ktp.png', 'VGI-1311202001-sertif.png', 12, 0, '1234', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'val@mail.com', '1998-06-16', '2025-11-16', NULL, NULL, 0, 0, NULL, NULL, NULL, '2020-11-13 07:24:17', NULL, NULL, NULL, '2020-11-18 02:37:42', NULL, 1),
	(18, 'Galih Budi', 'VGI-K1711202001', 'Staff', 5, '0', 'NDAwMDAw', '1', NULL, 'MTUwMDAw', 'MjAwMDAw', 'MTAwMDAw', 0, 'MTUwMDAw', 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, '1111', '002', 'VGI-K1711202001-picture.png', 'islam', NULL, 0, NULL, 'Karangpawitan\r\nKawali', '081214235971', NULL, 'VGI-K1711202001-ktp.gif', 'VGI-K1711202001-sertif.png', 12, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a@a.com', '2020-11-03', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '2020-11-17 13:37:19', NULL, NULL, NULL, '2020-11-17 13:37:19', NULL, 1),
	(19, 'Rangga Anggara', 'VGI-K1811202001', 'Staff', 4, '0', 'NDAwMDAwMA==', '1', NULL, 'MTUwMDAwMA==', 'MjAwMDAwMA==', 'MTAwMDAwMA==', 0, 'MTUwMDAwMA==', 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, '111', '002', 'VGI-K1811202001-picture.gif', 'islam', NULL, 0, NULL, 'Karangpawitan\r\nKawali', '081214235971', NULL, 'VGI-K1811202001-ktp.gif', 'VGI-K1811202001-serti1.gif', 12, 0, '081214235971', NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ranggaanggara8@gmail.com', '1996-10-31', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '2020-11-18 01:57:19', NULL, NULL, NULL, '2020-11-18 01:57:19', NULL, 1);
/*!40000 ALTER TABLE `hrd_employee` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee_history
CREATE TABLE IF NOT EXISTS `hrd_employee_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `activity` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act_date` date NOT NULL,
  `act_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `act_amount` decimal(15,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_employee_history: ~6 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee_history` DISABLE KEYS */;
INSERT INTO `hrd_employee_history` (`id`, `emp_id`, `activity`, `act_date`, `act_by`, `act_amount`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, 'in', '2020-11-12', 'cypher', NULL, '2020-11-12 02:43:39', NULL, NULL, NULL, '2020-11-12 02:43:39', NULL),
	(2, 2, 'in', '2020-11-12', 'cypher', NULL, '2020-11-12 03:54:56', NULL, NULL, NULL, '2020-11-12 03:54:56', NULL),
	(3, 3, 'in', '2020-11-13', 'cypher', NULL, '2020-11-13 07:24:17', NULL, NULL, NULL, '2020-11-13 07:24:17', NULL),
	(4, 18, 'in', '2020-11-17', 'cypher', NULL, '2020-11-17 13:37:19', NULL, NULL, NULL, '2020-11-17 13:37:19', NULL),
	(5, 19, 'in', '2020-11-18', 'cypher', NULL, '2020-11-18 01:57:19', NULL, NULL, NULL, '2020-11-18 01:57:19', NULL),
	(6, 3, 'dismiss', '2025-11-16', 'cypher', NULL, '2020-11-18 02:37:42', NULL, NULL, NULL, '2020-11-18 02:37:42', NULL);
/*!40000 ALTER TABLE `hrd_employee_history` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee_history_edit
CREATE TABLE IF NOT EXISTS `hrd_employee_history_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `req_act_date` date DEFAULT NULL,
  `app_act_date` date DEFAULT NULL,
  `request_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_date` date DEFAULT NULL,
  `status` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_employee_history_edit: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee_history_edit` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_employee_history_edit` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee_loan
CREATE TABLE IF NOT EXISTS `hrd_employee_loan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `loan_amount` decimal(10,0) DEFAULT NULL,
  `loan_start` date DEFAULT NULL,
  `loan_end` date DEFAULT NULL,
  `given_by` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_time` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_employee_loan: ~3 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee_loan` DISABLE KEYS */;
INSERT INTO `hrd_employee_loan` (`id`, `loan_id`, `emp_id`, `date_given`, `loan_amount`, `loan_start`, `loan_end`, `given_by`, `given_time`, `notes`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, '001/VGI/LN/XI/20', 2, '2020-11-12', 1000, '2020-10-12', '2021-06-24', 'cypher', '2020-11-12 03:56:31', 'a', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(2, '002/VGI/LN/XI/20', 1, '2020-11-17', 100000000, '2020-10-18', '2025-06-17', 'cypher', '2020-11-17 13:33:25', 'Test', '2020-11-17 13:33:25', NULL, NULL, NULL, '2020-11-17 13:33:25', NULL, 1),
	(3, '003/VGI/LN/XI/20', 3, '2020-11-17', 100000000, '2020-06-02', '2024-10-17', 'cypher', '2020-11-17 13:33:45', 'ddd', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1);
/*!40000 ALTER TABLE `hrd_employee_loan` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee_loan_payment
CREATE TABLE IF NOT EXISTS `hrd_employee_loan_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `payment_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_employee_loan_payment: ~60 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee_loan_payment` DISABLE KEYS */;
INSERT INTO `hrd_employee_loan_payment` (`id`, `loan_id`, `date_of_payment`, `amount`, `payment_id`, `remark`, `receive_by`, `receive_time`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, 1, '2020-10-17', 125, '001/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(2, 1, '2020-11-17', 125, '002/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(3, 1, '2020-12-17', 125, '003/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(4, 1, '2021-01-17', 125, '004/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(5, 1, '2021-02-17', 125, '005/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(6, 1, '2021-03-17', 125, '006/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(7, 1, '2021-04-17', 125, '007/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(8, 1, '2021-05-17', 125, '008/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-12 03:56:31', '2020-11-12 03:56:31', NULL, NULL, NULL, '2020-11-12 03:56:31', NULL, 1),
	(9, 3, '2020-06-17', 1923077, '009/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(10, 3, '2020-07-17', 1923077, '010/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(11, 3, '2020-08-17', 1923077, '011/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(12, 3, '2020-09-17', 1923077, '012/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(13, 3, '2020-10-17', 1923077, '013/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(14, 3, '2020-11-17', 1923077, '014/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(15, 3, '2020-12-17', 1923077, '015/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(16, 3, '2021-01-17', 1923077, '016/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(17, 3, '2021-02-17', 1923077, '017/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(18, 3, '2021-03-17', 1923077, '018/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(19, 3, '2021-04-17', 1923077, '019/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(20, 3, '2021-05-17', 1923077, '020/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(21, 3, '2021-06-17', 1923077, '021/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(22, 3, '2021-07-17', 1923077, '022/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(23, 3, '2021-08-17', 1923077, '023/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(24, 3, '2021-09-17', 1923077, '024/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(25, 3, '2021-10-17', 1923077, '025/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(26, 3, '2021-11-17', 1923077, '026/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(27, 3, '2021-12-17', 1923077, '027/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(28, 3, '2022-01-17', 1923077, '028/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(29, 3, '2022-02-17', 1923077, '029/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(30, 3, '2022-03-17', 1923077, '030/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(31, 3, '2022-04-17', 1923077, '031/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(32, 3, '2022-05-17', 1923077, '032/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(33, 3, '2022-06-17', 1923077, '033/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(34, 3, '2022-07-17', 1923077, '034/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(35, 3, '2022-08-17', 1923077, '035/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(36, 3, '2022-09-17', 1923077, '036/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(37, 3, '2022-10-17', 1923077, '037/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(38, 3, '2022-11-17', 1923077, '038/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(39, 3, '2022-12-17', 1923077, '039/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(40, 3, '2023-01-17', 1923077, '040/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(41, 3, '2023-02-17', 1923077, '041/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(42, 3, '2023-03-17', 1923077, '042/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(43, 3, '2023-04-17', 1923077, '043/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(44, 3, '2023-05-17', 1923077, '044/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(45, 3, '2023-06-17', 1923077, '045/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(46, 3, '2023-07-17', 1923077, '046/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(47, 3, '2023-08-17', 1923077, '047/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(48, 3, '2023-09-17', 1923077, '048/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(49, 3, '2023-10-17', 1923077, '049/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(50, 3, '2023-11-17', 1923077, '050/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(51, 3, '2023-12-17', 1923077, '051/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(52, 3, '2024-01-17', 1923077, '052/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(53, 3, '2024-02-17', 1923077, '053/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(54, 3, '2024-03-17', 1923077, '054/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(55, 3, '2024-04-17', 1923077, '055/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(56, 3, '2024-05-17', 1923077, '056/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(57, 3, '2024-06-17', 1923077, '057/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(58, 3, '2024-07-17', 1923077, '058/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(59, 3, '2024-08-17', 1923077, '059/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1),
	(60, 3, '2024-09-17', 1923077, '060/VGI/LNPAY/XI/20', 'insert by autopay', 'cypher', '2020-11-17 13:33:45', '2020-11-17 13:33:45', NULL, NULL, NULL, '2020-11-17 13:33:45', NULL, 1);
/*!40000 ALTER TABLE `hrd_employee_loan_payment` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_employee_type
CREATE TABLE IF NOT EXISTS `hrd_employee_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.hrd_employee_type: ~9 rows (approximately)
/*!40000 ALTER TABLE `hrd_employee_type` DISABLE KEYS */;
INSERT INTO `hrd_employee_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Staff', '2020-10-06 15:52:13', NULL, NULL),
	(2, 'Field', '2020-10-06 15:52:13', NULL, NULL),
	(3, 'Warehouse Bintaro', '2020-10-06 15:57:02', NULL, NULL),
	(4, 'Warehouse Cileungsi', '2020-10-06 15:57:02', NULL, NULL),
	(5, 'Manager', '2020-10-06 15:57:28', NULL, NULL),
	(6, 'BOD', '2020-10-06 15:57:28', NULL, NULL),
	(7, 'Konsultan', '2020-10-06 15:57:51', NULL, NULL),
	(8, 'Local Crew', '2020-10-06 15:57:51', NULL, NULL),
	(9, 'Marketing', '2020-10-06 15:58:39', NULL, NULL);
/*!40000 ALTER TABLE `hrd_employee_type` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_overtime
CREATE TABLE IF NOT EXISTS `hrd_overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `ovt_date` date DEFAULT NULL,
  `time_in` time DEFAULT NULL COMMENT 'berisi jumlah waktu overtime sehari',
  `time_out` time DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_date` (`emp_id`,`ovt_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_overtime: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_overtime` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_overtime` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_performa_review
CREATE TABLE IF NOT EXISTS `hrd_performa_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `superior_id` varchar(50) DEFAULT NULL,
  `review_date` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `review_type` varchar(50) DEFAULT NULL,
  `final_score` int(11) DEFAULT NULL,
  `entry_point` text DEFAULT NULL,
  `entry_goal` text DEFAULT NULL,
  `entry_strength` text DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.hrd_performa_review: ~2 rows (approximately)
/*!40000 ALTER TABLE `hrd_performa_review` DISABLE KEYS */;
INSERT INTO `hrd_performa_review` (`id`, `emp_id`, `superior_id`, `review_date`, `approved_by`, `approved_date`, `review_type`, `final_score`, `entry_point`, `entry_goal`, `entry_strength`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'cypher', '2020-11-17 06:46:46', 'cypher', '2020-11-17 08:44:30', 'yearly', 5, '{"1":"1","2":"2","3":"1","4":"2","5":"1","6":"2","7":"2","8":"2","9":"2","10":"2","11":"2","12":"2","13":"2","14":"3","15":"2","16":"3","17":"3","18":"3","19":"4","20":"3","21":"4","22":"4","23":"4","24":"3","25":"4","26":"3","27":"4","28":"4","29":"3","30":"3","31":"3","32":"3","33":"3"}', '{"1":"dasdasd","2":"dsadad","3":"adasdsaas","4":"dasdadsa","5":"dasdadsad","6":"dasdasdas","7":"asdasdsa"}', '{"1":"asdsa","2":"asda","3":"asdsad","4":"asdasdas","5":"adasdas","6":"asdsadas","7":"asdadasd"}', NULL, '2020-11-17 08:44:30', NULL, '2020-11-17 06:46:46', NULL, NULL, 1),
	(2, 2, 'cypher', '2020-11-17 14:06:39', 'cypher', '2020-11-17 14:07:58', 'yearly', 6, '{"1":"5","2":"5","3":"5","4":"5","5":"4","6":"4","7":"4","8":"4","9":"4","10":"3","11":"3","12":"3","13":"3","14":"2","15":"2","16":"2","17":"2","18":"1","19":"1","20":"1","21":"1","22":"1","23":"2","24":"2","25":"2","26":"2","27":"2","28":"3","29":"3","30":"4","31":"4","32":"4","33":"4"}', '{"1":"a2","2":"a2","3":"a3","4":"a4","5":"a5","6":"a6","7":"a7"}', '{"1":"a1","2":"a2","3":"a3","4":"a4","5":"a5","6":"a6","7":"a7"}', NULL, '2020-11-17 14:07:58', 'cypher', '2020-11-17 14:06:39', NULL, NULL, 1);
/*!40000 ALTER TABLE `hrd_performa_review` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_point
CREATE TABLE IF NOT EXISTS `hrd_point` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_p` int(10) DEFAULT NULL,
  `id_t` int(10) DEFAULT NULL,
  `gp` int(10) DEFAULT NULL,
  `bp` int(10) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `date_of_case` date DEFAULT NULL,
  `hrd_approved_by` varchar(50) DEFAULT NULL,
  `hrd_approved_at` datetime DEFAULT NULL,
  `bod_approved_by` varchar(50) DEFAULT NULL,
  `bod_approved_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_point: 4 rows
/*!40000 ALTER TABLE `hrd_point` DISABLE KEYS */;
INSERT INTO `hrd_point` (`id`, `id_p`, `id_t`, `gp`, `bp`, `keterangan`, `status`, `date_of_case`, `hrd_approved_by`, `hrd_approved_at`, `bod_approved_by`, `bod_approved_at`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 18, 1, 60, 10, 'teasdadas', 2, '2020-11-09', 'cypher', '2020-11-16 10:29:16', 'cypher', '2020-11-16 10:31:37', NULL, '2020-11-16 10:31:37', 'cypher', '2020-11-16 09:52:23', NULL, NULL, 1),
	(2, 5, NULL, 60, NULL, 'sdadas', 0, '2020-11-16', NULL, NULL, NULL, NULL, NULL, '2020-11-16 10:33:14', 'cypher', '2020-11-16 09:57:29', '2020-11-16 10:33:14', NULL, 1),
	(3, 19, 2, 5, 7, '55', 2, '2020-11-18', 'cypher', '2020-11-18 02:23:51', 'cypher', '2020-11-18 02:23:54', NULL, '2020-11-18 02:23:54', 'cypher', '2020-11-17 13:43:45', NULL, NULL, 1),
	(4, 1, NULL, 10, NULL, 'create cashbond', 2, '2020-12-14', NULL, NULL, 'system', '2020-12-14 08:11:07', NULL, '2020-12-14 08:11:07', 'system', '2020-12-14 08:11:07', NULL, NULL, 1);
/*!40000 ALTER TABLE `hrd_point` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_salary_archive
CREATE TABLE IF NOT EXISTS `hrd_salary_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `archive_period` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00-0000',
  `salary` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ovt_rate` decimal(17,2) DEFAULT NULL,
  `ovt_nom` int(5) DEFAULT NULL,
  `field_rate` decimal(17,2) DEFAULT NULL,
  `field_nom` int(3) DEFAULT NULL,
  `wh_rate` decimal(17,2) DEFAULT NULL,
  `wh_nom` int(3) DEFAULT NULL,
  `odo_rate` decimal(17,2) DEFAULT NULL,
  `odo_nom` int(3) DEFAULT NULL,
  `voucher` decimal(17,2) DEFAULT NULL,
  `deduction` decimal(17,2) DEFAULT NULL,
  `lateness` int(11) DEFAULT NULL,
  `bonus` decimal(17,2) DEFAULT NULL,
  `thr` decimal(17,2) DEFAULT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fld_dgr` decimal(17,2) DEFAULT NULL,
  `fld_swt` decimal(17,2) DEFAULT NULL,
  `odo_dgr` decimal(17,2) DEFAULT NULL,
  `odo_swt` decimal(17,2) DEFAULT NULL,
  `allow_bpjs_tk` decimal(17,2) DEFAULT NULL,
  `allow_bpjs_kes` decimal(17,2) DEFAULT NULL,
  `allow_jshk` decimal(17,2) DEFAULT NULL,
  `deduc_bpjs_tk` decimal(17,2) DEFAULT NULL,
  `deduc_bpjs_kes` decimal(17,2) DEFAULT NULL,
  `deduc_jshk` decimal(17,2) DEFAULT NULL,
  `deduc_pph21` decimal(17,2) DEFAULT NULL,
  `proportional` decimal(17,2) DEFAULT NULL,
  `company_id` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_salary_archive: ~14 rows (approximately)
/*!40000 ALTER TABLE `hrd_salary_archive` DISABLE KEYS */;
INSERT INTO `hrd_salary_archive` (`id`, `emp_id`, `archive_period`, `salary`, `ovt_rate`, `ovt_nom`, `field_rate`, `field_nom`, `wh_rate`, `wh_nom`, `odo_rate`, `odo_nom`, `voucher`, `deduction`, `lateness`, `bonus`, `thr`, `category`, `fld_dgr`, `fld_swt`, `odo_dgr`, `odo_swt`, `allow_bpjs_tk`, `allow_bpjs_kes`, `allow_jshk`, `deduc_bpjs_tk`, `deduc_bpjs_kes`, `deduc_jshk`, `deduc_pph21`, `proportional`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '10-2020', 'NTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5000000.00, 1, '2020-11-16 08:50:09', '2020-11-16 08:50:09', NULL),
	(2, 2, '10-2020', 'NzAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 125.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6999875.00, 1, '2020-11-16 08:50:09', '2020-11-16 08:50:09', NULL),
	(3, 3, '10-2020', 'MTAwMDAwMDA=', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10000000.00, 1, '2020-11-16 08:50:09', '2020-11-16 08:50:09', NULL),
	(4, 1, '9-2020', 'NTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5000000.00, 1, '2020-11-16 09:14:15', '2020-11-16 09:14:15', NULL),
	(5, 2, '9-2020', 'NzAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7000000.00, 1, '2020-11-16 09:14:15', '2020-11-16 09:14:15', NULL),
	(6, 3, '9-2020', 'MTAwMDAwMDA=', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10000000.00, 1, '2020-11-16 09:14:15', '2020-11-16 09:14:15', NULL),
	(15, 1, '11-2020', 'NTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4500000.00, 1, '2020-11-30 12:04:28', '2020-11-30 12:04:28', NULL),
	(16, 2, '11-2020', 'NzAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 125.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6299887.50, 1, '2020-11-30 12:04:28', '2020-11-30 12:04:28', NULL),
	(17, 18, '11-2020', 'MTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1000000.00, 1, '2020-11-30 12:04:28', '2020-11-30 12:04:28', NULL),
	(18, 19, '11-2020', 'MTAwMDAwMDA=', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10000000.00, 1, '2020-11-30 12:04:28', '2020-11-30 12:04:28', NULL),
	(19, 1, '12-2020', 'NTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1574193.55, 1, '2020-12-02 16:00:22', '2020-12-02 16:00:22', NULL),
	(20, 2, '12-2020', 'NzAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 125.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2258024.19, 1, '2020-12-02 16:00:22', '2020-12-02 16:00:22', NULL),
	(21, 18, '12-2020', 'MTAwMDAwMA==', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 483870.97, 1, '2020-12-02 16:00:22', '2020-12-02 16:00:22', NULL),
	(22, 19, '12-2020', 'MTAwMDAwMDA=', 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, NULL, 0.00, 0, 0.00, 0.00, 'all', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5161290.32, 1, '2020-12-02 16:00:22', '2020-12-02 16:00:22', NULL);
/*!40000 ALTER TABLE `hrd_salary_archive` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_salary_history
CREATE TABLE IF NOT EXISTS `hrd_salary_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` int(5) DEFAULT NULL,
  `basic` decimal(15,2) DEFAULT NULL,
  `voucher` decimal(15,2) DEFAULT NULL,
  `position` decimal(15,2) DEFAULT NULL,
  `execute_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_salary_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_salary_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_salary_history` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_salary_master_appreciation
CREATE TABLE IF NOT EXISTS `hrd_salary_master_appreciation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL DEFAULT 0,
  `max` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_salary_master_appreciation: ~5 rows (approximately)
/*!40000 ALTER TABLE `hrd_salary_master_appreciation` DISABLE KEYS */;
INSERT INTO `hrd_salary_master_appreciation` (`id`, `min`, `max`, `amount`) VALUES
	(1, 5, 10, 1),
	(2, 11, 15, 2),
	(3, 16, 20, 3),
	(4, 21, 25, 4),
	(5, 26, 999, 5);
/*!40000 ALTER TABLE `hrd_salary_master_appreciation` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_salary_master_reason
CREATE TABLE IF NOT EXISTS `hrd_salary_master_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` text DEFAULT NULL,
  `severance` decimal(17,2) NOT NULL DEFAULT 0.00,
  `apprecation` decimal(17,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_salary_master_reason: ~14 rows (approximately)
/*!40000 ALTER TABLE `hrd_salary_master_reason` DISABLE KEYS */;
INSERT INTO `hrd_salary_master_reason` (`id`, `reason`, `severance`, `apprecation`) VALUES
	(1, 'Pengunduran diri secara baik-baik', 0.00, 0.00),
	(2, 'Akhir kontrak pertama kali', 0.00, 0.00),
	(3, 'Pengunduran diri mengikuti prosedur', 0.00, 0.00),
	(4, 'Melakukan pelanggaran berat', 0.00, 0.00),
	(5, 'Pekerja ditahan pihak berwajib', 0.00, 1.00),
	(6, 'Pekerja melakukan pelanggaran ringan', 1.00, 1.00),
	(7, 'Perusahaan pailit', 1.00, 1.00),
	(8, 'Perusahaan tutup karena merugi', 1.00, 1.00),
	(9, 'Perubahan status, merger, peleburan, dan pekerja tidak melanjutkan hubungan kerja', 1.00, 1.00),
	(10, 'Perubahan status, merger, peleburan, dan perusahaan tidak menerima pekerja', 2.00, 1.00),
	(11, 'Perusahaan melakukan efisiensi', 2.00, 1.00),
	(12, 'Pekerja mencapai usia pensiun normal', 2.00, 1.00),
	(13, 'Pekerja meninggal dunia', 2.00, 1.00),
	(14, 'Pekerja sakit berkepanjangan atau cacat tetap akibat kecelakaan kerja', 2.00, 2.00);
/*!40000 ALTER TABLE `hrd_salary_master_reason` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_salary_master_severance
CREATE TABLE IF NOT EXISTS `hrd_salary_master_severance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL DEFAULT 0,
  `max` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_salary_master_severance: ~6 rows (approximately)
/*!40000 ALTER TABLE `hrd_salary_master_severance` DISABLE KEYS */;
INSERT INTO `hrd_salary_master_severance` (`id`, `min`, `max`, `amount`) VALUES
	(1, 3, 5, 2),
	(2, 6, 7, 4),
	(3, 8, 9, 6),
	(4, 10, 11, 7),
	(5, 12, 13, 8),
	(6, 14, 999, 9);
/*!40000 ALTER TABLE `hrd_salary_master_severance` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_sanction
CREATE TABLE IF NOT EXISTS `hrd_sanction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sanctionID` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `sanction_amount` decimal(10,0) DEFAULT NULL,
  `sanction_date` date DEFAULT NULL,
  `given_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_time` datetime DEFAULT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_sanction: ~2 rows (approximately)
/*!40000 ALTER TABLE `hrd_sanction` DISABLE KEYS */;
INSERT INTO `hrd_sanction` (`id`, `sanctionID`, `emp_id`, `date_given`, `sanction_amount`, `sanction_date`, `given_by`, `given_time`, `approved_by`, `approved_time`, `notes`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, '001/VGI/SA/XII/20', 1, '2020-12-01', 120000, '2020-12-01', 'cypher', '2020-12-01 03:57:14', 'cypher', '2020-12-01 04:24:07', 'rtert', '2020-12-01 03:57:14', NULL, NULL, NULL, '2020-12-01 04:24:07', NULL, 1),
	(2, '002/VGI/SA/XII/20', 2, '2020-12-01', 150000, '2020-12-08', 'cypher', '2020-12-01 07:06:34', 'cypher', '2020-12-01 07:06:37', 'tes2', '2020-12-01 07:06:34', NULL, NULL, NULL, '2020-12-01 07:06:37', NULL, 1);
/*!40000 ALTER TABLE `hrd_sanction` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_setting_point
CREATE TABLE IF NOT EXISTS `hrd_setting_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complete_point` int(11) DEFAULT NULL,
  `minus_point` int(11) DEFAULT NULL,
  `max_minus_point` int(11) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_setting_point: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_setting_point` DISABLE KEYS */;
INSERT INTO `hrd_setting_point` (`id`, `complete_point`, `minus_point`, `max_minus_point`, `modified_by`, `date_modified`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 30, 2, 10, NULL, NULL, '2020-11-17 12:04:13', NULL, NULL, NULL, '2020-11-17 12:04:13', NULL);
/*!40000 ALTER TABLE `hrd_setting_point` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_severance
CREATE TABLE IF NOT EXISTS `hrd_severance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `act_date` date DEFAULT NULL,
  `sev_date` date DEFAULT NULL,
  `id_reasons` int(11) DEFAULT NULL,
  `sev_amount` decimal(15,2) DEFAULT NULL,
  `app_amount` decimal(15,2) DEFAULT NULL,
  `add_out_salary` decimal(15,2) DEFAULT NULL,
  `add_thr` decimal(15,2) DEFAULT NULL,
  `add_bonus` decimal(15,2) DEFAULT NULL,
  `add_others` decimal(15,2) DEFAULT NULL,
  `deduc_loan` decimal(15,2) DEFAULT NULL,
  `deduc_union` decimal(15,2) DEFAULT NULL,
  `deduc_others` decimal(15,2) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `rejected_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_severance: ~2 rows (approximately)
/*!40000 ALTER TABLE `hrd_severance` DISABLE KEYS */;
INSERT INTO `hrd_severance` (`id`, `emp_id`, `act_date`, `sev_date`, `id_reasons`, `sev_amount`, `app_amount`, `add_out_salary`, `add_thr`, `add_bonus`, `add_others`, `deduc_loan`, `deduc_union`, `deduc_others`, `approved_at`, `approved_by`, `rejected_at`, `rejected_by`, `updated_by`, `updated_at`, `created_by`, `created_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 3, '2020-11-13', '2025-11-16', 14, 16000000.00, 4000000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2020-11-18 02:37:42', 'cypher', NULL, NULL, NULL, '2020-11-18 02:37:42', 'cypher', '2020-11-16 15:19:12', NULL, NULL, 1),
	(2, 1, '2020-11-12', '2030-11-16', 14, 28000000.00, 2000000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, '2020-11-16 15:27:17', 'cypher', '2020-11-16 15:25:19', '2020-11-16 15:27:17', NULL, 1);
/*!40000 ALTER TABLE `hrd_severance` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_training
CREATE TABLE IF NOT EXISTS `hrd_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `complete_point` int(11) DEFAULT NULL,
  `minus_point` int(11) DEFAULT NULL,
  `syllabus` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `pass_score` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_training: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_training` DISABLE KEYS */;
INSERT INTO `hrd_training` (`id`, `title`, `description`, `type`, `complete_point`, `minus_point`, `syllabus`, `start_date`, `deadline`, `status`, `link`, `active`, `pass_score`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 'LOREM IPSUM DSA', 'a', 'Mandatory', 30, 2, NULL, '2020-12-14 21:45:00', '2020-11-20 23:45:00', NULL, 'google.com', 1, 25, '2020-11-17 13:46:23', NULL, NULL, NULL, '2020-12-14 07:06:25', NULL);
/*!40000 ALTER TABLE `hrd_training` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_training_link_video
CREATE TABLE IF NOT EXISTS `hrd_training_link_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hrd_training` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_training_link_video: ~7 rows (approximately)
/*!40000 ALTER TABLE `hrd_training_link_video` DISABLE KEYS */;
INSERT INTO `hrd_training_link_video` (`id`, `id_hrd_training`, `link`, `status`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, 'aaaaaaaa', NULL, '2020-11-17 13:46:24', NULL, NULL, NULL, '2020-11-17 13:46:24', NULL),
	(2, 1, 'ssssss', NULL, '2020-11-17 13:46:24', NULL, NULL, NULL, '2020-11-17 13:46:24', NULL),
	(3, 1, 'ddddd', NULL, '2020-11-17 13:46:24', NULL, NULL, NULL, '2020-11-17 13:46:24', NULL),
	(4, 1, NULL, NULL, '2020-12-14 06:50:15', NULL, NULL, NULL, '2020-12-14 06:50:15', NULL),
	(5, 1, NULL, NULL, '2020-12-14 06:52:52', NULL, NULL, NULL, '2020-12-14 06:52:52', NULL),
	(6, 1, NULL, NULL, '2020-12-14 06:53:09', NULL, NULL, NULL, '2020-12-14 06:53:09', NULL),
	(7, 1, NULL, NULL, '2020-12-14 06:54:07', NULL, NULL, NULL, '2020-12-14 06:54:07', NULL),
	(8, 1, NULL, NULL, '2020-12-14 07:06:25', NULL, NULL, NULL, '2020-12-14 07:06:25', NULL);
/*!40000 ALTER TABLE `hrd_training_link_video` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_training_syllabus
CREATE TABLE IF NOT EXISTS `hrd_training_syllabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hrd_training` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cypher4.hrd_training_syllabus: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_training_syllabus` DISABLE KEYS */;
INSERT INTO `hrd_training_syllabus` (`id`, `id_hrd_training`, `name`, `type`, `location`, `status`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, '19700101T134623_syllabus_1.txt', 'txt', NULL, NULL, '2020-11-17 13:46:24', NULL, NULL, NULL, '2020-11-17 13:46:24', NULL);
/*!40000 ALTER TABLE `hrd_training_syllabus` ENABLE KEYS */;

-- Dumping structure for table cypher4.hrd_training_users
CREATE TABLE IF NOT EXISTS `hrd_training_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `exam_pass` int(3) DEFAULT NULL,
  `complete_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passed_on` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `pick_status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.hrd_training_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `hrd_training_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_training_users` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_bp_detail
CREATE TABLE IF NOT EXISTS `marketing_bp_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_main` int(11) NOT NULL,
  `prj_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_amount` decimal(15,2) DEFAULT NULL,
  `actual_amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.marketing_bp_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `marketing_bp_detail` DISABLE KEYS */;
INSERT INTO `marketing_bp_detail` (`id_detail`, `id_main`, `prj_code`, `item_name`, `request_amount`, `actual_amount`, `currency`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '2', 'AMOUNT', 7000.00, 0.00, 'IDR', '2020-11-13 07:53:57', '2020-11-13 08:03:28', NULL),
	(2, 1, '2', 'ADMINISTRATION', 1000.00, 0.00, 'IDR', '2020-11-13 07:53:57', '2020-11-13 08:03:28', NULL);
/*!40000 ALTER TABLE `marketing_bp_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_bp_main
CREATE TABLE IF NOT EXISTS `marketing_bp_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prj_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prj_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_bond` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_bond` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submit_date` date NOT NULL,
  `input_date` date NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_date` date DEFAULT NULL,
  `price_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `alasan_approve_operation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_reject_operation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_approve_finance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_reject_finance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_prj` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_jaminan` decimal(17,2) NOT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `durasi` int(6) DEFAULT NULL,
  `retrieve_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retrieve_date` date DEFAULT NULL,
  `retrieve_to` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `receive_to` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.marketing_bp_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_bp_main` DISABLE KEYS */;
INSERT INTO `marketing_bp_main` (`id`, `prj_code`, `prj_name`, `perusahaan`, `no_tender`, `no_bond`, `type_bond`, `submit_date`, `input_date`, `currency`, `app_date`, `price_date`, `release_date`, `alasan_approve_operation`, `alasan_reject_operation`, `alasan_approve_finance`, `alasan_reject_finance`, `status`, `nama_prj`, `nilai_jaminan`, `date1`, `date2`, `durasi`, `retrieve_by`, `retrieve_date`, `retrieve_to`, `receive_by`, `receive_date`, `receive_to`, `final_by`, `final_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2', 'JASA SEWA ANGKUTAN UMUM', 'PT. A', '1234', 'B123', 'B', '2020-11-13', '2020-11-13', 'IDR', NULL, '2020-11-13', '2020-11-13', '', '', '', '', 'Done', 'tes', 100000.00, '2020-11-13', '2021-11-08', 360, 'cypher', '2020-11-13', 'adi', 'cypher', '2020-11-13', 'iis', NULL, '2020-11-13', '2020-11-13 07:53:57', '2020-11-13 08:03:28', NULL);
/*!40000 ALTER TABLE `marketing_bp_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_clients
CREATE TABLE IF NOT EXISTS `marketing_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_1` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.marketing_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `marketing_clients` DISABLE KEYS */;
INSERT INTO `marketing_clients` (`id`, `company_name`, `address`, `phone_1`, `phone_2`, `fax`, `pic`, `pic_number`, `document_file`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `company_id`) VALUES
	(1, 'PT CLIENT A', 'Jalan Jalan', '1', '2', '3', 'Jonosari', '12312', NULL, NULL, '2020-11-12 02:46:11', NULL, '2020-11-12 02:46:11', NULL, NULL, 1),
	(2, 'Student', 'Karangpawitan\r\nKawali', '081214235971', '08231424524', '890', 'aaa', '081214235971', NULL, NULL, '2020-11-23 06:55:38', NULL, '2020-11-23 06:55:38', NULL, NULL, 17);
/*!40000 ALTER TABLE `marketing_clients` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_leads
CREATE TABLE IF NOT EXISTS `marketing_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leads_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `progress` decimal(10,2) DEFAULT NULL,
  `contributors` text DEFAULT NULL,
  `partner` int(11) DEFAULT NULL,
  `mom` mediumtext DEFAULT NULL,
  `nda` mediumtext DEFAULT NULL,
  `spd` mediumtext DEFAULT NULL,
  `ol` mediumtext DEFAULT NULL,
  `mou` mediumtext DEFAULT NULL,
  `pks` mediumtext DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_leads: ~7 rows (approximately)
/*!40000 ALTER TABLE `marketing_leads` DISABLE KEYS */;
INSERT INTO `marketing_leads` (`id`, `leads_name`, `description`, `id_client`, `id_category`, `progress`, `contributors`, `partner`, `mom`, `nda`, `spd`, `ol`, `mou`, `pks`, `approved_at`, `created_at`, `updated_at`, `deleted_at`, `approved_by`, `created_by`, `updated_by`, `deleted_by`, `company_id`) VALUES
	(1, 'lorem hey', 'asdasd', 1, NULL, 0.00, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-23 12:43:11', '2020-11-27 07:44:01', NULL, NULL, 'cypher', 'cypher', NULL, 1),
	(2, 'hgasf', 'asdas', 1, NULL, 100.00, NULL, NULL, '$2y$10$1.7.GtUF50vrsxEZWotOZKgCfuqssyMJFkfyjFB1LfIoYAIXfq', '$2y$10$PngYARO0knDTEfa8cuMxlezfGkKZcWbz51iEOkrziS3RLEv0lXkNK', '$2y$10$47KfLUNoPzXJLqD3IsbB.RfbO1JUH0rskYFEkfd4cHCRqECAYPku', '$2y$10$ezluQtVIKC7qZLp3sFSdkeaueG6sjvJ6JZy7NlgIzwMLhlT2OWGvq', '$2y$10$KYb.GyCynAolqMPSeX2tuoQGkwqa0uifPfF2KL33zUP3D6eG1B4O', '$2y$10$QYAJr7b3Yuo8FQxCTk8X.1HM8SRMgzBNN6Rc52N1pZm2Du1XNDM.', '2020-11-25 04:04:44', '2020-11-25 03:34:08', '2020-11-25 04:04:44', NULL, 'cypher', 'cypher', 'cypher', NULL, 1),
	(3, 'lorem', 'asdasd', 1, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-25 04:05:20', '2020-11-25 04:05:20', NULL, NULL, 'cypher', 'cypher', NULL, 1),
	(4, 'heho', 'asdasdsadas', 2, NULL, 100.00, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-30 07:03:33', '2020-11-27 04:03:39', '2020-11-30 07:03:33', NULL, 'cypher', 'cypher', 'cypher', NULL, 1),
	(5, 'asdasda', 'asdsad', 1, 1, 0.00, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-01 05:11:09', '2020-12-01 05:11:09', NULL, NULL, 'cypher', 'cypher', NULL, 1),
	(6, 'dasdsadasd', 'dasdasd', 1, 1, 100.00, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:13:17', '2020-12-02 01:48:13', '2020-12-02 02:13:17', NULL, 'cypher', 'cypher', 'cypher', NULL, 1),
	(7, 'weqeq', 'asdasd', 1, 1, 0.00, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', '2020-12-02 02:14:12', NULL, NULL, 'cypher', 'cypher', NULL, 1);
/*!40000 ALTER TABLE `marketing_leads` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_leads_associates
CREATE TABLE IF NOT EXISTS `marketing_leads_associates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_leads` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `file_draft` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `file_date` datetime DEFAULT NULL,
  `resi` text DEFAULT NULL,
  `resi_file` mediumtext DEFAULT NULL,
  `resi_date` datetime DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `step_type` varchar(50) DEFAULT NULL,
  `id_meeting_internal` int(11) DEFAULT NULL,
  `id_meeting_eksternal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_leads_associates: ~17 rows (approximately)
/*!40000 ALTER TABLE `marketing_leads_associates` DISABLE KEYS */;
INSERT INTO `marketing_leads_associates` (`id`, `id_leads`, `id_user`, `type`, `file_draft`, `file`, `file_date`, `resi`, `resi_file`, `resi_date`, `amount`, `step_type`, `id_meeting_internal`, `id_meeting_eksternal`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 4, 7, 'nda', '$2y$10$0q2r9ODt36UiktrJvdw1.0fEbX7JaipdQ.AGFq1DmYVnntGCgv0e', '$2y$10$5wFdmJWRonbZ4gH8GVt4OaVUos0KBViiWqyq39lIKsIeg55PcWw6', NULL, '$2y$10$f.dQSFqDKMYX1oZQP0ZA.MMLzmuEtA8xA23GR8CjLycRj0qd5p7e', NULL, '2020-11-30 04:48:59', 25000.00, NULL, NULL, NULL, '2020-11-27 09:05:10', 'cypher', '2020-11-30', NULL, NULL, NULL, 1),
	(2, 4, 8, 'drl', '$2y$10$OpNuNk5d5a3XSFbWNWze8BIsw0KacpVEAbIe25805yd89TNviL2', '$2y$10$wSqmQN.24wlZ.b4fbEvg1.6gimWRDHwWQFTRwkPHuXR7eMDHr1gS', NULL, '$2y$10$RSY2At34gcBcwwjUFU4iejURnegXro8IcOny.eTrpxgeLLkk1nq', NULL, '2020-11-30 04:49:19', 25000.00, NULL, NULL, NULL, '2020-11-27 09:05:10', 'cypher', '2020-11-30', NULL, NULL, NULL, 1),
	(3, 4, 9, 'meeting', '$2y$10$2beWB1jnRUHtCTDKbQdzf.RAIUgDL2K6pn6uYBMYIyuVFmCjK2.', '$2y$10$xiiZoEtUWOhFxdLxqvS.uoyRdQMnpGdbM9l7gZLw101AMoz0huVe', NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, '2020-11-27 09:05:10', 'cypher', '2020-11-30', NULL, NULL, NULL, 1),
	(4, 4, 9, 'wo', '$2y$10$DixUWgGhPVBxOsGYGFojcuv6jNmiGGLL4eowgpY.GU0W6.Pvbu0qq', '$2y$10$JR9mZYyMfc9BA5w1lTMcLu8C0ttKzt4mNxWO7OeiIw14AZIIjL45u', NULL, 'asdadqw3412312312', '$2y$10$NrSa6I6qpxddD67IAeyxFuAFnBfskdxpBUiJBSSyysiilWP3xDA4q', '2020-11-30 07:00:46', 20000.00, NULL, NULL, NULL, '2020-11-27 09:05:30', 'cypher', '2020-11-30', NULL, NULL, NULL, 1),
	(5, 4, 11, 'agreement', '$2y$10$RDI1HnEQtSlpgPSY4SmDAeoaIQqL4DuKc8weniH7nZML42dkemKzu', '$2y$10$Q02NzEd0y.ScOd2My2vnZuE6B.0OO98Jl9j40PFTgLiPVQ.RuoTcS', NULL, 'asdadqw3412312312', '$2y$10$Zt6u5.6WyHcrzzhYPyES9.RiEUjqDm9ptAOyskYm8P37u9UczcDga', '2020-11-30 07:01:07', 25000.00, NULL, NULL, NULL, '2020-11-27 09:05:30', 'cypher', '2020-11-30', NULL, NULL, NULL, 1),
	(9, 5, 7, 'nda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-01 05:34:41', 'cypher', '2020-12-01', NULL, NULL, NULL, 1),
	(10, 5, 8, 'drl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-01 05:34:41', 'cypher', '2020-12-01', NULL, NULL, NULL, 1),
	(11, 6, NULL, 'nda', '$2y$10$nObonbFIAF7l3OYV0NelO4jcfTnvOPWANLh0mbv5lxP7JTfitdpy', '$2y$10$nemU78FiRqJOvcLdFPaJSOzDeW6fGvlYfWwW2RXM1Lx2grvzq.obq', NULL, 'asdadqw3412312312', '$2y$10$O540vRaO4aiH0T33AYbP0e.4Rq7rX3YbZYYwFXGzyHRRfMzMNdcMG', '2020-12-02 01:58:26', 25000.00, NULL, NULL, NULL, '2020-12-02 01:48:13', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(12, 6, NULL, 'drl', '$2y$10$FriOowSyO3n9gdCglcCLJuEtoBt9rSJKelpVOYFuiUqyM1UV2P3O', '$2y$10$fATsEc2peQayMXqHxuAq.MX1G1Yz15lEfxyGE4zKUCIcFghUIRy', NULL, 'asdadqw3412312312', '$2y$10$8KSJnIvH7mDSsc.k9Tkc.4QaDIZNzhA6buyK.F3w0CmclJRIDFi', '2020-12-02 01:58:44', 25000.00, NULL, NULL, NULL, '2020-12-02 01:48:13', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(13, 6, NULL, 'meeting', '$2y$10$EUluh04dBhERPqlVbQQFxetW7gOHw9euHoOv1wfdSXfHvBteTHC6', '$2y$10$XrFqBAB9GQfmANWJfZWkZ.oSbJ9SNwqsHnUFKhsKSQhBUTrpcEqa', NULL, NULL, NULL, NULL, NULL, NULL, 4, 5, '2020-12-02 01:48:13', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(14, 6, NULL, 'wo', '$2y$10$e2FwOcPUa1qvDkEQ.XYq.PuVM6AwPsNgIconXgALQYnSXOQ.3J.', '$2y$10$jjHG3hgOSIH91diRMedEpuZj.7WFoMWbGGu55b8TCL3NYymZ8ddqi', NULL, 'asdadqw3412312312', '$2y$10$DWv5ScQwU1IoxkGtwZbtF.Ws7ZFNIKquLMZ7RDQkkZw80JMZ2N..G', '2020-12-02 02:12:44', 25000.00, 'Offering Letter', NULL, NULL, '2020-12-02 01:48:14', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(15, 6, NULL, 'agreement', '$2y$10$MpBakZdaBosHSWW3Rmk3U.GCqJtOC0i0qJ6A5NIuVNyRZf8wnlc5y', '$2y$10$6gH8fS4YVxYvaXz3axAIcO7W0ASbegssSPrFx6Qbx3naBYnhrh3C', NULL, 'asdadqw3412312312', '$2y$10$iV5.4Wj665SNWLu9RzV2OeDT2OyF2oCcPWRg7DRNFLkKOGEYY0Su', '2020-12-02 02:13:13', 25000.00, 'PKS (Perjanjian Kerjasama)', NULL, NULL, '2020-12-02 01:48:14', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(16, 7, 8, 'nda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(17, 7, NULL, 'drl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(18, 7, NULL, 'meeting', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(19, 7, NULL, 'wo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', 'cypher', '2020-12-02', NULL, NULL, NULL, 1),
	(20, 7, NULL, 'agreement', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:14:12', 'cypher', '2020-12-02', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `marketing_leads_associates` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_leads_category
CREATE TABLE IF NOT EXISTS `marketing_leads_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_leads_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_leads_category` DISABLE KEYS */;
INSERT INTO `marketing_leads_category` (`id`, `category_name`, `category_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'lorem', 'Legal', '2020-12-01 05:10:59', '2020-12-01 05:10:59', NULL);
/*!40000 ALTER TABLE `marketing_leads_category` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_lead_contracts
CREATE TABLE IF NOT EXISTS `marketing_lead_contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lead` int(11) DEFAULT NULL,
  `contract_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_lead_contracts: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_lead_contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `marketing_lead_contracts` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_lead_files
CREATE TABLE IF NOT EXISTS `marketing_lead_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lead` int(11) DEFAULT NULL,
  `file_code` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_lead_files: ~42 rows (approximately)
/*!40000 ALTER TABLE `marketing_lead_files` DISABLE KEYS */;
INSERT INTO `marketing_lead_files` (`id`, `id_lead`, `file_code`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 1, '$2y$10$QLH3I9j3acLUhpqZjy6BIeF9vLVBGVnDtaKDP1LuOU8wdmuclp8E2', '2020-11-23 14:17:50', '2020-11-23 14:17:50', NULL, NULL),
	(2, 1, '$2y$10$VSgJaSIWpRYgZAA276XOC.oQ7DqZE2WjFW2H2qJud0zkgVfViQzma', '2020-11-23 14:30:09', '2020-11-23 14:30:09', NULL, NULL),
	(3, 1, '$2y$10$RU.NnJA9o9PTgRx52vnqu7w0pwcFSJgnNgm0Q0e5wIHRFWFlSQO', '2020-11-23 14:30:32', '2020-11-23 14:30:32', NULL, NULL),
	(4, 1, '$2y$10$LAUDPdjJJOTkGQZIWBvk0.jB.cCpFBVs9K7Np9Q2eijRVsLRTE4.O', '2020-11-23 14:30:38', '2020-11-23 14:30:38', NULL, NULL),
	(5, 1, '$2y$10$9CK.GWYYXsmxe1ifACtdn.ajz5CyfLFtQfUgWVioQJ.9uPsST2dNK', '2020-11-23 14:30:46', '2020-11-23 14:30:46', NULL, NULL),
	(6, 1, '$2y$10$Vxdwjk11bPj2EQXBpQ08u.9PTGc66TDUMjJydJVcqZHMPBRBtUxxG', '2020-11-23 14:30:51', '2020-11-23 14:30:51', NULL, NULL),
	(7, 1, '$2y$10$NdcA0BrPMXPnSkY6QloNluIlXSZ2YPT2gFxuD1jRdE6TgQp.uDMfS', '2020-11-23 14:30:54', '2020-11-23 14:30:54', NULL, NULL),
	(8, 2, '$2y$10$1.7.GtUF50vrsxEZWotOZKgCfuqssyMJFkfyjFB1LfIoYAIXfq', '2020-11-25 03:53:05', '2020-11-25 03:53:05', NULL, NULL),
	(9, 2, '$2y$10$PngYARO0knDTEfa8cuMxlezfGkKZcWbz51iEOkrziS3RLEv0lXkNK', '2020-11-25 03:54:26', '2020-11-25 03:54:26', NULL, NULL),
	(10, 2, '$2y$10$47KfLUNoPzXJLqD3IsbB.RfbO1JUH0rskYFEkfd4cHCRqECAYPku', '2020-11-25 04:04:25', '2020-11-25 04:04:25', NULL, NULL),
	(11, 2, '$2y$10$ezluQtVIKC7qZLp3sFSdkeaueG6sjvJ6JZy7NlgIzwMLhlT2OWGvq', '2020-11-25 04:04:30', '2020-11-25 04:04:30', NULL, NULL),
	(12, 2, '$2y$10$KYb.GyCynAolqMPSeX2tuoQGkwqa0uifPfF2KL33zUP3D6eG1B4O', '2020-11-25 04:04:35', '2020-11-25 04:04:35', NULL, NULL),
	(13, 2, '$2y$10$QYAJr7b3Yuo8FQxCTk8X.1HM8SRMgzBNN6Rc52N1pZm2Du1XNDM.', '2020-11-25 04:04:44', '2020-11-25 04:04:44', NULL, NULL),
	(19, 4, '$2y$10$0q2r9ODt36UiktrJvdw1.0fEbX7JaipdQ.AGFq1DmYVnntGCgv0e', '2020-11-30 04:30:26', '2020-11-30 04:30:26', NULL, NULL),
	(20, 4, '$2y$10$f.dQSFqDKMYX1oZQP0ZA.MMLzmuEtA8xA23GR8CjLycRj0qd5p7e', '2020-11-30 04:48:59', '2020-11-30 04:48:59', NULL, NULL),
	(21, 4, '$2y$10$5wFdmJWRonbZ4gH8GVt4OaVUos0KBViiWqyq39lIKsIeg55PcWw6', '2020-11-30 04:49:04', '2020-11-30 04:49:04', NULL, NULL),
	(22, 4, '$2y$10$OpNuNk5d5a3XSFbWNWze8BIsw0KacpVEAbIe25805yd89TNviL2', '2020-11-30 04:49:11', '2020-11-30 04:49:11', NULL, NULL),
	(23, 4, '$2y$10$RSY2At34gcBcwwjUFU4iejURnegXro8IcOny.eTrpxgeLLkk1nq', '2020-11-30 04:49:19', '2020-11-30 04:49:19', NULL, NULL),
	(24, 4, '$2y$10$wSqmQN.24wlZ.b4fbEvg1.6gimWRDHwWQFTRwkPHuXR7eMDHr1gS', '2020-11-30 04:49:49', '2020-11-30 04:49:49', NULL, NULL),
	(25, 4, '$2y$10$2beWB1jnRUHtCTDKbQdzf.RAIUgDL2K6pn6uYBMYIyuVFmCjK2.', '2020-11-30 06:47:54', '2020-11-30 06:47:54', NULL, NULL),
	(26, 4, '$2y$10$xiiZoEtUWOhFxdLxqvS.uoyRdQMnpGdbM9l7gZLw101AMoz0huVe', '2020-11-30 06:59:02', '2020-11-30 06:59:02', NULL, NULL),
	(27, 4, '$2y$10$DixUWgGhPVBxOsGYGFojcuv6jNmiGGLL4eowgpY.GU0W6.Pvbu0qq', '2020-11-30 06:59:14', '2020-11-30 06:59:14', NULL, NULL),
	(28, 4, '$2y$10$NrSa6I6qpxddD67IAeyxFuAFnBfskdxpBUiJBSSyysiilWP3xDA4q', '2020-11-30 07:00:46', '2020-11-30 07:00:46', NULL, NULL),
	(29, 4, '$2y$10$JR9mZYyMfc9BA5w1lTMcLu8C0ttKzt4mNxWO7OeiIw14AZIIjL45u', '2020-11-30 07:00:52', '2020-11-30 07:00:52', NULL, NULL),
	(30, 4, '$2y$10$RDI1HnEQtSlpgPSY4SmDAeoaIQqL4DuKc8weniH7nZML42dkemKzu', '2020-11-30 07:00:57', '2020-11-30 07:00:57', NULL, NULL),
	(31, 4, '$2y$10$Zt6u5.6WyHcrzzhYPyES9.RiEUjqDm9ptAOyskYm8P37u9UczcDga', '2020-11-30 07:01:07', '2020-11-30 07:01:07', NULL, NULL),
	(32, 4, '$2y$10$twJIruKBZBos0PGJchgVY.JOHuRPwkq3oJMiWru66IHRKC0BOmAo.', '2020-11-30 07:01:20', '2020-11-30 07:01:20', NULL, NULL),
	(33, 4, '$2y$10$Q02NzEd0y.ScOd2My2vnZuE6B.0OO98Jl9j40PFTgLiPVQ.RuoTcS', '2020-11-30 07:03:33', '2020-11-30 07:03:33', NULL, NULL),
	(34, 6, '$2y$10$nObonbFIAF7l3OYV0NelO4jcfTnvOPWANLh0mbv5lxP7JTfitdpy', '2020-12-02 01:58:17', '2020-12-02 01:58:17', NULL, NULL),
	(35, 6, '$2y$10$O540vRaO4aiH0T33AYbP0e.4Rq7rX3YbZYYwFXGzyHRRfMzMNdcMG', '2020-12-02 01:58:26', '2020-12-02 01:58:26', NULL, NULL),
	(36, 6, '$2y$10$nemU78FiRqJOvcLdFPaJSOzDeW6fGvlYfWwW2RXM1Lx2grvzq.obq', '2020-12-02 01:58:32', '2020-12-02 01:58:32', NULL, NULL),
	(37, 6, '$2y$10$FriOowSyO3n9gdCglcCLJuEtoBt9rSJKelpVOYFuiUqyM1UV2P3O', '2020-12-02 01:58:37', '2020-12-02 01:58:37', NULL, NULL),
	(38, 6, '$2y$10$8KSJnIvH7mDSsc.k9Tkc.4QaDIZNzhA6buyK.F3w0CmclJRIDFi', '2020-12-02 01:58:44', '2020-12-02 01:58:44', NULL, NULL),
	(39, 6, '$2y$10$fATsEc2peQayMXqHxuAq.MX1G1Yz15lEfxyGE4zKUCIcFghUIRy', '2020-12-02 01:58:48', '2020-12-02 01:58:48', NULL, NULL),
	(40, 6, '$2y$10$EUluh04dBhERPqlVbQQFxetW7gOHw9euHoOv1wfdSXfHvBteTHC6', '2020-12-02 02:01:56', '2020-12-02 02:01:56', NULL, NULL),
	(41, 6, '$2y$10$XrFqBAB9GQfmANWJfZWkZ.oSbJ9SNwqsHnUFKhsKSQhBUTrpcEqa', '2020-12-02 02:02:13', '2020-12-02 02:02:13', NULL, NULL),
	(42, 6, '$2y$10$e2FwOcPUa1qvDkEQ.XYq.PuVM6AwPsNgIconXgALQYnSXOQ.3J.', '2020-12-02 02:10:35', '2020-12-02 02:10:35', NULL, NULL),
	(43, 6, '$2y$10$DWv5ScQwU1IoxkGtwZbtF.Ws7ZFNIKquLMZ7RDQkkZw80JMZ2N..G', '2020-12-02 02:12:44', '2020-12-02 02:12:44', NULL, NULL),
	(44, 6, '$2y$10$jjHG3hgOSIH91diRMedEpuZj.7WFoMWbGGu55b8TCL3NYymZ8ddqi', '2020-12-02 02:12:49', '2020-12-02 02:12:49', NULL, NULL),
	(45, 6, '$2y$10$MpBakZdaBosHSWW3Rmk3U.GCqJtOC0i0qJ6A5NIuVNyRZf8wnlc5y', '2020-12-02 02:12:55', '2020-12-02 02:12:55', NULL, NULL),
	(46, 6, '$2y$10$iV5.4Wj665SNWLu9RzV2OeDT2OyF2oCcPWRg7DRNFLkKOGEYY0Su', '2020-12-02 02:13:13', '2020-12-02 02:13:13', NULL, NULL),
	(47, 6, '$2y$10$6gH8fS4YVxYvaXz3axAIcO7W0ASbegssSPrFx6Qbx3naBYnhrh3C', '2020-12-02 02:13:17', '2020-12-02 02:13:17', NULL, NULL);
/*!40000 ALTER TABLE `marketing_lead_files` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_lead_meetings
CREATE TABLE IF NOT EXISTS `marketing_lead_meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lead` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attendees` text DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_lead_meetings: ~4 rows (approximately)
/*!40000 ALTER TABLE `marketing_lead_meetings` DISABLE KEYS */;
INSERT INTO `marketing_lead_meetings` (`id`, `id_lead`, `subject`, `description`, `attendees`, `start_time`, `duration`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `company_id`) VALUES
	(2, 4, 'Meeting Internal', 'asdsadas', '["a","b","c","d","e"]', '2020-11-30 13:33:00', 2, '2020-11-30 06:39:34', '2020-11-30 06:39:34', NULL, 'cypher', NULL, NULL, 1),
	(3, 4, 'Meeting Eksternal', 'asdasdasdas', '["asd","qwe","zxc"]', '2020-12-03 13:48:00', 2, '2020-11-30 06:48:25', '2020-11-30 06:48:25', NULL, 'cypher', NULL, NULL, 1),
	(4, 6, 'Meeting Internal', 'asdasd', '["a","s","v"]', '2020-12-02 09:00:00', 2, '2020-12-02 02:00:10', '2020-12-02 02:00:10', NULL, 'cypher', NULL, NULL, 1),
	(5, 6, 'Meeting Eksternal', 'asda', '["asd","zxc","qwe"]', '2020-12-05 09:02:00', 2, '2020-12-02 02:02:09', '2020-12-02 02:02:09', NULL, 'cypher', NULL, NULL, 1);
/*!40000 ALTER TABLE `marketing_lead_meetings` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_lead_notes
CREATE TABLE IF NOT EXISTS `marketing_lead_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_leads` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_ by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_lead_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_lead_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `marketing_lead_notes` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_lead_tasks
CREATE TABLE IF NOT EXISTS `marketing_lead_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lead` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.marketing_lead_tasks: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_lead_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `marketing_lead_tasks` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_projects
CREATE TABLE IF NOT EXISTS `marketing_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prj_code` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prj_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `value` bigint(20) DEFAULT NULL,
  `agreement_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agreement_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'internal',
  `transport` decimal(15,2) NOT NULL DEFAULT 0.00,
  `taxi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `airtax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_sim` int(11) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `ops_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ops_progress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ops_pic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mar_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mar_progress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mar_pic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ops_link` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wo_attach` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mar_link` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_category` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_subcost` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_tax` decimal(15,2) DEFAULT NULL,
  `list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prj_code` (`prj_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.marketing_projects: ~7 rows (approximately)
/*!40000 ALTER TABLE `marketing_projects` DISABLE KEYS */;
INSERT INTO `marketing_projects` (`id`, `prj_code`, `prj_name`, `id_client`, `value`, `agreement_number`, `agreement_title`, `prefix`, `address`, `currency`, `category`, `transport`, `taxi`, `rent`, `airtax`, `status`, `n_sim`, `start_time`, `end_time`, `ops_remark`, `ops_progress`, `ops_pic`, `mar_remark`, `mar_progress`, `mar_pic`, `ops_link`, `wo_attach`, `mar_link`, `to_category`, `view`, `view_subcost`, `actual_tax`, `list`, `del_list`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(1, '1', 'GENERAL AFFAIR', NULL, 10000000, '1', '1', 'GA', 'VESSEL TOWER', 'IDR', 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2020-11-10', '2021-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-12 02:07:34', NULL, NULL, NULL, '2020-11-12 02:07:34', NULL, 1),
	(2, '2', 'JASA SEWA ANGKUTAN UMUM', 1, 5000000, '1', '2', 'JSA', 'Jalan2', 'IDR', 'sales', 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2020-11-05', '2025-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-12 02:47:39', NULL, NULL, NULL, '2020-11-12 02:47:39', NULL, 1),
	(3, '3', 'dm', 2, 100000000, 'this is agreement', 'dasd', 'dm', 'Karangpawitan\r\nKawali', 'IDR', 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2020-11-17', '2022-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-23 06:56:09', NULL, NULL, NULL, '2020-11-23 06:56:09', NULL, 17),
	(4, '4', 'lorem hey', 1, NULL, NULL, NULL, 'LH', NULL, NULL, 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-23 15:11:41', NULL, NULL, NULL, '2020-11-23 15:11:41', NULL, 1),
	(6, '5', 'hgasf', 1, NULL, NULL, NULL, 'HGA', NULL, NULL, 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-25 04:04:44', NULL, NULL, NULL, '2020-11-25 04:04:44', NULL, 1),
	(7, '6', 'heho', 2, NULL, NULL, NULL, 'HEH', NULL, NULL, 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-30 07:03:33', NULL, NULL, NULL, '2020-11-30 07:03:33', NULL, 1),
	(8, '7', 'dasdsadasd', 1, NULL, NULL, NULL, 'DAS', NULL, NULL, 'cost', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 02:13:17', NULL, NULL, NULL, '2020-12-02 02:13:17', NULL, 1);
/*!40000 ALTER TABLE `marketing_projects` ENABLE KEYS */;

-- Dumping structure for table cypher4.marketing_subcost_detail
CREATE TABLE IF NOT EXISTS `marketing_subcost_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subcost` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_nota` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT 'IDR',
  `cashin` decimal(15,2) DEFAULT NULL,
  `cashout` decimal(15,2) DEFAULT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_string` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_int` int(4) DEFAULT NULL,
  `ceo_approve` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceo_approve_time` date DEFAULT NULL,
  `fin_approve` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin_approve_time` date DEFAULT NULL,
  `ops_approve` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ops_approve_time` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.marketing_subcost_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `marketing_subcost_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `marketing_subcost_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.mcu_log
CREATE TABLE IF NOT EXISTS `mcu_log` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mcu_id` int(50) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploader` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `upload_time` date NOT NULL,
  `mcu_date` date DEFAULT NULL,
  `mcu_remark` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mcu_expired` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.mcu_log: ~2 rows (approximately)
/*!40000 ALTER TABLE `mcu_log` DISABLE KEYS */;
INSERT INTO `mcu_log` (`id`, `mcu_id`, `name`, `uploader`, `address`, `upload_time`, `mcu_date`, `mcu_remark`, `mcu_expired`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'MCU 1', 'cypher', '$2y$10$BJQdGAfmVMPmOy9bH8MzevHoxspboWKZ0dlgWrNBAej43QC9kMC', '2020-11-17', '2020-11-17', 'sadas', '2020-11-19', '2020-11-17 13:50:18', '2020-11-17 13:50:18', NULL),
	(2, 1, 'IGOR', 'cypher', '$2y$10$UQsxb9eXNS8NLr75Nn2m.B2pjhmcfvnQ.QNu9UD7h1CbcJyqYOz6', '2020-11-17', '2020-11-11', 'asdas', '2021-06-17', '2020-11-17 13:51:15', '2020-11-17 13:51:15', NULL);
/*!40000 ALTER TABLE `mcu_log` ENABLE KEYS */;

-- Dumping structure for table cypher4.mcu_main
CREATE TABLE IF NOT EXISTS `mcu_main` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.mcu_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `mcu_main` DISABLE KEYS */;
INSERT INTO `mcu_main` (`id`, `emp_id`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 1, '2020-11-17 13:49:58', '2020-11-17 13:49:58', NULL, 1);
/*!40000 ALTER TABLE `mcu_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_11_09_033254_create_activity_log_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table cypher4.mtg_absence
CREATE TABLE IF NOT EXISTS `mtg_absence` (
  `id_absence` int(11) NOT NULL AUTO_INCREMENT,
  `id_main` int(100) DEFAULT NULL,
  `plan_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sig_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redir_id` int(100) DEFAULT NULL,
  `emp_position` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_absence`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.mtg_absence: ~0 rows (approximately)
/*!40000 ALTER TABLE `mtg_absence` DISABLE KEYS */;
INSERT INTO `mtg_absence` (`id_absence`, `id_main`, `plan_name`, `emp_name`, `sig_address`, `redir_id`, `emp_position`, `phone`, `email`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(6, 3, 'Student', 'Rangga Anggara', '2020_12_02_07_45_49_signature_Rangga Anggara.png', NULL, 'IT', '081214235971', 'ranggaanggara8@gmail.com', '2020-12-02 07:45:50', 'cypher', NULL, NULL, '2020-12-02 07:45:50', NULL, 1);
/*!40000 ALTER TABLE `mtg_absence` ENABLE KEYS */;

-- Dumping structure for table cypher4.mtg_main
CREATE TABLE IF NOT EXISTS `mtg_main` (
  `id_main` int(50) NOT NULL AUTO_INCREMENT,
  `id_rv_topic` int(50) DEFAULT 0,
  `topic` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_main` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `progress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'created',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.mtg_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `mtg_main` DISABLE KEYS */;
INSERT INTO `mtg_main` (`id_main`, `id_rv_topic`, `topic`, `location`, `date_main`, `date_end`, `progress`, `status`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(3, 0, 'blaster', 'indo', '2020-12-04 20:41:00', '2020-12-04 23:46:00', 'Done', 'created', '2020-12-02 07:41:38', 'cypher', NULL, NULL, '2020-12-02 07:46:15', NULL, 1),
	(4, 0, 'tracker', 'mt. takan', '2020-12-03 12:42:00', '2020-12-03 16:42:00', 'created', 'created', '2020-12-03 05:42:48', 'cypher', NULL, NULL, '2020-12-03 05:42:48', NULL, 1);
/*!40000 ALTER TABLE `mtg_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.mtg_mom
CREATE TABLE IF NOT EXISTS `mtg_mom` (
  `id_mom` int(50) NOT NULL AUTO_INCREMENT,
  `id_main` int(50) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `input_time` datetime DEFAULT NULL,
  `floor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mom`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.mtg_mom: ~0 rows (approximately)
/*!40000 ALTER TABLE `mtg_mom` DISABLE KEYS */;
INSERT INTO `mtg_mom` (`id_mom`, `id_main`, `content`, `pic`, `deadline`, `input_time`, `floor`, `pic2`, `created_at`, `created_by`, `deleted_at`, `deleted_by`, `updated_at`, `updated_by`, `company_id`) VALUES
	(3, 3, 'asdasdasda', 'asdasda', '2020-12-03', '2020-12-02 07:46:02', 'asdada', 'asdasdas', '2020-12-02 07:46:02', 'cypher', NULL, NULL, '2020-12-02 07:46:02', NULL, 1);
/*!40000 ALTER TABLE `mtg_mom` ENABLE KEYS */;

-- Dumping structure for table cypher4.new_category
CREATE TABLE IF NOT EXISTS `new_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.new_category: ~4 rows (approximately)
/*!40000 ALTER TABLE `new_category` DISABLE KEYS */;
INSERT INTO `new_category` (`id`, `id_parent`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
	(1, 0, 'Consumable', '2020-10-02 02:39:20', '2020-10-02 02:39:25', '2020-10-02 02:39:25', NULL, NULL, NULL),
	(2, 0, 'Transportation', '2020-10-05 08:07:50', '2020-10-05 08:07:50', NULL, NULL, NULL, NULL),
	(3, 2, 'Vehicle', '2020-10-05 08:08:08', '2020-10-05 08:08:08', NULL, NULL, NULL, NULL),
	(4, 0, 'ATK', '2020-11-12 02:18:30', '2020-11-12 02:18:30', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `new_category` ENABLE KEYS */;

-- Dumping structure for table cypher4.notification_rules
CREATE TABLE IF NOT EXISTS `notification_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_code` varchar(5) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `receivers` text DEFAULT NULL COMMENT 'JSON receiver positions',
  `created_at` text DEFAULT NULL,
  `updated_at` text DEFAULT NULL,
  `created_by` text DEFAULT NULL,
  `updated_by` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notification_code` (`notification_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.notification_rules: ~2 rows (approximately)
/*!40000 ALTER TABLE `notification_rules` DISABLE KEYS */;
INSERT INTO `notification_rules` (`id`, `notification_code`, `description`, `receivers`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, 'IRA', 'Approve Asset Item Request', '["1","2","5"]', '2020-10-15 16:52:02', '2020-10-15 16:52:02', NULL, NULL),
	(2, 'IRD', 'Approve Dricetor Item Requestasd sa', '["1","2","5"]', '2020-10-15 16:54:03', '2020-10-15 17:08:27', NULL, NULL);
/*!40000 ALTER TABLE `notification_rules` ENABLE KEYS */;

-- Dumping structure for table cypher4.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cypher4.policy_category
CREATE TABLE IF NOT EXISTS `policy_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_update_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.policy_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `policy_category` DISABLE KEYS */;
INSERT INTO `policy_category` (`id_category`, `name_category`, `created_by`, `last_update_by`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 'lorem', 'cypher', NULL, '2020-12-02 08:15:59', '2020-12-02 08:15:59', NULL, 1),
	(2, 'tester', 'cypher', NULL, '2020-12-02 08:16:06', '2020-12-02 08:16:06', NULL, 1);
/*!40000 ALTER TABLE `policy_category` ENABLE KEYS */;

-- Dumping structure for table cypher4.policy_detail
CREATE TABLE IF NOT EXISTS `policy_detail` (
  `id_detail` int(50) NOT NULL AUTO_INCREMENT,
  `id_policy_main` int(50) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_eng` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_detail` datetime DEFAULT NULL,
  `approved_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` date DEFAULT NULL,
  `acknowledge_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acknowledge_date` date DEFAULT NULL,
  `revision` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.policy_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `policy_detail` DISABLE KEYS */;
INSERT INTO `policy_detail` (`id_detail`, `id_policy_main`, `content`, `content_eng`, `created_by`, `attachment`, `date_detail`, `approved_by`, `approved_time`, `acknowledge_by`, `acknowledge_date`, `revision`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 1, '<p>dasdadadasd</p>', '<p>asdasdasda</p>', 'cypher', '2020_12_02_08_40_53_attachment_policy.png', '2020-12-02 08:40:53', 'cypher', '2020-12-02', 'cypher', '2020-12-02', '0', '2020-12-02 08:40:53', '2020-12-02 08:40:58', NULL, NULL),
	(2, 1, '<p>dasdadas</p>', '<p>asdasdaa</p>', 'cypher', '2020_12_02_08_46_33_attachment_policy.png', '2020-12-02 08:46:33', 'cypher', '2020-12-02', 'cypher', '2020-12-02', '1', '2020-12-02 08:46:33', '2020-12-02 08:46:37', NULL, NULL);
/*!40000 ALTER TABLE `policy_detail` ENABLE KEYS */;

-- Dumping structure for table cypher4.policy_main
CREATE TABLE IF NOT EXISTS `policy_main` (
  `id_main` int(50) NOT NULL AUTO_INCREMENT,
  `topic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_main` datetime DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `main_created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.policy_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `policy_main` DISABLE KEYS */;
INSERT INTO `policy_main` (`id_main`, `topic`, `location`, `date_main`, `category`, `main_created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 'blaster', 'operation', '2020-12-02 08:16:14', 1, 'cypher', NULL, '2020-12-02 08:16:14', '2020-12-02 08:16:14', NULL, 1);
/*!40000 ALTER TABLE `policy_main` ENABLE KEYS */;

-- Dumping structure for table cypher4.preference_config
CREATE TABLE IF NOT EXISTS `preference_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penalty_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty_stop` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period_end` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `absence_deduction` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thr_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `odorate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_amt1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_amt2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_amt3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_amt4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_amt5` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performa_end` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btl_col` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wo_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.preference_config: ~3 rows (approximately)
/*!40000 ALTER TABLE `preference_config` DISABLE KEYS */;
INSERT INTO `preference_config` (`id`, `penalty_amt`, `penalty_period`, `penalty_start`, `penalty_stop`, `period_start`, `period_end`, `absence_deduction`, `bonus_period`, `thr_period`, `odorate`, `overtime_period`, `overtime_start`, `overtime_amt`, `performa_period`, `performa_amt1`, `performa_amt2`, `performa_amt3`, `performa_amt4`, `performa_amt5`, `performa_start`, `performa_end`, `approval_start`, `btl_col`, `wo_signature`, `po_signature`, `to_signature`, `id_company`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '500', '1', '07:30:59', NULL, '2', '1', '30', '5', '08-20', '1.5', '4', '6', '8', '10', '12', '6', '8', '10', '12', '6', '8', NULL, '["nomor", "bank_acct", "thp", "emp_name"]', '71-Rangga Anggara', '1-Jokowi', '71-Rangga Anggara', 1, NULL, '2020-12-02 15:59:59', NULL),
	(2, '125', '1', '08:15', '18:00', '11', '10', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2020-10-12 08:13:55', '2020-10-12 08:14:21', NULL),
	(3, '500', '1', '07:30:59', NULL, '16', '15', '30', '5', '08-20', '1.5', '4', '6', '8', '10', '12', '6', '8', '10', '12', '6', '8', NULL, '["nomor", "bank_acct", "thp", "emp_name"]', NULL, NULL, NULL, 17, '2020-11-23 04:33:43', '2020-11-23 04:33:43', NULL);
/*!40000 ALTER TABLE `preference_config` ENABLE KEYS */;

-- Dumping structure for table cypher4.pref_activity_action
CREATE TABLE IF NOT EXISTS `pref_activity_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.pref_activity_action: ~6 rows (approximately)
/*!40000 ALTER TABLE `pref_activity_action` DISABLE KEYS */;
INSERT INTO `pref_activity_action` (`id`, `action_name`) VALUES
	(1, 'create'),
	(2, 'approve'),
	(3, 'approve_asset'),
	(4, 'approve_finance'),
	(5, 'approve_dir'),
	(6, 'approve_div');
/*!40000 ALTER TABLE `pref_activity_action` ENABLE KEYS */;

-- Dumping structure for table cypher4.pref_activity_label
CREATE TABLE IF NOT EXISTS `pref_activity_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `step` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.pref_activity_label: ~8 rows (approximately)
/*!40000 ALTER TABLE `pref_activity_label` DISABLE KEYS */;
INSERT INTO `pref_activity_label` (`id`, `name`, `step`) VALUES
	(1, 'fr', '["create","approve_div","approve_asset"]'),
	(2, 'so', '["create","approve_div"]'),
	(3, 'cashbond', '["create","approve","approve_div"]'),
	(4, 'reimburse', '["create","approve_dir","approve_finance"]'),
	(5, 'to', '["create","approve"]'),
	(7, 'meeting_scheduler', '["create"]'),
	(8, 'performa_review', '["create","approve"]'),
	(10, 'mom', '["create"]');
/*!40000 ALTER TABLE `pref_activity_label` ENABLE KEYS */;

-- Dumping structure for table cypher4.pref_activity_point
CREATE TABLE IF NOT EXISTS `pref_activity_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modul` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.pref_activity_point: ~17 rows (approximately)
/*!40000 ALTER TABLE `pref_activity_point` DISABLE KEYS */;
INSERT INTO `pref_activity_point` (`id`, `id_modul`, `action`, `point`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 1, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(2, 1, 'approve_asset', 30, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(3, 1, 'approve_div', 60, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(4, 2, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(5, 2, 'approve_div', 60, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(6, 3, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(7, 3, 'approve', 20, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(8, 3, 'approve_div', 60, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(9, 4, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(10, 4, 'approve_finance', 40, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(11, 4, 'approve_dir', 50, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(12, 5, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(13, 5, 'approve', 20, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(14, 7, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(15, 8, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(16, 8, 'approve', 20, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1),
	(17, 10, 'create', 10, '2020-12-14 06:42:45', 'cypher', '2020-12-14 06:43:18', 'cypher', NULL, NULL, 1);
/*!40000 ALTER TABLE `pref_activity_point` ENABLE KEYS */;

-- Dumping structure for table cypher4.pref_tax_config
CREATE TABLE IF NOT EXISTS `pref_tax_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `formula` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `conflict_with` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.pref_tax_config: ~3 rows (approximately)
/*!40000 ALTER TABLE `pref_tax_config` DISABLE KEYS */;
INSERT INTO `pref_tax_config` (`id`, `tax_name`, `formula`, `conflict_with`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'PPN 10%', '$sum * 0.1', '["2","3"]', 'rnggara', '2020-07-08 13:59:06', 'rnggara', '2020-07-08 14:29:19', NULL, NULL, 1),
	(2, 'PPH23', '$sum * 0.5', '["3"]', 'rnggara', '2020-07-08 14:12:53', 'rnggara', '2020-07-08 14:31:47', NULL, NULL, 1),
	(3, 'PBB', '$sum * 0.2', '["1"]', 'rnggara', '2020-07-08 14:13:50', 'rnggara', '2020-07-16 17:04:35', NULL, NULL, 1);
/*!40000 ALTER TABLE `pref_tax_config` ENABLE KEYS */;

-- Dumping structure for table cypher4.product_type
CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.product_type: ~15 rows (approximately)
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` (`id`, `type_name`) VALUES
	(1, 'Fitting'),
	(2, 'Piping'),
	(3, 'Electrical'),
	(4, 'Consumable'),
	(5, 'Civil Material'),
	(6, 'Print & Merchandising'),
	(7, 'Interior'),
	(8, 'Office Appliances'),
	(9, 'Forwarder'),
	(10, 'Contactor'),
	(11, 'Civil Work'),
	(12, 'Service'),
	(13, 'Safety Material'),
	(14, 'Convection'),
	(15, 'Sparepart');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;

-- Dumping structure for table cypher4.record
CREATE TABLE IF NOT EXISTS `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `id_emp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.record: ~18 rows (approximately)
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
INSERT INTO `record` (`id`, `tanggal`, `jam`, `id_emp`) VALUES
	(1, '2020-08-28', '08:01:12', 2202),
	(2, '2020-08-28', '08:01:40', 2202),
	(3, '2020-08-28', '11:02:15', 2202),
	(4, '2020-08-28', '11:05:28', 2203),
	(5, '2020-08-28', '11:07:48', 2202),
	(6, '2020-08-28', '13:01:33', 2202),
	(7, '2020-08-28', '13:15:50', 2203),
	(8, '2020-08-28', '15:10:40', 2202),
	(9, '2020-08-28', '16:32:01', 2203),
	(10, '2020-08-29', '08:01:12', 2202),
	(11, '2020-08-29', '08:01:40', 2202),
	(12, '2020-08-29', '11:02:15', 2202),
	(13, '2020-08-29', '11:05:28', 2203),
	(14, '2020-08-29', '11:07:48', 2202),
	(15, '2020-08-29', '13:01:33', 2202),
	(16, '2020-08-29', '13:15:50', 2203),
	(17, '2020-08-29', '15:10:40', 2202),
	(18, '2020-08-29', '16:32:01', 2203);
/*!40000 ALTER TABLE `record` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_actions
CREATE TABLE IF NOT EXISTS `rms_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rms_actions: ~7 rows (approximately)
/*!40000 ALTER TABLE `rms_actions` DISABLE KEYS */;
INSERT INTO `rms_actions` (`id`, `name`, `desc`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 'access', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'create', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'read', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'update', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'approvedlvl1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'approvedlvl2', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `rms_actions` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_divisions
CREATE TABLE IF NOT EXISTS `rms_divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rms_divisions: ~5 rows (approximately)
/*!40000 ALTER TABLE `rms_divisions` DISABLE KEYS */;
INSERT INTO `rms_divisions` (`id`, `id_company`, `name`, `desc`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 1, 'HRD', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 1, 'Finance', NULL, NULL, NULL, '2020-10-12 09:47:42', NULL, '2020-10-12 09:47:42', NULL),
	(4, 1, 'Asset', NULL, NULL, NULL, '2020-10-12 09:47:48', NULL, '2020-10-12 09:47:48', NULL),
	(5, 1, 'Operation', '-', NULL, NULL, '2020-11-13 04:40:51', NULL, '2020-11-13 04:40:51', NULL);
/*!40000 ALTER TABLE `rms_divisions` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_modules
CREATE TABLE IF NOT EXISTS `rms_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rms_modules: ~5 rows (approximately)
/*!40000 ALTER TABLE `rms_modules` DISABLE KEYS */;
INSERT INTO `rms_modules` (`id`, `name`, `desc`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 'general', 'menu general on prtal', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'fr', 'item request', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'frwaiting', 'item request waiting', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'frbank', 'item request that has been approved', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'frrejected', 'item request that has been rejected', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `rms_modules` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_roles
CREATE TABLE IF NOT EXISTS `rms_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'username',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rms_roles: ~6 rows (approximately)
/*!40000 ALTER TABLE `rms_roles` DISABLE KEYS */;
INSERT INTO `rms_roles` (`id`, `id_company`, `name`, `desc`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 1, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 1, 'Manager', NULL, NULL, NULL, '2020-10-12 09:47:55', NULL, '2020-10-12 09:47:55', NULL),
	(4, 1, 'Director', NULL, NULL, NULL, '2020-10-12 09:48:16', NULL, '2020-10-12 09:48:16', NULL),
	(5, 1, 'Vice Director', NULL, NULL, NULL, '2020-10-12 09:57:08', NULL, '2020-10-12 09:57:08', NULL),
	(6, 1, 'operator', NULL, NULL, NULL, '2020-10-12 17:31:46', NULL, '2020-10-12 17:31:46', NULL);
/*!40000 ALTER TABLE `rms_roles` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_roles_divisions
CREATE TABLE IF NOT EXISTS `rms_roles_divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `id_rms_roles_divisions_parent` int(11) DEFAULT NULL,
  `id_rms_roles` int(11) DEFAULT NULL,
  `id_rms_divisions` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='roles of divisions';

-- Dumping data for table cypher4.rms_roles_divisions: ~10 rows (approximately)
/*!40000 ALTER TABLE `rms_roles_divisions` DISABLE KEYS */;
INSERT INTO `rms_roles_divisions` (`id`, `id_company`, `id_rms_roles_divisions_parent`, `id_rms_roles`, `id_rms_divisions`, `name`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, NULL, 1, 1, 'admin admin', NULL, NULL, '2020-10-10 14:00:06', NULL, '2020-10-10 14:00:06', NULL),
	(2, 1, NULL, 4, 2, 'Director HRD', NULL, NULL, '2020-10-10 14:02:37', NULL, '2020-10-12 09:48:39', NULL),
	(3, 1, 2, 3, 2, 'Manager HRD', NULL, NULL, '2020-10-12 09:48:50', NULL, '2020-10-12 09:48:50', NULL),
	(4, 1, 3, 2, 2, 'staff HRD', NULL, NULL, '2020-10-12 09:49:03', NULL, '2020-10-12 09:49:03', NULL),
	(5, 1, NULL, 4, 3, 'Director Finance', NULL, NULL, '2020-10-12 09:56:45', NULL, '2020-10-12 09:56:45', NULL),
	(6, 1, 2, 5, 2, 'Vice Director HRD', NULL, NULL, '2020-10-12 09:57:23', NULL, '2020-10-12 09:57:23', NULL),
	(7, 1, 5, 3, 3, 'Manager Finance', NULL, NULL, '2020-10-12 17:30:51', NULL, '2020-10-12 17:30:51', NULL),
	(8, 1, 7, 2, 3, 'staff Finance', NULL, NULL, '2020-10-12 17:31:04', NULL, '2020-10-12 17:31:04', NULL),
	(9, 1, 2, 6, 2, 'operator HRD', '2020-10-12 17:32:07', NULL, '2020-10-12 17:31:55', NULL, '2020-10-12 17:32:07', NULL),
	(10, 1, 3, 6, 2, 'operator HRD', NULL, NULL, '2020-10-12 17:32:16', NULL, '2020-10-12 17:32:16', NULL);
/*!40000 ALTER TABLE `rms_roles_divisions` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_roles_privileges
CREATE TABLE IF NOT EXISTS `rms_roles_privileges` (
  `id_rms_roles_divisions` int(11) DEFAULT NULL,
  `id_rms_modules` int(11) DEFAULT NULL,
  `id_rms_actions` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='privileges of roles';

-- Dumping data for table cypher4.rms_roles_privileges: ~2 rows (approximately)
/*!40000 ALTER TABLE `rms_roles_privileges` DISABLE KEYS */;
INSERT INTO `rms_roles_privileges` (`id_rms_roles_divisions`, `id_rms_modules`, `id_rms_actions`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 1, 2, NULL, NULL, '2020-10-10 14:21:24', NULL, '2020-10-10 14:21:24', NULL),
	(1, 1, 3, NULL, NULL, '2020-10-10 14:21:24', NULL, '2020-10-10 14:21:24', NULL);
/*!40000 ALTER TABLE `rms_roles_privileges` ENABLE KEYS */;

-- Dumping structure for table cypher4.rms_users_privileges
CREATE TABLE IF NOT EXISTS `rms_users_privileges` (
  `id_users` int(11) DEFAULT NULL,
  `id_rms_modules` int(11) DEFAULT NULL,
  `id_rms_actions` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='rms_user + rms_module + rms_action';

-- Dumping data for table cypher4.rms_users_privileges: ~49 rows (approximately)
/*!40000 ALTER TABLE `rms_users_privileges` DISABLE KEYS */;
INSERT INTO `rms_users_privileges` (`id_users`, `id_rms_modules`, `id_rms_actions`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 2, 1, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 2, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 3, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 4, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 5, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 6, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 2, 7, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 1, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 2, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 3, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 4, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 5, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 6, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 4, 7, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 1, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 2, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 3, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 4, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 5, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 6, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 5, 7, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 1, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 2, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 3, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 4, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 5, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 6, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 3, 7, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 1, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 2, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 3, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 4, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 5, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 6, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(1, 1, 7, NULL, NULL, '2020-10-19 03:36:38', NULL, '2020-10-19 03:36:38', NULL),
	(5, 1, 2, NULL, NULL, '2020-11-09 04:06:25', NULL, '2020-11-09 04:06:25', NULL),
	(5, 1, 3, NULL, NULL, '2020-11-09 04:06:25', NULL, '2020-11-09 04:06:25', NULL),
	(6, 1, 2, NULL, NULL, '2020-11-09 04:10:09', NULL, '2020-11-09 04:10:09', NULL),
	(6, 1, 3, NULL, NULL, '2020-11-09 04:10:09', NULL, '2020-11-09 04:10:09', NULL),
	(8, 1, 2, NULL, NULL, '2020-11-27 08:21:07', NULL, '2020-11-27 08:21:07', NULL),
	(8, 1, 3, NULL, NULL, '2020-11-27 08:21:07', NULL, '2020-11-27 08:21:07', NULL),
	(7, 1, 2, NULL, NULL, '2020-11-27 08:21:13', NULL, '2020-11-27 08:21:13', NULL),
	(7, 1, 3, NULL, NULL, '2020-11-27 08:21:13', NULL, '2020-11-27 08:21:13', NULL),
	(9, 1, 2, NULL, NULL, '2020-11-27 08:21:35', NULL, '2020-11-27 08:21:35', NULL),
	(9, 1, 3, NULL, NULL, '2020-11-27 08:21:35', NULL, '2020-11-27 08:21:35', NULL),
	(10, 1, 2, NULL, NULL, '2020-11-27 08:21:57', NULL, '2020-11-27 08:21:57', NULL),
	(10, 1, 3, NULL, NULL, '2020-11-27 08:21:57', NULL, '2020-11-27 08:21:57', NULL),
	(11, 1, 2, NULL, NULL, '2020-11-27 08:23:04', NULL, '2020-11-27 08:23:04', NULL),
	(11, 1, 3, NULL, NULL, '2020-11-27 08:23:04', NULL, '2020-11-27 08:23:04', NULL);
/*!40000 ALTER TABLE `rms_users_privileges` ENABLE KEYS */;

-- Dumping structure for table cypher4.rv_absensi
CREATE TABLE IF NOT EXISTS `rv_absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kehadiran` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rv_absensi: ~0 rows (approximately)
/*!40000 ALTER TABLE `rv_absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `rv_absensi` ENABLE KEYS */;

-- Dumping structure for table cypher4.rv_book
CREATE TABLE IF NOT EXISTS `rv_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_masuk` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_keluar` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rv_book: ~0 rows (approximately)
/*!40000 ALTER TABLE `rv_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `rv_book` ENABLE KEYS */;

-- Dumping structure for table cypher4.rv_room
CREATE TABLE IF NOT EXISTS `rv_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rv_room: ~0 rows (approximately)
/*!40000 ALTER TABLE `rv_room` DISABLE KEYS */;
INSERT INTO `rv_room` (`id`, `nama_ruangan`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `company_id`) VALUES
	(1, 'tes', '2020-12-14 08:44:56', 'cypher', '2020-12-14 08:44:56', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `rv_room` ENABLE KEYS */;

-- Dumping structure for table cypher4.rv_time_check
CREATE TABLE IF NOT EXISTS `rv_time_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) DEFAULT NULL,
  `id_book` int(11) DEFAULT NULL,
  `id_topic` int(11) DEFAULT NULL,
  `topic_meeting` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rv_time_check: ~0 rows (approximately)
/*!40000 ALTER TABLE `rv_time_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `rv_time_check` ENABLE KEYS */;

-- Dumping structure for table cypher4.rv_topic
CREATE TABLE IF NOT EXISTS `rv_topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `id_book` int(11) DEFAULT NULL,
  `topic_meeting` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projek` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemimpin_meeting` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id_pemimpin` int(11) DEFAULT NULL,
  `notulen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id_notulen` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kehadiran_pemimpin_meeting` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kehadiran_notulen` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_pemimpin_meeting` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_notulen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id_topic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.rv_topic: ~0 rows (approximately)
/*!40000 ALTER TABLE `rv_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `rv_topic` ENABLE KEYS */;

-- Dumping structure for table cypher4.template_files
CREATE TABLE IF NOT EXISTS `template_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file_code` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.template_files: ~0 rows (approximately)
/*!40000 ALTER TABLE `template_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `template_files` ENABLE KEYS */;

-- Dumping structure for table cypher4.te_equipment_list
CREATE TABLE IF NOT EXISTS `te_equipment_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(50) NOT NULL DEFAULT '0',
  `subject` varchar(50) NOT NULL DEFAULT '0',
  `description` text DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `param1` varchar(50) DEFAULT '0',
  `param2` varchar(200) DEFAULT '0',
  `thumbnail` text DEFAULT NULL,
  `drawing` text DEFAULT NULL,
  `data_sheet` mediumtext DEFAULT NULL,
  `last_use` date DEFAULT NULL,
  `last_maintenance` date DEFAULT NULL,
  `hydro_test` date DEFAULT NULL,
  `function_test` date DEFAULT NULL,
  `coi` text DEFAULT NULL,
  `coi_expiry` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `additional_information` text DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.te_equipment_list: ~0 rows (approximately)
/*!40000 ALTER TABLE `te_equipment_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `te_equipment_list` ENABLE KEYS */;

-- Dumping structure for table cypher4.te_equipment_list_category
CREATE TABLE IF NOT EXISTS `te_equipment_list_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.te_equipment_list_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `te_equipment_list_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `te_equipment_list_category` ENABLE KEYS */;

-- Dumping structure for table cypher4.te_pd
CREATE TABLE IF NOT EXISTS `te_pd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `diameter_separator` varchar(200) DEFAULT NULL,
  `capacity_oil` varchar(200) DEFAULT NULL,
  `capacity_water` varchar(200) DEFAULT NULL,
  `capacity_gas` varchar(200) DEFAULT NULL,
  `retention_time` varchar(200) DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `drawing` text DEFAULT NULL,
  `list_pfd` mediumtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.te_pd: ~0 rows (approximately)
/*!40000 ALTER TABLE `te_pd` DISABLE KEYS */;
/*!40000 ALTER TABLE `te_pd` ENABLE KEYS */;

-- Dumping structure for table cypher4.te_pd_category
CREATE TABLE IF NOT EXISTS `te_pd_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cypher4.te_pd_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `te_pd_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `te_pd_category` ENABLE KEYS */;

-- Dumping structure for table cypher4.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `id_rms_roles_divisions` int(11) DEFAULT 0 COMMENT 'default 0 = other',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `company_id`, `id_rms_roles_divisions`, `name`, `email`, `position`, `user_img`, `access`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Administrator', 'admin@cypher.com', NULL, NULL, NULL, 'cypher', NULL, '$2y$10$hqzIGbf1OGSizdxXvJlWPO3DBSR2JWEgnhi8D.WRLEjpJ9agdvHl6', NULL, '2020-09-17 20:32:40', '2020-10-15 02:32:44'),
	(7, 1, 1, 'Rakai Wastu Demos', 'rakai@mail.com', NULL, NULL, NULL, 'rakai', NULL, '$2y$10$eU603KwcnD8fU0dxDpZlr.0ikNvQwoARkBQif4LlJ1xMatXncjObm', NULL, '2020-11-27 08:20:36', '2020-11-27 08:21:13'),
	(8, 1, 1, 'Denissa Nuragusti', 'denissa@mail.com', NULL, NULL, NULL, 'denissa', NULL, '$2y$10$0wS2sbOWX4R8MARkvl9NVen5O55bBJUOUWZeFVmbjlKcgpkP4t4by', NULL, '2020-11-27 08:21:07', '2020-11-27 08:21:07'),
	(9, 1, 1, 'Muhammad Fauzi Fikrillah Harahap', 'fauzi@mail.com', NULL, NULL, NULL, 'fauzi', NULL, '$2y$10$FEPWj/eA51cmb4UHVSgErelicOg.ZAJUrSUSNafVPXekrAeC5Aecq', NULL, '2020-11-27 08:21:35', '2020-11-27 08:21:35'),
	(10, 1, 1, 'Fiana Shabira', 'fia@mail.com', NULL, NULL, NULL, 'fia', NULL, '$2y$10$bRxgOo6EE105JVohd8IyzOUw7jE9rldTiO/CKmjxLpzZK0DW09Kua', NULL, '2020-11-27 08:21:57', '2020-11-27 08:21:57'),
	(11, 1, 1, 'Fanggie Deeva Clarista', 'fanggie@mail.com', NULL, NULL, NULL, 'fanggie', NULL, '$2y$10$Y1K.xN7sMGTbNx03Onp2KeOb5Rcq/hQuk1WXPAjnpZKf2gZtHrkNm', NULL, '2020-11-27 08:23:04', '2020-11-27 08:23:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cypher4.util_decree_main
CREATE TABLE IF NOT EXISTS `util_decree_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_form` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cypher4.util_decree_main: ~0 rows (approximately)
/*!40000 ALTER TABLE `util_decree_main` DISABLE KEYS */;
INSERT INTO `util_decree_main` (`id`, `author`, `title`, `deskripsi`, `class`, `file_form`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
	(1, 'cypher', 'LOREM', 'sdads', 'sss', '$2y$10$Pa8LTkItg4xSKLUZ.xwfeTtqvsBbGYWxXcELgJd9vrBgDWSYKCTK', '2020-11-17 13:47:59', '2020-11-17 13:47:59', NULL, 1);
/*!40000 ALTER TABLE `util_decree_main` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
