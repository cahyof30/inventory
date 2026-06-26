-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table inventory.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.cache: ~2 rows (approximately)
INSERT IGNORE INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-livewire-rate-limiter:a03482d47b45acecfdd4da52d94a0986080d88b3', 'i:1;', 1782477202),
	('laravel-cache-livewire-rate-limiter:a03482d47b45acecfdd4da52d94a0986080d88b3:timer', 'i:1782477202;', 1782477202);

-- Dumping structure for table inventory.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.cache_locks: ~0 rows (approximately)

-- Dumping structure for table inventory.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_slug_unique` (`slug`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.companies: ~4 rows (approximately)
INSERT IGNORE INTO `companies` (`id`, `slug`, `code`, `company_name`, `logo`, `created_at`, `updated_at`) VALUES
	(1, 'SGM', 'SGM', 'PT. Sentra Gemilang Mulia', 'company-logos/01KSVM7EHF4XRYW7X53QH1EQYP.png', '2026-02-22 20:57:21', '2026-05-29 22:03:07'),
	(2, 'TJKS', 'TJKS', 'PT. Ternak Jaya Keluarga Sentosa', 'company-logos/01KSVMB9Q231AZ8SENCFVYXAHC.png', '2026-02-22 20:57:55', '2026-05-29 22:05:13'),
	(3, 'SRT', 'SRAT', 'PT. Sumber Rejeki Aneka Transport', 'company-logos/01KT35AJZ27PTM4E7EEAFKXMAG.png', '2026-02-22 20:58:32', '2026-06-01 20:16:37'),
	(4, 'GSL', 'GSL', 'PT. Gemilang Satwa Lestari', NULL, '2026-02-22 20:58:52', '2026-02-22 20:58:52');

-- Dumping structure for table inventory.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint unsigned DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_code_unique` (`code`),
  KEY `departments_location_id_foreign` (`location_id`),
  CONSTRAINT `departments_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.departments: ~0 rows (approximately)

-- Dumping structure for table inventory.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `styles` json DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.divisions: ~8 rows (approximately)
INSERT IGNORE INTO `divisions` (`id`, `slug`, `name`, `styles`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'PROD', 'Produksi', '{"bg_color": "#f0fdf4", "text_color": "#166534", "border_color": "#bbf7d0"}', NULL, '2026-06-25 08:56:18', '2026-06-25 08:56:18'),
	(2, 'MAR', 'Marketing', '{"bg_color": "#fff7ed", "text_color": "#9a3412", "border_color": "#ffedd5"}', NULL, '2026-06-25 08:56:49', '2026-06-25 08:56:49'),
	(3, 'HRGA', 'HR GA & Legal', '{"bg_color": "#ecfeff", "text_color": "#0f766e", "border_color": "#cffafe"}', NULL, '2026-06-25 08:57:04', '2026-06-25 08:57:04'),
	(4, 'PRLG', 'Purchasing, Logistik, dan Distribusi', '{"bg_color": "#fef3c7", "text_color": "#78350f", "border_color": "#fde68a"}', NULL, '2026-06-25 08:57:31', '2026-06-25 08:57:32'),
	(5, 'FAT', 'Finance, Accounting, and Tax', '{"bg_color": "#eff6ff", "text_color": "#1e40af", "border_color": "#dbeafe"}', NULL, '2026-06-25 08:58:02', '2026-06-25 08:58:03'),
	(6, 'IT', 'Information & Technology', '{"bg_color": "#e0e7ff", "text_color": "#3730a3", "border_color": "#c7d2fe"}', NULL, '2026-06-25 08:58:21', '2026-06-25 08:58:21'),
	(7, 'IA', 'Internal Audit', '{"bg_color": "#fef2f2", "text_color": "#991b1b", "border_color": "#fee2e2"}', NULL, '2026-06-25 08:58:38', '2026-06-25 08:58:38'),
	(8, 'PRJ', 'Proyek', '{"bg_color": "#f8fafc", "text_color": "#334155", "border_color": "#e2e8f0"}', NULL, '2026-06-25 09:04:54', '2026-06-25 09:04:55');

-- Dumping structure for table inventory.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table inventory.ip_bans
CREATE TABLE IF NOT EXISTS `ip_bans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_attempts` int NOT NULL DEFAULT '0',
  `banned_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_bans_ip_unique` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.ip_bans: ~0 rows (approximately)

-- Dumping structure for table inventory.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `public_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `item_type` enum('fixed_asset','consumable') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'fixed_asset',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_id` bigint unsigned DEFAULT NULL,
  `posted_by` bigint unsigned DEFAULT NULL,
  `purchase_price` decimal(15,2) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `condition` enum('good','broken') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code` text COLLATE utf8mb4_unicode_ci,
  `barcode` text COLLATE utf8mb4_unicode_ci,
  `location_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `specification` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `items_code_unique` (`code`),
  UNIQUE KEY `items_public_uuid_unique` (`public_uuid`),
  KEY `items_category_id_foreign` (`category_id`),
  KEY `FK_items_companies` (`company_id`),
  KEY `FK_items_locations` (`location_id`),
  KEY `FK_items_users` (`pic_id`) USING BTREE,
  KEY `FK_items_users_2` (`posted_by`),
  CONSTRAINT `FK_items_companies` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_items_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_items_users` FOREIGN KEY (`pic_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_items_users_2` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.items: ~179 rows (approximately)
INSERT IGNORE INTO `items` (`id`, `public_uuid`, `code`, `company_id`, `category_id`, `item_type`, `name`, `brand`, `pic_id`, `posted_by`, `purchase_price`, `purchase_date`, `condition`, `stock`, `image`, `qr_code`, `barcode`, `location_id`, `description`, `specification`, `created_at`, `updated_at`) VALUES
	(319, '2f0cab95-b9d3-4edb-a0cf-4616b93de41d', 'SGM-PE-I-2026-02', 1, 2, 'fixed_asset', 'AC ', 'Sharp', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/2f0cab95-b9d3-4edb-a0cf-4616b93de41d', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(320, 'fd02fc5b-d90e-448d-b923-40e33e65de23', 'SGM-PE-I-2026-03', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', 24, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/fd02fc5b-d90e-448d-b923-40e33e65de23', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(321, '1b69c5ca-4db7-4607-a0be-51e6bbfa9110', 'SGM-PE-I-2026-05', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'Lenovo', 39, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/1b69c5ca-4db7-4607-a0be-51e6bbfa9110', NULL, 1, NULL, '{"seri": "All in One"}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(322, '3d61075b-0709-4be3-b961-904d900e7bd4', 'SGM-PE-I-2026-06', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/3d61075b-0709-4be3-b961-904d900e7bd4', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(323, '9d946e86-e5dc-47c3-8e3c-2989ee41b432', 'SGM-PE-I-2026-07', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9d946e86-e5dc-47c3-8e3c-2989ee41b432', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(324, 'c0ec2774-4942-4ddf-a9ce-0ae7f0232f95', 'SGM-PE-I-2026-08', 1, 2, 'fixed_asset', 'Laptop ', 'Acer', 26, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c0ec2774-4942-4ddf-a9ce-0ae7f0232f95', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(325, '8d6a685e-ea94-4e30-89f4-c18dab3dfeb7', 'SGM-PE-I-2026-09', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'Lenovo', 28, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/8d6a685e-ea94-4e30-89f4-c18dab3dfeb7', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(326, '899dbd2f-529b-494c-9083-dc0810383786', 'SGM-PE-I-2026-10', 1, 2, 'fixed_asset', 'Laptop ', 'Asus Vivo book', 27, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/899dbd2f-529b-494c-9083-dc0810383786', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(327, '02967bdd-1d15-4ba8-a97b-61e8d299b3ba', 'SGM-PE-I-2026-11', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', 41, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/02967bdd-1d15-4ba8-a97b-61e8d299b3ba', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(328, 'aebc8073-53ef-4ab8-86d1-11f1bb54af24', 'SGM-PE-I-2026-12', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'HP', 42, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/aebc8073-53ef-4ab8-86d1-11f1bb54af24', NULL, 1, NULL, '{"seri": "All in One"}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(329, '8224d6c3-7093-4b55-827a-47ef22608efb', 'SGM-PE-I-2026-13', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'HP', 40, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/8224d6c3-7093-4b55-827a-47ef22608efb', NULL, 1, NULL, '{"seri": "All in One"}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(330, '84874afe-95d5-47d8-9a14-34ba26b31289', 'SGM-PE-I-2026-14', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, NULL, NULL, NULL, 'broken', 1, NULL, 'http://localhost:81/scan/84874afe-95d5-47d8-9a14-34ba26b31289', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(331, '7a97b91d-e6e7-4625-95e2-df575ee6ee27', 'SGM-PE-I-2026-15', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', 28, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7a97b91d-e6e7-4625-95e2-df575ee6ee27', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(332, '756dfe5f-42e2-4129-b84f-53c3361b52c7', 'SGM-PE-I-2026-16', 1, 2, 'fixed_asset', 'Laptop ', 'Vaio Sony', NULL, NULL, NULL, NULL, 'broken', 1, NULL, 'http://localhost:81/scan/756dfe5f-42e2-4129-b84f-53c3361b52c7', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(333, '0d2e76ad-0a03-48e3-9291-d32a269a155c', 'SGM-PE-I-2026-17', 1, 2, 'fixed_asset', 'Laptop ', 'Chrome', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0d2e76ad-0a03-48e3-9291-d32a269a155c', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(334, 'fc11d04c-c593-41e7-88b7-d165ea390180', 'SGM-PE-I-2026-18', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', 29, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/fc11d04c-c593-41e7-88b7-d165ea390180', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(335, 'fef8beaa-efa3-4a3d-a40d-5ad3611816ed', 'SGM-PE-I-2026-19', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', 30, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/fef8beaa-efa3-4a3d-a40d-5ad3611816ed', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(336, '9af32914-1a2f-47cc-83fa-2b9fadd00bec', 'SGM-PE-I-2026-20', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'Rakitan', 43, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9af32914-1a2f-47cc-83fa-2b9fadd00bec', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(337, '6ae0e456-9fd8-48ca-91fd-c2acfc909cca', 'SGM-PE-I-2026-21', 1, 2, 'fixed_asset', 'Printer', 'HP', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6ae0e456-9fd8-48ca-91fd-c2acfc909cca', NULL, 1, NULL, '{"seri": "Ink Tank Wireless 415"}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(338, 'a7c75ee5-f14d-44aa-a632-b8527362e1cb', 'SGM-PE-I-2026-22', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a7c75ee5-f14d-44aa-a632-b8527362e1cb', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(339, '61a20f41-36d8-4c1d-b9c0-361b226ab580', 'SGM-PE-I-2026-23', 1, 2, 'fixed_asset', 'Monitor dan CPU', 'Redmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/61a20f41-36d8-4c1d-b9c0-361b226ab580', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(340, 'ca8d2d71-58dd-4433-82a8-959c1fbe6f74', 'SGM-PE-I-2026-24', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo V14', 32, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/ca8d2d71-58dd-4433-82a8-959c1fbe6f74', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(341, 'ac53d9fc-1cad-4412-b801-4d25c0f07156', 'SGM-PE-I-2026-25', 1, 2, 'fixed_asset', 'Laptop ', 'Acer', 33, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/ac53d9fc-1cad-4412-b801-4d25c0f07156', NULL, 1, NULL, '{"seri": "Aspire 15"}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(342, '576dc3c7-d479-4666-946d-d3e4b161c414', 'SGM-PE-I-2026-26', 1, 2, 'fixed_asset', 'Monitor ', 'Lg', 31, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/576dc3c7-d479-4666-946d-d3e4b161c414', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:45', '2026-06-25 20:45:45'),
	(343, '4409b64c-ed8f-4f93-8aec-4658dd1a4630', 'SGM-PE-I-2026-27', 1, 2, 'fixed_asset', 'CPU', 'CPU Rakitan ', 31, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/4409b64c-ed8f-4f93-8aec-4658dd1a4630', NULL, 1, NULL, '{"seri": "Core i3 Gen 10"}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(344, 'c6999b28-8f50-4e92-919e-13ae4d24ce67', 'SGM-PE-I-2026-28', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', 39, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c6999b28-8f50-4e92-919e-13ae4d24ce67', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(345, '2991e2d2-0270-49dd-9002-aa306057e961', 'SGM-PE-I-2026-29', 1, 2, 'fixed_asset', 'Monitor ', 'Samsung', 45, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/2991e2d2-0270-49dd-9002-aa306057e961', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(346, 'c983a32f-4c09-4bb6-8199-4fe92c9b59e8', 'SGM-PE-I-2026-30', 1, 2, 'fixed_asset', 'CPU', 'Acer', 45, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c983a32f-4c09-4bb6-8199-4fe92c9b59e8', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(347, '782bba08-4cc9-484d-b775-c058df30a22c', 'SGM-PE-I-2026-31', 1, 2, 'fixed_asset', 'Monitor ', 'Samsung', 38, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/782bba08-4cc9-484d-b775-c058df30a22c', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(348, '17f37492-b22c-4683-9261-9ee275a4ee0b', 'SGM-PE-I-2026-32', 1, 2, 'fixed_asset', 'CPU', 'Rakitan', 38, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/17f37492-b22c-4683-9261-9ee275a4ee0b', NULL, 1, NULL, '{"seri": "Ryzen 5500"}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(349, '5f19be72-037a-472c-af7a-fe8452c7d3ae', 'SGM-PE-I-2026-33', 1, 2, 'fixed_asset', 'Monitor ', 'Asus', 34, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/5f19be72-037a-472c-af7a-fe8452c7d3ae', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(350, '4c59825c-b6aa-45f5-8896-20d84fb87627', 'SGM-PE-I-2026-34', 1, 2, 'fixed_asset', 'Monitor ', 'Samsung', 35, NULL, NULL, NULL, 'broken', 1, NULL, 'http://localhost:81/scan/4c59825c-b6aa-45f5-8896-20d84fb87627', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(351, '1b7f6f92-f1ad-4e08-9890-a6a1bbfdfa2a', 'SGM-PE-I-2026-35', 1, 2, 'fixed_asset', 'CPU', 'Rakitan ', 35, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/1b7f6f92-f1ad-4e08-9890-a6a1bbfdfa2a', NULL, 1, NULL, '{"seri": "Athlon 3000"}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(352, '9dfac58a-3fbe-47a9-af01-4bd56cd76f80', 'SGM-PE-I-2026-36', 1, 2, 'fixed_asset', 'Penghancur Kertas', 'Deli', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9dfac58a-3fbe-47a9-af01-4bd56cd76f80', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(353, 'b1019d72-103b-454e-b007-e0212df1a0fd', 'SGM-PE-I-2026-37', 1, 2, 'fixed_asset', 'Printer', 'HP', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b1019d72-103b-454e-b007-e0212df1a0fd', NULL, 1, NULL, '{"seri": "Ink Tank Wireless 415"}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(354, '7de2b940-6dec-4835-8930-4c1e750b8ad3', 'SGM-PE-I-2026-38', 1, 2, 'fixed_asset', 'Printer', 'Epson', NULL, NULL, NULL, NULL, 'broken', 1, NULL, 'http://localhost:81/scan/7de2b940-6dec-4835-8930-4c1e750b8ad3', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(355, '6aa41509-aef9-4d7e-9a2f-139ea2579fcd', 'SGM-PE-I-2026-39', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6aa41509-aef9-4d7e-9a2f-139ea2579fcd', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(356, '1d74f4a7-652d-4d76-a422-17a813b3f6fa', 'SGM-PE-I-2026-40', 1, 2, 'fixed_asset', 'TV LED', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/1d74f4a7-652d-4d76-a422-17a813b3f6fa', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(357, '8ad7e391-e6d9-4147-95bc-07ee237ae445', 'SGM-PE-I-2026-41', 1, 2, 'fixed_asset', 'AC ', 'Daikin', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/8ad7e391-e6d9-4147-95bc-07ee237ae445', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(358, 'c33e6f54-3b13-4f8b-a4fd-b6c9f4de150c', 'SGM-PE-I-2026-42', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', 35, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c33e6f54-3b13-4f8b-a4fd-b6c9f4de150c', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(359, '606b5daa-cb4b-436b-99a2-b75e697323f7', 'SGM-PE-I-2026-43', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', 36, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/606b5daa-cb4b-436b-99a2-b75e697323f7', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(360, '0e8ca0ea-33de-4f95-9118-64c1be045b61', 'SGM-PE-I-2026-44', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', 37, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0e8ca0ea-33de-4f95-9118-64c1be045b61', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(361, 'bc73cf08-3a84-49f0-9733-9bbbfca3cd20', 'SGM-PE-I-2026-45', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/bc73cf08-3a84-49f0-9733-9bbbfca3cd20', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(362, 'c0b81587-08a1-4610-80b5-a07794990097', 'SGM-PE-I-2026-46', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'broken', 1, NULL, 'http://localhost:81/scan/c0b81587-08a1-4610-80b5-a07794990097', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(363, '34483176-ffb4-4938-98a1-cf7c22b6980d', 'SGM-PE-I-2026-47', 1, 2, 'fixed_asset', 'Monitor dan CPU ', 'Asus', 42, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/34483176-ffb4-4938-98a1-cf7c22b6980d', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(364, 'a32f627f-216f-455b-8a9b-4076e4c2f621', 'SGM-PE-I-2026-48', 1, 2, 'fixed_asset', 'HP', 'Redmi', 31, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a32f627f-216f-455b-8a9b-4076e4c2f621', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(365, '3af321d5-e1d9-4dd3-aef7-8fe51d65fcd1', 'SGM-PE-I-2026-49', 1, 2, 'fixed_asset', 'HP', 'Redmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/3af321d5-e1d9-4dd3-aef7-8fe51d65fcd1', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(366, '1c3952c9-9eba-4564-8070-90808f5fe1ef', 'SGM-PE-I-2026-50', 1, 2, 'fixed_asset', 'HP', 'Redmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/1c3952c9-9eba-4564-8070-90808f5fe1ef', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(367, '5bfa639b-e843-4abb-9d8c-94a9679f2e6f', 'SGM-PE-I-2026-51', 1, 2, 'fixed_asset', 'HP', 'Redmi 12', 45, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/5bfa639b-e843-4abb-9d8c-94a9679f2e6f', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(368, 'af93f74f-6ce6-41c4-8a62-845360788b97', 'SGM-PE-I-2026-52', 1, 2, 'fixed_asset', 'HP', 'Redmi 15 c', 28, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/af93f74f-6ce6-41c4-8a62-845360788b97', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(369, '60ed9264-c263-4273-ad66-022a21d6e2f5', 'SGM-PE-I-2026-53', 1, 2, 'fixed_asset', 'HP', 'Oppo A3', 37, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/60ed9264-c263-4273-ad66-022a21d6e2f5', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(370, '6dc83a4d-69fc-477c-a4e2-4279ab7efdb8', 'SGM-PE-I-2026-54', 1, 2, 'fixed_asset', 'HP', 'Redmi 15 c', 35, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6dc83a4d-69fc-477c-a4e2-4279ab7efdb8', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(371, '205db4bc-0f76-44b1-8f27-4a51cb8f88ce', 'SGM-PE-I-2026-55', 1, 2, 'fixed_asset', 'HP', 'Redmi', 38, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/205db4bc-0f76-44b1-8f27-4a51cb8f88ce', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(372, '9952acfa-b90e-4f12-bb95-50897cff923d', 'SGM-PE-I-2026-56', 1, 2, 'fixed_asset', 'HP', 'Samsung A17', 27, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9952acfa-b90e-4f12-bb95-50897cff923d', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(373, '73f49088-0226-4981-816c-0d691454c425', 'SGM-PE-I-2026-57', 1, 2, 'fixed_asset', 'HP', 'Redmi', 42, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/73f49088-0226-4981-816c-0d691454c425', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(374, '57ed43c8-e377-4307-80a6-b4b63cbfd907', 'SGM-PE-I-2026-58', 1, 2, 'fixed_asset', 'HP', 'Redmi', 40, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/57ed43c8-e377-4307-80a6-b4b63cbfd907', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(375, 'b3970043-ec6e-45f7-a8d3-48c36f8000d5', 'SGM-PE-I-2026-59', 1, 2, 'fixed_asset', 'HP', 'Redmi', 30, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b3970043-ec6e-45f7-a8d3-48c36f8000d5', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(376, 'e1eb8abb-46f3-46b9-b044-03c3c944c838', 'SGM-PE-I-2026-60', 1, 2, 'fixed_asset', 'HP', 'Redmi', 43, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e1eb8abb-46f3-46b9-b044-03c3c944c838', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(377, 'e42526d6-6ee7-4d92-b662-aae21cc68f8a', 'SGM-PE-I-2026-61', 1, 2, 'fixed_asset', 'HP', 'Redmi', 48, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e42526d6-6ee7-4d92-b662-aae21cc68f8a', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(378, 'c18960b7-6db8-48be-b906-7e8359141417', 'SGM-PE-I-2026-62', 1, 2, 'fixed_asset', 'HP', 'Redmi', 49, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c18960b7-6db8-48be-b906-7e8359141417', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(379, 'cb7262fb-9eda-4f7d-b379-7af465cf20b3', 'SGM-PE-I-2026-63', 1, 2, 'fixed_asset', 'HP', 'Redmi', 50, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/cb7262fb-9eda-4f7d-b379-7af465cf20b3', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(380, '89a9e4d3-7653-4f75-82f5-1e99d8ecd43c', 'SGM-PE-I-2026-64', 1, 2, 'fixed_asset', 'HP', 'Redmi', 25, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/89a9e4d3-7653-4f75-82f5-1e99d8ecd43c', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(381, 'ac3d2fdd-9732-403f-ba4d-c1a130dd7f09', 'SGM-PE-I-2026-65', 1, 2, 'fixed_asset', 'HP', 'Redmi 14 c', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/ac3d2fdd-9732-403f-ba4d-c1a130dd7f09', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(382, '0de052fc-7b20-4133-a210-17fd0419b5b5', 'SGM-PE-I-2026-66', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0de052fc-7b20-4133-a210-17fd0419b5b5', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(383, 'b3adbf52-0f04-42d0-ad0f-e3d484b59938', 'SGM-PE-I-2026-67', 1, 2, 'fixed_asset', 'Timbangan DOC', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b3adbf52-0f04-42d0-ad0f-e3d484b59938', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(384, 'e2c4e355-a641-4197-9c5e-5613654b962c', 'SGM-PE-I-2026-68', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e2c4e355-a641-4197-9c5e-5613654b962c', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(385, '6ddf6c98-9962-4282-a7d8-c4c883f4e600', 'SGM-PE-I-2026-69', 1, 2, 'fixed_asset', 'Timbangan Digital', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6ddf6c98-9962-4282-a7d8-c4c883f4e600', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(386, '561d2406-9ba6-4cc6-9ee5-83dd4719924d', 'SGM-PE-I-2026-70', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/561d2406-9ba6-4cc6-9ee5-83dd4719924d', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(387, 'fa8fa3f3-7d8f-4739-8f3e-0b990fbe7741', 'SGM-PE-I-2026-71', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/fa8fa3f3-7d8f-4739-8f3e-0b990fbe7741', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(388, '47d84b87-f09f-445a-94bd-348a0ced68c2', 'SGM-PE-I-2026-72', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/47d84b87-f09f-445a-94bd-348a0ced68c2', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(389, 'a1e61f91-9763-48f1-af14-1545a50bf6f3', 'SGM-PE-I-2026-73', 1, 2, 'fixed_asset', 'Timbangan DOC', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a1e61f91-9763-48f1-af14-1545a50bf6f3', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(390, '0e6a40cd-20b9-4d81-9842-3607ac61e61a', 'SGM-PE-I-2026-74', 1, 2, 'fixed_asset', 'Timbangan DOC', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0e6a40cd-20b9-4d81-9842-3607ac61e61a', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(391, 'f990eefb-70ad-4172-96d9-24317bb0bf96', 'SGM-PE-I-2026-75', 1, 2, 'fixed_asset', 'HP', 'Redmi', 39, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/f990eefb-70ad-4172-96d9-24317bb0bf96', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(392, '83627563-2798-41da-8bc6-4c22a8ba5fae', 'SGM-PE-I-2026-76', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/83627563-2798-41da-8bc6-4c22a8ba5fae', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(393, 'c8c90d2d-0c12-4a95-9fe8-fd97fd02f951', 'SGM-PE-I-2026-77', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c8c90d2d-0c12-4a95-9fe8-fd97fd02f951', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(394, 'a72afbd3-dd17-4219-a52d-ef2082c29406', 'SGM-PE-I-2026-78', 1, 2, 'fixed_asset', 'CPU', 'Rakitan', 34, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a72afbd3-dd17-4219-a52d-ef2082c29406', NULL, 1, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(395, '48693435-05a8-4d3e-a2f0-2d5643b54e4a', 'SGM-PE-I-2026-79', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/48693435-05a8-4d3e-a2f0-2d5643b54e4a', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(396, 'f152af03-1175-4267-84f0-32d3185c0c6e', 'SGM-PE-I-2026-80', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/f152af03-1175-4267-84f0-32d3185c0c6e', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(397, 'f65b1b44-38c9-47be-8a3f-562ba36252f4', 'SGM-PE-I-2026-81', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/f65b1b44-38c9-47be-8a3f-562ba36252f4', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(398, 'e14073d0-76e3-44b1-b71d-865ce15f294c', 'SGM-PE-I-2026-82', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e14073d0-76e3-44b1-b71d-865ce15f294c', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(399, 'a3d05540-e5ea-4649-8eab-2fdfe3066646', 'SGM-PE-I-2026-83', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a3d05540-e5ea-4649-8eab-2fdfe3066646', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(400, '966b831d-f68b-42f5-a65c-88a2196f1007', 'SGM-PE-I-2026-84', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/966b831d-f68b-42f5-a65c-88a2196f1007', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(401, '4eb707a1-3d5e-4665-879c-ad1fa3fdb7e3', 'SGM-PE-I-2026-85', 1, 2, 'fixed_asset', 'UPS', 'Prolink', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/4eb707a1-3d5e-4665-879c-ad1fa3fdb7e3', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(402, '8fbaa485-1347-486d-97f6-5dc2fc059581', 'SGM-PE-I-2026-86', 1, 2, 'fixed_asset', 'Mesin Fotocopy', 'canon', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/8fbaa485-1347-486d-97f6-5dc2fc059581', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(403, '8903981e-4f4e-4208-9205-523b7f91feeb', 'SGM-PE-I-2026-87', 1, 2, 'fixed_asset', 'HP', 'Readmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/8903981e-4f4e-4208-9205-523b7f91feeb', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(404, '715ec940-4609-4fce-9ded-dc23201a307b', 'SGM-PE-I-2026-88', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/715ec940-4609-4fce-9ded-dc23201a307b', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(405, 'c2373b44-b212-4842-a1b9-3ed54139ac62', 'SGM-PE-I-2026-89', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c2373b44-b212-4842-a1b9-3ed54139ac62', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(406, 'ea4e45e6-bd28-4973-8a0f-87db27d5953d', 'SGM-PE-I-2026-90', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/ea4e45e6-bd28-4973-8a0f-87db27d5953d', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(407, '09697a78-a6da-4d09-b91f-38e31a63ca61', 'SGM-PE-I-2026-91', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, 34, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/09697a78-a6da-4d09-b91f-38e31a63ca61', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(408, '3822ce59-0b27-4a27-aab8-42c80d23aa35', 'SGM-PE-I-2026-92', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/3822ce59-0b27-4a27-aab8-42c80d23aa35', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(409, '5af4be57-6efe-47d0-a7a7-ad063a514fbf', 'SGM-PE-I-2026-93', 1, 2, 'fixed_asset', 'Timbangan Digital', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/5af4be57-6efe-47d0-a7a7-ad063a514fbf', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(410, '7dddbbb5-f51f-4005-9853-829eeebb6a9c', 'SGM-PE-I-2026-94', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7dddbbb5-f51f-4005-9853-829eeebb6a9c', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(411, '9ff4b36e-f8eb-4f42-98ee-64db030dad74', 'SGM-PE-I-2026-95', 1, 2, 'fixed_asset', 'HP', 'Redmi 9C', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9ff4b36e-f8eb-4f42-98ee-64db030dad74', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(412, '81a397b3-28bd-43d9-a663-f4f4f6dc7883', 'SGM-PE-I-2026-96', 1, 2, 'fixed_asset', 'HP', 'Redmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/81a397b3-28bd-43d9-a663-f4f4f6dc7883', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(413, '7309eb9b-56fb-4995-ae39-07a90f045e6d', 'SGM-PE-I-2026-97', 1, 2, 'fixed_asset', 'TV LED', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7309eb9b-56fb-4995-ae39-07a90f045e6d', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(414, '64ee3df9-4df2-4533-8a74-479468e6934f', 'SGM-PE-I-2026-98', 1, 2, 'fixed_asset', 'TV LED', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/64ee3df9-4df2-4533-8a74-479468e6934f', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(415, 'dc01e238-5873-4829-87f8-4249ee233232', 'SGM-PE-I-2026-99', 1, 2, 'fixed_asset', 'Dispenser', 'Modena', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/dc01e238-5873-4829-87f8-4249ee233232', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(416, 'bfd77196-0c47-44f4-ab3a-31d79f67bc80', 'SGM-PE-I-2026-100', 1, 2, 'fixed_asset', 'Kulkas', 'Sharp', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/bfd77196-0c47-44f4-ab3a-31d79f67bc80', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(417, '604f7230-cc4b-422a-845a-ce615f416f05', 'SGM-PE-I-2026-101', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/604f7230-cc4b-422a-845a-ce615f416f05', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(418, 'fb7c9f5b-6d3a-4242-90c8-75f049ff0e77', 'SGM-PE-I-2026-102', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/fb7c9f5b-6d3a-4242-90c8-75f049ff0e77', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(419, 'e8bac5a2-5929-473f-835f-ce8787bd685e', 'SGM-PE-I-2026-103', 1, 2, 'fixed_asset', 'AC ', 'Daikin', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e8bac5a2-5929-473f-835f-ce8787bd685e', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(420, 'ed233712-2fc9-4574-8431-0ad8b3ca06d7', 'SGM-PE-I-2026-104', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/ed233712-2fc9-4574-8431-0ad8b3ca06d7', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(421, '5a11a394-2eb7-4940-a6a6-28c81db849b8', 'SGM-PE-I-2026-105', 1, 2, 'fixed_asset', 'TV LED', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/5a11a394-2eb7-4940-a6a6-28c81db849b8', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(422, '13b491d5-b013-4924-8e74-23898ba0f934', 'SGM-PE-I-2026-106', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/13b491d5-b013-4924-8e74-23898ba0f934', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(423, '9ed0864c-452c-4ab9-abdf-e17d30b01a9f', 'SGM-PE-I-2026-107', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9ed0864c-452c-4ab9-abdf-e17d30b01a9f', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(424, 'f62a858b-b81d-48c7-b1da-ee0a11d72374', 'SGM-PE-I-2026-108', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/f62a858b-b81d-48c7-b1da-ee0a11d72374', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(425, '7d86672d-9969-4ab0-8a39-e6c2f7f5870e', 'SGM-PE-I-2026-109', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, 34, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7d86672d-9969-4ab0-8a39-e6c2f7f5870e', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(426, 'd63ebe76-f0de-40bf-8698-a6d87ce3c804', 'SGM-PE-I-2026-110', 1, 2, 'fixed_asset', 'Timbangan Sayur', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/d63ebe76-f0de-40bf-8698-a6d87ce3c804', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(427, '6e1c9b93-bb5f-42e3-90cb-c1efd06cf3b1', 'SGM-PE-I-2026-111', 1, 2, 'fixed_asset', 'Printer', 'HP', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6e1c9b93-bb5f-42e3-90cb-c1efd06cf3b1', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(428, '62b0edf3-f043-45b6-aede-f0ec1587d4a0', 'SGM-PE-I-2026-112', 1, 2, 'fixed_asset', 'AC ', 'Daikin', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/62b0edf3-f043-45b6-aede-f0ec1587d4a0', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(429, 'b3c5d7d8-8300-4dce-a7db-ed69eefbf2ff', 'SGM-PE-I-2026-113', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b3c5d7d8-8300-4dce-a7db-ed69eefbf2ff', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(430, '55cfe52c-4940-41c9-8422-1a43bad23078', 'SGM-PE-I-2026-114', 1, 2, 'fixed_asset', 'AC ', 'Daikin', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/55cfe52c-4940-41c9-8422-1a43bad23078', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(431, 'dd6a6e91-4dec-41f1-afd3-319409c871d3', 'SGM-PE-I-2026-115', 1, 2, 'fixed_asset', 'AC ', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/dd6a6e91-4dec-41f1-afd3-319409c871d3', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(432, 'bd2390b8-b554-4bc8-8d8c-4db6f1aea1cb', 'SGM-PE-I-2026-116', 1, 2, 'fixed_asset', 'mesin penghitung uang', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/bd2390b8-b554-4bc8-8d8c-4db6f1aea1cb', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(433, '3be1bc61-67a0-423c-bdc6-d230749a37c3', 'SGM-PE-I-2026-117', 1, 2, 'fixed_asset', 'Kipas Berdiri', 'Rinnai', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/3be1bc61-67a0-423c-bdc6-d230749a37c3', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(434, 'b820eff7-cc1a-4e02-8630-8a95ac41ed4a', 'SGM-PE-I-2026-118', 1, 2, 'fixed_asset', 'Kipas Tempel', 'Miyako', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b820eff7-cc1a-4e02-8630-8a95ac41ed4a', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(435, '6110850e-6ec1-484d-a940-ebfea4825436', 'SGM-PE-I-2026-119', 1, 2, 'fixed_asset', 'Kulkas', 'Sharp', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6110850e-6ec1-484d-a940-ebfea4825436', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(436, 'e1504569-c9b8-4565-9281-a1c0f9a223c6', 'SGM-PE-I-2026-120', 1, 2, 'fixed_asset', 'Magic com', 'Vitara', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e1504569-c9b8-4565-9281-a1c0f9a223c6', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(437, '9c96ddeb-42f1-4d73-9269-6f86641f5ee4', 'SGM-PE-I-2026-121', 1, 2, 'fixed_asset', 'Dispenser', 'Vitara', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9c96ddeb-42f1-4d73-9269-6f86641f5ee4', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(438, 'c9acfbad-6efe-400c-a735-5b9b1e5e3524', 'SGM-PE-I-2026-122', 1, 2, 'fixed_asset', 'Exhoust', 'CKE', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c9acfbad-6efe-400c-a735-5b9b1e5e3524', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(439, '7f6b1f17-9cb4-4c21-addb-9eeb5262ff80', 'SGM-PE-I-2026-123', 1, 2, 'fixed_asset', 'Exhoust', 'CKE', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7f6b1f17-9cb4-4c21-addb-9eeb5262ff80', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(440, '72cce8f5-f453-4bc9-9f4b-804dbd7437d2', 'SGM-PE-I-2026-124', 1, 2, 'fixed_asset', 'Hp', 'Redmi 14 c', 49, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/72cce8f5-f453-4bc9-9f4b-804dbd7437d2', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(441, '7c726511-6a1c-4d66-aa87-618ccc79bfa4', 'SGM-PE-I-2026-125', 1, 2, 'fixed_asset', 'Hp', 'Redmi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7c726511-6a1c-4d66-aa87-618ccc79bfa4', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(442, '4d0de614-95c9-4fce-a1b1-cfec896a93a8', 'SGM-PE-I-2026-126', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/4d0de614-95c9-4fce-a1b1-cfec896a93a8', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:46', '2026-06-25 20:45:46'),
	(443, '5d401268-2256-4aa8-8851-2cc417755841', 'SGM-PE-I-2026-127', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/5d401268-2256-4aa8-8851-2cc417755841', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(444, '814dbe4a-465a-4e3d-9b73-827dd421d62d', 'SGM-PE-I-2026-128', 1, 2, 'fixed_asset', 'Timbangan Gantung', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/814dbe4a-465a-4e3d-9b73-827dd421d62d', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(445, '6534b3f5-d789-43ef-8da9-1cfa43c3893c', 'SGM-PE-I-2026-129', 1, 2, 'fixed_asset', 'CCTV', 'Techma', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6534b3f5-d789-43ef-8da9-1cfa43c3893c', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(446, 'a37c7da0-75b1-4783-aadb-7108a8df7995', 'SGM-PE-I-2026-130', 1, 2, 'fixed_asset', 'CCTV', 'Techma', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a37c7da0-75b1-4783-aadb-7108a8df7995', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(447, '2692322f-1e84-4c47-8233-61379d0fd00e', 'SGM-PE-I-2026-131', 1, 2, 'fixed_asset', 'CCTV', 'Techma', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/2692322f-1e84-4c47-8233-61379d0fd00e', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(448, 'b880c759-32df-4adc-b3a3-337652fa96e2', 'SGM-PE-I-2026-132', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b880c759-32df-4adc-b3a3-337652fa96e2', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(449, '2019de8c-67bc-465a-894e-3976894c7b34', 'SGM-PE-I-2026-133', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/2019de8c-67bc-465a-894e-3976894c7b34', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(450, '880e7de2-eded-4e41-8903-c83b5794a9c2', 'SGM-PE-I-2026-134', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/880e7de2-eded-4e41-8903-c83b5794a9c2', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(451, '7bacdc21-ac73-4fca-aa57-375d92e14ab6', 'SGM-PE-I-2026-135', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7bacdc21-ac73-4fca-aa57-375d92e14ab6', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(452, 'b4a0bd2e-bbd3-4b90-bd35-862e1c41eff4', 'SGM-PE-I-2026-136', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b4a0bd2e-bbd3-4b90-bd35-862e1c41eff4', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(453, '6b8fafe3-86ad-402b-ad21-d5d7175cf8fc', 'SGM-PE-I-2026-137', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/6b8fafe3-86ad-402b-ad21-d5d7175cf8fc', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(454, 'a68b5b10-da65-4e3c-9f2b-790c41e93a7d', 'SGM-PE-I-2026-138', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a68b5b10-da65-4e3c-9f2b-790c41e93a7d', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(455, '0a0701df-93f8-4bb1-8407-1c81874d37c7', 'SGM-PE-I-2026-139', 1, 2, 'fixed_asset', 'CCTV', 'One Tech', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0a0701df-93f8-4bb1-8407-1c81874d37c7', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(456, '9da8b58f-d7f4-4e3c-b3a8-1297eba97da0', 'SGM-PE-I-2026-140', 1, 2, 'fixed_asset', 'Kulkas', 'LG', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/9da8b58f-d7f4-4e3c-b3a8-1297eba97da0', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(457, '86aab6d1-baa1-4b87-bb13-982d470062c7', 'SGM-PE-I-2026-141', 1, 2, 'fixed_asset', 'Timbangan Gantung', 'Weiheng WH-AO8', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/86aab6d1-baa1-4b87-bb13-982d470062c7', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(458, 'e37513a6-cefc-470e-86f7-0ac40788e516', 'SGM-PE-I-2026-142', 1, 2, 'fixed_asset', 'Timbangan Gantung', 'Weiheng WH-AO8', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e37513a6-cefc-470e-86f7-0ac40788e516', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(459, 'f28d1251-74a1-4ff2-93a5-faf3701733b6', 'SGM-PE-I-2026-143', 1, 2, 'fixed_asset', 'Timbangan Gantung', 'Weiheng WH-AO8', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/f28d1251-74a1-4ff2-93a5-faf3701733b6', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(460, 'feca64be-4b24-408d-8640-f9ee4daeeec4', 'SGM-PE-I-2026-144', 1, 2, 'fixed_asset', 'Timbangan Gantung', 'Weiheng WH-AO8', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/feca64be-4b24-408d-8640-f9ee4daeeec4', NULL, NULL, NULL, '{"seri": null}', '2026-06-25 20:45:47', '2026-06-25 20:45:47'),
	(530, 'e5414c67-eff6-4055-a90b-60eb7744d735', 'SGM-KD-2026-01', 1, 1, 'fixed_asset', 'Mobil Truck ', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e5414c67-eff6-4055-a90b-60eb7744d735', NULL, 2, NULL, '{"seri": "Center FE 74 HD N 4X2 MT "}', '2026-06-26 00:17:11', '2026-06-26 00:17:11'),
	(531, '419e5c17-3bee-4785-b78e-255bd8a45298', 'SGM-KD-2026-02', 1, 1, 'fixed_asset', 'Mobil Truck ', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/419e5c17-3bee-4785-b78e-255bd8a45298', NULL, 2, NULL, '{"seri": "Center FE 74 HD N 4X2 MT "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(532, 'eebc6fab-3fc7-4199-b57e-b87c9e26ba27', 'SRT-KD-2026-03', 3, 1, 'fixed_asset', 'Mobil Truck ', NULL, NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/eebc6fab-3fc7-4199-b57e-b87c9e26ba27', NULL, 2, NULL, '{"seri": "Center FE 74 HD N 4X2 MT "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(533, 'b1e129cb-763c-494a-b409-07f4881c3ce2', 'SRT-KD-2026-04', 3, 1, 'fixed_asset', 'Mobil ', 'MPV', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b1e129cb-763c-494a-b409-07f4881c3ce2', NULL, 2, NULL, '{"seri": "Sigra"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(534, 'a0d49d5e-066c-4940-9c74-0c4347a15078', 'SRT-KD-2026-05', 3, 1, 'fixed_asset', 'Mobil ', 'Daihatsu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a0d49d5e-066c-4940-9c74-0c4347a15078', NULL, 2, NULL, '{"seri": "Granmax 1.5 2018"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(535, '630e8642-9ad8-4a55-bcd0-57a702f36fc1', 'SRT-KD-2026-06', 3, 1, 'fixed_asset', 'Mobil ', 'Daihatsu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/630e8642-9ad8-4a55-bcd0-57a702f36fc1', NULL, 2, NULL, '{"seri": "Granmax 1.5 2023"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(536, '23eac9b5-0897-41fb-bd1a-9afccf41d7dd', 'SRT-KD-2026-07', 3, 1, 'fixed_asset', 'Mobil ', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/23eac9b5-0897-41fb-bd1a-9afccf41d7dd', NULL, NULL, NULL, '{"seri": "CRV"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(537, '0540f0f9-4221-408a-bc88-db016211b3ea', 'SRT-KD-2026-08', 3, 1, 'fixed_asset', 'Mobil   ', 'Innova', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0540f0f9-4221-408a-bc88-db016211b3ea', NULL, NULL, NULL, '{"seri": "Zenix"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(538, 'd5186ac1-c65d-46da-8017-3ad39bc88192', 'SRT-KD-2026-09', 3, 1, 'fixed_asset', 'Mobil  ', 'Isuzu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/d5186ac1-c65d-46da-8017-3ad39bc88192', NULL, 2, NULL, '{"seri": "Traga Pick Up FD "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(539, 'd6cda842-9246-46b6-ad67-c69715a4b35b', 'SRT-KD-2026-10', 3, 1, 'fixed_asset', 'Mobil  ', 'Hyundai', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/d6cda842-9246-46b6-ad67-c69715a4b35b', NULL, NULL, NULL, '{"seri": "SANTA FE"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(540, '28409276-a635-43c9-ae3f-e59465c30dc8', 'SRT-KD-2026-11', 3, 1, 'fixed_asset', 'Mobil  ', 'Isuzu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/28409276-a635-43c9-ae3f-e59465c30dc8', NULL, 2, NULL, '{"seri": "Traga Pick Up FD "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(541, 'db9273a5-203e-4322-b27e-4624f01c46ff', 'SRT-KD-2026-12', 3, 1, 'fixed_asset', 'Mobil  ', 'Isuzu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/db9273a5-203e-4322-b27e-4624f01c46ff', NULL, 2, NULL, '{"seri": "Traga Pick Up FD "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(542, 'a3417136-dbe5-4034-a9c7-410218ca907d', 'SRT-KD-2026-13', 3, 1, 'fixed_asset', 'Mobil  ', 'Isuzu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/a3417136-dbe5-4034-a9c7-410218ca907d', NULL, 2, NULL, '{"seri": "Traga Pick Up FD "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(543, '018f4ffd-8d2a-4fa8-b03f-3aefe03033a7', 'SRT-KD-2026-14', 3, 1, 'fixed_asset', 'Mobil  ', 'Isuzu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/018f4ffd-8d2a-4fa8-b03f-3aefe03033a7', NULL, 2, NULL, '{"seri": "Traga Pick Up FD "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(544, 'b8a96856-08b2-4f56-bd30-a464bbb684af', 'SRT-KD-2026-15', 3, 1, 'fixed_asset', 'Mobil  ', 'Mitsubishi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/b8a96856-08b2-4f56-bd30-a464bbb684af', NULL, 2, NULL, '{"seri": "L300"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(545, 'd178fb74-a329-453d-bc4b-a2b8aa6598b2', 'SGM-KD-2026-16', 1, 1, 'fixed_asset', 'Mobil Truk ', 'Mitsubishi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/d178fb74-a329-453d-bc4b-a2b8aa6598b2', NULL, 2, NULL, '{"seri": null}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(546, '3472d67e-8b21-48e0-96a6-1df12469f743', 'SRT-KD-2026-17', 3, 1, 'fixed_asset', 'Mobil Pick Up  ', 'Daihatsu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/3472d67e-8b21-48e0-96a6-1df12469f743', NULL, NULL, NULL, '{"seri": 2016}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(547, '58e33d0e-56ce-40a8-aca3-7165a35849bc', 'SGM-KD-2026-18', 1, 1, 'fixed_asset', 'Mobil Pick Up', 'Daihatsu', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/58e33d0e-56ce-40a8-aca3-7165a35849bc', NULL, 2, NULL, '{"seri": 2017}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(548, '7be28435-a308-4a42-a555-89d271183010', 'SGM-KD-2026-19', 1, 1, 'fixed_asset', 'Mobil  ', 'Toyota', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7be28435-a308-4a42-a555-89d271183010', NULL, NULL, NULL, '{"seri": "Avanza"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(549, '1979290b-e612-461e-bd60-f48eff4dba26', 'SRT-KD-2026-20', 3, 1, 'fixed_asset', 'Mobil ', 'Toyota', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/1979290b-e612-461e-bd60-f48eff4dba26', NULL, NULL, NULL, '{"seri": "Avanza"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(550, '10cbc982-8896-46d0-b986-1e5bf023d386', 'SRT-KD-2026-21', 3, 1, 'fixed_asset', 'Mobil', 'Toyota', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/10cbc982-8896-46d0-b986-1e5bf023d386', NULL, NULL, NULL, '{"seri": "Avanza"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(551, '2c679e1c-4089-4fd2-bd24-f33a59a2e674', 'SRT-KD-2026-22', 1, 1, 'fixed_asset', 'Mobil ', 'Mitsubishi', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/2c679e1c-4089-4fd2-bd24-f33a59a2e674', NULL, NULL, NULL, '{"seri": "Pajero"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(552, 'e32d1df3-fb9b-49aa-8307-b497e76a9a92', 'SRT-KD-2026-23', 1, 1, 'fixed_asset', 'Mobil', 'Hyundai', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/e32d1df3-fb9b-49aa-8307-b497e76a9a92', NULL, NULL, NULL, '{"seri": "Creta"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(553, '7225a922-2352-4dd1-a21d-09ca8c02e64e', 'SRT-KD-2026-24', 3, 1, 'fixed_asset', 'Motor bebek', 'Yamaha ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/7225a922-2352-4dd1-a21d-09ca8c02e64e', NULL, NULL, NULL, '{"seri": "Aerox   "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(554, 'c400d56a-eddc-44d5-b4a2-54f1819c7ee5', 'SRT-KD-2026-25', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda  ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/c400d56a-eddc-44d5-b4a2-54f1819c7ee5', NULL, NULL, NULL, '{"seri": "Vario"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(555, '653a751d-387e-420b-8485-39ceeff12b5c', 'SRT-KD-2026-26', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/653a751d-387e-420b-8485-39ceeff12b5c', NULL, NULL, NULL, '{"seri": "vario"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(556, '68fadde0-0bf6-41f3-adc0-33bf6e0c4a49', 'SRT-KD-2026-27', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/68fadde0-0bf6-41f3-adc0-33bf6e0c4a49', NULL, NULL, NULL, '{"seri": "Beat Street 2018"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(557, '111be1ce-9534-460d-9a12-73f6e573b5b0', 'SRT-KD-2026-28', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/111be1ce-9534-460d-9a12-73f6e573b5b0', NULL, NULL, NULL, '{"seri": "Vario 125"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(558, 'cf14e251-db5d-4b1b-af97-3e77c5bfc321', 'SRT-KD-2026-29', 3, 1, 'fixed_asset', 'Honda Bebek', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/cf14e251-db5d-4b1b-af97-3e77c5bfc321', NULL, NULL, NULL, '{"seri": "Revo 2017"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(559, '24031861-e1c8-47e3-a2d9-02165b9d20a0', 'SRT-KD-2026-30', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/24031861-e1c8-47e3-a2d9-02165b9d20a0', NULL, NULL, NULL, '{"seri": " Vario 150 "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(560, '71cf5b82-08e3-452d-87b7-1c9cf4dbbcbf', 'SRT-KD-2026-31', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/71cf5b82-08e3-452d-87b7-1c9cf4dbbcbf', NULL, NULL, NULL, '{"seri": "Vario "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(561, '4c8d0ecd-c27a-4490-934e-6a764f177fa0', 'SRT-KD-2026-32', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/4c8d0ecd-c27a-4490-934e-6a764f177fa0', NULL, NULL, NULL, '{"seri": "Beat 2013"}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(562, '0ab51a75-0c5d-4853-ae63-e4b07589cba3', 'SRT-KD-2026-33', 3, 1, 'fixed_asset', 'Honda Bebek', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0ab51a75-0c5d-4853-ae63-e4b07589cba3', NULL, NULL, NULL, '{"seri": "Supra X "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(563, '322fc71f-a7d9-4715-a8bc-e59b437ad4fc', 'SRT-KD-2026-34', 3, 1, 'fixed_asset', 'Honda Bebek', 'Honda ', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/322fc71f-a7d9-4715-a8bc-e59b437ad4fc', NULL, NULL, NULL, '{"seri": "Supra X "}', '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(573, '80f356d1-1b84-4f0e-9522-6ae7a6e1d7f8', 'SGM-V-2026-01', 1, 5, 'fixed_asset', 'Tangki Semprot', 'Test', NULL, NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/scan/80f356d1-1b84-4f0e-9522-6ae7a6e1d7f8', NULL, NULL, NULL, '{"seri": "-"}', '2026-06-26 01:31:55', '2026-06-26 01:31:55'),
	(574, '0e181562-29eb-4386-b9e6-78d25292ffa4', 'SGM-V-2026-02', 1, 5, 'fixed_asset', 'Tangki Semprot', 'Test', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/0e181562-29eb-4386-b9e6-78d25292ffa4', NULL, NULL, NULL, '{"seri": null}', '2026-06-26 01:31:55', '2026-06-26 01:31:55'),
	(575, '55fe93bc-37e6-4845-845f-818c03ccce80', 'SGM-V-2026-03', 1, 5, 'fixed_asset', 'Tangki Semprot', 'Test', NULL, NULL, NULL, NULL, 'good', 1, NULL, 'http://localhost:81/scan/55fe93bc-37e6-4845-845f-818c03ccce80', NULL, NULL, NULL, '{"seri": null}', '2026-06-26 01:31:55', '2026-06-26 01:31:55');

-- Dumping structure for table inventory.item_categories
CREATE TABLE IF NOT EXISTS `item_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('movable','immovable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'immovable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_categories_code_unique` (`code`),
  UNIQUE KEY `item_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.item_categories: ~5 rows (approximately)
INSERT IGNORE INTO `item_categories` (`id`, `code`, `slug`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'KD', 'kendaraan', 'Kendaraan', 'immovable', '2026-02-22 21:10:48', '2026-02-23 19:59:26'),
	(2, 'PE', 'peralatan-elektronika', 'Peralatan Elektronika', 'immovable', '2026-02-22 21:11:12', '2026-06-25 01:17:40'),
	(3, 'FN', 'furniture', 'Furniture', 'immovable', '2026-02-22 21:11:28', '2026-02-23 19:58:18'),
	(4, 'MS', 'mesin', 'Mesin', 'immovable', '2026-02-23 19:58:36', '2026-02-23 19:59:15'),
	(5, 'LN', 'lain-lain', 'Lain-lain', 'immovable', '2026-02-23 19:59:44', '2026-02-23 19:59:44');

-- Dumping structure for table inventory.item_scan_logs
CREATE TABLE IF NOT EXISTS `item_scan_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `scanned_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_scan_logs_items` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.item_scan_logs: ~125 rows (approximately)
INSERT IGNORE INTO `item_scan_logs` (`id`, `item_id`, `ip`, `user_agent`, `scanned_at`, `created_at`, `updated_at`) VALUES
	(1, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:32:55', '2026-06-03 00:32:55', '2026-06-03 00:32:55'),
	(2, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:35:03', '2026-06-03 00:35:03', '2026-06-03 00:35:03'),
	(3, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:35:17', '2026-06-03 00:35:17', '2026-06-03 00:35:17'),
	(4, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:35:46', '2026-06-03 00:35:46', '2026-06-03 00:35:46'),
	(5, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:35:59', '2026-06-03 00:35:59', '2026-06-03 00:35:59'),
	(6, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:36:18', '2026-06-03 00:36:18', '2026-06-03 00:36:18'),
	(7, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:36:31', '2026-06-03 00:36:31', '2026-06-03 00:36:31'),
	(8, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:36:50', '2026-06-03 00:36:50', '2026-06-03 00:36:50'),
	(9, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:37:36', '2026-06-03 00:37:36', '2026-06-03 00:37:36'),
	(10, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 00:46:28', '2026-06-03 00:46:28', '2026-06-03 00:46:28'),
	(11, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:04:52', '2026-06-03 01:04:52', '2026-06-03 01:04:52'),
	(12, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:05:12', '2026-06-03 01:05:12', '2026-06-03 01:05:12'),
	(13, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:06:02', '2026-06-03 01:06:02', '2026-06-03 01:06:02'),
	(14, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:06:31', '2026-06-03 01:06:31', '2026-06-03 01:06:31'),
	(15, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:06:38', '2026-06-03 01:06:38', '2026-06-03 01:06:38'),
	(16, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:06:48', '2026-06-03 01:06:48', '2026-06-03 01:06:48'),
	(17, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:07:18', '2026-06-03 01:07:18', '2026-06-03 01:07:18'),
	(18, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:07:33', '2026-06-03 01:07:33', '2026-06-03 01:07:33'),
	(19, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:08:40', '2026-06-03 01:08:40', '2026-06-03 01:08:40'),
	(20, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:09:42', '2026-06-03 01:09:42', '2026-06-03 01:09:42'),
	(21, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:13:26', '2026-06-03 01:13:26', '2026-06-03 01:13:26'),
	(22, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:13:37', '2026-06-03 01:13:37', '2026-06-03 01:13:37'),
	(23, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:14:08', '2026-06-03 01:14:08', '2026-06-03 01:14:08'),
	(24, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:14:24', '2026-06-03 01:14:24', '2026-06-03 01:14:24'),
	(25, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:15:11', '2026-06-03 01:15:11', '2026-06-03 01:15:11'),
	(26, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:15:39', '2026-06-03 01:15:39', '2026-06-03 01:15:39'),
	(27, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:15:55', '2026-06-03 01:15:55', '2026-06-03 01:15:55'),
	(28, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:16:03', '2026-06-03 01:16:03', '2026-06-03 01:16:03'),
	(29, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:16:15', '2026-06-03 01:16:15', '2026-06-03 01:16:15'),
	(30, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:16:26', '2026-06-03 01:16:26', '2026-06-03 01:16:26'),
	(31, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:21:41', '2026-06-03 01:21:41', '2026-06-03 01:21:41'),
	(32, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:24:56', '2026-06-03 01:24:56', '2026-06-03 01:24:56'),
	(33, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:37:31', '2026-06-03 01:37:31', '2026-06-03 01:37:31'),
	(34, 53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:40:25', '2026-06-03 01:40:25', '2026-06-03 01:40:25'),
	(35, 53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:43:01', '2026-06-03 01:43:01', '2026-06-03 01:43:01'),
	(36, 52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 01:43:31', '2026-06-03 01:43:31', '2026-06-03 01:43:31'),
	(37, 52, '192.168.1.13', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', '2026-06-03 01:50:36', '2026-06-03 01:50:36', '2026-06-03 01:50:36'),
	(38, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:01:25', '2026-06-03 19:01:25', '2026-06-03 19:01:25'),
	(39, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:02:07', '2026-06-03 19:02:07', '2026-06-03 19:02:07'),
	(40, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:19:59', '2026-06-03 19:19:59', '2026-06-03 19:19:59'),
	(41, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:24:21', '2026-06-03 19:24:21', '2026-06-03 19:24:21'),
	(42, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:25:11', '2026-06-03 19:25:11', '2026-06-03 19:25:11'),
	(43, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:25:20', '2026-06-03 19:25:20', '2026-06-03 19:25:20'),
	(44, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:30:04', '2026-06-03 19:30:04', '2026-06-03 19:30:04'),
	(45, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:33:19', '2026-06-03 19:33:19', '2026-06-03 19:33:19'),
	(46, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:34:30', '2026-06-03 19:34:30', '2026-06-03 19:34:30'),
	(47, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:35:01', '2026-06-03 19:35:01', '2026-06-03 19:35:01'),
	(48, 53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:35:16', '2026-06-03 19:35:16', '2026-06-03 19:35:16'),
	(49, 53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:36:28', '2026-06-03 19:36:28', '2026-06-03 19:36:28'),
	(50, 53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:46:45', '2026-06-03 19:46:45', '2026-06-03 19:46:45'),
	(51, 52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:47:05', '2026-06-03 19:47:05', '2026-06-03 19:47:05'),
	(52, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:16:40', '2026-06-07 20:16:40', '2026-06-07 20:16:40'),
	(53, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:19:06', '2026-06-07 20:19:06', '2026-06-07 20:19:06'),
	(54, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:19:11', '2026-06-07 20:19:11', '2026-06-07 20:19:11'),
	(55, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:19:32', '2026-06-07 20:19:32', '2026-06-07 20:19:32'),
	(56, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:20:47', '2026-06-07 20:20:47', '2026-06-07 20:20:47'),
	(57, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:23:03', '2026-06-07 20:23:03', '2026-06-07 20:23:03'),
	(58, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:26:46', '2026-06-07 20:26:46', '2026-06-07 20:26:46'),
	(59, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:27:15', '2026-06-07 20:27:15', '2026-06-07 20:27:15'),
	(60, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:28:39', '2026-06-07 20:28:39', '2026-06-07 20:28:39'),
	(61, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:30:07', '2026-06-07 20:30:07', '2026-06-07 20:30:07'),
	(62, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-07 20:31:11', '2026-06-07 20:31:11', '2026-06-07 20:31:11'),
	(63, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 00:16:04', '2026-06-08 00:16:04', '2026-06-08 00:16:04'),
	(64, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:38:07', '2026-06-08 01:38:07', '2026-06-08 01:38:07'),
	(65, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:39:00', '2026-06-08 01:39:00', '2026-06-08 01:39:00'),
	(66, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:39:58', '2026-06-08 01:39:58', '2026-06-08 01:39:58'),
	(67, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:40:22', '2026-06-08 01:40:22', '2026-06-08 01:40:22'),
	(68, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:46:13', '2026-06-08 01:46:13', '2026-06-08 01:46:13'),
	(69, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:47:43', '2026-06-08 01:47:43', '2026-06-08 01:47:43'),
	(70, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 01:49:00', '2026-06-08 01:49:00', '2026-06-08 01:49:00'),
	(71, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:44:14', '2026-06-08 19:44:14', '2026-06-08 19:44:14'),
	(72, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:44:26', '2026-06-08 19:44:26', '2026-06-08 19:44:26'),
	(73, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:44:48', '2026-06-08 19:44:48', '2026-06-08 19:44:48'),
	(74, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:51:57', '2026-06-08 19:51:57', '2026-06-08 19:51:57'),
	(75, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:52:29', '2026-06-08 19:52:29', '2026-06-08 19:52:29'),
	(76, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:53:11', '2026-06-08 19:53:11', '2026-06-08 19:53:11'),
	(77, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:54:41', '2026-06-08 19:54:41', '2026-06-08 19:54:41'),
	(78, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:56:15', '2026-06-08 19:56:15', '2026-06-08 19:56:15'),
	(79, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:56:41', '2026-06-08 19:56:41', '2026-06-08 19:56:41'),
	(80, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 19:58:36', '2026-06-08 19:58:36', '2026-06-08 19:58:36'),
	(81, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 20:18:03', '2026-06-08 20:18:03', '2026-06-08 20:18:03'),
	(82, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 20:25:14', '2026-06-08 20:25:14', '2026-06-08 20:25:14'),
	(83, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 20:58:00', '2026-06-08 20:58:00', '2026-06-08 20:58:00'),
	(84, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 21:00:05', '2026-06-08 21:00:05', '2026-06-08 21:00:05'),
	(85, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 21:30:07', '2026-06-08 21:30:07', '2026-06-08 21:30:07'),
	(86, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 21:43:43', '2026-06-08 21:43:43', '2026-06-08 21:43:43'),
	(87, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 21:44:47', '2026-06-08 21:44:47', '2026-06-08 21:44:47'),
	(88, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-08 21:45:06', '2026-06-08 21:45:06', '2026-06-08 21:45:06'),
	(89, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:30:14', '2026-06-17 18:30:14', '2026-06-17 18:30:14'),
	(90, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:30:15', '2026-06-17 18:30:15', '2026-06-17 18:30:15'),
	(91, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:32:06', '2026-06-17 18:32:06', '2026-06-17 18:32:06'),
	(92, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:33:21', '2026-06-17 18:33:21', '2026-06-17 18:33:21'),
	(93, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:39:35', '2026-06-17 18:39:35', '2026-06-17 18:39:35'),
	(94, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:40:49', '2026-06-17 18:40:49', '2026-06-17 18:40:49'),
	(95, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:41:06', '2026-06-17 18:41:06', '2026-06-17 18:41:06'),
	(96, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:44:52', '2026-06-17 18:44:52', '2026-06-17 18:44:52'),
	(97, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:47:49', '2026-06-17 18:47:49', '2026-06-17 18:47:49'),
	(98, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:52:04', '2026-06-17 18:52:04', '2026-06-17 18:52:04'),
	(99, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 18:52:41', '2026-06-17 18:52:41', '2026-06-17 18:52:41'),
	(100, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 19:29:27', '2026-06-17 19:29:27', '2026-06-17 19:29:27'),
	(101, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 19:37:10', '2026-06-17 19:37:10', '2026-06-17 19:37:10'),
	(102, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:37:51', '2026-06-17 21:37:51', '2026-06-17 21:37:51'),
	(103, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:42:13', '2026-06-17 21:42:13', '2026-06-17 21:42:13'),
	(104, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:52:39', '2026-06-17 21:52:39', '2026-06-17 21:52:39'),
	(105, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:53:29', '2026-06-17 21:53:29', '2026-06-17 21:53:29'),
	(106, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:54:23', '2026-06-17 21:54:23', '2026-06-17 21:54:23'),
	(107, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:54:29', '2026-06-17 21:54:29', '2026-06-17 21:54:29'),
	(108, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:57:19', '2026-06-17 21:57:19', '2026-06-17 21:57:19'),
	(109, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 21:57:25', '2026-06-17 21:57:25', '2026-06-17 21:57:25'),
	(110, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-17 22:00:26', '2026-06-17 22:00:26', '2026-06-17 22:00:26'),
	(111, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-18 00:35:58', '2026-06-18 00:35:58', '2026-06-18 00:35:58'),
	(112, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-18 00:46:58', '2026-06-18 00:46:58', '2026-06-18 00:46:58'),
	(113, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-18 00:54:10', '2026-06-18 00:54:10', '2026-06-18 00:54:10'),
	(114, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-18 00:54:20', '2026-06-18 00:54:20', '2026-06-18 00:54:20'),
	(115, 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-18 01:18:39', '2026-06-18 01:18:39', '2026-06-18 01:18:39'),
	(116, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:21:00', '2026-06-25 18:21:00', '2026-06-25 18:21:00'),
	(117, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:22:23', '2026-06-25 18:22:23', '2026-06-25 18:22:23'),
	(118, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:25:34', '2026-06-25 18:25:34', '2026-06-25 18:25:34'),
	(119, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:39:09', '2026-06-25 18:39:09', '2026-06-25 18:39:09'),
	(120, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:40:27', '2026-06-25 18:40:27', '2026-06-25 18:40:27'),
	(121, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 18:40:57', '2026-06-25 18:40:57', '2026-06-25 18:40:57'),
	(122, 51, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '2026-06-25 18:41:07', '2026-06-25 18:41:07', '2026-06-25 18:41:07'),
	(123, 51, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '2026-06-25 18:43:32', '2026-06-25 18:43:32', '2026-06-25 18:43:32'),
	(124, 51, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '2026-06-25 18:43:36', '2026-06-25 18:43:36', '2026-06-25 18:43:36'),
	(125, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-25 19:00:48', '2026-06-25 19:00:48', '2026-06-25 19:00:48');

-- Dumping structure for table inventory.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.jobs: ~2 rows (approximately)
INSERT IGNORE INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
	(1, 'default', '{"uuid":"e618052e-4775-4ee4-b6b6-d088f18bf9e0","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:2:{i:0;i:27;i:1;i:28;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772437748,"delay":null}', 0, NULL, 1772437748, 1772437748),
	(2, 'default', '{"uuid":"40c07f69-98b4-41fe-aa8b-4e2159430f61","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:5:{i:0;i:29;i:1;i:30;i:2;i:31;i:3;i:32;i:4;i:33;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772437966,"delay":null}', 0, NULL, 1772437966, 1772437966),
	(3, 'default', '{"uuid":"8170448e-22f1-41d4-acd6-29e11daaaf39","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:5:{i:0;i:29;i:1;i:30;i:2;i:31;i:3;i:32;i:4;i:33;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772438366,"delay":null}', 0, NULL, 1772438366, 1772438366);

-- Dumping structure for table inventory.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.job_batches: ~0 rows (approximately)

-- Dumping structure for table inventory.loans
CREATE TABLE IF NOT EXISTS `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `loan_date` date NOT NULL,
  `expected_return_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_item_id_foreign` (`item_id`),
  KEY `loans_user_id_foreign` (`user_id`),
  CONSTRAINT `loans_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.loans: ~9 rows (approximately)

-- Dumping structure for table inventory.loan_logs
CREATE TABLE IF NOT EXISTS `loan_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `condition_on_return` enum('good','broken') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_logs_loan_id_foreign` (`loan_id`),
  CONSTRAINT `loan_logs_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.loan_logs: ~0 rows (approximately)

-- Dumping structure for table inventory.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `location_category_id` bigint unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_slug_unique` (`slug`),
  KEY `FK_locations_location_categories` (`location_category_id`),
  CONSTRAINT `FK_locations_location_categories` FOREIGN KEY (`location_category_id`) REFERENCES `location_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.locations: ~8 rows (approximately)
INSERT IGNORE INTO `locations` (`id`, `parent_id`, `location_category_id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
	(1, NULL, 1, 'HO', 'Head Office Sedayu', '2026-03-02 04:32:37', '2026-03-02 04:32:39'),
	(2, NULL, 1, 'GD', 'Gudang Depok', '2026-03-02 04:32:54', '2026-03-02 04:32:55'),
	(3, NULL, 2, 'DP', 'Dumpuh', '2026-03-02 04:33:07', '2026-03-02 04:33:07'),
	(5, NULL, 1, 'MR', 'Marrison Wonosari', '2026-06-25 03:25:10', '2026-06-25 03:25:10'),
	(6, NULL, 1, 'KRA', 'Karanganyar', '2026-06-25 03:26:09', '2026-06-25 03:26:10'),
	(7, NULL, 2, 'GK', 'Gunungkidul', '2026-06-25 03:27:02', '2026-06-25 03:27:02'),
	(8, 1, 1, 'HO-MT1', 'Ruang Meeting E4 Lt. 1', '2026-06-25 07:46:31', '2026-06-25 07:46:32'),
	(9, 1, 1, 'HO-MT2', 'Ruang Meeting E4 Lt. 2', '2026-06-25 07:46:31', '2026-06-25 07:46:32');

-- Dumping structure for table inventory.location_categories
CREATE TABLE IF NOT EXISTS `location_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location_categories_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.location_categories: ~2 rows (approximately)
INSERT IGNORE INTO `location_categories` (`id`, `code`, `name`) VALUES
	(1, 'I', 'Kantor'),
	(2, 'V', 'Kandang');

-- Dumping structure for table inventory.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.migrations: ~14 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_02_16_064833_create_item_categories_table', 1),
	(5, '2026_02_16_064838_create_items_table', 1),
	(6, '2026_02_16_064904_create_loans_table', 1),
	(7, '2026_02_16_064913_create_loan_logs_table', 1),
	(8, '2026_02_21_052541_create_companies_table', 1),
	(9, '2026_03_02_042926_create_locations_table', 2),
	(10, '2026_03_03_072513_create_vehicle_details_table', 3),
	(11, '2026_06_03_041651_create_item_scan_logs_table', 4),
	(12, '2026_02_16_064839_add_public_uuid_to_items_table', 5),
	(13, '2026_06_08_043641_create_specific_locations_table', 6),
	(14, '2026_06_08_044153_create_departments_table', 7),
	(15, '2026_06_18_080509_create_ip_bans_table', 8),
	(16, '2026_06_25_024400_create_location_categories_table', 9),
	(17, '2026_06_25_085142_create_divisions_table', 10);

-- Dumping structure for table inventory.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table inventory.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.sessions: ~2 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('JafL7revb14CtrG4yzfZmkGcHmS0Co5JrZAGJTSm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiekFETUZ5ODd1ZGJRMmllR3hDR2x5YzhiSmZzMmcwQlZsUWV6TFBQWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1782477181),
	('RWpVpkKwfAfYbsMEfT02rituAFAmJkb4L6WHFoux', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUpUTmxFUDBKQjRVNWR0YjFVRllCaXl3M0hodmR2THRxWk5INTRENCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9pbnZlbnRvcnkudGVzdDo4MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovL2ludmVudG9yeS50ZXN0OjgxL2FkbWluIjt9fQ==', 1782477203);

-- Dumping structure for table inventory.specific_locations
CREATE TABLE IF NOT EXISTS `specific_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specific_locations_location_id_foreign` (`location_id`),
  CONSTRAINT `specific_locations_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.specific_locations: ~2 rows (approximately)
INSERT IGNORE INTO `specific_locations` (`id`, `location_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 1, 'R. FAT', 'Ruang FAT Head Office', '2026-06-08 07:06:03', '2026-06-08 07:06:06'),
	(2, 1, 'R. HRGA', 'Ruang HRGA di Head Office', '2026-06-08 07:06:22', '2026-06-08 07:06:23');

-- Dumping structure for table inventory.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('ga','staf') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staf',
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `short_name` (`short_name`),
  KEY `FK_users_divisions` (`division_id`),
  CONSTRAINT `FK_users_divisions` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.users: ~31 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `short_name`, `name`, `email`, `email_verified_at`, `password`, `role`, `position`, `division_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'General Affair', 'ga@sgm.com', NULL, '$2y$12$MK1w81JMAzb.Fsc/jvqwdeOaO0hm2iVFlCi/euFZI/Jm0Eyf7ugaS', 'ga', 'staf', NULL, NULL, '2026-02-22 20:46:31', '2026-02-22 20:46:31'),
	(2, NULL, 'General Affair', 'general@sgm.com', NULL, '$2y$12$MK1w81JMAzb.Fsc/jvqwdeOaO0hm2iVFlCi/euFZI/Jm0Eyf7ugaS', 'ga', 'staf', NULL, 'bQXRV9MRbQXmUZCTA9iRHUwsJh39nVaqsc8TO2Hzgf2BKWw1Z1ukq51gyRZh', '2026-02-23 23:59:44', '2026-02-23 23:59:44'),
	(24, 'isna', 'Isna Nur Faizah', 'isna.nf@sgm.com', NULL, NULL, 'staf', 'Staf HR', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(25, 'wily', 'Arya Wily Nur Achmad', 'arya.wily.na@sgm.com', NULL, NULL, 'staf', 'Legal', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(26, 'hery', 'Hery Setiawan Junianto', 'hery.sj@sgm.com', NULL, NULL, 'staf', 'HR Manager', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(27, 'anggun', 'Beky Anggun Elsalibu', 'beky.ae@sgm.com', NULL, NULL, 'staf', 'Admin Sales (CRM)', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(28, 'misbah', 'Misbah Nur Rohman', 'misbah.nr@sgm.com', NULL, NULL, 'staf', 'Manager FAT', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(29, 'sunu', 'Sunu Heryanta', 'sunu.h@sgm.com', NULL, NULL, 'staf', 'Admin Proyek', 8, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(30, 'olivia', 'Olivia Lungit Astari Putri', 'olivia.lap@sgm.com', NULL, NULL, 'staf', 'Admin Pajak', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(31, 'riyana', 'Riyana Zuli Safitri', 'riyana.zs@sgm.com', NULL, NULL, 'staf', 'Admin Sales Telur', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(32, 'manda', 'Rahmanda Shevi Ulliyanti', 'rahmanda.su@sgm.com', NULL, NULL, 'staf', 'Admin FAT', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(33, 'cahyo', 'Cahyo Fitriningtyas', 'cahyo.f@sgm.com', NULL, NULL, 'staf', 'Admin IT', 6, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(34, 'lala', 'Pristi Fadilla', 'pristi.f@sgm.com', NULL, NULL, 'staf', 'Admin Produksi', 1, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(35, 'almira', 'Almira Tsania Aflah', 'almira.ta@sgm.com', NULL, NULL, 'staf', 'Admin Produksi', 1, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(36, 'fajar', 'Fajar Kurniawan', 'fajar.k@sgm.com', NULL, NULL, 'staf', 'CCC', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(37, 'fira', 'Safira Nur Azizah', 'safira.na@sgm.com', NULL, NULL, 'staf', 'Admin Produksi', 1, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(38, 'resti', 'Resti Defianti', 'resti.d@sgm.com', NULL, NULL, 'staf', 'Admin Sales', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(39, 'jatu', 'Jatu Saktia Sari', 'jatu.ss@sgm.com', NULL, NULL, 'staf', 'HR', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(40, 'muna', 'Muna Fa\'iqah', 'muna.f@sgm.com', NULL, NULL, 'staf', 'Admin Accounting', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(41, 'oca', 'Frisca Malosa', 'frisca.m@sgm.com', NULL, NULL, 'staf', 'General Accounting', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(42, 'yati', 'Sri Hidayati', 'sri.h@sgm.com', NULL, NULL, 'staf', 'Finance', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(43, 'adenia', 'Adenia Ayu Safira', 'adenia.as@sgm.com', NULL, NULL, 'staf', 'Admin FAT', 5, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(44, 'azka', 'Azka Ulil Albab', 'azka.ua@sgm.com', NULL, NULL, 'staf', 'Internal Audit', 7, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(45, 'fita', 'Sri Indah Nofita Sari', 'sri.indah.ns@sgm.com', NULL, NULL, 'staf', 'Admin Logistik & Distribusi', 4, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(46, 'simon', 'Simon Prasetyanto', 'simon.p@sgm.com', NULL, NULL, 'staf', 'Humas & Umum', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(47, 'agus', 'Agus Mu\'alim', 'agus.m@sgm.com', NULL, NULL, 'staf', 'Umum', 3, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(48, 'nugi', 'Nugroho Slamet', 'nugroho.s@sgm.com', NULL, NULL, 'staf', 'TSSR', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(49, 'tasminto', 'Dian Tasminto', 'dian.t@sgm.com', NULL, NULL, 'staf', 'TSSR', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(50, 'basuki', 'Basuki Rachmat', 'basuki.r@sgm.com', NULL, NULL, 'staf', 'TSSR', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(51, 'aswin', 'Muhammad Aswin Pratama', 'aswin.p@sgm.com', NULL, NULL, 'staf', 'TSSR', 2, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59'),
	(52, 'satria', 'Satria', 'satria@sgm.com', NULL, NULL, 'staf', 'Manager Purchasing ', 1, NULL, '2026-06-24 21:24:59', '2026-06-24 21:24:59');

-- Dumping structure for table inventory.vehicle_details
CREATE TABLE IF NOT EXISTS `vehicle_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chassis_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_details_item_id_foreign` (`item_id`),
  CONSTRAINT `vehicle_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.vehicle_details: ~34 rows (approximately)
INSERT IGNORE INTO `vehicle_details` (`id`, `item_id`, `license_plate`, `color`, `engine_number`, `chassis_number`, `created_at`, `updated_at`) VALUES
	(108, 530, 'AB 8618 BF ', NULL, NULL, NULL, '2026-06-26 00:17:11', '2026-06-26 00:17:11'),
	(109, 531, 'AB 8619 BF', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(110, 532, 'AB 8177 KA', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(111, 533, 'AB 1931 GM ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(112, 534, 'AB 8911 BF ', 'Putih', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(113, 535, 'AB 8054 BG', 'Putih', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(114, 536, 'AB 1922 GM ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(115, 537, 'AB 1739 K', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(116, 538, 'AB 8984 BK ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(117, 539, 'AB 1148 KA', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(118, 540, 'AB 8072 KA ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(119, 541, 'AB 8126 KA', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(120, 542, 'AB 8244 KA ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(121, 543, 'AB 8245 KA ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(122, 544, 'AB 8074 KA', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(123, 545, 'AB 8268 BF', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(124, 546, 'AB 8276 TB ', 'putih', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(125, 547, 'AB 8285 BE', 'hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(126, 548, 'AB 1559 GI', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(127, 549, 'AB 1450 K', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(128, 550, 'AB 1847 GM ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(129, 551, 'AB ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(130, 552, 'AB', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(131, 553, 'AB 4818 RC', 'hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(132, 554, 'AB 5165 LX', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(133, 555, 'AB 3181 TH', ' hitam merah ', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(134, 556, 'AB 3686 IX', 'hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(135, 557, 'AB 6944 OX ', 'Hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(136, 558, 'AA 3370 JA ', 'hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(137, 559, 'AB 6829 VS ', 'silver', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(138, 560, 'AB 4888 RC ', 'Hitam', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(139, 561, 'AB 6145 LE ', NULL, NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(140, 562, 'AB 6635 ZF', 'orange', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12'),
	(141, 563, 'AB 6828 VS ', 'putih', NULL, NULL, '2026-06-26 00:17:12', '2026-06-26 00:17:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
