# Host: localhost  (Version: 5.5.53)
# Date: 2017-06-26 18:50:00
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "php34_admin"
#

DROP TABLE IF EXISTS `php34_admin`;
CREATE TABLE `php34_admin` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用 1：启用 0：禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "php34_admin"
#

/*!40000 ALTER TABLE `php34_admin` DISABLE KEYS */;
INSERT INTO `php34_admin` VALUES (1,'root','2e63313c48a53b75eebe8d6f74ac9c22',1);
/*!40000 ALTER TABLE `php34_admin` ENABLE KEYS */;

#
# Structure for table "php34_goods"
#

DROP TABLE IF EXISTS `php34_goods`;
CREATE TABLE `php34_goods` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(45) NOT NULL DEFAULT '' COMMENT '商品名称',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '商品logo',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '商品缩略图logo',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_desc` longtext COMMENT '商品描述',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架，1：上架，2：不上架',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已经删除，1:已经删除，0：没有删除',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `price` (`price`),
  KEY `is_on_sale` (`is_on_sale`),
  KEY `is_delete` (`is_delete`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品表';

#
# Data for table "php34_goods"
#

/*!40000 ALTER TABLE `php34_goods` DISABLE KEYS */;
INSERT INTO `php34_goods` VALUES (2,'测试2','Goods/2017-06-26/595062451773e.jpg','Goods/2017-06-26/thumb_595062451773e.jpg',15.00,'<p>测试2</p>',1,0,1497585000),(3,'测试3','Goods/2017-06-26/5950919852a3c.jpg','Goods/2017-06-26/thumb_5950919852a3c.jpg',152.00,'',0,0,1497597389),(4,'测试626','Goods/2017-06-26/5950628ca2941.jpg','Goods/2017-06-26/thumb_5950628ca2941.jpg',1111.00,'<p>茶树菇<strong>真好吃</strong></p>',1,0,1498440332),(5,'编辑测试','Goods/2017-06-26/59508fbbc4e49.jpg','Goods/2017-06-26/thumb_59508fbbc4e49.jpg',1200.00,'',1,0,1498441333);
/*!40000 ALTER TABLE `php34_goods` ENABLE KEYS */;
