/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : newproject

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-09-08 10:04:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `admin_id` int(10) NOT NULL auto_increment,
  `user_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(150) NOT NULL,
  `action_list` text,
  `add_time` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '', '2ecx7cgjQQ1S83P6GR6Rkp/yI4VnjH5Wwq40PsbTqZo6HlsTAeYACR7WnWmeh/CxhF6GNLVP9MzQitVPvhAWpw==', null, '0', '1473229235');
INSERT INTO `admin_user` VALUES ('4', 'shin', '', 'k4lSi53/iAZUIyNZOx3Ov7GZ70scFbngrLShFldP6qm3/iSnieKYEogkszXu82rbKW0IqgGWeuk94llP2ApcXw==', null, '0', '1452649715');

-- ----------------------------
-- Table structure for `article_type`
-- ----------------------------
DROP TABLE IF EXISTS `article_type`;
CREATE TABLE `article_type` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_title` varchar(150) NOT NULL,
  `d_enable` enum('Y','N') NOT NULL default 'Y' COMMENT '啟用?',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_type
-- ----------------------------
INSERT INTO `article_type` VALUES ('1', '人生海海', 'Y', '2016-09-07 16:03:37', '2016-09-07 16:03:37');
INSERT INTO `article_type` VALUES ('7', '美髮保養/造型專區', 'Y', '2016-09-07 16:58:08', '2016-09-07 16:58:08');

-- ----------------------------
-- Table structure for `auto_page`
-- ----------------------------
DROP TABLE IF EXISTS `auto_page`;
CREATE TABLE `auto_page` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_menu_id` int(11) NOT NULL COMMENT '哪個列表用',
  `d_list` enum('Y','N') NOT NULL default 'N' COMMENT '是否為列表欄位',
  `d_fname` varchar(50) NOT NULL COMMENT '資料庫欄位',
  `d_title` varchar(50) NOT NULL COMMENT '標題',
  `d_type` tinyint(4) NOT NULL COMMENT 'Input類型1:text;2:checkbox;3:select;4:select_multiple;5:textarea;6:textarea_ckeditor;7:view;8:hidden;9:date;10:file;',
  `d_must` enum('Y','N') NOT NULL default 'N' COMMENT '是否必填',
  `d_musttype` enum('_String','_Select','_CheckRadio','_CheckPhone','_CheckEmail','_CheckIDNum') default NULL,
  `d_val` varchar(150) default NULL COMMENT 'Select 使用(以逗號區份)',
  `d_sort` tinyint(4) NOT NULL COMMENT '排序',
  `d_maxlength` tinyint(4) default NULL COMMENT 'Input最長字數',
  `d_search` enum('Y','N') default 'N' COMMENT '是否為搜尋欄位',
  `d_ctype` varchar(50) NOT NULL COMMENT 'Select 抓取之資料表名稱',
  `d_config` varchar(50) default NULL COMMENT '有值則抓config資料表d_type',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auto_page
-- ----------------------------
INSERT INTO `auto_page` VALUES ('1', '2', 'Y', 'd_enable', '狀態', '2', 'Y', '_CheckRadio', '開啟@#關閉', '1', null, 'N', '', 'd_enable');
INSERT INTO `auto_page` VALUES ('2', '2', 'Y', 'd_title', '文章名稱', '1', 'Y', '_String', null, '2', '20', 'N', '', null);

-- ----------------------------
-- Table structure for `d_config`
-- ----------------------------
DROP TABLE IF EXISTS `d_config`;
CREATE TABLE `d_config` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_type` varchar(20) NOT NULL,
  `d_title` varchar(50) NOT NULL,
  `d_val` text NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_config
-- ----------------------------
INSERT INTO `d_config` VALUES ('1', 'net_title', '天沐管理系統', '');
INSERT INTO `d_config` VALUES ('2', 'd_enable', '啟用', 'Y');
INSERT INTO `d_config` VALUES ('3', 'd_enable', '關閉', 'N');

-- ----------------------------
-- Table structure for `d_menu`
-- ----------------------------
DROP TABLE IF EXISTS `d_menu`;
CREATE TABLE `d_menu` (
  `d_id` tinyint(3) NOT NULL auto_increment,
  `d_p_id` tinyint(3) NOT NULL COMMENT '子選項',
  `d_code` varchar(150) default NULL COMMENT '權限名稱',
  `d_name` varchar(20) NOT NULL COMMENT '標題',
  `d_head` varchar(60) NOT NULL COMMENT '資料夾名稱',
  `d_dbname` varchar(50) default NULL COMMENT '資料庫名稱',
  `d_sort` tinyint(4) NOT NULL COMMENT '排序',
  `is_del` enum('Y','N') NOT NULL default 'N' COMMENT '是否刪除',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_menu
-- ----------------------------
INSERT INTO `d_menu` VALUES ('1', '0', null, '天沐岩盤浴', '', null, '0', 'N');
INSERT INTO `d_menu` VALUES ('2', '1', 'j_article', '文章分類', 'daymore', 'article_type', '0', 'N');

-- ----------------------------
-- Table structure for `simple`
-- ----------------------------
DROP TABLE IF EXISTS `simple`;
CREATE TABLE `simple` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_enable` enum('Y','N') NOT NULL default 'Y' COMMENT '啟用?',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of simple
-- ----------------------------
