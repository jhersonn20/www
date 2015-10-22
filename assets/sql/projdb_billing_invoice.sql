CREATE DATABASE  IF NOT EXISTS `projdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projdb`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: projdb
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `billing_invoice`
--

DROP TABLE IF EXISTS `billing_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_invoice` (
  `job_no` varchar(100) NOT NULL,
  `trans_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `client_bankref` varchar(100) NOT NULL,
  `bankref_date` date NOT NULL,
  `acctg_confirmed` date DEFAULT NULL,
  `acctg_remarks` varchar(100) NOT NULL,
  `invoice_amt` decimal(10,0) NOT NULL,
  `pay_type` varchar(100) NOT NULL,
  `proj_remarks` varchar(100) NOT NULL,
  `loguser` varchar(100) NOT NULL,
  `logupdate` varchar(100) NOT NULL,
  `PROGRESS_RECID` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_origin` varchar(100) NOT NULL,
  `letter_no` varchar(100) NOT NULL,
  `invoice_letter` varchar(100) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `invoice_confirmed` date NOT NULL,
  PRIMARY KEY (`PROGRESS_RECID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_invoice`
--

LOCK TABLES `billing_invoice` WRITE;
/*!40000 ALTER TABLE `billing_invoice` DISABLE KEYS */;
INSERT INTO `billing_invoice` VALUES ('34','2013-11-11','2013-11-11','a1b2c3','d4e5f6','2013-11-11','2013-11-11','HQ Remarks',100000,'SI','Project Remarks','rcgomez','rcgomez 2013-11-12 17:47:33',14,'15SUMMARY OF EXIT (CHART) 31DEC 2012(REVISED)aaa.pdf','a1','b1','2013-11-13 01:47:33','2013-11-11'),('34','2013-11-11','2013-11-11','a1b2c3_1','d4e5f6_1','2013-11-11','2013-11-11','HQ Remarks2',50000,'MS','Project Remarks2','rcgomez','rcgomez 2013-11-12 17:47:47',17,'214 (ver 2) by Rivermaya tabs @ Ultimate Guitar Archive.pdf','a2','b2','2013-11-13 01:47:47','2013-11-11'),('34','2013-10-12','2013-10-12','a1b2c3_2','d4e5f6_2','2013-10-12','2013-11-12','HQ Remarks3',1500,'SI','Project Remarks3','rcgomez','rcgomez 2013-11-12 10:58:10',50,'','a3','b3','2013-11-12 18:58:10','2013-11-12'),('33','2013-10-12','2013-11-12','dfd2d5w6','d8w5d6w1','2013-11-12','2013-11-12','Sample Confirmation',50000,'SI','Sample Transaction','rcgomez','rcgomez 2013-11-12 11:07:39',51,'','c1','d1','2013-11-12 19:07:39','0000-00-00'),('31','2013-10-12','2013-11-12','e8d5w2s6','e85d1a25','2013-11-12','2013-11-12','Sample Transaction',600000,'MS','Sample Transaction','rcgomez','rcgomez 2013-11-12 11:08:19',52,'','e1','f1','2013-11-12 19:08:19','0000-00-00'),('33','2013-11-12','2013-11-12','d8e515s6','w9r7f5as1q','2013-11-12','2013-11-12','Sample Confirmation',10000,'MS','Sample Transaction','rcgomez','rcgomez 2013-11-12 11:07:50',53,'','c2','d2','2013-11-12 19:07:50','0000-00-00');
/*!40000 ALTER TABLE `billing_invoice` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-13  6:13:21
