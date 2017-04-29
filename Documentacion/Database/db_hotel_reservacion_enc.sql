-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: db_hotel
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `reservacion_enc`
--

DROP TABLE IF EXISTS `reservacion_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservacion_enc` (
  `ID` varchar(100) NOT NULL DEFAULT '',
  `fecha_ini` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `IDUsuario` varchar(100) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_reservacion_enc` (`IDUsuario`),
  CONSTRAINT `FK_reservacion_enc` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservacion_enc`
--

LOCK TABLES `reservacion_enc` WRITE;
/*!40000 ALTER TABLE `reservacion_enc` DISABLE KEYS */;
INSERT INTO `reservacion_enc` VALUES ('100','2017-04-07 00:00:00','2017-04-08 00:00:00','2017003',200,'Facturado'),('101','2017-04-02 00:00:00','2017-04-06 00:00:00','2017005',200,'Facturado'),('102','2017-04-03 00:00:00','2017-04-05 00:00:00','2017005',200,'Facturado'),('103','2017-04-03 00:00:00','2017-04-05 00:00:00','2017006',200,'Cotizado'),('104','2017-04-01 00:00:00','2017-04-03 00:00:00','2017002',200,'Facturado'),('105','2017-03-25 00:00:00','2017-04-01 00:00:00','2017003',200,'Facturado'),('106','2017-04-29 00:00:00','2017-05-02 00:00:00','2017007',200,'Facturado'),('108','2017-04-24 00:00:00','2017-04-26 00:00:00','155802398030',150,'Cotizado'),('109','2017-04-27 00:00:00','2017-04-28 00:00:00','155802398030',150,'Cotizado'),('110','2017-04-27 00:00:00','2017-05-02 00:00:00','123',150,'Facturado');
/*!40000 ALTER TABLE `reservacion_enc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-28 20:27:38
