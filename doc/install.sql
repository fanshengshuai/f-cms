# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.42)
# Database: f_cms
# Generation Time: 2016-09-28 13:49:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table f_about
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_about`;

CREATE TABLE `f_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `summary` text COMMENT '详情描述',
  `type` int(11) DEFAULT NULL COMMENT '分类 1.公司简介 2企业文化 3.组织结构 4.企业宣传片 5.荣誉资质     ||  subsite=1      1.子网站公司简介  2.子网站公司荣誉  3.子网站特色产品 4.子网站蔬菜基地 5.子网站连系我们 6.子网站首页轮播 7.法律声明',
  `language` varchar(255) DEFAULT NULL COMMENT '语言',
  `status` int(11) DEFAULT NULL COMMENT '状态1.正常 2.删除',
  `create_time` datetime DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `subsite` int(11) DEFAULT NULL COMMENT '1、子网站  否则是主网站',
  `page` int(11) DEFAULT NULL COMMENT '页面1.关于我们 2.新闻中心 3.品牌产品 4.广告鉴赏 5.联系我们',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table f_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_admin`;

CREATE TABLE `f_admin` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gid` int(11) NOT NULL,
  `remark` text NOT NULL,
  `rtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_admin` WRITE;
/*!40000 ALTER TABLE `f_admin` DISABLE KEYS */;

INSERT INTO `f_admin` (`a_id`, `username`, `password`, `sex`, `phone`, `email`, `gid`, `remark`, `rtime`, `status`, `role_id`, `create_time`)
VALUES
	(1,'admin','f6fdffe48c908deb0f4c3bd36c032e72',0,'13687607337','1063967131@qq.com',1,'1111',1441150517,1,0,'2016-04-06 13:52:33');

/*!40000 ALTER TABLE `f_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_admin_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_admin_group`;

CREATE TABLE `f_admin_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sys_role` text NOT NULL,
  `cms_role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_admin_group` WRITE;
/*!40000 ALTER TABLE `f_admin_group` DISABLE KEYS */;

INSERT INTO `f_admin_group` (`id`, `name`, `sys_role`, `cms_role`)
VALUES
	(1,'超级管理员1','[\"admin\\/index\",\"admingroup\\/index\",\"article\\/index\",\"recommend\\/index\",\"block\\/list\",\"feedback\\/feedback_index\",\"forex\\/index\",\"fragment\\/index\",\"group\\/index\",\"member\\/index\",\"member\\/messager\",\"message\\/index\",\"setting\\/category\",\"supply\\/index\",\"supply\\/no_pass\",\"supply\\/re_top\",\"system\\/log\",\"link\\/index\",\"syssetting\\/edit\",\"sqlbackup\\/index\"]','[\"25\",\"26\",\"27\",\"67\",\"68\",\"73\",\"74\",\"29\",\"30\",\"31\",\"32\",\"15\",\"16\",\"17\",\"59\",\"60\",\"61\",\"75\",\"76\",\"77\",\"19\",\"70\",\"62\",\"63\",\"78\",\"79\",\"80\",\"64\",\"65\",\"66\",\"81\",\"82\",\"83\",\"23\",\"24\",\"43\",\"33\",\"34\",\"35\",\"36\",\"37\",\"58\",\"38\",\"39\",\"40\",\"41\",\"42\",\"44\",\"69\",\"51\",\"52\",\"53\",\"72\",\"56\"]'),
	(2,'供求审查','[\"supply\\/index\",\"supply\\/review\",\"supply\\/edit\",\"supply\\/supply_del\",\"supply\\/settop\"]','[\"33\",\"34\",\"35\",\"36\",\"58\"]'),
	(3,'会员管理员','[\"member\\/index\",\"member\\/add\",\"member\\/member_del\",\"member\\/edit\",\"member\\/change_pwd\"]',''),
	(4,'系统日志','[\"system\\/log\",\"system\\/logDel\"]',''),
	(54,'123','','');

