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


/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

INSERT INTO `categories`(id, type_name, name, english_name, parent_id, icon, app_count, created_at) VALUES 
(1,'android','应用','app',0,NULL,0,'2012-06-25 16:52:29'),
(2,'android','游戏','game',0,NULL,0,'2012-06-25 16:52:29'),
(3,'android','专题','game',0,NULL,0,'2012-06-25 16:52:29'),
(11,'iphone','应用','app',0,NULL,0,'2012-06-25 16:52:29'),
(12,'iphone','游戏','game',0,NULL,0,'2012-06-25 16:52:29'),
(13,'iphone','专题','game',0,NULL,0,'2012-06-25 16:52:29'),
(101,'android','装机必备',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(102,'android','省钱利器',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(103,'android','美容护肤',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(104,'android','时尚阅读',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(105,'android','美食旅游',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(106,'android','摄影娱乐',NULL,1,NULL,2000,'2012-06-25 16:52:29'),
(107,'android','便捷工具',NULL,1,NULL,2000,'2012-06-25 16:52:29');

/*
--add apps
INSERT INTO `apps`(type_name, name, logo, version, category_id, star, developer, language, size, download_times, created_at, app_path, comment, description, status)
VALUES ('android', '美丽说','',,'3.4.5',103,90,'美丽说（北京）网络科技有限公司','中文','2.68M',2000,now(),NULL,'','','专为时尚女生量身定做 逛淘宝 利器: 实时更新的千万级宝贝库,全部来自于资深买家的推荐,MM们不必再费心去“淘”,美丽触手可得,随时享受逛街快乐;所有宝贝均以美丽说版独创的海报形式展现,华丽流畅的效果让人爱不释手;紧跟潮流的时尚热榜,足不出户就可以感受到当下的流行主题,MM们可以选择自己感兴趣的时尚主题、分享搭配照片,随时随地参加时尚Party。', 'A'),
('android', '美妆易购','',,'1.9.1',102,90,'南京火木网络科技有限公司','中文','1.20M',2000,now(),NULL,'','便捷的美妆购物工具，支持一键比价、一键购买、货到付款，百分百正品保证，所有货源均来自著名电商网站。','-----------------------------------------<br> ***美妆易购***-------潮流MM美妆必备<br> -----------------------------------------<br> *一键比价<br> *一键购买<br> *货到付款<br> *百分百正品保证，所有货源均来自著名电商网站(京东、当当、卓越等)<br> <br>【步骤说明】<br> 1、搜索产品关键字/扫描产品条码——多电商一键比价，让您买的实惠<br> 2、一键下单购买，可购买雅诗兰黛、兰蔻、柏莱雅、卡姿兰、自然堂等多个品牌正品商品(无需注册、跳转神马的)<br> 3、货到付款！百分百正品保证！购买正品化妆品0风险！<br><br>【涉及品牌】<br>兰蔻、雅诗兰黛、倩碧、香奈儿、薇姿、欧莱雅、碧欧泉、雅芳、玫琳凯、资生堂、梦妆、欧珀莱、兰芝、曼秀雷敦、菲诗小铺、DHC、植村秀、SK-II、娥佩兰、婵真、草木年华、佰草集、李医生、美即、御泥坊、清妃、丹姿、温碧泉、片仔癀、大宝、百雀羚、美丽日记、相宜本草、芳草集、火烈鸟、同仁堂、大卫杜夫、巴宝莉、纪梵希、安娜苏、娇兰、欧树、娇韵诗、皇室贵族、宝拉珍选、欧舒丹、巴黎绯黛、O.P.I、芙丽芳丝、三宅一生、高丝、SKIN79、JUST BB、薇欧薇、COSMOS、思亲肤、杰丽斯、悦己、巨型一号、高夫、昭贵、安安、西藏红花、迪豆、膜法世家、生活良品、草木良品、肌言堂、粉粉香<br><br>【功效/品类】<br>补水、保湿、祛痘、祛斑、收缩毛孔、护肤、去黑头、瘦脸、美白、防晒隔离、控油平衡、抗敏镇静、黑眼圈、眼袋、脂肪粒、香水、古龙水、护肤保养、面部、眼部、彩妆、卸妆、化妆工具、头发护理、手足护理、身体护理、男士护理、美甲、沐浴、面霜、隔离霜、洁面、化妆水、润肤乳液、日霜、晚霜、祛痘膏、防晒、晒后修复、按摩霜、颈霜、BB霜、隔离霜、妆前乳、遮瑕膏、粉饼、睫毛膏、眉笔、唇彩、唇膏、口红、化妆、粉扑、修眉、护发素、染发、假发、防脱发、护手霜、润肤乳、脱毛、去角质、止汗露、控油、剃须刀、润唇膏、洗发、沐浴、护发、鼻贴、香皂、浴盐<br><br>', 'A'),
*/









/*!40101 SET character_set_client = @saved_cs_client */;
