# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: web02.swisscenter.com (MySQL 5.5.40-36.1-log)
# Database: fayabash_ppc
# Generation Time: 2015-03-11 10:20:29 +0000
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
	(1,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(2,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(3,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:00:00','2015-03-11 17:30:00',1),
	(4,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:30:00','2015-03-11 18:00:00',1),
	(5,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:30:00','2015-03-11 18:00:00',1),
	(6,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 17:30:00','2015-03-11 18:00:00',1),
	(7,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:00:00','2015-03-11 18:30:00',1),
	(8,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:00:00','2015-03-11 18:30:00',1),
	(9,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:00:00','2015-03-11 18:30:00',1),
	(10,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:30:00','2015-03-11 19:00:00',1),
	(11,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:30:00','2015-03-11 19:00:00',1),
	(12,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 18:30:00','2015-03-11 19:00:00',1),
	(13,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:00:00','2015-03-11 19:30:00',1),
	(14,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:00:00','2015-03-11 19:30:00',1),
	(15,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:00:00','2015-03-11 19:30:00',1),
	(16,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:30:00','2015-03-11 20:00:00',1),
	(17,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:30:00','2015-03-11 20:00:00',1),
	(18,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 19:30:00','2015-03-11 20:00:00',1),
	(19,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:00:00','2015-03-11 20:30:00',1),
	(20,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:00:00','2015-03-11 20:30:00',1),
	(21,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:00:00','2015-03-11 20:30:00',1),
	(22,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:30:00','2015-03-11 21:00:00',1),
	(23,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:30:00','2015-03-11 21:00:00',1),
	(24,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 20:30:00','2015-03-11 21:00:00',1),
	(25,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:00:00','2015-03-11 21:30:00',1),
	(26,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:00:00','2015-03-11 21:30:00',1),
	(27,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:00:00','2015-03-11 21:30:00',1),
	(28,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:30:00','2015-03-11 22:00:00',1),
	(29,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:30:00','2015-03-11 22:00:00',1),
	(30,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 21:30:00','2015-03-11 22:00:00',1),
	(31,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:00:00','2015-03-11 22:30:00',1),
	(32,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:00:00','2015-03-11 22:30:00',1),
	(33,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:00:00','2015-03-11 22:30:00',1),
	(34,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:30:00','2015-03-11 23:00:00',1),
	(35,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:30:00','2015-03-11 23:00:00',1),
	(36,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 22:30:00','2015-03-11 23:00:00',1),
	(37,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:00:00','2015-03-11 23:30:00',1),
	(38,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:00:00','2015-03-11 23:30:00',1),
	(39,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:00:00','2015-03-11 23:30:00',1),
	(40,'Table A','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:30:00','2015-03-12 00:00:00',1),
	(41,'Table B','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:30:00','2015-03-12 00:00:00',1),
	(42,'Table C','<p>Sessions de 30 minutes par r&eacute;servations, possibilit&eacute; de r&eacute;server 2 sessions par soir &agrave; conditions que les sessions ne se suivent pas.&nbsp;</p>','2015-03-11 23:30:00','2015-03-12 00:00:00',1),
	(43,'Table D','<p class=\"p1\"><em>Deux tournois sont organiser par soir le premier se d&eacute;roule de 17h30 &agrave; 20h30 et le deuxi&egrave;me de 20h30 &agrave; 23h30. Possibilit&eacute; de participer aux 2 tournois.</em></p>','2015-03-11 17:30:00','2015-03-10 20:30:00',16),
	(44,'Table D','<p class=\"p1\"><em>Deux tournois sont organiser par soir le premier se d&eacute;roule de 17h30 &agrave; 20h30 et le deuxi&egrave;me de 20h30 &agrave; 23h30. Possibilit&eacute; de participer aux 2 tournois.</em></p>','2015-03-11 20:30:00','2015-03-11 23:30:00',16);

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
  CONSTRAINT `fk_pitches_has_users_pitches1` FOREIGN KEY (`pitch_id`) REFERENCES `pitches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pitches_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pitches_users` WRITE;
/*!40000 ALTER TABLE `pitches_users` DISABLE KEYS */;

INSERT INTO `pitches_users` (`pitch_id`, `user_id`)
VALUES
	(11,6),
	(17,6),
	(25,7),
	(30,8),
	(44,8),
	(4,9),
	(26,10),
	(31,10),
	(27,11),
	(10,12),
	(16,13),
	(22,13),
	(19,14),
	(18,15),
	(21,16),
	(13,17),
	(28,18),
	(32,19),
	(29,20),
	(33,21),
	(20,23),
	(23,24),
	(34,25),
	(37,26),
	(35,27),
	(38,28),
	(14,29),
	(24,29),
	(44,30),
	(44,31);

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
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `score`, `username`, `firstname`, `lastname`, `mobile`)
VALUES
	(1,'antoine@3xw.ch','f95b3b8ebe0e5e0d19d6b8c4b1740755bbf664a8',1,0,'wawa',NULL,NULL,NULL),
	(2,'bautista@fayabash.com','f95b3b8ebe0e5e0d19d6b8c4b1740755bbf664a8',1,0,'minim',NULL,NULL,NULL),
	(3,'antoine.wallef@gmail.com','f95b3b8ebe0e5e0d19d6b8c4b1740755bbf664a8',2,0,'wawa2',NULL,NULL,NULL),
	(4,'valentin.bourquard@gmail.com','9331a371b93554f454283326a8bb947811911ea9',2,0,'vtb92',NULL,NULL,NULL),
	(5,'vsalphati@gmail.com','ee182e52667d54405d00548f2537bdb4a42b3add',2,0,'vic',NULL,NULL,NULL),
	(6,'marjorie.perretten@hotmail.ch','8fbce373573777b2873751d89721758a11e82a41',2,0,'Marjo',NULL,NULL,NULL),
	(7,'hollensteinleticia@gmail.com','308147de9d11a17a1f18af8adbf9111626590538',2,0,'LHO','Leticia','Hollenstein','+41 79 460 06 16'),
	(8,'jaqimages@bluewin.ch','d90c9c8df211e8f0850e83a59404d182073c7368',2,0,'Sapin','Pascal','Jaquet','0774813607'),
	(9,'g2rald@gmail.com','b342789808aeb410fbf37d8c6ad7df78496a28bf',2,0,'GMT','Gérald','Tribune','078 896 0908'),
	(10,'dominique@bernet.es','185284467e636d1849850044aff497150f11c803',2,0,'dom','dominique','Bernet','0766794490'),
	(11,'ema.bolomey@gmail.com','fa24947e38bd82a1513e7ecc17f5d3f38c09c5c4',2,0,'emabo','Ema','Bolomey','0765240928'),
	(12,'soundyc@gmail.com','b5d09a50e64f77e07ead03e25b6950df7fe9f446',2,0,'Sandy','Sandy','Caron','+41796411647'),
	(13,'tgrandjean85@gmail.com','91eda57e52f1be859ff8281a0153c24f5902ff79',2,0,'Wolf','Tatiana ','Grandjean ','+41786841110'),
	(14,'chetrit.sophie@hotmail.fr','346e6fce4bbd1fd9a402ac65ed67cd215e91c4ee',2,0,'soso','sophie','chetrit','0033695893710'),
	(15,'dundee12@hotmail.com','72286729facb458c510ac8e9cf733e8a097fa483',2,0,'Vince','Vincent','Zufferey','0793590519'),
	(16,'gunners1052@gmail.com','72286729facb458c510ac8e9cf733e8a097fa483',2,0,'Giom','Guillaume','Laville','0788354645'),
	(17,'valentin.bourquard@ehl.ch','abbe8d0318626e573633aa6c68a59aaf30650aec',2,0,'vtb','Valentin','Bourquard','+41788415378'),
	(18,'debrakestek@gmail.com','fb88f92a99025ff9e7e54af820bc4f244707793d',2,0,'debra','Debra','Kestek','+41792465909'),
	(19,'charlotte_bunter@hotmail.com','ac989db9222eeb1d44f802df4df3ddf62b15e28b',2,0,'cha','charlotte','Bunter','+41797282373'),
	(20,'alexandre.michel.lilla@gmail.com','9a5058252e639ba8dd97241432b1542e76cfee40',2,0,'alexl','Alexandre','Lilla','+41797201842'),
	(21,'harley.vanswaay@gmail.com','c2199a9cdf82fdf8db0d1aa060f0fb65a066b9f0',2,0,'hvs','harley','van swaay','+41 79 391 90 65'),
	(22,'noe.bory@gmail.com','5588a7697cd32d17394a4c59111ecf59647631e2',2,0,'ZIZIR','Noé','Bory','0787484420'),
	(23,'tissotrv@gmail.com','54950843eed2aeb959b345bf6792ef84dfa31e1b',2,0,'Willy','Hervé','Tissot','+41 79 512 75 17'),
	(24,'greg@big-game.ch','d9bd939c85eed298e421fd17765d0a92132b05ad',2,0,'greg','Grégoire','Jeanmonod','+41766151753'),
	(25,'f.frigeriobonvicino@hotmail.fr','67751712e75175cddea8b25d438c6a3262f833ff',2,0,'chicc','Francesca ','Frigerio ','0791386712'),
	(26,'bianca.decarvalho@ehl.ch','6bfe03f753d6f151a6b0be653f478fe8703f1999',2,0,'babyg','Bianca','de Carvalho','+41766834304'),
	(27,'costanep@gmail.com','204cb7bb42d1636d2cee6d132e9f65b20bfc1f93',2,0,'tcs','thiago','costa','+41764499208'),
	(28,'t-cs@hotmail.com','e5b815d383e5dedb7326c705677d9fb3f7625125',2,0,'Lotte','Lotte','Doornweerd','0797808208'),
	(29,'matthieubouchain@gmail.com','6fd8e5d9ad3a13c65b1449656d6c5f5f444ad133',2,0,'matth','Matthieu','bouchain','0033631602327'),
	(30,'anthony.ahlgren@gmail.com','ad15dc6c1b4a800bed69c8929ac167c5fea477a4',2,0,'Antho','Anthony ','Ahlgren','+41 79 702 98 27'),
	(31,'cafedesartisans@hotmail.ch','8bfd5ae3a20b75dfa246ca6b817c38a1db9e05ab',2,0,'amaya','Amaya','Rodriguez','+41 78 737 31 88');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
