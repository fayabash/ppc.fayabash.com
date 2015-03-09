# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.33)
# Database: fayabash_ppc
# Generation Time: 2015-03-09 07:52:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(45) NOT NULL,
  `subtype` varchar(45) NOT NULL,
  `size` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `embed` text,
  `description` text,
  `copyright` varchar(255) DEFAULT NULL,
  `metadata` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table attachments_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachments_posts`;

CREATE TABLE `attachments_posts` (
  `attachment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `order` int(11) DEFAULT '0',
  `id` int(11) DEFAULT '0',
  PRIMARY KEY (`attachment_id`,`post_id`),
  KEY `fk_attachments_has_posts_posts1_idx` (`post_id`),
  KEY `fk_attachments_has_posts_attachments1_idx` (`attachment_id`),
  CONSTRAINT `fk_attachments_has_posts_attachments1` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table categories_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories_posts`;

CREATE TABLE `categories_posts` (
  `category_id` int(11) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  PRIMARY KEY (`category_id`,`post_id`),
  KEY `fk_categories_has_posts_posts1_idx` (`post_id`),
  KEY `fk_categories_has_posts_categories1_idx` (`category_id`),
  CONSTRAINT `fk_categories_has_posts_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_categories_has_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table i18n
# ------------------------------------------------------------

DROP TABLE IF EXISTS `i18n`;

CREATE TABLE `i18n` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` bigint(20) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `foreign_key` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pitches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pitches`;

CREATE TABLE `pitches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `max_user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pitches` WRITE;
/*!40000 ALTER TABLE `pitches` DISABLE KEYS */;

INSERT INTO `pitches` (`id`, `title`, `description`, `start`, `end`, `max_user`)
VALUES
	(2,'Pitch A','<p>simple pitch</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(3,'Pitch B','<p>simple pitch</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(4,'Pitch C','<p>simple pitch</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(5,'Pitch D','<p>Tournament</p>','2015-03-11 17:00:00','2015-03-11 20:30:00',16),
	(6,'Pitch A','<p>Text &agrave; mettre</p>','2015-03-11 18:00:00','2015-03-11 18:30:00',1);

/*!40000 ALTER TABLE `pitches` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pitches_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pitches_users`;

CREATE TABLE `pitches_users` (
  `pitch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`pitch_id`,`user_id`),
  KEY `fk_pitches_has_users_users1_idx` (`user_id`),
  KEY `fk_pitches_has_users_pitches1_idx` (`pitch_id`),
  CONSTRAINT `fk_pitches_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_pitches_has_users_pitches1` FOREIGN KEY (`pitch_id`) REFERENCES `pitches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pitches_users` WRITE;
/*!40000 ALTER TABLE `pitches_users` DISABLE KEYS */;

INSERT INTO `pitches_users` (`pitch_id`, `user_id`)
VALUES
	(6,1);

/*!40000 ALTER TABLE `pitches_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `midified` datetime NOT NULL,
  `header` text,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`)
VALUES
	(1,'admin'),
	(2,'player');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `username` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `score`, `username`)
VALUES
	(1,'antoine@3xw.ch','f95b3b8ebe0e5e0d19d6b8c4b1740755bbf664a8',1,0,'wawa'),
	(2,'bautista@fayabash.com','f95b3b8ebe0e5e0d19d6b8c4b1740755bbf664a8',1,0,'minim');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
