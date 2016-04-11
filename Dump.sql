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

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `text` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

/*Data for the table `chat` */

insert  into `chat`(`id`,`user_name`,`text`,`date`) values (1,'lolo','fucking table','2015-04-11 00:00:00'),(2,'lolo','new text','2016-04-11 14:36:11'),(7,'lolo','new message','2016-04-11 15:09:36'),(97,'lolo','some text','2016-04-11 18:33:09'),(98,'lolo','the sam','2016-04-11 18:43:06'),(100,'lolo','the sam','2016-04-11 18:43:11'),(101,'lolik','wtf','2016-04-11 18:53:17'),(102,'lolo','Chat should be done with vanilla JavaScript (no jQuery or other frameworks like that)\r\n\r\nand work in all modern browsers (IE 9+, latest Chrome, Firefox, Safari).\r\n\r\nNote, that you can use simple AJAX calls to send/recieve data, it’s not required to use\r\n\r\nsockets, long polling or other more complex techniques that are usually used for chats. This is\r\n\r\njust a learning task, so lets keep it simple.\r\n\r\nServer side app for the chat could be very simple and written using any\r\n\r\nlanguage/framework, it doesn’t matter for this task.','2016-04-11 18:54:06'),(103,'lolo','message','2016-04-11 18:54:15');

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
) ENGINE=MyISAM AUTO_INCREMENT=361 DEFAULT CHARSET=utf8;

/*Data for the table `information` */

insert  into `information`(`id`,`users_id`,`FirstName`,`LastName`,`Email`,`Home`,`Work`,`Cell`,`Adress1`,`Adress2`,`City`,`State`,`Zip`,`Country`,`BirthDate`,`Telephone`) values (177,51,'Amerlin','Lmerry','fdsf@gmail.com','','12-15','','adr','adr','city','state','324324','count','1916-01-01','12-15'),(339,107,'Annit','Roit','fox@gmail.com','','356-356','','','','','','','','1930-08-15',''),(340,107,'Right','Ronald','ron@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(341,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(342,107,'Ann','Antity','an@gmail.com','15-15-157','356-356','','','','','','','','1937-01-01',''),(343,107,'Right','Ronald','ron@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(344,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(353,107,'Lex','Lissy','lex@gmail.com','','45-15-15','','','','','','','','1950-11-03',''),(346,107,'Right','Ronald','ron@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(347,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(348,107,'Ann','Antaty','an@gmail.com','','356-356-12','','','','','','','','1986-12-15','356-356-12'),(349,107,'Right','Ronald','ron@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(350,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(351,107,'Ann','Ante','an@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(352,107,'Right','Ronald','ron@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(358,107,'Tirex','Taffi','tsr@gmail.com','34-15-15648','','','','','','','','','1999-04-04',''),(359,107,'Rizz','Ret','r@gmail.com','','345-345-34545','','','','','','','','1999-01-12','345-345-34545'),(360,107,'Teffi','Fox','fox@gamil.com','','','16-26-26','','','','','','','1985-12-23','16-26-26'),(242,51,'Amerry','mire','merry@gmail.com','','12-23-85','','Home','Home','Cite','statte','4543545','count','1916-01-01','12-23-85'),(246,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(248,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(320,51,'amatorr','amer','dser@gmail.com','32432','234','234','adr','Add','Cite','state','43324','count','1916-01-01','234'),(264,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(265,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(266,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(276,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(277,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(278,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(279,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(280,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(281,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(282,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(283,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(284,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(285,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(286,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(287,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(288,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(289,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(290,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(291,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(292,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(293,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(294,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(295,51,'merry','','merry@gmail.com','','12-23-85','','','','','','','','1918-03-05','12-23-85'),(338,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(337,107,'Ann','Anit','anny@gmail.com','','356-356','','','','','','','','1989-04-14','356-356'),(336,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(335,107,'Ann','Ante','an@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(334,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(333,107,'Ann','Ante','an@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(332,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(331,107,'Ann','Ante','an@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(330,107,'Anny','Anitte','ann@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(329,107,'Ann','Ante','an@gmail.com',NULL,'356-356',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1937-01-01','356-356'),(306,107,'Ann','Fox','ann@gmail.com','','356-356','','','','','','','','1925-05-05','');

/*Table structure for table `task` */

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `age` int(2) NOT NULL,
  `Fullname` varchar(30) NOT NULL,
  `skills` enum('long','short','toll','stupid') DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `task` */

insert  into `task`(`id`,`age`,`Fullname`,`skills`,`price`,`date_creation`) values (26,1942290432,'Hphmsuvdloivlu','short','534.78','1978-08-25'),(27,877593994,'Vjrhlmwtqosuvhluqioscaggzs','short','224.68','1993-01-25'),(28,58,'Vewb','long','94.52','1996-11-23');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`login`,`password`) values (107,'rex','$2y$13$CgdqOgyDdE.krfkDGHpKaug3Ta8znc6SvdiWkB9wapunioIX8TYoK'),(108,'lolik','9af37cfb8e1bc8b8efc46054f575c0b9'),(51,'lolo','9af37cfb8e1bc8b8efc46054f575c0b9');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
