-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-02-26 10:44:50
-- 服务器版本： 5.6.11
-- PHP Version: 5.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gpa`
--
CREATE DATABASE IF NOT EXISTS `gpa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gpa`;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_academy`
--

DROP TABLE IF EXISTS `gpa_academy`;
CREATE TABLE IF NOT EXISTS `gpa_academy` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(40) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_class`
--

DROP TABLE IF EXISTS `gpa_class`;
CREATE TABLE IF NOT EXISTS `gpa_class` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(40) NOT NULL,
  `c_num` int(11) NOT NULL DEFAULT '0',
  `tc_id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `finish_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_class_message`
--

DROP TABLE IF EXISTS `gpa_class_message`;
CREATE TABLE IF NOT EXISTS `gpa_class_message` (
  `cm_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `score` float DEFAULT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_course`
--

DROP TABLE IF EXISTS `gpa_course`;
CREATE TABLE IF NOT EXISTS `gpa_course` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cr_name` varchar(40) NOT NULL,
  `t_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_major`
--

DROP TABLE IF EXISTS `gpa_major`;
CREATE TABLE IF NOT EXISTS `gpa_major` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(40) NOT NULL,
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_sclass`
--

DROP TABLE IF EXISTS `gpa_sclass`;
CREATE TABLE IF NOT EXISTS `gpa_sclass` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` char(4) NOT NULL,
  `sc_num` int(11) NOT NULL DEFAULT '0',
  `m_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_sclass_message`
--

DROP TABLE IF EXISTS `gpa_sclass_message`;
CREATE TABLE IF NOT EXISTS `gpa_sclass_message` (
  `scm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_id` int(11) NOT NULL,
  `s_id` char(15) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`scm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_score_message`
--

DROP TABLE IF EXISTS `gpa_score_message`;
CREATE TABLE IF NOT EXISTS `gpa_score_message` (
  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_time` int(11) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `t_id` int(11) NOT NULL,
  `score` float NOT NULL DEFAULT '0',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gpa_student`
--

DROP TABLE IF EXISTS `gpa_student`;
CREATE TABLE IF NOT EXISTS `gpa_student` (
  `s_id` char(15) NOT NULL,
  `s_name` varchar(20) NOT NULL,
  `s_pwd` char(32) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT '密码',
  `remember_date` char(8) DEFAULT NULL COMMENT '上一次记住密码的时间',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gpa_student`
--

INSERT INTO `gpa_student` (`s_id`, `s_name`, `s_pwd`, `remember_date`, `sex`, `a_id`, `is_del`, `birthday`) VALUES
('201005070626', '刘凌枫', 'e10adc3949ba59abbe56e057f20f883e', '20140306', 0, 1, 0, '1992-10-04');

-- --------------------------------------------------------

--
-- 表的结构 `gpa_teacher`
--

DROP TABLE IF EXISTS `gpa_teacher`;
CREATE TABLE IF NOT EXISTS `gpa_teacher` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_name` varchar(20) NOT NULL,
  `tc_user` char(15) NOT NULL,
  `tc_pwd` char(32) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT '密码',
  `remember_date` char(8) DEFAULT NULL COMMENT '上一次记住密码的时间',
  `administrator` tinyint(1) NOT NULL DEFAULT '0',
  `a_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `gpa_teacher`
--

INSERT INTO `gpa_teacher` (`tc_id`, `tc_name`, `tc_user`, `tc_pwd`, `remember_date`, `administrator`, `a_id`, `is_del`) VALUES
(1, '吴达胜', '11111111', 'e10adc3949ba59abbe56e057f20f883e', '20140306', 1, 10, 0),
(2, '黄美丽', '11111112', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `gpa_type`
--

DROP TABLE IF EXISTS `gpa_type`;
CREATE TABLE IF NOT EXISTS `gpa_type` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(20) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
