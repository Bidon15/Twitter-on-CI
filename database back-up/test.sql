-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.24-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-06-23 17:44:11
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table test.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `activation_key` varchar(50) DEFAULT NULL,
  `activated` int(50) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- Dumping data for table test.members: ~5 rows (approximately)
DELETE FROM `members`;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `first_name`, `last_name`, `username`, `password`, `email_address`, `activation_key`, `activated`, `image`) VALUES
	(53, 'masha', 'petrova', 'mashaPET', '81dc9bdb52d04dc20036dbd8313ed055', 'masha@petrova.com', NULL, 1339604190, NULL),
	(57, 'Sasha', 'Karluchenko', 'snownoob15', '827ccb0eea8a706c4c34a16891f84e7b', 'snownoob@test.com', NULL, 1339604190, 'd384ed5fc826a67834b61c475891b120.jpg'),
	(78, 'Yuri', 'Servatko', 'Seadog_CH', '827ccb0eea8a706c4c34a16891f84e7b', 'seadogch@gmail.com', NULL, 1339771272, NULL),
	(80, 'Nhu Viet', 'Nguyen', 'vit_tra', '81dc9bdb52d04dc20036dbd8313ed055', 'vit_tra@yahoo.com', NULL, 1340200900, NULL),
	(81, 'Marry', 'Doe', 'marrydoe', '81dc9bdb52d04dc20036dbd8313ed055', 'marry@doe.com', NULL, 1340201230, NULL),
	(82, 'Dinna', 'Doe', 'dinnadoe', '81dc9bdb52d04dc20036dbd8313ed055', 'dinna@doe.com', 'acb2e660cedba252e6c4669a29bc4a1f', 0, NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


-- Dumping structure for table test.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL DEFAULT '0',
  `message` varchar(300) NOT NULL,
  `created` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table test.messages: ~8 rows (approximately)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `user_id`, `message`, `created`) VALUES
	(3, 78, 'bla bla bal', 1340023168),
	(4, 78, 'asdadadasd', 1340023206),
	(5, 78, 'adasdasdasd', 1340023208),
	(8, 57, 'This is my first post again, because I\'ve written the code wrong :D', 1340098159),
	(10, 53, 'lolo', 1340104010),
	(11, 78, 'Oh my god, I did it!', 1340180375),
	(12, 53, 'Omg\r\n', 1340190297),
	(13, 80, 'WhaT?!\r\n', 1340201089);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table test.relationships
DROP TABLE IF EXISTS `relationships`;
CREATE TABLE IF NOT EXISTS `relationships` (
  `user_from_id` int(10) NOT NULL,
  `user_to_id` int(10) NOT NULL,
  KEY `user_from_id` (`user_from_id`),
  KEY `user_to_id` (`user_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table test.relationships: ~5 rows (approximately)
DELETE FROM `relationships`;
/*!40000 ALTER TABLE `relationships` DISABLE KEYS */;
INSERT INTO `relationships` (`user_from_id`, `user_to_id`) VALUES
	(57, 8),
	(57, 78),
	(53, 78),
	(57, 53),
	(80, 78);
/*!40000 ALTER TABLE `relationships` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
