/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : mvc

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2017-09-07 07:09:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mvc_admins
-- ----------------------------
DROP TABLE IF EXISTS `mvc_admins`;
CREATE TABLE `mvc_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `password_hash` varchar(32) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mvc_admins
-- ----------------------------

-- ----------------------------
-- Table structure for mvc_tasks
-- ----------------------------
DROP TABLE IF EXISTS `mvc_tasks`;
CREATE TABLE `mvc_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `hashString` varchar(32) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `mvc_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mvc_tasks
-- ----------------------------
INSERT INTO `mvc_tasks` VALUES ('1', 'some task to do', 'b09332e9e2b12826accadeb38ddd3ad0', 'image', '1', '0');
INSERT INTO `mvc_tasks` VALUES ('2', 'new task to do', 'd3b7cae0767505e4eaaa463c9640b9b6', 'image', '2', '1');
INSERT INTO `mvc_tasks` VALUES ('3', 'something to do', '4f868b5e84686560fcbbacf6df6b4a2f', 'image', '3', '0');
INSERT INTO `mvc_tasks` VALUES ('4', 'wewew', 'e012a61c6d1a4f875a3ca17df394be98', 'image', '4', '0');
INSERT INTO `mvc_tasks` VALUES ('5', '    wewew\r\n    ', '848659e20424f3421305247f91db595a', 'image', '4', '0');
INSERT INTO `mvc_tasks` VALUES ('6', 'i need to do my task i need to do my task i need to do my task ', 'e8ff34eddbb0b2c5795ddb0c0f423237', 'image', '5', '0');
INSERT INTO `mvc_tasks` VALUES ('7', 'kjksjdsjdjsjksa', '31e4f07fbb44ccd4cfdfe6dc230de518', 'f2a0d9ac2707a0be8af9f9ec7e30325d.gif', '2', '0');
INSERT INTO `mvc_tasks` VALUES ('8', 'fdkflkd;fk;sdf', '3c61a3f7f6be3c3793b54fdb68984f6d', 'ed90f7f5841740336de541fe04853637.gif', '6', '0');

-- ----------------------------
-- Table structure for mvc_users
-- ----------------------------
DROP TABLE IF EXISTS `mvc_users`;
CREATE TABLE `mvc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mvc_users
-- ----------------------------
INSERT INTO `mvc_users` VALUES ('1', 'name', 'name@mail.ru');
INSERT INTO `mvc_users` VALUES ('2', 'my name 2', 'emsi@mail.ru');
INSERT INTO `mvc_users` VALUES ('3', 'my name 2', 'maemail@mail.ri');
INSERT INTO `mvc_users` VALUES ('4', 'name', 'wewe@mail.ru');
INSERT INTO `mvc_users` VALUES ('5', 'my last name', 'mdsdil@mail.ru');
INSERT INTO `mvc_users` VALUES ('6', 'fdfjkdsjf', 'ffkjdfkdj@mail.ri');
