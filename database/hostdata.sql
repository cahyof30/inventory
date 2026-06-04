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

-- Dumping data for table inventory.cache: ~0 rows (approximately)

-- Dumping data for table inventory.cache_locks: ~0 rows (approximately)

-- Dumping data for table inventory.companies: ~4 rows (approximately)
INSERT IGNORE INTO `companies` (`id`, `slug`, `company_name`, `logo`, `created_at`, `updated_at`) VALUES
	(1, 'SGM', 'PT. Sentra Gemilang Mulia', 'company-logos/01KSVM7EHF4XRYW7X53QH1EQYP.png', '2026-02-22 20:57:21', '2026-05-29 22:03:07'),
	(2, 'TJKS', 'PT. Ternak Jaya Keluarga Sentosa', 'company-logos/01KSVMB9Q231AZ8SENCFVYXAHC.png', '2026-02-22 20:57:55', '2026-05-29 22:05:13'),
	(3, 'SRAT', 'PT. Sumber Rejeki Aneka Transport', 'company-logos/01KT35AJZ27PTM4E7EEAFKXMAG.png', '2026-02-22 20:58:32', '2026-06-01 20:16:37'),
	(4, 'GSL', 'PT. Gemilang Satwa Lestari', NULL, '2026-02-22 20:58:52', '2026-02-22 20:58:52');

-- Dumping data for table inventory.failed_jobs: ~0 rows (approximately)