/*!40000 ALTER TABLE `f_admin_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_article`;

CREATE TABLE `f_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `cat_id_2` int(11) DEFAULT NULL,
  `cat_id_3` int(11) NOT NULL,
  `sort` int(10) NOT NULL,
  `keywords` varchar(100) NOT NULL COMMENT '关键词，30个汉字',
  `desn` text NOT NULL COMMENT '描述',
  `u_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `comefrom` varchar(32) NOT NULL COMMENT '文章来源',
  `views` int(6) NOT NULL,
  `pic` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `audit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否编辑',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未审核1已审核2未通过',
  `language` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1.生产基地 2.技术中心 3.加工车间 4.公司新闻 5.行业新闻 6.首页轮播图 7.法律声明    1.子网站公司新闻 2.子网站品牌活动3.子网站广告鉴赏',
  `author` varchar(255) DEFAULT NULL COMMENT '文章作者',
  `times` int(11) DEFAULT '0' COMMENT '浏览次数',
  `subsite` int(11) DEFAULT NULL COMMENT '子网站',
  `url` varchar(255) DEFAULT NULL COMMENT '广告地址链接',
  `is_hot` tinyint(1) DEFAULT NULL COMMENT '热门',
  `is_recommend` tinyint(1) DEFAULT NULL COMMENT '推荐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_article` WRITE;
/*!40000 ALTER TABLE `f_article` DISABLE KEYS */;

