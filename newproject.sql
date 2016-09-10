/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : newproject

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-09-10 17:35:27
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
INSERT INTO `admin_user` VALUES ('1', 'admin', '', '2ecx7cgjQQ1S83P6GR6Rkp/yI4VnjH5Wwq40PsbTqZo6HlsTAeYACR7WnWmeh/CxhF6GNLVP9MzQitVPvhAWpw==', null, '0', '1473468049');
INSERT INTO `admin_user` VALUES ('4', 'shin', '', 'k4lSi53/iAZUIyNZOx3Ov7GZ70scFbngrLShFldP6qm3/iSnieKYEogkszXu82rbKW0IqgGWeuk94llP2ApcXw==', null, '0', '1452649715');

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_type` int(11) NOT NULL,
  `d_sex` tinyint(4) NOT NULL,
  `d_like` varchar(150) default NULL,
  `d_content` text NOT NULL,
  `d_content1` text NOT NULL,
  `d_img` varchar(150) default NULL,
  `d_log` varchar(150) default NULL,
  `d_date` date default NULL,
  `d_time` time default NULL,
  `d_enable` enum('Y','N') NOT NULL default 'Y' COMMENT '啟用?',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '7', '0', '0@#3', '231231', '312123', './uploads/article/20160910081038article6292.jpg', '123', '2016-09-15', '06:00:00', 'Y', '2016-09-09 17:17:31', '2016-09-10 16:49:47');

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
  `d_type` tinyint(4) NOT NULL COMMENT 'Input類型1:text;2.Radio3:checkbox;3:select;4:select_multiple;5:textarea;6:textarea_ckeditor;7:view;8:hidden;9:date;10:file;',
  `d_must` enum('Y','N') NOT NULL default 'N' COMMENT '是否必填',
  `d_musttype` enum('_String','_Select','_CheckRadio','_CheckPhone','_CheckEmail','_CheckIDNum','_File') default NULL,
  `d_val` varchar(150) default NULL COMMENT 'Select 使用(以逗號區份)',
  `d_sort` tinyint(4) NOT NULL COMMENT '排序',
  `d_maxlength` tinyint(4) default NULL COMMENT 'Input最長字數',
  `d_search` enum('Y','N') default 'N' COMMENT '是否為搜尋欄位',
  `d_ctype` varchar(50) NOT NULL COMMENT 'Select 抓取之資料表名稱',
  `d_config` varchar(50) default NULL COMMENT '有值則抓config資料表d_type',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auto_page
-- ----------------------------
INSERT INTO `auto_page` VALUES ('2', '2', 'Y', 'd_title', '文章名稱', '1', 'Y', '_String', null, '2', '20', 'N', '', null);
INSERT INTO `auto_page` VALUES ('3', '3', 'Y', 'd_sex', '性別', '2', 'Y', '_CheckRadio', '男@#女', '1', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('4', '3', 'Y', 'd_like', '喜歡的寵物', '3', 'N', null, '狗@#貓@#豬@#鳥', '2', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('5', '3', 'Y', 'd_type', '分類', '4', 'Y', '_Select', null, '3', null, 'N', 'article_type', null);
INSERT INTO `auto_page` VALUES ('6', '3', 'N', 'd_content', '說明', '5', 'Y', '_String', null, '4', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('7', '3', 'N', 'd_content1', '大說明', '6', 'Y', '_String', null, '5', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('8', '3', 'N', 'd_img', '縮圖', '7', 'N', null, null, '6', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('9', '3', 'N', 'd_img', '照片', '8', 'Y', '_File', '', '7', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('10', '3', 'N', 'd_log', '', '9', 'N', null, null, '8', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('11', '3', 'N', 'd_date', '預約日期', '10', 'Y', '_String', null, '9', null, 'N', '', null);
INSERT INTO `auto_page` VALUES ('12', '3', 'N', 'd_time', '預約時間', '11', 'Y', '_String', null, '10', null, 'N', '', null);

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

-- ----------------------------
-- Table structure for `d_menu`
-- ----------------------------
DROP TABLE IF EXISTS `d_menu`;
CREATE TABLE `d_menu` (
  `d_id` tinyint(3) NOT NULL auto_increment,
  `d_p_id` tinyint(3) NOT NULL COMMENT '子選項',
  `d_code` varchar(150) default NULL COMMENT '權限名稱',
  `d_menuname` varchar(20) NOT NULL COMMENT '標題',
  `d_listname` varchar(20) NOT NULL,
  `d_head` varchar(60) NOT NULL COMMENT '資料夾名稱',
  `d_dbname` varchar(50) default NULL COMMENT '資料庫名稱',
  `d_sort` tinyint(4) NOT NULL COMMENT '排序',
  `is_enable` enum('Y','N') default 'Y' COMMENT '是否有啟用功能',
  `is_del` enum('Y','N') NOT NULL default 'N' COMMENT '是否刪除',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_menu
-- ----------------------------
INSERT INTO `d_menu` VALUES ('1', '0', null, '天沐岩盤浴', '', '', null, '0', 'Y', 'N');
INSERT INTO `d_menu` VALUES ('2', '1', 'j_article', '文章分類', '文章分類', 'daymore', 'article_type', '0', 'Y', 'N');
INSERT INTO `d_menu` VALUES ('3', '1', null, '文章列表', '文章', 'daymore', 'article', '1', 'Y', 'N');

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
