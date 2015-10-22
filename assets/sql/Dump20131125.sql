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
  `invoice_confirmed` date DEFAULT NULL,
  `invoice_remarks` varchar(1024) DEFAULT NULL,
  `submitted_amt` decimal(10,0) DEFAULT NULL,
  `billing_month` date DEFAULT NULL,
  PRIMARY KEY (`PROGRESS_RECID`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_invoice`
--

LOCK TABLES `billing_invoice` WRITE;
/*!40000 ALTER TABLE `billing_invoice` DISABLE KEYS */;
INSERT INTO `billing_invoice` VALUES ('1430','2013-11-22','2013-11-30','invNo_1','bankRef_1','2013-11-30','2013-12-01','HQ Remarks',5000,'MS','Client Remarks','rcgomez','rcgomez 2013-11-23 10:46:02',69,'','letNo_1','invlet_1','2013-11-25 00:09:44','2013-11-30','Invoice Remarkss',5000,'2013-11-01'),('1430','2013-11-23','2013-11-24','invNo_2','bankRef_2','2013-11-25','2013-11-26','HQ Remarks',10000,'SI','Client Reamrks','rcgomez','rcgomez 2013-11-23 10:29:49',70,'','letNo_2','invLet_2','2013-11-25 00:31:53','2013-11-25','Invoice Remarks',10000,'2013-10-01'),('1480','2013-11-23','2013-11-24','mhi_invNo1','mhi_bankRef1','2013-11-25','2013-11-26','HQ Remarks',25000,'MS','Client Remarks','rcgomez','rcgomez 2013-11-23 10:54:24',71,'','mhi_letNo1','mhi_invLet1','2013-11-25 00:09:55','2013-11-26','Invoice Remarks',25000,'2013-10-01');
/*!40000 ALTER TABLE `billing_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_billing_invoice`
--

DROP TABLE IF EXISTS `h_billing_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_billing_invoice` (
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
  `PROGRESS_RECID` bigint(20) NOT NULL,
  `file_origin` varchar(100) NOT NULL,
  `letter_no` varchar(100) NOT NULL,
  `invoice_letter` varchar(100) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `invoice_confirmed` date DEFAULT NULL,
  `invoice_remarks` varchar(1024) DEFAULT NULL,
  `submitted_amt` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`PROGRESS_RECID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_billing_invoice`
--

LOCK TABLES `h_billing_invoice` WRITE;
/*!40000 ALTER TABLE `h_billing_invoice` DISABLE KEYS */;
INSERT INTO `h_billing_invoice` VALUES ('1430','2013-11-22','2013-11-30','invNo_1','bankRef_1','2013-11-30','0000-00-00','',15000,'MS','Client Remarks','rcgomez','rcgomez 2013-11-22 07:55:07',69,'','letNo_1','invlet_1','2013-11-22 15:55:07','0000-00-00','',10000);
/*!40000 ALTER TABLE `h_billing_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'projdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-25 10:30:55
