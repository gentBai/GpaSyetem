# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 115.126.112.38 (MySQL 5.5.28-log)
# Database: gpa
# Generation Time: 2014-05-03 18:17:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table gpa_academy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_academy`;

CREATE TABLE `gpa_academy` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(40) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_academy` WRITE;
/*!40000 ALTER TABLE `gpa_academy` DISABLE KEYS */;

INSERT INTO `gpa_academy` (`a_id`, `a_name`, `is_del`)
VALUES
	(1,'马克思主义学院',0),
	(2,'经济管理学院',0),
	(3,'外国语学院',0),
	(4,'风景园林与建筑学院、旅游与健康学院',0),
	(5,'林业与生物技术学院',0),
	(6,'法政学院',0),
	(7,'环境与资源学院',0),
	(8,'工程学院',0),
	(9,'农业与食品科学学院、动物科技学院（筹）',0),
	(10,'信息工程学院',0),
	(12,'艺术设计学院、人文·茶文化学院',0),
	(13,'集贤学院',0);

/*!40000 ALTER TABLE `gpa_academy` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_class
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_class`;

CREATE TABLE `gpa_class` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `cr_id` int(11) NOT NULL,
  `c_num` int(11) NOT NULL DEFAULT '0',
  `tc_id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `finish_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c_id`),
  KEY `start_time` (`start_time`),
  KEY `finish_time` (`finish_time`),
  KEY `start_time_2` (`start_time`,`finish_time`),
  KEY `cr_id` (`cr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_class` WRITE;
/*!40000 ALTER TABLE `gpa_class` DISABLE KEYS */;

INSERT INTO `gpa_class` (`c_id`, `cr_id`, `c_num`, `tc_id`, `start_time`, `finish_time`, `is_del`)
VALUES
	(12,1,9,2,1395244800,1403279999,0),
	(13,2,5,2,1394380800,1404143999,0);

/*!40000 ALTER TABLE `gpa_class` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_class_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_class_message`;

