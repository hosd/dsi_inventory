/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80031
Source Host           : localhost:3306
Source Database       : brambo

Target Server Type    : MYSQL
Target Server Version : 80031
File Encoding         : 65001

Date: 2023-03-23 15:21:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dynamic_menu_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_dynamic_menu_id_foreign` (`dynamic_menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('43', 'role-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '152');
INSERT INTO `permissions` VALUES ('44', 'role-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '152');
INSERT INTO `permissions` VALUES ('45', 'role-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '152');
INSERT INTO `permissions` VALUES ('46', 'role-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '152');
INSERT INTO `permissions` VALUES ('47', 'user-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '151');
INSERT INTO `permissions` VALUES ('48', 'user-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '151');
INSERT INTO `permissions` VALUES ('49', 'user-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '151');
INSERT INTO `permissions` VALUES ('50', 'category-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '2');
INSERT INTO `permissions` VALUES ('51', 'category-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '2');
INSERT INTO `permissions` VALUES ('52', 'category-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '2');
INSERT INTO `permissions` VALUES ('53', 'category-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '2');
INSERT INTO `permissions` VALUES ('54', 'province-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '3');
INSERT INTO `permissions` VALUES ('55', 'province-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '3');
INSERT INTO `permissions` VALUES ('56', 'province-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '3');
INSERT INTO `permissions` VALUES ('57', 'province-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '3');
INSERT INTO `permissions` VALUES ('58', 'district-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '4');
INSERT INTO `permissions` VALUES ('59', 'district-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '4');
INSERT INTO `permissions` VALUES ('60', 'district-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '4');
INSERT INTO `permissions` VALUES ('61', 'district-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '4');
INSERT INTO `permissions` VALUES ('62', 'city-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '5');
INSERT INTO `permissions` VALUES ('63', 'city-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '5');
INSERT INTO `permissions` VALUES ('64', 'city-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '5');
INSERT INTO `permissions` VALUES ('65', 'city-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '5');
INSERT INTO `permissions` VALUES ('66', 'establishment-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '6');
INSERT INTO `permissions` VALUES ('67', 'establishment-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '6');
INSERT INTO `permissions` VALUES ('68', 'establishment-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '6');
INSERT INTO `permissions` VALUES ('69', 'establishment-delete', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '6');
INSERT INTO `permissions` VALUES ('70', 'labour-office-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '7');
INSERT INTO `permissions` VALUES ('71', 'labour-office-create', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '7');
INSERT INTO `permissions` VALUES ('72', 'labour-office-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '7');
INSERT INTO `permissions` VALUES ('73', 'letter-template-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '9');
INSERT INTO `permissions` VALUES ('74', 'letter-template-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '9');
INSERT INTO `permissions` VALUES ('75', 'sms-template-list', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '10');
INSERT INTO `permissions` VALUES ('76', 'sms-template-edit', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '10');
INSERT INTO `permissions` VALUES ('77', 'register-complaint', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '11');
INSERT INTO `permissions` VALUES ('88', 'search-complaint', 'web', '2021-11-18 20:42:32', '2021-11-18 20:42:32', '13');
INSERT INTO `permissions` VALUES ('89', 'labour-office-delete', 'web', '2021-12-09 01:08:13', '2021-12-09 01:08:16', '7');
INSERT INTO `permissions` VALUES ('90', 'labour-office-add-city', 'web', '2021-12-09 01:09:25', '2021-12-09 01:09:28', '7');
INSERT INTO `permissions` VALUES ('91', 'pending-approval-list', 'web', '2021-12-09 01:23:57', '2021-12-09 01:24:00', '21');
INSERT INTO `permissions` VALUES ('92', 'pending-approval-status-history', 'web', '2021-12-09 01:24:03', '2021-12-09 01:24:06', '21');
INSERT INTO `permissions` VALUES ('93', 'pending-approval-action', 'web', '2021-12-09 01:24:13', '2021-12-09 01:24:16', '21');
INSERT INTO `permissions` VALUES ('94', 'pending-approval-view', 'web', '2021-12-09 01:31:00', '2021-12-09 01:31:02', '21');
INSERT INTO `permissions` VALUES ('95', 'pending-certificate-list', 'web', '2021-12-09 02:05:30', '2021-12-09 02:05:33', '23');
INSERT INTO `permissions` VALUES ('96', 'pending-certificate-status-history', 'web', '2021-12-09 02:05:35', '2021-12-09 02:05:39', '23');
INSERT INTO `permissions` VALUES ('97', 'pending-certificate-action', 'web', '2021-12-09 02:05:41', '2021-12-09 02:05:44', '23');
INSERT INTO `permissions` VALUES ('98', 'pending-certificate-view', 'web', '2021-12-09 02:05:47', '2021-12-09 02:05:51', '23');
INSERT INTO `permissions` VALUES ('99', 'pending-chargesheet-list', 'web', '2021-12-09 02:27:49', '2021-12-09 02:27:58', '25');
INSERT INTO `permissions` VALUES ('100', 'pending-chargesheet-status-history', 'web', '2021-12-09 02:27:51', '2021-12-09 02:28:01', '25');
INSERT INTO `permissions` VALUES ('101', 'pending-chargesheet-action', 'web', '2021-12-09 02:27:53', '2021-12-09 02:28:04', '25');
INSERT INTO `permissions` VALUES ('102', 'pending-chargesheet-view', 'web', '2021-12-09 02:27:55', '2021-12-09 02:28:08', '25');
INSERT INTO `permissions` VALUES ('103', 'report-search', 'web', '2021-12-09 02:42:55', '2021-12-09 02:43:05', '30');
INSERT INTO `permissions` VALUES ('104', 'report-complaint-year', 'web', '2021-12-09 02:43:00', '2021-12-09 02:43:07', '29');
INSERT INTO `permissions` VALUES ('105', 'report-complaint', 'web', '2021-12-09 02:43:02', '2021-12-09 02:43:10', '28');
INSERT INTO `permissions` VALUES ('106', 'complaint-status-list', 'web', '2021-12-09 02:43:02', '2021-12-09 02:43:02', '155');
INSERT INTO `permissions` VALUES ('107', 'complaint-status-create', 'web', '2021-12-09 02:43:02', '2021-12-09 02:43:02', '155');
INSERT INTO `permissions` VALUES ('108', 'complaint-status-edit', 'web', '2021-12-09 08:32:59', '2021-12-09 08:32:59', '155');
INSERT INTO `permissions` VALUES ('109', 'complaint-status-delete', 'web', '2021-12-09 08:32:59', '2021-12-09 08:32:59', '155');
INSERT INTO `permissions` VALUES ('110', 'business-nature-list', 'web', '2021-12-11 03:08:52', '2021-12-11 03:08:57', '158');
INSERT INTO `permissions` VALUES ('111', 'business-nature-create', 'web', '2021-12-11 03:22:32', '2021-12-11 03:22:36', '158');
INSERT INTO `permissions` VALUES ('112', 'business-nature-edit', 'web', '2021-12-11 03:23:01', '2021-12-11 03:23:04', '158');
INSERT INTO `permissions` VALUES ('113', 'business-nature-delete', 'web', '2021-12-11 03:23:30', '2021-12-11 03:23:34', '158');
INSERT INTO `permissions` VALUES ('117', 'recovery-list-view', 'web', '2021-12-11 04:26:39', '2021-12-11 04:26:42', '157');
INSERT INTO `permissions` VALUES ('118', 'pending-recovery-status-history', 'web', '2021-12-11 04:27:20', '2021-12-11 04:27:26', '157');
INSERT INTO `permissions` VALUES ('119', 'pending-recovery-action', 'web', '2021-12-11 04:27:41', '2021-12-11 04:27:46', '157');
INSERT INTO `permissions` VALUES ('127', 'log-activity-list', 'web', '2021-12-14 07:19:26', '2021-12-14 07:19:28', '26');
INSERT INTO `permissions` VALUES ('126', 'report-complaint-eachact', 'web', '2021-12-14 07:01:09', '2021-12-14 07:01:11', '31');
INSERT INTO `permissions` VALUES ('128', 'complaint-remark-list', 'web', '2021-12-09 02:43:02', '2021-12-09 02:43:02', '32');
INSERT INTO `permissions` VALUES ('129', 'complaint-remark-create', 'web', '2021-12-09 02:43:02', '2021-12-09 02:43:02', '32');
INSERT INTO `permissions` VALUES ('130', 'complaint-remark-edit', 'web', '2021-12-09 08:32:59', '2021-12-09 08:32:59', '32');
INSERT INTO `permissions` VALUES ('131', 'complaint-remark-delete', 'web', '2021-12-09 08:32:59', '2021-12-09 08:32:59', '32');
INSERT INTO `permissions` VALUES ('132', 'send-sms', 'web', '2021-12-28 03:20:18', '2021-12-28 03:20:24', '34');
INSERT INTO `permissions` VALUES ('133', 'report-complaint-eachoffice', 'web', '2022-01-11 21:37:10', '2022-01-11 21:37:14', '35');
INSERT INTO `permissions` VALUES ('134', 'sms-log-list', 'web', '2022-01-18 20:07:22', '2022-01-18 20:07:24', '36');
INSERT INTO `permissions` VALUES ('135', 'report-complaint-officerwise', 'web', '2022-01-21 09:15:31', '2022-01-21 09:15:36', '37');
INSERT INTO `permissions` VALUES ('136', 'report-complaint-officewise', 'web', '2022-01-25 02:15:51', '2022-01-25 02:15:53', '38');
INSERT INTO `permissions` VALUES ('137', 'report-complaint-by-period', 'web', '2022-01-24 10:15:51', '2022-01-24 10:15:53', '39');
INSERT INTO `permissions` VALUES ('139', 'email-log-list', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:31', '40');
INSERT INTO `permissions` VALUES ('140', 'report-transfer-complaint', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:31', '41');
INSERT INTO `permissions` VALUES ('141', 'report-categorywise', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:31', '42');
INSERT INTO `permissions` VALUES ('142', 'report-performance', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:31', '43');
INSERT INTO `permissions` VALUES ('143', 'event-title-list', 'web', '2021-12-08 15:43:02', '2021-12-08 15:43:02', '45');
INSERT INTO `permissions` VALUES ('144', 'event-title-create', 'web', '2021-12-08 15:43:02', '2021-12-08 15:43:02', '45');
INSERT INTO `permissions` VALUES ('145', 'event-title-edit', 'web', '2021-12-08 21:32:59', '2021-12-08 21:32:59', '45');
INSERT INTO `permissions` VALUES ('146', 'event-title-delete', 'web', '2021-12-08 21:32:59', '2021-12-08 21:32:59', '45');
INSERT INTO `permissions` VALUES ('147', 'event-list', 'web', '2021-12-08 15:43:02', '2021-12-08 15:43:02', '46');
INSERT INTO `permissions` VALUES ('148', 'event-edit', 'web', '2021-12-08 21:32:59', '2021-12-08 21:32:59', '46');
INSERT INTO `permissions` VALUES ('149', 'report-time-analysis', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:31', '44');
INSERT INTO `permissions` VALUES ('150', 'workshop-list', 'web', '2021-12-14 06:44:28', '2021-12-14 06:44:28', '200');
INSERT INTO `permissions` VALUES ('151', 'workshop-create', 'web', '2021-12-14 06:44:28', '0000-00-00 00:00:00', '200');
INSERT INTO `permissions` VALUES ('152', 'workshop-edit', 'web', '2021-12-14 06:44:28', '0000-00-00 00:00:00', '200');
INSERT INTO `permissions` VALUES ('153', 'workshop-delete', 'web', '2021-12-14 06:44:28', '0000-00-00 00:00:00', '200');
