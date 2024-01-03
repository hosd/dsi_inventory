/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80031
Source Host           : localhost:3306
Source Database       : brambo

Target Server Type    : MYSQL
Target Server Version : 80031
File Encoding         : 65001

Date: 2023-03-23 15:34:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dynamic_menu
-- ----------------------------
DROP TABLE IF EXISTS `dynamic_menu`;
CREATE TABLE `dynamic_menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `is_parent` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_menu` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_order` int DEFAULT NULL,
  `child_order` int DEFAULT NULL,
  `fOrder` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dynamic_menu_id_unique` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dynamic_menu
-- ----------------------------
INSERT INTO `dynamic_menu` VALUES ('1', 'fa fa-lg fa-fw fa-database', 'Master Data', '1', '#', '0', '1', '1', '1', '0', '1.00', '2021-10-28 23:14:26', '2021-10-28 23:14:30');
INSERT INTO `dynamic_menu` VALUES ('2', '', 'Vehicle type list', '2', 'vehicletype-list', '1', '0', '1', null, '1', '2.00', '2021-11-02 02:36:15', '2021-11-02 02:36:19');
INSERT INTO `dynamic_menu` VALUES ('3', '', 'Vehicle make', '3', 'vehiclemake-list', '1', '0', '1', null, '2', '3.00', '2021-11-02 02:36:15', '2021-11-02 02:36:19');
INSERT INTO `dynamic_menu` VALUES ('4', '', 'Vehicle model', '4', 'vehiclemodel-list', '1', '0', '1', null, '3', '4.00', '2021-11-02 02:36:15', '2021-11-02 02:36:19');
INSERT INTO `dynamic_menu` VALUES ('5', '', 'Vehicle submodel', '5', 'vehiclesubmodel-list', '1', '0', '1', null, '4', '5.00', '2021-11-04 22:20:15', '2021-11-04 22:20:15');
INSERT INTO `dynamic_menu` VALUES ('6', '', 'Transmission type', '6', 'transmission-list', '1', '0', '1', null, '5', '6.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('7', '', 'Axle', '7', 'axle-list', '1', '0', '1', null, '6', '7.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('150', 'fa fa-lg fa-fw fa-cube', 'Admin', '150', '#', '0', '1', '1', '2', '1', '100.00', '2021-11-02 02:36:15', '2021-11-02 02:36:15');
INSERT INTO `dynamic_menu` VALUES ('151', null, 'User', '151', 'users-list', '150', '0', '1', null, '1', '101.00', '2021-11-02 02:36:15', '2021-11-02 02:36:15');
INSERT INTO `dynamic_menu` VALUES ('152', null, 'Role', '152', 'roles.index', '150', '0', '1', null, '2', '102.00', '2021-11-02 02:36:15', '2021-11-02 02:36:15');
INSERT INTO `dynamic_menu` VALUES ('153', null, 'Complaint List', '153', 'action-pending-list', '8', '0', '1', null, '2', '21.00', '2021-11-19 02:07:38', '2021-11-19 02:07:45');
INSERT INTO `dynamic_menu` VALUES ('8', '', 'Brake system', '8', 'brakesystem-list', '1', '0', '1', null, '7', '8.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('9', '', 'Body type', '9', 'bodytype-list', '1', '0', '1', null, '8', '9.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('10', '', 'Ventilation type', '10', 'ventilation-type-list', '1', '0', '1', null, '9', '10.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('11', '', 'Engine type', '11', 'enginetype-list', '1', '0', '1', null, '10', '11.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('13', '', 'Drive type', '13', 'drivetype-list', '1', '0', '1', null, '11', '13.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('14', '', 'Series ', '14', 'series-list', '1', '0', '1', null, '12', '14.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('15', '', 'Product type ', '15', 'producttype-list', '1', '0', '1', null, '13', '15.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('16', '', 'Product family', '16', 'productfamily-list', '1', '0', '1', null, '14', '16.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('17', '', 'Original equipment for vehicles', '17', 'original-equipment-for-vehicles-list', '1', '0', '1', null, '15', '17.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('18', '', 'Competitor brands', '18', 'competitor-brandse-list', '1', '0', '1', null, '16', '18.00', '2021-11-05 00:48:15', '2021-11-05 00:48:15');
INSERT INTO `dynamic_menu` VALUES ('200', 'fa fa-lg fa-fw fa-building', 'Work shop', '200', 'workshop-list', '0', '1', '1', '3', '0', '20.00', '2021-10-28 23:14:26', '2021-10-28 23:14:30');
