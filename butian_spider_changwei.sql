/*
Navicat MySQL Data Transfer

Source Server         : 昌维
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : butian-spider

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-01-20 15:56:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for butian_spider_changwei
-- ----------------------------
DROP TABLE IF EXISTS `butian_spider_changwei`;
CREATE TABLE `butian_spider_changwei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `href` varchar(255) DEFAULT NULL,
  `QTVA` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `addtime` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
