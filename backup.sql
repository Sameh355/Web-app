-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: sameh_delivery
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'customer',
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT 'available',
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `driver_id` varchar(225) NOT NULL,
  `vehicle_model` varchar(225) NOT NULL,
  `id_picture` varchar(225) NOT NULL,
  `license_picture` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (1,'Driver 1','available','','','','','','',''),(2,'Driver 2','available','','','','','','',''),(3,'Sam','available','sam@gmail.com','$2y$10$yJWFa6M5r0Io/6U7T.HJUe4u4FcPbZCnau0h30izVuUeUiowvImiO','driver','8956','Honda','314.png','Screenshot 2024-04-22 112823.png'),(4,'Jhon','available','jhon@gmail.com','$2y$10$7evFlTzWWbEW12xTb7i4a.GimMIHenAK2VjjoriSj5QpgoKT.hPCW','driver','0123','Honda','Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png'),(5,'james','available','j@gmail.com','$2y$10$167LhMFyz.kIDWy30JYXseUISb.am1/9Sa.epsRWbSFM0OHthzs3O','driver','012345','Honda','Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png'),(6,'moon','available','moon@gmail.com','$2y$10$ySPYvjfSrTSSdbmpE4swGOG0QIEZsccV9IQhllkEksZlquFoR2Aia','driver','01','Yamaha','Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png'),(7,'moo','available','moo@gmail.com','$2y$10$0PyAvom6Ow7omCob0YkKWusXsKV5zJCM.6yiJLx7Gs2aPcTaznXI6','driver','00000','Honda','Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png'),(8,'mmna','available','nn@gmail.com','$2y$10$khXqfqzbgJSO7f.F4LqyiuYsumPmn21l/m9bzUmOMfjeV2.07cZue','driver','0159','Honda','Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `driver_id` int DEFAULT NULL,
  `status` enum('pending','picked up','delivered') DEFAULT 'pending',
  `client_name` varchar(100) DEFAULT NULL,
  `address` text,
  `contact` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tracking_number` varchar(50) NOT NULL,
  `pickup_address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(100) NOT NULL,
  `delivery_time` time DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_name` varchar(255) DEFAULT NULL,
  `delivery_time_weekday` time DEFAULT NULL,
  `delivery_time_weekend` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracking_number` (`tracking_number`),
  KEY `client_id` (`client_id`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (10,26,NULL,'pending',NULL,NULL,NULL,'2024-10-05 18:54:15','TRK-67018b5722843','wr','5',NULL,'2024-10-05 18:54:15','wt','12:57:00','21:59:00'),(12,27,NULL,'pending',NULL,NULL,NULL,'2024-10-05 19:48:27','TRK-6701980b86cf0','qw','8',NULL,'2024-10-05 19:48:27','qw','16:48:00','16:48:00'),(19,28,NULL,'pending',NULL,'asia1',NULL,'2024-10-08 03:31:51','TRK-6704a7a77fb92','asia','446',NULL,'2024-10-08 03:31:51','qwe','10:31:00','09:31:00');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `driver_id` varchar(255) DEFAULT NULL,
  `id_picture` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `vehicle_model` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sameh','sameh.gerges@gamil.com','$2y$10$Y1hXaUGh9tpCHrkeGmsu3uSXlxUGqQzqTlb0T2H/2b0s8B3tuqFVm','client','2024-09-18 14:05:52','f49b1da7ed1ccb0df72644417732f055ed1e617d668cb1347c8d23cff7532f5d4685462f3ac2133e8c3e270970b3d028876c','2024-09-23 16:30:07',NULL,NULL,NULL,NULL),(2,'Sam','sam.gerges@gmail.com','$2y$10$mQSgeZCahoOMrBxHMQpyEeltTiyMnOklgQlYkU5bICKgr6Lnlptlu','client','2024-09-18 14:49:29',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Priscillathe','thebraveychick@gmail.com','$2y$10$OTAfWVMhufNG3MFFZWUcyulk9V4mZC4Ym4SUxK09eAOsBt2/3fdIO','client','2024-09-19 06:03:46',NULL,NULL,NULL,NULL,NULL,NULL),(4,'123','123@12','$2y$10$r.tD54qwZqkr/CjTHD3ASuTwMx5feKt/7ra/Y2FYbZLM.nfXTez66','client','2024-09-19 07:16:26',NULL,NULL,NULL,NULL,NULL,NULL),(5,'sa','sa@gmail','$2y$10$qvpv1Z0UzCulKmgxPdQ1VOTU9SqEko9KIBTyPFLohyZwxZ04ps25C','client','2024-09-23 12:35:19',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Rahim','Rahim@gmail.com','$2y$10$qQ6o7cLIiGfM2wQossyR4O6YXlPlpAX.C1hUieNNiN8yOLsZQbGem','client','2024-09-24 06:07:32',NULL,NULL,NULL,NULL,NULL,NULL),(7,'sameh','sm@gmail.com','$2y$10$wwcam2y8S/8koSV1sctl0.DmvA8JPoRECuZuHb.mxt49JsoOEMSmW','client','2024-09-25 08:41:28',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Admin User','admin@example.com','admin123','admin','2024-09-25 08:54:13',NULL,NULL,NULL,NULL,NULL,NULL),(9,'admin','admin@gmail.com','$2y$10$kDiL.BA4GnWkNqNRXsxQveIX/EhVkWtMBqMQXijRSV6yNfiG90ZRu','client','2024-09-25 14:29:13',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Admin User','admin@gamil.com','$2y$10$uBr4ZzNjm2zjb/OcDi0n1O2NTcFtEC0uBOdx1TzHFu4hmxr9N0npS','admin','2024-09-25 14:33:02',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Admin User','admin1@gmail.com','$2y$10$kB2WNtOrPhQI21dQbNFai.7SxtSiSYug7BqWPC60R5JymqXekyJue','admin','2024-09-25 14:48:57',NULL,NULL,NULL,NULL,NULL,NULL),(17,'New Admin','newadmin@example.com','$2y$10$Kj3gF4HzcPQ...','admin','2024-09-25 14:55:08',NULL,NULL,NULL,NULL,NULL,NULL),(18,'s','s@g.com','$2y$10$kZSvMLz5LKZP0d.iL9J5kO4FH7zbxZyyVoS00NfnXv1bnc/Jspnye','client','2024-09-30 09:15:01',NULL,NULL,NULL,NULL,NULL,NULL),(19,'SA','SA@g.com','$2y$10$31fZVUxVGqHuVMwppOBUFOQDe10AsOcvCCy7CW9gCfKjkOismqLlO','client','2024-09-30 09:56:39',NULL,NULL,NULL,NULL,NULL,NULL),(20,'sameh','sd@gmail.com','$2y$10$1fpNFPbxlunl6Z/CVpRA2ufjDFraaoI/OJGLQ8IjBV9Qzl6bL8Ec6','client','2024-10-05 12:39:00',NULL,NULL,NULL,NULL,NULL,NULL),(21,'q','a@gmail.com','$2y$10$VQeXOUp/HF6ccyrvzkU.d.vOLxYq0xpq3PX/xx7sdlZD4GbY5o2rC','client','2024-10-05 17:58:46',NULL,NULL,NULL,NULL,NULL,NULL),(22,NULL,'w@gmail.com','$2y$10$u9B4TRSucKDum1rF/ewQ2eMK20h5hrnoUL7rmYmeX2HSi8RkWpYDe','admin','2024-10-05 18:07:01',NULL,NULL,NULL,NULL,NULL,NULL),(23,'q','q@gmail.com','$2y$10$1j32tDgRbUSBPAd7EaOkJ.bp7WwI6VCq26sJYCLVchnwVrFgEwpfO','admin','2024-10-05 18:07:17',NULL,NULL,NULL,NULL,NULL,NULL),(24,'o','o@gmail.com','$2y$10$GAzCeH1D.gJ.wEkY8Zs9B.wMWEE6zLENgh7V8Es92oslxH0SY.QvS','admin','2024-10-05 18:12:25',NULL,NULL,NULL,NULL,NULL,NULL),(25,'z','z@gmail.com','$2y$10$bNCQyNsaKR4c5pBtivd72OQf00LMGYxvzoRX5AIgfK7Mohys1dY6a','admin','2024-10-05 18:30:26',NULL,NULL,NULL,NULL,NULL,NULL),(26,'x','x@gmail.com','$2y$10$DQYS0VmAD6waRYihxBPNfeu93xQxuN5WMcx9Xi8oXC1QRtfpl1Zrm','client','2024-10-05 18:33:38',NULL,NULL,NULL,NULL,NULL,NULL),(27,'c','c@gmail.com','$2y$10$wUCngKjqIt1cLQffl5ZHNuRngm4L13BMvztV6EbCkaZFkukUcBnxG','client','2024-10-05 19:15:26',NULL,NULL,NULL,NULL,NULL,NULL),(28,'b','b@gmail.com','$2y$10$qLjG4.Ca63phS0sjR8kQ7ulBrNN1J.SulBest7b/cGD3Y8JPHlrXO','client','2024-10-06 02:58:40',NULL,NULL,NULL,NULL,NULL,NULL),(29,'u','u@gmail.com','$2y$10$qlFabAU4KJEICOvKqTPGo.i/75rHP..T5x7Q0saq4Nwaby1r1jUYK','client','2024-10-06 04:34:34',NULL,NULL,NULL,NULL,NULL,NULL),(30,'sameh','i@gmail.com','$2y$10$WTp0ndCkQ/ZifmGYNuXaJuBIuqq8YTKMdhH9CYHIzPc1ZEks8gVj.','client','2024-10-06 12:56:36',NULL,NULL,NULL,NULL,NULL,NULL),(33,'k','k@gmail.com','$2y$10$u7AY42olsIYJA/CBHBGOU.eI0dLXMcfA0fP7/40ugkhBshZyjfodu','client','2024-10-06 13:09:37',NULL,NULL,NULL,NULL,NULL,NULL),(34,'oli','ol@gmail.com','$2y$10$zr3OxM8c2WZ6zU7RUEz57eESMNKjY2GTWKoF5Bdp.YJT9m7uGRD7O','client','2024-10-06 13:33:07',NULL,NULL,NULL,NULL,NULL,NULL),(35,'rt','rt@gmail.com','$2y$10$ThI2ARQEACmYYIOM2Tx23ObTBxd8N2bM./gEiZQUFqEeGwdNoHdO6','client','2024-10-07 03:51:25',NULL,NULL,NULL,NULL,NULL,NULL),(36,'bn','bn@gmail.com','$2y$10$LU0TOr2b6VNkCizl.TEltuXZIvVUx730JYICqUwoTpre0IE1IigPS','client','2024-10-07 03:51:57',NULL,NULL,NULL,NULL,NULL,NULL),(37,'mmm','mm@gmail.com','$2y$10$haf77nkNFsXl3JPRbxzzFuo2N0Jpzf3uRSIVYKcdW3z0Xy6vFQzy2','client','2024-10-07 04:37:19',NULL,NULL,NULL,NULL,NULL,NULL),(38,'Jok','jk@gmail.com','$2y$10$Y2vt8jrHvlDjrwlEZDGrf.A0597SG.d03ufZOu2I/7sGX0XHbvmMG','client','2024-10-07 09:28:55',NULL,NULL,NULL,NULL,NULL,NULL),(39,'jef','jef@gmail.com','$2y$10$8jPb5kpB9kPmYaIamjRsUezYN1UNueSiXpmLLRJrHe3iYMzfPMkdO','client','2024-10-07 09:36:59',NULL,NULL,NULL,NULL,NULL,NULL),(40,'jak','jack@gmail.com','$2y$10$yp8ynH2IotUYLAAVCUSrkOmsUtJbRDcjadf5t6zv.m85.KHu51Gqe','customer','2024-10-07 09:46:00',NULL,NULL,NULL,NULL,NULL,NULL),(41,'Sameh','aqw@gmail.com','$2y$10$3KRrg3EvMexmM5Lc.AKWge3rOWum7/Y6mkdF6Z5HbhCVzSCqUt5ka','customer','2024-10-07 10:15:03',NULL,NULL,NULL,NULL,NULL,NULL),(42,'ty','ty@gmail.com','$2y$10$wFkX1tXeSDduGLUpdJtofu9yk5oQLVz0CJ3Edc21gRbRjeNNRpFyO','customer','2024-10-07 10:24:10',NULL,NULL,NULL,NULL,NULL,NULL),(45,'Driver Name','driver@example.com','newHashedPassword','driver','2024-10-07 10:50:10',NULL,NULL,NULL,NULL,NULL,NULL),(46,'mona','mona@gmail.com','$2y$10$eGrwJSDIoafZfznQxh/Esu1BR5Je0Fn2vsMLZrjd.9sGJRlDRVu3e','customer','2024-10-07 10:51:13',NULL,NULL,NULL,NULL,NULL,NULL),(47,'mina','mina@gmail.com','$2y$10$4iDKnw2yZ6I5iul60MMOle/yVtAiIijDO1C3SbdoQSRABNpnjTye2','driver','2024-10-07 14:53:32',NULL,NULL,NULL,'Screenshot 2024-04-22 112823.png','Screenshot 2024-04-22 112823.png','Honda'),(48,'mooom','mooom@gmail.com','$2y$10$d6XA8ryRe7CWIsXvcc7oj.QHknaVukcrj8E1COLJ.u2eArWPVKnji','customer','2024-10-07 16:05:18',NULL,NULL,NULL,NULL,NULL,NULL),(49,'sameh','ger@gmail.com','$2y$10$sZYdYgAOi6pOlz3V8ky9TOM4iugbu3Tuywwkw9m6DBU5KaRxZaiSi','customer','2024-10-08 04:38:23',NULL,NULL,NULL,NULL,NULL,NULL),(50,'mki','mki@gmail.com','$2y$10$2tZ7PWf2Aq2sF3VGh.BEHuOiajJLzlO8hKjLqZ3mc5/4eHWd8Rnbm','customer','2024-10-08 04:44:54',NULL,NULL,NULL,NULL,NULL,NULL),(51,'loi','loi@gmail.com','$2y$10$PixMvkWUVX4q01wEwlHhLult1OWZ8giz6xc4/sv7ckJy6aK41yEAu','customer','2024-10-08 04:48:31',NULL,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2024-10-08 11:17:03