CREATE TABLE `gpa_class_message` (
  `cm_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cm_id`),
  KEY `c_id` (`c_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_class_message` WRITE;
/*!40000 ALTER TABLE `gpa_class_message` DISABLE KEYS */;

INSERT INTO `gpa_class_message` (`cm_id`, `c_id`, `s_id`, `t_id`, `score`, `is_del`)
VALUES
	(56,12,2,0,0,0),
	(57,12,3,0,0,0),
	(58,12,4,0,0,0),
	(59,12,9,0,0,0),
	(60,12,10,0,0,0),
	(61,12,11,0,0,0),
	(62,12,12,0,0,0),
	(63,12,13,0,0,0),
	(64,12,15,0,0,0),
	(65,13,8,0,0,0),
	(66,13,9,0,0,0),
	(67,13,10,0,0,0),
	(68,13,11,0,0,0),
	(69,13,12,0,0,0);

/*!40000 ALTER TABLE `gpa_class_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_course
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_course`;

CREATE TABLE `gpa_course` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cr_name` varchar(40) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT 'type',
  `a_id` int(11) NOT NULL COMMENT 'acadeny',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cr_id`),
  KEY `t_id` (`t_id`),
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_course` WRITE;
/*!40000 ALTER TABLE `gpa_course` DISABLE KEYS */;

INSERT INTO `gpa_course` (`cr_id`, `cr_name`, `t_id`, `a_id`, `is_del`)
VALUES
	(1,'高级语言程序设计',2,10,0),
	(2,'数据库程序设计',1,10,0);

/*!40000 ALTER TABLE `gpa_course` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_major
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_major`;

CREATE TABLE `gpa_major` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(40) NOT NULL,
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`),
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_major` WRITE;
/*!40000 ALTER TABLE `gpa_major` DISABLE KEYS */;

INSERT INTO `gpa_major` (`m_id`, `m_name`, `a_id`, `is_del`)
VALUES
	(1,'计算机科学与技术',10,0),
	(2,'信息管理与信息技术',10,0),
	(3,'电子信息工程',10,0),
	(4,'工业设计',8,0),
	(5,'土木工程',4,0),
	(6,'建筑学',4,0),
	(7,'林学',5,0),
	(8,'农学',9,0),
	(9,'食品科学与工程',9,0);

/*!40000 ALTER TABLE `gpa_major` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_message`;

CREATE TABLE `gpa_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_tc_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 st -> tc 2 tc -> admin',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `t_id` int(11) NOT NULL DEFAULT '0',
  `old_per` int(11) NOT NULL DEFAULT '0',
  `new_per` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_message` WRITE;
/*!40000 ALTER TABLE `gpa_message` DISABLE KEYS */;

INSERT INTO `gpa_message` (`msg_id`, `to_tc_id`, `type`, `c_id`, `t_id`, `old_per`, `new_per`, `time`, `is_del`)
VALUES
	(1,0,2,13,7,10,15,1399137949,0),
	(2,0,2,13,8,60,60,1399137949,0),
	(3,0,2,13,6,15,10,1399137949,0),
	(4,0,2,13,5,5,0,1399137949,0),
	(5,0,2,13,9,10,15,1399137950,0);

/*!40000 ALTER TABLE `gpa_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_sclass
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_sclass`;

CREATE TABLE `gpa_sclass` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_no` int(11) NOT NULL,
  `sc_num` int(11) NOT NULL DEFAULT '0',
  `m_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sc_id`),
  KEY `m_id` (`m_id`),
  KEY `tc_id` (`tc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_sclass` WRITE;
/*!40000 ALTER TABLE `gpa_sclass` DISABLE KEYS */;

INSERT INTO `gpa_sclass` (`sc_id`, `sc_no`, `sc_num`, `m_id`, `tc_id`, `is_del`)
VALUES
	(1,102,28,1,3,0);

/*!40000 ALTER TABLE `gpa_sclass` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_sclass_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_sclass_message`;

CREATE TABLE `gpa_sclass_message` (
  `scm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`scm_id`),
  KEY `sc_id` (`sc_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_sclass_message` WRITE;
/*!40000 ALTER TABLE `gpa_sclass_message` DISABLE KEYS */;

INSERT INTO `gpa_sclass_message` (`scm_id`, `sc_id`, `s_id`, `is_del`)
VALUES
	(1,1,1,0),
	(2,1,2,0),
	(3,1,3,0),
	(4,1,4,0),
	(5,1,5,0),
	(6,1,6,0),
	(7,1,7,0),
	(8,1,8,0),
	(9,1,9,0);

/*!40000 ALTER TABLE `gpa_sclass_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_score_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_score_message`;

CREATE TABLE `gpa_score_message` (
  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `sm_time` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `percent` float NOT NULL DEFAULT '0',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sm_id`),
  KEY `sm_time` (`sm_time`),
  KEY `t_id` (`t_id`),
  KEY `score` (`percent`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_score_message` WRITE;
/*!40000 ALTER TABLE `gpa_score_message` DISABLE KEYS */;

INSERT INTO `gpa_score_message` (`sm_id`, `c_id`, `sm_time`, `t_id`, `percent`, `is_del`)
VALUES
	(46,12,0,7,10,0),
	(47,12,0,8,60,0),
	(48,12,0,6,15,0),
	(49,12,0,5,5,0),
	(50,12,0,9,10,0),
	(51,13,0,7,10,0),
	(52,13,0,8,60,0),
	(53,13,0,6,15,0),
	(54,13,0,5,5,0),
	(55,13,0,9,10,0);

/*!40000 ALTER TABLE `gpa_score_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_signup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_signup`;

CREATE TABLE `gpa_signup` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`up_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_signup` WRITE;
/*!40000 ALTER TABLE `gpa_signup` DISABLE KEYS */;

INSERT INTO `gpa_signup` (`up_id`, `c_id`, `s_id`, `value`, `time`, `is_del`)
VALUES
	(1,12,2,1,1399125949,0),
	(2,12,3,-1,1399125949,0),
	(3,12,4,1,1399125949,0),
	(4,12,9,1,1399125949,0),
	(5,12,10,0,1399125949,0),
	(6,12,11,1,1399125949,0),
	(7,12,12,1,1399125949,0),
	(8,12,13,-1,1399125949,0),
	(9,12,15,1,1399125949,0);

/*!40000 ALTER TABLE `gpa_signup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_student`;

CREATE TABLE `gpa_student` (
  `s_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_user` char(15) NOT NULL DEFAULT '',
  `s_name` varchar(20) NOT NULL,
  `s_pwd` char(32) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT 'ÃÜÂë',
  `remember_date` char(8) DEFAULT NULL COMMENT 'ÉÏÒ»´Î¼Ç×¡ÃÜÂëµÄÊ±¼ä',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_user` (`s_user`),
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_student` WRITE;
/*!40000 ALTER TABLE `gpa_student` DISABLE KEYS */;

INSERT INTO `gpa_student` (`s_id`, `s_user`, `s_name`, `s_pwd`, `remember_date`, `sex`, `a_id`, `is_del`, `birthday`)
VALUES
	(1,'201005070322','屠吉平','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(2,'201005070324','徐玉辉','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(3,'201005070608','姚晓妹','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(4,'201005070615','夏腾炜','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(5,'201005070616','张经纬','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(6,'201005070618','王汉甲','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(7,'201005070619','陈杰','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(8,'201005070621','张力平','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(9,'201005070622','蒋建梁','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(10,'201005070626','刘思源','e10adc3949ba59abbe56e057f20f883e','20140306',0,10,0,'1992-10-04'),
	(11,'201005070628','周锋霆','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'0000-00-00'),
	(12,'2019234837','张三','e10adc3949ba59abbe56e057f20f883e',NULL,0,1,0,'1992-03-01'),
	(13,'2019234839','李四','e10adc3949ba59abbe56e057f20f883e',NULL,0,1,0,'1992-12-30'),
	(15,'201923483711','汪少','e10adc3949ba59abbe56e057f20f883e',NULL,0,10,0,'1992-08-10');

/*!40000 ALTER TABLE `gpa_student` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_teacher
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_teacher`;

CREATE TABLE `gpa_teacher` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_name` varchar(20) NOT NULL,
  `a_id` int(11) NOT NULL,
  `tc_user` char(15) NOT NULL,
  `tc_pwd` char(32) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT 'ÃÜÂë',
  `remember_date` char(8) DEFAULT NULL COMMENT 'ÉÏÒ»´Î¼Ç×¡ÃÜÂëµÄÊ±¼ä',
  `administrator` tinyint(1) NOT NULL DEFAULT '0',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tc_id`),
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_teacher` WRITE;
/*!40000 ALTER TABLE `gpa_teacher` DISABLE KEYS */;

INSERT INTO `gpa_teacher` (`tc_id`, `tc_name`, `a_id`, `tc_user`, `tc_pwd`, `remember_date`, `administrator`, `is_del`)
VALUES
	(1,'吴达胜',10,'11111111','e10adc3949ba59abbe56e057f20f883e','20140514',1,0),
	(2,'黄美丽',10,'11111112','e10adc3949ba59abbe56e057f20f883e','20140518',0,0),
	(3,'王守先',10,'11111113','e10adc3949ba59abbe56e057f20f883e',NULL,0,0);

/*!40000 ALTER TABLE `gpa_teacher` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gpa_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gpa_type`;

CREATE TABLE `gpa_type` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(20) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gpa_type` WRITE;
/*!40000 ALTER TABLE `gpa_type` DISABLE KEYS */;

INSERT INTO `gpa_type` (`t_id`, `t_name`, `is_del`)
VALUES
	(1,'必修',0),
	(2,'公选',0),
	(3,'专选',0),
	(4,'平时成绩',0),
	(5,'考勤成绩',0),
	(6,'实验成绩',0),
	(7,'期中成绩',0),
	(8,'期末成绩',0),
	(9,'作业成绩',0),
	(10,'',1);

/*!40000 ALTER TABLE `gpa_type` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
