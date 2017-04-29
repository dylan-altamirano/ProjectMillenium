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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `ID` varchar(100) NOT NULL DEFAULT '',
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `pais` varchar(25) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `password` varbinary(50) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('123','Jose  Carlos','jocarlog@yahoo.com','US','Cliente','40bd001563085fc35165329ea1ff5c5ecbdbbeef',''),('155802398030','Dylan','dylan_altamirano@yahoo.com','Costa Rica','Cliente','81d73d4ea5b210ab78d6f4fa0778a8cbf3bf6439',''),('2017001','admin','admin@altamira.com','Costa Rica','Administrador','d033e22ae348aeb5660fc2140aec35850c4da997',''),('20170010','alexa','alexa@amazon.com','US','Cliente','bfdc12899d3bc57b97855392ffd5982ce875ab7a',''),('2017002','test','test@altamira.com','Costa Rica','Cliente','d94019fd760a71edf11844bb5c601a4de95aacaf',''),('2017003','Katherine','doaltamiranoce@est.utn.ac.cr','Costa Rica','Cliente','perro',''),('2017005','Carmen','caal@altamira.com','Panama','cliente','09e7c826ef231c9854ec1c90265facd51b52cad7',''),('2017006','Monica Ramirez','monicaal@aol.com','US','Cliente','jescasti93',''),('2017007','Melissa','dilan.altamirano@gmail.com','Costa Rica','Cliente','jescasti93',''),('2017009','alberto','d_altamirano45@hotmail.com','Costa Rica','Cliente','alberto',''),('22222222','jonathan','jcerdas@altamira.com','Costa Rica','Cliente','7c4a8d09ca3762af61e59520943dc26494f8941b','');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-28 20:27:39
