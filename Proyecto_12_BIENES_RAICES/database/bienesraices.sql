-- MySQL dump 10.13  Distrib 8.0.23, for macos10.15 (x86_64)
--
-- Host: localhost    Database: bienesraices
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamientos` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (1,'Propiedad1',1000.00,NULL,'Propiedad de ejemplo',5,4,3,NULL,10),(2,'Hermosa Casa en la playa',1200000.00,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat euismod neque eget elementum. Nam nec mauris purus. Sed euismod viverra orci ac laoreet. Fusce ut velit efficitur, pulvinar purus id, placerat augue. Phasellus ut sollicitudin odio. Suspendisse potenti. Suspendisse potenti. Phasellus vehicula quam malesuada nibh feugiat, in rhoncus justo consequat. Nam volutpat justo quis quam fermentum sollicitudin. Nulla scelerisque justo nec vehicula iaculis. Ut sodales molestie est, vel porttitor quam ultrices vel. Suspendisse eleifend posuere porttitor. Phasellus ligula diam, ornare quis lectus vel, lobortis aliquet nunc. Etiam ex nulla, laoreet a efficitur at, congue sit amet arcu. Morbi ut porta arcu. Praesent quis neque bibendum, blandit tellus at, euismod velit.',4,4,3,'2023-05-10',11),(3,'Hermosa Casa en la playa',1200000.00,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat euismod neque eget elementum. Nam nec mauris purus. Sed euismod viverra orci ac laoreet. Fusce ut velit efficitur, pulvinar purus id, placerat augue. Phasellus ut sollicitudin odio. Suspendisse potenti. Suspendisse potenti. Phasellus vehicula quam malesuada nibh feugiat, in rhoncus justo consequat. Nam volutpat justo quis quam fermentum sollicitudin. Nulla scelerisque justo nec vehicula iaculis. Ut sodales molestie est, vel porttitor quam ultrices vel. Suspendisse eleifend posuere porttitor. Phasellus ligula diam, ornare quis lectus vel, lobortis aliquet nunc. Etiam ex nulla, laoreet a efficitur at, congue sit amet arcu. Morbi ut porta arcu. Praesent quis neque bibendum, blandit tellus at, euismod velit.',4,4,3,'2023-05-10',12);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apellido` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numTelefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Carlos','Calderon','9999038088'),(10,'Alfonso ','Martinez','9999302520'),(11,'Pedro','Fernandez','9991221426'),(12,'Pedro','Fernandez','9991221426');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'bienesraices'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-09 23:24:06