-- Dumping data for table inventory.items: ~105 rows (approximately)
INSERT IGNORE INTO `items` (`id`, `code`, `company_id`, `category_id`, `item_type`, `name`, `brand`, `purchase_price`, `purchase_date`, `condition`, `stock`, `image`, `qr_code`, `barcode`, `location_id`, `description`, `specifications`, `created_at`, `updated_at`) VALUES
	(51, 'SGM-KD-202600001', 1, 1, 'fixed_asset', 'Mobil Truck ', 'Center FE 74 HD N 4X2 MT ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-KD-202600001', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(52, 'SGM-KD-202600002', 1, 1, 'fixed_asset', 'Mobil Truck ', 'Center FE 74 HD N 4X2 MT ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-KD-202600002', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(53, 'SRAT-KD-202600001', 3, 1, 'fixed_asset', 'Mobil Truck ', 'Center FE 74 HD N 4X2 MT ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600001', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(54, 'SRAT-KD-202600002', 3, 1, 'fixed_asset', 'Mobil Sigra', 'MPV', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600002', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(55, 'SRAT-KD-202600003', 3, 1, 'fixed_asset', 'Mobil Granmax 1.5 2018 - Putih', 'Daihatsu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600003', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(56, 'SRAT-KD-202600004', 3, 1, 'fixed_asset', 'Mobil Granmax 1.5 2023 - Putih ', 'Daihatsu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600004', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(57, 'SRAT-KD-202600005', 3, 1, 'fixed_asset', 'Mobil Honda CRV', 'Honda', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600005', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(58, 'SRAT-KD-202600006', 3, 1, 'fixed_asset', 'Mobil Innova Zenix ', 'Toyota', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600006', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(59, 'SRAT-KD-202600007', 3, 1, 'fixed_asset', 'Mobil Isuzu Traga Pick Up FD ', 'Isuzu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600007', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(60, 'SRAT-KD-202600008', 3, 1, 'fixed_asset', 'Mobil HYUNDAI SANTA FE', 'Hyundai', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600008', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(61, 'SRAT-KD-202600009', 3, 1, 'fixed_asset', 'Mobil Traga Pick Up FD ', 'Isuzu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600009', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(62, 'SRAT-KD-202600010', 3, 1, 'fixed_asset', 'Mobil Traga Pick Up FD ', 'Isuzu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600010', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(63, 'SRAT-KD-202600011', 3, 1, 'fixed_asset', 'Mobil Traga Pick Up FD ', 'Isuzu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600011', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:46'),
	(64, 'SRAT-KD-202600012', 3, 1, 'fixed_asset', 'Mobil Traga Pick Up FD ', 'Isuzu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600012', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(65, 'SRAT-KD-202600013', 3, 1, 'fixed_asset', 'Mobil Mitsubishi L300', 'Mitsubishi', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600013', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(66, 'SGM-KD-202600003', 1, 1, 'fixed_asset', 'Mobil Mitsubishi Truk ', 'Mitsubishi', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-KD-202600003', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(67, 'SRAT-KD-202600014', 3, 1, 'fixed_asset', 'Mobil Pick Up Daihatu 2016 - Putih', 'Daihatsu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600014', NULL, 4, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(68, 'SGM-KD-202600004', 1, 1, 'fixed_asset', 'Mobil Pick Up Daihatu 2017 - Hitam ', 'Daihatsu', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-KD-202600004', NULL, 2, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(69, 'SGM-KD-202600005', 1, 1, 'fixed_asset', 'Mobil Toyota Avanza', 'Toyota', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-KD-202600005', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(70, 'SRAT-KD-202600015', 3, 1, 'fixed_asset', 'Mobil Toyota Avanza ', 'Toyota', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600015', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(71, 'SRAT-KD-202600016', 3, 1, 'fixed_asset', 'Mobil Toyota Avanza ', 'Toyota', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600016', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(72, 'SRAT-KD-202600017', 3, 1, 'fixed_asset', 'Motor Bebek - Hitam', 'Yamaha Aerox', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600017', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(73, 'SRAT-KD-202600018', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda Vario ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600018', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(74, 'SRAT-KD-202600019', 3, 1, 'fixed_asset', 'Motor Matik - Hitam Merah', 'Honda Vario Matic ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600019', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(75, 'SRAT-KD-202600020', 3, 1, 'fixed_asset', 'Motor Matik - Hitam', 'Honda Beat Street 2018 ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600020', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(76, 'SRAT-KD-202600021', 3, 1, 'fixed_asset', 'Motor Matik - Hitam', 'Honda Vario 125', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600021', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(77, 'SRAT-KD-202600022', 3, 1, 'fixed_asset', 'Honda Bebek - Hitam', 'Honda Revo 2017', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600022', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(78, 'SRAT-KD-202600023', 3, 1, 'fixed_asset', 'Motor Matik - Silver', 'Honda Vario 150', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600023', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(79, 'SRAT-KD-202600024', 3, 1, 'fixed_asset', 'Motor Matik - Hitam', 'Honda Vario', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600024', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(80, 'SRAT-KD-202600025', 3, 1, 'fixed_asset', 'Motor Matik', 'Honda Beat 2013', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600025', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(81, 'SRAT-KD-202600026', 3, 1, 'fixed_asset', 'Honda Bebek - Orange', 'Honda Supra X', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600026', NULL, 3, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(82, 'SRAT-KD-202600027', 3, 1, 'fixed_asset', 'Honda Bebek - Merah Putih', 'Honda Supra X', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SRAT-KD-202600027', NULL, 1, NULL, NULL, '2026-03-09 18:46:00', '2026-06-03 19:44:47'),
	(83, 'SGM-FN-202600001', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600001', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(84, 'SGM-FN-202600002', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600002', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(85, 'SGM-FN-202600003', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600003', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(86, 'SGM-FN-202600004', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600004', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(87, 'SGM-FN-202600005', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600005', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(88, 'SGM-FN-202600006', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600006', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(89, 'SGM-FN-202600007', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600007', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(90, 'SGM-FN-202600008', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600008', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(91, 'SGM-FN-202600009', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600009', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(92, 'SGM-FN-202600010', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600010', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(93, 'SGM-FN-202600011', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600011', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(94, 'SGM-FN-202600012', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600012', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(95, 'SGM-FN-202600013', 1, 3, 'fixed_asset', 'Meja Staff', 'Rowaro', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600013', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(96, 'SGM-FN-202600014', 1, 3, 'fixed_asset', 'Meja Staff', 'Ativ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600014', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(97, 'SGM-FN-202600015', 1, 3, 'fixed_asset', 'Meja Staff', 'Ativ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600015', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(98, 'SGM-FN-202600016', 1, 3, 'fixed_asset', 'Rak Kayu Besar', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600016', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(99, 'SGM-FN-202600017', 1, 3, 'fixed_asset', 'Rak Kayu Kecil ', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600017', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(100, 'SGM-FN-202600018', 1, 3, 'fixed_asset', 'Kursi Office Roda', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600018', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(101, 'SGM-FN-202600019', 1, 3, 'fixed_asset', 'Kursi Office Roda', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600019', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(102, 'SGM-FN-202600020', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600020', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(103, 'SGM-FN-202600021', 1, 3, 'fixed_asset', 'Kursi Office Roda', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600021', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(104, 'SGM-FN-202600022', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600022', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(105, 'SGM-FN-202600023', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600023', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(106, 'SGM-FN-202600024', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600024', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(107, 'SGM-FN-202600025', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600025', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(108, 'SGM-FN-202600026', 1, 3, 'fixed_asset', 'Meja Panjang Skat Staff', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600026', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(109, 'SGM-FN-202600027', 1, 3, 'fixed_asset', 'Lemari Plastik Kecil', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600027', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(110, 'SGM-FN-202600028', 1, 3, 'fixed_asset', 'Lemari Plastik Besar', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600028', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(111, 'SGM-FN-202600029', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600029', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(112, 'SGM-FN-202600030', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600030', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(113, 'SGM-FN-202600031', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600031', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(114, 'SGM-FN-202600032', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600032', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(115, 'SGM-FN-202600033', 1, 3, 'fixed_asset', 'Meja Staff', 'Ativ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600033', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:47'),
	(116, 'SGM-FN-202600034', 1, 3, 'fixed_asset', 'Meja Staff', 'Ativ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600034', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(117, 'SGM-FN-202600035', 1, 3, 'fixed_asset', 'Meja Staff', 'Ativ', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600035', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(118, 'SGM-FN-202600036', 1, 3, 'fixed_asset', 'Meja Panjang Meeting', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600036', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(119, 'SGM-FN-202600037', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600037', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(120, 'SGM-FN-202600038', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600038', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(121, 'SGM-FN-202600039', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600039', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(122, 'SGM-FN-202600040', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600040', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(123, 'SGM-FN-202600041', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600041', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(124, 'SGM-FN-202600042', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600042', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(125, 'SGM-FN-202600043', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600043', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(126, 'SGM-FN-202600044', 1, 3, 'fixed_asset', 'Kursi Office Roda', 'Chair', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600044', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(127, 'SGM-FN-202600045', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600045', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(128, 'SGM-FN-202600046', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600046', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(129, 'SGM-FN-202600047', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600047', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(130, 'SGM-FN-202600048', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600048', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(131, 'SGM-FN-202600049', 1, 3, 'fixed_asset', 'Kursi Office Tanpa Roda', 'Ikea', NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600049', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(132, 'SGM-FN-202600050', 1, 3, 'fixed_asset', 'Lemari Pajang ', NULL, NULL, '2026-03-10', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-FN-202600050', NULL, 1, NULL, NULL, '2026-03-09 21:03:04', '2026-06-03 19:44:48'),
	(133, 'SGM-PE-202600001', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600001', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(134, 'SGM-PE-202600002', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600002', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(135, 'SGM-PE-202600003', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600003', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(136, 'SGM-PE-202600004', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600004', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(137, 'SGM-PE-202600005', 1, 2, 'fixed_asset', 'Laptop ', 'Acer', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600005', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(138, 'SGM-PE-202600006', 1, 2, 'fixed_asset', 'Laptop ', 'Asus Vivo book', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600006', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(139, 'SGM-PE-202600007', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600007', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(140, 'SGM-PE-202600008', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'broken', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600008', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(141, 'SGM-PE-202600009', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600009', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(142, 'SGM-PE-202600010', 1, 2, 'fixed_asset', 'Laptop ', 'Sony Vaio', NULL, '2026-03-23', 'broken', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600010', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(143, 'SGM-PE-202600011', 1, 2, 'fixed_asset', 'Laptop ', 'Chrome', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600011', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(144, 'SGM-PE-202600012', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600012', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(145, 'SGM-PE-202600013', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600013', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(146, 'SGM-PE-202600014', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600014', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(147, 'SGM-PE-202600015', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo V14', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600015', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(148, 'SGM-PE-202600016', 1, 2, 'fixed_asset', 'Laptop ', 'Acer', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600016', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(149, 'SGM-PE-202600017', 1, 2, 'fixed_asset', 'Laptop ', 'Lenovo', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600017', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(150, 'SGM-PE-202600018', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600018', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(151, 'SGM-PE-202600019', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600019', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(152, 'SGM-PE-202600020', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600020', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(153, 'SGM-PE-202600021', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600021', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(154, 'SGM-PE-202600022', 1, 2, 'fixed_asset', 'Laptop ', 'Asus', NULL, '2026-03-23', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600022', NULL, 1, NULL, NULL, '2026-03-22 23:49:06', '2026-06-03 19:44:48'),
	(155, 'SGM-PE-202600023', 1, 2, 'fixed_asset', 'Laptop', 'MSI', NULL, '2026-03-26', 'good', 1, NULL, 'http://localhost:81/inventory/public/scan/SGM-PE-202600023', NULL, 1, NULL, NULL, '2026-03-26 01:09:51', '2026-06-03 19:44:48');

-- Dumping data for table inventory.item_categories: ~5 rows (approximately)
INSERT IGNORE INTO `item_categories` (`id`, `code`, `slug`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'KD', 'kendaraan', 'Kendaraan', 'immovable', '2026-02-22 21:10:48', '2026-02-23 19:59:26'),
	(2, 'PE', 'peralatan-elektronik', 'Peralatan Elektronik', 'immovable', '2026-02-22 21:11:12', '2026-02-23 19:57:53'),
	(3, 'FN', 'furniture', 'Furniture', 'immovable', '2026-02-22 21:11:28', '2026-02-23 19:58:18'),
	(4, 'MS', 'mesin', 'Mesin', 'immovable', '2026-02-23 19:58:36', '2026-02-23 19:59:15'),
	(5, 'LN', 'lain-lain', 'Lain-lain', 'immovable', '2026-02-23 19:59:44', '2026-02-23 19:59:44');

-- Dumping data for table inventory.item_scan_logs: ~51 rows (approximately)
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
	(51, 52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-03 19:47:05', '2026-06-03 19:47:05', '2026-06-03 19:47:05');

-- Dumping data for table inventory.jobs: ~3 rows (approximately)
INSERT IGNORE INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
	(1, 'default', '{"uuid":"e618052e-4775-4ee4-b6b6-d088f18bf9e0","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:2:{i:0;i:27;i:1;i:28;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772437748,"delay":null}', 0, NULL, 1772437748, 1772437748),
	(2, 'default', '{"uuid":"40c07f69-98b4-41fe-aa8b-4e2159430f61","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:5:{i:0;i:29;i:1;i:30;i:2;i:31;i:3;i:32;i:4;i:33;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772437966,"delay":null}', 0, NULL, 1772437966, 1772437966),
	(3, 'default', '{"uuid":"8170448e-22f1-41d4-acd6-29e11daaaf39","displayName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SyncItemsToGoogleSheet","command":"O:31:\\"App\\\\Jobs\\\\SyncItemsToGoogleSheet\\":1:{s:5:\\"items\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\Item\\";s:2:\\"id\\";a:5:{i:0;i:29;i:1;i:30;i:2;i:31;i:3;i:32;i:4;i:33;}s:9:\\"relations\\";a:1:{i:0;s:8:\\"category\\";}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}}","batchId":null},"createdAt":1772438366,"delay":null}', 0, NULL, 1772438366, 1772438366);

-- Dumping data for table inventory.job_batches: ~0 rows (approximately)

-- Dumping data for table inventory.loans: ~10 rows (approximately)
INSERT IGNORE INTO `loans` (`id`, `item_id`, `user_id`, `loan_date`, `expected_return_date`, `actual_return_date`, `purpose`, `status`, `created_at`, `updated_at`) VALUES
	(2, 133, 1, '2026-03-23', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-23 01:02:39', '2026-03-23 01:02:39'),
	(3, 134, 3, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:44:20', '2026-03-26 00:44:20'),
	(4, 135, 4, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:44:46', '2026-03-26 00:44:46'),
	(5, 136, 5, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:45:05', '2026-03-26 00:45:05'),
	(6, 145, 6, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:45:27', '2026-03-26 00:45:27'),
	(7, 137, 7, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:45:51', '2026-03-26 00:45:51'),
	(8, 138, 8, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:46:14', '2026-03-26 00:46:14'),
	(9, 139, 9, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 00:46:33', '2026-03-26 00:46:33'),
	(10, 155, 11, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 01:23:54', '2026-03-26 01:23:54'),
	(11, 140, 13, '2026-03-26', NULL, NULL, 'Sebagai fasilitas kantor', 'active', '2026-03-26 01:24:35', '2026-03-26 01:24:35');

-- Dumping data for table inventory.loan_logs: ~0 rows (approximately)

-- Dumping data for table inventory.locations: ~4 rows (approximately)
INSERT IGNORE INTO `locations` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'HO', 'Head Office', '2026-03-02 04:32:37', '2026-03-02 04:32:39'),
	(2, 'GD', 'Gudang Depok', '2026-03-02 04:32:54', '2026-03-02 04:32:55'),
	(3, 'KD', 'Kandang', '2026-03-02 04:33:07', '2026-03-02 04:33:07'),
	(4, 'KR', 'Karanganyar', '2026-03-02 04:33:19', '2026-03-02 04:33:20');

-- Dumping data for table inventory.migrations: ~11 rows (approximately)
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
	(11, '2026_06_03_041651_create_item_scan_logs_table', 4);

-- Dumping data for table inventory.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table inventory.sessions: ~2 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('iksk0JgHzauBLF58G7nOfDjs7qrK12WTQi2AJ14n', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiU3dmVktZV0JXeVBnZHFjQ2sxRnRmdXJqVEJlcVdvR0dBRDdLczVGcyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiYmYxOTJjY2Y2ZTdhYWJhYWQwOTU3ZTA1NjJkNGUzNTc0NTBiNTQ4ZTA5ZjRlYjljYTFiNzdkNGE3OTNkOWQxZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly9pbnZlbnRvcnkudGVzdDo4MS9pdGVtcy9zdGlja2VyP2Rvd25sb2FkPTEmaWRzPTUxJTJDNTIlMkM1MyI7czo1OiJyb3V0ZSI7czoxMzoiaXRlbXMuc3RpY2tlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoidGFibGVzIjthOjE6e3M6NDA6IjFlYjlhY2M5NzI2YWIxZWI4YWY0Y2MzZGUxYTYxMjI4X2NvbHVtbnMiO2E6OTp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6InFyX2NvZGUiO3M6NToibGFiZWwiO3M6NzoiUVIgQ29kZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Mjc6InZlaGljbGVEZXRhaWwubGljZW5zZV9wbGF0ZSI7czo1OiJsYWJlbCI7czoxMDoiTm8uIFBvbGlzaSI7czo4OiJpc0hpZGRlbiI7YjoxO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTM6ImNhdGVnb3J5Lm5hbWUiO3M6NToibGFiZWwiO3M6ODoiQ2F0ZWdvcnkiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjQ6Im5hbWUiO3M6NToibGFiZWwiO3M6NDoiTmFtZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToiYnJhbmQiO3M6NToibGFiZWwiO3M6NToiQnJhbmQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjE0OiJwdXJjaGFzZV9wcmljZSI7czo1OiJsYWJlbCI7czoxNDoiUHVyY2hhc2UgUHJpY2UiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6ImltYWdlIjtzOjU6ImxhYmVsIjtzOjU6IkltYWdlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiQ3JlYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6ODthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiVXBkYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX19fQ==', 1780541109),
	('SPpCIYeMbUNd1ycNBCQ0us9B2alBT5pZ4iGLvxIU', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzU0dFBCczRJSlFDVTlkblJRS01tR1BFa3pTWkU1RnVaZkFMN2x6TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvaW52ZW50b3J5L3B1YmxpYy9zY2FuL1NHTS1LRC0yMDI2MDAwMDIiO3M6NToicm91dGUiO3M6MTA6Iml0ZW1zLnNjYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780541225);

-- Dumping data for table inventory.users: ~22 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'General Affair', 'ga@sgm.com', NULL, '$2y$12$MK1w81JMAzb.Fsc/jvqwdeOaO0hm2iVFlCi/euFZI/Jm0Eyf7ugaS', 'ga', NULL, '2026-02-22 20:46:31', '2026-02-22 20:46:31'),
	(2, 'General Affair', 'general@sgm.com', NULL, '$2y$12$MK1w81JMAzb.Fsc/jvqwdeOaO0hm2iVFlCi/euFZI/Jm0Eyf7ugaS', 'staf', 'xJme08NnIYQ77E0f8ZYyp22Rj3foGjQPHmYHmYa3ttvBuvxvL5wFJlrgZOyc', '2026-02-23 23:59:44', '2026-02-23 23:59:44'),
	(3, 'Isna', 'isna@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(4, 'Wily', 'wily@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(5, 'Nurrul', 'nurrul@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(6, 'Galih', 'galih@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(7, 'Hery', 'hery@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(8, 'Beky Anggun', 'beky.anggun@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(9, 'Danang S', 'danang.s@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(11, 'Misbah', 'misbah@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(12, 'Fat', 'fat@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(13, 'Sunu', 'sunu@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(14, 'Olivia', 'olivia@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(15, 'Riyana', 'riyana@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(16, 'Rahmanda', 'rahmanda@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(17, 'Cahyo', 'cahyo@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(18, 'Adieb', 'adieb@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(19, 'Lala', 'lala@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(20, 'Almira', 'almira@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(21, 'Fajar', 'fajar@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(22, 'Fira', 'fira@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10'),
	(23, 'Satria', 'satria@gmail.com', NULL, NULL, 'staf', NULL, '2026-03-26 00:41:10', '2026-03-26 00:41:10');

-- Dumping data for table inventory.vehicle_details: ~32 rows (approximately)
INSERT IGNORE INTO `vehicle_details` (`id`, `item_id`, `license_plate`, `engine_number`, `chassis_number`, `created_at`, `updated_at`) VALUES
	(7, 51, 'AB 8618 BF ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(8, 52, 'AB 8619 BF', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(9, 53, 'AB 8177 KA', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(10, 54, 'AB 1931 GM ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(11, 55, 'AB 8911 BF ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(12, 56, 'AB 8054 BG', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(13, 57, 'AB 1922 GM ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(14, 58, 'AB 1739 K', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(15, 59, 'AB 8984 BK ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(16, 60, 'AB 1148 KA', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(17, 61, 'AB 8072 KA ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(18, 62, 'AB 8126 KA', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(19, 63, 'AB 8244 KA ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(20, 64, 'AB 8245 KA ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(21, 65, 'AB 8074 KA', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(22, 66, 'AB 8268 BF', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(23, 67, 'AB 8276 TB ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(24, 68, 'AB 8285 BE', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(25, 69, 'AB 1559 GI', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(26, 70, 'AB 1450 K', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(27, 71, 'AB 1847 GM ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(28, 72, 'AB 4818 RC', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(29, 73, 'AB 5165 LX', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(30, 74, 'AB 3181 TH', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(31, 75, 'AB 3686 IX', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(32, 76, 'AB 6944 OX ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(33, 77, 'AA 3370 JA ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(34, 78, 'AB 6829 VS ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(35, 79, 'AB 4888 RC ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(36, 80, 'AB 6145 LE ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(37, 81, 'AB 6635 ZF', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00'),
	(38, 82, 'AB 6828 VS ', NULL, NULL, '2026-03-09 18:46:00', '2026-03-09 18:46:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
