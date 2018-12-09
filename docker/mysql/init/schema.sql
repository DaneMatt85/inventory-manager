-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.22 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for inventory_manager
CREATE DATABASE IF NOT EXISTS `inventory_manager` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventory_manager`;

-- Dumping structure for table inventory_manager.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_user_key` (`user_id`),
  CONSTRAINT `cat_user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory_manager.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
REPLACE INTO `categories` (`id`, `user_id`, `name`, `created`, `modified`) VALUES
	(1, 1, 'Category 1', '2018-12-09 12:02:40', '2018-12-09 12:12:56'),
	(2, 1, 'Category 2', '2018-12-09 12:02:43', '2018-12-09 12:02:43');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table inventory_manager.categories_products
CREATE TABLE IF NOT EXISTS `categories_products` (
  `category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `prod_key` (`product_id`),
  CONSTRAINT `cat_key` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `prod_key` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory_manager.categories_products: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories_products` DISABLE KEYS */;
REPLACE INTO `categories_products` (`category_id`, `product_id`) VALUES
	(1, 1),
	(2, 1);
/*!40000 ALTER TABLE `categories_products` ENABLE KEYS */;

-- Dumping structure for table inventory_manager.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_key` (`user_id`),
  CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory_manager.products: ~1 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`id`, `user_id`, `name`, `created`, `modified`) VALUES
	(1, 1, 'Product 1', '2018-12-09 12:19:32', '2018-12-09 12:19:32');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table inventory_manager.skus
CREATE TABLE IF NOT EXISTS `skus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `sku` varchar(50) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_key` (`product_id`),
  CONSTRAINT `product_key` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory_manager.skus: ~2 rows (approximately)
/*!40000 ALTER TABLE `skus` DISABLE KEYS */;
REPLACE INTO `skus` (`id`, `product_id`, `sku`, `price`, `quantity`, `created`, `modified`) VALUES
	(1, 1, 'SKU1', 100, 10, '2018-12-09 12:19:32', '2018-12-09 12:19:32'),
	(2, 1, 'SKU2', 100, 10, '2018-12-09 12:19:32', '2018-12-09 12:19:32');
/*!40000 ALTER TABLE `skus` ENABLE KEYS */;

-- Dumping structure for table inventory_manager.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key_plain` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory_manager.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `username`, `password`, `api_key_plain`, `api_key`, `created`, `modified`) VALUES
	(1, 'admin', '$2y$10$PVRpm.meD4EsU7IpfMDE3ebGWJp8sNpf8sDyXpDjXD3Rp0E4F5ph2', '9c2aee61575b1764f534914c508a831e005b070c3671f8ac6561704e32de9c82', '$2y$10$DWPkR62C1dxM0rzYqBlLxO0LI5Iuq7J8/HxmFOWGnIAPbGLS8TZ7C', '2018-12-08 10:01:59', '2018-12-08 10:14:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
