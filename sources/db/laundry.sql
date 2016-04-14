/*
SQLyog Ultimate v9.20 
MySQL - 5.6.16 : Database - laundry
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laundry` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laundry`;

/*Table structure for table `customer_types` */

DROP TABLE IF EXISTS `customer_types`;

CREATE TABLE `customer_types` (
  `CUSTOMER_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CUSTOMER_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `customer_types` */

insert  into `customer_types`(`CUSTOMER_TYPE_ID`,`NAME`,`DESCRIPTION`,`IS_DISABLE`) values (1,'Cabang',NULL,0),(2,'Reguler',NULL,0),(3,'Online',NULL,0);

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `CUSTOMER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CUSTOMER_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `USER_ID` int(10) unsigned DEFAULT NULL,
  `OWNER` varchar(100) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CUSTOMER_ID`),
  KEY `FK_CUSTOMERS_REF_USERS` (`USER_ID`),
  KEY `FK_CUSTOMERS_REF_CUSTOMER_TYPES` (`CUSTOMER_TYPE_ID`),
  CONSTRAINT `FK_CUSTOMERS_REF_CUSTOMER_TYPES` FOREIGN KEY (`CUSTOMER_TYPE_ID`) REFERENCES `customer_types` (`CUSTOMER_TYPE_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_CUSTOMERS_REF_USERS` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`CUSTOMER_ID`,`CUSTOMER_TYPE_ID`,`USER_ID`,`OWNER`,`NAME`,`ADDRESS`,`PHONE`,`EMAIL`,`IS_DISABLE`) values (1,2,3,NULL,'Anonymous',NULL,NULL,NULL,0),(2,1,4,'Dedi Kusnandar','Pelangi Laundry Buah Batu','Jl. Buah Batu No. 197','081712120045','pelangibuahbatu@gmail.com',0),(3,1,5,'Sri Mulyani','Pelangi Laundry Cibiru','Jl. Cibiru Raya No 112','085760122244','pelangicibiru@gmail.com',0),(4,1,6,'Wawan Suwandi','Pelangi Laundry Pasteur','Jl. Paster Komp. Setra Duta No 12','081255661232','pelangipasteur@gmail.com',0),(5,1,7,'Amar Muzaki','Pelangi Laundry Cimahi','Jl. Rajawali Depan RS Rajawali No 27','085788221023','pelangicimahi@gmail.com',0),(6,1,8,'Dede Trisnandar','Pelangi Laundry Dago','Jl. Dipatiukur No 33','081910024001','pelangidago@gmail.com',0),(7,3,9,NULL,'Dadang Sutisna','Jl. Cijagra No 72','085723412030','dadangsutisna@gmail.com',0),(8,3,10,NULL,'Willy Budiman','Jl. Terusan Buah Batu No 127','08992425123','willybudiman@gmail.com',0),(9,3,11,NULL,'Suhendra','Antapani','083811220022','suhendra@gmail.com',0);

/*Table structure for table `module_functions` */

DROP TABLE IF EXISTS `module_functions`;

CREATE TABLE `module_functions` (
  `MODULE_FUNCTION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MODULE_ID` int(10) unsigned DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `CONTROLLER` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MODULE_FUNCTION_ID`),
  KEY `FK_MODULE_FUNCTIONS_REF_MODULES` (`MODULE_ID`),
  CONSTRAINT `FK_MODULE_FUNCTIONS_REF_MODULES` FOREIGN KEY (`MODULE_ID`) REFERENCES `modules` (`MODULE_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `module_functions` */

insert  into `module_functions`(`MODULE_FUNCTION_ID`,`MODULE_ID`,`NAME`,`CONTROLLER`,`DESCRIPTION`) values (1,1,'Home','home',NULL),(2,2,'Dashboard','dashboard',NULL),(3,3,'Group Pengguna','user_permissions',NULL),(4,3,'Pengguna','users',NULL),(5,4,'Kategori Layanan','service_categories',NULL),(6,4,'Daftar Layanan','services',NULL),(7,5,'Jenis Pelanggan','customer_types',NULL),(8,5,'Pelanggan','customers',NULL),(9,6,'Pesanan','orders',NULL),(10,6,'Pesanan Online','order_online',NULL),(11,6,'Pengambilan Pesanan','order_retrieval',NULL),(12,7,'Biaya Pengeluaran','operational_costs',NULL),(13,8,'Laporan Daftar Layanan','report_services',NULL),(14,8,'Laporan Pelanggan','report_customers',NULL),(15,8,'Laporan Pesanan','report_orders',NULL),(16,8,'Laporan Biaya Pengeluaran','report_operational_costs',NULL),(17,8,'Laporan Pendapatan','report_income',NULL);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `MODULE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MODULE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `modules` */

insert  into `modules`(`MODULE_ID`,`NAME`,`DESCRIPTION`) values (1,'Home',NULL),(2,'Dashboard',NULL),(3,'Pengaturan',NULL),(4,'Layanan',NULL),(5,'Pelanggan',NULL),(6,'Pesanan',NULL),(7,'Biaya Pengeluaran',NULL),(8,'Laporan',NULL);

/*Table structure for table `operational_cost_details` */

DROP TABLE IF EXISTS `operational_cost_details`;

CREATE TABLE `operational_cost_details` (
  `OP_COST_DETAIL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OP_COST_ID` int(10) unsigned DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `PRICE` decimal(9,2) NOT NULL,
  `AMOUNT` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`OP_COST_DETAIL_ID`),
  KEY `FK_OPERATIONAL_COST_DETAILS_REF_OPERATIONAL_COSTS` (`OP_COST_ID`),
  CONSTRAINT `FK_OPERATIONAL_COST_DETAILS_REF_OPERATIONAL_COSTS` FOREIGN KEY (`OP_COST_ID`) REFERENCES `operational_costs` (`OP_COST_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `operational_cost_details` */

insert  into `operational_cost_details`(`OP_COST_DETAIL_ID`,`OP_COST_ID`,`NAME`,`PRICE`,`AMOUNT`) values (1,1,'Deterjen','10500.00',5),(2,1,'Pelembut','4200.00',4),(3,2,'Deterjen Cair','12000.00',3);

/*Table structure for table `operational_costs` */

DROP TABLE IF EXISTS `operational_costs`;

CREATE TABLE `operational_costs` (
  `OP_COST_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned DEFAULT NULL,
  `DATE` datetime NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `TOTAL_COST` decimal(9,2) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`OP_COST_ID`),
  KEY `FK_OPERATIONAL_COSTS_REF_USERS` (`USER_ID`),
  CONSTRAINT `FK_OPERATIONAL_COSTS_REF_USERS` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `operational_costs` */

insert  into `operational_costs`(`OP_COST_ID`,`USER_ID`,`DATE`,`NAME`,`TOTAL_COST`,`DESCRIPTION`,`IS_DISABLE`) values (1,1,'2014-08-22 12:54:14','Nota : 20140822001','69300.00','Belanja Perlengkapan',0),(2,1,'2014-08-23 10:56:00','Nota : 20140823012','36000.00','Belanja Perlengkapan',0);

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `ORDER_ID` int(10) unsigned DEFAULT NULL,
  `SERVICE_ID` int(10) unsigned DEFAULT NULL,
  `PRICE` decimal(9,2) NOT NULL,
  `AMOUNT` smallint(5) unsigned NOT NULL,
  KEY `FK_ORDER_DETAILS_REF_ORDERS` (`ORDER_ID`),
  KEY `FK_ORDER_DETAILS_REF_SERVICES` (`SERVICE_ID`),
  CONSTRAINT `FK_ORDER_DETAILS_REF_ORDERS` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_ORDER_DETAILS_REF_SERVICES` FOREIGN KEY (`SERVICE_ID`) REFERENCES `services` (`SERVICE_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `order_details` */

insert  into `order_details`(`ORDER_ID`,`SERVICE_ID`,`PRICE`,`AMOUNT`) values (1,3,'6000.00',10),(1,5,'6000.00',4),(1,10,'6000.00',6),(1,63,'7000.00',16),(2,2,'6000.00',3),(2,12,'6000.00',2),(2,26,'6000.00',5),(2,38,'10000.00',4),(2,63,'7000.00',10),(3,3,'6000.00',4),(3,6,'6000.00',6),(3,10,'6000.00',4),(3,41,'10000.00',2),(3,63,'7000.00',20),(4,9,'6000.00',10),(4,10,'6000.00',5),(4,4,'6000.00',5),(4,3,'6000.00',3),(4,51,'7000.00',4),(4,63,'7000.00',10),(4,65,'11000.00',5),(5,3,'6000.00',2),(5,9,'6000.00',5),(5,66,'10000.00',1),(6,5,'6000.00',3),(6,12,'6000.00',1),(6,17,'6000.00',2),(6,66,'10000.00',1),(7,3,'6000.00',2),(7,4,'6000.00',3),(7,5,'6000.00',1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `ORDER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ORDER_NUMBER` varchar(10) NOT NULL,
  `CASHIER_ID` int(10) unsigned DEFAULT NULL,
  `CUSTOMER_ID` int(10) unsigned DEFAULT NULL,
  `DATE_ORDER` datetime NOT NULL,
  `DEADLINE` datetime NOT NULL,
  `DATE_RETRIEVAL` datetime DEFAULT NULL,
  `DOWN_PAYMENT` decimal(9,2) NOT NULL,
  `TOTAL_PAYMENT` decimal(9,2) NOT NULL,
  `PAY_STATUS` tinyint(1) NOT NULL DEFAULT '0',
  `ORDER_STATUS` tinyint(1) NOT NULL DEFAULT '0',
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ORDER_ID`),
  KEY `FK_ORDERS_REF_USERS` (`CASHIER_ID`),
  KEY `FK_ORDERS_REF_CUSTOMERS` (`CUSTOMER_ID`),
  CONSTRAINT `FK_ORDERS_REF_CUSTOMERS` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`CUSTOMER_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_ORDERS_REF_USERS` FOREIGN KEY (`CASHIER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`ORDER_ID`,`ORDER_NUMBER`,`CASHIER_ID`,`CUSTOMER_ID`,`DATE_ORDER`,`DEADLINE`,`DATE_RETRIEVAL`,`DOWN_PAYMENT`,`TOTAL_PAYMENT`,`PAY_STATUS`,`ORDER_STATUS`,`DESCRIPTION`,`IS_DISABLE`) values (1,'1408200001',1,2,'2014-08-20 08:15:14','2014-08-23 08:15:14','2014-08-23 15:30:33','0.00','232000.00',1,3,NULL,0),(2,'1408200002',1,4,'2014-08-20 09:16:05','2014-08-23 09:16:05','2014-08-23 16:31:49','0.00','170000.00',1,3,NULL,0),(3,'1408210001',1,3,'2014-08-21 09:17:02','2014-08-24 09:17:02',NULL,'0.00','244000.00',0,2,NULL,0),(4,'1408220001',1,5,'2014-08-22 10:18:13','2014-08-25 10:18:13',NULL,'0.00','291000.00',0,0,NULL,0),(5,'1408230001',1,7,'2014-08-23 09:37:21','2014-08-26 09:37:21',NULL,'0.00','52000.00',0,2,NULL,0),(6,'1408240001',1,8,'2014-08-24 10:44:01','2014-08-27 10:44:01',NULL,'0.00','46000.00',0,0,NULL,0),(7,'1408250001',NULL,9,'2014-08-25 09:50:37','2014-08-28 09:50:37',NULL,'0.00','36000.00',0,1,NULL,0);

/*Table structure for table `service_categories` */

DROP TABLE IF EXISTS `service_categories`;

CREATE TABLE `service_categories` (
  `SERVICE_CATEGORY_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SERVICE_CATEGORY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `service_categories` */

insert  into `service_categories`(`SERVICE_CATEGORY_ID`,`NAME`,`DESCRIPTION`,`IS_DISABLE`) values (1,'Laundry',NULL,0),(2,'Dry Clean',NULL,0),(3,'Kiloan','',0),(4,'Ongkos Kirim','',0),(5,'Lainnya','',0);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `SERVICE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SERVICE_CATEGORY_ID` int(10) unsigned DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `SIZE` varchar(50) DEFAULT NULL,
  `UNIT` varchar(50) DEFAULT NULL,
  `PRICE` decimal(9,2) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SERVICE_ID`),
  KEY `FK_SERVICES_REF_SERVICE_CATEGORIES` (`SERVICE_CATEGORY_ID`),
  CONSTRAINT `FK_SERVICES_REF_SERVICE_CATEGORIES` FOREIGN KEY (`SERVICE_CATEGORY_ID`) REFERENCES `service_categories` (`SERVICE_CATEGORY_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `services` */

insert  into `services`(`SERVICE_ID`,`SERVICE_CATEGORY_ID`,`NAME`,`SIZE`,`UNIT`,`PRICE`,`DESCRIPTION`,`IS_DISABLE`) values (1,1,'Jas / Safari','','Gantung / Potong','6000.00','',0),(2,1,'Baju Anak','','Gantung / Potong','6000.00','',0),(3,1,'Celana Pendek','','Gantung / Potong','6000.00','',0),(4,1,'Celana Panjang','','Gantung / Potong','6000.00','',0),(5,1,'Celana Jeans','','Gantung / Potong','6000.00','',0),(6,1,'Kemeja Pendek','','Gantung / Potong','6000.00','',0),(7,1,'Kemeja Panjang','','Gantung / Potong','6000.00','',0),(8,1,'Kemeja Batik','','Gantung / Potong','6000.00','',0),(9,1,'Baju Kaos / T Shirt','','Gantung / Potong','6000.00','',0),(10,1,'Sweater / Jaket','','Gantung / Potong','6000.00','',0),(11,1,'Jas Hujan / Baju Koko','','Gantung / Potong','6000.00','',0),(12,1,'Jaket Jeans','','Gantung / Potong','6000.00','',0),(13,1,'Pakaian Dalam','','Gantung / Potong','6000.00','',0),(14,1,'Sarung / Dasi / Topi','','Gantung / Potong','6000.00','',0),(15,1,'Sapu Tangan / Kaos Kaki','','Gantung / Potong','6000.00','',0),(16,1,'Rompi / Sepatu','','Gantung / Potong','6000.00','',0),(17,1,'Jas / Blazer','','Gantung / Potong','6000.00','',0),(18,1,'Kebaya','','Gantung / Potong','6000.00','',0),(19,1,'Blus','','Gantung / Potong','6000.00','',0),(20,1,'Rok Biasa','','Gantung / Potong','6000.00','',0),(21,1,'Rok Plisket / Panjang','','Gantung / Potong','6000.00','',0),(22,1,'Rok & Blus Biasa','','Gantung / Potong','6000.00','',0),(23,1,'Baju Tidur / Stelan','','Gantung / Potong','6000.00','',0),(24,1,'Baju Muslim / Fasmina','','Gantung / Potong','6000.00','',0),(25,1,'Mukenah / Jilbab','','Gantung / Potong','6000.00','',0),(26,1,'Sajadah','','Gantung / Potong','6000.00','',0),(27,1,'Selendang / Slayer','','Gantung / Potong','6000.00','',0),(28,1,'Short / Long Dress / York','','Gantung / Potong','6000.00','',0),(29,1,'Gaun / Baju Pesta','','Gantung / Potong','6000.00','',0),(30,1,'Gaun Anak','','Gantung / Potong','6000.00','',0),(31,1,'Korset / Pakaian Dalam','','Gantung / Potong','6000.00','',0),(32,2,'Jas / Safari','','Potong','10000.00','',0),(33,2,'Baju Anak','','Potong','7000.00','',0),(34,2,'Celana Pendek','','Potong','7000.00','',0),(35,2,'Celana Panjang','','Potong','8000.00','',0),(36,2,'Celana Jeans','','Potong','10000.00','',0),(37,2,'Kemeja Pendek','','Potong','9000.00','',0),(38,2,'Kemeja Panjang','','Potong','10000.00','',0),(39,2,'Kemeja Batik','','Potong','10000.00','',0),(40,2,'Baju Kaos / T Shirt','','Potong','8000.00','',0),(41,2,'Sweater / Jaket','','Potong','10000.00','',0),(42,2,'Jas Hujan / Baju Koko','','Potong','10000.00','',0),(43,2,'Jaket Jeans','','Potong','10000.00','',0),(44,2,'Pakaian Dalam','','Potong','7000.00','',0),(45,2,'Sarung / Dasi / Topi','','Potong','7000.00','',0),(46,2,'Sapu Tangan / Kaos Kaki','','Potong','7000.00','',0),(47,2,'Rompi / Sepatu','','Potong','10000.00','',0),(48,2,'Jas / Blazer','','Potong','10000.00','',0),(49,2,'Kebaya','','Potong','10000.00','',0),(50,2,'Blus','','Potong','10000.00','',0),(51,2,'Rok Biasa','','Potong','7000.00','',0),(52,2,'Rok Plisket / Panjang','','Potong','9000.00','',0),(53,2,'Rok & Blus Biasa','','Potong','8000.00','',0),(54,2,'Baju Tidur / Stelan','','Potong','10000.00','',0),(55,2,'Baju Muslim / Fasmina','','Potong','10000.00','',0),(56,2,'Mukenah / Jilbab','','Potong','10000.00','',0),(57,2,'Sajadah','','Potong','9000.00','',0),(58,2,'Selendang / Slayer','','Potong','7000.00','',0),(59,2,'Short / Long Dress / York','','Potong','10000.00','',0),(60,2,'Gaun / Baju Pesta','','Potong','10000.00','',0),(61,2,'Gaun Anak','','Potong','10000.00','',0),(62,2,'Korset / Pakaian Dalam','','Potong','7000.00','',0),(63,3,'Kiloan Reguler','','Kg','7000.00','',0),(64,3,'Kiloan Ekspress 12 Jam','','Kg','14000.00','',0),(65,3,'Kiloan Ekspress 24 Jam','','Kg','11000.00','',0),(66,4,'Jarak Dekat','','','10000.00','',0),(67,4,'Jarak Sedang','','','15000.00','',0),(68,4,'Jarak Jauh','','','20000.00','',0);

/*Table structure for table `user_permission_access` */

DROP TABLE IF EXISTS `user_permission_access`;

CREATE TABLE `user_permission_access` (
  `PERMISSION_ID` int(10) unsigned DEFAULT NULL,
  `MODULE_FUNCTION_ID` int(10) unsigned DEFAULT NULL,
  `READ` tinyint(1) NOT NULL,
  `CREATE` tinyint(1) NOT NULL,
  `UPDATE` tinyint(1) NOT NULL,
  `DELETE` tinyint(1) NOT NULL,
  KEY `FK_USER_PERMISSION_ACCESS_REF_USER_PERMISSIONS` (`PERMISSION_ID`),
  KEY `FK_USER_PERMISSION_ACCESS_REF_MODULE_FUNCTIONS` (`MODULE_FUNCTION_ID`),
  CONSTRAINT `FK_USER_PERMISSION_ACCESS_REF_MODULE_FUNCTIONS` FOREIGN KEY (`MODULE_FUNCTION_ID`) REFERENCES `module_functions` (`MODULE_FUNCTION_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_PERMISSION_ACCESS_REF_USER_PERMISSIONS` FOREIGN KEY (`PERMISSION_ID`) REFERENCES `user_permissions` (`PERMISSION_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_permission_access` */

insert  into `user_permission_access`(`PERMISSION_ID`,`MODULE_FUNCTION_ID`,`READ`,`CREATE`,`UPDATE`,`DELETE`) values (1,1,1,1,1,1),(2,1,1,1,1,1),(3,1,1,1,1,1),(1,2,1,1,1,1),(2,2,1,0,0,0),(3,2,0,0,0,0),(1,3,1,1,1,1),(2,3,0,0,0,0),(3,3,0,0,0,0),(1,4,1,1,1,1),(2,4,0,0,0,0),(3,4,0,0,0,0),(1,5,1,1,1,1),(2,5,0,0,0,0),(3,5,0,0,0,0),(1,6,1,1,1,1),(2,6,0,0,0,0),(3,6,0,0,0,0),(1,7,1,1,1,1),(2,7,0,0,0,0),(3,7,0,0,0,0),(1,8,1,1,1,1),(2,8,0,0,0,0),(3,8,0,0,0,0),(1,9,1,1,1,1),(2,9,0,0,0,0),(3,9,0,0,0,0),(1,10,1,1,1,1),(2,10,0,0,0,0),(3,10,0,0,0,0),(1,11,1,1,1,1),(2,11,0,0,0,0),(3,11,0,0,0,0),(1,12,1,1,1,1),(2,12,0,0,0,0),(3,12,0,0,0,0),(1,13,1,1,1,1),(2,13,0,0,0,0),(3,13,0,0,0,0),(1,14,1,1,1,1),(2,14,0,0,0,0),(3,14,0,0,0,0),(1,15,1,1,1,1),(2,15,0,0,0,0),(3,15,0,0,0,0),(1,16,1,1,1,1),(2,16,0,0,0,0),(3,16,0,0,0,0),(1,17,1,1,1,1),(2,17,0,0,0,0),(3,17,0,0,0,0);

/*Table structure for table `user_permissions` */

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `PERMISSION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PERMISSION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_permissions` */

insert  into `user_permissions`(`PERMISSION_ID`,`NAME`,`DESCRIPTION`,`IS_DISABLE`) values (1,'Admin',NULL,0),(2,'Cabang',NULL,0),(3,'Pelanggan',NULL,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `USER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PERMISSION_ID` int(10) unsigned DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `IS_DISABLE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`USER_ID`),
  KEY `FK_USERS_REF_USER_PERMISSIONS` (`PERMISSION_ID`),
  CONSTRAINT `FK_USERS_REF_USER_PERMISSIONS` FOREIGN KEY (`PERMISSION_ID`) REFERENCES `user_permissions` (`PERMISSION_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`USER_ID`,`PERMISSION_ID`,`NAME`,`EMAIL`,`USERNAME`,`PASSWORD`,`IS_DISABLE`) values (1,1,'Demo Admin',NULL,'demoadmin','61152c80d1514e22fba66002597d0104',0),(2,2,'Demo Cabang',NULL,'democabang','21f8274e220170bb2617c3b9a1b56cbb',0),(3,3,'Demo Pelanggan',NULL,'demopelanggan','0ac8ae1917d1201bb6aecf45d6b31528',0),(4,2,'Pelangi Laundry Buah Batu','pelangibuahbatu@gmail.com','pelangibuahbatu','cb09918fcd2d2dccaf32da40f60462f0',0),(5,2,'Pelangi Laundry Cibiru','pelangicibiru@gmail.com','pelangicibiru','0210f427a88b65ddb0e3a4a1973ebc43',0),(6,2,'Pelangi Laundry Pasteur','pelangipasteur@gmail.com','pelangipasteur','e892d36e30dbe9d5890d57336cbc0599',0),(7,2,'Pelangi Laundry Cimahi','pelangicimahi@gmail.com','pelangicimahi','76f8f615ad8586f26dbddfb9789191ad',0),(8,2,'Pelangi Laundry Dago','pelangidago@gmail.com','pelangidago','f6b219dedf9add488f22644a5bbd8a33',0),(9,3,'Dadang Sutisna','dadangsutisna@gmail.com','dadangsutisna','cda2c188ee04e47deacdfc886443a911',0),(10,3,'Willy Budiman','willybudiman@gmail.com','willybudiman','2b4bc97ab9ac852535dfe6122b611735',0),(11,3,'Suhendra','suhendra@gmail.com','suhendra','46bb32621a172eac8fdae7acb3932764',0);

/* Procedure structure for procedure `ClearDBS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ClearDBS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ClearDBS`(IN `pass` VARCHAR(100))
BEGIN
    IF md5(pass) = 'fec82079b24f4db5e61c3c61702dac64' THEN
	SET FOREIGN_KEY_CHECKS=0;
	TRUNCATE `customer_types`;
	TRUNCATE `customers`;
	TRUNCATE `module_functions`;
	TRUNCATE `modules`;
	TRUNCATE `operational_cost_details`;
	TRUNCATE `operational_costs`;
	TRUNCATE `order_details`;
	TRUNCATE `orders`;
	TRUNCATE `service_categories`;
	TRUNCATE `services`;
	TRUNCATE `user_permission_access`;
	TRUNCATE `user_permissions`;
	TRUNCATE `users`;
	SET FOREIGN_KEY_CHECKS=1;
	
	
	INSERT INTO `user_permissions` (`user_permissions`.`NAME`) VALUES ('Admin'); SET @usr_per_id = LAST_INSERT_ID();
		INSERT INTO `users` (
			`users`.`PERMISSION_ID`,
			`users`.`NAME`,
			`users`.`USERNAME`,
			`users`.`PASSWORD`
		) VALUES (
			@usr_per_id,
			'Demo Admin',
			'demoadmin',
			MD5('demoadmin')
		);
	INSERT INTO `user_permissions` (`user_permissions`.`NAME`) VALUES ('Cabang'); SET @usr_per_id = LAST_INSERT_ID();
		INSERT INTO `users` (
			`users`.`PERMISSION_ID`,
			`users`.`NAME`,
			`users`.`USERNAME`,
			`users`.`PASSWORD`
		) VALUES (
			@usr_per_id,
			'Demo Cabang',
			'democabang',
			MD5('democabang')
		);
	INSERT INTO `user_permissions` (`user_permissions`.`NAME`) VALUES ('Pelanggan'); SET @usr_per_id = LAST_INSERT_ID();
		INSERT INTO `users` (
			`users`.`PERMISSION_ID`,
			`users`.`NAME`,
			`users`.`USERNAME`,
			`users`.`PASSWORD`
		) VALUES (
			@usr_per_id,
			'Demo Pelanggan',
			'demopelanggan',
			MD5('demopelanggan')
		);
	INSERT INTO `service_categories` (`service_categories`.`NAME`) VALUES ('Laundry');
	INSERT INTO `service_categories` (`service_categories`.`NAME`) VALUES ('Dry Clean');
	INSERT INTO `service_categories` (`service_categories`.`NAME`) VALUES ('Lainnya');
	INSERT INTO `customer_types` (`customer_types`.`NAME`) VALUES ('Cabang');
	INSERT INTO `customer_types` (`customer_types`.`NAME`) VALUES ('Reguler');
	INSERT INTO `customer_types` (`customer_types`.`NAME`) VALUES ('Online');
	INSERT INTO `customers` (
		`customers`.`CUSTOMER_TYPE_ID`,
		`customers`.`USER_ID`,
		`customers`.`NAME`
	) VALUES (2,3,'Anonymous');
	
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Home'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Home','home'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 1, 1, 1, 1);
		
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Dashboard'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Dashboard','dashboard'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 1, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
		
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Pengaturan'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Group Pengguna','user_permissions'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Pengguna','users'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
		
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Layanan'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Kategori Layanan','service_categories'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Daftar Layanan','services'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Pelanggan'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Jenis Pelanggan','customer_types'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Pelanggan','customers'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Pesanan'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Pesanan','orders'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Pesanan Online','order_online'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Pengambilan Pesanan','order_retrieval'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Biaya Pengeluaran'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Biaya Pengeluaran','operational_costs'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    
	INSERT INTO `modules` (`modules`.`NAME`) VALUES ('Laporan'); SET @mod_id = LAST_INSERT_ID();
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Laporan Daftar Layanan','report_services'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Laporan Pelanggan','report_customers'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Laporan Pesanan','report_orders'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Laporan Biaya Pengeluaran','report_operational_costs'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
	    INSERT INTO `module_functions` (`module_functions`.`MODULE_ID`,`module_functions`.`NAME`,`module_functions`.`CONTROLLER`) VALUES (@mod_id,'Laporan Pendapatan','report_income'); SET @mod_func_id = LAST_INSERT_ID();
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (1, @mod_func_id, 1, 1, 1, 1);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (2, @mod_func_id, 0, 0, 0, 0);
		
		INSERT INTO `user_permission_access` (
			`user_permission_access`.`PERMISSION_ID`,
			`user_permission_access`.`MODULE_FUNCTION_ID`,
			`user_permission_access`.`READ`,
			`user_permission_access`.`CREATE`,
			`user_permission_access`.`UPDATE`,
			`user_permission_access`.`DELETE`
		) VALUES (3, @mod_func_id, 0, 0, 0, 0);
		
    END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_CUSTOMERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_CUSTOMERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_CUSTOMERS`(
	IN cus_id 	INT(10)
    )
BEGIN
	update 	`customers`
	set 	`customers`.`IS_DISABLE` = 1 
	where 	`customers`.`CUSTOMER_ID` = cus_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_CUSTOMER_TYPES` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_CUSTOMER_TYPES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_CUSTOMER_TYPES`(
	in cus_id 	int(10)
    )
BEGIN
	update 	`customer_types`
	set 	`customer_types`.`IS_DISABLE` = 1 
	where 	`customer_types`.`CUSTOMER_TYPE_ID` = cus_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_OPERATIONAL_COSTS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_OPERATIONAL_COSTS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_OPERATIONAL_COSTS`(
	in op_id 	int(10)
    )
BEGIN
	update 	`operational_costs`
	set 	`operational_costs`.`IS_DISABLE` = 1 
	where 	`operational_costs`.`OP_COST_ID` = op_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_OPERATIONAL_COST_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_OPERATIONAL_COST_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_OPERATIONAL_COST_DETAILS`(
	in op_id	int(10)
    )
BEGIN
	delete from `operational_cost_details` where `operational_cost_details`.`OP_COST_ID` = op_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_ORDERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_ORDERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_ORDERS`(
	in ord_id 	int(10)
    )
BEGIN
	update 	`orders`
	set 	`orders`.`IS_DISABLE` = 1 
	where 	`orders`.`ORDER_ID` = ord_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_ORDER_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_ORDER_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_ORDER_DETAILS`(
	in ord_id	int(10)
    )
BEGIN
	delete from `order_details` where `order_details`.`ORDER_ID` = ord_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_SERVICES` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_SERVICES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_SERVICES`(
	in ser_id 	int(10)
    )
BEGIN
	update 	`services` 
	set 	`services`.`IS_DISABLE` = 1 
	where 	`services`.`SERVICE_ID` = ser_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_SERVICE_CATEGORIES` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_SERVICE_CATEGORIES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_SERVICE_CATEGORIES`(
	in ser_id 	int(10)
    )
BEGIN
	update 	`service_categories` 
	set 	`service_categories`.`IS_DISABLE` = 1 
	where 	`service_categories`.`SERVICE_CATEGORY_ID` = ser_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_USERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_USERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_USERS`(
	in usr_id 	int(10)
    )
BEGIN
	update 	`users` 
	set 	`users`.`IS_DISABLE` = 1 
	where 	`users`.`USER_ID` = usr_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_USER_PERMISSIONS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_USER_PERMISSIONS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_USER_PERMISSIONS`(
	in per_id 	int(10)
    )
BEGIN
	update 	`user_permissions` 
	set 	`user_permissions`.`IS_DISABLE` = 1 
	where 	`user_permissions`.`PERMISSION_ID` = per_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `del_USER_PERMISSION_ACCESS` */

/*!50003 DROP PROCEDURE IF EXISTS  `del_USER_PERMISSION_ACCESS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `del_USER_PERMISSION_ACCESS`(
	in per_id	int(10)
    )
BEGIN
	delete from `user_permission_access` where `user_permission_access`.`PERMISSION_ID` = per_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_CUSTOMERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_CUSTOMERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_CUSTOMERS`(
	in type_id 	int(10),
	in usr_id	int(10),
	in ow 		varchar(100),
	IN nm 		VARCHAR(100),
	in ad 		varchar(255),
	in ph 		varchar(20),
	in em 		varchar(100)
    )
BEGIN
	INSERT INTO `customers` (
		`customers`.`CUSTOMER_TYPE_ID`,
		`customers`.`USER_ID`,
		`customers`.`OWNER`,
		`customers`.`NAME`,
		`customers`.`ADDRESS`,
		`customers`.`PHONE`,
		`customers`.`EMAIL`
	) VALUES (
		type_id,
		usr_id,
		ow,
		nm,
		ad,
		ph,
		em
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_CUSTOMER_TYPES` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_CUSTOMER_TYPES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_CUSTOMER_TYPES`(
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	INSERT INTO `customer_types` (
		`customer_types`.`NAME`,
		`customer_types`.`DESCRIPTION`
	) VALUES (
		nm,
		des
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_OPERATIONAL_COSTS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_OPERATIONAL_COSTS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_OPERATIONAL_COSTS`(
	in usr 		int(10),
	IN nm 		VARCHAR(100),
	in tot 		decimal(9,2),
	IN des 		VARCHAR(255)
    )
BEGIN
	INSERT INTO `operational_costs` (
		`operational_costs`.`USER_ID`,
		`operational_costs`.`DATE`,
		`operational_costs`.`NAME`,
		`operational_costs`.`TOTAL_COST`,
		`operational_costs`.`DESCRIPTION`
	) VALUES (
		usr,
		now(),
		nm,
		tot,
		des
	);
	SELECT LAST_INSERT_ID() AS LAST_ID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_OPERATIONAL_COST_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_OPERATIONAL_COST_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_OPERATIONAL_COST_DETAILS`(
	in op_id 	int(10),
	in nm 		varchar(100),
	in pri 		decimal(9,2),
	in am 		smallint(5)
    )
BEGIN
	insert into `operational_cost_details` (
		`operational_cost_details`.`OP_COST_ID`,
		`operational_cost_details`.`NAME`,
		`operational_cost_details`.`PRICE`,
		`operational_cost_details`.`AMOUNT`
	) VALUES (
		op_id,
		nm,
		pri,
		am
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_ORDERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_ORDERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_ORDERS`(
	in cas_id 		int(10),
	in cust_id 		int(10),
	in d_ret 		datetime,
	in down_pay		decimal(9,2),
	in tot_pay		decimal(9,2),
	in p_status 		tinyint(1),
	in o_status 		tinyint(1),
	in des 			varchar(255)
    )
BEGIN
	DECLARE ord_num VARCHAR(20) DEFAULT "";
	SELECT CONCAT(DATE_FORMAT(NOW(), '%y%m%d'),LEFT('0000', 4 - LENGTH(COUNT(*))), COUNT(*) + 1) INTO ord_num FROM `orders` WHERE DATE(`orders`.`DATE_ORDER`) = DATE(NOW());
	INSERT INTO `orders` (
		`orders`.`ORDER_NUMBER`,
		`orders`.`CASHIER_ID`,
		`orders`.`CUSTOMER_ID`,
		`orders`.`DATE_ORDER`,
		`orders`.`DEADLINE`,
		`orders`.`DATE_RETRIEVAL`,
		`orders`.`DOWN_PAYMENT`,
		`orders`.`TOTAL_PAYMENT`,
		`orders`.`PAY_STATUS`,
		`orders`.`ORDER_STATUS`,
		`orders`.`DESCRIPTION`
	) VALUES (
		ord_num,
		cas_id,
		cust_id,
		now(),
		DATE_ADD(NOW(), INTERVAL 3 DAY),
		d_ret,
		down_pay,
		tot_pay,
		p_status,
		o_status,
		des
	);
	SELECT LAST_INSERT_ID() AS LAST_ID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_ORDER_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_ORDER_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_ORDER_DETAILS`(
	in ord_id 	int(10),
	in ser_id 	int(10),
	in pri 		decimal(9,2),
	in am 		smallint(5)
    )
BEGIN
	insert into `order_details` (
		`order_details`.`ORDER_ID`,
		`order_details`.`SERVICE_ID`,
		`order_details`.`PRICE`,
		`order_details`.`AMOUNT`
	) VALUES (
		ord_id,
		ser_id,
		pri,
		am
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_SERVICES` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_SERVICES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_SERVICES`(
	in cat_id	int(10),
	IN nm 		VARCHAR(100),
	in si 		varchar(50),
	in un 		varchar(50),
	in pri 		decimal(9,2),
	IN des 		VARCHAR(255)
    )
BEGIN
	INSERT INTO `services` (
		`services`.`SERVICE_CATEGORY_ID`,
		`services`.`NAME`,
		`services`.`SIZE`,
		`services`.`UNIT`,
		`services`.`PRICE`,
		`services`.`DESCRIPTION`
	) VALUES (
		cat_id,
		nm,
		si,
		un,
		pri,
		des
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_SERVICE_CATEGORIES` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_SERVICE_CATEGORIES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_SERVICE_CATEGORIES`(
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	INSERT INTO `service_categories` (
		`service_categories`.`NAME`,
		`service_categories`.`DESCRIPTION`
	) VALUES (
		nm,
		des
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_USERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_USERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_USERS`(
	in per_id 	int(10),
	in nm 		varchar(100),
	in em 		varchar(100),
	IN usr 		VARCHAR(100),
	IN pass 	VARCHAR(100)
)
BEGIN
	insert into `users` (
		`users`.`PERMISSION_ID`,
		`users`.`NAME`,
		`users`.`EMAIL`,
		`users`.`USERNAME`,
		`users`.`PASSWORD`
	) values (
		per_id,
		nm,
		em,
		usr,
		md5(pass)
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_USER_PERMISSIONS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_USER_PERMISSIONS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_USER_PERMISSIONS`(
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	INSERT INTO `user_permissions` (
		`user_permissions`.`NAME`,
		`user_permissions`.`DESCRIPTION`
	) VALUES (
		nm,
		des
	);
	SELECT LAST_INSERT_ID() AS LAST_ID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ins_USER_PERMISSION_ACCESS` */

/*!50003 DROP PROCEDURE IF EXISTS  `ins_USER_PERMISSION_ACCESS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ins_USER_PERMISSION_ACCESS`(
	IN per_id	INT(10),
	IN mod_func_id	INT(10),
	IN re 		TINYINT(1),
	IN cr 		TINYINT(1),
	IN up 		TINYINT(1),
	IN de 		TINYINT(1)
    )
BEGIN
	INSERT INTO `user_permission_access` (
		`user_permission_access`.`PERMISSION_ID`,
		`user_permission_access`.`MODULE_FUNCTION_ID`,
		`user_permission_access`.`READ`,
		`user_permission_access`.`CREATE`,
		`user_permission_access`.`UPDATE`,
		`user_permission_access`.`DELETE`
	) VALUES (
		per_id,
		mod_func_id,
		re,
		cr,
		up,
		de
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `LAST_ID_CUSTOMERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `LAST_ID_CUSTOMERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LAST_ID_CUSTOMERS`()
BEGIN
	SELECT MAX(`customers`.`CUSTOMER_ID`) AS LAST_ID FROM `customers`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `LAST_ID_ORDERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `LAST_ID_ORDERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LAST_ID_ORDERS`()
BEGIN
	SELECT MAX(`orders`.`ORDER_ID`) AS LAST_ID FROM `orders`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `LAST_ID_USERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `LAST_ID_USERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LAST_ID_USERS`()
BEGIN
	SELECT MAX(`users`.`USER_ID`) AS LAST_ID FROM `users`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_CUSTOMERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_CUSTOMERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_CUSTOMERS`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT 	`customers`.`CUSTOMER_ID`,
			`customers`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME` AS TYPE_NAME,
			`customers`.`USER_ID`, `users`.`NAME` AS USER_NAME, `users`.`EMAIL` AS USER_EMAIL, `users`.`USERNAME`,
			`customers`.`OWNER`, `customers`.`NAME`, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`, 
			`customers`.`IS_DISABLE`
		FROM 	`customers`
		INNER JOIN `customer_types` ON `customer_types`.`CUSTOMER_TYPE_ID` = `customers`.`CUSTOMER_TYPE_ID`
		INNER JOIN `users` ON `users`.`USER_ID` = `customers`.`USER_ID`
		WHERE `customers`.`IS_DISABLE` = 0;
	    ELSE
		SELECT 	`customers`.`CUSTOMER_ID`,
			`customers`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME` AS TYPE_NAME,
			`customers`.`USER_ID`, `users`.`NAME` AS USER_NAME, `users`.`EMAIL` AS USER_EMAIL, `users`.`USERNAME`,
			`customers`.`OWNER`, `customers`.`NAME`, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`, 
			`customers`.`IS_DISABLE`
		FROM 	`customers`
		INNER JOIN `customer_types` ON `customer_types`.`CUSTOMER_TYPE_ID` = `customers`.`CUSTOMER_TYPE_ID`
		INNER JOIN `users` ON `users`.`USER_ID` = `customers`.`USER_ID`
		WHERE `customers`.`IS_DISABLE` = 0
		and CONCAT(`customer_types`.`NAME`,' ',`users`.`NAME`,' ',`users`.`USERNAME`,' ',`customers`.`NAME`,' ',`customers`.`ADDRESS`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT 	`customers`.`CUSTOMER_ID`,
			`customers`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME` AS TYPE_NAME,
			`customers`.`USER_ID`, `users`.`NAME` AS USER_NAME, `users`.`EMAIL` AS USER_EMAIL, `users`.`USERNAME`,
			`customers`.`OWNER`, `customers`.`NAME`, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`, 
			`customers`.`IS_DISABLE`
		FROM 	`customers`
		INNER JOIN `customer_types` ON `customer_types`.`CUSTOMER_TYPE_ID` = `customers`.`CUSTOMER_TYPE_ID`
		INNER JOIN `users` ON `users`.`USER_ID` = `customers`.`USER_ID`
		WHERE `customers`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT 	`customers`.`CUSTOMER_ID`,
			`customers`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME` AS TYPE_NAME,
			`customers`.`USER_ID`, `users`.`NAME` AS USER_NAME, `users`.`EMAIL` AS USER_EMAIL, `users`.`USERNAME`,
			`customers`.`OWNER`, `customers`.`NAME`, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`, 
			`customers`.`IS_DISABLE`
		FROM 	`customers`
		INNER JOIN `customer_types` ON `customer_types`.`CUSTOMER_TYPE_ID` = `customers`.`CUSTOMER_TYPE_ID`
		INNER JOIN `users` ON `users`.`USER_ID` = `customers`.`USER_ID`
		WHERE `customers`.`IS_DISABLE` = 0
		AND CONCAT(`customer_types`.`NAME`,' ',`users`.`NAME`,' ',`users`.`USERNAME`,' ',`customers`.`NAME`,' ',`customers`.`ADDRESS`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE				
		SELECT 	`customers`.`CUSTOMER_ID`,
			`customers`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME` AS TYPE_NAME,
			`customers`.`USER_ID`, `users`.`NAME` AS USER_NAME, `users`.`EMAIL` AS USER_EMAIL, `users`.`USERNAME`,
			`customers`.`OWNER`, `customers`.`NAME`, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`, 
			`customers`.`IS_DISABLE`
		FROM 	`customers`
		INNER JOIN `customer_types` ON `customer_types`.`CUSTOMER_TYPE_ID` = `customers`.`CUSTOMER_TYPE_ID`
		INNER JOIN `users` ON `users`.`USER_ID` = `customers`.`USER_ID`
		WHERE `customers`.`IS_DISABLE` = 0
		and `customers`.`CUSTOMER_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_CUSTOMER_TYPES` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_CUSTOMER_TYPES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_CUSTOMER_TYPES`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT `customer_types`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME`, `customer_types`.`DESCRIPTION`, `customer_types`.`IS_DISABLE`
		FROM `customer_types`
		WHERE `customer_types`.`IS_DISABLE` = 0;
	    ELSE
		SELECT `customer_types`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME`, `customer_types`.`DESCRIPTION`, `customer_types`.`IS_DISABLE`
		FROM `customer_types`
		WHERE `customer_types`.`IS_DISABLE` = 0
		and CONCAT(`customer_types`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT `customer_types`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME`, `customer_types`.`DESCRIPTION`, `customer_types`.`IS_DISABLE`
		FROM `customer_types`
		WHERE `customer_types`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT `customer_types`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME`, `customer_types`.`DESCRIPTION`, `customer_types`.`IS_DISABLE`
		FROM `customer_types`
		WHERE `customer_types`.`IS_DISABLE` = 0
		and CONCAT(`customer_types`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT `customer_types`.`CUSTOMER_TYPE_ID`, `customer_types`.`NAME`, `customer_types`.`DESCRIPTION`, `customer_types`.`IS_DISABLE`
		FROM `customer_types`
		WHERE `customer_types`.`IS_DISABLE` = 0
		and `customer_types`.`CUSTOMER_TYPE_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_MODULES` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_MODULES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_MODULES`()
BEGIN
	SELECT 	`modules`.`MODULE_ID`, 
		`modules`.`NAME` AS MODULE_NAME, 
		`modules`.`DESCRIPTION`
	FROM `modules`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_MODULE_FUNCTIONS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_MODULE_FUNCTIONS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_MODULE_FUNCTIONS`()
BEGIN
	SELECT 	`module_functions`.`MODULE_FUNCTION_ID`, 
		`module_functions`.`MODULE_ID`, `modules`.`NAME` AS MODULE_NAME,
		`module_functions`.`NAME` AS MODULE_FUNCTION_NAME, 
		`module_functions`.`CONTROLLER`, 
		`module_functions`.`DESCRIPTION`
	FROM `module_functions`
	INNER JOIN `modules` ON `modules`.`MODULE_ID` = `module_functions`.`MODULE_ID`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_OPERATIONAL_COSTS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_OPERATIONAL_COSTS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_OPERATIONAL_COSTS`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT 	`operational_costs`.`OP_COST_ID`,
			`operational_costs`.`USER_ID`, `users`.`NAME` AS USER_NAME,
			`operational_costs`.`DATE`, `operational_costs`.`NAME`, `operational_costs`.`TOTAL_COST`, `operational_costs`.`DESCRIPTION`,
			`operational_costs`.`IS_DISABLE`
		FROM `operational_costs`
		INNER JOIN `users` ON `users`.`USER_ID` = `operational_costs`.`USER_ID`
		WHERE `operational_costs`.`IS_DISABLE` = 0;
	    ELSE
		SELECT 	`operational_costs`.`OP_COST_ID`,
			`operational_costs`.`USER_ID`, `users`.`NAME` AS USER_NAME,
			`operational_costs`.`DATE`, `operational_costs`.`NAME`, `operational_costs`.`TOTAL_COST`, `operational_costs`.`DESCRIPTION`,
			`operational_costs`.`IS_DISABLE`
		FROM `operational_costs`
		INNER JOIN `users` ON `users`.`USER_ID` = `operational_costs`.`USER_ID`
		WHERE `operational_costs`.`IS_DISABLE` = 0
		AND CONCAT(`users`.`NAME`,' ',`operational_costs`.`DATE`,' ',`operational_costs`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT 	`operational_costs`.`OP_COST_ID`,
			`operational_costs`.`USER_ID`, `users`.`NAME` AS USER_NAME,
			`operational_costs`.`DATE`, `operational_costs`.`NAME`, `operational_costs`.`TOTAL_COST`, `operational_costs`.`DESCRIPTION`,
			`operational_costs`.`IS_DISABLE`
		FROM `operational_costs`
		INNER JOIN `users` ON `users`.`USER_ID` = `operational_costs`.`USER_ID`
		WHERE `operational_costs`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT 	`operational_costs`.`OP_COST_ID`,
			`operational_costs`.`USER_ID`, `users`.`NAME` AS USER_NAME,
			`operational_costs`.`DATE`, `operational_costs`.`NAME`, `operational_costs`.`TOTAL_COST`, `operational_costs`.`DESCRIPTION`,
			`operational_costs`.`IS_DISABLE`
		FROM `operational_costs`
		INNER JOIN `users` ON `users`.`USER_ID` = `operational_costs`.`USER_ID`
		WHERE `operational_costs`.`IS_DISABLE` = 0
		AND CONCAT(`users`.`NAME`,' ',`operational_costs`.`DATE`,' ',`operational_costs`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT 	`operational_costs`.`OP_COST_ID`,
			`operational_costs`.`USER_ID`, `users`.`NAME` AS USER_NAME,
			`operational_costs`.`DATE`, `operational_costs`.`NAME`, `operational_costs`.`TOTAL_COST`, `operational_costs`.`DESCRIPTION`,
			`operational_costs`.`IS_DISABLE`
		FROM `operational_costs`
		INNER JOIN `users` ON `users`.`USER_ID` = `operational_costs`.`USER_ID`
		WHERE `operational_costs`.`IS_DISABLE` = 0
		AND `operational_costs`.`OP_COST_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_OPERATIONAL_COST_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_OPERATIONAL_COST_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_OPERATIONAL_COST_DETAILS`(
	in op_id	int(10)
    )
BEGIN
	SELECT 	`operational_cost_details`.`OP_COST_DETAIL_ID`, `operational_cost_details`.`OP_COST_ID`, `operational_cost_details`.`NAME`, 
		`operational_cost_details`.`PRICE`, `operational_cost_details`.`AMOUNT`, `operational_cost_details`.`PRICE` * `operational_cost_details`.`AMOUNT` AS TOTAL
	FROM 	`operational_cost_details`
	where 	`operational_cost_details`.`OP_COST_ID` = op_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_ORDERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_ORDERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_ORDERS`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT 	`orders`.`ORDER_ID`, `orders`.`ORDER_NUMBER`,
			`orders`.`CASHIER_ID`, `users`.`NAME` AS USER_NAME,
			`orders`.`CUSTOMER_ID`, `customers`.`OWNER`, `customers`.`NAME` AS CUSTOMER_NAME, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`,
			`orders`.`DATE_ORDER`, `orders`.`DEADLINE`, `orders`.`DATE_RETRIEVAL`, 
			`orders`.`DOWN_PAYMENT`, `orders`.`TOTAL_PAYMENT`, `orders`.`PAY_STATUS`, `orders`.`ORDER_STATUS`, 
			`orders`.`DESCRIPTION`, `orders`.`IS_DISABLE`
		FROM `orders`
		left JOIN `users` ON `users`.`USER_ID` = `orders`.`CASHIER_ID`
		INNER JOIN `customers` ON `customers`.`CUSTOMER_ID` = `orders`.`CUSTOMER_ID`
		WHERE `orders`.`IS_DISABLE` = 0;
	    ELSE
		SELECT 	`orders`.`ORDER_ID`, `orders`.`ORDER_NUMBER`,
			`orders`.`CASHIER_ID`, `users`.`NAME` AS USER_NAME,
			`orders`.`CUSTOMER_ID`, `customers`.`OWNER`, `customers`.`NAME` AS CUSTOMER_NAME, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`,
			`orders`.`DATE_ORDER`, `orders`.`DEADLINE`, `orders`.`DATE_RETRIEVAL`, 
			`orders`.`DOWN_PAYMENT`, `orders`.`TOTAL_PAYMENT`, `orders`.`PAY_STATUS`, `orders`.`ORDER_STATUS`, 
			`orders`.`DESCRIPTION`, `orders`.`IS_DISABLE`
		FROM `orders`
		left JOIN `users` ON `users`.`USER_ID` = `orders`.`CASHIER_ID`
		INNER JOIN `customers` ON `customers`.`CUSTOMER_ID` = `orders`.`CUSTOMER_ID`
		WHERE `orders`.`IS_DISABLE` = 0
		and CONCAT(`orders`.`ORDER_NUMBER`,' ',`users`.`NAME`,' ',`customers`.`NAME`,' ',`orders`.`DATE_ORDER`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT 	`orders`.`ORDER_ID`, `orders`.`ORDER_NUMBER`,
			`orders`.`CASHIER_ID`, `users`.`NAME` AS USER_NAME,
			`orders`.`CUSTOMER_ID`, `customers`.`OWNER`, `customers`.`NAME` AS CUSTOMER_NAME, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`,
			`orders`.`DATE_ORDER`, `orders`.`DEADLINE`, `orders`.`DATE_RETRIEVAL`, 
			`orders`.`DOWN_PAYMENT`, `orders`.`TOTAL_PAYMENT`, `orders`.`PAY_STATUS`, `orders`.`ORDER_STATUS`, 
			`orders`.`DESCRIPTION`, `orders`.`IS_DISABLE`
		FROM `orders`
		left JOIN `users` ON `users`.`USER_ID` = `orders`.`CASHIER_ID`
		INNER JOIN `customers` ON `customers`.`CUSTOMER_ID` = `orders`.`CUSTOMER_ID`
		WHERE `orders`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT 	`orders`.`ORDER_ID`, `orders`.`ORDER_NUMBER`,
			`orders`.`CASHIER_ID`, `users`.`NAME` AS USER_NAME,
			`orders`.`CUSTOMER_ID`, `customers`.`OWNER`, `customers`.`NAME` AS CUSTOMER_NAME, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`,
			`orders`.`DATE_ORDER`, `orders`.`DEADLINE`, `orders`.`DATE_RETRIEVAL`, 
			`orders`.`DOWN_PAYMENT`, `orders`.`TOTAL_PAYMENT`, `orders`.`PAY_STATUS`, `orders`.`ORDER_STATUS`, 
			`orders`.`DESCRIPTION`, `orders`.`IS_DISABLE`
		FROM `orders`
		left JOIN `users` ON `users`.`USER_ID` = `orders`.`CASHIER_ID`
		INNER JOIN `customers` ON `customers`.`CUSTOMER_ID` = `orders`.`CUSTOMER_ID`
		WHERE `orders`.`IS_DISABLE` = 0
		AND CONCAT(`orders`.`ORDER_NUMBER`,' ',`users`.`NAME`,' ',`customers`.`NAME`,' ',`orders`.`DATE_ORDER`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT 	`orders`.`ORDER_ID`, `orders`.`ORDER_NUMBER`,
			`orders`.`CASHIER_ID`, `users`.`NAME` AS USER_NAME,
			`orders`.`CUSTOMER_ID`, `customers`.`OWNER`, `customers`.`NAME` AS CUSTOMER_NAME, `customers`.`ADDRESS`, `customers`.`PHONE`, `customers`.`EMAIL`,
			`orders`.`DATE_ORDER`, `orders`.`DEADLINE`, `orders`.`DATE_RETRIEVAL`, 
			`orders`.`DOWN_PAYMENT`, `orders`.`TOTAL_PAYMENT`, `orders`.`PAY_STATUS`, `orders`.`ORDER_STATUS`, 
			`orders`.`DESCRIPTION`, `orders`.`IS_DISABLE`
		FROM `orders`
		left JOIN `users` ON `users`.`USER_ID` = `orders`.`CASHIER_ID`
		INNER JOIN `customers` ON `customers`.`CUSTOMER_ID` = `orders`.`CUSTOMER_ID`
		WHERE `orders`.`IS_DISABLE` = 0
		AND `orders`.`ORDER_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_ORDER_DETAILS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_ORDER_DETAILS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_ORDER_DETAILS`(
	in ord_id	int(10)
    )
BEGIN
	select 	`order_details`.`ORDER_ID`, 
		`order_details`.`SERVICE_ID`, `services`.`NAME` as SERVICE_NAME,
		`order_details`.`PRICE`, `order_details`.`AMOUNT`, `order_details`.`PRICE` * `order_details`.`AMOUNT` as TOTAL
	from 	`order_details`
	inner join `services` on `services`.`SERVICE_ID` = `order_details`.`SERVICE_ID`
	where 	`order_details`.`ORDER_ID` = ord_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_SERVICES` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_SERVICES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_SERVICES`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT 	`services`.`SERVICE_ID`, 
			`services`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME` AS CATEGORY_NAME,
			`services`.`NAME`, `services`.`SIZE`, `services`.`UNIT`, `services`.`PRICE`, `services`.`DESCRIPTION`, `services`.`IS_DISABLE`
		FROM 	`services`
		INNER JOIN `service_categories` ON `service_categories`.`SERVICE_CATEGORY_ID` = `services`.`SERVICE_CATEGORY_ID`
		WHERE `services`.`IS_DISABLE` = 0;
	    ELSE
		SELECT 	`services`.`SERVICE_ID`, 
			`services`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME` AS CATEGORY_NAME,
			`services`.`NAME`, `services`.`SIZE`, `services`.`UNIT`, `services`.`PRICE`, `services`.`DESCRIPTION`, `services`.`IS_DISABLE`
		FROM 	`services`
		INNER JOIN `service_categories` ON `service_categories`.`SERVICE_CATEGORY_ID` = `services`.`SERVICE_CATEGORY_ID`
		WHERE `services`.`IS_DISABLE` = 0
		and CONCAT(`service_categories`.`NAME`,' ',`services`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT 	`services`.`SERVICE_ID`, 
			`services`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME` AS CATEGORY_NAME,
			`services`.`NAME`, `services`.`SIZE`, `services`.`UNIT`, `services`.`PRICE`, `services`.`DESCRIPTION`, `services`.`IS_DISABLE`
		FROM 	`services`
		INNER JOIN `service_categories` ON `service_categories`.`SERVICE_CATEGORY_ID` = `services`.`SERVICE_CATEGORY_ID`
		WHERE `services`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT 	`services`.`SERVICE_ID`, 
			`services`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME` AS CATEGORY_NAME,
			`services`.`NAME`, `services`.`SIZE`, `services`.`UNIT`, `services`.`PRICE`, `services`.`DESCRIPTION`, `services`.`IS_DISABLE`
		FROM 	`services`
		INNER JOIN `service_categories` ON `service_categories`.`SERVICE_CATEGORY_ID` = `services`.`SERVICE_CATEGORY_ID`
		WHERE `services`.`IS_DISABLE` = 0
		and CONCAT(`service_categories`.`NAME`,' ',`services`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT 	`services`.`SERVICE_ID`, 
			`services`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME` AS CATEGORY_NAME,
			`services`.`NAME`, `services`.`SIZE`, `services`.`UNIT`, `services`.`PRICE`, `services`.`DESCRIPTION`, `services`.`IS_DISABLE`
		FROM 	`services`
		INNER JOIN `service_categories` ON `service_categories`.`SERVICE_CATEGORY_ID` = `services`.`SERVICE_CATEGORY_ID`
		WHERE `services`.`IS_DISABLE` = 0
		and `services`.`SERVICE_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_SERVICE_CATEGORIES` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_SERVICE_CATEGORIES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_SERVICE_CATEGORIES`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT `service_categories`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME`, `service_categories`.`DESCRIPTION`, `service_categories`.`IS_DISABLE`
		FROM `service_categories`
		WHERE `service_categories`.`IS_DISABLE` = 0;
	    ELSE
		SELECT `service_categories`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME`, `service_categories`.`DESCRIPTION`, `service_categories`.`IS_DISABLE`
		FROM `service_categories`
		WHERE `service_categories`.`IS_DISABLE` = 0
		and CONCAT(`service_categories`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT `service_categories`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME`, `service_categories`.`DESCRIPTION`, `service_categories`.`IS_DISABLE`
		FROM `service_categories`
		WHERE `service_categories`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT `service_categories`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME`, `service_categories`.`DESCRIPTION`, `service_categories`.`IS_DISABLE`
		FROM `service_categories`
		WHERE `service_categories`.`IS_DISABLE` = 0
		AND CONCAT(`service_categories`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT `service_categories`.`SERVICE_CATEGORY_ID`, `service_categories`.`NAME`, `service_categories`.`DESCRIPTION`, `service_categories`.`IS_DISABLE`
		FROM `service_categories`
		WHERE `service_categories`.`IS_DISABLE` = 0
		and `service_categories`.`SERVICE_CATEGORY_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_SIGNIN` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_SIGNIN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_SIGNIN`(
	IN usr 		VARCHAR(100),
	IN pass 	VARCHAR(100)
    )
BEGIN
	SELECT 	`users`.`USER_ID`,
		`users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
		`users`.`NAME` AS USER_NAME,
		`users`.`EMAIL`
	FROM `users`
	INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
	WHERE `user_permissions`.`IS_DISABLE` = 0 
	  AND `users`.`IS_DISABLE` = 0
	  AND `users`.`USERNAME` = usr 
	  AND `users`.`PASSWORD` = MD5(pass);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_TREE_MENUS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_TREE_MENUS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_TREE_MENUS`(
	IN per_id 	INT(10)
    )
BEGIN
	SELECT	`user_permission_access`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
		`module_functions`.`MODULE_ID`, `modules`.`NAME` AS MODULE_NAME,
		`user_permission_access`.`MODULE_FUNCTION_ID`, `module_functions`.`NAME` AS MODULE_FUNCTION_NAME, `module_functions`.`CONTROLLER`,
		`user_permission_access`.`READ`, `user_permission_access`.`CREATE`, `user_permission_access`.`UPDATE`, `user_permission_access`.`DELETE`
	FROM `user_permission_access`
	INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `user_permission_access`.`PERMISSION_ID`
	INNER JOIN `module_functions` ON `module_functions`.`MODULE_FUNCTION_ID` = `user_permission_access`.`MODULE_FUNCTION_ID`
	INNER JOIN `modules` ON `modules`.`MODULE_ID` = `module_functions`.`MODULE_ID`
	WHERE `user_permissions`.`IS_DISABLE` = 0 AND `user_permission_access`.`PERMISSION_ID` = per_id
	ORDER BY `user_permission_access`.`PERMISSION_ID`, `module_functions`.`MODULE_ID`, `user_permission_access`.`MODULE_FUNCTION_ID`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_USERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_USERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_USERS`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT 	`users`.`USER_ID`, `users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
			`users`.`NAME` AS USER_NAME, `users`.`EMAIL`, `users`.`USERNAME`, `users`.`PASSWORD`, `users`.`IS_DISABLE`
		FROM `users`
		INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
		WHERE `users`.`IS_DISABLE` = 0;
	    ELSE
		SELECT 	`users`.`USER_ID`, `users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
			`users`.`NAME` AS USER_NAME, `users`.`EMAIL`, `users`.`USERNAME`, `users`.`PASSWORD`, `users`.`IS_DISABLE`
		FROM `users`
		INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
		WHERE `users`.`IS_DISABLE` = 0
		and CONCAT(`users`.`NAME`,' ',`user_permissions`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT 	`users`.`USER_ID`, `users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
			`users`.`NAME` AS USER_NAME, `users`.`EMAIL`, `users`.`USERNAME`, `users`.`PASSWORD`, `users`.`IS_DISABLE`
		FROM `users`
		INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
		WHERE `users`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT 	`users`.`USER_ID`, `users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
			`users`.`NAME` AS USER_NAME, `users`.`EMAIL`, `users`.`USERNAME`, `users`.`PASSWORD`, `users`.`IS_DISABLE`
		FROM `users`
		INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
		WHERE `users`.`IS_DISABLE` = 0
		and CONCAT(`users`.`NAME`,' ',`user_permissions`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT 	`users`.`USER_ID`, `users`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
			`users`.`NAME` AS USER_NAME, `users`.`EMAIL`, `users`.`USERNAME`, `users`.`PASSWORD`, `users`.`IS_DISABLE`
		FROM `users`
		INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `users`.`PERMISSION_ID`
		WHERE `users`.`IS_DISABLE` = 0
		and `users`.`USER_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_USER_ACCESS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_USER_ACCESS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_USER_ACCESS`(
	IN per_id 	INT(10),
	IN con		VARCHAR(100)
    )
BEGIN
	SELECT	`user_permission_access`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME,
		`module_functions`.`MODULE_ID`, `modules`.`NAME` AS MODULE_NAME,
		`user_permission_access`.`MODULE_FUNCTION_ID`, `module_functions`.`NAME` AS MODULE_FUNCTION_NAME, `module_functions`.`CONTROLLER`,
		`user_permission_access`.`READ`, `user_permission_access`.`CREATE`, `user_permission_access`.`UPDATE`, `user_permission_access`.`DELETE`
	FROM `user_permission_access`
	INNER JOIN `user_permissions` ON `user_permissions`.`PERMISSION_ID` = `user_permission_access`.`PERMISSION_ID`
	INNER JOIN `module_functions` ON `module_functions`.`MODULE_FUNCTION_ID` = `user_permission_access`.`MODULE_FUNCTION_ID`
	INNER JOIN `modules` ON `modules`.`MODULE_ID` = `module_functions`.`MODULE_ID`
	WHERE `user_permissions`.`IS_DISABLE` = 0 AND `user_permission_access`.`PERMISSION_ID` = per_id AND `module_functions`.`CONTROLLER` = con
	ORDER BY `user_permission_access`.`PERMISSION_ID`, `module_functions`.`MODULE_ID`, `user_permission_access`.`MODULE_FUNCTION_ID`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_USER_PERMISSIONS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_USER_PERMISSIONS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_USER_PERMISSIONS`(
        IN lim INT(3),
        IN off INT(3),
        IN search_id INT(10),
        IN search_by VARCHAR(50)
    )
BEGIN
	IF search_id = '' THEN
	  IF lim = '' THEN
	    IF search_by = '' THEN
		SELECT `user_permissions`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME, `user_permissions`.`DESCRIPTION`, `user_permissions`.`IS_DISABLE`
		FROM `user_permissions`
		where `user_permissions`.`IS_DISABLE` = 0;
	    ELSE
		SELECT `user_permissions`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME, `user_permissions`.`DESCRIPTION`, `user_permissions`.`IS_DISABLE`
		FROM `user_permissions`
		WHERE `user_permissions`.`IS_DISABLE` = 0
		and CONCAT(`user_permissions`.`NAME`) LIKE CONCAT('%',search_by,'%');
	    END IF;
	  ELSE
	    IF search_by = '' THEN
		SELECT `user_permissions`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME, `user_permissions`.`DESCRIPTION`, `user_permissions`.`IS_DISABLE`
		FROM `user_permissions`
		WHERE `user_permissions`.`IS_DISABLE` = 0
		LIMIT lim OFFSET off;
	    ELSE
		SELECT `user_permissions`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME, `user_permissions`.`DESCRIPTION`, `user_permissions`.`IS_DISABLE`
		FROM `user_permissions`
		WHERE `user_permissions`.`IS_DISABLE` = 0
		AND CONCAT(`user_permissions`.`NAME`) LIKE CONCAT('%',search_by,'%')
		LIMIT lim OFFSET off;
	    END IF;
	  END IF;
	ELSE
		SELECT `user_permissions`.`PERMISSION_ID`, `user_permissions`.`NAME` AS PERMISSION_NAME, `user_permissions`.`DESCRIPTION`, `user_permissions`.`IS_DISABLE`
		FROM `user_permissions`
		WHERE `user_permissions`.`IS_DISABLE` = 0
		and `user_permissions`.`PERMISSION_ID` = search_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sel_USER_PERMISSION_ACCESS` */

/*!50003 DROP PROCEDURE IF EXISTS  `sel_USER_PERMISSION_ACCESS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_USER_PERMISSION_ACCESS`(
	in per_id	int(10)
    )
BEGIN
	select 	`user_permission_access`.`PERMISSION_ID`, 
		`user_permission_access`.`MODULE_FUNCTION_ID`,
		`user_permission_access`.`READ`, 
		`user_permission_access`.`CREATE`, 
		`user_permission_access`.`UPDATE`, 
		`user_permission_access`.`DELETE`
	from 	`user_permission_access` 
	where 	`user_permission_access`.`PERMISSION_ID` = per_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_CHANGE_PASSWORD` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_CHANGE_PASSWORD` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_CHANGE_PASSWORD`(
	in usr_id	int(10),
	IN pass 	VARCHAR(100)
    )
BEGIN
	update 	`users`
	set 	`users`.`PASSWORD` = md5(pass)
	where 	`users`.`USER_ID` = usr_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_CUSTOMERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_CUSTOMERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_CUSTOMERS`(
	in cus_id 	int(10),
	IN type_id 	INT(10),
	IN usr_id	INT(10),
	IN ow 		VARCHAR(100),
	IN nm 		VARCHAR(100),
	IN ad 		VARCHAR(255),
	IN ph 		VARCHAR(20),
	IN em 		VARCHAR(100)
    )
BEGIN
	update 	`customers`
	set 	`customers`.`CUSTOMER_TYPE_ID` = type_id,
		`customers`.`USER_ID` = usr_id,
		`customers`.`OWNER` = ow,
		`customers`.`NAME` = nm,
		`customers`.`ADDRESS` = ad,
		`customers`.`PHONE` = ph,
		`customers`.`EMAIL` = em
	where 	`customers`.`CUSTOMER_ID` = cus_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_CUSTOMER_TYPES` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_CUSTOMER_TYPES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_CUSTOMER_TYPES`(
	in cus_id 	int(10),
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	update 	`customer_types`
	set 	`customer_types`.`NAME` = nm,
		`customer_types`.`DESCRIPTION` = des
	where 	`customer_types`.`CUSTOMER_TYPE_ID` = cus_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_OPERATIONAL_COSTS` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_OPERATIONAL_COSTS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_OPERATIONAL_COSTS`(
	in op_id 	int(10),
	IN usr 		INT(10),
	IN nm 		VARCHAR(100),
	IN tot 		DECIMAL(9,2),
	IN des 		VARCHAR(255)
    )
BEGIN
	update 	`operational_costs`
	set 	`operational_costs`.`USER_ID` = usr,
		`operational_costs`.`NAME` = nm,
		`operational_costs`.`TOTAL_COST` = tot,
		`operational_costs`.`DESCRIPTION` = des
	where 	`operational_costs`.`OP_COST_ID` = op_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_ORDERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_ORDERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_ORDERS`(
	in ord_id 		int(10),
	IN cas_id 		INT(10),
	IN cust_id 		INT(10),
	IN d_ret 		DATETIME,
	IN down_pay		DECIMAL(9,2),
	IN tot_pay		DECIMAL(9,2),
	IN p_status 		TINYINT(1),
	IN o_status 		TINYINT(1),
	IN des 			VARCHAR(255)
    )
BEGIN
	update 	`orders`
	set 	`orders`.`CASHIER_ID` = cas_id, 
		`orders`.`CUSTOMER_ID` = cust_id, 
		`orders`.`DATE_RETRIEVAL` = d_ret, 
		`orders`.`DOWN_PAYMENT` = down_pay,
		`orders`.`TOTAL_PAYMENT` = tot_pay, 
		`orders`.`PAY_STATUS` = p_status, 
		`orders`.`ORDER_STATUS` = o_status, 
		`orders`.`DESCRIPTION` = des
	where 	`orders`.`ORDER_ID` = ord_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_ORDER_RETRIEVAL` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_ORDER_RETRIEVAL` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_ORDER_RETRIEVAL`(
	in ord_id 		int(10),
	IN cas_id 		INT(10),
	IN p_status 		TINYINT(1),
	IN o_status 		TINYINT(1)
    )
BEGIN
	update 	`orders`
	set 	`orders`.`CASHIER_ID` = cas_id, 
		`orders`.`DATE_RETRIEVAL` = now(), 
		`orders`.`PAY_STATUS` = p_status, 
		`orders`.`ORDER_STATUS` = o_status
	where 	`orders`.`ORDER_ID` = ord_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_SERVICES` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_SERVICES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_SERVICES`(
	in ser_id 	int(10),
	IN cat_id	INT(10),
	IN nm 		VARCHAR(100),
	IN si 		VARCHAR(50),
	IN un 		VARCHAR(50),
	IN pri 		DECIMAL(9,2),
	IN des 		VARCHAR(255)
    )
BEGIN
	update 	`services`
	set 	`services`.`SERVICE_CATEGORY_ID` = cat_id,
		`services`.`NAME` = nm,
		`services`.`SIZE` = si,
		`services`.`UNIT` = un,
		`services`.`PRICE` = pri,
		`services`.`DESCRIPTION` = des
	where 	`services`.`SERVICE_ID` = ser_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_SERVICE_CATEGORIES` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_SERVICE_CATEGORIES` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_SERVICE_CATEGORIES`(
	in ser_id 	int(10),
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	update 	`service_categories`
	set 	`service_categories`.`NAME` = nm,
		`service_categories`.`DESCRIPTION` = des
	where 	`service_categories`.`SERVICE_CATEGORY_ID` = ser_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_USERS` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_USERS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_USERS`(
	in usr_id	int(10),
	IN per_id 	INT(10),
	IN nm 		VARCHAR(100),
	IN em 		VARCHAR(100),
	IN usr 		VARCHAR(100)
    )
BEGIN
	update 	`users`
	set 	`users`.`PERMISSION_ID` = per_id,
		`users`.`NAME` = nm,
		`users`.`EMAIL` = em,
		`users`.`USERNAME` = usr
	where 	`users`.`USER_ID` = usr_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `upd_USER_PERMISSIONS` */

/*!50003 DROP PROCEDURE IF EXISTS  `upd_USER_PERMISSIONS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upd_USER_PERMISSIONS`(
	in per_id 	int(10),
	IN nm 		VARCHAR(100),
	IN des 		VARCHAR(255)
    )
BEGIN
	update 	`user_permissions`
	set 	`user_permissions`.`NAME` = nm,
		`user_permissions`.`DESCRIPTION` = des
	where 	`user_permissions`.`PERMISSION_ID` = per_id;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
