/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : dms_new

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 15/09/2021 12:24:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for app_dispatch
-- ----------------------------
DROP TABLE IF EXISTS `app_dispatch`;
CREATE TABLE `app_dispatch`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fOffice` tinyint(3) UNSIGNED NOT NULL,
  `fDept` smallint(5) UNSIGNED NOT NULL,
  `fDiv` smallint(5) UNSIGNED NOT NULL,
  `fSec` smallint(5) UNSIGNED NOT NULL,
  `fiscalYear` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dispatchNum` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dateOfIssue` date NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `timeOfIssue` time(0) NOT NULL,
  `adressedTo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rack_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rOffice` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rDept` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rDiv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rPlace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rSubject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rRefNum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rCopyTo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_dispatcher`(`author`) USING BTREE,
  INDEX `dfk_office_id`(`fOffice`) USING BTREE,
  INDEX `dfk_dept_id`(`fDept`) USING BTREE,
  INDEX `dfk_div_id`(`fDiv`) USING BTREE,
  INDEX `dfk_sec_id`(`fSec`) USING BTREE,
  CONSTRAINT `dfk_dept_id` FOREIGN KEY (`fDept`) REFERENCES `sys_departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dfk_div_id` FOREIGN KEY (`fDiv`) REFERENCES `sys_divisions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dfk_office_id` FOREIGN KEY (`fOffice`) REFERENCES `sys_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dfk_sec_id` FOREIGN KEY (`fSec`) REFERENCES `sys_sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_dispatch
-- ----------------------------
INSERT INTO `app_dispatch` VALUES (1, 1, 1, 1, 1, '2021-2022', '000001', '2021-07-09', 2021, 7, '01:31:00', 'Taba', '12345', '25', 'Tshering Wangchuk', 'Tshering Wangchuk', 'Tshering Wangchuk', 'Thimphu', 'Circular on CLC and CCS', 'ACC', '-', 'Notesheet.pdf', '2107097pm10018z2.pdf', 2, '2021-07-09 13:31:40', '2021-07-09 13:31:40');

-- ----------------------------
-- Table structure for app_dispatch_actions
-- ----------------------------
DROP TABLE IF EXISTS `app_dispatch_actions`;
CREATE TABLE `app_dispatch_actions`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dispatch_id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(3) NOT NULL COMMENT '1 = upload file, 2 = remarks, 3 = status, 4 = action, 5 = forward, 6 = forward to all\r\n',
  `filepath` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` smallint(5) UNSIGNED NOT NULL,
  `reciever` int(11) UNSIGNED NULL DEFAULT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_dispatch_status_id`(`status`) USING BTREE,
  INDEX `fk_dispatch_id`(`dispatch_id`) USING BTREE,
  CONSTRAINT `fk_dispatch_id` FOREIGN KEY (`dispatch_id`) REFERENCES `app_dispatch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_dispatch_actions
-- ----------------------------
INSERT INTO `app_dispatch_actions` VALUES (1, 1, 5, '', '', 'to normal user', 0, 3, 2, '2021-07-09 13:32:11', '2021-07-09 13:32:11');

-- ----------------------------
-- Table structure for app_notify
-- ----------------------------
DROP TABLE IF EXISTS `app_notify`;
CREATE TABLE `app_notify`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `key` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `flag` tinyint(3) NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_notify
-- ----------------------------
INSERT INTO `app_notify` VALUES (1, 'ods', 'dLetterAction.php', 1, 3, 1, 'to normal user', 2, '2021-07-09 13:32:11', '2021-07-09 13:32:11');
INSERT INTO `app_notify` VALUES (2, 'ods', 'rLetterAction.php', 1, 4, 1, 'to head', 2, '2021-07-09 13:35:25', '2021-07-09 13:35:25');

-- ----------------------------
-- Table structure for app_receipt
-- ----------------------------
DROP TABLE IF EXISTS `app_receipt`;
CREATE TABLE `app_receipt`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `addressedTo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fOffice` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fDept` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fDiv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fPlace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fSubject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fRefNum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fCopyTo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rack_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rOffice` tinyint(3) UNSIGNED NOT NULL,
  `rDept` smallint(5) UNSIGNED NOT NULL,
  `rDiv` smallint(5) UNSIGNED NOT NULL,
  `rSec` smallint(5) UNSIGNED NOT NULL,
  `fiscalYear` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recieptNum` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dateOfReciept` date NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `timeOfReciept` time(0) NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_receiver`(`author`) USING BTREE,
  INDEX `rfk_office_id`(`rOffice`) USING BTREE,
  INDEX `rfk_dept_id`(`rDept`) USING BTREE,
  INDEX `rfk_div_id`(`rDiv`) USING BTREE,
  INDEX `rfk_sec_id`(`rSec`) USING BTREE,
  CONSTRAINT `rfk_dept_id` FOREIGN KEY (`rDept`) REFERENCES `sys_departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rfk_div_id` FOREIGN KEY (`rDiv`) REFERENCES `sys_divisions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rfk_office_id` FOREIGN KEY (`rOffice`) REFERENCES `sys_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rfk_sec_id` FOREIGN KEY (`rSec`) REFERENCES `sys_sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_receipt
-- ----------------------------
INSERT INTO `app_receipt` VALUES (1, 'Head', 'NLCS', 'NLCS', 'NLCS', 'Thimphu', 'Circular on CLC and CCS', 'ACC', '-', '12345', '25', 'NUB-3965.pdf', '2107091oh5893j3.pdf', 1, 1, 1, 1, '2021-2022', '000001', '2021-07-09', 2021, 7, '01:33:00', 2, '2021-07-09 13:34:01', '2021-07-09 13:34:01');

-- ----------------------------
-- Table structure for app_receipt_actions
-- ----------------------------
DROP TABLE IF EXISTS `app_receipt_actions`;
CREATE TABLE `app_receipt_actions`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(3) NOT NULL COMMENT '1 = upload file, 2 = remarks, 3 = status, 4 = action, 5 = forward, 6 = forwarded to all',
  `filepath` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` smallint(5) UNSIGNED NOT NULL,
  `reciever` int(11) UNSIGNED NULL DEFAULT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_receipt_status_id`(`status`) USING BTREE,
  INDEX `fk_receipt_id`(`receipt_id`) USING BTREE,
  CONSTRAINT `fk_receipt_id` FOREIGN KEY (`receipt_id`) REFERENCES `app_receipt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_receipt_actions
