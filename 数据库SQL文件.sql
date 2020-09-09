/*
Navicat MySQL Data Transfer

Source Server         : 阿里Mysql
Source Server Version : 50537
Source Host           : 114.215.80.214:3306
Source Database       : template_cms_api

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2020-09-09 22:13:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_setkey
-- ----------------------------
DROP TABLE IF EXISTS `app_setkey`;
CREATE TABLE `app_setkey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `settype_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '对应settype表的id值',
  `settgradeone` varchar(10) NOT NULL DEFAULT 'android' COMMENT '平台',
  `config_key` varchar(30) NOT NULL COMMENT '配置键名',
  `config_name` varchar(255) NOT NULL COMMENT '显示什么名称',
  `config_htmltype` varchar(15) NOT NULL COMMENT 'text/radio/checkbox/textarea等',
  `config_htmlvalue` varchar(255) NOT NULL COMMENT '配置值,可以是单选值，多选值',
  `config_widthheight` varchar(15) NOT NULL DEFAULT '' COMMENT '输入框的长宽，否则只是宽',
  `config_value` varchar(255) NOT NULL DEFAULT '' COMMENT '配置默认值(各机型如果未单独设置就采用此值)',
  `config_disable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用',
  `config_help` varchar(200) NOT NULL DEFAULT '' COMMENT '配置页中的提示说明',
  `sortnum` int(10) unsigned NOT NULL DEFAULT '50' COMMENT '排序值(越大越排前)',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COMMENT='平台全局配置表';

-- ----------------------------
-- Table structure for app_settype
-- ----------------------------
DROP TABLE IF EXISTS `app_settype`;
CREATE TABLE `app_settype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setkey` varchar(30) NOT NULL COMMENT '英文标识符，线上禁止修改',
  `setname` varchar(50) NOT NULL COMMENT '配置类型名称',
  `settips` varchar(255) NOT NULL DEFAULT '' COMMENT '配置类型说明',
  `sortnum` int(11) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='配置类型表';

-- ----------------------------
-- Table structure for app_setval
-- ----------------------------
DROP TABLE IF EXISTS `app_setval`;
CREATE TABLE `app_setval` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `settgradeone` varchar(255) NOT NULL COMMENT '平台',
  `settgradetwo` varchar(255) NOT NULL DEFAULT 'high' COMMENT '机型',
  `settype_id` int(10) unsigned NOT NULL COMMENT '配置类别ID值',
  `setkey_id` int(10) unsigned NOT NULL COMMENT '配置项ID',
  `setval` varchar(255) NOT NULL DEFAULT '' COMMENT '配置的值',
  `lastmodify` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `only` (`settgradeone`,`settgradetwo`,`settype_id`,`setkey_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1477 DEFAULT CHARSET=utf8 COMMENT='配置值表';

-- ----------------------------
-- Table structure for app_user
-- ----------------------------
DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL COMMENT '暴风uid',
  `username` varchar(255) NOT NULL COMMENT '用户呢称',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `userimg` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '第一次进入 时间',
  `shifu_uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '师傅uid',
  `weixin_id` char(64) NOT NULL DEFAULT '' COMMENT '对应微信openid',
  `weixin_nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `weixin_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '绑定微信的时间',
  `invitecode` char(6) NOT NULL DEFAULT '' COMMENT '邀请码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `invitecode` (`invitecode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for app_usermore
-- ----------------------------
DROP TABLE IF EXISTS `app_usermore`;
CREATE TABLE `app_usermore` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL COMMENT '暴风uid',
  `golds` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户金币数',
  `money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户金钱数',
  `tudi_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '徒弟数量',
  `change_golds` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '累计转换金币',
  `out_cash` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '累计提现(分)',
  `devote_golds` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '累计给上级贡献金币数',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COMMENT='用户扩展表';

-- ----------------------------
-- Table structure for sys_adminer
-- ----------------------------
DROP TABLE IF EXISTS `sys_adminer`;
CREATE TABLE `sys_adminer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realname` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '真实姓名',
  `username` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT '管理员账号',
  `password` char(32) CHARACTER SET utf8 NOT NULL COMMENT '管理员密码',
  `role` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '账号角色:1超级管理员，2管理员',
  `says` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员的备注',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '账号状态;1正常，0禁用',
  `right` text CHARACTER SET utf8 COMMENT '账号权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=gbk COMMENT='管理员账号表';

-- ----------------------------
-- Table structure for sys_config
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` int(11) NOT NULL,
  `platname` varchar(100) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `copyright` varchar(20) NOT NULL,
  `googlecheck` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `gradeonename` varchar(255) NOT NULL DEFAULT '',
  `settgradeone` varchar(255) NOT NULL DEFAULT 'default',
  `gradetwoname` varchar(255) NOT NULL DEFAULT '',
  `settgradetwo` varchar(255) NOT NULL DEFAULT 'defalut',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统级配置表';

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keychar` varchar(20) NOT NULL,
  `showname` varchar(30) NOT NULL,
  `fatherid` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(50) NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `sortnum` int(11) unsigned NOT NULL DEFAULT '100',
  `fixurl` varchar(255) NOT NULL DEFAULT '',
  `fix` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '为1是不能删除修改',
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Table structure for sys_qa
-- ----------------------------
DROP TABLE IF EXISTS `sys_qa`;
CREATE TABLE `sys_qa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '分类:1新手问题;2金币问题;3收徒问题;4提现问题;5账号问题;',
  `question` varchar(255) NOT NULL DEFAULT '' COMMENT '问题描述',
  `answer` text NOT NULL COMMENT '答案',
  `enabled` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用: 1启用;0禁用;',
  `sortnum` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序值',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='常见问题';

-- ----------------------------
-- Table structure for sys_record
-- ----------------------------
DROP TABLE IF EXISTS `sys_record`;
CREATE TABLE `sys_record` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usertype` tinyint(3) NOT NULL DEFAULT '1' COMMENT '操作者角色（1管理员，2用户，3预留）',
  `uid` bigint(20) unsigned NOT NULL COMMENT 'uid',
  `username` varchar(100) NOT NULL COMMENT '操作角色名称(前台为暴风困呢称，后台为商家名称，总后台管理员呢称)',
  `dowhat` varchar(255) NOT NULL COMMENT '操作描述',
  `doip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户IP地址',
  `dotime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `dotime` (`dotime`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='平台操作记录表';
