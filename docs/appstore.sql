-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: appstore
-- ------------------------------------------------------
-- Server version	5.1.58-1ubuntu1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_types`
--

DROP TABLE IF EXISTS `app_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_types` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_types`
--

LOCK TABLES `app_types` WRITE;
/*!40000 ALTER TABLE `app_types` DISABLE KEYS */;
INSERT INTO app_types(id, type_name, created_at)
VALUES(1, 'Android', now());
INSERT INTO app_types(id, type_name, created_at)
VALUES(2, 'iPhone', now());
INSERT INTO app_types(id, type_name, created_at)
VALUES(3, 'iPad', now());
/*!40000 ALTER TABLE `app_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `english_name` varchar(20) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `app_count` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--
LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(1, 'android', '专题', 'topic', 0, 0, now());
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(2, 'android', '应用', 'app', 0, 0, now());
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(3, 'android', '游戏', 'game', 0, 0, now());
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(11, 'iphone', '专题', 'topic', 0, 0, now());
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(12, 'iphone', '应用', 'app', 0, 0, now());
INSERT INTO categories(id, type_name, name, english_name, parent_id, app_count, created_at)
VALUES(13, 'iphone', '游戏', 'game', 0, 0, now());

INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(101, 1, '装机必备', 1, 23425, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(102, 1, '照片美化工具箱', 1, 13532, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(103, 1, '通讯.聊天', 2, 509325, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(104, 1, '声控游戏', 2, 867962, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(105, 1, '学习好帮手', 3, 5326, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(106, 2, '休闲益智', 13, 5326, now());
INSERT INTO categories(id, type_name, name, parent_id, app_count, created_at)
VALUES(107, 2, '射击动作', 13, 5326, now());
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `apps`
--

DROP TABLE IF EXISTS `apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apps` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `version` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `star` int(11) DEFAULT NULL,
  `developer` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `download_times` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `app_path` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apps`
--

LOCK TABLES `apps` WRITE;
/*!40000 ALTER TABLE `apps` DISABLE KEYS */;
INSERT INTO `apps` VALUES (1, 'android', '恶魔忍者2汉化版','http://cdn.image.market.hiapk.com/data/upload//2012/04_11/201204111029383871.png','1.1.7',0,104,'Droid Studio','English','10.5M',2352365,'2012-06-03 12:33:27',NULL,NULL,'upload/app/1.apk','恶魔忍者2 Devil Ninja2(vs Boss)<br/>
Devil Ninja2(恶魔忍者2)是 Devil Ninja 的第二部，这是一款还算不错的横版动作过关游戏，与第一部相比，这个新的版本中游戏的画面做了一些修改，图像看起来更加清晰，而且里面人物看起来也更大了一点。游戏在其他方面和第一部的差别并不大，同样的操作方式和故事情节。游戏中你的目的就是要打死怪物。杀死BOSS，使用各种道具来增强你的战斗力。<br/>

游戏玩法：<br/>
1.跳过悬崖;<br/>
2.两次跳得更高;<br/>
3.长按出招键积累能量;<br/>
4.收集道具来获得更多必杀技;<br/>
5.游戏加速。<br/>');

INSERT INTO `apps` VALUES (2, 'android', '腾讯微信','/upload/icon/201204111029383871.png','4.0',0,101,'中国腾讯科技（深圳）有限','中文','10.39MB',26492776,'2012-06-03 12:33:27',NULL,NULL,'upload/app/2.apk','基于Android平台的腾讯微信服务，带给您全新的移动即时通信体验。您可以使用微信软件快速地发送消息，即时拍照分享，随时随地联系身边的朋友。支持基于Android平台的手机终端设备。为了保护您的隐私，微信不会自动扫描和上传您的手机通讯录。并且不透露信息是否已读，降低收信压力。功能简介： 1.快速消息：极速轻快的楼层式消息对话，带给您飞一般的手机聊天体验。 2.照片分享：可调用手机拍照或插入相册图片,照片任意发，只需支付流量费用。 3.设置头像：给自己设置个性化头像,让您在好友的微信里看起来更亲切。');

INSERT INTO `apps` VALUES (3, 'android', '腾讯微信','/upload/icon/201204111029383871.png','3.0',0,103,'中国腾讯科技（深圳）有限','中文','10.39MB',26492776,'2012-06-03 12:33:27',NULL,NULL,'upload/app/2.apk','基于Android平台的腾讯微信服务，带给您全新的移动即时通信体验。您可以使用微信软件快速地发送消息，即时拍照分享，随时随地联系身边的朋友。支持基于Android平台的手机终端设备。为了保护您的隐私，微信不会自动扫描和上传您的手机通讯录。并且不透露信息是否已读，降低收信压力。功能简介： 1.快速消息：极速轻快的楼层式消息对话，带给您飞一般的手机聊天体验。 2.照片分享：可调用手机拍照或插入相册图片,照片任意发，只需支付流量费用。 3.设置头像：给自己设置个性化头像,让您在好友的微信里看起来更亲切。');
/*!40000 ALTER TABLE `apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_imgs`
--

DROP TABLE IF EXISTS `app_imgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_imgs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_imgs`
--

LOCK TABLES `app_imgs` WRITE;
/*!40000 ALTER TABLE `app_imgs` DISABLE KEYS */;
INSERT INTO app_imgs(app_id, img_path, created_at)
VALUES(2, '/upload/screenshot/201206011606188673.jpg', now());
INSERT INTO app_imgs(app_id, img_path, created_at)
VALUES(2, '/upload/screenshot/201206011606259033.jpg', now());
INSERT INTO app_imgs(app_id, img_path, created_at)
VALUES(2, '/upload/screenshot/201206011606316306.jpg', now());
INSERT INTO app_imgs(app_id, img_path, created_at)
VALUES(2, '/upload/screenshot/201206011606427408.jpg', now());
INSERT INTO app_imgs(app_id, img_path, created_at)
VALUES(2, '/upload/screenshot/201206011606485951.jpg', now());
/*!40000 ALTER TABLE `app_imgs` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `app_categories`
--

DROP TABLE IF EXISTS `app_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_categories`
--

LOCK TABLES `app_categories` WRITE;
/*!40000 ALTER TABLE `app_categories` DISABLE KEYS */;
INSERT INTO app_categories(app_id, category_id, created_at)
VALUES(1, 4, now());
INSERT INTO app_categories(app_id, category_id, created_at)
VALUES(2, 103, now());
INSERT INTO app_categories(app_id, category_id, created_at)
VALUES(2, 101, now());
INSERT INTO app_categories(app_id, category_id, created_at)
VALUES(3, 102, now());
/*!40000 ALTER TABLE `app_categories` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `app_downloads`
--

DROP TABLE IF EXISTS `app_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_downloads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) DEFAULT NULL,
  `ip_from` varchar(50) DEFAULT NULL,
  `brower` varchar(50) DEFAULT NULL,
  `system` varchar(50) DEFAULT NULL,  
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recommend_apps`
--

DROP TABLE IF EXISTS `recommend_apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommend_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommend_apps`
--

LOCK TABLES `recommend_apps` WRITE;
/*!40000 ALTER TABLE `recommend_apps` DISABLE KEYS */;
INSERT INTO recommend_apps(app_id, category_id, created_at)
VALUES(1, 4, now());
INSERT INTO recommend_apps(app_id, category_id, created_at)
VALUES(2, 4, now());
INSERT INTO recommend_apps(app_id, category_id, created_at)
VALUES(3, 4, now());
/*!40000 ALTER TABLE `recommend_apps` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-03 12:40:15