-- ----------------------------
INSERT INTO `app_receipt_actions` VALUES (1, 1, 5, '', '', 'to head', 0, 4, 2, '2021-07-09 13:35:25', '2021-07-09 13:35:25');
INSERT INTO `app_receipt_actions` VALUES (2, 1, 2, '', '', 'asdasd', 0, 0, 4, '2021-07-09 13:35:49', '2021-07-09 13:35:49');
INSERT INTO `app_receipt_actions` VALUES (3, 1, 1, '2107096pq3346u9.pdf', 'Genja.pdf', '', 0, 0, 4, '2021-07-09 13:36:00', '2021-07-09 13:36:00');
INSERT INTO `app_receipt_actions` VALUES (4, 1, 3, '', '', '', 1, 0, 4, '2021-07-09 13:36:19', '2021-07-09 13:36:19');
INSERT INTO `app_receipt_actions` VALUES (5, 1, 3, '', '', '', 2, 0, 4, '2021-07-09 13:36:24', '2021-07-09 13:36:24');

-- ----------------------------
-- Table structure for app_social_media
-- ----------------------------
DROP TABLE IF EXISTS `app_social_media`;
CREATE TABLE `app_social_media`  (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(3) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_social_name`(`name`) USING BTREE,
  UNIQUE INDEX `idx_social_url`(`link`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_social_media
-- ----------------------------
INSERT INTO `app_social_media` VALUES (3, 'Facebook', 'https://www.facebook.com/twangchuktangbi/', 1, 'facebook', '8', '2021-04-15 13:34:46', '2021-04-15 13:34:46');
INSERT INTO `app_social_media` VALUES (4, 'Website', 'https://www.nlcs.gov.bt/', 1, 'globe', '8', '2021-04-15 13:44:42', '2021-04-15 13:44:42');

-- ----------------------------
-- Table structure for app_tasks
-- ----------------------------
DROP TABLE IF EXISTS `app_tasks`;
CREATE TABLE `app_tasks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `key` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL,
  `pending` tinyint(4) NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_tasks
-- ----------------------------
INSERT INTO `app_tasks` VALUES (1, 'ods', 'rLetterAction.php', 1, 4, 0, 0, 'Official letter in the system needs your attention.', 4, '2021-07-09 13:35:25', '2021-07-09 13:36:24');

-- ----------------------------
-- Table structure for sms_log
-- ----------------------------
DROP TABLE IF EXISTS `sms_log`;
CREATE TABLE `sms_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` int(8) NOT NULL,
  `sms` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senton` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_departments
-- ----------------------------
DROP TABLE IF EXISTS `sys_departments`;
CREATE TABLE `sys_departments`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `office` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `author` int(11) NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_office`(`office`) USING BTREE,
  CONSTRAINT `fk_office` FOREIGN KEY (`office`) REFERENCES `sys_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_departments
-- ----------------------------
INSERT INTO `sys_departments` VALUES (1, 1, 'Department One', 'Department One Description', 1, '2021-05-06 11:31:29', '2021-05-06 11:31:29');

-- ----------------------------
-- Table structure for sys_dispatch_num
-- ----------------------------
DROP TABLE IF EXISTS `sys_dispatch_num`;
CREATE TABLE `sys_dispatch_num`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dORr` int(11) NOT NULL COMMENT 'd=1, r=2',
  `dr_num` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of sys_dispatch_num
-- ----------------------------
INSERT INTO `sys_dispatch_num` VALUES (1, 1, 1, 2021);
INSERT INTO `sys_dispatch_num` VALUES (2, 2, 1, 2021);
INSERT INTO `sys_dispatch_num` VALUES (3, 1, 0, 2022);
INSERT INTO `sys_dispatch_num` VALUES (4, 2, 0, 2022);
INSERT INTO `sys_dispatch_num` VALUES (5, 1, 0, 2023);
INSERT INTO `sys_dispatch_num` VALUES (6, 2, 0, 2023);
INSERT INTO `sys_dispatch_num` VALUES (7, 1, 0, 2024);
INSERT INTO `sys_dispatch_num` VALUES (8, 2, 0, 2024);
INSERT INTO `sys_dispatch_num` VALUES (9, 1, 0, 2025);
INSERT INTO `sys_dispatch_num` VALUES (10, 2, 0, 2025);
INSERT INTO `sys_dispatch_num` VALUES (11, 1, 0, 2026);
INSERT INTO `sys_dispatch_num` VALUES (12, 2, 0, 2026);
INSERT INTO `sys_dispatch_num` VALUES (13, 1, 0, 2027);
INSERT INTO `sys_dispatch_num` VALUES (14, 2, 0, 2027);
INSERT INTO `sys_dispatch_num` VALUES (15, 1, 0, 2028);
INSERT INTO `sys_dispatch_num` VALUES (16, 2, 0, 2028);
INSERT INTO `sys_dispatch_num` VALUES (17, 1, 0, 2029);
INSERT INTO `sys_dispatch_num` VALUES (18, 2, 0, 2029);
INSERT INTO `sys_dispatch_num` VALUES (19, 1, 0, 2030);
INSERT INTO `sys_dispatch_num` VALUES (20, 2, 0, 2030);

-- ----------------------------
-- Table structure for sys_dispatch_status
-- ----------------------------
DROP TABLE IF EXISTS `sys_dispatch_status`;
CREATE TABLE `sys_dispatch_status`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `color` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_dispatch_status
-- ----------------------------
INSERT INTO `sys_dispatch_status` VALUES (1, 'Received', 'Copy recieved and acknowledge.', 'primary', 1, '2021-05-02 20:08:47', '2021-05-02 20:08:47');
INSERT INTO `sys_dispatch_status` VALUES (2, 'Complete', 'Receipt Complete', 'success', 1, '2021-05-02 20:08:47', '2021-05-02 20:08:47');

-- ----------------------------
-- Table structure for sys_divisions
-- ----------------------------
DROP TABLE IF EXISTS `sys_divisions`;
CREATE TABLE `sys_divisions`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `department`(`department`) USING BTREE,
  CONSTRAINT `fk_dept` FOREIGN KEY (`department`) REFERENCES `sys_departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_divisions
-- ----------------------------
INSERT INTO `sys_divisions` VALUES (1, 1, 'Division One', 'Division One Description', 1, '2021-05-06 11:31:50', '2021-05-06 11:31:50');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `route` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES (1, 'Dashoboard', 'main', '1,2,3,4', 'tachometer', 1, '2021-04-13 20:54:04', '2021-04-13 20:54:04');
INSERT INTO `sys_menu` VALUES (2, 'Office Details', NULL, '1,2,3,4', 'bank', 1, '2021-04-13 20:54:04', '2021-04-13 20:54:04');
INSERT INTO `sys_menu` VALUES (3, 'User Manager', NULL, '1,2,3,4', 'users', 1, '2021-04-13 20:54:04', '2021-04-13 20:54:04');
INSERT INTO `sys_menu` VALUES (4, 'Dispatch and Receipt', NULL, '1,2,3,4', 'envelope', 1, '2021-04-13 20:54:04', '2021-04-13 20:54:04');

-- ----------------------------
-- Table structure for sys_office
-- ----------------------------
DROP TABLE IF EXISTS `sys_office`;
CREATE TABLE `sys_office`  (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `author` int(11) NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_office
-- ----------------------------
INSERT INTO `sys_office` VALUES (1, 'Office', 'Office Description', 1, '2021-05-06 11:31:04', '2021-05-06 11:31:04');

-- ----------------------------
-- Table structure for sys_receipt_status
-- ----------------------------
DROP TABLE IF EXISTS `sys_receipt_status`;
CREATE TABLE `sys_receipt_status`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `color` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_receipt_status
-- ----------------------------
INSERT INTO `sys_receipt_status` VALUES (1, 'Received', 'Receipt recieved Acknowledge', 'primary', 1, '2021-05-01 20:08:47', '2021-05-01 20:08:47');
INSERT INTO `sys_receipt_status` VALUES (2, 'Completed', 'Receipt Complete', 'success', 1, '2021-05-01 20:08:47', '2021-05-01 20:08:47');

-- ----------------------------
-- Table structure for sys_roles
-- ----------------------------
DROP TABLE IF EXISTS `sys_roles`;
CREATE TABLE `sys_roles`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `role`(`role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_roles
-- ----------------------------
INSERT INTO `sys_roles` VALUES (1, 'Dispatcher', 'Dispatcher', 1, '2021-04-09 20:23:38', '2021-04-09 20:23:38');
INSERT INTO `sys_roles` VALUES (2, 'Normal User', 'Normal User', 1, '2021-04-09 20:23:38', '2021-04-09 20:23:38');
INSERT INTO `sys_roles` VALUES (3, 'Head', 'Head', 1, '2021-04-09 20:23:38', '2021-04-09 20:23:38');
INSERT INTO `sys_roles` VALUES (4, 'Admin', 'Admin', 1, '2021-04-09 20:23:38', '2021-04-09 20:23:38');

-- ----------------------------
-- Table structure for sys_sections
-- ----------------------------
DROP TABLE IF EXISTS `sys_sections`;
CREATE TABLE `sys_sections`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `division` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `author` int(11) NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `div_id`(`division`) USING BTREE,
  CONSTRAINT `fk_division` FOREIGN KEY (`division`) REFERENCES `sys_divisions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_sections
-- ----------------------------
INSERT INTO `sys_sections` VALUES (1, 1, 'Section One', 'Section One Description', 1, '2021-05-06 11:32:10', '2021-05-06 11:32:10');

-- ----------------------------
-- Table structure for sys_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_sub_menu`;
CREATE TABLE `sys_sub_menu`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `main_menu` smallint(5) UNSIGNED NOT NULL,
  `sub_menu_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `route` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_menu_id`(`main_menu`) USING BTREE,
  CONSTRAINT `fk_menu_id` FOREIGN KEY (`main_menu`) REFERENCES `sys_menu` (`id`) ON DELETE RESTRICT ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_sub_menu
-- ----------------------------
INSERT INTO `sys_sub_menu` VALUES (1, 2, 'Office Details Setup', 'system', 'office.php', '4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (2, 2, 'Staff Details', 'system', 'staff.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (3, 2, 'Contact Directory', 'system', 'cdirectory.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (4, 3, 'Create New User', 'user', 'addUser.php', '4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (5, 3, 'User List', 'user', 'index.php', '4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (6, 3, 'User Profile', 'user', 'userProfile.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (7, 3, 'User Notifications', 'user', 'notifications.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (8, 3, 'User Tasks', 'user', 'tasks.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (9, 4, 'Dispatch Letter', 'ods', 'dispatchLetter.php', '1,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (10, 4, 'Recieve Letter', 'ods', 'recieveLetter.php', '1,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (11, 4, 'Dispatch Report', 'ods', 'dispatchReport.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (12, 4, 'Receipt Report', 'ods', 'receiptReport.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (13, 4, 'Search D/R by Num', 'ods', 'searchDR.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');
INSERT INTO `sys_sub_menu` VALUES (14, 4, 'Search by RefNum', 'ods', 'searchDRbyRefNum.php', '1,2,3,4', 1, '2021-04-12 11:33:37', '2021-04-12 11:33:37');

-- ----------------------------
-- Table structure for sys_users
-- ----------------------------
DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE `sys_users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mobile` int(11) NOT NULL,
  `cid` bigint(11) NOT NULL,
  `empid` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `office` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `department` smallint(5) UNSIGNED NOT NULL,
  `division` smallint(5) UNSIGNED NOT NULL,
  `section` smallint(5) UNSIGNED NOT NULL,
  `office_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ext_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = blocked and 1 = active',
  `user_status` tinyint(3) NULL DEFAULT NULL COMMENT '0 = invisible, 1 = available,\r \n2 = busy',
  `photo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `last_logout` datetime(0) NULL DEFAULT NULL,
  `last_access_ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `logins` int(11) NULL DEFAULT 0,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_role_id`(`role`) USING BTREE,
  INDEX `fk_office_id`(`office`) USING BTREE,
  INDEX `fk_dept_id`(`department`) USING BTREE,
  INDEX `fk_division_id`(`division`) USING BTREE,
  INDEX `fk_section_id`(`section`) USING BTREE,
  CONSTRAINT `fk_dept_id` FOREIGN KEY (`department`) REFERENCES `sys_departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_division_id` FOREIGN KEY (`division`) REFERENCES `sys_divisions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_office_id` FOREIGN KEY (`office`) REFERENCES `sys_office` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_section_id` FOREIGN KEY (`section`) REFERENCES `sys_sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_users
-- ----------------------------
INSERT INTO `sys_users` VALUES (1, 'Admin', 'admin@gmail.com', 17521273, 11705001649, '2013', 1, 1, 1, 1, '02-330330', '205', 'ICT Officer', '4', 1, 1, 'default.jpg', '2021-09-15 12:22:43', '2021-09-15 12:22:26', '::1', 54, '6df73cc169278dd6daab5fe7d6cacb1fed537131', 1, '2021-04-13 21:54:45', '2021-09-15 12:24:24');
INSERT INTO `sys_users` VALUES (2, 'Dispatcher', 'dispatch@gmail.com', 11111111, 11705001649, '2013', 1, 1, 1, 1, '02-330330', '205', 'ICT Officer', '1', 1, 0, 'default.jpg', '2021-07-09 13:33:32', '2021-07-09 13:35:28', '::1', 53, '6df73cc169278dd6daab5fe7d6cacb1fed537131', 8, '2021-04-13 21:54:45', '2021-05-03 14:53:41');
INSERT INTO `sys_users` VALUES (3, 'Normal', 'normal@gmail.com', 22222222, 11705001649, '2013', 1, 1, 1, 1, '02-330330', '205', 'ICT Officer', '2', 1, 0, 'default.jpg', '2021-07-09 14:05:21', '2021-07-09 14:06:11', '::1', 54, '6df73cc169278dd6daab5fe7d6cacb1fed537131', 8, '2021-04-13 21:54:45', '2021-05-03 14:53:41');
INSERT INTO `sys_users` VALUES (4, 'Head', 'head@gmail.com', 33333333, 11705001649, '2013', 1, 1, 1, 1, '02-330330', '205', 'ICT Officer', '3', 1, 0, 'default.jpg', '2021-07-09 13:35:36', '2021-07-09 13:36:43', '::1', 52, '6df73cc169278dd6daab5fe7d6cacb1fed537131', 8, '2021-04-13 21:54:45', '2021-05-03 14:53:41');

SET FOREIGN_KEY_CHECKS = 1;
