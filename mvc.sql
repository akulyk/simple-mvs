/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : mvc

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2017-09-07 21:12:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mvc_admins
-- ----------------------------
DROP TABLE IF EXISTS `mvc_admins`;
CREATE TABLE `mvc_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `password_hash` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mvc_admins
-- ----------------------------
INSERT INTO `mvc_admins` VALUES ('1', 'admin', '$2y$10$fugAcJc9BymRJnDe8kL7OeYwht3JxDQWroTAJqd8Lrq.7LyNcvtd.', null);

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
INSERT INTO `mvc_tasks` VALUES ('1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'b09332e9e2b12826accadeb38ddd3ad0', 'image', '1', '0');
INSERT INTO `mvc_tasks` VALUES ('2', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'd3b7cae0767505e4eaaa463c9640b9b6', 'image', '2', '1');
INSERT INTO `mvc_tasks` VALUES ('3', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '4f868b5e84686560fcbbacf6df6b4a2f', 'image', '3', '1');
INSERT INTO `mvc_tasks` VALUES ('4', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'e012a61c6d1a4f875a3ca17df394be98', 'image', '4', '0');
INSERT INTO `mvc_tasks` VALUES ('5', '    wewewLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, leo ut ultricies laoreet, diam nisi vestibulum tortor, ac posuere dolor metus vel risus. Fusce consequat ipsum ut orci interdum, dictum dignissim orci volutpat. Phasellus viverra nisi a consectetur fermentum. Ut vitae auctor lorem. Aenean a hendrerit massa. Ut condimentum dictum iaculis. Aliquam erat volutpat. Sed commodo lectus in est fermentum faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac ipsum rhoncus, cursus augue id, tempus risus. Aliquam a nulla magna. Donec sollicitudin commodo purus a elementum. Ut id ante vitae lectus ullamcorper lobortis. Aliquam finibus risus eget malesuada suscipit. Donec ac metus commodo, scelerisque mi sed, egestas lorem.', '848659e20424f3421305247f91db595a', 'image', '4', '0');
INSERT INTO `mvc_tasks` VALUES ('6', 'Suspendisse rutrum urna eu porttitor dapibus. Mauris id pulvinar purus, ac semper massa. Aliquam ullamcorper augue arcu, vel dignissim velit imperdiet ac. Integer malesuada ipsum molestie dolor consequat, ac lacinia neque sollicitudin. Nam non elementum nisi, id cursus sapien. Donec consectetur augue in turpis porta, sit amet faucibus massa auctor. Quisque varius quam ac elit finibus eleifend. Nullam imperdiet neque luctus, malesuada nunc eget, fringilla enim. Sed semper sit amet ligula a luctus. In sed lacus sapien. Donec efficitur lectus nisl, quis dictum metus faucibus ut. Proin mollis augue nec tristique euismod. Sed tincidunt sem eu orci aliquam pharetra. Donec fermentum, orci a faucibus consectetur, massa purus mattis eros, id hendrerit sem ante in velit. Etiam varius consectetur libero et fringilla. Praesent rutrum, tortor ac vehicula pretium, mi purus venenatis magna, a finibus mauris odio in nibh. ', 'e8ff34eddbb0b2c5795ddb0c0f423237', 'image', '5', '0');
INSERT INTO `mvc_tasks` VALUES ('7', 'Mauris et rutrum neque, a cursus eros. Aliquam sapien nibh, eleifend vel euismod eget, cursus ut quam. Proin lobortis tincidunt rutrum. Donec semper justo justo, in vulputate libero condimentum nec. Mauris eu vestibulum mi, a finibus odio. Aliquam semper mi massa, eget ullamcorper leo ornare congue. Praesent odio sapien, egestas quis sem ac, ultrices auctor felis. Nam aliquam sapien id magna pharetra commodo. Suspendisse nec viverra nunc. Aliquam eu turpis eget neque iaculis finibus sit amet ut ligula. Nullam dapibus lacinia augue, imperdiet bibendum orci tempor id. Sed dictum finibus dolor quis scelerisque.', '31e4f07fbb44ccd4cfdfe6dc230de518', 'f2a0d9ac2707a0be8af9f9ec7e30325d.gif', '2', '0');
INSERT INTO `mvc_tasks` VALUES ('8', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent sed ultricies mi. Vivamus accumsan auctor fringilla. Proin varius eget purus eu congue. Nunc non velit vel nulla convallis vestibulum ut in massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In turpis ligula, maximus eget arcu et, dignissim accumsan turpis.', '3c61a3f7f6be3c3793b54fdb68984f6d', 'ed90f7f5841740336de541fe04853637.gif', '6', '0');

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
INSERT INTO `mvc_users` VALUES ('1', 'name1', 'name1@mail.ru');
INSERT INTO `mvc_users` VALUES ('2', 'name2', 'name2@mail.ru');
INSERT INTO `mvc_users` VALUES ('3', 'name3', 'name3@mail.ru');
INSERT INTO `mvc_users` VALUES ('4', 'name4', 'name4@mail.ru');
INSERT INTO `mvc_users` VALUES ('5', 'name5', 'name5@mail.ru');
INSERT INTO `mvc_users` VALUES ('6', 'name6', 'name6@mail.ru');
