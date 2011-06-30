/*
Navicat MySQL Data Transfer

Source Server         : _localhost
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : miner

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2011-06-30 15:17:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '0cc175b9c0f1b6a831c399e269772661');

-- ----------------------------
-- Table structure for `mine`
-- ----------------------------
DROP TABLE IF EXISTS `mine`;
CREATE TABLE `mine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `is_free` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mine
-- ----------------------------
INSERT INTO `mine` VALUES ('1', 'Rum Alley', '1');
INSERT INTO `mine` VALUES ('2', 'Coconut coast', '1');
INSERT INTO `mine` VALUES ('3', 'Hidden Hideaway', '1');

-- ----------------------------
-- Table structure for `mine_has_item`
-- ----------------------------
DROP TABLE IF EXISTS `mine_has_item`;
CREATE TABLE `mine_has_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mine_id` int(11) DEFAULT NULL,
  `mine_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mine_has_item_mine` (`mine_id`),
  KEY `fk_mine_has_item_mine_item` (`mine_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mine_has_item
-- ----------------------------
INSERT INTO `mine_has_item` VALUES ('3', '3', '4', '25');
INSERT INTO `mine_has_item` VALUES ('4', '3', '5', '50');
INSERT INTO `mine_has_item` VALUES ('5', '3', '3', '300');
INSERT INTO `mine_has_item` VALUES ('6', '2', '5', '10');
INSERT INTO `mine_has_item` VALUES ('7', '2', '5', '20');
INSERT INTO `mine_has_item` VALUES ('8', '3', '3', '100');

-- ----------------------------
-- Table structure for `mine_item`
-- ----------------------------
DROP TABLE IF EXISTS `mine_item`;
CREATE TABLE `mine_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mine_item
-- ----------------------------
INSERT INTO `mine_item` VALUES ('3', 'Gold', '10');
INSERT INTO `mine_item` VALUES ('4', 'Silver', '8');
INSERT INTO `mine_item` VALUES ('5', 'Diamond', '30');

-- ----------------------------
-- Table structure for `shop`
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('1', 'treasure island magic shop');

-- ----------------------------
-- Table structure for `shop_has_item`
-- ----------------------------
DROP TABLE IF EXISTS `shop_has_item`;
CREATE TABLE `shop_has_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `shop_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `is_free` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shop_has_item_shop` (`shop_id`),
  KEY `fk_shop_hat_item_shop_item` (`shop_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_has_item
-- ----------------------------
INSERT INTO `shop_has_item` VALUES ('3', '1', '2', '85', '0');
INSERT INTO `shop_has_item` VALUES ('4', '1', '1', '46', '0');
INSERT INTO `shop_has_item` VALUES ('5', '1', '3', '20', '1');
INSERT INTO `shop_has_item` VALUES ('6', '1', '4', '11', null);
INSERT INTO `shop_has_item` VALUES ('7', '1', '5', '7', null);

-- ----------------------------
-- Table structure for `shop_item`
-- ----------------------------
DROP TABLE IF EXISTS `shop_item`;
CREATE TABLE `shop_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `shop_item_type_id` int(11) DEFAULT NULL,
  `fb_coin_price` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shop_item_shop_item_type` (`shop_item_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_item
-- ----------------------------
INSERT INTO `shop_item` VALUES ('1', 'ekekapa', '1200', '2', null, '15');
INSERT INTO `shop_item` VALUES ('2', 'robokapa', '0', '2', '100', null);
INSERT INTO `shop_item` VALUES ('3', 'pizza', '10', '1', null, null);
INSERT INTO `shop_item` VALUES ('4', 'csákány', '13', '2', '0', '2');
INSERT INTO `shop_item` VALUES ('5', 'speedcsákány', '0', '2', '20', '20');

-- ----------------------------
-- Table structure for `shop_item_type`
-- ----------------------------
DROP TABLE IF EXISTS `shop_item_type`;
CREATE TABLE `shop_item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_item_type
-- ----------------------------
INSERT INTO `shop_item_type` VALUES ('1', 'food');
INSERT INTO `shop_item_type` VALUES ('2', 'tool');
INSERT INTO `shop_item_type` VALUES ('3', 'clothes');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) DEFAULT NULL,
  `fb_id` varchar(100) DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'adobi', 'adobi', '709');

-- ----------------------------
-- Table structure for `user_has_mine_item`
-- ----------------------------
DROP TABLE IF EXISTS `user_has_mine_item`;
CREATE TABLE `user_has_mine_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mine_has_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_sold_item_user` (`user_id`),
  KEY `fk_user_sold_item_mine_has_item` (`mine_has_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_has_mine_item
-- ----------------------------

-- ----------------------------
-- Table structure for `user_has_shop_item`
-- ----------------------------
DROP TABLE IF EXISTS `user_has_shop_item`;
CREATE TABLE `user_has_shop_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_bought_item_shop_item_id` (`shop_item_id`),
  KEY `fk_user_bought_item_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_has_shop_item
-- ----------------------------
INSERT INTO `user_has_shop_item` VALUES ('1', '1', '1', '9');
INSERT INTO `user_has_shop_item` VALUES ('2', '1', '2', '1');
INSERT INTO `user_has_shop_item` VALUES ('3', '1', '3', '1');
INSERT INTO `user_has_shop_item` VALUES ('31', '1', '4', '3');
INSERT INTO `user_has_shop_item` VALUES ('32', '1', '5', '3');

-- ----------------------------
-- Table structure for `user_mine`
-- ----------------------------
DROP TABLE IF EXISTS `user_mine`;
CREATE TABLE `user_mine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mine_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_mine_user` (`user_id`),
  KEY `fk_user_mine_mine` (`mine_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_mine
-- ----------------------------
INSERT INTO `user_mine` VALUES ('1', '1', '1');
INSERT INTO `user_mine` VALUES ('2', '1', '2');
INSERT INTO `user_mine` VALUES ('3', '1', '3');

-- ----------------------------
-- Table structure for `user_mined_item_log`
-- ----------------------------
DROP TABLE IF EXISTS `user_mined_item_log`;
CREATE TABLE `user_mined_item_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `mine_has_item_id` int(11) DEFAULT NULL,
  `started` timestamp NULL DEFAULT NULL,
  `finished` timestamp NULL DEFAULT NULL,
  `users_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_mined_item_log_user` (`user_id`),
  KEY `fk_user_mined_item_log_mine_has_item` (`mine_has_item_id`),
  KEY `fk_user_mined_item_log_user_has_shop_item` (`users_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_mined_item_log
-- ----------------------------
INSERT INTO `user_mined_item_log` VALUES ('19', '1', '6', '2011-06-29 14:37:16', '2011-06-29 14:39:46', '1');
INSERT INTO `user_mined_item_log` VALUES ('20', '1', '6', '2011-06-30 11:48:42', '2011-06-30 11:51:12', '1');

-- ----------------------------
-- Table structure for `user_purchase_log`
-- ----------------------------
DROP TABLE IF EXISTS `user_purchase_log`;
CREATE TABLE `user_purchase_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `purchase_type` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_purchase_log_user` (`user_id`),
  KEY `fk_user_purchase_log_shop_item` (`shop_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_purchase_log
-- ----------------------------
INSERT INTO `user_purchase_log` VALUES ('1', '1', '4', '2', '2011-06-30 14:39:38', '1', '26');
INSERT INTO `user_purchase_log` VALUES ('2', '1', '4', '3', '2011-06-30 14:40:46', '1', '39');
INSERT INTO `user_purchase_log` VALUES ('3', '1', '4', '3', '2011-06-30 14:41:57', '1', '39');
INSERT INTO `user_purchase_log` VALUES ('4', '1', '4', '1', '2011-06-30 14:43:57', '1', '13');
INSERT INTO `user_purchase_log` VALUES ('5', '1', '5', '3', '2011-06-30 14:45:05', '2', null);
INSERT INTO `user_purchase_log` VALUES ('6', '1', '1', '1', '2011-06-30 14:46:43', '1', '1200');
