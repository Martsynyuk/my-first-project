/*
SQLyog Community v12.09 (64 bit)
MySQL - 5.5.23 : Database - user
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`user` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `user`;

/*Table structure for table `information` */

DROP TABLE IF EXISTS `information`;

CREATE TABLE `information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(100) unsigned NOT NULL,
  `FirstName` varchar(128) DEFAULT NULL,
  `LastName` varchar(128) DEFAULT NULL,
  `Email` varchar(128) DEFAULT NULL,
  `Home` varchar(128) DEFAULT NULL,
  `Work` varchar(128) DEFAULT NULL,
  `Cell` varchar(128) DEFAULT NULL,
  `Adress1` varchar(128) DEFAULT NULL,
  `Adress2` varchar(128) DEFAULT NULL,
  `City` varchar(128) DEFAULT NULL,
  `State` varchar(128) DEFAULT NULL,
  `Zip` varchar(128) DEFAULT NULL,
  `Country` varchar(128) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Telephone` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;

/*Data for the table `information` */

insert  into `information`(`id`,`users_id`,`FirstName`,`LastName`,`Email`,`Home`,`Work`,`Cell`,`Adress1`,`Adress2`,`City`,`State`,`Zip`,`Country`,`BirthDate`,`Telephone`) values (165,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(166,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(125,101,'Terr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(153,51,'moto','','fghf@mu.ua','','','1446546','','','','','','','1918-04-04','1446546'),(120,101,'Terr','mass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(121,101,'Terr','mass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(123,101,'Terr','mass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(122,101,'Terr','mass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(71,54,'gfh','','','','','','','','','','','','1932-11-18',''),(167,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(133,51,'motor ','motorchik','fddf@dsfsdf.ua','','','45451','','','','','','','1918-03-05','45451'),(138,51,'motor ','motorchik','dsad@dfsfdsf.ua','','','45451','','','','','','','1918-03-05','45451'),(106,57,'xcvxcv','','','','','','','','','','','','1915-01-01',''),(132,51,'motorist','xzcxz','dasddg@fr.ua','','5451545','','','','','','','','1915-01-01','5451545'),(124,101,'Terr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(158,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(159,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(164,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(119,101,'Terr','mass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(162,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(160,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(161,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(134,51,'motor ','motorchik','dsghh@fr.ua','','','45451','','','','','','','1918-03-05','45451'),(135,51,'motor ','motorchik','lkj@ju.ua','','','45451','','','','','','','1918-03-05','45451'),(154,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(155,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(156,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45'),(157,51,'syslik','mtv','mtv@iy.ua','','15-23-45','','','','','','','','1918-03-04','15-23-45');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`login`,`password`) values (51,'lolo','9af37cfb8e1bc8b8efc46054f575c0b9');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