INSERT INTO `f_article` (`id`, `title`, `cat_id`, `cat_id_2`, `cat_id_3`, `sort`, `keywords`, `desn`, `u_id`, `location`, `comefrom`, `views`, `pic`, `content`, `create_time`, `audit`, `status`, `language`, `type`, `author`, `times`, `subsite`, `url`, `is_hot`, `is_recommend`)
VALUES
	(1023,'',0,NULL,0,0,'','',0,'','',0,'block/20160704/1115335509.jpg','','2016-06-14 16:27:05',0,1,NULL,1,NULL,0,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `f_article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_block`;

CREATE TABLE `f_block` (
  `bid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `block_type` tinyint(1) NOT NULL DEFAULT '0',
  `block_name` varchar(255) NOT NULL DEFAULT '',
  `block_title` text NOT NULL,
  `summary` text NOT NULL,
  `ext_fields` text NOT NULL COMMENT '扩展项目',
  `show_num` smallint(6) unsigned NOT NULL DEFAULT '0',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '0',
  `page` int(10) unsigned NOT NULL DEFAULT '0',
  `area` varchar(128) NOT NULL DEFAULT '0',
  `last_update_time` datetime NOT NULL COMMENT '上次更新时间',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  `remove_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `pic_width` smallint(6) unsigned DEFAULT '0',
  `pic_height` smallint(6) unsigned DEFAULT '0',
  `target` varchar(255) NOT NULL DEFAULT '',
  `cachetime` int(10) unsigned NOT NULL DEFAULT '0',
  `param` text NOT NULL,
  `sort` int(11) DEFAULT '0',
  `tpl` text,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_block` WRITE;
/*!40000 ALTER TABLE `f_block` DISABLE KEYS */;

INSERT INTO `f_block` (`bid`, `block_type`, `block_name`, `block_title`, `summary`, `ext_fields`, `show_num`, `cache_time`, `page`, `area`, `last_update_time`, `create_time`, `update_time`, `remove_time`, `status`, `pic_width`, `pic_height`, `target`, `cachetime`, `param`, `sort`, `tpl`)
VALUES
	(1,3,'首页幻灯片','','','',10,0,0,'1','0000-00-00 00:00:00','2016-07-30 09:20:08','0000-00-00 00:00:00','0000-00-00 00:00:00',1,NULL,NULL,'',0,'',0,'');

/*!40000 ALTER TABLE `f_block` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_block_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_block_item`;

CREATE TABLE `f_block_item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(255) NOT NULL DEFAULT '',
  `itemtype` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `pic` varchar(255) NOT NULL DEFAULT '',
  `picflag` tinyint(1) NOT NULL DEFAULT '0',
  `makethumb` tinyint(1) NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  `showstyle` text NOT NULL,
  `related` text NOT NULL,
  `fields` text NOT NULL,
  `sort` int(11) NOT NULL,
  `startdate` int(10) unsigned NOT NULL DEFAULT '0',
  `enddate` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  `remove_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `note` text NOT NULL COMMENT '注释',
  PRIMARY KEY (`item_id`),
  KEY `bid` (`bid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table f_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_category`;

CREATE TABLE `f_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `model_id` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `son_count` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT '分类id',
  `language` varchar(255) DEFAULT NULL,
  `subsite` int(11) DEFAULT NULL COMMENT '是否子网站',
  `alias` varchar(11) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `recommendation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_category` WRITE;
/*!40000 ALTER TABLE `f_category` DISABLE KEYS */;

INSERT INTO `f_category` (`id`, `name`, `parent_id`, `model_id`, `sort`, `son_count`, `type`, `category_id`, `language`, `subsite`, `alias`, `pic`, `recommendation`)
VALUES
	(184,'收听3000+的答主们',0,22,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1714537539.png',NULL),
	(183,'知名机构玩转分答',0,22,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1715284645.png',NULL),
	(182,'奇葩辩手教你好好说话',0,22,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1716208313.png',NULL),
	(178,'往期讨论',0,18,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(177,'精选',0,18,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(176,'最新',0,18,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(175,'一元偷偷听',0,14,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(174,'限时免费听',0,14,0,1,0,NULL,NULL,NULL,NULL,'',NULL),
	(187,'名人',0,24,0,4,0,NULL,NULL,NULL,NULL,'model/20160719/1652454906.png',0),
	(188,'兴趣',0,24,0,16,0,NULL,NULL,NULL,NULL,'model/20160719/1654326712.png',0),
	(189,'专家',0,24,0,21,0,NULL,NULL,NULL,NULL,'model/20160719/1656217945.png',NULL),
	(190,'机构',0,24,0,2,0,NULL,NULL,NULL,NULL,'model/20160719/1658314833.png',NULL),
	(191,'其他',0,24,0,1,0,NULL,NULL,NULL,NULL,'model/20160719/1658538195.png',NULL),
	(192,'媒体',187,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(193,'商界',187,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(194,'作家',187,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(195,'学术',187,24,4,0,0,NULL,NULL,NULL,NULL,'model/20160725/1321511934.png',1),
	(196,'情感',188,24,3,0,0,NULL,NULL,NULL,NULL,'model/20160722/1702094351.png',1),
	(197,'影视',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(198,'美食',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(199,'音乐',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(200,'体育',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(201,'旅游',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(202,'时尚',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(203,'娱乐',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(204,'摄影',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(205,'健身',188,24,2,0,0,NULL,NULL,NULL,NULL,'model/20160722/1703035262.png',1),
	(206,'游戏',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(207,'动漫',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(208,'数码',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(209,'萌宠',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(210,'搞笑',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(211,'收藏',188,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(212,'互联网',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,0),
	(213,'职场',189,24,1,0,0,NULL,NULL,NULL,NULL,'model/20160722/1703367561.png',1),
	(214,'创业',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(215,'健康',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(216,'营销',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(217,'教育',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(218,'心理',189,24,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1703583304.png',1),
	(219,'财经',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(220,'法律',189,24,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1704268311.png',1),
	(221,'科普',189,24,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1709438476.png',1),
	(222,'设计',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(223,'育儿',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(224,'电商',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(225,'营养',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(226,'美妆',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(227,'艺术',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(228,'理财',189,24,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1704489406.png',1),
	(229,'电台',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(230,'房产',189,24,0,0,0,NULL,NULL,NULL,NULL,'model/20160722/1705101834.png',1),
	(231,'公益',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(232,'汽车',189,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(233,'自媒体',190,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(234,'机构',190,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(235,'其他',191,24,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL),
	(236,'二级菜单',174,14,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `f_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_feedback`;

CREATE TABLE `f_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '反馈id',
  `feedback_m_id` int(10) DEFAULT NULL COMMENT '反馈用户id',
  `feedback_username` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `qq` varchar(11) DEFAULT NULL COMMENT 'QQ号',
  `feedback_time` varchar(20) DEFAULT NULL COMMENT '反馈时间',
  `feedback_content` varchar(255) DEFAULT NULL COMMENT '反馈内容',
  `status` int(3) DEFAULT NULL COMMENT '状态(0未读,1已读,2删除)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table f_fragment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_fragment`;

CREATE TABLE `f_fragment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flag` (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table f_model
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_model`;

CREATE TABLE `f_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_rel` varchar(255) DEFAULT NULL COMMENT '关联表',
  `model_name` varchar(255) DEFAULT NULL,
  `model_addon` varchar(255) DEFAULT NULL,
  `summary` text,
  `create_time` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `readonly` tinyint(1) DEFAULT NULL COMMENT '是否可以录入',
  `recommendation` tinyint(4) DEFAULT NULL,
  `has_cate` tinyint(1) DEFAULT NULL COMMENT '是否有栏目管理',
  `hotpush` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_model` WRITE;
/*!40000 ALTER TABLE `f_model` DISABLE KEYS */;

INSERT INTO `f_model` (`id`, `sort`, `table_name`, `table_rel`, `model_name`, `model_addon`, `summary`, `create_time`, `status`, `readonly`, `recommendation`, `has_cate`, `hotpush`)
VALUES
	(22,6,'wonderful',NULL,'精彩合辑','','{\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"0\",0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,\"0\",0,0,0],\"title\":[\"title\",\"varchar(255)\",\"\\u59d3\\u540d\",0,\"1\",\"1\"],\"position\":{\"0\":\"position\",\"1\":\"text\",\"2\":\"\\u804c\\u4f4d\",\"4\":\"1\",\"5\":\"2\"},\"pic\":[\"pic\",\"varchar(255)\",\"\\u5934\\u50cf\",0,\"1\",\"3\"],\"answer\":{\"0\":\"answer\",\"1\":\"int(11)\",\"2\":\"\\u56de\\u7b54\\u7684\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"4\"},\"listen\":{\"0\":\"listen\",\"1\":\"int(11)\",\"2\":\"\\u6536\\u542c\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"5\"},\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,\"1\",\"6\",0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,\"1\",\"7\",0,0],\"Introduction\":{\"0\":\"Introduction\",\"1\":\"text\",\"2\":\"\\u5185\\u5bb9\\u7b80\\u4ecb\",\"4\":\"1\",\"5\":\"8\"}}','2016-07-12 14:05:02',1,NULL,NULL,1,0),
	(23,5,'user',NULL,'热推名人','','{\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,1,0,0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,0,0,0,0],\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,1,0,0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,0,0,0,0],\"title\":[\"title\",\"varchar(255)\",\"\\u6807\\u9898\",0,1,\"1\",0,0],\"pic\":[\"pic\",\"varchar(255)\",\"\\u56fe\\u7247\",0,\"1\",\"2\",0,0],\"position\":{\"0\":\"position\",\"1\":\"text\",\"2\":\"\\u804c\\u4f4d\",\"4\":\"1\",\"5\":\"3\"},\"answer\":{\"0\":\"answer\",\"1\":\"int(11)\",\"2\":\"\\u56de\\u7b54\\u7684\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"4\"},\"listen\":{\"0\":\"listen\",\"1\":\"int(11)\",\"2\":\"\\u6536\\u542c\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"5\"}}','2016-07-13 13:51:16',1,NULL,NULL,NULL,0),
	(19,1,'question',NULL,'讨论','','{\"title\":[\"title\",\"varchar(255)\",\"\\u6807\\u9898\",0,1,\"1\",0,0],\"pic\":[\"pic\",\"varchar(255)\",\"\\u56fe\\u7247\",0,\"1\",\"2\",0,0],\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"0\",\"3\",0,0],\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,1,\"4\",0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,\"0\",\"5\",0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,\"1\",\"6\",0,0],\"position\":{\"0\":\"position\",\"1\":\"varchar(255)\",\"2\":\"\\u804c\\u4f4d\",\"4\":\"1\"},\"answer\":{\"0\":\"answer\",\"1\":\"int(14)\",\"2\":\"\\u56de\\u7b54\\u7684\\u4eba\\u6570\",\"4\":\"1\"},\"listen\":{\"0\":\"listen\",\"1\":\"int(14)\",\"2\":\"\\u542c\\u8fc7\\u7684\\u4eba\\u6570\",\"4\":\"1\"}}','2016-07-09 15:03:51',1,NULL,NULL,1,0),
	(14,1,'question',NULL,'问题榜','','{\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,\"0\",0,0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,0,0,0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,0,0,0,0],\"title\":[\"title\",\"varchar(255)\",\"\\u6807\\u9898\",0,\"1\",\"1\",0,0],\"pic\":[\"pic\",\"varchar(255)\",\"\\u56fe\\u7247\",0,\"1\",\"2\",0,0],\"user\":{\"0\":\"user\",\"1\":\"varchar(255)\",\"2\":\"\\u7528\\u6237\",\"5\":\"3\"},\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"1\",\"3\",0,0],\"price\":{\"0\":\"price\",\"1\":\"varchar(100)\",\"2\":\"\\u4ef7\\u683c\",\"4\":\"1\",\"5\":\"4\"},\"askquestions\":{\"0\":\"askquestions\",\"1\":\"varchar(255)\",\"2\":\"\\u63d0\\u95ee\\u7528\\u6237\",\"4\":\"1\",\"5\":\"5\"},\"thumbup\":{\"0\":\"thumbup\",\"1\":\"int(11)\",\"2\":\"\\u70b9\\u8d5e\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"6\"},\"heard\":{\"0\":\"heard\",\"1\":\"int(11)\",\"2\":\"\\u542c\\u8fc7\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"7\"},\"appreciates\":[\"appreciates\",\"int(11)\",\"\\u8d5e\\u8d4f\\u4eba\\u6570\",null,\"1\",\"8\"],\"file\":{\"0\":\"file\",\"1\":\"varchar(255)\",\"2\":\"\\u8bed\\u97f3\",\"5\":\"9\",\"4\":\"0\"}}','2016-07-02 09:37:15',1,NULL,0,1,0),
	(15,2,'user',NULL,'新普榜','','{\"title\":[\"title\",\"varchar(255)\",\"\\u6807\\u9898\",0,\"1\",\"1\"],\"position\":{\"0\":\"position\",\"1\":\"varchar(255)\",\"2\":\"\\u804c\\u4f4d\",\"4\":\"1\",\"5\":\"2\"},\"pic\":[\"pic\",\"varchar(255)\",\"\\u56fe\\u7247\",0,\"1\",\"3\",0,0],\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"1\",\"4\",0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,\"1\",\"5\",0,0],\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,\"1\",\"6\",0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,0,\"7\",0,0]}','2016-07-04 11:02:12',1,NULL,NULL,0,0),
	(16,2,'user',NULL,'才华榜','','{\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,0,0,0,0],\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,\"0\",0,0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,0,0,0,0],\"title\":[\"title\",\"varchar(255)\",\"\\u59d3\\u540d\",0,1,\"1\"],\"position\":{\"0\":\"position\",\"1\":\"varchar(255)\",\"2\":\"\\u804c\\u4f4d\",\"5\":\"2\",\"4\":\"1\"},\"answer\":[\"answer\",\"int(14)\",\"\\u56de\\u7b54\\u4eba\\u6570\",null,\"1\"],\"listen\":{\"0\":\"listen\",\"1\":\"int(14)\",\"2\":\"\\u6536\\u542c\\u4eba\\u6570\",\"4\":\"1\",\"5\":\"4\"},\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"1\",\"5\",0,0],\"pic\":[\"pic\",\"varchar(255)\",\"\\u56fe\\u7247\",0,\"1\",\"5\",0,0]}','2016-07-04 11:03:14',1,NULL,NULL,NULL,0),
	(24,7,'user',NULL,'客户管理','','{\"title\":[\"nick_name\",\"varchar(255)\",\"\\u6635\\u79f0\",0,\"1\"],\"pic\":[\"pic\",\"varchar(255)\",\"\\u5934\\u50cf\",0,\"1\",\"2\"],\"answer\":[\"answernumber\",\"int(11)\",\"\\u56de\\u7b54\\u4eba\\u6570\",null,\"1\"],\"listen\":[\"belistennumber\",\"int(11)\",\"\\u6536\\u542c\\u4eba\\u6570\",null,\"1\"],\"content\":[\"content\",\"text\",\"\\u5185\\u5bb9\",0,\"0\",\"5\",0,0],\"create_time\":[\"create_time\",\"datetime\",\"\\u8bb0\\u5f55\\u521b\\u5efa\\u65f6\\u95f4\",0,\"0\",\"6\",0,0],\"update_time\":[\"update_time\",\"datetime\",\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u65f6\\u95f4\",0,0,\"7\",0,0],\"status\":[\"status\",\"int(1)\",\"\\u8bb0\\u5f55\\u72b6\\u6001\",0,0,\"8\",0,0],\"sort\":[\"sort\",\"int(11)\",\"\\u6392\\u5e8f\",0,\"0\",\"9\"],\"position\":[\"partner_name\",\"text\",\"\\u804c\\u4f4d\",null,\"1\"]}','2016-07-15 08:54:40',1,NULL,1,1,1);

/*!40000 ALTER TABLE `f_model` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_page`;

CREATE TABLE `f_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table f_question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_question`;

CREATE TABLE `f_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `question_uid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `cate_id` int(11) DEFAULT NULL COMMENT '分类ID',
  `lang` varchar(20) DEFAULT NULL COMMENT '语言',
  `pic` varchar(255) DEFAULT NULL COMMENT '图片',
  `content` text COMMENT '内容',
  `create_time` datetime DEFAULT NULL COMMENT '记录创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '记录更新时间',
  `remote_time` datetime DEFAULT NULL COMMENT '记录删除时间',
  `status` int(1) DEFAULT NULL COMMENT '记录状态',
  `user` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `parent_cate_id` int(11) DEFAULT NULL,
  `heard` int(11) DEFAULT NULL,
  `askquestions` varchar(255) DEFAULT NULL,
  `thumbup` int(11) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `appreciates` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ask` varchar(255) DEFAULT NULL,
  `answercondition` tinyint(1) NOT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `ask_time` datetime DEFAULT NULL,
  `listened` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `discuss` tinyint(1) DEFAULT NULL,
  `free_time` datetime DEFAULT NULL COMMENT '限时免费时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `lang` (`lang`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_question` WRITE;
/*!40000 ALTER TABLE `f_question` DISABLE KEYS */;

INSERT INTO `f_question` (`id`, `uid`, `question_uid`, `title`, `cate_id`, `lang`, `pic`, `content`, `create_time`, `update_time`, `remote_time`, `status`, `user`, `file`, `parent_cate_id`, `heard`, `askquestions`, `thumbup`, `price`, `appreciates`, `sort`, `name`, `ask`, `answercondition`, `condition`, `avatar`, `ask_time`, `listened`, `type`, `discuss`, `free_time`)
VALUES
	(7,2,0,'朋友又来借钱，不喜欢的异性表白，办公室当抢使，地铁职业乞丐，酒桌劝酒等等，我们怎样说不，如何拒绝别人？',174,NULL,'model/20160722/1420447635.jpg','<p>测试限时免费听内容</p>','2016-07-04 15:31:37','2016-07-22 14:20:44',NULL,1,'黄执中|口语老师','',0,22,'22',22,'122',22,2,NULL,NULL,0,'0',NULL,NULL,NULL,0,NULL,'2016-08-16 23:59:59'),
	(8,1,0,'医生在分答上面回答专业问题算不算违法行医啊？',175,NULL,'model/20160722/1415062326.jpg','<p>测试一元偷偷听内容</p>','2016-07-04 15:36:49','2016-07-22 14:15:06',NULL,1,'法律咨询专家','',0,149,'',1,'',0,1,NULL,NULL,0,'0',NULL,NULL,NULL,0,NULL,NULL),
	(39,1,2,'私密提问',NULL,NULL,NULL,NULL,'2016-08-01 15:33:27',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'已过期',NULL,NULL,NULL,1,NULL,NULL),
	(38,1,2,'私密提问',NULL,NULL,NULL,NULL,'2016-08-01 15:22:31',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'待回答',NULL,NULL,NULL,NULL,NULL,NULL),
	(42,2,0,'我是数据库新问题',174,NULL,'model/20160722/1420447635.jpg','<p>测试限时免费听内容</p>','2016-08-01 15:22:31',NULL,NULL,NULL,'法律咨询专家',NULL,0,111,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'已回答',NULL,NULL,NULL,NULL,NULL,NULL),
	(43,2,0,'我也是数据库新问题',236,NULL,'model/20160722/1415062326.jpg','<p>测试一元偷偷听内容</p>','2016-08-01 15:22:31','2016-08-03 11:31:36',NULL,NULL,'黄执中|口语老师','',174,111,'',0,'',0,NULL,NULL,NULL,1,'已回答',NULL,NULL,NULL,NULL,1,NULL);

/*!40000 ALTER TABLE `f_question` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_setting`;

CREATE TABLE `f_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setting_title` varchar(50) NOT NULL DEFAULT '',
  `setting_value` text,
  `setting_type` varchar(11) DEFAULT NULL,
  `setting_summary` varchar(50) DEFAULT '',
  `language` varchar(255) DEFAULT NULL COMMENT '语言',
  `setting_name` varchar(255) DEFAULT NULL,
  `subsite` int(11) DEFAULT NULL COMMENT '是否是子网站内容',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_setting` WRITE;
/*!40000 ALTER TABLE `f_setting` DISABLE KEYS */;

INSERT INTO `f_setting` (`id`, `setting_title`, `setting_value`, `setting_type`, `setting_summary`, `language`, `setting_name`, `subsite`, `sort`)
VALUES
	(31,'测试排序333',NULL,'int','测试备注',NULL,'sort',NULL,4),
	(30,'测试排序2222',NULL,'int','测试备注',NULL,'sort',NULL,3),
	(32,'测试排序2222',NULL,'int','测试备注',NULL,'sort',NULL,3);

/*!40000 ALTER TABLE `f_setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_system_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_system_log`;

CREATE TABLE `f_system_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` int(11) DEFAULT NULL COMMENT '1 登陆日志',
  `content` text,
  `create_time` datetime DEFAULT NULL,
  `ip` varchar(22) DEFAULT NULL,
  `manager_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_system_log` WRITE;
/*!40000 ALTER TABLE `f_system_log` DISABLE KEYS */;

INSERT INTO `f_system_log` (`id`, `log_type`, `content`, `create_time`, `ip`, `manager_name`)
VALUES
	(1,1,'登录成功','2016-07-30 10:19:27','192.168.2.115','admin'),
	(2,1,'登录成功','2016-08-01 17:24:09','192.168.2.104','admin'),
	(3,2,'登陆失败','2016-08-02 09:07:21','127.0.0.1','admin'),
	(4,1,'登录成功','2016-08-02 09:07:28','127.0.0.1','admin'),
	(5,1,'登录成功','2016-08-02 10:44:14','127.0.0.1','admin'),
	(6,1,'登录成功','2016-08-02 11:08:36','127.0.0.1','admin'),
	(7,1,'登录成功','2016-08-02 17:20:48','127.0.0.1','admin'),
	(8,1,'登录成功','2016-08-02 17:49:53','127.0.0.1','admin'),
	(9,1,'登录成功','2016-08-03 08:53:21','127.0.0.1','admin'),
	(10,1,'登录成功','2016-08-03 10:27:21','127.0.0.1','admin'),
	(11,1,'登录成功','2016-08-03 10:27:53','127.0.0.1','admin'),
	(12,1,'登录成功','2016-08-03 10:57:02','127.0.0.1','admin'),
	(13,1,'登录成功','2016-08-04 08:54:35','127.0.0.1','admin'),
	(14,1,'登录成功','2016-09-28 21:30:06','0.0.0.0','admin'),
	(15,1,'登录成功','2016-09-28 21:45:14','0.0.0.0','admin');

/*!40000 ALTER TABLE `f_system_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_user`;

CREATE TABLE `f_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL,
  `nick_name` varchar(255) NOT NULL,
  `real_name` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `email` varchar(200) DEFAULT NULL,
  `cate_id2` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `partner_name` text NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `free` tinyint(1) DEFAULT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '' COMMENT '手机号',
  `card_num` varchar(255) DEFAULT NULL COMMENT '身份证号',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '金币',
  `parent_id` int(11) NOT NULL COMMENT '父级ID',
  `is_active` tinyint(2) DEFAULT '0' COMMENT '激活状态    0、未激活  1、自己激活  2、上级激活',
  `user_level` int(11) NOT NULL DEFAULT '1' COMMENT '级别 -1 管理员 1 正常用户  2 组长  3 科长  4 经理',
  `birthday` datetime DEFAULT NULL COMMENT '生日',
  `active_time` datetime DEFAULT NULL COMMENT '激活时间',
  `open_id` varchar(255) DEFAULT NULL COMMENT '微信open_id',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `pic` varchar(255) NOT NULL,
  `titlename` varchar(255) NOT NULL,
  `is_leader` tinyint(1) DEFAULT NULL COMMENT '是不是导师',
  `answernumber` int(11) NOT NULL,
  `listennumber` int(11) NOT NULL,
  `belistennumber` int(11) NOT NULL,
  `parent_cate_id` int(11) DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL,
  `hotpush` tinyint(1) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态 1、正常  2、删除 ',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `f_user` WRITE;
/*!40000 ALTER TABLE `f_user` DISABLE KEYS */;

INSERT INTO `f_user` (`id`, `user_name`, `nick_name`, `real_name`, `email`, `cate_id2`, `cate_id`, `title`, `partner_name`, `introduction`, `content`, `amount`, `free`, `phone`, `card_num`, `address`, `password`, `coin`, `parent_id`, `is_active`, `user_level`, `birthday`, `active_time`, `open_id`, `create_time`, `pic`, `titlename`, `is_leader`, `answernumber`, `listennumber`, `belistennumber`, `parent_cate_id`, `classification`, `hotpush`, `sort`, `status`)
VALUES
	(1,NULL,'我是昵称',NULL,NULL,NULL,NULL,NULL,'我是职位也是头衔','我是简介',NULL,'',NULL,'',NULL,NULL,NULL,0,0,0,0,NULL,NULL,'','0000-00-00 00:00:00','','',NULL,22,0,22,NULL,NULL,1,NULL,0),
	(2,NULL,'白胡子',NULL,NULL,192,193,NULL,'测试',' 测试',NULL,'',NULL,'',NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,'','',NULL,0,0,0,NULL,NULL,1,NULL,1),
	(94,NULL,'二恶烷亲',NULL,NULL,NULL,187,'','我是职位也是头衔','','<p>123</p>','',NULL,'',NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,'2016-08-02 12:06:19','','',NULL,123123,0,123,0,NULL,1,2,1),
	(97,NULL,'我是新人',NULL,NULL,0,193,'','','','<p>是</p>','',NULL,'',NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,'2016-08-03 13:45:51','','',NULL,0,0,0,NULL,NULL,NULL,NULL,1);

/*!40000 ALTER TABLE `f_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_user_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_user_group`;

CREATE TABLE `f_user_group` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) DEFAULT NULL,
  `cate` text,
  `inter_auth` tinyint(1) NOT NULL DEFAULT '1' COMMENT '国外供求查看权限1允许2禁止',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
