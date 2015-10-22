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
-- Dumping events for database 'projdb'
--

--
-- Dumping routines for database 'projdb'
--
/*!50003 DROP PROCEDURE IF EXISTS `bcStatus_q` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `bcStatus_q`()
BEGIN
	create temporary table if not exists qry_tbl(
		job_no varchar(1024),
		job_desc varchar(1024),
		proj_amt decimal(17,2) not null,
		contribution_rate decimal(17,2) not null,
		contribution decimal(17,2) not null,
		budget decimal(17,2) not null,
		billing_amt_1 decimal(17,2) not null,
		invoice_amt_1 decimal(17,2) not null,
		coll_amt_1 decimal(17,2) not null,
		billing_date_1 date,
		invoice_date_1 date,
		coll_date_1 date,
		billing_lag_1 varchar(1024) not null,
		invoice_lag_1 varchar(1024) not null,
		coll_lag_1 varchar(1024) not null,
		billing_amt_2 decimal(17,2) not null,
		invoice_amt_2 decimal(17,2) not null,
		coll_amt_2 decimal(17,2) not null,
		billing_date_2 date,
		invoice_date_2 date,
		coll_date_2 date,
		billing_lag_2 varchar(1024),
		invoice_lag_2 varchar(1024),
		coll_lag_2 varchar(1024),
		billing_amt_3 decimal(17,2) not null,
		invoice_amt_3 decimal(17,2) not null,
		coll_amt_3 decimal(17,2) not null,
		billing_date_3 date,
		invoice_date_3 date,
		coll_date_3 date,
		billing_lag_3 varchar(1024),
		invoice_lag_3 varchar(1024),
		coll_lag_3 varchar(1024),
		billing_amt_4 decimal(17,2) not null,
		invoice_amt_4 decimal(17,2) not null,
		coll_amt_4 decimal(17,2) not null,
		billing_date_4 date,
		invoice_date_4 date,
		coll_date_4 date,
		billing_lag_4 varchar(1024),
		invoice_lag_4 varchar(1024),
		coll_lag_4 varchar(1024),
		billing_amt_5 decimal(17,2) not null,
		invoice_amt_5 decimal(17,2) not null,
		coll_amt_5 decimal(17,2) not null,
		billing_date_5 date,
		invoice_date_5 date,
		coll_date_5 date,
		billing_lag_5 varchar(1024),
		invoice_lag_5 varchar(1024),
		coll_lag_5 varchar(1024),
		billing_amt_6 decimal(17,2) not null,
		invoice_amt_6 decimal(17,2) not null,
		coll_amt_6 decimal(17,2) not null,
		billing_date_6 date,
		invoice_date_6 date,
		coll_date_6 date,
		billing_lag_6 varchar(1024),
		invoice_lag_6 varchar(1024),
		coll_lag_6 varchar(1024),
		billing_amt_7 decimal(17,2) not null,
		invoice_amt_7 decimal(17,2) not null,
		coll_amt_7 decimal(17,2) not null,
		billing_date_7 date,
		invoice_date_7 date,
		coll_date_7 date,
		billing_lag_7 varchar(1024),
		invoice_lag_7 varchar(1024),
		coll_lag_7 varchar(1024),
		billing_amt_8 decimal(17,2) not null,
		invoice_amt_8 decimal(17,2) not null,
		coll_amt_8 decimal(17,2) not null,
		billing_date_8 date,
		invoice_date_8 date,
		coll_date_8 date,
		billing_lag_8 varchar(1024),
		invoice_lag_8 varchar(1024),
		coll_lag_8 varchar(1024),
		billing_amt_9 decimal(17,2) not null,
		invoice_amt_9 decimal(17,2) not null,
		coll_amt_9 decimal(17,2) not null,
		billing_date_9 date,
		invoice_date_9 date,
		coll_date_9 date,
		billing_lag_9 varchar(1024),
		invoice_lag_9 varchar(1024),
		coll_lag_9 varchar(1024),
		billing_amt_10 decimal(17,2) not null,
		invoice_amt_10 decimal(17,2) not null,
		coll_amt_10 decimal(17,2) not null,
		billing_date_10 date,
		invoice_date_10 date,
		coll_date_10 date,
		billing_lag_10 varchar(1024),
		invoice_lag_10 varchar(1024),
		coll_lag_10 varchar(1024),
		billing_amt_11 decimal(17,2) not null,
		invoice_amt_11 decimal(17,2) not null,
		coll_amt_11 decimal(17,2) not null,
		billing_date_11 date,
		invoice_date_11 date,
		coll_date_11 date,
		billing_lag_11 varchar(1024),
		invoice_lag_11 varchar(1024),
		coll_lag_11 varchar(1024),
		billing_amt_12 decimal(17,2) not null,
		invoice_amt_12 decimal(17,2) not null,
		coll_amt_12 decimal(17,2) not null,
		billing_date_12 date,
		invoice_date_12 date,
		coll_date_12 date,
		billing_lag_12 varchar(1024),
		invoice_lag_12 varchar(1024),
		coll_lag_12 varchar(1024),
		billing_remarks varchar(1024),
		invoice_remarks varchar(1024),
		coll_remarks varchar(1024)
	);
	
	insert into qry_tbl(job_no, job_desc, proj_amt, contribution_rate, contribution, budget)
		select t2.job_no, if(t2.client = '', t2.job_desc, concat(t2.job_desc, ' (', t2.client, ')')), t2.contract_amt, t2.contribution_rate, t2.contribution_amt, t2.budget from gendb.user_job t inner join projdb.job_tbl t2
			on t.job_no = t2.job_no
			where t.user_id = @user_id and
				  t2.type = @type order by t.job_no;

	-- update qry_tbl t inner join (select sum(submitted_amt) as submitted_amt, sum(invoice_amt) as invoice_amt, job_no, billing_month, trans_date, invoice_date, acctg_confirmed, acctg_remarks from projdb.billing_invoice where acctg_confirmed is not null group by job_no, billing_month) t2
	-- 		on t.job_no = t2.job_no
	set @baseMonth = month(convert(@baseDate, date)),
		@baseYear = year(convert(@baseDate, date));
		update qry_tbl t
			set billing_amt_1 = t.billing_amt_1 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				billing_date_1 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				billing_lag_1 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
		 		invoice_amt_1 = t.invoice_amt_1 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				invoice_date_1 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				invoice_lag_1 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
		 		coll_amt_1 = t.coll_amt_1 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_1 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_1 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_2 = t.billing_amt_2 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_2 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_2 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_2 = t.invoice_amt_2 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_2 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_2 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_2 = t.coll_amt_2 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_2 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_2 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_3 = t.billing_amt_3 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_3 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_3 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_3 = t.invoice_amt_3 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_3 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_3 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_3 = t.coll_amt_3 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_3 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_3 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_4 = t.billing_amt_4 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_4 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_4 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_4 = t.invoice_amt_4 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_4 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_4 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_4 = t.coll_amt_4 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_4 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_4 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_5 = t.billing_amt_5 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_5 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_5 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_5 = t.invoice_amt_5 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_5 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_5 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_5 = t.coll_amt_5 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_5 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_5 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_6 = t.billing_amt_6 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_6 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_6 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_6 = t.invoice_amt_6 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_6 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_6 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_6 = t.coll_amt_6 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_6 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_6 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_7 = t.billing_amt_7 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_7 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_7 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_7 = t.invoice_amt_7 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_7 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_7 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_7 = t.coll_amt_7 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_7 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_7 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_8 = t.billing_amt_8 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_8 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_8 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_8 = t.invoice_amt_8 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_8 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_8 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_8 = t.coll_amt_8 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_8 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_8 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_9 = t.billing_amt_9 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_9 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_9 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_9 = t.invoice_amt_9 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_9 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_9 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_9 = t.coll_amt_9 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_9 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_9 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_10 = t.billing_amt_10 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_10 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_10 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_10 = t.invoice_amt_10 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_10 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_10 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_10 = t.coll_amt_10 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_10 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_10 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_11 = t.billing_amt_11 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_11 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_11 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_11 = t.invoice_amt_11 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_11 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_11 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_11 = t.coll_amt_11 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_11 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_11 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_12 = t.billing_amt_12 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_12 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_12 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_12 = t.invoice_amt_12 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_12 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_12 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_12 = t.coll_amt_12 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_12 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_12 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				billing_remarks = (select GROUP_CONCAT(proj_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB'),
				invoice_remarks = (select GROUP_CONCAT(invoice_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB'),
				coll_remarks = (select GROUP_CONCAT(acctg_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null);

		set @total:=(select count(*) from qry_tbl);
		-- set @exec_stm:="select @total as total, t.* from qry_tbl t order by job_no limit @start_var,@pageSize_var;";
		-- if @where_stm != '' then
		-- 	set @exec_stm:=concat('select @total as total,t.* from qry_tbl t where ', @where_stm, ' order by job_no limit @start_var,@pageSize_var;');
	 	-- end if;
	 	-- PREPARE stmt FROM @exec_stm;
	 	-- EXECUTE stmt ;
	 	-- DEALLOCATE PREPARE stmt;	
		set @exec_stm:=concat("select @total as total, t.* from qry_tbl t ", if(@where_stm = "", "", concat("where ", @where_stm)) ," order by t.job_no limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
	 	PREPARE stmt FROM @exec_stm;
	 	EXECUTE stmt ;
	 	DEALLOCATE PREPARE stmt;	
		-- select @exec_stm;

	drop table qry_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `bcStatus_sp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `bcStatus_sp`(
	ip_query varchar(1024),
	ip_user varchar(1024)
)
BEGIN
	create temporary table if not exists qry_tbl(
		job_no varchar(1024),
		job_desc varchar(1024),
		type varchar(1024),
		month1_label varchar(1024),
		month2_label varchar(1024),
		month3_label varchar(1024),
		month4_label varchar(1024),
		month5_label varchar(1024),
		month6_label varchar(1024),
		month7_label varchar(1024),
		month8_label varchar(1024),
		month9_label varchar(1024),
		month10_label varchar(1024),
		month11_label varchar(1024),
		month12_label varchar(1024),
		proj_amt decimal(17,2) not null,
		contribution_rate decimal(17,2) not null,
		contribution decimal(17,2) not null,
		budget decimal(17,2) not null,
		billing_amt_1 decimal(17,2) not null,
		invoice_amt_1 decimal(17,2) not null,
		coll_amt_1 decimal(17,2) not null,
		billing_date_1 date,
		invoice_date_1 date,
		coll_date_1 date,
		billing_lag_1 varchar(1024) not null,
		invoice_lag_1 varchar(1024) not null,
		coll_lag_1 varchar(1024) not null,
		billing_amt_2 decimal(17,2) not null,
		invoice_amt_2 decimal(17,2) not null,
		coll_amt_2 decimal(17,2) not null,
		billing_date_2 date,
		invoice_date_2 date,
		coll_date_2 date,
		billing_lag_2 varchar(1024),
		invoice_lag_2 varchar(1024),
		coll_lag_2 varchar(1024),
		billing_amt_3 decimal(17,2) not null,
		invoice_amt_3 decimal(17,2) not null,
		coll_amt_3 decimal(17,2) not null,
		billing_date_3 date,
		invoice_date_3 date,
		coll_date_3 date,
		billing_lag_3 varchar(1024),
		invoice_lag_3 varchar(1024),
		coll_lag_3 varchar(1024),
		billing_amt_4 decimal(17,2) not null,
		invoice_amt_4 decimal(17,2) not null,
		coll_amt_4 decimal(17,2) not null,
		billing_date_4 date,
		invoice_date_4 date,
		coll_date_4 date,
		billing_lag_4 varchar(1024),
		invoice_lag_4 varchar(1024),
		coll_lag_4 varchar(1024),
		billing_amt_5 decimal(17,2) not null,
		invoice_amt_5 decimal(17,2) not null,
		coll_amt_5 decimal(17,2) not null,
		billing_date_5 date,
		invoice_date_5 date,
		coll_date_5 date,
		billing_lag_5 varchar(1024),
		invoice_lag_5 varchar(1024),
		coll_lag_5 varchar(1024),
		billing_amt_6 decimal(17,2) not null,
		invoice_amt_6 decimal(17,2) not null,
		coll_amt_6 decimal(17,2) not null,
		billing_date_6 date,
		invoice_date_6 date,
		coll_date_6 date,
		billing_lag_6 varchar(1024),
		invoice_lag_6 varchar(1024),
		coll_lag_6 varchar(1024),
		billing_amt_7 decimal(17,2) not null,
		invoice_amt_7 decimal(17,2) not null,
		coll_amt_7 decimal(17,2) not null,
		billing_date_7 date,
		invoice_date_7 date,
		coll_date_7 date,
		billing_lag_7 varchar(1024),
		invoice_lag_7 varchar(1024),
		coll_lag_7 varchar(1024),
		billing_amt_8 decimal(17,2) not null,
		invoice_amt_8 decimal(17,2) not null,
		coll_amt_8 decimal(17,2) not null,
		billing_date_8 date,
		invoice_date_8 date,
		coll_date_8 date,
		billing_lag_8 varchar(1024),
		invoice_lag_8 varchar(1024),
		coll_lag_8 varchar(1024),
		billing_amt_9 decimal(17,2) not null,
		invoice_amt_9 decimal(17,2) not null,
		coll_amt_9 decimal(17,2) not null,
		billing_date_9 date,
		invoice_date_9 date,
		coll_date_9 date,
		billing_lag_9 varchar(1024),
		invoice_lag_9 varchar(1024),
		coll_lag_9 varchar(1024),
		billing_amt_10 decimal(17,2) not null,
		invoice_amt_10 decimal(17,2) not null,
		coll_amt_10 decimal(17,2) not null,
		billing_date_10 date,
		invoice_date_10 date,
		coll_date_10 date,
		billing_lag_10 varchar(1024),
		invoice_lag_10 varchar(1024),
		coll_lag_10 varchar(1024),
		billing_amt_11 decimal(17,2) not null,
		invoice_amt_11 decimal(17,2) not null,
		coll_amt_11 decimal(17,2) not null,
		billing_date_11 date,
		invoice_date_11 date,
		coll_date_11 date,
		billing_lag_11 varchar(1024),
		invoice_lag_11 varchar(1024),
		coll_lag_11 varchar(1024),
		billing_amt_12 decimal(17,2) not null,
		invoice_amt_12 decimal(17,2) not null,
		coll_amt_12 decimal(17,2) not null,
		billing_date_12 date,
		invoice_date_12 date,
		coll_date_12 date,
		billing_lag_12 varchar(1024),
		invoice_lag_12 varchar(1024),
		coll_lag_12 varchar(1024),
		billing_remarks varchar(1024),
		invoice_remarks varchar(1024),
		coll_remarks varchar(1024)
	);
	
	insert into qry_tbl(job_no, job_desc, proj_amt, contribution_rate, contribution, budget, type)
		select t2.job_no, if(t2.client = '', t2.job_desc, concat(t2.job_desc, ' (', t2.client, ')')), t2.contract_amt, t2.contribution_rate, t2.contribution_amt, t2.budget, upper(t2.type) from gendb.user_job t inner join projdb.job_tbl t2
			on t.job_no = t2.job_no
			where t.user_id = ip_user and
				  (t2.type = 'mansupply' OR t2.type = 'project') order by t.job_no;

		set @counter = 1, @var_month = month(convert(ip_query, date)), @var_year = year(convert(ip_query, date)), @i2_orig = month(convert(ip_query, date));
		while @counter < 13 do
			update qry_tbl set month1_label = if(@counter = 1, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month1_label),
						 month2_label = if(@counter = 2, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month2_label),
						 month3_label = if(@counter = 3, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month3_label),
						 month4_label = if(@counter = 4, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month4_label),
						 month5_label = if(@counter = 5, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month5_label),
						 month6_label = if(@counter = 6, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month6_label),
						 month7_label = if(@counter = 7, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month7_label),
						 month8_label = if(@counter = 8, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month8_label),
						 month9_label = if(@counter = 9, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month9_label),
						 month10_label = if(@counter = 10, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month10_label),
						 month11_label = if(@counter = 11, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month11_label),
						 month12_label = if(@counter = 12, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month12_label);
			-- set @iList = if(@iList = '', concat(elt(@var_year,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year), concat(@iList, ", ", concat(elt(@var_year,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year)));
			if @var_month = 12 then
				set @var_month = 1,
					@var_year = @var_year + 1;
			else
				set @var_month = @var_month + 1;
			end if;
			set @counter = @counter + 1;
		end while;

	-- update qry_tbl t inner join (select sum(submitted_amt) as submitted_amt, sum(invoice_amt) as invoice_amt, job_no, billing_month, trans_date, invoice_date, acctg_confirmed, acctg_remarks from projdb.billing_invoice where acctg_confirmed is not null group by job_no, billing_month) t2
	-- 		on t.job_no = t2.job_no
		set @baseMonth = month(convert(ip_query, date)),
			@baseYear = year(convert(ip_query, date));
		update qry_tbl t
			set billing_amt_1 = t.billing_amt_1 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				billing_date_1 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				billing_lag_1 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
		 		invoice_amt_1 = t.invoice_amt_1 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				invoice_date_1 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
				invoice_lag_1 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB'),
		 		coll_amt_1 = t.coll_amt_1 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_1 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_1 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = @baseMonth and year(t2.billing_month) = @baseYear and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_2 = t.billing_amt_2 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_2 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_2 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_2 = t.invoice_amt_2 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_2 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_2 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_2 = t.coll_amt_2 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_2 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_2 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseMonth + 1) - 12, (@baseMonth + 1)) and year(t2.billing_month) = if((@baseMonth + 1) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_3 = t.billing_amt_3 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_3 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_3 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_3 = t.invoice_amt_3 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_3 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_3 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_3 = t.coll_amt_3 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_3 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_3 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseMonth + 2) - 12, (@baseMonth + 2)) and year(t2.billing_month) = if((@baseMonth + 2) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_4 = t.billing_amt_4 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_4 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_4 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_4 = t.invoice_amt_4 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_4 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_4 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_4 = t.coll_amt_4 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_4 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_4 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseMonth + 3) - 12, (@baseMonth + 3)) and year(t2.billing_month) = if((@baseMonth + 3) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_5 = t.billing_amt_5 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_5 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_5 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_5 = t.invoice_amt_5 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_5 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_5 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_5 = t.coll_amt_5 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_5 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_5 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseMonth + 4) - 12, (@baseMonth + 4)) and year(t2.billing_month) = if((@baseMonth + 4) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_6 = t.billing_amt_6 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_6 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_6 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_6 = t.invoice_amt_6 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_6 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_6 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_6 = t.coll_amt_6 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_6 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_6 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseMonth + 5) - 12, (@baseMonth + 5)) and year(t2.billing_month) = if((@baseMonth + 5) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_7 = t.billing_amt_7 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_7 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_7 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_7 = t.invoice_amt_7 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_7 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_7 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_7 = t.coll_amt_7 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_7 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_7 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseMonth + 6) - 12, (@baseMonth + 6)) and year(t2.billing_month) = if((@baseMonth + 6) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_8 = t.billing_amt_8 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_8 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_8 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_8 = t.invoice_amt_8 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_8 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_8 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_8 = t.coll_amt_8 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_8 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_8 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseMonth + 7) - 12, (@baseMonth + 7)) and year(t2.billing_month) = if((@baseMonth + 7) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_9 = t.billing_amt_9 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_9 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_9 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_9 = t.invoice_amt_9 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_9 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_9 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_9 = t.coll_amt_9 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_9 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_9 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseMonth + 8) - 12, (@baseMonth + 8)) and year(t2.billing_month) = if((@baseMonth + 8) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_10 = t.billing_amt_10 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_10 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_10 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_10 = t.invoice_amt_10 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_10 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_10 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_10 = t.coll_amt_10 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_10 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_10 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseMonth + 9) - 12, (@baseMonth + 9)) and year(t2.billing_month) = if((@baseMonth + 9) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_11 = t.billing_amt_11 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_11 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_11 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_11 = t.invoice_amt_11 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_11 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_11 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_11 = t.coll_amt_11 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_11 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_11 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseMonth + 10) - 12, (@baseMonth + 10)) and year(t2.billing_month) = if((@baseMonth + 10) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
		 		billing_amt_12 = t.billing_amt_12 + (select sum(submitted_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_date_12 = (select max(trans_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				billing_lag_12 = (select if(max(trans_date) < last_day(max(billing_month)), 'Advance', concat(to_days(concat(year(max(billing_month)),"-",month(max(billing_month)),"-",day(last_day(max(billing_month))))) - to_days(max(trans_date)), " d")) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		invoice_amt_12 = t.invoice_amt_12 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_date_12 = (select max(invoice_date) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
				invoice_lag_12 = (select concat((to_days(max(invoice_date)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB'),
		 		coll_amt_12 = t.coll_amt_12 + (select sum(invoice_amt) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_date_12 = (select max(acctg_confirmed) from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				coll_lag_12 = (select concat((to_days(max(acctg_confirmed)) - to_days(max(trans_date))), " d") from projdb.billing_invoice t2 where t2.job_no = t.job_no and month(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseMonth + 11) - 12, (@baseMonth + 11)) and year(t2.billing_month) = if((@baseMonth + 11) > 12,(@baseYear + 1), @baseYear) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null),
				billing_remarks = (select GROUP_CONCAT(proj_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB'),
				invoice_remarks = (select GROUP_CONCAT(invoice_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB'),
				coll_remarks = (select GROUP_CONCAT(acctg_remarks) from projdb.billing_invoice t2 where t2.job_no = t.job_no and year(t2.billing_month) = year(current_date) and t2.pay_type = 'MB' and t2.acctg_confirmed is not null);

		-- set @total:=(select count(*) from qry_tbl);
		select concat(if(month(convert(ip_query, date)) >= 1, year(convert(ip_query, date)), concat(year(convert(ip_query, date)), "-", (year(convert(ip_query, date)) + 1))), " Monthly Progress Billing") as colHdr, 
			   concat('As of: ', date_format(current_date,'%W %e %M %Y')) as asOf, 
			   t.* from qry_tbl t order by t.type desc;
		-- set @exec_stm:="select @total as total, t.* from qry_tbl t order by job_no limit @start_var,@pageSize_var;";
		-- if @where_stm != '' then
		-- 	set @exec_stm:=concat('select @total as total,t.* from qry_tbl t where ', @where_stm, ' order by job_no limit @start_var,@pageSize_var;');
	 	-- end if;
	 	-- PREPARE stmt FROM @exec_stm;
	 	-- EXECUTE stmt ;
	 	-- DEALLOCATE PREPARE stmt;	
		-- set @exec_stm:=concat("select @total as total, t.* from qry_tbl t ", if(@where_stm = "", "", concat("where ", @where_stm)) ," order by t.job_no limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
	 	-- PREPARE stmt FROM @exec_stm;
	 	-- EXECUTE stmt ;
	 	-- DEALLOCATE PREPARE stmt;	
		-- select @exec_stm;

	drop table qry_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_email_item` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_email_item`()
BEGIN
	-- drop temporary table billing_item;
	create temporary table if not exists billing_item(
		job_no varchar(10),
		invoice_date date,
		cutoff_day int,
		client_submission int,
		client_review int,
		pay_terms int,
		billing_status int,
		billing_status_desc varchar(5000),
		billing_month date,
		trans_date date,
		invoice_no varchar(1024),
		invoice_amt decimal(17,2)
	);

	insert into billing_item
		select job_no, invoice_date, cutoff_day, client_submission, client_review, pay_terms, 0, '', billing_month, trans_date, invoice_no, invoice_amt from projdb.billing_invoice
			inner join job_tbl 
			using(job_no) where acctg_confirmed is null and flg_status = 1;

	-- Past-Due
	update billing_item
		set billing_status = 5
		where billing_status = 0 and
			  date_add(invoice_date, interval pay_terms day) < curdate();

	-- 5 Days before Past-Due
	update billing_item
		set billing_status = 4
		where billing_status = 0 and
			  datediff(date_add(invoice_date, interval pay_terms day), curdate()) <= 5;

	-- After Review Days
	update billing_item
		set billing_status = 3
		where billing_status = 0 and
			  invoice_no is null and
			  date_add(convert(concat(year(billing_month), "-", (month(billing_month) + 1), "-", client_submission),date), interval client_review day) < curdate();

	-- After Cut-Off
	insert into billing_item(job_no, billing_status, billing_month, cutoff_day)
		select job_no, 2, billing_month, cutoff_day from job_tbl t
			inner join (
				select max(billing_month) as billing_month, max(job_no) as job_no from billing_invoice where year(billing_month) = year(curdate())  group by job_no
			) t2
			using(job_no)
			where flg_status = 1 and
				  (type = 'mansupply' OR type = 'project') and
				  ((month(billing_month) < (month(curdate()) - 1)) or
				   (month(billing_month) = (month(curdate()) - 1) and
                   cutoff_day < day(curdate())));

	-- 5 Days before Cut-Off
	insert into billing_item(job_no, billing_status, billing_month, cutoff_day)
		select job_no, 1, billing_month, cutoff_day from job_tbl t
			inner join (
				select max(billing_month) as billing_month, max(job_no) as job_no from billing_invoice where year(billing_month) = year(curdate())  group by job_no
			) t2
			using(job_no)
			where flg_status = 1 and
				  (type = 'mansupply' OR type = 'project') and
				  -- (month(billing_month) < (month(curdate()) - 1) or
				   month(billing_month) = (month(curdate()) - 1) and
                   (cutoff_day - 5) <= day(curdate());

	-- select t.*, t2.description from billing_item t
	-- 	inner join projdb.email_notif t2
	-- 	on t.billing_status = t2.id order by job_no;
	update billing_item t inner join projdb.email_notif t2
		on t.billing_status = t2.id
		set t.billing_status_desc = t2.description;

	-- select concat(year(curdate()), "-", month(curdate()), "-", cutoff_day) from billing_item where billing_status > 0;

	-- select 0, concat((select concat(p_char1, ";", p_char2) from sys_prog where prog_code = concat("BCS_AutoEmail_", job_no)), if(billing_status >= 2,concat(";", if(billing_status = 2,(select p_char1 from sys_prog where prog_code = "BCS_AutoEmail"), (select concat(p_char1, ";", p_char2, ";", p_char3) from sys_prog where prog_code = "BCS_AutoEmail"))), "")), if(billing_status = 1, "Reminder", "Notice"), billing_status_desc, concat(if(billing_status > 2, 3, billing_status), job_no) from billing_item;

	delete from email_item;
	-- INSERT INTO email_item
	-- 	select 0, concat((select concat(p_char1, ";", p_char2) from sys_prog where prog_code = concat("BCS_AutoEmail_", job_no)), if(billing_status >= 2,concat(";", if(billing_status = 2,(select p_char1 from sys_prog where prog_code = "BCS_AutoEmail"), (select concat(p_char1, ";", p_char2, ";", p_char3) from sys_prog where prog_code = "BCS_AutoEmail"))), "")), if(billing_status = 1, "Reminder", "Notice"), if(billing_status > 2, concat("Billing Month: ", date_format(billing_month,"%M"), " Billing Date: ", trans_date, " Invoice No.: " , invoice_no, " Invoice Date: ", invoice_date, " Invoice Amt: ", invoice_amt), if(billing_status = 1, concat("For the month of: ", date_format(curdate(),"%M")), concat("Since: ", date_format(billing_month,"%M")))), concat(if(billing_status > 2, 3, billing_status), job_no) from billing_item
	-- 	ON DUPLICATE KEY UPDATE message = concat(if(message is null, "", concat(message, ";")), if(billing_status > 2, concat("Billing Month: ", date_format(billing_month,"%M"), " Billing Date: ", trans_date, " Invoice No.: " , invoice_no, " Invoice Date: ", invoice_date, " Invoice Amt: ", invoice_amt), if(billing_status = 1, concat("For the month of: ", date_format(curdate(),"%M")), concat("Since: ", date_format(billing_month,"%M"))))),
	-- 							subject = concat(if(subject is null, "", if(subject != if(billing_status = 1, "Reminder", "Notice"), concat(subject, " AND "), "")), if(billing_status = 1, "Reminder", "Notice"));
	-- select job_no, billing_status from billing_item group by job_no, billing_status;

	insert into email_item
		select 0, (select concat(p_char1, ";", p_char2) from sys_prog where prog_code = concat("BCS_AutoEmail_", job_no)), if(billing_status = 1, "Reminder", "Notice"), 
		if(billing_status > 3, 
			concat(
				concat(billing_status_desc, ":***"), 
				"Billing Month: ", 
				date_format(billing_month,"%M"), 
				", Cut-Off Date: ", 
				convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
				", Billing Date: ",
				trans_date, 
				", Last Review Date: ",
				date_add(convert(concat(year(billing_month), "-", (month(billing_month) + 1), "-", client_submission),date), interval client_review day), 
				", Due Date: ", 
				date_add(invoice_date, interval pay_terms day), 
				", Invoice No.: " , 
				invoice_no, 
				", Invoice Date: ", 
				invoice_date, 
				", Invoice Amt: ", 
				invoice_amt
			), 
			if(billing_status = 1, 
				concat(
					concat(billing_status_desc, ":***"), 
					"Billing Month: ", 
					date_format(curdate(),"%M"), 
					", Cut-Off Date: ", 
					convert(concat(year(curdate()), "-", month(curdate()), "-", cutoff_day), date), 
					", Billing Date: , Last Review Date: , Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
				), 
				if(billing_status = 2, 
					concat(
						concat(billing_status_desc, ":***"), 
						"Billing Month: ", 
						date_format(billing_month,"%M"),  
						", Cut-Off Date: ", 
						convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
						", Billing Date: , Last Review Date: , Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
					), 
					concat(
						concat(billing_status_desc, ":***"), 
						"Billing Month: ", 
						date_format(billing_month,"%M"),  
						", Cut-Off Date: ", 
						convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
						", Billing Date: ",
						trans_date, 
						", Last Review Date: ",
						date_add(convert(concat(year(billing_month), "-", (month(billing_month) + 1), "-", client_submission),date), interval client_review day), 
						", Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
					)
				)
			)
		), job_no from billing_item where billing_status > 0
		on duplicate key update message = concat(if(message is null, "", concat(message, ";")), 
		if(billing_status > 3, 
			concat(
				concat(billing_status_desc, ":***"), 
				"Billing Month: ", 
				date_format(billing_month,"%M"), 
				", Cut-Off Date: ", 
				convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
				", Billing Date: ", 
				trans_date, 
				", Last Review Date: ",
				date_add(convert(concat(year(billing_month), "-", (month(billing_month) + 1), "-", client_submission),date), interval client_review day), 
				", Due Date: ", 
				date_add(invoice_date, interval pay_terms day), 
				", Invoice No.: ", 
				invoice_no, 
				", Invoice Date: ", 
				invoice_date, 
				", Invoice Amt: ", 
				invoice_amt
			), 
			if(billing_status = 1, 
				concat(
					concat(billing_status_desc, ":***"), 
					"Billing Month: ", 
					date_format(curdate(),"%M"),  
					", Cut-Off Date: ", 
					convert(concat(year(curdate()), "-", month(curdate()), "-", cutoff_day), date), 
					", Billing Date: , Last Review Date: , Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
				), 
				if(billing_status = 2, 
					concat(
						concat(billing_status_desc, ":***"), 
						"Billing Month: ", 
						date_format(billing_month,"%M"),  
						", Cut-Off Date: ", 
						convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
						", Billing Date: , Last Review Date: , Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
					), 
					concat(
						concat(billing_status_desc, ":***"), 
						"Billing Month: ", 
						date_format(billing_month,"%M"),  
						", Cut-Off Date: ", 
						convert(concat(year(billing_month), "-", month(billing_month), "-", cutoff_day), date), 
						", Billing Date: ",
						trans_date, 
						", Last Review Date: ",
						date_add(convert(concat(year(billing_month), "-", (month(billing_month) + 1), "-", client_submission),date), interval client_review day), 
						", Due Date: , Invoice No.: , Invoice Date: , Invoice Amt: "
					)
				)
			)
		)
		),
								subject = concat(if(subject is null, "", if(subject != if(billing_status = 1, "Reminder", "Notice"), concat(subject, " AND "), "")), if(billing_status = 1, "Reminder", "Notice"));

	-- insert into email_item
	-- 	select 0, (select concat(p_char1, ";", p_char2) from sys_prog where prog_code = concat("BCS_AutoEmail_", job_no)), if(billing_status = 1, "Reminder", "Notice"), if(billing_status > 2, concat(concat(billing_status_desc, ":***"), "Billing Month: ", date_format(billing_month,"%M"), ", Billing Date: ", trans_date, ", Invoice No.: " , invoice_no, ", Invoice Date: ", invoice_date, ", Invoice Amt: ", invoice_amt), if(billing_status = 1, concat(concat(billing_status_desc, ":***"), "For the month of: ", date_format(curdate(),"%M")), concat(concat(billing_status_desc, ":***"), "Since: ", date_format(billing_month,"%M")))), "All" from billing_item where billing_status > 1
	-- 	on duplicate key update message = concat(if(message is null, "", concat(message, ";")), if(billing_status > 2, concat(concat(billing_status_desc, ":***"), "Billing Month: ", date_format(billing_month,"%M"), ", Billing Date: ", trans_date, ", Invoice No.: " , invoice_no, ", Invoice Date: ", invoice_date, ", Invoice Amt: ", invoice_amt), if(billing_status = 1, concat(concat(billing_status_desc, ":***"), "For the month of: ", date_format(curdate(),"%M")), concat(concat(billing_status_desc, ":***"), "Since: ", date_format(billing_month,"%M"))))),
	-- 							subject = concat(if(subject is null, "", if(subject != if(billing_status = 1, "Reminder", "Notice"), concat(subject, " AND "), "")), if(billing_status = 1, "Reminder", "Notice"));

	select * from email_item;
	
	drop temporary table billing_item;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `outRec_q` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `outRec_q`()
BEGIN
	create temporary table if not exists qry_tbl(
		id int not null auto_increment primary key,
		job_desc varchar(1024),
		job_no varchar(1024),
		client_name varchar(1024),
		invoice_no varchar(1024),
		invoice_date varchar(1024),
		period varchar(1024),
		invoice_amt decimal(17,2),
		due_date varchar(1024),
		past_due int,
		due_per_month decimal(17,2),
		due_month varchar(1024)
	);
	create temporary table if not exists qry_tbl3(
			id int not null,
			due_per_month decimal(17,2)
	);
	create temporary table if not exists qry_tbl2(
		item int,
		job_no varchar(1024),
		client_name varchar(1024),
		month1 decimal(17,2) not null,
		month2 decimal(17,2) not null,
		month3 decimal(17,2) not null,
		month4 decimal(17,2) not null,
		month5 decimal(17,2) not null,
		month6 decimal(17,2) not null,
		month7 decimal(17,2) not null,
		month8 decimal(17,2) not null,
		month9 decimal(17,2) not null,
		month10 decimal(17,2) not null,
		month11 decimal(17,2) not null,
		month12 decimal(17,2) not null,
		sumTotal decimal(17,2) not null
	);
	insert into qry_tbl
		select 0, t.job_desc, t.job_no, t.client, t2.invoice_no, date_format(t2.invoice_date,'%e-%b-%y'), '', t2.invoice_amt, date_format(date_add(t2.invoice_date, interval t.pay_terms day),'%e-%b-%y'), (to_days(date_add(t2.invoice_date, interval t.pay_terms day)) - to_days(CURRENT_DATE)), 0, date_format(date_add(t2.invoice_date, interval t.pay_terms day), '%b') 
			from projdb.job_tbl t 
			inner join gendb.user_job t3
				on t.job_no = t3.job_no 
			inner join projdb.billing_invoice t2
			-- (
			-- 	select t5.duePerMonth, invoice_no, invoice_date, t4.job_no, invoice_amt 
			-- 	from projdb.billing_invoice t4 
			-- 	inner join (
			-- 		select sum(invoice_amt) as duePerMonth, t5.job_no from billing_invoice t5 group by t5.job_no
			-- 	) t5 on t4.job_no = t5.job_no
			-- ) t2
				on t.job_no = t2.job_no
			where t3.user_id = @user_id and
				  t.type = @type order by t.job_no, t2.invoice_date;

	if @module = 'detail' then
		insert into qry_tbl3
			select max(id), sum(invoice_amt) from qry_tbl group by job_no, due_month order by job_no, due_month;
		
		update qry_tbl t inner join qry_tbl3 t2
			on t.id = t2.id
			set t.due_per_month = t2.due_per_month;
		set @total:=(select count(*) from qry_tbl);
		set @exec_stm:=concat("select @total as total, t.* from qry_tbl t limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
		if @where_stm != '' then
			set @exec_stm:=concat('select @total as total, t.* from qry_tbl t where ', @where_stm, " limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
		end if;
		PREPARE stmt FROM @exec_stm;
		EXECUTE stmt ;
		DEALLOCATE PREPARE stmt; 
	else
		insert into qry_tbl2(job_no, client_name)
			select t.job_no, t2.client from gendb.user_job t inner join projdb.job_tbl t2
				on t.job_no = t2.job_no
				where t.user_id = @user_id and
					t2.type = @type order by t.job_no;

		set @baseMonth = month(convert(@baseDate, date)),
			@baseYear = year(convert(@baseDate, date));
		update qry_tbl2 t inner join (select sum(invoice_amt) as invoice_amt, acctg_confirmed, job_no, invoice_date from projdb.billing_invoice where acctg_confirmed is not null group by job_no) t2
			on t.job_no = t2.job_no
			set month1 = if(month(t2.invoice_date) = @baseMonth, (t.month1 + t2.invoice_amt), month1),
		 		month2 = if(month(t2.invoice_date) = if((@baseMonth + 1) > 12, (@baseMonth + 1) - 12, (@baseMonth + 1)), (t.month2 + t2.invoice_amt), month2),
		 		month3 = if(month(t2.invoice_date) = if((@baseMonth + 2) > 12, (@baseMonth + 2) - 12, (@baseMonth + 2)), (t.month3 + t2.invoice_amt), month3),
		 		month4 = if(month(t2.invoice_date) = if((@baseMonth + 3) > 12, (@baseMonth + 3) - 12, (@baseMonth + 3)), (t.month4 + t2.invoice_amt), month4),
		 		month5 = if(month(t2.invoice_date) = if((@baseMonth + 4) > 12, (@baseMonth + 4) - 12, (@baseMonth + 4)), (t.month5 + t2.invoice_amt), month5),
		 		month6 = if(month(t2.invoice_date) = if((@baseMonth + 5) > 12, (@baseMonth + 5) - 12, (@baseMonth + 5)), (t.month6 + t2.invoice_amt), month6),
		 		month7 = if(month(t2.invoice_date) = if((@baseMonth + 6) > 12, (@baseMonth + 6) - 12, (@baseMonth + 6)), (t.month7 + t2.invoice_amt), month7),
		 		month8 = if(month(t2.invoice_date) = if((@baseMonth + 7) > 12, (@baseMonth + 7) - 12, (@baseMonth + 7)), (t.month8 + t2.invoice_amt), month8),
		 		month9 = if(month(t2.invoice_date) = if((@baseMonth + 8) > 12, (@baseMonth + 8) - 12, (@baseMonth + 8)), (t.month9 + t2.invoice_amt), month9),
		 		month10 = if(month(t2.invoice_date) = if((@baseMonth + 9) > 12, (@baseMonth + 9) - 12, (@baseMonth + 9)), (t.month10 + t2.invoice_amt), month10),
		 		month11 = if(month(t2.invoice_date) = if((@baseMonth + 10) > 12, (@baseMonth + 10) - 12, (@baseMonth + 10)), (t.month11 + t2.invoice_amt), month11),
		 		month12 = if(month(t2.invoice_date) = if((@baseMonth + 11) > 12, (@baseMonth + 11) - 12, (@baseMonth + 11)), (t.month12 + t2.invoice_amt), month12),
		 		sumTotal = (t.month12 + t2.invoice_amt);

		set @total:=(select count(*) from qry_tbl2);
		set @exec_stm:=concat("select @total as total, t.* from qry_tbl2 t limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
		if @where_stm != '' then
			set @exec_stm:=concat("select @total as total, t.* from qry_tbl2 t where ", @where_stmlimit, " limit ", convert(@start, unsigned), ", ", convert(@pageSize, unsigned));
		end if;
		PREPARE stmt FROM @exec_stm;
		EXECUTE stmt ;
		DEALLOCATE PREPARE stmt; 

		drop table qry_tbl2;
	end if;
	drop table qry_tbl3;
	drop table qry_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `procAgain` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `procAgain`()
BEGIN
	update projdb.job_tbl t inner join (select sum(invoice_amt) as total, job_no from projdb.billing_invoice group by job_no) t2
		on t.job_no = t2.job_no
		set billed_amt = if(billed_amt != t2.total, t2.total, billed_amt),
			billing_for_col = if(billing_for_col != t2.total, t2.total, billing_for_col);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_new`()
BEGIN
	set @iList = '';
	while @i < 13 do
		set @iList = concat(@iList, ", ", @i2); -- if(@iList = '', concat(elt(@i2,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year), concat(@iList, ", ", concat(elt(@i2,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year)));
		if @i2 = 12 then
			set @i2 = 1,
				@curr_year = @curr_year + 1;
		else
			set @i2 = @i2 + 1;
		end if;
		set @i = @i + 1;
	end while;

	select @iList;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_pd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_pd`()
BEGIN
	-- declare dueDate date;
	-- declare pastDue decimal;
	-- declare forCollection decimal;
	-- declare pastDueA decimal;
	-- declare forCollectionA decimal

	update projdb.job_tbl t inner join projdb.billing_invoice t2
		on t.job_no = t2.job_no
		set billing_due = (t.billing_due + t2.invoice_amt),
		    billing_for_col = (t.billing_for_col - t2.invoice_amt) 
		where date(date_format(date_add(t2.trans_date, interval t.pay_terms day),'%Y-%m-%e')) < curdate();

	/*update projdb.job_tbl t3 inner join (
			select @dueDate:= ADDDATE(t.trans_date,t2.pay_terms) as duedate, t.job_no, t.invoice_amt, curdate() as currentDate
				from projdb.billing_invoice t 
				inner join projdb.job_tbl t2 
				on t.job_no = t2.job_no
				where t.acctg_confirmed is null) t4 
		on t3.job_no = t4.job_no
		set billing_due = (t3.billing_due + t4.invoice_amt),
		    billing_for_col = (t3.billing_for_col - t4.invoice_amt) 
		where curdate() > t4.dueDate;*/

	/*select @pastDue:=t.billing_due as pastDue1, @forCollection:=t.billing_for_col as forCol1
		from projdb.job_tbl t
		inner join projdb.billing_invoice t2
		on t.job_no = t2.job_no
		where t2.acctg_confirmed is null;

	select @pastDue, @forCollection, @pastDueA:=(@pastDue + t4.invoice_amt) as pastDue2, @forCollectionA:=(@forCollection - t4.invoice_amt) as forCol2
		from projdb.job_tbl t3
		inner join (
			select @dueDate:= ADDDATE(t.trans_date,t2.pay_terms) as duedate, t.job_no, t.invoice_amt,
				curdate() as currentDate
				from projdb.billing_invoice t 
				inner join projdb.job_tbl t2 
				on t.job_no = t2.job_no
				where t.acctg_confirmed is null) t4
		on t3.job_no = t4.job_no and
		   curdate() > t4.dueDate;*/

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `query_ogmr` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `query_ogmr`()
BEGIN
	declare x int;
	declare y int;

	set @x := 1;
	 create temporary table if not exists tmp_ogmr (
	 	ogmrNo int(6) zerofill primary key,
	 	iUse int
	 );
	insert into tmp_ogmr(ogmrNo) 
		select cast(ogmr_no as unsigned) from ogmr order by convert(ogmr_no,unsigned) limit 0, 1000;

	while @x <= @y do
	 	Insert into tmp_ogmr (ogmrNo,iUse) value(@x,3) on duplicate key update iUse=2;
	 	set @x = @x + 1;
	end while;
	select * from tmp_ogmr left join ogmr on convert(ogmr.ogmr_no,unsigned) = tmp_ogmr.ogmrNo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sample_projdb` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sample_projdb`(
	in ip_query varchar(1024),
	in ip_user varchar(1024),
	in ip_module varchar(1024),
	in ip_detail_type varchar(1024),
	in ip_type varchar(1024)
)
BEGIN
	create temporary table if not exists qry_tbl(
		id int not null auto_increment primary key,
		job_desc varchar(1024),
		job_no varchar(1024),
		client_name varchar(1024),
		invoice_no varchar(1024),
		invoice_date varchar(1024),
		period varchar(1024),
		invoice_amt decimal(17,2),
		due_date varchar(1024),
		past_due int,
		due_per_month decimal(17,2),
		due_month varchar(1024),
		billing_month date, 
		type varchar(1024), 
		acctg_confirmed date
	);
	create temporary table if not exists qry_tbl3(
			id int not null,
			due_per_month decimal(17,2)
	);
	create temporary table if not exists qry_tbl2(
		item int,
		job_no varchar(1024),
		client_name varchar(1024),
		type varchar(1024),
		month1_label varchar(1024),
		month2_label varchar(1024),
		month3_label varchar(1024),
		month4_label varchar(1024),
		month5_label varchar(1024),
		month6_label varchar(1024),
		month7_label varchar(1024),
		month8_label varchar(1024),
		month9_label varchar(1024),
		month10_label varchar(1024),
		month11_label varchar(1024),
		month12_label varchar(1024),
		month1 decimal(17,2) not null,
		month2 decimal(17,2) not null,
		month3 decimal(17,2) not null,
		month4 decimal(17,2) not null,
		month5 decimal(17,2) not null,
		month6 decimal(17,2) not null,
		month7 decimal(17,2) not null,
		month8 decimal(17,2) not null,
		month9 decimal(17,2) not null,
		month10 decimal(17,2) not null,
		month11 decimal(17,2) not null,
		month12 decimal(17,2) not null,
		sumTotal decimal(17,2) not null
	);

	if ip_module = 'detail' then
		if ip_detail_type = 'collected' then
			insert into qry_tbl		
				select 0, t.job_desc, t.job_no, t.client, t2.invoice_no, date_format(t2.invoice_date,'%m-%b-%y'), '', t2.invoice_amt, date_format(date_add(t2.invoice_date, interval t.pay_terms day),'%m-%b-%y'), (to_days(date_add(t2.invoice_date, interval t.pay_terms day)) - to_days(CURRENT_DATE)), (select sum(t4.invoice_amt) from projdb.job_tbl t3 inner join projdb.billing_invoice t4 on t3.job_no = t4.job_no), date_format(date_add(t2.invoice_date, interval t.pay_terms day), '%b'), t2.billing_month, upper(t.type), t2.acctg_confirmed from projdb.job_tbl t inner join gendb.user_job t3
					on t.job_no = t3.job_no inner join projdb.billing_invoice t2
					on t.job_no = t2.job_no
					where t3.user_id = ip_user and		
						  t2.acctg_confirmed is not null and
						  month(t2.billing_month) = month(convert(ip_query, date)) and
						  year(t2.billing_month) = year(convert(ip_query, date)) and
						  (t.type = 'mansupply' OR t.type = 'project') order by t.job_no, t2.invoice_date;
		else
			insert into qry_tbl
				select 0, t.job_desc, t.job_no, t.client, t2.invoice_no, date_format(t2.invoice_date,'%m-%b-%y'), '', t2.invoice_amt, date_format(date_add(t2.invoice_date, interval t.pay_terms day),'%m-%b-%y'), (to_days(date_add(t2.invoice_date, interval t.pay_terms day)) - to_days(CURRENT_DATE)), (select sum(t4.invoice_amt) from projdb.job_tbl t3 inner join projdb.billing_invoice t4 on t3.job_no = t4.job_no), date_format(date_add(t2.invoice_date, interval t.pay_terms day), '%b'), t2.billing_month, upper(t.type), t2.acctg_confirmed from projdb.job_tbl t inner join gendb.user_job t3
					on t.job_no = t3.job_no inner join projdb.billing_invoice t2
					on t.job_no = t2.job_no
					where t3.user_id = ip_user and
						  t2.acctg_confirmed is null and
						  t.type = ip_type order by t.job_no, t2.invoice_date;

			insert into qry_tbl3
				select max(id), sum(invoice_amt) from qry_tbl group by job_no, due_month order by job_no, due_month;
			update qry_tbl set due_per_month = 0;
			update qry_tbl t inner join qry_tbl3 t2
				on t.id = t2.id
				set t.due_per_month = t2.due_per_month;
		end if;

		select concat("A: COLLECTION FOR THE MONTH OF ", monthname(convert(ip_query, date))) as titleHead, concat("TOTAL COLLECTION FOR THE MONTH OF ", monthname(convert(ip_query, date))) as titleFoot, concat((weekofyear(current_date) - WEEKOFYEAR(date(concat(year(current_date),"-",(month(current_date) - 1),"-",day(last_day(date(concat(year(current_date),"-",(month(current_date) - 1),"-",1)))))))), elt((weekofyear(current_date) - WEEKOFYEAR(date(concat(year(current_date),"-",(month(current_date) - 1),"-",day(last_day(date(concat(year(current_date),"-",(month(current_date) - 1),"-",1)))))))),"st","nd","rd","th"), " Week") as weekNo, concat('As of ', date_format(current_date,'%M %e, %Y')) as asOf, t.* from qry_tbl t order by t.type desc, t.job_no, t.due_date;
		-- set @exec_stm:="select * from qry_tbl";		
		-- if ip_query != '' then
		-- 	set @exec_stm:=concat('select * from qry_tbl where ', ip_query);
		-- end if;
		-- PREPARE stmt FROM @exec_stm;
		-- EXECUTE stmt ;
		-- DEALLOCATE PREPARE stmt; 
	else
		insert into qry_tbl2(job_no, client_name, type)
			select t.job_no, t2.client, upper(t2.type) from gendb.user_job t inner join projdb.job_tbl t2
				on t.job_no = t2.job_no
				where t.user_id = ip_user and
					  (t2.type = 'MANSUPPLY' OR t2.type = 'PROJECT') order by t.job_no;

		set @counter = 1, @var_month = month(convert(ip_query, date)), @var_year = year(convert(ip_query, date)), @i2_orig = month(convert(ip_query, date));
		while @counter < 13 do
			update qry_tbl2 set month1_label = if(@counter = 1, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month1_label),
						 month2_label = if(@counter = 2, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month2_label),
						 month3_label = if(@counter = 3, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month3_label),
						 month4_label = if(@counter = 4, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month4_label),
						 month5_label = if(@counter = 5, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month5_label),
						 month6_label = if(@counter = 6, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month6_label),
						 month7_label = if(@counter = 7, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month7_label),
						 month8_label = if(@counter = 8, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month8_label),
						 month9_label = if(@counter = 9, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month9_label),
						 month10_label = if(@counter = 10, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month10_label),
						 month11_label = if(@counter = 11, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month11_label),
						 month12_label = if(@counter = 12, concat(elt(@var_month,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @var_year), month12_label);
			-- set @iList = if(@iList = '', concat(elt(@var_year,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year), concat(@iList, ", ", concat(elt(@var_year,"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"), "-", @curr_year)));
			if @var_month = 12 then
				set @var_month = 1,
					@var_year = @var_year + 1;
			else
				set @var_month = @var_month + 1;
			end if;
			set @counter = @counter + 1;
		end while;

		update qry_tbl2 t inner join (select sum(invoice_amt) as invoice_amt, acctg_confirmed, job_no, invoice_date from projdb.billing_invoice where acctg_confirmed is not null and year(billing_month) = year(convert(ip_query,date)) group by job_no) t2
			on t.job_no = t2.job_no
			set month1 = if(month(t2.invoice_date) = @i2_orig, (t.month1 + t2.invoice_amt), month1),
		 		month2 = if(month(t2.invoice_date) = if((@i2_orig + 1) > 12, (@i2_orig + 1) - 12, (@i2_orig + 1)), (t.month2 + t2.invoice_amt), month2),
		 		month3 = if(month(t2.invoice_date) = if((@i2_orig + 2) > 12, (@i2_orig + 2) - 12, (@i2_orig + 2)), (t.month3 + t2.invoice_amt), month3),
		 		month4 = if(month(t2.invoice_date) = if((@i2_orig + 3) > 12, (@i2_orig + 3) - 12, (@i2_orig + 3)), (t.month4 + t2.invoice_amt), month4),
		 		month5 = if(month(t2.invoice_date) = if((@i2_orig + 4) > 12, (@i2_orig + 4) - 12, (@i2_orig + 4)), (t.month5 + t2.invoice_amt), month5),
		 		month6 = if(month(t2.invoice_date) = if((@i2_orig + 5) > 12, (@i2_orig + 5) - 12, (@i2_orig + 5)), (t.month6 + t2.invoice_amt), month6),
		 		month7 = if(month(t2.invoice_date) = if((@i2_orig + 6) > 12, (@i2_orig + 6) - 12, (@i2_orig + 6)), (t.month7 + t2.invoice_amt), month7),
		 		month8 = if(month(t2.invoice_date) = if((@i2_orig + 7) > 12, (@i2_orig + 7) - 12, (@i2_orig + 7)), (t.month8 + t2.invoice_amt), month8),
		 		month9 = if(month(t2.invoice_date) = if((@i2_orig + 8) > 12, (@i2_orig + 8) - 12, (@i2_orig + 8)), (t.month9 + t2.invoice_amt), month9),
		 		month10 = if(month(t2.invoice_date) = if((@i2_orig + 9) > 12, (@i2_orig + 9) - 12, (@i2_orig + 9)), (t.month10 + t2.invoice_amt), month10),
		 		month11 = if(month(t2.invoice_date) = if((@i2_orig + 10) > 12, (@i2_orig + 10) - 12, (@i2_orig + 10)), (t.month11 + t2.invoice_amt), month11),
		 		month12 = if(month(t2.invoice_date) = if((@i2_orig + 11) > 12, (@i2_orig + 11) - 12, (@i2_orig + 11)), (t.month12 + t2.invoice_amt), month12),
		 		sumTotal = (t.month12 + t2.invoice_amt);

		select concat('As of ', date_format(current_date,'%M %e, %Y')) as asOf, t.* from qry_tbl2 t order by t.type desc;
		-- set @exec_stm:="select concat('As of ', date_format(current_date,'%M %e, %Y')) as asOf, t.* from qry_tbl2 t order by t.type desc";		
		-- if ip_query != '' then
		-- 	set @exec_stm:=concat("select concat('As of ', date_format(current_date,'%M %e, %Y')) as asOf, t.* from qry_tbl2 t where ", ip_query, "  order by t.type desc");
		-- end if;
		-- PREPARE stmt FROM @exec_stm;
		-- EXECUTE stmt ;
		-- DEALLOCATE PREPARE stmt; 

		drop table qry_tbl2;
	end if;
	drop table qry_tbl3;
	drop table qry_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-04  7:39:53
