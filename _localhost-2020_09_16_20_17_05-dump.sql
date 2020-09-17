-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: exchange
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `buys`
--

DROP TABLE IF EXISTS `buys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` int DEFAULT NULL,
  `fee` decimal(12,8) DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `confirm` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `buys___fk_currency` (`currency_id`),
  KEY `buys_users_id_fk` (`user_id`),
  CONSTRAINT `buys___fk_currency` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `buys_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buys`
--

LOCK TABLES `buys` WRITE;
/*!40000 ALTER TABLE `buys` DISABLE KEYS */;
INSERT INTO `buys` VALUES (3,42,44.00000000,1,88,'2020-09-16 11:25:40',NULL,1),(4,NULL,NULL,NULL,88,'2020-09-16 11:24:11','2020-09-16 11:24:11',0),(5,NULL,NULL,NULL,88,'2020-09-16 11:25:40','2020-09-16 11:25:40',0),(6,7,64.00000000,1,88,'2020-09-16 11:26:46','2020-09-16 11:26:46',1),(7,10,64.00000000,1,88,'2020-09-16 11:30:36','2020-09-16 11:30:36',0),(8,8,64.00000000,1,88,'2020-09-16 11:31:30','2020-09-16 11:31:30',1),(9,10,64.00000000,1,88,'2020-09-16 11:35:24','2020-09-16 11:35:24',0),(10,10,64.00000000,1,88,'2020-09-16 11:36:02','2020-09-16 11:36:02',0),(11,10,64.00000000,1,88,'2020-09-16 11:37:34','2020-09-16 11:37:34',0),(12,8,64.00000000,1,88,'2020-09-16 11:38:15','2020-09-16 11:37:46',1),(13,8,64.00000000,1,88,'2020-09-16 11:40:01','2020-09-16 11:39:58',1),(14,8,64.00000000,1,88,'2020-09-16 11:41:18','2020-09-16 11:41:18',1),(15,8,64.00000000,1,88,'2020-09-16 11:42:32','2020-09-16 11:42:32',1),(16,9,64.00000000,1,88,'2020-09-16 11:43:04','2020-09-16 11:43:04',1),(17,10,64.00000000,1,88,'2020-09-16 11:43:30','2020-09-16 11:43:30',0),(18,10,64.00000000,1,88,'2020-09-16 11:43:37','2020-09-16 11:43:37',0),(19,10,64.00000000,1,88,'2020-09-16 11:43:42','2020-09-16 11:43:42',0),(20,10,64.00000000,1,88,'2020-09-16 11:43:43','2020-09-16 11:43:43',0);
/*!40000 ALTER TABLE `buys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `currency` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD','USD'),(2,'ETH','Ethereum'),(3,'TRY','TRY'),(4,'XRP','xrp'),(5,'IOTA','Iota'),(6,'EURO','euro'),(7,'ETC','ETC');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deposits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `currency_id` int DEFAULT NULL,
  `balance` decimal(12,8) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposits___fk_currency` (`currency_id`),
  KEY `deposits_users_id_fk` (`user_id`),
  CONSTRAINT `deposits___fk_currency` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `deposits_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (1,1,-64.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26',88),(2,2,1.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26',88),(3,2,-1.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26',NULL),(4,1,1.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26',NULL),(5,1,-256.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27',88),(6,2,4.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27',88),(7,2,-4.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27',88),(8,1,256.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27',88),(9,1,-640.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13',88),(10,2,10.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13',88),(11,2,-10.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13',88),(12,1,640.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13',88),(13,1,-640.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21',88),(14,2,10.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21',88),(15,2,-10.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21',88),(16,1,640.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21',88),(17,1,-640.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46',88),(18,2,10.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46',88),(19,2,-10.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46',88),(20,1,640.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46',88),(21,1,-576.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54',88),(22,2,9.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54',88),(23,2,-9.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54',88),(24,1,576.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54',88),(25,NULL,NULL,'2020-09-16 13:07:01','2020-09-16 13:07:01',NULL),(26,1,1000.00000000,'2020-09-16 13:08:05','2020-09-16 13:08:05',92),(27,1,1000.00000000,'2020-09-16 13:08:22','2020-09-16 13:08:22',93),(28,1,-640.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13',88),(29,2,10.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13',88),(30,2,-10.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13',88),(31,1,640.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13',88);
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sells` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` int DEFAULT NULL,
  `fee` decimal(12,8) DEFAULT NULL,
  `confirm` tinyint DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sells_users_id_fk` (`user_id`),
  CONSTRAINT `sells_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sells`
--

LOCK TABLES `sells` WRITE;
/*!40000 ALTER TABLE `sells` DISABLE KEYS */;
/*!40000 ALTER TABLE `sells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade_history`
--

DROP TABLE IF EXISTS `trade_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trade_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `buy_currency_id` int DEFAULT NULL,
  `sell_currency_id` int DEFAULT NULL,
  `buy_fee` decimal(12,8) DEFAULT NULL,
  `sell_fee` decimal(12,8) DEFAULT NULL,
  `amount` decimal(12,8) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trade_history_users_id_fk` (`user_id`),
  KEY `trade_history___fkc` (`buy_currency_id`),
  KEY `trade_history___fkb` (`sell_currency_id`),
  CONSTRAINT `trade_history___fkb` FOREIGN KEY (`sell_currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `trade_history___fkc` FOREIGN KEY (`buy_currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `trade_history_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade_history`
--

LOCK TABLES `trade_history` WRITE;
/*!40000 ALTER TABLE `trade_history` DISABLE KEYS */;
INSERT INTO `trade_history` VALUES (1,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:42','2020-09-16 12:00:42'),(2,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:50','2020-09-16 12:00:50'),(3,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:53','2020-09-16 12:00:53'),(4,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:53','2020-09-16 12:00:53'),(5,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(6,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(7,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(8,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(9,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(10,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:00:54','2020-09-16 12:00:54'),(11,88,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26'),(12,NULL,1,2,64.00000000,1.00000000,1.00000000,'2020-09-16 12:05:26','2020-09-16 12:05:26'),(13,88,1,2,64.00000000,64.00000000,4.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27'),(14,88,1,2,64.00000000,64.00000000,4.00000000,'2020-09-16 12:05:27','2020-09-16 12:05:27'),(15,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13'),(16,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:13','2020-09-16 12:06:13'),(17,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21'),(18,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:21','2020-09-16 12:06:21'),(19,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46'),(20,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 12:06:46','2020-09-16 12:06:46'),(21,88,1,2,64.00000000,64.00000000,9.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54'),(22,88,1,2,64.00000000,64.00000000,9.00000000,'2020-09-16 12:06:54','2020-09-16 12:06:54'),(23,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13'),(24,88,1,2,64.00000000,64.00000000,10.00000000,'2020-09-16 15:41:13','2020-09-16 15:41:13');
/*!40000 ALTER TABLE `trade_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_pk` (`email`),
  UNIQUE KEY `users_pk_2` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (87,'ehsan','ehsasn@gmail.com','123','09125126491','2020-09-15 15:10:50','2020-09-15 15:10:50'),(88,'ehsan','ehsan3@gmail.com','202cb962ac59075b964b07152d234b70','09125126493','2020-09-15 15:13:03','2020-09-15 15:13:03'),(89,'ehsan','ehsan@gmail.com','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTIzIn0.w7PpX6w0gaZCjCZe2Q_WpTDOqZtcz8ZY0pxnYiLiq_c','09125126494','2020-09-15 15:34:36','2020-09-15 15:34:36'),(90,'ehsan','ehsan5@gmail.com','e5c0e7bdf92a83d312baa7ba18af2bc4','09125126495','2020-09-16 13:05:25','2020-09-16 13:05:25'),(91,'ehsan','ehsan6@gmail.com','e5c0e7bdf92a83d312baa7ba18af2bc4','09125126496','2020-09-16 13:07:01','2020-09-16 13:07:01'),(92,'ehsan','ehsan7@gmail.com','e5c0e7bdf92a83d312baa7ba18af2bc4','09125126497','2020-09-16 13:08:05','2020-09-16 13:08:05'),(93,'ehsan','ehsan8@gmail.com','e5c0e7bdf92a83d312baa7ba18af2bc4','09125126498','2020-09-16 13:08:22','2020-09-16 13:08:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-16 20:17:05
