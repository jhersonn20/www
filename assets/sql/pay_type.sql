-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2013 at 03:42 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pay_type`
--

CREATE TABLE IF NOT EXISTS `pay_type` (
  `pay_type` varchar(100) NOT NULL,
  `pay_desc` varchar(100) NOT NULL,
  `flg_status` tinyint(4) NOT NULL,
  `PROGRESS_RECID` bigint(20) NOT NULL AUTO_INCREMENT,
  `loguser` varchar(100) NOT NULL,
  `logdate` date NOT NULL,
  `logupdate` varchar(100) NOT NULL,
  PRIMARY KEY (`PROGRESS_RECID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pay_type`
--

INSERT INTO `pay_type` (`pay_type`, `pay_desc`, `flg_status`, `PROGRESS_RECID`, `loguser`, `logdate`, `logupdate`) VALUES
('SI', 'Site Instruction', 1, 10, 'rcgomez', '0000-00-00', 'rcgomez 11:10:50'),
('MS', 'Milestone Bonus', 1, 12, 'rcgomez', '0000-00-00', 'rcgomez 11:15:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
