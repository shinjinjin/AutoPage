/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : newproject

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2016-09-13 15:42:21
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
INSERT INTO `admin_user` VALUES ('1', 'admin', '', '2ecx7cgjQQ1S83P6GR6Rkp/yI4VnjH5Wwq40PsbTqZo6HlsTAeYACR7WnWmeh/CxhF6GNLVP9MzQitVPvhAWpw==', null, '0', '1473727802');
INSERT INTO `admin_user` VALUES ('4', 'shin', '', 'k4lSi53/iAZUIyNZOx3Ov7GZ70scFbngrLShFldP6qm3/iSnieKYEogkszXu82rbKW0IqgGWeuk94llP2ApcXw==', null, '0', '1452649715');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auto_page
-- ----------------------------

-- ----------------------------
-- Table structure for `city_category`
-- ----------------------------
DROP TABLE IF EXISTS `city_category`;
CREATE TABLE `city_category` (
  `d_id` smallint(5) unsigned NOT NULL auto_increment,
  `d_city_id` tinyint(1) default '0' COMMENT '繼承縣市id',
  `d_name` varchar(10) NOT NULL COMMENT '縣市名稱或區域名稱',
  `d_zipcode` decimal(5,0) default '0' COMMENT '郵遞區號',
  `d_sort` tinyint(1) NOT NULL default '0' COMMENT '排序',
  PRIMARY KEY  (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='縣市選單';

-- ----------------------------
-- Records of city_category
-- ----------------------------
INSERT INTO `city_category` VALUES ('1', '0', '基隆市', '0', '0');
INSERT INTO `city_category` VALUES ('2', '0', '台北市', '0', '1');
INSERT INTO `city_category` VALUES ('3', '0', '新北市', '0', '2');
INSERT INTO `city_category` VALUES ('4', '0', '桃園縣', '0', '3');
INSERT INTO `city_category` VALUES ('5', '0', '新竹市', '0', '4');
INSERT INTO `city_category` VALUES ('6', '0', '新竹縣', '0', '5');
INSERT INTO `city_category` VALUES ('7', '0', '苗栗縣', '0', '6');
INSERT INTO `city_category` VALUES ('8', '0', '台中市', '0', '7');
INSERT INTO `city_category` VALUES ('9', '0', '彰化縣', '0', '8');
INSERT INTO `city_category` VALUES ('10', '0', '南投縣', '0', '9');
INSERT INTO `city_category` VALUES ('11', '0', '雲林縣', '0', '10');
INSERT INTO `city_category` VALUES ('12', '0', '嘉義市', '0', '11');
INSERT INTO `city_category` VALUES ('13', '0', '嘉義縣', '0', '12');
INSERT INTO `city_category` VALUES ('14', '0', '台南市', '0', '13');
INSERT INTO `city_category` VALUES ('15', '0', '高雄市', '0', '14');
INSERT INTO `city_category` VALUES ('16', '0', '屏東縣', '0', '15');
INSERT INTO `city_category` VALUES ('17', '0', '台東縣', '0', '16');
INSERT INTO `city_category` VALUES ('18', '0', '花蓮縣', '0', '17');
INSERT INTO `city_category` VALUES ('19', '0', '宜蘭縣', '0', '18');
INSERT INTO `city_category` VALUES ('20', '0', '澎湖縣', '0', '19');
INSERT INTO `city_category` VALUES ('21', '0', '金門縣', '0', '20');
INSERT INTO `city_category` VALUES ('22', '0', '連江縣', '0', '21');
INSERT INTO `city_category` VALUES ('23', '15', '前鎮區', '806', '6');
INSERT INTO `city_category` VALUES ('24', '13', '六腳鄉', '615', '11');
INSERT INTO `city_category` VALUES ('25', '11', '斗南鎮', '630', '0');
INSERT INTO `city_category` VALUES ('26', '13', '太保市', '612', '8');
INSERT INTO `city_category` VALUES ('27', '9', '田尾鄉', '522', '18');
INSERT INTO `city_category` VALUES ('28', '18', '新城鄉', '971', '1');
INSERT INTO `city_category` VALUES ('29', '6', '新豐鄉', '304', '2');
INSERT INTO `city_category` VALUES ('30', '8', '后里區', '421', '13');
INSERT INTO `city_category` VALUES ('31', '15', '楠梓區', '811', '8');
INSERT INTO `city_category` VALUES ('32', '18', '玉里鎮', '981', '10');
INSERT INTO `city_category` VALUES ('33', '19', '南澳鄉', '272', '11');
INSERT INTO `city_category` VALUES ('34', '20', '湖西鄉', '885', '5');
INSERT INTO `city_category` VALUES ('35', '3', '平溪區', '226', '7');
INSERT INTO `city_category` VALUES ('36', '9', '北斗鎮', '521', '17');
INSERT INTO `city_category` VALUES ('37', '8', '太平區', '411', '8');
INSERT INTO `city_category` VALUES ('38', '13', '鹿草鄉', '611', '7');
INSERT INTO `city_category` VALUES ('39', '17', '鹿野鄉', '955', '5');
INSERT INTO `city_category` VALUES ('40', '14', '善化區', '741', '32');
INSERT INTO `city_category` VALUES ('41', '7', '頭份鎮', '351', '1');
INSERT INTO `city_category` VALUES ('42', '9', '彰化市', '500', '0');
INSERT INTO `city_category` VALUES ('43', '11', '水林鄉', '652', '16');
INSERT INTO `city_category` VALUES ('44', '3', '三峽區', '237', '16');
INSERT INTO `city_category` VALUES ('45', '9', '員林鎮', '510', '9');
INSERT INTO `city_category` VALUES ('46', '18', '鳳林鎮', '975', '5');
INSERT INTO `city_category` VALUES ('47', '3', '鶯歌區', '239', '18');
INSERT INTO `city_category` VALUES ('48', '16', '竹田鄉', '911', '10');
INSERT INTO `city_category` VALUES ('49', '17', '臺東市', '950', '0');
INSERT INTO `city_category` VALUES ('50', '7', '獅潭鄉', '354', '4');
INSERT INTO `city_category` VALUES ('51', '6', '關西鎮', '306', '4');
INSERT INTO `city_category` VALUES ('52', '19', '頭城鎮', '261', '1');
INSERT INTO `city_category` VALUES ('53', '4', '中壢市', '320', '0');
INSERT INTO `city_category` VALUES ('54', '3', '貢寮區', '228', '9');
INSERT INTO `city_category` VALUES ('55', '16', '來義鄉', '922', '15');
INSERT INTO `city_category` VALUES ('56', '11', '崙背鄉', '637', '7');
INSERT INTO `city_category` VALUES ('57', '15', '杉林區', '846', '34');
INSERT INTO `city_category` VALUES ('58', '7', '西湖鄉', '368', '16');
INSERT INTO `city_category` VALUES ('59', '8', '外埔區', '438', '27');
INSERT INTO `city_category` VALUES ('60', '10', '水里鎮', '553', '8');
INSERT INTO `city_category` VALUES ('61', '13', '大埔鄉', '607', '5');
INSERT INTO `city_category` VALUES ('62', '19', '釣魚台', '290', '12');
INSERT INTO `city_category` VALUES ('63', '15', '大社區', '815', '12');
INSERT INTO `city_category` VALUES ('64', '2', '松山區', '105', '3');
INSERT INTO `city_category` VALUES ('65', '5', '東區', '300', '0');
INSERT INTO `city_category` VALUES ('66', '6', '北埔鄉', '314', '11');
INSERT INTO `city_category` VALUES ('67', '8', '西區', '403', '3');
INSERT INTO `city_category` VALUES ('68', '7', '南庄鄉', '353', '3');
INSERT INTO `city_category` VALUES ('69', '8', '霧峰區', '413', '10');
INSERT INTO `city_category` VALUES ('70', '11', '麥寮鄉', '638', '8');
INSERT INTO `city_category` VALUES ('71', '6', '尖石鄉', '313', '10');
INSERT INTO `city_category` VALUES ('72', '15', '小港區', '812', '9');
INSERT INTO `city_category` VALUES ('73', '15', '燕巢區', '824', '19');
INSERT INTO `city_category` VALUES ('74', '16', '林邊鄉', '927', '20');
INSERT INTO `city_category` VALUES ('75', '15', '鳥松區', '833', '28');
INSERT INTO `city_category` VALUES ('76', '14', '安定區', '745', '36');
INSERT INTO `city_category` VALUES ('77', '2', '信義區', '110', '6');
INSERT INTO `city_category` VALUES ('78', '7', '頭屋鄉', '362', '10');
INSERT INTO `city_category` VALUES ('79', '6', '寶山鄉', '308', '6');
INSERT INTO `city_category` VALUES ('80', '4', '龍潭鄉', '325', '2');
INSERT INTO `city_category` VALUES ('81', '3', '蘆洲區', '247', '23');
INSERT INTO `city_category` VALUES ('82', '8', '清水區', '436', '25');
INSERT INTO `city_category` VALUES ('83', '19', '三星鄉', '266', '6');
INSERT INTO `city_category` VALUES ('84', '9', '芳苑鄉', '528', '24');
INSERT INTO `city_category` VALUES ('85', '14', '中西區', '700', '0');
INSERT INTO `city_category` VALUES ('86', '21', '金寧鄉', '892', '2');
INSERT INTO `city_category` VALUES ('87', '4', '楊梅市', '326', '3');
INSERT INTO `city_category` VALUES ('88', '15', '岡山區', '820', '15');
INSERT INTO `city_category` VALUES ('89', '4', '大園鄉', '337', '11');
INSERT INTO `city_category` VALUES ('90', '8', '大安區', '439', '28');
INSERT INTO `city_category` VALUES ('91', '9', '竹塘鄉', '525', '21');
INSERT INTO `city_category` VALUES ('92', '16', '南州鄉', '926', '19');
INSERT INTO `city_category` VALUES ('93', '3', '土城區', '236', '15');
INSERT INTO `city_category` VALUES ('94', '14', '後壁區', '731', '25');
INSERT INTO `city_category` VALUES ('95', '17', '東河鄉', '959', '9');
INSERT INTO `city_category` VALUES ('96', '9', '溪湖鎮', '514', '13');
INSERT INTO `city_category` VALUES ('97', '7', '卓蘭鎮', '369', '17');
INSERT INTO `city_category` VALUES ('98', '17', '綠島鄉', '951', '1');
INSERT INTO `city_category` VALUES ('99', '11', '虎尾鎮', '632', '2');
INSERT INTO `city_category` VALUES ('100', '3', '石門區', '253', '28');
INSERT INTO `city_category` VALUES ('101', '15', '阿蓮區', '822', '17');
INSERT INTO `city_category` VALUES ('102', '2', '中正區', '100', '0');
INSERT INTO `city_category` VALUES ('103', '15', '甲仙區', '847', '35');
INSERT INTO `city_category` VALUES ('104', '15', '新興區', '800', '0');
INSERT INTO `city_category` VALUES ('105', '19', '壯圍鄉', '263', '3');
INSERT INTO `city_category` VALUES ('106', '13', '大林鎮', '622', '14');
INSERT INTO `city_category` VALUES ('107', '14', '下營區', '735', '29');
INSERT INTO `city_category` VALUES ('108', '14', '北門區', '727', '23');
INSERT INTO `city_category` VALUES ('109', '14', '永康區', '710', '6');
INSERT INTO `city_category` VALUES ('110', '15', '仁武區', '814', '11');
INSERT INTO `city_category` VALUES ('111', '13', '義竹鄉', '624', '16');
INSERT INTO `city_category` VALUES ('112', '14', '新營區', '730', '24');
INSERT INTO `city_category` VALUES ('113', '16', '屏東市', '900', '0');
INSERT INTO `city_category` VALUES ('114', '8', '北屯區', '406', '5');
INSERT INTO `city_category` VALUES ('115', '3', '淡水區', '251', '26');
INSERT INTO `city_category` VALUES ('116', '10', '埔里鎮', '545', '4');
INSERT INTO `city_category` VALUES ('117', '17', '大武鄉', '965', '14');
INSERT INTO `city_category` VALUES ('118', '8', '南區', '402', '2');
INSERT INTO `city_category` VALUES ('119', '1', '仁愛區', '200', '0');
INSERT INTO `city_category` VALUES ('120', '4', '觀音鄉', '328', '5');
INSERT INTO `city_category` VALUES ('121', '15', '那瑪夏區', '849', '37');
INSERT INTO `city_category` VALUES ('122', '16', '里港鄉', '905', '5');
INSERT INTO `city_category` VALUES ('123', '14', '安平區', '708', '4');
INSERT INTO `city_category` VALUES ('124', '14', '仁德區', '717', '13');
INSERT INTO `city_category` VALUES ('125', '17', '太麻里鄉', '963', '12');
INSERT INTO `city_category` VALUES ('126', '19', '員山鄉', '264', '4');
INSERT INTO `city_category` VALUES ('127', '11', '口湖鄉', '653', '17');
INSERT INTO `city_category` VALUES ('128', '3', '八里區', '249', '25');
INSERT INTO `city_category` VALUES ('129', '16', '潮州鎮', '920', '13');
INSERT INTO `city_category` VALUES ('130', '2', '北投區', '112', '8');
INSERT INTO `city_category` VALUES ('131', '3', '永和區', '234', '13');
INSERT INTO `city_category` VALUES ('132', '2', '文山區', '116', '11');
INSERT INTO `city_category` VALUES ('133', '11', '土庫鎮', '633', '3');
INSERT INTO `city_category` VALUES ('134', '19', '五結鄉', '268', '8');
INSERT INTO `city_category` VALUES ('135', '3', '深坑區', '222', '4');
INSERT INTO `city_category` VALUES ('136', '15', '旗山區', '842', '30');
INSERT INTO `city_category` VALUES ('137', '1', '中正區', '202', '3');
INSERT INTO `city_category` VALUES ('138', '14', '新化區', '712', '8');
INSERT INTO `city_category` VALUES ('139', '15', '內門區', '845', '33');
INSERT INTO `city_category` VALUES ('140', '9', '溪州鄉', '524', '20');
INSERT INTO `city_category` VALUES ('141', '4', '龜山鄉', '333', '7');
INSERT INTO `city_category` VALUES ('142', '6', '竹東鎮', '310', '7');
INSERT INTO `city_category` VALUES ('143', '16', '滿洲鄉', '947', '32');
INSERT INTO `city_category` VALUES ('144', '20', '西嶼鄉', '881', '1');
INSERT INTO `city_category` VALUES ('145', '6', '橫山鄉', '312', '9');
INSERT INTO `city_category` VALUES ('146', '3', '三重區', '241', '19');
INSERT INTO `city_category` VALUES ('147', '15', '湖內區', '829', '24');
INSERT INTO `city_category` VALUES ('148', '16', '獅子鄉', '943', '28');
INSERT INTO `city_category` VALUES ('149', '22', '東引鄉', '212', '3');
INSERT INTO `city_category` VALUES ('150', '16', '佳冬鄉', '931', '23');
INSERT INTO `city_category` VALUES ('151', '11', '元長鄉', '655', '19');
INSERT INTO `city_category` VALUES ('152', '10', '名間鄉', '551', '6');
INSERT INTO `city_category` VALUES ('153', '18', '卓溪鄉', '982', '11');
INSERT INTO `city_category` VALUES ('154', '21', '金沙鎮', '890', '0');
INSERT INTO `city_category` VALUES ('155', '7', '三義鄉', '367', '15');
INSERT INTO `city_category` VALUES ('156', '16', '泰武鄉', '921', '14');
INSERT INTO `city_category` VALUES ('157', '3', '中和區', '235', '14');
INSERT INTO `city_category` VALUES ('158', '9', '社頭鄉', '511', '10');
INSERT INTO `city_category` VALUES ('159', '3', '烏來區', '233', '12');
INSERT INTO `city_category` VALUES ('160', '10', '仁愛鄉', '546', '5');
INSERT INTO `city_category` VALUES ('161', '15', '大寮區', '831', '26');
INSERT INTO `city_category` VALUES ('162', '9', '伸港鄉', '509', '8');
INSERT INTO `city_category` VALUES ('163', '7', '竹南鎮', '350', '0');
INSERT INTO `city_category` VALUES ('164', '13', '中埔鄉', '606', '4');
INSERT INTO `city_category` VALUES ('165', '15', '鹽埕區', '803', '3');
INSERT INTO `city_category` VALUES ('166', '7', '通霄鎮', '357', '6');
INSERT INTO `city_category` VALUES ('167', '15', '苓雅區', '802', '2');
INSERT INTO `city_category` VALUES ('168', '3', '萬里區', '207', '0');
INSERT INTO `city_category` VALUES ('169', '1', '安樂區', '204', '4');
INSERT INTO `city_category` VALUES ('170', '8', '大里區', '412', '9');
INSERT INTO `city_category` VALUES ('171', '14', '麻豆區', '721', '17');
INSERT INTO `city_category` VALUES ('172', '6', '湖口鄉', '303', '1');
INSERT INTO `city_category` VALUES ('173', '8', '豐原區', '420', '12');
INSERT INTO `city_category` VALUES ('174', '19', '大同鄉', '267', '7');
INSERT INTO `city_category` VALUES ('175', '9', '永靖鄉', '512', '11');
INSERT INTO `city_category` VALUES ('176', '13', '番路鄉', '602', '0');
INSERT INTO `city_category` VALUES ('177', '8', '沙鹿區', '433', '22');
INSERT INTO `city_category` VALUES ('178', '7', '苑裡鎮', '358', '7');
INSERT INTO `city_category` VALUES ('179', '8', '北區', '404', '4');
INSERT INTO `city_category` VALUES ('180', '11', '褒忠鄉', '634', '4');
INSERT INTO `city_category` VALUES ('181', '4', '新屋鄉', '327', '4');
INSERT INTO `city_category` VALUES ('182', '9', '埔心鄉', '513', '12');
INSERT INTO `city_category` VALUES ('183', '17', '海端鄉', '957', '7');
INSERT INTO `city_category` VALUES ('184', '8', '石岡區', '422', '14');
INSERT INTO `city_category` VALUES ('185', '15', '三民區', '807', '7');
INSERT INTO `city_category` VALUES ('186', '1', '暖暖區', '205', '5');
INSERT INTO `city_category` VALUES ('187', '14', '七股區', '724', '20');
INSERT INTO `city_category` VALUES ('188', '17', '延平鎮', '953', '3');
INSERT INTO `city_category` VALUES ('189', '20', '望安鄉', '882', '2');
INSERT INTO `city_category` VALUES ('190', '2', '南港區', '115', '10');
INSERT INTO `city_category` VALUES ('191', '5', '香山區', '300', '2');
INSERT INTO `city_category` VALUES ('192', '16', '東港鎮', '928', '21');
INSERT INTO `city_category` VALUES ('193', '16', '新園鄉', '932', '24');
INSERT INTO `city_category` VALUES ('194', '8', '龍井區', '434', '23');
INSERT INTO `city_category` VALUES ('195', '10', '鹿谷鄉', '558', '12');
INSERT INTO `city_category` VALUES ('196', '9', '埤頭鄉', '523', '19');
INSERT INTO `city_category` VALUES ('197', '20', '白沙鄉', '884', '4');
INSERT INTO `city_category` VALUES ('198', '11', '臺西鄉', '636', '6');
INSERT INTO `city_category` VALUES ('199', '14', '學甲區', '726', '22');
INSERT INTO `city_category` VALUES ('200', '16', '內埔鄉', '912', '11');
INSERT INTO `city_category` VALUES ('201', '7', '泰安鄉', '365', '13');
INSERT INTO `city_category` VALUES ('202', '14', '北區', '704', '3');
INSERT INTO `city_category` VALUES ('203', '10', '竹山鎮', '557', '11');
INSERT INTO `city_category` VALUES ('204', '21', '金湖鎮', '891', '1');
INSERT INTO `city_category` VALUES ('205', '18', '吉安鄉', '973', '3');
INSERT INTO `city_category` VALUES ('206', '14', '六甲區', '734', '28');
INSERT INTO `city_category` VALUES ('207', '16', '牡丹鄉', '945', '30');
INSERT INTO `city_category` VALUES ('208', '19', '宜蘭市', '260', '0');
INSERT INTO `city_category` VALUES ('209', '16', '高樹鄉', '906', '6');
INSERT INTO `city_category` VALUES ('210', '7', '銅鑼鄉', '366', '14');
INSERT INTO `city_category` VALUES ('211', '17', '金峰鄉', '964', '13');
INSERT INTO `city_category` VALUES ('212', '16', '萬巒鄉', '923', '16');
INSERT INTO `city_category` VALUES ('213', '15', '六龜區', '844', '32');
INSERT INTO `city_category` VALUES ('214', '14', '龍崎區', '719', '15');
INSERT INTO `city_category` VALUES ('215', '8', '東區', '401', '1');
INSERT INTO `city_category` VALUES ('216', '15', '前金區', '801', '1');
INSERT INTO `city_category` VALUES ('217', '16', '霧臺鄉', '902', '2');
INSERT INTO `city_category` VALUES ('218', '13', '新港鄉', '616', '12');
INSERT INTO `city_category` VALUES ('219', '21', '烈嶼鄉', '894', '4');
INSERT INTO `city_category` VALUES ('220', '15', '東沙群島', '817', '13');
INSERT INTO `city_category` VALUES ('221', '14', '柳營區', '736', '30');
INSERT INTO `city_category` VALUES ('222', '14', '關廟區', '718', '14');
INSERT INTO `city_category` VALUES ('223', '14', '將軍區', '725', '21');
INSERT INTO `city_category` VALUES ('224', '22', '北竿鄉', '210', '1');
INSERT INTO `city_category` VALUES ('225', '7', '三灣鄉', '352', '2');
INSERT INTO `city_category` VALUES ('226', '11', '二崙鄉', '649', '14');
INSERT INTO `city_category` VALUES ('227', '13', '竹崎鄉', '604', '2');
INSERT INTO `city_category` VALUES ('228', '2', '大同區', '103', '1');
INSERT INTO `city_category` VALUES ('229', '12', '東區', '600', '0');
INSERT INTO `city_category` VALUES ('230', '14', '左鎮區', '713', '9');
INSERT INTO `city_category` VALUES ('231', '14', '玉井區', '714', '10');
INSERT INTO `city_category` VALUES ('232', '7', '後龍鎮', '356', '5');
INSERT INTO `city_category` VALUES ('233', '11', '東勢鄉', '635', '5');
INSERT INTO `city_category` VALUES ('234', '8', '潭子區', '427', '18');
INSERT INTO `city_category` VALUES ('235', '9', '和美鎮', '508', '7');
INSERT INTO `city_category` VALUES ('236', '16', '崁頂鄉', '924', '17');
INSERT INTO `city_category` VALUES ('237', '17', '池上鄉', '958', '8');
INSERT INTO `city_category` VALUES ('238', '16', '車城鄉', '944', '29');
INSERT INTO `city_category` VALUES ('239', '17', '長濱鄉', '962', '11');
INSERT INTO `city_category` VALUES ('240', '8', '西屯區', '407', '6');
INSERT INTO `city_category` VALUES ('241', '14', '西港區', '723', '19');
INSERT INTO `city_category` VALUES ('242', '1', '中山區', '203', '2');
INSERT INTO `city_category` VALUES ('243', '11', '四湖鄉', '654', '18');
INSERT INTO `city_category` VALUES ('244', '14', '楠西區', '715', '11');
INSERT INTO `city_category` VALUES ('245', '8', '新社區', '426', '17');
INSERT INTO `city_category` VALUES ('246', '17', '卑南鄉', '954', '4');
INSERT INTO `city_category` VALUES ('247', '18', '光復鄉', '976', '6');
INSERT INTO `city_category` VALUES ('248', '17', '關山鎮', '956', '6');
INSERT INTO `city_category` VALUES ('249', '14', '山上區', '743', '34');
INSERT INTO `city_category` VALUES ('250', '7', '造橋鄉', '361', '9');
INSERT INTO `city_category` VALUES ('251', '14', '歸仁區', '711', '7');
INSERT INTO `city_category` VALUES ('252', '9', '芬園鄉', '502', '1');
INSERT INTO `city_category` VALUES ('253', '3', '三芝區', '252', '27');
INSERT INTO `city_category` VALUES ('254', '20', '馬公市', '880', '0');
INSERT INTO `city_category` VALUES ('255', '19', '羅東鎮', '265', '5');
INSERT INTO `city_category` VALUES ('256', '16', '九如鄉', '904', '4');
INSERT INTO `city_category` VALUES ('257', '14', '新市區', '744', '35');
INSERT INTO `city_category` VALUES ('258', '16', '麟洛鄉', '909', '9');
INSERT INTO `city_category` VALUES ('259', '2', '士林區', '111', '7');
INSERT INTO `city_category` VALUES ('260', '15', '鼓山區', '804', '4');
INSERT INTO `city_category` VALUES ('261', '15', '橋頭區', '825', '20');
INSERT INTO `city_category` VALUES ('262', '21', '金城鎮', '893', '3');
INSERT INTO `city_category` VALUES ('263', '2', '中山區', '104', '2');
INSERT INTO `city_category` VALUES ('264', '3', '汐止區', '221', '3');
INSERT INTO `city_category` VALUES ('265', '7', '大湖鄉', '364', '12');
INSERT INTO `city_category` VALUES ('266', '18', '花蓮市', '970', '0');
INSERT INTO `city_category` VALUES ('267', '11', '大埤鄉', '631', '1');
INSERT INTO `city_category` VALUES ('268', '6', '峨眉鄉', '315', '12');
INSERT INTO `city_category` VALUES ('269', '15', '左營區', '813', '10');
INSERT INTO `city_category` VALUES ('270', '19', '礁溪鄉', '262', '2');
INSERT INTO `city_category` VALUES ('271', '8', '大雅區', '428', '19');
INSERT INTO `city_category` VALUES ('272', '3', '雙溪區', '227', '8');
INSERT INTO `city_category` VALUES ('273', '3', '石碇區', '223', '5');
INSERT INTO `city_category` VALUES ('274', '8', '南屯區', '408', '7');
INSERT INTO `city_category` VALUES ('275', '3', '坪林區', '232', '11');
INSERT INTO `city_category` VALUES ('276', '8', '大肚區', '432', '21');
INSERT INTO `city_category` VALUES ('277', '13', '阿里山鄉', '605', '3');
INSERT INTO `city_category` VALUES ('278', '8', '大甲區', '437', '26');
INSERT INTO `city_category` VALUES ('279', '16', '鹽埔鄉', '907', '7');
INSERT INTO `city_category` VALUES ('280', '16', '琉球鄉', '929', '22');
INSERT INTO `city_category` VALUES ('281', '10', '集集鎮', '552', '7');
INSERT INTO `city_category` VALUES ('282', '19', '蘇澳鎮', '270', '10');
INSERT INTO `city_category` VALUES ('283', '3', '林口區', '244', '22');
INSERT INTO `city_category` VALUES ('284', '11', '莿桐鄉', '647', '12');
INSERT INTO `city_category` VALUES ('285', '1', '信義區', '201', '1');
INSERT INTO `city_category` VALUES ('286', '16', '三地門鄉', '901', '1');
INSERT INTO `city_category` VALUES ('287', '18', '瑞穗鄉', '978', '8');
INSERT INTO `city_category` VALUES ('288', '2', '萬華區', '108', '5');
INSERT INTO `city_category` VALUES ('289', '15', '彌陀區', '827', '22');
INSERT INTO `city_category` VALUES ('290', '13', '梅山鄉', '603', '1');
INSERT INTO `city_category` VALUES ('291', '15', '田寮區', '823', '18');
INSERT INTO `city_category` VALUES ('292', '3', '樹林區', '238', '17');
INSERT INTO `city_category` VALUES ('293', '11', '古坑鄉', '646', '11');
INSERT INTO `city_category` VALUES ('294', '19', '冬山鄉', '269', '9');
INSERT INTO `city_category` VALUES ('295', '18', '富里鄉', '983', '12');
INSERT INTO `city_category` VALUES ('296', '10', '魚池鄉', '555', '9');
INSERT INTO `city_category` VALUES ('297', '7', '苗栗市', '360', '8');
INSERT INTO `city_category` VALUES ('298', '18', '壽豐鄉', '974', '4');
INSERT INTO `city_category` VALUES ('299', '14', '安南區', '709', '5');
INSERT INTO `city_category` VALUES ('300', '3', '新店區', '231', '10');
INSERT INTO `city_category` VALUES ('301', '8', '和平區', '424', '16');
INSERT INTO `city_category` VALUES ('302', '14', '南化區', '716', '12');
INSERT INTO `city_category` VALUES ('303', '4', '蘆竹市', '338', '12');
INSERT INTO `city_category` VALUES ('304', '16', '枋寮鄉', '940', '25');
INSERT INTO `city_category` VALUES ('305', '2', '內湖區', '114', '9');
INSERT INTO `city_category` VALUES ('306', '15', '美濃區', '843', '31');
INSERT INTO `city_category` VALUES ('307', '21', '烏坵鄉', '896', '5');
INSERT INTO `city_category` VALUES ('308', '10', '中寮鄉', '541', '1');
INSERT INTO `city_category` VALUES ('309', '8', '東勢區', '423', '15');
INSERT INTO `city_category` VALUES ('310', '9', '鹿港鎮', '505', '4');
INSERT INTO `city_category` VALUES ('311', '22', '南竿鄉', '209', '0');
INSERT INTO `city_category` VALUES ('312', '16', '萬丹鄉', '913', '12');
INSERT INTO `city_category` VALUES ('313', '17', '蘭嶼鄉', '952', '2');
INSERT INTO `city_category` VALUES ('314', '17', '達仁鄉', '966', '15');
INSERT INTO `city_category` VALUES ('315', '17', '成功鎮', '961', '10');
INSERT INTO `city_category` VALUES ('316', '14', '佳里區', '722', '18');
INSERT INTO `city_category` VALUES ('317', '15', '梓官區', '826', '21');
INSERT INTO `city_category` VALUES ('318', '13', '民雄鄉', '621', '13');
INSERT INTO `city_category` VALUES ('319', '9', '福興鄉', '506', '5');
INSERT INTO `city_category` VALUES ('320', '15', '旗津區', '805', '5');
INSERT INTO `city_category` VALUES ('321', '4', '平鎮市', '324', '1');
INSERT INTO `city_category` VALUES ('322', '3', '五股區', '248', '24');
INSERT INTO `city_category` VALUES ('323', '3', '板橋區', '220', '2');
INSERT INTO `city_category` VALUES ('324', '15', '林園區', '832', '27');
INSERT INTO `city_category` VALUES ('325', '14', '官田區', '720', '16');
INSERT INTO `city_category` VALUES ('326', '9', '二水鄉', '530', '25');
INSERT INTO `city_category` VALUES ('327', '22', '莒光鄉', '211', '2');
INSERT INTO `city_category` VALUES ('328', '14', '鹽水區', '737', '31');
INSERT INTO `city_category` VALUES ('329', '15', '路竹區', '821', '16');
INSERT INTO `city_category` VALUES ('330', '3', '泰山區', '243', '21');
INSERT INTO `city_category` VALUES ('331', '4', '復興鄉', '336', '10');
INSERT INTO `city_category` VALUES ('332', '9', '線西鄉', '507', '6');
INSERT INTO `city_category` VALUES ('333', '15', '茂林區', '851', '38');
INSERT INTO `city_category` VALUES ('334', '6', '新埔鎮', '305', '3');
INSERT INTO `city_category` VALUES ('335', '9', '田中鎮', '520', '16');
INSERT INTO `city_category` VALUES ('336', '15', '鳳山區', '830', '25');
INSERT INTO `city_category` VALUES ('337', '9', '埔鹽鎮', '516', '15');
INSERT INTO `city_category` VALUES ('338', '15', '南沙群島', '819', '14');
INSERT INTO `city_category` VALUES ('339', '14', '南區', '702', '2');
INSERT INTO `city_category` VALUES ('340', '7', '公館鄉', '363', '11');
INSERT INTO `city_category` VALUES ('341', '8', '烏日區', '414', '11');
INSERT INTO `city_category` VALUES ('342', '6', '五峰鄉', '311', '8');
INSERT INTO `city_category` VALUES ('343', '9', '秀水鄉', '504', '3');
INSERT INTO `city_category` VALUES ('344', '11', '北港鎮', '651', '15');
INSERT INTO `city_category` VALUES ('345', '10', '草屯鎮', '542', '2');
INSERT INTO `city_category` VALUES ('346', '20', '七美鄉', '883', '3');
INSERT INTO `city_category` VALUES ('347', '14', '東區', '701', '1');
INSERT INTO `city_category` VALUES ('348', '4', '桃園市', '330', '6');
INSERT INTO `city_category` VALUES ('349', '5', '北區', '300', '1');
INSERT INTO `city_category` VALUES ('350', '4', '大溪鎮', '335', '9');
INSERT INTO `city_category` VALUES ('351', '10', '信義鄉', '556', '10');
INSERT INTO `city_category` VALUES ('352', '15', '永安區', '828', '23');
INSERT INTO `city_category` VALUES ('353', '9', '大村鄉', '515', '14');
INSERT INTO `city_category` VALUES ('354', '14', '白河區', '732', '26');
INSERT INTO `city_category` VALUES ('355', '16', '恆春鎮', '946', '31');
INSERT INTO `city_category` VALUES ('356', '11', '斗六市', '640', '9');
INSERT INTO `city_category` VALUES ('357', '9', '大城鄉', '527', '23');
INSERT INTO `city_category` VALUES ('358', '6', '竹北市', '302', '0');
INSERT INTO `city_category` VALUES ('359', '12', '西區', '600', '1');
INSERT INTO `city_category` VALUES ('360', '11', '林內鄉', '643', '10');
INSERT INTO `city_category` VALUES ('361', '1', '七堵區', '206', '6');
INSERT INTO `city_category` VALUES ('362', '18', '豐濱鄉', '977', '7');
INSERT INTO `city_category` VALUES ('363', '18', '秀林鄉', '972', '2');
INSERT INTO `city_category` VALUES ('364', '3', '瑞芳區', '224', '6');
INSERT INTO `city_category` VALUES ('365', '8', '梧棲區', '435', '24');
INSERT INTO `city_category` VALUES ('366', '3', '新莊區', '242', '20');
INSERT INTO `city_category` VALUES ('367', '9', '二林鎮', '526', '22');
INSERT INTO `city_category` VALUES ('368', '10', '國姓鄉', '544', '3');
INSERT INTO `city_category` VALUES ('369', '14', '東山區', '733', '27');
INSERT INTO `city_category` VALUES ('370', '6', '芎林鄉', '307', '5');
INSERT INTO `city_category` VALUES ('371', '18', '萬榮鄉', '979', '9');
INSERT INTO `city_category` VALUES ('372', '11', '西螺鎮', '648', '13');
INSERT INTO `city_category` VALUES ('373', '15', '大樹區', '840', '29');
INSERT INTO `city_category` VALUES ('374', '16', '長治鄉', '908', '8');
INSERT INTO `city_category` VALUES ('375', '15', '茄萣區', '852', '39');
INSERT INTO `city_category` VALUES ('376', '3', '金山區', '208', '1');
INSERT INTO `city_category` VALUES ('377', '13', '布袋鎮', '625', '17');
INSERT INTO `city_category` VALUES ('378', '8', '中區', '400', '0');
INSERT INTO `city_category` VALUES ('379', '10', '南投市', '540', '0');
INSERT INTO `city_category` VALUES ('380', '16', '春日鄉', '942', '27');
INSERT INTO `city_category` VALUES ('381', '16', '瑪家鄉', '903', '3');
INSERT INTO `city_category` VALUES ('382', '2', '大安區', '106', '4');
INSERT INTO `city_category` VALUES ('383', '15', '桃源區', '848', '36');
INSERT INTO `city_category` VALUES ('384', '9', '花壇鄉', '503', '2');
INSERT INTO `city_category` VALUES ('385', '13', '溪口鄉', '623', '15');
INSERT INTO `city_category` VALUES ('386', '8', '神岡區', '429', '20');
INSERT INTO `city_category` VALUES ('387', '16', '枋山鄉', '941', '26');
INSERT INTO `city_category` VALUES ('388', '13', '東石鄉', '614', '10');
INSERT INTO `city_category` VALUES ('389', '13', '朴子市', '613', '9');
INSERT INTO `city_category` VALUES ('390', '4', '八德市', '334', '8');
INSERT INTO `city_category` VALUES ('391', '16', '新埤鄉', '925', '18');
INSERT INTO `city_category` VALUES ('392', '13', '水上鄉', '608', '6');
INSERT INTO `city_category` VALUES ('393', '14', '大內區', '742', '33');

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_type` varchar(20) NOT NULL,
  `d_title` varchar(50) NOT NULL,
  `d_val` text NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_config
-- ----------------------------
INSERT INTO `d_config` VALUES ('1', 'net_title', '天沐管理系統', '');
INSERT INTO `d_config` VALUES ('3', 'autotype', 'Select', '2');
INSERT INTO `d_config` VALUES ('2', 'autotype', 'Text', '1');
INSERT INTO `d_config` VALUES ('4', 'autotype', 'Radio', '3');
INSERT INTO `d_config` VALUES ('5', 'autotype', 'Checkbox', '4');
INSERT INTO `d_config` VALUES ('6', 'autotype', 'Textarea', '5');
INSERT INTO `d_config` VALUES ('7', 'autotype', 'Ckeditor', '6');
INSERT INTO `d_config` VALUES ('8', 'autotype', 'View', '7');
INSERT INTO `d_config` VALUES ('9', 'autotype', 'File', '8');
INSERT INTO `d_config` VALUES ('10', 'autotype', 'Hidden', '9');
INSERT INTO `d_config` VALUES ('11', 'autotype', 'Date', '10');
INSERT INTO `d_config` VALUES ('12', 'autotype', 'Time', '11');
INSERT INTO `d_config` VALUES ('13', 'autotype', 'DateTime', '12');
INSERT INTO `d_config` VALUES ('14', 'autotype', 'Address', '13');
INSERT INTO `d_config` VALUES ('15', 'searchtype', '_String', '');
INSERT INTO `d_config` VALUES ('16', 'searchtype', '_Select', '');
INSERT INTO `d_config` VALUES ('17', 'searchtype', '_CheckRadio', '');
INSERT INTO `d_config` VALUES ('18', 'searchtype', '_CheckPhone', '');
INSERT INTO `d_config` VALUES ('19', 'searchtype', '_CheckEmail', '');
INSERT INTO `d_config` VALUES ('20', 'searchtype', '_CheckIDNum', '');
INSERT INTO `d_config` VALUES ('21', 'searchtype', '_File', '');

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
  `d_oc` enum('Y','N') NOT NULL default 'Y' COMMENT '是否有上下架功能?',
  `d_enable` enum('Y','N') default 'Y' COMMENT '是否有啟用功能',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_menu
-- ----------------------------

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
